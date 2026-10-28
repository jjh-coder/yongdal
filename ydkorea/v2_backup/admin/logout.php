<?php
/**
 * 용달코리아 v2 관리자 로그아웃 처리 (PHP 7.4.33)
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// 관리자 세션 파기
unset($_SESSION['ydk_admin_logged']);
unset($_SESSION['ydk_admin_user']);
unset($_SESSION['ydk_admin_login_at']);

$loginUrl = url('admin/login.php?logout=1');
header("Location: {$loginUrl}");
exit;
