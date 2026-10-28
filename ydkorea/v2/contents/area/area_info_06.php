<?php
/**
 * 용달코리아 v2 리턴 공차 안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_info_06.html
 * 대상 경로: v2/contents/area/area_info_06.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$activeAreaCode = '06';
$pageTitle = '전국 리턴 공차 및 혼적(합바) 알선 안내 | ' . SITE_NAME;
$pageDescription = '전국 각지에서 짐 하차 후 원래 연고지로 복귀하는 빈 차(리턴공차)와 혼적 화물을 실시간 매칭하여 정상 운임 대비 최대 30~50% 비용을 획기적으로 낮추는 알뜰 운송 시스템 안내.';

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
      <span class="active">리턴 공차 안내</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="sync alternate icon"></i> 전국 리턴 공차 및 혼적 알선 안내
    </h1>
    <p class="ydk-page-desc">
      지방에서 상경한 후 원래 차고지로 돌아가는 대기 차량을 실시간으로 연결하여 장거리 물류비를 대폭 줄여드립니다.
    </p>
  </header>

  <!-- 2. 공통 지역 정보 내비게이션 탭 -->
  <?php include __DIR__ . '/_area_nav.php'; ?>

  <!-- 3. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #fefce8 0%, #fef9c3 100%); border: 1px solid #fde047; border-radius: 12px; margin-bottom: 28px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
    <i class="coins icon" style="color: #ca8a04;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #854d0e; margin-bottom: 6px;">
        빈 차로 돌아가지 않아 차주도 좋고, 화주는 최대 30~50% 운임 절감!
      </div>
      <p style="color: #422006; line-height: 1.6; margin: 0;">
        용달코리아의 실시간 전국 화물망을 통해 노선이 일치하는 최적의 귀로 차량을 찾아드립니다. 
        <strong>정식 관허 [제4042호]</strong>의 검증된 차주와 함께 안전하고 저렴하게 장거리 운송을 해결하세요.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문 (10 wide) -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 리턴 공차란 무엇인가? -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #ca8a04; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #854d0e; margin-top: 0; margin-bottom: 16px;">
          <i class="question circle outline icon" style="color: #ca8a04;"></i> 리턴 공차(Return Cargo)와 혼적(합바)의 원리
        </h2>
        
        <div style="font-size: 1rem; line-height: 1.8; color: #334155;">
          <p>
            부산, 광주, 대구, 대전 등 전국 각 지방에서 화물을 싣고 서울·수도권으로 상경한 차량은 하차 후 다시 자신의 원래 거주지나 차고지로 돌아가야 합니다. 빈 차로 내려가면 유류비와 통행료 손실이 발생하므로, <strong>해당 방향으로 내려가는 화주 고객과 매칭</strong>하면 파격적으로 저렴한 운임이 형성됩니다.
          </p>

          <div style="background: #f0fdf4; border-left: 4px solid #10b981; padding: 16px 20px; border-radius: 0 8px 8px 0; margin: 18px 0;">
            <strong style="color: #065f46; font-size: 1.05rem;">혼적(합바짐) 운송이란?</strong>
            <p style="margin: 6px 0 0 0; color: #166534; font-size: 0.95rem; line-height: 1.6;">
              독차(차량 1대를 혼자 전부 쓰는 것)를 채우지 못하는 파레트 1~2개 분량의 짐이나 박스 몇 개, 냉장고·세탁기 단일 가전 등 소량 짐을 같은 방향으로 내려가는 대형 트럭의 남는 적재 공간에 함께 실어 보내는 알뜰 운송 방식입니다.
            </p>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 일반 독차 vs 리턴공차 vs 혼적 비교표 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 8px;">
          <i class="balance scale icon" style="color: #10b981;"></i> 운송 방식별 특징 및 비용 비교
        </h2>
        <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 16px;">
          고객님의 화물 물량과 일정 긴급도에 따라 가장 유리한 방식을 선택하실 수 있습니다.
        </p>

        <!-- 데스크톱/태블릿 표 -->
        <div class="ydk-desktop-table-wrap">
          <table class="ui unstackable celled structured table ydk-table" style="font-size: 0.95rem; text-align: center;">
            <thead style="background: #f1f5f9;">
              <tr>
                <th style="width: 25%;">구분</th>
                <th style="width: 25%;">일반 편도 독차</th>
                <th style="width: 25%;">리턴 공차 (추천)</th>
                <th style="width: 25%;">혼적 (합바짐)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">운임 수준</td>
                <td>정상 표준 운임 (100%)</td>
                <td><strong style="color: #c2410c;">정상가 대비 20~30% 절감</strong></td>
                <td><strong style="color: #10b981;">정상가 대비 40~50% 절감</strong></td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">적재 공간</td>
                <td>적재함 100% 단독 사용</td>
                <td>적재함 100% 단독 사용</td>
                <td>남는 적재 공간 공유 (일부)</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">배차 시간</td>
                <td>고객 희망 즉시 배차</td>
                <td>시간 조율 탄력 배차</td>
                <td>당착 또는 익일착 조율</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">적합한 대상</td>
                <td>긴급 납품, 일반/포장이사</td>
                <td>장거리 기업물류, 소형 이사</td>
                <td>파레트 1~2개, 단일 가전·가구</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- 모바일 전용 카드 -->
        <div class="ydk-mobile-pricing-list" style="display: none;">
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
              <span style="font-weight: 700; color: #1e293b;">1. 일반 편도 독차</span>
              <span style="font-weight: 700; color: #64748b;">정상 운임</span>
            </div>
            <div style="font-size: 0.88rem; color: #475569;">시간이 촉박하고 차를 통째로 단독 사용할 때 적합합니다.</div>
          </div>
          <div style="background: #fefce8; border: 1px solid #fde047; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
              <span style="font-weight: 700; color: #854d0e;">2. 리턴 공차 (인기)</span>
              <span style="font-weight: 800; color: #c2410c;">20~30% 절감</span>
            </div>
            <div style="font-size: 0.88rem; color: #713f12;">단독 사용하면서 귀로 차량 매칭으로 비용을 크게 아낍니다.</div>
          </div>
          <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
              <span style="font-weight: 700; color: #166534;">3. 혼적 (합바짐)</span>
              <span style="font-weight: 800; color: #10b981;">최대 50% 절감</span>
            </div>
            <div style="font-size: 0.88rem; color: #15803d;">소량 짐이나 가전 1~2개를 같은 노선 트럭에 함께 싣습니다.</div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 물품 상차 전 고객 확인 필수 3가지 (legacy 원문 완벽 계승) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: var(--ydk-primary); margin-top: 0; margin-bottom: 14px;">
          <i class="clipboard check icon" style="color: var(--ydk-primary);"></i> 리턴공차 상차 전 꼭 메모해야 할 3가지
        </h2>
        <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 16px;">
          차량에 짐을 적재하고 차량이 출발하기 전 아래 3가지 인적사항을 기사에게 직접 확인해 두시면 운송 중 실시간 위치 파악과 안전 관리가 확실해집니다.
        </p>

        <div class="ui three column stackable grid" style="text-align: center;">
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px 14px; height: 100%;">
              <i class="car icon" style="font-size: 2.2rem; color: #0284c7; margin-bottom: 8px;"></i>
              <div style="font-weight: 700; color: #1e293b; font-size: 1.1rem;">1. 차량 등록번호</div>
              <div style="font-size: 0.88rem; color: #64748b; margin-top: 4px;">운행 트럭의 정확한 차량 번호판 메모</div>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px 14px; height: 100%;">
              <i class="mobile alternate icon" style="font-size: 2.2rem; color: #10b981; margin-bottom: 8px;"></i>
              <div style="font-weight: 700; color: #1e293b; font-size: 1.1rem;">2. 기사 휴대전화</div>
              <div style="font-size: 0.88rem; color: #64748b; margin-top: 4px;">운행 기사의 직통 연락처 상호 저장</div>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px 14px; height: 100%;">
              <i class="warehouse icon" style="font-size: 2.2rem; color: #f59e0b; margin-bottom: 8px;"></i>
              <div style="font-weight: 700; color: #1e293b; font-size: 1.1rem;">3. 차량 연고 차고지</div>
              <div style="font-size: 0.88rem; color: #64748b; margin-top: 4px;">기사의 원래 소속 지역 및 차고지 확인</div>
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
            리턴공차 전담 배차실
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.92rem;">전국 상경/귀로 공차 실시간 검색</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 직통 상담 번호</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.7rem; font-weight: 800; color: var(--ydk-cta); text-decoration: none; display: block; margin-bottom: 6px;">
            <i class="phone icon"></i> <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b;">
            직통: 010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(원하는 노선의 빈 차를 즉시 찾아드립니다)</div>

          <div class="ui divider"></div>

          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 16px; text-align: left;">
            <strong>[공차 매칭 노선]</strong><br>
            • 서울/수도권 ↔ 부산·대구·영남<br>
            • 서울/수도권 ↔ 광주·전주·호남<br>
            • 서울/수도권 ↔ 대전·세종·충청<br>
            • 1톤 카고, 윙바디, 5톤 대형 트럭
          </p>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid button" style="background-color: var(--ydk-cta); color: #fff; border-radius: 8px; font-weight: 700; padding: 14px;">
            <i class="phone icon"></i> 공차 즉시 상담 연결
          </a>
        </div>
      </div>

      <!-- 온라인 견적 문의 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px; text-align: center;">
          <i class="laptop icon" style="font-size: 2.2rem; color: #3b82f6; margin-bottom: 8px;"></i>
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">공차 온라인 견적 신청</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">
            보내실 짐의 크기와 출발/도착지를 남겨주시면 가장 저렴한 공차 매칭 견적을 문자로 보내드립니다.
          </p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            견적 신청 작성 <i class="angle right icon"></i>
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
