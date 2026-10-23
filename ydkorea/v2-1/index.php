<?php
/**
 * 용달코리아 v2-1 메인 페이지 (v2 대비 단순화 구조 비교용, PHP 7.4.33, Deep Navy 테마)
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/admin/includes/db.php';

$pageTitle = '용달코리아 대표번호 1688-2404 용달화물 및 이사 용달차 안내 전국 화물 네트워크';
$pageDescription = '서울시 성동구에 위치한 용달코리아 대표번호 1688-2404. 용달, 1톤~5톤 화물, 용달이사, 원룸이사, 리프트차, 탑차, 전국 화물 네트워크 직거래 연결';

// 메인 노출용 공지사항 및 묻고답하기 최신 3건
$mainNotices = get_notice_list('', 3);
$mainQas = get_qa_list('', '', 3);

// 서울 25개 구 데이터
$seoulAreas = [
    ['id' => '11', 'name' => '강남구'],
    ['id' => '12', 'name' => '강동구'],
    ['id' => '13', 'name' => '강서구'],
    ['id' => '14', 'name' => '강북구'],
    ['id' => '15', 'name' => '관악구'],
    ['id' => '16', 'name' => '광진구'],
    ['id' => '17', 'name' => '구로구'],
    ['id' => '18', 'name' => '금천구'],
    ['id' => '19', 'name' => '노원구'],
    ['id' => '20', 'name' => '도봉구'],
    ['id' => '21', 'name' => '동대문구'],
    ['id' => '22', 'name' => '동작구'],
    ['id' => '23', 'name' => '마포구'],
    ['id' => '24', 'name' => '서대문구'],
    ['id' => '25', 'name' => '서초구'],
    ['id' => '26', 'name' => '성동구'],
    ['id' => '27', 'name' => '성북구'],
    ['id' => '28', 'name' => '송파구'],
    ['id' => '29', 'name' => '양천구'],
    ['id' => '30', 'name' => '영등포구'],
    ['id' => '31', 'name' => '용산구'],
    ['id' => '32', 'name' => '은평구'],
    ['id' => '33', 'name' => '종로구'],
    ['id' => '34', 'name' => '중구'],
    ['id' => '35', 'name' => '중랑구'],
];

// 경기/인천 21개 지역 데이터
$gyeonggiAreas = [
    ['id' => '36', 'name' => '구리/남양주'],
    ['id' => '37', 'name' => '군포/의왕'],
    ['id' => '38', 'name' => '성남/분당'],
    ['id' => '39', 'name' => '평택/송탄'],
    ['id' => '40', 'name' => '수원/병점'],
    ['id' => '41', 'name' => '안산/시흥'],
    ['id' => '42', 'name' => '안양/과천'],
    ['id' => '43', 'name' => '오산/동탄'],
    ['id' => '44', 'name' => '인천/부평'],
    ['id' => '45', 'name' => '화성/발안'],
    ['id' => '46', 'name' => '광명시'],
    ['id' => '47', 'name' => '양주시'],
    ['id' => '48', 'name' => '의정부시'],
    ['id' => '49', 'name' => '포천시'],
    ['id' => '50', 'name' => '광주시'],
    ['id' => '51', 'name' => '고양시'],
    ['id' => '52', 'name' => '김포시'],
    ['id' => '53', 'name' => '부천시'],
    ['id' => '54', 'name' => '용인시'],
    ['id' => '55', 'name' => '파주시'],
    ['id' => '56', 'name' => '하남시'],
];

// 전국 주요 도시 및 광역시 18개 지역 데이터
$metroAreas = [
    ['id' => '57', 'name' => '천안'],
    ['id' => '58', 'name' => '충주'],
    ['id' => '59', 'name' => '대전'],
    ['id' => '60', 'name' => '전주'],
    ['id' => '61', 'name' => '광주'],
    ['id' => '62', 'name' => '부산'],
    ['id' => '71', 'name' => '구미'],
    ['id' => '64', 'name' => '대구'],
    ['id' => '65', 'name' => '원주'],
    ['id' => '66', 'name' => '춘천'],
    ['id' => '63', 'name' => '울산'],
    ['id' => '68', 'name' => '강릉'],
    ['id' => '69', 'name' => '창원'],
    ['id' => '79', 'name' => '양산'],
    ['id' => '67', 'name' => '포항'],
    ['id' => '80', 'name' => '세종'],
    ['id' => '81', 'name' => '군산'],
    ['id' => '82', 'name' => '순천'],
];

// 바로가기 15개 서비스 데이터
$quickServices = [
    ['name' => 'best 용달', 'desc' => '신속·친절 우수 용달', 'url' => url('contents/company/company_list.php?id=07'), 'icon' => 'truck'],
    ['name' => '1.4t / 2.5t / 5t', 'desc' => '중·대형 화물 트럭', 'url' => url('contents/company/company_list.php?id=08'), 'icon' => 'shipping fast'],
    ['name' => '탑차 (1t~5t)', 'desc' => '비·눈 걱정 없는 탑차', 'url' => url('contents/company/company_list.php?id=09'), 'icon' => 'box'],
    ['name' => '리프트 차', 'desc' => '중량물·장비 전용 리프트', 'url' => url('contents/company/company_list.php?id=10'), 'icon' => 'level up alternate'],
    ['name' => '지역 차량 (서울·경기)', 'desc' => '수도권 차주 직거래', 'url' => url('contents/info/area_01.php'), 'icon' => 'map marker alternate'],
    ['name' => '지역 차량 (광역시)', 'desc' => '전국 광역시 차주 안내', 'url' => url('contents/info/area_02.php'), 'icon' => 'map signs'],
    ['name' => '화물 예약', 'desc' => '온라인 간편 화물 예약', 'url' => url('contents/info/freight.php'), 'icon' => 'calendar check'],
    ['name' => '지방 화물 안내', 'desc' => '장거리·지방 리턴공차', 'url' => url('contents/info/car_list_03.php'), 'icon' => 'road'],
    ['name' => '이삿짐 예상 단가', 'desc' => '투명한 이사 요금 기준', 'url' => url('contents/info/forecast_trt.php'), 'icon' => 'calculator'],
    ['name' => '용달 이사', 'desc' => '원룸·소형 소호 이사', 'url' => url('contents/info/yd_mov.php'), 'icon' => 'home'],
    ['name' => '원룸 이사', 'desc' => '학생·직장인 맞춤 이사', 'url' => url('contents/info/room_mov.php'), 'icon' => 'user'],
    ['name' => '사무실 이사', 'desc' => '기업·사무실 이전 전문', 'url' => url('contents/info/off_mov.php'), 'icon' => 'building'],
    ['name' => '일반 이사', 'desc' => '알뜰하고 편리한 이사', 'url' => url('contents/info/gen_mov.php'), 'icon' => 'dolly'],
    ['name' => '보관 이사', 'desc' => '안전한 화물 보관 이사', 'url' => url('contents/info/kee_mov.php'), 'icon' => 'warehouse'],
    ['name' => '포장 이사', 'desc' => '포장부터 정리까지 원스톱', 'url' => url('contents/info/pack_mov.php'), 'icon' => 'boxes'],
];

include __DIR__ . '/includes/header.php';
?>

<?php
$freightServices = array_slice($quickServices, 0, 8);
$moveServices = array_slice($quickServices, 8);
$regionTabs = [
    ['key' => 'seoul', 'label' => '서울', 'areas' => $seoulAreas],
    ['key' => 'gyeonggi', 'label' => '경기·인천', 'areas' => $gyeonggiAreas],
    ['key' => 'metro', 'label' => '광역시·지방', 'areas' => $metroAreas],
];
$procedure = [
    ['icon' => 'phone', 'title' => '전화 상담'],
    ['icon' => 'truck', 'title' => '차량 배차'],
    ['icon' => 'box', 'title' => '화물 상차'],
    ['icon' => 'shipping fast', 'title' => '안전 운송'],
    ['icon' => 'check circle', 'title' => '하차 완료'],
];
$areaInfos = [
    ['서울·수도권 화물안내', 'main/area_info_01.html'],
    ['충청권 화물안내', 'main/area_info_02.html'],
    ['호남권 화물안내', 'main/area_info_03.html'],
    ['영남권 화물안내', 'main/area_info_04.html'],
    ['강원·제주 화물안내', 'main/area_info_05.html'],
    ['리턴 공차 안내', 'main/area_info_06.html'],
    ['용달 운임 기준표', 'main/area_info_07.html'],
    ['화물 취급 요령', 'main/area_info_08.html'],
];
?>

<main class="ydk-container ydk-main">

  <!-- 1. 히어로 배너: 그래픽 일러스트 + 헤드라인 + 즉시 전화 상담 -->
  <section class="ydk2-hero" aria-label="용달코리아 소개">
    <!-- 하단 도로 & 차선 레이어 -->
    <div class="ydk2-hero-road"></div>
    <div class="ydk2-hero-lane"></div>

    <!-- 좌측 헤드라인 & 콜투액션 (텍스트 좌측 배치) -->
    <div class="ydk2-hero-content">
      <h1 class="ydk2-hero-title">용달·화물·이사,<br>한 통의 전화로 끝냅니다</h1>
      <p class="ydk2-hero-desc">전국 차주와 직거래로 연결해 드립니다.</p>
      <div class="ydk2-hero-actions">
        <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button ydk2-btn-call">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="#ffd2bd" aria-hidden="true"><path d="M6.6 10.8a15 15 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 0 1 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1z"></path></svg>
          <span>전화 상담 <?= SITE_PHONE ?></span>
        </a>
        <a href="#regionSection" class="ydk2-hero-link">지역 차주 찾기 <i class="angle right icon"></i></a>
      </div>
    </div>

    <!-- 우측 일러스트 그래픽 (도시 빌딩 + 하늘 구름 + 이삿짐 박스 + 용달 트럭) -->
    <div class="ydk2-hero-visual">
      <div class="ydk2-hero-fade"></div>
      <svg viewBox="0 0 640 296" preserveAspectRatio="xMidYMax meet" class="ydk2-hero-svg" fill="none" aria-hidden="true">
        <!-- 원경·근경 빌딩군 -->
        <g fill="#206a9d">
          <rect x="20" y="170" width="60" height="130"></rect>
          <rect x="100" y="110" width="50" height="190"></rect>
          <rect x="170" y="150" width="70" height="150"></rect>
          <rect x="260" y="70" width="40" height="230"></rect>
          <rect x="320" y="130" width="80" height="170"></rect>
          <rect x="420" y="90" width="44" height="210"></rect>
          <rect x="485" y="150" width="70" height="150"></rect>
          <rect x="570" y="120" width="50" height="180"></rect>
        </g>
        <g fill="#1a5c8a">
          <rect x="40" y="200" width="40" height="100"></rect>
          <rect x="200" y="190" width="40" height="110"></rect>
          <rect x="345" y="170" width="55" height="130"></rect>
          <rect x="510" y="190" width="45" height="110"></rect>
        </g>

        <!-- 하늘 구름 -->
        <g fill="#ffffff">
          <g opacity=".95">
            <ellipse cx="130" cy="56" rx="46" ry="16"></ellipse>
            <circle cx="112" cy="46" r="18"></circle>
            <circle cx="146" cy="42" r="22"></circle>
          </g>
          <g opacity=".85">
            <ellipse cx="470" cy="38" rx="34" ry="11"></ellipse>
            <circle cx="458" cy="30" r="13"></circle>
            <circle cx="484" cy="28" r="15"></circle>
          </g>
          <g opacity=".7">
            <ellipse cx="330" cy="92" rx="26" ry="8"></ellipse>
            <circle cx="322" cy="86" r="10"></circle>
          </g>
        </g>

        <!-- 적재함 위 이삿짐 박스 -->
        <rect x="104" y="92" width="86" height="66" rx="3" fill="#d9b88a"></rect>
        <path d="M104 108h86M147 92v16" stroke="#b8935f" stroke-width="3"></path>
        <rect x="196" y="112" width="74" height="46" rx="3" fill="#e4c79d"></rect>
        <path d="M196 126h74M233 112v14" stroke="#b8935f" stroke-width="3"></path>
        <rect x="132" y="38" width="72" height="54" rx="3" fill="#e4c79d"></rect>
        <path d="M132 52h72M168 38v14" stroke="#b8935f" stroke-width="3"></path>

        <!-- 트럭 적재함 프레임 & 바디 -->
        <rect x="84" y="158" width="250" height="84" rx="4" fill="#1b365d"></rect>
        <g stroke="#2d5a96" stroke-width="3">
          <path d="M84 176h250M84 194h250M84 212h250M84 230h250"></path>
        </g>
        <rect x="70" y="240" width="400" height="16" rx="3" fill="#0f1f3a"></rect>

        <!-- 트럭 운전석 캡 (오렌지 포인트) & 창문 -->
        <path d="M344 142h74l40 52v48H344z" fill="#c8440c"></path>
        <path d="M404 154h-48v40h82z" fill="#d6ecfa"></path>
        <path d="M404 154l12 0 22 40h-24z" fill="#ffffff" opacity=".35"></path>
        <rect x="344" y="212" width="114" height="6" fill="#a83805"></rect>
        <rect x="446" y="216" width="14" height="12" rx="2" fill="#ffd25a"></rect>
        <rect x="456" y="236" width="18" height="20" rx="3" fill="#9aa4b0"></rect>

        <!-- 대형 휠 & 타이어 -->
        <g>
          <circle cx="150" cy="262" r="32" fill="#0f1f3a"></circle>
          <circle cx="150" cy="262" r="16" fill="#cfd6df"></circle>
          <circle cx="150" cy="262" r="6" fill="#0f1f3a"></circle>
          <circle cx="400" cy="262" r="32" fill="#0f1f3a"></circle>
          <circle cx="400" cy="262" r="16" fill="#cfd6df"></circle>
          <circle cx="400" cy="262" r="6" fill="#0f1f3a"></circle>
        </g>
      </svg>
    </div>
  </section>

  <!-- 2. 핵심 3블록 -->
  <section class="ydk2-section" aria-label="핵심 서비스">
    <div class="ui three column stackable grid">
      <div class="column">
        <div class="ydk2-block">
          <i class="truck icon ydk2-block-icon"></i>
          <h2 class="ydk2-block-title">용달·화물</h2>
          <p class="ydk2-block-text">1톤부터 5톤, 탑차, 리프트차까지</p>
          <a href="<?= url('contents/company/company_list.php?id=07') ?>" class="ydk2-block-link">차량 보기 <i class="angle right icon"></i></a>
        </div>
      </div>
      <div class="column">
        <div class="ydk2-block">
          <i class="dolly icon ydk2-block-icon"></i>
          <h2 class="ydk2-block-title">이사</h2>
          <p class="ydk2-block-text">원룸·사무실·포장 이사까지</p>
          <a href="<?= url('contents/info/yd_mov.php') ?>" class="ydk2-block-link">이사 안내 <i class="angle right icon"></i></a>
        </div>
      </div>
      <div class="column">
        <div class="ydk2-block">
          <i class="map marker alternate icon ydk2-block-icon"></i>
          <h2 class="ydk2-block-title">지역 차주 찾기</h2>
          <p class="ydk2-block-text">내 동네 차주와 바로 연결</p>
          <a href="#regionSection" class="ydk2-block-link">지역 선택 <i class="angle right icon"></i></a>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. 차종·이사 탭 -->
  <section class="ydk2-section" aria-label="차종 및 이사 서비스 바로가기">
    <h2 class="ydk2-title">원하는 서비스를 고르세요</h2>
    <div class="ui menu ydk2-tabs">
      <a class="item active" data-tab="svc-freight">화물·차종</a>
      <a class="item" data-tab="svc-move">이사</a>
    </div>
    <div class="ui tab active" data-tab="svc-freight">
      <div class="ydk2-links">
        <?php foreach ($freightServices as $svc): ?>
          <a href="<?= e($svc['url']) ?>" class="ydk2-link"><i class="<?= e($svc['icon']) ?> icon"></i> <?= e($svc['name']) ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="ui tab" data-tab="svc-move">
      <div class="ydk2-links">
        <?php foreach ($moveServices as $svc): ?>
          <a href="<?= e($svc['url']) ?>" class="ydk2-link"><i class="<?= e($svc['icon']) ?> icon"></i> <?= e($svc['name']) ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 4. 지역 선택 탭 -->
  <section id="regionSection" class="ydk2-section" aria-label="지역별 차량 안내">
    <h2 class="ydk2-title">지역을 선택하세요</h2>
    <div class="ui menu ydk2-tabs">
      <?php foreach ($regionTabs as $i => $tab): ?>
        <a class="item<?= $i === 0 ? ' active' : '' ?>" data-tab="reg-<?= e($tab['key']) ?>"><?= e($tab['label']) ?></a>
      <?php endforeach; ?>
    </div>
    <?php foreach ($regionTabs as $i => $tab): ?>
      <div class="ui tab<?= $i === 0 ? ' active' : '' ?>" data-tab="reg-<?= e($tab['key']) ?>">
        <div class="ydk2-links">
          <?php foreach ($tab['areas'] as $area): ?>
            <a href="<?= url("contents/company/company_list.php?id={$area['id']}") ?>" class="ydk2-link"><?= e($area['name']) ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>

    <div class="ui accordion ydk2-accordion">
      <div class="title"><i class="dropdown icon"></i> 지역별 운송 정보 안내</div>
      <div class="content">
        <div class="ydk2-links">
          <?php foreach ($areaInfos as $info): ?>
            <a href="<?= legacy($info[1]) ?>" class="ydk2-link"><?= e($info[0]) ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. 이용 절차 (아이콘 + 제목) -->
  <section class="ydk2-section" aria-label="이용 절차">
    <h2 class="ydk2-title">이용은 이렇게 간단합니다</h2>
    <ol class="ydk2-steps">
      <?php foreach ($procedure as $step): ?>
        <li class="ydk2-step">
          <i class="<?= e($step['icon']) ?> icon ydk2-step-icon"></i>
          <span><?= e($step['title']) ?></span>
        </li>
      <?php endforeach; ?>
    </ol>
    <p class="ydk2-note">상담 전 확인할 내용은 <a href="<?= url('contents/tel/tel.php') ?>">전화 상담 방법 안내</a>에서 볼 수 있습니다.</p>
  </section>

  <!-- 6. 공지 / 묻고답하기 (3줄) -->
  <section class="ydk2-section" aria-label="공지사항과 묻고답하기">
    <div class="ui two column stackable grid">
      <div class="column">
        <div class="ydk2-board-head">
          <h2 class="ydk2-board-title">공지사항</h2>
          <a href="<?= url('contents/notice/notice.php') ?>" class="ydk2-more">더보기 <i class="angle right icon"></i></a>
        </div>
        <ul class="ydk2-board">
          <?php if (!empty($mainNotices)): ?>
            <?php foreach ($mainNotices as $n): ?>
              <li>
                <a href="<?= url('contents/notice/notice_view.php?id=' . (int)$n['id']) ?>">
                  <?php if (!empty($n['is_pinned'])): ?>
                    <span style="color: #EF4444; font-weight: 700; margin-right: 2px;">[공지]</span>
                  <?php endif; ?>
                  <?= e($n['title']) ?>
                </a>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li><a href="<?= url('contents/notice/notice.php') ?>">등록된 공지사항이 없습니다.</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <div class="column">
        <div class="ydk2-board-head">
          <h2 class="ydk2-board-title">묻고답하기</h2>
          <a href="<?= url('contents/qa/qa.php') ?>" class="ydk2-more">전체보기 <i class="angle right icon"></i></a>
        </div>
        <ul class="ydk2-board">
          <?php if (!empty($mainQas)): ?>
            <?php foreach ($mainQas as $q): ?>
              <li>
                <a href="<?= url('contents/qa/qa_view.php?id=' . (int)$q['id']) ?>">
                  <?php if (($q['status'] ?? '') === '답변완료'): ?>
                    <span style="color: #16A34A; font-weight: 700; margin-right: 2px;">[완료]</span>
                  <?php else: ?>
                    <span style="color: #EA580C; font-weight: 700; margin-right: 2px;">[대기]</span>
                  <?php endif; ?>
                  <?= e($q['title']) ?>
                </a>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li><a href="<?= url('contents/qa/qa_write.php') ?>">첫 번째 질문을 등록해 보세요!</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
    <p class="ydk2-note"><i class="id card outline icon"></i> 차주님이신가요? <a href="<?= url('contents/club/car_club.php') ?>">차주 회원 모집 안내</a></p>
  </section>

  <!-- 7. 마무리 전화 CTA -->
  <section class="ydk2-closing" aria-label="전화 상담">
    <h2 class="ydk2-closing-title">지금 바로 전화 주세요</h2>
    <a href="tel:<?= SITE_PHONE_TEL ?>" class="ydk2-closing-phone"><i class="phone icon"></i> <?= SITE_PHONE ?></a>
  </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
