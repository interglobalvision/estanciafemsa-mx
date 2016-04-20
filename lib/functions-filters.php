<?php

// Custom filters (like pre_get_posts etc)

function search_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('post_type', array( 'post', ) );
    }
  }
}

add_action('pre_get_posts', 'search_filter');