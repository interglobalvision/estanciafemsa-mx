<?php

// Enqueue

function scripts_and_styles_method() {

  $templateuri = get_template_directory_uri() . '/js/';

  $jslib = $templateuri . 'library.js';
  wp_enqueue_script( 'jslib', $jslib,'','',true);

  $myscripts = $templateuri . 'main.js';
  wp_register_script( 'myscripts', $myscripts );

  $is_admin = current_user_can('administrator') ? 1 : 0;
  $jsVars = array(
  	'siteUrl' => home_url(),
  	'themeUrl' => get_template_directory_uri(),
  	'isAdmin' => $is_admin,
  );

  wp_localize_script( 'myscripts', 'WP', $jsVars );
  wp_enqueue_script( 'myscripts', $myscripts,'','',true);

  wp_enqueue_style( 'site', get_stylesheet_directory_uri() . '/css/site.css' );

  if (is_admin()) {
    wp_enqueue_style( 'dashicons' );
  }

}
add_action('wp_enqueue_scripts', 'scripts_and_styles_method');


// Declare thumbnail sizes

get_template_part( 'lib/thumbnail-sizes' );


// Add lib

get_template_part( 'lib/custom-gallery' );
get_template_part( 'lib/post-types' );
get_template_part( 'lib/meta-boxes' );
get_template_part( 'lib/theme-options' );


// Add third party PHP libs

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
function cmb_initialize_cmb_meta_boxes() {
  if (!class_exists( 'cmb2_bootstrap_202' ) ) {
    require_once 'lib/thirdparty/CMB2/init.php';
  }
}

// Add custom functions

get_template_part( 'lib/functions-misc' );
get_template_part( 'lib/functions-custom' );
get_template_part( 'lib/functions-filters' );
get_template_part( 'lib/functions-hooks' );
get_template_part( 'lib/functions-utility' );

?>