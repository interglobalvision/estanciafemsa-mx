<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts">

<?php
if(have_posts()) {
  while(have_posts()) {
    the_post();
    $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'col-4');
?>

    <article <?php post_class('container'); ?> id="post-<?php the_ID(); ?>">

      <div class="row">
        <div class="col col-4">

          <h3 class="font-key-color text-align-center margin-top-basic margin-bottom-basic"><?php echo __('[:es]Previa Cita[:en]Appointments'); ?></h3>

          <div class="copy"><?php
            if (qtranxf_getLanguage() === 'es') {
              $cita_text = IGV_get_option('_igv_visits_text');
              if (!empty($cita_text)) {
                echo wpautop($cita_text);
              }
            } else {
              $cita_text = IGV_get_option('_igv_visits_text_en');
              if (!empty($cita_text)) {
                echo wpautop($cita_text);
              }
            }
          ?></div>

        </div>

        <div class="col col-4">

          <div id="page-key-color-image" class="image-key-color-holder background-key-color">
            <div class="image-key-color" style="background-image: url(<?php if (!empty($img)) {echo $img[0];} ?>);"></div>
          </div>

        </div>

        <div class="col col-4">

          <h3 class="font-key-color text-align-center margin-top-basic margin-bottom-basic"><?php echo __('[:es]Agendar cita[:en]Schedule appointment'); ?></h3>

          <div class="copy">
          <?php
            if (qtranxf_getLanguage() === 'es') {
              $cita_text_2 = IGV_get_option('_igv_visits_guide');
              if (!empty($cita_text_2)) {
                echo wpautop($cita_text_2);
              }
            } else {
              $cita_text_2 = IGV_get_option('_igv_visits_guide_en');
              if (!empty($cita_text_2)) {
                echo wpautop($cita_text_2);
              }
            }

            $cost_general = '200';
            $cost_special = '100';
            // if set override
            $cost_general = IGV_get_option('_igv_visits_cost_general');
            $cost_special = IGV_get_option('_igv_visits_cost_special');

            $cost_special_terms = IGV_get_option('_igv_visits_cost_special_terms');
            $cost_special_terms_en = IGV_get_option('_igv_visits_cost_special_terms_en');
          ?>

            <span class="font-key-color"><?php echo __('[:es]Costo de entrada general[:en]Cost of general entry'); ?></span><br/>
            <span class="font-key-color"><?php echo $cost_general; ?></span> pesos<br/>
            <span class="font-key-color"><?php echo $cost_special; ?></span> pesos <?php
              if (!empty($cost_special_terms) && !empty($cost_special_terms_en)) {
                echo __('[:es]' . $cost_special_terms . '[:en]' . $cost_special_terms_en);
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