<?php
/**
 * 용달코리아 v2 관리자 온라인 상담 상세 보기 & 상태 변경 (PHP 7.4.33)
 */
$adminTitle = '상담 내역 상세';
require_once __DIR__ . '/includes/header.php';

$id = (int)($_GET['id'] ?? 0);
$consult = get_consult_by_id($id);

if (!$consult) {
    echo '<div class="ui negative message" style="margin-top: 20px;">존재하지 않거나 삭제된 상담 내역입니다. <a href="' . url('admin/consult_list.php') . '">목록으로 돌아가기</a></div>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$saveMessage = '';
$saveError = '';

// 상태 및 메모 수정 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newStatus = trim($_POST['status'] ?? '');
    $adminMemo = trim($_POST['admin_memo'] ?? '');

    if (in_array($newStatus, ['접수', '상담중', '배차완료', '취소'])) {
        $ok = update_consult_status($id, $newStatus, $adminMemo);
        if ($ok) {
            $saveMessage = '상담 처리 상태 및 관리자 메모가 성공적으로 저장되었습니다.';
            // 최신 데이터 다시 로드
            $consult = get_consult_by_id($id);
        } else {
            $saveError = '저장 처리 중 오류가 발생했습니다.';
        }
    } else {
        $saveError = '올바른 처리 상태를 선택해 주세요.';
    }
}

$carTypes = [
    '1t_cargo' => '1톤 일반 카고 (기본 용달)',
    '1t_top' => '1톤 탑차 (방수·안심 화물)',
    '1t_lift' => '1톤 리프트차 (중량물·오토바이)',
    '1.4t_cargo' => '1.4톤 화물 트럭',
    '2.5t_cargo' => '2.5톤 중형 화물',
    '5t_cargo' => '5톤 대형 화물',
    'room_move' => '원룸 / 소형 이사',
    'office_move' => '사무실 / 기업 이전'
];
$carName = $carTypes[$consult['car_type']] ?? ($consult['car_type'] ?: '상담 후 차종 결정');
$st = $consult['status'] ?? '접수';
?>

<div class="ydk-admin-card">
  <div class="ydk-admin-card-header">
    <div style="display: flex; align-items: center; gap: 10px;">
      <a href="<?= url('admin/consult_list.php') ?>" class="ui basic icon button" title="목록으로">
        <i class="arrow left icon"></i>
      </a>
      <h1 class="ydk-admin-card-title">
        상담 상세 내역 #<?= (int)$consult['id'] ?>
        <span class="ydk-badge-status <?= e($st) ?>" style="margin-left: 10px;"><?= e($st) ?></span>
      </h1>
    </div>
    <div>
      <a href="tel:<?= preg_replace('/[^0-9]/', '', $consult['tel']) ?>" class="ui huge button" style="background-color: var(--ydk-adm-accent); color: #FFFFFF;">
        <i class="phone icon"></i> 고객에게 바로 전화 걸기
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
    <!-- 좌측: 신청 내용 상세 -->
    <div>
      <h3 style="font-size: 17px; font-weight: 700; color: #1E293B; margin-bottom: 12px;">
        <i class="user outline icon"></i> 고객 신청 정보
      </h3>
      <table class="ui celled definition table ydk-detail-info-table">
        <tbody>
          <tr>
            <th>신청자명</th>
            <td><strong><?= e($consult['name']) ?></strong></td>
          </tr>
          <tr>
            <th>전화번호</th>
            <td>
              <a href="tel:<?= preg_replace('/[^0-9]/', '', $consult['tel']) ?>" style="font-size: 18px; font-weight: 700; color: #2563EB;">
                <?= e($consult['tel']) ?>
              </a>
              <span style="font-size: 13px; color: var(--ydk-adm-muted); margin-left: 8px;">(클릭 시 통화 연결)</span>
            </td>
          </tr>
          <tr>
            <th>이메일</th>
            <td><?= e($consult['email'] ?: '-') ?></td>
          </tr>
          <tr>
            <th>운송 희망 일자</th>
            <td><strong><?= e($consult['move_date'] ?: '미지정 (상담 시 조율)') ?></strong></td>
          </tr>
          <tr>
            <th>희망 차량 종류</th>
            <td><?= e($carName) ?></td>
          </tr>
          <tr>
            <th>출발지</th>
            <td><i class="map marker alternate icon" style="color: #2563EB;"></i> <?= e($consult['start_area'] ?: '미지정') ?></td>
          </tr>
          <tr>
            <th>도착지</th>
            <td><i class="flag checkered icon" style="color: #DC2626;"></i> <?= e($consult['end_area'] ?: '미지정') ?></td>
          </tr>
          <tr>
            <th>신청 일시</th>
            <td><?= e($consult['created_at']) ?> (IP: <?= e($consult['client_ip']) ?>)</td>
          </tr>
        </tbody>
      </table>

      <h3 style="font-size: 17px; font-weight: 700; color: #1E293B; margin: 24px 0 12px 0;">
        <i class="file text outline icon"></i> 상담 및 화물 세부 내용
      </h3>
      <div style="background-color: #F8FAFC; border: 1px solid var(--ydk-adm-border-light); border-radius: 8px; padding: 20px; font-size: 16px; line-height: 1.8; color: #1E293B; white-space: pre-wrap;"><?= e($consult['story']) ?></div>
    </div>

    <!-- 우측: 관리자 처리 폼 (상태 변경 및 메모) -->
    <div>
      <div style="background-color: #F8FAFC; border: 1px solid var(--ydk-adm-border); border-radius: 10px; padding: 22px;">
        <h3 style="font-size: 18px; font-weight: 800; color: var(--ydk-adm-primary); margin-top: 0; margin-bottom: 16px;">
          <i class="cogs icon"></i> 상담 상태 및 배차 관리
        </h3>

        <form class="ui form" method="post" action="<?= e($_SERVER['REQUEST_URI']) ?>">
          <div class="field">
            <label style="font-weight: 700;">진행 상태 변경</label>
            <select name="status" class="ui dropdown" style="height: 44px;">
              <option value="접수" <?= ($st === '접수') ? 'selected' : '' ?>>접수 (신규 대기)</option>
              <option value="상담중" <?= ($st === '상담중') ? 'selected' : '' ?>>상담중 (통화/견적 협의)</option>
              <option value="배차완료" <?= ($st === '배차완료') ? 'selected' : '' ?>>배차완료 (차주 연결 완료)</option>
              <option value="취소" <?= ($st === '취소') ? 'selected' : '' ?>>취소 (고객 취소/미진행)</option>
            </select>
          </div>

          <div class="field" style="margin-top: 18px;">
            <label style="font-weight: 700;">관리자 메모 & 배차 차주 정보</label>
            <textarea name="admin_memo" rows="8" placeholder="상담 통화 내용, 견적 합의 금액, 배정된 차주 기사님 성함 및 연락처 등을 메모하세요."><?= e($consult['admin_memo'] ?? '') ?></textarea>
          </div>

          <div style="margin-top: 20px;">
            <button type="submit" class="ui fluid button" style="background-color: var(--ydk-adm-primary); color: var(--ydk-adm-on-primary); height: 46px; font-weight: 700; font-size: 16px;">
              <i class="save icon"></i> 저장하기
            </button>
          </div>
        </form>

        <?php if (!empty($consult['updated_at'])): ?>
          <div style="font-size: 12px; color: var(--ydk-adm-muted); margin-top: 12px; text-align: right;">
            최근 수정: <?= e($consult['updated_at']) ?>
          </div>
        <?php endif; ?>
      </div>

      <div style="margin-top: 18px;">
        <a href="<?= url('admin/consult_list.php') ?>" class="ui fluid basic button" style="height: 44px; display: flex; align-items: center; justify-content: center;">
          <i class="list icon"></i> 상담 목록으로 돌아가기
        </a>
      </div>
    </div>
  </div>

</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
