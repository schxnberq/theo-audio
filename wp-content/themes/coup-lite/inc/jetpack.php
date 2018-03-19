<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package coup
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function coup_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'wrapper'        => false,
		'container'      => 'post-load',
		'render'         => 'coup_infinite_scroll_render',
		'footer_widgets' => array('sidebar-2','sidebar-3'),
		'footer'         => 'page',
		'type'           => 'scroll'
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add Featured Content Support
	add_theme_support( 'featured-content', array(
		'filter'    => 'coup_get_featured_posts',
		'max_posts' => 8,
	) );

	// Add support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'blog-display' => 'excerpt',
		'post-details' => array(
			'stylesheet' => 'coup-style',
			'date'       => '.entry-date',
			'categories' => '.cat-links',
			'tags'       => '.tags-links'
		),
	) );
}
add_action( 'after_setup_theme', 'coup_jetpack_setup' );

/**
 * Change compression quality in Photon
 */

function coup_custom_photon_compression( $args ) {
    $args['quality'] = 95;
    return $args;
}
add_filter('jetpack_photon_pre_args', 'coup_custom_photon_compression' );

/**
 * Custom render function for Infinite Scroll.
 */
function coup_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) {
		    get_template_part( 'template-parts/content', 'search' );
		} else {
		    get_template_part( 'template-parts/content', get_post_format() );
		}
	}
}

/**
 * Filter Jetpack's Related Post thumbnail size.
 *
 * @param  $size (array) - Current width and height of thumbnail.
 * @return $size (array) - New width and height of thumbnail.
*/
function coup_jetpack_relatedposts_filter_thumbnail_size( $size ) {
	$size = array(
		'width'  => 235,
		'height' => 9999
	);
	return $size;
}
add_filter( 'jetpack_relatedposts_filter_thumbnail_size', 'coup_jetpack_relatedposts_filter_thumbnail_size' );

/**
 * Change width of gallery widget
 */
function coup_custom_gallery_content_width(){
    return 360;
}
add_filter( 'gallery_widget_content_width', 'coup_custom_gallery_content_width' );


/**
 * Change infinite scroll button text
 *
 * see: https://gist.github.com/kopepasah/9481454
 */
function coup_filter_jetpack_infinite_scroll_js_settings( $settings ) {
	$settings['text'] = __( 'Load More', 'coup' );
	return $settings;
}
add_filter( 'infinite_scroll_js_settings', 'coup_filter_jetpack_infinite_scroll_js_settings' );

/**
 * Featured posts filter function
 */
function coup_get_featured_posts() {
    return apply_filters( 'coup_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 */
function coup_has_featured_posts() {
	return ( bool ) coup_get_featured_posts();
}

/**
 * Remove jetpack related posts from its place
 * it is placed inside template-parts/content-single.php via d-_shortcode
 *
 * @link https://jetpack.com/support/related-posts/customize-related-posts/#delete
 */
function coup_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'coup_remove_rp', 20 );


