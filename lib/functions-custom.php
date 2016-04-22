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
    $latest = current_query();

    if ($latest->have_posts()) {
      $post_id = $latest->post->ID;
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
  <div class="index-programacion-post u-flex-center font-sans font-color-white" style="background-color: <?php if (!empty($meta['_igv_color'][0])) {echo $meta['_igv_color'][0];} ?>; background-image: url(<?php if (!empty($img)) {echo $img[0];} ?>);">
    <?php if (!empty($meta['_igv_number'][0])) {echo 'No. ' . add_leading_zero( $meta['_igv_number'][0] );} ?>
  </div>
</a>

<?php

}

// Query Current Program

function current_query() {
  $date = time();

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