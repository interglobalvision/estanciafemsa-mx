<div id="scroll-buffer"></div>

<div id="splash" class="background-key-color font-sans text-align-center u-pointer">
  <div id="splash-container">
    <div id="splash-top">
      <h3 class="font-larger font-bold font-uppercase"><?php bloginfo('name'); ?></h3>
    </div>

    <div id="splash-bottom">
      <h3 class="font-larger font-bold font-uppercase">CASA LUIS BARRAGÁN</h3>
    </div>

    <div id="splash-text" class="font-huge font-leading-zero u-flex-center">
      <?php

        if (qtranxf_getLanguage() === 'es') {
          $splash_text = IGV_get_option('_igv_splash_text');
        } else {
          $splash_text = IGV_get_option('_igv_splash_text_en');
        }

        if (!empty($splash_text)) {
          echo $splash_text;
        }
      ?>
    </div>
  </div>
</div>