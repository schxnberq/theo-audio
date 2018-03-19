<?php
/*********NullPoint Sidebars**************/
if ( ! function_exists( 'nullpoint_sidebars_widgets_init' ) ) {
function nullpoint_sidebars_widgets_init() {
    register_sidebar( array(
        'name' => esc_attr__( 'Main Sidebar', 'nullpoint'),
        'id' => 'nullpoint_main_sidebar',
        'description' => esc_attr__( 'Main Sidebar Widget Area', 'nullpoint' ),
        'before_widget' 	=> '<ul><li id="%1$s" class="widget-container %2$s"><div class="box">',
		'after_widget' 		=> '<div class="clear"></div></div></li></ul>',
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 			=> '</h3>',
    ));
	
	register_sidebar(array(
		'name'          => __('Footer Sidebar 1', 'nullpoint' ),
		'id'         	=> 'footer-1',
		'description'   => __( 'Footer widget column.', 'nullpoint' ),
		'before_widget' => '<ul class="npt-fw-element"><li id="%1$s" class="widget-container %2$s"><div class="box">',
		'after_widget' 	=> '<div class="clearfix"></div></div></li></ul>',
		'before_title' 	=> '<p class="npt-footer-title widget-title">',
		'after_title' 	=> '</p>',
	));
	
	register_sidebar(array(
		'name'          => __('Footer Sidebar 2', 'nullpoint' ),
		'id'         	=> 'footer-2',
		'description'   => __( 'Footer widget column.', 'nullpoint' ),
		'before_widget' => '<ul class="npt-fw-element"><li id="%1$s" class="widget-container %2$s"><div class="box">',
		'after_widget' 	=> '<div class="clearfix"></div></div></li></ul>',
		'before_title' 	=> '<p class="npt-footer-title widget-title">',
		'after_title' 	=> '</p>',
	));
	
	register_sidebar(array(
		'name'          => __('Footer Sidebar 3', 'nullpoint' ),
		'id'         	=> 'footer-3',
		'description'   => __( 'Footer widget column.', 'nullpoint' ),
		'before_widget' => '<ul class="npt-fw-element"><li id="%1$s" class="widget-container %2$s"><div class="box">',
		'after_widget' 	=> '<div class="clearfix"></div></div></li></ul>',
		'before_title' 	=> '<p class="npt-footer-title widget-title">',
		'after_title' 	=> '</p>',
	));
	
	register_sidebar(array(
		'name'          => __('Footer Sidebar 4', 'nullpoint' ),
		'id'         	=> 'footer-4',
		'description'   => __( 'Footer widget column.', 'nullpoint' ),
		'before_widget' => '<ul class="npt-fw-element"><li id="%1$s" class="widget-container %2$s"><div class="box">',
		'after_widget' 	=> '<div class="clearfix"></div></div></li></ul>',
		'before_title' 	=> '<p class="npt-footer-title widget-title">',
		'after_title' 	=> '</p>',
	));
	
	register_sidebar(array(
		'name'          => __('Footer Sidebar 5', 'nullpoint' ),
		'id'         	=> 'footer-5',
		'description'   => __( 'Footer widget column.', 'nullpoint' ),
		'before_widget' => '<ul class="npt-fw-element"><li id="%1$s" class="widget-container %2$s"><div class="box">',
		'after_widget' 	=> '<div class="clearfix"></div></div></li></ul>',
		'before_title' 	=> '<p class="npt-footer-title widget-title">',
		'after_title' 	=> '</p>',
	));
}
add_action( 'widgets_init', 'nullpoint_sidebars_widgets_init' );
}