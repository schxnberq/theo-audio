<?php
/**
 * Implementation Customize Google Fonts
 * @package Teletype
 */
function teletype_google_fonts() {
	if ( get_theme_mod( 'fonts-default', 1 ) ) {
		wp_enqueue_style( 'teletype-fonts', teletype_fonts_url(), array(), null );
	} else {
		// Font options
		$fonts = array(
			get_theme_mod( 'primary-font', customizer_library_get_default( 'primary-font' ) ),
			get_theme_mod( 'secondary-font', customizer_library_get_default( 'secondary-font' ) )
		);

		$font_uri = customizer_library_get_google_font_uri( $fonts );
		wp_enqueue_style( 'teletype-customize-fonts', $font_uri, array(), null, 'screen' );
	}
}
add_action( 'wp_enqueue_scripts', 'teletype_google_fonts' );