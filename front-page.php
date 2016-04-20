<?php
get_header();
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
        'compare' => '<='
      ),
      array(
        'key'     => '_igv_end_time',
        'value'   => $date,
        'compare' => '>='
      )
    )
  );
  $ahora = new WP_Query($args);
  if ($ahora->have_posts()) {
    while ($ahora->have_posts()) {
      $ahora->the_post();
?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

      <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>

      <?php the_content(); ?>

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