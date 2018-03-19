<?php 

/*********Head action hook**************/
if(!function_exists("nullpoint_head")){
	function nullpoint_head(){
		do_action("nullpoint_head");
	}
	add_action('wp_head', 'nullpoint_head', 20);
}

/*********Print the logo html**************/
if(!function_exists("nullpoint_logo")){
function nullpoint_logo(){
	if ( has_custom_logo() ) { ?>
    <div class="npt-default-logo">
    	<?php the_custom_logo(); ?>
    </div>     
	<?php } else { ?>
	<div id="npt-logo-text">
    	<a href="<?php echo esc_url(home_url( '/')); ?>" title="<?php esc_attr_e('Click for Home','nullpoint'); ?>"><?php echo esc_html(bloginfo()); ?></a>
    </div>
	<?php } 	
}
}

/*********Print the secondary header html**************/
if(!function_exists("nullpoint_secondary_header")){
	function nullpoint_secondary_header(){
		
	$npt_sh_layout              = get_theme_mod( 'nullpoint_sh_layout', 'menu-custom-social' );
	$npt_sh_custom_content      = get_theme_mod( 'header_title_text', '' );
	$npt_sh_menu 				= get_theme_mod( 'nullpoint_sh_menu', 'off' );
	$npt_sh_socials 			= get_theme_mod( 'nullpoint_sh_socials', 'on' );
	$npt_social1 				= get_theme_mod( 'social_1', '' );
	$npt_social2 				= get_theme_mod( 'social_2', '' );
	$npt_social3 				= get_theme_mod( 'social_3', '' );
	$npt_social4 				= get_theme_mod( 'social_4', '' );
	$npt_social5 				= get_theme_mod( 'social_5', '' );
	?>
	<div id="npt-outersecondaryheader">
        <div class="container">
        	<div id="npt-secondary-header" class="npt-<?php echo esc_attr($npt_sh_layout); ?>">
        	<?php
			$npt_sh_order = $npt_sh_layout;
			$npt_sh_order_elements = explode('-', $npt_sh_order);
			foreach ($npt_sh_order_elements as $sh_element) {
			?>
            	<?php if ($sh_element == 'custom') {
					if ($npt_sh_custom_content != '') { ?>
            	<div id="npt-sh-custom">
					<?php echo esc_html($npt_sh_custom_content) ; ?>
            	</div>
					<?php }
				} ?>
                <?php if ($sh_element == 'menu') { 
					if ($npt_sh_menu == 'on') { ?>
                <div id="npt-sh-menu">
                	<nav id="npt-sh-navigation">
						<?php wp_nav_menu( array(
                          'container'       => 'ul', 
                          'menu_class'      => 'npt-sh-menu-content',
                          'menu_id'         => 'sh-nav', 
                          'depth'           => 1,
                          'sort_column'     => 'menu_order',
                          'theme_location'  => 'secondarymenu' 
                          )); 
                        ?>                                                             
                    </nav>
                </div>
                	<?php }
				}?>
                <?php if ($sh_element == 'social') { 
					if ($npt_sh_socials == 'on') { ?>
                <div id="npt-sh-social">
                	<div id="npt-menu-social" class="npt-menu-social">
                        <ul id="npt-menu-social-items" class="menu-items">
                         <?php if($npt_social1 != ''){ ?><li><a href="<?php echo esc_url($npt_social1) ; ?>"><i class="fa fa-facebook"></i></a></li> <?php } ?>
                         <?php if($npt_social2 != ''){ ?><li><a href="<?php echo esc_url($npt_social2) ; ?>"><i class="fa fa-google"></i></a></li> <?php } ?>
                         <?php if($npt_social3 != ''){ ?><li><a href="<?php echo esc_url($npt_social3) ; ?>"><i class="fa fa-twitter"></i></a></li> <?php } ?>
                         <?php if($npt_social4 != ''){ ?><li><a href="<?php echo esc_url($npt_social4) ; ?>"><i class="fa fa-youtube"></i></a></li> <?php } ?>
                         <?php if($npt_social5 != ''){ ?><li><a href="<?php echo esc_url($npt_social5) ; ?>"><i class="fa fa-linkedin"></i></a></li> <?php } ?>
                        </ul>
                    </div>
                </div>
                	<?php }
				}?>
            <?php } ?>
            	<div class="clearfix"></div>
            </div>
        </div>
    </div>
    <?php
	}
}


/*********DYNAMIC STYLES**************/

/*********Header Styles**************/
if(!function_exists("nullpoint_header_styles")){
function nullpoint_header_styles() {

$npt_body_bg_color 			 = get_theme_mod( 'background_color', get_theme_support( 'custom-background', 'default-color' ) );
$npt_sh_mobil      			 = get_theme_mod( 'nullpoint_sh_mobil', 'off' );
$npt_feautered_blog_posts    = get_theme_mod( 'feautered_blog_posts', 'on' );
$npt_header_background_color = get_theme_mod( 'nullpoint_header_background_color', '#0d0d0d' );
$npt_fw_background_color     = get_theme_mod( 'nullpoint_fw_background_color', '#2d2d2d' );
$npt_bf_bg                   = get_theme_mod( 'nullpoint_bf_bg', '#0d0d0d' );
?>
<style type="text/css">
body {
	background-color: #<?php echo esc_attr($npt_body_bg_color); ?> !important;
}

#npt-outerheader {
	background-image: url('<?php header_image(); ?>');
}

@media (max-width: 967px) {
	<?php if($npt_sh_mobil == 'off'){ ?>
	#npt-outersecondaryheader {
		display: none !important;
	}
	<?php } else { ?>
	#npt-secondary-header #npt-sh-menu,
	#npt-secondary-header #npt-sh-social,
	#npt-secondary-header #npt-sh-custom {
		float: none !important;
		padding: 10px 0 !important;
		width: 100%;
		text-align: center;
	}
	<?php } ?>
}

<?php if ((is_home() || is_tax() || is_archive() || is_search() || is_404()) && $npt_feautered_blog_posts == 'on') { ?>
#npt-maincontent {
    padding-top: 0px;
    padding-bottom: 0px;
}
<?php } ?>

<?php if ($npt_header_background_color != ('')){ ?>
#npt-outerheader {
    background-color: <?php echo esc_attr($npt_header_background_color); ?>;
}
<?php } ?>

<?php if ($npt_fw_background_color != ('')){ ?>
#npt-footer-sidebar {
	background-color: <?php echo esc_attr($npt_fw_background_color); ?> !important;
}
<?php } ?>

<?php if ($npt_bf_bg != ('')){ ?>
#npt-footer, #npt-bottom-footer-holder #npt-menu-social-items-footer li {
    background-color: <?php echo esc_attr($npt_bf_bg); ?> !important;
}
<?php } ?>

<?php if (is_page()) { 
$post_id            = get_the_ID();  
$npt_top_padding    = get_post_meta( $post_id, 'nullpoint_top_padding', true);
$npt_bottom_padding = get_post_meta( $post_id, 'nullpoint_bottom_padding', true);
if (($npt_top_padding != '') || ($npt_bottom_padding != '')){
?> 
#npt-maincontent {
	padding-top: <?php echo esc_attr($npt_top_padding) ; ?>;
	padding-bottom: <?php echo esc_attr($npt_bottom_padding) ; ?>;
}
<?php 
}} ?>
</style>
<?php 
}
}
add_action( 'wp_head', 'nullpoint_header_styles', 997 );