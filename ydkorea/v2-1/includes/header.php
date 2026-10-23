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
  <link rel="canonical" href="https://www.ydkorea.co.kr/v2-1/">

  <!-- Fomantic-UI 2.9.4 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.4/dist/semantic.min.css">
  <!-- Pretendard Font -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css">
  <!-- Custom CSS (Fomantic 뒤에 로드, 캐시 갱신용 버전 파라미터 포함) -->
  <link rel="stylesheet" href="<?= url('assets/css/custom.css?v=' . filemtime(__DIR__ . '/../assets/css/custom.css')) ?>">
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
        <a href="/v2-1/admin/index.php"><i class="cog icon"></i> 관리자</a>
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
        <!-- 모바일 전용 햄버거 메뉴 토글 버튼 -->
        <button type="button" class="ydk-btn-menu-toggle" id="btnMobileMenu" aria-label="전체 메뉴 열기" title="전체 메뉴 열기">
          <i class="bars icon"></i>
        </button>
      </div>
    </div>

    <!-- 7대 상단 내비게이션 바 -->
    <nav class="ydk-nav-wrap">
      <div class="ydk-container">
        <div class="ui menu ydk-nav">
          <a class="item" href="<?= url('contents/info/company.php') ?>">회사 소개</a>
          <a class="item" href="<?= url('contents/online/contact_us.php') ?>">온라인 상담</a>
          <a class="item" href="<?= url('contents/tel/tel.php') ?>">전화 상담 방법</a>
          <a class="item" href="<?= url('contents/trt/trt.php') ?>">운송 요금</a>
          <a class="item" href="<?= url('contents/size/car_size.php') ?>">차량 규격</a>
          <a class="item" href="<?= url('contents/club/car_club.php') ?>">차주 회원 모집</a>
          <a class="item" href="<?= url('contents/service/service.php') ?>">서비스 안내</a>
        </div>
      </div>
    </nav>
  </header>

  <!-- 모바일 오프캔버스 드로어 내비게이션 & 오버레이 -->
  <div class="ydk-drawer-overlay" id="drawerOverlay" aria-hidden="true"></div>
  <aside class="ydk-mobile-drawer" id="mobileDrawer" aria-label="모바일 전체 메뉴" role="dialog" aria-modal="true">
    <div class="ydk-drawer-header">
      <div class="ydk-drawer-title">
        <a href="<?= url() ?>">
          <img src="<?= url('assets/images/log/logo_02_simple.png') ?>" alt="<?= SITE_NAME ?>" style="height: 38px; width: auto; display: block;">
        </a>
      </div>
      <button type="button" class="ydk-drawer-close" id="btnCloseDrawer" aria-label="메뉴 닫기">
        <i class="times icon"></i>
      </button>
    </div>

    <div class="ydk-drawer-body">
      <!-- 1. 빠른 직통 상담 액션 카드 -->
      <div class="ydk-drawer-action-card">
        <div class="ydk-drawer-action-label">신속하고 친절한 전국 화물·이사 상담</div>
        <a href="tel:<?= SITE_PHONE_TEL ?>" class="ydk-drawer-call-btn">
          <i class="phone icon"></i> <?= SITE_PHONE ?> 즉시 통화
        </a>
        <a href="<?= url('contents/online/contact_us.php') ?>" class="ydk-drawer-quote-btn">
          <i class="edit outline icon"></i> 1분 온라인 간편 견적 신청
        </a>
      </div>

      <!-- 2. 7대 핵심 서비스 메뉴 -->
      <div class="ydk-drawer-section-title">서비스 메뉴</div>
      <ul class="ydk-drawer-nav">
        <li>
          <a href="<?= url('contents/info/company.php') ?>">
            <i class="info circle icon"></i> 회사 소개
          </a>
        </li>
        <li>
          <a href="<?= url('contents/online/contact_us.php') ?>">
            <i class="edit icon"></i> 온라인 상담 / 무료 견적
          </a>
        </li>
        <li>
          <a href="<?= url('contents/tel/tel.php') ?>">
            <i class="phone volume icon"></i> 전화 상담 방법 안내
          </a>
        </li>
        <li>
          <a href="<?= url('contents/trt/trt.php') ?>">
            <i class="calculator icon"></i> 차종별 운송 요금표
          </a>
        </li>
        <li>
          <a href="<?= url('contents/size/car_size.php') ?>">
            <i class="truck icon"></i> 차량 적재함 규격
          </a>
        </li>
        <li>
          <a href="<?= url('contents/club/car_club.php') ?>">
            <i class="user plus icon"></i> 차주 회원 모집 안내
          </a>
        </li>
        <li>
          <a href="<?= url('contents/service/service.php') ?>">
            <i class="clipboard list icon"></i> 종합 서비스 안내
          </a>
        </li>
      </ul>

      <!-- 3. 지역별 차주 찾기 & 지점 바로가기 -->
      <div class="ydk-drawer-section-title">지역 및 특화 차주 찾기</div>
      <div class="ydk-drawer-sublinks">
        <a href="<?= url('contents/company/company_list.php?id=07') ?>">best 용달</a>
        <a href="<?= url('contents/company/company_list.php?id=08') ?>">1.4t~5t 화물</a>
        <a href="<?= url('contents/company/company_list.php?id=09') ?>">탑차</a>
        <a href="<?= url('contents/company/company_list.php?id=10') ?>">리프트차</a>
        <a href="<?= url('contents/company/company_list.php?id=11') ?>">서울권 지점</a>
        <a href="<?= url('contents/company/company_list.php?id=36') ?>">경기·인천권</a>
        <a href="<?= url('contents/company/company_list.php?id=59') ?>">광역시·지방</a>
        <a href="<?= url('contents/company/jijum/') ?>">전국 지점 상세안내</a>
      </div>

      <!-- 4. 하단 신뢰 안내 -->
      <div class="ydk-drawer-footer">
        <div style="font-weight: 800; color: var(--ydk-primary); margin-bottom: 4px;">용달코리아 전국 통합 배차센터</div>
        <div>연중무휴 당일 신속 배차 직거래 연결</div>
        <div style="margin-top: 6px; font-size: 11px; color: var(--ydk-muted);">
          화물자동차운송주선사업 관허 제4-42호 등록업체
        </div>
      </div>
    </div>
  </aside>
