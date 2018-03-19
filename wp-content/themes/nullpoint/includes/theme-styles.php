<?php
/*********NullPoint Styles**************/
function nullpoint_about_theme_style($hook) {
	global $nullpoint_about_theme_page;
	if( $hook != $nullpoint_about_theme_page ) { 
		return;
	}
	wp_enqueue_style('nullpoint-about-theme-style-css', get_template_directory_uri().'/admin/css/about-theme.css');
}
add_action( 'admin_enqueue_scripts', 'nullpoint_about_theme_style' );

function nullpoint_custom_admin_style($hook) {
	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) { 
		return;
	}
	wp_enqueue_style('nullpoint-unyson-admin-css', get_template_directory_uri().'/admin/css/edit.css');
}
add_action( 'admin_enqueue_scripts', 'nullpoint_custom_admin_style' );

function nullpoint_styles() {
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', '', '', 'screen, all');
	wp_enqueue_style('flexslider', get_template_directory_uri().'/css/flexslider.css', '', '', 'screen, all');
	wp_enqueue_style('owl-carousel', get_template_directory_uri().'/css/owl-carousel.css', '', '', 'screen, all');
	wp_enqueue_style('prettyphoto-css', get_template_directory_uri().'/css/prettyPhoto.css', '', '', 'screen, all');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' , array(), '4.4.0', 'all' );
			
	wp_enqueue_style('nullpoint-main-css', get_bloginfo( 'stylesheet_url' ), '', '', 'all');
	
	wp_enqueue_style('nullpoint-google-fonts', '//fonts.googleapis.com/css?family=PT+Sans:regular|Montserrat:700|Oswald:regular,300,500|Playfair+Display');									
}
add_action('wp_enqueue_scripts', 'nullpoint_styles');
