<?php
/**
 * The template for displaying the footer.
 *
 * @since NullPoint 1.0
 */
 
?>

<?php
// Theme Settings
$npt_allow_f_widgets 	= get_theme_mod( 'nullpoint_allow_f_widgets', 'on' );
$npt_footcolumn 		= get_theme_mod( 'nullpoint_footer_column', '1-2-3' );
$npt_bf_layout 			= get_theme_mod( 'nullpoint_bf_layout', 'cr-menu' );
$npt_social 			= get_theme_mod( 'nullpoint_footer_social_switch', 'on' );
$npt_social1 			= get_theme_mod( 'social_1', '' );
$npt_social2 			= get_theme_mod( 'social_2', '' );
$npt_social3 			= get_theme_mod( 'social_3', '' );
$npt_social4 			= get_theme_mod( 'social_4', '' );
$npt_social5 			= get_theme_mod( 'social_5', '' );
$npt_bf_menu_switch 	= get_theme_mod( 'nullpoint_bf_menu_switch', 'on' );
$npt_copyright_content  = get_theme_mod( 'nullpoint_copyright_content', '' );
  
if($npt_footcolumn=="1"){
	$npt_typecol = "col-12";
}elseif($npt_footcolumn=="1-2"){
	$npt_typecol = "col-6";
}elseif($npt_footcolumn=="1-2-3-4"){
	$npt_typecol = "col-3";
}elseif($npt_footcolumn=="1-2-3-4-5"){
	$npt_typecol = "col-1-5";
}else{
	$npt_typecol = "col-4";
}
	
$npt_fc_sb = $npt_footcolumn;
$npt_fc_sb_elements = explode('-', $npt_fc_sb);
?> 
			
                        <div class="clear"></div>
                        </div><!-- main -->                           
                        <div class="clear"></div>
                    </div><!-- content -->
                    <?php nullpoint_sidebar_layout(); ?>
                    <div class="clear"></div>
                </div><!-- END row -->
                <div class="clear"></div>
            </div><!-- END container -->
        </div><!-- END MAIN CONTENT -->

		<?php if($npt_allow_f_widgets != 'off'){ ?>
        
        <!-- FOOTER SIDEBAR -->
        <div id="npt-footer-sidebar">
            <div id="npt-footer-sidebar-container">
                <div class="container">
                    <div class="row"> 
                        <div id="npt-fs-content">
                            <?php foreach ($npt_fc_sb_elements as $npt_fc_sb_element) { ?>
							<div class="<?php echo esc_attr($npt_typecol); ?> npt-footer-widget">
								<?php dynamic_sidebar( 'footer-'.$npt_fc_sb_element ); ?>
                                <div class="clearfix"></div>
                            </div>
							<?php } ?>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FOOTER SIDEBAR -->
        <?php } ?>
        
        <!-- FOOTER -->
        <div id="npt-footer">
        	<div id="npt-footer-container">
                <div class="container">
                    <div class="row">
						<!-- npt-bottom-footer-holder -->
                        <div id="npt-bottom-footer-holder">
                        <?php if($npt_social == 'on'){ ?>
                        <div id="npt-menu-social-footer" class="npt-menu-social">
                    			<ul id="npt-menu-social-items-footer" class="menu-items">
                         <?php if($npt_social1 != ''){ ?><li><a href="<?php echo esc_url($npt_social1) ; ?>"><i class="fa fa-facebook"></i></a></li> <?php } ?>
                         <?php if($npt_social2 != ''){ ?><li><a href="<?php echo esc_url($npt_social2) ; ?>"><i class="fa fa-google"></i></a></li> <?php } ?>
                         <?php if($npt_social3 != ''){ ?><li><a href="<?php echo esc_url($npt_social3) ; ?>"><i class="fa fa-twitter"></i></a></li> <?php } ?>
                         <?php if($npt_social4 != ''){ ?><li><a href="<?php echo esc_url($npt_social4) ; ?>"><i class="fa fa-youtube"></i></a></li> <?php } ?>
                         <?php if($npt_social5 != ''){ ?><li><a href="<?php echo esc_url($npt_social5) ; ?>"><i class="fa fa-linkedin"></i></a></li> <?php } ?>
                                </ul>
                                <div class="clear"></div>
                		</div>
                        <?php } ?>
                        
						<footer id="npt-bottom-footer" class="npt-bf-<?php echo esc_attr($npt_bf_layout) ; ?> npt-bf-animation">
							
							<?php if($npt_bf_layout == 'cr-menu'){ ?>
                            <div class="npt-bottom-footer-col npt-bf-cr">
								<?php echo esc_html($npt_copyright_content); ?>
                            </div>
                            <?php } ?>
                            
                            <div class="npt-bottom-footer-col npt-bf-menu">
                            <?php if($npt_bf_menu_switch == 'on'){ ?>
								<?php wp_nav_menu( array(
                                  'container'       => 'ul', 
                                  'menu_class'      => 'npt-footer-menu',
                                  'menu_id'         => 'footernav', 
                                  'depth'           => 1,
                                  'sort_column'    => 'menu_order',
                                  'fallback_cb'     => 'nullpoint_nav_page_fallback',
                                  'theme_location' => 'footermenu' 
                                  )); 
                                ?>
                            <?php } ?>
                            </div>
                            
                            <?php if($npt_bf_layout == 'menu-cr'){ ?>
                            <div class="npt-bottom-footer-col npt-bf-cr">
								<?php echo esc_html($npt_copyright_content); ?>
                            </div>
                            <?php } ?>
                         	<div class="clearfix"></div>
                        </footer>
                    </div><!-- npt-bottom-footer-holder end -->
                </div><!-- row end -->
            </div><!-- container end -->
        </div><!-- npt-footer-container end -->
        </div><!-- npt-footer end --> 
	</div><!-- npt-outercontainer end --> 
</div><!-- npt-page-holder end --> 
<?php wp_footer(); ?>

</body>
</html>
