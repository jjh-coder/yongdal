-- ========================================================
-- 용달코리아 v2 온라인 상담 (견적 문의) 테이블 스키마
-- 데이터베이스: MySQL 5.7+ / MariaDB 10.2+ / MySQL 8.0+
-- 문자셋: utf8mb4 (EUC-KR 호스팅 환경의 경우 utf8 권장)
-- ========================================================

CREATE TABLE IF NOT EXISTS `ydk_online_consult` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '상담 고유번호',
  `name` VARCHAR(50) NOT NULL COMMENT '고객명 또는 상호명',
  `tel` VARCHAR(30) NOT NULL COMMENT '연락처 (휴대전화)',
  `email` VARCHAR(100) NULL DEFAULT '' COMMENT '이메일 주소',
  `move_date` DATE NULL COMMENT '운송 희망 일자',
  `car_type` VARCHAR(50) NULL DEFAULT '' COMMENT '희망 차량 종류 (1t_cargo, 1t_top, 1t_lift 등)',
  `start_area` VARCHAR(100) NULL DEFAULT '' COMMENT '출발지 (시/구/동)',
  `end_area` VARCHAR(100) NULL DEFAULT '' COMMENT '도착지 (시/구/동)',
  `story` TEXT NOT NULL COMMENT '상담 및 화물 세부 내용',
  `status` ENUM('접수', '상담중', '배차완료', '취소') NOT NULL DEFAULT '접수' COMMENT '처리 상태',
  `admin_memo` TEXT NULL COMMENT '관리자 상담 기록 및 메모',
  `client_ip` VARCHAR(45) NULL DEFAULT '' COMMENT '신청자 IP 주소',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '신청 일시',
  `updated_at` DATETIME NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '상태/메모 수정 일시',
  PRIMARY KEY (`id`),
  INDEX `idx_status` (`status`),
  INDEX `idx_created_at` (`created_at`),
  INDEX `idx_tel` (`tel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='용달코리아 온라인 상담 및 견적 신청 내역';

-- ========================================================
-- 초기 테스트 및 샘플 데이터
-- ========================================================
INSERT INTO `ydk_online_consult` 
  (`name`, `tel`, `email`, `move_date`, `car_type`, `start_area`, `end_area`, `story`, `status`, `admin_memo`, `client_ip`, `created_at`) 
VALUES
  ('김철수', '010-1234-5678', 'kim@example.com', DATE_ADD(CURDATE(), INTERVAL 2 DAY), '1t_cargo', '서울 성동구 마장동', '경기 성남시 분당구', '소형 가전(냉장고 소형, 세탁기) 및 박스 5개 운송입니다. 엘리베이터 양쪽 다 있습니다.', '접수', '', '127.0.0.1', NOW()),
  ('이영희', '010-9876-5432', 'lee@test.com', DATE_ADD(CURDATE(), INTERVAL 3 DAY), 'room_move', '서울 마포구 공덕동', '서울 관악구 신림동', '원룸 이사 견적 문의드립니다. 침대 매트리스(슈퍼싱글) 1개, 책상, 옷박스 6개 정도입니다. 기사님 도움 필요합니다.', '상담중', '10/20 11:30 1차 통화 완료, 단가 12만원 안내 후 일정 조율 중', '127.0.0.1', DATE_SUB(NOW(), INTERVAL 2 HOUR)),
  ('박대표', '010-5555-7777', 'park@corp.co.kr', DATE_ADD(CURDATE(), INTERVAL 5 DAY), '5t_cargo', '인천 남동공단', '충남 천안시 서북구', '공장 자재 파레트 4개 운송 건입니다. 지게차 상하차 가능합니다.', '배차완료', '배차 완료: 인천 전담 차주 김기사님 연결 완료', '127.0.0.1', DATE_SUB(NOW(), INTERVAL 1 DAY)),
  ('정민우', '010-3333-2222', '', CURDATE(), '1t_lift', '서울 강남구 역삼동', '경기 용인시 수지구', '오토바이(250cc) 1대 탁송 문의합니다. 리프트차로 안전하게 운송 부탁드립니다.', '접수', '', '127.0.0.1', DATE_SUB(NOW(), INTERVAL 30 MINUTE));
