<?php
/**
 * 용달코리아 v2 온라인 상담 페이지 (PHP 7.4.33, 반응형 웹)
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '온라인 상담 및 견적 문의 | ' . SITE_NAME . ' (1688-2404)';
$pageDescription = '용달코리아 온라인 상담 및 견적 문의. 화물 운송, 용달이사, 원룸이사, 리프트차 견적을 친절하고 신속하게 상담해 드립니다.';

// CSRF 토큰 생성
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$isSubmitted = false;
$isSuccess = false;
$errorMessage = '';

// 폼 제출 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isSubmitted = true;
    $csrfToken = $_POST['csrf_token'] ?? '';

    if (!hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        $errorMessage = '비정상적인 요청이 감지되었습니다. 페이지를 새로고침 후 다시 시도해 주세요.';
    } else {
        $name = trim($_POST['name'] ?? '');
        $tel = trim($_POST['tel'] ?? '');
        $email = trim($_POST['e_mail'] ?? '');
        $carType = trim($_POST['car_type'] ?? '');
        $moveDate = trim($_POST['move_date'] ?? '');
        $startArea = trim($_POST['start_area'] ?? '');
        $endArea = trim($_POST['end_area'] ?? '');
        $story = trim($_POST['story'] ?? '');
        $privacy = $_POST['privacy'] ?? '';

        // 유효성 검사
        if (mb_strlen($name, 'UTF-8') < 2) {
            $errorMessage = '성명(또는 업체명)을 2글자 이상 정확히 입력해 주세요.';
        } elseif (empty($tel) || !preg_match('/^[0-9\-\s]{8,20}$/', $tel)) {
            $errorMessage = '연락 가능한 전화번호를 올바르게 입력해 주세요.';
        } elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = '이메일 주소 형식이 올바르지 않습니다.';
        } elseif (empty($story)) {
            $errorMessage = '상담 및 화물 내용을 입력해 주세요.';
        } elseif ($privacy !== 'Y') {
            $errorMessage = '개인정보 수집 및 이용 안내에 동의해 주셔야 접수가 가능합니다.';
        } else {
            $consultData = [
                'name' => $name,
                'tel' => $tel,
                'email' => $email,
                'move_date' => $moveDate,
                'car_type' => $carType,
                'start_area' => $startArea,
                'end_area' => $endArea,
                'story' => $story,
                'client_ip' => $_SERVER['REMOTE_ADDR'] ?? ''
            ];

            // 1. DB 또는 Mock 데이터 저장
            require_once __DIR__ . '/../../admin/includes/db.php';
            insert_consult_item($consultData);

            // 2. 관리자 알림 이메일 발송 (main/formmail_01.php 연동)
            send_consult_mail($consultData);

            // 3. 완료 페이지 전달용 세션 데이터 생성
            $_SESSION['consult_success'] = $consultData;
            $_SESSION['consult_id'] = 'YDK-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid((string)mt_rand(), true)), 0, 4));
            $_SESSION['consult_time'] = date('Y년 m월 d일 H시 i분');

            // 새 CSRF 토큰 발급 (중복 전송 방지)
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

            // 4. 완료 페이지로 이동 (PRG 패턴: 새로고침 시 중복 제출 방지)
            header('Location: ' . url('contents/online/complete.php'));
            exit;
        }
    }
}

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">온라인 상담</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="edit outline icon"></i> 온라인 상담 및 견적 문의
    </h1>
    <p class="ydk-page-desc">
      화물 운송, 용달 이사 견적이 필요하신가요? 아래 내용을 남겨주시면 전담 상담원이 신속히 안내해 드립니다.
    </p>
  </header>

  <!-- 2. 빠른 전화 상담 안내 박스 (고대비 메시지) -->
  <section class="ui message ydk-notice-box" aria-label="빠른 전화 상담 안내">
    <div class="header">
      <i class="phone volume icon"></i> 빠른 상담과 당일 즉시 배차는 전화가 가장 빠릅니다!
    </div>
    <ul>
      <li>당일 급한 화물이나 빠른 운송료 확인을 원하시면 대표번호 <strong><a href="tel:<?= SITE_PHONE_TEL ?>"><?= SITE_PHONE ?></a></strong>으로 바로 전화 주세요.</li>
      <li>온라인 접수는 순차적으로 전문 상담원이 기재해 주신 연락처로 견적 금액과 배차 일정을 안내해 드립니다.</li>
    </ul>
  </section>

  <!-- 3. 온라인 상담 폼 영역 -->
  <section class="ydk-form-card" aria-label="온라인 견적 상담 신청 폼">

    <?php if ($isSubmitted && $isSuccess): ?>
      <!-- 접수 완료 메시지 -->
      <div class="ui positive message" style="padding: 28px 24px; border-radius: 8px;">
        <div class="header" style="font-size: 22px; margin-bottom: 10px; color: var(--ydk-primary-dark);">
          <i class="check circle icon"></i> 온라인 상담 신청이 정상적으로 접수되었습니다!
        </div>
        <p style="font-size: 17px; line-height: 1.7; color: var(--ydk-text);">
          고객님께서 남겨주신 운송 문의 내용을 확인한 후, 전담 상담원이 <strong><?= e($tel) ?></strong>번으로 신속하게 상세 견적과 배차 가능 일정을 안내해 드리겠습니다.<br>
          급하신 용무는 언제든 대표번호 <strong><?= SITE_PHONE ?></strong>으로 전화 주시기 바랍니다. 감사합니다.
        </p>
        <div style="margin-top: 20px;">
          <a href="<?= url() ?>" class="ui button ydk-btn-submit" style="margin-right: 10px;">
            <i class="home icon"></i> 메인으로 돌아가기
          </a>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui button ydk-btn-reset">
            <i class="edit icon"></i> 추가 문의 작성하기
          </a>
        </div>
      </div>
    <?php else: ?>

      <?php if (!empty($errorMessage)): ?>
        <!-- 오류 안내 메시지 -->
        <div class="ui negative message" style="margin-bottom: 24px;">
          <i class="exclamation triangle icon"></i>
          <strong>입력 확인:</strong> <?= e($errorMessage) ?>
        </div>
      <?php endif; ?>

      <form class="ui form ydk-form" method="post" action="<?= e($_SERVER['PHP_SELF']) ?>">
        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">

        <div class="two fields">
          <div class="required field">
            <label for="f_name">성명 / 상호명 <span class="ydk-required">*</span></label>
            <input type="text" id="f_name" name="name" required placeholder="예: 홍길동 또는 (주)용달상사" value="<?= e($_POST['name'] ?? '') ?>" maxlength="30">
          </div>
          <div class="required field">
            <label for="f_tel">연락처 (휴대전화) <span class="ydk-required">*</span></label>
            <input type="tel" id="f_tel" name="tel" required placeholder="예: 010-1234-5678" value="<?= e($_POST['tel'] ?? '') ?>" maxlength="20">
            <div class="ydk-field-hint">견적 안내 전화를 받으실 연락처를 정확히 입력해 주세요.</div>
          </div>
        </div>

        <div class="two fields">
          <div class="field">
            <label for="f_email">이메일 주소 (선택)</label>
            <input type="email" id="f_email" name="e_mail" placeholder="예: ydkorea@example.com" value="<?= e($_POST['e_mail'] ?? '') ?>" maxlength="50">
          </div>
          <div class="field">
            <label for="f_move_date">운송 희망 일자 (선택)</label>
            <input type="date" id="f_move_date" name="move_date" value="<?= e($_POST['move_date'] ?? date('Y-m-d')) ?>">
          </div>
        </div>

        <div class="field">
          <label for="f_car_type">희망 차량 종류 (선택)</label>
          <select id="f_car_type" name="car_type" class="ui dropdown">
            <option value="">차량 종류를 선택하세요 (잘 모르시면 상담 후 추천)</option>
            <option value="1t_cargo" <?= (($_POST['car_type'] ?? '') === '1t_cargo') ? 'selected' : '' ?>>1톤 일반 카고 (기본 용달)</option>
            <option value="1t_top" <?= (($_POST['car_type'] ?? '') === '1t_top') ? 'selected' : '' ?>>1톤 탑차 (눈·비 안심 방수 화물)</option>
            <option value="1t_lift" <?= (($_POST['car_type'] ?? '') === '1t_lift') ? 'selected' : '' ?>>1톤 리프트차 (오토바이, 중량 장비 전용)</option>
            <option value="1.4t_cargo" <?= (($_POST['car_type'] ?? '') === '1.4t_cargo') ? 'selected' : '' ?>>1.4톤 화물 트럭</option>
            <option value="2.5t_cargo" <?= (($_POST['car_type'] ?? '') === '2.5t_cargo') ? 'selected' : '' ?>>2.5톤 중형 화물</option>
            <option value="5t_cargo" <?= (($_POST['car_type'] ?? '') === '5t_cargo') ? 'selected' : '' ?>>5톤 대형 화물</option>
            <option value="room_move" <?= (($_POST['car_type'] ?? '') === 'room_move') ? 'selected' : '' ?>>원룸 / 소형 이사</option>
            <option value="office_move" <?= (($_POST['car_type'] ?? '') === 'office_move') ? 'selected' : '' ?>>사무실 / 기업 이전</option>
          </select>
        </div>

        <div class="two fields">
          <div class="field">
            <label for="f_start_area">출발지 (시/구/동)</label>
            <input type="text" id="f_start_area" name="start_area" placeholder="예: 서울 성동구 마장동" value="<?= e($_POST['start_area'] ?? '') ?>" maxlength="50">
          </div>
          <div class="field">
            <label for="f_end_area">도착지 (시/구/동)</label>
            <input type="text" id="f_end_area" name="end_area" placeholder="예: 부산 해운대구 우동" value="<?= e($_POST['end_area'] ?? '') ?>" maxlength="50">
          </div>
        </div>

        <div class="required field">
          <label for="f_story">상담 및 화물 내용 <span class="ydk-required">*</span></label>
          <textarea id="f_story" name="story" rows="6" required placeholder="상세한 상담 내용을 적어주시면 더욱 정확한 견적 산출이 가능합니다.&#10;예시)&#10;1. 화물 품목: 침대(퀸), 책상 1개, 옷 박스 5개&#10;2. 출발지/도착지 층수 및 엘리베이터 유무&#10;3. 상하차 작업 시 운송 기사님 도움 필요 여부"><?= e($_POST['story'] ?? '') ?></textarea>
          <div class="ydk-field-hint">운송 물동량, 작업 조건(엘리베이터 유무, 사다리차 필요 여부 등)을 알려주시면 친절히 안내해 드립니다.</div>
        </div>

        <!-- 개인정보 수집 및 이용 동의 -->
        <div class="ydk-privacy-wrap">
          <div class="ydk-privacy-title"><i class="shield check icon"></i> 개인정보 수집 및 이용 동의</div>
          <div class="ydk-privacy-content">
            1. 수집 항목: 성명, 연락처, 이메일, 출발지·도착지 주소<br>
            2. 수집 목적: 용달·화물 운송 및 이사 견적 상담, 배차 안내<br>
            3. 보유 기간: 상담 및 계약 완료 후 법정 보존 기한 준수 (목적 달성 후 즉시 파기)<br>
            ※ 고객님은 동의를 거부하실 권리가 있으나, 미동의 시 온라인 상담 신청이 제한될 수 있습니다.
          </div>
          <label class="ydk-privacy-check">
            <input type="checkbox" name="privacy" value="Y" required <?= (($_POST['privacy'] ?? '') === 'Y') ? 'checked' : '' ?>>
            개인정보 수집 및 이용 안내에 동의합니다. (필수)
          </label>
        </div>

        <!-- 전송 버튼 -->
        <div class="ydk-form-actions">
          <button type="submit" class="ui button ydk-btn-submit">
            <i class="paper plane outline icon"></i> 온라인 상담 신청 전송하기
          </button>
          <button type="reset" class="ui button ydk-btn-reset">
            <i class="undo icon"></i> 다시 작성
          </button>
        </div>

      </form>
    <?php endif; ?>

  </section>

  <!-- 4. 즉시 전화 상담 배너 -->
  <aside class="ydk-sub-cta" aria-label="전화 상담 안내">
    <div class="ydk-sub-cta-text">
      <h3><i class="phone volume icon"></i> 실시간 전화 상담이 필요하신가요?</h3>
      <p>대표번호 <strong><?= SITE_PHONE ?></strong>으로 전화 주시면 친절하게 견적을 안내해 드립니다.</p>
    </div>
    <div class="ydk-sub-cta-actions">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge button ydk-btn-call">
        <i class="phone icon"></i> 전화 상담 (<?= SITE_PHONE ?>)
      </a>
      <a href="<?= url('contents/info/company.php') ?>" class="ui huge inverted button">
        <i class="building outline icon"></i> 회사 소개 보기
      </a>
    </div>
  </aside>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
?>
