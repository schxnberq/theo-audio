<?php
/*********NullPoint Scripts**************/
function nullpoint_script() {
	
	wp_enqueue_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), '2.1', true);
	wp_enqueue_script('jquery-directionalhover', get_template_directory_uri().'/js/jquery.directionalhover.js', array('jquery'), '2.1', true);
	wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array(), '1.0', true);
	wp_enqueue_script('nullpoint-pro-custom', get_template_directory_uri().'/js/custom.js', array('jquery'), '1.0', true);
	wp_enqueue_script('owl-carousel-js', get_template_directory_uri().'/js/owl.carousel.min.js', true, '1.0', true);
	wp_enqueue_script('jquery-prettyphoto', get_template_directory_uri().'/js/jquery.prettyPhoto-min.js', array('jquery'), '3.1.6', true);
	wp_enqueue_script( 'parallax', get_template_directory_uri(). '/js/parallax.js', true, '1.4.2', true );
	
	if ( is_singular() && pings_open() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
		
}
add_action('wp_enqueue_scripts', 'nullpoint_script');