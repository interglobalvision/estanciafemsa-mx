<?php

// Custom functions (like special queries, etc)

function get_key_color() {

  $key_color = 'red';

  // if on single programacion post get the current post ID
  global $post;
  if (is_single() && is_single_type('programacion', $post)) {

    $post_id = $post->ID;

  } else {

    // get post ID from latest programacion. if none fallback
    $latest_programacion = get_posts(array(
      'post_type' => 'programacion',
      'posts_per_page' => 1,
    ));

    if (!empty($latest_programacion[0])) {

      $post_id = $latest_programacion[0]->ID;

    } else {

      $post_id = false;

    }

  }

  if ($post_id) {

    // post color value from post meta
    $meta = get_post_meta($post_id, '_igv_color');

    if (!empty($meta[0])) {
      $key_color = $meta[0];
    }

  }

  return $key_color;
}