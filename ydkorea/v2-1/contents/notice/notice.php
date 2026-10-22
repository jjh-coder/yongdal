<?php
/**
 * 용달코리아 v2-1 공지사항 목록 페이지
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반, 반응형 웹
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../admin/includes/db.php';

$pageTitle = '공지사항 | ' . SITE_NAME . ' (1688-2404)';
$metaDescription = '용달코리아의 주요 공지사항, 배차 안내, 부정클릭 주의 안내, 서비스 개편 소식을 전해드립니다.';

// 검색 파라미터
$keyword = trim($_GET['kw'] ?? '');
$page = max(1, (int)($_GET['p'] ?? 1));
$perPage = 10;

// 데이터 조회
$allList = get_notice_list($keyword);
$totalRows = count($allList);
$totalPages = max(1, (int)ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$pagedList = array_slice($allList, $offset, $perPage);

// 10페이지 단위 블록 페이징 계산
$pageBlock = 10;
$startPage = (int)(floor(($page - 1) / $pageBlock) * $pageBlock) + 1;
$endPage = min($totalPages, $startPage + $pageBlock - 1);

$makePageUrl = function($p) use ($keyword) {
    $q = ['p' => $p];
    if ($keyword !== '') $q['kw'] = $keyword;
    return url('contents/notice/notice.php?' . http_build_query($q));
};

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">공지사항</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="bullhorn icon"></i> 공지사항
    </h1>
    <p class="ydk-page-desc">
      용달코리아의 최신 서비스 소식, 운임 기준, 배차 관련 주요 안내 사항을 확인하실 수 있습니다.
    </p>
  </header>

  <!-- 2. 상단 검색 바 -->
  <section class="ui segment" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 14px 18px; margin-bottom: 20px;">
    <form method="get" action="<?= url('contents/notice/notice.php') ?>" style="display: flex; gap: 8px; align-items: center; justify-content: space-between; flex-wrap: wrap;">
      <div style="font-size: 14px; color: var(--ydk-muted); font-weight: 500;">
        총 <strong style="color: var(--ydk-primary);"><?= number_format($totalRows) ?></strong>건의 공지사항
      </div>
      <div class="ui action input" style="max-width: 380px; width: 100%;">
        <input type="text" name="kw" placeholder="제목, 내용 또는 작성자 검색..." value="<?= e($keyword) ?>">
        <button type="submit" class="ui primary button">검색</button>
        <?php if ($keyword !== ''): ?>
          <a href="<?= url('contents/notice/notice.php') ?>" class="ui basic button">초기화</a>
        <?php endif; ?>
      </div>
    </form>
  </section>

  <!-- 3. 공지사항 테이블 -->
  <?php if (empty($pagedList)): ?>
    <div class="ui placeholder segment" style="padding: 50px 20px; text-align: center;">
      <div class="ui icon header" style="color: var(--ydk-muted);">
        <i class="inbox icon"></i>
        <?php if ($keyword !== ''): ?>
          '<?= e($keyword) ?>' 검색 결과와 일치하는 공지사항이 없습니다.
        <?php else: ?>
          등록된 공지사항이 없습니다.
        <?php endif; ?>
      </div>
      <?php if ($keyword !== ''): ?>
        <div style="margin-top: 10px;">
          <a href="<?= url('contents/notice/notice.php') ?>" class="ui basic button">전체 목록 보기</a>
        </div>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <div style="overflow-x: auto; background: #FFF; border-radius: 10px; border: 1px solid #E2E8F0; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
      <table class="ui celled table unstackable selectable" style="margin: 0; border: none; font-size: 14px;">
        <thead>
          <tr style="background: #F8FAFC;">
            <th style="width: 75px; text-align: center;">번호</th>
            <th>제목</th>
            <th style="width: 110px; text-align: center;">작성자</th>
            <th style="width: 120px; text-align: center;">작성일</th>
            <th style="width: 80px; text-align: center;">조회</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pagedList as $row): 
            $isPinned = !empty($row['is_pinned']);
            $nId = (int)$row['id'];
            $viewUrl = url('contents/notice/notice_view.php?id=' . $nId);
            $dateStr = !empty($row['created_at']) ? date('Y.m.d', strtotime($row['created_at'])) : '-';
          ?>
            <tr style="<?= $isPinned ? 'background-color: #F8FAFC; font-weight: 600;' : '' ?>">
              <td style="text-align: center;">
                <?php if ($isPinned): ?>
                  <span class="ui red mini label" style="font-weight: 700;">공지</span>
                <?php else: ?>
                  <span style="color: var(--ydk-muted);"><?= $nId ?></span>
                <?php endif; ?>
              </td>
              <td>
                <a href="<?= $viewUrl ?>" style="color: <?= $isPinned ? '#1E293B' : '#334155' ?>; text-decoration: none; display: block;">
                  <?php if ($isPinned): ?>
                    <i class="bullhorn icon" style="color: #EF4444; margin-right: 4px;"></i>
                  <?php endif; ?>
                  <?= e($row['title']) ?>
                </a>
              </td>
              <td style="text-align: center; color: var(--ydk-muted);"><?= e($row['author'] ?? '관리자') ?></td>
              <td style="text-align: center; color: var(--ydk-muted); font-size: 13px;"><?= e($dateStr) ?></td>
              <td style="text-align: center; color: var(--ydk-muted); font-size: 13px;"><?= number_format((int)($row['hit'] ?? 0)) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- 4. 10페이지 블록 페이지네이션 -->
    <?php if ($totalPages > 1): ?>
      <div style="display: flex; justify-content: center; align-items: center; margin-top: 26px;">
        <div class="ui pagination menu" style="box-shadow: 0 1px 3px rgba(0,0,0,0.06); flex-wrap: wrap;">
          <?php if ($page > 1): ?>
            <a class="item" href="<?= $makePageUrl(1) ?>" title="처음 페이지"><i class="angle double left icon"></i></a>
            <a class="item" href="<?= $makePageUrl($page - 1) ?>" title="이전 페이지"><i class="angle left icon"></i></a>
          <?php else: ?>
            <span class="disabled item"><i class="angle double left icon"></i></span>
            <span class="disabled item"><i class="angle left icon"></i></span>
          <?php endif; ?>

          <?php if ($startPage > 1): ?>
            <a class="item" href="<?= $makePageUrl($startPage - 1) ?>" title="이전 10페이지">...</a>
          <?php endif; ?>

          <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <a href="<?= $makePageUrl($i) ?>" class="item <?= ($page === $i) ? 'active' : '' ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>

          <?php if ($endPage < $totalPages): ?>
            <a class="item" href="<?= $makePageUrl($endPage + 1) ?>" title="다음 10페이지">...</a>
          <?php endif; ?>

          <?php if ($page < $totalPages): ?>
            <a class="item" href="<?= $makePageUrl($page + 1) ?>" title="다음 페이지"><i class="angle right icon"></i></a>
            <a class="item" href="<?= $makePageUrl($totalPages) ?>" title="마지막 페이지"><i class="angle double right icon"></i></a>
          <?php else: ?>
            <span class="disabled item"><i class="angle right icon"></i></span>
            <span class="disabled item"><i class="angle double right icon"></i></span>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

  <?php endif; ?>

  <!-- 5. 하단 안내 배너 -->
  <section class="ui segment" style="background: #F8FAFC; border: 1px solid #CBD5E1; border-radius: 12px; padding: 22px; text-align: center; margin-top: 40px; margin-bottom: 20px;">
    <h3 style="font-size: 17px; font-weight: 800; color: #1E293B; margin-top: 0; margin-bottom: 6px;">
      용달 및 화물 운송 관련 궁금한 사항이 있으신가요?
    </h3>
    <p style="font-size: 14px; color: #64748B; margin-bottom: 16px;">
      온라인 묻고답하기 또는 365일 실시간 전국 통합 콜센터로 문의 주시면 친절히 상담해 드립니다.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button" style="background-color: var(--ydk-cta); color: #FFF; font-weight: 700; padding: 11px 22px;">
        <i class="phone icon"></i> 대표 콜센터 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/qa/qa.php') ?>" class="ui primary basic button" style="font-weight: 700; padding: 11px 22px;">
        <i class="comments icon"></i> 묻고답하기 바로가기
      </a>
    </div>
  </section>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
?>
