<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">
  <div class="row">
    <div class="col col-s-12 col-m-11 col-l-10">
      <?php get_template_part('partials/home-content'); ?>
    </div>
  </div>
<!-- end main-content -->
</main>

<nav class="home-plus only-desktop">
  <div class="container">
    <div class="row">
      <div class="col col-s-12">
        <a href="<?php echo site_url('/noticias'); ?>"><?php 
          echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/ui-plus.svg'); 
        ?></a>
      </div>
    </div>
  </div>
</nav>

<?php
get_footer();
?>
