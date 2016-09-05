<?php

$home_content = get_post_meta( get_the_ID(), '_igv_home_content', true);

if ($home_content) {
  foreach ($home_content as $item) {
    echo '<div class="home-item"><div class="home-item-holder">';
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
    echo '</div></div>';
  }
}

?>