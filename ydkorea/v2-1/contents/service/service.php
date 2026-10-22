<?php
/**
 * 용달코리아 v2-1 서비스 안내 페이지 (PHP 7.4.33, 반응형 웹)
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '서비스 안내 | ' . SITE_NAME . ' (1688-2404)';
$pageDescription = '용달코리아 전국 화물·이사 서비스 안내. 단품 소화물 운송, 원룸·가정·사무실 이사, 기사 인력 지원, 사내 가구 이동, 이삿짐 보관, 전국 지방 리턴공차 및 1톤~5톤 전문 배차 서비스를 제공합니다.';

// 7대 핵심 서비스 데이터 정의
$services = [
    [
        'icon' => 'box',
        'badge' => '단품·소화물',
        'title' => '소형 화물 & 단품 운송',
        'desc' => '냉장고, 세탁기, 침대, 책상 등 가전·가구 1개부터 소형 박스 짐까지 알뜰하게 운송해 드립니다.',
        'points' => ['단일 품목 즉시 운송', '중고거래 가전·가구 배송', '오토바이·자전거 전문 탁송']
    ],
    [
        'icon' => 'dolly',
        'badge' => '맞춤 이사',
        'title' => '원룸 & 맞춤형 이사 서비스',
        'desc' => '고객님의 상황과 예산에 맞추어 차량만 이용하는 알뜰 용달부터 일반이사, 포장이사까지 지원합니다.',
        'points' => ['학생·직장인 원룸이사', '투룸·가정집 일반이사', '기업·사무실 이전 전문 배차']
    ],
    [
        'icon' => 'hands helping',
        'badge' => '일손 지원',
        'title' => '기사 동승 인력 지원 서비스',
        'desc' => '혼자 짐을 옮기기 어려우실 때, 숙련된 전문 기사님이 상·하차 및 실내 운반 작업을 함께 도와드립니다.',
        'points' => ['기사 1인 수작업 지원', '전문 작업원 추가 배차', '엘리베이터 및 계단 운반 협의']
    ],
    [
        'icon' => 'building outline',
        'badge' => '실내 이동',
        'title' => '건물 내 층간·실내 가구 재배치',
        'desc' => '차량 운송 없이도 건물 내 다른 층으로의 물품 이동이나 사무실 부서 이동, 무거운 가구 이동을 대행합니다.',
        'points' => ['사옥 내 부서·집기 재배치', '아파트·주택 내 대형 가구 이동', '단순 인력 파견 지원']
    ],
    [
        'icon' => 'warehouse',
        'badge' => '보관 대행',
        'title' => '이삿짐 안전 보관 서비스',
        'desc' => '이사 날짜와 입주 날짜가 맞지 않거나 리모델링 공사 기간 동안 전용 보관 창고에 안전하게 보관합니다.',
        'points' => ['안전 전용 컨테이너 보관', '장·단기 보관 맞춤 계약', '포장부터 보관, 재배송 원스톱']
    ],
    [
        'icon' => 'road',
        'badge' => '운임 절감',
        'title' => '지방 장거리 리턴공차 알선',
        'desc' => '서울·수도권과 전국 각지를 오가는 복귀 빈차(리턴공차)를 연결하여 장거리 운임을 30~50% 대폭 절감합니다.',
        'points' => ['전국,광역시,지방에서 짐 하차 후 대기 차량', '소량 화물 합바(혼적) 운송', '실시간 지방 공차 매칭']
    ],
    [
        'icon' => 'shipping fast',
        'badge' => '기업 물류',
        'title' => '1톤 ~ 5톤 대량 화물 전국 배차',
        'desc' => '1톤 카고부터 1.4톤, 2.5톤, 5톤 윙탑 및 축플러스까지 기업 납품 물류와 대용량 화물을 완벽 배차합니다.',
        'points' => ['파레트 대량 화물 독차 배차', '비·눈 안심 윙탑·탑차 운송', '산업 공장 장비 전문 배차']
    ],
];

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">서비스 안내</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="cogs icon"></i> 용달코리아 서비스 안내
    </h1>
    <p class="ydk-page-desc">
      단일 품목 소화물부터 전국 대형 화물, 맞춤 이사, 보관 및 인력 지원까지 고객이 필요로 하는 모든 운송 솔루션을 제공합니다.
    </p>
  </header>

  <!-- 2. 화물 운송 기본 원칙 안내 박스 -->
  <section class="ydk-service-notice" aria-label="화물 운송 기본 서비스 기준" style="background:var(--ydk-box-bg); border:1px solid var(--ydk-border-light); border-left:6px solid var(--ydk-primary); border-radius:10px; padding:24px 20px; margin-bottom:36px;">
    <h2 style="font-size:19px; font-weight:800; color:var(--ydk-primary); margin:0 0 12px 0; display:flex; align-items:center; gap:8px;">
      <i class="info circle icon"></i> 화물 운송의 기본 서비스 기준 안내
    </h2>
    <div style="font-size:15px; line-height:1.8; color:var(--ydk-text);">
      <p style="margin:0 0 8px 0;">
        • <strong>표준 기본 운송 원칙:</strong> 화물 운송의 기본 서비스는 <strong>출발지 건물 앞 상차 &rarr; 도착지 건물 앞 하차</strong>(차량만 운송)가 기본 기준입니다.
      </p>
      <p style="margin:0 0 8px 0;">
        • <strong>사전 준비 권장:</strong> 신속한 정시 운행을 위해 약속된 배차 시간에 맞추어 차량 도착 전까지 물품을 건물 1층(또는 주차장)에 준비해 주시기 바랍니다.
      </p>
      <p style="margin:0; color:#c8440c; font-weight:700;">
        • <strong>인력 지원 및 추가 작업:</strong> 기사님의 실내 운반 동참, 엘리베이터/계단 수작업, 사다리차 이용 또는 현장 대기 시간이 필요한 경우 사전 협의를 통해 맞춤 서비스를 지원합니다.
      </p>
    </div>
    <div style="margin-top:16px; padding-top:12px; border-top:1px dashed var(--ydk-border-light); display:flex; flex-wrap:wrap; justify-content:space-between; align-items:center; gap:12px;">
      <span style="font-size:15px; color:var(--ydk-muted);">
        <i class="phone icon"></i> 어떤 서비스가 필요한지 애매하신가요? <strong><?= SITE_PHONE ?> / 1688-2407</strong>로 편하게 문의하세요.
      </span>
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button" style="background:var(--ydk-cta); color:#fff; font-size:15px; font-weight:700; padding:10px 18px; border-radius:6px;">
        <i class="phone icon"></i> 서비스 실시간 상담
      </a>
    </div>
  </section>

  <!-- 3. 용달코리아 7대 핵심 서비스 목록 (그리드 카드) -->
  <section class="ydk-service-list" aria-label="제공 서비스 목록" style="margin-bottom:48px;">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="th large icon"></i> 용달코리아 대표 운송 서비스</h2>
      <span class="ydk-section-sub">차주와 화주 직거래 시스템으로 거품 없는 합리적 운임을 제공합니다.</span>
    </div>

    <div class="ui two column stackable grid" style="margin-top:12px;">
      <?php foreach ($services as $svc): ?>
        <div class="column">
          <div class="ydk-service-card">
            <div>
              <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:14px;">
                <span style="display:inline-block; background:rgba(27, 54, 93, 0.08); color:var(--ydk-primary); font-size:13px; font-weight:800; padding:4px 12px; border-radius:20px;">
                  <?= e($svc['badge']) ?>
                </span>
                <i class="<?= e($svc['icon']) ?> icon" style="font-size:26px; color:var(--ydk-cta); margin:0;"></i>
              </div>
              <h3 style="font-size:21px; font-weight:800; color:var(--ydk-primary); margin:0 0 10px 0; text-align:left;">
                <?= e($svc['title']) ?>
              </h3>
              <p style="font-size:15px; color:#555; line-height:1.6; margin-bottom:16px; text-align:left;">
                <?= e($svc['desc']) ?>
              </p>
              <ul style="margin:0; padding:0; list-style:none; font-size:14.5px; color:#334155; line-height:1.8; text-align:left;">
                <?php foreach ($svc['points'] as $pt): ?>
                  <li style="display:flex; align-items:flex-start; gap:8px; margin-bottom:6px;">
                    <i class="check circle icon" style="color:#2563EB; font-size:14px; margin-top:3px; flex-shrink:0;"></i>
                    <span style="line-height:1.5;"><?= e($pt) ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div style="margin-top:20px; padding-top:14px; border-top:1px solid #edf2f7; display:flex; justify-content:space-between; align-items:center;">
              <span style="font-size:14px; color:var(--ydk-muted); font-weight:600;">전국 당일·사전 예약 가능</span>
              <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-weight:700; font-size:15px; color:var(--ydk-cta); text-decoration:none; display:inline-flex; align-items:center; gap:4px;">
                배차 문의 <i class="angle right icon"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- 4. 손쉬운 이용 절차 (4단계) -->
  <section class="ydk-service-steps" aria-label="서비스 이용 절차" style="margin-bottom:48px; background:#fafbfd; border:1px solid var(--ydk-border-light); border-radius:12px; padding:32px 24px;">
    <div class="ydk-section-header" style="text-align:center;">
      <h2 class="ydk-section-title" style="display:inline-flex; align-items:center; gap:8px;">
        <i class="clipboard list icon"></i> 이용은 이렇게 간단합니다
      </h2>
      <span class="ydk-section-sub" style="display:block; margin-top:6px;">복잡한 가입 없이 전화 한 통으로 신속하게 접수됩니다.</span>
    </div>

    <div class="ui four column stackable grid" style="margin-top:20px;">
      <div class="column" style="text-align:center;">
        <div style="width:56px; height:56px; border-radius:50%; background:#1b365d; color:#fff; display:flex; align-items:center; justify-content:center; font-size:22px; margin:0 auto 12px auto;">
          <i class="phone icon" style="margin:0;"></i>
        </div>
        <div style="font-size:14px; font-weight:800; color:#c8440c; margin-bottom:4px;">STEP 1</div>
        <h4 style="font-size:17px; font-weight:800; margin:0 0 6px 0; color:#1b365d;">전화 상담 및 접수</h4>
        <p style="font-size:14px; color:#666; line-height:1.5; margin:0;">출발지, 도착지, 짐 종류를 알려주시면 즉시 최적 운임을 산출합니다.</p>
      </div>
      <div class="column" style="text-align:center;">
        <div style="width:56px; height:56px; border-radius:50%; background:#1b365d; color:#fff; display:flex; align-items:center; justify-content:center; font-size:22px; margin:0 auto 12px auto;">
          <i class="truck icon" style="margin:0;"></i>
        </div>
        <div style="font-size:14px; font-weight:800; color:#c8440c; margin-bottom:4px;">STEP 2</div>
        <h4 style="font-size:17px; font-weight:800; margin:0 0 6px 0; color:#1b365d;">우수 차주 매칭</h4>
        <p style="font-size:14px; color:#666; line-height:1.5; margin:0;">가장 가까운 거리의 검증된 우수 차주를 직거래로 연결해 드립니다.</p>
      </div>
      <div class="column" style="text-align:center;">
        <div style="width:56px; height:56px; border-radius:50%; background:#1b365d; color:#fff; display:flex; align-items:center; justify-content:center; font-size:22px; margin:0 auto 12px auto;">
          <i class="box icon" style="margin:0;"></i>
        </div>
        <div style="font-size:14px; font-weight:800; color:#c8440c; margin-bottom:4px;">STEP 3</div>
        <h4 style="font-size:17px; font-weight:800; margin:0 0 6px 0; color:#1b365d;">안전 상차 및 운송</h4>
        <p style="font-size:14px; color:#666; line-height:1.5; margin:0;">숙련된 차주님이 내 물건처럼 소중하고 안전하게 상차하여 운송합니다.</p>
      </div>
      <div class="column" style="text-align:center;">
        <div style="width:56px; height:56px; border-radius:50%; background:#1b365d; color:#fff; display:flex; align-items:center; justify-content:center; font-size:22px; margin:0 auto 12px auto;">
          <i class="check circle icon" style="margin:0;"></i>
        </div>
        <div style="font-size:14px; font-weight:800; color:#c8440c; margin-bottom:4px;">STEP 4</div>
        <h4 style="font-size:17px; font-weight:800; margin:0 0 6px 0; color:#1b365d;">하차 및 완료 확인</h4>
        <p style="font-size:14px; color:#666; line-height:1.5; margin:0;">도착지에서 안전하게 하차를 완료하고 물품 상태를 최종 확인합니다.</p>
      </div>
    </div>
  </section>

  <!-- 5. 하단 즉시 상담 및 온라인 견적 문의 CTA -->
  <aside class="ydk-sub-cta" aria-label="서비스 이용 상담 문의">
    <div class="ydk-sub-cta-text">
      <h3><i class="phone volume icon"></i> 필요한 서비스에 대해 바로 상담받아 보세요</h3>
      <p>대표번호 <strong><?= SITE_PHONE ?></strong> 또는 <strong>1688-2407</strong>로 전화 주시면 친절하게 견적을 안내해 드립니다.</p>
    </div>
    <div class="ydk-sub-cta-actions">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge button ydk-btn-call">
        <i class="phone icon"></i> 전화 상담 (<?= SITE_PHONE ?>)
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge inverted button">
        <i class="edit outline icon"></i> 온라인 견적 문의
      </a>
    </div>
  </aside>

  <!-- 모바일 전용 하단 고정 전화 상담 바 -->
  <aside class="ydk-mobile-callbar" aria-label="모바일 즉시 전화상담">
    <a href="tel:<?= SITE_PHONE_TEL ?>" class="ydk-mobile-callbar-btn">
      <i class="phone icon"></i>
      <span class="ydk-mobile-callbar-label">지금 바로 전화 상담</span>
      <strong class="ydk-mobile-callbar-num"><?= SITE_PHONE ?></strong>
    </a>
  </aside>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
?>
