<?php

$home_content = get_post_meta( get_the_ID(), '_igv_home_content', true);

if ($home_content) {
  echo '<div id="home-holder">';
  foreach ($home_content as $item) {
    if (!empty($item['link'])) {
      echo '<div class="home-item margin-top-';
      echo rand(0,1) == 1 ? 'mid' : 'basic';
      echo !empty($item['image_id']) ? ' text-align-center">' : '">';
      echo '<a href="' . get_permalink($item['link']) . '">';
      if (!empty($item['image_id'])) {
        echo '<div class="home-item-image-holder">' . wp_get_attachment_image($item['image_id'], 'home-thumb') . '</div>';
      } else if (get_post_type($item['link']) == 'programacion') {
        $number = get_post_meta($item['link'], '_igv_number', true);
        $subtitle = get_post_meta($item['link'], '_igv_subtitle', true);
        $color = get_post_meta($item['link'], '_igv_color', true);

        echo '<h3 class="u-inline-block"';
        echo !empty($color) ? ' style="color: ' . $color . '">' : '>';
        echo 'No. ' . add_leading_zero($number) . '<br>';
        echo get_the_title($item['link']); 
        echo !empty($subtitle) ? ', <em>' . $subtitle . '</em>' : '';
        echo '</h3>';
      }
      echo '</a>';
      if (!empty($item['image_id']) && (!empty($item['caption']) || !empty($item['title']))) {
        echo '<h4 class="home-item-image-caption padding-top-tiny text-align-center">';
        echo !empty($item['title']) ? '<em>' . $item['title'] . '</em>' : '';
        echo !empty($item['caption']) ? $item['caption'] : '';
        echo '</h4>';
      }
      echo '</div>';
    }
  }
  echo '</div>';
}

?>