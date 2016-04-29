<?php

// get slug of active template/page for menu actives
function get_active_slug() {
  $active_slug = null;
  $queried_object = get_queried_object();

  if ( is_page() || is_home() ) {
    $active_slug = $queried_object->post_name;
  } else if (is_post_type_archive()) {
    $active_slug = $queried_object->rewrite['slug'];
  } else if (is_single()) {
    $active_slug = $queried_object->post_type;
  }

  return $active_slug;
}

// get key color from approriate programacion post
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

// render programacion post on index
function render_programacion_index($post_id) {
  $meta = get_post_meta($post_id);
  $img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'index-programacion-post');
?>

<a href="<?php echo get_the_permalink($post_id); ?>">
  <div class="index-programacion-post-container image-key-color-holder" style="background-color: <?php if (!empty($meta['_igv_color'][0])) {echo $meta['_igv_color'][0];} ?>">
    <div class="index-programacion-post-image image-key-color" style="background-image: url(<?php if (!empty($img)) {echo $img[0];} ?>);"></div>
    <div class="index-programacion-post-number u-flex-center font-sans font-color-white">
      <?php if (!empty($meta['_igv_number'][0])) {echo 'No. ' . add_leading_zero( $meta['_igv_number'][0] );} ?>
    </div>
  </div>
</a>

<?php

}

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
