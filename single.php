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

    <article <?php post_class('row margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">

      <div class="col col-2"></div>
      <div class="col col-8">

        <h4 class="font-sans font-capitalize"><?php the_time('F Y'); ?></h4>
        <h3 class="font-serif"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

        <div class="copy">
          <?php the_content(); ?>
        </div>

      </div>

    </article>

<?php
    $tags = wp_get_post_tags($post->ID);

    if ($tags) {
      $tag_ids = array();

      foreach ($tags as $tag) {
        $tag_ids[] = $tag->term_id;
      }

      $args = array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page' => 6,
      );

      $related = new wp_query($args);

      if ($related->have_posts()) {
        $i = 0;
?>

    <div class="row">
      <div class="col col-12">
        <h3 class="text-align-center margin-bottom-basic"><?php echo __('[:es]Contenidos relacionados:[:en]Related content:'); ?></h3>
      </div>
    </div>
<?php
        while ($related->have_posts()) {
          $related->the_post();
          if ($i % 2 === 0) {
            echo '<div class="row"><div class="col col-2"></div>';
          }
?>
      <div class="col col-4">
        <h4 class="font-sans font-capitalize text-align-center margin-bottom-tiny"><?php the_time('M Y'); ?>
        <h3 class="index-post-title font-serif"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
      </div>
<?php
          if ($i % 2 !== 0) {
            echo '<div class="col col-2"></div></div>';
          }
          $i++;
        }
      }
      wp_reset_query();
    }
  }
} else {
?>
    <article class="row"><div class="col col-12 text-align-center u-alert"><?php _e('Sorry, no posts matched your criteria'); ?></div></article>
<?php
} ?>

  <!-- end posts -->
  </section>

<!-- end main-content -->
</main>

<?php
get_footer();
?>