<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="posts">

<?php
if (!is_single()) {

  $args = array (
    'post_type'              => array( 'post', 'actividad' ),
    'posts_per_page'         => '-1',
  );

  $query = new WP_Query( $args );

} else {
  $query = $wp_query;
}

if( $query->have_posts() ) {
  while( $query->have_posts() ) {
    $query->the_post();

    if (get_post_type() == 'post') {
      get_template_part('partials/post-content');
    } else {
      get_template_part('partials/actividad-content');
    }

  }
} else {
?>
    <article class="u-alert row">
      <div class="col col-s-12">
        <?php _e('[:es]Lo sentimos, no hemos encontrado lo que estás buscando[:en]Sorry, no posts matched your criteria'); ?>
      </div>
    </article>
<?php
} 

wp_reset_postdata();
?>

  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
