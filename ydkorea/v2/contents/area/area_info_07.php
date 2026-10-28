<?php
/**
 * 용달코리아 v2 용달 운임 기준표 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_info_07.html
 * 대상 경로: v2/contents/area/area_info_07.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$activeAreaCode = '07';
$pageTitle = '용달 운임 기준표 및 요금 책정 가이드 | ' . SITE_NAME;
$pageDescription = '1톤 용달 화물 운송료 및 소형 이사 비용 산출 기준 투명 정찰제 가이드. 거리별·권역별 표준 운임과 작업 옵션별 요금 체계 안내.';

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
      <span class="active">용달 운임 기준표</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="won sign icon"></i> 용달 운임 기준표 및 요금 책정 가이드
    </h1>
    <p class="ydk-page-desc">
      불투명한 바가지 요금 없는 정찰제 직거래! 거리·차종·작업 조건에 따른 합리적인 표준 요금 체계를 투명하게 공개합니다.
    </p>
  </header>

  <!-- 2. 공통 지역 정보 내비게이션 탭 -->
  <?php include __DIR__ . '/_area_nav.php'; ?>

  <!-- 3. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 1px solid #bfdbfe; border-radius: 12px; margin-bottom: 28px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
    <i class="calculator icon" style="color: var(--ydk-primary);"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #1e3a8a; margin-bottom: 6px;">
        사전 정찰제 운임 확정으로 현장 추가금 걱정 제로!
      </div>
      <p style="color: #1e293b; line-height: 1.6; margin: 0;">
        용달코리아는 전화 상담 시 출발지, 도착지, 짐 물량, 작업 조건을 명확히 파악하여 
        <strong>출발 전 최종 운임을 확정</strong>해 드리므로 안심하고 이용하실 수 있습니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문 (10 wide) -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 1톤 용달 표준 운임표 (2026-10 현실화 기준) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: var(--ydk-primary); margin-top: 0; margin-bottom: 8px;">
          <i class="table icon" style="color: var(--ydk-primary);"></i> 전국 주요 권역별 1톤 용달 표준 운임
        </h2>
        <p style="color: #64748b; font-size: 0.92rem; margin-bottom: 16px;">
          * 서울 기준 편도 단순운송(차량만 운송, 1층 상하차) 기준 예시 요금입니다.
        </p>

        <!-- 데스크톱/태블릿 표 -->
        <div class="ydk-desktop-table-wrap">
          <table class="ui unstackable celled structured table ydk-table" style="font-size: 0.95rem; text-align: center;">
            <thead style="background: #f1f5f9;">
              <tr>
                <th style="width: 25%;">권역 / 구간</th>
                <th style="width: 30%;">주요 대표 도시</th>
                <th style="width: 25%;">1톤 카고</th>
                <th style="width: 20%;">2.5톤 트럭</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">서울 시내 관내</td>
                <td>10km 이내 근거리 이동</td>
                <td><strong style="color: #c2410c;">50,000 ~ 60,000원</strong></td>
                <td>100,000 ~ 110,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">서울 시내 구간</td>
                <td>15 ~ 25km 도심 이동</td>
                <td><strong style="color: #c2410c;">60,000 ~ 90,000원</strong></td>
                <td>110,000 ~ 130,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">수도권 인접</td>
                <td>부천, 광명, 김포, 성남, 하남</td>
                <td><strong style="color: #c2410c;">70,000 ~ 90,000원</strong></td>
                <td>120,000 ~ 140,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">수도권 외곽</td>
                <td>수원, 용인, 안산, 파주, 평택</td>
                <td><strong style="color: #c2410c;">80,000 ~ 120,000원</strong></td>
                <td>130,000 ~ 160,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">충청권</td>
                <td>천안, 아산, 청주, 대전, 세종</td>
                <td><strong style="color: #c2410c;">100,000 ~ 160,000원</strong></td>
                <td>160,000 ~ 220,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">강원권</td>
                <td>춘천, 원주, 홍천, 강릉, 속초</td>
                <td><strong style="color: #c2410c;">100,000 ~ 190,000원</strong></td>
                <td>160,000 ~ 250,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">호남권</td>
                <td>전주, 군산, 익산, 광주, 목포</td>
                <td><strong style="color: #c2410c;">160,000 ~ 280,000원</strong></td>
                <td>220,000 ~ 330,000원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #1e293b;">영남권</td>
                <td>김천, 구미, 대구, 포항, 부산, 창원</td>
                <td><strong style="color: #c2410c;">160,000 ~ 260,000원</strong></td>
                <td>220,000 ~ 330,000원</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- 모바일 전용 카드 -->
        <div class="ydk-mobile-pricing-list" style="display: none;">
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
              <span style="font-weight: 700; color: #1e293b;">서울 시내 관내 운송</span>
              <span style="font-weight: 800; color: #c2410c;">5 ~ 6 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">10km 이내 단순운송 (2.5톤: 10~11만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
              <span style="font-weight: 700; color: #1e293b;">수도권 인접 / 외곽</span>
              <span style="font-weight: 800; color: #c2410c;">7 ~ 12 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">부천/성남/수원/용인/파주 (2.5톤: 12~16만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
              <span style="font-weight: 700; color: #1e293b;">충청권 / 강원권</span>
              <span style="font-weight: 800; color: #c2410c;">10 ~ 19 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">천안/대전/춘천/강릉 (2.5톤: 16~25만 원)</div>
          </div>
          <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
              <span style="font-weight: 700; color: #1e293b;">호남권 / 영남권</span>
              <span style="font-weight: 800; color: #c2410c;">16 ~ 28 만원</span>
            </div>
            <div style="font-size: 0.85rem; color: #64748b;">전주/광주/대구/부산 (2.5톤: 22~33만 원)</div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 차종별 특수 옵션 및 이사 작업 요금 기준 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 14px;">
          <i class="cogs icon" style="color: #10b981;"></i> 차종 옵션 및 이사 작업 부가 요금 안내
        </h2>

        <div class="ui two column stackable grid">
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
              <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 8px; font-size: 1.05rem;">
                <i class="truck icon" style="color: #0284c7;"></i> 특수 차종 옵션
              </div>
              <ul style="margin: 0; padding-left: 20px; font-size: 0.92rem; color: #475569; line-height: 1.7;">
                <li><strong>탑차 / 호루차:</strong> + 20,000 ~ 40,000원 (비·눈 날씨 보호 및 밀폐 운송)</li>
                <li><strong>리프트차:</strong> + 20,000 ~ 30,000원 (오토바이, 대형복사기, 금고 등)</li>
                <li><strong>야간 / 심야 운송:</strong> 22시 이후 상하차 시 야간 할증 2~3만 원</li>
              </ul>
            </div>
          </div>

          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
              <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 8px; font-size: 1.05rem;">
                <i class="dolly icon" style="color: #10b981;"></i> 이사 작업 조건별 요금 (서울 1층 기준)
              </div>
              <ul style="margin: 0; padding-left: 20px; font-size: 0.92rem; color: #475569; line-height: 1.7;">
                <li><strong>단순 운송 (차량만):</strong> 6 ~ 9만 원 (거리 비례)</li>
                <li><strong>일반이사 (고객도움+기사):</strong> 평일 10~15만 원 / 손없는날 12~17만 원</li>
                <li><strong>인부 1명 추가 (기사+인부 1명):</strong> 평일 25~30만 원 / 손없는날 27~32만 원</li>
                <li><strong>포장이사 (기사+인부 1명):</strong> 평일 35~40만 원 / 손없는날 40~45만 원</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 운임 문의 시 필수 3요소 (legacy 계승) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #f59e0b; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #92400e; margin-top: 0; margin-bottom: 12px;">
          <i class="phone volume icon" style="color: #f59e0b;"></i> 전화 상담 시 이것만 알려주시면 1분 견적 완성!
        </h2>
        <p style="color: #475569; font-size: 0.95rem; line-height: 1.6; margin-bottom: 16px;">
          "그냥 대충 얼마예요?"라고 물으시면 정확한 산출이 어렵습니다. 아래 3가지를 알려주시면 가장 저렴한 직거래 최저가를 즉시 안내해 드립니다.
        </p>

        <div class="ui three column stackable grid" style="text-align: center;">
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 12px; height: 100%;">
              <div style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">1. 출발·도착지 상세 동</div>
              <div style="font-size: 0.85rem; color: #64748b; margin-top: 4px;">출발지와 도착지의 구/동 지명 및 엘리베이터 유무(층수)</div>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 12px; height: 100%;">
              <div style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">2. 운송 물품 종류 & 크기</div>
              <div style="font-size: 0.85rem; color: #64748b; margin-top: 4px;">박스 수량, 가구/가전 규격 (침대, 양문형냉장고 등)</div>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 12px; height: 100%;">
              <div style="font-weight: 700; color: #1e293b; font-size: 1.05rem;">3. 작업 지원 여부</div>
              <div style="font-size: 0.85rem; color: #64748b; margin-top: 4px;">단순 차량 운송만인지, 기사님과 함께 나를 것인지 선택</div>
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
            실시간 운임 견적 문의
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.92rem;">차주 직거래 최저가 즉시 산출</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 직통 상담 번호</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.7rem; font-weight: 800; color: var(--ydk-cta); text-decoration: none; display: block; margin-bottom: 6px;">
            <i class="phone icon"></i> <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b;">
            직통: 010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(365일 실시간 운송비 즉시 조회)</div>

          <div class="ui divider"></div>

          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 16px; text-align: left;">
            <strong>[요금 보장 3원칙]</strong><br>
            • 사전 정찰제 확정 운임 원칙<br>
            • 차주-화주 100% 직거래 최저가<br>
            • 정식 관허 [제4042호] 보증
          </p>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid button" style="background-color: var(--ydk-cta); color: #fff; border-radius: 8px; font-weight: 700; padding: 14px;">
            <i class="phone icon"></i> 전화로 운임 바로 조회
          </a>
        </div>
      </div>

      <!-- 상세 요금표 바로가기 링크 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="margin: 0 0 10px 0; color: #1e293b; font-size: 1.05rem;">
            <i class="external alternate icon" style="color: #0284c7;"></i> 연관 요금 안내 바로가기
          </h4>
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <a href="<?= url('contents/trt/trt.php') ?>" class="ui fluid basic blue button" style="text-align: left; border-radius: 6px;">
              <i class="won sign icon"></i> 4대 권역 정밀 화물 요금표
            </a>
            <a href="<?= url('contents/info/yd_mov.php') ?>" class="ui fluid basic teal button" style="text-align: left; border-radius: 6px;">
              <i class="truck icon"></i> 1톤 용달이사 비용 가이드
            </a>
            <a href="<?= url('contents/size/car_size.php') ?>" class="ui fluid basic grey button" style="text-align: left; border-radius: 6px;">
              <i class="ruler combined icon"></i> 차량 적재함 규격표
            </a>
          </div>
        </div>
      </div>

      <!-- 온라인 견적 문의 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <i class="laptop icon" style="font-size: 2.2rem; color: #3b82f6; margin-bottom: 8px;"></i>
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">온라인 견적 문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">
            운송 품목과 이동 구간을 남겨주시면 최적의 배차 요금을 안내해 드립니다.
          </p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            견적 신청서 작성 <i class="angle right icon"></i>
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
