<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="page">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

    <article <?php post_class('container'); ?> id="post-<?php the_ID(); ?>">

      <div class="row">
        <div class="col col-4">

          <h3 class="font-key-color text-align-center margin-top-basic margin-bottom-basic"><?php the_title(); ?>:</h3>

          <div class="copy"><?php the_content(); ?></div>

        </div>

        <div class="col col-4">

          <div id="page-key-color-image" class="image-key-color-holder background-key-color">
            <div class="image-key-color" style="background-image: url(<?php if (!empty($img)) {echo $img[0];} ?>);"></div>
          </div>

        </div>

        <div class="col col-4">

<?php
      $current_query = current_query();

      if ($current_query->have_posts()) {
        while ($current_query->have_posts()) {
          $current_query->the_post();

          $number = get_post_meta($post->ID, '_igv_number');
          $program_files = get_post_meta($post->ID, '_igv_program_files');
?>

          <h3 class="font-key-color text-align-center margin-top-basic margin-bottom-basic">
            <?php if (!empty($number[0])) { echo 'No. ' . add_leading_zero($number[0]) . '<br>'; } ?>
            <?php the_title(); ?>
          </h3>

<?php

          if (!empty($program_files[0])) {
            echo '<ul>';
            foreach ($program_files[0] as $file) {
              echo "<li><a href=" . $file['file'] . " target='_blank' class='font-underline'>" . __('[:es]' . $file['text'] . '[:en]' . $file['text_en']) . "</a></li>";
            }
            echo '</ul>';
          } // end if
        } // end while
      } // end if
      wp_reset_postdata();
?>
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

  <!-- end page -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
