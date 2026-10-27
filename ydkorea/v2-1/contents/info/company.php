<?php
/**
 * 용달코리아 v2-1 회사 소개 페이지 (PHP 7.4.33, 반응형 웹)
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '회사 소개 | ' . SITE_NAME . ' (1688-2404)';
$pageDescription = '용달코리아 대표번호 1688-2404, 1688-2407. 작은 화물 하나도 내 물건처럼 소중히 여기며 정직과 신뢰를 싣고 전국으로 달리는 이사·화물 운송 네트워크입니다.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">회사 소개</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="building outline icon"></i> 회사 소개 (About Us)
    </h1>
    <p class="ydk-page-desc">
      언제나 처음 마음 그대로, 정직과 신뢰를 싣고 전국으로 달리는 용달코리아입니다.
    </p>
  </header>

  <!-- 2. 대표 인사말 섹션 (CEO Greeting) -->
  <section class="ydk-ceo-greeting" aria-label="대표 인사말">
    <div class="ydk-ceo-badge">
      <i class="handshake icon"></i> 신뢰와 정성을 다하는 운송 파트너
    </div>
    <h2 class="ydk-ceo-heading">
      "작은 짐 하나라도 내 가족의 물건처럼 소중하게 생각하고<br class="ydk-hide-mobile">
      처음부터 끝까지 책임을 다하겠습니다."
    </h2>
    <div class="ydk-ceo-body">
      <p>
        저희 용달코리아 홈페이지를 찾아주신 고객 여러분께 진심으로 깊은 감사의 인사를 올립니다.
      </p>
      <p>
        용달코리아는 오랜 실무와 풍부한 현장 경험을 바탕으로, 화물 운송 분야에서 그 누구보다 투철한 직업정신과 
        언제나 처음이라는 초심의 마음으로 일하는 성실한 전문 차주들이 함께 모여 만든 <strong>전국 화물·이사 네트워크</strong>입니다.
      </p>
      
      <div class="ydk-ceo-quote">
        "BOX 한 개, 의자 하나라도 내 물건처럼 소중히 다루고,<br>
        형이나 동생처럼, 언니나 동생처럼 속마음을 편하게 터놓고 부탁할 수 있는 친근하고 든든한 곳 <br>
        그것이 바로 용달코리아가 추구하는 진정한 서비스의 가치입니다."
      </div>

      <p>
        용달코리아는 소형 용달이사, 원룸이사, 학생·직장인 이사부터 일반산업 물류 화물을 독차부터 합바짐(혼적짐)까지 
        고객님의 상황과 일정에 꼭 맞춘 최적의 차량을 빈틈없이 배차해 드립니다.
      </p>
      <p>
        구내 단거리 운송부터 서울에서 제주까지 전국 방방곡곡을 <strong>한 통화의 전화(1688-2404)</strong>로 신속·정확하게 처리해 드리는 것을 
        원칙으로 운영하고 있습니다. 가장 가까운 지역의 우수 차주와 직접 연결되는 직거래 시스템을 통해 불필요한 중간 거품을 걷어내고, 
        혹여 거래 과정에서 불편함이나 궁금증이 생기시면 언제든 본점으로 연락 주시면 가장 빠른 시간 내에 성심껏 해결해 드리겠습니다.
      </p>
      <p>
        앞으로도 고객님의 믿음과 성원에 보답하여 가장 편안하고 기분 좋은 운송 경험을 약속드리겠습니다. 늘 건강하시고 행복한 하루 보내십시오.
      </p>
    </div>

    <div class="ydk-ceo-sign">
      용달코리아 대표 <strong>민 경 철</strong> 배상
    </div>
  </section>

  <!-- 3. 3대 핵심 가치 (Core Values) -->
  <section class="ydk-core-values" aria-label="용달코리아 3대 핵심 가치">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="shield alternate icon"></i> 용달코리아가 지켜온 3대 원칙</h2>
      <span class="ydk-section-sub">언제나 고객님의 소중한 화물을 안전하고 투명하게 운송합니다.</span>
    </div>
    
    <div class="ui three column doubling stackable grid">
      <div class="column">
        <div class="ydk-value-card">
          <div class="ydk-value-icon"><i class="box icon"></i></div>
          <h3 class="ydk-value-title">책임과 정성 (Care)</h3>
          <p class="ydk-value-desc">
            소형 박스 한 개라도 내 물건처럼 소중히 다루며, 출발지 상차부터 도착지 하차까지 안전을 최우선으로 여깁니다.
          </p>
        </div>
      </div>
      <div class="column">
        <div class="ydk-value-card">
          <div class="ydk-value-icon"><i class="shipping fast icon"></i></div>
          <h3 class="ydk-value-title">신속 직거래 배차 (Speed)</h3>
          <p class="ydk-value-desc">
            전국 지역 네트워크를 기반으로 고객과 가장 가까운 검증된 차주를 즉시 연결하여 불필요한 대기시간을 줄입니다.
          </p>
        </div>
      </div>
      <div class="column">
        <div class="ydk-value-card">
          <div class="ydk-value-icon"><i class="heart outline icon"></i></div>
          <h3 class="ydk-value-title">가족 같은 친절 (Trust)</h3>
          <p class="ydk-value-desc">
            형제·자매에게 부탁하듯 부담 없이 속마음을 털어놓을 수 있는 친절하고 정직한 운송 상담을 약속드립니다.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. 회사 기본 정보 (Company Overview) -->
  <section class="ydk-company-info" aria-label="회사 기본 정보" style="margin-top: 36px;">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="id card icon"></i> 회사 개요</h2>
      <span class="ydk-section-sub">관허 등록 정식 운송 주선업체로서 신뢰할 수 있는 법적 기준을 준수합니다.</span>
    </div>

    <div class="ydk-table-wrap">
      <table class="ui celled table ydk-table" summary="용달코리아 회사 기본 정보 표">
        <tbody>
          <tr>
            <th scope="row">상호명</th>
            <td><?= e(BIZ_NAME) ?></td>  
          </tr>
          <tr>
            <th scope="row">대표자</th>
            <td><?= e(BIZ_CEO) ?></td>
          </tr>
          <tr>
            <th scope="row">화물운송주선</th>
            <td>관허 4042호</td>
          </tr>
          <tr>
            <th scope="row">사업자등록번호</th>
            <td><?= e(BIZ_NO) ?></td>
          </tr>
          <tr>
            <th scope="row">통신판매업신고</th>
            <td><?= e(BIZ_MAIL_ORDER) ?></td>
          </tr>
          <tr>
            <th scope="row">대표 전화</th>
            <td><strong>1688-2404 , 1688-2407</strong></td>
          </tr>
          <tr>
            <th scope="row">사업장 소재지</th>
            <td><?= e(BIZ_ADDRESS) ?></td>
          </tr>
          <tr>
            <th scope="row">주요 업무</th>
            <td>소형화물, 용달화물, 중·대형화물 (1t~5t), 용달이사, 원, 투룸이사, 학생, 사무실이사, 리프트차, 윙탑차 전국 화물 책임 운송함</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- 5. 즉시 상담 안내 CTA 배너 -->
  <aside class="ydk-sub-cta" aria-label="전화 상담 안내">
    <div class="ydk-sub-cta-text">
      <h3><i class="phone volume icon"></i> 운송에 대해 궁금하신 점이 있으신가요?</h3>
      <p>대표번호 <strong><?= SITE_PHONE ?></strong>으로 전화 주시면 친절하고 상세하게 견적을 안내해 드립니다.</p>
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
