/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document */

var winHeight;
var winWidth;
var $langEs = $('.lang-es');
var $langEn = $('.lang-en');

var $splash = $('#splash');
var $scrollBuffer = $('#scroll-buffer');
var $splashContainer = $('#splash-container');

function setLang(code) {
  if (code === 'en') {
    $langEs.hide();
    $langEn.show();
    window.location.hash = 'en';
  } else {
    $langEn.hide();
    $langEs.show();
    window.location.hash = 'es';
  }
}

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

function onResize() {
  winHeight = $(window).height();
  winWidth = $(window).width();

  $('html, body').css({
    'min-height': winHeight * 2,
  });

  $splashContainer.css({
    'height': winHeight,
    'width': winWidth,
  });

  matchHeights('.match-height');
}

// SCROLLTO EVENTS
function bindScrollEvent() {
  $('.scroll').on('click', function() {
    var target = $(this).attr('data-scroll');

    $('html, body').animate({
      scrollTop: $(target).offset().top,
    }, 1000);
  });
}

// SPLASH SCROLL
function removeSplash() {
  $('#main-container').css('position', 'relative');
  $splash.remove();
  $scrollBuffer.remove();
  $(window).scrollTop(0).off('scroll');
  bindScrollEvent();
}

$(document).ready(function () {
  'use strict';

  onResize();

  if (window.location.hash) {
    console.log(window.location.hash);
    setLang(window.location.hash.substring(1));
  }

  $splash.on('click', function() {
    $(this).animate({
      'height': '0%',
    }, 1000, function() {
      removeSplash();
    });
  });

  $(window).on({
    scroll: function() {
      var elPos = $scrollBuffer.offset().top - $(window).scrollTop(),
        elBottom = elPos + winHeight,
        elPercent = (elBottom / winHeight) * 100;

      $splash.css('height', elPercent + '%');

      if (elPercent === 0) {
        removeSplash();
      }
    },

    resize: onResize(),
  });

  $('.js-set-lang').on({
    click: function(e) {
      e.preventDefault();
      setLang($(this).data('lang'));
    },
  });

  // utility class mainly for use on headines to avoid widows [single words on a new line]
  $('.js-fix-widows').each(function(){
    var string = $(this).html();

    string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
    $(this).html(string);
  });

});