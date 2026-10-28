<?php
/**
 * 용달코리아 v2 영남권 화물안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_info_04.html
 * 대상 경로: v2/contents/area/area_info_04.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$activeAreaCode = '04';
$pageTitle = '영남권 화물안내 (부산·대구·울산·경남·경북) | ' . SITE_NAME;
$pageDescription = '부산, 대구, 울산, 창원, 김해, 포항, 구미 등 영남 산업벨트와 수도권을 잇는 1톤 용달, 2.5톤, 5톤 대량 정기 배차. 경부선 야간 특급 상차 및 상경 리턴공차 매칭 안내.';

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
      <span class="active">영남권 화물안내</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="industry icon"></i> 영남권 화물안내 (부산·대구·울산·경남·경북)
    </h1>
    <p class="ydk-page-desc">
      대한민국 최대의 산업 동맥 경부고속도로망! 부산·대구·울산·창원·구미 등 영남 전역과 수도권을 잇는 초고속 정기 배차망입니다.
    </p>
  </header>

  <!-- 2. 공통 지역 정보 내비게이션 탭 -->
  <?php include __DIR__ . '/_area_nav.php'; ?>

  <!-- 3. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 1px solid #bfdbfe; border-radius: 12px; margin-bottom: 28px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
    <i class="shipping fast icon" style="color: var(--ydk-primary);"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #1e3a8a; margin-bottom: 6px;">
        경부선 직통 야간 상차 → 익일 새벽·오전착 정시 배송!
      </div>
      <p style="color: #1e293b; line-height: 1.6; margin: 0;">
        부산항 컨테이너 반출입, 창원·구미 기계전자 부품, 울산 자동차 부품 등 긴급 산업 화물을 위해 
        <strong>수도권 ↔ 영남권 1톤~5톤 전담 직거래 배차망</strong>을 24시간 가동합니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문 (10 wide) -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 영남권 주요 산업 거점 및 배차망 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: var(--ydk-primary); margin-top: 0; margin-bottom: 16px;">
          <i class="cogs icon" style="color: var(--ydk-primary);"></i> 영남 중화학·기계·수출입 산업 벨트 특화 운송
        </h2>
        
        <div style="font-size: 1rem; line-height: 1.8; color: #334155;">
          <p>
            영남권은 해양 수도 부산과 제1의 무역항 부산신항, 울산의 완성차·중공업, 창원의 방산·정밀기계 국가산단, 구미 전자단지, 포항 제철소, 대구 섬유·로봇 산업까지 대한민국 제조업의 중추입니다.
          </p>

          <div class="ui two column stackable grid" style="margin-top: 10px;">
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="truck icon" style="color: #0284c7;"></i> 중대형 기계 & 파레트 규격 운송
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  1톤 용달부터 3.5톤 광폭(파레트 6~8개), 5톤 축 윙바디(파레트 12~14개), 중량물 상하차용 리프트 특장차까지 전 차종 완비.
                </div>
              </div>
            </div>
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="sync alternate icon" style="color: #ca8a04;"></i> 부산·대구 상경 공차 알뜰 매칭
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  부산·경남에서 수도권으로 올라가는 수많은 대기 차주와 연결하여, 정상 독차 비용 대비 <strong>최대 30~40% 절감된 공차 운임</strong> 적용.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 영남권 주요 노선별 표준 운임표 (2026-10 동기화) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 8px;">
          <i class="won sign icon" style="color: #10b981;"></i> 서울/수도권 ↔ 영남권 주요 지역 편도 운임 기준표
        </h2>
        <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 16px;">
          * 서울 기준 편도 단순운송(상하차 기준) 기준이며, 리턴공차/혼적짐 이용 시 파격적인 할인 운임이 적용됩니다.
        </p>

        <!-- 데스크톱/태블릿 표 -->
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
                <td style="font-weight: 700; color: #1e293b;">경북 북부권</td>
                <td>문경, 상주, 안동, 영주, 예천</td>
                <td><strong style="color: #c2410c;">160,000 ~ 190,000원</strong></td>
                <td>220,000 ~ 250,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">경북 중남부권</td>
                <td>김천, 구미, 칠곡, 성주</td>
                <td><strong style="color: #c2410c;">170,000 ~ 200,000원</strong></td>
                <td>230,000 ~ 260,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">대구광역시 / 경산</td>
                <td>수성, 달서, 북구, 경산, 영천</td>
                <td><strong style="color: #c2410c;">180,000 ~ 220,000원</strong></td>
                <td>240,000 ~ 280,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">동해안 산업권</td>
                <td>포항, 경주, 영덕, 울진</td>
                <td><strong style="color: #c2410c;">200,000 ~ 240,000원</strong></td>
                <td>260,000 ~ 300,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">부산 / 울산 / 경남</td>
                <td>부산전역, 울산, 창원, 김해, 양산</td>
                <td><strong style="color: #c2410c;">220,000 ~ 260,000원</strong></td>
                <td>280,000 ~ 330,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">경남 서부 / 해안</td>
                <td>진주, 사천, 통영, 거제, 밀양</td>
                <td><strong style="color: #c2410c;">240,000 ~ 280,000원</strong></td>
                <td>300,000 ~ 350,000원</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- 모바일 전용 카드 -->
        <div class="ydk-mobile-pricing-list" style="display: none;">
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">김천 / 구미 / 안동</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">16 ~ 20 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 22~26만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">대구광역시 / 경산 / 영천</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">18 ~ 22 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 24~28만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">포항 / 경주 / 울산광역시</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">20 ~ 24 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 26~30만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">부산광역시 / 창원 / 김해 / 거제</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">22 ~ 28 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">1톤 기준 (2.5톤: 28~35만 원)</div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 장거리 이사 및 화물 운송 수칙 (legacy 계승) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: var(--ydk-primary); margin-top: 0; margin-bottom: 14px;">
          <i class="clipboard check icon" style="color: var(--ydk-primary);"></i> 영남 장거리 화물·이사 운송 4대 필수 지침
        </h2>

        <div class="ui relaxed divided list" style="font-size: 0.98rem; line-height: 1.8; color: #334155;">
          <div class="item" style="padding: 12px 0;">
            <i class="clock outline icon" style="color: #0284c7; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">1. 야간 상차 → 새벽·오전착 탄력 일정</strong>
              <div style="color: #64748b; margin-top: 2px;">
                서울 ↔ 부산 400km 거리는 주간 운행 시 고속도로 정체가 발생할 수 있습니다. 전날 저녁 18~20시 상차하여 익일 아침 08~09시 현장 하차하는 야간 배차를 이용하시면 당일 업무 공백 없이 정확하게 납품할 수 있습니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="boxes icon" style="color: #16a34a; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">2. 파레트 포장 및 지게차 상·하차 사전 확인</strong>
              <div style="color: #64748b; margin-top: 2px;">
                부품이나 완제품 화물은 규격 파레트에 적재 후 스트레치 필름(랩핑)을 3회 이상 단단히 감아주셔야 고속 주행 시 전도 사고를 예방할 수 있습니다. 현장 지게차 유무를 미리 알려주시면 윙바디 차량을 맞춰 보냅니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="certificate icon" style="color: #ca8a04; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">3. 정식 관허 [제4042호] 확인 및 서면 계약</strong>
              <div style="color: #64748b; margin-top: 2px;">
                장거리 이사나 대형 화물일수록 무허가 업체의 불법 하도급이나 운송 도중 추가 요금 요구 피해가 발생하기 쉽습니다. 관허 업체의 관인 서면 계약서를 작성하여 안전을 보장받으세요.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="check circle outline icon" style="color: #c2410c; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">4. 하차 현장 검수 및 확인</strong>
              <div style="color: #64748b; margin-top: 2px;">
                운송이 완료되면 하차 현장에서 물품 외관 손상 여부를 기사와 함께 육안으로 확인하시고, 만약 이상이 있을 경우 현장 작업 팀장의 확인을 서면으로 즉시 남겨두셔야 빠른 보상이 진행됩니다.
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
            영남권 화물 전담 상담실
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.92rem;">부산·대구·울산·창원 24시간 실시간 배차</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 직통 상담 번호</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.7rem; font-weight: 800; color: var(--ydk-cta); text-decoration: none; display: block; margin-bottom: 6px;">
            <i class="phone icon"></i> <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b;">
            직통: 010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(경부선 특급 야간 상차·휴일 배차)</div>

          <div class="ui divider"></div>

          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 16px; text-align: left;">
            <strong>[영남권 배차 라인업]</strong><br>
            • 1톤 카고 / 탑차 / 리프트차<br>
            • 3.5톤 광폭 윙바디 (파레트 6~8개)<br>
            • 5톤 축 윙바디 (파레트 12~14개)<br>
            • 부산·대구 상경 공차 및 혼적(합바)
          </p>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid button" style="background-color: var(--ydk-cta); color: #fff; border-radius: 8px; font-weight: 700; padding: 14px;">
            <i class="phone icon"></i> 영남권 즉시 상담 연결
          </a>
        </div>
      </div>

      <!-- 리턴공차 안내 바로가기 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.05rem;">
            <i class="sync alternate icon" style="color: #ca8a04;"></i> 부산·영남 상경 리턴공차
          </h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 12px;">
            수도권으로 복귀하는 빈 차를 이용하시면 독차 정상 요금보다 30% 이상 저렴하게 운송할 수 있습니다.
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
            상세한 화물 품목과 상·하차 장소를 남겨주시면 최적의 직거래 견적을 안내해 드립니다.
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
