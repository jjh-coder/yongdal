<?php
/**
 * 용달코리아 v2-1 묻고답하기(Q&A) 상세 보기 페이지
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반, 반응형 웹
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../admin/includes/db.php';

$id = max(0, (int)($_GET['id'] ?? 0));
$qa = get_qa_item($id, true);

if (!$qa) {
    echo "<script>alert('존재하지 않거나 삭제된 게시물입니다.'); location.href='" . url('contents/qa/qa.php') . "';</script>";
    exit;
}

$pageTitle = e($qa['title']) . ' | 묻고답하기 | ' . SITE_NAME;
$metaDescription = mb_substr(strip_tags($qa['question']), 0, 120, 'UTF-8');

// 비밀글 접근 제어
$isSecret = !empty($qa['is_secret']);
$isUnlocked = false;
$passError = '';

// 관리자 세션 체크
$isAdmin = !empty($_SESSION['ydk_admin_logged_in']);
if ($isAdmin) {
    $isUnlocked = true;
}

// 세션 비밀번호 해제 여부
$sessionKey = 'qa_unlocked_' . $id;
if (!empty($_SESSION[$sessionKey])) {
    $isUnlocked = true;
}

// 비밀번호 검증 처리 (POST)
if ($isSecret && !$isUnlocked && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputPw = trim($_POST['password'] ?? '');
    $storedPw = $qa['password'] ?? '';

    if (!empty($storedPw) && (password_verify($inputPw, $storedPw) || $inputPw === $storedPw)) {
        $_SESSION[$sessionKey] = true;
        $isUnlocked = true;
    } else {
        $passError = '비밀번호가 올바르지 않습니다. 다시 확인해 주세요.';
    }
}

// 이전글 / 다음글 조회
$allQas = get_qa_list();
$prevQa = null;
$nextQa = null;
$count = count($allQas);
for ($i = 0; $i < $count; $i++) {
    if ((int)$allQas[$i]['id'] === $id) {
        if ($i > 0) {
            $prevQa = $allQas[$i - 1];
        }
        if ($i < $count - 1) {
            $nextQa = $allQas[$i + 1];
        }
        break;
    }
}

// 마스킹 처리된 작성자명
$rawWriter = $qa['writer'] ?? '고객';
$wLen = mb_strlen($rawWriter, 'UTF-8');
if ($wLen > 2) {
    $maskedWriter = mb_substr($rawWriter, 0, 1, 'UTF-8') . str_repeat('*', $wLen - 2) . mb_substr($rawWriter, -1, 1, 'UTF-8');
} elseif ($wLen === 2) {
    $maskedWriter = mb_substr($rawWriter, 0, 1, 'UTF-8') . '*';
} else {
    $maskedWriter = $rawWriter;
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
      <span class="active">질문 및 답변</span>
    </nav>
  </header>

  <?php if ($isSecret && !$isUnlocked): ?>
    <!-- 비밀글 잠금 화면 -->
    <div class="ui segment" style="background: #FFF; border: 1px solid #E2E8F0; border-radius: 12px; padding: 40px 24px; text-align: center; max-width: 520px; margin: 30px auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
      <div style="font-size: 48px; color: #64748B; margin-bottom: 16px;">
        <i class="lock icon"></i>
      </div>
      <h2 style="font-size: 20px; font-weight: 800; color: #1E293B; margin-bottom: 8px;">
        비밀글로 보호된 게시물입니다
      </h2>
      <p style="font-size: 14px; color: #64748B; margin-bottom: 24px;">
        작성자 본인 또는 관리자만 열람하실 수 있습니다.<br>글 작성 시 입력하신 비밀번호를 입력해 주세요.
      </p>

      <?php if (!empty($passError)): ?>
        <div class="ui negative message" style="text-align: left; margin-bottom: 18px; font-size: 13px;">
          <i class="exclamation triangle icon"></i> <?= e($passError) ?>
        </div>
      <?php endif; ?>

      <form method="post" action="<?= url('contents/qa/qa_view.php?id=' . $id) ?>" class="ui form">
        <div class="field">
          <input type="password" name="password" placeholder="비밀번호 입력" required autofocus style="text-align: center; font-size: 16px; padding: 12px;">
        </div>
        <div style="display: flex; gap: 8px; justify-content: center; margin-top: 18px;">
          <a href="<?= url('contents/qa/qa.php') ?>" class="ui basic button" style="padding: 11px 20px;">
            목록으로
          </a>
          <button type="submit" class="ui primary button" style="padding: 11px 24px; font-weight: 700;">
            확인하기
          </button>
        </div>
      </form>
    </div>

  <?php else: ?>

    <!-- 2. 질문 본문 카드 -->
    <article class="ui segment" style="background: #FFF; border: 1px solid #E2E8F0; border-radius: 12px; padding: 28px 32px; box-shadow: 0 2px 4px rgba(0,0,0,0.03); margin-bottom: 24px;">
      
      <!-- 질문 제목 헤더 -->
      <div style="border-bottom: 2px solid #F1F5F9; padding-bottom: 18px; margin-bottom: 24px;">
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 10px;">
          <?php if (($qa['status'] ?? '') === '답변완료'): ?>
            <span class="ui green mini label" style="font-weight: 700;">답변완료</span>
          <?php else: ?>
            <span class="ui orange mini label" style="font-weight: 700;">답변대기</span>
          <?php endif; ?>

          <?php if ($isSecret): ?>
            <span class="ui basic mini label"><i class="lock icon"></i> 비밀글</span>
          <?php endif; ?>

          <span style="font-size: 13px; color: var(--ydk-muted);">No. <?= (int)$qa['id'] ?></span>
        </div>
        
        <h1 style="font-size: 22px; font-weight: 800; color: #1E293B; line-height: 1.4; margin: 0 0 14px 0;">
          <span style="color: #2563EB; margin-right: 6px;">Q.</span> <?= e($qa['title']) ?>
        </h1>

        <div style="display: flex; gap: 16px; font-size: 13px; color: #64748B; flex-wrap: wrap;">
          <div><i class="user outline icon"></i> <strong>작성자:</strong> <?= e($maskedWriter) ?></div>
          <div><i class="clock outline icon"></i> <strong>등록일:</strong> <?= e(date('Y년 m월 d일 H:i', strtotime($qa['created_at']))) ?></div>
          <div><i class="eye icon"></i> <strong>조회수:</strong> <?= number_format((int)($qa['hit'] ?? 0)) ?></div>
        </div>
      </div>

      <!-- 질문 본문 -->
      <div style="font-size: 15px; line-height: 1.8; color: #334155; min-height: 100px; word-break: break-all; padding: 10px 0;">
        <?= nl2br(e($qa['question'])) ?>
      </div>

    </article>

    <!-- 3. 관리자 답변 블록 -->
    <?php if (!empty($qa['answer'])): ?>
      <section class="ui segment" style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 12px; padding: 24px 28px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); margin-bottom: 24px;">
        <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #DCFCE7; padding-bottom: 12px; margin-bottom: 16px; flex-wrap: wrap; gap: 8px;">
          <div style="display: flex; align-items: center; gap: 8px;">
            <span style="background: #16A34A; color: #FFF; font-weight: 800; font-size: 13px; padding: 4px 10px; border-radius: 6px;">
              A. 답변
            </span>
            <strong style="color: #14532D; font-size: 16px;">용달코리아 고객상담팀</strong>
          </div>
          <?php if (!empty($qa['answered_at'])): ?>
            <div style="font-size: 13px; color: #15803D;">
              <i class="check circle icon"></i> 답변일시: <?= e(date('Y년 m월 d일 H:i', strtotime($qa['answered_at']))) ?>
            </div>
          <?php endif; ?>
        </div>

        <div style="font-size: 15px; line-height: 1.8; color: #166534; word-break: break-all;">
          <?= nl2br(e($qa['answer'])) ?>
        </div>
      </section>
    <?php else: ?>
      <div class="ui message" style="background: #FFFBEB; border: 1px solid #FDE68A; border-radius: 10px; padding: 18px 24px; color: #92400E; margin-bottom: 24px;">
        <i class="hourglass half icon" style="color: #D97706;"></i>
        <strong>담당자가 질문을 확인하고 있습니다.</strong> 평일 기준 1~2시간 이내에 친절히 답변을 등록해 드리겠습니다.
        급하신 경우 대표 콜센터 <strong><a href="tel:<?= SITE_PHONE_TEL ?>" style="color: #B45309; text-decoration: underline;"><?= SITE_PHONE ?></a></strong>으로 문의해 주세요.
      </div>
    <?php endif; ?>

    <!-- 4. 이전글 / 다음글 이동 네비게이션 -->
    <div class="ui segment" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 0; margin-bottom: 28px; overflow: hidden;">
      <div style="display: flex; flex-direction: column;">
        
        <!-- 다음글 -->
        <div style="display: flex; padding: 12px 18px; border-bottom: 1px solid #E2E8F0; align-items: center; gap: 12px;">
          <span style="width: 70px; font-weight: 700; font-size: 13px; color: #64748B;">
            <i class="angle up icon"></i> 다음글
          </span>
          <?php if ($prevQa): ?>
            <a href="<?= url('contents/qa/qa_view.php?id=' . (int)$prevQa['id']) ?>" style="color: #334155; flex: 1; text-decoration: none;">
              <?php if (!empty($prevQa['is_secret'])): ?><i class="lock icon" style="font-size: 12px; color: #64748B;"></i><?php endif; ?>
              <?= e($prevQa['title']) ?>
            </a>
            <span style="font-size: 12px; color: var(--ydk-muted);"><?= date('Y.m.d', strtotime($prevQa['created_at'])) ?></span>
          <?php else: ?>
            <span style="color: var(--ydk-muted); font-size: 13px;">다음 게시물이 없습니다.</span>
          <?php endif; ?>
        </div>

        <!-- 이전글 -->
        <div style="display: flex; padding: 12px 18px; align-items: center; gap: 12px;">
          <span style="width: 70px; font-weight: 700; font-size: 13px; color: #64748B;">
            <i class="angle down icon"></i> 이전글
          </span>
          <?php if ($nextQa): ?>
            <a href="<?= url('contents/qa/qa_view.php?id=' . (int)$nextQa['id']) ?>" style="color: #334155; flex: 1; text-decoration: none;">
              <?php if (!empty($nextQa['is_secret'])): ?><i class="lock icon" style="font-size: 12px; color: #64748B;"></i><?php endif; ?>
              <?= e($nextQa['title']) ?>
            </a>
            <span style="font-size: 12px; color: var(--ydk-muted);"><?= date('Y.m.d', strtotime($nextQa['created_at'])) ?></span>
          <?php else: ?>
            <span style="color: var(--ydk-muted); font-size: 13px;">이전 게시물이 없습니다.</span>
          <?php endif; ?>
        </div>

      </div>
    </div>

    <!-- 5. 액션 버튼 -->
    <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 40px;">
      <a href="<?= url('contents/qa/qa.php') ?>" class="ui basic button" style="padding: 12px 26px; font-weight: 700;">
        <i class="list icon"></i> 목록으로
      </a>
      <a href="<?= url('contents/qa/qa_write.php') ?>" class="ui primary button" style="padding: 12px 26px; font-weight: 700;">
        <i class="edit icon"></i> 새 질문 작성
      </a>
    </div>

  <?php endif; ?>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
?>
