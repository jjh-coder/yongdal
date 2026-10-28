<?php
/**
 * 용달코리아 v2-1 묻고답하기(Q&A) 목록 페이지
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반, 반응형 웹
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../admin/includes/db.php';

$pageTitle = '묻고답하기(Q&A) | ' . SITE_NAME . ' (1688-2404)';
$metaDescription = '용달 화물, 원룸이사, 용달차 대여 및 배차 관련 실시간 질문과 답변을 확인하세요.';

// 검색 및 필터 파라미터
$statusFilter = trim($_GET['status'] ?? '');
$keyword = trim($_GET['kw'] ?? '');
$page = max(1, (int)($_GET['p'] ?? 1));
$perPage = 10;

// 데이터 조회
$allList = get_qa_list($statusFilter, $keyword);
$totalRows = count($allList);
$totalPages = max(1, (int)ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$pagedList = array_slice($allList, $offset, $perPage);

// 10페이지 단위 블록 페이징 계산
$pageBlock = 10;
$startPage = (int)(floor(($page - 1) / $pageBlock) * $pageBlock) + 1;
$endPage = min($totalPages, $startPage + $pageBlock - 1);

$makePageUrl = function($p) use ($statusFilter, $keyword) {
    $q = ['p' => $p];
    if ($statusFilter !== '') $q['status'] = $statusFilter;
    if ($keyword !== '') $q['kw'] = $keyword;
    return url('contents/qa/qa.php?' . http_build_query($q));
};

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">묻고답하기</span>
    </nav>
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="ydk-page-title">
          <i class="comments outline icon"></i> 묻고답하기 (Q&A)
        </h1>
        <p class="ydk-page-desc">
          화물 운송 견적, 이사 문의, 일정 조율 등 궁금하신 점을 남겨주시면 전문 상담원이 성심껏 답변해 드립니다.
        </p>
      </div>
      <div>
        <a href="<?= url('contents/qa/qa_write.php') ?>" class="ui primary button" style="font-weight: 700; padding: 12px 20px;">
          <i class="edit icon"></i> 질문 작성하기
        </a>
      </div>
    </div>
  </header>

  <!-- 2. 빠른 전화 안내 박스 -->
  <section class="ui message" style="background-color: #EFF6FF; border: 1px solid #BFDBFE; border-radius: 10px; margin-bottom: 20px;">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
      <div style="color: #1E3A8A; font-size: 14px; line-height: 1.5;">
        <i class="phone volume icon" style="color: #2563EB;"></i> <strong>급한 배차나 즉시 확인이 필요하신가요?</strong>
        전국 통합 콜센터 <strong><a href="tel:<?= SITE_PHONE_TEL ?>" style="color: #2563EB; font-weight: 800;"><?= SITE_PHONE ?></a></strong>으로 전화 주시면 실시간 1:1 상담이 가능합니다.
      </div>
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui mini blue button" style="font-weight: 700;">
        <i class="phone icon"></i> 전화 상담
      </a>
    </div>
  </section>

  <!-- 3. 검색 및 상태 필터 바 -->
  <section class="ui segment" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 14px 18px; margin-bottom: 20px;">
    <form method="get" action="<?= url('contents/qa/qa.php') ?>" style="display: flex; gap: 10px; align-items: center; justify-content: space-between; flex-wrap: wrap;">
      
      <!-- 상태 필터 탭 -->
      <div class="ui small buttons">
        <a href="<?= url('contents/qa/qa.php?kw=' . urlencode($keyword)) ?>" class="ui <?= ($statusFilter === '') ? 'blue' : 'basic' ?> button">
          전체 (<?= number_format($totalRows) ?>)
        </a>
        <a href="<?= url('contents/qa/qa.php?status=' . urlencode('접수') . '&kw=' . urlencode($keyword)) ?>" class="ui <?= ($statusFilter === '접수') ? 'blue' : 'basic' ?> button">
          답변대기
        </a>
        <a href="<?= url('contents/qa/qa.php?status=' . urlencode('답변완료') . '&kw=' . urlencode($keyword)) ?>" class="ui <?= ($statusFilter === '답변완료') ? 'blue' : 'basic' ?> button">
          답변완료
        </a>
      </div>

      <!-- 검색 입력창 -->
      <div class="ui action input" style="max-width: 360px; width: 100%;">
        <?php if ($statusFilter !== ''): ?>
          <input type="hidden" name="status" value="<?= e($statusFilter) ?>">
        <?php endif; ?>
        <input type="text" name="kw" placeholder="제목, 질문내용, 작성자 검색..." value="<?= e($keyword) ?>">
        <button type="submit" class="ui primary button">검색</button>
        <?php if ($keyword !== '' || $statusFilter !== ''): ?>
          <a href="<?= url('contents/qa/qa.php') ?>" class="ui basic button">초기화</a>
        <?php endif; ?>
      </div>

    </form>
  </section>

  <!-- 4. Q&A 목록 테이블 -->
  <?php if (empty($pagedList)): ?>
    <div class="ui placeholder segment" style="padding: 50px 20px; text-align: center;">
      <div class="ui icon header" style="color: var(--ydk-muted);">
        <i class="inbox icon"></i>
        <?php if ($keyword !== '' || $statusFilter !== ''): ?>
          조건과 일치하는 질문 및 문의 내역이 없습니다.
        <?php else: ?>
          등록된 질문이 없습니다. 첫 번째 질문을 남겨보세요!
        <?php endif; ?>
      </div>
      <div style="margin-top: 14px;">
        <a href="<?= url('contents/qa/qa_write.php') ?>" class="ui primary button">
          <i class="edit icon"></i> 첫 질문 작성하기
        </a>
      </div>
    </div>
  <?php else: ?>
    <div style="overflow-x: auto; background: #FFF; border-radius: 10px; border: 1px solid #E2E8F0; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
      <table class="ui celled table unstackable selectable" style="margin: 0; border: none; font-size: 14px;">
        <thead>
          <tr style="background: #F8FAFC;">
            <th style="width: 75px; text-align: center;">번호</th>
            <th style="width: 100px; text-align: center;">상태</th>
            <th>제목</th>
            <th style="width: 110px; text-align: center;">작성자</th>
            <th style="width: 120px; text-align: center;">등록일</th>
            <th style="width: 75px; text-align: center;">조회</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pagedList as $row): 
            $qId = (int)$row['id'];
            $st = $row['status'] ?? '접수';
            $isAnswered = ($st === '답변완료');
            $isSecret = !empty($row['is_secret']);
            $viewUrl = url('contents/qa/qa_view.php?id=' . $qId);
            $dateStr = !empty($row['created_at']) ? date('Y.m.d', strtotime($row['created_at'])) : '-';

            // 작성자 이름 마스킹 (개인정보 보호: 홍*동)
            $rawWriter = $row['writer'] ?? '고객';
            $wLen = mb_strlen($rawWriter, 'UTF-8');
            if ($wLen > 2) {
                $maskedWriter = mb_substr($rawWriter, 0, 1, 'UTF-8') . str_repeat('*', $wLen - 2) . mb_substr($rawWriter, -1, 1, 'UTF-8');
            } elseif ($wLen === 2) {
                $maskedWriter = mb_substr($rawWriter, 0, 1, 'UTF-8') . '*';
            } else {
                $maskedWriter = $rawWriter;
            }
          ?>
            <tr>
              <td style="text-align: center; color: var(--ydk-muted);"><?= $qId ?></td>
              <td style="text-align: center;">
                <?php if ($isAnswered): ?>
                  <span class="ui green tiny label" style="font-weight: 700;">답변완료</span>
                <?php else: ?>
                  <span class="ui orange tiny label" style="font-weight: 700;">답변대기</span>
                <?php endif; ?>
              </td>
              <td>
                <a href="<?= $viewUrl ?>" style="color: #1E293B; text-decoration: none; font-weight: 600; display: block;">
                  <?php if ($isSecret): ?>
                    <i class="lock icon" style="color: #64748B; margin-right: 4px;" title="비밀글"></i>
                  <?php endif; ?>
                  <?= e($row['title']) ?>
                  <?php if ($isAnswered): ?>
                    <span style="font-size: 12px; color: #16A34A; margin-left: 6px;">[답변 등록됨]</span>
                  <?php endif; ?>
                </a>
              </td>
              <td style="text-align: center; color: #475569;"><?= e($maskedWriter) ?></td>
              <td style="text-align: center; color: var(--ydk-muted); font-size: 13px;"><?= e($dateStr) ?></td>
              <td style="text-align: center; color: var(--ydk-muted); font-size: 13px;"><?= number_format((int)($row['hit'] ?? 0)) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- 5. 10페이지 블록 페이지네이션 -->
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

  <!-- 6. 하단 작성 플로팅/바로가기 영역 -->
  <div style="display: flex; justify-content: flex-end; margin-top: 18px;">
    <a href="<?= url('contents/qa/qa_write.php') ?>" class="ui primary button" style="font-weight: 700; padding: 11px 24px;">
      <i class="pencil alternate icon"></i> 질문 작성하기
    </a>
  </div>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
?>
