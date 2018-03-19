<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package coup
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function coup_body_classes( $classes ) {

	// Get blog layout setting
	if ( ( is_archive() && !is_tax( 'jetpack-portfolio-type' ) && !is_post_type_archive( 'portfolio' ) ) || is_home() ) {
	    $classes[] = 'standard-layout';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class if main sidebar is active
	if ( is_active_sidebar('sidebar-1') ) {
		$classes[] = 'has-sidebar';
	}

	// Adds a class for choosen slider
	if ( is_home() && !is_paged() && coup_has_featured_posts() ) {
		$classes[] = 'regular-slider';
	}

	return $classes;
}
add_filter( 'body_class', 'coup_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function coup_post_classes( $classes ) {

    if ( !has_post_thumbnail() ) {
        $classes[] = 'no-featured-content';
    }

    return $classes;
}
add_filter( 'post_class', 'coup_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function coup_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'coup_pingback_header' );

/**
 * Check for embed content in post and extract
 *
 * @since coup 1.0
 */
function coup_get_embeded_media() {
	$content   = get_the_content();
	$embeds    = get_media_embedded_in_content( $content );
	$video_url = wp_extract_urls( $content );

	if ( !empty( $embeds ) ) {

		// Check what is the first embed containg video tag, youtube or vimeo
		foreach( $embeds as $embed ) {
			if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) ) {

				$id   = 'coup' . rand();
				$href = "#TB_inline?height=640&width=1000&inlineId=" . $id;

				if ( !is_single() && has_post_thumbnail() ) {

					$video_url = '<div id="' . $id . '" style="display:none;">' . $embed . '</div>';
					$video_url .= '<div class="featured-content featured-image"><a class="thickbox" title="' . the_title_attribute() . '" href="' . $href . '">' . get_the_post_thumbnail() . '</a></div>';

					return $video_url;

				} else {

					return $embed;

				}

			}
		}

	} else {

		if ( $video_url ) {

			if ( strpos( $video_url[0], 'youtube' ) || strpos( $video_url[0], 'vimeo' ) ) {

				$id   = 'coup' . rand();
				$href = "#TB_inline?height=640&width=1000&inlineId=" . $id;

				if ( !is_single() && has_post_thumbnail() ) {

					$video_url = '<div id="' . $id . '" style="display:none;">' . wp_oembed_get( $video_url[0] ) . '</div>';
					$video_url .= '<div class="featured-content featured-image"><a class="thickbox" title="' . the_title_attribute() . '" href="' . $href . '">' . get_the_post_thumbnail() . '</a></div>';

					return $video_url;

				} else {

					return wp_oembed_get( $video_url[0] );

				}

			}

		} else {
			// No video embedded found
			return $content;
		}
	}
}


/**
 * Filter content for gallery post format
 *
 * @since  coup 1.0
 */
function coup_filter_post_content( $content ) {

    if ( 'video' == get_post_format() && 'post' == get_post_type() ) {
        $video_content = get_media_embedded_in_content( $content );
        $video_url     = wp_extract_urls( $content );

        if ( $video_content ) {
            $content = str_replace( $video_content, '', $content );
        }

        if ( $video_url ) {
            if ( strpos( $video_url[0], 'youtube' ) || strpos( $video_url[0], 'vimeo' ) ) {
                $content = str_replace( $video_url[0], '', $content );
            }
        }

    }

    if ( 'gallery' == get_post_format() && 'post' == get_post_type() ) {
        $regex   = '/\[gallery.*]/';
        $content = preg_replace( $regex, '', $content, 1 );
    }

    return $content;
}
add_filter( 'the_content', 'coup_filter_post_content' );

/**
 * Get Thumbnail Image Size Class
 *
 * @since coup 1.0
 */
function coup_get_featured_image_class() {

    $thumb_class            = '';
    $url                    = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

    if ( $url != false ) {

	    list( $width, $height ) = getimagesize( $url );

	    if ( $width > $height || $width == $height ) {
	        $thumb_class = 'horizontal-img';
	    } else {
	        $thumb_class = 'vertical-img';
	    }
	}

    return $thumb_class;

}

/**
 * Change tag cloud font size
 *
 * @since  coup 1.0
 */
function coup_widget_tag_cloud_args( $args ) {
    $args['largest']  = 14;
    $args['smallest'] = 14;
    $args['unit']     = 'px';
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'coup_widget_tag_cloud_args' );

/**
 * Remove parenthesses from excerpt
 *
 * @since coup 1.0
 */
function coup_excerpt_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'coup_excerpt_more' );

/**
 * Parenthesses remove
 *
 * Removes parenthesses from category and archives widget
 *
 * @since coup 1.0
 */
function coup_categories_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
add_filter( 'wp_list_categories','coup_categories_postcount_filter' );

function coup_archives_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', '</span>', $variable );
	return $variable;
}
add_filter( 'get_archives_link','coup_archives_postcount_filter' );


/**
* A title for the search.php template that displays the total number of search results and search terms
*
* @return  String [Search results count]
*/
function coup_search_results_count() {
	if( is_search() ) {

		global $wp_query;

		$result_count = esc_html__( 'Results', 'coup' );
		$result_count .= ' ';

		$result_count .= $wp_query->found_posts;

		print_r($result_count);

	}
}
