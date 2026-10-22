<?php
/**
 * 용달코리아 v2-1 일반 이사 서비스 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/gen_mov.html
 * 대상 경로: v2-1/contents/info/gen_mov.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '일반 이사 (알뜰 경제형 이사 서비스) | ' . SITE_NAME;
$pageDescription = '가장 저렴하고 합리적인 비용으로 이사하기를 원하신다면 일반이사를 선택하세요. 고객 사전 포장 + 전문 기사 안전 운반 및 대형 가구 배치 지원.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">일반 이사</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="dolly icon"></i> 알뜰 일반이사 서비스
    </h1>
    <p class="ydk-page-desc">
      불필요한 포장 인건비를 줄여 이사 비용을 가장 크게 절약할 수 있는 실속파 고객 맞춤 서비스입니다.
    </p>
  </header>

  <!-- 2. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #fdf4ff 0%, #fae8ff 100%); border: 1px solid #f0abfc; border-radius: 12px; margin-bottom: 28px;">
    <i class="wallet icon" style="color: #c026d3;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #86198f; margin-bottom: 6px;">
        포장이사 대비 최대 40~50% 비용 절감 효과!
      </div>
      <p style="color: #701a75; line-height: 1.6; margin: 0;">
        잔짐은 고객님께서 시간 나실 때 직접 박스에 챙겨두시고, 힘든 대형 가구·가전의 계단/엘리베이터 운반과 
        차량 적재, 도착지 방안 배치는 용달코리아 전문 기사가 든든하게 맡아드립니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문: 일반이사 특징 & 작업 요령 -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 일반이사란? -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #c026d3; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #701a75; margin-top: 0; margin-bottom: 14px;">
          <i class="info circle icon" style="color: #c026d3;"></i> 일반이사의 특징 및 진행 방식
        </h2>

        <p style="font-size: 0.98rem; line-height: 1.8; color: #374151;">
          일반이사는 원룸, 투룸, 소형 아파트, 빌라, 소호 사무실 등 모든 유형의 이사에 널리 적용됩니다. 
          포장이사에 비해 비용 부담이 훨씬 적어 <strong>대학생, 사회초년생, 알뜰 주부님들</strong>께서 가장 많이 선호하시는 이사 방식입니다.
        </p>

        <div class="ui two column doubling grid" style="margin-top: 10px;">
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
              <strong style="color: #1e293b;"><i class="user icon" style="color: #3b82f6;"></i> 고객님 준비 사항</strong>
              <ul style="margin: 6px 0 0 16px; padding: 0; font-size: 0.88rem; color: #64748b; line-height: 1.6;">
                <li>차량 도착 전 모든 잔짐 박스 포장 완료</li>
                <li>냉장고 음식물 정리 및 아이스박스 보관</li>
                <li>세탁기, TV, PC 배선 분리</li>
              </ul>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
              <strong style="color: #1e293b;"><i class="truck icon" style="color: #10b981;"></i> 용달코리아 기사 역할</strong>
              <ul style="margin: 6px 0 0 16px; padding: 0; font-size: 0.88rem; color: #64748b; line-height: 1.6;">
                <li>대형 가구/가전 안전 보호 포장 및 이동</li>
                <li>차량 적재 및 안전 로프 결속 운송</li>
                <li>도착지 원하는 방/위치에 가구 배치</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 일반이사 요금표 -->
      <div class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid #0284c7; margin-bottom: 24px;">
        <h3 style="font-size: 1.15rem; color: #075985; margin-top: 0; margin-bottom: 14px;">
          <i class="table icon" style="color: #0284c7;"></i> 일반이사 표준 요금 기준표 (서울·수도권)
        </h3>

        <div class="ui responsive table-wrapper" style="overflow-x: auto;">
          <table class="ui celled table" style="border-radius: 8px; text-align: center; font-size: 0.95rem;">
            <thead style="background: #f8fafc;">
              <tr>
                <th>차량 규격</th>
                <th>작업 인원</th>
                <th>평일 요금</th>
                <th>이삿날 (손없는날)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td rowspan="2" style="font-weight: 700;">1톤 용달</td>
                <td>기사 1명 (고객 도움)</td>
                <td><strong style="color: #c026d3;">8 ~ 10 만원</strong></td>
                <td><strong style="color: #c026d3;">10 ~ 12 만원</strong></td>
              </tr>
              <tr>
                <td>전문 기사 1명 + 전문 인부 1명</td>
                <td><strong>20 ~ 22 만원</strong></td>
                <td><strong>22 ~ 25 만원</strong></td>
              </tr>
              <tr>
                <td rowspan="2" style="font-weight: 700; background: #fafafa;">2.5톤 화물</td>
                <td>기사 1명 (상하차 지원)</td>
                <td><strong>18 ~ 20 만원</strong></td>
                <td><strong>20 ~ 22 만원</strong></td>
              </tr>
              <tr>
                <td>전문 기사 1명 + 전문 인부 1명</td>
                <td><strong>35 ~ 40 만원</strong></td>
                <td><strong>40 ~ 45 만원</strong></td>
              </tr>
            </tbody>
          </table>
        </div>

        <p style="font-size: 0.85rem; color: #64748b; margin-top: 10px; line-height: 1.5;">
          ※ 사다리차 이용, 엘리베이터 없는 계단층, 장거리 이송 거리에 따라 소정의 옵션비가 추가될 수 있습니다.
        </p>
      </div>

      <!-- 섹션 3: 이사 전 체크포인트 -->
      <div class="ui segment secondary" style="border-radius: 12px; padding: 20px; background: #f8fafc; border: 1px dashed #cbd5e1;">
        <h4 style="color: #1e293b; font-size: 1.05rem; margin-top: 0; margin-bottom: 8px;">
          <i class="bell icon" style="color: #f59e0b;"></i> 일반이사 당일 지연 방지 안내
        </h4>
        <p style="margin: 0; color: #64748b; font-size: 0.92rem; line-height: 1.6;">
          기사 및 차량이 도착하기 전까지 <strong>모든 짐의 박스 테이핑과 포장이 완료</strong>되어 있어야 차량 대기시간이 발생하지 않고 정해진 시간에 신속히 이사가 끝납니다.
        </p>
      </div>

    </div>

    <!-- 우측 컬럼: 전화 상담 및 견적 신청 -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 직통 전화 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid #c026d3; overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: #c026d3; color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            일반이사 실시간 전화 상담
          </h3>
          <p style="margin: 4px 0 0 0; color: #fae8ff; font-size: 0.95rem;">친절한 작업 방법 및 견적 안내</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표 상담전화</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.6rem; font-weight: 800; color: #c026d3;">
            <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-top: 6px;">
            010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(08:00 ~ 21:00 연중무휴)</div>

          <div class="ui divider"></div>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid primary button" style="border-radius: 8px; font-weight: 700; padding: 14px; background: #c026d3;">
            <i class="phone icon"></i> 전화로 요금 확인하기
          </a>
        </div>
      </div>

      <!-- 포장이사 비교 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="font-size: 1.05rem; color: #1e293b; margin-top: 0; margin-bottom: 8px;">
            <i class="boxes icon" style="color: #f59e0b;"></i> 포장할 시간이 없으신가요?
          </h4>
          <p style="font-size: 0.9rem; color: #64748b; line-height: 1.5; margin-bottom: 12px;">
            직장 업무나 육아로 박스 포장이 곤란하시다면 포장부터 수납정리까지 해드리는 포장이사를 확인해 보세요.
          </p>
          <a href="<?= url('contents/info/pack_mov.php') ?>" class="ui fluid basic orange button" style="border-radius: 6px; font-weight: 600;">
            포장이사 안내 보기 <i class="angle right icon"></i>
          </a>
        </div>
      </div>

      <!-- 온라인 견적 문의 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">온라인 무료 견적 문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">출발/도착지 및 이사 일정을 남겨주시면 알뜰 견적을 회신드립니다.</p>
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
      알뜰하고 편리한 일반이사, 용달코리아가 함께합니다
    </h3>
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 18px;">
      내 가족의 이사처럼 정성을 다하여 안전하고 신속하게 모시겠습니다.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge primary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="phone icon"></i> 대표전화 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge secondary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="edit outline icon"></i> 온라인 무료 견적
      </a>
    </div>
  </section>

</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
