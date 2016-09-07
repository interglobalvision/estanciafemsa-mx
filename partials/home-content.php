<?php

$home_content = get_post_meta( get_the_ID(), '_igv_home_content', true);

if ($home_content) {
  echo '<div id="home-holder">';
  foreach ($home_content as $item) {
    echo '<div class="home-item margin-top-';
    echo rand(0,1) == 1 ? 'mid' : 'basic';
    echo '">';
    if (!empty($item['link'])) {
      echo '<a href="' . get_permalink($item['link']) . '">';
    }
    if (!empty($item['image_id'])) {
      echo '<div class="home-item-image-holder">' . wp_get_attachment_image($item['image_id'], 'home-thumb') . '</div>';

      if (!empty($item['caption'])) {
        echo '<h4 class="home-item-image-caption padding-top-tiny text-align-center">' . $item['caption'] . '</h4>';
      }
    } else if (!empty($item['text'])) {
      echo '<h3>' . $item['text'] . '</h3>';
    }
    if (!empty($item['link'])) {
      echo '</a>';
    }
    echo '</div>';
  }
  echo '</div>';
}

?>