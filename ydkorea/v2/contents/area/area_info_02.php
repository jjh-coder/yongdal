<?php
/**
 * 용달코리아 v2 충청권 화물안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_info_02.html
 * 대상 경로: v2/contents/area/area_info_02.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$activeAreaCode = '02';
$pageTitle = '충청권 화물안내 (대전·세종·충남·충북) | ' . SITE_NAME;
$pageDescription = '대전, 세종, 천안, 아산, 청주, 충주, 서산 등 충청권 전역 1톤 용달, 2.5톤, 5톤 화물 실시간 배차. 수도권 ↔ 충청권 당일 특급 및 상·하행 리턴공차 30% 운임 절감 안내.';

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
      <span class="active">충청권 화물안내</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="compass outline icon"></i> 충청권 화물안내 (대전·세종·충남·충북)
    </h1>
    <p class="ydk-page-desc">
      국토의 중심이자 사통팔달 교통의 요충지! 대전·세종·천안·청주 등 충청권 전역과 수도권을 잇는 초고속 배차망입니다.
    </p>
  </header>

  <!-- 2. 공통 지역 정보 내비게이션 탭 -->
  <?php include __DIR__ . '/_area_nav.php'; ?>

  <!-- 3. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #fefce8 0%, #fef9c3 100%); border: 1px solid #fde047; border-radius: 12px; margin-bottom: 28px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
    <i class="road icon" style="color: #ca8a04;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #854d0e; margin-bottom: 6px;">
        수도권 ↔ 충청권 1시간대 진입! 당일 특급 및 리턴공차 매칭
      </div>
      <p style="color: #422006; line-height: 1.6; margin: 0;">
        경부·호남·중부·당진영덕 고속도로를 통해 수도권과 충청권을 가장 빠르게 연결합니다. 
        상경/하행 리턴공차를 활용하시면 <strong>정상 운임 대비 20~30% 절감된 비용</strong>으로 이용하실 수 있습니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문 (10 wide) -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 충청권 물류 허브 특장점 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #ca8a04; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #854d0e; margin-top: 0; margin-bottom: 16px;">
          <i class="industry icon" style="color: #ca8a04;"></i> 중부권 핵심 산업 벨트 및 정밀 배차 네트워크
        </h2>
        
        <div style="font-size: 1rem; line-height: 1.8; color: #334155;">
          <p>
            충청권은 대전 대덕연구개발특구의 첨단 시험 장비, 천안·아산의 반도체·디스플레이 공단, 청주 오창·오송의 2차전지 및 바이오 밸리, 서산 석유화학 및 당진 철강 단지 등 대한민국 핵심 산업의 중심지입니다.
          </p>

          <div class="ui two column stackable grid" style="margin-top: 10px;">
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="cogs icon" style="color: #0284c7;"></i> 정밀 장비 & 반도체·부품 특화 운송
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  진동과 충격에 민감한 연구 장비 및 전자 부품을 위해 <strong>무진동 에어서스펜션 차량, 윙바디, 리프트 차량</strong>을 맞춤 배차합니다.
                </div>
              </div>
            </div>
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="home icon" style="color: #10b981;"></i> 정부청사·공공기관 및 소형 이사
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  세종시 정부청사 공무원 이전, 대전·청주 혁신도시 공공기관 발령 이사 및 대학가(충남대, 카이스트, 충북대) 원룸이사 원스톱 지원.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 충청권 주요 노선별 표준 운임표 (2026-10 동기화) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 8px;">
          <i class="won sign icon" style="color: #10b981;"></i> 서울/수도권 ↔ 충청권 주요 지역 편도 운임 기준표
        </h2>
        <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 16px;">
          * 서울시청 기준 편도 단순 운송(상하차 기준) 기준이며, 리턴공차 배차 시 추가 할인(2~3만 원) 적용 가능합니다.
        </p>

        <!-- 데스크톱/태블릿용 표 -->
        <div class="ydk-desktop-table-wrap">
          <table class="ui unstackable celled structured table ydk-table" style="font-size: 0.95rem; text-align: center;">
            <thead style="background: #f1f5f9;">
              <tr>
                <th style="width: 25%;">도착 지역</th>
                <th style="width: 25%;">주요 거점</th>
                <th style="width: 25%;">1톤 카고</th>
                <th style="width: 25%;">2.5톤 트럭</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">충남 북부권</td>
                <td>천안, 아산, 당진</td>
                <td><strong style="color: #c2410c;">100,000 ~ 130,000원</strong></td>
                <td>160,000 ~ 180,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">충북 중부권</td>
                <td>청주, 진천, 음성</td>
                <td><strong style="color: #c2410c;">130,000 ~ 150,000원</strong></td>
                <td>180,000 ~ 200,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">대전 / 세종특별시</td>
                <td>유성, 둔산, 세종정부청사</td>
                <td><strong style="color: #c2410c;">140,000 ~ 160,000원</strong></td>
                <td>190,000 ~ 220,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">충남 서해안권</td>
                <td>서산, 태안, 보령(대천), 홍성</td>
                <td><strong style="color: #c2410c;">140,000 ~ 170,000원</strong></td>
                <td>200,000 ~ 230,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">충북 북부 / 충남 남부</td>
                <td>충주, 제천, 단양, 논산, 부여</td>
                <td><strong style="color: #c2410c;">150,000 ~ 180,000원</strong></td>
                <td>210,000 ~ 240,000원</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- 모바일 전용 카드 -->
        <div class="ydk-mobile-pricing-list" style="display: none;">
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">천안 / 아산 / 당진</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">10 ~ 13 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 16~18만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">청주 / 오창 / 진천</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">13 ~ 15 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 18~20만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">대전광역시 / 세종특별자치시</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">14 ~ 16 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 19~22만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">서산 / 태안 / 충주 / 제천</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">14 ~ 18 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 20~24만 원)</div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 장거리 화물 및 이사 이용 시 주의사항 (legacy 계승) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: var(--ydk-primary); margin-top: 0; margin-bottom: 14px;">
          <i class="shield alternate icon" style="color: var(--ydk-primary);"></i> 충청권 장거리 화물 운송 4대 체크포인트
        </h2>

        <div class="ui relaxed divided list" style="font-size: 0.98rem; line-height: 1.8; color: #334155;">
          <div class="item" style="padding: 12px 0;">
            <i class="certificate icon" style="color: #10b981; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">정식 관허업체 [관허 4042호]를 통한 안전 거래</strong>
              <div style="color: #64748b; margin-top: 2px;">
                고속도로를 이용하는 중장거리 화물은 이동 중 흔들림이나 돌발 상황이 발생할 수 있습니다. 무허가 중개업체 대신 적재물 보험이 완비된 정식 관허업체를 이용하셔야 사고 시 100% 보상이 가능합니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="sync alternate icon" style="color: #ca8a04; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">리턴공차(빈 차) 사전 예약으로 비용 절감</strong>
              <div style="color: #64748b; margin-top: 2px;">
                지방에서 서울로 짐을 싣고 온 후 대기 중인 차량이나 반대로 복귀하는 차량을 예약하시면 편도 독차보다 훨씬 저렴한 공차 운임으로 장거리 운송이 가능합니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="clock outline icon" style="color: #0284c7; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">상하차 시간 및 고속도로 통행료 확인</strong>
              <div style="color: #64748b; margin-top: 2px;">
                주요 고속도로 출퇴근 시간대 정체를 피하기 위해 오전 일찍(08시 이전) 상차하시거나 오후 시간대를 활용하시면 도착 예정 시간을 정확하게 맞출 수 있습니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="edit outline icon" style="color: #c2410c; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">화물 파손 방지 포장 및 기사 서면 확인</strong>
              <div style="color: #64748b; margin-top: 2px;">
                도자기, 정밀 기기, 가구류는 사전에 에어캡과 완충재로 충분히 포장해 주시고, 하차 직후 외관 검수를 거쳐 이상 유무를 기사와 함께 확인해 두시면 안전합니다.
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
            충청권 화물 직통 상담실
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.92rem;">대전·세종·천안·청주 실시간 배차</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 직통 상담 번호</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.7rem; font-weight: 800; color: var(--ydk-cta); text-decoration: none; display: block; margin-bottom: 6px;">
            <i class="phone icon"></i> <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b;">
            직통: 010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(야간·새벽 배차 및 휴일 정상 상담)</div>

          <div class="ui divider"></div>

          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 16px; text-align: left;">
            <strong>[충청권 전담 차량]</strong><br>
            • 1톤 카고, 호루차, 탑차, 윙바디<br>
            • 1.4톤 / 2.5톤 / 3.5톤 / 5톤 축차<br>
            • 정밀 기계 리프트 차량<br>
            • 세종 정부청사 및 기업 이전 전문
          </p>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid button" style="background-color: var(--ydk-cta); color: #fff; border-radius: 8px; font-weight: 700; padding: 14px;">
            <i class="phone icon"></i> 충청권 즉시 상담 연결
          </a>
        </div>
      </div>

      <!-- 리턴공차 안내 바로가기 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.05rem;">
            <i class="sync alternate icon" style="color: #ca8a04;"></i> 알뜰 리턴공차 활용하기
          </h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 12px;">
            충청 ↔ 수도권 왕복 차량의 빈 공간(혼적/합바)이나 공차를 이용해 물류비를 최대 30% 절감하세요.
          </p>
          <a href="<?= url('contents/area/area_info_06.php') ?>" class="ui fluid basic orange button" style="border-radius: 6px; font-weight: 700;">
            리턴공차 안내 보기 <i class="angle right icon"></i>
          </a>
        </div>
      </div>

      <!-- 온라인 견적 문의 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <i class="laptop icon" style="font-size: 2.2rem; color: #3b82f6; margin-bottom: 8px;"></i>
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">온라인 견적 문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">
            출발·도착지 상세 주소를 남겨주시면 가장 저렴한 직거래 운임을 산출해 드립니다.
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
