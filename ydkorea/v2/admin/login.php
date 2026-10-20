<?php
/**
 * 용달코리아 v2 관리자 로그인 화면 (PHP 7.4.33)
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// 이미 로그인된 경우 대시보드로 이동
if (!empty($_SESSION['ydk_admin_logged']) && $_SESSION['ydk_admin_logged'] === true) {
    header('Location: ' . url('admin/index.php'));
    exit;
}

$errorMessage = '';
$isLoggedOut = isset($_GET['logout']) && $_GET['logout'] === '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = trim($_POST['admin_id'] ?? '');
    $userPw = trim($_POST['admin_pw'] ?? '');

    // 임시 인증: admin / admin
    if ($userId === 'admin' && $userPw === 'admin') {
        $_SESSION['ydk_admin_logged'] = true;
        $_SESSION['ydk_admin_user'] = 'admin';
        $_SESSION['ydk_admin_login_at'] = date('Y-m-d H:i:s');

        header('Location: ' . url('admin/index.php'));
        exit;
    } else {
        $errorMessage = '아이디 또는 비밀번호가 올바르지 않습니다. (임시 계정: admin / admin)';
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>관리자 로그인 | <?= SITE_NAME ?></title>

  <!-- Fomantic-UI 2.9.4 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.4/dist/semantic.min.css">
  <!-- Pretendard Font -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css">
  <!-- Admin CSS -->
  <link rel="stylesheet" href="<?= url('admin/assets/css/admin.css') ?>">
</head>
<body class="ydk-login-body">

  <div class="ydk-login-box">
    <div class="ydk-login-header">
      <div style="font-size: 38px; color: var(--ydk-adm-primary); margin-bottom: 8px;">
        <i class="shield alternate icon"></i>
      </div>
      <h1 class="ydk-login-title"><?= SITE_NAME ?> 관리자</h1>
      <p class="ydk-login-sub">온라인 상담 및 사이트 운영 관리 시스템</p>
    </div>

    <?php if ($isLoggedOut): ?>
      <div class="ui positive mini message">
        <i class="check icon"></i> 안전하게 로그아웃되었습니다.
      </div>
    <?php endif; ?>

    <?php if (!empty($errorMessage)): ?>
      <div class="ui negative mini message">
        <i class="exclamation triangle icon"></i> <?= e($errorMessage) ?>
      </div>
    <?php endif; ?>

    <form class="ui form" method="post" action="<?= e($_SERVER['PHP_SELF']) ?>">
      <div class="field">
        <label for="admin_id" style="font-weight: 700; color: #334155;">관리자 아이디</label>
        <div class="ui left icon input" style="height: 46px;">
          <i class="user icon"></i>
          <input type="text" id="admin_id" name="admin_id" required autofocus placeholder="admin" value="admin">
        </div>
      </div>

      <div class="field" style="margin-top: 18px;">
        <label for="admin_pw" style="font-weight: 700; color: #334155;">비밀번호</label>
        <div class="ui left icon input" style="height: 46px;">
          <i class="lock icon"></i>
          <input type="password" id="admin_pw" name="admin_pw" required placeholder="admin" value="admin">
        </div>
        <div style="font-size: 13px; color: #64748B; margin-top: 6px;">
          ※ 개발/테스트용 임시 계정: <strong>admin / admin</strong>
        </div>
      </div>

      <div style="margin-top: 26px;">
        <button type="submit" class="ui fluid button" style="background-color: var(--ydk-adm-primary); color: #FFFFFF; height: 48px; font-size: 17px; font-weight: 700; border-radius: 8px;">
          <i class="sign in alternate icon"></i> 로그인
        </button>
      </div>

      <div style="text-align: center; margin-top: 20px;">
        <a href="<?= url() ?>" style="color: #64748B; font-size: 14px; text-decoration: none;">
          <i class="arrow left icon"></i> 홈페이지로 이동
        </a>
      </div>
    </form>
  </div>

</body>
</html>
