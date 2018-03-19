<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @since NullPoint 1.0
 */

$npt_excerpt = get_the_excerpt();
?>

	<!-- #post start -->
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    	<div class="npt-article-container">
            <!-- blog-entry  -->
            <div class="blog-entry">
                
                <!-- entry image  -->
                <div class="entry-image">
					<?php
                    $post_id = get_the_ID(); 
					if ( get_post_gallery() ) {
                    $npt_gallery_format = get_post_gallery_images( $post_id );
                    ?>	
             
                    <div class="postimg">
                        <div id="postgalleryslider" class="flexslider">
                            <ul class="slides">
                                <?php foreach ( $npt_gallery_format as $attachment):  ?>
                                <li class="slide">
                                    <div class="npt-spih">
                                        <div class="single-post-image" style="background-image: url(<?php echo esc_url($attachment) ;?>)"></div>
                                    </div>
                                </li>
                                <?php endforeach; ?> 
                            </ul>
                        </div>
                    </div>
             
                    <?php } else { ?>
                    	<?php nullpoint_post_thumbnails(); ?>
					<?php } ?>
                </div>
                <!-- entry image end -->
                
                <!-- entry texts -->
                <div class="npt-entry-texts">
                    <div class="npt-psth">
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'nullpoint' ), the_title_attribute( 'echo=0' ) ); ?>"><h3 class="npt-post-single-title"><?php if ( is_sticky() ) { ?><i class="fa fa-thumb-tack"></i><?php } the_title(); ?></h3></a>
                    <p class="npt-ps-categories"><?php the_category(' '); ?></p>
                    </div>
    
                    <div class="entry-content">
                        <p class="npt-entry-excerpt"><?php echo wp_kses_post($npt_excerpt); ?></p>
                        <div class="npt-post-button-holder">
                            <a class="npt-btn npt-btn-basic" href="<?php the_permalink(); ?>">
                                <div class="npt-btn-overlay"></div>
                                <div class="npt-btn-content"><?php nullpoint_read_more_text() ?></div>
                            </a>
                        </div>
                    </div>
                    
					<?php nullpoint_entry_infos(); ?>
                    
                </div>
                <!-- entry texts end  -->
            </div>
            <!-- blog-entry end  -->
            <div class="clear"></div>
        </div>
	</article>
    <!-- #post end -->