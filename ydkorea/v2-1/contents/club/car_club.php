<?php
/**
 * 용달코리아 v2-1 차주회원 및 업체회원 모집안내
 * PHP 7.4.33 호환, Fomantic-UI 2.9.4 기반
 * 원본: main/car_club.html
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '차주회원 및 업체회원 모집안내';
$metaDescription = '용달코리아 전국 화물 네트워크 차주회원 및 업체회원 모집 안내. 직거래 배차 및 정회원 혜택, 등록비용, 표준약관 안내.';

require_once __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">

  <!-- 상단 브레드크럼 & 서브페이지 헤더 -->
  <header class="ydk-sub-header">
    <nav class="ydk-breadcrumb" aria-label="브레드크럼">
      <a href="<?= url() ?>"><i class="home icon"></i>홈</a>
      <span class="divider">/</span>
      <span class="active">차주회원 모집안내</span>
    </nav>
    <h1 class="ydk-page-title">
      <i class="truck icon" style="color: var(--ydk-primary); margin-right: 8px;"></i>
      차주회원 및 제휴 업체회원 모집안내
    </h1>
    <p class="ydk-page-desc">
      고객 전화를 차주님이 직접 수신하여 운송비와 시간을 직접 조율하는 직거래 화물 네트워크! 매출 향상과 공차율 해소를 위한 든든한 파트너가 되어 드립니다.
    </p>

    <!-- 탭 네비게이션 (안내 / 회원가입 폼) -->
    <div class="ui pointing secondary menu" style="margin-top: 20px; border-bottom: 2px solid var(--ydk-border-subtle);">
      <a class="active item" href="<?= url('contents/club/car_club.php') ?>" style="font-size: 16px; font-weight: 700; color: var(--ydk-primary);">
        <i class="info circle icon"></i> 회원 모집 및 혜택 안내
      </a>
      <a class="item" href="<?= url('contents/club/club.php') ?>" style="font-size: 16px; font-weight: 600; color: var(--ydk-text-muted);">
        <i class="edit outline icon"></i> 온라인 회원가입 신청
      </a>
    </div>
  </header>

  <!-- 1. 히어로 배너: 직거래 네트워크의 차별점 -->
  <section class="ydk-club-hero" aria-label="차주회원 핵심 가치">
    <div class="ydk-club-hero-inner">
      <div class="ydk-club-hero-badge">DIRECT NETWORK</div>
      <h2 class="ydk-club-hero-title">지역 차주와 고객의 1:1 직거래 배차 시스템</h2>
      <p class="ydk-club-hero-desc">
        용달코리아는 복잡한 콜센터 중개 수수료 방식 대신, 고객이 홈페이지에서 지역 차주님의 연락처를 확인하고 <strong>직접 통화하여 예약·운송</strong>하는 시스템을 운영합니다.
      </p>
      <div class="ydk-club-hero-actions">
        <a href="<?= url('contents/club/club.php') ?>" class="ui huge primary button" style="font-weight: 800; border-radius: 8px; box-shadow: 0 4px 14px rgba(37,99,235,0.3);">
          <i class="user plus icon"></i> 정회원 가입 신청하기
        </a>
        <a href="tel:16882407" class="ui huge basic inverted button" style="font-weight: 700; border-radius: 8px;">
          <i class="phone icon"></i> 가입 상담 문의: 1688-2407
        </a>
      </div>
    </div>
  </section>

  <!-- 2. 정회원 5대 핵심 혜택 안내 -->
  <section style="margin-bottom: 36px;" aria-label="정회원 가입 혜택">
    <div class="ydk-section-title-wrap" style="margin-bottom: 20px;">
      <h2 style="font-size: 22px; font-weight: 800; color: #1E293B; margin: 0;">
        <i class="star icon" style="color: #F59E0B;"></i> 정회원이 되면 운송 매출에 큰 힘이 되는 핵심 혜택
      </h2>
      <p style="font-size: 14px; color: var(--ydk-text-muted); margin: 6px 0 0 0;">
        차주님의 시간과 운행 패턴에 맞춘 가장 유연하고 자율적인 운송 환경을 지원합니다.
      </p>
    </div>

    <div class="ui stackable three column grid">
      <div class="column">
        <div class="ydk-feature-card">
          <div class="ydk-feature-icon" style="background-color: #EFF6FF; color: #2563EB;">
            <i class="phone volume icon"></i>
          </div>
          <h3 class="ydk-feature-title">1. 직접 통화 &amp; 운임 조절</h3>
          <p class="ydk-feature-desc">
            차주 개인이 고객 전화를 직접 받기 때문에 화물 작업 여건, 엘리베이터 유무 등에 따라 운송 시간과 적정 운송비를 고객과 직접 조절할 수 있습니다.
          </p>
        </div>
      </div>

      <div class="column">
        <div class="ydk-feature-card">
          <div class="ydk-feature-icon" style="background-color: #ECFDF5; color: #059669;">
            <i class="calendar check outline icon"></i>
          </div>
          <h3 class="ydk-feature-title">2. 하루 스케줄 맞춤 예약</h3>
          <p class="ydk-feature-desc">
            개인 차주의 당일 운행 동선과 예약 스케줄에 맞춰 필요한 시간대의 운송만을 선별하여 맞춤 예약을 잡을 수 있습니다.
          </p>
        </div>
      </div>

      <div class="column">
        <div class="ydk-feature-card">
          <div class="ydk-feature-icon" style="background-color: #FEF3C7; color: #D97706;">
            <i class="handshake outline icon"></i>
          </div>
          <h3 class="ydk-feature-title">3. 유휴 시간 운임 절충</h3>
          <p class="ydk-feature-desc">
            공차로 돌아오거나 일이 없는 한가한 시간대에는 고객과의 탄력적인 운송비 절충을 통해 공차율을 줄이고 추가 수익을 창출합니다.
          </p>
        </div>
      </div>

      <div class="column">
        <div class="ydk-feature-card">
          <div class="ydk-feature-icon" style="background-color: #F5F3FF; color: #7C3AED;">
            <i class="bolt icon"></i>
          </div>
          <h3 class="ydk-feature-title">4. 순번 없는 자율 수주</h3>
          <p class="ydk-feature-desc">
            일반 운송 사무실처럼 끝없는 배차 순번 대기 없이, 차주님에게 직접 걸려오는 고객 문의를 즉시 수주하여 일할 수 있습니다.
          </p>
        </div>
      </div>

      <div class="column">
        <div class="ydk-feature-card">
          <div class="ydk-feature-icon" style="background-color: #FEE2E2; color: #DC2626;">
            <i class="building outline icon"></i>
          </div>
          <h3 class="ydk-feature-title">5. 화물·용달 업체 연계</h3>
          <p class="ydk-feature-desc">
            용달/화물 전문 업체가 가입하시면 고객의 요청 시간에 맞춘 신속한 배차와 광범위한 전국 거점 네트워크 협업이 가능해집니다.
          </p>
        </div>
      </div>

      <div class="column">
        <div class="ydk-feature-card" style="border: 2px dashed #93C5FD; background-color: #F0F9FF;">
          <div class="ydk-feature-icon" style="background-color: #2563EB; color: #FFFFFF;">
            <i class="shield alternate icon"></i>
          </div>
          <h3 class="ydk-feature-title">안심 전국 네트워크</h3>
          <p class="ydk-feature-desc">
            20여 년간 구축된 전국 단위 화물 데이터베이스와 브랜드 인지도를 바탕으로 매일 안정적인 고객 유입을 지원합니다.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. 등록 비용 및 전용 계좌 안내 -->
  <section style="margin-bottom: 36px;" aria-label="등록 비용 및 입금 계좌">
    <div class="ui segment" style="border-radius: 12px; border: 1px solid #CBD5E1; padding: 28px; background: #F8FAFC;">
      <div class="ui two column stackable grid middle aligned">
        <div class="ten wide column">
          <h3 style="font-size: 19px; font-weight: 800; color: #1E293B; margin-top: 0; margin-bottom: 12px;">
            <i class="tags icon" style="color: var(--ydk-primary);"></i>
            정회원 등록 비용 안내 (1톤 기준)
          </h3>
          <table class="ui celled table unstackable" style="background: #FFFFFF;">
            <thead>
              <tr style="background: #F1F5F9;">
                <th style="font-size: 14px;">구분</th>
                <th style="font-size: 14px;">대상 지역</th>
                <th style="font-size: 14px; text-align: right;">월 회비 (1톤 기준)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>서울 지역</strong></td>
                <td>서울시 1개 구 관할</td>
                <td style="text-align: right;"><strong style="color: #2563EB; font-size: 16px;">월 30,000원</strong></td>
              </tr>
              <tr>
                <td><strong>수도권 지역</strong></td>
                <td>경기/인천 수도권 2개 지역</td>
                <td style="text-align: right;"><strong style="color: #2563EB; font-size: 16px;">월 60,000원</strong></td>
              </tr>
              <tr>
                <td><strong>광역시 및 거점</strong></td>
                <td>광역시 및 지방 핵심 거점</td>
                <td style="text-align: right;"><strong style="color: #2563EB; font-size: 16px;">월 70,000원</strong></td>
              </tr>
              <tr> 
				<td><strong>서울시 및 수도권</strong></td>
                <td>서울시 전구 및 수도권 일부</td>
                <td style="text-align: right;"><strong style="color: #2563EB; font-size: 16px;">월 250,000원</strong></td>
			  
			  
			  
			  
			  
			  </tr>
            </tbody>
          </table>

          <div class="ydk-bank-box" style="margin-top: 16px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 8px; padding: 14px 18px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <span class="ui blue label" style="font-size: 12px; font-weight: 700;">등록비 입금 계좌</span>
            <span style="font-size: 15px; font-weight: 700; color: #1E293B;">기업은행</span>
            <span style="font-size: 18px; font-weight: 800; color: #DC2626; letter-spacing: 0.5px;">010-8833-1412</span>
            <span style="font-size: 14px; color: #64748B;">(예금주 : 민경철)</span>
          </div>
        </div>

        <div class="six wide column center aligned" style="border-left: 1px dashed #CBD5E1;">
          <div style="font-size: 14px; color: var(--ydk-text-muted); margin-bottom: 6px;">
            차주회원 가입 및 제휴 상담
          </div>
          <div style="font-size: 26px; font-weight: 900; color: #DC2626; line-height: 1.2;">
            1688-2407
          </div>
          <div style="font-size: 18px; font-weight: 800; color: #1E293B; margin-top: 6px;">
            010-8833-1412
          </div>
          <p style="font-size: 13px; color: var(--ydk-text-muted); margin-top: 10px; line-height: 1.5;">
            지역 배차 및 상세 등록 절차가 궁금하시면 언제든지 편하게 문의해 주시기 바랍니다.
          </p>
          <a href="<?= url('contents/club/club.php') ?>" class="ui fluid primary button" style="margin-top: 14px; height: 46px; display: flex; align-items: center; justify-content: center; font-weight: 700;">
            <i class="pencil alternate icon"></i> 회원가입 신청하기
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. 공정거래위원회 표준약관 안내 (아코디언/스크롤 뷰어) -->
  <section style="margin-bottom: 40px;" aria-label="회원가입 표준약관">
    <div class="ui segment" style="border-radius: 12px; border: 1px solid var(--ydk-border-subtle); padding: 24px;">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; flex-wrap: wrap; gap: 8px;">
        <h3 style="font-size: 18px; font-weight: 800; color: #1E293B; margin: 0;">
          <i class="file text outline icon" style="color: var(--ydk-primary);"></i>
          공정거래위원회 표준약관 제10023호 및 사이트 이용약관
        </h3>
        <span style="font-size: 12px; color: var(--ydk-text-muted);">
          가입 전 약관을 반드시 정독하시기 바랍니다.
        </span>
      </div>

      <div class="ydk-terms-scroll-area">
        <p><strong>ydkorea.co.kr 웹사이트는 공정거래위원회에서 심의한 표준약관을 준수하고 있습니다.</strong></p>
        <p>&lt;공정거래위원회 표준약관 제10023호&gt;</p>

        <h4>제1조(목적)</h4>
        <p>이 약관은 ydkorea.co.kr에서 운영하는 ydkorea 웹사이트(이하 "사이트"라 한다)에서 제공하는 인터넷 관련 서비스(이하 "서비스"라 한다)를 이용함에 있어 사이트 이용자의 권리, 의무 및 책임사항을 규정함을 목적으로 합니다.</p>

        <h4>제2조(정의)</h4>
        <p>① "사이트" 란 ydkorea.co.kr이 서비스를 이용자에게 제공하기 위하여 컴퓨터 등 정보통신설비를 이용할 수 있도록 설정한 가상의 영업장을 말하며, 아울러 사이트 운영하는 사업자의 의미로도 사용합니다.<br>
        ② "이용자"란 "사이트"에 접속하여 이 약관에 따라 "사이트"가 제공하는 서비스를 받는 회원 및 비회원을 말합니다.<br>
        ③ "회원"이라 함은 "사이트"에 개인정보를 제공하여 회원등록을 한 자로서 "사이트"의 정보를 지속적으로 제공받으며 서비스를 계속적으로 이용할 수 있는 자를 말합니다.<br>
        ④ "비회원"이라 함은 회원에 가입하지 않고 "사이트"가 제공하는 서비스를 이용하는 자를 말합니다.</p>

        <h4>제3조(약관의 명시와 개정)</h4>
        <p>① "사이트"는 이 약관의 내용과 상호, 영업장 소재지, 대표자 성명, 사업자등록번호, 연락처 등을 이용자가 알 수 있도록 서비스 전면에 게시합니다.<br>
        ② "사이트"는 약관의 규제 등에 관한 법률, 전자상거래 등에서의 소비자보호에 관한 법률 등 관련 법령을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.</p>

        <h4>제4조(서비스의 제공 및 변경)</h4>
        <p>① "사이트"는 인터넷 관련 정보 및 화물 알선 플랫폼 서비스를 제공합니다.<br>
        ② "사이트"는 유료로 서비스를 제공하는 것을 원칙으로 하나, 일부 서비스에 한하여 무료로 제공되어질 수 있습니다.<br>
        ③ 서비스 이용은 연중무휴 1일 24시간을 원칙으로 하되, 시스템 보수나 천재지변 등 불가항력 시에는 제한될 수 있습니다.</p>

        <h4>제6조(회원가입)</h4>
        <p>이용자는 "사이트"가 정한 가입 양식에 따라 회원정보를 기입한 후 이 약관에 동의한다는 의사표시를 함으로써 회원가입을 신청합니다.</p>

        <h4>제9조(개인정보보호)</h4>
        <p>① "사이트"는 이용자의 정보수집 시 회원 관리에 필요한 최소한의 정보를 수집합니다. (성명, 회사명, 이메일, 전화번호, 휴대폰, 보유차량, 차량번호, 주소 등)<br>
        ② 제공된 개인정보는 회원의 동의 없이 목적 외의 이용이나 제3자에게 제공하지 않습니다.</p>

        <h4>제16조(재판권 및 준거법)</h4>
        <p><strong>① "사이트"의 회원과 고객 간의 운송 중 발생하는 손해, 운임 분쟁, 화물 파손 등에 관한 분쟁은 용달코리아에게 책임이 없으며 민형사상의 어떠한 내용도 고객과 회원이 상호 해결함을 원칙으로 합니다.</strong><br>
        ② "사이트"와 이용자 간에 발생한 전자거래 분쟁에 관한 소송은 민사소송법상의 관할법원에 제기합니다.<br>
        ③ "사이트"와 이용자 간에 제기된 전자거래 소송에는 한국법을 적용합니다.</p>
      </div>

      <!-- 약관 하단 동의 및 신청 바로가기 CTA -->
      <div style="margin-top: 24px; text-align: center; padding: 20px 0 8px 0; border-top: 1px solid var(--ydk-border-subtle);">
        <p style="font-size: 15px; color: #1E293B; font-weight: 600; margin-bottom: 16px;">
          위 약관에 동의하시고 정회원 등록을 희망하시는 차주 및 화물 운송 업체는 아래 가입 신청을 진행해 주세요.
        </p>
        <a href="<?= url('contents/club/club.php') ?>" class="ui huge primary button" style="min-width: 260px; font-weight: 800; border-radius: 8px;">
          <i class="check circle outline icon"></i> 회원가입 신청서 작성하기
        </a>
      </div>
    </div>
  </section>

</main>

<style>
/* 히어로 배너 */
.ydk-club-hero {
  background: linear-gradient(135deg, #1E3A8A 0%, #2563EB 60%, #1D4ED8 100%);
  border-radius: 14px;
  padding: 44px 32px;
  color: #FFFFFF;
  margin-bottom: 32px;
  box-shadow: 0 8px 24px rgba(37, 99, 235, 0.25);
}
.ydk-club-hero-badge {
  display: inline-block;
  background-color: #F59E0B;
  color: #1E293B;
  font-size: 11px;
  font-weight: 900;
  padding: 4px 12px;
  border-radius: 20px;
  letter-spacing: 0.8px;
  margin-bottom: 14px;
}
.ydk-club-hero-title {
  font-size: 28px;
  font-weight: 900;
  color: #FFFFFF;
  margin: 0 0 12px 0;
  line-height: 1.3;
}
.ydk-club-hero-desc {
  font-size: 16px;
  color: #DBEAFE;
  margin: 0 0 24px 0;
  line-height: 1.7;
  max-width: 800px;
}
.ydk-club-hero-actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

/* 혜택 카드 그리드 */
.ydk-feature-card {
  background-color: #FFFFFF;
  border: 1px solid var(--ydk-border-subtle);
  border-radius: 12px;
  padding: 24px;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: transform 0.2s, box-shadow 0.2s;
}
.ydk-feature-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.06);
}
.ydk-feature-icon {
  width: 48px;
  height: 48px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 16px;
}
.ydk-feature-title {
  font-size: 18px;
  font-weight: 800;
  color: #1E293B;
  margin: 0 0 10px 0;
}
.ydk-feature-desc {
  font-size: 14px;
  color: var(--ydk-text-muted);
  line-height: 1.65;
  margin: 0;
}

/* 약관 스크롤 뷰어 */
.ydk-terms-scroll-area {
  max-height: 260px;
  overflow-y: auto;
  border: 1px solid #E2E8F0;
  border-radius: 8px;
  background-color: #F8FAFC;
  padding: 20px;
  font-size: 13px;
  color: #475569;
  line-height: 1.7;
}
.ydk-terms-scroll-area h4 {
  color: #1E293B;
  font-size: 14px;
  margin: 16px 0 6px 0;
}
.ydk-terms-scroll-area p {
  margin-bottom: 8px;
}

@media (max-width: 768px) {
  .ydk-club-hero {
    padding: 28px 20px;
  }
  .ydk-club-hero-title {
    font-size: 22px;
  }
  .ydk-club-hero-desc {
    font-size: 14px;
  }
  .ydk-club-hero-actions .button {
    width: 100% !important;
    margin-bottom: 8px !important;
  }
}
</style>

<?php
require_once __DIR__ . '/../../includes/footer.php';
?>
