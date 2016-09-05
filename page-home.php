<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">
  <div class="row">
    <div class="col col-s-12 col-m-11 col-l-10">
      <div id="home-holder">
      <?php
        get_template_part('partials/home-content');
      ?>
      </div>
    </div>
  </div>
<!-- end main-content -->
</main>

<nav id="home-plus">
  <a href="<?php echo site_url('/noticias'); ?>">+</a>
</nav>

<?php
get_footer();
?>
