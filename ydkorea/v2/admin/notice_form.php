<?php
/**
 * 용달코리아 v2 관리자 - 공지사항 등록 및 수정 폼
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반
 */
$adminTitle = '공지사항 작성/수정';
require_once __DIR__ . '/includes/header.php';

$id = max(0, (int)($_GET['id'] ?? 0));
$isEdit = ($id > 0);
$notice = $isEdit ? get_notice_item($id) : null;

if ($isEdit && !$notice) {
    echo "<script>alert('존재하지 않는 공지사항입니다.'); location.href='" . url('admin/notice_list.php') . "';</script>";
    exit;
}

$msg = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = trim($_POST['title'] ?? '');
    $author   = trim($_POST['author'] ?? '');
    $content  = trim($_POST['content'] ?? '');
    $isPinned = !empty($_POST['is_pinned']) ? 1 : 0;

    if (empty($title)) {
        $error = '공지사항 제목을 입력해 주세요.';
    } elseif (empty($content)) {
        $error = '공지사항 내용을 입력해 주세요.';
    } else {
        $data = [
            'title'     => $title,
            'author'    => $author ?: '관리자',
            'content'   => $content,
            'is_pinned' => $isPinned,
        ];

        if ($isEdit) {
            if (update_notice_item($id, $data)) {
                echo "<script>alert('공지사항이 성공적으로 수정되었습니다.'); location.href='" . url('admin/notice_list.php') . "';</script>";
                exit;
            } else {
                $error = '공지사항 수정 처리 중 오류가 발생했습니다.';
            }
        } else {
            $newId = insert_notice_item($data);
            if ($newId > 0) {
                echo "<script>alert('공지사항이 성공적으로 등록되었습니다.'); location.href='" . url('admin/notice_list.php') . "';</script>";
                exit;
            } else {
                $error = '공지사항 등록 처리 중 오류가 발생했습니다.';
            }
        }
    }
}

// 폼 기본값 바인딩
$valTitle    = $_POST['title'] ?? ($notice['title'] ?? '');
$valAuthor   = $_POST['author'] ?? ($notice['author'] ?? '관리자');
$valContent  = $_POST['content'] ?? ($notice['content'] ?? '');
$valIsPinned = isset($_POST['is_pinned']) ? !empty($_POST['is_pinned']) : (!empty($notice['is_pinned']));
?>

<div class="ydk-admin-card" style="max-width: 900px; margin: 0 auto;">
  <div class="ydk-admin-card-header">
    <h1 class="ydk-admin-card-title">
      <i class="<?= $isEdit ? 'edit outline' : 'plus' ?> icon"></i>
      <?= $isEdit ? '공지사항 수정' : '신규 공지사항 등록' ?>
    </h1>
    <a href="<?= url('admin/notice_list.php') ?>" class="ui small basic button">
      <i class="list icon"></i> 공지 목록으로
    </a>
  </div>

  <?php if (!empty($error)): ?>
    <div class="ui negative message">
      <i class="exclamation triangle icon"></i> <?= e($error) ?>
    </div>
  <?php endif; ?>

  <form method="post" action="<?= url('admin/notice_form.php' . ($isEdit ? '?id=' . $id : '')) ?>" class="ui form">
    
    <div class="two fields">
      <div class="twelve wide required field">
        <label>공지사항 제목</label>
        <input type="text" name="title" value="<?= e($valTitle) ?>" placeholder="공지사항 제목을 입력하세요" required>
      </div>
      <div class="four wide required field">
        <label>작성자</label>
        <input type="text" name="author" value="<?= e($valAuthor) ?>" placeholder="관리자" required>
      </div>
    </div>

    <div class="field" style="margin: 8px 0 16px 0;">
      <div class="ui checkbox">
        <input type="checkbox" name="is_pinned" value="1" id="is_pinned_chk" <?= $valIsPinned ? 'checked' : '' ?>>
        <label for="is_pinned_chk" style="font-weight: 700; color: #DC2626; cursor: pointer;">
          <i class="bullhorn icon"></i> 상단 고정 공지로 등록 (목록 최상단에 항상 노출)
        </label>
      </div>
    </div>

    <div class="required field">
      <label>공지 본문 내용</label>
      <textarea name="content" rows="14" placeholder="공지사항 내용을 상세히 작성해 주세요." required style="font-size: 15px; line-height: 1.6;"><?= e($valContent) ?></textarea>
    </div>

    <div style="display: flex; gap: 10px; justify-content: center; margin-top: 30px;">
      <a href="<?= url('admin/notice_list.php') ?>" class="ui basic button" style="padding: 12px 28px;">
        취소
      </a>
      <button type="submit" class="ui primary button" style="padding: 12px 36px; font-weight: 700;">
        <i class="check icon"></i> <?= $isEdit ? '공지 수정 완료' : '공지 등록하기' ?>
      </button>
    </div>

  </form>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
