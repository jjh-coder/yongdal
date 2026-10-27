<?php
/**
 * 용달코리아 v2-1 이삿짐 예상 단가 및 서비스별 요금 가이드 (PHP 7.4.33, 반응형 웹)
 * 원본: main/forecast_trt.html
 * 대상 경로: v2-1/contents/info/forecast_trt.php
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '이삿짐 예상 단가 및 서비스별 요금 가이드 | ' . SITE_NAME;
$pageDescription = '투명하고 합리적인 이삿짐 예상 단가 기준. 단순 차량 운송만 이용부터 기사 도움, 일반이사, 반포장, 포장이사까지 1톤/2.5톤 평일·이삿날 표준 요금표를 확인하세요.';

include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 1. 서브페이지 헤더 및 브레드크럼 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="현재 위치 경로">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">이삿짐 예상 단가</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="calculator icon"></i> 이삿짐 예상 단가 안내
    </h1>
    <p class="ydk-page-desc">
      내 짐의 양과 필요한 작업 범위에 맞추어 가장 투명하고 경제적인 이사 방식을 선택하실 수 있습니다.
    </p>
  </header>

  <!-- 2. 이사 방식별 4대 유형 비교 가이드 -->
  <div class="ui segment" style="border-radius: 12px; padding: 26px; border-top: 4px solid #0070ba; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 28px;">
    <h2 style="font-size: 1.25rem; color: #1a365d; margin-top: 0; margin-bottom: 18px;">
      <i class="exchange alternate icon" style="color: #0070ba;"></i> 어떤 이사 방식이 나에게 맞을까요?
    </h2>

    <div class="ui four column doubling stackable grid">
      
      <div class="column">
        <div class="ui segment secondary" style="border-radius: 10px; height: 100%; padding: 18px; border: 1px solid #e2e8f0;">
          <div style="font-weight: 700; color: #0284c7; font-size: 1.1rem; margin-bottom: 8px;">
            <i class="truck icon"></i> 차량 운송만
          </div>
          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 10px;">
            건물 밖으로 내놓은 짐을 기사가 차에 싣고 도착지 바깥에 내려드리는 기본 운송 서비스입니다.
          </p>
          <div style="font-size: 0.85rem; color: #0369a1; background: #e0f2fe; padding: 6px 10px; border-radius: 6px;">
            <strong>추천:</strong> 짐을 직접 다 나를 수 있어 운임만 최소화하고 싶은 분
          </div>
        </div>
      </div>

      <div class="column">
        <div class="ui segment secondary" style="border-radius: 10px; height: 100%; padding: 18px; border: 1px solid #e2e8f0;">
          <div style="font-weight: 700; color: #10b981; font-size: 1.1rem; margin-bottom: 8px;">
            <i class="user plus icon"></i> 기사 작업 도움
          </div>
          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 10px;">
            고객과 함께 계단이나 엘리베이터로 짐을 함께 운반하고, 차에 적재 및 방안 이동을 돕습니다.
          </p>
          <div style="font-size: 0.85rem; color: #065f46; background: #ecfdf5; padding: 6px 10px; border-radius: 6px;">
            <strong>추천:</strong> 1인 가구, 싱글, 무거운 가구/가전 운반 인력이 부족한 분
          </div>
        </div>
      </div>

      <div class="column">
        <div class="ui segment secondary" style="border-radius: 10px; height: 100%; padding: 18px; border: 1px solid #e2e8f0;">
          <div style="font-weight: 700; color: #8b5cf6; font-size: 1.1rem; margin-bottom: 8px;">
            <i class="dolly icon"></i> 일반이사
          </div>
          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 10px;">
            고객이 사전에 박스로 짐을 다 싸두시면, 기사(인부)가 운반하여 도착지 큰 가구를 배치해 드립니다.
          </p>
          <div style="font-size: 0.85rem; color: #5b21b6; background: #f3e8ff; padding: 6px 10px; border-radius: 6px;">
            <strong>추천:</strong> 원룸·가정·사무실 등 가장 대중적이고 알뜰한 이사
          </div>
        </div>
      </div>

      <div class="column">
        <div class="ui segment secondary" style="border-radius: 10px; height: 100%; padding: 18px; border: 1px solid #e2e8f0;">
          <div style="font-weight: 700; color: #f59e0b; font-size: 1.1rem; margin-bottom: 8px;">
            <i class="boxes icon"></i> 포장 / 반포장이사
          </div>
          <p style="font-size: 0.9rem; color: #475569; line-height: 1.5; margin-bottom: 10px;">
            전문 포장재로 이삿짐 포장부터 운송, 가구배치, 수납정리 및 기본 청소까지 올인원 케어합니다.
          </p>
          <div style="font-size: 0.85rem; color: #92400e; background: #fef3c7; padding: 6px 10px; border-radius: 6px;">
            <strong>추천:</strong> 바쁜 직장인, 맞벌이 부부, 손 하나 대지 않고 편하게 이사할 분
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- 3. 차량 기준별 예상 요금표 -->
  <div class="ui stackable grid" style="margin-bottom: 24px;">
    
    <!-- 1톤 차량 기준 요금표 -->
    <div class="sixteen wide column">
      <div class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid #0284c7;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; margin-bottom: 16px;">
          <h3 style="font-size: 1.2rem; color: #0369a1; margin: 0;">
            <i class="truck icon"></i> 1톤 차량 기준 이사 요금 (서울 시내 1층 기준 예시)
          </h3>
          <span style="font-size: 0.88rem; color: #64748b;">※ 거리 및 층수, 엘리베이터 유무에 따라 변동될 수 있습니다.</span>
        </div>

        <div class="ui responsive table-wrapper" style="overflow-x: auto;">
          <table class="ui celled structured table" style="border-radius: 8px; text-align: center; font-size: 0.95rem;">
            <thead style="background: #f8fafc;">
              <tr>
                <th style="width: 22%;">서비스 구분</th>
                <th style="width: 26%;">작업 인원 구성</th>
                <th style="width: 26%;">평 일 요금</th>
                <th style="width: 26%;">이삿날(손없는날/월말)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="font-weight: 600; color: #334155;">단순 차량 운송만</td>
                <td>기사 1명 (상하차 적재 도움)</td>
                <td><strong style="color: #0284c7;">6 ~ 8 만원</strong></td>
                <td><strong style="color: #0284c7;">7 ~ 9 만원</strong></td>
              </tr>
              <tr>
                <td rowspan="2" style="font-weight: 700; color: #1e293b; background: #fafafa;">일반이사</td>
                <td>기사 1명 + 고객 도움</td>
                <td><strong>10 ~ 13 만원</strong></td>
                <td><strong>13 ~ 15 만원</strong></td>
              </tr>
              <tr>
                <td>전문 기사 1명 + 전문 인부 1명</td>
                <td><strong>23 ~ 25 만원</strong></td>
                <td><strong>25 ~ 30 만원</strong></td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #065f46; background: #fafafa;">반포장이사</td>
                <td>전문 기사 1명 + 전문 인부 1명</td>
                <td><strong>35 ~ 38 만원</strong></td>
                <td><strong>38 ~ 40 만원</strong></td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #b45309; background: #fafafa;">포장이사</td>
                <td>전문 기사 1명 + 전문 인부 1명</td>
                <td><strong>35 ~ 40 만원</strong></td>
                <td><strong>40 ~ 45 만원</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- 2.5톤 차량 기준 요금표 -->
    <div class="sixteen wide column">
      <div class="ui segment" style="border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 4px solid #10b981;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; margin-bottom: 16px;">
          <h3 style="font-size: 1.2rem; color: #065f46; margin: 0;">
            <i class="truck icon"></i> 2.5톤 차량 기준 이사 요금. 서울 시내 1층 기준(투룸·가정·사무실)
          </h3>
          <span style="font-size: 0.88rem; color: #64748b;">※ 가구/가전 물량이 많은 가정 및 중소형 사무실 기준</span>
        </div>

        <div class="ui responsive table-wrapper" style="overflow-x: auto;">
          <table class="ui celled structured table" style="border-radius: 8px; text-align: center; font-size: 0.95rem;">
            <thead style="background: #f8fafc;">
              <tr>
                <th style="width: 22%;">서비스 구분</th>
                <th style="width: 26%;">작업 인원 구성</th>
                <th style="width: 26%;">평 일 요금</th>
                <th style="width: 26%;">이삿날(손없는날/월말)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td rowspan="2" style="font-weight: 700; color: #1e293b; background: #fafafa;">일반이사</td>
                <td>기사 1명 (상하차 적재 지원)</td>
                <td><strong>20 ~ 22 만원</strong></td>
                <td><strong>22 ~ 25 만원</strong></td>
              </tr>
              <tr>
                <td>전문 기사 1명 + 전문 인부 1명</td>
                <td><strong>50 ~ 55 만원</strong></td>
                <td><strong>55 ~ 60 만원</strong></td>
              </tr>
              <tr>
                <td style="font-weight: 700; color: #065f46; background: #fafafa;">반포장 / 포장이사</td>
                <td>전문 기사 1명 + 전문 인부 1~2명</td>
                <td><strong>65 ~ 70 만원</strong></td>
                <td><strong>75 ~ 80 만원</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- 4. 추가 옵션 및 현장 특수 상황 안내 -->
  <div class="ui segment" style="border-radius: 12px; padding: 24px; background: #fffbeb; border: 1px solid #fef3c7; margin-bottom: 28px;">
    <h3 style="color: #92400e; font-size: 1.15rem; margin-top: 0; margin-bottom: 12px;">
      <i class="plus circle icon" style="color: #d97706;"></i> 별도 비용이 적용되는 옵션 및 현장 변수
    </h3>
    <div class="ui two column doubling stackable grid">
      <div class="column">
        <ul class="ui list" style="line-height: 1.8; color: #78350f; font-size: 0.95rem;">
          <li><strong>사다리차 사용:</strong> 저층/고층 엘리베이터 사용 불가 시 층수별 별도 요금 적용</li>
          <li><strong>특수 중량물:</strong> 금고, 돌침대, 안마의자, 피아노, 대형 양문형 냉장고 분해 등</li>
          <li><strong>가전·가구 이전설치:</strong> 벽걸이 TV 탈부착, 에어컨 배관 분리 및 가스 회수 등</li>
        </ul>
      </div>
      <div class="column">
        <ul class="ui list" style="line-height: 1.8; color: #78350f; font-size: 0.95rem;">
          <li><strong>계단 작업:</strong> 엘리베이터 없는 건물의 2층 이상 계단 수작업 운반 시</li>
          <li><strong>장거리 이송거리:</strong> 차량 진입 불가로 구루마 이동 거리가 긴 경우 (50m 이상 등)</li>
          <li><strong>현장 장시간 대기:</strong> 잔금 처리나 열쇠 문제 등으로 1~2시간 이상 현장 대기 시</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- 5. 단일 품목 운송 안내 -->
  <div class="ui segment secondary" style="border-radius: 12px; padding: 20px; background: #f8fafc; border: 1px dashed #cbd5e1; margin-bottom: 28px;">
    <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
      <div style="font-size: 2.2rem; color: #0284c7;"><i class="couch icon"></i></div>
      <div style="flex: 1; min-width: 250px;">
        <h4 style="margin: 0 0 4px 0; color: #1e293b; font-size: 1.1rem;">냉장고, 세탁기, 침대 등 "단일 품목 운송"</h4>
        <p style="margin: 0; color: #64748b; font-size: 0.92rem; line-height: 1.5;">
          가전제품 한 개, 침대나 소파 하나만 옮기실 때에도 1톤 용달차로 신속히 이동해 드리며, 시내 단거리 운송 기준 5~7만원 선의 합리적인 운임으로 이용 가능합니다.
        </p>
      </div>
      <div>
        <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui primary button" style="border-radius: 6px; font-weight: 700;">
          단일품목 운송 문의
        </a>
      </div>
    </div>
  </div>

  <!-- 6. 마무리 전화 및 견적 CTA -->
  <section class="ydk-bottom-cta" style="padding: 28px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; text-align: center;">
    <h3 style="font-size: 1.3rem; color: #1e293b; margin-bottom: 8px;">
      정확한 맞춤 견적이 필요하신가요?
    </h3>
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 18px;">
      출발지와 도착지, 짐의 종류를 말씀해 주시면 가장 알뜰하고 정확한 확정 요금을 즉시 산출해 드립니다.
    </p>
    <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
      <a href="tel:<?= SITE_PHONE_TEL ?>" class="ui huge primary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="phone icon"></i> 전화 견적 상담 <?= SITE_PHONE ?>
      </a>
      <a href="<?= url('contents/online/contact_us.php') ?>" class="ui huge secondary button" style="font-weight: 700; border-radius: 30px; padding: 14px 28px;">
        <i class="edit outline icon"></i> 온라인 무료 견적 신청
      </a>
    </div>
  </section>

</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
