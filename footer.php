  <?php if (!is_front_page()) { ?>
    <footer id="footer" class="padding-top-micro padding-bottom-micro">
      <div class="container">
        <div class="col s-col-12 text-align-right">
          <h1 class="font-uppercase only-mobile"><a href="<?php echo home_url('/citas'); ?>">Casa Luis Barragán</a></h1>
          <div class="footer-lang-switch only-desktop"><?php get_template_part('partials/language-switch'); ?></div>
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