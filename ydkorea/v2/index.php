<?php
/**
 * 용달코리아 v2 메인 페이지 (PHP 7.4.33)
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

<main class="ydk-container ydk-main">

  <!-- 1. 히어로 배너 -->
  <section class="ydk-hero">
    <div class="ydk-hero-content">
      <div class="ydk-hero-badge"><i class="check circle icon"></i> 전국 화물·용달 직거래 네트워크</div>
      <h1 class="ydk-hero-title">
        용달 이사부터 5톤 전국 화물까지<br>
        한 통의 전화로 빠르고 친절하게
      </h1>
      <p class="ydk-hero-desc">
        거품 없는 직거래 운송 요금과 검증된 전문 차주 연결로<br>
        소형 용달부터 대형 전국 화물까지 신속·정확하게 운송해 드립니다.
      </p>
      <div class="ydk-hero-actions">
        <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button ydk-hero-btn ydk-cta">
          <i class="phone icon"></i> 전화 상담 (<?= SITE_PHONE ?>)
        </a>
        <a href="#regionSection" class="ui button ydk-hero-btn ydk-outline">
          <i class="map marker alternate icon"></i> 지역 차주 찾기
        </a>
        <a href="<?= legacy('main/freight.html') ?>" class="ui button ydk-hero-btn ydk-outline">
          <i class="calendar check icon"></i> 화물 예약
        </a>
      </div>
    </div>
  </section>

  <!-- 2. 상담 전 확인사항 안내 박스 -->
  <section class="ui message ydk-notice-box">
    <div class="header">
      <i class="info circle icon"></i> 상담 전화를 하실 때는 이런 내용을 꼭 알고서 전화해 주세요!
    </div>
    <ul>
      <li>전문 상담원이 신속히 견적을 안내해 드리므로 <strong>차량 종류</strong>와 <strong>화물의 물동량</strong>을 미리 확인해 주세요.</li>
      <li>정확한 <strong>출발지와 도착지</strong> (예: 서울 종로구 2가에서 서초구 서초동까지 / 경기 군포에서 부산 해운대구까지)를 알려주세요.</li>
      <li>더 자세한 상담 준비 요령은 <a href="<?= legacy('main/tel_con.html') ?>"><strong>[전화 상담 방법 안내]</strong></a>에서 확인하실 수 있습니다.</li>
    </ul>
  </section>

  <!-- 3. 바로가기 15대 서비스 그리드 -->
  <section class="ydk-quick-grid">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="th icon"></i> 맞춤 차종 및 이사 서비스</h2>
      <span class="ydk-section-sub">필요하신 화물 차종이나 이사 서비스를 선택하시면 상세 안내 페이지로 이동합니다.</span>
    </div>
    <div class="ui five column grid">
      <?php foreach ($quickServices as $svc): ?>
        <div class="column">
          <a href="<?= e($svc['url']) ?>" class="ydk-service-card">
            <div class="ydk-service-icon"><i class="<?= e($svc['icon']) ?> icon"></i></div>
            <div class="ydk-service-name"><?= e($svc['name']) ?></div>
            <div class="ydk-service-desc"><?= e($svc['desc']) ?></div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- 4. 지역 차량 찾기 (서울 / 경기 / 광역시) -->
  <section id="regionSection" class="ydk-region-section">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="map marked alternate icon"></i> 전국 지역별 차량 직거래 안내</h2>
      <span class="ydk-section-sub">원하시는 지역을 클릭하시면 해당 지역에 등록된 차주와 바로 직거래 상담을 하실 수 있습니다.</span>
    </div>

    <!-- 서울 지역 (25개 구) -->
    <div class="ydk-region-group">
      <div class="ydk-region-label">
        <span class="ydk-region-badge">서울 특별시</span>
        <span>서울 전 지역 (25개 구)</span>
      </div>
      <div class="ydk-region-pills">
        <?php foreach ($seoulAreas as $area): ?>
          <a href="<?= legacy("main/list.php?id={$area['id']}") ?>" class="ydk-region-pill">
            <?= e($area['name']) ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- 경기/인천 지역 -->
    <div class="ydk-region-group">
      <div class="ydk-region-label">
        <span class="ydk-region-badge">경기도 · 인천</span>
        <span>수도권 주요 시/구</span>
      </div>
      <div class="ydk-region-pills">
        <?php foreach ($gyeonggiAreas as $area): ?>
          <a href="<?= legacy("main/list.php?id={$area['id']}") ?>" class="ydk-region-pill">
            <?= e($area['name']) ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- 전국 광역시 및 주요 도시 -->
    <div class="ydk-region-group">
      <div class="ydk-region-label">
        <span class="ydk-region-badge">전국 광역시 · 지방</span>
        <span>전국 주요 광역시 및 지방 도시</span>
      </div>
      <div class="ydk-region-pills">
        <?php foreach ($metroAreas as $area): ?>
          <a href="<?= legacy("main/list.php?id={$area['id']}") ?>" class="ydk-region-pill">
            <?= e($area['name']) ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- 5. 2단 위젯 (게시판 & 서비스 안내) -->
  <section class="ydk-board-section">
    <div class="ui two column grid">

      <!-- 좌측: 공지사항 & 묻고답하기 -->
      <div class="column">
        <!-- 공지사항 -->
        <div class="ydk-board-card ydk-board-card-spaced">
          <div class="ydk-board-header">
            <h3 class="ydk-board-title"><i class="bullhorn icon"></i> 공지사항</h3>
            <a href="<?= legacy('bbs/zboard.php?id=gongji') ?>" class="ydk-board-more">더보기 <i class="angle right icon"></i></a>
          </div>
          <div class="ui list ydk-board-list">
            <div class="item">
              <a href="<?= legacy('bbs/zboard.php?id=gongji') ?>">
                <span class="ydk-board-item-title">스폰서 부정 클릭은 형사 처벌을 받습니다</span>
                <span class="ydk-board-badge">공지</span>
              </a>
            </div>
            <div class="item">
              <a href="<?= legacy('bbs/zboard.php?id=gongji') ?>">
                <span class="ydk-board-item-title">용달코리아 전국 차주 회원을 상시 모집합니다</span>
                <span class="ydk-board-badge">안내</span>
              </a>
            </div>
            <div class="item">
              <a href="<?= legacy('bbs/zboard.php?id=gongji') ?>">
                <span class="ydk-board-item-title">부정 클릭 및 허위 문의에 대한 법적 대응 안내</span>
                <span class="ydk-board-badge">필독</span>
              </a>
            </div>
            <div class="item">
              <a href="<?= legacy('bbs/zboard.php?id=gongji') ?>">
                <span class="ydk-board-item-title">용달코리아 광고 안내 및 회원 위치 서비스 소개</span>
                <span class="ydk-board-badge">안내</span>
              </a>
            </div>
          </div>
        </div>

        <!-- 묻고답하기 (견적문의) -->
        <div class="ydk-board-card">
          <div class="ydk-board-header">
            <h3 class="ydk-board-title"><i class="comments icon"></i> 묻고답하기 (견적 문의)</h3>
            <a href="<?= legacy('bbs/zboard.php?id=Qwrite') ?>" class="ydk-board-more">문의 작성 <i class="angle right icon"></i></a>
          </div>
          <div class="ui list ydk-board-list">
            <div class="item">
              <a href="<?= legacy('bbs/zboard.php?id=Qwrite') ?>">
                <span class="ydk-board-item-title">용달 화물 견적 문의 드립니다</span>
                <span class="ydk-board-badge">견적</span>
              </a>
            </div>
            <div class="item">
              <a href="<?= legacy('bbs/zboard.php?id=Qwrite') ?>">
                <span class="ydk-board-item-title">원룸 이사 및 소형 화물 운송 문의</span>
                <span class="ydk-board-badge">이사</span>
              </a>
            </div>
            <div class="item">
              <a href="<?= legacy('bbs/zboard.php?id=Qwrite') ?>">
                <span class="ydk-board-item-title">개인 가구(침대, 책상) 운송 비용 견적 부탁드립니다</span>
                <span class="ydk-board-badge">가구</span>
              </a>
            </div>
            <div class="item">
              <a href="<?= legacy('bbs/zboard.php?id=Qwrite') ?>">
                <span class="ydk-board-item-title">서울-지방 장거리 화물 견적 요청</span>
                <span class="ydk-board-badge">지방</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- 우측: 서비스 이용 단계 & 차주 모집 배너 -->
      <div class="column">
        <div class="ydk-board-card">
          <div class="ydk-board-header">
            <h3 class="ydk-board-title"><i class="tasks icon"></i> 화물·용달 이용 절차 안내</h3>
            <a href="<?= legacy('main/service.html') ?>" class="ydk-board-more">상세보기 <i class="angle right icon"></i></a>
          </div>

          <div class="ydk-steps-wrap">
            <div class="ydk-step-item">
              <div class="ydk-step-num">STEP 1</div>
              <div class="ydk-step-title">전화 상담</div>
              <div class="ydk-step-desc">1688-2404 견적 및 일정 접수</div>
            </div>
            <div class="ydk-step-item">
              <div class="ydk-step-num">STEP 2</div>
              <div class="ydk-step-title">차량 배차</div>
              <div class="ydk-step-desc">최적 차종 및 전담 차주 지정</div>
            </div>
            <div class="ydk-step-item">
              <div class="ydk-step-num">STEP 3</div>
              <div class="ydk-step-title">화물 상차</div>
              <div class="ydk-step-desc">약속 시간 출발지 도착 및 적재</div>
            </div>
            <div class="ydk-step-item">
              <div class="ydk-step-num">STEP 4</div>
              <div class="ydk-step-title">안전 운송</div>
              <div class="ydk-step-desc">목적지까지 신속·안전 이동</div>
            </div>
            <div class="ydk-step-item">
              <div class="ydk-step-num">STEP 5</div>
              <div class="ydk-step-title">하차 완료</div>
              <div class="ydk-step-desc">도착지 확인 및 운송 완료</div>
            </div>
          </div>

          <!-- 차주 모집 배너 카드 -->
          <div class="ydk-driver-banner">
            <div>
              <div class="ydk-driver-title"><i class="id card outline icon"></i> 용달코리아 차주 회원 상시 모집</div>
              <div class="ydk-driver-desc">1톤 용달, 리프트차, 탑차, 2.5톤~5톤 화물 차주님을 모십니다.</div>
            </div>
            <div>
              <a href="<?= legacy('main/car_club.html') ?>" class="ui small inverted button">
                회원 가입 안내 <i class="arrow right icon"></i>
              </a>
            </div>
          </div>

          <!-- 지역 상세 정보 바로가기 -->
          <div class="ydk-area-info-wrap">
            <div class="ydk-area-info-title">
              <i class="info circle icon"></i> 지역별 운송 정보 안내
            </div>
            <div class="ydk-area-info-pills">
              <a href="<?= legacy('main/area_info_01.html') ?>" class="ydk-region-pill ydk-pill-sm">서울·수도권 화물안내</a>
              <a href="<?= legacy('main/area_info_02.html') ?>" class="ydk-region-pill ydk-pill-sm">충청권 화물안내</a>
              <a href="<?= legacy('main/area_info_03.html') ?>" class="ydk-region-pill ydk-pill-sm">호남권 화물안내</a>
              <a href="<?= legacy('main/area_info_04.html') ?>" class="ydk-region-pill ydk-pill-sm">영남권 화물안내</a>
              <a href="<?= legacy('main/area_info_05.html') ?>" class="ydk-region-pill ydk-pill-sm">강원·제주 화물안내</a>
              <a href="<?= legacy('main/area_info_06.html') ?>" class="ydk-region-pill ydk-pill-sm">리턴 공차 안내</a>
              <a href="<?= legacy('main/area_info_07.html') ?>" class="ydk-region-pill ydk-pill-sm">용달 운임 기준표</a>
              <a href="<?= legacy('main/area_info_08.html') ?>" class="ydk-region-pill ydk-pill-sm">화물 취급 요령</a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

</main>

<?php
include __DIR__ . '/includes/footer.php';
?>
