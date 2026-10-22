<?php
/**
 * 용달코리아 v2-1 차주회원 가입 신청
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반
 * 원본: main/club.html
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../admin/includes/db.php';

$pageTitle = '차주회원 가입 신청 | ' . SITE_NAME;
$metaDescription = '용달코리아 차주회원 및 업체회원 온라인 가입 신청. 유료회원 등록을 통해 전국 화물 네트워크의 일원이 되어보세요.';

// CSRF 토큰 생성
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$isSubmitted = false;
$isSuccess = false;
$errorMessage = '';

// POST 처리: 차주 회원가입 신청
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isSubmitted = true;
    $csrfToken = $_POST['csrf_token'] ?? '';

    if (!hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        $errorMessage = '비정상적인 요청이 감지되었습니다. 새로고침 후 다시 시도해 주세요.';
    } else {
        $name    = trim($_POST['name'] ?? '');
        $c_name  = trim($_POST['c_name'] ?? '');
        $e_mail  = trim($_POST['e_mail'] ?? '');
        $tel     = trim($_POST['tel'] ?? '');
        $hp      = trim($_POST['hp'] ?? '');
        $car     = trim($_POST['car'] ?? '');
        $car_no  = trim($_POST['car_no'] ?? '');
        $ad      = trim($_POST['ad'] ?? '');
        $fro     = trim($_POST['fro'] ?? '');
        $agree   = isset($_POST['agree']) && $_POST['agree'] === 'Y';

        // 필수 항목 유효성 검사 (main/club.html의 검증 로직 준수)
        if (mb_strlen($name, 'UTF-8') < 2) {
            $errorMessage = '성명을 2자 이상 바르게 입력해 주십시오.';
        } elseif (empty($c_name)) {
            $errorMessage = '회사명(상호)을 바르게 입력해 주십시오. (예: 개인용달, 개별화물 등)';
        } elseif (!empty($e_mail) && !filter_var($e_mail, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = '이메일 주소를 바르게 입력해 주십시오.';
        } elseif (empty($hp)) {
            $errorMessage = '휴대폰 번호를 바르게 입력해 주십시오.';
        } elseif (empty($car)) {
            $errorMessage = '보유차량을 바르게 입력해 주십시오.';
        } elseif (empty($car_no)) {
            $errorMessage = '차량번호를 바르게 입력해 주십시오. (예: 서울 80 자 1234)';
        } elseif (empty($ad)) {
            $errorMessage = '현주소 및 활동지역을 바르게 입력해 주십시오.';
        } elseif (empty($fro)) {
            $errorMessage = '영업용 차량 경력을 포함한 간단한 자기소개를 입력해 주십시오.';
        } elseif (!$agree) {
            $errorMessage = '회원가입 약관에 동의하셔야 가입 신청이 완료됩니다.';
        } else {
            // DB 또는 Mock 등록 처리
            $saveData = [
                'name'      => $name,
                'c_name'    => $c_name,
                'e_mail'    => $e_mail,
                'tel'       => $tel,
                'hp'        => $hp,
                'car'       => $car,
                'car_no'    => $car_no,
                'ad'        => $ad,
                'fro'       => $fro,
                'client_ip' => $_SERVER['REMOTE_ADDR'] ?? '',
            ];

            $res = insert_club_item($saveData);
            if ($res) {
                // 관리자 알림 이메일 발송 (main/formmail_1.php 연동)
                send_club_mail($saveData);

                $isSuccess = true;
                // 새 CSRF 토큰 발급
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            } else {
                $errorMessage = '신청 처리 중 일시적인 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.';
            }
        }
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <a href="<?= url('contents/club/car_club.php') ?>">차주회원모집</a>
      <span class="divider">/</span>
      <span class="active">회원가입 신청</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="id card outline icon"></i> 차주회원 가입하기
    </h1>
    <p class="ydk-page-desc" style="color: #DC2626; font-weight: 600;">
      ※ 유료회원 안내 : 한 지역당 월 / 3만원, 6만원, 5만원 (1톤 기준) 이니 필요한 차주분만 가입하세요.
    </p>

    <!-- 탭 네비게이션 (모집안내 / 회원가입) -->
    <div class="ui pointing secondary menu" style="margin-top: 20px; border-bottom: 2px solid var(--ydk-border-subtle);">
      <a class="item" href="<?= url('contents/club/car_club.php') ?>" style="font-size: 16px; font-weight: 600; color: var(--ydk-text-muted);">
        <i class="info circle icon"></i> 회원 모집 및 혜택 안내
      </a>
      <a class="active item" href="<?= url('contents/club/club.php') ?>" style="font-size: 16px; font-weight: 700; color: var(--ydk-primary);">
        <i class="edit outline icon"></i> 온라인 회원가입 신청
      </a>
    </div>
  </header>

  <!-- 2. 가입 비용 및 입금 계좌 요약 안내 바 -->
  <section class="ui message" style="background: #F8FAFC; border: 1px solid #CBD5E1; border-left: 6px solid var(--ydk-primary); border-radius: 8px; padding: 18px 22px; margin-bottom: 28px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
      <div>
        <div style="font-size: 16px; font-weight: 800; color: #1E293B; margin-bottom: 6px;">
          <i class="tags icon" style="color: var(--ydk-primary);"></i> 정회원 등록비용 (1톤 기준)
        </div>
        <div style="font-size: 14px; color: #475569; line-height: 1.6;">
          • 서울시 1개 구 가입 시 : <strong>월 30,000원</strong> &nbsp;|&nbsp;
          • 수도권 2개 지역 가입 시 : <strong>월 60,000원</strong> &nbsp;|&nbsp;
          • 광역시/거점 : <strong>월 60,000원</strong>
        </div>
        <div style="font-size: 14px; color: #1E293B; margin-top: 4px;">
          • <strong>은행 계좌 :</strong> 기업은행 <strong>010-8833-1412</strong> (예금주 : 민경철)
        </div>
      </div>
      <div style="text-align: right;">
        <div style="font-size: 13px; color: #64748B;">가입 상세 상담 문의</div>
        <div style="font-size: 20px; font-weight: 900; color: #DC2626;">1688-2407</div>
        <div style="font-size: 14px; font-weight: 700; color: #1E293B;">010-8833-1412</div>
      </div>
    </div>
  </section>

  <!-- 3. 회원가입 신청 폼 카드 -->
  <section class="ydk-form-card" style="background: #FFFFFF; border: 1px solid var(--ydk-border-light); border-radius: 12px; padding: 32px 36px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); margin-bottom: 36px;">

    <?php if ($isSubmitted && $isSuccess): ?>
      <!-- 신청 완료 안내 -->
      <div class="ui positive message" style="padding: 32px 24px; border-radius: 8px; text-align: center;">
        <i class="check circle icon massive" style="color: #059669; margin-bottom: 16px;"></i>
        <h2 style="font-size: 24px; font-weight: 800; color: #065F46; margin-top: 0; margin-bottom: 12px;">
          차주회원 가입 신청이 정상적으로 완료되었습니다!
        </h2>
        <p style="font-size: 16px; line-height: 1.8; color: #1F2937; max-width: 680px; margin: 0 auto 24px auto;">
          <strong><?= e($name) ?></strong> 차주님의 가입 신청 정보가 안전하게 접수되었습니다.<br>
          등록비 입금 확인 및 관할 지역 배차 설정을 위해 담당자가 빠른 시일 내에 <strong><?= e($hp) ?></strong> 번으로 연락드리겠습니다.
        </p>
        <div>
          <a href="<?= url() ?>" class="ui button" style="background: var(--ydk-primary); color: #FFF; font-weight: 700; padding: 12px 24px;">
            <i class="home icon"></i> 메인으로 이동
          </a>
          <a href="<?= url('contents/club/car_club.php') ?>" class="ui basic button" style="padding: 12px 24px; font-weight: 700;">
            <i class="info circle icon"></i> 회원 모집 안내 보기
          </a>
        </div>
      </div>
    <?php else: ?>

      <?php if (!empty($errorMessage)): ?>
        <!-- 오류 안내 메시지 -->
        <div class="ui negative message" style="margin-bottom: 24px; border-radius: 8px;">
          <i class="exclamation triangle icon"></i>
          <strong>입력 확인 필요 :</strong> <?= e($errorMessage) ?>
        </div>
      <?php endif; ?>

      <form class="ui form" method="post" action="<?= e($_SERVER['PHP_SELF']) ?>" onsubmit="return frm1_check(this);">
        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">

        <div style="border-bottom: 2px solid var(--ydk-primary); padding-bottom: 12px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-end;">
          <h2 style="font-size: 20px; font-weight: 800; color: var(--ydk-primary); margin: 0;">
            ▶ 회원 기본 정보
          </h2>
          <span style="font-size: 13px; color: #DC2626; font-weight: 600;">* 표시는 필수 입력 항목입니다.</span>
        </div>

        <!-- 1행: 성명 / 회사명 -->
        <div class="two fields">
          <div class="required field">
            <label for="f_name" style="font-weight: 700; font-size: 15px;">≫ 성&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;명</label>
            <input type="text" id="f_name" name="name" required placeholder="예) 홍길동" value="<?= e($_POST['name'] ?? '') ?>" maxlength="10">
          </div>
          <div class="required field">
            <label for="f_c_name" style="font-weight: 700; font-size: 15px;">≫ 회 사 명</label>
            <input type="text" id="f_c_name" name="c_name" required placeholder="예) 개인용달, 개별화물, 가나다화물 등" value="<?= e($_POST['c_name'] ?? '') ?>" maxlength="30">
          </div>
        </div>

        <!-- 2행: 이메일 / 전화번호 -->
        <div class="two fields">
          <div class="field">
            <label for="f_email" style="font-weight: 700; font-size: 15px;">≫ 이 메 일 (선택)</label>
            <input type="email" id="f_email" name="e_mail" placeholder="예) kch1414@ydkorea.co.kr" value="<?= e($_POST['e_mail'] ?? '') ?>" maxlength="50">
          </div>
          <div class="field">
            <label for="f_tel" style="font-weight: 700; font-size: 15px;">≫ 일반전화 (선택)</label>
            <input type="tel" id="f_tel" name="tel" placeholder="예) 02-123-4567" value="<?= e($_POST['tel'] ?? '') ?>" maxlength="20">
          </div>
        </div>

        <!-- 3행: 휴대폰 / 차량번호 -->
        <div class="two fields">
          <div class="required field">
            <label for="f_hp" style="font-weight: 700; font-size: 15px;">≫ 휴 대 폰</label>
            <input type="tel" id="f_hp" name="hp" required placeholder="예) 010-1234-5678" value="<?= e($_POST['hp'] ?? '') ?>" maxlength="20">
            <div style="font-size: 12px; color: var(--ydk-muted); margin-top: 4px;">배차 및 안내 전화를 받으실 휴대전화 번호를 정확히 적어주세요.</div>
          </div>
          <div class="required field">
            <label for="f_car_no" style="font-weight: 700; font-size: 15px;">≫ 차량번호</label>
            <input type="text" id="f_car_no" name="car_no" required placeholder="예) 서울 80 자 1234" value="<?= e($_POST['car_no'] ?? '') ?>" maxlength="20">
          </div>
        </div>

        <!-- 4행: 보유차량 -->
        <div class="required field">
          <label for="f_car" style="font-weight: 700; font-size: 15px;">≫ 보유차량</label>
          <div class="fields" style="margin-bottom: 0;">
            <div class="eight wide field">
              <input type="text" id="f_car" name="car" required placeholder="예) 1t, 1.4t, 2.5t, 5t, 사다리차, 1t 탑차, 리프트 등" value="<?= e($_POST['car'] ?? '') ?>" maxlength="30">
            </div>
            <div class="eight wide field">
              <select class="ui dropdown" onchange="if(this.value){document.getElementById('f_car').value=this.value;}">
                <option value="">자주 쓰는 차종 선택</option>
                <option value="1톤 카고">1톤 카고 (오픈형)</option>
                <option value="1톤 호루">1톤 호루 (자바라/천막)</option>
                <option value="1톤 탑차">1톤 내장탑차</option>
                <option value="1톤 윙탑">1톤 윙탑</option>
                <option value="1톤 리프트">1톤 리프트차</option>
                <option value="1.4톤 카고/탑">1.4톤 카고/탑차</option>
                <option value="2.5톤 카고/윙탑">2.5톤 카고/윙탑</option>
                <option value="5톤 윙탑/축차">5톤 윙탑/축차</option>
                <option value="사다리차">사다리차</option>
              </select>
            </div>
          </div>
        </div>

        <!-- 5행: 주소 -->
        <div class="required field">
          <label for="f_ad" style="font-weight: 700; font-size: 15px;">≫ 주&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;소 (현주소 및 활동 희망 지역)</label>
          <input type="text" id="f_ad" name="ad" required placeholder="현주소 및 배차를 희망하시는 주요 활동 지역을 상세히 적어주세요" value="<?= e($_POST['ad'] ?? '') ?>" maxlength="150">
        </div>

        <!-- 6행: 자기소개 -->
        <div class="required field">
          <label for="f_fro" style="font-weight: 700; font-size: 15px;">≫ 자기소개</label>
          <textarea id="f_fro" name="fro" rows="5" required placeholder="영업용 차량 운송 경력을 포함한 간단한 자기소개를 작성해 주세요. (예: 개인용달 10년 무사고 경력, 원룸이사 및 리프트 중량물 운반 전문 등)"><?= e($_POST['fro'] ?? '') ?></textarea>
          <div style="font-size: 13px; color: var(--ydk-muted); margin-top: 4px;">
            ↑ 영업용 차량 운송 경력을 포함한 간단한 자기소개를 하세요.
          </div>
        </div>

        <!-- 회원가입 약관 동의 체크박스 -->
        <div class="field" style="margin-top: 24px; padding: 18px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px;">
          <div style="font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 10px;">
            <strong>회원가입 약관 확인 안내 :</strong> 등록 신청 전 공정거래위원회 표준약관 및 이용 규정을 확인하셨습니까?
            <a href="<?= url('contents/club/car_club.php') ?>" target="_blank" style="color: #2563EB; font-weight: 700; text-decoration: underline; margin-left: 6px;">
              [약관 전문 보기]
            </a>
          </div>
          <div class="ui checkbox">
            <input type="checkbox" id="agree" name="agree" value="Y" required>
            <label for="agree" style="font-weight: 700; color: #1E293B; cursor: pointer;">
              본인은 회원가입 약관 및 개인정보 수집·이용에 동의하며 차주회원 가입을 신청합니다. <span style="color: #DC2626;">(필수)</span>
            </label>
          </div>
        </div>

        <!-- 제출 버튼 -->
        <div style="display: flex; justify-content: center; gap: 16px; margin-top: 32px; padding-top: 24px; border-top: 1px solid var(--ydk-border-light);">
          <button type="submit" class="ui primary large button" style="min-width: 180px; height: 50px; font-size: 17px; font-weight: 800; border-radius: 8px;">
            <i class="check icon"></i> 신청하기
          </button>
          <button type="reset" class="ui basic large button" style="min-width: 140px; height: 50px; font-size: 17px; font-weight: 700; border-radius: 8px;">
            <i class="redo icon"></i> 다시쓰기
          </button>
        </div>

      </form>
    <?php endif; ?>

  </section>

</main>

<script>
// main/club.html 검증 함수와 100% 동일한 로직 적용
function frm1_check(f) {
  if (f.name.value.trim().length < 2) {
    alert("이름을 바르게 입력해 주십시오.");
    f.name.focus();
    return false;
  }
  if (f.c_name.value.trim().length < 1) {
    alert("회사명을 바르게 입력해 주십시오.");
    f.c_name.focus();
    return false;
  }
  if (f.e_mail.value.trim() !== '' && f.e_mail.value.search(/(\S+)@(\S+)\.(\S+)/) === -1) {
    alert("E-Mail을 바르게 입력해 주십시오.");
    f.e_mail.focus();
    return false;
  }
  if (f.hp.value.trim().length < 1) {
    alert("휴대폰번호를 바르게 입력해 주십시오.");
    f.hp.focus();
    return false;
  }
  if (f.car.value.trim().length < 1) {
    alert("보유차량을 바르게 입력해 주십시오.");
    f.car.focus();
    return false;
  }
  if (f.car_no.value.trim().length < 1) {
    alert("차량번호를 바르게 입력해 주십시오.");
    f.car_no.focus();
    return false;
  }
  if (f.ad.value.trim().length < 1) {
    alert("주소를 바르게 입력해 주십시오.");
    f.ad.focus();
    return false;
  }
  if (f.fro.value.trim().length < 1) {
    alert("자기소개를 바르게 입력해 주십시오.");
    f.fro.focus();
    return false;
  }
  if (!f.agree.checked) {
    alert("회원가입 약관에 동의해 주십시오.");
    f.agree.focus();
    return false;
  }
  return true;
}
</script>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>
