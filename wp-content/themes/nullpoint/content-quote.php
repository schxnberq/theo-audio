<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @since NullPoint 1.0
 */
?>
	
    <!-- #post start -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<div class="npt-article-container">
                      
                <div class="entry-content">
                    <?php 
					$post_id = get_the_ID(); 
					$npt_quote_format = get_the_excerpt();
					?>
                    
					<div class="npt-blockquote-2-holder">
                    	<div class="npt-blockquote-2">
                            <div class="npt-blockquote-2-content"><?php echo esc_html($npt_quote_format); ?></div>
                            <div class="clear"></div>
						</div>
					</div>				       
                </div>  
				<div class="clear"></div>
        </div>
	</article>
    <!-- #post end -->