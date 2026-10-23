<?php
/**
 * 용달코리아 v2-1 지점 데이터 조회 및 레거시 연동 헬퍼 (PHP 7.4.33)
 * 대상 경로: /v2-1/contents/company/jijum/jijum_helper.php
 */

require_once __DIR__ . '/../../../includes/config.php';
require_once __DIR__ . '/../../../includes/functions.php';
require_once __DIR__ . '/../../../admin/includes/db.php';

/**
 * 지점 상세 정보 조회
 * 1. DB (company 테이블) 우선 조회
 * 2. 레거시 /jijum/{code}.html 정적 파일 파싱
 * 3. Mock Fallback
 */
function get_jijum_detail(string $code): ?array
{
    $code = trim($code);
    if ($code === '') {
        return null;
    }

    // 보안: 파일 경로 조작(Directory Traversal) 방지 - 영문, 숫자, 밑줄, 하이픈만 허용
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $code)) {
        return null;
    }

    $dbItem = null;
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM company WHERE code = :code LIMIT 1");
            $stmt->execute([':code' => $code]);
            $dbItem = $stmt->fetch();
        } catch (\Throwable $e) {
            $dbItem = null;
        }
    }

    // 2. 레거시 HTML 파일 파싱 시도
    $htmlItem = parse_legacy_jijum_html($code);

    // 데이터 병합 (DB 정보 우선, 빈 필드는 레거시 HTML 정보로 보완)
    if ($dbItem || $htmlItem) {
        $rawName = $dbItem['name'] ?? ($htmlItem['name'] ?? '용달 전문점');
        // 상호명에서 HTML 태그 제거
        $name = trim(strip_tags($rawName));

        $owner = $htmlItem['owner'] ?? '';
        if (empty($owner) && !empty($dbItem['owner'])) {
            $owner = trim(strip_tags($dbItem['owner']));
        }

        $rawTel = !empty($dbItem['tel']) ? $dbItem['tel'] : ($htmlItem['tel'] ?? SITE_PHONE);
        $tel = trim(strip_tags($rawTel));
        $telClean = preg_replace('/[^0-9]/', '', $tel) ?: SITE_PHONE_TEL;

        $car = !empty($dbItem['car']) ? $dbItem['car'] : ($htmlItem['car'] ?? '1톤 카고 / 탑차 / 리프트');
        $car = trim(strip_tags($car));

        $rawStory = !empty($dbItem['detail']) ? $dbItem['detail'] : ($htmlItem['story'] ?? '');
        $story = trim(strip_tags($rawStory));
        if (empty($story)) {
            $story = "항상 초심의 자세로 최선을 다하고 정성껏 운송을 약속드립니다.\n용달화물 / 용달이사 / 원룸이사 / 학생이사 / 소형화물 책임운송";
        }

        // 줄바꿈 기준으로 배열 분리 (단락형 UI 렌더링용)
        $storyLines = array_values(array_filter(
            array_map('trim', explode("\n", str_replace(["\r\n", "\r"], "\n", $story))),
            fn($line) => $line !== ''
        ));

        return [
            'code'        => $code,
            'name'        => $name ?: '용달 전문점',
            'owner'       => $owner ?: '전문 차주',
            'tel'         => $tel ?: SITE_PHONE,
            'tel_clean'   => $telClean,
            'car'         => $car,
            'story'       => $story,
            'story_lines' => $storyLines,
            'area_id'     => $dbItem['id'] ?? '',
            'source'      => $dbItem ? 'db' : 'legacy_html',
        ];
    }

    // 3. Fallback 기본 지점 정보
    return [
        'code'        => $code,
        'name'        => '용달코리아 지정 우수 협력점',
        'owner'       => '지정 전문기사',
        'tel'         => SITE_PHONE,
        'tel_clean'   => SITE_PHONE_TEL,
        'car'         => '1톤 용달 / 1.4톤 / 리프트 / 탑차',
        'story'       => "용달코리아 전국 네트워크에 등록된 정식 관허 화물 운송 지점입니다.\n신속하고 안전한 원룸이사, 학생이사, 소형화물 직거래 배차를 지원합니다.",
        'story_lines' => [
            '용달코리아 전국 화물 네트워크 정식 등록 우수 지점',
            '원룸이사 / 학생이사 / 소형화물 / 오피스텔 이사 전문',
            '안전하고 친절한 직거래 운송 상담'
        ],
        'area_id'     => '07',
        'source'      => 'fallback',
    ];
}

/**
 * /jijum/{code}.html 레거시 HTML 파일 파싱
 */
function parse_legacy_jijum_html(string $code): ?array
{
    // 루트 경로 기준 jijum 디렉토리 탐색
    $possiblePaths = [
        __DIR__ . '/../../../../jijum/' . $code . '.html',
        $_SERVER['DOCUMENT_ROOT'] . '/jijum/' . $code . '.html',
        dirname(__DIR__, 4) . '/jijum/' . $code . '.html',
    ];

    $filePath = null;
    foreach ($possiblePaths as $path) {
        if (file_exists($path)) {
            $filePath = $path;
            break;
        }
    }

    if (!$filePath) {
        return null;
    }

    $rawContent = @file_get_contents($filePath);
    if ($rawContent === false || $rawContent === '') {
        return null;
    }

    // 인코딩 판별 및 UTF-8 변환
    $content = convert_to_utf8($rawContent);

    $name = '';
    $owner = '';
    $tel = '';
    $car = '';
    $story = '';

    // 상호 추출
    if (preg_match('/상\s*호\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/is', $content, $m)) {
        $name = clean_table_cell($m[1]);
    }

    // 성명 추출
    if (preg_match('/성\s*명\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/is', $content, $m)) {
        $owner = clean_table_cell($m[1]);
    }

    // 연락처 추출
    if (preg_match('/연락처\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/is', $content, $m)) {
        $tel = clean_table_cell($m[1]);
    }

    // 보유차량 추출
    if (preg_match('/보유차량\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/is', $content, $m)) {
        $car = clean_table_cell($m[1]);
    }

    // 상세 내용(colspan=2 영역) 추출
    if (preg_match('/<tr[^>]*>\s*<td[^>]*colspan=["\']?2["\']?[^>]*>(.*?)<\/td>\s*<\/tr>/is', $content, $m)) {
        $rawStory = $m[1];
        // 줄바꿈 태그 변환
        $rawStory = preg_replace('/<br\s*\/?>/i', "\n", $rawStory);
        // 이미지 태그는 글머리 기호(• )로 대체
        $rawStory = preg_replace('/<img[^>]*>/i', '• ', $rawStory);
        // HTML 태그 제거
        $story = clean_table_cell($rawStory);
    }

    if (empty($name) && empty($tel)) {
        return null;
    }

    return [
        'name'  => $name,
        'owner' => $owner,
        'tel'   => $tel,
        'car'   => $car,
        'story' => $story,
    ];
}

/**
 * 인코딩 감지 및 UTF-8 변환
 * UTF-16BE BOM, UTF-16LE BOM, EUC-KR, CP949 대응
 */
function convert_to_utf8(string $bytes): string
{
    $len = strlen($bytes);
    if ($len >= 2) {
        $b0 = ord($bytes[0]);
        $b1 = ord($bytes[1]);

        // UTF-16BE BOM: FE FF
        if ($b0 === 0xFE && $b1 === 0xFF) {
            $converted = @mb_convert_encoding(substr($bytes, 2), 'UTF-8', 'UTF-16BE');
            if ($converted !== false) return $converted;
        }

        // UTF-16LE BOM: FF FE
        if ($b0 === 0xFF && $b1 === 0xFE) {
            $converted = @mb_convert_encoding(substr($bytes, 2), 'UTF-8', 'UTF-16LE');
            if ($converted !== false) return $converted;
        }
    }

    // 이미 UTF-8인지 확인
    if (mb_check_encoding($bytes, 'UTF-8')) {
        return $bytes;
    }

    // EUC-KR / CP949 변환 시도
    $converted = @mb_convert_encoding($bytes, 'UTF-8', 'CP949');
    if ($converted !== false && mb_check_encoding($converted, 'UTF-8')) {
        return $converted;
    }

    return @mb_convert_encoding($bytes, 'UTF-8', 'EUC-KR') ?: $bytes;
}

/**
 * 테이블 셀 텍스트 정제
 */
function clean_table_cell(string $html): string
{
    // HTML 엔티티 치환
    $text = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
    $text = str_replace(['&nbsp;', '&#160;'], ' ', $text);
    // 태그 제거
    $text = strip_tags($text);
    // 연속 공백 및 다듬기
    $lines = explode("\n", str_replace(["\r\n", "\r"], "\n", $text));
    $cleanedLines = [];
    foreach ($lines as $line) {
        $trimmed = trim(preg_replace('/[ \t]+/', ' ', $line));
        if ($trimmed !== '') {
            $cleanedLines[] = $trimmed;
        }
    }
    return implode("\n", $cleanedLines);
}

/**
 * 전체 지점 파일 목록 검색
 */
function get_all_jijum_list(): array
{
    $possibleDirs = [
        __DIR__ . '/../../../../jijum',
        $_SERVER['DOCUMENT_ROOT'] . '/jijum',
        dirname(__DIR__, 4) . '/jijum',
    ];

    $jijumDir = null;
    foreach ($possibleDirs as $dir) {
        if (is_dir($dir)) {
            $jijumDir = $dir;
            break;
        }
    }

    if (!$jijumDir) {
        return [];
    }

    $files = @glob($jijumDir . '/*.html');
    if (!$files) {
        return [];
    }

    $list = [];
    foreach ($files as $f) {
        $base = basename($f, '.html');
        $item = get_jijum_detail($base);
        if ($item) {
            $list[] = $item;
        }
    }

    return $list;
}
