<?php
/**
 * 용달코리아 v2-1 관리자 온라인 상담 내역 전체 목록 (PHP 7.4.33)
 * 온라인 상담 단건 삭제 및 선택 일괄 삭제 기능 지원
 */
$adminTitle = '온라인 상담 내역 목록';
require_once __DIR__ . '/includes/header.php';

// 검색 및 필터 파라미터
$filterStatus = trim($_GET['status'] ?? '');
$keyword = trim($_GET['kw'] ?? '');
$page = max(1, (int)($_GET['p'] ?? 1));
$perPage = 15;

$makePageUrl = function($p) use ($filterStatus, $keyword) {
    $q = ['p' => $p];
    if ($filterStatus !== '') $q['status'] = $filterStatus;
    if ($keyword !== '') $q['kw'] = $keyword;
    return url('admin/consult_list.php?' . http_build_query($q));
};

// 1. POST 삭제 요청 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // 단건 삭제
    if ($action === 'delete') {
        $delId = (int)($_POST['id'] ?? 0);
        if ($delId > 0 && delete_consult_item($delId)) {
            $_SESSION['admin_flash'] = [
                'type' => 'positive',
                'message' => "상담 내역(#{$delId})이 성공적으로 삭제되었습니다."
            ];
        } else {
            $_SESSION['admin_flash'] = [
                'type' => 'negative',
                'message' => "상담 내역 삭제 처리에 실패했습니다."
            ];
        }
        header('Location: ' . $makePageUrl($page));
        exit;
    }

    // 선택 일괄 삭제
    if ($action === 'batch_delete') {
        $ids = $_POST['ids'] ?? [];
        if (is_array($ids) && count($ids) > 0) {
            $deletedCount = delete_consult_items($ids);
            $_SESSION['admin_flash'] = [
                'type' => 'positive',
                'message' => "선택하신 상담 내역 총 {$deletedCount}건이 성공적으로 삭제되었습니다."
            ];
        } else {
            $_SESSION['admin_flash'] = [
                'type' => 'negative',
                'message' => "삭제할 상담 내역을 1개 이상 선택해 주세요."
            ];
        }
        header('Location: ' . $makePageUrl($page));
        exit;
    }
}

// 세션 플래시 메시지 확인
$flash = $_SESSION['admin_flash'] ?? null;
if (isset($_SESSION['admin_flash'])) {
    unset($_SESSION['admin_flash']);
}

// 2. 데이터 조회
$allList = get_consult_list($filterStatus, $keyword);
$totalRows = count($allList);
$totalPages = max(1, (int)ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$pagedList = array_slice($allList, $offset, $perPage);

// 페이지네이션 블록 계산 (10페이지 단위)
$pageBlock = 10;
$startPage = (int)(floor(($page - 1) / $pageBlock) * $pageBlock) + 1;
$endPage = min($totalPages, $startPage + $pageBlock - 1);

// 상태별 카운트 계산용 전체 조회
$statsList = get_consult_list('', $keyword);
$statCounts = ['전체' => count($statsList), '접수' => 0, '상담중' => 0, '배차완료' => 0, '취소' => 0];
foreach ($statsList as $row) {
    $st = $row['status'] ?? '접수';
    if (isset($statCounts[$st])) {
        $statCounts[$st]++;
    }
}

$carTypes = [
    '1t_cargo' => '1톤 카고',
    '1t_top' => '1톤 탑차',
    '1t_lift' => '1톤 리프트',
    '1.4t_cargo' => '1.4톤',
    '2.5t_cargo' => '2.5톤',
    '5t_cargo' => '5톤',
    'room_move' => '원룸이사',
    'office_move' => '사무실이사'
];
?>

<div class="ydk-admin-card">
  <!-- 상단 알림 메시지 -->
  <?php if (!empty($flash)): ?>
    <div class="ui <?= e($flash['type'] ?? 'info') ?> message" style="margin-bottom: 20px;">
      <i class="<?= ($flash['type'] === 'positive') ? 'check' : 'exclamation triangle' ?> icon"></i>
      <?= e($flash['message']) ?>
    </div>
  <?php endif; ?>

  <div class="ydk-admin-card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
    <h1 class="ydk-admin-card-title" style="margin: 0;">
      <i class="comments outline icon"></i> 온라인 상담 및 견적 신청 내역
      <span style="font-size: 15px; font-weight: 500; color: var(--ydk-adm-muted); margin-left: 8px;">
        (총 <?= number_format($totalRows) ?>건)
      </span>
    </h1>

    <div style="display: flex; gap: 8px; align-items: center;">
      <button type="button" class="ui negative small button" id="btnBatchDelete" onclick="deleteBatch()" style="font-weight: 700;">
        <i class="trash alternate icon"></i> 선택 항목 삭제
      </button>
    </div>
  </div>

  <!-- 필터 탭 & 검색창 -->
  <div class="ydk-filter-bar">
    <!-- 상태 탭 -->
    <div class="ydk-status-tabs">
      <a href="<?= url('admin/consult_list.php?kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '') ? 'active' : '' ?>">
        전체 (<?= $statCounts['전체'] ?>)
      </a>
      <a href="<?= url('admin/consult_list.php?status=' . urlencode('접수') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '접수') ? 'active' : '' ?>">
        신규 접수 (<?= $statCounts['접수'] ?>)
      </a>
      <a href="<?= url('admin/consult_list.php?status=' . urlencode('상담중') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '상담중') ? 'active' : '' ?>">
        상담 진행 (<?= $statCounts['상담중'] ?>)
      </a>
      <a href="<?= url('admin/consult_list.php?status=' . urlencode('배차완료') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '배차완료') ? 'active' : '' ?>">
        배차 완료 (<?= $statCounts['배차완료'] ?>)
      </a>
      <a href="<?= url('admin/consult_list.php?status=' . urlencode('취소') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '취소') ? 'active' : '' ?>">
        취소 (<?= $statCounts['취소'] ?>)
      </a>
    </div>

    <!-- 검색 폼 -->
    <form class="ui form" method="get" action="<?= url('admin/consult_list.php') ?>" style="display: flex; gap: 8px;">
      <?php if ($filterStatus !== ''): ?>
        <input type="hidden" name="status" value="<?= e($filterStatus) ?>">
      <?php endif; ?>
      <div class="ui left icon input" style="width: 260px;">
        <i class="search icon"></i>
        <input type="text" name="kw" placeholder="고객명, 연락처, 지역 검색" value="<?= e($keyword) ?>">
      </div>
      <button type="submit" class="ui button basic">검색</button>
      <?php if ($keyword !== '' || $filterStatus !== ''): ?>
        <a href="<?= url('admin/consult_list.php') ?>" class="ui button basic">초기화</a>
      <?php endif; ?>
    </form>
  </div>

  <!-- 목록 테이블 -->
  <?php if (empty($pagedList)): ?>
    <div class="ui placeholder segment" style="padding: 40px; text-align: center;">
      <div class="ui icon header" style="color: var(--ydk-adm-muted);">
        <i class="search icon"></i>
        조건에 일치하는 상담 내역이 없습니다.
      </div>
    </div>
  <?php else: ?>
    <!-- 일괄 선택 폼 (테이블 내부 체크박스와 연동) -->
    <form id="batchDeleteForm" method="post" action="<?= $makePageUrl($page) ?>">
      <input type="hidden" name="action" value="batch_delete">
    </form>

    <div style="overflow-x: auto;">
      <table class="ui celled table unstackable selectable ydk-adm-table">
        <thead>
          <tr>
            <th style="width: 44px; text-align: center;">
              <input type="checkbox" id="checkAll" title="전체 선택/해제" style="cursor: pointer; width: 16px; height: 16px;">
            </th>
            <th style="width: 65px; text-align: center;">번호</th>
            <th style="width: 95px; text-align: center;">상태</th>
            <th style="width: 120px;">신청자명</th>
            <th style="width: 140px;">연락처</th>
            <th style="width: 110px;">희망차종</th>
            <th>출발지 → 도착지</th>
            <th style="width: 110px; text-align: center;">운송희망일</th>
            <th style="width: 130px; text-align: center;">신청일시</th>
            <th style="width: 120px; text-align: center;">관리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pagedList as $row): 
            $st = $row['status'] ?? '접수';
            $carName = $carTypes[$row['car_type']] ?? ($row['car_type'] ?: '상담후결정');
          ?>
            <tr>
              <td style="text-align: center;">
                <input type="checkbox" name="ids[]" value="<?= (int)$row['id'] ?>" class="consult-chk" form="batchDeleteForm" style="cursor: pointer; width: 16px; height: 16px;">
              </td>
              <td style="text-align: center; color: var(--ydk-adm-muted);"><?= (int)$row['id'] ?></td>
              <td style="text-align: center;">
                <span class="ydk-badge-status <?= e($st) ?>"><?= e($st) ?></span>
              </td>
              <td><strong><?= e($row['name']) ?></strong></td>
              <td>
                <a href="tel:<?= preg_replace('/[^0-9]/', '', $row['tel']) ?>" style="color: #2563EB; font-weight: 600;">
                  <i class="phone icon"></i><?= e($row['tel']) ?>
                </a>
              </td>
              <td><?= e($carName) ?></td>
              <td>
                <span><?= e($row['start_area'] ?: '미지정') ?></span>
                <i class="arrow right small icon" style="color: var(--ydk-adm-muted); margin: 0 4px;"></i>
                <span><?= e($row['end_area'] ?: '미지정') ?></span>
              </td>
              <td style="text-align: center;"><?= e($row['move_date'] ?: '-') ?></td>
              <td style="text-align: center; color: var(--ydk-adm-muted); font-size: 13px;">
                <?= e(date('y/m/d H:i', strtotime($row['created_at']))) ?>
              </td>
              <td style="text-align: center;">
                <div class="ui mini buttons">
                  <a href="<?= url('admin/consult_view.php?id=' . (int)$row['id']) ?>" class="ui button primary" style="padding: 6px 10px;">
                    보기
                  </a>
                  <button type="button" class="ui button negative basic" style="padding: 6px 10px;" onclick="deleteSingle(<?= (int)$row['id'] ?>, '<?= e(addslashes($row['name'])) ?>')">
                    삭제
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- 페이징 -->
    <?php if ($totalPages > 1): ?>
      <div style="display: flex; justify-content: center; align-items: center; margin-top: 24px;">
        <div class="ui pagination menu" style="box-shadow: 0 1px 3px rgba(0,0,0,0.06); flex-wrap: wrap;">
          <!-- 처음 페이지 -->
          <?php if ($page > 1): ?>
            <a class="item" href="<?= $makePageUrl(1) ?>" title="처음 페이지">
              <i class="angle double left icon"></i>
            </a>
            <a class="item" href="<?= $makePageUrl($page - 1) ?>" title="이전 페이지">
              <i class="angle left icon"></i>
            </a>
          <?php else: ?>
            <span class="disabled item"><i class="angle double left icon"></i></span>
            <span class="disabled item"><i class="angle left icon"></i></span>
          <?php endif; ?>

          <!-- 이전 10페이지 점프 -->
          <?php if ($startPage > 1): ?>
            <a class="item" href="<?= $makePageUrl($startPage - 1) ?>" title="이전 10페이지">...</a>
          <?php endif; ?>

          <!-- 페이지 번호 (현재 블록) -->
          <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <a href="<?= $makePageUrl($i) ?>" class="item <?= ($page === $i) ? 'active' : '' ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>

          <!-- 다음 10페이지 점프 -->
          <?php if ($endPage < $totalPages): ?>
            <a class="item" href="<?= $makePageUrl($endPage + 1) ?>" title="다음 10페이지">...</a>
          <?php endif; ?>

          <!-- 다음 / 마지막 페이지 -->
          <?php if ($page < $totalPages): ?>
            <a class="item" href="<?= $makePageUrl($page + 1) ?>" title="다음 페이지">
              <i class="angle right icon"></i>
            </a>
            <a class="item" href="<?= $makePageUrl($totalPages) ?>" title="마지막 페이지">
              <i class="angle double right icon"></i>
            </a>
          <?php else: ?>
            <span class="disabled item"><i class="angle right icon"></i></span>
            <span class="disabled item"><i class="angle double right icon"></i></span>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

  <?php endif; ?>

</div>

<!-- 단건 삭제 전송용 숨김 폼 -->
<form id="singleDeleteForm" method="post" action="<?= $makePageUrl($page) ?>" style="display: none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="id" id="singleDeleteId" value="">
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var checkAll = document.getElementById('checkAll');
  var rowChecks = document.querySelectorAll('.consult-chk');

  if (checkAll) {
    checkAll.addEventListener('change', function () {
      var isChecked = this.checked;
      rowChecks.forEach(function (chk) {
        chk.checked = isChecked;
      });
    });
  }
});

// 단건 삭제 확인
function deleteSingle(id, name) {
  var msg = '[' + name + ' 고객님]의 상담 내역 #' + id + '번을 정말로 삭제하시겠습니까?\n삭제 후에는 복구할 수 없습니다.';
  if (confirm(msg)) {
    document.getElementById('singleDeleteId').value = id;
    document.getElementById('singleDeleteForm').submit();
  }
}

// 선택 일괄 삭제 확인
function deleteBatch() {
  var checkedBoxes = document.querySelectorAll('.consult-chk:checked');
  if (checkedBoxes.length === 0) {
    alert('삭제할 상담 내역을 1개 이상 선택해 주세요.');
    return;
  }

  var msg = '선택하신 총 ' + checkedBoxes.length + '건의 상담 내역을 정말로 일괄 삭제하시겠습니까?\n삭제 후에는 복구할 수 없습니다.';
  if (confirm(msg)) {
    document.getElementById('batchDeleteForm').submit();
  }
}
</script>

<?php
require_once __DIR__ . '/includes/footer.php';
