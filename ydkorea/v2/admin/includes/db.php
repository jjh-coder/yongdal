<?php
/**
 * 용달코리아 v2 관리자 DB 연동 헬퍼 (PHP 7.4.33, PDO)
 */
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

// 데이터베이스 설정 (호스팅 정보)
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'kch1414');
if (!defined('DB_PASS')) define('DB_PASS', 'tlssoehd00');
if (!defined('DB_NAME')) define('DB_NAME', 'kch1414');

/**
 * PDO DB 인스턴스 반환
 */
function get_db_connection()
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    try {
        if (!class_exists('PDO')) {
            return null;
        }
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (\Throwable $e) {
        // DB 연결 실패 시 null 반환 (Mock 스토어 연동)
        return null;
    }
}

/**
 * Mock JSON 파일 경로
 */
function get_mock_file_path(): string
{
    $dir = __DIR__ . '/../data';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    return $dir . '/consult_mock.json';
}

/**
 * Mock 데이터 로드 (DB 연결 실패 시 fallback)
 */
function load_mock_consults(): array
{
    $filePath = get_mock_file_path();
    if (file_exists($filePath)) {
        $json = file_get_contents($filePath);
        $data = json_decode($json, true);
        if (is_array($data)) {
            return $data;
        }
    }

    // 기본 샘플 데이터
    $defaultData = [
        [
            'id' => 1,
            'name' => '김철수',
            'tel' => '010-1234-5678',
            'email' => 'kim@example.com',
            'move_date' => date('Y-m-d', strtotime('+2 days')),
            'car_type' => '1t_cargo',
            'start_area' => '서울 성동구 마장동',
            'end_area' => '경기 성남시 분당구',
            'story' => "소형 가전(냉장고 소형, 세탁기) 및 박스 5개 운송입니다.\n엘리베이터 양쪽 다 있습니다.",
            'status' => '접수',
            'admin_memo' => '',
            'client_ip' => '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 2,
            'name' => '이영희',
            'tel' => '010-9876-5432',
            'email' => 'lee@test.com',
            'move_date' => date('Y-m-d', strtotime('+3 days')),
            'car_type' => 'room_move',
            'start_area' => '서울 마포구 공덕동',
            'end_area' => '서울 관악구 신림동',
            'story' => "원룸 이사 견적 문의드립니다.\n침대 매트리스(슈퍼싱글) 1개, 책상, 옷박스 6개 정도입니다. 기사님 도움 필요합니다.",
            'status' => '상담중',
            'admin_memo' => '10/20 11:30 1차 통화 완료, 단가 12만원 안내 후 일정 조율 중',
            'client_ip' => '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
        ],
        [
            'id' => 3,
            'name' => '박대표',
            'tel' => '010-5555-7777',
            'email' => 'park@corp.co.kr',
            'move_date' => date('Y-m-d', strtotime('+5 days')),
            'car_type' => '5t_cargo',
            'start_area' => '인천 남동공단',
            'end_area' => '충남 천안시 서북구',
            'story' => "공장 자재 파레트 4개 운송 건입니다. 지게차 상하차 가능합니다.",
            'status' => '배차완료',
            'admin_memo' => '배차 완료: 인천 전담 차주 김기사님 연결 완료',
            'client_ip' => '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
        ],
        [
            'id' => 4,
            'name' => '정민우',
            'tel' => '010-3333-2222',
            'email' => '',
            'move_date' => date('Y-m-d'),
            'car_type' => '1t_lift',
            'start_area' => '서울 강남구 역삼동',
            'end_area' => '경기 용인시 수지구',
            'story' => "오토바이(250cc) 1대 탁송 문의합니다. 리프트차로 안전하게 운송 부탁드립니다.",
            'status' => '접수',
            'admin_memo' => '',
            'client_ip' => '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s', strtotime('-30 minutes'))
        ],
    ];

    save_mock_consults($defaultData);
    return $defaultData;
}

/**
 * Mock 데이터 저장
 */
function save_mock_consults(array $data): bool
{
    $filePath = get_mock_file_path();
    return (bool) file_put_contents($filePath, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

/**
 * 온라인 상담 내역 목록 조회 (검색 및 필터링 지원)
 */
function get_consult_list(string $status = '', string $keyword = ''): array
{
    $pdo = get_db_connection();
    if ($pdo) {
        $sql = "SELECT * FROM ydk_online_consult WHERE 1=1";
        $params = [];
        if ($status !== '' && in_array($status, ['접수', '상담중', '배차완료', '취소'])) {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }
        if ($keyword !== '') {
            $sql .= " AND (name LIKE :kw OR tel LIKE :kw OR start_area LIKE :kw OR end_area LIKE :kw)";
            $params[':kw'] = '%' . $keyword . '%';
        }
        $sql .= " ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll() ?: [];
    }

    // Fallback Mock
    $list = load_mock_consults();
    $result = [];
    foreach ($list as $item) {
        if ($status !== '' && ($item['status'] ?? '') !== $status) {
            continue;
        }
        if ($keyword !== '') {
            $matched = (mb_strpos($item['name'] ?? '', $keyword) !== false)
                || (mb_strpos($item['tel'] ?? '', $keyword) !== false)
                || (mb_strpos($item['start_area'] ?? '', $keyword) !== false)
                || (mb_strpos($item['end_area'] ?? '', $keyword) !== false);
            if (!$matched) {
                continue;
            }
        }
        $result[] = $item;
    }

    usort($result, function ($a, $b) {
        return ($b['id'] ?? 0) <=> ($a['id'] ?? 0);
    });

    return $result;
}

/**
 * 온라인 상담 단건 조회
 */
function get_consult_by_id(int $id): ?array
{
    $pdo = get_db_connection();
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM ydk_online_consult WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    $list = load_mock_consults();
    foreach ($list as $item) {
        if ((int)($item['id'] ?? 0) === $id) {
            return $item;
        }
    }
    return null;
}

/**
 * 온라인 상담 상태 및 관리자 메모 수정
 */
function update_consult_status(int $id, string $status, string $adminMemo): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        $stmt = $pdo->prepare("UPDATE ydk_online_consult SET status = :status, admin_memo = :memo WHERE id = :id");
        return $stmt->execute([
            ':status' => $status,
            ':memo' => $adminMemo,
            ':id' => $id
        ]);
    }

    $list = load_mock_consults();
    $found = false;
    foreach ($list as &$item) {
        if ((int)($item['id'] ?? 0) === $id) {
            $item['status'] = $status;
            $item['admin_memo'] = $adminMemo;
            $item['updated_at'] = date('Y-m-d H:i:s');
            $found = true;
            break;
        }
    }
    if ($found) {
        save_mock_consults($list);
        return true;
    }
    return false;
}

/**
 * 신규 온라인 상담 등록
 */
function insert_consult_item(array $data): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        $sql = "INSERT INTO ydk_online_consult 
                (name, tel, email, move_date, car_type, start_area, end_area, story, status, client_ip, created_at)
                VALUES (:name, :tel, :email, :move_date, :car_type, :start_area, :end_area, :story, '접수', :client_ip, NOW())";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'] ?? '',
            ':tel' => $data['tel'] ?? '',
            ':email' => $data['email'] ?? '',
            ':move_date' => !empty($data['move_date']) ? $data['move_date'] : null,
            ':car_type' => $data['car_type'] ?? '',
            ':start_area' => $data['start_area'] ?? '',
            ':end_area' => $data['end_area'] ?? '',
            ':story' => $data['story'] ?? '',
            ':client_ip' => $data['client_ip'] ?? '',
        ]);
    }

    $list = load_mock_consults();
    $newId = 1;
    foreach ($list as $item) {
        if (($item['id'] ?? 0) >= $newId) {
            $newId = $item['id'] + 1;
        }
    }
    $newItem = [
        'id' => $newId,
        'name' => $data['name'] ?? '',
        'tel' => $data['tel'] ?? '',
        'email' => $data['email'] ?? '',
        'move_date' => $data['move_date'] ?? '',
        'car_type' => $data['car_type'] ?? '',
        'start_area' => $data['start_area'] ?? '',
        'end_area' => $data['end_area'] ?? '',
        'story' => $data['story'] ?? '',
        'status' => '접수',
        'admin_memo' => '',
        'client_ip' => $data['client_ip'] ?? '',
        'created_at' => date('Y-m-d H:i:s')
    ];
    array_unshift($list, $newItem);
    save_mock_consults($list);
    return true;
}
