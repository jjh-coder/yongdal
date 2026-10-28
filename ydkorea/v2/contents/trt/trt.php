<?php
/**
 * 용달코리아 v2-1 운송 요금표 페이지 (PHP 7.4.33, 반응형 웹)
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '운송 요금표 | ' . SITE_NAME . ' (1688-2404)';
$pageDescription = '용달코리아 전국 화물 운송 요금 기준표. 서울 시청 출발 기준 서울·수도권 및 강원·충청·영남·호남 전국 1톤, 2.5톤 일반 및 탑차 운송 요금을 투명하게 안내해 드립니다.';

// 운송 요금 데이터 (출발지: 서울시청 기준)
$ratesGyeonggi = [
    ['area1' => '서울시내', 't1_1' => '50,000 ~ 90,000', 't25_1' => '100,000 ~ 130,000', 'area2' => '수도권', 't1_2' => '70,000 ~ 90,000', 't25_2' => '120,000 ~ 150,000'],
    ['area1' => '의정부',   't1_1' => '60,000 ~ 80,000', 't25_1' => '120,000 ~ 140,000', 'area2' => '남양주', 't1_2' => '60,000 ~ 90,000', 't25_2' => '120,000 ~ 150,000'],
    ['area1' => '성남시',   't1_1' => '60,000 ~ 70,000', 't25_1' => '110,000 ~ 130,000', 'area2' => '안양시', 't1_2' => '60,000 ~ 80,000', 't25_2' => '120,000 ~ 130,000'],
    ['area1' => '부천시',   't1_1' => '60,000 ~ 80,000', 't25_1' => '120,000 ~ 140,000', 'area2' => '김포시', 't1_2' => '80,000 ~ 120,000', 't25_2' => '140,000 ~ 170,000'],
    ['area1' => '하남시',   't1_1' => '60,000 ~ 80,000', 't25_1' => '110,000 ~ 130,000', 'area2' => '인천시', 't1_2' => '80,000 ~ 100,000', 't25_2' => '130,000 ~ 160,000'],
    ['area1' => '안산시',   't1_1' => '80,000 ~ 90,000', 't25_1' => '130,000 ~ 150,000', 'area2' => '이천시', 't1_2' => '90,000 ~ 110,000', 't25_2' => '140,000 ~ 160,000'],
    ['area1' => '파주시',   't1_1' => '80,000 ~ 110,000', 't25_1' => '130,000 ~ 160,000', 'area2' => '동두천', 't1_2' => '90,000 ~ 100,000', 't25_2' => '140,000 ~ 160,000'],
    ['area1' => '철원',     't1_1' => '130,000 ~ 140,000', 't25_1' => '180,000 ~ 200,000', 'area2' => '문산',   't1_2' => '100,000 ~ 110,000', 't25_2' => '140,000 ~ 170,000'],
    ['area1' => '강화',     't1_1' => '120,000 ~ 150,000', 't25_1' => '160,000 ~ 180,000', 'area2' => '오산시', 't1_2' => '100,000 ~ 120,000', 't25_2' => '150,000 ~ 170,000'],
    ['area1' => '용인시',   't1_1' => '80,000 ~ 140,000', 't25_1' => '130,000 ~ 180,000', 'area2' => '수원시', 't1_2' => '90,000 ~ 110,000', 't25_2' => '130,000 ~ 160,000'],
    ['area1' => '평택시',   't1_1' => '120,000 ~ 150,000', 't25_1' => '170,000 ~ 180,000', 'area2' => '인천공항', 't1_2' => '110,000 ~ 120,000', 't25_2' => '170,000 ~ 180,000'],
];

$ratesGangwon = [
    ['area1' => '춘천시', 't1_1' => '150,000', 't25_1' => '190,000', 'area2' => '원주시', 't1_2' => '150,000', 't25_2' => '190,000'],
    ['area1' => '강릉시', 't1_1' => '200,000', 't25_1' => '300,000', 'area2' => '동해시', 't1_2' => '230,000', 't25_2' => '330,000'],
    ['area1' => '속초시', 't1_1' => '200,000', 't25_1' => '300,000', 'area2' => '태백시', 't1_2' => '240,000', 't25_2' => '320,000'],
    ['area1' => '삼척시', 't1_1' => '270,000', 't25_1' => '360,000', 'area2' => '간성',   't1_2' => '250,000', 't25_2' => '330,000'],
];

$ratesChungcheong = [
    ['area1' => '천안시', 't1_1' => '140,000', 't25_1' => '190,000', 'area2' => '충주시', 't1_2' => '150,000', 't25_2' => '200,000'],
    ['area1' => '청주시', 't1_1' => '150,000', 't25_1' => '210,000', 'area2' => '서산시', 't1_2' => '150,000', 't25_2' => '230,000'],
    ['area1' => '공주시', 't1_1' => '150,000', 't25_1' => '220,000', 'area2' => '대전시', 't1_2' => '160,000', 't25_2' => '210,000'],
    ['area1' => '논산시', 't1_1' => '180,000', 't25_1' => '250,000', 'area2' => '부여',   't1_2' => '200,000', 't25_2' => '270,000'],
];

$ratesSouth = [
    ['area1' => '전주시', 't1_1' => '200,000', 't25_1' => '280,000', 'area2' => '남원시', 't1_2' => '220,000', 't25_2' => '290,000'],
    ['area1' => '광주시', 't1_1' => '220,000', 't25_1' => '310,000', 'area2' => '광양시', 't1_2' => '270,000', 't25_2' => '360,000'],
    ['area1' => '목포시', 't1_1' => '270,000', 't25_1' => '380,000', 'area2' => '김천시', 't1_2' => '210,000', 't25_2' => '300,000'],
    ['area1' => '대구시', 't1_1' => '220,000', 't25_1' => '310,000', 'area2' => '포항시', 't1_2' => '240,000', 't25_2' => '370,000'],
    ['area1' => '울산시', 't1_1' => '280,000', 't25_1' => '370,000', 'area2' => '부산시', 't1_2' => '270,000', 't25_2' => '380,000'],
    ['area1' => '창원시', 't1_1' => '260,000', 't25_1' => '370,000', 'area2' => '진주시', 't1_2' => '260,000', 't25_2' => '360,000'],
];

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">운송 요금</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="calculator icon"></i> 운송 요금표 (Freight Rates)
    </h1>
    <p class="ydk-page-desc">
      투명하고 합리적인 전국 용달·화물 표준 운임표입니다. 거품 없는 직거래 연결로 신속하고 안전하게 운송해 드립니다.
    </p>
  </header>

  <!-- 2. 요금 기준 필수 안내 박스 -->
  <section class="ydk-rate-guide" aria-label="운송 요금 산정 기준 안내" style="background:var(--ydk-box-bg); border:1px solid var(--ydk-border-light); border-left:6px solid var(--ydk-primary); border-radius:10px; padding:24px 20px; margin-bottom:36px;">
    <h2 style="font-size:19px; font-weight:800; color:var(--ydk-primary); margin:0 0 12px 0; display:flex; align-items:center; gap:8px;">
      <i class="info circle icon"></i> 운송 요금 기준 및 유의사항
    </h2>
    <ul style="margin:0; padding-left:22px; font-size:15px; line-height:1.8; color:var(--ydk-text);">
      <li><strong>출발지 기준:</strong> 본 운임표는 <strong>서울 시청 기준</strong> 일반 카고(오픈형) 트럭 운임입니다.</li>
      <li><strong>탑차(윙탑·탑차) 운임:</strong> 비·눈 안심 운송 및 화물 보호용 탑차는 차종 특성상 <strong>2만 ~ 4만 원</strong>이 추가될 수 있습니다.</li>
      <li><strong>리프트 및 특수 차량:</strong> 오토바이, 대형 복합기 등 중량물 상·하차용 리프트 차량은 작업 조건에 따라 별도 협의됩니다.</li>
      <li><strong>수작업 및 층수 조건:</strong> 단순 차량 운송 외에 기사님 운반 도움, 계단 수작업, 사다리차 이용 시 추가 운임이 발생합니다.</li>
      <li><strong>장거리 알뜰 혼적(합바짐):</strong> 부피가 적은 화물은 같은 방향 차량과 합적하여 <strong>최대 30~50% 저렴한 요금</strong>으로 이용 가능합니다.</li>
    </ul>
    <div style="margin-top:16px; padding-top:12px; border-top:1px dashed var(--ydk-border-light); display:flex; flex-wrap:wrap; justify-content:space-between; align-items:center; gap:12px;">
      <span style="font-size:15px; color:var(--ydk-muted);">
        <i class="phone icon"></i> 상세 맞춤 견적이 필요하신가요? <strong><?= SITE_PHONE ?> / 1688-2407</strong>로 전화 주시면 즉시 안내해 드립니다.
      </span>
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button" style="background:var(--ydk-cta); color:#fff; font-size:15px; font-weight:700; padding:10px 18px; border-radius:6px;">
        <i class="phone icon"></i> 전화로 실시간 견적 문의
      </a>
    </div>
  </section>

  <!-- 3. 권역별 빠른 이동 앵커 탭 -->
  <nav aria-label="권역별 요금표 바로가기" style="margin-bottom:28px;">
    <div class="ui four item stackable menu" style="font-weight:700; font-size:16px;">
      <a class="item" href="#sec-gyeonggi"><i class="map marker alternate icon"></i> 수도권·경기 지역</a>
      <a class="item" href="#sec-gangwon"><i class="mountain icon"></i> 강원도 지역</a>
      <a class="item" href="#sec-chungcheong"><i class="compass icon"></i> 충청도 지역</a>
      <a class="item" href="#sec-south"><i class="road icon"></i> 전라·경상 지역</a>
    </div>
  </nav>

  <!-- 4. 1구역: 수도권 및 경기지역 요금표 -->
  <section id="sec-gyeonggi" class="ydk-rate-section" aria-label="수도권 및 경기지역 운송 요금표" style="margin-bottom:44px;">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="map marker alternate icon"></i> 시내 및 수도권·경기 지역</h2>
      <span class="ydk-section-sub">출발지: 서울 시청 기준 (단위: 원, 일반 카고 기준)</span>
    </div>

    <div class="ydk-table-wrap" style="overflow-x:auto;">
      <table class="ui celled table ydk-table" summary="시내 및 수도권 경기지역 1톤 2.5톤 운송 요금표">
        <thead>
          <tr style="background:#f0f4f9; text-align:center;">
            <th style="width:14%;">지 역</th>
            <th style="width:18%;">1 t 용달</th>
            <th style="width:18%;">2.5 t 트럭</th>
            <th style="width:14%;">지 역</th>
            <th style="width:18%;">1 t 용달</th>
            <th style="width:18%;">2.5 t 트럭</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ratesGyeonggi as $row): ?>
            <tr style="text-align:center;">
              <td style="font-weight:700; background:#fafbfd;"><?= e($row['area1']) ?></td>
              <td style="color:#1b365d; font-weight:600;"><?= e($row['t1_1']) ?></td>
              <td style="color:#555;"><?= e($row['t25_1']) ?></td>
              <td style="font-weight:700; background:#fafbfd;"><?= e($row['area2']) ?></td>
              <td style="color:#1b365d; font-weight:600;"><?= e($row['t1_2']) ?></td>
              <td style="color:#555;"><?= e($row['t25_2']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- 5. 2구역: 강원도 지역 요금표 -->
  <section id="sec-gangwon" class="ydk-rate-section" aria-label="강원도 지역 운송 요금표" style="margin-bottom:44px;">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="mountain icon"></i> 강원도 지역</h2>
      <span class="ydk-section-sub">출발지: 서울 시청 기준 (단위: 원, 일반 카고 기준)</span>
    </div>

    <div class="ydk-table-wrap" style="overflow-x:auto;">
      <table class="ui celled table ydk-table" summary="강원도 지역 1톤 2.5톤 운송 요금표">
        <thead>
          <tr style="background:#f0f4f9; text-align:center;">
            <th style="width:14%;">지 역</th>
            <th style="width:18%;">1 t 용달</th>
            <th style="width:18%;">2.5 t 트럭</th>
            <th style="width:14%;">지 역</th>
            <th style="width:18%;">1 t 용달</th>
            <th style="width:18%;">2.5 t 트럭</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ratesGangwon as $row): ?>
            <tr style="text-align:center;">
              <td style="font-weight:700; background:#fafbfd;"><?= e($row['area1']) ?></td>
              <td style="color:#1b365d; font-weight:600;"><?= e($row['t1_1']) ?></td>
              <td style="color:#555;"><?= e($row['t25_1']) ?></td>
              <td style="font-weight:700; background:#fafbfd;"><?= e($row['area2']) ?></td>
              <td style="color:#1b365d; font-weight:600;"><?= e($row['t1_2']) ?></td>
              <td style="color:#555;"><?= e($row['t25_2']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- 6. 3구역: 충청도 지역 요금표 -->
  <section id="sec-chungcheong" class="ydk-rate-section" aria-label="충청도 지역 운송 요금표" style="margin-bottom:44px;">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="compass icon"></i> 충청도 지역</h2>
      <span class="ydk-section-sub">출발지: 서울 시청 기준 (단위: 원, 일반 카고 기준)</span>
    </div>

    <div class="ydk-table-wrap" style="overflow-x:auto;">
      <table class="ui celled table ydk-table" summary="충청도 지역 1톤 2.5톤 운송 요금표">
        <thead>
          <tr style="background:#f0f4f9; text-align:center;">
            <th style="width:14%;">지 역</th>
            <th style="width:18%;">1 t 용달</th>
            <th style="width:18%;">2.5 t 트럭</th>
            <th style="width:14%;">지 역</th>
            <th style="width:18%;">1 t 용달</th>
            <th style="width:18%;">2.5 t 트럭</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ratesChungcheong as $row): ?>
            <tr style="text-align:center;">
              <td style="font-weight:700; background:#fafbfd;"><?= e($row['area1']) ?></td>
              <td style="color:#1b365d; font-weight:600;"><?= e($row['t1_1']) ?></td>
              <td style="color:#555;"><?= e($row['t25_1']) ?></td>
              <td style="font-weight:700; background:#fafbfd;"><?= e($row['area2']) ?></td>
              <td style="color:#1b365d; font-weight:600;"><?= e($row['t1_2']) ?></td>
              <td style="color:#555;"><?= e($row['t25_2']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- 7. 4구역: 전라도 및 경상도 지역 요금표 -->
  <section id="sec-south" class="ydk-rate-section" aria-label="전라도 및 경상도 지역 운송 요금표" style="margin-bottom:44px;">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="road icon"></i> 전라도 및 경상도 지역</h2>
      <span class="ydk-section-sub">출발지: 서울 시청 기준 (단위: 원, 일반 카고 기준)</span>
    </div>

    <div class="ydk-table-wrap" style="overflow-x:auto;">
      <table class="ui celled table ydk-table" summary="전라도 및 경상도 지역 1톤 2.5톤 운송 요금표">
        <thead>
          <tr style="background:#f0f4f9; text-align:center;">
            <th style="width:14%;">지 역</th>
            <th style="width:18%;">1 t 용달</th>
            <th style="width:18%;">2.5 t 트럭</th>
            <th style="width:14%;">지 역</th>
            <th style="width:18%;">1 t 용달</th>
            <th style="width:18%;">2.5 t 트럭</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ratesSouth as $row): ?>
            <tr style="text-align:center;">
              <td style="font-weight:700; background:#fafbfd;"><?= e($row['area1']) ?></td>
              <td style="color:#1b365d; font-weight:600;"><?= e($row['t1_1']) ?></td>
              <td style="color:#555;"><?= e($row['t25_1']) ?></td>
              <td style="font-weight:700; background:#fafbfd;"><?= e($row['area2']) ?></td>
              <td style="color:#1b365d; font-weight:600;"><?= e($row['t1_2']) ?></td>
              <td style="color:#555;"><?= e($row['t25_2']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- 8. 하단 즉시 상담 및 견적 안내 CTA 배너 -->
  <aside class="ydk-sub-cta" aria-label="운송 요금 상담 문의">
    <div class="ydk-sub-cta-text">
      <h3><i class="phone volume icon"></i> 정확한 실시간 운송 요금이 궁금하신가요?</h3>
      <p>물동량, 경유지, 상·하차 작업 조건에 따라 가장 합리적인 직거래 최적 운임을 즉시 안내해 드립니다.</p>
    </div>
    <div class="ydk-sub-cta-actions">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge button ydk-btn-call">
        <i class="phone icon"></i> 전화 견적 상담 (<?= SITE_PHONE ?>)
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge inverted button">
        <i class="edit outline icon"></i> 온라인 견적 문의
      </a>
    </div>
  </aside>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
?>
