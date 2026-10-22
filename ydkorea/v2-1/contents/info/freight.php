<?php
/**
 * 용달코리아 v2-1 화물 및 이사 운송예약 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/freight.html
 * 대상 경로: v2-1/contents/info/freight.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '화물 및 이사 운송예약 안내 | ' . SITE_NAME;
$pageDescription = '운송할 화물을 미리 예약하시면 정확한 시간에 차량이 도착하여 시간과 비용을 크게 절약할 수 있습니다. 관허 4-42호 용달코리아 1688-2404.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">화물 예약</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="calendar check outline icon"></i> 화물 및 이사 운송예약 안내
    </h1>
    <p class="ydk-page-desc">
      운송하실 화물을 미리 예약하시면 정해진 시간에 정확히 차량이 도착하여 소중한 시간을 절약하실 수 있습니다.
    </p>
  </header>

  <!-- 2. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #eff6ff 0%, #e0f2fe 100%); border: 1px solid #bae6fd; border-radius: 12px; margin-bottom: 30px;">
    <i class="shield alternate icon" style="color: #0284c7;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #0369a1; margin-bottom: 6px;">
        믿을 수 있는 정식 "관허업체 [관허 4-42호]"를 선택하세요!
      </div>
      <p style="color: #334155; line-height: 1.6; margin: 0;">
        화물 운송 및 이사 예약 시 공인된 정식 관허업체를 이용하셔야 만일의 하자가 없으며, 
        원하시는 출발 일시에 차질 없이 신뢰할 수 있는 차량과 전문 기사가 배차됩니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 컬럼: 예약 안내 및 절차 -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">
      
      <!-- 예약 안내 본문 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #0070ba; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #1a365d; margin-top: 0; margin-bottom: 16px;">
          <i class="info circle icon" style="color: #0070ba;"></i> 편리하고 정확한 사전 예약 시스템
        </h2>
        
        <div style="font-size: 1rem; line-height: 1.8; color: #374151;">
          <p>
            운송을 하실 화물과 이삿짐을 사전에 미리 예약하시면 필요한 차종(1t 용달, 1.4t, 2.5t, 5t, 탑차, 리프트차 등)을 
            가장 적합한 조건으로 선점할 수 있어 <strong>시간 절약</strong>과 <strong>안정적인 운송</strong>이 가능합니다.
          </p>
          <p>
            용달코리아의 직통 상담 전화는 <strong>연중무휴 매일 08:00부터 21:00까지</strong> 친절하게 열려 있으며, 
            야간이나 통화가 곤란하신 경우에는 24시간 언제든 <strong>온라인 간편 견적문의</strong>를 이용하실 수 있습니다.
          </p>
        </div>

        <div class="ui divider" style="margin: 20px 0;"></div>

        <h3 style="font-size: 1.15rem; color: #1e293b; margin-bottom: 14px;">
          <i class="clipboard check icon" style="color: #10b981;"></i> 간편 예약 진행 방법
        </h3>

        <div class="ui three steps tablet computer only" style="border-radius: 8px;">
          <div class="step">
            <i class="phone volume icon"></i>
            <div class="content">
              <div class="title">1. 운송 문의</div>
              <div class="description">전화 또는 온라인 상담</div>
            </div>
          </div>
          <div class="step">
            <i class="calendar alternate outline icon"></i>
            <div class="content">
              <div class="title">2. 일정·요금 협의</div>
              <div class="description">차종, 짐양, 운임 확정</div>
            </div>
          </div>
          <div class="step active">
            <i class="truck icon"></i>
            <div class="content">
              <div class="title">3. 배차 및 도착</div>
              <div class="description">약속 시간 정시 도착</div>
            </div>
          </div>
        </div>

        <!-- 모바일용 단계 리스트 -->
        <div class="mobile only" style="background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
          <div style="margin-bottom: 10px; font-size: 0.95rem;"><strong>1단계:</strong> 전화(1688-2404) 또는 온라인 폼으로 상담 접수</div>
          <div style="margin-bottom: 10px; font-size: 0.95rem;"><strong>2단계:</strong> 이사/화물 물량, 작업조건, 일정 확인 후 요금 확정</div>
          <div style="font-size: 0.95rem;"><strong>3단계:</strong> 담당 기사 배정 및 약속 일시에 현장 도착</div>
        </div>

      </div>

      <!-- 예약 시 주의사항 (체크리스트) -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #f59e0b; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <h2 style="font-size: 1.25rem; color: #92400e; margin-top: 0; margin-bottom: 16px;">
          <i class="exclamation triangle icon" style="color: #f59e0b;"></i> 예약 시 꼭 지켜주셔야 할 유의사항
        </h2>

        <div class="ui relaxed divided list" style="font-size: 0.98rem; line-height: 1.7;">
          <div class="item" style="padding: 10px 0;">
            <i class="large check circle outline icon" style="color: #10b981; vertical-align: top;"></i>
            <div class="content">
              <div class="header" style="color: #1f2937; margin-bottom: 4px;">사전 예약 권장</div>
              <div class="description" style="color: #4b5563;">
                날짜와 시간을 미리 예약하시면 당일 급박한 배차 지연 없이 차량 도착시간이 정확하며 고객님의 일정이 원활해집니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 10px 0;">
            <i class="large exclamation circle icon" style="color: #ef4444; vertical-align: top;"></i>
            <div class="content">
              <div class="header" style="color: #b91c1c; margin-bottom: 4px;">중복 예약 절대 금지</div>
              <div class="description" style="color: #4b5563;">
                여러 업체와 상담하시다 동일한 일시에 두 곳 이상의 업체에 중복 예약을 하시면 배차된 차주에게 막대한 손해가 발생하며 위약금이 청구될 수 있으니 꼭 한 곳을 확정해 주시기 바랍니다.
              </div>
            </div>
          </div>

          <div class="item" style="padding: 10px 0;">
            <i class="large clock outline icon" style="color: #0284c7; vertical-align: top;"></i>
            <div class="content">
              <div class="header" style="color: #1f2937; margin-bottom: 4px;">예약 취소 및 내용 변경은 미리 연락</div>
              <div class="description" style="color: #4b5563;">
                예약을 취소하시거나 화물 물량·출발지 등을 변경하실 경우는 <strong>최소한 하루 전</strong>에 연락을 주셔야 합니다. 
                불가피하게 당일 시간을 변경하실 때에도 <strong>최소 2시간 전</strong>에는 반드시 본점으로 알려주셔야 재조율이 가능합니다.
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- 우측 컬럼: 직통 연락처 카드 & 온라인 접수 바로가기 -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">
      
      <!-- 관허업체 보증 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid #0070ba; overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: #0070ba; color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            <?= e(BIZ_NAME) ?>
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0f2fe; font-size: 0.95rem;">공식 화물자동차 운송주선 허가업체</p>
        </div>
        <div class="content" style="padding: 22px;">
          <table class="ui very basic compact table" style="font-size: 0.95rem;">
            <tbody>
              <tr>
                <td style="color: #64748b; width: 35%; font-weight: 600;">대표 전화</td>
                <td><strong style="color: #0070ba; font-size: 1.15rem;"><?= SITE_PHONE ?></strong></td>
              </tr>
              <tr>
                <td style="color: #64748b; font-weight: 600;">직통 핸드폰</td>
                <td><strong style="color: #1e293b;">010-4477-2404</strong></td>
              </tr>
              <tr>
                <td style="color: #64748b; font-weight: 600;">통화 가능</td>
                <td><strong>08:00 ~ 21:00</strong> (연중무휴)</td>
              </tr>
              <tr>
                <td style="color: #64748b; font-weight: 600;">보유 차종</td>
                <td>1t, 1.4t, 2.5t, 5t, 탑차, 리프트</td>
              </tr>
              <tr>
                <td style="color: #64748b; font-weight: 600;">운송 구역</td>
                <td>시내 단거리부터 서울-제주 전국</td>
              </tr>
            </tbody>
          </table>

          <div style="margin-top: 18px;">
            <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid primary button" style="border-radius: 8px; font-weight: 700; padding: 14px;">
              <i class="phone icon"></i> 전화로 즉시 예약
            </a>
          </div>
        </div>
      </div>

      <!-- 온라인 상담 및 바로가기 링크 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="font-size: 1.1rem; color: #1e293b; margin-top: 0; margin-bottom: 8px;">
            <i class="edit outline icon" style="color: #10b981;"></i> 24시간 온라인 예약 접수
          </h4>
          <p style="font-size: 0.9rem; color: #64748b; line-height: 1.5; margin-bottom: 14px;">
            통화가 어려우시거나 상세 견적 상담을 원하시면 온라인 견적 게시판에 남겨주세요. 신속히 검토 후 연락드립니다.
          </p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid basic green button" style="border-radius: 6px; font-weight: 600;">
            온라인 견적 문의 작성 <i class="angle right icon"></i>
          </a>
        </div>
      </div>

      <!-- 관련 정보 퀵 링크 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 18px 20px;">
          <h4 style="font-size: 1rem; color: #1e293b; margin-top: 0; margin-bottom: 12px;">
            <i class="linkify icon"></i> 관련 서비스 링크
          </h4>
          <div class="ui vertical following fluid menu text" style="margin: 0;">
            <a class="item" href="<?= url('contents/info/forecast_trt.php') ?>" style="padding: 8px 0; color: #3b82f6;">
              <i class="calculator icon"></i> 이삿짐 예상 단가표 보기
            </a>
            <a class="item" href="<?= url('contents/trt/trt.php') ?>" style="padding: 8px 0; color: #3b82f6;">
              <i class="table icon"></i> 거리별 화물 운송 요금표
            </a>
            <a class="item" href="<?= url('contents/info/car_list_03.php') ?>" style="padding: 8px 0; color: #3b82f6;">
              <i class="road icon"></i> 지방 화물 및 리턴공차 안내
            </a>
            <a class="item" href="<?= url('contents/info/area_01.php') ?>" style="padding: 8px 0; color: #3b82f6;">
              <i class="map marker alternate icon"></i> 수도권 (서울·경기) 차주 안내
            </a>
          </div>
        </div>
      </div>

    </div>

  </div>

</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
