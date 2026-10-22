<?php
/**
 * 용달코리아 v2-1 차량 규격 안내 페이지 (PHP 7.4.33, 반응형 웹)
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '차량 규격 안내 | ' . SITE_NAME . ' (1688-2404)';
$pageDescription = '용달코리아 전국 화물 차량 적재함 규격표. 1톤 용달, 1.4톤, 2.5톤, 3.5톤, 5톤, 11톤, 18톤 대형 화물 및 1톤~5톤 탑차 적재함 길이, 넓이, 높이 상세 치수를 안내해 드립니다.';

// 차량 규격 데이터 정의
$truckSizes = [
    // 일반 카고 트럭
    [
        'category' => '소·중형 화물',
        'name' => '1 톤 (용달)',
        'length' => '2,850',
        'width' => '1,600',
        'height' => '355',
        'payload' => '약 1.0 ~ 1.2톤',
        'pallet' => '2개',
        'desc' => '원룸이사, 학생이사, 소형 가전·가구 및 일반 소화물에 가장 대중적인 대표 용달차'
    ],
    [
        'category' => '소·중형 화물',
        'name' => '1.3 톤',
        'length' => '3,100',
        'width' => '1,650',
        'height' => '355',
        'payload' => '약 1.3 ~ 1.5톤',
        'pallet' => '2개',
        'desc' => '1톤보다 짐이 조금 더 많거나 길이가 긴 화물 운송에 경제적인 차량'
    ],
    [
        'category' => '소·중형 화물',
        'name' => '1.4 톤',
        'length' => '3,100',
        'width' => '1,650',
        'height' => '360',
        'payload' => '약 1.4 ~ 1.8톤',
        'pallet' => '2개',
        'desc' => '적재함 보강으로 중량감 있는 공업용 화물 및 투룸 이사에 적합'
    ],
    [
        'category' => '소·중형 화물',
        'name' => '2.5 톤',
        'length' => '4,300',
        'width' => '1,850',
        'height' => '380',
        'payload' => '약 2.5 ~ 3.0톤',
        'pallet' => '3개',
        'desc' => '일반 가정집 이사, 사무실 이전, 기업 납품 물류에 가장 널리 쓰이는 만능 트럭'
    ],
    [
        'category' => '소·중형 화물',
        'name' => '3.5 톤',
        'length' => '4,880',
        'width' => '2,050',
        'height' => '355',
        'payload' => '약 3.5 ~ 4.5톤',
        'pallet' => '표준 4~6개',
        'desc' => '2.5톤 대비 넓은 폭과 여유 있는 길이로 부피가 큰 화물 운송에 유리'
    ],
    // 대형 화물
    [
        'category' => '대형 화물',
        'name' => '5 톤 (단축/일반)',
        'length' => '6,200',
        'width' => '2,270',
        'height' => '400',
        'payload' => '약 5.0 ~ 6.5톤',
        'pallet' => '표준 10개 적재',
        'desc' => '대량 파레트 화물, 건축 자재, 기계 장비 및 대형 이삿짐 전국 운송'
    ],
    [
        'category' => '대형 화물',
        'name' => '5 톤 축 플러스 (장축)',
        'length' => '7,300 ~ 8,300',
        'width' => '2,310 ~ 2,350',
        'height' => '400',
        'payload' => '약 7.0 ~ 9.0톤',
        'pallet' => '표준 12~14개',
        'desc' => '가변축 장착으로 최대 8m 이상 길이의 화물 및 대용량 공장 물류 최적'
    ],
    [
        'category' => '대형 화물',
        'name' => '11 톤',
        'length' => '9,100',
        'width' => '2,340',
        'height' => '500',
        'payload' => '약 11 ~ 13톤',
        'pallet' => '14개',
        'desc' => '전국 장거리 간선 운송, 대량 벌크 화물 및 대형 플랜트 장비 운송'
    ],
    [
        'category' => '대형 화물',
        'name' => '18 톤',
        'length' => '10,000',
        'width' => '2,340',
        'height' => '500',
        'payload' => '약 18 ~ 20톤',
        'pallet' => '16개',
        'desc' => '초대형 중량 화물 및 항만·컨테이너 연계 장거리 대량 운송'
    ],
    // 탑차 규격
    [
        'category' => '탑차 (비·눈 안심)',
        'name' => '1 톤 탑차',
        'length' => '2,850',
        'width' => '1,600',
        'height' => '1,450 ~ 1,700 (탑내경)',
        'payload' => '약 1.0톤',
        'pallet' => '2개',
        'desc' => '우천·폭설 시에도 안전하며 의류, 전자제품, 박스 포장 화물에 최적'
    ],
    [
        'category' => '탑차 (비·눈 안심)',
        'name' => '2.5 톤 탑차',
        'length' => '4,300',
        'width' => '1,850',
        'height' => '2,200 ~ 2,300 (탑내경)',
        'payload' => '약 2.5톤',
        'pallet' => '3개',
        'desc' => '가구, 정밀기기, 식품 유통 및 깔끔한 포장 이사에 적합'
    ],
    [
        'category' => '탑차 (비·눈 안심)',
        'name' => '5 톤 탑차 (윙탑)',
        'length' => '6,200',
        'width' => '2,270',
        'height' => '2,300 (탑내경)',
        'payload' => '약 5.0톤',
        'pallet' => '표준 10개',
        'desc' => '양쪽 날개가 열려 지게차 상·하차가 매우 신속한 대표적인 기업 물류 차량'
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
      <span class="active">차량 규격</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="truck icon"></i> 차량 적재함 규격 안내
    </h1>
    <p class="ydk-page-desc">
      고객님의 화물 크기와 부피에 딱 맞는 최적의 차량을 선택하실 수 있도록 차종별 적재함 상세 규격을 안내해 드립니다.
    </p>
  </header>

  <!-- 2. 차량 선택 가이드 및 단위 안내 박스 -->
  <section class="ydk-size-notice" aria-label="규격 단위 및 확인사항" style="background:var(--ydk-box-bg); border:1px solid var(--ydk-border-light); border-left:6px solid var(--ydk-primary); border-radius:10px; padding:24px 20px; margin-bottom:36px;">
    <h2 style="font-size:19px; font-weight:800; color:var(--ydk-primary); margin:0 0 12px 0; display:flex; align-items:center; gap:8px;">
      <i class="info circle icon"></i> 적재함 규격 확인 전 꼭 읽어보세요
    </h2>
    <ul style="margin:0; padding-left:22px; font-size:15px; line-height:1.8; color:var(--ydk-text);">
      <li><strong>치수 단위 안내:</strong> 본 표의 모든 적재함 수치는 <strong>mm (밀리미터)</strong> 기준입니다. (예: 2,850mm = 2.85m)</li>
      <li><strong>차량별 미세 차이:</strong> 차량 제조사(현대, 기아, 타타대우 등) 및 연식, 특장 개조 상태에 따라 <strong>약간의 오차(±50~100mm)</strong>가 있을 수 있습니다.</li>
      <li><strong>탑차 내경 높이:</strong> 탑차(윙탑)의 높이는 지면이 아닌 <strong>적재함 바닥에서 천장까지의 실내 순수 높이(내경)</strong>입니다. 지하주차장 진입 가능 여부 확인 시 유의해 주세요.</li>
      <li><strong>정밀 적재 상담:</strong> 기계, 배관, 가구 등 적재함 폭이나 길이에 딱 맞는 화물은 <strong>1688-2404</strong>로 미리 정확한 치수를 말씀해 주시면 맞춤 배차를 지원합니다.</li>
    </ul>
    <div style="margin-top:16px; padding-top:12px; border-top:1px dashed var(--ydk-border-light); display:flex; flex-wrap:wrap; justify-content:space-between; align-items:center; gap:12px;">
      <span style="font-size:15px; color:var(--ydk-muted);">
        <i class="phone icon"></i> 어떤 차를 불러야 할지 고민되시나요? <strong>1688-2404 / 1688-2407</strong>로 화물 종류를 알려주시면 바로 추천해 드립니다.
      </span>
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button" style="background:var(--ydk-cta); color:#fff; font-size:15px; font-weight:700; padding:10px 18px; border-radius:6px;">
        <i class="phone icon"></i> 차종 추천 및 견적 문의
      </a>
    </div>
  </section>

  <!-- 3. 차량 적재함 상세 규격표 -->
  <section class="ydk-size-table-section" aria-label="차량 적재함 규격 상세 표" style="margin-bottom:44px;">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="ruler combined icon"></i> 차종별 적재함 제원표 (단위 : mm)</h2>
      <span class="ydk-section-sub">1톤 소형 용달부터 18톤 대형 화물 및 특수 탑차까지 한눈에 비교해 보세요.</span>
    </div>

    <div class="ydk-table-wrap" style="overflow-x:auto;">
      <table class="ui celled structured table ydk-table" summary="화물차 적재함 규격 길이 넓이 높이 표">
        <thead>
          <tr style="background:#f0f4f9; text-align:center;">
            <th style="width:16%;">적재 정량 (차종)</th>
            <th style="width:14%;">적재함 길이<br><span style="font-size:13px; font-weight:normal; color:#666;">(mm)</span></th>
            <th style="width:14%;">적재함 넓이<br><span style="font-size:13px; font-weight:normal; color:#666;">(mm)</span></th>
            <th style="width:16%;">적재함 높이<br><span style="font-size:13px; font-weight:normal; color:#666;">(mm / 난간·탑내경)</span></th>
            <th style="width:14%;">표준 파레트<br><span style="font-size:13px; font-weight:normal; color:#666;">(1100×1200)</span></th>
            <th style="width:26%;">주요 용도 및 추천 화물</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $currentCat = '';
          foreach ($truckSizes as $truck): 
            if ($currentCat !== $truck['category']):
              $currentCat = $truck['category'];
          ?>
            <tr style="background:#eaf2fb;">
              <td colspan="6" style="font-weight:800; color:var(--ydk-primary); padding:10px 16px;">
                <i class="tag icon"></i> <?= e($currentCat) ?>
              </td>
            </tr>
          <?php endif; ?>
            <tr style="text-align:center;">
              <td style="font-weight:700; background:#fafbfd; text-align:left; padding-left:18px;">
                <strong><?= e($truck['name']) ?></strong>
              </td>
              <td style="color:#1b365d; font-weight:600; font-size:16px;"><?= e($truck['length']) ?></td>
              <td style="color:#1b365d; font-weight:600; font-size:16px;"><?= e($truck['width']) ?></td>
              <td style="color:#555;"><?= e($truck['height']) ?></td>
              <td style="color:#c8440c; font-weight:700; font-size:14px;"><?= e($truck['pallet']) ?></td>
              <td style="text-align:left; font-size:14px; line-height:1.5; color:#444;"><?= e($truck['desc']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- 4. 자주 쓰이는 핵심 차종 3종 비교 카드 -->
  <section class="ydk-core-trucks" aria-label="대표 추천 차종" style="margin-bottom:44px;">
    <div class="ydk-section-header">
      <h2 class="ydk-section-title"><i class="star outline icon"></i> 가장 많이 찾는 대표 차종 가이드</h2>
      <span class="ydk-section-sub">어떤 차를 불러야 할지 고민될 때 가장 먼저 확인하는 3대 차종입니다.</span>
    </div>

    <div class="ui three column stackable grid" style="margin-top:12px;">
      <!-- 1톤 용달 -->
      <div class="column">
        <div class="ydk-value-card" style="height:100%; display:flex; flex-direction:column; justify-content:space-between; text-align:left;">
          <div>
            <div style="display:inline-block; background:#1b365d; color:#fff; font-size:13px; font-weight:700; padding:4px 10px; border-radius:4px; margin-bottom:12px;">
              원룸이사 / 소화물 대표
            </div>
            <h3 style="font-size:22px; font-weight:800; margin:0 0 8px 0; color:#1b365d;">1톤 용달 트럭</h3>
            <p style="font-size:15px; color:#555; line-height:1.6; margin-bottom:14px;">
              골목길 진입이 쉽고 기동성이 탁월합니다. 침대, 냉장고, 세탁기 등 단품 가전·가구 운송 및 원룸·학생 이사에 가장 경제적입니다.
            </p>
            <div style="background:#f7f9fc; padding:12px; border-radius:8px; font-size:14px; line-height:1.7;">
              <div><strong>길이 × 넓이:</strong> 2.85m × 1.6m</div>
              <div><strong>적재 중량:</strong> 약 1.1톤 이내</div>
              <div><strong>추천:</strong> 박스짐 20~30개, 가전·가구 소형 운송</div>
            </div>
          </div>
          <div style="margin-top:18px;">
            <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui fluid button" style="background:#1b365d; color:#fff; font-weight:700;">
              <i class="phone icon"></i> 1톤 용달 상담
            </a>
          </div>
        </div>
      </div>

      <!-- 2.5톤 트럭 -->
      <div class="column">
        <div class="ydk-value-card" style="height:100%; display:flex; flex-direction:column; justify-content:space-between; text-align:left;">
          <div>
            <div style="display:inline-block; background:#c8440c; color:#fff; font-size:13px; font-weight:700; padding:4px 10px; border-radius:4px; margin-bottom:12px;">
              가정·사무실 이사 만능
            </div>
            <h3 style="font-size:22px; font-weight:800; margin:0 0 8px 0; color:#1b365d;">2.5톤 화물 트럭</h3>
            <p style="font-size:15px; color:#555; line-height:1.6; margin-bottom:14px;">
              투룸, 소형 아파트(20평형 안팎) 가정집 이사와 중소기업 완제품 납품 물류에 가장 많이 쓰이는 표준 규격 트럭입니다.
            </p>
            <div style="background:#f7f9fc; padding:12px; border-radius:8px; font-size:14px; line-height:1.7;">
              <div><strong>길이 × 넓이:</strong> 4.3m × 1.85m</div>
              <div><strong>적재 중량:</strong> 약 2.5 ~ 3.0톤</div>
              <div><strong>추천:</strong> 투룸 이삿짐, 표준 파레트 3장</div>
            </div>
          </div>
          <div style="margin-top:18px;">
            <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui fluid button" style="background:#c8440c; color:#fff; font-weight:700;">
              <i class="phone icon"></i> 2.5톤 배차 문의
            </a>
          </div>
        </div>
      </div>

      <!-- 5톤 윙탑 / 탑차 -->
      <div class="column">
        <div class="ydk-value-card" style="height:100%; display:flex; flex-direction:column; justify-content:space-between; text-align:left;">
          <div>
            <div style="display:inline-block; background:#206a9d; color:#fff; font-size:13px; font-weight:700; padding:4px 10px; border-radius:4px; margin-bottom:12px;">
              기업 물류 / 대량 화물
            </div>
            <h3 style="font-size:22px; font-weight:800; margin:0 0 8px 0; color:#1b365d;">5톤 탑차 / 윙탑</h3>
            <p style="font-size:15px; color:#555; line-height:1.6; margin-bottom:14px;">
              양쪽 날개가 활짝 열려 지게차로 신속한 상하차가 가능하며, 날씨에 구애받지 않고 고가 제품이나 대량 파레트를 안전하게 운송합니다.
            </p>
            <div style="background:#f7f9fc; padding:12px; border-radius:8px; font-size:14px; line-height:1.7;">
              <div><strong>길이 × 넓이:</strong> 6.2m ~ 8.3m × 2.3m</div>
              <div><strong>실내 높이:</strong> 2.3m (내경)</div>
              <div><strong>추천:</strong> 파레트 10~14장, 기업 물류</div>
            </div>
          </div>
          <div style="margin-top:18px;">
            <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui fluid button" style="background:#206a9d; color:#fff; font-weight:700;">
              <i class="phone icon"></i> 5톤 윙탑 상담
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. 하단 전화 상담 및 온라인 견적 문의 CTA -->
  <aside class="ydk-sub-cta" aria-label="차량 배차 상담 안내">
    <div class="ydk-sub-cta-text">
      <h3><i class="phone volume icon"></i> 실물 화물 크기가 규격에 맞는지 애매하신가요?</h3>
      <p>대표번호 <strong><?= SITE_PHONE ?></strong> 또는 <strong>1688-2407</strong>로 전화 주시면 전문 배차원이 가장 적합하고 저렴한 차량을 찾아드립니다.</p>
    </div>
    <div class="ydk-sub-cta-actions">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge button ydk-btn-call">
        <i class="phone icon"></i> 전화 차종 상담 (<?= SITE_PHONE ?>)
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
