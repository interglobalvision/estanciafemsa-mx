/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize($.debounce(250, function(){
      _this.onResize();
    }));

    $(document).ready(function () {
      _this.Layout.init();
    });

    if ($('body').hasClass('post-type-archive-programacion')) {
      _this.Programacion.Archive.init();
    }

    if ($('body').hasClass('single-programacion')) {
      _this.Programacion.Single.init();
    }

    if ($('body').hasClass('blog') || $('body').hasClass('single-post')) {
      _this.Noticias.init();
    }

    _this.Menu.init();

    _this.Home.init();
  },

  onResize: function() {
    var _this = this;

    if ($('body').hasClass('single-programacion')) {
      _this.Programacion.Single.sizeSlideImageHolder();
    }
    _this.Menu.closeMenu();
    _this.Layout.layoutMasonry();


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
  $masonry: null,

  init: function() {
    var _this = this;

    if ($('.home-item').length) {
      _this.initMasonry();
    }
  },

  initMasonry: function() {
    var _this = this;

    _this.$masonry = $('#home-holder').masonry({
      itemSelector: '.home-item',
      transitionDuration: 0,
      resize: false
    });

    _this.$masonry.imagesLoaded().progress( function() {
      _this.layoutMasonry();
    });
  },

  layoutMasonry: function() {
    var _this = this;

    if ($('.home-item').length) {
      _this.$masonry.masonry('layout');
    }
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

Site.Menu = {
  init: function() {
    var _this = this;

    _this.bindToggle();
    _this.bindSearchToggle();
  },

  bindToggle: function() {
    $('.menu-toggle').on('click', function() {
      $('body').toggleClass('menu-active');
    });
  },

  bindSearchToggle: function() {
    $('#search-toggle').on('click', function() {
      $(this).hide();
      $('#search-form').css('display', 'inline-block');
      $('#search-input').focus();
    });

    $(document).on('click', function(event) {
      if(!$(event.target).closest('#search-bar').length) {
        if($('#search-form').is(":visible")) {
          $('#search-toggle').show();
          $('#search-form').css('display', 'none');
          $('#search-input').blur();
        }
      }
    });
  },

  closeMenu: function() {
    $('body').removeClass('menu-active');
  },
};

Site.Programacion = {

  Archive: {
    init: function() {
      var _this = this;

      if ($('[data-hover-color]').length) {
        _this.bindHoverColor();
      }
    },

    bindHoverColor: function() {
      $('[data-hover-color]').hover(
        function() {
          $(this).css('color', $(this).attr('data-hover-color'));
        },
        function() {
          $(this).css('color', 'inherit');
        }
      );
    }
  },

  Single: {
    init: function() {
      var _this = this;
      _this.$programacionDrawer = $('.programacion-drawer');

      $(document).ready(function () {
        _this.initGallery();
        _this.bindToggle();
        _this.sizeSlideImageHolder();
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
        setWrapperSize: true,
        paginationCustomRender: function (swiper, current, total) {
          return '<span id="gallery-index-active">' + current + '</span> / <span id="gallery-index-length">' + total + '</span>';
        },
        onClick: function(swiper) {
          swiper.slideNext();
        },
      });
    },

    sizeSlideImageHolder: function() {
      var _this = this,
        windowWidth = $(window).width(),
        headerHeight = $('#header').outerHeight(true);

      $('.programacion-content-holder').scrollTop(0);
      $('body').removeClass('drawer-open');

      var contentHeight = $('.programacion-header').outerHeight(true);

      if (windowWidth < 1024) {
        $('.slide-image-holder').css({
          'padding-top': 0,
          'padding-bottom': 0,
        });
      } else {
        $('.slide-image-holder').css({
          'padding-top': headerHeight,
          'padding-bottom': contentHeight,
        });
      }
    },

    bindToggle: function() {
      var _this = this;

      $('.programacion-title, .programacion-drawer-toggle, .close-drawer-overlay').bind('click', function() {
        _this.toggleContent();
      });

      $('#programacion-slider').on({
        mousewheel: function(event){
          var delta = event.originalEvent.wheelDelta;

          if (delta < 0 && !_this.$programacionDrawer.hasClass('drawer-open')){
            _this.toggleContent();
          } else if (delta > 0 && _this.$programacionDrawer.hasClass('drawer-open')){
            _this.toggleContent();
          }
        }
      });

    },

    toggleContent: function() {
      var _this = this;

      if (_this.$programacionDrawer.hasClass('drawer-open')) {
        _this.$programacionDrawer.removeClass('drawer-open').css('height', '');
        $('.programacion-content-holder').css('height', 'auto');
        $('.close-drawer-overlay').hide();
      } else {
        _this.setDrawerHeight();
        _this.$programacionDrawer.addClass('drawer-open');
        $('.close-drawer-overlay').show();
      }

      $('.programacion-content-holder').scrollTop(0);
    },

    setDrawerHeight: function() {
      var _this = this;
      var windowHeightHalf = $(window).height() / 2;
      var drawerHeight = $('.programacion-header').outerHeight(true) + $('.programacion-content-holder').outerHeight(true);

      if (drawerHeight > windowHeightHalf) {
        _this.$programacionDrawer.css('height', windowHeightHalf);
        $('.programacion-content-holder').css('height', (windowHeightHalf - $('.programacion-header').outerHeight(true)));
      } else {
        _this.$programacionDrawer.css('height', drawerHeight);
        $('.programacion-content-holder').css('height', (drawerHeight - $('.programacion-header').outerHeight(true)));
      }
    }
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
};

Site.init();
