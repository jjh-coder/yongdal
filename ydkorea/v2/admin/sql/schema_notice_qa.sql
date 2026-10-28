-- ========================================================
-- 용달코리아(ydkorea) v2-1 공지사항(notice) & 묻고답하기(qa) 테이블 스키마
-- MySQL / MariaDB (PHP 7.4.33 호환)
-- ========================================================

-- 1. 공지사항 (notice) 테이블
CREATE TABLE IF NOT EXISTS `notice` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '공지사항 고유 번호',
  `title` VARCHAR(255) NOT NULL COMMENT '공지사항 제목',
  `content` MEDIUMTEXT NOT NULL COMMENT '공지사항 내용',
  `author` VARCHAR(50) NOT NULL DEFAULT '관리자' COMMENT '작성자',
  `hit` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '조회수',
  `is_pinned` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '상단 고정 여부 (1: 고정, 0: 일반)',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일시',
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '수정일시',
  PRIMARY KEY (`id`),
  INDEX `idx_notice_pinned_created` (`is_pinned` DESC, `created_at` DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='공지사항 테이블';

-- 2. 묻고답하기 (qa) 테이블
CREATE TABLE IF NOT EXISTS `qa` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '문의 고유 번호',
  `title` VARCHAR(255) NOT NULL COMMENT '문의 제목',
  `writer` VARCHAR(50) NOT NULL COMMENT '작성자 성명',
  `phone` VARCHAR(30) DEFAULT NULL COMMENT '연락처 (휴대폰)',
  `email` VARCHAR(100) DEFAULT NULL COMMENT '이메일 주소',
  `password` VARCHAR(255) DEFAULT NULL COMMENT '비밀번호 (비밀글/수정 확인용 해시 또는 암호)',
  `is_secret` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '비밀글 여부 (1: 비밀글, 0: 공개글)',
  `question` MEDIUMTEXT NOT NULL COMMENT '문의 내용',
  `answer` MEDIUMTEXT DEFAULT NULL COMMENT '관리자 답변 내용',
  `answered_at` DATETIME DEFAULT NULL COMMENT '답변 등록일시',
  `status` ENUM('접수', '답변완료') NOT NULL DEFAULT '접수' COMMENT '답변 상태',
  `hit` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT '조회수',
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일시',
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '수정일시',
  PRIMARY KEY (`id`),
  INDEX `idx_qa_status` (`status`),
  INDEX `idx_qa_created` (`created_at` DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='묻고답하기(Q&A) 테이블';

-- --------------------------------------------------------
-- 샘플 공지사항 데이터
-- --------------------------------------------------------
INSERT INTO `notice` (`title`, `content`, `author`, `hit`, `is_pinned`, `created_at`, `updated_at`) VALUES
('스폰서 부정 클릭은 형사 처벌을 받습니다', '안녕하세요. 용달코리아 운영본부입니다.\n\n당사 포털 및 포털 스폰서 광고에 대한 경쟁 업체의 악의적인 부정 클릭 및 매크로 트래픽이 일부 감지되고 있습니다.\n\n당사는 모든 접속 IP 및 유입 경로, 세션 로그를 실시간으로 기록·보관하고 있으며, 부정 클릭 행위 적발 시 관할 경찰서 사이버수사대에 업무방해죄 및 사기 혐의로 정식 고발 조치와 함께 민사상 손해배상을 엄중 청구하고 있습니다.\n\n정당한 물류 시장 발전을 위해 건전한 이용을 부탁드립니다.\n감사합니다.', '관리자', 428, 1, NOW() - INTERVAL 15 DAY, NOW() - INTERVAL 15 DAY),
('용달코리아 전국 차주 회원을 상시 모집합니다', '전국의 열정적인 용달 및 개별화물 차주님들을 모십니다!\n\n용달코리아는 전국 네트워크를 기반으로 1톤, 1.4톤, 2.5톤, 5톤 카고/탑차/리프트 등 다양한 화물 오더를 매일 실시간으로 연계해 드립니다.\n\n■ 모집 대상: 1톤~5톤 용달 및 개별화물 차주님 (영업용 화물 운송 허가 소지자)\n■ 가입 혜택: 전국 권역별 풍부한 배차 물량 공유, 장거리 합차 물류망 연계\n■ 신청 방법: 상단 메뉴 [차주회원모집] > 온라인 가입 신청 또는 대표전화 1688-2404 문의\n\n차주님들의 많은 관심과 참여를 기다립니다.', '운영팀', 315, 1, NOW() - INTERVAL 10 DAY, NOW() - INTERVAL 10 DAY),
('부정 클릭 및 허위 문의에 대한 법적 대응 안내', '고객님들의 신속하고 정확한 배차 업무를 방해하는 허위 예약 및 장난 전화, 악의적 도배 문의에 대해 엄정 대처하고 있습니다.\n\n허위 견적 문의로 인한 선량한 화주 및 차주님들의 배차 지연 피해를 방지하기 위해 상습 허위 발신 번호는 시스템 차단 및 법적 대응을 진행 중이오니 유의해 주시기 바랍니다.', '법무팀', 198, 0, NOW() - INTERVAL 7 DAY, NOW() - INTERVAL 7 DAY),
('2026년 소형 화물 및 원룸이사 표준 요금 안내', '용달코리아는 투명하고 합리적인 화물 운송 시장 정착을 위해 거리별, 차종별 표준 권장 운송 요금표를 공개하고 있습니다.\n\n홈페이지 내 [운송요금] 메뉴에서 기본 거리(10km 이하) 40,000원부터 구간별 요금을 확인하실 수 있으며, 정확한 견적은 화물의 부피, 작업 환경(사다리차/엘리베이터 여부), 기사님 도움 여부에 따라 조율되오니 참고하시기 바랍니다.', '관리자', 254, 0, NOW() - INTERVAL 3 DAY, NOW() - INTERVAL 3 DAY),
('우천·동절기 안심 운송 서비스(호루차 및 탑차 배차)', '비나 눈이 오는 기상 악화 시에도 소중한 화물이 젖지 않도록 방수 호루 및 탑차 우선 배차 서비스를 상시 지원합니다.\n\n기상 예보에 따라 우천이 예상되는 일정에는 접수 시 미리 말씀해 주시면 탑차/윙바디/호루 차량으로 맞춤 배차해 드리겠습니다.\n\n대표 콜센터: 1688-2404', '배차본부', 142, 0, NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 1 DAY);

-- --------------------------------------------------------
-- 샘플 묻고답하기 데이터
-- --------------------------------------------------------
INSERT INTO `qa` (`title`, `writer`, `phone`, `email`, `is_secret`, `question`, `answer`, `answered_at`, `status`, `hit`, `created_at`, `updated_at`) VALUES
('용달 화물 견적 문의 드립니다', '최민우', '010-3344-5566', 'minwoo@example.com', 0, '서울 강남에서 성남 분당까지 소형 소파와 서랍장 운송하려고 합니다.\n1톤 용달 운송 비용이 대략 얼마 정도 나오나요? 기사님 도움은 조금 필요합니다.', '안녕하세요 고객님, 용달코리아입니다.\n\n서울 강남구에서 성남 분당까지 1톤 단순 운송(고객님과 함께 상하차 기준) 시 약 40,000원~50,000원 선에서 배차가 가능합니다.\n기사님이 직접 계단 이동이나 무거운 짐을 전담 운반해 드려야 하는 경우에는 2~3만원 내외의 수고비가 가산될 수 있습니다.\n\n정확한 일정과 주소를 대표번호 1688-2404로 알려주시면 가장 가까운 지역 기사님을 실시간으로 배차해 드리겠습니다.\n감사합니다.', NOW() - INTERVAL 5 DAY, '답변완료', 67, NOW() - INTERVAL 6 DAY, NOW() - INTERVAL 5 DAY),
('원룸 이사 및 소형 화물 운송 문의', '박지영', '010-8877-6655', 'jypark@test.com', 0, '학생 원룸 이사입니다.\n신촌에서 성북구 안암동까지 책과 옷가지, 32인치 모니터 1대 정도입니다.\n이번 주 토요일 오전 10시경 배차 예약 가능한가요?', '안녕하세요 박지영 고객님!\n\n문의주신 소형 원룸 학생이사의 경우 1톤 카고 차량으로 충분히 안전하게 적재 가능합니다.\n주말 오전 시간대도 사전 예약해 주시면 원하시는 시각에 차질 없이 기사님이 도착하도록 배차해 드립니다.\n\n대표번호 1688-2404로 전화 주셔서 예약 확정 부탁드립니다. 이용해 주셔서 감사합니다.', NOW() - INTERVAL 4 DAY, '답변완료', 53, NOW() - INTERVAL 4 DAY, NOW() - INTERVAL 4 DAY),
('서울-지방 장거리 화물 요청', '이정훈', '010-2211-9988', 'jhlee@biz.co.kr', 0, '서울 금천구 가산동에서 부산 사상구 공단까지 파레트 1개 분량 기계 부품입니다.\n독차는 비용이 부담스러운데 장거리 합차(혼적) 운송도 가능한지, 비용과 소요시간이 궁금합니다.', '안녕하세요 이정훈 고객님, 용달코리아 전국화물 배차팀입니다.\n\n파레트 1개 규격(1100*1100 이내)인 경우 매일 운행하는 서울-부산 간 정기 노선 혼적(합차) 차량을 이용하시면 독차 대비 훨씬 경제적인 비용(약 12만~15만원 선)으로 운송이 가능합니다.\n당일 오후 상차 시 익일 오전 도착 기준이며, 지게차 상하차 여부를 확인해 주시면 더욱 신속히 진행됩니다.\n\n배차실 1688-2404로 연락 주시면 상세 일정 안내해 드리겠습니다.', NOW() - INTERVAL 2 DAY, '답변완료', 41, NOW() - INTERVAL 2 DAY, NOW() - INTERVAL 2 DAY),
('피아노 운반 가능한 리프트 차량 문의', '김서연', '010-6677-1234', NULL, 0, '업라이트 피아노를 마포에서 일산으로 이동하려고 합니다.\n무게가 있어서 파손 위험 때문에 리프트 차량으로 운송하고 싶은데 리프트 용달 배차 가능한가요?', NULL, NULL, '접수', 18, NOW() - INTERVAL 1 DAY, NOW() - INTERVAL 1 DAY),
('사무실 부분 집기 지방 이전 견적 문의', '한승우', '010-9988-4321', 'swhan@partner.co.kr', 0, '서초동 사무실에서 세종시 지사로 책상 2개, 의자 2개, 캐비닛 1개를 보내려고 합니다.\n2.5톤 탑차 또는 1톤 2대로 가능한지, 세금계산서 발행 가능한지 확인 부탁드립니다.', NULL, NULL, '접수', 12, NOW() - INTERVAL 5 HOUR, NOW() - INTERVAL 5 HOUR);
