<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

    <article <?php post_class('container'); ?> id="post-<?php the_ID(); ?>">

      <div class="row">
        <div class="col col-4">

          <div class="font-key-color font-sans text-align-center"><?php the_title(); ?>:</div>

          <div class="copy"><?php the_content(); ?></div>

        </div>

        <div class="col col-4">

          <?php the_post_thumbnail('col-4'); ?>

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

          <div class="font-key-color font-sans text-align-center">
            <?php if (!empty($number[0])) { echo 'No. ' . $number[0] . '<br>'; } ?>
            <?php the_title(); ?>
          </div>

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

  } // end while
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