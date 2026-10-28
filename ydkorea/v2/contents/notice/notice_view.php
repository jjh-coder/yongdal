<?php
/**
 * 용달코리아 v2-1 공지사항 상세 보기 페이지
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반, 반응형 웹
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../admin/includes/db.php';

$id = max(0, (int)($_GET['id'] ?? 0));
$notice = get_notice_item($id, true);

if (!$notice) {
    echo "<script>alert('존재하지 않거나 삭제된 공지사항입니다.'); location.href='" . url('contents/notice/notice.php') . "';</script>";
    exit;
}

$pageTitle = e($notice['title']) . ' | 공지사항 | ' . SITE_NAME;
$metaDescription = mb_substr(strip_tags($notice['content']), 0, 120, 'UTF-8');

// 이전글 / 다음글 조회용 전체 리스트
$allNotices = get_notice_list();
$prevNotice = null;
$nextNotice = null;
$count = count($allNotices);
for ($i = 0; $i < $count; $i++) {
    if ((int)$allNotices[$i]['id'] === $id) {
        if ($i > 0) {
            $prevNotice = $allNotices[$i - 1]; // 최신순 정렬이므로 인덱스가 작을수록 더 최신(다음글)
        }
        if ($i < $count - 1) {
            $nextNotice = $allNotices[$i + 1]; // 인덱스가 클수록 이전글
        }
        break;
    }
}

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <a href="<?= url('contents/notice/notice.php') ?>">공지사항</a>
      <span class="divider">/</span>
      <span class="active">공지 내용</span>
    </nav>
  </header>

  <!-- 2. 공지사항 본문 카드 -->
  <article class="ui segment" style="background: #FFF; border: 1px solid #E2E8F0; border-radius: 12px; padding: 28px 32px; box-shadow: 0 2px 4px rgba(0,0,0,0.03); margin-bottom: 24px;">
    
    <!-- 공지 제목 헤더 -->
    <div style="border-bottom: 2px solid #F1F5F9; padding-bottom: 18px; margin-bottom: 24px;">
      <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 10px;">
        <?php if (!empty($notice['is_pinned'])): ?>
          <span class="ui red mini label" style="font-weight: 700;">중요 공지</span>
        <?php endif; ?>
        <span style="font-size: 13px; color: var(--ydk-muted);">No. <?= (int)$notice['id'] ?></span>
      </div>
      
      <h1 style="font-size: 22px; font-weight: 800; color: #1E293B; line-height: 1.4; margin: 0 0 14px 0;">
        <?= e($notice['title']) ?>
      </h1>

      <div style="display: flex; gap: 16px; font-size: 13px; color: #64748B; flex-wrap: wrap;">
        <div><i class="user outline icon"></i> <strong>작성자:</strong> <?= e($notice['author'] ?? '관리자') ?></div>
        <div><i class="clock outline icon"></i> <strong>작성일:</strong> <?= e(date('Y년 m월 d일 H:i', strtotime($notice['created_at']))) ?></div>
        <div><i class="eye icon"></i> <strong>조회수:</strong> <?= number_format((int)($notice['hit'] ?? 0)) ?></div>
      </div>
    </div>

    <!-- 공지 내용 본문 -->
    <div style="font-size: 15px; line-height: 1.8; color: #334155; min-height: 180px; word-break: break-all; padding: 10px 0;">
      <?= nl2br(e($notice['content'])) ?>
    </div>

  </article>

  <!-- 3. 이전글 / 다음글 이동 네비게이션 -->
  <div class="ui segment" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 10px; padding: 0; margin-bottom: 28px; overflow: hidden;">
    <div style="display: flex; flex-direction: column;">
      
      <!-- 다음글 -->
      <div style="display: flex; padding: 12px 18px; border-bottom: 1px solid #E2E8F0; align-items: center; gap: 12px;">
        <span style="width: 70px; font-weight: 700; font-size: 13px; color: #64748B;">
          <i class="angle up icon"></i> 다음글
        </span>
        <?php if ($prevNotice): ?>
          <a href="<?= url('contents/notice/notice_view.php?id=' . (int)$prevNotice['id']) ?>" style="color: #334155; flex: 1; text-decoration: none;">
            <?= e($prevNotice['title']) ?>
          </a>
          <span style="font-size: 12px; color: var(--ydk-muted);"><?= date('Y.m.d', strtotime($prevNotice['created_at'])) ?></span>
        <?php else: ?>
          <span style="color: var(--ydk-muted); font-size: 13px;">다음 공지글이 없습니다.</span>
        <?php endif; ?>
      </div>

      <!-- 이전글 -->
      <div style="display: flex; padding: 12px 18px; align-items: center; gap: 12px;">
        <span style="width: 70px; font-weight: 700; font-size: 13px; color: #64748B;">
          <i class="angle down icon"></i> 이전글
        </span>
        <?php if ($nextNotice): ?>
          <a href="<?= url('contents/notice/notice_view.php?id=' . (int)$nextNotice['id']) ?>" style="color: #334155; flex: 1; text-decoration: none;">
            <?= e($nextNotice['title']) ?>
          </a>
          <span style="font-size: 12px; color: var(--ydk-muted);"><?= date('Y.m.d', strtotime($nextNotice['created_at'])) ?></span>
        <?php else: ?>
          <span style="color: var(--ydk-muted); font-size: 13px;">이전 공지글이 없습니다.</span>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <!-- 4. 목록으로 가기 버튼 -->
  <div style="text-align: center; margin-bottom: 40px;">
    <a href="<?= url('contents/notice/notice.php') ?>" class="ui primary button" style="padding: 12px 30px; font-weight: 700;">
      <i class="list icon"></i> 공지사항 목록으로
    </a>
  </div>

</main>

<?php
include __DIR__ . '/../../includes/footer.php';
?>
