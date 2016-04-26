<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="page">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    $meta = get_post_meta($post->ID);
?>

    <article <?php post_class('row margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">

      <div class="col col-2"></div>
      <div class="col col-8">

        <h3 class="font-serif"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

        <div class="copy">
          <?php the_content(); ?>
        </div>

      </div>

    </article>

<?php
  }
} else {
?>
    <article class="row"><div class="col col-12 text-align-center u-alert"><?php _e('[:es]Lo sentimos, pero no podemos encontrar lo que estás buscando.[:en]Sorry, no posts matched your criteria[:]'); ?></div></article>
<?php
} ?>

  <!-- end posts -->
  </section>

<!-- end main-content -->
</main>

<?php
get_footer();
?>
