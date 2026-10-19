/**
 * 용달코리아 v2 프론트엔드 스크립트 (jQuery 3.x + Fomantic-UI)
 */
$(document).ready(function () {
  // Fomantic UI 팝업, 탭, 드롭다운 초기화
  if ($.fn.dropdown) {
    $('.ui.dropdown').dropdown();
  }
  if ($.fn.tab) {
    $('.ui.menu .item').tab();
  }
  if ($.fn.popup) {
    $('[data-content]').popup();
  }

  // 즐겨찾기 클릭 이벤트 (Ctrl+D 안내)
  $('#btnBookmark').on('click', function (e) {
    e.preventDefault();
    alert('Ctrl 키와 D 키를 동시에 누르면 현재 페이지를 즐겨찾기에 추가할 수 있습니다.');
  });
});
