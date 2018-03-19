<?php
/**
 * coup Theme Customizer.
 *
 * @package coup
 */

// Load Customizer specific functions
require get_template_directory() . '/inc/customizer/functions/customizer-sanitization.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function coup_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/functions/customizer-functions.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Upsells
	 */

	if ( ! class_exists( 'coup_Control_Upsell_Theme_Info' ) ) :
		/**
		 * coup_Control_Upsell_Theme_Info class.
		 */
		class coup_Control_Upsell_Theme_Info extends WP_Customize_Control {

		/**
		 * Control type
		 *
		 * @var string control type
		 */
		public $type = 'coup-lite-control-upsell';

		/**
		 * Button text
		 *
		 * @var string button text
		 */
		public $button_text = '';

		/**
		 * Button link
		 *
		 * @var string button url
		 */
		public $button_url = '#';

		/**
		 * List of features
		 *
		 * @var array theme features / options
		 */
		public $options = array();

		/**
		 * List of explanations
		 *
		 * @var array additional info
		 */
		public $explained_features = array();

		/**
		 * coup_Control_Upsell_Theme_Info constructor.
		 *
		 * @param WP_Customize_Manager $manager the customize manager class.
		 * @param string               $id id.
		 * @param array                $args customizer manager parameters.
		 */
		public function __construct( WP_Customize_Manager $manager, $id, array $args ) {
			$this->button_text;
			$manager->register_control_type( 'coup_Control_Upsell_Theme_Info' );
			parent::__construct( $manager, $id, $args );

		}
		/**
		 * Enqueue resources for the control
		 */
		public function enqueue() {
			wp_enqueue_style( 'coup-lite-upsell-style', get_template_directory_uri() . '/inc/class/class-customizer-theme-info-control/css/style.css', '1.0.0' );
		}

		/**
		 * Json conversion
		 */
		public function to_json() {
			parent::to_json();
			$this->json['button_text']  = $this->button_text;
			$this->json['button_url']   = $this->button_url;
			$this->json['options']      = $this->options;
			$this->json['explained_features'] = $this->explained_features;
		}

		/**
		 * Control content
		 */
		public function content_template() { ?>
			<div class="coup-lite-upsell">
				<#  if ( data.options ) { #>
				<ul class="coup-lite-upsell-features">
					<# for (option in data.options) { #>
						<li><span class="upsell-pro-label"></span>{{ data.options[option] }}
						</li>
						<# } #>
				</ul>
				<# } #>

				<# if ( data.button_text && data.button_url ) { #>
				<a target="_blank" href="{{ data.button_url }}" class="button button-primary" target="_blank">{{
					data.button_text }}</a>
				<# } #>

				<# if ( data.explained_features.length > 0 ) { #>
				<hr />

				<ul class="coup-lite-upsell-feature-list">
					<# for (requirement in data.explained_features) { #>
						<li>* {{{ data.explained_features[requirement] }}}</li>
						<# } #>
				</ul>
				<# } #>
			</div>
		<?php }
		}
	endif;


	$wp_customize->add_section( 'coup_theme_info_main_section', array(
		'title'    => __( 'See the full Coup features', 'coup' ),
		'priority' => 1,
	) );
	$wp_customize->add_setting( 'coup_theme_info_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );
	$wp_customize->add_setting( 'coup_theme_info_main_control_2', array(
		'sanitize_callback' => 'esc_html',
	) );

	/*
	 * View Pro Version Section Control
	 */
	$wp_customize->add_control( new coup_Control_Upsell_Theme_Info( $wp_customize, 'coup_theme_info_main_control', array(
		'section'     => 'coup_theme_info_main_section',
		'priority'    => 100,
		'options'     => array(
			esc_html__( 'Shuffle Layout', 'coup' ),
			esc_html__( 'Change Colors', 'coup' ),
			esc_html__( 'Change Fonts', 'coup' ),
			esc_html__( 'Built-in Portfolio', 'coup' ),
			esc_html__( 'Support', 'coup' ),
			esc_html__( 'Change Credit Footer Link', 'coup' ),
			esc_html__( 'Fullwidth Video Header', 'coup' ),
			esc_html__( 'Fullwidth Slider', 'coup' ),
		),
		'button_url'  => esc_url( 'https://themeskingdom.com/wordpress-themes/coup-architects-blog-portfolio-theme/' ),
		'button_text' => esc_html__( 'See Coup', 'coup' ),
	) ) );

	$wp_customize->add_control( new coup_Control_Upsell_Theme_Info( $wp_customize, 'coup_theme_info_main_control_2', array(
		'section'     => 'coup_theme_info_main_section',
		'priority'    => 101,
		'options'     => array(
			esc_html__( 'Shuffle Layout', 'coup' ),
			esc_html__( 'Change Colors', 'coup' ),
			esc_html__( 'Change Fonts', 'coup' ),
			esc_html__( 'Built-in Portfolio', 'coup' ),
			esc_html__( 'Support', 'coup' ),
			esc_html__( 'Change Credit Footer Link', 'coup' ),
			esc_html__( 'Fullwidth Video Header', 'coup' ),
			esc_html__( 'Fullwidth Slider', 'coup' ),
			esc_html__( 'Customizable Slider', 'coup' ),
			esc_html__( 'Built-in Shop', 'coup' ),
			esc_html__( 'Multiple Shop Layouts', 'coup' ),
			esc_html__( 'Cart', 'coup' ),
		),
		'button_url'  => esc_url( 'https://themeskingdom.com/wordpress-themes/coupshop-woocommerce-wordpress-theme/' ),
		'button_text' => esc_html__( 'See Coup Shop', 'coup' ),
	) ) );

}
add_action( 'customize_register', 'coup_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function coup_customize_preview_js() {
	wp_enqueue_script( 'coup-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'coup_customize_preview_js' );
