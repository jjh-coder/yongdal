<?php
/**
 * 용달코리아 v2 강원·제주 화물안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_info_05.html
 * 대상 경로: v2/contents/area/area_info_05.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$activeAreaCode = '05';
$pageTitle = '강원·제주 화물안내 (강원도 & 제주특별자치도) | ' . SITE_NAME;
$pageDescription = '춘천, 원주, 강릉, 속초, 동해 등 강원 산간·동해안권 및 제주도 선박 카페리 연계 화물·소형이사 전문 직거래 배차. 도서산간 기상 특화 운송 및 투명한 정찰제 운임 안내.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <a href="<?= url('contents/area/area_info_01.php') ?>">지역별 운송 정보</a>
      <span class="divider">/</span>
      <span class="active">강원·제주 화물안내</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="ship icon"></i> 강원·제주 화물안내 (강원도 & 제주도)
    </h1>
    <p class="ydk-page-desc">
      험준한 산악 고갯길부터 푸른 동해안과 바다 건너 제주도까지! 지형과 기후에 특화된 안전 운송 솔루션을 제공합니다.
    </p>
  </header>

  <!-- 2. 공통 지역 정보 내비게이션 탭 -->
  <?php include __DIR__ . '/_area_nav.php'; ?>

  <!-- 3. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%); border: 1px solid #99f6e4; border-radius: 12px; margin-bottom: 28px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
    <i class="anchor icon" style="color: #0d9488;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #115e59; margin-bottom: 6px;">
        강원 영동·영서 당일 배송 & 제주도 카페리 선박 연계 직거래!
      </div>
      <p style="color: #134e4a; line-height: 1.6; margin: 0;">
        눈길·결빙에 대비한 월동 장비 구비 차량 및 제주도 완도·목포·녹동항 카페리 선적 연계 시스템을 통해 
        <strong>도서산간 지역도 안심하고 안전하게</strong> 화물과 이삿짐을 운송하실 수 있습니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문 (10 wide) -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 강원 & 제주 특화 물류 운송 체계 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #0d9488; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #115e59; margin-top: 0; margin-bottom: 16px;">
          <i class="mountain icon" style="color: #0d9488;"></i> 지형과 기상에 최적화된 강원·제주 배차 솔루션
        </h2>
        
        <div style="font-size: 1rem; line-height: 1.8; color: #334155;">
          <p>
            강원도 산간 지형과 제주도 해상 운송은 일반 내륙 평지 운송과 완전히 다른 노하우가 요구됩니다. 결빙 도로 주행 능력, 선적 일정 조율, 해풍 및 염분 차단 포장 등 전문 배차 시스템을 갖추고 있습니다.
          </p>

          <div class="ui two column stackable grid" style="margin-top: 10px;">
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: var(--ydk-primary); margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="snowflake icon" style="color: #0284c7;"></i> 강원 산간·군부대·리조트 물류
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  춘천·원주 혁신도시, 영서·영동 관광 레저 물류, 철원·화천·인제·양구 등 전방 군부대 관사 이사 및 월동 체인 구비 차량 지원.
                </div>
              </div>
            </div>
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: var(--ydk-primary); margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="ship icon" style="color: #0d9488;"></i> 제주도 선박 카페리 연계 운송
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  목포/완도/녹동항에서 대형 카페리에 화물차를 통째로 선적하여 제주 현지까지 환적(짐 옮김) 없이 원스톱 도선 운송 가능.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 강원권 및 제주도 편도 운임 기준표 (2026-10 동기화) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 8px;">
          <i class="won sign icon" style="color: #10b981;"></i> 서울/수도권 ↔ 강원·제주 운임 기준표
        </h2>
        <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 16px;">
          * 서울 기준 편도 단순운송(상하차 기준) 기준이며, 제주도는 육상운임 외 선적료가 포함된 복합 견적으로 산출됩니다.
        </p>

        <!-- 데스크톱/태블릿 표 -->
        <div class="ydk-desktop-table-wrap">
          <table class="ui unstackable celled structured table ydk-table" style="font-size: 0.95rem; text-align: center;">
            <thead style="background: #f1f5f9;">
              <tr>
                <th style="width: 25%;">도착 지역</th>
                <th style="width: 25%;">대표 거점</th>
                <th style="width: 25%;">1톤 카고</th>
                <th style="width: 25%;">2.5톤 트럭</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">강원 영서 북부</td>
                <td>춘천, 가평, 홍천, 화천, 철원</td>
                <td><strong style="color: #c2410c;">100,000 ~ 130,000원</strong></td>
                <td>160,000 ~ 190,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">강원 영서 남부</td>
                <td>원주, 횡성, 문막, 평창</td>
                <td><strong style="color: #c2410c;">110,000 ~ 140,000원</strong></td>
                <td>170,000 ~ 200,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">강원 동해안 북부</td>
                <td>강릉, 속초, 양양, 고성, 인제</td>
                <td><strong style="color: #c2410c;">150,000 ~ 190,000원</strong></td>
                <td>210,000 ~ 250,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">강원 남부 / 폐광지역</td>
                <td>동해, 삼척, 태백, 정선, 영월</td>
                <td><strong style="color: #c2410c;">170,000 ~ 210,000원</strong></td>
                <td>230,000 ~ 270,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">제주특별자치도</td>
                <td>제주시, 서귀포시 전역</td>
                <td><strong style="color: #c2410c;">상담 견적 (도선료 포함)</strong></td>
                <td>상담 견적 (선적 조율)</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- 모바일 전용 카드 -->
        <div class="ydk-mobile-pricing-list" style="display: none;">
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">춘천 / 원주 / 홍천 / 횡성</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">10 ~ 14 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 16~20만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">강릉 / 속초 / 양양 / 인제</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">15 ~ 19 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 21~25만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">동해 / 삼척 / 태백 / 정선</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">17 ~ 21 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 23~27만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">제주특별자치도 전역</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">전화 맞춤 견적</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">육상운임 + 카페리 도선 선적비 포함 안내</div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 도서산간 화물 취급 및 적재물 보험 필수 수칙 (legacy 원문 계승) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: var(--ydk-primary); margin-top: 0; margin-bottom: 14px;">
          <i class="shield alternate icon" style="color: var(--ydk-primary);"></i> 도서산간 화물 운송 4대 안전 기준
        </h2>

        <div class="ui relaxed divided list" style="font-size: 0.98rem; line-height: 1.8; color: #334155;">
          <div class="item" style="padding: 12px 0;">
            <i class="shield check icon" style="color: #10b981; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">1. 고가 물품 적재물 배상책임보험 부보</strong>
              <div style="color: #64748b; margin-top: 2px;">
                화물 운송 시 5톤 미만 차량은 법적으로 임의보험 대상이며, 5톤 초과는 의무보험 대상입니다. 따라서 1톤~2.5톤 차량으로 고가의 물품을 운송하실 때는 사전 상담을 통해 적재물 보험 가입 차량을 지정하시는 것이 필수적입니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="umbrella icon" style="color: #0284c7; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">2. 기상 변화 대비 방수·방한 포장 철저</strong>
              <div style="color: #64748b; margin-top: 2px;">
                대관령, 미시령 등 강원 고갯길은 급작스러운 폭설과 돌풍이 자주 발생합니다. 또한 제주도 카페리 운송 시 해풍 염분이 닿지 않도록 호루 덮개 2중 체결 또는 밀폐형 탑차를 이용해야 합니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="truck icon" style="color: #ca8a04; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">3. 화물 운송과 택배의 차이점 숙지</strong>
              <div style="color: #64748b; margin-top: 2px;">
                용달 화물은 1톤 이하 적재정량의 소형 물류 및 소형 이사를 전문으로 하며, 택배와 달리 화주가 차량 도착 전 짐을 1층에 내놓아야 바로 상차하여 정해진 시간에 출발할 수 있습니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="file alternate outline icon" style="color: #c2410c; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">4. 이사 4대 서비스(단순/일반/포장/보관) 사전 구분</strong>
              <div style="color: #64748b; margin-top: 2px;">
                단순 운송만 할 것인지, 기사와 함께 짐을 나르는 일반이사를 할 것인지, 입주 날짜 차이로 인한 컨테이너 보관이사가 필요한지 사전에 확인하여 계약서를 작성하시면 분쟁을 방지할 수 있습니다.
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- 우측 컬럼 (6 wide 사이드바) -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 전화 상담 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid var(--ydk-primary); overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: var(--ydk-primary); color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            강원·제주 화물 직통 상담실
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.92rem;">산간·도서 카페리 선적 전담 안내</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 직통 상담 번호</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.7rem; font-weight: 800; color: var(--ydk-cta); text-decoration: none; display: block; margin-bottom: 6px;">
            <i class="phone icon"></i> <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b;">
            직통: 010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(선박 운항 시간 및 기상 상태 실시간 체크)</div>

          <div class="ui divider"></div>

          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 16px; text-align: left;">
            <strong>[특화 배차 차량]</strong><br>
            • 강원 산간 월동 체인 구비 카고/호루<br>
            • 제주도 카페리 선적 1톤~5톤 윙바디<br>
            • 군부대 관사 이사 및 소형 원룸이사<br>
            • 동해안 상경 리턴공차 매칭
          </p>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid button" style="background-color: var(--ydk-cta); color: #fff; border-radius: 8px; font-weight: 700; padding: 14px;">
            <i class="phone icon"></i> 강원·제주 즉시 상담
          </a>
        </div>
      </div>

      <!-- 리턴공차 안내 바로가기 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.05rem;">
            <i class="sync alternate icon" style="color: #ca8a04;"></i> 강원 ↔ 수도권 리턴공차
          </h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 12px;">
            강릉, 속초, 원주 등에서 수도권으로 올라오는 공차를 활용해 편도 운임을 절약하세요.
          </p>
          <a href="<?= url('contents/area/area_info_06.php') ?>" class="ui fluid basic orange button" style="border-radius: 6px; font-weight: 700;">
            리턴공차 혜택 보기 <i class="angle right icon"></i>
          </a>
        </div>
      </div>

      <!-- 온라인 견적 문의 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <i class="laptop icon" style="font-size: 2.2rem; color: #3b82f6; margin-bottom: 8px;"></i>
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">제주·강원 견적 문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">
            상세 주소와 선적 희망 날짜를 남겨주시면 정확한 견적을 안내해 드립니다.
          </p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            견적 문의 작성 <i class="angle right icon"></i>
          </a>
        </div>
      </div>

    </div>

  </div>

</main>

<style>
@media (max-width: 767px) {
  .ydk-desktop-table-wrap { display: none !important; }
  .ydk-mobile-pricing-list { display: block !important; }
}
</style>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
