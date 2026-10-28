<?php
/**
 * 용달코리아 v2 서울·수도권 화물안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_info_01.html
 * 대상 경로: v2/contents/area/area_info_01.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$activeAreaCode = '01';
$pageTitle = '서울·수도권 화물안내 (서울·경기·인천) | ' . SITE_NAME;
$pageDescription = '서울 25개 자치구 및 경기·인천 수도권 전역 1톤 용달, 다마스, 라보, 1.4톤~5톤 화물 실시간 직거래 배차. 도심 지하주차장 진입 탑차, 당일 특급 배송 및 최저가 정찰제 운임 안내.';

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
      <span class="active">서울·수도권 화물안내</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="building outline icon"></i> 서울·수도권 화물안내
    </h1>
    <p class="ydk-page-desc">
      서울 25개 자치구와 경기도, 인천광역시 전역을 거미줄처럼 연결하는 1톤 용달·화물 실시간 직거래 배차 네트워크입니다.
    </p>
  </header>

  <!-- 2. 공통 지역 정보 내비게이션 탭 -->
  <?php include __DIR__ . '/_area_nav.php'; ?>

  <!-- 3. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 1px solid #bfdbfe; border-radius: 12px; margin-bottom: 28px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
    <i class="shipping fast icon" style="color: var(--ydk-primary);"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #1e3a8a; margin-bottom: 6px;">
        서울 및 수도권 전역 30분~1시간 이내 신속 현장 배차!
      </div>
      <p style="color: #1e293b; line-height: 1.6; margin: 0;">
        빌딩 밀집 도심지부터 대단지 아파트 지하주차장(2.1m~2.3m 저상탑차), 판교·가산 테크노밸리, 남동·시화 공단까지 
        <strong>정식 관허 [제4042호] 인증 차주</strong>가 가장 빠르고 경제적인 직거래 운송을 약속합니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문 (10 wide) -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 서울·수도권 화물 운송 핵심 특징 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: var(--ydk-primary); margin-top: 0; margin-bottom: 16px;">
          <i class="map signs icon" style="color: var(--ydk-primary);"></i> 수도권 도심 및 비즈니스 특화 운송 시스템
        </h2>
        
        <div style="font-size: 1rem; line-height: 1.8; color: #334155;">
          <p>
            서울과 수도권은 복잡한 도심 교통망과 건물 구조적 특수성(높이 제한 지하주차장, 주정차 곤란 구역, 출퇴근 혼잡 시간대)이 공존합니다. 용달코리아는 이러한 환경에 최적화된 맞춤형 차량을 즉시 연결합니다.
          </p>

          <div class="ui two column stackable grid" style="margin-top: 10px;">
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: var(--ydk-primary); margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="warehouse icon" style="color: #0284c7;"></i> 도심 빌딩 & 지하주차장 진입
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  신축 아파트 및 업무용 빌딩 지하(2.1m~2.3m) 진입이 가능한 <strong>저상 탑차 및 윙바디</strong>를 우선 배차하여 날씨에 구애받지 않고 안전하게 상·하차합니다.
                </div>
              </div>
            </div>
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: var(--ydk-primary); margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="clock outline icon" style="color: #10b981;"></i> 신속 당일 배차 & 정시 배송
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  강남 테헤란로, 여의도 금융가, 구로·가산디지털단지 등 긴급 기업 화물 및 시제품 배송을 접수 후 <strong>30~60분 이내 상차</strong>하여 정확하게 배송합니다.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 2026-10 수도권 1톤 운송 요금 가이드 (사이트가이드 동기화) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 8px;">
          <i class="won sign icon" style="color: #10b981;"></i> 서울·수도권 1톤 용달 표준 운임 기준표
        </h2>
        <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 16px;">
          * 서울시청 기준 편도 단순 운송(건물 앞 상차·하차) 예시이며, 작업 조건·시간대·탑차 여부에 따라 변동될 수 있습니다.
        </p>

        <!-- 데스크톱/태블릿용 구조화 표 -->
        <div class="ydk-desktop-table-wrap">
          <table class="ui unstackable celled structured table ydk-table" style="font-size: 0.95rem; text-align: center;">
            <thead style="background: #f1f5f9;">
              <tr>
                <th style="width: 25%;">운송 구간</th>
                <th style="width: 25%;">거리 기준</th>
                <th style="width: 25%;">1톤 카고</th>
                <th style="width: 25%;">2.5톤 트럭</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">서울 시내 관내 운송</td>
                <td>10km 이내 근거리</td>
                <td><strong style="color: #c2410c;">50,000 ~ 60,000원</strong></td>
                <td>100,000 ~ 110,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">서울 시내 구간 이동</td>
                <td>15 ~ 25km (구간간)</td>
                <td><strong style="color: #c2410c;">60,000 ~ 90,000원</strong></td>
                <td>110,000 ~ 130,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">서울 ↔ 인접 경기/인천</td>
                <td>부천, 광명, 김포, 하남, 성남</td>
                <td><strong style="color: #c2410c;">70,000 ~ 90,000원</strong></td>
                <td>120,000 ~ 140,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">서울 ↔ 외곽 수도권</td>
                <td>수원, 용인, 안산, 파주, 의정부</td>
                <td><strong style="color: #c2410c;">80,000 ~ 110,000원</strong></td>
                <td>130,000 ~ 150,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">서울 ↔ 인천공항/강화/평택</td>
                <td>장거리 수도권 구간</td>
                <td><strong style="color: #c2410c;">100,000 ~ 130,000원</strong></td>
                <td>150,000 ~ 180,000원</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- 모바일 전용 스마트 카드 -->
        <div class="ydk-mobile-pricing-list" style="display: none;">
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">서울 시내 관내 운송</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">5 ~ 6 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">10km 이내 단순운송 (2.5톤: 10~11만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">서울 시내 구간 이동</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">6 ~ 9 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">15~25km 도심 이동 (2.5톤: 11~13만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">서울 ↔ 인접 경기·인천</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">7 ~ 9 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">부천/광명/성남/하남 (2.5톤: 12~14만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
              <span style="font-weight: 700; color: #1e293b;">서울 ↔ 외곽 수도권</span>
              <span style="font-weight: 800; color: #c2410c; font-size: 1.1rem;">8 ~ 11 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">수원/용인/안산/파주 (2.5톤: 13~15만 원)</div>
          </div>
        </div>

      </div>

      <!-- 섹션 3: 화물 및 이사 운송 전 필수 점검 4대 수칙 (legacy 원문 계승) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #f59e0b; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #92400e; margin-top: 0; margin-bottom: 14px;">
          <i class="clipboard check icon" style="color: #f59e0b;"></i> 화물 및 이사 운송 전 필수 점검 4대 수칙
        </h2>
        <p style="color: #475569; font-size: 0.95rem; line-height: 1.6; margin-bottom: 16px;">
          사전 확인이 미비할 경우 현장에서 불필요한 대기 시간이나 추가 비용이 발생할 수 있으니 아래 사항을 꼭 확인해 주시기 바랍니다.
        </p>

        <div class="ui relaxed divided list" style="font-size: 0.98rem; line-height: 1.8; color: #334155;">
          <div class="item" style="padding: 12px 0;">
            <i class="truck icon" style="color: var(--ydk-primary); font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">1. 화물 물량에 최적화된 차량 선택</strong>
              <div style="color: #64748b; margin-top: 2px;">
                어떤 차량을 써야 할지 모를 때는 대표번호(1688-2404) 상담원에게 물품 크기와 수량을 말씀하시면 카고, 탑차, 윙바디, 리프트 중 최적의 차종을 추천해 비용을 절감해 드립니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="boxes icon" style="color: #0284c7; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">2. 차량 도착 전 물품 1층 대기 준비</strong>
              <div style="color: #64748b; margin-top: 2px;">
                용달 화물 운송은 택배와 달리 시간제 배차로 운영됩니다. 차량 도착 전 물건을 상차 장소(1층 건물 앞)에 미리 내놓으시면 대기 비용 없이 신속한 상차가 진행됩니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="certificate icon" style="color: #10b981; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">3. 정식 허가 관허업체 [관허 4042호] 확인</strong>
              <div style="color: #64748b; margin-top: 2px;">
                무허가 업체를 이용하시면 운송 중 분실이나 파손 발생 시 피해보상을 받기 어렵습니다. 용달코리아는 정식 화물운송주선사업 관허 등록 업체로서 투명한 계약을 체결합니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 12px 0;">
            <i class="handshake outline icon" style="color: #c2410c; font-size: 1.3rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">4. 기사 도움 작업 시 사전 협의</strong>
              <div style="color: #64748b; margin-top: 2px;">
                혼자 들기 무거운 가구나 가전제품은 기사와 함께 운반 작업을 요청하시면 전문 인부를 별도로 부르는 것보다 훨씬 알뜰한 비용으로 안전하게 옮길 수 있습니다.
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 4: 서울 25개 구 및 경기 주요 지역 바로가기 -->
      <div class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); background: #f8fafc; border: 1px solid #e2e8f0;">
        <h3 style="font-size: 1.15rem; color: #1e293b; margin-top: 0; margin-bottom: 12px;">
          <i class="map marker alternate icon" style="color: #e11d48;"></i> 수도권 지역별 차주 등록 현황 확인하기
        </h3>
        <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 14px;">
          우리 동네에 등록된 대기 차주와 직거래로 통화하여 배차 일정을 조율할 수 있습니다.
        </p>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
          <a href="<?= url('contents/info/area_01.php') ?>" class="ui small primary button" style="border-radius: 6px;">
            <i class="building icon"></i> 서울 25개 구 차주 안내
          </a>
          <a href="<?= url('contents/company/company_list.php') ?>" class="ui small teal button" style="border-radius: 6px;">
            <i class="list icon"></i> 수도권 등록업체 전체 리스트
          </a>
          <a href="<?= url('contents/trt/trt.php') ?>" class="ui small basic button" style="border-radius: 6px;">
            <i class="won sign icon"></i> 정밀 운송 요금표
          </a>
        </div>
      </div>

    </div>

    <!-- 우측 컬럼 (6 wide 사이드바) -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 전화 상담 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid var(--ydk-primary); overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: var(--ydk-primary); color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            수도권 화물 전담 상담실
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.92rem;">서울·경기·인천 30분 즉시 배차</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 직통 전화 (원클릭 통화)</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.7rem; font-weight: 800; color: var(--ydk-cta); text-decoration: none; display: block; margin-bottom: 6px;">
            <i class="phone icon"></i> <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b;">
            직통: 010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(연중무휴 08:00 ~ 21:00 야간·휴일 예약 가능)</div>

          <div class="ui divider"></div>

          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 16px; text-align: left;">
            <strong>[배차 가능 차량]</strong><br>
            • 1톤 카고 / 호루차 / 리프트차<br>
            • 1톤 지하주차장 진입 탑차 (윙바디)<br>
            • 1.4톤, 2.5톤, 3.5톤, 5톤 개별화물<br>
            • 원룸이사, 학생이사, 사무실 이전
          </p>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid button" style="background-color: var(--ydk-cta); color: #fff; border-radius: 8px; font-weight: 700; padding: 14px;">
            <i class="phone icon"></i> 수도권 즉시 상담 연결
          </a>
        </div>
      </div>

      <!-- 온라인 견적 문의 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px; text-align: center;">
          <i class="laptop icon" style="font-size: 2.2rem; color: #3b82f6; margin-bottom: 8px;"></i>
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">온라인 간편 견적 신청</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">
            통화가 곤란하신 분은 출발지, 도착지, 화물 품목을 남겨주시면 최적 운임을 문자로 신속히 안내해 드립니다.
          </p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            견적 신청하기 <i class="angle right icon"></i>
          </a>
        </div>
      </div>

      <!-- 관허 4042호 보증 뱃지 세그먼트 -->
      <div class="ui segment" style="border-radius: 12px; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 18px;">
        <h4 style="color: #166534; margin-top: 0; margin-bottom: 8px; font-size: 1rem;">
          <i class="shield alternate icon" style="color: #16a34a;"></i> 안심 보증 시스템
        </h4>
        <ul style="margin: 0; padding-left: 20px; font-size: 0.88rem; color: #15803d; line-height: 1.6;">
          <li>화물운송주선사업 정식 관허 제4042호</li>
          <li>적재물 배상책임보험 가입 차량 배차</li>
          <li>차주-화주 100% 직거래 정찰제 운임</li>
          <li>불필요한 웃돈·부당 요구 근절 보장</li>
        </ul>
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
