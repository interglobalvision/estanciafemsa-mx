/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Modernizr */
Site = {
  mobileThreshold: 1008,
  init: function() {
    var _this = this;

    _this.Gallery.init();
    _this.Footer.init();

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

Site.Footer = {
  init: function() {
    var _this = this;

    _this.$footer = $('#footer');

    _this.bind();
    _this.layout();
  },

  bind: function() {
    var _this = this;

    $('#open-footer').click(function() {
      _this.$footer.addClass('active');
    });

    $('#close-footer').click(function() {
      _this.$footer.removeClass('active');
    });

  },

  layout: function() {
    var _this = this;
    var offset = _this.$footer.innerHeight() - $('#footer-toogle-ui').outerHeight(true);

    _this.$footer.css('bottom', '-' + offset + 'px');
  },
}

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
