<?php
/**
 * 용달코리아 v2-1 지점 상세 안내 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: /jijum/{code}.html 레거시 팝업 리뉴얼
 * 대상 경로: /v2/contents/company/jijum/detail.php
 */

require_once __DIR__ . '/../../../includes/config.php';
require_once __DIR__ . '/../../../includes/functions.php';
require_once __DIR__ . '/jijum_helper.php';

// 지점 코드 파라미터 수신
$code = trim($_GET['code'] ?? '');
$item = get_jijum_detail($code);

// 지역 목록 복귀용 ID
$areaId = trim($_GET['id'] ?? ($item['area_id'] ?? '07'));
if ($areaId === '') {
    $areaId = '07';
}

$pageTitle = ($item ? $item['name'] . ' 지점 상세 안내' : '지점 안내') . ' | ' . SITE_NAME;
$pageDescription = ($item ? $item['name'] . ' 직통 전화 ' . $item['tel'] . '. 원룸이사, 학생이사, 소형화물, 1톤 용달 안전 배차 직거래 연결.' : '용달코리아 전국 지점 상세 안내');

// 지점 상세 전용 맞춤형 모바일 듀얼 플로팅 바 (본사 콜센터 + 지점 직통 전화)
if ($item) {
    $customCallbarHtml = '
    <div class="ydk-callbar-dual">
      <a href="tel:' . SITE_PHONE_TEL . '" class="ydk-callbar-btn-sub" title="본사 통합 콜센터 상담">
        <i class="phone icon"></i>
        <span>본사 ' . SITE_PHONE . '</span>
      </a>
      <a href="tel:' . e($item['tel_clean']) . '" class="ydk-callbar-btn-main" title="' . e($item['name']) . ' 직통 전화걸기">
        <i class="phone volume icon"></i>
        <span class="ydk-callbar-text">
          <small>지점 직통 상담</small>
          <strong>' . e($item['tel']) . '</strong>
        </span>
      </a>
    </div>';
}

require_once __DIR__ . '/../../../includes/header.php';
?>

<main class="ydk-container ydk-main" style="padding-top: 24px; padding-bottom: 60px;">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header" style="margin-bottom: 24px;">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로" style="font-size: 14px; color: var(--ydk-muted); margin-bottom: 10px;">
      <a href="<?= url() ?>" style="color: var(--ydk-muted);"><i class="home icon"></i>홈</a>
      <span class="divider" style="margin: 0 8px;">/</span>
      <a href="<?= url('contents/company/company_list.php?id=' . e($areaId)) ?>" style="color: var(--ydk-muted);">지역별 업체 리스트</a>
      <span class="divider" style="margin: 0 8px;">/</span>
      <span class="active" style="color: var(--ydk-primary); font-weight: 700;">지점 상세 안내</span>
    </nav>
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 12px; border-bottom: 2px solid var(--ydk-primary); padding-bottom: 14px;">
      <div>
        <h1 style="font-size: 26px; font-weight: 800; color: var(--ydk-primary); margin: 0 0 6px 0; line-height: 1.3;">
          <?= $item ? e($item['name']) : '지점 정보 안내' ?>
        </h1>
        <p style="font-size: 15px; color: var(--ydk-muted); margin: 0;">
          용달코리아 전국 화물 네트워크 정식 등록 우수 운송 협력점입니다.
        </p>
      </div>
      <div>
        <a href="<?= url('contents/company/company_list.php?id=' . e($areaId)) ?>" class="ui basic button" style="font-weight: 700;">
          <i class="arrow left icon"></i> 업체 목록으로
        </a>
      </div>
    </div>
  </header>

  <?php if (!$item): ?>
    <!-- 지점 정보가 없을 경우 안내 메시지 -->
    <section class="ui negative message" style="padding: 30px; text-align: center; border-radius: 12px; margin: 30px 0;">
      <i class="exclamation triangle huge icon" style="margin-bottom: 16px; display: inline-block;"></i>
      <h2 style="font-size: 20px; font-weight: 800; margin-top: 0;">요청하신 지점 정보를 찾을 수 없습니다.</h2>
      <p style="font-size: 15px; color: #475569; max-width: 500px; margin: 0 auto 20px auto;">
        입력하신 지점 식별 코드(<?= e($code) ?>)가 존재하지 않거나 변경되었을 수 있습니다.<br>
        지역별 업체 목록에서 원하시는 지점을 다시 선택해 주세요.
      </p>
      <div style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
        <a href="<?= url('contents/company/company_list.php') ?>" class="ui primary button" style="font-weight: 700;">
          <i class="th list icon"></i> 지역별 업체 전체보기
        </a>
        <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button" style="background-color: var(--ydk-cta); color: #fff; font-weight: 700;">
          <i class="phone icon"></i> 대표 콜센터 <?= SITE_PHONE ?> 문의
        </a>
      </div>
    </section>
  <?php else: ?>

    <!-- 2. 지점 상세 프로필 카드 (반응형) -->
    <div class="ui stackable grid" style="margin-top: 0;">
      
      <!-- 좌측 메인 상세 영역 (10 컬럼) -->
      <div class="eleven wide column">
        
        <!-- 기본 정보 세그먼트 -->
        <article class="ui segment" style="border-radius: 12px; border: 1px solid var(--ydk-border-light); box-shadow: 0 4px 14px rgba(0,0,0,0.05); padding: 28px 24px; margin-bottom: 24px;">
          
          <!-- 상단 뱃지 & 지점명 -->
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; flex-wrap: wrap; gap: 10px;">
            <div style="display: flex; align-items: center; gap: 8px;">
              <span class="ui blue label" style="font-size: 13px; font-weight: 700; margin: 0;">
                <i class="truck icon"></i> <?= e($item['car']) ?>
              </span>
              <span class="ui green label" style="font-size: 13px; font-weight: 700; margin: 0;">
                <i class="check circle icon"></i> 즉시 배차 가능
              </span>
            </div>
            <span style="font-size: 13px; color: var(--ydk-muted); font-family: monospace;">
              지점 코드: <strong><?= e($item['code']) ?></strong>
            </span>
          </div>

          <h2 style="font-size: 24px; font-weight: 900; color: #1E293B; margin: 0 0 16px 0; border-bottom: 1px dashed #E2E8F0; padding-bottom: 12px;">
            <?= e($item['name']) ?>
          </h2>

          <!-- 지점 제원 정보 테이블 -->
          <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 18px; margin-bottom: 24px;">
            <div class="ui two column stackable grid" style="margin: 0;">
              
              <div class="column" style="padding: 8px 12px; display: flex; align-items: center;">
                <div style="width: 90px; font-size: 14px; font-weight: 700; color: var(--ydk-muted);">
                  <i class="user outline icon"></i> 대표자 성명
                </div>
                <div style="font-size: 16px; font-weight: 800; color: #1E293B;">
                  <?= e($item['owner'] ?: '전문 차주 직영') ?>
                </div>
              </div>

              <div class="column" style="padding: 8px 12px; display: flex; align-items: center;">
                <div style="width: 90px; font-size: 14px; font-weight: 700; color: var(--ydk-muted);">
                  <i class="truck icon"></i> 보유 차량
                </div>
                <div style="font-size: 16px; font-weight: 800; color: #2563EB;">
                  <?= e($item['car']) ?>
                </div>
              </div>

              <div class="column" style="padding: 8px 12px; display: flex; align-items: center;">
                <div style="width: 90px; font-size: 14px; font-weight: 700; color: var(--ydk-muted);">
                  <i class="map marker alternate icon"></i> 관할 구역
                </div>
                <div style="font-size: 15px; font-weight: 700; color: #334155;">
                  수도권 및 전국 연계 운송
                </div>
              </div>

              <div class="column" style="padding: 8px 12px; display: flex; align-items: center;">
                <div style="width: 90px; font-size: 14px; font-weight: 700; color: var(--ydk-muted);">
                  <i class="shield alternate icon"></i> 인증 현황
                </div>
                <div style="font-size: 14px; font-weight: 700; color: #059669;">
                  용달코리아 관허 정식 등록
                </div>
              </div>

            </div>
          </div>

          <!-- 직통 상담 전화 강조 박스 (원클릭 전화걸기) -->
          <div style="background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%); border: 2px solid #93C5FD; border-radius: 12px; padding: 22px 20px; text-align: center; margin-bottom: 24px;">
            <div style="font-size: 13px; font-weight: 800; color: #1E40AF; letter-spacing: 0.5px; margin-bottom: 4px;">
              [지점 직통 상담 및 예약 번호]
            </div>
            <div style="font-size: 28px; font-weight: 900; color: #1D4ED8; letter-spacing: 0.5px; margin-bottom: 12px;">
              <a href="tel:<?= e($item['tel_clean']) ?>" style="color: inherit; text-decoration: none;">
                <i class="phone volume icon"></i> <?= e($item['tel']) ?>
              </a>
            </div>
            <div style="font-size: 13px; color: #475569; margin-bottom: 14px;">
              스마트폰에서 아래 버튼을 터치하시면 담당 차주와 즉시 직접 연결됩니다.
            </div>
            <a href="tel:<?= e($item['tel_clean']) ?>" class="ui huge fluid primary button" style="font-weight: 800; font-size: 18px; padding: 16px; border-radius: 8px; box-shadow: 0 4px 10px rgba(37,99,235,0.25);">
              <i class="phone icon"></i> 바로 전화걸기 (직통 연결)
            </a>
          </div>

          <!-- 서비스 상세 안내 블록 -->
          <div style="margin-bottom: 20px;">
            <h3 style="font-size: 17px; font-weight: 800; color: #1E293B; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
              <i class="clipboard list icon" style="color: var(--ydk-primary);"></i> 운송 및 이사 서비스 안내
            </h3>
            <div style="background-color: var(--ydk-box-bg); border-left: 4px solid var(--ydk-primary); border-radius: 0 8px 8px 0; padding: 18px 20px; line-height: 1.8; font-size: 15px; color: #1E293B;">
              <?php if (!empty($item['story_lines'])): ?>
                <ul style="margin: 0; padding-left: 20px;">
                  <?php foreach ($item['story_lines'] as $line): ?>
                    <li style="margin-bottom: 6px;"><?= e(ltrim($line, '•- ')) ?></li>
                  <?php endforeach; ?>
                </ul>
              <?php else: ?>
                <p style="margin: 0;"><?= nl2br(e($item['story'])) ?></p>
              <?php endif; ?>
            </div>
          </div>

          <!-- 주요 취급 업무 아이콘 그리드 -->
          <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #E2E8F0;">
            <div style="font-size: 14px; font-weight: 800; color: #475569; margin-bottom: 12px;">
              주요 취급 업무
            </div>
            <div class="ui four column stackable grid" style="text-align: center;">
              <div class="column" style="padding: 10px 6px;">
                <div style="background: #FFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 6px;">
                  <i class="box large icon" style="color: #2563EB; margin-bottom: 6px;"></i>
                  <div style="font-size: 13px; font-weight: 700; color: #1E293B;">소형 일반화물</div>
                </div>
              </div>
              <div class="column" style="padding: 10px 6px;">
                <div style="background: #FFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 6px;">
                  <i class="home large icon" style="color: #059669; margin-bottom: 6px;"></i>
                  <div style="font-size: 13px; font-weight: 700; color: #1E293B;">원룸 / 오피스텔</div>
                </div>
              </div>
              <div class="column" style="padding: 10px 6px;">
                <div style="background: #FFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 6px;">
                  <i class="graduation cap large icon" style="color: #D97706; margin-bottom: 6px;"></i>
                  <div style="font-size: 13px; font-weight: 700; color: #1E293B;">학생 / 고시원이사</div>
                </div>
              </div>
              <div class="column" style="padding: 10px 6px;">
                <div style="background: #FFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px 6px;">
                  <i class="shipping fast large icon" style="color: #7C3AED; margin-bottom: 6px;"></i>
                  <div style="font-size: 13px; font-weight: 700; color: #1E293B;">지방 당일 연계</div>
                </div>
              </div>
            </div>
          </div>

        </article>

      </div>

      <!-- 우측 보조 사이드바 영역 (5 컬럼) -->
      <aside class="five wide column">

        <!-- 1. 본사 안심 콜센터 안내 카드 -->
        <div class="ui segment" style="border-radius: 12px; border: 1px solid #FED7AA; background: #FFF7ED; padding: 22px; margin-bottom: 20px; text-align: center;">
          <div class="ui orange tiny label" style="font-weight: 800; margin-bottom: 10px;">
            통합 배차 지원
          </div>
          <h3 style="font-size: 17px; font-weight: 800; color: #9A3412; margin: 0 0 6px 0;">
            원하는 일정·차량이 없으신가요?
          </h3>
          <p style="font-size: 13px; color: #7C2D12; line-height: 1.5; margin-bottom: 14px;">
            본사 콜센터로 문의하시면 전국 화물망을 통해 최적의 차량을 즉시 안내해 드립니다.
          </p>
          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui fluid button" style="background-color: var(--ydk-cta); color: #FFF; font-weight: 800; font-size: 16px; padding: 14px; border-radius: 8px;">
            <i class="phone icon"></i> 대표번호 <?= SITE_PHONE ?>
          </a>
        </div>

        <!-- 2. 신뢰 보증 및 안내 카드 -->
        <div class="ui segment" style="border-radius: 12px; border: 1px solid var(--ydk-border-light); padding: 20px; margin-bottom: 20px; font-size: 13px; color: var(--ydk-muted);">
          <h4 style="font-size: 15px; font-weight: 800; color: #1E293B; margin-top: 0; margin-bottom: 10px;">
            <i class="info circle icon" style="color: var(--ydk-primary);"></i> 이용 전 확인사항
          </h4>
          <ul style="margin: 0; padding-left: 18px; line-height: 1.6;">
            <li style="margin-bottom: 6px;">화물 규격(가로, 세로, 높이, 무게)을 미리 말씀해 주시면 더욱 정확한 견적이 가능합니다.</li>
            <li style="margin-bottom: 6px;">계단 작업, 사다리차 지원, 기사 도움 여부는 상담 시 미리 협의해 주세요.</li>
            <li>용달코리아는 정식 화물자동차 운송주선사업 관허[제4-42호] 등록 업체입니다.</li>
          </ul>
        </div>

        <!-- 3. 빠른 바로가기 링크 버튼군 -->
        <div style="display: flex; flex-direction: column; gap: 8px;">
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui basic fluid button" style="font-weight: 700; padding: 12px; text-align: left;">
            <i class="edit outline icon" style="color: var(--ydk-primary);"></i> 온라인 무료 견적 신청
          </a>
          <a href="<?= url('contents/trt/trt.php') ?>" class="ui basic fluid button" style="font-weight: 700; padding: 12px; text-align: left;">
            <i class="calculator icon" style="color: var(--ydk-primary);"></i> 운송 요금표 확인하기
          </a>
          <a href="<?= url('contents/company/company_list.php?id=' . e($areaId)) ?>" class="ui fluid secondary button" style="font-weight: 700; padding: 12px;">
            <i class="list icon"></i> 다른 지역 지점 찾기
          </a>
        </div>

      </aside>

    </div>

  <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../../../includes/footer.php'; ?>
