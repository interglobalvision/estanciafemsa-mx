<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts">

<?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'col-4');

    if (empty($img)) {
      $current_query = current_query();
      if ($current_query->have_posts()) {
        $current_query->the_post();
        $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'col-4');
      }
      wp_reset_postdata();
    }
?>

    <article <?php post_class('container'); ?> id="post-<?php the_ID(); ?>">

      <div class="row">
        <div class="col col-4">

          <h3 class="text-align-center margin-top-basic margin-bottom-basic"><?php echo __('[:es]Previa Cita[:en]Appointments'); ?></h3>

          <div class="copy"><?php
            if (qtranxf_getLanguage() === 'es') {
              $cita_text = IGV_get_option('_igv_visits_text');
            } else {
              $cita_text = IGV_get_option('_igv_visits_text_en');
            }

            if (!empty($cita_text)) {
              echo apply_filters('the_content', $cita_text);
            }
          ?></div>

        </div>

        <div class="col col-4">

          <div id="page-key-color-image" class="image-key-color-holder background-key-color">
            <div class="image-key-color" style="background-image: url(<?php if (!empty($img)) {echo $img[0];} ?>);"></div>
          </div>

        </div>

        <div class="col col-4">

          <h3 class="text-align-center margin-top-basic margin-bottom-basic"><?php echo __('[:es]Agendar cita[:en]Schedule appointment'); ?>&nbsp;&nbsp;<span class="ui-arrow"><?php echo url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/ui-arrow-right.svg'); ?></span></h3>

          <div class="copy">
          <?php
            if (qtranxf_getLanguage() === 'es') {
              $cita_text_2 = IGV_get_option('_igv_visits_guide');
              $cost = IGV_get_option('_igv_visits_cost');
            } else {
              $cita_text_2 = IGV_get_option('_igv_visits_guide_en');
              $cost = IGV_get_option('_igv_visits_cost_en');
            }

            if (!empty($cita_text_2)) {
              echo apply_filters('the_content', $cita_text_2);
            }

            if (!empty($cost)) {
              echo wpautop($cost);
            }
          ?>

          </div>

        </div>

      </div>
    </article>

<?php
  }
} else {
?>
    <article class="u-alert"><?php _e('[:es]Lo sentimos, pero no podemos encontrar lo que estás buscando.[:en]Sorry, no posts matched your criteria[:]'); ?></article>
<?php
} ?>

  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
