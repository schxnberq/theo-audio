<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since NullPoint 1.0
 */

get_header(); ?>
                        
			<?php
                
                /* Run the loop for the archives page to output the posts.
                 * If you want to overload this in a child theme then include a file
                 * called loop-archives.php and that will be used instead.
                 */
                get_template_part( 'loop', 'archive' );
            ?>
        <div class="clear"></div><!-- clear float --> 

<?php get_footer(); ?>