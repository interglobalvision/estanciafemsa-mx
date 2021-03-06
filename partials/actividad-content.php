<?php
$date = get_post_meta($post->ID, '_igv_activity_dates', true);

$event = get_post_meta($post->ID, '_igv_related_event', true);
$color = !empty($event) ? get_post_meta($event, '_igv_color', true) : false;

$event_activity_num = '';

if (!empty($event)) {
  $event_num = get_post_meta($event, '_igv_number', true);
  $activity_num = get_post_meta($post->ID, '_igv_activity_num', true);

  if (!empty($event_num) && !empty($activity_num)) {
    $event_activity_num = 'No. ' . add_leading_zero($event_num) . '.' . $activity_num;
  }
}
?>

<article <?php post_class('row margin-bottom-small margin-top-tiny'); ?> id="post-<?php the_ID(); ?>">

  <!-- Article Meta -->
  <div class="article-meta col col-s-12 col-m-3 col-xl-2">
    <?php
    if (!empty($date)) {
    ?>
    <h3 class="font-capitalize font-bold article-meta-item"><?php echo apply_filters('the_content', $date); ?></h3>
    <?php
    }
    ?> 
    
    <div class="font-serif article-meta-item">
    <?php echo '<a href="' . home_url('actividad') . '">' . __('[:es]Actividad Académica[:en]Academic Activity[:]') . '</a>'; ?>
    </div>

    <?php 
    if (is_single()) {
    ?>
    <a class="font-serif article-meta-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer"><?php _e('[:en]Share on Facebook[:es]Compartir en Facebook'); ?></a>
    <?php 
    }
    ?>
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
    <div class="font-serif">
    <?php
    if( is_single() ) {
      the_content(); 
    } else {
      $content = !empty($post->post_excerpt) ? $post->post_excerpt . ' <a class="more-link font-bold font-sans font-size-basic" href="'. get_permalink($post->ID) .'">' . __('[:es]LEER MÁS[:en]READ MORE') . '</a>' : get_the_content();

      echo apply_filters('the_content', $content); 
    }
    ?>    
    </div>
  </div>

</article>