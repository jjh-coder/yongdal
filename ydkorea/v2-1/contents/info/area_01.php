<?php
/**
 * 용달코리아 v2-1 지역 차량 (서울·경기) 안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_01.html
 * 대상 경로: v2-1/contents/info/area_01.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '수도권 지역 차량 (서울·경기) 차주 직거래 안내 | ' . SITE_NAME;
$pageDescription = '서울 25개 자치구 및 경기도 주요 시·군 지역 차주 직거래 연결. 1톤 용달, 탑차, 리프트차, 당일 즉시 배차 및 저렴한 운송비 지원.';

// 서울 25개 자치구
$seoulDistricts = [
    ['id' => '11', 'name' => '강남구'],
    ['id' => '12', 'name' => '강동구'],
    ['id' => '13', 'name' => '강서구'],
    ['id' => '14', 'name' => '강북구'],
    ['id' => '15', 'name' => '관악구'],
    ['id' => '16', 'name' => '광진구'],
    ['id' => '17', 'name' => '구로구'],
    ['id' => '18', 'name' => '금천구'],
    ['id' => '19', 'name' => '노원구'],
    ['id' => '20', 'name' => '도봉구'],
    ['id' => '21', 'name' => '동대문구'],
    ['id' => '22', 'name' => '동작구'],
    ['id' => '23', 'name' => '마포구'],
    ['id' => '24', 'name' => '서대문구'],
    ['id' => '25', 'name' => '서초구'],
    ['id' => '26', 'name' => '성동구'],
    ['id' => '27', 'name' => '성북구'],
    ['id' => '28', 'name' => '송파구'],
    ['id' => '29', 'name' => '양천구'],
    ['id' => '30', 'name' => '영등포구'],
    ['id' => '31', 'name' => '용산구'],
    ['id' => '32', 'name' => '은평구'],
    ['id' => '33', 'name' => '종로구'],
    ['id' => '34', 'name' => '중구'],
    ['id' => '35', 'name' => '중랑구'],
];

// 경기/인천 주요 21개 지역
$gyeonggiDistricts = [
    ['id' => '36', 'name' => '구리 / 남양주'],
    ['id' => '37', 'name' => '군포 / 의왕'],
    ['id' => '38', 'name' => '성남 / 분당'],
    ['id' => '39', 'name' => '평택 / 송탄'],
    ['id' => '40', 'name' => '수원 / 병점'],
    ['id' => '41', 'name' => '안산 / 시흥'],
    ['id' => '42', 'name' => '안양 / 과천'],
    ['id' => '43', 'name' => '오산 / 동탄'],
    ['id' => '44', 'name' => '인천 / 부평'],
    ['id' => '45', 'name' => '화성 / 발안'],
    ['id' => '46', 'name' => '광명시'],
    ['id' => '47', 'name' => '양주시'],
    ['id' => '48', 'name' => '의정부시'],
    ['id' => '49', 'name' => '포천시'],
    ['id' => '50', 'name' => '광주시'],
    ['id' => '51', 'name' => '고양 / 일산'],
    ['id' => '52', 'name' => '김포시'],
    ['id' => '53', 'name' => '부천시'],
    ['id' => '54', 'name' => '용인시'],
    ['id' => '55', 'name' => '파주시'],
    ['id' => '56', 'name' => '하남시'],
];

// 광역시 및 주요 거점 바로가기
$metroDistricts = [
    ['id' => '57', 'name' => '천안'],
    ['id' => '58', 'name' => '충주'],
    ['id' => '59', 'name' => '대전'],
    ['id' => '60', 'name' => '전주'],
    ['id' => '61', 'name' => '광주'],
    ['id' => '62', 'name' => '부산'],
    ['id' => '63', 'name' => '울산'],
    ['id' => '64', 'name' => '대구'],
    ['id' => '65', 'name' => '원주'],
    ['id' => '66', 'name' => '춘천'],
    ['id' => '67', 'name' => '포항'],
    ['id' => '68', 'name' => '강릉'],
    ['id' => '69', 'name' => '창원'],
    ['id' => '71', 'name' => '구미'],
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
      <span class="active">수도권 차량 (서울·경기)</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="map marker alternate icon"></i> 수도권 지역 차량 (서울·경기)
    </h1>
    <p class="ydk-page-desc">
      각 지역을 선택하시면 현지 차주와 직거래로 연결되어 더욱 빠르고 경제적인 운송이 가능합니다.
    </p>
  </header>

  <!-- 2. 핵심 안내 배너 (직거래 장점) -->
  <div class="ui icon message info-hero-banner" style="background: linear-gradient(135deg, #e6f7ff 0%, #f0f5ff 100%); border: 1px solid #91d5ff; border-radius: 12px; margin-bottom: 28px;">
    <i class="truck icon" style="color: #0070ba;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #003a8c; margin-bottom: 6px;">
        지역 차주와 직거래로 불필요한 중간 수수료를 걷어냅니다!
      </div>
      <p style="color: #2c3e50; line-height: 1.6; margin: 0;">
        서울 25개 구 및 경기도 전역에 차주 네트워크가 상시 대기 중입니다. 출발지 또는 도착지 관내 차량을 선택하시면 
        <strong>신속한 배차</strong>와 <strong>합리적인 운송 비용</strong>을 직접 협의하실 수 있습니다.
      </p>
    </div>
  </div>

  <!-- 3. 권역 탭 네비게이션 -->
  <div class="ui secondary pointing menu area-nav-menu" style="margin-bottom: 24px; border-bottom: 2px solid #e0e0e0;">
    <a class="active item" style="font-weight: 700; font-size: 1.05rem;" href="<?= url('contents/info/area_01.php') ?>">
      <i class="map marker alternate icon"></i> 서울·경기 권역
    </a>
    <a class="item" style="font-weight: 600; font-size: 1.05rem;" href="<?= url('contents/info/area_02.php') ?>">
      <i class="map signs icon"></i> 전국 광역시 권역
    </a>
    <a class="item" style="font-weight: 600; font-size: 1.05rem;" href="<?= url('contents/info/car_list_03.php') ?>">
      <i class="road icon"></i> 지방화물·리턴공차 안내
    </a>
  </div>

  <div class="ui stackable grid">
    
    <!-- 좌측/상단: 서울 25개 구 그리드 -->
    <div class="sixteen wide column">
      <div class="ui segment" style="border-radius: 12px; padding: 24px; border-top: 4px solid #0070ba; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 18px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">
          <h2 style="font-size: 1.25rem; margin: 0; color: #1a365d;">
            <i class="compass outline icon" style="color: #0070ba;"></i> 서울특별시 25개 자치구 차주 안내
          </h2>
          <span style="font-size: 0.9rem; color: #666;">원하시는 구를 누르시면 업체 목록으로 즉시 이동합니다.</span>
        </div>

        <div class="ui five column doubling grid district-btn-grid">
          <?php foreach ($seoulDistricts as $d): ?>
            <div class="column" style="padding: 6px;">
              <a href="<?= url('contents/company/company_list.php?id=' . $d['id']) ?>" class="ui fluid basic button district-btn" style="text-align: left; padding: 12px 14px; border-radius: 8px; border-color: #d9d9d9; font-weight: 600; transition: all 0.2s ease;">
                <i class="map pin icon" style="color: #0070ba; margin-right: 6px;"></i><?= e($d['name']) ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- 경기/인천 21개 지역 그리드 -->
    <div class="sixteen wide column">
      <div class="ui segment" style="border-radius: 12px; padding: 24px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 12px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 18px; border-bottom: 1px solid #f0f0f0; padding-bottom: 12px;">
          <h2 style="font-size: 1.25rem; margin: 0; color: #064e3b;">
            <i class="building outline icon" style="color: #10b981;"></i> 경기도 및 인천 주요 지역 차주 안내
          </h2>
          <span style="font-size: 0.9rem; color: #666;">수도권 전역 1t 용달, 1.4t~5t 화물, 리프트차 대기 중</span>
        </div>

        <div class="ui four column doubling grid district-btn-grid">
          <?php foreach ($gyeonggiDistricts as $d): ?>
            <div class="column" style="padding: 6px;">
              <a href="<?= url('contents/company/company_list.php?id=' . $d['id']) ?>" class="ui fluid basic button district-btn" style="text-align: left; padding: 12px 14px; border-radius: 8px; border-color: #d9d9d9; font-weight: 600; transition: all 0.2s ease;">
                <i class="truck icon" style="color: #10b981; margin-right: 6px;"></i><?= e($d['name']) ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- 전국 광역시 바로가기 빠른 링크 -->
    <div class="sixteen wide column">
      <div class="ui segment secondary" style="border-radius: 12px; padding: 20px; background: #fafafa; border: 1px dashed #d1d5db; margin-top: 12px;">
        <h3 style="font-size: 1.1rem; margin-top: 0; margin-bottom: 12px; color: #374151;">
          <i class="share icon"></i> 전국 광역시 차주 바로가기
        </h3>
        <div class="ui seven column doubling grid">
          <?php foreach ($metroDistricts as $m): ?>
            <div class="column" style="padding: 4px;">
              <a href="<?= url('contents/company/company_list.php?id=' . $m['id']) ?>" class="ui small fluid basic grey button" style="padding: 8px 4px; font-weight: 600; text-align: center;">
                <?= e($m['name']) ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- 4. 서비스 연계 추천 카드: 일반이사/포장이사 안내 -->
    <div class="eight wide tablet eight wide computer sixteen wide mobile column">
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.06); height: 100%;">
        <div class="content">
          <div class="header" style="color: #702459; font-size: 1.15rem;">
            <i class="dolly icon"></i> 알뜰 일반이사 서비스
          </div>
          <div class="meta" style="margin-top: 4px;">저렴한 비용으로 실속 있는 이사를 원하신다면</div>
          <div class="description" style="margin-top: 12px; font-size: 0.95rem; line-height: 1.6; color: #4b5563;">
            고객님께서 사전에 물품을 박스 포장해 두시면, 전문 기사가 상하차 운반 및 가구 원위치 배치를 도와드려 이사 비용을 대폭 절감할 수 있습니다.
          </div>
        </div>
        <div class="extra content">
          <a href="<?= url('contents/info/gen_mov.php') ?>" class="ui fluid basic purple button">
            일반이사 상세안내 바로가기 <i class="arrow right icon"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="eight wide tablet eight wide computer sixteen wide mobile column">
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.06); height: 100%;">
        <div class="content">
          <div class="header" style="color: #0d9488; font-size: 1.15rem;">
            <i class="calculator icon"></i> 이삿짐 예상 단가 확인
          </div>
          <div class="meta" style="margin-top: 4px;">1톤/2.5톤 평일·이삿날 투명한 표준 요금 안내</div>
          <div class="description" style="margin-top: 12px; font-size: 0.95rem; line-height: 1.6; color: #4b5563;">
            단순 차량 운송만 이용하실 때부터 기사 도움, 일반이사, 포장이사까지 작업 조건별 예상 요금을 미리 확인하고 예산에 맞춰 계획하세요.
          </div>
        </div>
        <div class="extra content">
          <a href="<?= url('contents/info/forecast_trt.php') ?>" class="ui fluid basic teal button">
            이삿짐 예상단가표 보기 <i class="arrow right icon"></i>
          </a>
        </div>
      </div>
    </div>

  </div>

  <!-- 5. 마무리 전화 상담 CTA -->
  <section class="ydk-bottom-cta" style="margin-top: 36px; padding: 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
    <h3 style="font-size: 1.3rem; color: #1e293b; margin-bottom: 8px;">
      수도권 실시간 배차 및 맞춤 화물 운송 상담
    </h3>
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 18px;">
      지역 차주 연결이 원활하지 않거나 즉각적인 다량 배차가 필요하시면 대표번호로 문의해 주세요.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge primary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="phone icon"></i> 대표전화 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge secondary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="edit outline icon"></i> 온라인 간편 견적문의
      </a>
    </div>
  </section>

</main>

<style>
.district-btn:hover {
  background-color: #f0f7ff !important;
  border-color: #0070ba !important;
  color: #0070ba !important;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(0, 112, 186, 0.15);
}
</style>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
