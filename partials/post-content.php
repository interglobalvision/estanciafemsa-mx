<?php
$author = get_post_meta($post->ID, '_igv_post_author', true);
$date = get_post_meta($post->ID, '_igv_post_date', true);
if (!empty($date)) {
  $time = new \Moment\Moment('@' . $date);
}

$event = get_post_meta($post->ID, '_igv_related_event', true);
$color = !empty($event) ? get_post_meta($event, '_igv_color', true) : false;
?>

<article <?php post_class('row margin-bottom-small margin-top-tiny'); ?> id="post-<?php the_ID(); ?>">

  <!-- Article Meta -->
  <div class="article-meta col col-s-12 col-m-3 col-xl-2">
    <?php
    if (!empty($date)) {
    ?>
    <h3 class="font-capitalize font-bold article-meta-item"><?php echo $time->format('j F, Y'); ?></h3>
    <?php
    }
    ?> 
    
    <div class="font-serif article-meta-item">
    <?php 
      if (!empty($author)) {
        echo __('[:es]Por[:en]By[:]') . ':<br/>' . $author;
      }
    ?>
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
      <a href="<?php the_permalink() ?>"><h3 class="u-inline-block font-bold" <?php echo $color ? 'style="color: ' . $color . '"' : ''; ?>><?php the_title(); ?></h3></a><?php

        $source = get_post_meta($post->ID, '_igv_source_text', true);
        $link = get_post_meta($post->ID, '_igv_source_link', true);

        if (!empty($source)) {
          echo '&nbsp;<h4 class="font-serif u-inline-block">&nbsp;—&nbsp;</h4>&nbsp;';
          echo '<h4 class="font-serif u-inline-block">';
          echo !empty($link) ? '<a href="' . esc_url($link) . '" target="_blank" rel="noopener noreferrer">' . $source . '</a>' : $source;
          echo '</h4>';
        }
      ?>
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