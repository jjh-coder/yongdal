<?php
/**
 * 용달코리아 v2 공통 헤더 템플릿 (PHP 7.4.33)
 */
if (!defined('BASE_URL')) {
    exit('Direct access not permitted');
}

$title = isset($pageTitle) && $pageTitle !== '' 
    ? e($pageTitle) 
    : '용달코리아 대표번호 1688-2404 용달화물 및 이사 용달차 안내 전국 화물 네트워크';

$metaDesc = isset($pageDescription) && $pageDescription !== ''
    ? e($pageDescription)
    : '서울시 성동구에 위치한 용달코리아 대표번호 1688-2404 용달네트워크 업체 소형화물, 중형화물, 지방화물 알선, 용달차, 개인용달, 용달화물, 이삿짐, 용달이사, 원룸이사, 사무실이사 전문';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <meta name="description" content="<?= $metaDesc ?>">
  <meta name="keywords" content="용달코리아, 용달, 개인용달, 용달차, 개별용달, 전국화물, 리프트용달, 1톤트럭, 2.5톤, 5톤화물, 용달이사, 원룸이사, 지방화물, 화물운임">
  <meta name="robots" content="noindex, nofollow">
  <link rel="canonical" href="https://www.ydkorea.co.kr/v2/">

  <!-- Fomantic-UI 2.9.4 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.4/dist/semantic.min.css">
  <!-- Pretendard Font -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css">
  <!-- Custom CSS (Fomantic 뒤에 로드) -->
  <link rel="stylesheet" href="<?= url('assets/css/custom.css') ?>">
</head>
<body>

  <!-- 상단 유틸리티 바 -->
  <div class="ydk-topbar">
    <div class="ydk-container ydk-topbar-inner">
      <div class="ydk-topbar-notice">
        <i class="bullhorn icon"></i> 전국 어디서나 한 통의 전화로 신속하고 안전한 용달·화물 직거래 운송
      </div>
      <div>
        <a href="#" id="btnBookmark"><i class="star outline icon"></i> 즐겨찾기 추가</a>
        <a href="/v2/admin/index.php"><i class="cog icon"></i> 관리자</a>
      </div>
    </div>
  </div>

  <!-- 메인 헤더 & 대표번호 (상단 고정) -->
  <header class="ydk-header-wrap">
    <div class="ydk-container ydk-header-main">
      <div class="ydk-logo">
        <a href="<?= url() ?>">
          <img src="<?= url('assets/images/log/logo_02_simple.png') ?>" alt="<?= SITE_NAME ?> 로고" class="ydk-logo-img">
        </a>
      </div>
      <div class="ydk-header-phone">
        <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button ydk-btn-call">
          <i class="phone icon"></i>
          <span class="ydk-call-label">상담·예약</span>
          <span class="ydk-call-number"><?= SITE_PHONE ?></span>
        </a>
      </div>
    </div>

    <!-- 7대 상단 내비게이션 바 -->
    <nav class="ydk-nav-wrap">
      <div class="ydk-container">
        <div class="ui menu ydk-nav">
          <a class="item" href="<?= url('contents/info/compnay.php') ?>">회사 소개</a>
          <a class="item" href="<?= url('contents/online/contact_us.php') ?>">온라인 상담</a>
          <a class="item" href="<?= legacy('main/tel_con.html') ?>">전화 상담 방법</a>
          <a class="item" href="<?= legacy('main/trt.html') ?>">운송 요금</a>
          <a class="item" href="<?= legacy('main/car_size.html') ?>">차량 규격</a>
          <a class="item" href="<?= legacy('main/car_club.html') ?>">차주 회원 모집</a>
          <a class="item" href="<?= legacy('main/service.html') ?>">서비스 안내</a>
        </div>
      </div>
    </nav>
  </header>
