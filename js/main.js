/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Modernizr */
Site = {
  mobileThreshold: 1008,
  init: function() {
    var _this = this;

    _this.Gallery.init();

    $(window).resize(function(){
      _this.onResize();
    });

  },

  onResize: function() {
    var _this = this;

    // Stuff to trigger onResize
  },
};

Site.Gallery = {
  Swiper: undefined,
  init: function() {
    var _this = this;

    _this.Swiper = new Swiper('.swiper-container', {
      loop: true,
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',
      preloadImages: false,
      lazyLoading: true,
      lazyLoadingInPrevNext: true,

      pagination: '.swiper-pagination',
      paginationType: 'custom',
      paginationCustomRender: function (swiper, current, total) {
        return '<span id="gallery-index-active">' + current + '</span>/<span id="gallery-index-length">' + total + '</span>';
      },

      onTap: function(swiper, event) {
        if (event.target.tagName === 'IMG') {
          swiper.slideNext();
        }
      },
    });

  },
};

jQuery(document).ready(function () {
  'use strict';

  // utility class mainly for use on headines to avoid widows [single words on a new line]
  $('.js-fix-widows').each(function(){
    var string = $(this).html();

    string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
    $(this).html(string);
  });

  var scrollOffset = $('.splash-header').height() * 5,
    winHeight,
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

    $('#scroll-buffer').css({
      'min-height': winHeight * 2,
    });

    $('#splash-container').css({
      'height': winHeight,
      'width': winWidth,
    });

    matchHeights('.match-height');

  }

  // SPLASH SCROLL
  function removeSplash() {
    $('#main-container').removeClass('u-fixed');
    $('#splash, #scroll-buffer').remove();
    $(window).scrollTop(0).off('scroll');
    bindScrollEvent();
  }

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

  Site.init();

});
