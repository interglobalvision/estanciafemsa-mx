<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="programacion-post">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    $meta = get_post_meta($post->ID);
?>

    <article <?php post_class(''); ?> id="post-<?php the_ID(); ?>">

      <div class="row">
        <div class="col col-s-12">
          <?php if (!empty($meta['_igv_gallery'][0])) {echo do_shortcode($meta['_igv_gallery'][0]);} ?>
        </div>
      </div>

      <header class="row">
        <div class="col col-s-12 col-m-8">
          <h2><?php the_title(); ?></h2>
        </div>
        <div class="col col-s-6 col-m-2">
          <span class="swiper-prev u-pointer">< </span><span id="single-programacion-gallery-pagination"></span><span class="swiper-next u-pointer"> ></span>
        </div>
        <div class="col col-s-6 col-m-2">
          <?php
            if (!empty($meta['_igv_number'][0])) {
              echo 'No. ' . add_leading_zero( $meta['_igv_number'][0] );
            }

            next_post_link('%link', ' >');
          ?>
        </div>
      </header>

      <div class="row">
        <div class="col col-s-12">
          <?php
            the_content();

            if (!empty($meta['_igv_credits'][0])) {
              echo apply_filters('the_content', $meta['_igv_credits'][0]);
            }
          ?>
        </div>
      </div>

    </article>

<?php
  }
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>

  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>