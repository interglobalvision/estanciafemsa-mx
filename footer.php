  <?php if (!is_front_page()) { ?>
    <footer id="footer">
      <div class="container">
        <div class="col s-col-12 text-align-right">
        <?php 
          $host = IGV_get_option('_igv_host_location');

          if ($host) {
        ?>
          <h1 class="font-uppercase only-mobile"><a href="<?php echo home_url('/citas'); ?>"><?php echo $host; ?></a></h1>
        <?php 
          }
        ?>
          <div class="font-bold footer-lang-switch only-desktop"><?php get_template_part('partials/language-switch'); ?></div>
        </div>
      </div>
    </footer>
  <?php } ?>

  </section>

  <?php
    get_template_part('partials/scripts');
    get_template_part('partials/schema-org');
  ?>

  </body>
</html>