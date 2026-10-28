<?php
/**
 * 용달코리아 v2-1 원룸·투룸 이사 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/room_mov.html
 * 대상 경로: v2-1/contents/info/room_mov.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '원룸·투룸 이사 서비스 | ' . SITE_NAME;
$pageDescription = '싱글, 대학생, 직장인 맞춤 원룸·투룸 이사. 가구 전용 커버, 침대 매트리스 커버, 행거 박스 등 전문 자재를 활용한 꼼꼼한 포장과 안전 운송을 제공합니다.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">원룸 이사</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="user outline icon"></i> 원룸·투룸 이사 서비스
    </h1>
    <p class="ydk-page-desc">
      싱글 직장인, 대학생, 사회초년생의 라이프스타일에 맞춘 섬세하고 실속 있는 원룸 전문 이사 솔루션입니다.
    </p>
  </header>

  <!-- 2. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); border: 1px solid #fed7aa; border-radius: 12px; margin-bottom: 28px;">
    <i class="heart outline icon" style="color: #ea580c;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #9a3412; margin-bottom: 6px;">
        내 짐처럼 소중하게! 1인 가구 맞춤 안심 이사
      </div>
      <p style="color: #431407; line-height: 1.6; margin: 0;">
        매트리스 전용 위생 커버, 정장/원피스를 구김 없이 옮기는 행거 박스, 식기 에어캡 포장까지 — 
        작은 원룸이라도 프리미엄 이사의 정성 그대로 꼼꼼하게 작업해 드립니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문: 포장 방법 & 운송 시스템 -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 원룸 전문 포장 시스템 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #ea580c; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #7c2d12; margin-top: 0; margin-bottom: 16px;">
          <i class="box icon" style="color: #ea580c;"></i> 용달코리아의 원룸 맞춤 포장 노하우
        </h2>

        <div class="ui two column doubling grid">
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="check circle icon" style="color: #10b981;"></i> 가구 전용 커버</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">서랍장, 책상, 거울 등 스크래치 방지 보호 패드 포장</p>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="check circle icon" style="color: #10b981;"></i> 매트리스 위생 커버</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">먼지나 오염을 완벽 차단하는 전용 침대 커버 씌움</p>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="check circle icon" style="color: #10b981;"></i> 의류 전용 행거 박스</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">옷걸이 채로 담아 구김 없이 즉시 이동 및 재걸기</p>
            </div>
          </div>
          <div class="column">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; margin-bottom: 10px;">
              <strong style="color: #1e293b;"><i class="check circle icon" style="color: #10b981;"></i> 주방용품 에어캡 완충</strong>
              <p style="font-size: 0.88rem; color: #64748b; margin: 4px 0 0 0;">유리 그릇, 머그컵, 주방 가전 2중 뽁뽁이 완충 포장</p>
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 안전 운송 프로세스 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #0284c7; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #075985; margin-top: 0; margin-bottom: 16px;">
          <i class="shield alternate icon" style="color: #0284c7;"></i> 세심한 현장 보호 및 안전 운송
        </h2>

        <ul class="ui list" style="line-height: 1.8; color: #374151; font-size: 0.98rem;">
          <li><strong>탑차 및 호루차 운송:</strong> 눈, 비, 미세먼지로부터 짐을 안전하게 보호하는 방수 탑차 우선 배차</li>
          <li><strong>바닥 및 엘리베이터 보호:</strong> 이송 통로에 바닥 보강재를 설치하여 건물의 훼손 및 민원 예방</li>
          <li><strong>건물 조건별 맞춤 운반:</strong> 좁은 골목길은 구루마 장비 운반, 2층 이상 고층은 사다리차 연계 지원</li>
          <li><strong>도착지 기본 자리배치:</strong> 침대 프레임 조립, 책상 및 대형 가전을 고객이 원하시는 위치에 안착</li>
        </ul>
      </div>

      <!-- 섹션 3: 원룸 이사 요금 기준표 -->
      <div class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid #10b981;">
        <h3 style="font-size: 1.15rem; color: #064e3b; margin-top: 0; margin-bottom: 14px;">
          <i class="table icon" style="color: #10b981;"></i> 원룸 이사 요금 가이드 (1톤 기준 예시)
        </h3>

        <div class="ui responsive table-wrapper" style="overflow-x: auto;">
          <table class="ui celled table" style="border-radius: 8px; text-align: center; font-size: 0.95rem;">
            <thead style="background: #f8fafc;">
              <tr>
                <th>서비스 구분</th>
                <th>평일 요금</th>
                <th>이삿날 (손없는날)</th>
                <th>작업 내용 요약</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 700;">일반이사 (기사도움)</td>
                <td>8 ~ 10 만원</td>
                <td>10 ~ 12 만원</td>
                <td>고객 박스 포장 완료 + 기사와 함께 운반</td>
              </tr>
              <tr>
                <td style="font-weight: 700;">일반이사 (전문 2인)</td>
                <td>20 ~ 22 만원</td>
                <td>22 ~ 25 만원</td>
                <td>기사 1명 + 인부 1명 (고객 손 안 대는 일반이사)</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #b45309;">원룸 반포장 / 포장</td>
                <td>33 ~ 35 만원</td>
                <td>35 ~ 40 만원</td>
                <td>전문 인력 2명 포장부터 정리까지 원스톱</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- 우측 컬럼: 빠른 상담 & 견적 문의 -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 직통 예약 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid #ea580c; overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: #ea580c; color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            원룸이사 실시간 전화 상담
          </h3>
          <p style="margin: 4px 0 0 0; color: #ffedd5; font-size: 0.95rem;">1인 가구 맞춤 정직한 견적</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표번호</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.6rem; font-weight: 800; color: #ea580c;">
            <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-top: 6px;">
            010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(08:00 ~ 21:00 연중무휴)</div>

          <div class="ui divider"></div>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid primary button" style="border-radius: 8px; font-weight: 700; padding: 14px; background: #ea580c;">
            <i class="phone icon"></i> 전화로 즉시 상담받기
          </a>
        </div>
      </div>

      <!-- 이사 체크리스트 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="font-size: 1.05rem; color: #1e293b; margin-top: 0; margin-bottom: 12px;">
            <i class="tasks icon" style="color: #10b981;"></i> 원룸이사 준비 꿀팁
          </h4>
          <ul class="ui list" style="line-height: 1.7; color: #475569; font-size: 0.92rem;">
            <li>귀중품(노트북, 현금, 귀금속)은 별도 가방에 직접 챙기기</li>
            <li>이사 전날 냉장고 성에 제거 및 물기 닦기</li>
            <li>종량제 쓰레기봉투(50L~100L) 1~2장 사전 준비</li>
            <li>관리사무소에 엘리베이터 사용 예약 및 공과금 정산</li>
          </ul>
        </div>
      </div>

      <!-- 온라인 견적 문의 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">24시간 온라인 견적 접수</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">출발/도착 층수와 주요 가구를 알려주시면 빠른 견적을 드립니다.</p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            온라인 간편 문의
          </a>
        </div>
      </div>

    </div>

  </div>

  <!-- 4. 하단 CTA -->
  <section class="ydk-bottom-cta" style="margin-top: 24px; padding: 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
    <h3 style="font-size: 1.3rem; color: #1e293b; margin-bottom: 8px;">
      새로운 출발, 편안하고 기분 좋은 원룸이사
    </h3>
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 18px;">
      용달코리아의 오랜 경험과 친절한 서비스로 이삿날의 수고를 덜어드립니다.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge primary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="phone icon"></i> 전화 상담 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge secondary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="edit outline icon"></i> 온라인 무료 견적
      </a>
    </div>
  </section>

</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
