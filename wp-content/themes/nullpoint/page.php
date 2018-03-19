<?php
/**
 * The template for displaying all pages.
 *
 * @since NullPoint 1.0
 */
  
get_header(); 
?>
                        
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php the_content( __( 'Read More', 'nullpoint' ) ); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'nullpoint' ), 'after' => '</div>' ) ); ?>
            
			<?php 
			/**	edit_post_link( __( 'Edit', 'nullpoint' ), '<span class="edit-link">', '</span>' ); */ 
 			?>
            <div class="clear"></div>
            
        </div><!-- #post -->

		<?php if ( comments_open() || get_comments_number() ) :
			comments_template( '', true );
		endif; ?>

        <?php endwhile; ?>
        
        <div class="clear"></div><!-- clear float --> 
                  	
		<?php get_footer(); ?>