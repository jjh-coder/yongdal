<?php
/**
 * 용달코리아 v2-1 관리자 통합 대시보드 (PHP 7.4.33)
 */
$adminTitle = '대시보드';
require_once __DIR__ . '/includes/header.php';

// 전체 상담 데이터 조회
$allConsults = get_consult_list();
$totalConsultCount = count($allConsults);
$countNewConsult = 0;
$countIngConsult = 0;
$countDoneConsult = 0;

foreach ($allConsults as $c) {
    $st = $c['status'] ?? '접수';
    if ($st === '접수') $countNewConsult++;
    elseif ($st === '상담중') $countIngConsult++;
    elseif ($st === '배차완료') $countDoneConsult++;
}

// 전체 차주회원 데이터 조회
$allClubs = get_club_list();
$totalClubCount = count($allClubs);
$countNewClub = 0;
$countApprovedClub = 0;

foreach ($allClubs as $m) {
    $st = $m['status'] ?? '신청';
    if ($st === '신청') $countNewClub++;
    elseif ($st === '승인') $countApprovedClub++;
}

// 최근 내역 슬라이스
$recentConsults = array_slice($allConsults, 0, 5);
$recentClubs = array_slice($allClubs, 0, 5);
$totalCompanyCount = count(get_company_admin_list());

// 공지사항 및 Q&A 카운트
$allNotices = get_notice_list();
$totalNoticeCount = count($allNotices);

$allQas = get_qa_list();
$totalQaCount = count($allQas);
$countPendingQa = 0;
foreach ($allQas as $q) {
    if (($q['status'] ?? '접수') === '접수') {
        $countPendingQa++;
    }
}
?>

<!-- 상단 관리자 바로가기 헤더 -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
  <div style="font-size: 14px; color: var(--ydk-adm-muted); display: flex; gap: 14px; flex-wrap: wrap;">
    <span>지역 업체: <strong style="color: var(--ydk-adm-primary);"><?= number_format($totalCompanyCount) ?></strong>개</span>
    <span>공지사항: <strong style="color: #2563EB;"><?= number_format($totalNoticeCount) ?></strong>건</span>
    <span>묻고답하기: <strong style="color: #D97706;"><?= number_format($totalQaCount) ?></strong>건 (답변대기 <?= $countPendingQa ?>건)</span>
  </div>
  <div style="display: flex; gap: 8px; flex-wrap: wrap;">
    <a href="<?= url('admin/notice_list.php') ?>" class="ui small basic button">
      <i class="bullhorn icon"></i> 공지사항 관리
    </a>
    <a href="<?= url('admin/qa_list.php') ?>" class="ui small button" style="background: #2563EB; color: #FFF; font-weight: 700;">
      <i class="comments icon"></i> 묻고답하기 관리 <?= $countPendingQa > 0 ? "({$countPendingQa})" : '' ?>
    </a>
    <a href="<?= url('admin/company_list.php') ?>" class="ui small button" style="background: #0F766E; color: #FFF; font-weight: 700;">
      <i class="building outline icon"></i> 지역업체 관리
    </a>
  </div>
</div>

<!-- 1. 통계 요약 카드 4개 -->
<section class="ydk-stat-grid" aria-label="운영 현황 요약">
  <!-- 온라인 상담 총합 -->
  <div class="ydk-stat-card primary">
    <div>
      <div class="ydk-stat-label">온라인 상담 신청</div>
      <div class="ydk-stat-val"><?= number_format($totalConsultCount) ?><span style="font-size: 16px; font-weight: 500;">건</span></div>
      <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 4px;">
        신규 대기: <strong style="color: #D97706;"><?= $countNewConsult ?></strong>건 | 완료: <strong style="color: #059669;"><?= $countDoneConsult ?></strong>건
      </div>
    </div>
    <div class="ydk-stat-icon" style="color: var(--ydk-adm-primary);">
      <i class="comments outline icon"></i>
    </div>
  </div>

  <!-- 상담 신규 대기 -->
  <div class="ydk-stat-card warning">
    <div>
      <div class="ydk-stat-label">상담 접수 대기</div>
      <div class="ydk-stat-val" style="color: #D97706;"><?= number_format($countNewConsult) ?><span style="font-size: 16px; font-weight: 500;">건</span></div>
      <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 4px;">
        상담 진행중: <strong><?= $countIngConsult ?></strong>건
      </div>
    </div>
    <div class="ydk-stat-icon" style="color: #D97706;">
      <i class="bell outline icon"></i>
    </div>
  </div>

  <!-- 차주회원 전체 -->
  <div class="ydk-stat-card success">
    <div>
      <div class="ydk-stat-label">차주회원 신청 총계</div>
      <div class="ydk-stat-val" style="color: #059669;"><?= number_format($totalClubCount) ?><span style="font-size: 16px; font-weight: 500;">명</span></div>
      <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 4px;">
        정회원 승인: <strong style="color: #059669;"><?= $countApprovedClub ?></strong>명
      </div>
    </div>
    <div class="ydk-stat-icon" style="color: #059669;">
      <i class="truck icon"></i>
    </div>
  </div>

  <!-- 차주회원 신규 신청 대기 -->
  <div class="ydk-stat-card info">
    <div>
      <div class="ydk-stat-label">차주 가입 대기</div>
      <div class="ydk-stat-val" style="color: #2563EB;"><?= number_format($countNewClub) ?><span style="font-size: 16px; font-weight: 500;">건</span></div>
      <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 4px;">
        입금 확인 및 등록 필요
      </div>
    </div>
    <div class="ydk-stat-icon" style="color: #2563EB;">
      <i class="id card outline icon"></i>
    </div>
  </div>
</section>

<!-- 2. 최근 차주회원 가입 신청 내역 (신규) -->
<section class="ydk-admin-card" aria-label="최근 차주회원 신청 내역" style="margin-bottom: 24px;">
  <div class="ydk-admin-card-header">
    <h2 class="ydk-admin-card-title">
      <i class="truck icon" style="color: var(--ydk-adm-primary);"></i> 최근 차주회원 가입 신청 내역
    </h2>
    <a href="<?= url('admin/club_list.php') ?>" class="ui small primary button">
      전체 차주회원 관리 <i class="angle right icon"></i>
    </a>
  </div>

  <?php if (empty($recentClubs)): ?>
    <div class="ui placeholder segment" style="padding: 30px; text-align: center;">
      <div class="ui icon header" style="color: var(--ydk-adm-muted);">
        <i class="inbox icon"></i>
        신청된 차주회원 내역이 없습니다.
      </div>
    </div>
  <?php else: ?>
    <div style="overflow-x: auto;">
      <table class="ui celled table unstackable selectable ydk-adm-table">
        <thead>
          <tr>
            <th style="width: 65px; text-align: center;">번호</th>
            <th style="width: 90px; text-align: center;">상태</th>
            <th style="width: 120px;">차주성명</th>
            <th style="width: 130px;">상호</th>
            <th style="width: 140px;">휴대폰</th>
            <th style="width: 120px;">차종</th>
            <th style="width: 130px;">차량번호</th>
            <th>활동지역</th>
            <th style="width: 120px; text-align: center;">신청일시</th>
            <th style="width: 75px; text-align: center;">관리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentClubs as $row): 
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
                  <?= e($row['hp']) ?>
                </a>
              </td>
              <td><?= e($row['car']) ?></td>
              <td><?= e($row['car_no']) ?></td>
              <td><?= e($row['ad']) ?></td>
              <td style="text-align: center; color: var(--ydk-adm-muted); font-size: 13px;">
                <?= e(date('m/d H:i', strtotime($row['created_at']))) ?>
              </td>
              <td style="text-align: center;">
                <a href="<?= url('admin/club_view.php?id=' . (int)$row['id']) ?>" class="ui mini basic button">
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

<!-- 3. 최근 온라인 상담 5건 목록 -->
<section class="ydk-admin-card" aria-label="최근 온라인 상담 신청 내역">
  <div class="ydk-admin-card-header">
    <h2 class="ydk-admin-card-title">
      <i class="clock outline icon"></i> 최근 온라인 상담 접수 내역
    </h2>
    <a href="<?= url('admin/consult_list.php') ?>" class="ui small primary button">
      전체 상담 내역 보기 <i class="angle right icon"></i>
    </a>
  </div>

  <?php if (empty($recentConsults)): ?>
    <div class="ui placeholder segment" style="padding: 30px; text-align: center;">
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
            <th style="width: 65px; text-align: center;">번호</th>
            <th style="width: 90px; text-align: center;">상태</th>
            <th style="width: 110px;">고객명</th>
            <th style="width: 140px;">연락처</th>
            <th style="width: 110px;">희망차종</th>
            <th>출발지 → 도착지</th>
            <th style="width: 110px; text-align: center;">운송희망일</th>
            <th style="width: 120px; text-align: center;">신청일시</th>
            <th style="width: 75px; text-align: center;">관리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentConsults as $row): 
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
