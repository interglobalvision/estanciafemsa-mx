<?php

// Custom hooks (like excerpt length etc)

// Show excerpt field by default
add_filter('default_hidden_meta_boxes', 'show_hidden_meta_boxes', 10, 2);

function show_hidden_meta_boxes($hidden, $screen) {
  if ('post' == $screen->base) {
    foreach($hidden as $key=>$value) {
      if ('postexcerpt' == $value) {
        unset($hidden[$key]);
        break;
      }
    }
  }

  return $hidden;
}