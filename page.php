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

          <?php the_post_thumbnail(); ?>
          
        </div>

        <div class="col col-4">

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