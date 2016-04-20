<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <!-- main posts loop -->
  <section id="posts">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

    <article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">

      <div class="col col-9">

        <?php the_content(); ?>

      </div>
      <div class="col col-3">

        <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

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