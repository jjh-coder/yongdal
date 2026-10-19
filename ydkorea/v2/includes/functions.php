<?php
/**
 * 용달코리아 v2 공통 헬퍼 함수 (PHP 7.4.33)
 */

/**
 * XSS 방지 출력 이스케이프
 */
function e($v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}

/**
 * 신규(v2) 절대경로 URL 생성
 */
function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * 기존 사이트 레거시 절대경로 URL 생성
 */
function legacy(string $path = ''): string
{
    return LEGACY_URL . '/' . ltrim($path, '/');
}
