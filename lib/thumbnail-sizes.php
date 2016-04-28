<?php

if( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'admin-thumb', 150, 150, false );
  add_image_size( 'opengraph', 1200, 630, true );

  add_image_size( 'index-programacion-post', 300, 400, true );

  add_image_size( 'gallery', 656, 450, false );

  add_image_size( 'col-4', 368, 9999, false );

  add_image_size( 'name', 199, 299, true );
}