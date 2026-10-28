<?php
/**
 * 용달코리아 v2-1 지방화물 및 리턴공차 알선 안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/car_list_03.html
 * 대상 경로: v2-1/contents/info/car_list_03.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '지방화물 및 리턴공차 알선 안내 | ' . SITE_NAME;
$pageDescription = '전국 각 지방에서 상경한 차량 및 짐 하차 후 대기 차량(리턴공차)을 고객과 연결하여 물류비를 획기적으로 절감해 드리는 알뜰 주선 서비스입니다.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">지방화물 안내</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="road icon"></i> 지방화물 및 리턴공차 알선 안내
    </h1>
    <p class="ydk-page-desc">
      전국 각 지방에서 상경한 차량이나 짐 하차 후 대기 중인 복귀 차량을 실시간으로 연결하여 운송비를 획기적으로 낮춥니다.
    </p>
  </header>

  <!-- 2. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #fefce8 0%, #fef9c3 100%); border: 1px solid #fde047; border-radius: 12px; margin-bottom: 28px;">
    <i class="coins icon" style="color: #ca8a04;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #854d0e; margin-bottom: 6px;">
        리턴공차(빈 차)를 활용한 똑똑한 물류비 절감!
      </div>
      <p style="color: #422006; line-height: 1.6; margin: 0;">
        차주는 빈 차로 돌아가지 않아 좋고, 고객은 일반 편도 독차 운임보다 훨씬 저렴하게 이용할 수 있는 
        <strong>상생형 직거래 주선 시스템</strong>입니다. 관허 4-42호 정식 등록업체와 함께 안심하고 이용하세요.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문: 지방화물 알선이란? & 핵심 가이드 -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 지방화물 알선이란? -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #0070ba; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #1a365d; margin-top: 0; margin-bottom: 16px;">
          <i class="question circle outline icon" style="color: #0070ba;"></i> 지방화물 알선(주선업)이란?
        </h2>
        
        <div style="font-size: 1rem; line-height: 1.8; color: #374151;">
          <p>
            각 지방에서 화물을 싣고 서울·수도권으로 올라온 차량이나, 반대로 수도권에서 각 지방으로 화물 운송을 끝마친 후 
            <strong>자신의 원래 차고지로 복귀하기 위해 대기 중인 차량</strong>들과, 
            해당 방향으로 화물이나 이삿짐을 보내려는 고객을 정밀하게 매칭해 드리는 서비스를 말합니다.
          </p>
          <p>
            주선업체를 선택하실 때는 <strong>반드시 법적 인가를 받은 "관허업체"</strong>를 선택하셔야 화물 운송 중 불의의 사고나 분쟁이 발생하지 않습니다.
          </p>
          <div style="background: #f0fdf4; border-left: 4px solid #10b981; padding: 14px 18px; border-radius: 0 8px 8px 0; margin: 16px 0;">
            <strong style="color: #065f46;">용달코리아의 이점:</strong>
            <p style="margin: 4px 0 0 0; color: #166534; font-size: 0.95rem;">
              차량은 공차 운행 손실을 줄이고, 화주 고객은 <strong>정상 운임 대비 30~50% 절감된 비용</strong>으로 지방 장거리 이사·화물을 운송할 수 있어 이미 많은 알뜰 고객님들께서 적극적으로 이용하고 계십니다.
            </p>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 상차 전 고객 확인 사항 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 14px;">
          <i class="clipboard check icon" style="color: #10b981;"></i> 물품 상차 전 고객이 꼭 확인해야 할 3가지
        </h2>
        <p style="color: #4b5563; font-size: 0.95rem; margin-bottom: 16px;">
          차량에 짐을 적재하고 차량이 출발하기 전에 아래 기사의 인적사항을 반드시 메모해 두시면, 운송 중 실시간 위치 확인 및 안전한 도착 확인이 가능합니다.
        </p>

        <div class="ui three column doubling grid" style="text-align: center;">
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 12px;">
              <i class="car icon" style="font-size: 2rem; color: #0284c7; margin-bottom: 8px;"></i>
              <div style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">1. 차량번호</div>
              <div style="font-size: 0.85rem; color: #64748b; margin-top: 4px;">운행 차량의 정확한 번호</div>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 12px;">
              <i class="mobile alternate icon" style="font-size: 2rem; color: #10b981; margin-bottom: 8px;"></i>
              <div style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">2. 기사 연락처</div>
              <div style="font-size: 0.85rem; color: #64748b; margin-top: 4px;">직통 휴대전화 번호 확인</div>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 12px;">
              <i class="warehouse icon" style="font-size: 2rem; color: #f59e0b; margin-bottom: 8px;"></i>
              <div style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">3. 차량 차고지</div>
              <div style="font-size: 0.85rem; color: #64748b; margin-top: 4px;">기사의 원래 연고 지역</div>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 예약 및 일정 변경 안내 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #6366f1; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <h2 style="font-size: 1.25rem; color: #3730a3; margin-top: 0; margin-bottom: 14px;">
          <i class="clock outline icon" style="color: #6366f1;"></i> 지방 화물 예약 및 일정 조율 수칙
        </h2>

        <div class="ui list" style="line-height: 1.8; color: #334155; font-size: 0.98rem;">
          <div class="item">
            <i class="check icon" style="color: #10b981;"></i>
            <div class="content"><strong>날짜·시간 사전 예약:</strong> 미리 예약하시면 노선이 일치하는 가장 좋은 상태의 차량이 배정되어 시간이 절약됩니다.</div>
          </div>
          <div class="item">
            <i class="check icon" style="color: #10b981;"></i>
            <div class="content"><strong>일정 변경 시 하루 전 통보:</strong> 취소나 날짜 변경은 최소한 하루 전에 연락 주셔야 대체 배차나 위약금 문제가 발생하지 않습니다.</div>
          </div>
          <div class="item">
            <i class="check icon" style="color: #10b981;"></i>
            <div class="content"><strong>당일 시간 변경:</strong> 부득이하게 상하차 시간을 변경하고자 하실 때에는 <strong>최소 2시간 전</strong>에 미리 연락해 주십시오.</div>
          </div>
          <div class="item">
            <i class="check icon" style="color: #10b981;"></i>
            <div class="content"><strong>소량 짐은 합바짐(혼적) 추천:</strong> 독차를 채우지 못하는 소형 짐은 같은 방향 차량에 함께 실어 보내는 합바짐을 이용하시면 더욱 경제적입니다.</div>
          </div>
        </div>
      </div>

    </div>

    <!-- 우측 컬럼: 빠른 상담 및 권역 연결 -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 전화 상담 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid #0070ba; overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: #0070ba; color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            지방화물 전담 직통 상담
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.95rem;">서울에서 제주까지 전국 네트워크</p>
        </div>
        <div class="content" style="padding: 22px;">
          <div style="text-align: center; margin-bottom: 16px;">
            <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 상담 번호</div>
            <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.6rem; font-weight: 800; color: #0070ba;">
              <?= SITE_PHONE ?>
            </a>
            <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-top: 6px;">
              010-4477-2404
            </div>
            <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(통화 가능: 08:00 ~ 21:00)</div>
          </div>

          <div class="ui divider"></div>

          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 16px;">
            <strong>[취급 화물]</strong> 1톤, 2.5톤, 5톤 용달 및 개별화물, 탑차, 윙바디, 리프트차, 지방 이삿짐, 기업 물류
          </p>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid primary button" style="border-radius: 8px; font-weight: 700; padding: 14px;">
            <i class="phone icon"></i> 지방차 즉시 상담·예약
          </a>
        </div>
      </div>

      <!-- 지역별 차주 찾기 바로가기 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="font-size: 1.05rem; color: #1e293b; margin-top: 0; margin-bottom: 12px;">
            <i class="map marker alternate icon" style="color: #059669;"></i> 권역별 차주 바로가기
          </h4>
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <a href="<?= url('contents/info/area_02.php') ?>" class="ui fluid basic teal button" style="text-align: left; border-radius: 6px;">
              <i class="map signs icon"></i> 전국 광역시 차주 안내 <i class="angle right icon" style="float: right;"></i>
            </a>
            <a href="<?= url('contents/info/area_01.php') ?>" class="ui fluid basic blue button" style="text-align: left; border-radius: 6px;">
              <i class="building icon"></i> 수도권 (서울·경기) 차주 안내 <i class="angle right icon" style="float: right;"></i>
            </a>
            <a href="<?= url('contents/company/company_list.php') ?>" class="ui fluid basic grey button" style="text-align: left; border-radius: 6px;">
              <i class="list icon"></i> 전체 지역별 업체 리스트 <i class="angle right icon" style="float: right;"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- 온라인 견적 문의 배너 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <i class="laptop icon" style="font-size: 2.2rem; color: #3b82f6; margin-bottom: 8px;"></i>
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">온라인 무료 견적 문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">화물 종류, 출발지, 도착지를 남겨주시면 최적의 공차 운임을 안내해 드립니다.</p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            견적 문의 작성하기
          </a>
        </div>
      </div>

    </div>

  </div>

</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
