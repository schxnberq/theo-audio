<?php
/**
 * Singleton class file.
 *
 * @package Coup Lite
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class coup_Customizer_Upsell {

    /**
     * Returns the instance.
     *
     * @since  1.0.0
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
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function __construct() {}

    /**
     * Sets up initial actions.
     *
     * @since  1.0.0
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
     * @since  1.0.0
     * @access public
     * @param  object $manager Customizer manager.
     * @return void
     */
    public function sections( $manager ) {

        // Load custom sections.
        get_template_part( 'inc/class/class-customizer-theme-info-control/class-coup-customize-theme-info-main' );
        get_template_part( 'inc/class/class-customizer-theme-info-control/class-coup-customize-upsell-section' );

        // Register custom section types.
        $manager->register_section_type( 'coup_Customizer_Theme_Info_Main' );

        // Main Documentation Link In Customizer Root.
        $manager->add_section( new coup_Customizer_Theme_Info_Main( $manager, 'coup-theme-info', array(
            'theme_info_title' => __( 'Coup Lite', 'coup' ),
            'label_url'        => esc_url( 'https://themeskingdom.com/wordpress-themes/coup-architects-blog-portfolio-theme/' ),
            'label_text'       => __( 'Documentation', 'coup' ),
        ) ) );

        // Frontpage Sections Upsell.
        $manager->add_section( new coup_Customizer_Upsell_Section( $manager, 'coup-upsell-frontpage-sections', array(
            'panel'       => 'coup_frontpage_sections_panel',
            'priority'    => 500,
            'options'     => array(
                esc_html__( 'Portfolio', 'coup' ),
                esc_html__( 'Packages section', 'coup' ),
                esc_html__( 'Subscribe section', 'coup' ),
                esc_html__( 'Ribbon Section', 'coup' ),
                esc_html__( 'Google map section', 'coup' )
            ),
            'button_url'  => esc_url( 'https://themeskingdom.com/wordpress-themes/coup-architects-blog-portfolio-theme/' ),
            'button_text' => esc_html__( 'See the full Coup features', 'coup' ),
        ) ) );
    }

    /**
     * Loads theme customizer CSS.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue_control_scripts() {

        wp_enqueue_script( 'coup-upsell-js', trailingslashit( get_template_directory_uri() ) . 'inc/class/class-customizer-theme-info-control/js/coup-upsell-customize-controls.js', array( 'customize-controls' ) );

        wp_enqueue_style( 'coup-theme-info-style', trailingslashit( get_template_directory_uri() ) . 'inc/class/class-customizer-theme-info-control/css/style.css' );

    }
}

coup_Customizer_Upsell::get_instance();
