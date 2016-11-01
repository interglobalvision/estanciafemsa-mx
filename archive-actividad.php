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
    $event = get_post_meta($post->ID, '_igv_related_event', true);
    $color = !empty($event) ? get_post_meta($event, '_igv_color', true) : false;
?>

    <article <?php post_class('row margin-bottom-small margin-top-tiny'); ?> id="post-<?php the_ID(); ?>">

      <!-- Desktop Article Meta -->
      <div class="article-meta col col-s-12 col-m-3 col-xl-2 only-desktop">
        <h3 class="font-capitalize font-bold"><?php _e('[:en]Academic Activities[:es]Actividades Académicas'); ?></h3>
      </div>

      <!-- Mobile Article Meta -->
      <div class="article-meta col col-s-12 col-m-3 only-mobile margin-bottom-tiny">
        <h3 class="font-capitalize font-bold"><?php _e('[:en]Academic Activities[:es]Actividades Académicas'); ?>
      </div>

      <!-- Article Content -->
      <div class="article-content col col-s-12 col-m-9 col-l-6">
        <header class="article-content-header margin-bottom-small">
          <a href="<?php the_permalink() ?>"><h3 class="u-inline-block font-bold" <?php echo $color ? 'style="color: ' . $color . '"' : ''; ?>><?php the_title(); ?></h3></a>
        </header>
      </div>

    </article>

<?php
  }
} else {
?>
    <article class="u-alert row">
      <div class="col col-s-12">
        <?php _e('[:es]Lo sentimos, no hemos encontrado lo que estás buscando[:en]Sorry, no posts matched your criteria'); ?>
      </div>
    </article>
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
