<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package coup
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container container-medium" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<aside class="side-nav">
		<!-- Search form -->
		<div class="search-wrap">
			<?php get_search_form(); ?>
		</div>

		<!-- insert sharedaddy if enabled here -->
		<?php coup_insert_sharedaddy() ?>

		<!-- Post navigation -->
		<?php coup_post_navigation(); ?>

	</aside>

<?php
get_footer();
