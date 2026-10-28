<?php
/**
 * 용달코리아 v2-1 보관 이사 서비스 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/kee_mov.html
 * 대상 경로: v2-1/contents/info/kee_mov.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '안전 컨테이너 보관 이사 서비스 | ' . SITE_NAME;
$pageDescription = '입주 날짜 불일치, 인테리어 리모델링 맞춤 보관이사. 도난·화재 방지 전용 컨테이너 창고에서 고객이 원하시는 기간만큼 안전하게 보관해 드립니다.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">보관 이사</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="warehouse icon"></i> 안전 컨테이너 보관이사 서비스
    </h1>
    <p class="ydk-page-desc">
      입주 날짜가 맞지 않거나 리모델링 공사 기간 동안, 소중한 이삿짐을 안전한 보관 창고에 보관해 드립니다.
    </p>
  </header>

  <!-- 2. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%); border: 1px solid #5eead4; border-radius: 12px; margin-bottom: 28px;">
    <i class="shield alternate icon" style="color: #0d9488;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #115e59; margin-bottom: 6px;">
        항온·항습·도난방지 전용 컨테이너 창고 완비!
      </div>
      <p style="color: #134e4a; line-height: 1.6; margin: 0;">
        보관이사는 일반 이사와 달리 <strong>입고 운송 &rarr; 창고 보관 &rarr; 출고 운송</strong>의 2회 이사 과정이 수반되므로, 
        숙련된 포장 기술과 믿을 수 있는 보관 시설을 갖춘 전문 업체를 선택하셔야 물품 훼손과 곰팡이를 예방할 수 있습니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문: 보관 시스템 & 프로세스 -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 보관이사 특징 및 시스템 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #0d9488; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #115e59; margin-top: 0; margin-bottom: 16px;">
          <i class="lock icon" style="color: #0d9488;"></i> 안심 보관 관리 시스템
        </h2>

        <div class="ui two column doubling grid">
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="shield icon" style="color: #0d9488;"></i> 전용 컨테이너 보관</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">화재, 도난, 해충 방지 및 보안 시스템 완비</p>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="calendar check icon" style="color: #0d9488;"></i> 자유로운 보관 기간</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">단기(수일~수주일)부터 장기(수개월)까지 가능</p>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="box icon" style="color: #0d9488;"></i> 방습·특수 2중 포장</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">습기 방지제 투입 및 가구 에어캡 밀봉 포장</p>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="map marker alternate icon" style="color: #0d9488;"></i> 고객 희망 지역 보관</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">수도권 및 지방 거점 인접 보관 창고 연계</p>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 보관이사 진행 절차 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #0284c7; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #075985; margin-top: 0; margin-bottom: 14px;">
          <i class="sync icon" style="color: #0284c7;"></i> 보관이사 3단계 진행 흐름
        </h2>

        <div class="ui list" style="line-height: 1.8; color: #374151; font-size: 0.98rem;">
          <div class="item">
            <i class="chevron right icon" style="color: #0284c7;"></i>
            <div class="content"><strong>1단계 [포장 및 창고 입고]:</strong> 출발지에서 특수 완충 포장 후 차량에 적재하여 전용 컨테이너 보관 창고로 이송·입고합니다.</div>
          </div>
          <div class="item">
            <i class="chevron right icon" style="color: #0284c7;"></i>
            <div class="content"><strong>2단계 [안심 창고 보관]:</strong> 지정된 개별 컨테이너에 봉인 후 약정된 기간 동안 철저한 보안과 온·습도 관리 하에 보관합니다.</div>
          </div>
          <div class="item">
            <i class="chevron right icon" style="color: #0284c7;"></i>
            <div class="content"><strong>3단계 [창고 출고 및 신규 입주]:</strong> 입주일 약속 시간에 맞추어 차량에 재적재 후 신규 주택/사무실로 운송하여 원위치에 배치해 드립니다.</div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 비용 안내 -->
      <div class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid #10b981;">
        <h3 style="font-size: 1.15rem; color: #064e3b; margin-top: 0; margin-bottom: 14px;">
          <i class="calculator icon" style="color: #10b981;"></i> 보관이사 비용 산출 방식
        </h3>

        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 16px; margin-bottom: 14px; text-align: center;">
          <strong style="font-size: 1.1rem; color: #166534;">
            총 보관이사 비용 = [ 1차 입고 이사비용 ] + [ 일별 창고 보관료 ] + [ 2차 출고 이사비용 ]
          </strong>
        </div>

        <ul class="ui list" style="line-height: 1.7; color: #475569; font-size: 0.92rem;">
          <li><strong>보관료 기준:</strong> 1톤 컨테이너 기준 1일 약 7,000~10,000원 선 (물량 및 기간에 따라 할인 적용)</li>
          <li><strong>이사 운송비:</strong> 1톤/2.5톤 기본 일반이사 및 포장이사 요금이 입고 시 1회, 출고 시 1회 각각 적용됩니다.</li>
          <li><strong>음식물/귀중품 보관 불가:</strong> 부패하기 쉬운 음식물, 현금, 귀금속, 인화성 물질은 보관 대상에서 제외됩니다.</li>
        </ul>
      </div>

    </div>

    <!-- 우측 컬럼: 직통 상담 및 견적 안내 -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 직통 전화 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid #0d9488; overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: #0d9488; color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            보관이사 전문 상담·예약
          </h3>
          <p style="margin: 4px 0 0 0; color: #ccfbf1; font-size: 0.95rem;">보관 일수별 맞춤 요금 컨설팅</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 상담전화</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.6rem; font-weight: 800; color: #0d9488;">
            <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-top: 6px;">
            010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(08:00 ~ 21:00 연중무휴)</div>

          <div class="ui divider"></div>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid primary button" style="border-radius: 8px; font-weight: 700; padding: 14px; background: #0d9488;">
            <i class="phone icon"></i> 보관 견적 문의하기
          </a>
        </div>
      </div>

      <!-- 보관이사 체크리스트 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="font-size: 1.05rem; color: #1e293b; margin-top: 0; margin-bottom: 12px;">
            <i class="check square outline icon" style="color: #0d9488;"></i> 보관 시 필수 주의사항
          </h4>
          <ul class="ui list" style="line-height: 1.7; color: #475569; font-size: 0.92rem;">
            <li>세탁기 호스 물 빼기 및 건조 완료</li>
            <li>냉장고 성에 제거 및 물기 바짝 말리기</li>
            <li>생물, 화초, 유통기한 있는 식료품 반출</li>
            <li>귀금속, 통장, 인감 등 귀중품은 직접 보관</li>
          </ul>
        </div>
      </div>

      <!-- 온라인 견적 문의 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">온라인 보관 견적 문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">보관 시작일, 출고 예정일, 짐의 양을 알려주시면 상세 견적을 드립니다.</p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            온라인 무료 견적
          </a>
        </div>
      </div>

    </div>

  </div>

  <!-- 4. 하단 CTA -->
  <section class="ydk-bottom-cta" style="margin-top: 24px; padding: 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
    <h3 style="font-size: 1.3rem; color: #1e293b; margin-bottom: 8px;">
      입주 날짜가 안 맞아 고민이신가요?
    </h3>
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 18px;">
      용달코리아의 안전한 전용 창고에 믿고 맡기세요. 깨끗하고 안전하게 보관해 드립니다.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge primary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="phone icon"></i> 대표전화 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge secondary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="edit outline icon"></i> 온라인 상담 접수
      </a>
    </div>
  </section>

</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
