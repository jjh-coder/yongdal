<?php
/**
 * 용달코리아 v2 관리자 공통 헤더 (PHP 7.4.33)
 */
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';

$pageTitle = isset($adminTitle) ? $adminTitle . ' | 용달코리아 관리자' : '용달코리아 관리자 시스템';
$currentScript = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($pageTitle) ?></title>
  
  <!-- Fomantic-UI 2.9.4 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.4/dist/semantic.min.css">
  <!-- Pretendard Font -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css">
  <!-- Admin Custom CSS -->
  <link rel="stylesheet" href="<?= url('admin/assets/css/admin.css') ?>">
</head>
<body class="ydk-admin-body">

  <!-- 관리자 상단 네비게이션 바 -->
  <nav class="ydk-admin-navbar">
    <div class="ydk-admin-container ydk-admin-nav-inner">
      <div class="ydk-admin-nav-left">
        <a href="<?= url('admin/index.php') ?>" class="ydk-admin-brand">
          <span class="ydk-admin-logo-badge">관리자</span>
          <span class="ydk-admin-title"><?= SITE_NAME ?> 운영 관리</span>
        </a>

        <div class="ydk-admin-menu">
          <a href="<?= url('admin/index.php') ?>" class="nav-item <?= ($currentScript === 'index.php') ? 'active' : '' ?>">
            <i class="chart bar outline icon"></i> 대시보드
          </a>
          <a href="<?= url('admin/consult_list.php') ?>" class="nav-item <?= in_array($currentScript, ['consult_list.php', 'consult_view.php']) ? 'active' : '' ?>">
            <i class="comments outline icon"></i> 온라인 상담
          </a>
          <a href="<?= url('admin/club_list.php') ?>" class="nav-item <?= in_array($currentScript, ['club_list.php', 'club_view.php']) ? 'active' : '' ?>">
            <i class="truck icon"></i> 차주회원
          </a>
          <a href="<?= url('admin/company_list.php') ?>" class="nav-item <?= in_array($currentScript, ['company_list.php', 'company_form.php']) ? 'active' : '' ?>">
            <i class="building outline icon"></i> 지역업체
          </a>
          <a href="<?= url('admin/notice_list.php') ?>" class="nav-item <?= in_array($currentScript, ['notice_list.php', 'notice_form.php']) ? 'active' : '' ?>">
            <i class="bullhorn icon"></i> 공지사항
          </a>
          <a href="<?= url('admin/qa_list.php') ?>" class="nav-item <?= in_array($currentScript, ['qa_list.php', 'qa_view.php']) ? 'active' : '' ?>">
            <i class="question circle outline icon"></i> 묻고답하기
          </a>
          <a href="<?= url('admin/code_list.php') ?>" class="nav-item <?= in_array($currentScript, ['code_list.php']) ? 'active' : '' ?>">
            <i class="tags icon"></i> 코드 관리
          </a>
        </div>
      </div>

      <div class="ydk-admin-menu ydk-admin-nav-right">
        <a href="<?= url() ?>" target="_blank" class="nav-item">
          <i class="external alternate icon"></i> 사이트 보기
        </a>
        <a href="<?= url('admin/logout.php') ?>" class="nav-item btn-logout" onclick="return confirm('관리자에서 로그아웃 하시겠습니까?');">
          <i class="sign out alternate icon"></i> 로그아웃
        </a>
      </div>
    </div>
  </nav>

  <div class="ydk-admin-main-wrap">
    <div class="ydk-admin-container">
