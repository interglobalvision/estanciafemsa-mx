<?php

/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class IGV_Admin {

	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'IGV_options';

	/**
 	 * Option prefix
 	 * @var string
 	 */
	private $prefix = '_igv_';

	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'IGV_option_metabox';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = 'Site Options';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		// Set our title
		$this->title = __( 'Site Options', 'IGV' );
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_init', array( $this, 'add_options_page_metabox' ) );
	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		$footer = new_cmb2_box( array(
			'id'      => $this->metabox_id,
			'hookup'  => false,
			'show_on' => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		// Set our CMB2 fields

		$footer->add_field( array(
			'name' => __( 'Footer', 'cmb2' ),
			'desc' => __( '', 'cmb2' ),
			'id'   => $prefix . 'title',
			'type' => 'title',
		) );

		$footer->add_field( array(
			'name' => __( 'Descripcíon basico', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_text',
			'type' => 'text',
			'default' => 'Estancia Femsa es una plataforma cultural y artística auspiciada por Casa Luis Barragán con el apoyo de Colección FEMSA.',
		) );

		$footer->add_field( array(
			'name' => __( 'Dirección', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_address',
			'type' => 'textarea_small',
			'default' => 'Oficina Estancia FEMSA
General Francisco Ramírez 17 
Ampliación Daniel Garza 
11840, Ciudad de México',
		) );

		$footer->add_field( array(
			'name' => __( 'Numero telephono', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_phone',
			'type' => 'text',
			'default' => '+52 (55) 2614 8427',
		) );

		$footer->add_field( array(
			'name' => __( 'Email', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_email',
			'type' => 'text',
			'default' => 'info@estanciafemsa.mx',
		) );


	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the IGV_Admin object
 * @since  0.1.0
 * @return IGV_Admin object
 */
function IGV_admin() {
	static $object = null;
	if ( is_null( $object ) ) {
		$object = new IGV_Admin();
		$object->hooks();
	}

	return $object;
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function IGV_get_option( $key = '' ) {
	return cmb2_get_option( IGV_admin()->key, $key );
}

// Get it started
IGV_admin();