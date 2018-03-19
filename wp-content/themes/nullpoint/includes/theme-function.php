<?php

/*********For Localization**************/
add_action('after_setup_theme', 'nullpoint_load_textdomain');
function nullpoint_load_textdomain(){
	load_theme_textdomain( 'nullpoint', get_template_directory().'/languages' );
}

/*********Array Pages**************/
if ( ! function_exists( 'nullpoint_all_pages' ) ):
function nullpoint_all_pages() {
	$npt_pages = get_pages();
	$npt_list = array();
	$npt_list[0] = esc_html__('None', 'nullpoint');
	foreach ( $npt_pages as $npt_page ) {
		$npt_list[ $npt_page->ID ] = $npt_page->post_title;
	}
	return $npt_list;
}
endif;

/*********Template for comments and pingbacks**************/
if ( ! function_exists( 'nullpoint_comment' ) ) :
function nullpoint_comment( $comment, $args, $depth ) {
	$comment = $GLOBALS['comment'];
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="con-comment">
		<div class="comment-author vcard">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div><!-- .comment-author .vcard -->


		<div class="comment-body">
			<?php  printf( __( '%s ', 'nullpoint' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            <span class="time">
               <?php
                /* translators: 1: date, 2: time */
                printf( __( '%1$s %2$s', 'nullpoint' ), get_comment_date(),  get_comment_time() ); ?>
            </span>
			<div class="commenttext">
			<?php comment_text(); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'nullpoint' ); ?></em>
			<?php endif; ?>
            <?php edit_comment_link( __( 'Edit', 'nullpoint' ), '<div class="com-link">', '</div>' );?>
			<?php comment_reply_link( 
                array_merge( 
                    $args, array(
                    'before' => '<div class="com-reply">', 
                    'depth' => $depth, 
                    'max_depth' => $args['max_depth'],
                    'after'      => '</div>' 
                    ) 
                ) 
            ); ?>
            
			</div>
            <div class="arrow"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'nullpoint' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'nullpoint'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/*********Display navigation to next/previous comments**************/
if ( ! function_exists( 'nullpoint_comment_nav' ) ) {
function nullpoint_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'nullpoint' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'nullpoint' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'nullpoint' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
}

/*********Read More Text**************/
if(!function_exists('nullpoint_read_more_text')){
function nullpoint_read_more_text(){
	
	$npt_read_more_text = get_theme_mod( 'nullpoint_read_more_text', __('Read More', 'nullpoint') );
	echo esc_html($npt_read_more_text);

}
}
/*********Post Thumbnails**************/

if(!function_exists('nullpoint_post_thumbnails')){
function nullpoint_post_thumbnails(){	
?>
	<?php if (has_post_thumbnail()) { ?>
        <div class="npt-spih">
            <?php the_post_thumbnail( 'nullpoint-entry-image' ) ; ?>
        </div>
    <?php } ?>
<?php                    
}
}

/*********Layout functions**************/
// Breadcrumbs call
if ( ! function_exists( 'nullpoint_breadcrumbs_layout' ) ) :
function nullpoint_breadcrumbs_layout() {
	if (defined( 'FW' )) {
		// Theme Settings
		$post_id = get_the_ID();  
		$npt_post_allow_breadcrumbs = get_post_meta( $post_id, 'nullpoint_post_allow_breadcrumbs', true ) ;
		$npt_allow_breadcrumbs      = get_theme_mod( 'nullpoint_allow_breadcrumbs', 'on');
		$npt_blog_allow_breadcrumbs = get_theme_mod( 'nullpoint_blog_allow_breadcrumbs', 'off');
		
		if (is_home() || is_tax() || is_archive() || is_search() || is_404()) {
			if ($npt_blog_allow_breadcrumbs == 'on') { echo fw_ext_get_breadcrumbs( $separator = '-'); }
			elseif ($npt_blog_allow_breadcrumbs == 'off') { }
			elseif ($npt_allow_breadcrumbs == 'on'){ echo fw_ext_get_breadcrumbs( $separator = '-'); } 
			else { }
		} 
		elseif ($npt_post_allow_breadcrumbs == 'yes'){ echo fw_ext_get_breadcrumbs( $separator = '-'); } 
		elseif( $npt_post_allow_breadcrumbs == 'no'){ } 
		elseif ($npt_allow_breadcrumbs == 'on'){ echo fw_ext_get_breadcrumbs( $separator = '-'); } 
	}
}
endif;

// Layout classes for npt-maincontent
if ( ! function_exists( 'nullpoint_maincontent_with_sidebar' ) ) :
function nullpoint_maincontent_with_sidebar() {

	// Theme Settings
	$post_id = get_the_ID();  
	$npt_basic_post_layer_select = get_post_meta( $post_id, 'nullpoint_basic_post_layer_select', true ) ;
	$npt_basic_layer_select      = get_theme_mod( 'nullpoint_basic_layer_select', '1-col' );
	$npt_blog_basic_layer_select = get_theme_mod( 'nullpoint_blog_basic_layer_select', 'default');
	
	if (is_home() || is_tax() || is_archive() || is_search() || is_404()) {
		if ($npt_blog_basic_layer_select == '2-col-l') { echo 'contentcol columns positionleft';
		} elseif ($npt_blog_basic_layer_select == '2-col-r') { echo 'contentcol columns positionright';
		} elseif ($npt_blog_basic_layer_select == '1-col') { echo 'blogcontent columns';
		} else {
			if ($npt_basic_layer_select == '2-col-l') { echo 'contentcol columns positionleft';
			} elseif ($npt_basic_layer_select == '2-col-r') { echo 'contentcol columns positionright';
			} else { echo 'blogcontent columns';
			}
		}
	} elseif (isset($npt_basic_post_layer_select) && ($npt_basic_post_layer_select == '2-col-l')) { echo 'contentcol columns positionleft';
	} elseif (isset($npt_basic_post_layer_select) && ($npt_basic_post_layer_select == '2-col-r')) { echo 'contentcol columns positionright';
	} elseif (isset($npt_basic_post_layer_select) && ($npt_basic_post_layer_select == '1-col')) { echo 'content';
	} else {
		if ($npt_basic_layer_select == '2-col-l') { echo 'contentcol columns positionleft';
		} elseif ($npt_basic_layer_select == '2-col-r') { echo 'contentcol columns positionright';
		}
	}   
}
endif;

// Layout classes for sidebar
if ( ! function_exists( 'nullpoint_sidebar_layout' ) ) :
function nullpoint_sidebar_layout() {

	$post_id = get_the_ID();
	$npt_basic_post_layer_select = get_post_meta( $post_id, 'nullpoint_basic_post_layer_select', true ) ;
	$npt_basic_layer_select      = get_theme_mod( 'nullpoint_basic_layer_select', '1-col' );
	$npt_blog_basic_layer_select = get_theme_mod( 'nullpoint_blog_basic_layer_select', 'default');
	
	
	if (is_home() || is_tax() || is_archive() || is_search() || is_404()) { ?>
		<?php if ($npt_blog_basic_layer_select == '2-col-l') { ?>                                         
			<aside id="sidebar" class="sidebarcol columns positionright sidebar-right">
				<?php get_sidebar(); ?>
			</aside><!-- sidebar -->
		<?php } elseif ($npt_blog_basic_layer_select == '2-col-r') { ?>
			<aside id="sidebar" class="sidebarcol columns positionleft sidebar-left">
				<?php get_sidebar(); ?>
			</aside>                       
		<?php } elseif ($npt_blog_basic_layer_select == '1-col') { ?>
		<?php } else { ?>
			<?php if ($npt_basic_layer_select == '2-col-l') { ?>                                         
				<aside id="sidebar" class="sidebarcol columns positionright sidebar-right">
					<?php get_sidebar(); ?>
				</aside><!-- sidebar -->
			<?php } elseif ($npt_basic_layer_select == '2-col-r') { ?>
				<aside id="sidebar" class="sidebarcol columns positionleft sidebar-left">
					<?php get_sidebar(); ?>
				</aside>                        
			<?php } elseif ($npt_basic_layer_select == '1-col') { ?>
			<?php }?>
		<?php } ?>
	<?php } elseif (isset($npt_basic_post_layer_select) && ($npt_basic_post_layer_select == '2-col-l')) { ?>                                         
		<aside id="sidebar" class="sidebarcol columns positionright sidebar-right">
		<?php get_sidebar(); ?>  
		</aside><!-- sidebar -->
	<?php } elseif (isset($npt_basic_post_layer_select) && ($npt_basic_post_layer_select == '2-col-r')) { ?>
		<aside id="sidebar" class="sidebarcol columns positionleft sidebar-left">
		<?php get_sidebar(); ?> 
		</aside>                       
	<?php } elseif (isset($npt_basic_post_layer_select) && ($npt_basic_post_layer_select == '1-col')) { ?>
	<?php } else {  ?> 
		<?php if ($npt_basic_layer_select == '2-col-l') { ?>                                         
			<aside id="sidebar" class="sidebarcol columns positionright sidebar-right">
				<?php  get_sidebar(); ?> 
			</aside><!-- sidebar -->
		<?php } elseif ($npt_basic_layer_select == '2-col-r') { ?>
			<aside id="sidebar" class="sidebarcol columns positionleft sidebar-left">
				<?php get_sidebar(); ?>  
			</aside>                        
		<?php } elseif ($npt_basic_layer_select == '1-col') { ?>
		<?php }?>
	<?php } ?>
	<?php  

}
endif;

 /*********Post Infos**************/
if(!function_exists('nullpoint_post_infos')){
function nullpoint_post_infos(){

$posttype = get_post_type(get_the_ID());
?>
<div class="npt-post-infos">
    <div class="date"><i class="fa fa-calendar"></i> <?php the_time(get_option('date_format')); ?></div>
    <div class="user"> <i class="fa fa-user"></i> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' )));?>"><?php the_author();?></a></div>
    <?php if ($posttype == 'post'){ ?>
    <div class="category"> <i class="fa fa-folder"></i> <?php the_category(', '); ?></div>
    <?php } ?>
    <div class="comment"> <i class="fa fa-comment"></i> 
        <?php 
          comments_popup_link( 
          __( 'No Comments', 'nullpoint' ), 
          __( '1 Comment', 'nullpoint' ), 
          __( '% Comments', 'nullpoint' ),
          __( 'Comments Closed', 'nullpoint' )
          );
        ?>
    </div>
</div>
<?php
}
}

/*********Post Tags**************/
if(!function_exists('nullpoint_post_tags')){
function nullpoint_post_tags(){
?>	
<div class="npt-entry-tag">
    <?php
    $posttags = get_the_tags();
    if($posttags){
    ?>
    <span class="npt-tag-text"><?php _e('Tags:','nullpoint'); ?></span>
    <?php 
    the_tags('<div class="npt-tag-items"><span>','</span><span>','</span></div>'); 
    } 
    ?>
</div>    
<?php
}
}


/*********Entry Infos**************/
if(!function_exists('nullpoint_entry_infos')){
function nullpoint_entry_infos(){
?>

<div class="npt-entry-infos">
	<div class="npt-entry-utility">
            <?php nullpoint_post_infos(); ?>
	</div>
        <?php nullpoint_post_tags(); ?>
</div>	

<?php
}
}