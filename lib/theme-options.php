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

		$options_metabox = new_cmb2_box( array(
			'id'      => $this->metabox_id,
			'hookup'  => false,
			'show_on' => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		// Set our CMB2 fields

		// FOOTER

		$options_metabox->add_field( array(
			'name' => __( 'Footer', 'cmb2' ),
			'desc' => __( '', 'cmb2' ),
			'id'   => $this->prefix . 'footer_title',
			'type' => 'title',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Descripcíon basico', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_text',
			'type' => 'text',
			'default' => 'Estancia Femsa es una plataforma cultural y artística auspiciada por Casa Luis Barragán con el apoyo de Colección FEMSA.',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Descripcíon basico [EN]', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_text_en',
			'type' => 'text',
			'default' => 'Estancia Femsa is a platform.',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Dirección', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_address',
			'type' => 'textarea_small',
			'default' => 'Oficina Estancia FEMSA
General Francisco Ramírez 17
Ampliación Daniel Garza
11840, Ciudad de México',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Numero telephono', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_phone',
			'type' => 'text',
			'default' => '+52 (55) 2614 8427',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Email', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_email',
			'type' => 'text',
			'default' => 'info@estanciafemsa.mx',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Logos', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'footer_logos',
			'type' => 'wysiwyg',
		) );

		// SOCIAL

		$options_metabox->add_field( array(
			'name' => __( 'Redes Sociales', 'cmb2' ),
			'desc' => __( '', 'cmb2' ),
			'id'   => $this->prefix . 'social_title',
			'type' => 'title',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Facebook', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'social_facebook',
			'type' => 'text',
			'default' => 'https://www.facebook.com/EstanciaFEMSA/',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Twitter', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'social_twitter',
			'type' => 'text',
			'default' => 'https://twitter.com/estanciafemsa',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Instagram', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'social_instagram',
			'type' => 'text',
			'default' => 'https://www.instagram.com/estanciafemsa/',
		) );

		// VISITS

		$options_metabox->add_field( array(
			'name' => __( 'Citas', 'cmb2' ),
			'desc' => __( '', 'cmb2' ),
			'id'   => $this->prefix . 'visits_title',
			'type' => 'title',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Previa Cita', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'visits_text',
			'type' => 'textarea_small',
			'default' => 'Para visitar Estancia FEMSA es necesario agendar una cita a través de:

+52 (55) 5515 4908
+52 (55) 5272 4945
o por internet.',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Previa Cita [EN]', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'visits_text_en',
			'type' => 'textarea_small',
			'default' => 'To visit Estancia FEMSA is is...:

+52 (55) 5515 4908
+52 (55) 5272 4945
o por internet.',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Instrucciones', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'visits_guide',
			'type' => 'textarea_small',
			'default' => 'Se solicita llegar 15 minutos antes del horario asignado ya que no habrá tolerancia.',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Instrucciones [EN]', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'visits_guide_en',
			'type' => 'textarea_small',
			'default' => 'Dont turn up late',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Costo general', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'visits_cost_general',
			'type' => 'text',
			'default' => '200',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Costo especial', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'visits_cost_special',
			'type' => 'text',
			'default' => '100',
		) );


		// ABOUT

		$options_metabox->add_field( array(
			'name' => __( 'Sobre Nosotros', 'cmb2' ),
			'desc' => __( '', 'cmb2' ),
			'id'   => $this->prefix . 'about_title',
			'type' => 'title',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Sobre Estancia Femsa', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'about_text',
			'type' => 'wysiwyg',
			'options' => array(
				'textarea_rows' => 5,
				'media_buttons' => false,
			),
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Contacto', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'about_contact',
			'type' => 'textarea_small',
			'default' => 'Oficinas Estancia FEMSA:
Pendiente
General Francisco Ramírez 12-14
Miguel Hidalgo,
CP 11840, Ciudad de México, D.F.',
		) );

		$options_metabox->add_field( array(
			'name' => __( 'Directorio', 'IGV' ),
			'desc' => __( '', 'IGV' ),
			'id'   => $this->prefix . 'about_directory',
			'type' => 'wysiwyg',
			'options' => array(
				'textarea_rows' => 12,
				'media_buttons' => false,
			),
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