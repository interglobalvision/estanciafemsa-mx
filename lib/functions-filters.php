<?php

// Custom filters (like pre_get_posts etc)

// Page Slug Body Class
function add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/* For adding custom field to gallery popup */
function add_image_attachment_fields_to_edit($form_fields, $post) {
  $checked = get_post_meta($post->ID, '_igv_full_view', true) == 'on' ? 'checked' : '';

  $form_fields["full_view"] = array(
    "label" => __("Full view"),
    "input" => "html",
    "html"  => "<input type='checkbox' {$checked} 
    name='attachments[{$post->ID}][full_view]'
    id='attachments[{$post->ID}][full_view]' />",
    "checked" => get_post_meta($post->ID, "_igv_full_view", true),
    "helps" => __("Make full view?"),
  );
   return $form_fields;
}
add_filter("attachment_fields_to_edit", "add_image_attachment_fields_to_edit", null, 2);

function add_image_attachment_fields_to_save($post, $attachment) {

  if( isset($attachment['full_view']) ){
    update_post_meta($post['ID'], '_igv_full_view', 'on');
  } else {
    update_post_meta($post['ID'], '_igv_full_view', '');
  }
  return $post;
}
add_filter("attachment_fields_to_save", "add_image_attachment_fields_to_save", null , 2);

// Changing excerpt more
function custom_excerpt_more($more) {
  global $post;
  return ' <a class="more-link" href="'. get_permalink($post->ID) .'">' . __('[:es]LEER MÁS[:en]READ MORE') . '</a>';
}
add_filter('excerpt_more', 'custom_excerpt_more');

//Remove pages from search results
function exclude_pages_from_search($query) {
    if ( $query->is_search ) {
        $query->set( 'post_type', array('post', 'programacion') );
    }
    return $query;
}
add_filter( 'pre_get_posts','exclude_pages_from_search' );