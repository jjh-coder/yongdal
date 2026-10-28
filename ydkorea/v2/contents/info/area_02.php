<?php
/**
 * 용달코리아 v2-1 전국 광역시 및 주요 거점 차량 안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_02.html
 * 대상 경로: v2-1/contents/info/area_02.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '전국 광역시 및 주요 거점 지역 차량 안내 | ' . SITE_NAME;
$pageDescription = '전국 광역시(부산, 대구, 인천, 광주, 대전, 울산) 및 주요 지방 거점 차주 직거래 안내. 지방 장거리 화물 및 리턴공차 알선.';

// 전국 광역시 및 주요 거점 14개 지역
$metroDistricts = [
    ['id' => '57', 'name' => '충남 천안시', 'badge' => '충청권', 'desc' => '천안·아산 전 지역 즉시 배차'],
    ['id' => '58', 'name' => '충북 충주시', 'badge' => '충청권', 'desc' => '충주·제천·음성 충북 내륙'],
    ['id' => '59', 'name' => '대전광역시', 'badge' => '광역시', 'desc' => '대전 전 지역 및 세종·공주 연계'],
    ['id' => '60', 'name' => '전북 전주시', 'badge' => '호남권', 'desc' => '전주·완주·익산·군산 거점'],
    ['id' => '61', 'name' => '광주광역시', 'badge' => '광역시', 'desc' => '광주 전 지역 및 나주·담양'],
    ['id' => '62', 'name' => '부산광역시', 'badge' => '광역시', 'desc' => '부산 전 지역 및 김해·양산'],
    ['id' => '63', 'name' => '울산광역시', 'badge' => '광역시', 'desc' => '울산 전 지역 및 온산 공단'],
    ['id' => '64', 'name' => '대구광역시', 'badge' => '광역시', 'desc' => '대구 전 지역 및 경산·칠곡'],
    ['id' => '65', 'name' => '강원 원주시', 'badge' => '강원권', 'desc' => '원주 혁신도시 및 영서 거점'],
    ['id' => '66', 'name' => '강원 춘천시', 'badge' => '강원권', 'desc' => '춘천·홍천·가평 영서 북부'],
    ['id' => '67', 'name' => '경북 포항시', 'badge' => '영남권', 'desc' => '포항 철강공단 및 경주'],
    ['id' => '68', 'name' => '강원 강릉시', 'badge' => '강원권', 'desc' => '강릉·동해·삼척 영동 거점'],
    ['id' => '69', 'name' => '경남 창원시', 'badge' => '영남권', 'desc' => '창원·마산·진해 공단 배차'],
    ['id' => '71', 'name' => '경북 구미시', 'badge' => '영남권', 'desc' => '구미 국가산단 및 김천'],
];

// 서울/경기 주요 지역 바로가기
$capitalDistricts = [
    ['id' => '11', 'name' => '서울 강남'],
    ['id' => '25', 'name' => '서울 서초'],
    ['id' => '28', 'name' => '서울 송파'],
    ['id' => '23', 'name' => '서울 마포'],
    ['id' => '13', 'name' => '서울 강서'],
    ['id' => '26', 'name' => '서울 성동'],
    ['id' => '40', 'name' => '수원·병점'],
    ['id' => '38', 'name' => '성남·분당'],
    ['id' => '51', 'name' => '고양·일산'],
    ['id' => '44', 'name' => '인천·부평'],
    ['id' => '54', 'name' => '경기 용인'],
    ['id' => '39', 'name' => '평택·송탄'],
];

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <a href="<?= url('contents/company/company_list.php') ?>">지역별 업체 안내</a>
      <span class="divider">/</span>
      <span class="active">전국 광역시 및 거점 도시</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="map signs icon"></i> 전국 광역시 및 주요 거점 차량 안내
    </h1>
    <p class="ydk-page-desc">
      전국 6대 광역시 및 각 도의 핵심 거점 도시 차주와 직접 연결되어 전국 어디든 안심 운송을 지원합니다.
    </p>
  </header>

  <!-- 2. 상단 안내 배너 (지방 화물 & 리턴공차 혜택) -->
  <div class="ui icon message info-hero-banner" style="background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%); border: 1px solid #a7f3d0; border-radius: 12px; margin-bottom: 28px;">
    <i class="road icon" style="color: #059669;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #065f46; margin-bottom: 6px;">
        전국 광역시 직거래 및 지방 복귀차량(리턴공차) 알선
      </div>
      <p style="color: #2c3e50; line-height: 1.6; margin: 0;">
        수도권에서 지방으로 내려간 차량이나, 지방에서 상경 후 복귀를 위해 대기 중인 <strong>리턴공차</strong>를 연계하시면 
        최대 30~50% 저렴한 알뜰 운임으로 장거리 화물 및 이사를 해결하실 수 있습니다.
      </p>
    </div>
  </div>

  <!-- 3. 권역 탭 네비게이션 -->
  <div class="ui secondary pointing menu area-nav-menu" style="margin-bottom: 24px; border-bottom: 2px solid #e0e0e0;">
    <a class="item" style="font-weight: 600; font-size: 1.05rem;" href="<?= url('contents/info/area_01.php') ?>">
      <i class="map marker alternate icon"></i> 서울·경기 권역
    </a>
    <a class="active item" style="font-weight: 700; font-size: 1.05rem;" href="<?= url('contents/info/area_02.php') ?>">
      <i class="map signs icon"></i> 전국 광역시 권역
    </a>
    <a class="item" style="font-weight: 600; font-size: 1.05rem;" href="<?= url('contents/info/car_list_03.php') ?>">
      <i class="road icon"></i> 지방화물·리턴공차 안내
    </a>
  </div>

  <!-- 4. 광역시/거점도시 카드 그리드 -->
  <div class="ui segment" style="border-radius: 12px; padding: 24px; border-top: 4px solid #059669; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 28px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">
      <h2 style="font-size: 1.25rem; margin: 0; color: #064e3b;">
        <i class="map marked alternate icon" style="color: #059669;"></i> 전국 주요 광역시 및 지방 거점 도시 차주 리스트
      </h2>
      <span style="font-size: 0.9rem; color: #666;">도시를 선택하시면 상세 차주 연락처와 배차 현황을 확인하실 수 있습니다.</span>
    </div>

    <div class="ui three column doubling stackable grid">
      <?php foreach ($metroDistricts as $m): ?>
        <div class="column" style="padding: 10px;">
          <div class="ui fluid card metro-card" style="border-radius: 10px; border: 1px solid #e5e7eb; transition: all 0.25s ease; box-shadow: 0 2px 6px rgba(0,0,0,0.04);">
            <div class="content" style="padding: 18px 20px;">
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <span class="ui small label" style="background-color: #ecfdf5; color: #065f46; font-weight: 700;">
                  <?= e($m['badge']) ?>
                </span>
                <span style="font-size: 0.85rem; color: #9ca3af;"><i class="truck icon"></i> 상시대기</span>
              </div>
              <h3 style="font-size: 1.2rem; margin: 0 0 6px 0; color: #111827;">
                <?= e($m['name']) ?>
              </h3>
              <p style="font-size: 0.9rem; color: #4b5563; margin-bottom: 14px; line-height: 1.4;">
                <?= e($m['desc']) ?>
              </p>
              <a href="<?= url('contents/company/company_list.php?id=' . $m['id']) ?>" class="ui fluid basic teal button" style="border-radius: 6px; font-weight: 600;">
                차주 리스트 확인 <i class="arrow right icon"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- 5. 수도권(서울·경기) 빠른 이동 박스 -->
  <div class="ui segment secondary" style="border-radius: 12px; padding: 20px; background: #f8fafc; border: 1px dashed #cbd5e1; margin-bottom: 28px;">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; margin-bottom: 12px;">
      <h3 style="font-size: 1.1rem; margin: 0; color: #1e293b;">
        <i class="exchange alternate icon"></i> 수도권 (서울·경기) 주요 지역 바로가기
      </h3>
      <a href="<?= url('contents/info/area_01.php') ?>" style="font-size: 0.9rem; font-weight: 600; color: #0070ba;">
        수도권 전체 구/시 보기 <i class="angle right icon"></i>
      </a>
    </div>
    <div class="ui six column doubling grid">
      <?php foreach ($capitalDistricts as $c): ?>
        <div class="column" style="padding: 4px;">
          <a href="<?= url('contents/company/company_list.php?id=' . $c['id']) ?>" class="ui small fluid basic grey button" style="padding: 8px 4px; font-weight: 600; text-align: center;">
            <?= e($c['name']) ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- 6. 지방 장거리 화물 및 알선 프로세스 -->
  <div class="ui two column doubling stackable grid" style="margin-bottom: 10px;">
    <div class="column">
      <div class="ui segment" style="border-radius: 12px; padding: 22px; height: 100%;">
        <h3 style="color: #0369a1; font-size: 1.15rem; margin-top: 0; margin-bottom: 12px;">
          <i class="shipping fast icon"></i> 지방 장거리 화물 운송 핵심 팁
        </h3>
        <ul class="ui list" style="line-height: 1.8; color: #334155; font-size: 0.95rem;">
          <li><strong>사전 예약 권장:</strong> 1~2일 전 사전 예약 시 가장 유리한 조건의 복귀차량과 매칭됩니다.</li>
          <li><strong>상차 전 필수 확인:</strong> 배차된 기사의 차량번호, 연락처, 차고지를 필히 확인하십시오.</li>
          <li><strong>혼적(합바짐) 활용:</strong> 짐이 적은 소형 화물은 합바짐으로 운송 시 운임이 절반 수준으로 절약됩니다.</li>
          <li><strong>관허 주선업체 이용:</strong> 용달코리아는 관허 4-42호 등록 정식 운송주선 네트워크입니다.</li>
        </ul>
      </div>
    </div>
    <div class="column">
      <div class="ui segment" style="border-radius: 12px; padding: 22px; height: 100%;">
        <h3 style="color: #7c2d12; font-size: 1.15rem; margin-top: 0; margin-bottom: 12px;">
          <i class="calendar check icon"></i> 예약 변경 및 취소 안내
        </h3>
        <ul class="ui list" style="line-height: 1.8; color: #334155; font-size: 0.95rem;">
          <li><strong>일정 변경:</strong> 날짜 및 시간 변경은 원활한 재배차를 위해 최소 1일 전 연락 주시기 바랍니다.</li>
          <li><strong>긴급 시간 변경:</strong> 당일 불가피한 시간 변경은 최소 2시간 전에 통보해 주셔야 합니다.</li>
          <li><strong>중복 예약 금지:</strong> 타 업체와의 이중 중복 예약은 차주 피해 및 위약금이 발생할 수 있으니 주의바랍니다.</li>
          <li><strong>도서산간/제주 운송:</strong> 연륙교 및 카페리 선적 일정 조율이 필요하므로 사전 상담 필수입니다.</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- 7. 마무리 CTA -->
  <section class="ydk-bottom-cta" style="margin-top: 36px; padding: 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
    <h3 style="font-size: 1.3rem; color: #1e293b; margin-bottom: 8px;">
      전국 지방화물·리턴공차 24시간 실시간 상담
    </h3>
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 18px;">
      전국 광역시 간 직행 운송부터 제주도 화물까지 친절하고 투명한 상담을 약속드립니다.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge primary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="phone icon"></i> 대표전화 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge secondary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="edit outline icon"></i> 온라인 상담 접수
      </a>
    </div>
  </section>

</main>

<style>
.metro-card:hover {
  transform: translateY(-4px);
  border-color: #059669 !important;
  box-shadow: 0 8px 18px rgba(5, 150, 105, 0.12) !important;
}
</style>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
