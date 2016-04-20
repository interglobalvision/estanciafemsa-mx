<?php
get_header();

$date = time();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts">

<?php
  $args = array(
    'post_type' => 'programacion',
    'posts_per_page' => 1,
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key'     => '_igv_start_time',
        'value'   => $date,
        'compare' => '<='  //returns current or most recent past
      )
    )
  );
  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();

      $meta = get_post_meta($post->ID);
?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

        <?php if (!empty($meta['_igv_start_time'][0])) { 
            $start_time = $meta['_igv_start_time'][0];
          ?>
        <div>
          <div><?php echo __('[:es]Desde[:en]From'); ?></div>
          <div><?php echo date( 'M. d', $start_time ); ?></div>
          <div><?php echo date( 'Y', $start_time ); ?></div>
        </div>
        <?php } ?>

        <h3><?php if (!empty($meta['_igv_number'][0])) { echo 'No. ' . add_leading_zero( $meta['_igv_number'][0] ); } ?></h3>

        <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

        <h3><?php if (!empty($meta['_igv_subtitle'][0])) { echo $meta['_igv_subtitle'][0];} ?></h3>

        <?php if (!empty($meta['_igv_end_time'][0])) { 
            $end_time = $meta['_igv_end_time'][0];
          ?>
        <div>
          <div><?php echo __('[:es]Hasta[:en]Until'); ?></div>
          <div><?php echo date( 'M. d', $end_time ); ?></div>
          <div><?php echo date( 'Y', $end_time ); ?></div>
        </div>
        <?php } ?>

    </article>

<?php
    }
  } else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
  }
  wp_reset_postdata();
?>

  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>