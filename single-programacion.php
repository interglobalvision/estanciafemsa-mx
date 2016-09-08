<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="programacion-post">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    $gallery = get_post_meta($post->ID, '_igv_program_gallery', true);
    $number = get_post_meta($post->ID, '_igv_number', true);
    $credits = get_post_meta($post->ID, '_igv_credits', true);
?>

    <article <?php post_class(''); ?> id="post-<?php the_ID(); ?>">

      <div id="programacion-slider">
        <div class="swiper-container gallery-<?php the_ID(); ?>"">
          <div class="swiper-wrapper">
<?php 
  if (!empty($gallery)) {
    foreach ($gallery as $image_id) {
      $full = get_post_meta($image_id, '_igv_full_view', true);
?>
            <div class="swiper-slide">
<?php
      if ($full == 'on') {
?>
              <div class="container full-slide" style="background-image: url('<?php echo wp_get_attachment_image_src($image_id, 'full')[0]; ?>'">
<?php 
      } else {
?>
              <div class="container">
<?php } ?>
                <div class="slide-image-holder">
                  <?php echo wp_get_attachment_image($image_id, 'full'); ?>
                </div>
              </div>
            </div>
<?php
    }
  } 
?>
          </div>
        </div>
        <div class="slider-cursor-pagination">
          <div class="cursor-pagination-button swiper-prev"></div>
          <div class="cursor-pagination-button swiper-next"></div>
        </div>
      </div>

      <div id="programacion-content">
        <header class="programacion-header padding-top-tiny padding-bottom-micro">
          <div class="container">
            <div class="row font-size-h2">
              <div class="col col-s-12 col-m-6 col-l-5">
                <h2 class="u-inline-block"><?php the_title(); ?></h2> <span class="programacion-content-toggle"></span>
              </div>
              <div class="col col-s-6 col-m-3 col-l-2 text-align-left">
                <span class="swiper-prev u-pointer">< </span><span id="single-programacion-gallery-pagination"></span><span class="swiper-next u-pointer"> ></span>
              </div>
              <div class="col col-s-6 col-m-3 col-l-2 text-align-right">
                <?php
                  previous_post_link('%link', '< ');

                  if (!empty($number)) {
                    echo 'No. ' . add_leading_zero($number);
                  }

                  next_post_link('%link', ' >');
                ?>
              </div>
              <div class="col col-s-3 text-align-right only-desktop">
                <?php get_template_part('partials/language-switch'); ?>
              </div>
            </div>
          </div>
        </header>

        <div class="programacion-text-holder padding-top-micro">
          <div class="container">
            <div class="row">
              <div class="col col-s-12 programaction-text">
                <?php the_content(); ?>
              </div>
<?php
if (!empty($credits)) {
?>
              <div class="col col-s-12 margin-top-small padding-bottom-micro">
                <?php echo apply_filters('the_content', $credits); ?>
              </div>
<?php 
}
?>
            </div>
          </div>
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