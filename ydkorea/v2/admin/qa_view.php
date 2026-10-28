<?php
/**
 * 용달코리아 v2 관리자 - 묻고답하기 상세 및 답변 작성
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반
 */
$adminTitle = 'Q&A 답변 작성 및 관리';
require_once __DIR__ . '/includes/header.php';

$id = max(0, (int)($_GET['id'] ?? 0));
$qa = get_qa_item($id);

if (!$qa) {
    echo "<script>alert('존재하지 않거나 삭제된 문의입니다.'); location.href='" . url('admin/qa_list.php') . "';</script>";
    exit;
}

$msg = '';
$error = '';

// 답변 저장 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'answer') {
        $answer = trim($_POST['answer'] ?? '');
        if (empty($answer)) {
            $error = '답변 내용을 입력해 주세요.';
        } else {
            if (answer_qa_item($id, $answer)) {
                $msg = '답변이 성공적으로 등록/수정되었습니다.';
                $qa = get_qa_item($id); // 최신 데이터 재조회
            } else {
                $error = '답변 저장 중 오류가 발생했습니다.';
            }
        }
    } elseif ($action === 'delete') {
        if (delete_qa_item($id)) {
            echo "<script>alert('문의가 삭제되었습니다.'); location.href='" . url('admin/qa_list.php') . "';</script>";
            exit;
        } else {
            $error = '문의 삭제 중 오류가 발생했습니다.';
        }
    }
}

$phoneNum = preg_replace('/[^0-9]/', '', $qa['phone'] ?? '');
$isAnswered = (($qa['status'] ?? '') === '답변완료');
?>

<div class="ydk-admin-card" style="max-width: 950px; margin: 0 auto;">
  <div class="ydk-admin-card-header">
    <h1 class="ydk-admin-card-title">
      <i class="comment alternate outline icon"></i> Q&A 문의 상세 및 답변
      <span style="font-size: 14px; font-weight: normal; margin-left: 8px;">(No. <?= (int)$qa['id'] ?>)</span>
    </h1>
    <div style="display: flex; gap: 8px;">
      <a href="<?= url('contents/qa/qa_view.php?id=' . (int)$qa['id']) ?>" target="_blank" class="ui small basic button">
        <i class="external alternate icon"></i> 사용자단 화면 보기
      </a>
      <a href="<?= url('admin/qa_list.php') ?>" class="ui small basic button">
        <i class="list icon"></i> 문의 목록
      </a>
    </div>
  </div>

  <?php if (!empty($msg)): ?>
    <div class="ui positive message">
      <i class="check icon"></i> <?= e($msg) ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="ui negative message">
      <i class="exclamation triangle icon"></i> <?= e($error) ?>
    </div>
  <?php endif; ?>

  <!-- 1. 문의자 정보 요약 -->
  <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 18px 24px; margin-bottom: 24px;">
    <div class="ui four column stackable grid">
      <div class="column">
        <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-bottom: 4px;">작성자</div>
        <div style="font-size: 16px; font-weight: 700; color: #1E293B;"><?= e($qa['writer']) ?></div>
      </div>
      <div class="column">
        <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-bottom: 4px;">연락처</div>
        <div>
          <?php if (!empty($phoneNum)): ?>
            <a href="tel:<?= e($phoneNum) ?>" style="font-size: 16px; font-weight: 700; color: #2563EB;">
              <i class="phone icon"></i><?= e($qa['phone']) ?>
            </a>
          <?php else: ?>
            <span style="color: var(--ydk-adm-muted);">-</span>
          <?php endif; ?>
        </div>
      </div>
      <div class="column">
        <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-bottom: 4px;">이메일</div>
        <div style="font-size: 14px; color: #334155;"><?= e($qa['email'] ?: '-') ?></div>
      </div>
      <div class="column">
        <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-bottom: 4px;">상태 / 등록일시</div>
        <div>
          <?php if ($isAnswered): ?>
            <span class="ui green tiny label" style="font-weight: 700;">답변완료</span>
          <?php else: ?>
            <span class="ui orange tiny label" style="font-weight: 700;">답변대기</span>
          <?php endif; ?>
          <span style="font-size: 13px; color: var(--ydk-adm-muted); margin-left: 6px;">
            <?= e(date('y/m/d H:i', strtotime($qa['created_at']))) ?>
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- 2. 고객 질문 내용 -->
  <div style="margin-bottom: 30px;">
    <h3 style="font-size: 17px; font-weight: 800; color: #1E293B; margin-bottom: 12px;">
      <span style="color: #2563EB;">[고객 질문]</span> <?= e($qa['title']) ?>
      <?php if (!empty($qa['is_secret'])): ?>
        <span class="ui basic mini label" style="margin-left: 6px;"><i class="lock icon"></i> 비밀글</span>
      <?php endif; ?>
    </h3>
    <div style="background: #FFF; border: 1px solid #CBD5E1; border-radius: 8px; padding: 20px; font-size: 15px; line-height: 1.8; color: #334155; min-height: 120px;">
      <?= nl2br(e($qa['question'])) ?>
    </div>
  </div>

  <!-- 3. 관리자 답변 작성 / 수정 폼 -->
  <div style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 10px; padding: 24px; margin-bottom: 30px;">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 8px;">
      <h3 style="font-size: 17px; font-weight: 800; color: #166534; margin: 0;">
        <i class="reply icon"></i> 관리자 답변 <?= $isAnswered ? '수정' : '작성' ?>
      </h3>
      <?php if (!empty($qa['answered_at'])): ?>
        <span style="font-size: 13px; color: #15803D;">
          <i class="clock icon"></i> 최근 답변일: <?= e(date('Y년 m월 d일 H:i', strtotime($qa['answered_at']))) ?>
        </span>
      <?php endif; ?>
    </div>

    <form method="post" action="<?= url('admin/qa_view.php?id=' . $id) ?>" class="ui form">
      <input type="hidden" name="action" value="answer">
      
      <div class="field">
        <textarea name="answer" rows="9" placeholder="고객님의 질문에 대한 답변 내용을 입력해 주세요. (저장 시 즉시 '답변완료' 상태로 전환되며 사용자단에 공개됩니다.)" required style="font-size: 15px; line-height: 1.7;"><?= e($qa['answer'] ?? '') ?></textarea>
      </div>

      <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 18px; flex-wrap: wrap; gap: 10px;">
        <span style="font-size: 13px; color: #15803D;">
          * 답변을 저장하면 상태가 <strong>[답변완료]</strong>로 변경됩니다.
        </span>
        <button type="submit" class="ui positive button" style="padding: 12px 28px; font-weight: 700;">
          <i class="check icon"></i> 답변 <?= $isAnswered ? '수정 저장' : '등록 완료' ?>
        </button>
      </div>
    </form>
  </div>

  <!-- 4. 하단 삭제 및 목록 액션 바 -->
  <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #E2E8F0; padding-top: 20px;">
    <form method="post" action="<?= url('admin/qa_view.php?id=' . $id) ?>" onsubmit="return confirm('정말 이 문의를 영구 삭제하시겠습니까?');">
      <input type="hidden" name="action" value="delete">
      <button type="submit" class="ui negative basic button">
        <i class="trash alternate icon"></i> 문의 삭제
      </button>
    </form>
    <a href="<?= url('admin/qa_list.php') ?>" class="ui basic button" style="padding: 11px 24px;">
      <i class="list icon"></i> 문의 목록으로
    </a>
  </div>

</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
