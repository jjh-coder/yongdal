<?php
/**
 * 용달코리아 v2 관리자 대시보드 (PHP 7.4.33)
 */
$adminTitle = '대시보드';
require_once __DIR__ . '/includes/header.php';

// 전체 상담 데이터 조회
$allConsults = get_consult_list();

// 상태별 카운트 계산
$totalCount = count($allConsults);
$countNew = 0;      // 접수 (대기)
$countIng = 0;      // 상담중
$countDone = 0;     // 배차완료
$countCancel = 0;   // 취소

foreach ($allConsults as $c) {
    $st = $c['status'] ?? '접수';
    if ($st === '접수') $countNew++;
    elseif ($st === '상담중') $countIng++;
    elseif ($st === '배차완료') $countDone++;
    elseif ($st === '취소') $countCancel++;
}

// 최근 10건
$recentList = array_slice($allConsults, 0, 10);
?>

<!-- 1. 통계 요약 카드 4개 -->
<section class="ydk-stat-grid" aria-label="상담 처리 현황 요약">
  <div class="ydk-stat-card primary">
    <div>
      <div class="ydk-stat-label">전체 접수 건수</div>
      <div class="ydk-stat-val"><?= number_format($totalCount) ?><span style="font-size: 16px; font-weight: 500;">건</span></div>
    </div>
    <div class="ydk-stat-icon" style="color: var(--ydk-adm-primary);">
      <i class="folder open outline icon"></i>
    </div>
  </div>

  <div class="ydk-stat-card warning">
    <div>
      <div class="ydk-stat-label">신규 대기 (접수)</div>
      <div class="ydk-stat-val" style="color: #D97706;"><?= number_format($countNew) ?><span style="font-size: 16px; font-weight: 500;">건</span></div>
    </div>
    <div class="ydk-stat-icon" style="color: #D97706;">
      <i class="bell outline icon"></i>
    </div>
  </div>

  <div class="ydk-stat-card info">
    <div>
      <div class="ydk-stat-label">상담 진행 중</div>
      <div class="ydk-stat-val" style="color: #2563EB;"><?= number_format($countIng) ?><span style="font-size: 16px; font-weight: 500;">건</span></div>
    </div>
    <div class="ydk-stat-icon" style="color: #2563EB;">
      <i class="phone volume icon"></i>
    </div>
  </div>

  <div class="ydk-stat-card success">
    <div>
      <div class="ydk-stat-label">배차 완료 건수</div>
      <div class="ydk-stat-val" style="color: #059669;"><?= number_format($countDone) ?><span style="font-size: 16px; font-weight: 500;">건</span></div>
    </div>
    <div class="ydk-stat-icon" style="color: #059669;">
      <i class="check circle outline icon"></i>
    </div>
  </div>
</section>

<!-- 2. 최근 온라인 상담 10건 목록 -->
<section class="ydk-admin-card" aria-label="최근 온라인 상담 신청 내역">
  <div class="ydk-admin-card-header">
    <h2 class="ydk-admin-card-title">
      <i class="clock outline icon"></i> 최근 온라인 상담 접수 내역
    </h2>
    <a href="<?= url('admin/consult_list.php') ?>" class="ui small primary button">
      전체 상담 내역 보기 <i class="angle right icon"></i>
    </a>
  </div>

  <?php if (empty($recentList)): ?>
    <div class="ui placeholder segment" style="padding: 40px; text-align: center;">
      <div class="ui icon header" style="color: var(--ydk-adm-muted);">
        <i class="inbox icon"></i>
        접수된 온라인 상담 내역이 없습니다.
      </div>
    </div>
  <?php else: ?>
    <div style="overflow-x: auto;">
      <table class="ui celled table unstackable selectable ydk-adm-table">
        <thead>
          <tr>
            <th style="width: 70px; text-align: center;">번호</th>
            <th style="width: 100px; text-align: center;">상태</th>
            <th style="width: 110px;">고객명</th>
            <th style="width: 140px;">연락처</th>
            <th style="width: 110px;">희망차종</th>
            <th>출발지 → 도착지</th>
            <th style="width: 110px; text-align: center;">운송희망일</th>
            <th style="width: 150px; text-align: center;">신청일시</th>
            <th style="width: 90px; text-align: center;">관리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentList as $row): 
            $st = $row['status'] ?? '접수';
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
            $carName = $carTypes[$row['car_type']] ?? ($row['car_type'] ?: '상담후결정');
          ?>
            <tr>
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
                <span style="color: var(--ydk-adm-text);">
                  <?= e($row['start_area'] ?: '미지정') ?>
                </span>
                <i class="arrow right small icon" style="color: var(--ydk-adm-muted); margin: 0 4px;"></i>
                <span style="color: var(--ydk-adm-text);">
                  <?= e($row['end_area'] ?: '미지정') ?>
                </span>
              </td>
              <td style="text-align: center;"><?= e($row['move_date'] ?: '-') ?></td>
              <td style="text-align: center; color: var(--ydk-adm-muted); font-size: 13px;">
                <?= e(date('m/d H:i', strtotime($row['created_at']))) ?>
              </td>
              <td style="text-align: center;">
                <a href="<?= url('admin/consult_view.php?id=' . (int)$row['id']) ?>" class="ui mini basic button">
                  상세
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
