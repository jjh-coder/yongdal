<?php
/**
 * 용달코리아 v2-1 용달 이사 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/yd_mov.html
 * 대상 경로: v2-1/contents/info/yd_mov.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '용달 이사 (원룸·투룸·소형가정·사무실) | ' . SITE_NAME;
$pageDescription = '원룸, 투룸, 자취, 학생, 싱글 가구 및 소호 사무실 맞춤 용달이사. 단순 운송부터 일반이사, 포장이사까지 합리적인 비용으로 안전하게 운송합니다.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">용달 이사</span>
    </nav>
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 12px;">
      <div>
        <h1 class="ydk-page-title" style="margin-bottom: 6px;">
          <i class="truck icon" style="color: var(--ydk-primary);"></i> 용달 이사 서비스
        </h1>
        <p class="ydk-page-desc" style="margin: 0;">
          원룸, 투룸, 자취생, 싱글족 및 소호 사무실을 위한 경제적이고 신속한 1톤 맞춤형 이사 솔루션입니다.
        </p>
      </div>
      <div>
        <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui button" style="background-color: var(--ydk-cta); color: #FFF; font-weight: 700; padding: 10px 18px;">
          <i class="phone icon"></i> 이사 상담 1688-2404
        </a>
      </div>
    </div>
  </header>

  <!-- 2. 서비스 요약 배너 개선 (단순 1줄 텍스트 박스 -> 3대 핵심 강점 카드 그리드) -->
  <section style="margin-bottom: 30px;">
    <div style="background: linear-gradient(135deg, #1E3A8A 0%, #1B365D 100%); border-radius: 12px; padding: 24px; color: #FFFFFF; box-shadow: 0 4px 14px rgba(27, 54, 93, 0.2);">
      <div style="text-align: center; margin-bottom: 20px;">
        <span style="display: inline-block; background: rgba(255, 255, 255, 0.15); font-size: 13px; font-weight: 700; padding: 4px 12px; border-radius: 20px; margin-bottom: 8px;">
          SMART MOVE SOLUTION
        </span>
        <h2 style="font-size: 22px; font-weight: 800; color: #FFFFFF; margin: 0;">
          소형 이사는 왜 용달코리아 1톤 용달이 정답일까요?
        </h2>
        <p style="font-size: 14px; opacity: 0.9; margin: 6px 0 0 0;">
          짐이 적은데 값비싼 대형 포장이사를 부를 필요가 없습니다. 필요한 작업만큼만 선택해 비용을 절약하세요.
        </p>
      </div>

      <!-- 3열 반응형 특장점 카드 -->
      <div class="ui three column stackable grid" style="margin: 0;">
        <div class="column" style="padding: 8px;">
          <div style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px; padding: 18px 16px; height: 100%; text-align: center;">
            <div style="width: 44px; height: 44px; background: #FFFFFF; color: var(--ydk-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; font-size: 20px; font-weight: 900;">
              <i class="won sign icon" style="margin: 0;"></i>
            </div>
            <h3 style="font-size: 17px; font-weight: 800; color: #FFFFFF; margin: 0 0 6px 0;">대형 이사 대비 50% 절감</h3>
            <p style="font-size: 13px; opacity: 0.88; line-height: 1.5; margin: 0;">
              불필요한 인건비 거품 없이, 짐의 양과 작업 여건에 맞춘 최적의 실속 요금을 제시합니다.
            </p>
          </div>
        </div>

        <div class="column" style="padding: 8px;">
          <div style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px; padding: 18px 16px; height: 100%; text-align: center;">
            <div style="width: 44px; height: 44px; background: #FFFFFF; color: var(--ydk-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; font-size: 20px;">
              <i class="tasks icon" style="margin: 0;"></i>
            </div>
            <h3 style="font-size: 17px; font-weight: 800; color: #FFFFFF; margin: 0 0 6px 0;">운송부터 포장까지 선택</h3>
            <p style="font-size: 13px; opacity: 0.88; line-height: 1.5; margin: 0;">
              단순 차량 운송만부터 기사님 동참, 일반이사, 반포장까지 고객이 원하는 방식대로 진행합니다.
            </p>
          </div>
        </div>

        <div class="column" style="padding: 8px;">
          <div style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px; padding: 18px 16px; height: 100%; text-align: center;">
            <div style="width: 44px; height: 44px; background: #FFFFFF; color: var(--ydk-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px auto; font-size: 20px;">
              <i class="bolt icon" style="margin: 0;"></i>
            </div>
            <h3 style="font-size: 17px; font-weight: 800; color: #FFFFFF; margin: 0 0 6px 0;">수도권 당일 신속 배차</h3>
            <p style="font-size: 13px; opacity: 0.88; line-height: 1.5; margin: 0;">
              서울 및 수도권 전지역 30분 내 긴급 배차와 주말/야간 안심 사전 예약 시스템을 운영합니다.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="ui stackable grid">

    <!-- 좌측 본문: 가정/사무실 구분 및 상세 (10 컬럼) -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 용달 가정이사 -->
      <article class="ui segment" style="border-radius: 12px; padding: 26px; border: 1px solid var(--ydk-border-light); border-top: 4px solid var(--ydk-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.04); margin-bottom: 24px;">
        <h2 style="font-size: 19px; font-weight: 800; color: #1E293B; margin-top: 0; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
          <i class="home icon" style="color: var(--ydk-primary);"></i> 용달 가정이사 (원룸·투룸·학생·싱글)
        </h2>
        
        <ul style="line-height: 1.8; color: #334155; font-size: 15px; margin: 0; padding-left: 20px;">
          <li style="margin-bottom: 8px;">
            <strong>맞춤 대상:</strong> 원룸·투룸 이사, 자취생, 대학생 짐, 고시원, 오피스텔, 분가 짐 등 1인~소형 가구
          </li>
          <li style="margin-bottom: 8px;">
            <strong>방식 선택:</strong> 이삿짐 규모와 예산에 따라 <strong>차량 단순운송, 일반이사, 반포장/포장이사</strong>를 자유롭게 선택할 수 있습니다.
          </li>
          <li style="margin-bottom: 8px;">
            <strong>운송만 이용 시:</strong> 예약 시간 전까지 짐을 건물 밖(1층)으로 꺼내 놓으시면, 기사님이 차에 안전하게 싣고 목적지 1층 하차까지 도와드립니다. (가장 알뜰한 방식)
          </li>
          <li>
            <strong>일반이사 진행 시:</strong> 잔짐은 박스에 미리 포장해 두시면, 기사님이 실내 상·하차 운반 및 가구/가전의 자리 배치를 함께 도와드립니다.
          </li>
        </ul>
      </article>

      <!-- 섹션 2: 용달 사무실이사 -->
      <article class="ui segment" style="border-radius: 12px; padding: 26px; border: 1px solid var(--ydk-border-light); border-top: 4px solid #2563EB; box-shadow: 0 4px 12px rgba(0,0,0,0.04); margin-bottom: 24px;">
        <h2 style="font-size: 19px; font-weight: 800; color: #1E293B; margin-top: 0; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
          <i class="building outline icon" style="color: #2563EB;"></i> 용달 사무실이사 (소호·소형점포·작업실 이전)
        </h2>
        
        <ul style="line-height: 1.8; color: #334155; font-size: 15px; margin: 0; padding-left: 20px;">
          <li style="margin-bottom: 8px;">
            <strong>맞춤 대상:</strong> 스타트업, 소호 사무실, 개인 작업실, 공방, 소형 점포, 공유오피스 이전
          </li>
          <li style="margin-bottom: 8px;">
            <strong>집기 운송만:</strong> 책상, 의자, PC, 서류 박스를 1층에 준비해 두시면 가장 합리적인 기본 운송 요금으로 이전 가능합니다.
          </li>
          <li>
            <strong>배치 지원:</strong> 일반이사 진행 시 사무용 파티션, 책상, 회의용 테이블, 집기를 원하시는 실내 배치도에 맞추어 운반·정리해 드립니다.
          </li>
        </ul>
      </article>

      <!-- 섹션 3: 1톤 기준 이사 비용 가이드 (모바일 완벽 대응 반응형 표 & 카드) -->
      <article class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 14px rgba(0,0,0,0.05); border: 1px solid var(--ydk-border-light); border-top: 4px solid #059669; margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; margin-bottom: 14px;">
          <h3 style="font-size: 18px; font-weight: 800; color: #064E3B; margin: 0; display: flex; align-items: center; gap: 6px;">
            <i class="table icon" style="color: #059669;"></i> 1톤 용달이사 표준 비용 가이드 (서울 시내 1층 기준 예시)
          </h3>
          <span class="ui green tiny label" style="font-weight: 700;">사전 정찰 기준</span>
        </div>

        <!-- [모바일 화면: 767px 이하 전용] 가독성 극대화 스마트 요금 카드 리스트 -->
        <div class="ydk-mobile-pricing-list" style="display: none;">
          
          <!-- 카드 1: 차량 운송만 -->
          <div style="background: #F8FAFC; border: 1px solid #CBD5E1; border-radius: 10px; padding: 16px; margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
              <span style="font-size: 16px; font-weight: 800; color: #1E293B;">
                <i class="truck icon" style="color: #2563EB;"></i> 용달차 단순 운송
              </span>
              <span class="ui blue mini label" style="font-weight: 700;">가장 알뜰형</span>
            </div>
            <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 12px; text-align: center; margin-bottom: 8px;">
              <div style="font-size: 12px; color: var(--ydk-muted); margin-bottom: 2px;">평일 / 손없는날 동일 기준</div>
              <div style="font-size: 20px; font-weight: 900; color: #2563EB;">6 ~ 9 만원 <span style="font-size: 13px; font-weight: 600; color: #64748B;">(거리 비례)</span></div>
            </div>
            <div style="font-size: 13px; color: #475569; line-height: 1.5;">
              <i class="check circle icon" style="color: #059669;"></i> 기사님 차량 운송 및 적재·하차 기본 지원 (짐은 1층 상차 대기)
            </div>
          </div>

          <!-- 카드 2: 일반이사 (고객 함께) -->
          <div style="background: #F8FAFC; border: 1px solid #CBD5E1; border-radius: 10px; padding: 16px; margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
              <span style="font-size: 16px; font-weight: 800; color: #1E293B;">
                <i class="user outline icon" style="color: #059669;"></i> 일반이사 (기사 1인 + 고객 동참)
              </span>
              <span class="ui green mini label" style="font-weight: 700;">원룸 최다선택</span>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 8px;">
              <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px; text-align: center;">
                <div style="font-size: 11px; color: var(--ydk-muted);">평일 요금</div>
                <div style="font-size: 17px; font-weight: 900; color: #1E293B;">9 ~ 10 만원</div>
              </div>
              <div style="background: #FFF7ED; border: 1px solid #FED7AA; border-radius: 8px; padding: 10px; text-align: center;">
                <div style="font-size: 11px; color: #9A3412;">손없는날 / 주말</div>
                <div style="font-size: 17px; font-weight: 900; color: #C2410C;">10 ~ 12 만원</div>
              </div>
            </div>
            <div style="font-size: 13px; color: #475569; line-height: 1.5;">
              <i class="check circle icon" style="color: #059669;"></i> 기사 1명이 고객님과 함께 짐 운반 및 가구/가전 실내 배치 지원
            </div>
          </div>

          <!-- 카드 3: 일반이사 (전문인부 포함) -->
          <div style="background: #F8FAFC; border: 1px solid #CBD5E1; border-radius: 10px; padding: 16px; margin-bottom: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
              <span style="font-size: 16px; font-weight: 800; color: #1E293B;">
                <i class="users icon" style="color: #7C3AED;"></i> 일반이사 (기사 1인 + 전문인부 1인)
              </span>
              <span class="ui purple mini label" style="font-weight: 700;">짐 많은 가구</span>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 8px;">
              <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px; text-align: center;">
                <div style="font-size: 11px; color: var(--ydk-muted);">평일 요금</div>
                <div style="font-size: 17px; font-weight: 900; color: #1E293B;">20 ~ 25 만원</div>
              </div>
              <div style="background: #FFF7ED; border: 1px solid #FED7AA; border-radius: 8px; padding: 10px; text-align: center;">
                <div style="font-size: 11px; color: #9A3412;">손없는날 / 주말</div>
                <div style="font-size: 17px; font-weight: 900; color: #C2410C;">24 ~ 28 만원</div>
              </div>
            </div>
            <div style="font-size: 13px; color: #475569; line-height: 1.5;">
              <i class="check circle icon" style="color: #059669;"></i> 2인 전문팀이 상·하차부터 큰 가구 배치까지 전담 (고객 작업 없음)
            </div>
          </div>

          <!-- 카드 4: 포장이사 -->
          <div style="background: #F8FAFC; border: 1px solid #CBD5E1; border-radius: 10px; padding: 16px; margin-bottom: 8px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
              <span style="font-size: 16px; font-weight: 800; color: #1E293B;">
                <i class="boxes icon" style="color: #D97706;"></i> 원스톱 포장이사 (올인원)
              </span>
              <span class="ui orange mini label" style="font-weight: 700;">프리미엄</span>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 8px;">
              <div style="background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px; text-align: center;">
                <div style="font-size: 11px; color: var(--ydk-muted);">평일 요금</div>
                <div style="font-size: 17px; font-weight: 900; color: #1E293B;">35 ~ 40 만원</div>
              </div>
              <div style="background: #FFF7ED; border: 1px solid #FED7AA; border-radius: 8px; padding: 10px; text-align: center;">
                <div style="font-size: 11px; color: #9A3412;">손없는날 / 주말</div>
                <div style="font-size: 17px; font-weight: 900; color: #C2410C;">40 ~ 45 만원</div>
              </div>
            </div>
            <div style="font-size: 13px; color: #475569; line-height: 1.5;">
              <i class="check circle icon" style="color: #059669;"></i> 전용 포장재 포장, 운송, 가구 조립/배치, 바닥 보양까지 원스톱
            </div>
          </div>

        </div>

        <!-- [데스크톱/태블릿 화면: 768px 이상 전용] unstackable celled table -->
        <div class="ydk-desktop-pricing-table">
          <table class="ui unstackable celled structured table" style="border-radius: 8px; text-align: center; font-size: 14px; margin: 0;">
            <thead style="background: #F1F5F9;">
              <tr>
                <th style="background: #F1F5F9; color: #1E293B; font-weight: 800; width: 22%;">서비스 구분</th>
                <th style="background: #F1F5F9; color: #1E293B; font-weight: 800; width: 20%;">평일 요금</th>
                <th style="background: #F1F5F9; color: #1E293B; font-weight: 800; width: 22%;">이삿날 (손없는날/주말)</th>
                <th style="background: #F1F5F9; color: #1E293B; font-weight: 800; width: 36%;">기본 작업 내용</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 800; color: #1E293B; background: #FAF5FF;">
                  <i class="truck icon" style="color: #2563EB;"></i> 용달차 단순 운송
                </td>
                <td colspan="2" style="font-size: 15px; font-weight: 800; color: #2563EB;">
                  6 ~ 9 만원 <span style="font-size: 12px; font-weight: normal; color: var(--ydk-muted);">(거리 비례)</span>
                </td>
                <td style="text-align: left; padding-left: 14px;">기사 적재 및 하차 지원 (1층 대기 기준)</td>
              </tr>
              <tr>
                <td rowspan="2" style="font-weight: 800; color: #1E293B; background: #F0FDF4; vertical-align: middle;">
                  <i class="user outline icon" style="color: #059669;"></i> 일반이사
                </td>
                <td style="font-weight: 800; color: #1E293B;">9 ~ 10 만원</td>
                <td style="font-weight: 800; color: #C2410C;">10 ~ 12 만원</td>
                <td style="text-align: left; padding-left: 14px;">기사 1명 + 고객 함께 작업 (실내 운반)</td>
              </tr>
              <tr>
                <td style="font-weight: 800; color: #1E293B;">20 ~ 25 만원</td>
                <td style="font-weight: 800; color: #C2410C;">24 ~ 28 만원</td>
                <td style="text-align: left; padding-left: 14px;">기사 1명 + 전문 인부 1명 (고객 작업 없음)</td>
              </tr>
              <tr>
                <td style="font-weight: 800; color: #9A3412; background: #FFF7ED;">
                  <i class="boxes icon" style="color: #D97706;"></i> 포장이사
                </td>
                <td style="font-weight: 800; color: #1E293B;">35 ~ 40 만원</td>
                <td style="font-weight: 800; color: #C2410C;">40 ~ 45 만원</td>
                <td style="text-align: left; padding-left: 14px;">기사 1명 + 전문 인부 1명 올인원 포장/정리</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div style="font-size: 13px; color: #64748B; margin-top: 12px; line-height: 1.6; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 6px; padding: 10px 14px;">
          <i class="info circle icon" style="color: #0284C7;"></i>
          <strong>유의사항:</strong> 사다리차 이용료, 엘리베이터 없는 고층 계단 작업, 에어컨/벽걸이 TV 탈부착 등 특수 옵션 작업은 현장 여건에 따라 사전 협의 요금이 발생합니다.
        </div>
      </article>

    </div>

    <!-- 우측 컬럼: 빠른 전화 상담 & 연관 이사 링크 (6 컬럼) -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 직통 예약 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); border: 2px solid var(--ydk-primary); overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: var(--ydk-primary); color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 19px; font-weight: 800;">
            용달이사 직통 상담·예약
          </h3>
          <p style="margin: 4px 0 0 0; color: #E2E8F0; font-size: 13px;">당일 즉시 배차 및 날짜 지정 예약</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 13px; color: var(--ydk-muted); margin-bottom: 2px;">전국 통합 콜센터</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 26px; font-weight: 900; color: var(--ydk-primary); display: block; letter-spacing: 0.5px;">
            <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 15px; font-weight: 800; color: #334155; margin-top: 6px;">
            <i class="phone icon" style="color: #059669;"></i> 010-4477-2404
          </div>
          <div style="font-size: 12px; color: var(--ydk-muted); margin-top: 4px;">(08:00 ~ 21:00 연중무휴 친절 상담)</div>

          <div class="ui divider" style="margin: 16px 0;"></div>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid button" style="border-radius: 8px; font-weight: 800; padding: 14px; background: var(--ydk-cta); color: #FFF; box-shadow: 0 3px 10px rgba(194,65,12,0.35);">
            <i class="phone icon"></i> 전화로 맞춤 견적받기
          </a>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid basic button" style="border-radius: 8px; font-weight: 700; padding: 12px; margin-top: 8px;">
            <i class="edit outline icon"></i> 온라인 무료 견적 신청
          </a>
        </div>
      </div>

      <!-- 기타 이사 유형 빠른 바로가기 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.04); border: 1px solid var(--ydk-border-light); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="font-size: 16px; font-weight: 800; color: #1E293B; margin-top: 0; margin-bottom: 12px;">
            <i class="exchange alternate icon" style="color: var(--ydk-primary);"></i> 다른 이사 서비스 둘러보기
          </h4>
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <a href="<?= url('contents/info/room_mov.php') ?>" class="ui fluid basic teal button" style="text-align: left; border-radius: 6px; padding: 12px 14px; font-weight: 700;">
              <i class="user icon"></i> 원룸·투룸 이사 상세 가이드 <i class="angle right icon" style="float: right;"></i>
            </a>
            <a href="<?= url('contents/info/off_mov.php') ?>" class="ui fluid basic blue button" style="text-align: left; border-radius: 6px; padding: 12px 14px; font-weight: 700;">
              <i class="building icon"></i> 사무실·기업 이전 전문 <i class="angle right icon" style="float: right;"></i>
            </a>
            <a href="<?= url('contents/info/gen_mov.php') ?>" class="ui fluid basic purple button" style="text-align: left; border-radius: 6px; padding: 12px 14px; font-weight: 700;">
              <i class="dolly icon"></i> 알뜰 일반 이사 서비스 <i class="angle right icon" style="float: right;"></i>
            </a>
            <a href="<?= url('contents/info/pack_mov.php') ?>" class="ui fluid basic orange button" style="text-align: left; border-radius: 6px; padding: 12px 14px; font-weight: 700;">
              <i class="boxes icon"></i> 프리미엄 포장 이사 <i class="angle right icon" style="float: right;"></i>
            </a>
            <a href="<?= url('contents/info/forecast_trt.php') ?>" class="ui fluid basic button" style="text-align: left; border-radius: 6px; padding: 12px 14px; font-weight: 700; color: var(--ydk-primary);">
              <i class="calculator icon"></i> 이삿짐 예상 단가표 전체보기 <i class="angle right icon" style="float: right;"></i>
            </a>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- 4. 하단 CTA -->
  <section class="ydk-bottom-cta" style="margin-top: 10px; padding: 32px 24px; background: #F8FAFC; border: 1px solid #CBD5E1; border-radius: 12px; text-align: center;">
    <h3 style="font-size: 20px; font-weight: 800; color: #1E293B; margin-bottom: 8px;">
      용달이사 정확한 비용이 궁금하신가요?
    </h3>
    <p style="color: #64748B; font-size: 15px; margin-bottom: 20px;">
      원룸, 오피스텔, 고시원 등 적은 짐도 정성껏 소중히 옮겨드립니다. 전화 한 통으로 가장 합리적인 견적을 확인하세요.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge button" style="background-color: var(--ydk-cta); color: #FFF; font-weight: 800; border-radius: 30px; padding: 14px 28px;">
        <i class="phone icon"></i> 전화 견적 문의 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge secondary button" style="font-weight: 800; border-radius: 30px; padding: 14px 28px;">
        <i class="edit outline icon"></i> 온라인 무료 견적
      </a>
    </div>
  </section>

</main>

<style>
/* 모바일 요금 카드 리스트 및 데스크톱 요금표 반응형 미디어 쿼리 */
@media (max-width: 767px) {
  .ydk-mobile-pricing-list {
    display: block !important;
  }
  .ydk-desktop-pricing-table {
    display: none !important;
  }
}

@media (min-width: 768px) {
  .ydk-mobile-pricing-list {
    display: none !important;
  }
  .ydk-desktop-pricing-table {
    display: block !important;
  }
}
</style>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
