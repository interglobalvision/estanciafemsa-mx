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

// order Noticias by meta field _igv_post_date
function orderby_meta_date( $query ) {
  if ( $query->is_home() && $query->is_main_query() && !is_admin() ) {
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', '_igv_post_date' );
  }
}
add_action( 'pre_get_posts', 'orderby_meta_date' );

// get_posts for actividades related with event
function get_event_actividades($event_id) {
  $args = array (
    'post_type'       => array( 'actividad' ),
    'posts_per_page'  => '-1',
    'order'           => 'ASC',
    'meta_query'      => array(
      array(
        'key'       => '_igv_related_event',
        'value'     => $event_id,
      ),
    ),
  );

  return get_posts($args);
}
