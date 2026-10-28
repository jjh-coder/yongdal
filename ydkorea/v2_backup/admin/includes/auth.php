<?php
/**
 * 용달코리아 v2 관리자 세션 인증 미들웨어 (PHP 7.4.33)
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

// 비로그인 상태일 경우 로그인 페이지로 리다이렉트
if (empty($_SESSION['ydk_admin_logged']) || $_SESSION['ydk_admin_logged'] !== true) {
    $loginUrl = url('admin/login.php');
    header("Location: {$loginUrl}");
    exit;
}
