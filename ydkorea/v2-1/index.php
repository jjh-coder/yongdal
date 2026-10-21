<?php
/**
 * 용달코리아 v2-1 메인 페이지 (v2 대비 단순화 구조 비교용, PHP 7.4.33)
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = '용달코리아 대표번호 1688-2404 용달화물 및 이사 용달차 안내 전국 화물 네트워크';
$pageDescription = '서울시 성동구에 위치한 용달코리아 대표번호 1688-2404. 용달, 1톤~5톤 화물, 용달이사, 원룸이사, 리프트차, 탑차, 전국 화물 네트워크 직거래 연결';

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
    ['name' => 'best 용달', 'desc' => '신속·친절 우수 용달', 'url' => legacy('main/list.php?id=07'), 'icon' => 'truck'],
    ['name' => '1.4t / 2.5t / 5t', 'desc' => '중·대형 화물 트럭', 'url' => legacy('main/list.php?id=08'), 'icon' => 'shipping fast'],
    ['name' => '탑차 (1t~5t)', 'desc' => '비·눈 걱정 없는 탑차', 'url' => legacy('main/list.php?id=09'), 'icon' => 'box'],
    ['name' => '리프트 차', 'desc' => '중량물·장비 전용 리프트', 'url' => legacy('main/list.php?id=10'), 'icon' => 'level up alternate'],
    ['name' => '지역 차량 (서울·경기)', 'desc' => '수도권 차주 직거래', 'url' => legacy('main/area_01.html'), 'icon' => 'map marker alternate'],
    ['name' => '지역 차량 (광역시)', 'desc' => '전국 광역시 차주 안내', 'url' => legacy('main/area_02.html'), 'icon' => 'map signs'],
    ['name' => '화물 예약', 'desc' => '온라인 간편 화물 예약', 'url' => legacy('main/freight.html'), 'icon' => 'calendar check'],
    ['name' => '지방 화물 안내', 'desc' => '장거리·지방 리턴공차', 'url' => legacy('main/car_list_03.html'), 'icon' => 'road'],
    ['name' => '이삿짐 예상 단가', 'desc' => '투명한 이사 요금 기준', 'url' => legacy('main/forecast_trt.html'), 'icon' => 'calculator'],
    ['name' => '용달 이사', 'desc' => '원룸·소형 소호 이사', 'url' => legacy('main/yd_mov.html'), 'icon' => 'home'],
    ['name' => '원룸 이사', 'desc' => '학생·직장인 맞춤 이사', 'url' => legacy('main/room_mov.html'), 'icon' => 'user'],
    ['name' => '사무실 이사', 'desc' => '기업·사무실 이전 전문', 'url' => legacy('main/off_mov.html'), 'icon' => 'building'],
    ['name' => '일반 이사', 'desc' => '알뜰하고 편리한 이사', 'url' => legacy('main/gen_mov.html'), 'icon' => 'dolly'],
    ['name' => '보관 이사', 'desc' => '안전한 화물 보관 이사', 'url' => legacy('main/kee_mov.html'), 'icon' => 'warehouse'],
    ['name' => '포장 이사', 'desc' => '포장부터 정리까지 원스톱', 'url' => legacy('main/pack_mov.html'), 'icon' => 'boxes'],
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

  <!-- 1. 히어로: 한 문장 + 전화 버튼 + 보조 링크 -->
  <section class="ydk2-hero" aria-label="용달코리아 소개">
    <h1 class="ydk2-hero-title">용달·화물·이사,<br>한 통의 전화로 끝냅니다</h1>
    <p class="ydk2-hero-desc">전국 차주와 직거래로 연결해 드립니다.</p>
    <div class="ydk2-hero-actions">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button ydk2-btn-call">
        <i class="phone icon"></i> 전화 상담 <?= SITE_PHONE ?>
      </a>
      <a href="#regionSection" class="ydk2-hero-link">지역 차주 찾기 <i class="angle right icon"></i></a>
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
          <a href="<?= legacy('main/list.php?id=07') ?>" class="ydk2-block-link">차량 보기 <i class="angle right icon"></i></a>
        </div>
      </div>
      <div class="column">
        <div class="ydk2-block">
          <i class="dolly icon ydk2-block-icon"></i>
          <h2 class="ydk2-block-title">이사</h2>
          <p class="ydk2-block-text">원룸·사무실·포장 이사까지</p>
          <a href="<?= legacy('main/yd_mov.html') ?>" class="ydk2-block-link">이사 안내 <i class="angle right icon"></i></a>
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
            <a href="<?= legacy("main/list.php?id={$area['id']}") ?>" class="ydk2-link"><?= e($area['name']) ?></a>
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
    <p class="ydk2-note">상담 전 확인할 내용은 <a href="<?= legacy('main/tel_con.html') ?>">전화 상담 방법 안내</a>에서 볼 수 있습니다.</p>
  </section>

  <!-- 6. 공지 / 묻고답하기 (3줄) -->
  <section class="ydk2-section" aria-label="공지사항과 묻고답하기">
    <div class="ui two column stackable grid">
      <div class="column">
        <div class="ydk2-board-head">
          <h2 class="ydk2-board-title">공지사항</h2>
          <a href="<?= legacy('bbs/zboard.php?id=gongji') ?>" class="ydk2-more">더보기 <i class="angle right icon"></i></a>
        </div>
        <ul class="ydk2-board">
          <li><a href="<?= legacy('bbs/zboard.php?id=gongji') ?>">스폰서 부정 클릭은 형사 처벌을 받습니다</a></li>
          <li><a href="<?= legacy('bbs/zboard.php?id=gongji') ?>">용달코리아 전국 차주 회원을 상시 모집합니다</a></li>
          <li><a href="<?= legacy('bbs/zboard.php?id=gongji') ?>">부정 클릭 및 허위 문의에 대한 법적 대응 안내</a></li>
        </ul>
      </div>
      <div class="column">
        <div class="ydk2-board-head">
          <h2 class="ydk2-board-title">묻고답하기</h2>
          <a href="<?= legacy('bbs/zboard.php?id=Qwrite') ?>" class="ydk2-more">문의 작성 <i class="angle right icon"></i></a>
        </div>
        <ul class="ydk2-board">
          <li><a href="<?= legacy('bbs/zboard.php?id=Qwrite') ?>">용달 화물 견적 문의 드립니다</a></li>
          <li><a href="<?= legacy('bbs/zboard.php?id=Qwrite') ?>">원룸 이사 및 소형 화물 운송 문의</a></li>
          <li><a href="<?= legacy('bbs/zboard.php?id=Qwrite') ?>">서울-지방 장거리 화물 견적 요청</a></li>
        </ul>
      </div>
    </div>
    <p class="ydk2-note"><i class="id card outline icon"></i> 차주님이신가요? <a href="<?= legacy('main/car_club.html') ?>">차주 회원 모집 안내</a></p>
  </section>

  <!-- 7. 마무리 전화 CTA -->
  <section class="ydk2-closing" aria-label="전화 상담">
    <h2 class="ydk2-closing-title">지금 바로 전화 주세요</h2>
    <a href="tel:<?= SITE_PHONE_TEL ?>" class="ydk2-closing-phone"><i class="phone icon"></i> <?= SITE_PHONE ?></a>
  </section>

  <!-- 모바일 전용 하단 고정 전화 바 (767px 이하) -->
  <aside class="ydk-mobile-callbar" aria-label="모바일 즉시 전화상담">
    <a href="tel:<?= SITE_PHONE_TEL ?>" class="ydk-mobile-callbar-btn">
      <i class="phone icon"></i>
      <span class="ydk-mobile-callbar-label">지금 바로 전화 상담</span>
      <strong class="ydk-mobile-callbar-num"><?= SITE_PHONE ?></strong>
    </a>
  </aside>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
