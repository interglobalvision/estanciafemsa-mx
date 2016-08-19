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

    <article <?php post_class('row margin-bottom-mid'); ?> id="page-<?php the_ID(); ?>">

      <div class="page-content col col-s-12 offset-m-3 col-m-6">
        <header class="article-content-header margin-bottom-small">
          <h3><?php the_title(); ?></h3>
        </header>
        <?php the_content(); ?>
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