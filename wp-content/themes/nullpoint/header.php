<?php
/**
 * The Header for our theme.
 *
 * @since NullPoint 1.0
 */

// Theme Settings
$npt_header_layout 		       = get_theme_mod( 'nullpoint_header_layout', 'logo-rightmenu-buttons' );
$npt_hb_search     		       = get_theme_mod( 'nullpoint_search_button', 'on' );
$npt_extra_button_link		   = get_theme_mod( 'header_button_link', '' );
$npt_extra_button_text 		   = get_theme_mod( 'header_button_text', '' );
$npt_secondary_header  		   = get_theme_mod( 'nullpoint_secondary_header', 'on' );
$npt_sh_position 			   = get_theme_mod( 'nullpoint_sh_position', 'top' );
$npt_th_allow 		   		   = get_theme_mod( 'nullpoint_th_allow', 'off' );
$npt_feautered_blog_posts      = get_theme_mod( 'feautered_blog_posts', 'on' );
$npt_body_class				   = '' ;
$npt_return_transparent_header = '';

if (($npt_th_allow == 'on') || ((is_home() || is_tax() || is_archive() || is_search()) && $npt_feautered_blog_posts == 'on')) { 
	$npt_body_class = 'npt-body-th' ;
	$npt_return_transparent_header = 'yes';
}
			
if (is_page()) {
	$post_id = get_the_ID();
	$npt_post_transparent_header = get_post_meta( $post_id, 'nullpoint_post_transparent_header', true);
		
	if ($npt_post_transparent_header == 'yes') { 
		$npt_body_class = 'npt-body-th' ;
		$npt_return_transparent_header = 'yes';
	} elseif ($npt_post_transparent_header == 'no') {
		$npt_body_class = '' ;
		$npt_return_transparent_header = '';
	}
}
?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php if ( is_singular() && pings_open() ) { ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php } ?>

<?php wp_head(); ?>

</head>

<body <?php body_class($npt_body_class); ?>>

<div id="npt-page-holder">
	<div id="npt-outercontainer">
        <!-- HEADER -->
        <?php
        if(($npt_secondary_header == 'on') && ($npt_sh_position == 'top')){ 
			nullpoint_secondary_header();
		} ?>
        <?php if ($npt_return_transparent_header == 'yes') { ?><div id="npt-transparent-header" class="active"><?php } ?>
        <div id="npt-outerheader">
        	<div class="container">
            	<header id="npt-header" class="npt-<?php echo esc_attr($npt_header_layout); ?>">
                    <div id="npt-logo"><?php nullpoint_logo();?></div>
                    <div id="npt-header-menus" class="npt-header-menu1">
                        <a id="npt-toggleMenu" href="#"><?php echo _e( 'Menu', 'nullpoint' ) ; ?><span class="menu-icon"><i class="fa fa-bars"></i></span></a>
                        <nav id="npt-mobile-navigation" class="npt-toggle_container">
                            <?php wp_nav_menu( array(
                              'container'       => 'ul', 
                              'menu_class'      => 'npt-mobile-menu',
                              'menu_id'         => 'topnav-mobile', 
                              'depth'           => 4,
                              'sort_column'     => 'menu_order',
                              'theme_location'  => 'mobilmenu' 
                              )); 
                            ?>                                                             
                        </nav>
                        <nav id="npt-header-navigation" class="npt-line-animation">
                            <?php wp_nav_menu( array(
                              'container'       => 'ul', 
                              'menu_class'      => 'npt-menu',
                              'menu_id'         => 'topnav', 
                              'depth'           => 4,
                              'sort_column'     => 'menu_order',
                              'theme_location'  => 'mainmenu',
                              'link_before' => '<span>',
                              'link_after' => '</span>'
                              )); 
                            ?>                                                             
                        </nav>
                    </div>
                    	<?php if(($npt_hb_search == 'on') || ($npt_extra_button_text != '')){ ?>
                    <div id="npt-header-buttons">
                    	<?php if($npt_hb_search == 'on'){ ?>
                    	<a id="npt-header-search" class="npt-btn npt-btn-hb" href="#">
                        	<div class="npt-btn-overlay"></div>
                            <div class="npt-btn-content"><i class="fa fa-search"></i></div>
                        </a>
                        <div id="npt-hb-search">
                            <?php get_search_form(); ?>
                        </div>
                        <?php } ?>
                        <?php if($npt_extra_button_text != ''){ ?>
                        <a class="npt-btn npt-btn-hb" href="<?php echo esc_url($npt_extra_button_link) ; ?>">
                            <div class="npt-btn-overlay"></div>
                            <div class="npt-btn-content"><?php echo esc_html($npt_extra_button_text) ; ?></div>
                        </a>
                        <?php } ?>
                    </div>
                    	<?php } ?>
                </header>
            </div>
		</div>
        <?php if ($npt_return_transparent_header == 'yes') { ?></div><?php } ?>
        <?php
        if(($npt_secondary_header == 'on') && ($npt_sh_position == 'bottom')){ 
			nullpoint_secondary_header();
		} ?>
        <!-- END HEADER -->

		<?php nullpoint_breadcrumbs_layout(); ?>
        
        <!-- MAIN CONTENT -->               
        <div id="npt-maincontent">
        <?php 
		if ((is_home() || is_tax() || is_archive() || is_search()) && $npt_feautered_blog_posts == 'on') {
			$npt_featured_query_args = array(
				'post_type' => 'post',
				'posts_per_page' => 1,
				'meta_query' => array(array('key' => '_thumbnail_id')),
				'ignore_sticky_posts' => 1,
			);
            $npt_featured_query = new WP_Query( $npt_featured_query_args ); 
			
			if ( $npt_featured_query->have_posts() ) :
				while ( $npt_featured_query->have_posts() ) : $npt_featured_query->the_post();
				$npt_featured_excerpt = get_the_excerpt();
				$npt_featured_excerpt = substr($npt_featured_excerpt, 0, 180); ?>
        <div id="npt-featured-post-holder">
			<img src="<?php the_post_thumbnail_url(); ?>" >
            <div class="npt-fp-content-h container">
            	<div class="npt-fp-content">
        			<h2><?php the_title(); ?></h2>
                    <p><?php echo esc_html($npt_featured_excerpt); ?></p>
                    <div class="npt-fp-button-h">
						<a href="<?php the_permalink(); ?>"><div class="npt-fp-button"><?php nullpoint_read_more_text() ?> <i class="fa fa-arrow-right"></i></div></a>
                    </div>
            	</div>
            </div>
        </div>          
                <?php endwhile;
				wp_reset_postdata();
			endif;
		} ?> 
            <div class="container">
                <div class="row">
          
                <div id="content" class="<?php nullpoint_maincontent_with_sidebar(); ?>">
                	<div class="main">