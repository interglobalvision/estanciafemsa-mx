  <?php if (!is_front_page()) { ?>
    <footer id="footer" class="padding-bottom-micro only-mobile">
      <div class="container">
        <div class="col s-col-12 text-align-right">
          <h1 class="font-uppercase"><a href="<?php echo home_url('/citas'); ?>">Casa Luis Barragán</a></h1>
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