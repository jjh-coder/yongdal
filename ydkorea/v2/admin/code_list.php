<?php
/**
 * 용달코리아 v2-1 관리자 공통 코드 관리 (PHP 7.4.33, 반응형 웹)
 * 그룹 코드(대분류) 및 세부 코드(상세) CRUD 통합 관리
 */
$adminTitle = '공통 코드 관리';
require_once __DIR__ . '/includes/header.php';

// 선택된 그룹 코드 파라미터
$selectedGroup = trim($_GET['group'] ?? '');

// 1. POST 요청 처리 (그룹 및 세부코드 등록/수정/삭제)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // (1) 그룹 코드 등록
    if ($action === 'add_group') {
        $gCode = strtoupper(trim($_POST['group_code'] ?? ''));
        $gName = trim($_POST['group_name'] ?? '');
        $gDesc = trim($_POST['description'] ?? '');
        $gUse  = ($_POST['is_use'] ?? 'Y') === 'N' ? 'N' : 'Y';
        $gSort = (int)($_POST['sort_order'] ?? 0);

        if (!empty($gCode) && !empty($gName)) {
            $ok = insert_code_group([
                'group_code' => $gCode,
                'group_name' => $gName,
                'description' => $gDesc,
                'is_use' => $gUse,
                'sort_order' => $gSort
            ]);
            if ($ok) {
                $_SESSION['admin_flash'] = ['type' => 'positive', 'message' => "코드 그룹 [{$gCode}]이 성공적으로 등록되었습니다."];
                header('Location: ' . url('admin/code_list.php?group=' . urlencode($gCode)));
                exit;
            } else {
                $_SESSION['admin_flash'] = ['type' => 'negative', 'message' => "그룹 코드 등록 실패: 이미 존재하는 코드이거나 입력값에 오류가 있습니다."];
            }
        } else {
            $_SESSION['admin_flash'] = ['type' => 'negative', 'message' => "그룹 코드와 그룹명을 필수 입력해 주세요."];
        }
        header('Location: ' . url('admin/code_list.php' . ($selectedGroup ? '?group=' . urlencode($selectedGroup) : '')));
        exit;
    }

    // (2) 그룹 코드 수정
    if ($action === 'edit_group') {
        $gCode = strtoupper(trim($_POST['group_code'] ?? ''));
        $gName = trim($_POST['group_name'] ?? '');
        $gDesc = trim($_POST['description'] ?? '');
        $gUse  = ($_POST['is_use'] ?? 'Y') === 'N' ? 'N' : 'Y';
        $gSort = (int)($_POST['sort_order'] ?? 0);

        if (!empty($gCode) && !empty($gName)) {
            $ok = update_code_group($gCode, [
                'group_name' => $gName,
                'description' => $gDesc,
                'is_use' => $gUse,
                'sort_order' => $gSort
            ]);
            if ($ok) {
                $_SESSION['admin_flash'] = ['type' => 'positive', 'message' => "코드 그룹 [{$gCode}] 정보가 수정되었습니다."];
            } else {
                $_SESSION['admin_flash'] = ['type' => 'negative', 'message' => "코드 그룹 수정 처리에 실패했습니다."];
            }
        }
        header('Location: ' . url('admin/code_list.php?group=' . urlencode($gCode)));
        exit;
    }

    // (3) 그룹 코드 삭제
    if ($action === 'delete_group') {
        $gCode = strtoupper(trim($_POST['group_code'] ?? ''));
        if (!empty($gCode) && delete_code_group($gCode)) {
            $_SESSION['admin_flash'] = ['type' => 'positive', 'message' => "코드 그룹 [{$gCode}] 및 소속 세부 코드가 모두 삭제되었습니다."];
            header('Location: ' . url('admin/code_list.php'));
            exit;
        } else {
            $_SESSION['admin_flash'] = ['type' => 'negative', 'message' => "코드 그룹 삭제 처리에 실패했습니다."];
        }
        header('Location: ' . url('admin/code_list.php'));
        exit;
    }

    // (4) 세부 코드 등록
    if ($action === 'add_detail') {
        $gCode = trim($_POST['group_code'] ?? '');
        $cVal  = trim($_POST['code_value'] ?? '');
        $cName = trim($_POST['code_name'] ?? '');
        $cSort = (int)($_POST['sort_order'] ?? 0);
        $cUse  = ($_POST['is_use'] ?? 'Y') === 'N' ? 'N' : 'Y';
        $ex1   = trim($_POST['extra_val_1'] ?? '');
        $ex2   = trim($_POST['extra_val_2'] ?? '');

        if (!empty($gCode) && !empty($cVal) && !empty($cName)) {
            $ok = insert_code_detail([
                'group_code' => $gCode,
                'code_value' => $cVal,
                'code_name' => $cName,
                'sort_order' => $cSort,
                'is_use' => $cUse,
                'extra_val_1' => $ex1,
                'extra_val_2' => $ex2
            ]);
            if ($ok) {
                $_SESSION['admin_flash'] = ['type' => 'positive', 'message' => "세부 코드 [{$cName}] ({$cVal})이 등록되었습니다."];
            } else {
                $_SESSION['admin_flash'] = ['type' => 'negative', 'message' => "세부 코드 등록 실패: 동일 그룹 내 이미 존재하는 코드값이거나 오류입니다."];
            }
        } else {
            $_SESSION['admin_flash'] = ['type' => 'negative', 'message' => "소속 그룹, 코드값, 표시명은 필수 입력 항목입니다."];
        }
        header('Location: ' . url('admin/code_list.php?group=' . urlencode($gCode)));
        exit;
    }

    // (5) 세부 코드 수정
    if ($action === 'edit_detail') {
        $dId   = (int)($_POST['detail_id'] ?? 0);
        $gCode = trim($_POST['group_code'] ?? '');
        $cVal  = trim($_POST['code_value'] ?? '');
        $cName = trim($_POST['code_name'] ?? '');
        $cSort = (int)($_POST['sort_order'] ?? 0);
        $cUse  = ($_POST['is_use'] ?? 'Y') === 'N' ? 'N' : 'Y';
        $ex1   = trim($_POST['extra_val_1'] ?? '');
        $ex2   = trim($_POST['extra_val_2'] ?? '');

        if ($dId > 0 && !empty($cVal) && !empty($cName)) {
            $ok = update_code_detail($dId, [
                'code_value' => $cVal,
                'code_name' => $cName,
                'sort_order' => $cSort,
                'is_use' => $cUse,
                'extra_val_1' => $ex1,
                'extra_val_2' => $ex2
            ]);
            if ($ok) {
                $_SESSION['admin_flash'] = ['type' => 'positive', 'message' => "세부 코드 [{$cName}] 정보가 수정되었습니다."];
            } else {
                $_SESSION['admin_flash'] = ['type' => 'negative', 'message' => "세부 코드 수정 처리에 실패했습니다."];
            }
        }
        header('Location: ' . url('admin/code_list.php?group=' . urlencode($gCode)));
        exit;
    }

    // (6) 세부 코드 단건 삭제
    if ($action === 'delete_detail') {
        $dId   = (int)($_POST['detail_id'] ?? 0);
        $gCode = trim($_POST['group_code'] ?? '');
        if ($dId > 0 && delete_code_detail($dId)) {
            $_SESSION['admin_flash'] = ['type' => 'positive', 'message' => "세부 코드가 성공적으로 삭제되었습니다."];
        } else {
            $_SESSION['admin_flash'] = ['type' => 'negative', 'message' => "세부 코드 삭제에 실패했습니다."];
        }
        header('Location: ' . url('admin/code_list.php?group=' . urlencode($gCode)));
        exit;
    }

    // (7) 세부 코드 선택 일괄 삭제
    if ($action === 'batch_delete_detail') {
        $ids = $_POST['ids'] ?? [];
        $gCode = trim($_POST['group_code'] ?? '');
        if (is_array($ids) && count($ids) > 0) {
            $cnt = delete_code_details($ids);
            $_SESSION['admin_flash'] = ['type' => 'positive', 'message' => "선택하신 세부 코드 총 {$cnt}건이 삭제되었습니다."];
        } else {
            $_SESSION['admin_flash'] = ['type' => 'negative', 'message' => "삭제할 세부 코드를 1개 이상 선택해 주세요."];
        }
        header('Location: ' . url('admin/code_list.php?group=' . urlencode($gCode)));
        exit;
    }
}

// 플래시 메시지
$flash = $_SESSION['admin_flash'] ?? null;
if (isset($_SESSION['admin_flash'])) {
    unset($_SESSION['admin_flash']);
}

// 2. 데이터 조회
$groupList = get_code_groups();
// 첫 진입 시 선택된 그룹이 없고 그룹이 존재하면 첫 번째 그룹 자동 선택
if (empty($selectedGroup) && !empty($groupList)) {
    $selectedGroup = $groupList[0]['group_code'];
}

$detailList = get_code_details($selectedGroup);
$currentGroupInfo = null;
foreach ($groupList as $g) {
    if ($g['group_code'] === $selectedGroup) {
        $currentGroupInfo = $g;
        break;
    }
}
?>

<div class="ydk-admin-card">
  <!-- 상단 알림 메시지 -->
  <?php if (!empty($flash)): ?>
    <div class="ui <?= e($flash['type'] ?? 'info') ?> message" style="margin-bottom: 20px;">
      <i class="<?= ($flash['type'] === 'positive') ? 'check' : 'exclamation triangle' ?> icon"></i>
      <?= e($flash['message']) ?>
    </div>
  <?php endif; ?>

  <!-- 상단 헤더 -->
  <div class="ydk-admin-card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
    <div>
      <h1 class="ydk-admin-card-title" style="margin: 0;">
        <i class="tags icon"></i> 공통 코드 관리 시스템
      </h1>
      <p style="margin: 4px 0 0 0; font-size: 14px; color: var(--ydk-adm-muted);">
        용달코리아 전반에서 사용하는 화물 차종, 이사 구분, 진행 상태 등의 공통 분류 코드를 그룹별로 체계적으로 관리합니다.
      </p>
    </div>
    <div>
      <a href="<?= url('admin/sql/schema_code.sql') ?>" target="_blank" class="ui basic small button" title="테이블 스키마 파일 확인">
        <i class="database icon"></i> SQL 스키마 스크립트 보기
      </a>
    </div>
  </div>

  <!-- 2단 그리드 레이아웃 (좌측: 그룹 코드 / 우측: 세부 코드) -->
  <div class="ui stackable grid" style="margin-top: 10px;">

    <!-- ================= 좌측: 코드 그룹 (대분류) ================= -->
    <div class="five wide column">
      <div style="background: #FFFFFF; border: 1px solid var(--ydk-adm-border); border-radius: 8px; padding: 18px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 2px solid var(--ydk-adm-primary); padding-bottom: 8px;">
          <h3 style="margin: 0; font-size: 16px; font-weight: 800; color: var(--ydk-adm-primary);">
            <i class="folder open outline icon"></i> 코드 그룹 (대분류)
          </h3>
          <button type="button" class="ui mini primary button" onclick="openAddGroupModal()" style="font-weight: 700;">
            <i class="plus icon"></i> 그룹 등록
          </button>
        </div>

        <div style="max-height: 600px; overflow-y: auto;">
          <table class="ui celled table unstackable selectable" style="font-size: 13px;">
            <thead>
              <tr>
                <th>그룹 코드 / 명칭</th>
                <th style="width: 55px; text-align: center;">건수</th>
                <th style="width: 55px; text-align: center;">관리</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($groupList)): ?>
                <tr>
                  <td colspan="3" style="text-align: center; color: var(--ydk-adm-muted); padding: 20px;">
                    등록된 그룹이 없습니다.
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($groupList as $g): 
                  $isActiveGroup = ($g['group_code'] === $selectedGroup);
                ?>
                  <tr style="<?= $isActiveGroup ? 'background: #EFF6FF; font-weight: 700;' : '' ?>">
                    <td>
                      <a href="<?= url('admin/code_list.php?group=' . urlencode($g['group_code'])) ?>" style="display: block; color: <?= $isActiveGroup ? '#1D4ED8' : '#1E293B' ?>;">
                        <div style="font-weight: 800;"><?= e($g['group_name']) ?></div>
                        <div style="font-size: 12px; color: var(--ydk-adm-muted);"><?= e($g['group_code']) ?></div>
                      </a>
                    </td>
                    <td style="text-align: center;">
                      <span class="ui tiny label <?= $g['detail_count'] > 0 ? 'blue' : 'grey' ?>">
                        <?= (int)$g['detail_count'] ?>
                      </span>
                    </td>
                    <td style="text-align: center; padding: 4px;">
                      <div class="ui icon dropdown mini basic button" style="padding: 6px 8px;" onclick="event.stopPropagation();">
                        <i class="ellipsis vertical icon"></i>
                        <div class="menu">
                          <div class="item" onclick="openEditGroupModal(<?= htmlspecialchars(json_encode($g), ENT_QUOTES, 'UTF-8') ?>)">
                            <i class="edit icon"></i> 수정
                          </div>
                          <div class="item" style="color: #DC2626;" onclick="deleteGroup('<?= e(addslashes($g['group_code'])) ?>', '<?= e(addslashes($g['group_name'])) ?>', <?= (int)$g['detail_count'] ?>)">
                            <i class="trash icon"></i> 삭제
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ================= 우측: 세부 코드 (상세) ================= -->
    <div class="eleven wide column">
      <div style="background: #FFFFFF; border: 1px solid var(--ydk-adm-border); border-radius: 8px; padding: 18px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 2px solid #0284C7; padding-bottom: 8px; flex-wrap: wrap; gap: 8px;">
          <div>
            <h3 style="margin: 0; font-size: 16px; font-weight: 800; color: #0369A1;">
              <i class="list ol icon"></i> 
              <?php if ($currentGroupInfo): ?>
                [<?= e($currentGroupInfo['group_code']) ?>] <?= e($currentGroupInfo['group_name']) ?> 세부 코드
              <?php else: ?>
                세부 코드 관리
              <?php endif; ?>
              <span style="font-size: 13px; font-weight: normal; color: var(--ydk-adm-muted); margin-left: 6px;">
                (총 <?= count($detailList) ?>건)
              </span>
            </h3>
            <?php if (!empty($currentGroupInfo['description'])): ?>
              <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 3px;">
                <?= e($currentGroupInfo['description']) ?>
              </div>
            <?php endif; ?>
          </div>

          <div style="display: flex; gap: 6px;">
            <?php if (!empty($selectedGroup)): ?>
              <button type="button" class="ui positive small button" onclick="openAddDetailModal('<?= e(addslashes($selectedGroup)) ?>')" style="font-weight: 700;">
                <i class="plus icon"></i> 세부코드 등록
              </button>
            <?php endif; ?>
            <button type="button" class="ui negative basic small button" onclick="deleteBatchDetail()">
              <i class="trash alternate icon"></i> 선택 삭제
            </button>
          </div>
        </div>

        <!-- 세부 코드 일괄 삭제 폼 -->
        <form id="batchDetailForm" method="post" action="<?= url('admin/code_list.php') ?>">
          <input type="hidden" name="action" value="batch_delete_detail">
          <input type="hidden" name="group_code" value="<?= e($selectedGroup) ?>">
        </form>

        <div style="overflow-x: auto;">
          <table class="ui celled table unstackable selectable" style="font-size: 14px;">
            <thead>
              <tr>
                <th style="width: 40px; text-align: center;">
                  <input type="checkbox" id="checkAllDetail" style="cursor: pointer;">
                </th>
                <th style="width: 55px; text-align: center;">순서</th>
                <th style="width: 130px;">코드값 (Key)</th>
                <th>코드 표시명</th>
                <th style="width: 140px;">추가 속성 1</th>
                <th style="width: 160px;">추가 속성 2</th>
                <th style="width: 70px; text-align: center;">사용</th>
                <th style="width: 110px; text-align: center;">관리</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($detailList)): ?>
                <tr>
                  <td colspan="8" style="text-align: center; color: var(--ydk-adm-muted); padding: 40px 20px;">
                    <i class="info circle icon"></i> 등록된 세부 코드가 없습니다. 상단 [세부코드 등록] 버튼을 눌러 추가해 주세요.
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($detailList as $d): ?>
                  <tr>
                    <td style="text-align: center;">
                      <input type="checkbox" name="ids[]" value="<?= (int)$d['id'] ?>" class="detail-chk" form="batchDetailForm" style="cursor: pointer;">
                    </td>
                    <td style="text-align: center; color: var(--ydk-adm-muted); font-size: 13px;">
                      <?= (int)$d['sort_order'] ?>
                    </td>
                    <td>
                      <code style="background: #F1F5F9; color: #0F172A; padding: 2px 6px; border-radius: 4px; font-weight: 700;">
                        <?= e($d['code_value']) ?>
                      </code>
                    </td>
                    <td>
                      <strong style="color: #1E293B;"><?= e($d['code_name']) ?></strong>
                    </td>
                    <td style="color: #475569; font-size: 13px;">
                      <?= e($d['extra_val_1'] ?: '-') ?>
                    </td>
                    <td style="color: #64748B; font-size: 13px;">
                      <?= e($d['extra_val_2'] ?: '-') ?>
                    </td>
                    <td style="text-align: center;">
                      <?php if (($d['is_use'] ?? 'Y') === 'Y'): ?>
                        <span class="ui mini green label" style="font-weight: 700;">사용</span>
                      <?php else: ?>
                        <span class="ui mini grey label">중지</span>
                      <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                      <div class="ui mini buttons">
                        <button type="button" class="ui button basic primary" style="padding: 5px 8px;" onclick="openEditDetailModal(<?= htmlspecialchars(json_encode($d), ENT_QUOTES, 'UTF-8') ?>)">
                          수정
                        </button>
                        <button type="button" class="ui button basic negative" style="padding: 5px 8px;" onclick="deleteDetailSingle(<?= (int)$d['id'] ?>, '<?= e(addslashes($d['code_name'])) ?>', '<?= e(addslashes($selectedGroup)) ?>')">
                          삭제
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- ================= 모달 1: 코드 그룹 등록/수정 모달 ================= -->
<div class="ui tiny modal" id="groupModal">
  <div class="header" id="groupModalTitle">
    <i class="folder icon"></i> 코드 그룹 등록
  </div>
  <div class="content">
    <form class="ui form" id="groupForm" method="post" action="<?= url('admin/code_list.php') ?>">
      <input type="hidden" name="action" id="groupAction" value="add_group">

      <div class="required field">
        <label>그룹 코드 (영문 대문자/언더바)</label>
        <input type="text" name="group_code" id="m_group_code" required placeholder="예: CAR_TYPE, MOVE_TYPE" maxlength="50" style="text-transform: uppercase;">
        <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 3px;">영문 대문자, 숫자, 언더바(_)만 권장 (등록 후 코드 변경 불가)</div>
      </div>

      <div class="required field">
        <label>그룹 코드명</label>
        <input type="text" name="group_name" id="m_group_name" required placeholder="예: 화물 차종 구분" maxlength="100">
      </div>

      <div class="field">
        <label>그룹 설명</label>
        <input type="text" name="description" id="m_group_desc" placeholder="코드 그룹에 대한 간단한 용도 설명" maxlength="255">
      </div>

      <div class="two fields">
        <div class="field">
          <label>정렬 순서</label>
          <input type="number" name="sort_order" id="m_group_sort" value="10" step="10">
        </div>
        <div class="field">
          <label>사용 여부</label>
          <select name="is_use" id="m_group_use" class="ui dropdown">
            <option value="Y">Y (사용)</option>
            <option value="N">N (미사용)</option>
          </select>
        </div>
      </div>
    </form>
  </div>
  <div class="actions">
    <button type="button" class="ui cancel button">취소</button>
    <button type="button" class="ui primary button" onclick="submitGroupForm()">
      <i class="save icon"></i> 저장하기
    </button>
  </div>
</div>

<!-- ================= 모달 2: 세부 코드 등록/수정 모달 ================= -->
<div class="ui tiny modal" id="detailModal">
  <div class="header" id="detailModalTitle">
    <i class="tag icon"></i> 세부 코드 등록
  </div>
  <div class="content">
    <form class="ui form" id="detailForm" method="post" action="<?= url('admin/code_list.php') ?>">
      <input type="hidden" name="action" id="detailAction" value="add_detail">
      <input type="hidden" name="detail_id" id="m_detail_id" value="">

      <div class="required field">
        <label>소속 그룹 코드</label>
        <select name="group_code" id="m_detail_group" class="ui dropdown" required>
          <?php foreach ($groupList as $g): ?>
            <option value="<?= e($g['group_code']) ?>" <?= ($g['group_code'] === $selectedGroup) ? 'selected' : '' ?>>
              [<?= e($g['group_code']) ?>] <?= e($g['group_name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="two fields">
        <div class="required field">
          <label>코드값 (Key)</label>
          <input type="text" name="code_value" id="m_detail_val" required placeholder="예: 1t_cargo, 접수" maxlength="50">
        </div>
        <div class="required field">
          <label>코드 표시명 (Name)</label>
          <input type="text" name="code_name" id="m_detail_name" required placeholder="예: 1톤 일반 카고" maxlength="100">
        </div>
      </div>

      <div class="two fields">
        <div class="field">
          <label>정렬 순서</label>
          <input type="number" name="sort_order" id="m_detail_sort" value="10" step="10">
        </div>
        <div class="field">
          <label>사용 여부</label>
          <select name="is_use" id="m_detail_use" class="ui dropdown">
            <option value="Y">Y (사용)</option>
            <option value="N">N (미사용)</option>
          </select>
        </div>
      </div>

      <div class="field">
        <label>추가 속성 1 (아이콘/뱃지색상 등)</label>
        <input type="text" name="extra_val_1" id="m_detail_ex1" placeholder="예: truck, blue, 1.2 등" maxlength="255">
      </div>

      <div class="field">
        <label>추가 속성 2 (보조 설명/특이사항)</label>
        <input type="text" name="extra_val_2" id="m_detail_ex2" placeholder="예: 소형 원룸 최적" maxlength="255">
      </div>
    </form>
  </div>
  <div class="actions">
    <button type="button" class="ui cancel button">취소</button>
    <button type="button" class="ui primary button" onclick="submitDetailForm()">
      <i class="save icon"></i> 저장하기
    </button>
  </div>
</div>

<!-- 단건 삭제용 숨김 폼 -->
<form id="singleGroupDeleteForm" method="post" action="<?= url('admin/code_list.php') ?>" style="display: none;">
  <input type="hidden" name="action" value="delete_group">
  <input type="hidden" name="group_code" id="singleGroupCode" value="">
</form>

<form id="singleDetailDeleteForm" method="post" action="<?= url('admin/code_list.php') ?>" style="display: none;">
  <input type="hidden" name="action" value="delete_detail">
  <input type="hidden" name="detail_id" id="singleDetailId" value="">
  <input type="hidden" name="group_code" id="singleDetailGroup" value="">
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Fomantic UI 드롭다운 초기화
  if (typeof $ !== 'undefined' && $.fn.dropdown) {
    $('.ui.dropdown').dropdown();
  }

  // 전체 선택 체크박스
  var checkAll = document.getElementById('checkAllDetail');
  var detailChecks = document.querySelectorAll('.detail-chk');
  if (checkAll) {
    checkAll.addEventListener('change', function () {
      var isChecked = this.checked;
      detailChecks.forEach(function (chk) {
        chk.checked = isChecked;
      });
    });
  }
});

// 그룹 등록 모달 열기
function openAddGroupModal() {
  document.getElementById('groupModalTitle').innerHTML = '<i class="plus icon"></i> 코드 그룹 등록';
  document.getElementById('groupAction').value = 'add_group';
  document.getElementById('m_group_code').value = '';
  document.getElementById('m_group_code').readOnly = false;
  document.getElementById('m_group_name').value = '';
  document.getElementById('m_group_desc').value = '';
  document.getElementById('m_group_sort').value = '10';
  document.getElementById('m_group_use').value = 'Y';
  $('#groupModal').modal('show');
}

// 그룹 수정 모달 열기
function openEditGroupModal(groupData) {
  document.getElementById('groupModalTitle').innerHTML = '<i class="edit icon"></i> 코드 그룹 수정: ' + groupData.group_code;
  document.getElementById('groupAction').value = 'edit_group';
  document.getElementById('m_group_code').value = groupData.group_code;
  document.getElementById('m_group_code').readOnly = true;
  document.getElementById('m_group_name').value = groupData.group_name || '';
  document.getElementById('m_group_desc').value = groupData.description || '';
  document.getElementById('m_group_sort').value = groupData.sort_order || 0;
  document.getElementById('m_group_use').value = groupData.is_use || 'Y';
  $('#groupModal').modal('show');
}

function submitGroupForm() {
  var code = document.getElementById('m_group_code').value.trim();
  var name = document.getElementById('m_group_name').value.trim();
  if (!code || !name) {
    alert('그룹 코드와 그룹명을 입력해 주세요.');
    return;
  }
  document.getElementById('groupForm').submit();
}

// 그룹 삭제 확인
function deleteGroup(groupCode, groupName, count) {
  var msg = '코드 그룹 [' + groupName + ' (' + groupCode + ')]을 정말 삭제하시겠습니까?\n' +
            (count > 0 ? '※ 주의: 이 그룹에 속한 세부 코드 ' + count + '건도 함께 영구 삭제됩니다!' : '');
  if (confirm(msg)) {
    document.getElementById('singleGroupCode').value = groupCode;
    document.getElementById('singleGroupDeleteForm').submit();
  }
}

// 세부코드 등록 모달 열기
function openAddDetailModal(groupCode) {
  document.getElementById('detailModalTitle').innerHTML = '<i class="plus icon"></i> 세부 코드 등록';
  document.getElementById('detailAction').value = 'add_detail';
  document.getElementById('m_detail_id').value = '';
  if (groupCode) {
    document.getElementById('m_detail_group').value = groupCode;
  }
  document.getElementById('m_detail_val').value = '';
  document.getElementById('m_detail_val').readOnly = false;
  document.getElementById('m_detail_name').value = '';
  document.getElementById('m_detail_sort').value = '10';
  document.getElementById('m_detail_use').value = 'Y';
  document.getElementById('m_detail_ex1').value = '';
  document.getElementById('m_detail_ex2').value = '';
  $('#detailModal').modal('show');
}

// 세부코드 수정 모달 열기
function openEditDetailModal(detailData) {
  document.getElementById('detailModalTitle').innerHTML = '<i class="edit icon"></i> 세부 코드 수정: ' + detailData.code_name;
  document.getElementById('detailAction').value = 'edit_detail';
  document.getElementById('m_detail_id').value = detailData.id;
  document.getElementById('m_detail_group').value = detailData.group_code;
  document.getElementById('m_detail_val').value = detailData.code_value || '';
  document.getElementById('m_detail_name').value = detailData.code_name || '';
  document.getElementById('m_detail_sort').value = detailData.sort_order || 0;
  document.getElementById('m_detail_use').value = detailData.is_use || 'Y';
  document.getElementById('m_detail_ex1').value = detailData.extra_val_1 || '';
  document.getElementById('m_detail_ex2').value = detailData.extra_val_2 || '';
  $('#detailModal').modal('show');
}

function submitDetailForm() {
  var val = document.getElementById('m_detail_val').value.trim();
  var name = document.getElementById('m_detail_name').value.trim();
  if (!val || !name) {
    alert('코드값과 코드 표시명을 입력해 주세요.');
    return;
  }
  document.getElementById('detailForm').submit();
}

// 세부코드 단건 삭제
function deleteDetailSingle(id, name, groupCode) {
  var msg = '세부 코드 [' + name + ']을 정말 삭제하시겠습니까?\n삭제 후에는 복구할 수 없습니다.';
  if (confirm(msg)) {
    document.getElementById('singleDetailId').value = id;
    document.getElementById('singleDetailGroup').value = groupCode;
    document.getElementById('singleDetailDeleteForm').submit();
  }
}

// 세부코드 선택 일괄 삭제
function deleteBatchDetail() {
  var checked = document.querySelectorAll('.detail-chk:checked');
  if (checked.length === 0) {
    alert('삭제할 세부 코드를 1개 이상 선택해 주세요.');
    return;
  }

  var msg = '선택하신 총 ' + checked.length + '건의 세부 코드를 정말로 일괄 삭제하시겠습니까?\n삭제 후에는 복구할 수 없습니다.';
  if (confirm(msg)) {
    document.getElementById('batchDetailForm').submit();
  }
}
</script>

<?php
require_once __DIR__ . '/includes/footer.php';
