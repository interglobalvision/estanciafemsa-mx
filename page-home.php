<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">
  <div class="row">
    <div class="col col-s-12 col-m-11 col-l-10">
<?php
  $home_content = get_post_meta( get_the_ID(), '_igv_home_content', true);

  render_home_style_content($home_content);
?>
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
