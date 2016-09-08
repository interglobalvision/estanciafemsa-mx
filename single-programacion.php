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
    foreach ($gallery as $image) {
      $full = get_post_meta($image, '_igv_full_view', true);

      if ($full == 'on') {
?>
            <div class="swiper-slide">
              <div class="full-slide" style="background-image: url('<?php echo wp_get_attachment_image_src($image, 'full')[0]; ?>'"></div>
            </div>
<?php 
      } else {
?>
            <div class="swiper-slide">
              <div class="container">
                <?php echo wp_get_attachment_image($image, 'full'); ?>
              </div>
            </div>
<?php
      }
    }
  } 
?>
          </div>
        </div>
      </div>

      <div id="programacion-content">
        <div class="container">
          <div class="row">
            <div class="col col-s-12 col-m-8">
              <h2><?php the_title(); ?></h2>
            </div>
            <div class="col col-s-6 col-m-2">
              <span class="swiper-prev u-pointer">< </span><span id="single-programacion-gallery-pagination"></span><span class="swiper-next u-pointer"> ></span>
            </div>
            <div class="col col-s-6 col-m-2 text-align-right">
              <?php
                previous_post_link('%link', '< ');

                if (!empty($number)) {
                  echo 'No. ' . add_leading_zero($number);
                }

                next_post_link('%link', ' >');
              ?>
            </div>
          </div>

          <div class="row">
            <div class="col col-s-12">
              <?php
                the_content();

                if (!empty($credits)) {
                  echo apply_filters('the_content', $credits);
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