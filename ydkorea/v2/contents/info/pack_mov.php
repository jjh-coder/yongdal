<?php
/**
 * 용달코리아 v2-1 포장 이사 서비스 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/pack_mov.html
 * 대상 경로: v2-1/contents/info/pack_mov.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '원스톱 프리미엄 포장 이사 서비스 | ' . SITE_NAME;
$pageDescription = '포장부터 운송, 가구배치, 수납정리, 마무리 청소까지 원스톱! 손 하나 까딱할 필요 없는 편리하고 완벽한 용달코리아 프리미엄 포장이사 서비스.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">포장 이사</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="boxes icon"></i> 원스톱 프리미엄 포장이사
    </h1>
    <p class="ydk-page-desc">
      포장부터 운송, 가구배치, 수납정리, 마무리 청소까지 — 처음부터 끝까지 정성을 다해 케어해 드립니다.
    </p>
  </header>

  <!-- 2. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%); border: 1px solid #fde68a; border-radius: 12px; margin-bottom: 28px;">
    <i class="gem outline icon" style="color: #d97706;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #92400e; margin-bottom: 6px;">
        손 하나 대지 않고 편안하게 이사하는 원스톱 풀케어!
      </div>
      <p style="color: #78350f; line-height: 1.6; margin: 0;">
        귀중품(현금, 귀금속, 중요 서류)만 챙겨두시면, 주방 식기 포장부터 냉장고 아이스박스 보관, 
        도착지 가구 배치 및 서랍장 수납, 기본 바닥 청소까지 베테랑 전문가팀이 완벽하게 마무리합니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문: 4단계 올인원 시스템 -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 꼼꼼한 포장 시스템 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #d97706; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #92400e; margin-top: 0; margin-bottom: 16px;">
          <i class="box open icon" style="color: #d97706;"></i> 1. 전문 자재를 활용한 맞춤 포장
        </h2>

        <div class="ui two column doubling grid">
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="shield alternate icon" style="color: #d97706;"></i> 대형 가구·가전 전용 커버</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">냉장고, 세탁기, 장롱 두터운 충격 방지 누비 패드 밀봉</p>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="snowflake icon" style="color: #0284c7;"></i> 냉장고 아이스박스 보관</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">냉장/냉동 음식물을 아이스박스에 신선하게 담아 운송</p>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="wine glass icon" style="color: #ef4444;"></i> 유리·식기류 2중 에어캡</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">깨지기 쉬운 사기 그릇, 접시, 와인잔 하나하나 개별 포장</p>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="tshirt icon" style="color: #10b981;"></i> 의류 행거 박스 & 매트리스</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">옷걸이 채 행거 박스 적재 및 침대 매트리스 전용 커버</p>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 안심 운송 및 완벽한 정리/청소 서비스 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #10b981; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #064e3b; margin-top: 0; margin-bottom: 16px;">
          <i class="broom icon" style="color: #10b981;"></i> 2. 도착지 가구 배치 및 수납·정리·청소
        </h2>

        <div class="ui list" style="line-height: 1.8; color: #374151; font-size: 0.98rem;">
          <div class="item">
            <i class="check icon" style="color: #10b981;"></i>
            <div class="content"><strong>가구 배치 및 수납 복원:</strong> 고객이 원하시는 위치에 장롱, 침대, 책상을 배치하고 서랍장 내부 물품을 정돈해 드립니다.</div>
          </div>
          <div class="item">
            <i class="check icon" style="color: #10b981;"></i>
            <div class="content"><strong>주방 조리기구 및 식기 수납:</strong> 싱크대와 찬장에 그릇과 냄비, 주방용품을 쓰기 편하시도록 정갈하게 수납합니다.</div>
          </div>
          <div class="item">
            <i class="check icon" style="color: #10b981;"></i>
            <div class="content"><strong>가전 배선 연결 및 부착물:</strong> 냉장고 수평 맞춤, 세탁기 급배수 호스 연결, 오디오 및 액자 부착 서비스를 지원합니다.</div>
          </div>
          <div class="item">
            <i class="check icon" style="color: #10b981;"></i>
            <div class="content"><strong>마무리 바닥 청소:</strong> 짐 정리가 끝난 후 각 방과 거실 바닥을 쓸고 닦아내어 곧바로 생활하실 수 있도록 해드립니다.</div>
          </div>
        </div>
      </div>

      <!-- 섹션 3: 포장이사 요금 가이드 -->
      <div class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid #0284c7;">
        <h3 style="font-size: 1.15rem; color: #075985; margin-top: 0; margin-bottom: 14px;">
          <i class="table icon" style="color: #0284c7;"></i> 포장이사 요금 기준표 (서울 시내 기준 예시)
        </h3>

        <div class="ui responsive table-wrapper" style="overflow-x: auto;">
          <table class="ui celled table" style="border-radius: 8px; text-align: center; font-size: 0.95rem;">
            <thead style="background: #f8fafc;">
              <tr>
                <th>차량 규격</th>
                <th>작업 인원 구성</th>
                <th>평일 요금</th>
                <th>이삿날 (손없는날)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 700;">1톤 용달 포장 (원룸)</td>
                <td>전문 기사 1명 + 전문 인부 1명</td>
                <td><strong style="color: #d97706;">33 ~ 35 만원</strong></td>
                <td><strong style="color: #d97706;">35 ~ 40 만원</strong></td>
              </tr>
              <tr>
                <td style="font-weight: 700; background: #fafafa;">2.5톤 포장 (투룸·가정)</td>
                <td>전문 기사 1명 + 전문 인부 2명</td>
                <td><strong>65 ~ 70 만원</strong></td>
                <td><strong>75 ~ 80 만원</strong></td>
              </tr>
              <tr>
                <td style="font-weight: 700; background: #fafafa;">5톤 포장 (3~4인 가정)</td>
                <td>전문 남성 3인 + 주방 여성 1인</td>
                <td colspan="2"><strong>110 ~ 130 만원 (현장 실사 견적)</strong></td>
              </tr>
            </tbody>
          </table>
        </div>

        <p style="font-size: 0.85rem; color: #64748b; margin-top: 10px; line-height: 1.5;">
          ※ 사다리차 비용, 에어컨 배관 탈부착 등은 현장 여건에 따라 별도 옵션으로 산정됩니다.
        </p>
      </div>

    </div>

    <!-- 우측 컬럼: 빠른 전화 상담 & 견적 문의 -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 직통 예약 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid #d97706; overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: #d97706; color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            포장이사 무료 견적 상담
          </h3>
          <p style="margin: 4px 0 0 0; color: #fef3c7; font-size: 0.95rem;">친절하고 정직한 올인원 이사</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 상담전화</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.6rem; font-weight: 800; color: #d97706;">
            <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-top: 6px;">
            010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(08:00 ~ 21:00 연중무휴)</div>

          <div class="ui divider"></div>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid primary button" style="border-radius: 8px; font-weight: 700; padding: 14px; background: #d97706;">
            <i class="phone icon"></i> 전화로 견적 문의하기
          </a>
        </div>
      </div>

      <!-- 고객 유의사항 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="font-size: 1.05rem; color: #1e293b; margin-top: 0; margin-bottom: 12px;">
            <i class="user shield icon" style="color: #0284c7;"></i> 고객님 직접 보관 필수 품목
          </h4>
          <p style="font-size: 0.88rem; color: #64748b; line-height: 1.5; margin-bottom: 10px;">
            포장이사는 모든 짐을 포장해 드리지만, 아래 귀중품은 분실 방지를 위해 이사 당일 고객님께서 직접 챙겨주셔야 합니다.
          </p>
          <ul class="ui list" style="line-height: 1.6; color: #475569; font-size: 0.88rem;">
            <li>현금, 상품권, 유가증권, 통장, 도장</li>
            <li>다이아몬드, 금/귀금속, 명품 시계</li>
            <li>개인 노트북, 중요 외장하드, 서류철</li>
          </ul>
        </div>
      </div>

      <!-- 온라인 견적 문의 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">온라인 무료 견적 문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">출발/도착 층수와 방 구조(원룸, 투룸 등)를 남겨주시면 상세 견적을 드립니다.</p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            간편 온라인 접수
          </a>
        </div>
      </div>

    </div>

  </div>

  <!-- 4. 하단 CTA -->
  <section class="ydk-bottom-cta" style="margin-top: 24px; padding: 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
    <h3 style="font-size: 1.3rem; color: #1e293b; margin-bottom: 8px;">
      새 보금자리에서의 첫날, 미소 짓는 이사를 약속드립니다
    </h3>
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 18px;">
      오랜 노하우와 숙련된 전문 인력이 처음부터 끝까지 정성을 다해 안전하게 모십니다.
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
