<?php
/**
 * 용달코리아 v2-1 용달 이사 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/yd_mov.html
 * 대상 경로: v2-1/contents/info/yd_mov.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '용달 이사 (원룸·소형가정·사무실) | ' . SITE_NAME;
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
    <h1 class="ydk-page-title">
      <i class="truck icon"></i> 용달 이사 서비스
    </h1>
    <p class="ydk-page-desc">
      원룸, 투룸, 자취생, 싱글족 및 소호 사무실을 위한 경제적이고 신속한 1톤 맞춤형 이사 솔루션입니다.
    </p>
  </header>

  <!-- 2. 서비스 요약 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%); border: 1px solid #c7d2fe; border-radius: 12px; margin-bottom: 28px;">
    <i class="home icon" style="color: #4f46e5;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #3730a3; margin-bottom: 6px;">
        부담 없는 비용으로 알뜰하게! 소형 이사는 역시 1톤 용달!
      </div>
      <p style="color: #312e81; line-height: 1.6; margin: 0;">
        짐이 적어 대형 익스프레스 포장이사가 부담스러우셨다면, 필요한 작업만큼만 선택해 비용을 줄이는 용달이사가 최선입니다. 
        단순 차량 운송만부터 기사 도움, 일반이사, 반포장까지 맞춤으로 지원합니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문: 가정/사무실 구분 및 상세 -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 용달 가정이사 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #4f46e5; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #312e81; margin-top: 0; margin-bottom: 14px;">
          <i class="user outline icon" style="color: #4f46e5;"></i> 용달 가정이사 (원룸·투룸·학생·싱글)
        </h2>
        
        <ul class="ui list" style="line-height: 1.8; color: #374151; font-size: 0.98rem;">
          <li><strong>맞춤 대상:</strong> 원·투룸 이사, 자취 짐, 학생 짐, 고시원 짐, 분가 짐, 싱글족 등 적은 짐을 소유하신 고객</li>
          <li><strong>방식 선택:</strong> 적은 양의 이삿짐이라도 고객의 주문 요청에 따라 단순운송, 일반이사, 포장이사를 자유롭게 선택 가능합니다.</li>
          <li><strong>운송만 이용 시:</strong> 약속 시간까지 짐을 건물 밖(1층)으로 꺼내 놓으셔야 하며, 기사는 차에서 받아 싣고 내려드립니다.</li>
          <li><strong>일반이사 진행 시:</strong> 잔짐은 박스로 사전 포장되어 있어야 하며, 도착지에서 가구와 큰 짐을 원하시는 위치에 배치해 드립니다.</li>
        </ul>
      </div>

      <!-- 섹션 2: 용달 사무실이사 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #0284c7; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #075985; margin-top: 0; margin-bottom: 14px;">
          <i class="building outline icon" style="color: #0284c7;"></i> 용달 사무실이사 (소호·소형점포 이전)
        </h2>
        
        <ul class="ui list" style="line-height: 1.8; color: #374151; font-size: 0.98rem;">
          <li><strong>맞춤 대상:</strong> 스타트업, 소호 사무실, 개인 작업실, 소형 점포, 오피스텔 사무실 이전</li>
          <li><strong>집기 운송만:</strong> 약속 시간까지 책상, 의자, 서류 박스를 1층으로 꺼내 놓으시면 가장 저렴한 운송비가 적용됩니다.</li>
          <li><strong>배치 지원:</strong> 일반이사 선택 시 사무집기, 책상 파티션, 서류 박스를 원하시는 배치도에 맞추어 옮겨 드립니다.</li>
        </ul>
      </div>

      <!-- 섹션 3: 1톤 기준 이사 비용표 -->
      <div class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid #10b981;">
        <h3 style="font-size: 1.15rem; color: #064e3b; margin-top: 0; margin-bottom: 14px;">
          <i class="table icon" style="color: #10b981;"></i> 1톤 용달이사 표준 비용 가이드 (서울 시내 기준 예시)
        </h3>

        <div class="ui responsive table-wrapper" style="overflow-x: auto;">
          <table class="ui celled table" style="border-radius: 8px; text-align: center; font-size: 0.95rem;">
            <thead style="background: #f8fafc;">
              <tr>
                <th>서비스 구분</th>
                <th>평일 요금</th>
                <th>이삿날 (손없는날)</th>
                <th>기본 작업 내용</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 600;">용달차 운송만</td>
                <td colspan="2"><strong style="color: #0284c7;">5 ~ 7 만원</strong> (거리 비례)</td>
                <td>기사 적재 및 하차 지원</td>
              </tr>
              <tr>
                <td rowspan="2" style="font-weight: 700; background: #fafafa;">일반이사</td>
                <td>9 ~ 10 만원</td>
                <td>10 ~ 12 만원</td>
                <td>기사 1명 + 고객 함께 작업</td>
              </tr>
              <tr>
                <td>20 ~ 22 만원</td>
                <td>22 ~ 25 만원</td>
                <td>기사 1명 + 전문 인부 1명</td>
              </tr>
              <tr>
                <td style="font-weight: 700; background: #fafafa; color: #b45309;">포장이사</td>
                <td>33 ~ 35 만원</td>
                <td>35 ~ 40 만원</td>
                <td>기사 1명 + 전문 인부 1명 올인원</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div style="font-size: 0.85rem; color: #64748b; margin-top: 10px; line-height: 1.5;">
          ※ 사다리차 이용, 엘리베이터 없는 고층 계단 작업, 에어컨/벽걸이 TV 탈부착 등 옵션 작업은 별도 협의 요금이 발생합니다.
        </div>
      </div>

    </div>

    <!-- 우측 컬럼: 빠른 전화 상담 & 연관 이사 링크 -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 직통 예약 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid #4f46e5; overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: #4f46e5; color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            용달이사 직통 상담·예약
          </h3>
          <p style="margin: 4px 0 0 0; color: #e0e7ff; font-size: 0.95rem;">당일 즉시 배차 및 날짜 지정 예약</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">대표번호</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.6rem; font-weight: 800; color: #4f46e5;">
            <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-top: 6px;">
            010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(08:00 ~ 21:00 연중무휴 상담)</div>

          <div class="ui divider"></div>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid primary button" style="border-radius: 8px; font-weight: 700; padding: 14px; background: #4f46e5;">
            <i class="phone icon"></i> 전화로 간편 견적받기
          </a>
        </div>
      </div>

      <!-- 기타 이사 유형 빠른 바로가기 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
        <div class="content" style="padding: 20px;">
          <h4 style="font-size: 1.05rem; color: #1e293b; margin-top: 0; margin-bottom: 12px;">
            <i class="exchange alternate icon" style="color: #0284c7;"></i> 다른 이사 서비스 둘러보기
          </h4>
          <div style="display: flex; flex-direction: column; gap: 8px;">
            <a href="<?= url('contents/info/room_mov.php') ?>" class="ui fluid basic teal button" style="text-align: left; border-radius: 6px;">
              <i class="user icon"></i> 원룸·투룸 이사 상세 <i class="angle right icon" style="float: right;"></i>
            </a>
            <a href="<?= url('contents/info/off_mov.php') ?>" class="ui fluid basic blue button" style="text-align: left; border-radius: 6px;">
              <i class="building icon"></i> 사무실·기업 이전 <i class="angle right icon" style="float: right;"></i>
            </a>
            <a href="<?= url('contents/info/gen_mov.php') ?>" class="ui fluid basic purple button" style="text-align: left; border-radius: 6px;">
              <i class="dolly icon"></i> 알뜰 일반이사 안내 <i class="angle right icon" style="float: right;"></i>
            </a>
            <a href="<?= url('contents/info/pack_mov.php') ?>" class="ui fluid basic orange button" style="text-align: left; border-radius: 6px;">
              <i class="boxes icon"></i> 프리미엄 포장이사 <i class="angle right icon" style="float: right;"></i>
            </a>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- 4. 하단 CTA -->
  <section class="ydk-bottom-cta" style="margin-top: 24px; padding: 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
    <h3 style="font-size: 1.3rem; color: #1e293b; margin-bottom: 8px;">
      용달이사 비용이 궁금하신가요?
    </h3>
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 18px;">
      원룸, 오피스텔, 고시원 등 적은 짐도 정성껏 소중히 옮겨드립니다. 전화 한 통으로 빠른 견적을 확인하세요.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge primary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="phone icon"></i> 전화 견적 문의 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge secondary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="edit outline icon"></i> 온라인 무료 견적
      </a>
    </div>
  </section>

</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
