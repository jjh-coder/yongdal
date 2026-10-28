<?php
/**
 * 용달코리아 v2 화물 취급 요령 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/area_info_08.html
 * 대상 경로: v2/contents/area/area_info_08.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$activeAreaCode = '08';
$pageTitle = '화물 취급 요령 및 안전 운송 체크리스트 | ' . SITE_NAME;
$pageDescription = '안전한 화물 운송을 위한 사전 포장 수칙, 상하차 대기 요령, 적재물 배상책임보험 및 관허 4042호 정식 계약을 통한 분실·파손 예방 가이드.';

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
      <span class="active">화물 취급 요령</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="clipboard check icon"></i> 화물 취급 요령 및 안전 수칙
    </h1>
    <p class="ydk-page-desc">
      운송 중 물품 손상과 분실을 사전에 완벽 차단! 안전 포장 요령부터 적재물 보험, 관허 계약 필수 체크리스트를 안내합니다.
    </p>
  </header>

  <!-- 2. 공통 지역 정보 내비게이션 탭 -->
  <?php include __DIR__ . '/_area_nav.php'; ?>

  <!-- 3. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #86efac; border-radius: 12px; margin-bottom: 28px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
    <i class="shield check icon" style="color: #16a34a;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #14532d; margin-bottom: 6px;">
        안전한 운송의 시작은 "올바른 포장과 관허업체 계약"입니다!
      </div>
      <p style="color: #166534; line-height: 1.6; margin: 0;">
        화물 용달은 택배와 달리 개별 화물 특성에 맞추어 적재됩니다. 
        <strong>정식 관허 [제4042호]</strong>의 전문 지침을 미리 확인하시면 예기치 못한 사고나 분쟁을 100% 예방할 수 있습니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문 (10 wide) -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 화물 운송 도착 전 필수 준비 수칙 (legacy 원문 계승) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: var(--ydk-primary); margin-top: 0; margin-bottom: 16px;">
          <i class="boxes icon" style="color: var(--ydk-primary);"></i> 차량 도착 전 화주 고객 준비 수칙 (택배와의 차이)
        </h2>
        
        <div style="font-size: 1rem; line-height: 1.8; color: #334155;">
          <p>
            용달 화물 운송은 기사 1명이 정해진 배차 시간 내에 고객의 화물만을 단독 또는 혼적으로 운송하는 시스템입니다. 택배처럼 집안에 들어가서 물건을 포장해 오는 것이 아니므로, <strong>차량 도착 전 준비</strong>가 매우 중요합니다.
          </p>

          <div class="ui two column stackable grid" style="margin-top: 10px;">
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="building icon" style="color: #0284c7;"></i> 차량 도착 전 1층 밖 대기
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  단순 운송의 경우 차량이 도착하기 전 물품을 건물 1층 입구나 주차장 앞까지 미리 내려놓으셔야 도착 즉시 신속한 적재가 이루어집니다.
                </div>
              </div>
            </div>
            <div class="column">
              <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 18px 16px; height: 100%;">
                <div style="font-weight: 700; color: #1e3a8a; margin-bottom: 6px; font-size: 1.05rem;">
                  <i class="lock icon" style="color: #e11d48;"></i> 귀중품은 직접 본인 휴대
                </div>
                <div style="font-size: 0.92rem; color: #475569;">
                  현금, 귀금속, 통장, 유가증권, 중요한 계약서 등은 차량 적재함에 싣지 마시고 이사 전날 고객님께서 가방에 직접 챙겨 소지하셔야 합니다.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 물품 유형별 안전 포장 가이드 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 14px;">
          <i class="box open icon" style="color: #10b981;"></i> 주요 품목별 올바른 포장 가이드
        </h2>

        <div class="ui list" style="font-size: 0.98rem; line-height: 1.8; color: #334155;">
          <div class="item" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
            <i class="couch icon" style="color: #0284c7; font-size: 1.2rem;"></i>
            <div class="content">
              <strong>가구류 (장롱, 침대 매트리스, 서랍장, 소파)</strong>
              <div style="color: #64748b; font-size: 0.92rem;">
                서랍장 안의 내용물은 비운 뒤 테이프로 서랍을 고정합니다. 매트리스는 전용 방수 비닐 커버를 씌우고, 원목 가구 모서리는 두꺼운 완충재로 보호합니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
            <i class="tv icon" style="color: #ca8a04; font-size: 1.2rem;"></i>
            <div class="content">
              <strong>가전제품 (대형 TV, 냉장고, 세탁기, PC 모니터)</strong>
              <div style="color: #64748b; font-size: 0.92rem;">
                냉장고는 운송 전날 전원을 끄고 내부 성에와 물기를 완전히 제거합니다. 세탁기 배수 호스 물을 빼내고, TV와 모니터 패널은 에어캡 3중 포장 후 전용 상자에 넣습니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 10px 0; border-bottom: 1px solid #f1f5f9;">
            <i class="glass martini icon" style="color: #e11d48; font-size: 1.2rem;"></i>
            <div class="content">
              <strong>유리 및 식기류 (거울, 액자, 도자기, 그릇)</strong>
              <div style="color: #64748b; font-size: 0.92rem;">
                신문지나 에어캡으로 낱개 포장 후 상자 바닥과 틈새에 완충재를 채워 흔들리지 않게 하고, 상자 외부에 <strong>[취급주의 / 파손주의]</strong> 문구를 크게 표기합니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 10px 0;">
            <i class="archive icon" style="color: #10b981; font-size: 1.2rem;"></i>
            <div class="content">
              <strong>일반 잡화 및 의류, 도서류</strong>
              <div style="color: #64748b; font-size: 0.92rem;">
                책이나 서류 등 무거운 짐은 작은 상자에 나누어 담고, 의류나 이불은 큰 비닐봉지에 먼저 넣은 뒤 상자에 담아 먼지와 습기를 차단합니다.
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 적재물 보험 및 계약 분실/파손 방지 5계명 (legacy 완벽 계승) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #f59e0b; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px; background: #fff;">
        <h2 style="font-size: 1.25rem; color: #92400e; margin-top: 0; margin-bottom: 14px;">
          <i class="file contract icon" style="color: #f59e0b;"></i> 분실·파손 방지 및 피해보상 보증 5계명
        </h2>

        <div class="ui relaxed divided list" style="font-size: 0.98rem; line-height: 1.8; color: #334155;">
          <div class="item" style="padding: 10px 0;">
            <i class="check circle icon" style="color: #10b981; font-size: 1.2rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">1. 적재물 보험의 법적 기준 확인 (5톤 기준)</strong>
              <div style="color: #64748b; margin-top: 2px;">
                화물 적재물 보험은 5톤 초과 차량은 법적 의무보험이나, 5톤 미만 소형 화물차는 임의보험입니다. 고가품 운송 시 사전에 보험 가입 차량을 요청해 두셔야 완벽한 보상을 받을 수 있습니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 10px 0;">
            <i class="check circle icon" style="color: #10b981; font-size: 1.2rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">2. 반드시 정식 관허업체 [관허 4042호] 이용</strong>
              <div style="color: #64748b; margin-top: 2px;">
                인터넷에 홈페이지나 사업자번호가 있어도 화물운송주선사업 관허가 없는 무자격 중개상이 많습니다. 관허 등록 업체를 이용하셔야 사고 발생 시 법적 보호를 받습니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 10px 0;">
            <i class="check circle icon" style="color: #10b981; font-size: 1.2rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">3. 포장이사는 관인 서면 계약서 작성</strong>
              <div style="color: #64748b; margin-top: 2px;">
                포장이사를 진행할 때는 관허업체의 관인 계약서에 작업 차량 톤수, 투입 인원 수(기사+인부+주방이모), 옵션 사항을 서면으로 꼼꼼히 기재합니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 10px 0;">
            <i class="check circle icon" style="color: #10b981; font-size: 1.2rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">4. 계약서상 차량 및 투입 인원 현장 일치 확인</strong>
              <div style="color: #64748b; margin-top: 2px;">
                작업 시작 전 계약서에 명시된 차량 크기와 작업 인원이 제대로 투입되었는지 현장에서 확인하셔야 원활한 작업이 진행됩니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 10px 0;">
            <i class="check circle icon" style="color: #10b981; font-size: 1.2rem;"></i>
            <div class="content">
              <strong style="color: #0f172a;">5. 작업 종료 직후 파손품 확인 및 현장 팀장 서면 확인 필수</strong>
              <div style="color: #64748b; margin-top: 2px;">
                하차가 완료되면 물품 파손 여부를 기사와 함께 확인하시고, 만약 파손된 물품이 있을 경우 <strong>현장 작업 팀장의 확인을 서면으로 받아두셔야</strong> 보상 절차가 신속하게 처리됩니다.
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
            안전 화물 상담실
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.92rem;">차종 선택부터 포장 상담까지 원스톱</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 직통 상담 번호</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.7rem; font-weight: 800; color: var(--ydk-cta); text-decoration: none; display: block; margin-bottom: 6px;">
            <i class="phone icon"></i> <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b;">
            직통: 010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(화물 포장 및 차종 선택 친절 가이드)</div>

          <div class="ui divider"></div>

          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 16px; text-align: left;">
            <strong>[안심 보증 안내]</strong><br>
            • 화물운송주선사업 정식 관허 제4042호<br>
            • 적재물 배상책임보험 차량 우선 배차<br>
            • 차주-화주 직거래 정찰제 최저가
          </p>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid button" style="background-color: var(--ydk-cta); color: #fff; border-radius: 8px; font-weight: 700; padding: 14px;">
            <i class="phone icon"></i> 안전 화물 전화 상담
          </a>
        </div>
      </div>

      <!-- 전화상담방법 바로가기 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.05rem;">
            <i class="phone volume icon" style="color: #0284c7;"></i> 전화 상담 잘하는 요령
          </h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 12px;">
            상담 전 확인해야 할 5대 체크포인트와 추천 질문 패턴을 안내해 드립니다.
          </p>
          <a href="<?= url('contents/tel/tel.php') ?>" class="ui fluid basic blue button" style="border-radius: 6px; font-weight: 700;">
            전화 상담 가이드 보기 <i class="angle right icon"></i>
          </a>
        </div>
      </div>

      <!-- 온라인 견적 문의 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <i class="laptop icon" style="font-size: 2.2rem; color: #3b82f6; margin-bottom: 8px;"></i>
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">온라인 견적 문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">
            품목과 상하차 환경을 남겨주시면 적합한 차종과 견적을 안내해 드립니다.
          </p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            견적 신청서 작성 <i class="angle right icon"></i>
          </a>
        </div>
      </div>

    </div>

  </div>

</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
