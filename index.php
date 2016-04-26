<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="container">

  <div class="row margin-bottom-basic">
    <div class="col col-12 text-align-center">
      <?php get_search_form(); ?>
    </div>
  </div>

  <!-- main posts loop -->
  <section id="posts">
    <div class="row">
<?php
if( have_posts() ) {
  $i = 1;
  while( have_posts() ) {
    the_post();
?>
    <a href="<?php the_permalink() ?>">
      <article <?php post_class('col col-4 margin-bottom-small'); ?> id="post-<?php the_ID(); ?>">
          <h4 class="font-sans font-capitalize text-align-center margin-bottom-tiny"><?php the_time('M Y'); ?>
          <h3 class="index-post-title font-serif"><?php the_title(); ?></h3>
      </article>
    </a>
<?php
    if ($i % 3 === 0) {
      echo '</div><div class="row">';
    }
    $i++;
  }
} else {
?>
    <article class="u-alert"><?php _e('[:es]Lo sentimos, pero no podemos encontrar lo que estás buscando.[:en]Sorry, no posts matched your criteria[:]'); ?></article>
<?php
} ?>
    </div>
  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->
</main>

<?php
get_footer();
?>
