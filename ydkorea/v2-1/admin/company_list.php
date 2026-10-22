<?php
/**
 * 용달코리아 v2-1 관리자 지역별 등록 업체 관리 (PHP 7.4.33)
 */
$adminTitle = '지역업체 관리';
require_once __DIR__ . '/includes/header.php';

// 지역 맵 정의
$areaMap = [
    '07' => 'best 용달',
    '08' => '1.4t / 2.5t / 5t',
    '09' => '탑차 (1t~5t)',
    '10' => '리프트차 (1t, 1.4t)',
    '11' => '서울 강남구', '12' => '서울 강동구', '13' => '서울 강서구', '14' => '서울 강북구', '15' => '서울 관악구',
    '16' => '서울 광진구', '17' => '서울 구로구', '18' => '서울 금천구', '19' => '서울 노원구', '20' => '서울 도봉구',
    '21' => '서울 동대문구', '22' => '서울 동작구', '23' => '서울 마포구', '24' => '서울 서대문구', '25' => '서울 서초구',
    '26' => '서울 성동구', '27' => '서울 성북구', '28' => '서울 송파구', '29' => '서울 양천구', '30' => '서울 영등포구',
    '31' => '서울 용산구', '32' => '서울 은평구', '33' => '서울 종로구', '34' => '서울 중구', '35' => '서울 중랑구',
    '36' => '경기 구리/남양주', '37' => '경기 군포/의왕', '38' => '경기 성남/분당', '39' => '경기 평택/송탄', '40' => '경기 수원/병점',
    '41' => '경기 안산/시흥', '42' => '경기 안양/과천', '43' => '경기 오산/동탄', '44' => '인천/부평', '45' => '경기 화성/발안',
    '46' => '경기 광명시', '47' => '경기 양주시', '48' => '경기 의정부시', '49' => '경기 포천시', '50' => '경기 광주시',
    '51' => '경기 고양시', '52' => '경기 김포시', '53' => '경기 부천시', '54' => '경기 용인시', '55' => '경기 파주시', '56' => '경기 하남시',
    '57' => '충남 천안시', '58' => '충북 충주시', '59' => '대전광역시', '60' => '전북 전주시', '61' => '광주광역시',
    '62' => '부산광역시', '63' => '울산광역시', '64' => '대구광역시', '65' => '강원 원주시', '66' => '강원 춘천시',
    '67' => '경북 포항시', '68' => '강원 강릉시', '69' => '경남 창원시', '71' => '경북 구미시', '77' => '경남 진주시',
    '79' => '경남 양산시', '80' => '세종특별자치시', '81' => '전북 군산시', '82' => '전남 순천시',
];

// 삭제 처리
$msg = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    $delId = trim($_POST['id'] ?? '');
    $delCode = trim($_POST['code'] ?? '');
    if ($delId !== '' && $delCode !== '') {
        $delOk = delete_company_item($delId, $delCode);
        if ($delOk) {
            $msg = '업체 정보가 성공적으로 삭제되었습니다.';
        } else {
            $error = '업체 삭제 처리 중 오류가 발생했습니다.';
        }
    }
}

// 검색 및 필터 파라미터
$filterArea = trim($_GET['area'] ?? '');
$keyword = trim($_GET['kw'] ?? '');
$page = max(1, (int)($_GET['p'] ?? 1));
$perPage = 15;

// 데이터 조회
$allList = get_company_admin_list($filterArea, $keyword);
$totalRows = count($allList);
$totalPages = max(1, (int)ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$pagedList = array_slice($allList, $offset, $perPage);

// 페이지네이션 블록 계산 (10페이지 단위)
$pageBlock = 10;
$startPage = (int)(floor(($page - 1) / $pageBlock) * $pageBlock) + 1;
$endPage = min($totalPages, $startPage + $pageBlock - 1);

$makePageUrl = function($p) use ($filterArea, $keyword) {
    $q = ['p' => $p];
    if ($filterArea !== '') $q['area'] = $filterArea;
    if ($keyword !== '') $q['kw'] = $keyword;
    return url('admin/company_list.php?' . http_build_query($q));
};
?>

<div class="ydk-admin-card">
  <div class="ydk-admin-card-header">
    <h1 class="ydk-admin-card-title">
      <i class="building outline icon"></i> 지역별 등록 업체 및 차주 관리
      <span style="font-size: 15px; font-weight: 500; color: var(--ydk-adm-muted); margin-left: 8px;">
        (총 <?= number_format($totalRows) ?>개)
      </span>
    </h1>
    <div style="display: flex; gap: 8px;">
      <a href="<?= url('admin/company_form.php') ?>" class="ui small primary button">
        <i class="plus icon"></i> 신규 업체 등록
      </a>
      <a href="<?= url('contents/company/company_list.php') ?>" target="_blank" class="ui small basic button">
        <i class="external alternate icon"></i> 사용자단 업체목록 보기
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

  <!-- 필터 및 검색창 -->
  <div class="ydk-filter-bar" style="margin-bottom: 20px;">
    <form class="ui form" method="get" action="<?= url('admin/company_list.php') ?>" style="display: flex; gap: 10px; width: 100%; flex-wrap: wrap;">
      <div style="min-width: 220px;">
        <select name="area" class="ui dropdown" onchange="this.form.submit();">
          <option value="">전체 지역/차종 보기</option>
          <?php foreach ($areaMap as $k => $name): ?>
            <option value="<?= e($k) ?>" <?= ($filterArea === (string)$k) ? 'selected' : '' ?>>
              [<?= e($k) ?>] <?= e($name) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div style="flex: 1; min-width: 200px; display: flex; gap: 6px;">
        <input type="text" name="kw" placeholder="상호명, 전화번호, 상세설명, 코드 검색..." value="<?= e($keyword) ?>">
        <button type="submit" class="ui primary button">검색</button>
        <?php if ($filterArea !== '' || $keyword !== ''): ?>
          <a href="<?= url('admin/company_list.php') ?>" class="ui basic button">초기화</a>
        <?php endif; ?>
      </div>
    </form>
  </div>

  <!-- 목록 테이블 -->
  <?php if (empty($pagedList)): ?>
    <div class="ui placeholder segment" style="padding: 50px; text-align: center;">
      <div class="ui icon header" style="color: var(--ydk-adm-muted);">
        <i class="inbox icon"></i>
        조건에 일치하는 등록 업체가 없습니다.
      </div>
    </div>
  <?php else: ?>
    <div style="overflow-x: auto;">
      <table class="ui celled table unstackable selectable ydk-adm-table">
        <thead>
          <tr>
            <th style="width: 70px; text-align: center;">ID</th>
            <th style="width: 140px;">관할 지역 / 차종</th>
            <th style="width: 110px; text-align: center;">지점코드</th>
            <th style="width: 170px;">상호명 (업체명)</th>
            <th style="width: 150px;">전화번호</th>
            <th>상세 설명 / 특기사항</th>
            <th style="width: 130px; text-align: center;">관리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pagedList as $row): 
            $rawId = $row['id'] ?? '';
            $rawCode = $row['code'] ?? '';
            $areaTitle = $areaMap[$rawId] ?? ('지역코드 ' . $rawId);

            // HTML 태그 정제
            $cleanName = trim(strip_tags($row['name'] ?? ''));
            $cleanTel = trim(strip_tags($row['tel'] ?? ''));
            $cleanDetail = trim(strip_tags($row['detail'] ?? ''));
            $telNum = preg_replace('/[^0-9]/', '', $cleanTel);
          ?>
            <tr>
              <td style="text-align: center; color: var(--ydk-adm-muted);"><?= e($rawId) ?></td>
              <td>
                <span class="ui blue mini label"><?= e($rawId) ?></span>
                <strong><?= e($areaTitle) ?></strong>
              </td>
              <td style="text-align: center;">
                <code style="background: #F1F5F9; padding: 2px 6px; border-radius: 4px; font-size: 13px;"><?= e($rawCode) ?></code>
              </td>
              <td><strong><?= e($cleanName ?: '(상호명 없음)') ?></strong></td>
              <td>
                <a href="tel:<?= e($telNum) ?>" style="color: #2563EB; font-weight: 600;">
                  <i class="phone icon"></i><?= e($cleanTel ?: '-') ?>
                </a>
              </td>
              <td style="color: #475569; font-size: 14px;"><?= e($cleanDetail ?: '-') ?></td>
              <td style="text-align: center;">
                <a href="<?= url('admin/company_form.php?id=' . urlencode($rawId) . '&code=' . urlencode($rawCode)) ?>" class="ui mini primary basic button">
                  수정
                </a>
                <form method="post" action="<?= url('admin/company_list.php') ?>" style="display: inline;" onsubmit="return confirm('정말 이 업체를 삭제하시겠습니까?');">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?= e($rawId) ?>">
                  <input type="hidden" name="code" value="<?= e($rawCode) ?>">
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
