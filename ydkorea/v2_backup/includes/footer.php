<?php
/**
 * 용달코리아 v2 공통 푸터 템플릿 (PHP 7.4.33)
 */
if (!defined('BASE_URL')) {
    exit('Direct access not permitted');
}

// 방문자 카운터 기록 (PHP 7.4 호환)
$c_conn = @mysqli_connect('localhost', 'kch1414', 'tlssoehd00', 'kch1414');
if ($c_conn) {
    mysqli_set_charset($c_conn, 'utf8');
    $c_ip = mysqli_real_escape_string($c_conn, $_SERVER['REMOTE_ADDR'] ?? '');
    $c_ref = mysqli_real_escape_string($c_conn, $_SERVER['HTTP_REFERER'] ?? '');
    $c_today = date('Y-m-d');
    $c_chk = mysqli_query($c_conn, "SELECT acn_id FROM counter WHERE SUBSTRING(acn_datetime, 1, 10) = '{$c_today}' AND acn_ip = '{$c_ip}'");
    if ($c_chk && mysqli_num_rows($c_chk) < 1) {
        mysqli_query($c_conn, "INSERT INTO counter VALUES ('', NOW(), '{$c_ip}', '{$c_ref}')");
    }
    mysqli_close($c_conn);
}
?>

  <!-- 푸터 영역 -->
  <footer class="ydk-footer">
    <div class="ydk-container">
      <div class="ydk-footer-top">
        <div class="ydk-footer-brand">
          <div class="ydk-footer-brand-title"><?= e(SITE_NAME) ?></div>
          <div class="ydk-footer-info">
            상호 : <?= e(BIZ_NAME) ?> &nbsp;|&nbsp; 대표자 : <?= e(BIZ_CEO) ?> &nbsp;|&nbsp; 사업자등록번호 : <?= e(BIZ_NO) ?><br>
            통신판매업신고 : <?= e(BIZ_MAIL_ORDER) ?> &nbsp;|&nbsp; 대표전화 : <strong><?= e(SITE_PHONE) ?></strong> &nbsp;|&nbsp; 이메일 : <?= e(BIZ_EMAIL) ?><br>
            주소 : <?= e(BIZ_ADDRESS) ?>
          </div>
        </div>
        <div class="ydk-footer-bank">
          <div class="ydk-footer-bank-title">입금 계좌 안내</div>
          <div class="ydk-footer-bank-account">기업은행 281-042527-04-011</div>
          <div class="ydk-footer-bank-holder">예금주 : 용달코리아 (민경철)</div>
        </div>
      </div>

      <!-- 법적 중개자 면책 고지 (필수 유지) -->
      <div class="ydk-footer-disclaimer">
        <strong>[법적 고지]</strong> <?= e(LEGAL_DISCLAIMER) ?>
      </div>

      <div class="ydk-footer-copyright">
        Copyright &copy; 2004 - <?= date('Y') ?> <?= e(SITE_NAME) ?> All rights reserved.
      </div>
    </div>
  </footer>

  <!-- jQuery 3.7.1 CDN -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Fomantic-UI 2.9.4 JS CDN -->
  <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.4/dist/semantic.min.js"></script>
  <!-- App JS -->
  <script src="<?= url('assets/js/app.js') ?>"></script>

  <!-- Naver 공통 적용 스크립트 -->
  <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
  <script type="text/javascript">
    if (!wcs_add) var wcs_add = {};
    wcs_add["wa"] = "s_2cb6a2ac0ff9";
    if (!_nasa) var _nasa = {};
    if (window.wcs) {
      wcs.inflow();
      wcs_do(_nasa);
    }
  </script>

  <!-- Smartlog 스마트 로그 -->
  <script type="text/javascript">
    var hpt_info = {'_account': 'UHPT-16768'};
  </script>
  <script language="javascript" src="//a22.smlog.co.kr/smart.js" charset="utf-8"></script>
  <noscript><img src="//a22.smlog.co.kr/smart_bda.php?_account=16768" style="display:none;width:0;height:0;" border="0"/></noscript>

</body>
</html>
