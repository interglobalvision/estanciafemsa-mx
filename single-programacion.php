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
    $actividades = get_event_actividades($post->ID);
?>

    <article <?php post_class(''); ?> id="post-<?php the_ID(); ?>">

      <div id="programacion-slider">
        <div class="swiper-container gallery-<?php the_ID(); ?>">
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
              <div class="container full-slide" style="background-image: url('<?php echo wp_get_attachment_image_src($image_id, 'full-slide')[0]; ?>')">
<?php 
      } else {
?>
              <div class="container">
<?php } ?>
                  <?php echo wp_get_attachment_image($image_id, 'full'); ?>
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
        <div class="close-drawer-overlay"></div>
      </div>

      <div class="programacion-drawer">
        <header class="programacion-header padding-top-tiny padding-bottom-micro font-bold">
          <div class="container">
            <div class="row font-size-h2">
              <div class="col col-s-12 col-m-6 col-l-5">
                <h2 class="u-inline-block programacion-title u-pointer"><?php the_title(); ?></h2> <span class="programacion-drawer-toggle"></span>
              </div>
              <div class="col col-s-6 col-m-3 col-l-3">
                <span class="swiper-prev u-pointer">< </span><span id="single-programacion-gallery-pagination"></span><span class="swiper-next u-pointer"> ></span>
              </div>
              <div class="col col-s-6 col-m-3 col-l-2 programacion-pagination-holder">
                <?php
                  previous_post_link('%link', '< ');

                  if (!empty($number)) {
                    echo 'No. ' . add_leading_zero($number);
                  }

                  next_post_link('%link', ' >');
                ?>
              </div>
              <div class="col col-s-2 text-align-right only-desktop">
                <?php get_template_part('partials/language-switch'); ?>
              </div>
            </div>
          </div>
        </header>

        <div class="programacion-content-holder padding-top-micro padding-bottom-basic">
          <div class="container">
            <div class="row">
              <div class="col col-s-12 col-m-6 col-l-8 programacion-content line-tighter">
                <?php the_content(); ?>
                <?php 
                if (qtranxf_getLanguage() == 'es') {
                  $program_file = get_post_meta($post->ID, '_igv_program_visitors_file_es', true);
                } else {
                  $program_file = get_post_meta($post->ID, '_igv_program_visitors_file_en', true);
                }

                if (!empty($program_file)) {
                  $link_text = get_post_meta($post->ID, '_igv_program_visitors_file_text', true);

                  if (!empty($link_text)) {
                    echo '<p><a href="' . esc_url($program_file) . '" target="_blank" rel="noopener noreferrer">' . $link_text . '</a></p>';
                  }
                }
                ?>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer"><?php _e('[:en]Share on Facebook[:es]Compartir en Facebook'); ?> ></a>
              </div>
              <?php 
               if (!empty($actividades)) {
              ?> 
              <div class="col col-s-12 col-m-6 col-l-4">
                <h2 class="margin-bottom-tiny"><?php echo __('[:es]Actividad Académica[:en]Academic Activity'); ?></h2>
                <ul class="font-serif">
              <?php 
                foreach ($actividades as $actividad) {
                  $event_activity_num = '';
                  $activity_num = get_post_meta($actividad->ID, '_igv_activity_num', true);

                  if (!empty($number) && !empty($activity_num)) {
                    $event_activity_num = 'No. ' . add_leading_zero($number) . '.' . $activity_num;
                  }
              ?> 
                  <li class="margin-bottom-tiny"><a href="<?php echo get_permalink($actividad->ID); ?>"><?php 
                  echo $event_activity_num . '<br>'; ?><div class="u-inline-block program-activity-title"><?php echo $actividad->post_title; ?></div></a></li>
              <?
                }
              ?>
                </ul>
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