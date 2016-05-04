/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Modernizr, Site, Swiper */
Site = {
  mobileThreshold: 1008,
  init: function() {
    var _this = this;

    _this.windowHeight = $(window).height();
    _this.windowWidth = $(window).width();

    _this.Gallery.init();
    _this.Header.init();
    _this.Footer.init();
    if ($('body').hasClass('home')) {
      _this.Splash.init();
    }

    $(window).resize(function(){
      _this.onResize();
    });

  },

  onResize: function() {
    var _this = this;

    _this.windowHeight = $(window).height();
    _this.windowWidth = $(window).width();

    _this.Splash.resize();
    _this.Header.layout();

  },
};

// SPLASH SCROLL

Site.Splash = {
  // this var is never used?
  scrollOffset: $('.splash-header').height() * 5,
  $splash: $('#splash'),
  $scrollBuffer: $('#scroll-buffer'),

  init: function() {
    var _this = this;

    _this.bind();
    _this.layout();
  },

  bind: function() {
    var _this = this;

    _this.$splash.on('click', function() {
      $(this).animate({
        'height': '0%',
      }, 1000, function() {
        _this.removeSplash();
      });
    });

    $(window).on({
      'scroll.splash': function() {
        var elPos = _this.$scrollBuffer.offset().top - $(window).scrollTop(),
          elBottom = elPos + Site.windowHeight,
          elPercent = (elBottom / Site.windowHeight) * 100;

        _this.$splash.css('height', elPercent + '%');

        if (elPercent === 0) {
          _this.removeSplash();
        }
      },
    });
  },

  resize: function() {
    this.layout();
  },

  layout: function() {
    var _this = this;

    _this.$scrollBuffer.css({
      'min-height': Site.windowHeight * 2,
    });

    $('#splash-container').css({
      'height': Site.windowHeight,
      'width': Site.windowWidth,
    });

    _this.matchHeights('.match-height');

  },

  matchHeights: function(selector) {
    var topHeight = 0;

    $(selector).each(function() {
      var height = $(this).height();

      if (height > topHeight){
        topHeight = height;
      }
    });

    $(selector).css('height', topHeight);
  },

  removeSplash: function() {
    var _this = this;

    $('#main-container').removeClass('u-fixed');

    _this.$scrollBuffer.remove();
    _this.$splash.remove();

    $(window).scrollTop(0).off('scroll.splash');
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

Site.Header = {
  init: function() {
    var _this = this;

    _this.$header = $('#header');
    _this.$main = $('#main-container');

    _this.layout();
  },

  layout: function() {
    var _this = this;
    var offset = _this.$header.outerHeight(true);

    _this.$main.css('margin-top', offset + 'px');
  },
};

Site.Footer = {
  init: function() {
    var _this = this;

    _this.$footer = $('#footer');

    _this.bind();
    _this.layout();
  },

  bind: function() {
    var _this = this;

    $('#footer-toogle-ui').click(function() {
      _this.$footer.toggleClass('active');
    });

    $('#footer-title').click(function() {
      _this.$footer.toggleClass('active');
    });

    $('#mce-EMAIL').keydown(function(e) {
      if (e.keyCode === 13) {
        $('#mc-embedded-subscribe-form').submit();
      }
    });

  },

  layout: function() {
    var _this = this;
    var offset = _this.$footer.innerHeight() - $('#footer-toogle-ui').outerHeight(true);

    _this.$footer.css('bottom', '-' + offset + 'px');
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

  Site.init();

});