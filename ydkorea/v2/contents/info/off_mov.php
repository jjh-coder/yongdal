<?php
/**
 * 용달코리아 v2-1 사무실·기업 이전 전문 서비스 페이지 (PHP 7.4.33, 반응형 웹)
 * 원본: main/off_mov.html
 * 대상 경로: v2-1/contents/info/off_mov.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '사무실·기업 이전 전문 서비스 | ' . SITE_NAME;
$pageDescription = '소호 사무실부터 기업 사옥 이전까지. 업무 공백을 최소화하는 주말·야간 이전, 사전 무료 방문견적, 파티션 분해조립 및 집기 배치 완벽 지원.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">사무실 이사</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="building icon"></i> 사무실·기업 이전 전문 서비스
    </h1>
    <p class="ydk-page-desc">
      회사의 소중한 업무 공백을 최소화하고 체계적인 프로세스로 신속·안전하게 사옥 이전을 완수합니다.
    </p>
  </header>

  <!-- 2. 상단 하이라이트 배너 -->
  <div class="ui icon message" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #86efac; border-radius: 12px; margin-bottom: 28px;">
    <i class="briefcase icon" style="color: #16a34a;"></i>
    <div class="content">
      <div class="header" style="font-size: 1.25rem; font-weight: 700; color: #14532d; margin-bottom: 6px;">
        주말·공휴일·야간 이전으로 월요일 정상 업무를 보장합니다!
      </div>
      <p style="color: #14532d; line-height: 1.6; margin: 0;">
        기업 이전의 핵심은 시간과 체계입니다. 사전 방문 견적을 통한 층별/부서별 세부 동선 기획부터 
        PC·전자기기 안전 포장, 파티션 분해조립, 배치도에 따른 안착까지 원스톱으로 책임집니다.
      </p>
    </div>
  </div>

  <div class="ui stackable grid">

    <!-- 좌측 본문: 서비스 프로세스 & 세부 안내 -->
    <div class="ten wide computer ten wide tablet sixteen wide mobile column">

      <!-- 섹션 1: 사무실 이전 핵심 프로세스 -->
      <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #16a34a; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 24px;">
        <h2 style="font-size: 1.25rem; color: #14532d; margin-top: 0; margin-bottom: 16px;">
          <i class="clipboard list icon" style="color: #16a34a;"></i> 체계적인 4단계 기업 이전 시스템
        </h2>

        <div class="ui list" style="line-height: 1.8; color: #374151; font-size: 0.98rem;">
          <div class="item" style="padding: 8px 0;">
            <i class="check circle icon" style="color: #16a34a;"></i>
            <div class="content">
              <strong>1. 사전 방문견적 및 일정 수립:</strong> 물량이 많은 경우 현장 실사를 통해 차량 대수, 작업 인원, 반출입 엘리베이터 동선 및 사다리차 사용 여부를 정밀 산출합니다.
            </div>
          </div>
          <div class="item" style="padding: 8px 0;">
            <i class="check circle icon" style="color: #16a34a;"></i>
            <div class="content">
              <strong>2. 전용 박스 사전 대여:</strong> 이사 3~5일 전 직원 개인 서류 및 사물 포장을 위한 플라스틱 이사박스와 라벨 스티커를 사전에 무료 대여해 드립니다.
            </div>
          </div>
          <div class="item" style="padding: 8px 0;">
            <i class="check circle icon" style="color: #16a34a;"></i>
            <div class="content">
              <strong>3. 전문 집기 분해 및 보호 포장:</strong> 회의용 테이블, 파티션, 임원실 중역 가구를 전문 분해하고, 바닥 보호재 및 코너 가드를 설치하여 건물을 보호합니다.
            </div>
          </div>
          <div class="item" style="padding: 8px 0;">
            <i class="check circle icon" style="color: #16a34a;"></i>
            <div class="content">
              <strong>4. 부서별 배치도에 따른 원위치 세팅:</strong> 신규 사무실의 배치도와 라벨 번호에 맞추어 책상, 서랍장, 캐비닛, 박스를 정확한 자리에 안착시켜 드립니다.
            </div>
          </div>
        </div>
      </div>

      <!-- 섹션 2: 사무실 이사 비용 가이드 -->
      <div class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid #0284c7; margin-bottom: 24px;">
        <h3 style="font-size: 1.15rem; color: #075985; margin-top: 0; margin-bottom: 14px;">
          <i class="table icon" style="color: #0284c7;"></i> 사무실 이전 비용 기준 안내 (서울·수도권 기준)
        </h3>

        <div class="ui responsive table-wrapper" style="overflow-x: auto;">
          <table class="ui celled table" style="border-radius: 8px; text-align: center; font-size: 0.95rem;">
            <thead style="background: #f8fafc;">
              <tr>
                <th>규모 구분</th>
                <th>투입 차량 및 인력</th>
                <th>평일 기준 요금</th>
                <th>주말·휴일 기준 요금</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 700;">소호 사무실 (1~3인)</td>
                <td>1톤 용달 1~2대 / 전문 2인</td>
                <td>20 ~ 25 만원</td>
                <td>25 ~ 30 만원</td>
              </tr>
              <tr>
                <td style="font-weight: 700;">중소형 사무실 (5~10인)</td>
                <td>2.5톤~5톤 / 전문 3~4인</td>
                <td>50 ~ 70 만원</td>
                <td>60 ~ 85 만원</td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #16a34a;">중대형 기업 (10인 이상)</td>
                <td>5톤 다수 / 사다리차 / 전문팀</td>
                <td colspan="2"><strong style="color: #16a34a;">현장 무료 방문견적 후 맞춤 산출</strong></td>
              </tr>
            </tbody>
          </table>
        </div>

        <p style="font-size: 0.85rem; color: #64748b; margin-top: 10px; line-height: 1.5;">
          ※ 전산 서버, 금고, 대형 복합기 등 특수 장비 이전 및 층별 파티션 재조립 공정에 따라 최종 견적이 확정됩니다.
        </p>
      </div>

      <!-- 섹션 3: 고객사 혜택 -->
      <div class="ui segment secondary" style="border-radius: 12px; padding: 20px; background: #f8fafc; border: 1px dashed #cbd5e1;">
        <h4 style="color: #1e293b; font-size: 1.05rem; margin-top: 0; margin-bottom: 8px;">
          <i class="receipt icon" style="color: #0284c7;"></i> 법인·사업자 증빙 완벽 지원
        </h4>
        <p style="margin: 0; color: #64748b; font-size: 0.92rem; line-height: 1.6;">
          용달코리아는 관허 4-42호 등록 정식 법인 거래 파트너로서 전자세금계산서 발행, 기업 지출결의서용 견적서 및 청구서, 거래명세서를 신속하고 정확하게 발행해 드립니다.
        </p>
      </div>

    </div>

    <!-- 우측 컬럼: 방문견적 신청 및 상담 -->
    <div class="six wide computer six wide tablet sixteen wide mobile column">

      <!-- 방문견적 신청 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 2px solid #16a34a; overflow: hidden; margin-bottom: 20px;">
        <div class="content" style="background: #16a34a; color: #fff; padding: 18px 20px; text-align: center;">
          <h3 style="color: #fff; margin: 0; font-size: 1.25rem;">
            기업 이전 무료 방문견적
          </h3>
          <p style="margin: 4px 0 0 0; color: #dcfce7; font-size: 0.95rem;">전문 상담사가 직접 방문 실사합니다</p>
        </div>
        <div class="content" style="padding: 22px; text-align: center;">
          <div style="font-size: 0.9rem; color: #64748b; margin-bottom: 4px;">사무실 이전 전담 직통</div>
          <a href="tel:<?= SITE_PHONE_TEL ?>" style="font-size: 1.6rem; font-weight: 800; color: #16a34a;">
            <?= SITE_PHONE ?>
          </a>
          <div style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-top: 6px;">
            010-4477-2404
          </div>
          <div style="font-size: 0.85rem; color: #94a3b8; margin-top: 4px;">(야간 및 주말 이전 상담 가능)</div>

          <div class="ui divider"></div>

          <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge fluid primary button" style="border-radius: 8px; font-weight: 700; padding: 14px; background: #16a34a;">
            <i class="phone icon"></i> 방문 견적 신청하기
          </a>
        </div>
      </div>

      <!-- 온라인 상담 카드 -->
      <div class="ui card fluid" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div class="content" style="padding: 20px; text-align: center;">
          <h4 style="margin: 0 0 6px 0; color: #1e293b; font-size: 1.1rem;">사무실 이전 온라인 견적문의</h4>
          <p style="font-size: 0.88rem; color: #64748b; margin-bottom: 14px;">직원 수, 대략적인 이전 일정 및 출발/도착지를 알려주시면 가견적서를 송부해 드립니다.</p>
          <a href="<?= url('contents/online/contact_us.php') ?>" class="ui fluid green button" style="border-radius: 6px; font-weight: 700;">
            온라인 문의 작성
          </a>
        </div>
      </div>

    </div>

  </div>

  <!-- 4. 하단 CTA -->
  <section class="ydk-bottom-cta" style="margin-top: 24px; padding: 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
    <h3 style="font-size: 1.3rem; color: #1e293b; margin-bottom: 8px;">
      성공적인 비즈니스를 위한 든든한 이전 파트너
    </h3>
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 18px;">
      꼼꼼한 보양 작업부터 신속한 세팅까지, 귀사의 새로운 도약을 완벽히 지원하겠습니다.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge primary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="phone icon"></i> 대표전화 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge secondary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="edit outline icon"></i> 온라인 견적 상담
      </a>
    </div>
  </section>

</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
