<?php
/**
 * 용달코리아 v2 호남권 화물안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_info_03.html
 * 대상 경로: v2/contents/area/area_info_03.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$activeAreaCode = '03';
$pageTitle = '호남권 화물안내 (광주·전남·전북) | ' . SITE_NAME;
$pageDescription = '광주광역시, 전주, 군산, 익산, 목포, 여수, 순천, 광양 등 호남권 전역 1톤 용달, 2.5톤, 5톤 장거리 정기 배차. 수도권 ↔ 호남권 상경 리턴공차 매칭으로 최대 40% 운임 절감 안내.';

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
      <span class="active">호남권 화물안내</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="map marker alternate icon"></i> 호남권 화물안내 (광주·전남·전북)
    </h1>
    <p class="ydk-page-desc">
      풍요로운 서남해안과 대도시를 잇는 호남고속선! 광주·전주·군산·여수·목포 등 전남북 전역 장거리 화물 직거래 네트워크입니다.
    </p>
  </header>

  <!-- 2. 공통 지역 정보 내비게이션 탭 -->
  <?php include __DIR__ . '/_area_nav.php'; ?>

  <!-- 3. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #86efac; border-radius: 12px; margin-bottom: 28px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
    <i class="truck moving icon" style="color: #16a34a;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #14532d; margin-bottom: 6px;">
        호남 장거리 운송의 핵심! 상행 리턴공차로 최대 30~40% 절감
      </div>
      <p style="color: #166534; line-height: 1.6; margin: 0;">
        전남·전북에서 농수산물과 기업 화물을 싣고 수도권으로 올라온 차량들이 원래 차고지로 돌아갈 때 매칭해 드립니다. 
        <strong>독차 편도 정상 요금보다 훨씬 경제적인 비용</strong>으로 안전하게 보내실 수 있습니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문 (10 wide) -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 호남권 물류 산업 및 지역 거점 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #16a34a; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #14532d; margin-top: 0; margin-bottom: 16px;">
          <i class="warehouse icon" style="color: #16a34a;"></i> 호남권 주요 산업 거점 및 맞춤형 배차 체계
        </h2>
        
        <div style="font-size: 1rem; line-height: 1.8; color: #334155;">
          <p>
            호남권은 빛고을 광주의 자동차·가전 클러스터, 나주 빛가람 혁신도시의 공기업 단지, 전주 탄소소재 국가산단, 군산·새만금 복합물류지구, 여수·광양만권의 중화학 및 철강 항만 물류까지 고속 성장하는 경제권입니다.
          </p>

          <div class="ui two column stackable grid" style="margin-top: 10px;">
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: var(--ydk-primary); margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="leaf icon" style="color: #16a34a;"></i> 청정 농수산물 및 특산물 신속 배송
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  나주 배, 담양 딸기, 완도 전복, 영광 굴비 등 신선도 유지가 생명인 농수산물 직송을 위해 <strong>방수 탑차 및 냉장·냉동 윙바디</strong> 차량을 정시 배차합니다.
                </div>
              </div>
            </div>
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: var(--ydk-primary); margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="boxes icon" style="color: #0284c7;"></i> 혁신도시 공기업 발령 & 장거리 이사
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  한국전력 등 나주 혁신도시 이전 기관 임직원 사택 이사 및 원룸·오피스텔 장거리 소형 이사를 정찰제 운임으로 깔끔하게 처리합니다.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 호남권 주요 거점별 운임표 (2026-10 개정 동기화) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 8px;">
          <i class="won sign icon" style="color: #10b981;"></i> 서울/수도권 ↔ 호남권 주요 권역 편도 운임 기준표
        </h2>
        <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 16px;">
          * 서울 기준 편도 카고 단순운송 예시이며, 혼적(합바) 또는 리턴공차 시 최대 30~40% 할인 혜택이 적용됩니다.
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
                <td style="font-weight: 700; color: #1e293b;">전북 북부권</td>
                <td>군산, 익산, 전주, 완주</td>
                <td><strong style="color: #c2410c;">160,000 ~ 190,000원</strong></td>
                <td>220,000 ~ 250,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">전북 남부 / 내륙</td>
                <td>정읍, 김제, 남원, 고창, 부안</td>
                <td><strong style="color: #c2410c;">180,000 ~ 210,000원</strong></td>
                <td>240,000 ~ 270,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">광주광역시 / 나주</td>
                <td>광산, 북구, 서구, 나주혁신도시</td>
                <td><strong style="color: #c2410c;">190,000 ~ 230,000원</strong></td>
                <td>250,000 ~ 280,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">전남 동부 해안권</td>
                <td>순천, 여수, 광양, 담양, 곡성</td>
                <td><strong style="color: #c2410c;">230,000 ~ 270,000원</strong></td>
                <td>280,000 ~ 320,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">전남 서남해안권</td>
                <td>목포, 무안, 영암, 해남, 강진, 완도</td>
                <td><strong style="color: #c2410c;">240,000 ~ 280,000원</strong></td>
                <td>290,000 ~ 330,000원</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- 모바일 전용 카드 -->
        <div class="ydk-mobile-pricing-list" style="display: none;">
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">전주 / 익산 / 군산</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">16 ~ 19 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 22~25만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">광주광역시 / 나주혁신도시</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">19 ~ 23 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 25~28만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">순천 / 여수 / 광양</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">23 ~ 27 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 28~32만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">목포 / 무안 / 해남 / 완도</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">24 ~ 28 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 29~33만 원)</div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 장거리 화물 필수 주의사항 (legacy 계승) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: var(--ydk-primary); margin-top: 0; margin-bottom: 14px;">
          <i class="clipboard check icon" style="color: var(--ydk-primary);"></i> 호남 장거리 화물 운송 4대 안심 수칙
        </h2>

        <div class="ui relaxed divided list" style="font-size: 0.98rem; line-height: 1.8; color: #334155;">
          <div class="item" style="padding: 12px 0;">
            <i class="lock icon" style="color: #0284c7; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">1. 장거리 적재물 안전 결속 및 방수 조치</strong>
              <div style="color: #64748b; margin-top: 2px;">
                서해안고속도로 및 호남고속도로는 300km 이상의 장거리 구간입니다. 적재물이 흔들리지 않도록 결속 벨트(깔깔이)와 보호 덮개를 단단히 고정하고, 기상 악화 시 탑차나 윙바디를 우선 배정합니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="shield icon" style="color: #16a34a; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">2. 적재물 배상책임보험 확인</strong>
              <div style="color: #64748b; margin-top: 2px;">
                고가의 전자제품이나 예술품, 산업 자재를 운송할 경우 화물 가액을 사전에 고지해 주시면 적재물 배상책임보험이 부보된 안전한 전문 기사가 배차됩니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="sync alternate icon" style="color: #ca8a04; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">3. 당착 / 익일착 탄력 운용으로 추가 절감</strong>
              <div style="color: #64748b; margin-top: 2px;">
                당일 꼭 받아야 하는 급송 화물(당착) 외에, 다음날 오전이나 오후에 도착해도 괜찮은 짐(내일착)은 야간 혼적망을 이용해 운송료를 한 번 더 아낄 수 있습니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="file alternate outline icon" style="color: #c2410c; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">4. 관허 [제4042호] 관인 계약서 서면 작성</strong>
              <div style="color: #64748b; margin-top: 2px;">
                이사나 대형 화물 계약 시 관허 등록 확인 및 서면 계약서를 구비해 두시면 작업 인원 투입 현황과 운송 조건이 명확히 보장됩니다.
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
            호남권 화물 전담 상담실
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.92rem;">광주·전주·군산·여수 실시간 배차</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 직통 상담 번호</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.7rem; font-weight: 800; color: var(--ydk-cta); text-decoration: none; display: block; margin-bottom: 6px;">
            <i class="phone icon"></i> <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b;">
            직통: 010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(장거리 야간 상차·새벽착 예약 접수)</div>

          <div class="ui divider"></div>

          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 16px; text-align: left;">
            <strong>[호남권 직통 차량]</strong><br>
            • 1톤 카고 / 호루탑 / 윙바디<br>
            • 1.4톤 / 2.5톤 / 3.5톤 / 5톤 개별화물<br>
            • 수도권 상경 공차 및 혼적(합바)<br>
            • 나주혁신도시·광주권 기업 이사
          </p>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid button" style="background-color: var(--ydk-cta); color: #fff; border-radius: 8px; font-weight: 700; padding: 14px;">
            <i class="phone icon"></i> 호남권 즉시 상담 연결
          </a>
        </div>
      </div>

      <!-- 리턴공차 안내 바로가기 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.05rem;">
            <i class="sync alternate icon" style="color: #ca8a04;"></i> 호남 ↔ 수도권 리턴공차
          </h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 12px;">
            장거리일수록 공차 매칭 효과가 큽니다. 빈 차로 돌아가는 트럭과 매칭해 운송비를 절약하세요.
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
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">온라인 견적 문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">
            도착 지역과 짐 물량을 남겨주시면 가장 합리적인 공차/독차 견적을 제시해 드립니다.
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
