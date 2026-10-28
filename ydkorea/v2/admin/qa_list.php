<?php
/**
 * 용달코리아 v2 관리자 - 묻고답하기(Q&A) 문의 관리 목록
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반
 */
$adminTitle = '묻고답하기 관리';
require_once __DIR__ . '/includes/header.php';

$msg = '';
$error = '';

// 삭제 처리 (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $delId = (int)($_POST['id'] ?? 0);
    if ($delId > 0) {
        if (delete_qa_item($delId)) {
            $msg = '문의 게시물이 성공적으로 삭제되었습니다.';
        } else {
            $error = '문의 게시물 삭제 중 오류가 발생했습니다.';
        }
    }
}

// 검색 및 필터 파라미터
$filterStatus = trim($_GET['status'] ?? '');
$keyword = trim($_GET['kw'] ?? '');
$page = max(1, (int)($_GET['p'] ?? 1));
$perPage = 10;

// 데이터 조회
$allList = get_qa_list($filterStatus, $keyword);
$totalRows = count($allList);
$totalPages = max(1, (int)ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$pagedList = array_slice($allList, $offset, $perPage);

// 상태별 카운트 계산용 전체 조회
$statsList = get_qa_list('', $keyword);
$statCounts = ['전체' => count($statsList), '접수' => 0, '답변완료' => 0];
foreach ($statsList as $row) {
    $st = $row['status'] ?? '접수';
    if (isset($statCounts[$st])) {
        $statCounts[$st]++;
    }
}

// 10페이지 단위 블록 계산
$pageBlock = 10;
$startPage = (int)(floor(($page - 1) / $pageBlock) * $pageBlock) + 1;
$endPage = min($totalPages, $startPage + $pageBlock - 1);

$makePageUrl = function($p) use ($filterStatus, $keyword) {
    $q = ['p' => $p];
    if ($filterStatus !== '') $q['status'] = $filterStatus;
    if ($keyword !== '') $q['kw'] = $keyword;
    return url('admin/qa_list.php?' . http_build_query($q));
};
?>

<div class="ydk-admin-card">
  <div class="ydk-admin-card-header">
    <h1 class="ydk-admin-card-title">
      <i class="comments outline icon"></i> 묻고답하기 (Q&A) 문의 관리
      <span style="font-size: 15px; font-weight: 500; color: var(--ydk-adm-muted); margin-left: 8px;">
        (총 <?= number_format($totalRows) ?>건)
      </span>
    </h1>
    <div>
      <a href="<?= url('contents/qa/qa.php') ?>" target="_blank" class="ui small basic button">
        <i class="external alternate icon"></i> 사용자 Q&A 목록
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

  <!-- 상태 필터 & 검색 바 -->
  <div class="ydk-filter-bar">
    <div class="ydk-status-tabs">
      <a href="<?= url('admin/qa_list.php?kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '') ? 'active' : '' ?>">
        전체 (<?= $statCounts['전체'] ?>)
      </a>
      <a href="<?= url('admin/qa_list.php?status=' . urlencode('접수') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '접수') ? 'active' : '' ?>">
        답변대기 (<?= $statCounts['접수'] ?>)
      </a>
      <a href="<?= url('admin/qa_list.php?status=' . urlencode('답변완료') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '답변완료') ? 'active' : '' ?>">
        답변완료 (<?= $statCounts['답변완료'] ?>)
      </a>
    </div>

    <form method="get" action="<?= url('admin/qa_list.php') ?>" style="display: flex; gap: 8px;">
      <?php if ($filterStatus !== ''): ?>
        <input type="hidden" name="status" value="<?= e($filterStatus) ?>">
      <?php endif; ?>
      <input type="text" name="kw" placeholder="제목, 질문, 작성자, 전화번호..." value="<?= e($keyword) ?>">
      <button type="submit" class="ui primary button">검색</button>
      <?php if ($filterStatus !== '' || $keyword !== ''): ?>
        <a href="<?= url('admin/qa_list.php') ?>" class="ui basic button">초기화</a>
      <?php endif; ?>
    </form>
  </div>

  <!-- 목록 테이블 -->
  <?php if (empty($pagedList)): ?>
    <div class="ui placeholder segment" style="padding: 50px; text-align: center;">
      <div class="ui icon header" style="color: var(--ydk-adm-muted);">
        <i class="inbox icon"></i>
        조건에 일치하는 질문 및 문의 내역이 없습니다.
      </div>
    </div>
  <?php else: ?>
    <div style="overflow-x: auto;">
      <table class="ui celled table unstackable selectable ydk-adm-table">
        <thead>
          <tr>
            <th style="width: 70px; text-align: center;">번호</th>
            <th style="width: 100px; text-align: center;">상태</th>
            <th>질문 제목</th>
            <th style="width: 110px;">작성자</th>
            <th style="width: 140px;">연락처</th>
            <th style="width: 80px; text-align: center;">비밀글</th>
            <th style="width: 120px; text-align: center;">등록일시</th>
            <th style="width: 140px; text-align: center;">관리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pagedList as $row): 
            $qId = (int)$row['id'];
            $st = $row['status'] ?? '접수';
            $isAnswered = ($st === '답변완료');
            $isSecret = !empty($row['is_secret']);
            $phone = $row['phone'] ?? '';
            $phoneNum = preg_replace('/[^0-9]/', '', $phone);
          ?>
            <tr>
              <td style="text-align: center; color: var(--ydk-adm-muted);"><?= $qId ?></td>
              <td style="text-align: center;">
                <?php if ($isAnswered): ?>
                  <span class="ui green tiny label" style="font-weight: 700;">답변완료</span>
                <?php else: ?>
                  <span class="ui orange tiny label" style="font-weight: 700;">답변대기</span>
                <?php endif; ?>
              </td>
              <td>
                <a href="<?= url('admin/qa_view.php?id=' . $qId) ?>" style="font-weight: 700; color: #1E293B;">
                  <?= e($row['title']) ?>
                </a>
              </td>
              <td><strong><?= e($row['writer']) ?></strong></td>
              <td>
                <?php if (!empty($phoneNum)): ?>
                  <a href="tel:<?= e($phoneNum) ?>" style="color: #2563EB; font-weight: 600;">
                    <i class="phone icon"></i><?= e($phone) ?>
                  </a>
                <?php else: ?>
                  <span style="color: var(--ydk-adm-muted);">-</span>
                <?php endif; ?>
              </td>
              <td style="text-align: center;">
                <?php if ($isSecret): ?>
                  <span class="ui basic mini label" style="color: #64748B;"><i class="lock icon"></i>비밀글</span>
                <?php else: ?>
                  <span style="color: #94A3B8; font-size: 13px;">공개</span>
                <?php endif; ?>
              </td>
              <td style="text-align: center; font-size: 13px; color: var(--ydk-adm-muted);">
                <?= !empty($row['created_at']) ? date('y/m/d H:i', strtotime($row['created_at'])) : '-' ?>
              </td>
              <td style="text-align: center;">
                <a href="<?= url('admin/qa_view.php?id=' . $qId) ?>" class="ui mini <?= $isAnswered ? 'basic' : 'primary' ?> button">
                  <?= $isAnswered ? '상세/수정' : '답변작성' ?>
                </a>
                <form method="post" action="<?= url('admin/qa_list.php') ?>" style="display: inline;" onsubmit="return confirm('정말 이 문의를 삭제하시겠습니까?');">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= $qId ?>">
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
