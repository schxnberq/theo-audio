<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Teletype
 */

get_header(); ?>

<?php get_template_part( 'template-parts/headline' ); ?>

<div id="primary" class="content-area container">
	<main id="main" class="site-main" role="main">

	<!-- Blog Section -->
      	<section id="blog" class="text-left">

            		<div class="section-title center wow fadeIn">
			<h1><?php printf( esc_html__( 'Search Results for: %s', 'teletype' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            		</div>

            		<div class="space"></div>

<?php
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'search' );

		endwhile;

			teletype_pagination();

	else :
			get_template_part( 'template-parts/content', 'none' );

	endif; ?>

	</section><!-- #blog -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();