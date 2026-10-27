<?php
/**
 * 용달코리아 v2 사이트 설정 파일 (PHP 7.4.33)
 */

// 사이트 URL 설정 (루트 승격 시 '' 로 변경)
define('BASE_URL', '/v2-1');

// 대표 연락처 정보
define('SITE_PHONE', '1688-2404');
define('SITE_PHONE_TEL', '16882404');
define('SITE_NAME', '용달코리아');

// 기존 사이트(비변경 영역: /main, /bbs, /images 등) 절대경로
define('LEGACY_URL', '');

// 사업자 및 법적 정보
define('BIZ_NAME', '용달코리아 [관허4042]');
define('BIZ_CEO', '민경철');
define('BIZ_NO', '206-01-76008');
define('BIZ_MAIL_ORDER', '제2009-서울성동-0009호');
define('BIZ_ADDRESS', '서울 성동구 마장로42길 14 (마장동, 세림상가301호)');
define('BIZ_EMAIL', 'kch1414@ydkorea.co.kr');
define('BIZ_BANK', '기업은행 : 281-042527-04-011 (예금주 : 용달코리아 / 민경철)');

// 알림 메일 발송 설정 (기존 main/formmail_01.php, formmail_1.php 연동)
define('ADMIN_NOTIFY_EMAIL', 'kch1412@naver.com'); // 상담 및 회원가입 알림을 수신할 관리자 이메일
define('MAIL_FROM_EMAIL', 'kch1414@ydkorea.co.kr');  // 시스템 발신용 이메일

// 법적 고지 (중개자 면책 고지 문구)
define('LEGAL_DISCLAIMER', '용달코리아는 통신판매 주선업(중개자)이므로 화물 운송 중에 발생하는 사고는 운송 당사자와 화주의 책임이므로 그 책임에 대해서는 민, 형사상의 책임을 지지 않습니다.');
