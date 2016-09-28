<?php

$home_content = get_post_meta( get_the_ID(), '_igv_home_content', true);

if ($home_content) {
  echo '<div id="home-holder">';
  foreach (array_reverse($home_content) as $item) {
    if (!empty($item['link'])) {
      echo '<div class="home-item margin-bottom-small margin-top-';
      echo rand(0,1) == 1 ? 'basic' : 'small';
      echo !empty($item['image_id']) ? ' text-align-center">' : '">';
      echo '<a href="' . get_permalink($item['link']) . '">';

      if (!empty($item['image_id'])) {

        echo '<div class="home-item-image-holder">' . wp_get_attachment_image($item['image_id'], 'home-thumb') . '</div>';

      } else if (!empty($item['caption']) || get_post_type($item['link']) == 'programacion') {

        echo '<h3 class="u-inline-block font-bold"';

        if (get_post_type($item['link']) == 'programacion') {
          $color = get_post_meta($item['link'], '_igv_color', true);
          echo !empty($color) ? ' style="color: ' . $color . '">' : '>';
        } else {
          echo '>';
        }

        if (!empty($item['caption'])) {
          echo apply_filters('the_content', $item['caption']);
        } else if (get_post_type($item['link']) == 'programacion') {
          $number = get_post_meta($item['link'], '_igv_number', true);
          $subtitle = get_post_meta($item['link'], '_igv_subtitle', true);
          
          echo 'No. ' . add_leading_zero($number) . '<br>';
          echo get_the_title($item['link']); 
          echo !empty($subtitle) ? ', <em>' . $subtitle . '</em>' : ''; 
        }

        echo '</h3>';

      }

      echo '</a>';

      if (!empty($item['image_id']) && !empty($item['caption'])) {

        echo '<h4 class="home-item-image-caption padding-top-micro text-align-center">';
        echo apply_filters('the_content', $item['caption']);
        echo '</h4>';

      }

      echo '</div>';
    }
  }
  if (is_page('home')) {
    echo '<div class="home-item margin-top-';
    echo rand(0,1) == 1 ? 'mid' : 'basic';
    echo ' text-align-center only-mobile">';
    echo '<nav class="home-plus">';
    echo '<a href="' . site_url('/noticias') . '">' . file_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/ui-plus.svg') . '</a>';
    echo '</div>';
  }
  echo '</div>';
}

?>
