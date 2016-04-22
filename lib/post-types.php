<?php

// Register Custom Post Type
function programacion_post_type() {

	$labels = array(
		'name'                  => _x( 'Programación', 'Post Type General Name', 'estanciafemsa_mx' ),
		'singular_name'         => _x( 'Programación', 'Post Type Singular Name', 'estanciafemsa_mx' ),
		'menu_name'             => __( 'Programación', 'estanciafemsa_mx' ),
		'name_admin_bar'        => __( 'Programación', 'estanciafemsa_mx' ),
		'archives'              => __( 'Archivo', 'estanciafemsa_mx' ),
		'parent_item_colon'     => __( 'Entrada Padre', 'estanciafemsa_mx' ),
		'all_items'             => __( 'Todas las Entradas', 'estanciafemsa_mx' ),
		'add_new_item'          => __( 'Agregar Nueva Entrada', 'estanciafemsa_mx' ),
		'add_new'               => __( 'Agregar Nueva', 'estanciafemsa_mx' ),
		'new_item'              => __( 'Nueva Entrada', 'estanciafemsa_mx' ),
		'edit_item'             => __( 'Editar Entrada', 'estanciafemsa_mx' ),
		'update_item'           => __( 'Actualizar Entrada', 'estanciafemsa_mx' ),
		'view_item'             => __( 'Ver Entradas', 'estanciafemsa_mx' ),
		'search_items'          => __( 'Buscar Entradas', 'estanciafemsa_mx' ),
		'not_found'             => __( 'No fue encontrada', 'estanciafemsa_mx' ),
		'not_found_in_trash'    => __( 'No fue encontrada en la Papeleras', 'estanciafemsa_mx' ),
		'featured_image'        => __( 'Featured Image', 'estanciafemsa_mx' ),
		'set_featured_image'    => __( 'Establecer featured image', 'estanciafemsa_mx' ),
		'remove_featured_image' => __( 'Eliminar featured image', 'estanciafemsa_mx' ),
		'use_featured_image'    => __( 'Usar como featured image', 'estanciafemsa_mx' ),
		'insert_into_item'      => __( 'Insertar en la Entrada', 'estanciafemsa_mx' ),
		'uploaded_to_this_item' => __( 'Cargar a la Entrada', 'estanciafemsa_mx' ),
		'items_list'            => __( 'Lista de Entradas', 'estanciafemsa_mx' ),
		'items_list_navigation' => __( 'Items list navigation', 'estanciafemsa_mx' ),
		'filter_items_list'     => __( 'Filter items list', 'estanciafemsa_mx' ),
	);
	$args = array(
		'label'                 => __( 'Programación', 'estanciafemsa_mx' ),
		'description'           => __( 'Programación', 'estanciafemsa_mx' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'programacion', $args );

}
add_action( 'init', 'programacion_post_type', 0 );
