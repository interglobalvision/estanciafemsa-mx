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

    <article <?php post_class('row page-citas-row margin-bottom-small'); ?> id="page-<?php the_ID(); ?>">

      <div class="page-images col col-s-12 col-m-7 col-l-9 font-size-h4 font-bold">
      <?php 
        $citas_content = get_post_meta( get_the_ID(), '_igv_citas_content', true);

        if ($citas_content) {
      ?>
        <div id="home-holder">
          <?php
          foreach ($citas_content as $item) {
            if (!empty($item['image_id'])) {
          ?>
          <div class="home-item citas-item margin-bottom-small margin-top-<?php echo rand(0,1) == 1 ? 'basic' : 'small'; ?> text-align-center">
            <div class="home-item-image-holder">
              <?php echo wp_get_attachment_image($item['image_id'], 'home-thumb'); ?>
            </div>
          </div>
          <?php
            }
          }
          ?>
        </div>
      <?php 
        }
      ?>
      </div>

      <div class="page-content col col-s-12 col-m-5 col-l-3">

        <div class="margin-bottom-small font-sans">
          <h3 class="font-bolder font-uppercase"><?php echo __('[:es]Previa Cita[:en]Appointments'); ?></h3>
          <div class="font-bold font-size-h4">
            <?php
              $cita_text = get_post_meta( get_the_ID(),'_igv_visits_text', true);
              $cita_url = get_post_meta( get_the_ID(),'_igv_visits_url', true);
              if (!empty($cita_text)) {
                echo apply_filters('the_content', $cita_text);
              }
              if (!empty($cita_url)) {
                echo '<p>o por internet <a href="' . esc_url($cita_url) . '" target="_blank" rel="noopener noreferrer">' . 
                  '<img class="citas-arrow" src="' . get_bloginfo('stylesheet_directory') . '/img/dist/ui-cursor-right.png"></a></p>'; 
              }
            ?>
          </div>
        </div>

        <div class="margin-bottom-small font-sans">
          <h3 class="font-bolder font-uppercase"><?php echo __('[:es]Agendar cita[:en]Schedule appointment'); ?></h3>
          <div class="font-bold font-size-h4">
            <?php
              $cita_text_2 = get_post_meta( get_the_ID(),'_igv_visits_guide', true);
              $cost = get_post_meta( get_the_ID(),'_igv_visits_cost', true);
              if (!empty($cita_text_2)) {
                echo apply_filters('the_content', $cita_text_2);
              }
              if (!empty($cost)) {
                echo apply_filters('the_content', $cost);
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
