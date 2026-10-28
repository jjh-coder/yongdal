<?php
/**
 * 용달코리아 v2 지역별 운송 정보 공통 내비게이션 탭 컴포넌트
 */
$areaNavItems = [
    '01' => ['title' => '서울·수도권 화물', 'badge' => '수도권', 'icon' => 'building', 'file' => 'area_info_01.php'],
    '02' => ['title' => '충청권 화물', 'badge' => '충청권', 'icon' => 'compass', 'file' => 'area_info_02.php'],
    '03' => ['title' => '호남권 화물', 'badge' => '호남권', 'icon' => 'map marker alternate', 'file' => 'area_info_03.php'],
    '04' => ['title' => '영남권 화물', 'badge' => '영남권', 'icon' => 'industry', 'file' => 'area_info_04.php'],
    '05' => ['title' => '강원·제주 화물', 'badge' => '강원제주', 'icon' => 'ship', 'file' => 'area_info_05.php'],
    '06' => ['title' => '리턴 공차 안내', 'badge' => '리턴공차', 'icon' => 'sync alternate', 'file' => 'area_info_06.php'],
    '07' => ['title' => '용달 운임 기준표', 'badge' => '운임기준', 'icon' => 'won sign', 'file' => 'area_info_07.php'],
    '08' => ['title' => '화물 취급 요령', 'badge' => '취급요령', 'icon' => 'clipboard check', 'file' => 'area_info_08.php'],
];
$activeKey = $activeAreaCode ?? '01';
?>

<div class="ydk-area-nav-wrap" style="margin-bottom: 26px;">
  <div style="font-size: 0.9rem; font-weight: 700; color: var(--ydk-muted); margin-bottom: 8px; display: flex; align-items: center; gap: 6px;">
    <i class="th large icon" style="color: var(--ydk-primary);"></i>
    <span>지역별 화물 운송 가이드 및 안내 바로가기 (8개 가이드)</span>
  </div>
  <div class="ydk-area-nav-scroll" style="display: flex; gap: 8px; overflow-x: auto; padding-bottom: 6px; -webkit-overflow-scrolling: touch;">
    <?php foreach ($areaNavItems as $key => $nav): ?>
      <?php $isActive = ($activeKey === $key); ?>
      <a href="<?= url("contents/area/{$nav['file']}") ?>" 
         class="ui button <?= $isActive ? 'primary' : 'basic' ?>" 
         style="flex: 0 0 auto; border-radius: 8px; font-weight: <?= $isActive ? '700' : '600' ?>; display: inline-flex; align-items: center; gap: 6px; padding: 10px 15px; font-size: 0.95rem; white-space: nowrap; <?= $isActive ? 'background-color: var(--ydk-primary) !important; color: #fff !important; box-shadow: 0 2px 8px rgba(27,54,93,0.25);' : 'border-color: #cbd5e1; color: #334155;' ?>">
        <i class="<?= e($nav['icon']) ?> icon" style="margin: 0; <?= $isActive ? 'color: #ffd2bd;' : 'color: var(--ydk-primary);' ?>"></i>
        <span><?= e($nav['title']) ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</div>
