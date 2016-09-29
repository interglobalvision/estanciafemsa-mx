<?php
get_header();

$plus_link_id = get_post_meta(get_the_ID(), '_igv_plus_link_id', true);
?>

<!-- main content -->
<main id="main-content" class="container">
  <div class="row">
    <div class="col col-s-12 col-m-10 col-l-9">
      <?php get_template_part('partials/home-content'); ?>
    </div>
  </div>
<!-- end main-content -->
</main>

<?php
if (!empty($plus_link_id)) {
?>
<nav class="home-plus only-desktop">
  <div class="container">
    <div class="row">
      <div class="col offset-s-10 col-s-2 text-align-center">
        <a href="<?php echo get_the_permalink($plus_link_id); ?>"><?php 
          echo file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/ui-plus.svg'); 
        ?></a>
      </div>
    </div>
  </div>
</nav>
<?php
}

get_footer();
?>
