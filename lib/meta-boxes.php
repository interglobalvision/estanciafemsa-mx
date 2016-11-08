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
    'name' => __( 'Autor', 'cmb2' ),
    'id'   => $prefix . 'post_author',
    'type' => 'text',
  ) );

  $post_meta->add_field( array(
    'name' => __( 'Fecha', 'cmb2' ),
    'desc' => __( 'de publicación. Requerido', 'cmb2' ),
    'id'   => $prefix . 'post_date',
    'type' => 'text_date_timestamp',
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

  $related_event_meta = new_cmb2_box( array(
    'id'            => $prefix . 'related_event_metabox',
    'title'         => __( 'Evento relacionado Metabox', 'cmb2' ),
    'object_types'  => array( 'post', 'actividad' ), // Post type
  ) );

  $related_event_meta->add_field( array(
    'name' => __( 'Evento relacionado', 'cmb2' ),
    'id'   => $prefix . 'related_event',
    'type' => 'post_search_text',
    'post_type' => array('programacion'),
    'select_type' => 'radio',
    'select_behavior' => 'replace',
  ) );

  $activity_meta = new_cmb2_box( array(
    'id'            => $prefix . 'activity_metabox',
    'title'         => __( 'Actividad Metabox', 'cmb2' ),
    'object_types'  => array( 'actividad', ), // Post type
  ) ); 

  $activity_meta->add_field( array(
    'name' => __( 'Fechas / horario', 'cmb2' ),
    'id'   => $prefix . 'activity_dates',
    'type' => 'textarea_small',
    'attributes' => array(
      'class' => 'cmb2-qtranslate'
    )
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
    'name' => __( 'Archive Title', 'cmb2' ),
    'id'   => $prefix . 'archive_title',
    'type' => 'textarea_small',
    'attributes' => array(
      'class' => 'cmb2-qtranslate'
    )
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
    'name' => __( 'Visitantes (archivo en español)', 'cmb2' ),
    'id'   => $prefix . 'program_visitors_file_es',
    'type' => 'file',
    'desc' => __( 'Max. 64mb', 'cmb2' ),
  ) );

  $program_meta->add_field( array(
    'name' => __( 'Visitantes (archivo en inglés)', 'cmb2' ),
    'id'   => $prefix . 'program_visitors_file_en',
    'type' => 'file',
    'desc' => __( 'Max. 64mb', 'cmb2' ),
  ) );

  $program_meta->add_field( array(
    'name'       => __( 'Visitantes (texto del link al archivo)', 'cmb2' ),
    'id'         => $prefix . 'program_visitors_file_text',
    'type'       => 'text',
    'attributes' => array(
      'class' => 'cmb2-qtranslate'
    )
  ) );

  $program_meta->add_field( array(
    'name' => __( 'Prensa (archivo en español)', 'cmb2' ),
    'id'   => $prefix . 'program_file_es',
    'type' => 'file',
    'desc' => __( 'Max. 64mb', 'cmb2' ),
  ) );


  $program_meta->add_field( array(
    'name' => __( 'Prensa (archivo en inglés)', 'cmb2' ),
    'id'   => $prefix . 'program_file_en',
    'type' => 'file',
    'desc' => __( 'Max. 64mb', 'cmb2' ),
  ) );

  // *** HOME
  $home_meta = new_cmb2_box( array(
  	'id'            => $prefix . 'home_metabox',
  	'title'         => __( 'Contenido del Home', 'cmb2' ),
  	'object_types'  => array( 'page', ), // Post type
    'show_on'       => array( 'key' => 'id', 'value' => array( get_id_by_slug('home') ) ),
  ) );

  $home_meta->add_field( array(
    'name' => 'Plus (+) link',
    'desc' => __( '', 'cmb2' ),
    'id'   => $prefix . 'plus_link_id',
    'type' => 'post_search_text',
    'post_type' => array('page', 'post', 'programacion'),
    'select_type' => 'radio',
    'select_behavior' => 'replace',
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
    'desc' => __( 'Opcional, pero es requerida si el Link es a una Entrada (Max. 64mb)', 'cmb2' ),
    'id'   => 'image',
    'type' => 'file',
  ) );

  $home_meta->add_group_field( $home_content, array(
    'name' => 'Texto',
    'desc' => __( '', 'cmb2' ),
    'id'   => 'caption',
    'type'    => 'wysiwyg',
    'options' => array( 
      'media_buttons' => false,
      'textarea_rows' => 2, 
      'editor_class' => 'cmb2-qtranslate'
    )
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

  // *** CITAS
  $citas_meta = new_cmb2_box( array(
    'id'            => $prefix . 'citas_metabox',
    'title'         => __( 'Imagenes', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'       => array( 'key' => 'id', 'value' => array( get_id_by_slug('citas') ) ),
  ) );

  $citas_meta->add_field( array(
    'name' => __( 'Previa Cita', 'IGV' ),
    'desc' => __( '', 'IGV' ),
    'id'   => $prefix . 'visits_text',
    'type' => 'textarea_small',
    'default' => 'Para visitar Estancia FEMSA es necesario agendar una cita a través de:

+52 (55) 5515 4908
+52 (55) 5272 4945',
    'attributes' => array(
      'class' => 'cmb2-qtranslate'
    ),
  ) );

  $citas_meta->add_field( array(
    'name' => 'URL externo para citas',
    'desc' => __( '', 'cmb2' ),
    'id'   => $prefix . 'visits_url',
    'type' => 'text',
  ) );

  $citas_meta->add_field( array(
    'name' => 'Texto para URL externo para citas',
    'desc' => __( '', 'cmb2' ),
    'id'   => $prefix . 'visits_url_text',
    'type' => 'text',
    'attributes' => array(
      'class' => 'cmb2-qtranslate'
    ),
  ) );

  $citas_meta->add_field( array(
    'name' => __( 'Previa Cita (2a Parte)', 'IGV' ),
    'desc' => __( '', 'IGV' ),
    'id'   => $prefix . 'visits_text_two',
    'type' => 'textarea_small',
    'default' => '',
    'attributes' => array(
      'class' => 'cmb2-qtranslate'
    ),
  ) );

  $citas_meta->add_field( array(
    'name' => __( 'Instrucciones', 'IGV' ),
    'desc' => __( '', 'IGV' ),
    'id'   => $prefix . 'visits_guide',
    'type' => 'textarea_small',
    'default' => 'Se solicita llegar 15 minutos antes del horario asignado ya que no habrá tolerancia.',
    'attributes' => array(
      'class' => 'cmb2-qtranslate'
    ),
  ) );

  $citas_meta->add_field( array(
    'name' => __( 'Costo', 'IGV' ),
    'desc' => __( '', 'IGV' ),
    'id'   => $prefix . 'visits_cost',
    'type' => 'textarea_small',
    'attributes' => array(
      'class' => 'cmb2-qtranslate'
    ),
  ) );

  $citas_content = $citas_meta->add_field( array(
    'id' => $prefix . 'citas_content',
    'type' => 'group',
    'options'     => array(
      'group_title'   => __( 'Imagen {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
      'add_button'    => __( 'Agregar otra imagen', 'cmb2' ),
      'remove_button' => __( 'Eliminar imagen', 'cmb2' ),
      'sortable'      => true, // beta
    ),
  ) );

  $citas_meta->add_group_field( $citas_content, array(
    'name' => 'Imagen',
    'desc' => __( 'Opcional, pero es requerida si el Link es a una Entrada (Max. 64mb)', 'cmb2' ),
    'id'   => 'image',
    'type' => 'file',
  ) );
  

}

?>
