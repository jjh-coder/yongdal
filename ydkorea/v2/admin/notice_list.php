<?php
/**
 * 용달코리아 v2 관리자 - 공지사항 관리 목록
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반
 */
$adminTitle = '공지사항 관리';
require_once __DIR__ . '/includes/header.php';

$msg = '';
$error = '';

// 삭제 처리 (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $delId = (int)($_POST['id'] ?? 0);
    if ($delId > 0) {
        if (delete_notice_item($delId)) {
            $msg = '공지사항이 성공적으로 삭제되었습니다.';
        } else {
            $error = '공지사항 삭제 중 오류가 발생했습니다.';
        }
    }
}

// 검색 및 페이징 파라미터
$keyword = trim($_GET['kw'] ?? '');
$page = max(1, (int)($_GET['p'] ?? 1));
$perPage = 10;

// 데이터 조회
$allList = get_notice_list($keyword);
$totalRows = count($allList);
$totalPages = max(1, (int)ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$pagedList = array_slice($allList, $offset, $perPage);

// 10페이지 단위 블록 계산
$pageBlock = 10;
$startPage = (int)(floor(($page - 1) / $pageBlock) * $pageBlock) + 1;
$endPage = min($totalPages, $startPage + $pageBlock - 1);

$makePageUrl = function($p) use ($keyword) {
    $q = ['p' => $p];
    if ($keyword !== '') $q['kw'] = $keyword;
    return url('admin/notice_list.php?' . http_build_query($q));
};
?>

<div class="ydk-admin-card">
  <div class="ydk-admin-card-header">
    <h1 class="ydk-admin-card-title">
      <i class="bullhorn icon"></i> 공지사항 관리
      <span style="font-size: 15px; font-weight: 500; color: var(--ydk-adm-muted); margin-left: 8px;">
        (총 <?= number_format($totalRows) ?>건)
      </span>
    </h1>
    <div style="display: flex; gap: 8px;">
      <a href="<?= url('admin/notice_form.php') ?>" class="ui small primary button">
        <i class="plus icon"></i> 신규 공지 등록
      </a>
      <a href="<?= url('contents/notice/notice.php') ?>" target="_blank" class="ui small basic button">
        <i class="external alternate icon"></i> 사용자 공지 목록
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

  <!-- 검색 바 -->
  <div class="ydk-filter-bar">
    <form method="get" action="<?= url('admin/notice_list.php') ?>" style="display: flex; gap: 8px; width: 100%; max-width: 480px;">
      <input type="text" name="kw" placeholder="제목, 내용 또는 작성자 검색..." value="<?= e($keyword) ?>">
      <button type="submit" class="ui primary button">검색</button>
      <?php if ($keyword !== ''): ?>
        <a href="<?= url('admin/notice_list.php') ?>" class="ui basic button">초기화</a>
      <?php endif; ?>
    </form>
  </div>

  <!-- 목록 테이블 -->
  <?php if (empty($pagedList)): ?>
    <div class="ui placeholder segment" style="padding: 50px; text-align: center;">
      <div class="ui icon header" style="color: var(--ydk-adm-muted);">
        <i class="inbox icon"></i>
        등록된 공지사항이 없습니다.
      </div>
    </div>
  <?php else: ?>
    <div style="overflow-x: auto;">
      <table class="ui celled table unstackable selectable ydk-adm-table">
        <thead>
          <tr>
            <th style="width: 75px; text-align: center;">번호</th>
            <th style="width: 90px; text-align: center;">고정</th>
            <th>공지 제목</th>
            <th style="width: 120px; text-align: center;">작성자</th>
            <th style="width: 130px; text-align: center;">등록일시</th>
            <th style="width: 80px; text-align: center;">조회</th>
            <th style="width: 140px; text-align: center;">관리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pagedList as $row): 
            $nId = (int)$row['id'];
            $isPinned = !empty($row['is_pinned']);
          ?>
            <tr style="<?= $isPinned ? 'background-color: #F8FAFC;' : '' ?>">
              <td style="text-align: center; color: var(--ydk-adm-muted);"><?= $nId ?></td>
              <td style="text-align: center;">
                <?php if ($isPinned): ?>
                  <span class="ui red mini label" style="font-weight: 700;">고정공지</span>
                <?php else: ?>
                  <span style="color: #94A3B8; font-size: 13px;">일반</span>
                <?php endif; ?>
              </td>
              <td>
                <a href="<?= url('contents/notice/notice_view.php?id=' . $nId) ?>" target="_blank" style="color: #1E293B; font-weight: 600;">
                  <?= e($row['title']) ?>
                </a>
              </td>
              <td style="text-align: center;"><?= e($row['author'] ?? '관리자') ?></td>
              <td style="text-align: center; font-size: 13px; color: var(--ydk-adm-muted);">
                <?= !empty($row['created_at']) ? date('y/m/d H:i', strtotime($row['created_at'])) : '-' ?>
              </td>
              <td style="text-align: center; font-size: 13px; color: var(--ydk-adm-muted);">
                <?= number_format((int)($row['hit'] ?? 0)) ?>
              </td>
              <td style="text-align: center;">
                <a href="<?= url('admin/notice_form.php?id=' . $nId) ?>" class="ui mini primary basic button">
                  수정
                </a>
                <form method="post" action="<?= url('admin/notice_list.php') ?>" style="display: inline;" onsubmit="return confirm('정말 이 공지사항을 삭제하시겠습니까?');">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $nId ?>">
                  <button type="submit" class="ui mini negative basic button">
                    삭제
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- 10페이지 블록 페이지네이션 -->
    <?php if ($totalPages > 1): ?>
      <div style="display: flex; justify-content: center; align-items: center; margin-top: 24px;">
        <div class="ui pagination menu" style="box-shadow: 0 1px 3px rgba(0,0,0,0.06); flex-wrap: wrap;">
          <?php if ($page > 1): ?>
            <a class="item" href="<?= $makePageUrl(1) ?>" title="처음 페이지"><i class="angle double left icon"></i></a>
            <a class="item" href="<?= $makePageUrl($page - 1) ?>" title="이전 페이지"><i class="angle left icon"></i></a>
          <?php else: ?>
            <span class="disabled item"><i class="angle double left icon"></i></span>
            <span class="disabled item"><i class="angle left icon"></i></span>
          <?php endif; ?>

          <?php if ($startPage > 1): ?>
            <a class="item" href="<?= $makePageUrl($startPage - 1) ?>" title="이전 10페이지">...</a>
          <?php endif; ?>

          <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <a href="<?= $makePageUrl($i) ?>" class="item <?= ($page === $i) ? 'active' : '' ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>

          <?php if ($endPage < $totalPages): ?>
            <a class="item" href="<?= $makePageUrl($endPage + 1) ?>" title="다음 10페이지">...</a>
          <?php endif; ?>

          <?php if ($page < $totalPages): ?>
            <a class="item" href="<?= $makePageUrl($page + 1) ?>" title="다음 페이지"><i class="angle right icon"></i></a>
            <a class="item" href="<?= $makePageUrl($totalPages) ?>" title="마지막 페이지"><i class="angle double right icon"></i></a>
          <?php else: ?>
            <span class="disabled item"><i class="angle right icon"></i></span>
            <span class="disabled item"><i class="angle double right icon"></i></span>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

  <?php endif; ?>

</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
