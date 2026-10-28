<?php
/**
 * 용달코리아 v2-1 전화 상담 방법 안내 페이지 (PHP 7.4.33, 반응형 웹)
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '전화 상담 방법 안내 | ' . SITE_NAME . ' (1688-2404)';
$pageDescription = '용달코리아 대표번호 1688-2404, 1688-2407. 빠르고 정확한 화물·이사 견적 산출을 위해 전화 상담 전 확인해야 할 5가지 핵심 사항과 친절한 상담 가이드를 안내해 드립니다.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">전화 상담 방법</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="phone volume icon"></i> 전화 상담 방법 안내
    </h1>
    <p class="ydk-page-desc">
      출발지·도착지와 화물 정보를 미리 확인해 주시면, 단 한 번의 통화로 가장 정확하고 합리적인 견적을 즉시 안내받으실 수 있습니다.
    </p>
  </header>

  <!-- 2. 신속 상담 대표번호 안내 배너 -->
  <section class="ydk-tel-banner" aria-label="대표번호 상담 안내" style="background:#1b365d; color:#fff; border-radius:12px; padding:28px 24px; margin-bottom:36px; display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:20px;">
    <div style="flex:1 1 300px;">
      <span style="display:inline-block; background:rgba(255,255,255,0.15); padding:4px 12px; border-radius:20px; font-size:14px; font-weight:700; margin-bottom:10px;">
        <i class="clock outline icon"></i> 연중무휴 신속 배차 상담
      </span>
      <h2 style="font-size:clamp(20px, 2.2vw, 26px); font-weight:800; margin:0 0 6px 0; color:#fff;">
        전국 어디서나 1688-2404 / 1688-2407
      </h2>
      <p style="margin:0; font-size:15px; color:rgba(255,255,255,0.85); line-height:1.5;">
        소형 용달부터 5톤 대형 화물, 원룸·가정·사무실 이사까지 전문 상담원이 친절히 안내해 드립니다.
      </p>
    </div>
    <div style="display:flex; flex-wrap:wrap; gap:12px;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button ydk-btn-call" style="background:#c8440c; color:#fff; font-size:18px; font-weight:700; padding:14px 24px; min-height:48px; border-radius:8px;">
        <i class="phone icon"></i> 1688-2404 통화
      </a>
      <a href="tel:16882407" class="ui button" style="background:rgba(255,255,255,0.18); color:#fff; font-size:18px; font-weight:700; padding:14px 24px; min-height:48px; border-radius:8px; border:1px solid rgba(255,255,255,0.35);">
        <i class="phone icon"></i> 1688-2407 통화
      </a>
    </div>
  </section>

  <!-- 3. 상담 전 꼭 확인해야 할 5가지 핵심 사항 -->
  <section class="ydk-tel-checklist" aria-label="전화 상담 전 확인사항">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title">
        <i class="clipboard check icon"></i> 전화 상담 전 미리 확인해 주셔야 할 5가지
      </h2>
      <span class="ydk-section-sub">아래 5가지 사항을 확인하신 후 상담 주시면 불필요한 대기 없이 1분 만에 최적의 견적을 산출해 드립니다.</span>
    </div>

    <div class="ui stackable grid" style="margin-top:12px;">
      <!-- 항목 1 -->
      <div class="eight wide computer sixteen wide tablet sixteen wide mobile column">
        <div class="ydk-value-card" style="display:flex; gap:18px; align-items:flex-start; height:100%;">
          <div class="ydk-value-icon" style="flex-shrink:0;"><i class="truck icon"></i></div>
          <div>
            <h3 class="ydk-value-title" style="margin-top:0;">1. 화물의 종류와 대략적인 물량 (또는 희망 차종)</h3>
            <p class="ydk-value-desc">
              운송하실 물품의 부피와 무게를 대략 파악해 주시면 가장 알맞은 차량을 추천해 드립니다.<br>
              <strong style="color:var(--ydk-primary);">[예시]</strong> 1톤 카고(일반 용달), 1.4톤/2.5톤/5톤 트럭, 눈·비 안심 탑차, 중량물 리프트차, 또는 소형 박스 짐 / 독차 / 혼적(합바짐)
            </p>
          </div>
        </div>
      </div>

      <!-- 항목 2 -->
      <div class="eight wide computer sixteen wide tablet sixteen wide mobile column">
        <div class="ydk-value-card" style="display:flex; gap:18px; align-items:flex-start; height:100%;">
          <div class="ydk-value-icon" style="flex-shrink:0;"><i class="map marker alternate icon"></i></div>
          <div>
            <h3 class="ydk-value-title" style="margin-top:0;">2. 출발지와 도착지의 정확한 상세 위치 (동/읍/면)</h3>
            <p class="ydk-value-desc">
              운송료 산출의 기본 기준은 실주행 거리입니다. 시·군·구 단위뿐만 아니라 동·읍·면 단위까지 알려주시면 오차 없는 운임을 산출할 수 있습니다.<br>
              <strong style="color:var(--ydk-primary);">[예시]</strong> 경기 구리시 수택동 → 경기 화성시 우정읍 조암리
            </p>
          </div>
        </div>
      </div>

      <!-- 항목 3 -->
      <div class="eight wide computer sixteen wide tablet sixteen wide mobile column">
        <div class="ydk-value-card" style="display:flex; gap:18px; align-items:flex-start; height:100%;">
          <div class="ydk-value-icon" style="flex-shrink:0;"><i class="dolly icon"></i></div>
          <div>
            <h3 class="ydk-value-title" style="margin-top:0;">3. 상·하차 작업 시 인력 지원 및 엘리베이터 유무</h3>
            <p class="ydk-value-desc">
              단순히 차량으로 운송만 하는지, 기사님의 운반 도움이나 전문 인력 추가가 필요한지 알려주세요. 건물 층수와 엘리베이터 이용 가능 여부도 중요합니다.<br>
              <strong style="color:var(--ydk-primary);">[예시]</strong> 단순 차량 운송(고객 직접 상하차) / 기사님 운반 도움 요망 / 사다리차 필요
            </p>
          </div>
        </div>
      </div>

      <!-- 항목 4 -->
      <div class="eight wide computer sixteen wide tablet sixteen wide mobile column">
        <div class="ydk-value-card" style="display:flex; gap:18px; align-items:flex-start; height:100%;">
          <div class="ydk-value-icon" style="flex-shrink:0;"><i class="route icon"></i></div>
          <div>
            <h3 class="ydk-value-title" style="margin-top:0;">4. 경유지 또는 현장 대기 시간 유무</h3>
            <p class="ydk-value-desc">
              운송 도중 물건을 추가로 싣거나 내리는 경유지가 있거나, 상·하차지에서 일정 시간 대기가 필요한 경우 미리 말씀해 주시면 정확한 시간표를 잡아드립니다.<br>
              <strong style="color:var(--ydk-primary);">[예시]</strong> 서울 성수동 출발 → 잠원동 1곳 경유 → 서초동 최종 도착
            </p>
          </div>
        </div>
      </div>

      <!-- 항목 5 (전폭) -->
      <div class="sixteen wide column">
        <div class="ydk-value-card" style="display:flex; gap:18px; align-items:flex-start; height:100%;">
          <div class="ydk-value-icon" style="flex-shrink:0;"><i class="compass outline icon"></i></div>
          <div>
            <h3 class="ydk-value-title" style="margin-top:0;">5. 출발 지역의 지명을 구체적으로 말씀해 주세요</h3>
            <p class="ydk-value-desc">
              용달코리아는 전국 16개 시·도 전역을 연결하는 광역 네트워크로 운영됩니다. 상담 시 "여기요" 대신 계신 지역의 시·구·동 지명을 말씀해 주시면, 가장 가까운 곳에 대기 중인 우수 차주를 즉시 조회해 드립니다.<br>
              <strong style="color:var(--ydk-primary);">[예시]</strong> "서울 성동구 마장동입니다", "대전 유성구 봉명동 공장입니다"
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. 친절하고 신속한 견적을 위한 질문 가이드 (Before & After) -->
  <section class="ydk-tel-guide" aria-label="친절한 견적 문의 팁" style="margin-top:44px;">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title">
        <i class="lightbulb outline icon"></i> 빠르고 정확한 맞춤 견적을 받는 꿀팁
      </h2>
      <span class="ydk-section-sub">
        화물·이사 운임은 <strong>거리(km) + 물동량 + 작업 여건(층수/사다리차) + 차량 종류</strong>에 따라 책정되므로, 구체적인 정보를 알려주실수록 더 알뜰하고 정확한 운임을 찾아드릴 수 있습니다.
      </span>
    </div>

    <div class="ui two column stackable grid" style="margin-top:8px;">
      <!-- 주의/보완 필요 질문 예시 -->
      <div class="column">
        <div style="background:#FFF5F5; border:1px solid #FED7D7; border-left:6px solid #E53E3E; border-radius:10px; padding:24px; height:100%;">
          <h3 style="color:#C53030; font-size:18px; font-weight:800; margin:0 0 14px 0; display:flex; align-items:center; gap:8px;">
            <i class="question circle outline icon"></i> 추가 확인이 필요한 막연한 질문 예시
          </h3>
          <p style="font-size:15px; color:#742A2A; margin-bottom:16px; line-height:1.5;">
            아래처럼 질문을 하시면 세부 조건을 다시 여쭤봐야 해서 상담 시간이 다소 길어집니다.
          </p>
          <ul style="padding-left:20px; margin:0; font-size:15px; color:#4A5568; line-height:1.8;">
            <li>"아저씨, 용달차 한 대 얼마예요?"</li>
            <li>"용달 이사 / 원룸 이사 얼마면 되나요?"</li>
            <li>"경기도에서 경기도까지 얼마예요?"</li>
            <li>"여기서 부산까지 얼마죠?"</li>
          </ul>
          <div style="margin-top:16px; padding:10px 14px; background:rgba(229,62,62,0.08); border-radius:6px; font-size:14px; color:#9B2C2C;">
            <i class="info circle icon"></i> 차량 종류와 운송 물품, 출발·도착지가 없으면 운송비를 산출할 수가 없습니다!
          </div>
        </div>
      </div>

      <!-- 권장 질문 예시 (Best Practice) -->
      <div class="column">
        <div style="background:#F0FFF4; border:1px solid #C6F6D5; border-left:6px solid #38A169; border-radius:10px; padding:24px; height:100%;">
          <h3 style="color:#276749; font-size:18px; font-weight:800; margin:0 0 14px 0; display:flex; align-items:center; gap:8px;">
            <i class="check circle outline icon"></i> 단 1분 만에 정확한 견적이 나오는 추천 질문
          </h3>
          <p style="font-size:15px; color:#22543D; margin-bottom:16px; line-height:1.5;">
            차량 종류,운송 물품,출발·도착지를 알려주시면 정확한 운송비를 산출할 수가 있습니다!
          </p>
          <ul style="padding-left:20px; margin:0; font-size:15px; color:#2D3748; line-height:1.8;">
            <li>"<strong>서울 마장동 3층(엘리베이터)에서 구리시 수택동 1층</strong>으로 박스 15개와 소형 냉장고 운송 견적 문의합니다."</li>
            <li>"<strong>경기 구리시에서 화성시 동탄까지</strong> 1톤 카고 단독 배차 운임이 궁금합니다."</li>
            <li>"<strong>서울 영등포에서 부산 사상구까지</strong> 파레트 1개(약 400kg) 혼적(합바) 가능한가요?"</li>
          </ul>
          <div style="margin-top:16px; padding:10px 14px; background:rgba(56,161,105,0.1); border-radius:6px; font-size:14px; color:#22543D; font-weight:600;">
            <i class="thumbs up outline icon"></i> 차량의 종류,운송 물품,출발·도착지를 알려주시면 직거래 최저 요금을 찾아드립니다!
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. 전화 상담 전 핵심 Q&A 박스 -->
  <section class="ydk-tel-faq" aria-label="자주 묻는 질문" style="margin-top:40px; background:var(--ydk-box-bg); border-radius:12px; padding:28px 24px; border:1px solid var(--ydk-border-light);">
    <h3 style="font-size:20px; font-weight:800; margin:0 0 16px 0; color:var(--ydk-primary); display:flex; align-items:center; gap:8px;">
      <i class="comments outline icon"></i> 상담 시 자주 묻는 질문 (FAQ)
    </h3>
    <div class="ui list" style="line-height:1.8;">
      <div class="item" style="padding:10px 0;">
        <i class="help circle icon" style="color:var(--ydk-primary);"></i>
        <div class="content">
          <strong style="font-size:16px;">당일 배차나 야간·새벽 운송도 가능한가요?</strong>
          <div style="color:var(--ydk-muted); font-size:15px; margin-top:4px;">
            네, 전국 대기 차주 네트워크를 통해 24시간 실시간 배차가 가능합니다. 단, 야간·새벽 및 주말은 사전 예약해 주시면 더욱 여유로운 배차가 가능합니다.
          </div>
        </div>
      </div>
      <div class="item" style="padding:10px 0; border-top:1px dashed var(--ydk-border-light);">
        <i class="help circle icon" style="color:var(--ydk-primary);"></i>
        <div class="content">
          <strong style="font-size:16px;">독차(단독 운송)와 합바(혼적)의 차이가 무엇인가요?</strong>
          <div style="color:var(--ydk-muted); font-size:15px; margin-top:4px;">
            독차는 차량 전체를 고객님 단독으로 이용하여 원하는 시간에 즉시 출발·도착하는 방식이며, 합바(혼적은 당착이나 내일착으로)는 장거리 지방 운송 시 같은 방향 화물과 적재함을 나누어 실어 운송료를 최대 30~40% 절감하는 알뜰 운송 방식입니다.
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 6. 즉시 전화 및 온라인 견적 하단 CTA -->
  <aside class="ydk-sub-cta" aria-label="상담 신청 배너" style="margin-top:48px;">
    <div class="ydk-sub-cta-text">
      <h3><i class="phone volume icon"></i> 지금 바로 맞춤 운송 견적을 확인해 보세요</h3>
      <p>대표번호 <strong><?= SITE_PHONE ?></strong> 또는 <strong>1688-2407</strong>로 전화 주시면 가장 합리적인 직거래 요금을 안내해 드립니다.</p>
    </div>
    <div class="ydk-sub-cta-actions">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge button ydk-btn-call">
        <i class="phone icon"></i> 전화 상담 (<?= SITE_PHONE ?>)
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge inverted button">
        <i class="edit outline icon"></i> 온라인 견적 상담
      </a>
    </div>
  </aside>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
?>
