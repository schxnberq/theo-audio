<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package coup
 */

get_header(); ?>

	<div id="primary" class="content-area gallery">
		<main id="main" class="site-main container" role="main">
				<div class="masonry row">

					<article class="hentry buy-pro">
					<div class="archive-background">

						<header class="entry-header">

						</header><!-- .entry-header -->

						<div class="entry-content">
						</div><!-- .entry-content -->

					</div>
					</article><!-- #post-## -->

				</div>
		</main>
	</div>
	<aside class="side-nav">
		<!-- Search form -->
		<div class="search-wrap">
			<?php get_search_form(); ?>
		</div>

	</aside>

<?php
get_footer();
