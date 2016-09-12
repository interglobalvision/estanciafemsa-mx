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
?>

    <article <?php post_class('col col-s-6 col-m-4 margin-top-small margin-bottom-small text-align-center'); ?> id="programacion-<?php the_ID(); ?>">
      <a href="<?php the_permalink() ?>" class="programacion-item" <?php if (!empty($meta['_igv_color'][0])) { echo 'data-hover-color="' . $meta['_igv_color'][0] . '"'; } ?> >
        <div class="margin-bottom-tiny"><?php if (!empty($meta['_igv_number'][0])) {echo 'No. ' . add_leading_zero( $meta['_igv_number'][0] );} ?></div>
        <h2 class="archive-programacion-post-title"><?php the_title(); ?></h2>
        <h5 class="font-size-h4 margin-top-micro"><?php if (!empty($meta['_igv_subtitle'][0])) {echo $meta['_igv_subtitle'][0];} ?></h5>
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
