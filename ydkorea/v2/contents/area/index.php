<?php
/**
 * 용달코리아 v2 지역별 운송 정보 인덱스 (기본 01 서울·수도권으로 리다이렉트)
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

header('Location: ' . url('contents/area/area_info_01.php'), true, 301);
exit;
