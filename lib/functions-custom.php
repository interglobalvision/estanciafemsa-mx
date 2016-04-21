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

// RENDER functions

function render_programacion_index($post_id) {

  $meta = get_post_meta($post_id);
  $img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'index-programacion-post');
?>

<a href="<?php echo get_the_permalink($post_id); ?>">
  <div class="index-programacion-post-container background-key-color">
    <div class="index-programacion-post-image image-key-color" 
    style="background-image: url(<?php if (!empty($img)) {echo $img[0];} ?>);"></div>
    <div class="index-programacion-post-number u-flex-center font-sans font-color-white">
      <?php if (!empty($meta['_igv_number'][0])) {echo 'No. ' . add_leading_zero( $meta['_igv_number'][0] );} ?>
    </div>
  </div>
</a>

<?php

}

// adds leading 0 for numbers less than 2 digits

function add_leading_zero($number) {
  return sprintf("%02d", $number);
} 
