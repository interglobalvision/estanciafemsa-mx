/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, Modernizr */

var scrollOffset = $('.nav-top').height() * 5;

var langEs = $('.lang-es');
var langEn = $('.lang-en');

function setLang(code) {
  if (code === 'en') {
    langEs.hide();
    langEn.show();
    window.location.hash = 'en';
  } else {
    langEn.hide();
    langEs.show();
    window.location.hash = 'es';
  }
}

$(document).ready(function () {
  'use strict';

  if (window.location.hash) {
    console.log(window.location.hash);
    setLang(window.location.hash.substring(1));
  }

  // utility class mainly for use on headines to avoid widows [single words on a new line]
  $('.js-fix-widows').each(function(){
    var string = $(this).html();

    string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
    $(this).html(string);
  });

  var winHeight,
    winWidth;

  function matchHeights(selector) {
    var topHeight = 0;

    $(selector).each(function(){
        var height = $(this).height();

        if (height > topHeight){
          topHeight = height;
        }
    });

    $(selector).css('height', topHeight);
  }

  function resize() {
    winHeight = $(window).height();
    winWidth = $(window).width();

    $('html, body').css({
      'min-height': winHeight * 2,
    });

    $('#splash-container').css({
      'height': winHeight,
      'width': winWidth,
    });

    matchHeights('.match-height');

  }

  // SCROLLTO EVENTS
  function bindScrollEvent() {
    $('.scroll').on('click', function() {
      var target = $(this).attr('data-scroll');

      $('html,body').animate({
        scrollTop: $(target).offset().top - ( scrollOffset )
      }, 1000);
    });
  }


  // SPLASH SCROLL
  function removeSplash() {
    $('#main-container').css('position', 'relative');
    $('#splash, #scroll-buffer').remove();
    $(window).scrollTop(0).off('scroll');
    bindScrollEvent();
  };

  $('#splash').on('click', function() {
    $(this).animate({
      'height': '0%',
    }, 1000, function() {
      removeSplash();
    });
  });

  $(window).on({
    scroll: function() {
      var elPos = $('#scroll-buffer').offset().top - $(window).scrollTop(),
        elBottom = elPos + winHeight,
        elPercent = (elBottom / winHeight) * 100;

      $('#splash').css('height', elPercent + '%');

      if (elPercent === 0) {
        removeSplash();
      }
    },

    resize: function() {
      resize();
    },
  });

  resize();

  $('.js-set-lang').on({
    click: function(e) {
      e.preventDefault();
      setLang($(this).data('lang'));
    },
  });

});