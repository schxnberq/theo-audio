<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  2.0.5
 * @access public
 */
final class coup_Customizer_Upsell {
	/**
	 * Returns the instance.
	 *
	 * @since  2.0.5
	 * @access public
	 * @return object
	 */
	public static function get_instance() {
		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}
		return $instance;
	}
	/**
	 * Constructor method.
	 *
	 * @since  2.0.5
	 * @access private
	 * @return void
	 */
	private function __construct() {}
	/**
	 * Sets up initial actions.
	 *
	 * @since  2.0.5
	 * @access private
	 * @return void
	 */
	private function setup_actions() {
		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );
		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}
	/**
	 * Sets up the customizer sections.
	 *
	 * @since  2.0.5
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		get_template_part( 'inc/customizer-info/class/class-coup-customize-upsell-pro' );
		get_template_part( 'inc/customizer-info/class/class-coup-customize-upsell-features' );

		$manager->register_section_type( 'coup_Customizer_Upsell_Pro' );
		$manager->register_section_type( 'coup_Customizer_Upsell_Features' );

		$manager->add_section( new coup_Customizer_Upsell_Pro( $manager, 'coup-upsell-pro',
				array(
					'upsell_title' => __('See the full Coup features', 'coup'),
					'label_url' => 'https://themeskingdom.com/wordpress-themes/coup-architects-blog-portfolio-theme/',
					'label_text' => __('Get it', 'coup'),
				)
			)
		);

		$manager->add_section( new coup_Customizer_Upsell_Features( $manager, 'coup-upsell-features-1',
				array(
					'upsell_text'               => sprintf( '<a href="'.esc_url( 'https://themeskingdom.com/wordpress-themes/coup-architects-blog-portfolio-theme/' ).'" target="_blank">%s</a>' , __( 'See the full Coup features','coup' ) ),
					'panel'                     => 'panel_big_title',
					'priority'                  => 500,
				)
			)
		);

		$manager->add_section( new coup_Customizer_Upsell_Features( $manager, 'coup-upsell-features-2',
				array(
					'upsell_text'               => sprintf( '<a href="'.esc_url( 'https://themeskingdom.com/wordpress-themes/coupshop-woocommerce-wordpress-theme/' ).'" target="_blank">%s</a>' , __( 'See the full Coup features','coup' ) ),
					'panel'                     => 'panel_general',
					'priority'                  => 500,
				)
			)
		);
	}
	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  2.0.5
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		wp_enqueue_script( 'coup-upsell-js', trailingslashit( get_template_directory_uri() ) . 'inc/customizer-info/js/customizer-info-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'coup-upsell-style', trailingslashit( get_template_directory_uri() ) . 'inc/customizer-info/css/customizer-info.css' );
	}
}
coup_Customizer_Upsell::get_instance();
