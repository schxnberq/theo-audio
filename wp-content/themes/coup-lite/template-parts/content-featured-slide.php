<?php
/**
 * Template part for displaying featured posts in featured posts slider
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package coup
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-text">

		<div class="entry-meta">
			<?php
			coup_entry_footer();
			coup_posted_on();
			?>
		</div>
		<header class="entry-header">

			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
			endif;
			?>

		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_excerpt();
			?>
		</div><!-- .entry-content -->
	</div>

	<?php coup_hero_featured_image(); ?>
</article><!-- #post-## -->
