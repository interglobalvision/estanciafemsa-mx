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

      <div class="page-content col col-s-12 offset-m-3 col-m-6">
        <header class="article-content-header margin-bottom-small">
          <h3><?php the_title(); ?></h3>
        </header>


        <div class="margin-bottom-small">
          <?php the_content(); ?>
        </div>

        <div class="margin-bottom-small">
          <h3 class="margin-bottom-small"><?php echo __('[:es]Directorio[:en]Directory'); ?></h3>
          <?php
            if (qtranxf_getLanguage() === 'es') {
              $about_directory = IGV_get_option('_igv_about_directory');
            } else {
              $about_directory = IGV_get_option('_igv_about_directory_en');
            }
            if (!empty($about_directory)) {
              echo apply_filters('the_content', $about_directory);
            }
          ?>
        </div>

        <div class="margin-bottom-small">
          <h3 class="margin-bottom-small"><?php echo __('[:es]Prensa[:en]Press'); ?></h3>
<?php
      $current_query = current_query();
      if ($current_query->have_posts()) {
        while ($current_query->have_posts()) {
          $current_query->the_post();
/*           $number = get_post_meta($post->ID, '_igv_number'); */
          $program_files = get_post_meta($post->ID, '_igv_program_files');

          if (!empty($program_files[0])) {
            echo '<ul>';
            foreach ($program_files[0] as $file) {
              echo "<li><a href=" . $file['file'] . " target='_blank' class='font-underline'>File: " . __($file['text']) . "</a></li>";
            }
            echo '</ul>';
          }
        }
      }
      wp_reset_postdata();
?>
          <p>
          <?php
            $press_email = IGV_get_option('_igv_prensa_email');
            $press_telephone = IGV_get_option('_igv_prensa_telephone');
            if (!empty($press_email)) {echo '<a href="mailto:' . $press_email . '">' . $press_email . '<a/><br/>';}
            if (!empty($press_telephone)) {echo '<a href="tel:' . $press_telephone . '">' . $press_telephone . '<a/>';}
          ?>
          </p>
        </div>

        <div class="margin-bottom-small">
          <h3 class="margin-bottom-small"><?php echo __('[:es]Contacto[:en]Contact'); ?></h3>
          <?php
            $about_contact = IGV_get_option('_igv_about_contact');
            if (!empty($about_contact)) {
              echo apply_filters('the_content', $about_contact);
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