<?php
/**
 * 용달코리아 v2-1 온라인 상담 신청 완료 페이지 (PHP 7.4.33, 반응형 웹)
 * 레거시 main/online_con_01.html 리뉴얼
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '온라인 상담 접수 완료 | ' . SITE_NAME . ' (1688-2404)';
$pageDescription = '용달코리아 온라인 상담 및 견적 문의 접수가 완료되었습니다. 전문 상담원이 신속히 확인 후 연락드리겠습니다.';

// 세션에서 접수 데이터 가져오기 (플래시 세션)
$consultSuccess = $_SESSION['consult_success'] ?? null;
$consultId = $_SESSION['consult_id'] ?? ('YDK-' . date('Ymd') . '-' . strtoupper(substr(md5(uniqid((string)mt_rand(), true)), 0, 4)));
$consultTime = $_SESSION['consult_time'] ?? date('Y년 m월 d일 H시 i분');

// 1회 확인 후 세션 데이터 정리 (단, 새로고침 시 화면 유지를 위해 consultId와 consultTime은 유지 가능)
if (isset($_SESSION['consult_success'])) {
    unset($_SESSION['consult_success']);
}

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <a href="<?= url('contents/online/contact_us.php') ?>">온라인 상담</a>
      <span class="divider">/</span>
      <span class="active">접수 완료</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="check circle outline icon" style="color: #059669;"></i> 온라인 상담 접수 완료
    </h1>
    <p class="ydk-page-desc">
      고객님의 화물 운송 및 이사 견적 문의가 정상적으로 접수되었습니다.
    </p>
  </header>

  <!-- 2. 완료 안내 히어로 카드 -->
  <section class="ui segment" style="border-radius: 12px; padding: 36px 24px; text-align: center; background: #FFFFFF; border: 1px solid var(--ydk-border-light); border-top: 4px solid #059669; box-shadow: 0 4px 14px rgba(0,0,0,0.05); margin-bottom: 28px;">
    <div style="width: 72px; height: 72px; background: #ECFDF5; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 18px;">
      <i class="check icon massive" style="color: #059669; font-size: 36px; margin: 0;"></i>
    </div>
    
    <h2 style="font-size: 24px; font-weight: 800; color: #064E3B; margin: 0 0 10px 0;">
      온라인 상담 및 견적 신청이 정상 접수되었습니다!
    </h2>
    
    <p style="font-size: 16px; color: #475569; line-height: 1.7; max-width: 680px; margin: 0 auto 20px auto;">
      소중한 문의를 남겨주셔서 대단히 감사드립니다.<br>
      접수해 주신 내용은 전담 배차팀에서 실시간 검토 중이며, 남겨주신 연락처로 <strong>빠른 시간 내에 최적의 운임과 배차 일정</strong>을 안내해 드리겠습니다.
    </p>

    <!-- 접수 식별 번호 및 일시 뱃지 -->
    <div style="display: inline-flex; flex-wrap: wrap; justify-content: center; gap: 12px; background: #F8FAFC; border: 1px solid #E2E8F0; padding: 10px 20px; border-radius: 8px;">
      <div style="font-size: 14px; color: #334155;">
        <strong>접수 번호 :</strong> <span style="color: #2563EB; font-weight: 700;"><?= e($consultId) ?></span>
      </div>
      <span style="color: #CBD5E1;">|</span>
      <div style="font-size: 14px; color: #334155;">
        <strong>접수 일시 :</strong> <span><?= e($consultTime) ?></span>
      </div>
    </div>
  </section>

  <!-- 3. 상세 접수 내역 (신청 데이터가 있을 경우 렌더링) -->
  <?php if (!empty($consultSuccess)): ?>
    <section class="ui segment" style="border-radius: 12px; padding: 24px; background: #FFFFFF; border: 1px solid var(--ydk-border-light); box-shadow: 0 2px 8px rgba(0,0,0,0.03); margin-bottom: 28px;">
      <h3 style="font-size: 17px; font-weight: 800; color: var(--ydk-primary-dark); margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
        <i class="clipboard list icon" style="color: var(--ydk-primary);"></i> 신청하신 견적 상담 내용 요약
      </h3>

      <div class="ui responsive table-wrapper" style="overflow-x: auto;">
        <table class="ui celled structured unstackable table" style="border-radius: 8px; font-size: 15px;">
          <tbody>
            <tr>
              <th scope="row" style="width: 140px; background: #F8FAFC; color: #475569; font-weight: 700;">성명 / 상호명</th>
              <td style="color: #1E293B; font-weight: 600;"><?= e($consultSuccess['name'] ?? '-') ?></td>
              <th scope="row" style="width: 140px; background: #F8FAFC; color: #475569; font-weight: 700;">연락처</th>
              <td style="color: #2563EB; font-weight: 700;"><?= e($consultSuccess['tel'] ?? '-') ?></td>
            </tr>
            <tr>
              <th scope="row" style="background: #F8FAFC; color: #475569; font-weight: 700;">이메일</th>
              <td><?= e(!empty($consultSuccess['email']) ? $consultSuccess['email'] : '미입력') ?></td>
              <th scope="row" style="background: #F8FAFC; color: #475569; font-weight: 700;">희망 운송일</th>
              <td style="color: #059669; font-weight: 600;"><?= e(!empty($consultSuccess['move_date']) ? $consultSuccess['move_date'] : '상담 후 결정') ?></td>
            </tr>
            <tr>
              <th scope="row" style="background: #F8FAFC; color: #475569; font-weight: 700;">신청 차종</th>
              <td colspan="3"><?= e(!empty($consultSuccess['car_type']) ? $consultSuccess['car_type'] : '미지정 (상담 후 추천)') ?></td>
            </tr>
            <tr>
              <th scope="row" style="background: #F8FAFC; color: #475569; font-weight: 700;">운송 구간</th>
              <td colspan="3">
                <span style="color: #1E293B; font-weight: 600;">[출발] <?= e($consultSuccess['start_area'] ?? '-') ?></span>
                <i class="arrow right icon" style="color: #94A3B8; margin: 0 8px;"></i>
                <span style="color: #C2410C; font-weight: 700;">[도착] <?= e($consultSuccess['end_area'] ?? '-') ?></span>
              </td>
            </tr>
            <tr>
              <th scope="row" style="background: #F8FAFC; color: #475569; font-weight: 700; vertical-align: top;">상담 및 화물 내용</th>
              <td colspan="3" style="color: #334155; line-height: 1.7; white-space: pre-line;"><?= e($consultSuccess['story'] ?? '-') ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  <?php endif; ?>

  <!-- 4. 접수 후 진행 절차 3단계 안내 -->
  <section class="ui segment" style="border-radius: 12px; padding: 24px; background: #FFFFFF; border: 1px solid var(--ydk-border-light); box-shadow: 0 2px 8px rgba(0,0,0,0.03); margin-bottom: 28px;">
    <h3 style="font-size: 17px; font-weight: 800; color: #1E293B; margin: 0 0 18px 0; display: flex; align-items: center; gap: 8px;">
      <i class="tasks icon" style="color: var(--ydk-primary);"></i> 상담 신청 후 향후 진행 절차
    </h3>

    <div class="ui three column stackable grid" style="margin: 0;">
      <div class="column" style="padding: 10px;">
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 18px; height: 100%; border-left: 4px solid #059669;">
          <div style="font-size: 12px; font-weight: 700; color: #059669; margin-bottom: 4px;">STEP 01 (완료)</div>
          <div style="font-size: 16px; font-weight: 800; color: #1E293B; margin-bottom: 6px;">실시간 접수 및 전담 배정</div>
          <div style="font-size: 13px; color: #64748B; line-height: 1.5;">
            고객님의 견적 문의가 안전하게 접수되어 해당 지역 배차 담당자에게 즉시 전달되었습니다.
          </div>
        </div>
      </div>

      <div class="column" style="padding: 10px;">
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 18px; height: 100%; border-left: 4px solid #2563EB;">
          <div style="font-size: 12px; font-weight: 700; color: #2563EB; margin-bottom: 4px;">STEP 02 (진행 예정)</div>
          <div style="font-size: 16px; font-weight: 800; color: #1E293B; margin-bottom: 6px;">유선 해피콜 & 운임 안내</div>
          <div style="font-size: 13px; color: #64748B; line-height: 1.5;">
            거리, 층수, 작업 조건을 정밀 확인한 후 가장 경제적인 맞춤 운임을 전화로 안내해 드립니다.
          </div>
        </div>
      </div>

      <div class="column" style="padding: 10px;">
        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 18px; height: 100%; border-left: 4px solid #D97706;">
          <div style="font-size: 12px; font-weight: 700; color: #D97706; margin-bottom: 4px;">STEP 03</div>
          <div style="font-size: 16px; font-weight: 800; color: #1E293B; margin-bottom: 6px;">배차 확정 & 안전 운송</div>
          <div style="font-size: 13px; color: #64748B; line-height: 1.5;">
            견적 승인 시 지정된 날짜·시간에 베테랑 차주가 현장에 도착하여 책임 운송을 완료합니다.
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. 빠른 유선 상담 안내 (레거시 main/online_con_01.html 계승) -->
  <section class="ui message" style="background: #FEF2F2; border: 1px solid #FECACA; border-radius: 10px; padding: 20px 24px; margin-bottom: 32px;">
    <div style="display: flex; align-items: flex-start; gap: 14px;">
      <i class="phone volume icon" style="font-size: 26px; color: #DC2626; margin-top: 2px;"></i>
      <div style="flex: 1;">
        <div style="font-size: 17px; font-weight: 800; color: #991B1B; margin-bottom: 6px;">
          급하신 용무이거나 1시간 이내 빠른 배차 안내가 필요하신가요?
        </div>
        <p style="font-size: 14px; color: #7F1D1D; line-height: 1.6; margin: 0 0 10px 0;">
          온라인 접수 후 <strong>1시간 이내에 연락이 없거나</strong>, 당일 즉시 운송이 필요한 급한 건은 대표번호로 직접 연락 주시면 즉시 상담원이 연결되어 가장 빠르게 처리해 드립니다.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center;">
          <a href="tel:16882404" class="ui red mini button" style="font-weight: 700; font-size: 14px; padding: 8px 14px;">
            <i class="phone icon"></i> 대표번호 1688-2404
          </a>
          <a href="tel:16882407" class="ui basic red mini button" style="font-weight: 700; font-size: 14px; padding: 8px 14px;">
            <i class="phone icon"></i> 상담직통 1688-2407
          </a>
          <span style="font-size: 13px; color: #991B1B;">(야간 및 공휴일 24시간 당직 상담 운영)</span>
        </div>
      </div>
    </div>
  </section>

  <!-- 6. 하단 바로가기 버튼 그룹 -->
  <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 14px; margin-bottom: 40px;">
    <a href="<?= url() ?>" class="ui button" style="background: var(--ydk-primary); color: #FFFFFF; font-size: 16px; font-weight: 700; padding: 14px 28px; border-radius: 8px;">
      <i class="home icon"></i> 메인 화면으로 이동
    </a>
    <a href="<?= url('contents/online/contact_us.php') ?>" class="ui basic button" style="font-size: 16px; font-weight: 700; padding: 14px 24px; border-radius: 8px; color: #334155;">
      <i class="edit icon"></i> 추가 문의 작성하기
    </a>
    <a href="<?= url('contents/trt/trt.php') ?>" class="ui basic button" style="font-size: 16px; font-weight: 700; padding: 14px 24px; border-radius: 8px; color: #334155;">
      <i class="table icon"></i> 운송 요금표 확인하기
    </a>
  </div>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
