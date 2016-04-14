<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */

  $program_meta = new_cmb2_box( array(
  	'id'            => $prefix . 'programacion_metabox',
  	'title'         => __( 'Programación Metabox', 'cmb2' ),
  	'object_types'  => array( 'programacion', ), // Post type
  ) );

  $program_meta->add_field( array(
		'name' => __( 'Start Date', 'cmb2' ),
		'desc' => __( 'Fecha de inicio', 'cmb2' ),
		'id'   => $prefix . 'start_time',
		'type' => 'text_date_timestamp',
	) );

  $program_meta->add_field( array(
		'name' => __( 'End Date', 'cmb2' ),
		'desc' => __( 'Fecha de fin', 'cmb2' ),
		'id'   => $prefix . 'end_time',
		'type' => 'text_date_timestamp',
	) );

  $program_meta->add_field( array(
    'name'    => __( 'Event key color', 'cmb2' ),
    'desc'    => __( 'Color de evento', 'cmb2' ),
    'id'      => $prefix . 'color',
    'type'    => 'colorpicker',
    'default' => '#ffffff',
    // 'attributes' => array(
    // 	'data-colorpicker' => json_encode( array(
    // 		'palettes' => array( '#3dd0cc', '#ff834c', '#4fa2c0', '#0bc991', ),
    // 	) ),
    // ),
  ) );

  $program_meta->add_field( array(
		'name'       => __( 'Event Number', 'cmb2' ),
		'desc'       => __( 'Número de evento', 'cmb2' ),
		'id'         => $prefix . 'number',
		'type'       => 'text',
	) );

  $program_meta->add_field( array(
		'name'       => __( 'Sub-Title', 'cmb2' ),
		'desc'       => __( 'Sub-titulo', 'cmb2' ),
		'id'         => $prefix . 'subtitle',
		'type'       => 'text',
	) );

  $program_meta->add_field( array(
		'name'    => __( 'Credits', 'cmb2' ),
		'desc'    => __( '...', 'cmb2' ),
		'id'      => $prefix . 'credits',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 14, ),
	) );

}
?>
