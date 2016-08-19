<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

    <article <?php post_class('row margin-bottom-small'); ?> id="page-<?php the_ID(); ?>">

      <div class="page-images col col-s-12 col-m-9">

        //>>> query exactly where these images come from
        <?php the_content(); ?>

      </div>

      <div class="page-content col col-s-12 col-m-3">

        <div class="margin-bottom-small">
          <h3 class="margin-bottom-small"><?php echo __('[:es]Previa Cita[:en]Appointments'); ?></h3>
          <?php
            if (qtranxf_getLanguage() === 'es') {
              $cita_text = IGV_get_option('_igv_visits_text');
            } else {
              $cita_text = IGV_get_option('_igv_visits_text_en');
            }
            if (!empty($cita_text)) {
              echo apply_filters('the_content', $cita_text);
            }
          ?>
        </div>

        <div class="margin-bottom-small">
          <h3 class="margin-bottom-small"><?php echo __('[:es]Agendar cita[:en]Schedule appointment'); ?></h3>
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