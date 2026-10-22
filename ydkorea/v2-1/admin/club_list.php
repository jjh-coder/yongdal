<?php
/**
 * 용달코리아 v2-1 관리자 차주회원 신청 목록 (PHP 7.4.33)
 */
$adminTitle = '차주회원 관리';
require_once __DIR__ . '/includes/header.php';

// 검색 및 필터 파라미터
$filterStatus = trim($_GET['status'] ?? '');
$keyword = trim($_GET['kw'] ?? '');
$page = max(1, (int)($_GET['p'] ?? 1));
$perPage = 15;

// 데이터 조회
$allList = get_club_list($filterStatus, $keyword);
$totalRows = count($allList);
$totalPages = max(1, (int)ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$pagedList = array_slice($allList, $offset, $perPage);

// 페이지네이션 블록 계산 (10페이지 단위)
$pageBlock = 10;
$startPage = (int)(floor(($page - 1) / $pageBlock) * $pageBlock) + 1;
$endPage = min($totalPages, $startPage + $pageBlock - 1);

$makePageUrl = function($p) use ($filterStatus, $keyword) {
    $q = ['p' => $p];
    if ($filterStatus !== '') $q['status'] = $filterStatus;
    if ($keyword !== '') $q['kw'] = $keyword;
    return url('admin/club_list.php?' . http_build_query($q));
};

// 상태별 카운트 계산용 전체 조회
$statsList = get_club_list('', $keyword);
$statCounts = ['전체' => count($statsList), '신청' => 0, '승인' => 0, '보류' => 0, '탈퇴' => 0];
foreach ($statsList as $row) {
    $st = $row['status'] ?? '신청';
    if (isset($statCounts[$st])) {
        $statCounts[$st]++;
    }
}
?>

<div class="ydk-admin-card">
  <div class="ydk-admin-card-header">
    <h1 class="ydk-admin-card-title">
      <i class="truck icon"></i> 차주회원 및 제휴업체 신청 관리
      <span style="font-size: 15px; font-weight: 500; color: var(--ydk-adm-muted); margin-left: 8px;">
        (총 <?= number_format($totalRows) ?>건)
      </span>
    </h1>
    <a href="<?= url('contents/club/club.php') ?>" target="_blank" class="ui small basic button">
      <i class="external alternate icon"></i> 가입 신청 페이지 보기
    </a>
  </div>

  <!-- 필터 탭 & 검색창 -->
  <div class="ydk-filter-bar">
    <!-- 상태 탭 -->
    <div class="ydk-status-tabs">
      <a href="<?= url('admin/club_list.php?kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '') ? 'active' : '' ?>">
        전체 (<?= $statCounts['전체'] ?>)
      </a>
      <a href="<?= url('admin/club_list.php?status=' . urlencode('신청') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '신청') ? 'active' : '' ?>">
        신청 대기 (<?= $statCounts['신청'] ?>)
      </a>
      <a href="<?= url('admin/club_list.php?status=' . urlencode('승인') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '승인') ? 'active' : '' ?>">
        승인 완료 (<?= $statCounts['승인'] ?>)
      </a>
      <a href="<?= url('admin/club_list.php?status=' . urlencode('보류') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '보류') ? 'active' : '' ?>">
        보류 (<?= $statCounts['보류'] ?>)
      </a>
      <a href="<?= url('admin/club_list.php?status=' . urlencode('탈퇴') . '&kw=' . urlencode($keyword)) ?>" 
         class="ydk-status-tab <?= ($filterStatus === '탈퇴') ? 'active' : '' ?>">
        탈퇴 (<?= $statCounts['탈퇴'] ?>)
      </a>
    </div>

    <!-- 검색창 -->
    <form class="ydk-search-box" method="get" action="<?= url('admin/club_list.php') ?>">
      <?php if ($filterStatus !== ''): ?>
        <input type="hidden" name="status" value="<?= e($filterStatus) ?>">
      <?php endif; ?>
      <input type="text" name="kw" placeholder="성명, 상호, 연락처, 차량, 번호판..." value="<?= e($keyword) ?>">
      <button type="submit" class="ui primary button">검색</button>
      <?php if ($keyword !== ''): ?>
        <a href="<?= url('admin/club_list.php' . ($filterStatus ? '?status=' . urlencode($filterStatus) : '')) ?>" class="ui basic button" title="검색 초기화">초기화</a>
      <?php endif; ?>
    </form>
  </div>

  <!-- 목록 테이블 -->
  <?php if (empty($pagedList)): ?>
    <div class="ui placeholder segment" style="padding: 50px; text-align: center;">
      <div class="ui icon header" style="color: var(--ydk-adm-muted);">
        <i class="inbox icon"></i>
        조건에 일치하는 차주회원 신청 내역이 없습니다.
      </div>
    </div>
  <?php else: ?>
    <div style="overflow-x: auto;">
      <table class="ui celled table unstackable selectable ydk-adm-table">
        <thead>
          <tr>
            <th style="width: 65px; text-align: center;">번호</th>
            <th style="width: 95px; text-align: center;">상태</th>
            <th style="width: 120px;">차주성명</th>
            <th style="width: 130px;">회사명(상호)</th>
            <th style="width: 140px;">휴대폰</th>
            <th style="width: 120px;">보유차량</th>
            <th style="width: 130px;">차량번호</th>
            <th>활동지역 / 거주지</th>
            <th style="width: 130px; text-align: center;">신청일시</th>
            <th style="width: 80px; text-align: center;">관리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pagedList as $row): 
            $st = $row['status'] ?? '신청';
            $badgeClass = '대기';
            if ($st === '승인') $badgeClass = '배차완료';
            elseif ($st === '신청') $badgeClass = '접수';
            elseif ($st === '보류') $badgeClass = '상담중';
            elseif ($st === '탈퇴') $badgeClass = '취소';
          ?>
            <tr>
              <td style="text-align: center; color: var(--ydk-adm-muted);"><?= (int)$row['id'] ?></td>
              <td style="text-align: center;">
                <span class="ydk-badge-status <?= e($badgeClass) ?>"><?= e($st) ?></span>
              </td>
              <td><strong><?= e($row['name']) ?></strong></td>
              <td><?= e($row['c_name'] ?: '-') ?></td>
              <td>
                <a href="tel:<?= preg_replace('/[^0-9]/', '', $row['hp']) ?>" style="color: #2563EB; font-weight: 600;">
                  <i class="phone icon"></i><?= e($row['hp']) ?>
                </a>
              </td>
              <td><span class="ui small label"><?= e($row['car'] ?: '-') ?></span></td>
              <td><strong><?= e($row['car_no'] ?: '-') ?></strong></td>
              <td style="color: var(--ydk-adm-text);">
                <i class="map marker alternate icon" style="color: #64748B;"></i>
                <?= e($row['ad'] ?: '-') ?>
              </td>
              <td style="text-align: center; color: var(--ydk-adm-muted); font-size: 13px;">
                <?= e(date('y/m/d H:i', strtotime($row['created_at']))) ?>
              </td>
              <td style="text-align: center;">
                <a href="<?= url('admin/club_view.php?id=' . (int)$row['id']) ?>" class="ui mini primary basic button">
                  상세
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- 페이지네이션 -->
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

<?php
require_once __DIR__ . '/includes/footer.php';
?>
