<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="single-programacion">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    $meta = get_post_meta($post->ID);
?>

    <article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">

      <div class="col col-8">

        <?php the_content(); ?>

      </div>
      <div class="col col-1"></div>
      <div class="col col-3">
        <header id="single-programacion-header" class="text-align-center font-key-color margin-bottom-large">
          <h3><?php if (!empty($meta['_igv_number'][0])) { echo $meta['_igv_number'][0];} ?></h3>
          <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
          <h3><?php if (!empty($meta['_igv_subtitle'][0])) { echo $meta['_igv_subtitle'][0];} ?></h3>
        </header>

        <?php if (!empty($meta['_igv_credits'][0])) { echo wpautop($meta['_igv_credits'][0]);} ?>
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

<!-- end main-content -->
</main>

<?php
get_footer();
?>