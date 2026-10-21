# site_guide.md — 용달코리아(ydkorea.co.kr) 사이트 개편 총괄 가이드 (v2, 반응형 웹)

> 이 문서는 AI 및 작업자가 용달코리아 사이트를 구축·개편할 때 **반드시 준수해야 하는 총괄 가이드라인**입니다.
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
- **주요 사용자**: 30~60대 다양한 기기(PC, 스마트폰) 사용자 → 큰 글씨, 명확한 고대비 메뉴, 단순한 흐름, 손쉬운 터치
- **법적 고지**: "통신판매 주선업(중개자)이며 운송 중 사고 책임은 당사자에게 있음" 문구는 **모든 페이지 푸터에 유지**

### 사이트 구조 (기존 메뉴 유지)

| 구분 | 메뉴 |
|---|---|
| 상단 메뉴 | 회사 소개, 온라인 상담, 전화 상담 방법, 운송 요금, 차량 규격, 차주 회원 모집, 서비스 안내 |
| 바로가기 | best 용달, 1.4t/2.5t/5t, 탑차(1t~5t), 리프트 차, 지역 차량(서울·경기), 지역 차량(광역시), 화물 예약, 지방 화물 안내, 이삿짐 예상 단가, 용달 이사, 원룸 이사, 사무실 이사, 일반 이사, 보관 이사, 포장 이사 |
| 메인 위젯 | 전국 광역시 지역 선택, 공지사항, 묻고답하기, 상담 전 안내 문구 |
| 푸터 | 상호, 대표자, 사업자번호, 통신판매업 신고번호, 주소, 전화, 계좌, 중개자 고지 |

> 기존 게시판은 zboard 기반(`/bbs/zboard.php`). **게시판 URL과 동작은 변경하지 않고 겉모양만 개편**하며, v2에서는 `legacy('bbs/zboard.php?id=...')`로 링크한다. `[TODO]` 게시판까지 새로 만들지 여부 결정.

---

## 2. 기술 스택 (변경 금지)

| 항목 | 규칙 |
|---|---|
| 서버 | **PHP 7.4.33** (후이즈 호스팅, **서버 설정 수정 불가**) |
| 작업 폴더 | **`/v2/`** (기존 파일은 수정하지 않음) |
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

> 버전과 CDN 주소는 적용 전에 실제로 로드되는지 확인한다.

### Fomantic-UI 사용 규칙

- 공식 문서에 있는 클래스만 사용한다. 존재하지 않는 클래스를 지어내지 않는다.
- Fomantic 기본 스타일을 수정하지 말고 **`custom.css`에서 덮어쓴다**. (CDN 방식이라 `site.variables` 테마 빌드는 쓰지 않음)
- 덮어쓰기는 `.ydk` 접두 클래스를 붙여 범위를 제한한다. 예: `.ydk-hero`, `.ydk-container`
- 인라인 `style=""`는 금지. 단발성 값도 `custom.css`에 클래스로 만든다.
- 테이블 레이아웃(`<table>`로 배치) 금지. 데이터 표에만 `ui table` 사용.
- **`<meta name="viewport" content="width=device-width, initial-scale=1.0">`는 필수 포함.**
- 그리드 배치 시 Fomantic 반응형 유틸리티 클래스(`doubling`, `stackable`)를 적극 활용한다.
- 본문 폭은 `.ydk-container`(최대 1200px, width: 100%, 좌우 패딩 16px, 가운데 정렬)를 사용한다.

### 허용 컴포넌트 목록

`grid`/`column` (doubling, stackable 포함), `segment`, `button`, `card`/`cards`, `list`/`item`, `menu`(상단 메뉴), `form`/`field`, `input`, `dropdown`, `table`, `message`, `label`, `divider`, `header`, `icon`, `breadcrumb`, `pagination`(menu), `modal`, `accordion`, `tab`, `sidebar`

이 외 컴포넌트가 필요하면 먼저 질문한다.

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
| DB | **PDO + prepared statement만 사용.** 문자열 이어붙인 SQL 금지, `mysql_*` 금지 |
| 폼 | CSRF 토큰 검증, 서버 측 입력 검증 필수 |
| 비밀번호 | `password_hash()` / `password_verify()` |
| 설정값 | DB 접속 정보 등은 웹 루트 밖 또는 `config.php`(접근 차단) 에 두고 저장소에 올리지 않음 |
| 에러 | 운영에서는 `display_errors=0`, 로그 파일로 기록 |

### 인코딩

- 새로 작성하는 파일은 **UTF-8(BOM 없음)**.
- `[TODO]` 기존 DB/게시판이 EUC-KR인지 UTF-8인지 확인. EUC-KR이면 연동 구간에서만 `mb_convert_encoding` 사용하고 구분해서 문서화.

---

## 4. 폴더 구조 & 배포 규칙

### 4-1. 기존 서버 구성 (수정 금지)

현재 후이즈 서버 웹 루트에는 기존 사이트가 운영 중이다. **아래 항목은 읽기 전용으로 취급하고 AI가 수정·삭제하는 코드를 만들지 않는다.**

| 경로 | 설명 |
|---|---|
| `index.html` | 현재 메인 페이지. **전환 시 리다이렉트 파일로 교체하는 유일한 기존 파일** (교체 전 백업 필수, 4-5 참조) |
| `main/` | 기존 하위 페이지 (info.html, trt.html, list.php ...) |
| `bbs/`, `bbs_patchedByWhoisWeb/` | zboard 게시판 |
| `images/`, `jijum/`, `yd/`, `tel-1688-2404/`, `cgi-bin/`, `LOGSCRIPT/` | 기존 리소스 |
| `.htaccess` 등 서버 설정 | **수정 불가. 건드리지 않는다** |

### 4-2. 신규 개편 폴더: `/v2/`

모든 신규 작업물은 **`/v2/` 폴더 안에서만** 만든다. 기존 폴더와 파일 이름이 겹치지 않게 한다.

```
/v2/
├─ index.php              # 메인 페이지 (완료)
├─ includes/
│   ├─ config.php         # 사이트 상수 (BASE_URL, 전화번호, 상호 등)
│   ├─ functions.php      # e(), url(), 공통 헬퍼
│   ├─ header.php         # <head> + 상단 메뉴 (반응형 뷰포트 포함)
│   ├─ footer.php         # 푸터 + 스크립트 + 모바일 플로팅 CTA
│   └─ partials/
│       ├─ car-card.php   # 차량 카드
│       └─ notice-list.php
├─ contents/              # 하위 콘텐츠 페이지
│   ├─ info/
│   │   ├─ compnay.php    # 회사 소개 (main/info.html 리뉴얼 완료)
│   │   └─ company.php    # 스펠링 별칭 지원
│   └─ online/
│       ├─ contact_us.php # 온라인 상담 및 견적 문의 (main/online_con.html 리뉴얼 완료)
│       └─ online_con.php # 별칭 지원
├─ pages/                 # 기타 하위 페이지 (운송요금, 차량규격 등)
└─ assets/
    ├─ css/custom.css     # 디자인 토큰 & 반응형 미디어쿼리 & 폼 스타일
    ├─ js/app.js          # 모바일 메뉴 토글 및 스크립트
    └─ img/               # SVG 아이콘, WebP 이미지
```

### 4-3. 경로 규칙 (가장 중요)

폴더명이 나중에 바뀌거나 루트로 승격되어도 한 줄만 고치면 되도록 **경로를 하드코딩하지 않는다.**

`includes/config.php`

```php
<?php
define('BASE_URL', '/v2');                 // 루트 승격 시 '' 로 변경
define('SITE_PHONE', '1688-2404');
define('SITE_PHONE_TEL', '16882404');
define('SITE_NAME', '용달코리아');
// 기존 사이트(비변경 영역) 절대경로
define('LEGACY_URL', '');                  // 기존 /main, /bbs 는 루트 기준
```

`includes/functions.php`

```php
<?php
function e($v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}

// 신규(v2) 경로
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
include __DIR__ . '/../../includes/header.php';
?>

<main class="ydk-container ydk-main">
    <!-- 본문 -->
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
<meta name="description" content="[기존 index.html의 meta description 그대로]">
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

### 4-6. 서버 정리 권고 (개편과 별개, 우선 확인)

AI가 코드를 만들 때 아래 파일이 웹에서 접근 가능하다는 가정을 하지 않는다. 그리고 담당자는 다음을 점검한다.

- 웹 루트의 **DB 덤프(`*.sql`)** 는 외부에서 내려받을 수 있으면 개인정보 유출 위험이 있으므로 웹 루트 밖으로 이동하거나 삭제한다.
- `formmailtest.php`, `test_euckr.php`, `dead.letter` 등 테스트·임시 파일 정리
- 기존 메일 폼(`formmail_*.php`)은 스팸 발송에 악용되기 쉬우므로 v2의 신규 문의 폼은 CSRF 토큰, 입력 검증, 발송 횟수 제한을 적용한다.

---

## 5. 브랜드 & 디자인 토큰

### 톤앤매너

- 키워드: **신뢰감 / 직관적 / 빠름** `[TODO: 확정]`
- 참고 사이트: `[TODO: 2~3개 URL]`

### 색상 팔레트 (장년층 시각 배려 & 고대비 가이드)

> **선정 배경**: 장년·고령층은 수정체 황변과 대비 감도 저하로 파스텔톤이나 연회색 글씨 판독이 어렵습니다. 따라서 WCAG 기준(일반 4.5:1, 고령층 안전 기준 7:1 안팎)을 충족하는 **콘플라워 블루 + 주황 CTA + 따뜻한 흰 배경** 조합을 사용합니다. 파랑과 주황은 보색에 가까워 색상 구분이 서툰 사용자도 직관적으로 역할을 식별할 수 있습니다. 단, 콘플라워 블루는 밝은 색이라 **흰 글씨와의 대비가 낮으므로**(약 3.0:1) 주조색 배경 위의 작은 글씨는 `--ydk-text`(어두운 글씨)를 쓰거나 18px 이상 굵은 글씨로만 사용한다.

| 토큰 | 색상 값 | 용도 | 대비율 (WCAG) | 비고 |
|---|---|---|---|---|
| `--ydk-text` | `#1A1A1A` | 본문 글씨 | 배경 위 **16.4:1** | 순수 검정 대신 눈이 편한 부드러운 검정 |
| `--ydk-muted` | `#595959` | 보조 글씨 | 흰 배경 위 **7.0:1** | 이보다 연한 회색 사용 금지 |
| `--ydk-primary` | `#6495ED` | 주조색 (메뉴, 제목, 링크) — Cornflower Blue | 흰 글씨 **3.0:1**, 본문 글씨(`#1A1A1A`) **5.9:1** | 밝은 색이므로 배경·큰 글씨용. 작은 글씨 링크에는 `--ydk-primary-dark` 사용 |
| `--ydk-primary-dark` | `#4169E1` | 주조색 hover, 작은 글씨 링크 (Royal Blue) | 흰 글씨 **4.9:1** | |
| `--ydk-cta` | `#C2410C` | 전화 CTA (대표번호) | 흰 글씨 **5.2:1** | 화면에서 가장 눈에 띄는 진한 주황 |
| `--ydk-cta-dark` | `#9A3412` | CTA hover | 흰 글씨 **7.3:1** | |
| `--ydk-bg` | `#FAF8F5` | 페이지 배경 | - | 따뜻한 흰색 (순백 대비 눈부심 감소) |
| `--ydk-surface` | `#FFFFFF` | 카드/표 배경 | - | |
| `--ydk-box-bg` | `#EAF1FD` | 안내 박스 배경 | 본문 글씨 **15.5:1** | "상담 전 안내" 같은 안내 박스 |
| `--ydk-border` | `#8A8F98` | 입력창/구분선 테두리 | 흰 배경 **3.3:1** | 입력창 경계를 선명하게 유지 |
| `--ydk-danger` | `#B91C1C` | 오류/경고 | 흰 글씨 **6.5:1** | |

`custom.css` 최상단에 CSS 변수로 선언하고, 이후에는 **변수만 참조**한다. HEX 직접 입력 금지.

### 타이포그래피

- 폰트: `Pretendard, 'Malgun Gothic', sans-serif`
- 본문 **최소 18px**, 행간 1.6 (장년층 가독성을 위해 18px 기본 적용, 모바일에서는 16~17px 가능)
- 보조 글씨: **최소 15px** (15px 미만 사용 금지, 모바일 보조 13~14px 허용)
- 크기 스케일: 15 / 18 / 20 / 24 / 28 / 36
- 전화번호: 항상 굵게(700) + 24px 이상
- 메뉴·링크: 색상뿐만 아니라 **굵기나 밑줄**로 식별 가능하게 구분

### 간격 / 모서리 / 그림자

- 간격 단위 4px 배수 (4, 8, 12, 16, 24, 32, 48)
- 둥근 모서리: 버튼·입력 8px, 카드 12px
- 그림자: 카드 기본 1단계만 사용 (과한 그림자 금지)

---

## 6. 컴포넌트 규칙

### 버튼 및 모바일 터치 최적화

| 종류 | 클래스 | 사용처 |
|---|---|---|
| 전화 CTA | `ui huge button ydk-btn-call` | 대표번호 노출. `<a href="tel:16882404">` 링크로 제작 |
| 주요 | `ui primary button` | 예약, 문의 등록 |
| 보조 | `ui basic button` | 취소, 목록 |
| 하단 플로팅 전화바 | `ydk-mobile-callbar` | 모바일 전용 하단 고정 전화 상담 바 |

- 버튼 최소 높이 **44px** (모바일 터치 표준 가이드 준수).
- PC 사용자는 대표번호 숫자 자체를 크고 굵게 보고, **모바일 사용자는 터치 한 번으로 즉시 전화 걸기(`tel:16882404`)가 작동**해야 함.
- 모바일(화면 폭 767px 이하)에서는 화면 하단에 고정되는 플로팅 전화상담 바(`ydk-mobile-callbar`)를 상시 노출하여 탐색 중 언제든 원클릭으로 상담 가능하게 한다.

### 차량/지역 카드

- `ui card` 기반: 지역 또는 차종, 대표 정보, 상세 보기 링크
- 한 줄에 4개 (`ui four cards`), 태블릿 2개, 모바일 1~2개로 자동 반응
- 카드 안 링크 전체를 터치/클릭 가능하게 한다.

### 폼 (견적 문의, 화물 예약)

- `ui form` 사용, 라벨은 입력창 위에 배치
- 필수 항목은 `required field` 클래스 + 서버 검증
- 모바일 환경을 고려하여 모든 입력창 높이 44px 이상, 전화번호 입력은 `type="tel"`
- 오류 메시지는 `ui negative message`, 성공은 `ui positive message`
- 전화 상담 전 안내 문구(차량 종류, 물동량, 출발지·도착지)는 폼 상단에 `ui info message`로 노출

### 목록/게시판 (공지사항, 묻고답하기)

- 메인: `ui list divided relaxed`
- 게시판 전체: `ui table` (모바일에서는 가로 스크롤 가능하도록 `.table-responsive` 래퍼 제공)

### 내비게이션 (반응형 메뉴)

- **데스크톱**: 상단 `ui menu` 가로 메뉴 (7개 항목) + 헤더 우측에 대표번호 상시 노출
- **모바일/태블릿**:
  - 가로 터치 스크롤 메뉴(`overflow-x: auto`) 또는 모바일 토글 메뉴 지원
  - 헤더의 대표번호 버튼 크기를 모바일에 최적화하여 상단에 고정
- 바로가기 15개 메뉴: `ui five column doubling stackable grid`를 사용하여 데스크톱 5열, 태블릿 3열, 모바일 2열로 자동 재배치

### 서브페이지 공통 레이아웃 컴포넌트

- **브레드크럼 (`.ydk-breadcrumb`)**: 홈 > 현재 페이지 경로 표기 (아이콘 + 슬래시 구분자)
- **서브 헤더 (`.ydk-sub-header`)**: 페이지 대표 타이틀(`h1.ydk-page-title`), 서브 설명(`p.ydk-page-desc`)
- **대표 인사말 카드 (`.ydk-ceo-greeting`)**:
  - 좌측 6px 주조색 포인트 보더 + 고대비 배경
  - 인용구 박스(`.ydk-ceo-quote`), 대표자 서명(`용달코리아 대표 민경철`)
- **3단 핵심 가치 카드 (`.ydk-value-card`)**: `ui three column doubling stackable grid` 구조, 원형 아이콘 + 제목 + 설명
- **회사 개요 표 (`.ydk-table-wrap`)**: `ui celled table ydk-table` 반응형 테이블
- **하단 전화 상담 CTA 배너 (`.ydk-sub-cta`)**: 주조색(콘플라워 블루) 배경 + 원클릭 전화걸기 버튼 + 온라인 견적 버튼

---

## 7. 레이아웃 (반응형 웹 디자인)

- **PC, 태블릿, 모바일을 모두 지원하는 반응형 웹(Responsive Web)**으로 작성한다.
- **반응형 브레이크포인트 규격**:
  - **데스크톱 (Desktop)**: `1200px` 이상 (기본 1920px 해상도 최적화)
  - **태블릿 (Tablet)**: `768px ~ 1199px`
  - **모바일 (Mobile)**: `320px ~ 767px`
- **본문 컨테이너 (`.ydk-container`)**:
  - `width: 100%;`
  - `max-width: 1200px;`
  - `margin: 0 auto;`
  - `padding: 0 16px;` (모바일/태블릿 화면 잘림 방지)
  - `box-sizing: border-box;`
- **헤더 영역**: 상단 고정(sticky) 유지. 모바일에서는 로고와 직관적인 전화 걸기 버튼 중심으로 슬림하게 유지.
- **모바일 하단 플로팅 바**: 모바일 기기(767px 이하) 접속 시 하단에 전화걸기 플로팅 바를 노출하여 본문 탐색 중에도 상담 전환율 극대화. (하단 바가 본문 콘텐츠를 가리지 않도록 모바일에서 `body` 또는 `main` 하단에 패딩 확보)

---

## 8. 페이지별 요구사항

### 1) 메인 (`/v2/index.php`) — [완료]

1. 헤더: 로고 + 대표번호(크게) + 메뉴 (모바일 반응형 대응)
2. 히어로: 한 줄 소개 + 전화 CTA + "지역 차량 찾기" 버튼 (모바일 세로 배치 지원)
3. 상담 전 준비사항 안내 (고대비 연파랑 박스)
4. 바로가기 (차종, 이사 유형, 지역 - 반응형 그리드 `doubling stackable`)
5. 전국 광역시 지역 선택 (터치 친화적 뱃지/필)
6. 공지사항 / 묻고답하기 2단 (모바일에서 1단 자동 스택)
7. 화물·용달 이용 절차 안내 (모바일 1~2열 스택)
8. 차주 회원 모집 배너
9. 푸터 (사업자 정보, 계좌, 중개자 고지)
10. 모바일 전용 하단 고정 전화 바 (`ydk-mobile-callbar`)

### 2) 회사 소개 (`/v2/contents/info/compnay.php`) — [완료]

- **기존 원본**: `main/info.html` 리뉴얼
- **파일 경로**: `/v2/contents/info/compnay.php` (스펠링 별칭 `/v2/contents/info/company.php` 동시 지원)
- **구성 요소**:
  1. 서브 헤더: 브레드크럼 (홈 > 회사 소개) + 타이틀 + 한 줄 슬로건
  2. 대표 인사말 (CEO Greeting):
     - "BOX 한 개, 의자 하나라도 내 물건처럼 소중하게"
     - "가족처럼 속마음을 편하게 터놓을 수 있는 곳"
     - "서울에서 제주까지 한 통화(1688-2404)로 일사천리 직거래 연결"
     - 대표자 서명: 용달코리아 대표 민경철
  3. 3대 핵심 가치: 책임과 정성(Care) / 신속 직거래 배차(Speed) / 가족 같은 친절(Trust)
  4. 회사 개요 표: 상호, 대표자, 화물운송주선 관허 4-42호, 사업자번호, 통신판매신고, 주소, 전화번호
  5. 하단 전화 상담 CTA 배너 + 모바일 하단 플로팅 바

### 3) 온라인 상담 (`/v2/contents/online/contact_us.php`) — [완료]

- **기존 원본**: `main/online_con.html` 리뉴얼
- **파일 경로**: `/v2/contents/online/contact_us.php` (별칭 `/v2/contents/online/online_con.php` 동시 지원)
- **보안 및 기술**:
  - CSRF 토큰 검증 적용 (`$_SESSION['csrf_token']`)
  - 모든 사용자 입력 이스케이프(`e()`) 및 유효성 검사
- **구성 요소**:
  1. 서브 헤더: 브레드크럼 (홈 > 온라인 상담) + 타이틀 + 안내 설명
  2. 빠른 전화 상담 안내 고대비 박스 (당일 급한 배차는 1688-2404 직통 안내)
  3. 온라인 견적 상담 폼:
     - 성명/상호명 (필수)
     - 연락처 (휴대전화, 필수)
     - 이메일 주소 (선택)
     - 운송 희망 일자 (날짜 픽커)
     - 희망 차량 종류 (드롭다운 선택)
     - 출발지 및 도착지 (시/구/동)
     - 상담 및 화물 상세 내용 (필수)
     - 개인정보 수집 및 이용 동의 (필수 체크)
     - 전송하기 / 다시작성 버튼
  4. 제출 완료 처리: 성공 메시지 카드(`ui positive message`) 및 접수 확인 안내
  5. 하단 전화 상담 배너 및 모바일 하단 플로팅 전화상담 바 (`ydk-mobile-callbar`)

### 4) 다음 작업 대상 페이지 `[TODO: 우선순위 순]`

1. 전화 상담 방법 (`main/tel_con.html`)
2. 운송 요금 (`main/trt.html`)
3. 차량 규격 (`main/car_size.html`)
4. 차주 회원 모집 (`main/car_club.html`)
5. 서비스 안내 (`main/service.html`)
6. 화물 예약 (`main/freight.html`)
7. 이삿짐 예상 단가 / 이사 유형별 상세 페이지

---

## 9. 접근성 & 성능 & SEO

- **명도 대비 기준**: 본문과 배경의 명도 대비는 **7:1 안팎 권장** (일반 기준 4.5:1 이상 필수). 장년·고령층 시각 특성 고려.
- **색상 단독 전달 금지**: 성공/오류 등 상태 정보는 색만으로 전달하지 않고 아이콘 및 문구(예: "오류:", "완료:")를 반드시 함께 병기 (적록색약 배려).
- **텍스트 가독성 절대 원칙**:
  - 연한 회색 글씨 금지 (`--ydk-muted: #595959` 미만 금지)
  - 이미지 위에 얹은 글씨 금지
  - 그라데이션 배경 위 글씨 금지
- 이미지에는 `alt` 필수, 장식용은 `alt=""`
- 이미지는 WebP 우선, `loading="lazy"`
- 기존 `<title>`, `meta description`, `keywords`는 **유지**하고 페이지마다 고유하게 작성한다. (기존 SEO 손실 방지)
- 기존 URL 구조는 변경하지 않는다. `main/`, `bbs/` 하위 페이지는 URL을 그대로 둔다.
- **서버 설정을 수정할 수 없어 301 리다이렉트는 사용할 수 없다.** 메인 이동은 4-5의 `index.html` 리다이렉트로만 처리하고, `/v2/` 페이지는 각자 자기 자신을 가리키는 `canonical`을 둔다.

---

## 10. Do / Don't

**Do**
- 대표번호는 모든 페이지 헤더에서 항상 보이게 한다.
- 모바일(767px 이하)에서는 화면 하단 플로팅 전화 상담 바를 노출하여 즉시 통화를 유도한다.
- 정보가 많은 페이지일수록 여백과 구분선으로 정리한다.
- 장년층 가독성을 위해 **본문 최소 18px** (모바일 16px), **보조 텍스트 최소 15px** (모바일 13px)를 준수한다.
- 터치 요소는 최소 44px 이상의 터치 타깃 영역을 확보한다.
- 상태 알림은 색상 외에 텍스트·아이콘을 병기한다.
- 반복 정보는 `config.php`, 반복 UI는 `partials/`로 관리한다.

**Don't**
- PHP 8 문법 사용 금지
- 인라인 스타일, `!important` 남발 금지
- 고정 폭(`width: 1200px` 하드코딩, `min-width: 1280px` 등)으로 모바일 화면을 깨뜨리지 않는다.
- 연한 회색 글씨, 이미지 위 텍스트, 그라데이션 배경 위 텍스트 금지
- 색상만으로 상태(성공/실패/주의)를 구분하게 만들기 금지
- 테이블로 레이아웃 잡기 금지
- 그라데이션·이모지·장식용 애니메이션 남발 금지
- 요청하지 않은 기능 추가(회원가입, 결제 등) 금지
- 중개자 고지 문구 삭제 금지
- `.htaccess` 등 서버 설정 변경을 전제로 한 코드·안내 작성 금지

---

## 11. 작업 체크리스트 (페이지 완료 기준)

- [ ] PHP 7.4 문법만 사용했다 (`php -l` 통과)
- [ ] 출력 이스케이프, SQL prepared statement 적용
- [ ] 본문 최소 18px, 보조 글씨 최소 15px 준수 (모바일 가독성 확인)
- [ ] 색상 토큰 및 명도 대비율 준수 (연한 회색 글씨, 이미지/그라데이션 위 글씨 없음)
- [ ] 상태 표현 시 색상 외에 아이콘·문구 병기
- [ ] 허용 컴포넌트만 사용했다
- [ ] 모바일(360px, 390px), 태블릿(768px), PC(1280px, 1920px)에서 레이아웃이 깨지지 않는다
- [ ] 대표번호가 헤더 및 모바일 하단 플로팅 바에서 항상 보인다
- [ ] 모바일에서 원클릭으로 `tel:` 전화 통화가 정상 동작한다
- [ ] 기존 링크와 기능이 모두 유지된다
- [ ] 파일이 `/v2/` 안에만 있고 기존 파일을 건드리지 않았다
- [ ] 경로가 `url()` / `legacy()` / `BASE_URL`로 작성되었다 (상대경로·하드코딩 없음)
- [ ] `/v2/` 직접 접속과 `index.html` 리다이렉트 이후 모두 CSS·JS·이미지가 정상 로드된다
- [ ] `<meta name="viewport" content="width=device-width, initial-scale=1.0">`가 헤더에 포함되어 있다
- [ ] 푸터에 사업자 정보와 중개자 고지가 있다
