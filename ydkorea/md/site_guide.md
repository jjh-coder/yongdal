# site_guide.md — 용달코리아(ydkorea.co.kr) 사이트 개편 총괄 가이드 (v2, 반응형 웹)

> 이 문서는 AI 및 작업자가 용달코리아 사이트를 구축·개편할 때 **반드시 준수해야 하는 총괄 가이드라인**입니다.
> 기준 작업 경로는 **`/v2/`** 이며, `v2-1`에서 검증·단순화한 반응형 아키텍처를 `/v2/`로 정식 승격·통합 완료하였습니다.
> `[TODO]` 표시는 직접 정해서 채워 넣으세요. 비어 있으면 AI가 임의로 정하지 말고 질문해야 합니다.

---

## 0. AI 작업 원칙

1. 이 문서에 없는 스타일·컴포넌트·라이브러리를 임의로 추가하지 않는다.
2. 한 번에 한 페이지씩 작업한다. 작업 전 해당 페이지의 기존 기능 목록을 먼저 나열하고 확인받는다.
3. 기존 기능(링크, 게시판, 폼 동작)을 누락하지 않는다.
4. 불확실하면 추측하지 말고 질문한다.
5. **모든 신규 파일은 `/v2/` 안에만 만든다.** 루트의 기존 파일·폴더는 수정하거나 삭제하지 않는다.
6. 파일 경로는 하드코딩하지 말고 `url()`, `legacy()`, `BASE_URL`을 사용한다. (4장 참조)
7. **반응형 웹 사이트다.** PC(1920px/1280px), 태블릿(768px~1199px), 모바일(320px~767px)을 모두 지원하며, 화면 크기에 맞추어 레이아웃이 자연스럽게 적응해야 한다.
8. **서버 설정(`.htaccess`, Apache 설정 등)은 수정할 수 없다.** 전환은 `index.html`의 리다이렉트로만 처리한다. (4-5 참조)

---

## 1. 서비스 개요

- **서비스**: 용달·화물·이사 차량 중개 (차주와 화주 직거래 연결)
- **대표번호**: 1688-2404
- **핵심 행동 (우선순위 순)**
  1. 전화 상담 (1688-2404) — 모바일 환경에서는 '원클릭 즉시 통화'가 최우선
  2. 지역/차종별 차주 찾기
  3. 화물 예약 / 견적 문의 게시판 작성
- **개편 범위**: **반응형 웹 단일 사이트로 개편** (PC, 태블릿, 모바일 기기 모두 `/v2/`로 통합 수용)
- **개편 방향**: 불필요한 장식 요소를 배제하고 직관적인 히어로, 탭 기반 서비스/지역 분류, 전화 상담 중심의 간결하고 빠른 UX 제공
- **주요 사용자**: 30~60대 다양한 기기(PC, 스마트폰) 사용자 → 큰 글씨, 명확한 고대비 메뉴, 단순한 흐름, 손쉬운 터치
- **법적 고지**: "통신판매 주선업(중개자)이며 운송 중 사고 책임은 당사자에게 있음" 문구는 **모든 페이지 푸터에 유지**

### 사이트 구조 (기존 메뉴 유지)

| 구분 | 메뉴 |
|---|---|
| 상단 메뉴 | 회사 소개, 온라인 상담, 전화 상담 방법, 운송 요금, 차량 규격, 차주 회원 모집, 서비스 안내 |
| 바로가기 | best 용달, 1.4t/2.5t/5t, 탑차(1t~5t), 리프트 차, 지역 차량(서울·경기), 지역 차량(광역시), 화물 예약, 지방 화물 안내, 이삿짐 예상 단가, 용달 이사, 원룸 이사, 사무실 이사, 일반 이사, 보관 이사, 포장 이사 |
| 메인 영역 | 직관적 히어로, 3대 핵심 블록, 화물/이사 탭, 3대 권역(서울/경기·인천/지방) 지역 탭, 이용 절차(5단계), 공지사항/Q&A, 마무리 전화 CTA |
| 푸터 | 상호, 대표자, 사업자번호, 통신판매업 신고번호, 주소, 대표전화, 이메일, 계좌안내, 중개자 법적 고지, 접속 카운터/로그 |

> 기존 게시판은 zboard 기반(`/bbs/zboard.php`). **게시판 URL과 동작은 변경하지 않고 겉모양만 개편**하며, v2에서는 `legacy('bbs/zboard.php?id=...')`로 링크한다.

---

## 2. 기술 스택 (변경 금지)

| 항목 | 규칙 |
|---|---|
| 서버 | **PHP 7.4.33** (후이즈 호스팅, **서버 설정 수정 불가**) |
| 작업 폴더 | **`/v2/`** (구버전은 `/v2_backup/`에 보관, 기존 루트 파일은 직접 수정하지 않음) |
| UI | **Fomantic-UI 2.9.x** (원본 Semantic UI 사용 금지) |
| JS | jQuery 3.x + Fomantic-UI JS (필요한 곳에만) |
| 번들러 | 사용하지 않음 (CDN + 정적 파일) |
| 대상 | **반응형 웹** (모바일 320px ~ 데스크톱 1920px+) |
| 폰트 | Pretendard (CDN) |
| 아이콘 | Fomantic 기본 아이콘(`icon` 클래스) |

### CDN 로드 (버전 고정, `@latest` 금지)

```html
<!-- head -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.4/dist/semantic.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/custom.css"> <!-- 반드시 Fomantic 다음에 로드 -->

<!-- body 끝 -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.4/dist/semantic.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/app.js"></script>
```

---

## 3. PHP 7.4.33 코딩 규칙

PHP 7.4는 지원이 종료된 버전이므로 **PHP 8 문법을 쓰면 오류가 납니다.**

### 사용 금지 (PHP 8+ 전용)

- `match` 표현식 → `switch` 또는 `if/else`
- `enum`, `readonly` 프로퍼티, 생성자 프로퍼티 승격
- Named arguments (`foo(name: 1)`)
- Nullsafe 연산자 `?->`
- Union types (`int|string`), `mixed` 타입
- `str_contains()`, `str_starts_with()`, `str_ends_with()` → `strpos() !== false`, `strncmp()`, `substr()` 사용
- `#[Attribute]` 문법, `static` 반환 타입

### 사용 가능 (7.4)

- 화살표 함수 `fn($x) => $x * 2`
- 타입이 있는 프로퍼티, `??`, `??=`, 배열 스프레드 `[...$a, ...$b]`
- 짧은 출력 태그 `<?= ?>` (템플릿에서 사용)
- 스칼라 타입 선언, 리턴 타입 선언, nullable 타입 `?string`

### 보안 (필수)

| 항목 | 규칙 |
|---|---|
| 출력 | 모든 사용자 데이터는 `htmlspecialchars($v, ENT_QUOTES, 'UTF-8')`. 헬퍼 `e()` 함수로 통일 |
| DB | **PDO 또는 mysqli + prepared statement 사용.** 문자열 이어붙인 SQL 금지 |
| 폼 | CSRF 토큰 검증, 서버 측 입력 검증 필수 |
| 비밀번호 | `password_hash()` / `password_verify()` |
| 설정값 | DB 접속 정보 등은 웹 루트 밖 또는 `config.php` 등에 두고 저장소 노출 방지 |
| 에러 | 운영에서는 `display_errors=0`, 로그 파일로 기록 |

---

## 4. 폴더 구조 & 배포 규칙

### 4-1. 기존 서버 구성 (수정 금지)

현재 후이즈 서버 웹 루트에는 기존 사이트가 운영 중이다. **아래 항목은 읽기 전용으로 취급하고 AI가 수정·삭제하는 코드를 만들지 않는다.**

| 경로 | 설명 |
|---|---|
| `index.html` | 현재 메인 페이지. **전환 시 리다이렉트 파일로 교체하는 유일한 기존 파일** (교체 전 백업 필수, 4-5 참조) |
| `main/` | 기존 하위 페이지 (info.html, trt.html, list.php ...) |
| `bbs/`, `bbs_patchedByWhoisWeb/` | zboard 게시판 |
| `images/`, `jijum/`, `yd/`, `tel-1688-2404/`, `cgi-bin/`, `LOGSCRIPT/` | 기존 리소스 (`jijum_old/` 98개 백업 폴더 및 `tel-1688-2404/kch1414_DB.sql` 35MB DB 덤프 인입) |
| `.htaccess` 등 서버 설정 | **수정 불가. 건드리지 않는다** |

### 4-2. 정식 개편 폴더: `/v2/`

모든 신규 작업물은 **`/v2/` 폴더 안에서만** 관리한다. (기존 구버전은 `/v2_backup/`에 보관)

```
/v2/
├─ index.php              # 메인 페이지 (간결화·탭 기반 UI 적용 완료)
├─ includes/
│   ├─ config.php         # 사이트 상수 (BASE_URL='/v2', 전화번호, 사업자 정보, 법적 고지)
│   ├─ functions.php      # e(), url(), legacy() 공통 헬퍼
│   ├─ header.php         # <head> + 상단 유틸바 + 로고/전화 + 상단 7대 메뉴 + 모바일 햄버거 드로어
│   └─ footer.php         # 푸터 + 카운터/분석 스크립트 + 모바일 듀얼 플로팅 바(견적+전화)
├─ contents/              # 하위 콘텐츠 페이지
│   ├─ area/              # 지역별 운송 정보 안내 (main/area_info_*.html 리뉴얼 완료)
│   │   ├─ _area_nav.php    # 8개 지역 정보 공통 가로 스크롤 탭 내비게이션
│   │   ├─ index.php        # area_info_01.php 기본 리다이렉트
│   │   ├─ area_info_01.php # 서울·수도권 화물안내 (도심 지하주차장 탑차, 2026-10 운임표)
│   │   ├─ area_info_02.php # 충청권 화물안내 (대전·세종·충남북 중부 물류 허브)
│   │   ├─ area_info_03.php # 호남권 화물안내 (광주·전남북 서남권 장거리 및 농수산물 특화)
│   │   ├─ area_info_04.php # 영남권 화물안내 (부산·대구·울산·경남북 산업벨트 경부축 야간특급)
│   │   ├─ area_info_05.php # 강원·제주 화물안내 (산간 결빙 대비 및 제주 카페리 도선 연계)
│   │   ├─ area_info_06.php # 리턴 공차 안내 (복귀 빈차 매칭, 혼적/합바 30~50% 운임 절감)
│   │   ├─ area_info_07.php # 용달 운임 기준표 (1톤 표준 거리별 운임표 및 이사 옵션 요금)
│   │   └─ area_info_08.php # 화물 취급 요령 (포장 가이드, 적재물 보험, 관허 4042호 계약 5계명)
│   ├─ info/
│   │   ├─ company.php      # 회사 소개 (main/info.html 리뉴얼 완료, compnay.php 호환)
│   │   ├─ area_01.php      # 수도권 지역 차량 (서울·경기) 안내 (area_seoul.php 호환)
│   │   ├─ area_02.php      # 전국 광역시 및 주요 거점 차량 안내 (area_metro.php 호환)
│   │   ├─ freight.php      # 화물 및 이사 운송예약 안내 (main/freight.html 리뉴얼 완료)
│   │   ├─ car_list_03.php  # 지방 화물 및 리턴공차 알선 안내 (long_distance.php 호환)
│   │   ├─ forecast_trt.php # 이삿짐 예상 단가 및 서비스별 요금표 (move_cost.php 호환)
│   │   ├─ yd_mov.php       # 용달 이사 (원룸·소형 소호 이사)
│   │   ├─ room_mov.php     # 원룸·투룸 이사 가이드
│   │   ├─ off_mov.php      # 사무실·기업 이전 전문 (office_mov.php 호환)
│   │   ├─ gen_mov.php      # 알뜰 일반 이사 서비스 (general_mov.php 호환)
│   │   ├─ kee_mov.php      # 안전 컨테이너 보관 이사 (storage_mov.php 호환)
│   │   └─ pack_mov.php     # 원스톱 프리미엄 포장 이사
│   ├─ company/
│   │   ├─ company_list.php # 지역별 업체 리스트 (main/list.php 리뉴얼 완료)
│   │   └─ jijum/           # 지점 상세 안내 (레거시 /jijum/*.html 리뉴얼 완료)
│   │       ├─ detail.php   # 지점 상세 안내 페이지 (PHP 7.4 반응형 웹, ?code=...)
│   │       ├─ index.php    # 지점 라우팅 및 전국 등록 지점 목록
│   │       └─ jijum_helper.php # 지점 데이터 조회 및 레거시 HTML 연동 헬퍼
│   ├─ online/
│   │   ├─ contact_us.php # 온라인 상담 및 견적 문의 (main/online_con.html 리뉴얼 완료)
│   │   ├─ complete.php   # 온라인 상담 접수 완료 페이지 (main/online_con_01.html 리뉴얼 완료)
│   │   ├─ online_con.php # contact_us.php 별칭 지원
│   │   └─ online_con_01.php # complete.php 별칭 지원
│   ├─ tel/
│   │   └─ tel.php        # 전화 상담 방법 안내 (main/tel_con.html 리뉴얼 완료)
│   ├─ trt/
│   │   └─ trt.php        # 운송 요금표 (main/trt.html 리뉴얼 완료)
│   ├─ size/
│   │   └─ car_size.php   # 차량 적재함 규격 (main/car_size.html 리뉴얼 완료)
│   ├─ club/
│   │   ├─ car_club.php   # 차주회원 모집 안내 (main/car_club.html 리뉴얼 완료)
│   │   └─ club.php       # 온라인 회원가입 신청 (main/club.html 리뉴얼 완료)
│   ├─ service/
│   │   └─ service.php    # 서비스 안내 (main/service.html 리뉴얼 완료)
│   ├─ notice/
│   │   ├─ notice.php     # 공지사항 목록 (고정 공지, 검색, 10블록 페이징)
│   │   └─ notice_view.php# 공지사항 상세 (이전글/다음글, 조회수)
│   └─ qa/
│       ├─ qa.php         # 묻고답하기 목록 (상태별 필터, 마스킹, 비밀글 아이콘)
│       ├─ qa_view.php    # 묻고답하기 상세 (비밀글 비밀번호 검증, 관리자 답변 블록)
│       └─ qa_write.php   # 묻고답하기 질문 작성 (비밀글 설정, 개인정보 동의)
├─ admin/                 # 관리자 시스템 (온라인 상담, 차주회원, 지역업체, 공지, Q&A, 코드관리)
│   ├─ index.php          # 통합 대시보드 (통계 요약, 최근 내역 미리보기 및 즉시 삭제)
│   ├─ consult_list.php   # 온라인상담 목록 (상태필터, 검색, 10블록 페이징, 단건/선택 일괄 삭제)
│   ├─ consult_view.php   # 온라인상담 상세 (상태변경, 관리자메모, 원클릭 통화, 영구 삭제)
│   ├─ club_list.php      # 차주회원 신청 목록
│   ├─ club_view.php      # 차주회원 상세/승인/메모
│   ├─ company_list.php   # 지역업체 관리 목록
│   ├─ company_form.php   # 지역업체 등록/수정
│   ├─ notice_list.php    # 공지사항 관리 목록
│   ├─ notice_form.php    # 공지사항 등록/수정
│   ├─ qa_list.php        # 묻고답하기 문의 관리 목록
│   ├─ qa_view.php        # 묻고답하기 답변 작성/수정/삭제
│   ├─ code_list.php      # 공통 코드 관리 (그룹코드-세부코드 2단 분할 CRUD, 일괄삭제)
│   ├─ data/              # 관리자 및 Mock fallback JSON 데이터
│   │   ├─ consult_mock.json
│   │   ├─ notice_mock.json
│   │   ├─ qa_mock.json
│   │   ├─ club_mock.json   # 차주회원 신청 모의 데이터
│   │   ├─ company_mock.json# 등록 지역업체 모의 데이터
│   │   └─ code_mock.json   # 공통 코드 관리 모의 데이터 (신규)
│   ├─ sql/
│   │   ├─ schema_notice_qa.sql # 공지사항 & Q&A MySQL 테이블 스키마 스크립트
│   │   └─ schema_code.sql      # 공통 코드 관리(code_group, code_detail) DDL 및 기초 데이터
│   └─ includes/          # 관리자 공통 인증/헤더/DB연동(Mock fallback)
├─ pages/                 # 기타 하위 페이지 (운송 요금, 차량 규격 등 순차 작업 대상)
└─ assets/
    ├─ css/
    │   └─ custom.css     # 디자인 토큰 & 반응형 미디어쿼리 & 탭/그리드 스타일
    ├─ js/
    │   └─ app.js          # 모바일 메뉴 토글, 탭 전환, 아코디언 동작 스크립트
    └─ images/            # 로고 및 사이트 이미지 (log/logo_02_simple.png 등)
```

### 4-3. 경로 규칙 (가장 중요)

폴더명이 나중에 바뀌거나 루트로 승격되어도 한 줄만 고치면 되도록 **경로를 하드코딩하지 않는다.**

`includes/config.php`

```php
<?php
// 사이트 URL 설정 (루트 승격 시 '' 로 변경)
define('BASE_URL', '/v2');

// 대표 연락처 정보
define('SITE_PHONE', '1688-2404');
define('SITE_PHONE_TEL', '16882404');
define('SITE_NAME', '용달코리아');

// 기존 사이트(비변경 영역: /main, /bbs, /images 등) 절대경로
define('LEGACY_URL', '');

// 사업자 및 법적 정보
define('BIZ_NAME', '용달코리아 [관허4-42]');
define('BIZ_CEO', '민경철');
define('BIZ_NO', '206-01-76008');
define('BIZ_MAIL_ORDER', '제2009-서울성동-0009호');
define('BIZ_ADDRESS', '서울 성동구 마장로42길 14 (마장동, 세림상가301호)');
define('BIZ_EMAIL', 'kch1414@ydkorea.co.kr');
define('BIZ_BANK', '기업은행 : 281-042527-04-011 (예금주 : 용달코리아 / 민경철)');

// 법적 고지 (중개자 면책 고지 문구)
define('LEGAL_DISCLAIMER', '용달코리아는 통신판매 주선업(중개자)이므로 화물 운송 중에 발생하는 사고는 운송 당사자와 화주의 책임이므로 그 책임에 대해서는 민, 형사상의 책임을 지지 않습니다.');
```

`includes/functions.php`

```php
<?php
function e($v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}

// 신규(v2-1) 경로
function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

// 기존 사이트 경로 (예: legacy('main/trt.html'), legacy('bbs/zboard.php?id=Qwrite'))
function legacy(string $path = ''): string
{
    return LEGACY_URL . '/' . ltrim($path, '/');
}
```

- 신규 페이지·에셋 링크: `<?= url('assets/css/custom.css') ?>`
- 아직 이관하지 않은 기존 페이지·게시판 링크: `<?= legacy('main/trt.html') ?>`
- 모든 경로는 `/`로 시작하는 **절대경로**를 사용한다. (`../`, `./` 상대경로 금지)

### 4-4. 페이지 작성 템플릿

```php
<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';

$pageTitle = '페이지 제목';
$pageDescription = '페이지 설명';
include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">
    <!-- 본문 내용 -->
</main>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
```

### 4-5. 배포 / 전환 절차 (index.html 리다이렉트 방식)

서버 설정을 수정할 수 없으므로 **루트 `index.html`을 리다이렉트 파일로 교체**해서 `/v2/`로 보낸다. 반응형 웹 사이트이므로 PC와 모바일 모두 단일 `/v2/` 주소로 통합 연결된다.

| 단계 | 내용 |
|---|---|
| 1. 개발 | `https://www.ydkorea.co.kr/v2/` 로 직접 접속해서 확인. 기존 `index.html`은 건드리지 않는다 |
| 2. 검수 | 본 문서 11장 체크리스트 통과. 모바일(360px, 390px), 태블릿(768px), PC(1280px, 1920px) 확인 |
| 3. 백업 | FTP에서 `index.html`을 **`index_legacy.html`로 복사**하고, 로컬 PC에도 원본을 보관한다 |
| 4. 전환 | `index.html`을 아래 리다이렉트 파일로 **덮어쓴다** |
| 5. 확인 | PC·태블릿·모바일 접속 시 `/v2/`로 이동하는지, 뒤로가기 시 무한 반복이 없는지 확인 |
| 6. 롤백 | `index_legacy.html` 내용을 `index.html`로 되돌려 덮어쓴다 (1분 이내 복구) |

**리다이렉트용 `index.html`**

```html
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>용달코리아 대표번호 1688-2404 용달화물 및 이사 용달차 안내 전국 화물 네트워크</title>
<meta name="description" content="서울시 성동구에 위치한 용달코리아 대표번호 1688-2404. 용달, 1톤~5톤 화물, 용달이사, 원룸이사, 리프트차, 탑차, 전국 화물 네트워크 직거래 연결">
<link rel="canonical" href="https://www.ydkorea.co.kr/v2/">
<script>
(function () {
    // 단일 반응형 사이트로 즉시 이동. replace()를 써서 뒤로가기 무한 반복을 방지
    location.replace('/v2/');
})();
</script>
<noscript><meta http-equiv="refresh" content="0;url=/v2/"></noscript>
</head>
<body>
<p><a href="/v2/">용달코리아 메인으로 이동</a></p>
</body>
</html>
```

### 4-6. 서버 정리 권고

AI가 코드를 만들 때 아래 파일이 웹에서 접근 가능하다는 가정을 하지 않는다. 그리고 담당자는 다음을 점검한다.

- 웹 루트의 **DB 덤프(`*.sql`)** 는 외부에서 내려받을 수 없도록 웹 루트 밖으로 이동하거나 삭제
- `formmailtest.php`, `test_euckr.php`, `dead.letter` 등 임시 파일 정리
- v2-1의 신규 문의 폼은 CSRF 토큰, 입력 검증을 필수로 적용

---

## 5. 브랜드 & 디자인 토큰

### 톤앤매너
- 키워드: **신뢰감 / 직관적 / 빠름**
- 컬러 테마: **Deep Navy (`#1B365D`) + Vibrant Orange CTA (`#C2410C`)**
- 가독성: WCAG AAA 준수 (주조색-흰 텍스트 대비 12.3:1)

### 색상 팔레트

| 토큰 | 색상 값 | 용도 | 대비율 (WCAG) | 비고 |
|---|---|---|---|---|
| `--ydk-text` | `#1A1A1A` | 본문 글씨 | 배경 위 **16.4:1** | 부드러운 검정 |
| `--ydk-muted` | `#595959` | 보조 글씨 | 흰 배경 위 **7.0:1** | 이보다 연한 회색 사용 금지 |
| `--ydk-primary` | `#1B365D` | 주조색 (Deep Navy) | 흰 글씨 **12.3:1 (AAA)** | 깊은 신뢰감의 딥 네이비 |
| `--ydk-primary-dark` | `#0F254A` | 주조색 hover | 흰 글씨 **14.2:1 (AAA)** | |
| `--ydk-on-primary` | `#FFFFFF` | 주조색 배경 위 글씨 | 주조색 위 **12.3:1 (AAA)** | 탁월한 판독성 |
| `--ydk-cta` | `#C2410C` | 전화 CTA (대표번호) | 흰 글씨 **5.2:1 (AA)** | 진한 주황 |
| `--ydk-cta-dark` | `#9A3412` | CTA hover | 흰 글씨 **7.3:1 (AAA)** | |
| `--ydk-bg` | `#FAF8F5` | 페이지 배경 | - | 따뜻한 흰색 |
| `--ydk-surface` | `#FFFFFF` | 카드/표/블록 배경 | - | |
| `--ydk-box-bg` | `#F0F4F9` | 안내 박스 배경 | 본문 글씨 **15.2:1 (AAA)** | 연한 네이비 틴트 |
| `--ydk-border` | `#8A8F98` | 테두리/구분선 | 흰 배경 **3.3:1** | 선명한 경계선 |
| `--ydk-border-light` | `#E2E8F0` | 연한 구분선 | - | |
| `--ydk-danger` | `#B91C1C` | 오류/경고 | 흰 글씨 **6.5:1 (AA)** | |

### 타이포그래피

- 폰트: `Pretendard, 'Malgun Gothic', sans-serif`
- 본문 **최소 18px**, 행간 1.6 (장년층 배려, 모바일 16~17px 가능)
- 보조 글씨: **최소 15px** (모바일 13~14px 허용)
- 전화번호: 항상 굵게(700) + 24px 이상

---

## 6. 컴포넌트 규칙 (v2-1 특화)

### 1) 직관적 히어로 & 전화 CTA (`ydk2-hero`, `ydk2-btn-call`)
- 메인 상단에서 긴 설명 없이 한 줄 문구 + 즉시 전화 상담 버튼 + 지역 차주 링크 제공
- 버튼 최소 높이 44px 이상, 모바일 원클릭 통화(`tel:16882404`) 연결

### 2) 핵심 3블록 (`ydk2-block`)
- `ui three column stackable grid` 구조로 용달·화물 / 이사 / 지역 차주 찾기 3대 핵심 진입점 제공
- 아이콘, 직관적인 한 줄 안내, 바로가기 링크 일관 배치

### 3) 탭 기반 서비스 & 지역 선택 (`ydk2-tabs`, `ydk2-links`)
- **서비스 탭**: 화물·차종(8종) / 이사(7종) 탭 전환
- **지역 선택 탭**: 서울(25개 구) / 경기·인천(21개 지역) / 광역시·지방(18개 지역) 탭 전환
- 지역별 운송 정보 안내는 `ui accordion ydk2-accordion`으로 깔끔하게 접어둠

### 4) 간결한 이용 절차 (`ydk2-steps`)
- 번호/아이콘 형태의 5단계 가로형 배치 (전화 상담 → 차량 배차 → 화물 상차 → 안전 운송 → 하차 완료)
- 모바일에서는 세로 스택 또는 유연한 래핑 지원

### 5) 모바일 전용 하단 듀얼 플로팅 바 (`ydk-mobile-callbar`, `ydk-callbar-dual`)
- 화면 폭 767px 이하 기기 접속 시 화면 하단에 상시 고정 노출 (`footer.php`에서 일괄 공통 렌더링)
- **듀얼 액션 구조**:
  - 좌측(36%): `[온라인 견적]` (통화가 곤란한 장소/심야 시간대 고객용 간편 견적 접수)
  - 우측(64%): `[전화 상담·예약 1688-2404]` (오렌지 CTA 원클릭 즉시 통화)
- 지점 상세 페이지(`detail.php`) 접속 시:
  - 좌측: `[본사 1688-2404]` / 우측: `[지점 직통 상담]`으로 상황 맞춤형 자동 전환
- 본문 하단 및 푸터에 여백(`padding-bottom: 60~80px`)을 두어 플로팅 바가 본문 콘텐츠를 가리지 않도록 보장

### 6) 모바일 햄버거 토글 & 오프캔버스 드로어 메뉴 (`ydk-mobile-drawer`)
- 768px 이하 모바일 화면 헤더 우측에 햄버거 토글 버튼(`ydk-btn-menu-toggle`, `bars icon`) 제공
- 터치 시 우측에서 부드럽게 슬라이드 인(`transform: translateX(0)`)되는 오프캔버스 메뉴
- 구성: 상단 로고 + 닫기(X) + 빠른 직통 상담 카드(1688-2404 즉시 통화 + 온라인 견적) + 7대 핵심 메뉴 + 지역별 차주 찾기 칩 + 관허 제4042호 신뢰 안내
- 배경 오버레이 클릭, 닫기 버튼, ESC 키 입력, 내부 메뉴 이동 시 부드럽게 닫히며 열려 있는 동안 뒷배경 스크롤 방지(`ydk-drawer-locked`)

### 7) 모바일 반응형 표 깨짐 방지 & 스마트 요금 카드 패턴 (`ydk-mobile-pricing-list`, `ui unstackable table`)
- **문제 해결**: Fomantic-UI의 기본 `.ui.table`은 767px 이하 모바일에서 `stackable`되어 헤더(`th`)와 데이터 셀(`td`)이 분리되고 `rowspan`이 완전히 붕괴됨.
- **표준 구현 패턴 (듀얼 렌더링)**:
  - **데스크톱/태블릿 (768px 이상)**: `.ui.unstackable.celled.structured.table`을 사용하여 행/열 구조가 깨지지 않는 정교한 비교 표 제공.
  - **모바일 (767px 이하)**: 표 대신 `.ydk-mobile-pricing-list`로 자동 전환하여, 서비스 항목별 **독립 카드(요금, 조건, 작업 내용)** 형태로 렌더링. 작은 스마트폰 화면에서도 한눈에 파악 가능.
- **핵심 강점 카드 그리드 패턴**: 밋밋한 1줄 텍스트 배너 지양, `ui three column stackable grid`를 활용하여 3대 핵심 혜택(비용 절감, 맞춤 선택, 신속 배차)을 시각화.

---

## 7. 레이아웃 (반응형 웹 디자인)

- **반응형 브레이크포인트**:
  - **데스크톱**: `1200px` 이상 (기본 1920px 대응)
  - **태블릿**: `768px ~ 1199px`
  - **모바일**: `320px ~ 767px`
- **본문 컨테이너 (`.ydk-container`)**:
  - `max-width: 1200px; margin: 0 auto; padding: 0 16px;`
- **헤더 고정**: 상단 유틸바 + 로고 + 대표번호 + 7대 상단 메뉴

---

## 8. 페이지별 현황 및 요구사항

### 1) 메인 (`/v2-1/index.php`) — [완료]

1. 상단 유틸바: 공지 문구 + 즐겨찾기 + 관리자 링크
2. 헤더: 용달코리아 로고 + 대표번호 전화 상담 버튼 (`1688-2404`)
3. 내비게이션 바: 7대 메뉴 (회사 소개, 온라인 상담, 전화 상담 방법, 운송 요금, 차량 규격, 차주 회원 모집, 서비스 안내)
4. 히어로 섹션 (`ydk2-hero`): "용달·화물·이사, 한 통의 전화로 끝냅니다" + 즉시 전화 CTA + 지역 차주 링크
5. 핵심 3블록 (`ydk2-block`): 용달·화물 / 이사 / 지역 차주 찾기
6. 서비스 바로가기 탭: 화물·차종 8개 / 이사 7개
7. 전국 지역 선택 탭: 서울(25개 구) / 경기·인천(21개 지역) / 광역시·지방(18개 지역) + 지역별 운송 정보 아코디언
8. 5단계 이용 절차 (`ydk2-steps`)
9. 공지사항 / 묻고답하기 2단 그리드 + 차주 회원 모집 링크
10. 마무리 전화 CTA 섹션
11. 푸터: 상호, 사업자 정보, 입금 계좌, 중개자 법적 면책 고지, 카운터/로그 스크립트
12. 모바일 전용 햄버거 토글 & 오프캔버스 드로어 메뉴 (`ydk-mobile-drawer`)
13. 모바일 전용 하단 듀얼 플로팅 바 (`ydk-callbar-dual`: 온라인 견적 + 대표전화 1688-2404)

### 2) 회사 소개 (`/v2-1/contents/info/company.php`) — [완료]

- **기존 원본**: `main/info.html` 리뉴얼
- **파일 경로**: `/v2-1/contents/info/company.php` (기존 `compnay.php` 접속 시 호환 리다이렉트)
- **구성 요소**:
  - 서브 헤더 (브레드크럼 + 타이틀 + 슬로건)
  - 대표 인사말 (CEO Greeting, 민경철 대표 서명)
  - 3대 핵심 가치 (책임과 정성 / 신속 직거래 / 가족 같은 친절)
  - 회사 개요 표 (관허 4042호, 사업자번호 등)
  - 하단 전화 상담 배너

### 3) 온라인 상담 (`/v2-1/contents/online/contact_us.php`, `complete.php`) — [완료]

- **기존 원본**: `main/online_con.html`, `main/online_con_01.html` 리뉴얼
- **파일 경로**:
  - `/v2-1/contents/online/contact_us.php` (온라인 상담 및 견적 신청 폼, 별칭 `online_con.php`)
  - `/v2-1/contents/online/complete.php` (온라인 상담 접수 완료 전용 페이지, 별칭 `online_con_01.php`)
- **보안 및 기술**:
  - CSRF 토큰 검증, 유효성 검사, 에러 안내
  - DB 또는 Mock 데이터 저장(`insert_consult_item`) 및 관리자 알림 메일 발송(`send_consult_mail`)
  - **PRG(Post/Redirect/Get) 패턴 적용**: 폼 제출 완료 시 새로고침에 의한 중복 발송을 방지하기 위해 세션 플래시 데이터(`consult_success`, `consult_id`, `consult_time`)를 전달하며 `complete.php`로 자동 리다이렉트
- **완료 페이지 구성 요소 (`complete.php`)**:
  - 서브 헤더 (브레드크럼 + 완료 타이틀)
  - 완료 히어로 카드 (성공 아이콘, 접수 감사 문구, 접수 번호/접수 일시 뱃지)
  - 신청 내역 요약 표 (성명, 연락처, 이메일, 희망일, 차종, 운송 구간, 상담 내용)
  - 3단계 진행 절차 안내 카드 (STEP 01: 실시간 접수 → STEP 02: 유선 해피콜 & 운임 안내 → STEP 03: 배차 확정 & 안전 운송)
  - 빠른 유선 상담 안내 (레거시 계승: 1시간 이내 연락 부재 시 대표번호 1688-2404 / 1688-2407 즉시 통화 유도)
  - 하단 액션 버튼 ([메인 이동], [추가 문의 작성], [운송 요금표 확인])

### 4) 전화 상담 방법 (`/v2-1/contents/tel/tel.php`) — [완료]

- **기존 원본**: `main/tel_con.html` 리뉴얼
- **파일 경로**: `/v2-1/contents/tel/tel.php`
- **개편 방향**: 직설적 주의사항("절대로 하지 마시고")을 고객 친화적이고 신뢰감 있는 "빠르고 정확한 맞춤 견적 가이드(Before & After)"로 개선.
- **최신 개정 사항 (2026-10)**:
  - 막연한 문의 방지: "차량 종류와 운송 물품, 출발·도착지가 없으면 운송비를 산출할 수가 없습니다!" 필수 3대 조건 명시.
  - 추천 질문 패턴 강화: 차량 종류, 운송 물품, 출발·도착 동(층수/EV 유무) 제공 시 직거래 최저 요금 즉시 산출 안내.
  - 합바(혼적) FAQ 현실화: **"당착이나 내일착으로"** 배차 조건 명시 및 **"운송료 최대 30~40% 절감"**으로 안내 현실화.
- **구성 요소**:
  - 서브 헤더 (브레드크럼 + 타이틀 + 안내문)
  - 대표번호 직통 전화 배너 (1688-2404 / 1688-2407)
  - 전화 상담 전 미리 확인해야 할 5대 핵심 체크포인트 (차종/물량, 상세 출발·도착지, 인력/작업조건, 경유지/대기시간, 구체적 지역 지명)
  - 친절한 질문 가이드 (추가 확인이 필요한 질문 vs 1분 완성 추천 질문)
  - 자주 묻는 질문(FAQ: 당일/야간 배차, 독차와 합바/혼적 차이)
  - 하단 즉시 전화 및 온라인 견적 배너 + 모바일 하단 플로팅 전화바

### 5) 운송 요금 (`/v2-1/contents/trt/trt.php`) — [완료]

- **기존 원본**: `main/trt.html` 리뉴얼
- **파일 경로**: `/v2-1/contents/trt/trt.php`
- **개편 방향**: 4대 권역(수도권·경기, 강원, 충청, 영남·호남)의 1톤 및 2.5톤 운송 요금을 깔끔한 반응형 표와 PHP 배열 데이터 구조로 개편.
- **최신 개정 사항 (2026-10 운임 현실화)**:
  - 서울시내: 1톤 `50,000 ~ 90,000원`, 2.5톤 `100,000 ~ 130,000원`
  - 수도권: 1톤 `70,000 ~ 90,000원`, 2.5톤 `120,000 ~ 150,000원`
  - 경기 주요 지역(부천, 김포, 인천, 파주, 동두천, 문산, 강화, 오산, 용인, 수원, 평택, 인천공항) 운임 1~2만 원 현실화 인상
  - 강원권(춘천, 강릉, 동해, 태백, 삼척), 충청권(청주, 서산, 부여), 영·호남권(전주, 남원, 광주, 광양, 목포, 김천, 대구, 포항, 울산, 부산, 창원, 진주) 장거리 2.5톤 운임 1~3만 원 현실화 인상 반영
- **구성 요소**:
  - 서브 헤더 (브레드크럼 + 타이틀 + 안내문)
  - 요금 기준 및 유의사항 안내 박스 (서울시청 기준, 탑차 2~4만 원 추가, 혼적 안내, 실시간 상담 링크)
  - 4대 권역 앵커 이동 탭 (수도권·경기 / 강원 / 충청 / 전라·경상)
  - 권역별 반응형 요금표 (`ui celled table ydk-table`)
  - 하단 즉시 전화 및 온라인 견적 배너 + 모바일 하단 플로팅 전화바

### 6) 차량 규격 (`/v2-1/contents/size/car_size.php`) — [완료]

- **기존 원본**: `main/car_size.html` 리뉴얼
- **파일 경로**: `/v2-1/contents/size/car_size.php`
- **개편 방향**: 1톤부터 18톤 대형 화물 및 특수 탑차까지 적재함 치수(길이/넓이/높이)를 체계적인 구조화 데이터로 표현.
- **최신 개정 사항 (2026-10 제원 정밀화)**:
  - 3.5톤 카고 파레트 적재: `표준 4~8개(광폭)` 반영
  - 5톤 축 카고 파레트 적재: `표준 12개`로 정정
  - 2.5톤 탑차 높이: `2,000 ~ 2,200mm (탑내경)`으로 현실화
  - 탑차(윙탑) 라인업 세분화:
    - **3.5톤 탑차 (윙탑)**: 길이 4,600 / 폭 2,050 / 높이 2,000~2,200mm / 적재 3.5톤 / 파레트 표준 4개·광폭 6개
    - **5톤축 탑차 (윙탑)**: 길이 7,400 / 폭 2,270 / 높이 2,300~2,500mm / 적재 5.0톤 / 파레트 표준 12개
- **구성 요소**:
  - 서브 헤더 (브레드크럼 + 타이틀 + 안내문)
  - 치수 단위(mm) 및 규격 확인 유의사항 안내 박스
  - 차종별 적재함 상세 제원표 (`ui celled structured table ydk-table`)
  - 3대 대표 추천 차종 카드 (1톤 용달, 2.5톤 트럭, 5톤 윙탑 비교)
  - 하단 즉시 전화 및 온라인 견적 배너 + 모바일 하단 플로팅 전화바

### 7) 서비스 안내 (`/v2-1/contents/service/service.php`) — [완료]

- **기존 원본**: `main/service.html` 리뉴얼
- **파일 경로**: `/v2-1/contents/service/service.php`
- **개편 방향**: 화물 운송 기본 원칙(건물 앞 상·하차 기준)을 명확히 안내하고, 7대 핵심 서비스 라인업 제공.
- **구성 요소**: 서브 헤더, 화물 운송 기본 서비스 기준 안내 박스, 7대 핵심 서비스 라인업 카드, 4단계 손쉬운 이용 절차 가이드, 하단 CTA.

### 8) 지점 상세 안내 (`/v2-1/contents/company/jijum/detail.php`) — [완료]

- **기존 원본**: `jijum/*.html` (98개 정적 팝업) 리뉴얼
- **파일 경로**:
  - `/v2-1/contents/company/jijum/detail.php` (지점 상세 뷰)
  - `/v2-1/contents/company/jijum/index.php` (라우팅 및 전체 지점 목록)
  - `/v2-1/contents/company/jijum/jijum_helper.php` (DB 우선 조회 및 레거시 HTML 파싱 fallback 연동)
- **개편 방향**: 윈도우 팝업을 반응형 풀페이지로 전면 개편.
- **최신 개정 사항 (2026-10 지점 데이터 전면 업데이트)**:
  - 전국 지점 데이터 최신화: 상호, 대표자 성명(민경철 일원화 등), 연락처(`1688-2404 / 1688-2407 / 010-4477-2404`), 보유차종 최신 규격 일괄 적용.
  - 신규 지점 파일 추가: `ydkorea/jijum/code_18_1.html` 추가.
  - 안전 백업 구성: `ydkorea/jijum_old/`에 기존 98개 레거시 원본 백업 보관.
- **구성 요소**:
  - 서브 헤더 (브레드크럼 + 상호명 + 목록으로 돌아가기 버튼)
  - 지점 정보 세그먼트 (상호명, 대표자 성명, 보유 차종 뱃지, 즉시 배차 상태)
  - 직통 상담 전화 강조 배너 (1688-2404 / 지점 직통)
  - 주요 취급 업무 아이콘 그리드 및 운송/이사 상세 박스
  - 지점 맞춤형 모바일 듀얼 플로팅 바 (본사 1688-2404 + 지점 직통)

### 9) 용달 이사 (`/v2-1/contents/info/yd_mov.php`) — [완료]

- **기존 원본**: `main/yd_mov.html` 리뉴얼
- **파일 경로**: `/v2-1/contents/info/yd_mov.php`
- **개편 방향**: 소형 이사 3대 핵심 강점 카드 그리드 및 모바일 스마트 요금 카드 듀얼 렌더링.
- **최신 개정 사항 (2026-10 운임 현실화)**:
  - 기준 명시: 표 제목에 **"서울 시내 1층 기준 예시"** 조건 명확화.
  - 단순 운송: `6 ~ 9 만원` (거리 비례)
  - 일반이사 (기사+인부 1명): 평일 `20 ~ 25 만원` / 손없는날 `24 ~ 28 만원`
  - 포장이사 (기사+인부 1명): 평일 `35 ~ 40 만원` / 손없는날 `40 ~ 45 만원`
- **구성 요소**: 3대 핵심 특장점 카드, 가정이사/사무실이사 섹션, 1톤 표준 비용 가이드 (모바일 스마트 카드 / 데스크톱 구조화 표), 직통 예약 카드 사이드바, 하단 CTA.

### 10) 차주 회원 모집 및 가입 (`car_club.php`, `club.php`) — [완료]

- **기존 원본**: `main/car_club.html`, `main/club.html` 리뉴얼
- **파일 경로**:
  - `/v2-1/contents/club/car_club.php` (차주회원 모집 안내)
  - `/v2-1/contents/club/club.php` (온라인 차주회원 가입 신청)
- **개편 방향**: 1톤~5톤 지입/개별 차주를 위한 직거래 배차망 참여 혜택, 등록 절차, 온라인 가입 폼 및 투명한 월 회비 체계 안내.
- **최신 개정 사항 (2026-10 회비 정책 개편)**:
  - 서울시 1개 구 가입 시: **월 30,000원**
  - 수도권 2개 지역 (지역시): **월 60,000원**
  - 광역시 및 핵심 거점: **월 70,000원** (기존 6만 원에서 인상)
  - **서울시 전구 및 수도권 일부**: **월 250,000원** (광역 통합 요금제 신설)
  - 입금 계좌: 기업은행 010-8833-1412 (예금주: 민경철) 안내
  - 관리자 연동: `admin/data/club_mock.json` 모의 데이터 연동 및 관리자 승인 시스템 연계.

### 11) 화물 운송 예약 안내 (`freight.php`) — [완료]

- **기존 원본**: `main/freight.html` 리뉴얼
- **파일 경로**: `/v2-1/contents/info/freight.php`
- **개편 방향**: 정식 관허업체 신뢰성 강조 및 안전 화물 예약 가이드.
- **최신 개정 사항 (2026-10)**:
  - 관허업체 표기: **"관허업체 [관허 4042호]"**로 공식 인증 번호 정정 반영.

### 12) 연관 이사 서비스 라인업 — [완료]

- **파일 경로**:
  - `/v2-1/contents/info/forecast_trt.php` (이삿짐 예상 단가, move_cost.php 호환)
  - `/v2-1/contents/info/gen_mov.php` (일반이사, general_mov.php 호환)
  - `/v2-1/contents/info/room_mov.php` (원룸이사)
  - `/v2-1/contents/info/off_mov.php` (사무실이사, office_mov.php 호환)
  - `/v2-1/contents/info/kee_mov.php` (보관이사, storage_mov.php 호환)
  - `/v2-1/contents/info/pack_mov.php` (포장이사)
- **최신 개정 사항 (2026-10 운임 및 기준 일괄 동기화)**:
  - 모든 이사 요금 기준표에 **"서울 시내 1층 기준"** 조건 적용.
  - 1톤 차량 기준 이사 요금: 단순운송 `6~9만 원`, 일반이사(고객도움) `10~15만 원` / 손없는날 `12~17만 원`, 인부 1명 포함 `25~30만 원` / 손없는날 `27~32만 원`, 반포장 `35~38만 원` / 손없는날 `38~40만 원`, 포장이사 `35~40만 원` / 손없는날 `40~45만 원`.
  - 2.5톤 차량 기준 이사 요금: 기사 1명 상하차 `20~23만 원` / 손없는날 `22~25만 원`, 인부 1명 포함 `40~45만 원` / 손없는날 `45~50만 원`.

### 13) 지역별 운송 정보 안내 (`/v2/contents/area/area_info_01.php ~ 08.php`) — [완료]

- **기존 원본**: `main/area_info_01.html` ~ `main/area_info_08.html` 전면 개편
- **파일 경로**:
  - `/v2/contents/area/_area_nav.php` (8개 가이드 공통 터치 탭 내비게이션)
  - `/v2/contents/area/index.php` (기본 01 리다이렉트)
  - `/v2/contents/area/area_info_01.php` (서울·수도권 화물안내)
  - `/v2/contents/area/area_info_02.php` (충청권 화물안내)
  - `/v2/contents/area/area_info_03.php` (호남권 화물안내)
  - `/v2/contents/area/area_info_04.php` (영남권 화물안내)
  - `/v2/contents/area/area_info_05.php` (강원·제주 화물안내)
  - `/v2/contents/area/area_info_06.php` (리턴 공차 및 혼적 알선 안내)
  - `/v2/contents/area/area_info_07.php` (용달 운임 기준표 및 요금 책정 가이드)
  - `/v2/contents/area/area_info_08.php` (화물 취급 요령 및 안전 수칙)
- **개편 방향**:
  - 레거시 Namo WebEditor 정적 테이블과 단순 텍스트 반복을 탈피하여, 각 권역별 지리·산업 특성에 맞춘 전문 가이드로 전면 고도화.
  - 기존 레거시의 핵심 지침(관허 4042호 확인, 상차 전 차량번호·기사연락처·차고지 확인, 적재물 보험 5톤 기준, 분실/파손 현장 확인 서면 작성)을 100% 보존·강화.
  - 2026-10 최신 현실화 운임 기준 동기화 및 데스크톱 구조화 표(`ui unstackable celled structured table`)와 모바일 스마트 카드(`ydk-mobile-pricing-list`) 듀얼 렌더링 적용.
  - 8개 페이지 상단에 유기적인 탭 내비게이션(`_area_nav.php`)을 배치하여 원클릭 순환 이동 지원.

### 14) 향후 유지보수 및 차기 작업 대상

1. 사용자 편의 기능: 메인 화면 실시간 운임 계산기 위젯 (Interactive Cost Estimator)
2. 지역업체 리스트(`company_list.php`) 실시간 인풋 검색 및 차종별 필터 칩 고도화
3. 실시간 배차 완료 알림 롤링 티커 연동

---

## 9. 접근성 & 성능 & SEO

- 본문-배경 명도 대비: 7:1 안팎 권장 (최소 4.5:1 이상)
- 상태 전달 시 색상 단독 전달 금지 (아이콘·텍스트 병기)
- 연한 회색 글씨, 이미지 위 텍스트, 그라데이션 위 텍스트 금지
- 이미지 `alt` 필수, `loading="lazy"` 적용
- 기존 메타 태그 유지 및 페이지별 고유 `<title>`, `description` 제공
- `/v2-1/` 페이지는 각각 자기 자신을 가리키는 `canonical` 태그 삽입

---

## 10. Do / Don't

**Do**
- 기준 작업 폴더는 반드시 `/v2-1/`를 사용한다.
- 대표번호(1688-2404)는 헤더와 모바일 하단 플로팅 바에서 즉시 누를 수 있게 한다.
- 장년층 가독성을 위해 본문 18px(모바일 16px), 보조 15px(모바일 13px) 이상을 유지한다.
- 터치 타깃 영역은 최소 44px 이상을 확보한다.
- 상대경로(`../`) 대신 `url()`, `legacy()`, `BASE_URL`을 사용한다.

**Don't**
- `/v2/` 또는 루트의 기존 파일을 덮어쓰거나 임의 수정하지 않는다.
- PHP 8 전용 문법 사용 금지 (PHP 7.4.33 호환 필수).
- 인라인 스타일, `!important` 남발 금지.
- 가로 스크롤을 유발하는 고정 픽셀 폭 하드코딩 금지.
- 중개자 면책 고지 문구 삭제 금지.

---

## 11. 작업 체크리스트 (페이지 완료 기준)

- [ ] PHP 7.4 문법만 사용했다 (`php -l` 통과)
- [ ] 출력 이스케이프(`e()`), SQL prepared statement 적용
- [ ] 본문 최소 18px, 보조 글씨 최소 15px 준수 (모바일 가독성 확인)
- [ ] 색상 토큰 및 명도 대비율 준수 (Deep Navy `#1B365D`, CTA `#C2410C`)
- [ ] 허용 컴포넌트(Fomantic-UI)만 사용했다
- [ ] 모바일(360px~), 태블릿(768px~), PC(1200px~) 반응형 레이아웃 정상 동작
- [ ] 대표번호가 헤더 및 모바일 하단 플로팅 바에서 항상 보인다
- [ ] 모바일 햄버거 토글 및 오프캔버스 드로어 메뉴가 정상 개폐된다
- [ ] 모바일 하단 듀얼 플로팅 바(온라인 견적 + 대표전화)가 콘텐츠를 가리지 않는다
- [ ] 복잡한 표(Table)는 모바일에서 깨지지 않도록 unstackable 처리하거나 모바일 카드 리스트로 전환했다
- [ ] 모바일에서 원클릭으로 `tel:` 전화 통화가 정상 동작한다
- [ ] 파일이 `/v2-1/` 안에만 있고 기존 파일을 건드리지 않았다
- [ ] 경로가 `url()` / `legacy()` / `BASE_URL`로 작성되었다 (상대경로·하드코딩 없음)
- [ ] `/v2-1/` 직접 접속과 `index.html` 리다이렉트 이후 모두 CSS·JS·이미지가 정상 로드된다
- [ ] `<meta name="viewport" content="width=device-width, initial-scale=1.0">`가 헤더에 포함되어 있다
- [ ] 푸터에 사업자 정보와 중개자 면책 고지가 있다

---

## 12. UI/UX 고도화 가이드 및 향후 로드맵

전문가 관점에서 도출된 사용자 경험(UX) 및 전환율(CVR) 최적화 로드맵입니다.

### 1) 기구현 핵심 기능 (완료)

| 기능명 | 적용 위치 | 설명 및 UX 효과 |
|---|---|---|
| **모바일 햄버거 드로어 메뉴** | `header.php`, `custom.css`, `app.js` | 768px 이하 모바일 화면에서 가로 스크롤 잘림 문제를 해결하고, 원클릭 통화·온라인 견적·7대 메뉴·지역 칩을 슬라이드 드로어로 집약 제공 |
| **모바일 듀얼 플로팅 바** | `footer.php`, `custom.css` | 통화가 곤란한 조용한 장소/심야 시간대 고객을 위한 **[온라인 견적(36%)]** + 즉시 통화 **[1688-2404(64%)]** 복합 배치 |
| **지점 맞춤형 듀얼 바** | `jijum/detail.php` | 지점 상세 페이지에서 **[본사 문의 1688-2404]**와 **[지점 직통 전화]**를 함께 제공하여 전환율 극대화 |

### 2) 향후 권장 고도화 로드맵 (차기 추진)

1. **30초 실시간 예상 운임 간편 계산기 위젯 (Interactive Cost Estimator)**:
   - 메인 히어로 하단 배치: [출발지] + [도착지] + [차종] + [작업조건] 선택 시 즉시 예상 요금 구간 산출 및 전화 상담 연결.
2. **지역별 업체 리스트 실시간 검색 및 차종 필터 칩 (Search & Filter Chips)**:
   - `company_list.php` 상단에 실시간 인풋 검색 및 [1톤 카고] [탑차] [리프트] [2.5톤~] 필터 칩 제공.
3. **실시간 배차 현황 롤링 티커 & 안심 4대 보증 뱃지**:
   - 실시간 배차 완료 알림 롤링 티커와 적재물 보험/관허 등록/사전 정찰제 보증 뱃지로 사회적 증거(Social Proof) 강화.

---

## 13. 운영 데이터 및 정책 개편 변경 이력 (Changelog)

### [2026-10-27] 운영자 및 실무 정책 반영 개정

현장 실무 운영 데이터 및 정책 수정사항을 전수 조사하여 사이트 전반에 동기화하였습니다.

| 구분 | 대상 파일 | 주요 개정 내용 |
|---|---|---|
| **사업자·관허 정보** | `v2-1/includes/config.php`<br>`v2-1/contents/info/company.php`<br>`v2-1/contents/info/freight.php` | • 관허번호 공식 표기 개정: `관허 4-42호` → **`관허 4042호`** (`용달코리아 [관허4042]`)<br>• 회사 소개 상호명 중복 제거 및 대표자 인사말 다듬기 |
| **차주회원 회비 정책** | `v2-1/contents/club/car_club.php`<br>`v2-1/contents/club/club.php` | • 광역시 및 거점 월 회비 인상: 월 60,000원 → **월 70,000원**<br>• 서울/수도권 광역 요금제 신설: **서울시 전구 및 수도권 일부 월 250,000원**<br>• 서울시 1개 구 월 30,000원, 수도권 2개 지역 월 60,000원 정돈<br>• 입금 계좌 안내: 기업은행 010-8833-1412 (예금주: 민경철) 명시 |
| **화물 운송 요금표** | `v2-1/contents/trt/trt.php` | • 유류비 및 물가 변동 반영 운임 현실화<br>• 서울시내: 1톤 5~9만 원, 2.5톤 10~13만 원<br>• 수도권: 1톤 7~9만 원, 2.5톤 12~15만 원 (김포, 인천, 파주, 강화 등 1~2만 원 인상)<br>• 강원/충청/영호남 장거리 2.5톤 운임 1~3만 원 일괄 현실화 |
| **이사 표준 요금표** | `v2-1/contents/info/yd_mov.php`<br>`v2-1/contents/info/gen_mov.php`<br>`v2-1/contents/info/forecast_trt.php` | • 모든 이사 요금표에 **"서울 시내 1층 기준"** 조건 필수 명시<br>• 1톤 단순 운송: 6~9만 원 (거리 비례)<br>• 1톤 일반이사: 고객도움 평일 10~15만(손없는날 12~17만), 인부포함 25~30만(손없는날 27~32만)<br>• 1톤 포장이사: 평일 35~40만(손없는날 40~45만)<br>• 2.5톤 이사: 기사 상하차 20~23만, 인부포함 40~45만(손없는날 45~50만) |
| **차량 적재함 규격** | `v2-1/contents/size/car_size.php` | • 3.5톤 카고 파레트: 표준 4~6개 → **표준 4~8개(광폭)**<br>• 5톤 축 카고 파레트: 표준 12~14개 → **표준 12개**<br>• 2.5톤 탑차 높이: **2,000 ~ 2,200mm (탑내경)**<br>• 탑차(윙탑) 2단계 세분화:<br>  - **3.5톤 윙탑**: 길이 4,600 / 폭 2,050 / 높이 2,000~2,200 / 표준 4·광폭 6<br>  - **5톤축 윙탑**: 길이 7,400 / 폭 2,270 / 높이 2,300~2,500 / 표준 12 |
| **전화 상담 가이드** | `v2-1/contents/tel/tel.php` | • 운임 산출 3대 필수 요소 강조: 차량 종류, 운송 물품, 출발·도착지 필수 안내<br>• 합바(혼적) 조건 구체화: "당착이나 내일착으로" 배차 조건 및 "최대 30~40% 절감" 명시 |
| **지점 데이터 전면 개편** | `ydkorea/jijum/code_*.html`<br>`ydkorea/jijum_old/`<br>`v2-1/contents/company/jijum/` | • 전국 98개 지점 상호, 대표자 성명(민경철 일원화 등), 연락처(`1688-2404 / 1688-2407 / 010-4477-2404`), 차종 일괄 최신화<br>• 신규 지점 `code_18_1.html` 추가<br>• 기존 정적 파일은 `jijum_old/`로 98개 전량 안전 백업 |
| **관리자 및 DB 리소스** | `v2-1/admin/data/`<br>`tel-1688-2404/` | • 관리자 모의 데이터 확장: `club_mock.json`, `company_mock.json` 신규 추가<br>• 실제 운영 DB 덤프 인입: `tel-1688-2404/kch1414_DB.sql` (35MB) |
| **레거시 메인 원본** | `ydkorea/main/info.html`<br>`ydkorea/main/list.php` | • 회사 소개 본문 문구(대표 민경철, 카톡/메신저 채널 등) 정돈<br>• 지점 리스트 박스 디자인 및 테이블 마크업 정돈 |
| **온라인 상담 완료 페이지** | `v2-1/contents/online/complete.php`<br>`v2-1/contents/online/online_con_01.php`<br>`v2-1/contents/online/contact_us.php` | • 견적 문의 저장 및 메일 발송 완료 시 전용 완료 페이지(`complete.php`)로 PRG 리다이렉트<br>• 접수 번호/일시 및 신청 요약 카드, 3단계 진행 절차 안내, 빠른 유선 연결(1688-2404 / 1688-2407) 제공<br>• 레거시 `main/online_con_01.html` 리뉴얼 및 별칭 `online_con_01.php` 지원 |
| **온라인 상담 삭제 기능** | `v2-1/admin/consult_list.php`<br>`v2-1/admin/consult_view.php`<br>`v2-1/admin/index.php`<br>`v2-1/admin/includes/db.php` | • 상담 내역 단건 삭제 및 선택 일괄 삭제 기능 추가 (`delete_consult_item`, `delete_consult_items`)<br>• 목록(`consult_list.php`): 체크박스 전체 선택/개별 선택 일괄 삭제, 각 행별 단건 삭제 버튼 및 안전 Confirm 제공<br>• 상세(`consult_view.php`): 상단 헤더 및 관리 카드 하단에 영구 삭제 버튼 제공 (삭제 후 목록 리다이렉트)<br>• 대시보드(`index.php`): 최근 접수 내역 관리 열에 단건 삭제 버튼 및 즉시 삭제 지원 |
| **공통 코드 관리 시스템** | `v2/admin/code_list.php`<br>`v2/admin/sql/schema_code.sql`<br>`v2/admin/data/code_mock.json`<br>`v2/admin/includes/db.php`<br>`v2/admin/includes/header.php`<br>`v2/admin/index.php` | • 사이트 전반 공통 코드 체계(그룹코드-상세코드 2계층) 신설<br>• DDL 스크립트 작성(`schema_code.sql`): `code_group`, `code_detail` 테이블 및 차종, 이사종류, 상담상태 등 기초 시드 데이터 포함<br>• 관리자 UI(`code_list.php`): 좌측(5/16) 대분류 그룹코드 목록, 우측(11/16) 세부코드 목록 2단 분할 레이아웃<br>• 그룹/세부코드 등록, 수정, 단건 삭제 및 세부코드 다중 선택 일괄 삭제 Fomantic-UI 모달 UI 완비<br>• Mock JSON fallback(`code_mock.json`) 및 DB 헬퍼 함수(`get_codes_by_group()` 등) 구현 |
| **v2 정식 승격 및 폴더 이전** | `v2/`<br>`v2_backup/`<br>`v2/includes/config.php`<br>`v2/includes/header.php`<br>`site_guide.md` | • 반응형 신규 시스템(`v2-1`)을 정식 서비스 경로인 `/v2/`로 통합 승격 완료<br>• 기존 초기 `v2`는 `v2_backup/`으로 안전 보관 처리 후 `v2-1` 폴더 제거 완료<br>• `BASE_URL`을 `'/v2'`로 단일 동기화 및 캐노니컬 URL, 관리자 링크 최신화 완료 |




