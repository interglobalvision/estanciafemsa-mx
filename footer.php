  </section>

<?php
  $footer_text = IGV_get_option('_igv_footer_text');
  $footer_text_en = IGV_get_option('_igv_footer_text_en');
  $footer_address = IGV_get_option('_igv_footer_address');
  $footer_phone = IGV_get_option('_igv_footer_phone');
  $footer_email = IGV_get_option('_igv_footer_email');
  $footer_logos = IGV_get_option('_igv_footer_logos');

  $facebook = IGV_get_option('_igv_social_facebook');
  $twitter = IGV_get_option('_igv_social_twitter');
  $instagram = IGV_get_option('_igv_social_instagram');
?>

  <footer id="footer" class="background-key-color font-color-white">
    <div id="footer-above">
      <h1 id="footer-title" class="u-pointer font-larger font-bold font-uppercase font-key-color text-align-center">CASA LUIS BARRAGÁN</h1>
      <nav id="footer-language-switcher" class="font-sans"><?php echo qtranxf_generateLanguageSelectCode('both'); ?></nav>
    </div>


    <div class="container">
      <nav id="footer-toogle-ui" class="row margin-top-tiny margin-bottom-tiny">
        <div class="col col-12 text-align-center">
          <nav id="open-footer" class="u-pointer"><?php echo url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/ui-arrow-up.svg'); ?></nav>
          <nav id="close-footer" class="u-pointer"><?php echo url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/ui-close.svg'); ?></nav>
        </div>
      </nav>
      <div class="row text-align-center margin-bottom-tiny">
        <div class="col col-3">
          <div class="margin-bottom-basic">
            <h3>Newsletter</h3>
            <form action="//estanciafemsa.us12.list-manage.com/subscribe/post?u=dac8a23df9d04e8715078fbf8&amp;id=1308107034" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate margin-bottom-tiny" target="_blank" novalidate>
              <input value="" name="EMAIL" class="required email" id="mce-EMAIL" />
              <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_dac8a23df9d04e8715078fbf8_1308107034" tabindex="-1" value=""></div>
            </form>
            <?php echo __('[:es]Suscríbete ahora.[:en]Subscribe now.'); ?>
          </div>
          <div>
            <h4 class="margin-bottom-tiny"><?php echo __('[:es]Sigue nuestras redes:[:en]Follow us:'); ?></h4>
            <ul id="footer-social-links" class="u-inline-list">
              <li><h3><a href="<?php echo $twitter; ?>" target="_blank">TW</a></h3></li>
              <li><h3><a href="<?php echo $facebook; ?>" target="_blank">FB</a></h3></li>
              <li><h3><a href="<?php echo $instagram; ?>" target="_blank">IN</a></h3></li>
            </ul>
          </div>
        </div>
        <div class="col col-6">
          <h3 id="footer-text"><?php echo __('[:es]' . $footer_text . '[:en]' . $footer_text_en); ?></h3>
        </div>
        <div class="col col-3">
          <h3><?php echo __('[:es]Contacto[:en]Contact'); ?></h3>
          <div id="footer-contact-text" class="font-smaller text-align-left margin-bottom-small">
            <?php echo wpautop($footer_address); ?>
            <?php echo $footer_phone; ?><br/>
            <a href="mailto:<?php echo $footer_email; ?>"><?php echo $footer_email; ?></a>
          </div>
          <div>
            <?php echo $footer_logos; ?>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <?php get_template_part('partials/scripts'); ?>

  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "http://www.example.com",
      "logo": "http://www.example.com/images/logo.png",
      "contactPoint" : [
        { "@type" : "ContactPoint",
          "telephone" : "+1-877-746-0909",
          "contactType" : "customer service",
          "contactOption" : "TollFree",
          "areaServed" : "US"
        } , {
          "@type" : "ContactPoint",
          "telephone" : "+1-505-998-3793",
          "contactType" : "customer service"
        } ],
      "sameAs" : [
        "http://www.facebook.com/your-profile",
        "http://instagram.com/yourProfile",
        "http://www.linkedin.com/in/yourprofile",
        "http://plus.google.com/your_profile"
        ]
    }
  </script>

  </body>
</html>