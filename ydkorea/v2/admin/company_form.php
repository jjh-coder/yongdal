<?php
/**
 * 용달코리아 v2-1 관리자 지역별 등록 업체 등록/수정 (PHP 7.4.33)
 */
$adminTitle = '지역업체 등록/수정';
require_once __DIR__ . '/includes/header.php';

// 지역 맵 정의
$areaMap = [
    '07' => 'best 용달',
    '08' => '1.4t / 2.5t / 5t',
    '09' => '탑차 (1t~5t)',
    '10' => '리프트차 (1t, 1.4t)',
    '11' => '서울 강남구', '12' => '서울 강동구', '13' => '서울 강서구', '14' => '서울 강북구', '15' => '서울 관악구',
    '16' => '서울 광진구', '17' => '서울 구로구', '18' => '서울 금천구', '19' => '서울 노원구', '20' => '서울 도봉구',
    '21' => '서울 동대문구', '22' => '서울 동작구', '23' => '서울 마포구', '24' => '서울 서대문구', '25' => '서울 서초구',
    '26' => '서울 성동구', '27' => '서울 성북구', '28' => '서울 송파구', '29' => '서울 양천구', '30' => '서울 영등포구',
    '31' => '서울 용산구', '32' => '서울 은평구', '33' => '서울 종로구', '34' => '서울 중구', '35' => '서울 중랑구',
    '36' => '경기 구리/남양주', '37' => '경기 군포/의왕', '38' => '경기 성남/분당', '39' => '경기 평택/송탄', '40' => '경기 수원/병점',
    '41' => '경기 안산/시흥', '42' => '경기 안양/과천', '43' => '경기 오산/동탄', '44' => '인천/부평', '45' => '경기 화성/발안',
    '46' => '경기 광명시', '47' => '경기 양주시', '48' => '경기 의정부시', '49' => '경기 포천시', '50' => '경기 광주시',
    '51' => '경기 고양시', '52' => '경기 김포시', '53' => '경기 부천시', '54' => '경기 용인시', '55' => '경기 파주시', '56' => '경기 하남시',
    '57' => '충남 천안시', '58' => '충북 충주시', '59' => '대전광역시', '60' => '전북 전주시', '61' => '광주광역시',
    '62' => '부산광역시', '63' => '울산광역시', '64' => '대구광역시', '65' => '강원 원주시', '66' => '강원 춘천시',
    '67' => '경북 포항시', '68' => '강원 강릉시', '69' => '경남 창원시', '71' => '경북 구미시', '77' => '경남 진주시',
    '79' => '경남 양산시', '80' => '세종특별자치시', '81' => '전북 군산시', '82' => '전남 순천시',
];

$origId = trim($_GET['id'] ?? '');
$origCode = trim($_GET['code'] ?? '');
$isEdit = ($origId !== '' && $origCode !== '');

$item = null;
if ($isEdit) {
    $item = get_company_by_id_and_code($origId, $origCode);
    if (!$item) {
        echo '<div class="ui negative message" style="margin-top: 20px;">수정할 업체 정보를 찾을 수 없습니다. <a href="' . url('admin/company_list.php') . '">목록으로</a></div>';
        require_once __DIR__ . '/includes/footer.php';
        exit;
    }
}

$msg = '';
$error = '';

// POST 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newId     = trim($_POST['id'] ?? '');
    $newCode   = trim($_POST['code'] ?? '');
    $name      = trim(strip_tags($_POST['name'] ?? ''));
    $tel       = trim(strip_tags($_POST['tel'] ?? ''));
    $detail    = trim(strip_tags($_POST['detail'] ?? ''));

    if (empty($newId)) {
        $error = '관할 지역을 선택해 주세요.';
    } elseif (empty($newCode)) {
        $error = '지점 코드를 입력해 주세요.';
    } elseif (empty($name)) {
        $error = '상호명을 입력해 주세요.';
    } elseif (empty($tel)) {
        $error = '전화번호를 입력해 주세요.';
    } else {
        $saveData = [
            'id'     => $newId,
            'code'   => $newCode,
            'name'   => $name,
            'tel'    => $tel,
            'detail' => $detail,
        ];

        if ($isEdit) {
            $ok = update_company_item($origId, $origCode, $saveData);
            if ($ok) {
                $msg = '업체 정보가 성공적으로 수정되었습니다.';
                $origId = $newId;
                $origCode = $newCode;
                $item = get_company_by_id_and_code($origId, $origCode);
            } else {
                $error = '수정 처리 중 오류가 발생했습니다.';
            }
        } else {
            $ok = insert_company_item($saveData);
            if ($ok) {
                echo '<script>alert("신규 업체가 성공적으로 등록되었습니다."); location.href = "' . url('admin/company_list.php?area=' . urlencode($newId)) . '";</script>';
                exit;
            } else {
                $error = '등록 처리 중 오류가 발생했습니다.';
            }
        }
    }
}

// 폼 초기값
$valId = $_POST['id'] ?? ($item['id'] ?? '11');
$valCode = $_POST['code'] ?? ($item['code'] ?? '');
$valName = $_POST['name'] ?? trim(strip_tags($item['name'] ?? ''));
$valTel = $_POST['tel'] ?? trim(strip_tags($item['tel'] ?? ''));
$valDetail = $_POST['detail'] ?? trim(strip_tags($item['detail'] ?? ''));
?>

<div class="ydk-admin-card">
  <div class="ydk-admin-card-header">
    <div style="display: flex; align-items: center; gap: 10px;">
      <a href="<?= url('admin/company_list.php') ?>" class="ui basic icon button" title="목록으로">
        <i class="arrow left icon"></i>
      </a>
      <h1 class="ydk-admin-card-title">
        <?= $isEdit ? '지역업체 정보 수정' : '신규 지역업체 등록' ?>
      </h1>
    </div>
  </div>

  <?php if (!empty($msg)): ?>
    <div class="ui positive message">
      <i class="check icon"></i> <?= e($msg) ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="ui negative message">
      <i class="exclamation triangle icon"></i> <?= e($error) ?>
    </div>
  <?php endif; ?>

  <div style="max-width: 800px; margin: 0 auto; padding: 20px 0;">
    <form class="ui form" method="post" action="<?= e($_SERVER['REQUEST_URI']) ?>">

      <!-- 지역 선택 -->
      <div class="required field">
        <label style="font-weight: 700;">관할 지역 / 차종 카테고리</label>
        <select name="id" class="ui dropdown" style="height: 44px;" required>
          <?php foreach ($areaMap as $k => $name): ?>
            <option value="<?= e($k) ?>" <?= ($valId === (string)$k) ? 'selected' : '' ?>>
              [코드 <?= e($k) ?>] <?= e($name) ?>
            </option>
          <?php endforeach; ?>
        </select>
        <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 4px;">
          홈페이지 메인 및 지역 리스트 페이지에서 분류 기준이 되는 관할 지역입니다.
        </div>
      </div>

      <!-- 지점 고유 코드 -->
      <div class="required field" style="margin-top: 18px;">
        <label style="font-weight: 700;">지점 고유 코드 (code)</label>
        <input type="text" name="code" value="<?= e($valCode) ?>" required placeholder="예: code_8, j1101, j2601" maxlength="30">
        <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 4px;">
          지점 상세 페이지(/jijum/{code}.html) 식별 코드입니다. 중복되지 않는 영문/숫자로 입력하세요.
        </div>
      </div>

      <!-- 상호명 -->
      <div class="required field" style="margin-top: 18px;">
        <label style="font-weight: 700;">상호명 / 차주명 (name)</label>
        <input type="text" name="name" value="<?= e($valName) ?>" required placeholder="예: 강남개인용달, 성실화물 등" maxlength="50">
        <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 4px;">
          HTML 태그 없이 순수한 업체명/차주 성명만 입력하세요.
        </div>
      </div>

      <!-- 전화번호 -->
      <div class="required field" style="margin-top: 18px;">
        <label style="font-weight: 700;">직통 전화번호 (tel)</label>
        <input type="text" name="tel" value="<?= e($valTel) ?>" required placeholder="예: 010-1234-5678, 02-123-4567" maxlength="30">
        <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 4px;">
          고객이 바로 통화 연결할 대표 전화번호를 입력하세요.
        </div>
      </div>

      <!-- 상세 설명 -->
      <div class="field" style="margin-top: 18px;">
        <label style="font-weight: 700;">주요 업무 및 상세 설명 (detail)</label>
        <textarea name="detail" rows="4" placeholder="예: 1톤 / 원룸이사 / 학생이사 / 소형화물 전문 배차"><?= e($valDetail) ?></textarea>
      </div>

      <!-- 제출 버튼 -->
      <div style="display: flex; gap: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--ydk-adm-border-light);">
        <button type="submit" class="ui primary button" style="min-width: 140px; height: 44px; font-weight: 700;">
          <i class="save icon"></i> <?= $isEdit ? '수정 내용 저장' : '신규 업체 등록' ?>
        </button>
        <a href="<?= url('admin/company_list.php') ?>" class="ui basic button" style="height: 44px; display: inline-flex; align-items: center;">
          목록으로 취소
        </a>
      </div>

    </form>
  </div>

</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
