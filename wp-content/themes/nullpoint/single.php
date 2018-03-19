<?php
/**
 * The Template for displaying all single posts.
 *
 * @since NullPoint 1.0
 */

get_header(); ?>
            
    <div id="singlepost">
    	
		  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      
      <div class="single-article-wrapper">
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          
          <?php 
		  // Post Option
		  $post_id = get_the_ID();
		  $npt_post_nav = get_post_meta($post_id, 'nullpoint_post_nav', true );
          ?>

          <?php
          /* HEADER
          ----------------------------------------------- */
          if (has_post_thumbnail()) {
          $image = wp_get_attachment_url( get_post_thumbnail_id()); ?>
            <div class="npt-spih">
              <div class="single-post-image" style="background-image: url(<?php echo esc_url($image) ; ?>)"></div>
            </div>
          <?php } ?>

            <div class="npt-psth">
              <h3 class="npt-post-single-title"><?php the_title(); ?></h3>
              <p class="npt-ps-categories"><?php the_category(' '); ?></p>
            </div>
                

            <div class="entry-content">
              <?php
        			/* Content
              ----------------------------------------------- */ 
              the_content();
     
              ?>
              <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'nullpoint' ), 'after' => '</div>' ) ); ?>
            </div> 
    
            <div class="clearfix"></div><!-- clear float --> 
        </article>

        <div class="npt-entry-utility">
			<?php nullpoint_post_infos(); ?>
        </div>
             
        <?php nullpoint_post_tags(); ?>
        
      </div><!-- single-article-wrapper --> 
          
      <?php if (isset($npt_post_nav) && ($npt_post_nav != 'no')) { 
	  the_post_navigation(array(
			'prev_text'          => '<div class="nav-indicator">' . __( 'Previous Post:', 'nullpoint' ) . '</div><p>%title</p>',
        	'next_text'          => '<div class="nav-indicator">' . __( 'Next Post:', 'nullpoint' ) . '</div><p>%title</p>',
        	'screen_reader_text' => __( 'Post navigation', 'nullpoint' ),
	  )); 
	  } ?>

      <?php 
	  if ( comments_open() || get_comments_number() ) :
	  	comments_template(); 
	  endif; 
	  ?>
        
      <?php endwhile; ?>
    
    </div><!-- singlepost --> 
    <div class="clearfix"></div><!-- clear float --> 

<?php get_footer(); ?>