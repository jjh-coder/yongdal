-- ========================================================
-- 용달코리아(ydkorea) v2-1 공통 코드 관리(Code Management) 테이블 스키마
-- MySQL / MariaDB (PHP 7.4.33 호환)
-- ========================================================

-- 1. 코드 그룹(대분류) 테이블
CREATE TABLE IF NOT EXISTS `code_group` (
  `group_code` VARCHAR(50) NOT NULL COMMENT '그룹 코드 (영문 대문자/언더바, 예: CAR_TYPE)',
  `group_name` VARCHAR(100) NOT NULL COMMENT '그룹 코드명 (한글 설명, 예: 차량 종류)',
  `description` VARCHAR(255) DEFAULT NULL COMMENT '그룹 상세 설명',
  `is_use` CHAR(1) NOT NULL DEFAULT 'Y' COMMENT '사용 여부 (Y: 사용, N: 미사용)',
  `sort_order` INT NOT NULL DEFAULT 0 COMMENT '정렬 순서 (작을수록 상위)',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일시',
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '수정일시',
  PRIMARY KEY (`group_code`),
  INDEX `idx_group_sort` (`sort_order` ASC, `group_code` ASC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='공통 코드 그룹 (대분류) 테이블';

-- 2. 세부 코드(상세) 테이블
CREATE TABLE IF NOT EXISTS `code_detail` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '세부 코드 고유 번호',
  `group_code` VARCHAR(50) NOT NULL COMMENT '소속 그룹 코드 (code_group.group_code 참조)',
  `code_value` VARCHAR(50) NOT NULL COMMENT '코드값 (예: 1t_cargo, 접수, seoul 등)',
  `code_name` VARCHAR(100) NOT NULL COMMENT '코드 표시명 (예: 1톤 일반 카고)',
  `sort_order` INT NOT NULL DEFAULT 0 COMMENT '정렬 순서 (작을수록 상위)',
  `is_use` CHAR(1) NOT NULL DEFAULT 'Y' COMMENT '사용 여부 (Y: 사용, N: 미사용)',
  `extra_val_1` VARCHAR(255) DEFAULT NULL COMMENT '추가 속성값 1 (예: 뱃지 색상, 아이콘 클래스 등)',
  `extra_val_2` VARCHAR(255) DEFAULT NULL COMMENT '추가 속성값 2 (예: 보조 설명, 배차 가중치 등)',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일시',
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '수정일시',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_group_code_value` (`group_code`, `code_value`),
  INDEX `idx_detail_group_sort` (`group_code`, `sort_order` ASC, `id` ASC),
  CONSTRAINT `fk_code_detail_group` FOREIGN KEY (`group_code`) 
    REFERENCES `code_group` (`group_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='공통 세부 코드 (상세) 테이블';

-- --------------------------------------------------------
-- 초기 기본 그룹 코드 데이터 등록
-- --------------------------------------------------------
INSERT INTO `code_group` (`group_code`, `group_name`, `description`, `is_use`, `sort_order`) VALUES
('CAR_TYPE', '화물 차종 구분', '용달코리아에서 취급하는 화물 및 용달 차량 라인업', 'Y', 10),
('MOVE_TYPE', '이사 서비스 종류', '가정·원룸·사무실·특수 이사 상품 분류', 'Y', 20),
('CONSULT_STATUS', '온라인 상담 진행 상태', '온라인 견적 문의 처리 프로세스 단계', 'Y', 30),
('CLUB_STATUS', '차주회원 상태', '차주 회원가입 심사 및 승인 상태', 'Y', 40),
('REGION_AREA', '전국 운송 권역 구분', '전국 5대 권역 및 거점 분류', 'Y', 50)
ON DUPLICATE KEY UPDATE `group_name` = VALUES(`group_name`), `description` = VALUES(`description`);

-- --------------------------------------------------------
-- 초기 세부 코드 데이터 등록 (CAR_TYPE: 차종)
-- --------------------------------------------------------
INSERT INTO `code_detail` (`group_code`, `code_value`, `code_name`, `sort_order`, `is_use`, `extra_val_1`, `extra_val_2`) VALUES
('CAR_TYPE', '1t_cargo', '1톤 일반 카고 (기본 용달)', 10, 'Y', 'truck', '소형 화물/원룸/학생이사 최적'),
('CAR_TYPE', '1t_top', '1톤 탑차 (방수·안심 화물)', 20, 'Y', 'boxes', '눈·비 기상악화 안심 적재'),
('CAR_TYPE', '1t_lift', '1톤 리프트차 (중량물 전용)', 30, 'Y', 'dolly', '오토바이, 피아노, 의료기, 대형 가전'),
('CAR_TYPE', '1.4t_cargo', '1.4톤 화물 트럭', 40, 'Y', 'truck', '1톤 초과 여유 적재'),
('CAR_TYPE', '2.5t_cargo', '2.5톤 중형 화물', 50, 'Y', 'truck moving', '투룸/중소기업 사무실 이전'),
('CAR_TYPE', '3.5t_wing', '3.5톤 윙탑 (파레트 6개)', 60, 'Y', 'warehouse', '지게차 상하차 신속 물류'),
('CAR_TYPE', '5t_cargo', '5톤 대형 화물', 70, 'Y', 'truck', '공장 원자재, 대용량 화물'),
('CAR_TYPE', '5t_wing', '5톤축 윙탑 (파레트 12개)', 80, 'Y', 'warehouse', '기업 정기 물류/장거리 독차')
ON DUPLICATE KEY UPDATE `code_name` = VALUES(`code_name`), `sort_order` = VALUES(`sort_order`);

-- --------------------------------------------------------
-- 초기 세부 코드 데이터 등록 (MOVE_TYPE: 이사 종류)
-- --------------------------------------------------------
INSERT INTO `code_detail` (`group_code`, `code_value`, `code_name`, `sort_order`, `is_use`, `extra_val_1`, `extra_val_2`) VALUES
('MOVE_TYPE', 'simple_trans', '단순 차량 운송', 10, 'Y', 'shipping fast', '차량만 대절, 고객 직접 상하차 (알뜰운송)'),
('MOVE_TYPE', 'room_mov', '원룸·소형 이사', 20, 'Y', 'home', '기사 1인 고객 함께 작업 (1톤 기준)'),
('MOVE_TYPE', 'gen_mov', '일반 이사', 30, 'Y', 'dolly flatbed', '기사+전문인부 현장 투입 실내 운반'),
('MOVE_TYPE', 'half_pack', '반포장 이사', 40, 'Y', 'box open', '포장은 함께, 큰 가구/가전 전용 커버링'),
('MOVE_TYPE', 'pack_mov', '원스톱 포장 이사', 50, 'Y', 'boxes', '포장부터 운송·정리까지 올인원 서비스'),
('MOVE_TYPE', 'office_mov', '사무실·기업 이전', 60, 'Y', 'building', '파티션, 전산장비, 기업 집기 전문 이전'),
('MOVE_TYPE', 'kee_mov', '보관 이사', 70, 'Y', 'warehouse', '전용 컨테이너 안전 보관 이사')
ON DUPLICATE KEY UPDATE `code_name` = VALUES(`code_name`), `sort_order` = VALUES(`sort_order`);

-- --------------------------------------------------------
-- 초기 세부 코드 데이터 등록 (CONSULT_STATUS: 상담 상태)
-- --------------------------------------------------------
INSERT INTO `code_detail` (`group_code`, `code_value`, `code_name`, `sort_order`, `is_use`, `extra_val_1`, `extra_val_2`) VALUES
('CONSULT_STATUS', '접수', '접수 (신규 대기)', 10, 'Y', 'blue', '미확인 신규 접수건'),
('CONSULT_STATUS', '상담중', '상담중 (견적 협의)', 20, 'Y', 'orange', '고객 통화 및 일정/운임 조율중'),
('CONSULT_STATUS', '배차완료', '배차완료 (기사 연결)', 30, 'Y', 'green', '차주 배정 완료 및 안내 완료'),
('CONSULT_STATUS', '취소', '취소 (미진행)', 40, 'Y', 'grey', '고객 취소 또는 미체결')
ON DUPLICATE KEY UPDATE `code_name` = VALUES(`code_name`), `sort_order` = VALUES(`sort_order`);

-- --------------------------------------------------------
-- 초기 세부 코드 데이터 등록 (CLUB_STATUS: 차주 상태)
-- --------------------------------------------------------
INSERT INTO `code_detail` (`group_code`, `code_value`, `code_name`, `sort_order`, `is_use`, `extra_val_1`, `extra_val_2`) VALUES
('CLUB_STATUS', '신청', '신청 (대기)', 10, 'Y', 'blue', '온라인 가입 신청 대기'),
('CLUB_STATUS', '승인', '승인 (정회원)', 20, 'Y', 'green', '등록비 입금 및 관허 배차망 등록 완료'),
('CLUB_STATUS', '보류', '보류 (확인필요)', 30, 'Y', 'orange', '서류 미비 또는 연락 대기'),
('CLUB_STATUS', '탈퇴', '탈퇴 (이용중지)', 40, 'Y', 'grey', '회원 탈퇴 및 배차 제한')
ON DUPLICATE KEY UPDATE `code_name` = VALUES(`code_name`), `sort_order` = VALUES(`sort_order`);

-- --------------------------------------------------------
-- 초기 세부 코드 데이터 등록 (REGION_AREA: 운송 권역)
-- --------------------------------------------------------
INSERT INTO `code_detail` (`group_code`, `code_value`, `code_name`, `sort_order`, `is_use`, `extra_val_1`, `extra_val_2`) VALUES
('REGION_AREA', 'seoul_metro', '수도권 (서울·경기·인천)', 10, 'Y', 'teal', '서울 25개 구 및 경기·인천 21개 거점'),
('REGION_AREA', 'gangwon', '강원권', 20, 'Y', 'olive', '춘천, 원주, 강릉, 속초 등'),
('REGION_AREA', 'chungcheong', '충청권', 30, 'Y', 'yellow', '대전, 천안, 청주, 서산 등'),
('REGION_AREA', 'yeongnam', '영남권 (대구·부산·울산·경북·경남)', 40, 'Y', 'blue', '부산, 대구, 울산, 창원, 포항 등'),
('REGION_AREA', 'honam', '호남권 (광주·전북·전남)', 50, 'Y', 'purple', '광주, 전주, 목포, 여수 등'),
('REGION_AREA', 'jeju', '제주도', 60, 'Y', 'violet', '제주 직항 화물선 연계')
ON DUPLICATE KEY UPDATE `code_name` = VALUES(`code_name`), `sort_order` = VALUES(`sort_order`);
