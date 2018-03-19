<?php
/**
 * Loads the child theme textdomain.
 */
function onepagex_child_theme_setup() {
    load_child_theme_textdomain('onepagex');
}
add_action( 'after_setup_theme', 'onepagex_child_theme_setup' );

function onepagex_child_enqueue_styles() {
    $parent_style = 'onepagex-parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	 wp_enqueue_style( 'onepagex-style',get_stylesheet_directory_uri() . '/onepagex.css');
}
add_action( 'wp_enqueue_scripts', 'onepagex_child_enqueue_styles',99);
?>