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

  // **** POST
  $post_meta = new_cmb2_box( array(
    'id'            => $prefix . 'post_metabox',
    'title'         => __( 'Entrada Metabox', 'cmb2' ),
    'object_types'  => array( 'post', ), // Post type
  ) );

  $post_meta->add_field( array(
    'name' => __( 'Source', 'cmb2' ),
    'id'   => $prefix . 'source_text',
    'type' => 'text',
  ) );

  $post_meta->add_field( array(
    'name' => __( 'Source Link', 'cmb2' ),
    'id'   => $prefix . 'source_link',
    'type' => 'text',
  ) );

  $post_meta->add_field( array(
    'name' => __( 'Evento relacionado', 'cmb2' ),
    'id'   => $prefix . 'related_event',
    'type' => 'post_search_text',
    'post_type' => array('programacion'),
    'select_type' => 'radio',
    'select_behavior' => 'replace',
  ) );

  // **** PROGRAM
  $program_meta = new_cmb2_box( array(
  	'id'            => $prefix . 'programacion_metabox',
  	'title'         => __( 'Programación Metabox', 'cmb2' ),
  	'object_types'  => array( 'programacion', ), // Post type
  ) );

  $program_meta->add_field( array(
		'name' => __( 'Fecha de inicio', 'cmb2' ),
		'id'   => $prefix . 'start_time',
		'type' => 'text_date_timestamp',
    'date_format' => 'd/m/Y'
	) );

  $program_meta->add_field( array(
		'name' => __( 'Fecha de fin', 'cmb2' ),
		'id'   => $prefix . 'end_time',
		'type' => 'text_date_timestamp',
    'date_format' => 'd/m/Y'
	) );

  $program_meta->add_field( array(
		'name'    => __( 'Galería', 'cmb2' ),
    'button' => 'Modificar galería', // Optionally set button label
    'clear-button' => 'Eliminar galería', // Optionally set clear button label
		'id'      => $prefix . 'program_gallery',
		'type' => 'pw_gallery',
    'preview_size' => array( 150, 150 ), // Set the size of the thumbnails
    'sanitization_cb' => 'pw_gallery_field_sanitise', // REQUIRED
	) );

  $program_meta->add_field( array(
    'name'    => __( 'Color del evento', 'cmb2' ),
    'id'      => $prefix . 'color',
    'type'    => 'colorpicker',
    'default' => '#0e0e0e',
    // 'attributes' => array(
    // 	'data-colorpicker' => json_encode( array(
    // 		'palettes' => array( '#3dd0cc', '#ff834c', '#4fa2c0', '#0bc991', ),
    // 	) ),
    // ),
  ) );

  $program_meta->add_field( array(
		'name'       => __( 'Número de evento', 'cmb2' ),
		'id'         => $prefix . 'number',
		'type'       => 'text',
	) );

  $program_meta->add_field( array(
		'name'       => __( 'Sub-título', 'cmb2' ),
		'id'         => $prefix . 'subtitle',
		'type'       => 'text',
    'attributes' => array(
      'class' => 'cmb2-qtranslate'
    )
	) );

  $program_meta->add_field( array(
		'name'    => __( 'Creditos', 'cmb2' ),
		'id'      => $prefix . 'credits',
		'type'    => 'wysiwyg',
		'options' => array(
		  'textarea_rows' => 14,
      'editor_class' => 'cmb2-qtranslate'
     ),
	) );

  /*
  $program_files_group = $program_meta->add_field( array(
    'id'          => $prefix . 'program_files',
    'type'        => 'group',
    'name'    => __( 'Archivos para la sección de Prensa (Ej. PDF, zip).', 'cmb2' ),
    'description' => __( 'Es necesario incluir el texto del link para cada idioma', 'cmb2' ),
    'options'     => array(
      'group_title'   => __( 'Archivo {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'    => __( 'Añadir Archivo', 'cmb2' ),
      'remove_button' => __( 'Quitar Archivo', 'cmb2' ),
      'sortable'      => true, // beta
      // 'closed'     => true, // true to have the groups closed by default
    ),
  ) );
   */

  $program_meta->add_field( array(
    'name' => __( 'Archivo (prensa)', 'cmb2' ),
    'id'   => $prefix . 'program_file',
    'type' => 'file',
  ) );

  // *** HOME
  $home_meta = new_cmb2_box( array(
  	'id'            => $prefix . 'home_metabox',
  	'title'         => __( 'Contenido del Home', 'cmb2' ),
  	'object_types'  => array( 'page', ), // Post type
    'show_on_cb' => 'metabox_for_home_style_content',
  ) );

  $home_content = $home_meta->add_field( array(
    'id' => $prefix . 'home_content',
    'type' => 'group',
    'options'     => array(
      'group_title'   => __( 'Entrada {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
      'add_button'    => __( 'Agregar otra entrada', 'cmb2' ),
      'remove_button' => __( 'Eliminar entrada', 'cmb2' ),
      'sortable'      => true, // beta
    ),
  ) );

  $home_meta->add_group_field( $home_content, array(
    'name' => 'Imagen',
    'desc' => __( 'Opcional, pero es requerida si el Link es a una Entrada', 'cmb2' ),
    'id'   => 'image',
    'type' => 'file',
  ) );

  $home_meta->add_group_field( $home_content, array(
    'name' => 'Título',
    'desc' => __( 'Aparece en itálicas en hover', 'cmb2' ),
    'id'   => 'title',
    'type' => 'text',
  ) );

  $home_meta->add_group_field( $home_content, array(
    'name' => 'Sub-tíitulo',
    'desc' => __( 'Aparece despues del título en hover', 'cmb2' ),
    'id'   => 'caption',
    'type' => 'text',
  ) );

  $home_meta->add_group_field( $home_content, array(
    'name' => 'Link',
    'desc' => __( 'Requerido', 'cmb2' ),
    'id'   => 'link',
    'type' => 'post_search_text',
    'post_type' => array('post', 'programacion'),
    'select_type' => 'radio',
    'select_behavior' => 'replace',
  ) );
}

function metabox_for_home_style_content($cmb) {
  $home = get_page_by_path('home');
  $citas = get_page_by_path('citas');

  if ($home->ID == $cmb->object_id || $citas->ID == $cmb->object_id) {
    return true;
  } else {
    return false;
  }
}
?>
