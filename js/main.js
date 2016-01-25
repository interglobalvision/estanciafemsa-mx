/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, Modernizr */

$(document).ready(function () {
  'use strict';

  // utility class mainly for use on headines to avoid widows [single words on a new line]
  $('.js-fix-widows').each(function(){
    var string = $(this).html();

    string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
    $(this).html(string);
  });

  var winHeight,
    winWidth;

  const resizeSplash = function() {
    winHeight = $(window).height();
    winWidth = $(window).width();

    $('html, body').css({
      'min-height': winHeight * 2,
    });

    $('#splash-container').css({
      'height': winHeight,
      'width': winWidth,
    });
  };

  // SPLASH SCROLL
  $(window).on({
    scroll: function() {
      var elPos = $('#scroll-buffer').offset().top - $(window).scrollTop(),
        elBottom = elPos + winHeight,
        elPercent = (elBottom / winHeight) * 100;
      
      $('#splash').css('height', elPercent + '%');

      if (elPercent === 0) {
        $('#main-container').css('position', 'relative');
        $('#splash, #scroll-buffer').remove();
        $(window).scrollTop(0).off('scroll');
      }
    },
    resize: function() {
      resizeSplash();
    },
  });

  resizeSplash();

});
