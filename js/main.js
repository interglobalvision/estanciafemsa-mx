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

      _this.hoverColor();
  
    });

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
  },

  hoverColor: function(s) {
    if ($('[data-hover-color]').length) {
      $('[data-hover-color]').hover(
        function() {
          $(this).css('color', $(this).attr('data-hover-color'));
        }, 
        function() {
          $(this).css('color', 'inherit');
        }
      );
    }
  }
};

Site.init();