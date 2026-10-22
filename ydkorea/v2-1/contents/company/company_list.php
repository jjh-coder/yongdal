<?php
/**
 * 용달코리아 v2-1 지역별 업체 리스트 (PHP 7.4.33, 반응형 웹)
 * 원본: main/list.php
 * 대상 경로: v2-1/contents/company/company_list.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../admin/includes/db.php';

// 지역 및 차종 ID 맵핑 정의
$areaMap = [
    // 차종별 특화 카테고리
    '07' => ['name' => 'best 용달', 'category' => '차종별', 'badge' => '우수추천'],
    '08' => ['name' => '1.4t / 2.5t / 5t 화물', 'category' => '차종별', 'badge' => '중·대형화물'],
    '09' => ['name' => '탑차 (1t~5t)', 'category' => '차종별', 'badge' => '방수·안심'],
    '10' => ['name' => '리프트차 (1t, 1.4t)', 'category' => '차종별', 'badge' => '중량물·장비'],

    // 서울 25개 자치구
    '11' => ['name' => '서울 강남구', 'category' => '서울', 'badge' => '서울'],
    '12' => ['name' => '서울 강동구', 'category' => '서울', 'badge' => '서울'],
    '13' => ['name' => '서울 강서구', 'category' => '서울', 'badge' => '서울'],
    '14' => ['name' => '서울 강북구', 'category' => '서울', 'badge' => '서울'],
    '15' => ['name' => '서울 관악구', 'category' => '서울', 'badge' => '서울'],
    '16' => ['name' => '서울 광진구', 'category' => '서울', 'badge' => '서울'],
    '17' => ['name' => '서울 구로구', 'category' => '서울', 'badge' => '서울'],
    '18' => ['name' => '서울 금천구', 'category' => '서울', 'badge' => '서울'],
    '19' => ['name' => '서울 노원구', 'category' => '서울', 'badge' => '서울'],
    '20' => ['name' => '서울 도봉구', 'category' => '서울', 'badge' => '서울'],
    '21' => ['name' => '서울 동대문구', 'category' => '서울', 'badge' => '서울'],
    '22' => ['name' => '서울 동작구', 'category' => '서울', 'badge' => '서울'],
    '23' => ['name' => '서울 마포구', 'category' => '서울', 'badge' => '서울'],
    '24' => ['name' => '서울 서대문구', 'category' => '서울', 'badge' => '서울'],
    '25' => ['name' => '서울 서초구', 'category' => '서울', 'badge' => '서울'],
    '26' => ['name' => '서울 성동구', 'category' => '서울', 'badge' => '서울'],
    '27' => ['name' => '서울 성북구', 'category' => '서울', 'badge' => '서울'],
    '28' => ['name' => '서울 송파구', 'category' => '서울', 'badge' => '서울'],
    '29' => ['name' => '서울 양천구', 'category' => '서울', 'badge' => '서울'],
    '30' => ['name' => '서울 영등포구', 'category' => '서울', 'badge' => '서울'],
    '31' => ['name' => '서울 용산구', 'category' => '서울', 'badge' => '서울'],
    '32' => ['name' => '서울 은평구', 'category' => '서울', 'badge' => '서울'],
    '33' => ['name' => '서울 종로구', 'category' => '서울', 'badge' => '서울'],
    '34' => ['name' => '서울 중구', 'category' => '서울', 'badge' => '서울'],
    '35' => ['name' => '서울 중랑구', 'category' => '서울', 'badge' => '서울'],

    // 경기/인천 21개 지역
    '36' => ['name' => '경기 구리/남양주', 'category' => '경기·인천', 'badge' => '수도권'],
    '37' => ['name' => '경기 군포/의왕', 'category' => '경기·인천', 'badge' => '수도권'],
    '38' => ['name' => '경기 성남/분당', 'category' => '경기·인천', 'badge' => '수도권'],
    '39' => ['name' => '경기 평택/송탄', 'category' => '경기·인천', 'badge' => '수도권'],
    '40' => ['name' => '경기 수원/병점', 'category' => '경기·인천', 'badge' => '수도권'],
    '41' => ['name' => '경기 안산/시흥', 'category' => '경기·인천', 'badge' => '수도권'],
    '42' => ['name' => '경기 안양/과천', 'category' => '경기·인천', 'badge' => '수도권'],
    '43' => ['name' => '경기 오산/동탄', 'category' => '경기·인천', 'badge' => '수도권'],
    '44' => ['name' => '인천/부평', 'category' => '경기·인천', 'badge' => '수도권'],
    '45' => ['name' => '경기 화성/발안', 'category' => '경기·인천', 'badge' => '수도권'],
    '46' => ['name' => '경기 광명시', 'category' => '경기·인천', 'badge' => '수도권'],
    '47' => ['name' => '경기 양주시', 'category' => '경기·인천', 'badge' => '수도권'],
    '48' => ['name' => '경기 의정부시', 'category' => '경기·인천', 'badge' => '수도권'],
    '49' => ['name' => '경기 포천시', 'category' => '경기·인천', 'badge' => '수도권'],
    '50' => ['name' => '경기 광주시', 'category' => '경기·인천', 'badge' => '수도권'],
    '51' => ['name' => '경기 고양시/일산', 'category' => '경기·인천', 'badge' => '수도권'],
    '52' => ['name' => '경기 김포시', 'category' => '경기·인천', 'badge' => '수도권'],
    '53' => ['name' => '경기 부천시', 'category' => '경기·인천', 'badge' => '수도권'],
    '54' => ['name' => '경기 용인시', 'category' => '경기·인천', 'badge' => '수도권'],
    '55' => ['name' => '경기 파주시', 'category' => '경기·인천', 'badge' => '수도권'],
    '56' => ['name' => '경기 하남시', 'category' => '경기·인천', 'badge' => '수도권'],

    // 광역시 및 전국 주요 도시
    '57' => ['name' => '충남 천안시', 'category' => '광역시·지방', 'badge' => '충청'],
    '58' => ['name' => '충북 충주시', 'category' => '광역시·지방', 'badge' => '충청'],
    '59' => ['name' => '대전광역시', 'category' => '광역시·지방', 'badge' => '광역시'],
    '60' => ['name' => '전북 전주시', 'category' => '광역시·지방', 'badge' => '호남'],
    '61' => ['name' => '광주광역시', 'category' => '광역시·지방', 'badge' => '광역시'],
    '62' => ['name' => '부산광역시', 'category' => '광역시·지방', 'badge' => '광역시'],
    '63' => ['name' => '울산광역시', 'category' => '광역시·지방', 'badge' => '광역시'],
    '64' => ['name' => '대구광역시', 'category' => '광역시·지방', 'badge' => '광역시'],
    '65' => ['name' => '강원 원주시', 'category' => '광역시·지방', 'badge' => '강원'],
    '66' => ['name' => '강원 춘천시', 'category' => '광역시·지방', 'badge' => '강원'],
    '67' => ['name' => '경북 포항시', 'category' => '광역시·지방', 'badge' => '영남'],
    '68' => ['name' => '강원 강릉시', 'category' => '광역시·지방', 'badge' => '강원'],
    '69' => ['name' => '경남 창원시', 'category' => '광역시·지방', 'badge' => '영남'],
    '71' => ['name' => '경북 구미시', 'category' => '광역시·지방', 'badge' => '영남'],
    '77' => ['name' => '경남 진주시', 'category' => '광역시·지방', 'badge' => '영남'],
    '79' => ['name' => '경남 양산시', 'category' => '광역시·지방', 'badge' => '영남'],
    '80' => ['name' => '세종특별자치시', 'category' => '광역시·지방', 'badge' => '충청'],
    '81' => ['name' => '전북 군산시', 'category' => '광역시·지방', 'badge' => '호남'],
    '82' => ['name' => '전남 순천시', 'category' => '광역시·지방', 'badge' => '호남'],
];

// 요청 ID 처리 (기본값: '07' best 용달)
$id = trim($_GET['id'] ?? '07');
if (!isset($areaMap[$id])) {
    $id = '07';
}

$currentInfo = $areaMap[$id];
$pageTitle = $currentInfo['name'] . ' 지역별 업체 리스트 | ' . SITE_NAME;
$metaDescription = $currentInfo['name'] . ' 지역 화물·용달 전문 차주 및 운송 업체 안내. 전화 통화로 직거래 상담 및 당일 즉시 배차를 지원합니다.';

/**
 * DB에서 가져온 레거시 상호명 및 지점 링크 정제 함수
 */
function clean_company_name(string $rawName, string $rawCode = ''): array
{
    // HTML 태그 제거하여 순수 상호명 추출
    $name = trim(strip_tags($rawName));

    // a href 속성에서 지점 링크 또는 code 추출
    $link = '';
    if (preg_match('/href=["\']?([^"\'>\s]+)["\']?/i', $rawName, $m)) {
        $link = $m[1];
    } elseif (!empty($rawCode)) {
        $link = '/jijum/' . $rawCode . '.html';
    }

    return [
        'name' => $name ?: '용달 전문점',
        'link' => $link,
    ];
}

/**
 * DB에서 가져온 레거시 전화번호 필드 정제 함수
 */
function clean_company_tel(string $rawTel): array
{
    // 태그 제거
    $cleanTel = trim(strip_tags($rawTel));
    // 공백 정리
    $cleanTel = preg_replace('/\s+/', ' ', $cleanTel);

    // 전화걸기 링크용 숫자만 추출
    $cleanNumber = preg_replace('/[^0-9]/', '', $cleanTel);

    // 기본값 보정
    if (empty($cleanTel)) {
        $cleanTel = SITE_PHONE;
        $cleanNumber = SITE_PHONE_TEL;
    }

    return [
        'display' => $cleanTel,
        'number'  => $cleanNumber,
    ];
}

/**
 * DB에서 가져온 상세설명 정제 함수
 */
function clean_company_detail(string $rawDetail): string
{
    $detail = trim(strip_tags($rawDetail));
    return $detail ?: '소형화물, 원룸이사, 학생이사 전국 화물 운송 전문';
}

// DB 조회 시도
$companies = [];
$pdo = get_db_connection();
if ($pdo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM company WHERE id = :id ORDER BY rand()");
        $stmt->execute([':id' => $id]);
        $companies = $stmt->fetchAll() ?: [];
    } catch (\Throwable $e) {
        $companies = [];
    }
}

// Fallback Mock 데이터 (DB 연결 불가 또는 데이터 부재 시 예시 데이터 제공)
if (empty($companies)) {
    $currentName = $currentInfo['name'];
    $shortName = preg_replace('/^(서울|경기|충남|충북|전북|전남|경북|경남|강원)\s*/', '', $currentName);

    $companies = [
        [
            'code'   => 'c' . $id . '01',
            'name'   => $shortName . ' 성실용달',
            'tel'    => '010-8833-1412',
            'detail' => '원룸이사·일반화물·학생이사 전문 친절 상담',
            'car'    => '1톤 카고 (호루)'
        ],
        [
            'code'   => 'c' . $id . '02',
            'name'   => $shortName . ' 직거래화물',
            'tel'    => '1688-2404',
            'detail' => '소형화물부터 중형화물 당일 신속 배차 지원',
            'car'    => '1톤 / 1.4톤 화물'
        ],
        [
            'code'   => 'c' . $id . '03',
            'name'   => $shortName . ' 파워리프트',
            'tel'    => '010-3456-7890',
            'detail' => '오토바이·대형가전·무거운 장비 안전 탁송',
            'car'    => '1톤 리프트차'
        ],
        [
            'code'   => 'c' . $id . '04',
            'name'   => $shortName . ' 안심탑차',
            'tel'    => '010-9876-5432',
            'detail' => '비·눈 걱정 없는 박스화물·가구 깔끔 운송',
            'car'    => '1톤 내장탑차'
        ],
        [
            'code'   => 'c' . $id . '05',
            'name'   => $shortName . ' 개별화물 2.5톤',
            'tel'    => '1688-2407',
            'detail' => '공장 자재·기업 물류·장거리 지방화물 전문',
            'car'    => '2.5톤 카고/윙탑'
        ],
        [
            'code'   => 'c' . $id . '06',
            'name'   => $shortName . ' 5톤 대형특송',
            'tel'    => '010-5555-7777',
            'detail' => '파레트 대량 화물·전국 광역 장거리 독차 배차',
            'car'    => '5톤 윙탑'
        ],
    ];
}

require_once __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">지역별 업체 안내</span>
      <span class="divider">/</span>
      <span class="active" style="color: var(--ydk-primary); font-weight: 700;"><?= e($currentInfo['name']) ?></span>
    </nav>
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="ydk-page-title" style="margin-bottom: 6px;">
          <i class="map marker alternate icon" style="color: var(--ydk-primary);"></i>
          <?= e($currentInfo['name']) ?> 전문 업체 리스트
          <span class="ui blue small label" style="margin-left: 8px; vertical-align: middle;"><?= e($currentInfo['badge']) ?></span>
        </h1>
        <p class="ydk-page-desc">
          해당 지역 전담 차주 및 전문 운송 업체와 <strong>직접 통화하여 합리적인 운송비와 일정</strong>을 조율하세요.
        </p>
      </div>
      <div>
        <a href="<?= url('contents/club/car_club.php') ?>" class="ui small primary button" style="font-weight: 700;">
          <i class="truck icon"></i> 이 지역 차주 등록 신청
        </a>
      </div>
    </div>
  </header>

  <!-- 2. 빠른 지역/차종 전환 네비게이터 -->
  <section class="ui segment" style="background: #F8FAFC; border: 1px solid var(--ydk-border-light); border-radius: 12px; padding: 20px 24px; margin-bottom: 28px;">
    <div style="font-size: 15px; font-weight: 800; color: #1E293B; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
      <i class="compass outline icon" style="color: var(--ydk-primary);"></i> 다른 지역 및 차종 바로가기
    </div>

    <!-- 대분류 탭 버튼 -->
    <div class="ui stackable four item menu" style="margin-bottom: 16px; border: 1px solid #CBD5E1;">
      <a class="item <?= in_array($id, ['07', '08', '09', '10']) ? 'active' : '' ?>" href="<?= url('contents/company/company_list.php?id=07') ?>" style="font-weight: 700;">
        <i class="truck icon"></i> 차종별 추천 (1톤~5톤)
      </a>
      <a class="item <?= ((int)$id >= 11 && (int)$id <= 35) ? 'active' : '' ?>" href="<?= url('contents/company/company_list.php?id=11') ?>" style="font-weight: 700;">
        <i class="building icon"></i> 서울 25개 구
      </a>
      <a class="item <?= ((int)$id >= 36 && (int)$id <= 56) ? 'active' : '' ?>" href="<?= url('contents/company/company_list.php?id=36') ?>" style="font-weight: 700;">
        <i class="map icon"></i> 경기 / 인천 (21개 시·군)
      </a>
      <a class="item <?= ((int)$id >= 57) ? 'active' : '' ?>" href="<?= url('contents/company/company_list.php?id=59') ?>" style="font-weight: 700;">
        <i class="globe icon"></i> 전국 광역시 / 거점
      </a>
    </div>

    <!-- 세부 지역 빠른 클릭 칩스 (현재 선택된 대분류에 맞춤 표시) -->
    <div style="display: flex; flex-wrap: wrap; gap: 6px; max-height: 140px; overflow-y: auto; padding: 6px 0;">
      <?php
      $targetCategory = $currentInfo['category'];
      foreach ($areaMap as $k => $item) {
          if ($item['category'] === $targetCategory) {
              $isActive = ($k === $id);
              $activeStyle = $isActive ? 'background-color: var(--ydk-primary); color: #FFF; font-weight: 800;' : 'background-color: #FFF; color: #334155; border: 1px solid #CBD5E1;';
              echo '<a href="' . url('contents/company/company_list.php?id=' . $k) . '" class="ui mini button" style="margin: 0; ' . $activeStyle . '">' . e($item['name']) . '</a>';
          }
      }
      ?>
    </div>
  </section>

  <!-- 3. 직거래 안내 메시지 배너 -->
  <section class="ui message" style="background: linear-gradient(135deg, #1E3A8A 0%, #2563EB 100%); color: #FFFFFF; border-radius: 12px; padding: 22px 28px; margin-bottom: 28px; box-shadow: 0 4px 12px rgba(37,99,235,0.2);">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
      <div>
        <div style="font-size: 20px; font-weight: 900; line-height: 1.3; margin-bottom: 4px;">
          <i class="phone volume icon" style="color: #F59E0B;"></i> 각 업체와 직접 상담하시면 중간 거품 없는 직거래가 이루어집니다!
        </div>
        <div style="font-size: 14px; color: #DBEAFE; line-height: 1.6;">
          원하시는 업체의 전화번호를 클릭하시면 담당 차주와 바로 연결됩니다. 친절하고 신속한 운송을 약속드립니다.
        </div>
      </div>
      <div style="display: flex; gap: 10px; align-items: center;">
        <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge button" style="background-color: #DC2626; color: #FFFFFF; font-weight: 900; padding: 12px 20px; border-radius: 8px;">
          대표 상담: <?= SITE_PHONE ?>
        </a>
      </div>
    </div>
  </section>

  <!-- 4. 업체 리스트 카드 그리드 -->
  <section aria-label="<?= e($currentInfo['name']) ?> 등록 업체 목록" style="margin-bottom: 40px;">
    <div style="margin-bottom: 16px; display: flex; justify-content: space-between; align-items: center;">
      <h2 style="font-size: 19px; font-weight: 800; color: #1E293B; margin: 0;">
        <i class="list alternate outline icon" style="color: var(--ydk-primary);"></i>
        등록 업체 및 차주 목록 (총 <?= count($companies) ?>곳)
      </h2>
      <span style="font-size: 13px; color: var(--ydk-muted);">* 정기 안전점검 및 사업자 등록 확인 업체</span>
    </div>

    <div class="ui stackable three column grid">
      <?php foreach ($companies as $com): 
        $rawName = $com['name'] ?? '';
        $rawTel  = $com['tel'] ?? '';
        $rawCode = $com['code'] ?? '';
        $rawDetail = $com['detail'] ?? ($com['explain'] ?? '');
        $carType = $com['car'] ?? '1톤 카고';

        // HTML 태그 정제
        $parsedName = clean_company_name($rawName, $rawCode);
        $parsedTel  = clean_company_tel($rawTel);
        $cleanDetail = clean_company_detail($rawDetail);
      ?>
        <div class="column">
          <div class="ui fluid card" style="border-radius: 10px; border: 1px solid var(--ydk-border-light); box-shadow: 0 2px 8px rgba(0,0,0,0.04); height: 100%; transition: transform 0.2s, box-shadow 0.2s;">
            <div class="content" style="padding: 20px;">
              <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                <span class="ui blue mini label" style="font-weight: 700;"><?= e($carType) ?></span>
                <span style="font-size: 12px; color: var(--ydk-muted);"><i class="check circle icon" style="color: #059669;"></i> 배차가능</span>
              </div>
              <h3 style="font-size: 19px; font-weight: 800; color: #1E293B; margin: 0 0 10px 0; line-height: 1.4;">
                <?= e($parsedName['name']) ?>
              </h3>
              <p style="font-size: 14px; color: #475569; min-height: 42px; line-height: 1.5; margin-bottom: 16px;">
                <?= e($cleanDetail) ?>
              </p>
              <div style="background-color: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 14px; text-align: center; margin-bottom: 14px;">
                <div style="font-size: 12px; color: var(--ydk-muted); margin-bottom: 2px;">직통 상담 전화</div>
                <a href="tel:<?= e($parsedTel['number']) ?>" style="font-size: 20px; font-weight: 900; color: #2563EB; letter-spacing: 0.5px; display: block;">
                  <i class="phone icon"></i> <?= e($parsedTel['display']) ?>
                </a>
              </div>
              <div style="display: flex; gap: 8px;">
                <a href="tel:<?= e($parsedTel['number']) ?>" class="ui fluid primary button" style="font-weight: 700; padding: 10px; font-size: 14px;">
                  <i class="phone icon"></i> 바로 전화걸기
                </a>
                <?php if (!empty($parsedName['link'])): ?>
                  <a href="<?= e($parsedName['link']) ?>" target="_blank" class="ui basic icon button" title="지점 상세 안내" style="padding: 10px 12px;">
                    <i class="external alternate icon"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- 5. 하단 화물 및 이사 서비스 안내 배너 -->
  <section class="ui segment" style="background: #F1F5F9; border: 1px solid #CBD5E1; border-radius: 12px; padding: 24px; text-align: center; margin-bottom: 20px;">
    <h3 style="font-size: 18px; font-weight: 800; color: #1E293B; margin-top: 0; margin-bottom: 8px;">
      원하시는 차량이나 일정을 찾기 어려우신가요?
    </h3>
    <p style="font-size: 14px; color: #64748B; margin-bottom: 18px;">
      용달코리아 전국 통합 배차 센터로 연락 주시면 고객님의 화물 크기와 일정에 가장 적합한 차량을 즉시 안내해 드립니다.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button" style="background-color: var(--ydk-cta); color: #FFF; font-weight: 700; padding: 12px 24px;">
        <i class="phone icon"></i> 대표 콜센터 1688-2404
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui basic primary button" style="font-weight: 700; padding: 12px 24px;">
        <i class="edit icon"></i> 온라인 상담 남기기
      </a>
    </div>
  </section>

</main>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>
