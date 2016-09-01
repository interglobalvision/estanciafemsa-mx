<?php

// Custom functions (like special queries, etc)

// query current programacion post
function current_query() {
  $date = current_time( 'timestamp' );
  $args = array(
    'post_type' => 'programacion',
    'posts_per_page' => 1,
    'meta_key' => '_igv_end_time',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key'     => '_igv_end_time',
        'value'   => $date,
        'compare' => '>='  //returns Current or nearest Future
      )
    )
  );
  $query = new WP_Query($args);
  if (!$query->have_posts()) { // if no Current or Future, get Past
    $args = array(
      'post_type' => 'programacion',
      'posts_per_page' => 1,
      'meta_key' => '_igv_end_time',
      'orderby' => 'meta_value_num',
      'order' => 'DESC',
      'meta_query' => array(
        'relation' => 'AND',
        array(
          'key'     => '_igv_end_time',
          'value'   => $date,
          'compare' => '<'  //returns nearest Past
        )
      )
    );
    $query = new WP_Query($args);
  }
  return $query;
}

// adds leading 0 for numbers less than 2 digits
function add_leading_zero($number) {
  return sprintf("%02d", $number);
}

function render_home_style_content($home_content) {
  if ($home_content) {
  foreach ($home_content as $item) {
    echo '<div class="home-item u-pointer">';
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
}
}