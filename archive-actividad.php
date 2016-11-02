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

    $event_activity_num = '';

    if (!empty($event)) {
      $event_num = get_post_meta($event, '_igv_number', true);
      $activity_num = get_post_meta($post->ID, '_igv_activity_num', true);

      if (!empty($event_num)) {
        $event_activity_num = 'No. ' . add_leading_zero($event_num) . '.' . $activity_num;
      }
    }
?>

    <article <?php post_class('row margin-bottom-small margin-top-tiny'); ?> id="post-<?php the_ID(); ?>">

      <!-- Article Meta -->
      <div class="article-meta col col-s-12 col-m-3 col-xl-2">
        <h3 class="font-capitalize font-bold article-meta-item"><?php _e('[:en]Academic Activities[:es]Actividades Académicas'); ?></h3>
      </div>

      <!-- Article Content -->
      <div class="article-content col col-s-12 col-m-9 col-l-6">
        <header class="article-content-header margin-bottom-small">
          <a href="<?php the_permalink() ?>"><h3 class="u-inline-block font-bold" <?php echo $color ? 'style="color: ' . $color . '"' : ''; ?>><?php 
          echo __('[:es]Actividad Académica[:en]Academic Activity');
          echo ' ' . $event_activity_num . '<br>';
          the_title(); 
          ?></h3></a>
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
