<?php
/**
 * The template for displaying Search Results pages.
 *
 * @since NullPoint 1.0
 */

get_header(); ?>
                        	
        <div id="searchresult">
			<?php if ( have_posts() ) the_post(); ?>
            <?php get_template_part( 'loop' ); ?>
        </div>
        
    	<div class="clear"></div><!-- clear float --> 

<?php get_footer(); ?>