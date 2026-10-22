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

/**
 * Mock 차주회원 JSON 파일 경로
 */
function get_mock_club_file_path(): string
{
    $dir = __DIR__ . '/../data';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    return $dir . '/club_mock.json';
}

/**
 * Mock 차주회원 데이터 로드
 */
function load_mock_clubs(): array
{
    $filePath = get_mock_club_file_path();
    if (file_exists($filePath)) {
        $json = file_get_contents($filePath);
        $data = json_decode($json, true);
        if (is_array($data)) {
            return $data;
        }
    }

    // 기본 샘플 데이터 (초기 차주회원 신청 예시)
    $defaultData = [
        [
            'id' => 1,
            'name' => '김영철',
            'c_name' => '마장개인용달',
            'e_mail' => 'kch1414@naver.com',
            'tel' => '02-2299-1234',
            'hp' => '010-8833-1412',
            'car' => '1톤 카고 (호루)',
            'car_no' => '서울 80 자 1412',
            'ad' => '서울시 성동구 마장로 42길',
            'fro' => "개인용달 15년 무사고 경력입니다.\n서울 성동/동대문/중구 위주로 활동 희망하며 원룸이사 및 일반 소형화물 전문입니다.",
            'status' => '승인',
            'admin_memo' => '등록비 입금확인 완료(기업은행). 성동구 관할 정회원 등록 배차 연결.',
            'client_ip' => '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
        ],
        [
            'id' => 2,
            'name' => '이종혁',
            'c_name' => '강남화물',
            'e_mail' => 'leejh@daum.net',
            'tel' => '031-755-9876',
            'hp' => '010-3456-7890',
            'car' => '1톤 파워리프트',
            'car_no' => '경기 83 바 5678',
            'ad' => '경기도 성남시 분당구 야탑동',
            'fro' => "리프트 차량으로 오토바이 탁송, 대형냉장고 및 무거운 악기/서버 운반 전문입니다.",
            'status' => '신청',
            'admin_memo' => '가입신청 접수됨. 등록비 입금 안내 문자 발송 완료.',
            'client_ip' => '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            'updated_at' => null
        ],
        [
            'id' => 3,
            'name' => '박동수',
            'c_name' => '인천개별화물',
            'e_mail' => 'parkds@gmail.com',
            'tel' => '032-888-4321',
            'hp' => '010-9876-1122',
            'car' => '5톤 윙탑',
            'car_no' => '인천 92 사 9988',
            'ad' => '인천광역시 남동구 논현동',
            'fro' => "인천/경기권 5톤 파레트 화물 전문입니다. 지게차 상하차 장거리 지방 운송 가능합니다.",
            'status' => '신청',
            'admin_memo' => '',
            'client_ip' => '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s', strtotime('-5 hours')),
            'updated_at' => null
        ]
    ];

    save_mock_clubs($defaultData);
    return $defaultData;
}

/**
 * Mock 차주회원 데이터 저장
 */
function save_mock_clubs(array $data): bool
{
    $filePath = get_mock_club_file_path();
    return (bool) file_put_contents($filePath, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

/**
 * 차주회원 신청 목록 조회 (검색 및 상태 필터링)
 */
function get_club_list(string $status = '', string $keyword = ''): array
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $sql = "SELECT * FROM club WHERE 1=1";
            $params = [];
            if ($status !== '' && in_array($status, ['신청', '승인', '보류', '탈퇴'])) {
                $sql .= " AND status = :status";
                $params[':status'] = $status;
            }
            if ($keyword !== '') {
                $sql .= " AND (name LIKE :kw OR c_name LIKE :kw OR tel LIKE :kw OR hp LIKE :kw OR car LIKE :kw OR car_no LIKE :kw OR ad LIKE :kw)";
                $params[':kw'] = '%' . $keyword . '%';
            }
            $sql .= " ORDER BY id DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $res = $stmt->fetchAll();
            if ($res !== false) {
                return $res;
            }
        } catch (\Throwable $e) {
            // DB 에러 시 Mock 데이터로 전환
        }
    }

    // Fallback Mock
    $list = load_mock_clubs();
    $result = [];
    foreach ($list as $item) {
        if ($status !== '' && ($item['status'] ?? '') !== $status) {
            continue;
        }
        if ($keyword !== '') {
            $matched = (mb_strpos($item['name'] ?? '', $keyword) !== false)
                || (mb_strpos($item['c_name'] ?? '', $keyword) !== false)
                || (mb_strpos($item['tel'] ?? '', $keyword) !== false)
                || (mb_strpos($item['hp'] ?? '', $keyword) !== false)
                || (mb_strpos($item['car'] ?? '', $keyword) !== false)
                || (mb_strpos($item['car_no'] ?? '', $keyword) !== false)
                || (mb_strpos($item['ad'] ?? '', $keyword) !== false);
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
 * 차주회원 단건 조회
 */
function get_club_by_id(int $id): ?array
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM club WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch();
            if ($row) {
                return $row;
            }
        } catch (\Throwable $e) {
            // DB 실패 시 Mock 진행
        }
    }

    $list = load_mock_clubs();
    foreach ($list as $item) {
        if ((int)($item['id'] ?? 0) === $id) {
            return $item;
        }
    }
    return null;
}

/**
 * 차주회원 신청 등록
 */
function insert_club_item(array $data): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $sql = "INSERT INTO club 
                    (name, c_name, e_mail, tel, hp, car, car_no, ad, fro, status, client_ip, created_at)
                    VALUES (:name, :c_name, :e_mail, :tel, :hp, :car, :car_no, :ad, :fro, '신청', :client_ip, NOW())";
            $stmt = $pdo->prepare($sql);
            $res = $stmt->execute([
                ':name' => $data['name'] ?? '',
                ':c_name' => $data['c_name'] ?? '',
                ':e_mail' => $data['e_mail'] ?? '',
                ':tel' => $data['tel'] ?? '',
                ':hp' => $data['hp'] ?? '',
                ':car' => $data['car'] ?? '',
                ':car_no' => $data['car_no'] ?? '',
                ':ad' => $data['ad'] ?? '',
                ':fro' => $data['fro'] ?? '',
                ':client_ip' => $data['client_ip'] ?? '',
            ]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // 테이블이 아직 없거나 에러인 경우 Mock으로 fallback
        }
    }

    $list = load_mock_clubs();
    $newId = 1;
    foreach ($list as $item) {
        if (($item['id'] ?? 0) >= $newId) {
            $newId = $item['id'] + 1;
        }
    }
    $newItem = [
        'id' => $newId,
        'name' => $data['name'] ?? '',
        'c_name' => $data['c_name'] ?? '',
        'e_mail' => $data['e_mail'] ?? '',
        'tel' => $data['tel'] ?? '',
        'hp' => $data['hp'] ?? '',
        'car' => $data['car'] ?? '',
        'car_no' => $data['car_no'] ?? '',
        'ad' => $data['ad'] ?? '',
        'fro' => $data['fro'] ?? '',
        'status' => '신청',
        'admin_memo' => '',
        'client_ip' => $data['client_ip'] ?? '',
        'created_at' => date('Y-m-d H:i:s')
    ];
    array_unshift($list, $newItem);
    save_mock_clubs($list);
    return true;
}

/**
 * 차주회원 상태 및 관리자 메모 수정
 */
function update_club_status(int $id, string $status, string $adminMemo): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE club SET status = :status, admin_memo = :memo, updated_at = NOW() WHERE id = :id");
            $res = $stmt->execute([
                ':status' => $status,
                ':memo' => $adminMemo,
                ':id' => $id
            ]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_clubs();
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
        save_mock_clubs($list);
        return true;
    }
    return false;
}

/**
 * 차주회원 삭제
 */
function delete_club_item(int $id): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("DELETE FROM club WHERE id = :id");
            $res = $stmt->execute([':id' => $id]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_clubs();
    $filtered = array_filter($list, function ($item) use ($id) {
        return (int)($item['id'] ?? 0) !== $id;
    });
    save_mock_clubs(array_values($filtered));
    return true;
}

/**
 * Mock 지역업체 JSON 파일 경로
 */
function get_mock_company_file_path(): string
{
    $dir = __DIR__ . '/../data';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    return $dir . '/company_mock.json';
}

/**
 * Mock 지역업체 데이터 로드
 */
function load_mock_companies(): array
{
    $filePath = get_mock_company_file_path();
    if (file_exists($filePath)) {
        $json = file_get_contents($filePath);
        $data = json_decode($json, true);
        if (is_array($data)) {
            return $data;
        }
    }

    // 기본 샘플 데이터
    $defaultData = [
        ['id' => '07', 'code' => 'code_001', 'name' => '용달코리아 본점', 'tel' => '1688-2404', 'detail' => '1톤, 1.4톤, 2.5톤, 5톤 / 이사 및 각종화물 운송'],
        ['id' => '07', 'code' => 'code_8', 'name' => '개인용달 8호점', 'tel' => '010-3781-3522', 'detail' => '1톤 / 용달이사 / 원, 투룸이사 / 용달화물'],
        ['id' => '11', 'code' => 'j1101', 'name' => '강남개인용달', 'tel' => '010-8833-1412', 'detail' => '강남구 원룸이사, 학생이사, 사무실 소형화물 전문'],
        ['id' => '11', 'code' => 'j1102', 'name' => '역삼화물', 'tel' => '02-555-1234', 'detail' => '테헤란로 기업 납품 및 1톤 탑차 방수 운송'],
        ['id' => '26', 'code' => 'j2601', 'name' => '마장개인용달', 'tel' => '02-2299-1234', 'detail' => '성동구 전지역 소형용달, 리프트차 운송 전문'],
        ['id' => '38', 'code' => 'j3801', 'name' => '분당개별화물', 'tel' => '031-755-9876', 'detail' => '성남/분당/판교 가구·가전 이사 및 기업물류'],
        ['id' => '59', 'code' => 'j5901', 'name' => '대전용달특송', 'tel' => '042-888-2404', 'detail' => '대전/세종 전지역 1톤~5톤 전국 리턴공차 연결'],
    ];

    save_mock_companies($defaultData);
    return $defaultData;
}

/**
 * Mock 지역업체 데이터 저장
 */
function save_mock_companies(array $data): bool
{
    $filePath = get_mock_company_file_path();
    return (bool) file_put_contents($filePath, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

/**
 * 관리자 지역별 업체 목록 조회
 */
function get_company_admin_list(string $areaId = '', string $keyword = ''): array
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $sql = "SELECT * FROM company WHERE 1=1";
            $params = [];
            if ($areaId !== '') {
                $sql .= " AND id = :id";
                $params[':id'] = $areaId;
            }
            if ($keyword !== '') {
                $sql .= " AND (name LIKE :kw OR tel LIKE :kw OR detail LIKE :kw OR code LIKE :kw)";
                $params[':kw'] = '%' . $keyword . '%';
            }
            $sql .= " ORDER BY id ASC, name ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $res = $stmt->fetchAll();
            if ($res !== false && count($res) > 0) {
                return $res;
            }
        } catch (\Throwable $e) {
            // DB 조회 실패 시 Mock fallback
        }
    }

    $list = load_mock_companies();
    $result = [];
    foreach ($list as $item) {
        if ($areaId !== '' && ($item['id'] ?? '') !== $areaId) {
            continue;
        }
        if ($keyword !== '') {
            $matched = (mb_strpos($item['name'] ?? '', $keyword) !== false)
                || (mb_strpos($item['tel'] ?? '', $keyword) !== false)
                || (mb_strpos($item['detail'] ?? '', $keyword) !== false)
                || (mb_strpos($item['code'] ?? '', $keyword) !== false);
            if (!$matched) {
                continue;
            }
        }
        $result[] = $item;
    }
    return $result;
}

/**
 * 단일 업체 조회
 */
function get_company_by_id_and_code(string $id, string $code): ?array
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM company WHERE id = :id AND code = :code LIMIT 1");
            $stmt->execute([':id' => $id, ':code' => $code]);
            $row = $stmt->fetch();
            if ($row) {
                return $row;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_companies();
    foreach ($list as $item) {
        if (($item['id'] ?? '') === $id && ($item['code'] ?? '') === $code) {
            return $item;
        }
    }
    return null;
}

/**
 * 지역 업체 등록
 */
function insert_company_item(array $data): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO company (id, code, name, tel, detail) VALUES (:id, :code, :name, :tel, :detail)");
            $res = $stmt->execute([
                ':id'     => $data['id'] ?? '',
                ':code'   => $data['code'] ?? '',
                ':name'   => $data['name'] ?? '',
                ':tel'    => $data['tel'] ?? '',
                ':detail' => $data['detail'] ?? '',
            ]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_companies();
    $newItem = [
        'id'     => $data['id'] ?? '',
        'code'   => $data['code'] ?? '',
        'name'   => $data['name'] ?? '',
        'tel'    => $data['tel'] ?? '',
        'detail' => $data['detail'] ?? '',
    ];
    $list[] = $newItem;
    save_mock_companies($list);
    return true;
}

/**
 * 지역 업체 수정
 */
function update_company_item(string $origId, string $origCode, array $data): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE company SET id = :new_id, code = :new_code, name = :name, tel = :tel, detail = :detail WHERE id = :orig_id AND code = :orig_code");
            $res = $stmt->execute([
                ':new_id'    => $data['id'] ?? $origId,
                ':new_code'  => $data['code'] ?? $origCode,
                ':name'      => $data['name'] ?? '',
                ':tel'       => $data['tel'] ?? '',
                ':detail'    => $data['detail'] ?? '',
                ':orig_id'   => $origId,
                ':orig_code' => $origCode,
            ]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_companies();
    $found = false;
    foreach ($list as &$item) {
        if (($item['id'] ?? '') === $origId && ($item['code'] ?? '') === $origCode) {
            $item['id'] = $data['id'] ?? $origId;
            $item['code'] = $data['code'] ?? $origCode;
            $item['name'] = $data['name'] ?? '';
            $item['tel'] = $data['tel'] ?? '';
            $item['detail'] = $data['detail'] ?? '';
            $found = true;
            break;
        }
    }
    if ($found) {
        save_mock_companies($list);
        return true;
    }
    return false;
}

/**
 * 지역 업체 삭제
 */
function delete_company_item(string $id, string $code): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("DELETE FROM company WHERE id = :id AND code = :code");
            $res = $stmt->execute([':id' => $id, ':code' => $code]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_companies();
    $filtered = array_filter($list, function ($item) use ($id, $code) {
        return !(($item['id'] ?? '') === $id && ($item['code'] ?? '') === $code);
    });
    save_mock_companies(array_values($filtered));
    return true;
}

/* ==========================================================================
   공지사항 (Notice) 데이터 관리 함수
   ========================================================================== */

function get_mock_notice_file_path(): string
{
    $dir = __DIR__ . '/../data';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    return $dir . '/notice_mock.json';
}

function load_mock_notices(): array
{
    $filePath = get_mock_notice_file_path();
    if (file_exists($filePath)) {
        $json = file_get_contents($filePath);
        $data = json_decode($json, true);
        if (is_array($data)) {
            return $data;
        }
    }
    return [];
}

function save_mock_notices(array $data): bool
{
    $filePath = get_mock_notice_file_path();
    return file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
}

function get_notice_list(string $keyword = '', int $limit = 0): array
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $sql = "SELECT * FROM notice WHERE 1=1";
            $params = [];
            if ($keyword !== '') {
                $sql .= " AND (title LIKE :kw OR content LIKE :kw OR author LIKE :kw)";
                $params[':kw'] = '%' . $keyword . '%';
            }
            $sql .= " ORDER BY is_pinned DESC, id DESC";
            if ($limit > 0) {
                $sql .= " LIMIT " . (int)$limit;
            }
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_notices();
    if ($keyword !== '') {
        $list = array_filter($list, function ($item) use ($keyword) {
            return (stripos($item['title'] ?? '', $keyword) !== false) ||
                   (stripos($item['content'] ?? '', $keyword) !== false) ||
                   (stripos($item['author'] ?? '', $keyword) !== false);
        });
    }

    usort($list, function ($a, $b) {
        $pinA = (int)($a['is_pinned'] ?? 0);
        $pinB = (int)($b['is_pinned'] ?? 0);
        if ($pinA !== $pinB) {
            return $pinB <=> $pinA;
        }
        return (int)($b['id'] ?? 0) <=> (int)($a['id'] ?? 0);
    });

    if ($limit > 0) {
        $list = array_slice($list, 0, $limit);
    }
    return array_values($list);
}

function get_notice_item(int $id, bool $increaseHit = false): ?array
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            if ($increaseHit) {
                $upStmt = $pdo->prepare("UPDATE notice SET hit = hit + 1 WHERE id = :id");
                $upStmt->execute([':id' => $id]);
            }
            $stmt = $pdo->prepare("SELECT * FROM notice WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch();
            if ($row) {
                return $row;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_notices();
    foreach ($list as &$item) {
        if ((int)($item['id'] ?? 0) === $id) {
            if ($increaseHit) {
                $item['hit'] = (int)($item['hit'] ?? 0) + 1;
                save_mock_notices($list);
            }
            return $item;
        }
    }
    return null;
}

function insert_notice_item(array $data): int
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO notice (title, content, author, hit, is_pinned, created_at, updated_at) 
                                   VALUES (:title, :content, :author, 0, :is_pinned, NOW(), NOW())");
            $res = $stmt->execute([
                ':title'     => $data['title'] ?? '',
                ':content'   => $data['content'] ?? '',
                ':author'    => $data['author'] ?? '관리자',
                ':is_pinned' => !empty($data['is_pinned']) ? 1 : 0,
            ]);
            if ($res) {
                return (int)$pdo->lastInsertId();
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_notices();
    $maxId = 0;
    foreach ($list as $item) {
        $cId = (int)($item['id'] ?? 0);
        if ($cId > $maxId) {
            $maxId = $cId;
        }
    }
    $newId = $maxId + 1;
    $now = date('Y-m-d H:i:s');
    $newItem = [
        'id'         => $newId,
        'title'      => $data['title'] ?? '',
        'content'    => $data['content'] ?? '',
        'author'     => $data['author'] ?? '관리자',
        'hit'        => 0,
        'is_pinned'  => !empty($data['is_pinned']) ? 1 : 0,
        'created_at' => $now,
        'updated_at' => $now,
    ];
    array_unshift($list, $newItem);
    save_mock_notices($list);
    return $newId;
}

function update_notice_item(int $id, array $data): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE notice SET title = :title, content = :content, author = :author, is_pinned = :is_pinned, updated_at = NOW() WHERE id = :id");
            $res = $stmt->execute([
                ':title'     => $data['title'] ?? '',
                ':content'   => $data['content'] ?? '',
                ':author'    => $data['author'] ?? '관리자',
                ':is_pinned' => !empty($data['is_pinned']) ? 1 : 0,
                ':id'        => $id,
            ]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_notices();
    $found = false;
    foreach ($list as &$item) {
        if ((int)($item['id'] ?? 0) === $id) {
            $item['title'] = $data['title'] ?? $item['title'];
            $item['content'] = $data['content'] ?? $item['content'];
            $item['author'] = $data['author'] ?? $item['author'];
            $item['is_pinned'] = !empty($data['is_pinned']) ? 1 : 0;
            $item['updated_at'] = date('Y-m-d H:i:s');
            $found = true;
            break;
        }
    }
    if ($found) {
        save_mock_notices($list);
        return true;
    }
    return false;
}

function delete_notice_item(int $id): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("DELETE FROM notice WHERE id = :id");
            $res = $stmt->execute([':id' => $id]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_notices();
    $filtered = array_filter($list, function ($item) use ($id) {
        return (int)($item['id'] ?? 0) !== $id;
    });
    save_mock_notices(array_values($filtered));
    return true;
}

/* ==========================================================================
   묻고답하기 (QA) 데이터 관리 함수
   ========================================================================== */

function get_mock_qa_file_path(): string
{
    $dir = __DIR__ . '/../data';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    return $dir . '/qa_mock.json';
}

function load_mock_qas(): array
{
    $filePath = get_mock_qa_file_path();
    if (file_exists($filePath)) {
        $json = file_get_contents($filePath);
        $data = json_decode($json, true);
        if (is_array($data)) {
            return $data;
        }
    }
    return [];
}

function save_mock_qas(array $data): bool
{
    $filePath = get_mock_qa_file_path();
    return file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
}

function get_qa_list(string $status = '', string $keyword = '', int $limit = 0): array
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $sql = "SELECT * FROM qa WHERE 1=1";
            $params = [];
            if ($status !== '') {
                $sql .= " AND status = :status";
                $params[':status'] = $status;
            }
            if ($keyword !== '') {
                $sql .= " AND (title LIKE :kw OR question LIKE :kw OR writer LIKE :kw OR phone LIKE :kw)";
                $params[':kw'] = '%' . $keyword . '%';
            }
            $sql .= " ORDER BY id DESC";
            if ($limit > 0) {
                $sql .= " LIMIT " . (int)$limit;
            }
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_qas();
    if ($status !== '') {
        $list = array_filter($list, function ($item) use ($status) {
            return ($item['status'] ?? '접수') === $status;
        });
    }
    if ($keyword !== '') {
        $list = array_filter($list, function ($item) use ($keyword) {
            return (stripos($item['title'] ?? '', $keyword) !== false) ||
                   (stripos($item['question'] ?? '', $keyword) !== false) ||
                   (stripos($item['writer'] ?? '', $keyword) !== false) ||
                   (stripos($item['phone'] ?? '', $keyword) !== false);
        });
    }

    usort($list, function ($a, $b) {
        return (int)($b['id'] ?? 0) <=> (int)($a['id'] ?? 0);
    });

    if ($limit > 0) {
        $list = array_slice($list, 0, $limit);
    }
    return array_values($list);
}

function get_qa_item(int $id, bool $increaseHit = false): ?array
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            if ($increaseHit) {
                $upStmt = $pdo->prepare("UPDATE qa SET hit = hit + 1 WHERE id = :id");
                $upStmt->execute([':id' => $id]);
            }
            $stmt = $pdo->prepare("SELECT * FROM qa WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch();
            if ($row) {
                return $row;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_qas();
    foreach ($list as &$item) {
        if ((int)($item['id'] ?? 0) === $id) {
            if ($increaseHit) {
                $item['hit'] = (int)($item['hit'] ?? 0) + 1;
                save_mock_qas($list);
            }
            return $item;
        }
    }
    return null;
}

function insert_qa_item(array $data): int
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO qa (title, writer, phone, email, password, is_secret, question, status, hit, created_at, updated_at) 
                                   VALUES (:title, :writer, :phone, :email, :password, :is_secret, :question, '접수', 0, NOW(), NOW())");
            $res = $stmt->execute([
                ':title'     => $data['title'] ?? '',
                ':writer'    => $data['writer'] ?? '',
                ':phone'     => $data['phone'] ?? null,
                ':email'     => $data['email'] ?? null,
                ':password'  => !empty($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : null,
                ':is_secret' => !empty($data['is_secret']) ? 1 : 0,
                ':question'  => $data['question'] ?? '',
            ]);
            if ($res) {
                return (int)$pdo->lastInsertId();
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_qas();
    $maxId = 0;
    foreach ($list as $item) {
        $cId = (int)($item['id'] ?? 0);
        if ($cId > $maxId) {
            $maxId = $cId;
        }
    }
    $newId = $maxId + 1;
    $now = date('Y-m-d H:i:s');
    $newItem = [
        'id'          => $newId,
        'title'       => $data['title'] ?? '',
        'writer'      => $data['writer'] ?? '',
        'phone'       => $data['phone'] ?? '',
        'email'       => $data['email'] ?? '',
        'password'    => !empty($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : '',
        'is_secret'   => !empty($data['is_secret']) ? 1 : 0,
        'question'    => $data['question'] ?? '',
        'answer'      => null,
        'answered_at' => null,
        'status'      => '접수',
        'hit'         => 0,
        'created_at'  => $now,
        'updated_at'  => $now,
    ];
    array_unshift($list, $newItem);
    save_mock_qas($list);
    return $newId;
}

function answer_qa_item(int $id, string $answer): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE qa SET answer = :answer, answered_at = NOW(), status = '답변완료', updated_at = NOW() WHERE id = :id");
            $res = $stmt->execute([
                ':answer' => $answer,
                ':id'     => $id,
            ]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_qas();
    $found = false;
    foreach ($list as &$item) {
        if ((int)($item['id'] ?? 0) === $id) {
            $item['answer'] = $answer;
            $item['answered_at'] = date('Y-m-d H:i:s');
            $item['status'] = '답변완료';
            $item['updated_at'] = date('Y-m-d H:i:s');
            $found = true;
            break;
        }
    }
    if ($found) {
        save_mock_qas($list);
        return true;
    }
    return false;
}

function delete_qa_item(int $id): bool
{
    $pdo = get_db_connection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("DELETE FROM qa WHERE id = :id");
            $res = $stmt->execute([':id' => $id]);
            if ($res) {
                return true;
            }
        } catch (\Throwable $e) {
            // Mock fallback
        }
    }

    $list = load_mock_qas();
    $filtered = array_filter($list, function ($item) use ($id) {
        return (int)($item['id'] ?? 0) !== $id;
    });
    save_mock_qas(array_values($filtered));
    return true;
}

