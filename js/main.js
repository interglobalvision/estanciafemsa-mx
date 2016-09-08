/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {
      _this.Layout.init();
    });

    if ($('body').hasClass('single-programacion')) {
      _this.Programacion.Single.init();
    }

    if ($('body').hasClass('blog') || $('body').hasClass('single-post')) {
      _this.Noticias.init();
    }

    _this.Home.init();
  },

  onResize: function() {
    var _this = this;

  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  }
};

Site.Layout = {
  init: function() {
    var _this = this;

    if ($('.home-item').length) {
      _this.layoutMasonry();
    }
  },

  layoutMasonry: function() {
    var $masonry = $('#home-holder').masonry({
      itemSelector: '.home-item',
      transitionDuration: 0,
    });

    $masonry.imagesLoaded().progress( function() {
      $masonry.masonry('layout');
    });
  }
};

Site.Home = {
  init: function() {
    var _this = this;

    if ($('.home-item').length) {
      _this.bindItemHover();
    }
  },

  bindItemHover: function() {
    $('.home-item a').hover(
      function() {
        $('.home-item a').not(this).parent('.home-item').addClass('home-item-hidden');
        $(this).parent('.home-item').addClass('home-item-hover');
      }, 
      function() {
        $('.home-item').removeClass('home-item-hidden home-item-hover');
      }
    );
  }
};

Site.Programacion = {

  Single: {
    init: function() {
      var _this = this;

      $(document).ready(function () {
        _this.initGallery();
      });
    },

    initGallery: function() {
      var _this = this;

      _this.swiper = new Swiper('.swiper-container', {
        loop: true,
        nextButton: '.swiper-next',
        prevButton: '.swiper-prev',
        pagination: '#single-programacion-gallery-pagination',
        paginationType: 'custom',
        paginationCustomRender: function (swiper, current, total) {
          return '<span id="gallery-index-active">' + current + '</span> / <span id="gallery-index-length">' + total + '</span>';
        },
        onClick: function(swiper) {
          swiper.slideNext();
        },
      });
    },
  }

};

Site.Noticias = {
  init: function() {
    this.Galleries.init();
  },

  Galleries: {
    init: function() {
      $('.swiper-container').each(function() {
        var swiper = new Swiper($(this), {
          loop: true,
          onClick: function(swiper) {
            swiper.slideNext();
          },
        });
      });
    },
  }
}

Site.init();