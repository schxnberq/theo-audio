<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package coup
 */

if ( ! function_exists( 'coup_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function coup_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = sprintf(
		/* translators: author meta text */
		esc_html_x( 'By : %s', 'post author', 'coup' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline">' . $byline . '</span><span class="posted-on"> ' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'coup_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function coup_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() or 'jetpack-portfolio' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( ', ' );

		if ( $categories_list && coup_categorized_blog() ) {
			/* translators: category meta text */
			printf( '<span class="cat-links"><span class="meta-text">' . esc_html__( 'Posted in %1$s', 'coup' ) . '</span>', '</span>' . $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'coup' ) );


		if ($categories_list && $tags_list ) {
			/* translators: separator for category and tags meta */
			printf('<span class="cat-tags-connector meta-text">' . esc_html__(' and ','coup') . '</span>');
		}

		if ( $tags_list ) {
			/* translators: tags meta text */
			printf( '<span class="tags-links"><span class="meta-text">' . esc_html__( 'tagged %1$s', 'coup' ) . '</span>', '</span>' . $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'coup' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}



	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'coup' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Custom post navigation
 *
 * @since coup 1.0
 */
function coup_post_navigation() {
	$post_navigation      = '';
	$prev_post_navigation = '';
	$next_post_navigation = '';
	$previous_post        = get_previous_post();
	$next_post            = get_next_post();

	// Previous post
	if ( !empty( $previous_post ) ) {

		$prev_text 		= esc_html__( 'Previous Post', 'coup' );
		$prev_post_text = '<a href="' . esc_url( get_permalink( $previous_post->ID ) ) . '"><span class="prev-trig">' . $prev_text . '<i class="icon-left"></i></span>';

		$prev_post_navigation = '<div class="nav-previous">';
		$prev_post_navigation .= $prev_post_text;
		$prev_post_navigation .= '<div class="prev-title">';
			$prev_post_navigation .= '<span class="post-title">' . get_the_title( $previous_post->ID ) . '</span>';
		$prev_post_navigation .= '</div></a></div>';
	}

	// Next post
	if ( !empty( $next_post ) ) {

		$next_text 		= esc_html__( 'Next Post', 'coup' );
		$next_post_text = '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '"><span class="next-trig">' . $next_text . '<i class="icon-right"></i></span>';

		$next_post_navigation = '<div class="nav-next">';
		$next_post_navigation .= $next_post_text;
		$next_post_navigation .= '<div class="next-title">';
			$next_post_navigation .= '<span class="post-title">' . get_the_title( $next_post->ID ) . '</span>';
		$next_post_navigation .= '</div></a></div>';
	}

	// Post navigation
	$post_navigation = $next_post_navigation . $prev_post_navigation;

	print_r( _navigation_markup( $post_navigation ));
}



/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function coup_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'coup_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'coup_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so coup_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so coup_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in coup_categorized_blog.
 */
function coup_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'coup_categories' );
}
add_action( 'edit_category', 'coup_category_transient_flusher' );
add_action( 'save_post',     'coup_category_transient_flusher' );


/**
 * Generate and display Footer widgets
 *
 * @since coup 1.0
 */
function coup_footer_widgets() {

	$footer_sidebars = array(
		'sidebar-2',
		'sidebar-3'
	);

	foreach ( $footer_sidebars as $footer_sidebar ) {

		if ( is_active_sidebar( $footer_sidebar ) ) { ?>

			<div class="widget-area">
				<?php dynamic_sidebar( $footer_sidebar ); ?>
			</div>

		<?php

		}

	}

}

/**
 * Displays post featured image
 *
 * @since  coup 1.0
 */
function coup_featured_image() {

	if ( has_post_thumbnail() ) :

		if ( is_single() ) { ?>

			<div class="featured-content featured-image <?php echo esc_attr( coup_get_featured_image_class() ); ?>">
				<?php

				$url = wp_get_attachment_url( get_post_thumbnail_id( ) );
				$filetype = wp_check_filetype($url);
				if ($filetype['ext'] == 'gif') {
					$thumb_size = '';
				} else {
					$thumb_size = 'coup-single-post';
				}

				the_post_thumbnail( $thumb_size ); ?>
			</div>

		<?php } else { ?>

			<div class="featured-content featured-image <?php echo esc_attr( coup_get_featured_image_class() ); ?>">

				<?php

					$url = wp_get_attachment_url( get_post_thumbnail_id( ) );
					$filetype = wp_check_filetype($url);
					if ($filetype['ext'] == 'gif') {
						$thumb_size = '';
					} else {

						$blog_layout        = get_theme_mod( 'blog_layout_setting', 'standard-layout' );
						if ($blog_layout == 'standard-layout') {
							if (is_sticky()) {
								$thumb_size = 'coup-archive-sticky';
							} else {
								$thumb_size = 'coup-archive';
							}
						} else {
							if (is_sticky()) {
								$thumb_size = 'coup-shuffle-sticky';
							} else {
								$thumb_size = 'coup-shuffle';
							}
						}
					}
				?>

				<?php if ( 'image' == get_post_format() ) {

					$thumb_id        = get_post_thumbnail_id();
					$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'full', true );
					$thumb_url       = $thumb_url_array[0];

				?>
					<a href="<?php echo esc_url( $thumb_url ); ?>" title="<?php echo esc_attr( the_title_attribute() ); ?>" class="thickbox">
						<?php the_post_thumbnail($thumb_size); ?>
					</a>

				<?php } else { ?>

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumb_size); ?></a>

				<?php } ?>

				<?php if ('link' != get_post_format() && 'quote' != get_post_format() && 'jetpack-portfolio' != get_post_type() ) {
					echo '<a class="more-link" href="' . esc_url(get_permalink()) . '">' . esc_html__('Read More','coup') . '</a>';
				}
				?>

			</div>

		<?php }

	else :

		return;

	endif;
}

/**
 * Displays post featured image for hero positioned: slider or last post
 *
 * @since  coup 1.0
 */
function coup_hero_featured_image() {

	if ( has_post_thumbnail() ) :

		?>

		<div class="featured-content featured-image">

			<?php the_post_thumbnail(); ?>

		</div>

		<?php

	else :

		return;

	endif;

}

/**
 * Displays post featured image
 *
 * @since  coup 1.0
 */
function coup_featured_media() {

	if ( 'gallery' == get_post_format() ) :

		if ( get_post_gallery() && ! post_password_required() ) { ?>

			<div class="featured-content entry-gallery">
				<?php print_r(get_post_gallery()); ?>
				<?php if (!is_single() && !'link' == get_post_format() && !'quote' == get_post_format() && !'jetpack-portfolio' == get_post_type() ) {
					echo '<a class="more-link" href="' . esc_url(get_permalink()) . '">' . esc_html__('Read More','coup') . '</a>';
				} ?>
			</div><!-- .entry-gallery -->

		<?php } else {

			coup_featured_image();

		}

	elseif ( 'video' == get_post_format() ) :

		if ( coup_get_embeded_media() ) { ?>

			<div class="featured-content entry-video">
				<div class="video-sizer">
					<?php print_r(coup_get_embeded_media()); ?>
				</div>
				<?php if (!is_single() && !'link' == get_post_format() && !'quote' == get_post_format() && !'jetpack-portfolio' == get_post_type()) {
					echo '<a class="more-link" href="' . esc_url(get_permalink()) . '">' . esc_html__('Read More','coup') . '</a>';
				} ?>
			</div><!-- .entry-video -->

		<?php } else {

			coup_featured_image();

		}

	else :

		coup_featured_image();

	endif;

}


/**
 * Display the archive title based on the queried object.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function coup_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( '<span class="big-text">%s</span><span class="archive-name">%s</span>',
		                 esc_html__( 'Category', 'coup'),
		                 single_cat_title( '', false )
		         );
	} elseif ( is_tag() ) {
		$title = sprintf( '<span class="big-text">%s</span>%s',
		                 esc_html__( 'Tag' , 'coup'),
		                 single_tag_title( '', false )
		         );
	} elseif ( is_author() ) {
		$title = sprintf( '<span class="big-text">%s</span>%s',
		                 esc_html__( 'Author' , 'coup'),
		                 get_the_author()
		         );
	} elseif ( is_year() ) {
		$title = sprintf( '<span class="big-text">%s</span>%s',
		                 esc_html__( 'Year' , 'coup'),
		                 get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'coup' ) )  );
	} elseif ( is_month() ) {
		$title = sprintf( '<span class="big-text">%s</span>%s',
		                 esc_html__( 'Month' , 'coup'),
		                 get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'coup' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( '<span class="big-text">%s</span>%s',
		                 esc_html__( 'Day' , 'coup'),
		                 get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'coup' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = '<span class="big-text">' . esc_html_x( 'Asides', 'post format archive title', 'coup' ) . '</span>';
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = '<span class="big-text">' . esc_html_x( 'Galleries', 'post format archive title', 'coup' ) . '</span>';
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = '<span class="big-text">' . esc_html_x( 'Images', 'post format archive title', 'coup' ) . '</span>';
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = '<span class="big-text">' . esc_html_x( 'Videos', 'post format archive title', 'coup' ) . '</span>';
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = '<span class="big-text">' . esc_html_x( 'Quotes', 'post format archive title', 'coup' ) . '</span>';
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = '<span class="big-text">' . esc_html_x( 'Links', 'post format archive title', 'coup' ) . '</span>';
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = '<span class="big-text">' . esc_html_x( 'Statuses', 'post format archive title', 'coup' ) . '</span>';
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = '<span class="big-text">' . esc_html_x( 'Audio', 'post format archive title', 'coup' ) . '</span>';
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = '<span class="big-text">' . esc_html_x( 'Chats', 'post format archive title', 'coup' ) . '</span>';
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( '<span class="big-text">%s</span>',
		                  post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf('<span class="big-text">%1$s</span>%2$s',
		                 $tax->labels->singular_name,
		                 single_term_title( '', false )
		         );
	} else {
		$title = sprintf('<span class="big-text">%s</span>%s',
					esc_html__( 'Archives', 'coup' )
				 );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}

/**
 * coup custom paging function
 *
 * Creates and displays custom page numbering pagination in bottom of archives
 *
 * @since coup 1.0
 */
function coup_numbers_pagination() {

	global $wp_query, $wp_rewrite, $project_query;

	$paging_query = $wp_query;

	/** Stop execution if there's only 1 page */
	if( $paging_query->max_num_pages <= 1 )
		return;


	$paging_query->query_vars['paged'] > 1 ? $current = $paging_query->query_vars['paged'] : $current = 1;

	$pagination = array(
		'base'      => add_query_arg( 'paged', '%#%' ),
		'format'    => '',
		'total'     => $paging_query->max_num_pages,
		'current'   => $current,
		'end_size'           => 1,
		'mid_size'           => 2,
		'type'      => 'list',
		'prev_next' => false
	);

	if ( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if ( ! empty( $paging_query->query_vars['s'] ) ) {
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	}

	// add prev and next post links
	$prev_link_text = esc_html__('Prev','coup');
	$next_link_text = esc_html__('Next','coup');
	$prev_link = get_previous_posts_link( $prev_link_text );
	$next_link = get_next_posts_link( $next_link_text );

	if ( !$prev_link ) {
		$prev_link = '<span class="disabled">' . $prev_link_text . '</span>';
	}

	if ( !$next_link ) {
		$next_link = '<span class="disabled">' . $next_link_text . '</span>';
	}

	// Display pagination
	printf( '<nav class="navigation paging-navigation"><h4 class="screen-reader-text">%1$s</h4>%2$s %3$s %4$s</nav>',
		esc_html__( 'Page navigation', 'coup' ),
		wp_kses_post($prev_link),
		wp_kses_post(paginate_links($pagination)),
		wp_kses_post($next_link)
	);

}


/**
 * List all categories
 *
 * @since coup 1.0
 */
function coup_categories_filter( $type ) {

	if ($type == 'index') {

		$categories_list = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );

		if ( ! empty( $categories_list ) && ! is_wp_error( $categories_list ) ) {

			$categories_list_display = '<ul class="category-filter">';

			if (! is_archive()) {

				$count_all_posts = wp_count_posts('post','readable');
				$categories_list_display .= '<li class="cat-active"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'All Stories', 'coup' ) . '<span>' . $count_all_posts->publish . '</span></a></li>';

				foreach( $categories_list as $category ) {
					$count = $category->category_count;
					$category_link = get_category_link( $category );
					$categories_list_display .= '<li><a href="' . esc_url( $category_link ) . '">' . esc_attr($category->name) . '<span>' . esc_attr($count) . '</span></a></li>';

				}

			} else {
				if ( isset( get_queried_object()->term_id ) ) {
					$category_id = get_queried_object()->term_id;
				} else {
					$category_id = 0;
				}

				$count_all_posts = wp_count_posts('post','readable');
				$categories_list_display .= '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'All Stories', 'coup' ) . '<span>' . esc_attr($count_all_posts->publish) . '</span></a></li>';

				foreach( $categories_list as $category ) {
					if ( $category->term_id == $category_id ) {
						$active_class = 'cat-active';
					} else {
						$active_class = '';
					}

					$count = $category->category_count;
					$category_link = get_category_link( $category );
					$categories_list_display .= '<li class="' . $active_class . '"><a href="' . esc_url( $category_link ) . '">' . esc_attr($category->name) . '<span>' . esc_attr($count) . '</span></a></li>';

				}
			}

			$categories_list_display .= '</ul>';

			print_r($categories_list_display);
		}
	}
}

/**
 * Insert sharedaddy
 *
 * @since coup 1.0
 */
function coup_insert_sharedaddy() {

	// Disabled for this post?

	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'sharedaddy' ) ) {

		$share_content = sharing_display( '', false );

		if ( function_exists( 'sharing_display' ) && !empty($share_content) ) {
			echo '<div class="sharedaddy-holder"><i class="icon-share"></i>';
		    print_r($share_content);
			echo '</div>';
		}
	};
}
