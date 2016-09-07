<?php

$home_content = get_post_meta( get_the_ID(), '_igv_home_content', true);

if ($home_content) {
  echo '<div id="home-holder">';
  foreach ($home_content as $item) {
    if (!empty($item['image_id']) || !empty($item['event'])) {
      echo '<div class="home-item margin-top-';
      echo rand(0,1) == 1 ? 'mid' : 'basic';
      echo '">';
      if (!empty($item['event'])) {
        echo '<a href="' . get_permalink($item['event']) . '">';
      }
      if (!empty($item['image_id'])) {
        echo '<div class="home-item-image-holder">' . wp_get_attachment_image($item['image_id'], 'home-thumb') . '</div>';
      } else if (!empty($item['event'])) {

        echo '<h3>';
        echo get_the_title($item['event']); 
        echo '</h3>';
      }
      if (!empty($item['event'])) {
        echo '</a>';
      }
      echo '</div>';
    }
  }
  echo '</div>';
}

?>