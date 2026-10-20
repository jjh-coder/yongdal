# adm_guide.md — 용달코리아(ydkorea.co.kr) 관리자 시스템 가이드 (v2)

> 이 문서는 용달코리아 관리자 시스템(`/v2/admin/`)을 구축·운영할 때 **반드시 준수해야 하는 규격과 개발 지침**입니다.
> `site_guide.md`의 기술 스택 및 보안 원칙을 기반으로 작성되었습니다.

---

## 0. 관리자 AI 작업 원칙 & 보안 기본 수칙

1. 모든 관리자 파일은 **`/v2/admin/` 폴더 안에서만** 생성·수정한다.
2. 비인가 사용자가 URL로 직접 하위 페이지에 접근할 수 없도록, 모든 관리자 페이지 최상단에 **세션 인증 미들웨어(`require_once __DIR__ . '/includes/auth.php'`)**를 포함해야 한다.
3. PHP 7.4.33 문법만 사용한다. (PHP 8 전용 문법 금지)
4. 모든 DB 연동은 **PDO + Prepared Statements**로 구현하여 SQL Injection을 원천 차단한다.
5. 출력 시에는 반드시 **`e()` (htmlspecialchars)** 함수로 이스케이프하여 XSS를 방지한다.
6. 상태 변경, 메모 저장 등 POST 요청 처리에는 **CSRF 토큰** 검증을 적용한다.

---

## 1. 관리자 시스템 개요

- **경로**: `https://www.ydkorea.co.kr/v2/admin/`
- **목적**: 
  1. 홈페이지에서 접수된 **온라인 상담 및 화물·이사 견적 문의 내역 실시간 확인**
  2. 고객 상담 상태(접수 → 상담중 → 배차완료 → 취소) 변경 및 관리자 전용 상담 메모 관리
  3. 향후 화물 예약, 게시판 관리, 사이트 통계 기능의 통합 관리 기반 마련
- **로그인 인증**:
  - **임시 계정**: 아이디 `admin` / 비밀번호 `admin`
  - 세션 변수: `$_SESSION['ydk_admin_logged'] = true`, `$_SESSION['ydk_admin_user'] = 'admin'`
  - 로그아웃: `logout.php`를 통해 세션 완전 파기 후 로그인 화면으로 리다이렉트

---

## 2. 기술 스택 (site_guide.md 호환)

| 구분 | 기술 / 버전 | 비고 |
|---|---|---|
| 서버 환경 | **PHP 7.4.33** (후이즈 호스팅) | PHP 8 전용 문법 금지 |
| 데이터베이스 | **MySQL 5.7+ / MariaDB** (PDO) | `utf8mb4` 문자셋 |
| UI 프레임워크 | **Fomantic-UI 2.9.x** (CDN) | Fomantic Admin 테이블, 메뉴, 카드 |
| JS 라이브러리 | **jQuery 3.7.1** (CDN) | 드롭다운, 모달, 팝업 지원 |
| 폰트 | **Pretendard** (CDN) | 가독성 높은 산세리프 |
| CSS | **`assets/css/admin.css`** | 관리자 전용 대시보드 레이아웃 |

---

## 3. 디렉토리 구조

```
/v2/admin/
├─ index.php            # 관리자 대시보드 (현황 요약 및 최근 상담 목록)
├─ login.php            # 관리자 로그인 페이지 (admin/admin 임시 인증)
├─ logout.php           # 세션 파기 및 로그아웃 처리
├─ consult_list.php     # 온라인 상담 내역 목록 (검색 / 상태 필터링 / 페이징)
├─ consult_view.php     # 상담 상세 보기 & 상태 변경 & 관리자 메모 저장
├─ includes/
│   ├─ auth.php         # 세션 로그인 여부 체크 미들웨어
│   ├─ db.php           # PDO 데이터베이스 연결 헬퍼 (Mock 폴백 내장)
│   ├─ header.php       # 관리자 공통 상단 네비게이션 & 통계 바
│   └─ footer.php       # 관리자 공통 푸터
└─ assets/
    ├─ css/admin.css    # 관리자 전용 스타일 (Fomantic 기반 반응형)
    └─ js/admin.js      # 상태 변경 AJAX 및 폼 스크립트
```

---

## 4. 데이터베이스 테이블 명세 (`sql/schema_online_consult.sql`)

### 테이블명: `ydk_online_consult`

| 컬럼명 | 데이터 타입 | Null | 기본값 | 설명 |
|---|---|---|---|---|
| `id` | INT UNSIGNED | NO | AUTO_INCREMENT | 고유 식별자 (PK) |
| `name` | VARCHAR(50) | NO | | 신청자 성명 / 상호명 |
| `tel` | VARCHAR(30) | NO | | 연락처 (휴대전화) |
| `email` | VARCHAR(100) | YES | '' | 이메일 주소 |
| `move_date` | DATE | YES | NULL | 운송 희망 일자 |
| `car_type` | VARCHAR(50) | YES | '' | 희망 차종 (1t_cargo, 1t_top 등) |
| `start_area` | VARCHAR(100) | YES | '' | 출발지 (시/구/동) |
| `end_area` | VARCHAR(100) | YES | '' | 도착지 (시/구/동) |
| `story` | TEXT | NO | | 상담 및 화물 세부 내용 |
| `status` | ENUM | NO | '접수' | '접수', '상담중', '배차완료', '취소' |
| `admin_memo` | TEXT | YES | NULL | 관리자 상담 기록 / 차주 배차 메모 |
| `client_ip` | VARCHAR(45) | YES | '' | 신청자 IP 주소 |
| `created_at` | DATETIME | NO | CURRENT_TIMESTAMP | 신청 접수 일시 |
| `updated_at` | DATETIME | YES | ON UPDATE CURRENT_TIMESTAMP | 수정 일시 |

> **인덱스**: `PRIMARY KEY (id)`, `INDEX (status)`, `INDEX (created_at)`, `INDEX (tel)`

---

## 5. 화면별 기능 요구사항 및 UI/UX

### 5-1. 관리자 로그인 (`login.php`)
- **디자인**: 화면 중앙 정렬의 컴팩트한 Fomantic UI 세그먼트 카드.
- **인증 로직**:
  - `POST`로 전송된 ID가 `admin`, PW가 `admin`인 경우 로그인 성공.
  - 로그인 성공 시 `$_SESSION['ydk_admin_logged'] = true`, `$_SESSION['ydk_admin_user'] = 'admin'` 저장 후 `index.php`로 이동.
  - 실패 시 오류 메시지("아이디 또는 비밀번호가 일치하지 않습니다.") 노출.
- **이미 로그인된 경우**: 즉시 `index.php`로 리다이렉트.

### 5-2. 관리자 메인 대시보드 (`index.php`)
- **상태별 카운터 카드**:
  - '전체 접수', '신규 접수(대기)', '상담중', '배차 완료' 4개 통계 카드 노출
- **최근 온라인 상담 10건 목록**:
  - 테이블 형태로 즉시 확인 가능.
  - 클릭 시 상세 보기(`consult_view.php?id=...`)로 이동.

### 5-3. 온라인 상담 목록 (`consult_list.php`)
- **필터링 & 검색**:
  - 상태별 탭 필터: 전체 / 접수 / 상담중 / 배차완료 / 취소
  - 검색창: 고객명, 연락처, 출발지, 도착지 키워드 검색
- **목록 테이블**:
  - 번호, 고객명, 연락처, 희망차종, 출발지→도착지, 운송희망일, 신청일시, 처리상태, 관리 버튼
  - 상태별 컬러 라벨:
    - `접수`: 파란색(`ui blue label`)
    - `상담중`: 주황색(`ui orange label`)
    - `배차완료`: 초록색(`ui green label`)
    - `취소`: 회색(`ui grey label`)
- **페이징**: 페이지당 15건 기준

### 5-4. 온라인 상담 상세 보기 & 상태 변경 (`consult_view.php`)
- 고객 신청 정보(성명, 연락처, 이메일, 운송일, 출발/도착지, 화물 상세 내용) 명확히 노출
- 원클릭 전화 걸기 링크: `<a href="tel:...">`를 제공하여 관리자가 모바일/PC에서 즉시 고객 통화 가능
- **관리자 전용 제어 박스**:
  - 상태 변경 드롭다운 (`접수` / `상담중` / `배차완료` / `취소`)
  - 관리자 메모 텍스트에어리어 (배차된 차주 연락처, 운송료 협의 내용 등 기록)
  - '수정 저장' 버튼 클릭 시 즉시 DB 업데이트 및 알림

---

## 6. Do / Don't

**Do**
- 모든 관리자 페이지 상단에 `auth.php`를 포함해 비인가 접근을 차단한다.
- 관리자 화면에서도 고대비 디자인 토큰과 가독성 높은 폰트(Pretendard)를 유지한다.
- 모바일(태블릿/스마트폰)에서도 관리자가 현장에서 상담 내역을 확인할 수 있도록 반응형 테이블 및 레이아웃을 지원한다.

**Don't**
- 관리자 권한 체크 없이 DB를 조회하거나 조작하는 페이지를 만들지 않는다.
- SQL Injection 취약점이 있는 문자열 결합 SQL을 작성하지 않는다. (반드시 Prepared Statement 사용)
- 비밀번호나 민감한 개인정보를 URL 파라미터(GET)로 전송하지 않는다.

---

## 7. 배포 및 보안 전환 체크리스트

- [ ] 임시 로그인(`admin`/`admin`)이 정상 작동하고 세션이 유지된다
- [ ] 로그아웃 시 세션이 완전히 제거되고 비인가 페이지 접근이 차단된다
- [ ] `ydk_online_consult` 테이블 생성 SQL 스크립트가 준비되었다
- [ ] 홈페이지(`contact_us.php`)에서 상담 신청 시 관리자 목록에 실시간 반영된다
- [ ] 상담 상태 변경 및 관리자 메모 저장이 정상 동작한다
- [ ] 모바일 화면에서도 목록과 상세 조회가 깨지지 않는다
- [ ] 향후 실제 운영 시에는 `config.php`에서 관리자 비밀번호를 `password_hash()`로 암호화 전환한다
