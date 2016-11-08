<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="programacion-posts" class="row margin-bottom-mid">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    $meta = get_post_meta($post->ID);
    $color = get_post_meta($post->ID, '_igv_color', true);
    $number = get_post_meta($post->ID, '_igv_number', true);
    $title = get_post_meta($post->ID, '_igv_archive_title', true);
    $subtitle = get_post_meta($post->ID, '_igv_subtitle', true);
    $curator = get_post_meta($post->ID, '_igv_curator', true);
    $start_time = get_post_meta($post->ID, '_igv_start_time', true);
    $end_time = get_post_meta($post->ID, '_igv_end_time', true);
    $text_time = get_post_meta($post->ID, '_igv_text_time', true);
?>

    <article <?php post_class('col col-s-6 col-m-4 margin-top-small margin-bottom-small text-align-center'); ?> id="programacion-<?php the_ID(); ?>">
      <a href="<?php the_permalink() ?>" class="programacion-item" <?php echo !empty($number) ? 'data-hover-color="' . $number . '"' : ''; ?> >
        <div class="margin-bottom-tiny"><?php echo !empty($number) ? 'No. ' . add_leading_zero($number) : ''; ?></div>
        <h2 class="archive-programacion-post-title"><?php 
          if (!empty($title)) {
            echo apply_filters( 'the_content', $title );
          } else {
            the_title(); 
          }
        ?></h2>
        <h4 class="margin-top-micro">
          <?php echo !empty($subtitle) ? $subtitle : '&nbsp;'; ?>
        </h4>
        <h4 class="margin-top-micro">
          <?php echo !empty($curator) ? $curator : '&nbsp;'; ?>
        </h4>
        <h5 class="margin-top-micro"><?php   
          if (!empty($text_time)) {
            echo $text_time;
          } elseif (!empty($start_time) || !empty($end_time)) {
            $start_date = false;
            $end_date = false;
            if (!empty($start_time)) {
              $start_date = new \Moment\Moment(date('c', $start_time));
            }
            if (!empty($end_time)) {
              $end_date = new \Moment\Moment(date('c', $end_time));
            }
            echo $start_date ? $start_date->format('d. m. y') : false;
            echo $start_date && $end_date ? ' &mdash; ' : false;
            echo $end_date ? $end_date->format('d. m. y') : false;
          } else {
            echo '&nbsp;';
          }
        ?></h5>
      </a>
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

<!-- end main-content -->

</main>

<?php
get_footer();
?>
