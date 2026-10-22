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

// v2-1: 메인 지역 정보 아코디언 및 상단으로 가기
$(document).ready(function () {
  if ($.fn.accordion) {
    $('.ui.accordion').accordion();
  }

  // 상단으로 가기 (Scroll to Top) 기능
  var $btnScrollTop = $('#btnScrollTop');
  if ($btnScrollTop.length) {
    var toggleScrollTopBtn = function () {
      if ($(window).scrollTop() > 250) {
        $btnScrollTop.addClass('is-visible');
      } else {
        $btnScrollTop.removeClass('is-visible');
      }
    };

    // 스크롤 시 버튼 표시/숨김
    $(window).on('scroll', toggleScrollTopBtn);
    toggleScrollTopBtn();

    // 클릭 시 부드럽게 최상단으로 이동
    $btnScrollTop.on('click', function (e) {
      e.preventDefault();
      if ('scrollBehavior' in document.documentElement.style) {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      } else {
        $('html, body').animate({ scrollTop: 0 }, 300);
      }
    });
  }
});

