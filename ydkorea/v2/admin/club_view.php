<?php
/**
 * 용달코리아 v2-1 관리자 차주회원 상세 보기 & 상태 관리 (PHP 7.4.33)
 */
$adminTitle = '차주회원 상세 정보';
require_once __DIR__ . '/includes/header.php';

$id = (int)($_GET['id'] ?? 0);
$member = get_club_by_id($id);

if (!$member) {
    echo '<div class="ui negative message" style="margin-top: 20px;">존재하지 않거나 삭제된 차주회원 정보입니다. <a href="' . url('admin/club_list.php') . '">목록으로 돌아가기</a></div>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$saveMessage = '';
$saveError = '';

// POST 처리: 상태 및 메모 수정 또는 삭제
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = trim($_POST['action'] ?? 'update');

    if ($action === 'delete') {
        $delOk = delete_club_item($id);
        if ($delOk) {
            echo '<script>alert("차주회원 정보가 삭제되었습니다."); location.href = "' . url('admin/club_list.php') . '";</script>';
            exit;
        } else {
            $saveError = '삭제 처리 중 오류가 발생했습니다.';
        }
    } else {
        $newStatus = trim($_POST['status'] ?? '');
        $adminMemo = trim($_POST['admin_memo'] ?? '');

        if (in_array($newStatus, ['신청', '승인', '보류', '탈퇴'])) {
            $ok = update_club_status($id, $newStatus, $adminMemo);
            if ($ok) {
                $saveMessage = '차주회원 상태 및 관리자 메모가 성공적으로 저장되었습니다.';
                $member = get_club_by_id($id);
            } else {
                $saveError = '저장 처리 중 오류가 발생했습니다.';
            }
        } else {
            $saveError = '올바른 처리 상태를 선택해 주세요.';
        }
    }
}

$st = $member['status'] ?? '신청';
$badgeClass = '대기';
if ($st === '승인') $badgeClass = '배차완료';
elseif ($st === '신청') $badgeClass = '접수';
elseif ($st === '보류') $badgeClass = '상담중';
elseif ($st === '탈퇴') $badgeClass = '취소';
?>

<div class="ydk-admin-card">
  <div class="ydk-admin-card-header">
    <div style="display: flex; align-items: center; gap: 10px;">
      <a href="<?= url('admin/club_list.php') ?>" class="ui basic icon button" title="목록으로">
        <i class="arrow left icon"></i>
      </a>
      <h1 class="ydk-admin-card-title">
        차주회원 상세 정보 #<?= (int)$member['id'] ?> (<?= e($member['name']) ?>)
        <span class="ydk-badge-status <?= e($badgeClass) ?>" style="margin-left: 10px;"><?= e($st) ?></span>
      </h1>
    </div>
    <div style="display: flex; gap: 8px;">
      <a href="tel:<?= preg_replace('/[^0-9]/', '', $member['hp']) ?>" class="ui button" style="background-color: var(--ydk-adm-accent); color: #FFFFFF;">
        <i class="phone icon"></i> 전화 걸기
      </a>
    </div>
  </div>

  <?php if (!empty($saveMessage)): ?>
    <div class="ui positive message">
      <i class="check icon"></i> <?= e($saveMessage) ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($saveError)): ?>
    <div class="ui negative message">
      <i class="exclamation triangle icon"></i> <?= e($saveError) ?>
    </div>
  <?php endif; ?>

  <div class="ydk-detail-grid">
    <!-- 좌측: 차주 신청 상세 정보 -->
    <div>
      <h3 style="font-size: 17px; font-weight: 700; color: #1E293B; margin-bottom: 12px;">
        <i class="id badge outline icon"></i> 차주 기본 및 차량 정보
      </h3>
      <table class="ui celled definition table ydk-detail-info-table">
        <tbody>
          <tr>
            <th style="width: 140px;">성명</th>
            <td><strong><?= e($member['name']) ?></strong></td>
          </tr>
          <tr>
            <th>회사명 / 상호</th>
            <td><strong><?= e($member['c_name'] ?: '-') ?></strong></td>
          </tr>
          <tr>
            <th>휴대폰 번호</th>
            <td>
              <a href="tel:<?= preg_replace('/[^0-9]/', '', $member['hp']) ?>" style="font-size: 17px; font-weight: 700; color: #2563EB;">
                <?= e($member['hp']) ?>
              </a>
              <span style="font-size: 13px; color: var(--ydk-adm-muted); margin-left: 8px;">(클릭 시 즉시 통화)</span>
            </td>
          </tr>
          <tr>
            <th>일반 전화번호</th>
            <td><?= e($member['tel'] ?: '-') ?></td>
          </tr>
          <tr>
            <th>이메일 주소</th>
            <td><?= e($member['e_mail'] ?: '-') ?></td>
          </tr>
          <tr>
            <th>보유 차량</th>
            <td>
              <span class="ui blue small label" style="font-size: 14px;"><?= e($member['car']) ?></span>
            </td>
          </tr>
          <tr>
            <th>차량 번호</th>
            <td><strong style="color: #1E293B; font-size: 15px;"><?= e($member['car_no']) ?></strong></td>
          </tr>
          <tr>
            <th>거주지 및 희망 활동지역</th>
            <td>
              <i class="map marker alternate icon" style="color: #2563EB;"></i>
              <strong><?= e($member['ad']) ?></strong>
            </td>
          </tr>
          <tr>
            <th>신청 일시</th>
            <td><?= e($member['created_at']) ?> (IP: <?= e($member['client_ip'] ?: '-') ?>)</td>
          </tr>
        </tbody>
      </table>

      <h3 style="font-size: 17px; font-weight: 700; color: #1E293B; margin: 24px 0 12px 0;">
        <i class="file text outline icon"></i> 차주 자기소개 및 경력사항
      </h3>
      <div style="background-color: #F8FAFC; border: 1px solid var(--ydk-adm-border-light); border-radius: 8px; padding: 20px; font-size: 15px; line-height: 1.8; color: #1E293B; white-space: pre-wrap;"><?= e($member['fro'] ?: '(작성된 자기소개가 없습니다)') ?></div>
    </div>

    <!-- 우측: 관리자 상태 변경 및 메모 폼 -->
    <div>
      <div style="background-color: #F8FAFC; border: 1px solid var(--ydk-adm-border); border-radius: 10px; padding: 22px;">
        <h3 style="font-size: 18px; font-weight: 800; color: var(--ydk-adm-primary); margin-top: 0; margin-bottom: 16px;">
          <i class="cogs icon"></i> 회원 상태 &amp; 등록비 관리
        </h3>

        <form class="ui form" method="post" action="<?= e($_SERVER['REQUEST_URI']) ?>">
          <input type="hidden" name="action" value="update">

          <div class="field">
            <label style="font-weight: 700;">회원 상태 변경</label>
            <select name="status" class="ui dropdown" style="height: 44px;">
              <option value="신청" <?= ($st === '신청') ? 'selected' : '' ?>>신청 (가입 대기)</option>
              <option value="승인" <?= ($st === '승인') ? 'selected' : '' ?>>승인 (정회원 승인 / 배차 연동)</option>
              <option value="보류" <?= ($st === '보류') ? 'selected' : '' ?>>보류 (등록비 미입금 / 서류 확인)</option>
              <option value="탈퇴" <?= ($st === '탈퇴') ? 'selected' : '' ?>>탈퇴 (활동 종료 / 중단)</option>
            </select>
          </div>

          <div class="field" style="margin-top: 18px;">
            <label style="font-weight: 700;">관리자 메모 &amp; 배차 관할구역</label>
            <textarea name="admin_memo" rows="8" placeholder="등록비 입금일자(기업은행 010-8833-1412), 배정 관할 구역(예: 서울 성동구, 강남구), 특이사항 등을 기록하세요."><?= e($member['admin_memo'] ?? '') ?></textarea>
          </div>

          <div style="margin-top: 20px;">
            <button type="submit" class="ui fluid button" style="background-color: var(--ydk-adm-primary); color: var(--ydk-adm-on-primary); height: 46px; font-weight: 700; font-size: 16px;">
              <i class="save icon"></i> 저장하기
            </button>
          </div>
        </form>

        <?php if (!empty($member['updated_at'])): ?>
          <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 12px; text-align: right;">
            최근 수정: <?= e($member['updated_at']) ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- 위험 구역: 회원 정보 삭제 -->
      <div style="margin-top: 18px; background: #FFF; border: 1px dashed #EF4444; border-radius: 8px; padding: 16px;">
        <div style="font-size: 13px; color: #DC2626; font-weight: 700; margin-bottom: 8px;">
          <i class="trash alternate outline icon"></i> 차주회원 정보 삭제
        </div>
        <p style="font-size: 12px; color: #64748B; margin-bottom: 12px;">삭제된 신청 정보는 복구되지 않습니다. 신중히 결정해 주세요.</p>
        <form method="post" action="<?= e($_SERVER['REQUEST_URI']) ?>" onsubmit="return confirm('정말로 이 차주회원 신청 정보를 삭제하시겠습니까?');">
          <input type="hidden" name="action" value="delete">
          <button type="submit" class="ui fluid negative basic button">
            회원 정보 삭제
          </button>
        </form>
      </div>

      <div style="margin-top: 18px;">
        <a href="<?= url('admin/club_list.php') ?>" class="ui fluid basic button" style="height: 44px; display: flex; align-items: center; justify-content: center;">
          <i class="list icon"></i> 차주회원 목록으로 돌아가기
        </a>
      </div>
    </div>
  </div>

</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
