<?php
/**
 * 용달코리아 v2-1 지점 라우터 및 전체 지점 안내 (PHP 7.4.33)
 * 대상 경로: /v2/contents/company/jijum/index.php
 */

require_once __DIR__ . '/../../../includes/config.php';
require_once __DIR__ . '/../../../includes/functions.php';
require_once __DIR__ . '/jijum_helper.php';

$code = trim($_GET['code'] ?? '');

// code 파라미터가 있는 경우 바로 detail.php를 포함하여 렌더링
if ($code !== '') {
    require __DIR__ . '/detail.php';
    exit;
}

// code 파라미터가 없는 경우 전체 지점 안내 목록 표시
$pageTitle = '전국 지점 상세 안내 | ' . SITE_NAME;
$pageDescription = '용달코리아 전국 화물 네트워크 등록 지점 목록 및 상세 직통 전화 안내.';
$allJijum = get_all_jijum_list();

require_once __DIR__ . '/../../../includes/header.php';
?>

<main class="ydk-container ydk-main" style="padding-top: 24px; padding-bottom: 60px;">

  <!-- 서브페이지 헤더 -->
  <header class="ydk-sub-header" style="margin-bottom: 24px;">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로" style="font-size: 14px; color: var(--ydk-muted); margin-bottom: 10px;">
      <a href="<?= url() ?>" style="color: var(--ydk-muted);"><i class="home icon"></i>홈</a>
      <span class="divider" style="margin: 0 8px;">/</span>
      <a href="<?= url('contents/company/company_list.php') ?>" style="color: var(--ydk-muted);">지역별 업체 리스트</a>
      <span class="divider" style="margin: 0 8px;">/</span>
      <span class="active" style="color: var(--ydk-primary); font-weight: 700;">전국 등록 지점 목록</span>
    </nav>
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 12px; border-bottom: 2px solid var(--ydk-primary); padding-bottom: 14px;">
      <div>
        <h1 style="font-size: 26px; font-weight: 800; color: var(--ydk-primary); margin: 0 0 6px 0; line-height: 1.3;">
          용달코리아 전국 등록 지점 안내
        </h1>
        <p style="font-size: 15px; color: var(--ydk-muted); margin: 0;">
          전국 화물·용달 네트워크에 등록된 지점별 상세 프로필 및 직통 상담 안내입니다.
        </p>
      </div>
      <div>
        <a href="<?= url('contents/company/company_list.php') ?>" class="ui primary button" style="font-weight: 700;">
          <i class="map marker alternate icon"></i> 지역별로 보기
        </a>
      </div>
    </div>
  </header>

  <!-- 지점 목록 그리드 (3열 반응형) -->
  <section>
    <div class="ui three column stackable grid">
      <?php if (empty($allJijum)): ?>
        <div class="sixteen wide column">
          <div class="ui message info" style="text-align: center; padding: 30px;">
            <p style="font-size: 16px; margin: 0;">
              등록된 지점 상세 안내를 준비 중입니다. <a href="<?= url('contents/company/company_list.php') ?>">지역별 업체 리스트</a>를 확인해 주세요.
            </p>
          </div>
        </div>
      <?php else: ?>
        <?php foreach ($allJijum as $j): ?>
          <div class="column">
            <div class="ui fluid card" style="border-radius: 10px; border: 1px solid var(--ydk-border-light); height: 100%; box-shadow: 0 2px 6px rgba(0,0,0,0.04);">
              <div class="content" style="padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                  <span class="ui blue mini label" style="font-weight: 700;"><?= e($j['car']) ?></span>
                  <span style="font-size: 11px; color: var(--ydk-muted); font-family: monospace;"><?= e($j['code']) ?></span>
                </div>
                <h3 style="font-size: 18px; font-weight: 800; color: #1E293B; margin: 0 0 8px 0;">
                  <a href="<?= url('contents/company/jijum/detail.php?code=' . e($j['code'])) ?>" style="color: inherit; text-decoration: none;">
                    <?= e($j['name']) ?>
                  </a>
                </h3>
                <div style="font-size: 13px; color: var(--ydk-muted); margin-bottom: 12px;">
                  <i class="user outline icon"></i> <?= e($j['owner'] ?: '전문 차주') ?>
                </div>
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 10px; text-align: center; margin-bottom: 12px;">
                  <a href="tel:<?= e($j['tel_clean']) ?>" style="font-size: 17px; font-weight: 900; color: #2563EB; text-decoration: none;">
                    <i class="phone icon"></i> <?= e($j['tel']) ?>
                  </a>
                </div>
                <div style="display: flex; gap: 8px;">
                  <a href="tel:<?= e($j['tel_clean']) ?>" class="ui fluid primary button" style="font-weight: 700; font-size: 13px; padding: 10px;">
                    <i class="phone icon"></i> 전화걸기
                  </a>
                  <a href="<?= url('contents/company/jijum/detail.php?code=' . e($j['code'])) ?>" class="ui basic button" style="font-weight: 700; font-size: 13px; padding: 10px 14px;" title="지점 상세 프로필 보기">
                    상세보기
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>

</main>

<?php require_once __DIR__ . '/../../../includes/footer.php'; ?>
