<?php
/**
 * 용달코리아 v2-1 묻고답하기(Q&A) 질문 작성 페이지
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반, 반응형 웹
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../admin/includes/db.php';

$pageTitle = '질문 작성하기 | 묻고답하기 | ' . SITE_NAME;
$metaDescription = '용달 화물, 원룸이사, 용달차 대여 및 운송 비용에 대해 무엇이든 질문해 주세요.';

// CSRF 토큰 발급
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$errorMessage = '';
$isSuccess = false;
$newId = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfToken = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        $errorMessage = '비정상적인 요청이 감지되었습니다. 페이지를 새로고침 후 다시 시도해 주세요.';
    } else {
        $title    = trim($_POST['title'] ?? '');
        $writer   = trim($_POST['writer'] ?? '');
        $phone    = trim($_POST['phone'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $isSecret = !empty($_POST['is_secret']) ? 1 : 0;
        $password = trim($_POST['password'] ?? '');
        $question = trim($_POST['question'] ?? '');
        $privacy  = $_POST['privacy'] ?? '';

        if (mb_strlen($title, 'UTF-8') < 2) {
            $errorMessage = '제목을 2글자 이상 입력해 주세요.';
        } elseif (mb_strlen($writer, 'UTF-8') < 2) {
            $errorMessage = '작성자 성명을 바르게 입력해 주세요.';
        } elseif (empty($phone) || !preg_match('/^[0-9\-\s]{8,20}$/', $phone)) {
            $errorMessage = '연락 가능한 전화번호를 올바르게 입력해 주세요.';
        } elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = '이메일 주소 형식이 올바르지 않습니다.';
        } elseif ($isSecret && mb_strlen($password, 'UTF-8') < 4) {
            $errorMessage = '비밀글로 설정하실 경우 4자리 이상의 비밀번호를 입력해 주세요.';
        } elseif (empty($question)) {
            $errorMessage = '질문 및 문의 내용을 입력해 주세요.';
        } elseif ($privacy !== 'Y') {
            $errorMessage = '개인정보 수집 및 이용 동의에 체크해 주세요.';
        } else {
            $newId = insert_qa_item([
                'title'     => $title,
                'writer'    => $writer,
                'phone'     => $phone,
                'email'     => $email,
                'password'  => $password,
                'is_secret' => $isSecret,
                'question'  => $question,
            ]);

            if ($newId > 0) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                // 본인이 방금 등록한 글은 즉시 열람할 수 있도록 세션 저장
                $_SESSION['qa_unlocked_' . $newId] = true;
                echo "<script>alert('문의글이 성공적으로 접수되었습니다.\\n담당자가 확인 후 신속히 답변 드리겠습니다.'); location.href='" . url('contents/qa/qa_view.php?id=' . $newId) . "';</script>";
                exit;
            } else {
                $errorMessage = '질문 등록 중 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.';
            }
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
      <a href="<?= url('contents/qa/qa.php') ?>">묻고답하기</a>
      <span class="divider">/</span>
      <span class="active">질문 작성</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="pencil alternate icon"></i> 질문 및 문의 작성
    </h1>
    <p class="ydk-page-desc">
      화물 운송, 차량 선택, 요금 및 일정 등 궁금하신 사항을 남겨주시면 친절히 안내해 드립니다.
    </p>
  </header>

  <?php if (!empty($errorMessage)): ?>
    <div class="ui negative message" style="margin-bottom: 24px;">
      <i class="exclamation triangle icon"></i> <?= e($errorMessage) ?>
    </div>
  <?php endif; ?>

  <!-- 2. 작성 폼 카드 -->
  <div class="ui segment" style="background: #FFF; border: 1px solid #E2E8F0; border-radius: 12px; padding: 28px 32px; box-shadow: 0 2px 4px rgba(0,0,0,0.03); margin-bottom: 40px;">
    
    <form method="post" action="<?= url('contents/qa/qa_write.php') ?>" class="ui form">
      <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">

      <!-- 제목 -->
      <div class="required field">
        <label style="font-weight: 700; color: #1E293B;">질문 제목</label>
        <input type="text" name="title" placeholder="예: 1톤 용달 분당-강남 운송 견적 및 일정 문의" value="<?= e($_POST['title'] ?? '') ?>" required maxlength="100">
      </div>

      <!-- 작성자 정보 그리드 -->
      <div class="two fields">
        <div class="required field">
          <label style="font-weight: 700; color: #1E293B;">작성자 성명 (또는 상호)</label>
          <input type="text" name="writer" placeholder="홍길동" value="<?= e($_POST['writer'] ?? '') ?>" required maxlength="30">
          <small style="color: var(--ydk-muted); font-size: 12px;">* 목록에는 개인정보 보호를 위해 홍*동 형태로 안전하게 표시됩니다.</small>
        </div>
        <div class="required field">
          <label style="font-weight: 700; color: #1E293B;">연락처 (휴대폰)</label>
          <input type="tel" name="phone" placeholder="010-1234-5678" value="<?= e($_POST['phone'] ?? '') ?>" required maxlength="20">
          <small style="color: var(--ydk-muted); font-size: 12px;">* 답변 완료 시 알림 및 상담 확인용으로만 활용되며 외부에 공개되지 않습니다.</small>
        </div>
      </div>

      <!-- 이메일 및 비밀번호 -->
      <div class="two fields">
        <div class="field">
          <label style="font-weight: 700; color: #1E293B;">이메일 (선택)</label>
          <input type="email" name="email" placeholder="example@email.com" value="<?= e($_POST['email'] ?? '') ?>" maxlength="60">
        </div>
        <div class="field">
          <label style="font-weight: 700; color: #1E293B;">비밀번호 (비밀글 설정 또는 수정용)</label>
          <input type="password" name="password" placeholder="4자리 이상 입력" maxlength="20">
        </div>
      </div>

      <!-- 비밀글 여부 체크 -->
      <div class="field" style="margin: 12px 0 20px 0;">
        <div class="ui checkbox">
          <input type="checkbox" name="is_secret" value="1" id="is_secret_chk" <?= (!empty($_POST['is_secret'])) ? 'checked' : '' ?>>
          <label for="is_secret_chk" style="font-weight: 600; color: #334155; cursor: pointer;">
            <i class="lock icon" style="color: #64748B;"></i> 비밀글로 등록 (작성자와 관리자만 열람 가능)
          </label>
        </div>
      </div>

      <!-- 문의 내용 -->
      <div class="required field">
        <label style="font-weight: 700; color: #1E293B;">질문 및 문의 내용</label>
        <textarea name="question" rows="8" placeholder="출발지 및 도착지 주소, 화물 종류, 엘리베이터 유무, 희망 일정 등을 자세히 적어주시면 더욱 정확하고 빠른 답변이 가능합니다." required style="font-size: 15px; line-height: 1.6;"><?= e($_POST['question'] ?? '') ?></textarea>
      </div>

      <!-- 개인정보 수집 및 이용 동의 -->
      <div class="field" style="margin-top: 24px; padding: 16px; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px;">
        <div style="font-size: 13px; color: #475569; line-height: 1.6; margin-bottom: 10px;">
          <strong>[개인정보 수집 및 이용 안내]</strong><br>
          1. 수집 항목: 성명, 연락처, 이메일, 상담 내용<br>
          2. 수집 목적: 질문에 대한 답변 제공 및 배차 견적 상담<br>
          3. 보유 기간: 전자상거래법 등 관계 법령에 따른 보존 기간 경과 후 파기
        </div>
        <div class="ui checkbox">
          <input type="checkbox" name="privacy" value="Y" id="privacy_agree" required <?= (($_POST['privacy'] ?? '') === 'Y') ? 'checked' : '' ?>>
          <label for="privacy_agree" style="font-weight: 700; color: #1E293B; cursor: pointer;">
            개인정보 수집 및 이용에 동의합니다. (필수)
          </label>
        </div>
      </div>

      <!-- 제출 버튼 -->
      <div style="display: flex; gap: 12px; justify-content: center; margin-top: 30px;">
        <a href="<?= url('contents/qa/qa.php') ?>" class="ui basic button" style="padding: 13px 28px; font-weight: 700;">
          취소
        </a>
        <button type="submit" class="ui primary button" style="padding: 13px 36px; font-weight: 800; font-size: 15px;">
          <i class="check icon"></i> 질문 등록하기
        </button>
      </div>

    </form>

  </div>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
?>
