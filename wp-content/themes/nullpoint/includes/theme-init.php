<?php
/*********NullPoint Setup**************/
add_action( 'after_setup_theme', 'nullpoint_setup' );
if ( ! function_exists( 'nullpoint_setup' ) ):
function nullpoint_setup() {
	
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'title-tag' );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
		
	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote' ) );
	
	//Add Custom Image Size
	add_image_size( 'nullpoint-entry-image', '890', '420', true );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'mainmenu' => __( 'Main Menu', 'nullpoint' ),
		'mobilmenu' => __( 'Mobil Menu', 'nullpoint' ),
		'secondarymenu' => __( 'Secondary Header Menu', 'nullpoint' ),
		'footermenu' => __( 'Footer Menu', 'nullpoint' )
	) );	
}
endif;

/*********Customizer functions**************/
if ( ! function_exists( 'nullpoint_custom_setup' ) ):
function nullpoint_custom_setup() {
	add_theme_support( "custom-background",
		array(
			'default-color' 		 => '0d0d0d',
			'default-image'          => '',
			'default-repeat'         => 'repeat',
			'default-position-x'     => 'left',
			'default-position-y'     => 'top',
			'default-size'           => 'auto',
			'default-attachment'     => 'scroll',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		)
	);
	
	add_theme_support( "custom-header",
		array(
			'default-image'          => '',
			'flex-height'            => false,
			'flex-width'             => false,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => false,
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		)
	);
	
	add_theme_support( "custom-logo",
		array(
			'height'      => 42,
			'width'       => 155,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);
}
endif;
add_action( 'after_setup_theme', 'nullpoint_custom_setup' );

if ( ! function_exists ('nullpoint_customize_functions') ):
function nullpoint_customize_functions( $wp_customize ) {
	
	// Header settings
	$wp_customize->add_section( 'nullpoint_header_settings' , array(
		'title'      => __( 'Header Settings', 'nullpoint' ),
		'priority'   => 50,
	) );
	
	$wp_customize->add_setting( 'nullpoint_header_layout' , array(
		'default'     => 'logo-rightmenu-buttons',
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_header_layout',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_header_layout', array(
		'label'        => __( 'Header Layout', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'nullpoint_header_layout',
		'type'           => 'radio',
		'choices'        => array(
			'logo-menu-buttons'      => __( 'Logo - Menu - Buttons', 'nullpoint' ),
			'logo-rightmenu-buttons' => __( 'Logo - Right Menu - Buttons', 'nullpoint' ),
		),
		'description'   => __( 'Choose one of the header layouts.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'header_button_text' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_button_text', array(
		'label'        => __( 'Header Button Text', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'header_button_text',
		'description'   => __( 'Add Your text or leave empty.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'header_button_link' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_button_link', array(
		'label'        => __( 'Header Button Link', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'header_button_link',
		'description'   => __( 'Add Your link.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_search_button' , array(
		'default'     => __( 'on', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_search_button', array(
		'label'        => __( 'Search Button', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'nullpoint_search_button',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Allow search field on header.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_secondary_header' , array(
		'default'     => __( 'on', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_secondary_header', array(
		'label'        => __( 'Allow Secondary Header', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'nullpoint_secondary_header',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Display secondary header.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_sh_mobil' , array(
		'default'     => __( 'off', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_sh_mobil', array(
		'label'        => __( 'Secondary Header On Mobil', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'nullpoint_sh_mobil',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Display secondary header on mobil.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_sh_position' , array(
		'default'     => 'top',
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_top_bottom',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_sh_position', array(
		'label'       => __( 'Secondary Header Positon', 'nullpoint' ),
		'section'     => 'nullpoint_header_settings',
		'settings'    => 'nullpoint_sh_position',
		'type' 		  => 'radio',
		'choices'        => array(
			'top'     => __( 'Top', 'nullpoint' ),
			'bottom'  => __( 'Bottom', 'nullpoint' ),
		),
		'description' => __( 'Secondary Header under or above the basic header. With transparent header only top works.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_sh_layout' , array(
		'default'     => 'menu-custom-social',
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_sh_layout',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_sh_layout', array(
		'label'       => __( 'Secondary Header Layout', 'nullpoint' ),
		'section'     => 'nullpoint_header_settings',
		'settings'    => 'nullpoint_sh_layout',
		'type' 		  => 'radio',
		'choices'        => array(
			'custom-social-menu' => __( 'Custom - Menu - Social', 'nullpoint' ),
			'menu-social-custom' => __( 'Menu - Social - Custom', 'nullpoint' ),
			'menu-custom-social' => __( 'Menu - Custom - Social', 'nullpoint' ),
			'social-custom-menu' => __( 'Social - Custom - Menu', 'nullpoint' ),
		),
		'description' => __( 'Choose one of the layouts.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'header_title_text' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_header_text', array(
		'label'        => __( 'Secondary Header Text', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'header_title_text',
		'description'   => __( 'Add Your text to the top header', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_sh_menu' , array(
		'default'     => __( 'off', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_sh_menu', array(
		'label'        => __( 'Secondary Header Menu', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'nullpoint_sh_menu',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Display menu on secondary header. (You can`t use submenu here.)', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_sh_socials' , array(
		'default'     => __( 'on', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_sh_socials', array(
		'label'        => __( 'Secondary Header Socials', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'nullpoint_sh_socials',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Display socials on secondary header.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'social_1' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_1', array(
		'label'        => __( 'Facebook', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'social_1',
		'description'   => __( 'Add Your link or leave empty.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'social_2' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_2', array(
		'label'        => __( 'Google', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'social_2',
		'description'   => __( 'Add Your link or leave empty.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'social_3' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_3', array(
		'label'        => __( 'Twitter', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'social_3',
		'description'   => __( 'Add Your link or leave empty.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'social_4' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_4', array(
		'label'        => __( 'Youtube', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'social_4',
		'description'   => __( 'Add Your link or leave empty.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'social_5' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_link_5', array(
		'label'        => __( 'Linkedin', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'social_5',
		'description'   => __( 'Add Your link or leave empty.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_th_allow' , array(
		'default'     => __( 'off', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_th_allow', array(
		'label'        => __( 'Transparent Header For Pages', 'nullpoint' ),
		'section'    => 'nullpoint_header_settings',
		'settings'   => 'nullpoint_th_allow',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Allow transparent header for all pages.', 'nullpoint' ),
	) ) );
		
	// General settings
	$wp_customize->add_section( 'nullpoint_general_settings' , array(
		'title'      => __( 'General Settings', 'nullpoint' ),
		'priority'   => 40,
	) );
	
	$wp_customize->add_setting( 'feautered_blog_posts' , array(
		'default'     => __( 'on', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'feautered_blog_posts', array(
		'label'        => __( 'Featured Blog Post', 'nullpoint' ),
		'section'    => 'nullpoint_general_settings',
		'settings'   => 'feautered_blog_posts',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Featured post on the top of the blog page. The first post with featured image will be displayed.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_basic_layer_select' , array(
		'default'     => '1-col',
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_basic_layer',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_basic_layer_select', array(
		'label'        => __('Default Layout', 'nullpoint'),
		'section'    => 'nullpoint_general_settings',
		'settings'   => 'nullpoint_basic_layer_select',
		'type'           => 'radio',
		'choices'        => array(
			'1-col'   => __( 'No sidebar', 'nullpoint' ),
			'2-col-l' => __( 'Right sidebar', 'nullpoint' ),
			'2-col-r' => __( 'Left sidebar', 'nullpoint' )
		),
		'description'   => __('Select the default layout for your theme.', 'nullpoint'),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_blog_basic_layer_select' , array(
		'default'     => 'default',
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_blog_layer',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_blog_basic_layer_select', array(
		'label'        => __('Blog Layout', 'nullpoint'),
		'section'    => 'nullpoint_general_settings',
		'settings'   => 'nullpoint_blog_basic_layer_select',
		'type'           => 'radio',
		'choices'        => array(
			'default' => __( 'Default', 'nullpoint' ),
			'1-col'   => __( 'No sidebar', 'nullpoint' ),
			'2-col-l' => __( 'Right sidebar', 'nullpoint' ),
			'2-col-r' => __( 'Left sidebar', 'nullpoint' )
		),
		'description'   => __('Select the layout for your blog loops.', 'nullpoint'),
	) ) );
	
	if (defined('FW')) {
	
	$wp_customize->add_setting( 'nullpoint_allow_breadcrumbs' , array(
		'default'     => __( 'on', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_allow_breadcrumbs', array(
		'label'        => __('Breadcrumbs', 'nullpoint'),
		'section'    => 'nullpoint_general_settings',
		'settings'   => 'nullpoint_allow_breadcrumbs',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Default setting to allow breadcrumbs or not.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_blog_allow_breadcrumbs' , array(
		'default'     => 'off',
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_defaultonoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_blog_allow_breadcrumbs', array(
		'label'        => __( 'Default Blog Breadcrumbs', 'nullpoint' ),
		'section'    => 'nullpoint_general_settings',
		'settings'   => 'nullpoint_blog_allow_breadcrumbs',
		'type'           => 'radio',
		'choices'        => array(
			'default'   => __( 'default', 'nullpoint' ),
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Breadcrumbs setting for blog loops.', 'nullpoint' ),
	) ) );
		
	}
	
	$wp_customize->add_setting( 'nullpoint_read_more_text' , array(
		'default'     => __('Read more', 'nullpoint'),
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_read_more_text', array(
		'label'        => __('Read More', 'nullpoint'),
		'section'    => 'nullpoint_general_settings',
		'settings'   => 'nullpoint_read_more_text',
		'description'   => __('Default "Read more" text on buttons.', 'nullpoint'),
	) ) );
	
	// Footer settings
	$wp_customize->add_section( 'nullpoint_footer_settings' , array(
		'title'      => __( 'Footer Settings', 'nullpoint' ),
		'priority'   => 51,
	) );
	
	$wp_customize->add_setting( 'nullpoint_allow_f_widgets' , array(
		'default'     => 'on',
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_allow_f_widgets', array(
		'label'        => __( 'Allow Footer Widgets', 'nullpoint' ),
		'section'    => 'nullpoint_footer_settings',
		'settings'   => 'nullpoint_allow_f_widgets',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Display widget area on footer or not.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_footer_column' , array(
		'default'     => '1-2-3',
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_footer_column',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_footer_column', array(
		'label'        => __('Footer Columns', 'nullpoint'),
		'section'    => 'nullpoint_footer_settings',
		'settings'   => 'nullpoint_footer_column',
		'type'           => 'radio',
		'choices'        => array(
			'1' => '1',
			'1-2' => '2',
			'1-2-3' => '3',
			'1-2-3-4' => '4',
			'1-2-3-4-5' => '5',
		),
		'description'   => __( 'The value is column for display in footer column.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_bf_layout' , array(
		'default'     => 'cr-menu',
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_bf_layout',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_bf_layout', array(
		'label'        => __('Bottom Footer Layout', 'nullpoint'),
		'section'    => 'nullpoint_footer_settings',
		'settings'   => 'nullpoint_bf_layout',
		'type'           => 'radio',
		'choices'        => array(
			'cr-menu' => __( 'Copyright - Menu', 'nullpoint' ),
			'menu-cr' => __( 'Menu - Copyright', 'nullpoint' ),
		),
		'description'   => __( 'Choose one of the bottom footer layouts.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_footer_social_switch' , array(
		'default'     => __( 'on', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_footer_social_switch', array(
		'label'        => __('Social Icons', 'nullpoint'),
		'section'    => 'nullpoint_footer_settings',
		'settings'   => 'nullpoint_footer_social_switch',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Display social icons on the footer. Add the links at Header Settings.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_bf_menu_switch' , array(
		'default'     => __( 'on', 'nullpoint' ),
		'transport'   => 'refresh',
		'sanitize_callback' => 'nullpoint_sanitize_onoff',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_bf_menu_switch', array(
		'label'        => __('Bottom Footer Menu', 'nullpoint'),
		'section'    => 'nullpoint_footer_settings',
		'settings'   => 'nullpoint_bf_menu_switch',
		'type'           => 'radio',
		'choices'        => array(
			'on'   => __( 'on', 'nullpoint' ),
			'off'  => __( 'off', 'nullpoint' )
		),
		'description'   => __( 'Display menu on the bottom footer.', 'nullpoint' ),
	) ) );
	
	$wp_customize->add_setting( 'nullpoint_copyright_content' , array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nullpoint_copyright_content', array(
		'label'        => __('Copyright Text', 'nullpoint'),
		'section'    => 'nullpoint_footer_settings',
		'settings'   => 'nullpoint_copyright_content',
		'description'   => __('If you dont need to add a copyright message to your website, leave this field blank.', 'nullpoint'),
	) ) );
	
	// Colors
	$wp_customize->add_setting( 'nullpoint_header_background_color', array(
		'default'    => '#0d0d0d',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nullpoint_header_background_color', array(
		'label'        => __( 'Header Background Color', 'nullpoint' ),
		'section'      => 'colors',
		'settings'     => 'nullpoint_header_background_color',
		'description'   => __('It does not work with transparent header or with featured blog post.', 'nullpoint'),
	)));
	
	$wp_customize->add_setting( 'nullpoint_fw_background_color', array(
		'default'    => '#2d2d2d',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nullpoint_fw_background_color', array(
		'label'        => __( 'Footer Widgets Background Color', 'nullpoint' ),
		'section'      => 'colors',
		'settings'     => 'nullpoint_fw_background_color',
	)));
	
	$wp_customize->add_setting( 'nullpoint_bf_bg', array(
		'default'    => '#0d0d0d',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nullpoint_bf_bg', array(
		'label'        => __( 'Bottom Footer Background Color', 'nullpoint' ),
		'section'      => 'colors',
		'settings'     => 'nullpoint_bf_bg',
	)));
	
}
endif;
add_action( 'customize_register', 'nullpoint_customize_functions' );	
	
	
if ( ! function_exists ('nullpoint_sanitize_onoff') ):
function nullpoint_sanitize_onoff( $input ) {
 $valid = array(
	'on'   => __( 'on', 'nullpoint' ),
	'off'  => __( 'off', 'nullpoint' )
 );
 if ( array_key_exists( $input, $valid ) ) {
  return $input;
 } else {
  return '';
 }
}
endif;

if ( ! function_exists ('nullpoint_sanitize_defaultonoff') ):
function nullpoint_sanitize_defaultonoff( $input ) {
 $valid = array(
	'default'   => __( 'default', 'nullpoint' ),
	'on'   => __( 'on', 'nullpoint' ),
	'off'  => __( 'off', 'nullpoint' )
 );
 if ( array_key_exists( $input, $valid ) ) {
  return $input;
 } else {
  return '';
 }
}
endif;

if ( ! function_exists ('nullpoint_sanitize_top_bottom') ):
function nullpoint_sanitize_top_bottom( $input ) {
 $valid = array(
	'top' => __( 'Top', 'nullpoint' ),
	'bottom' => __( 'Bottom', 'nullpoint' ),
 );
 if ( array_key_exists( $input, $valid ) ) {
  return $input;
 } else {
  return '';
 }
}
endif;

if ( ! function_exists ('nullpoint_sanitize_sh_layout') ):
function nullpoint_sanitize_sh_layout( $input ) {
 $valid = array(
	'custom-social-menu' => __( 'Custom - Menu - Social', 'nullpoint' ),
	'menu-social-custom' => __( 'Menu - Social - Custom', 'nullpoint' ),
	'menu-custom-social' => __( 'Menu - Custom - Social', 'nullpoint' ),
	'social-custom-menu' => __( 'Social - Custom - Menu', 'nullpoint' ),
 );
 if ( array_key_exists( $input, $valid ) ) {
  return $input;
 } else {
  return '';
 }
}
endif;

if ( ! function_exists ('nullpoint_sanitize_basic_layer') ):
function nullpoint_sanitize_basic_layer( $input ) {
 $valid = array(
	'1-col'   => __( 'No sidebar', 'nullpoint' ),
	'2-col-l' => __( 'Right sidebar', 'nullpoint' ),
	'2-col-r' => __( 'Left sidebar', 'nullpoint' )
 );
 if ( array_key_exists( $input, $valid ) ) {
  return $input;
 } else {
  return '';
 }
}
endif;

if ( ! function_exists ('nullpoint_sanitize_blog_layer') ):
function nullpoint_sanitize_blog_layer( $input ) {
 $valid = array(
	'default' => __( 'Default', 'nullpoint' ),
	'1-col'   => __( 'No sidebar', 'nullpoint' ),
	'2-col-l' => __( 'Right sidebar', 'nullpoint' ),
	'2-col-r' => __( 'Left sidebar', 'nullpoint' )
 );
 if ( array_key_exists( $input, $valid ) ) {
  return $input;
 } else {
  return '';
 }
}
endif;

if ( ! function_exists ('nullpoint_sanitize_header_layout') ):
function nullpoint_sanitize_header_layout( $input ) {
 $valid = array(
	'logo-menu-buttons' => __( 'Logo - Menu - Buttons', 'nullpoint' ),
	'logo-rightmenu-buttons' => __( 'Logo - Right Menu - Buttons', 'nullpoint' ),
 );
 if ( array_key_exists( $input, $valid ) ) {
  return $input;
 } else {
  return '';
 }
}
endif;

if ( ! function_exists ('nullpoint_sanitize_footer_column') ):
function nullpoint_sanitize_footer_column( $input ) {
 $valid = array(
	'1' => '1',
	'1-2' => '2',
	'1-2-3' => '3',
	'1-2-3-4' => '4',
	'1-2-3-4-5' => '5',
 );
 if ( array_key_exists( $input, $valid ) ) {
  return $input;
 } else {
  return '';
 }
}
endif;

if ( ! function_exists ('nullpoint_sanitize_bf_layout') ):
function nullpoint_sanitize_bf_layout( $input ) {
 $valid = array(
	'cr-menu' => __( 'Copyright - Menu', 'nullpoint' ),
	'menu-cr' => __( 'Menu - Copyright', 'nullpoint' ),
 );
 if ( array_key_exists( $input, $valid ) ) {
  return $input;
 } else {
  return '';
 }
}
endif;

/*********Page custom fields**************/
if ( ! function_exists ('nullpoint_page_options_get_meta') ):
function nullpoint_page_options_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}
endif;

if ( ! function_exists ('nullpoint_page_options_add_meta_box') ):
function nullpoint_page_options_add_meta_box() {
	add_meta_box(
		'page_options-page-options',
		__( 'Page Options', 'nullpoint' ),
		'nullpoint_page_options_html',
		'page',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'nullpoint_page_options_add_meta_box' );
endif;

if ( ! function_exists ('nullpoint_page_options_html') ):
function nullpoint_page_options_html( $post) {
	wp_nonce_field( '_page_options_nonce', 'page_options_nonce' ); 
	$nullpoint_basic_post_layer_select = nullpoint_page_options_get_meta( 'nullpoint_basic_post_layer_select');
	?>

	<div class="page-option-holder">
		<label for="nullpoint_basic_post_layer_select" class="page-option-label"><?php _e( 'Layout', 'nullpoint' ); ?></label>
		<div class="image_radio_button_control page-option-content">
            <label for="nullpoint_basic_post_layer_select_0" class="radio-button-label">
            	<input type="radio" name="nullpoint_basic_post_layer_select" id="nullpoint_basic_post_layer_select_0" value="default" <?php echo ( nullpoint_page_options_get_meta( 'nullpoint_basic_post_layer_select' ) === 'default' || empty($nullpoint_basic_post_layer_select)) ? 'checked' : ''; ?>>
                <img src="<?php echo esc_url(get_template_directory_uri()) . '/images/mb-default.png'; ?>" />
    		</label>
    		
            <label for="nullpoint_basic_post_layer_select_1" class="radio-button-label">
            	<input type="radio" name="nullpoint_basic_post_layer_select" id="nullpoint_basic_post_layer_select_1" value="1-col" <?php echo ( nullpoint_page_options_get_meta( 'nullpoint_basic_post_layer_select' ) === '1-col' ) ? 'checked' : ''; ?>>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/mb-1c.png'); ?>" />
   			</label>
    		
            <label for="nullpoint_basic_post_layer_select_2" class="radio-button-label">
            	<input type="radio" name="nullpoint_basic_post_layer_select" id="nullpoint_basic_post_layer_select_2" value="2-col-l" <?php echo ( nullpoint_page_options_get_meta( 'nullpoint_basic_post_layer_select' ) === '2-col-l' ) ? 'checked' : ''; ?>>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/mb-2cl.png'); ?>" />
			</label>
    		
            <label for="nullpoint_basic_post_layer_select_3" class="radio-button-label">
            	<input type="radio" name="nullpoint_basic_post_layer_select" id="nullpoint_basic_post_layer_select_3" value="2-col-r" <?php echo ( nullpoint_page_options_get_meta( 'nullpoint_basic_post_layer_select' ) === '2-col-r' ) ? 'checked' : ''; ?>>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/mb-2cr.png'); ?>" />
			</label>
		</div>
	</div>	
    <div class="page-option-holder">
		<label for="nullpoint_post_transparent_header" class="page-option-label"><?php _e( 'Transparent Header', 'nullpoint' ); ?></label>
		<div class="page-option-content">
            <select name="nullpoint_post_transparent_header" id="nullpoint_post_transparent_header">
                <option <?php echo (nullpoint_page_options_get_meta( 'nullpoint_post_transparent_header' ) === 'default' ) ? 'selected' : '' ?>><?php _e( 'default', 'nullpoint' ); ?></option>
                <option <?php echo (nullpoint_page_options_get_meta( 'nullpoint_post_transparent_header' ) === 'yes' ) ? 'selected' : '' ?>><?php _e( 'yes', 'nullpoint' ); ?></option>
                <option <?php echo (nullpoint_page_options_get_meta( 'nullpoint_post_transparent_header' ) === 'no' ) ? 'selected' : '' ?>><?php _e( 'no', 'nullpoint' ); ?></option>
            </select>
        </div>
	</div>	
    <?php if (defined( 'FW' )) { ?>
    <div class="page-option-holder">
		<label for="nullpoint_post_allow_breadcrumbs" class="page-option-label"><?php _e( 'Breadcrumbs', 'nullpoint' ); ?></label>
		<div class="page-option-content">
            <select name="nullpoint_post_allow_breadcrumbs" id="nullpoint_post_allow_breadcrumbs">
                <option <?php echo (nullpoint_page_options_get_meta( 'nullpoint_post_allow_breadcrumbs' ) === 'default' ) ? 'selected' : '' ?>><?php _e( 'default', 'nullpoint' ); ?></option>
                <option <?php echo (nullpoint_page_options_get_meta( 'nullpoint_post_allow_breadcrumbs' ) === 'yes' ) ? 'selected' : '' ?>><?php _e( 'yes', 'nullpoint' ); ?></option>
                <option <?php echo (nullpoint_page_options_get_meta( 'nullpoint_post_allow_breadcrumbs' ) === 'no' ) ? 'selected' : '' ?>><?php _e( 'no', 'nullpoint' ); ?></option>
            </select>
        </div>
	</div>
    <?php } ?>
    <div class="page-option-holder">
		<label for="nullpoint_top_padding" class="page-option-label"><?php _e( 'Top Padding in px', 'nullpoint' ); ?></label>
		<div class="page-option-content">
            <input name="nullpoint_top_padding" id="nullpoint_top_padding" value="<?php echo esc_attr((nullpoint_page_options_get_meta( 'nullpoint_top_padding'))); ?>">
        </div>
	</div>
    <div class="page-option-holder">
		<label for="nullpoint_bottom_padding" class="page-option-label"><?php _e( 'Bottom Padding in px', 'nullpoint' ); ?></label>
		<div class="page-option-content">
            <input name="nullpoint_bottom_padding" id="nullpoint_bottom_padding" value="<?php echo esc_attr((nullpoint_page_options_get_meta( 'nullpoint_bottom_padding'))); ?>">
        </div>
	</div>
<?php  }
endif;

function nullpoint_page_options_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['page_options_nonce'] ) || ! wp_verify_nonce( $_POST['page_options_nonce'], '_page_options_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	
	if ( isset( $_POST['nullpoint_basic_post_layer_select'] ) )
		update_post_meta( $post_id, 'nullpoint_basic_post_layer_select', sanitize_text_field( $_POST['nullpoint_basic_post_layer_select'] ) );
	if ( isset( $_POST['nullpoint_post_transparent_header'] ) )
		update_post_meta( $post_id, 'nullpoint_post_transparent_header', sanitize_text_field( $_POST['nullpoint_post_transparent_header'] ) );
	if (defined( 'FW' )) {
		if ( isset( $_POST['nullpoint_post_allow_breadcrumbs'] ) )
			update_post_meta( $post_id, 'nullpoint_post_allow_breadcrumbs', sanitize_text_field( $_POST['nullpoint_post_allow_breadcrumbs'] ) );
	}
	if ( isset( $_POST['nullpoint_top_padding'] ) )
		update_post_meta( $post_id, 'nullpoint_top_padding', sanitize_text_field( $_POST['nullpoint_top_padding'] ) );
	if ( isset( $_POST['nullpoint_bottom_padding'] ) )
		update_post_meta( $post_id, 'nullpoint_bottom_padding', sanitize_text_field( $_POST['nullpoint_bottom_padding'] ) );
		
}
add_action( 'save_post', 'nullpoint_page_options_save' );


/*********Post custom fields**************/
if ( ! function_exists ('nullpoint_post_options_get_meta') ):
function nullpoint_post_options_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}
endif;

if ( ! function_exists ('nullpoint_post_options_add_meta_box') ):
function nullpoint_post_options_add_meta_box() {
	add_meta_box(
		'post_options-post-options',
		__( 'Post Options', 'nullpoint' ),
		'nullpoint_post_options_html',
		'post',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'nullpoint_post_options_add_meta_box' );
endif;

if ( ! function_exists ('nullpoint_post_options_html') ):
function nullpoint_post_options_html( $post) {
	wp_nonce_field( '_post_options_nonce', 'post_options_nonce' ); 
	$nullpoint_basic_post_layer_select = nullpoint_post_options_get_meta( 'nullpoint_basic_post_layer_select');
	?>

    <div class="page-option-holder">
		<label for="nullpoint_basic_post_layer_select" class="page-option-label"><?php _e( 'Layout', 'nullpoint' ); ?></label>
		<div class="image_radio_button_control page-option-content">
            <label for="nullpoint_basic_post_layer_select_0" class="radio-button-label">
            	<input type="radio" name="nullpoint_basic_post_layer_select" id="nullpoint_basic_post_layer_select_0" value="default" <?php echo ( nullpoint_post_options_get_meta( 'nullpoint_basic_post_layer_select' ) === 'default' || empty($nullpoint_basic_post_layer_select)) ? 'checked' : ''; ?>>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/mb-default.png'); ?>" />
    		</label>
    		
            <label for="nullpoint_basic_post_layer_select_1" class="radio-button-label">
            	<input type="radio" name="nullpoint_basic_post_layer_select" id="nullpoint_basic_post_layer_select_1" value="1-col" <?php echo ( nullpoint_post_options_get_meta( 'nullpoint_basic_post_layer_select' ) === '1-col' ) ? 'checked' : ''; ?>>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/mb-1c.png'); ?>" />
   			</label>
    		
            <label for="nullpoint_basic_post_layer_select_2" class="radio-button-label">
            	<input type="radio" name="nullpoint_basic_post_layer_select" id="nullpoint_basic_post_layer_select_2" value="2-col-l" <?php echo ( nullpoint_post_options_get_meta( 'nullpoint_basic_post_layer_select' ) === '2-col-l' ) ? 'checked' : ''; ?>>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/mb-2cl.png'); ?>" />
			</label>
    		
            <label for="nullpoint_basic_post_layer_select_3" class="radio-button-label">
            	<input type="radio" name="nullpoint_basic_post_layer_select" id="nullpoint_basic_post_layer_select_3" value="2-col-r" <?php echo ( nullpoint_post_options_get_meta( 'nullpoint_basic_post_layer_select' ) === '2-col-r' ) ? 'checked' : ''; ?>>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/images/mb-2cr.png'); ?>" />
			</label>
		</div>
	</div>	
    <?php if (defined( 'FW' )) { ?>	
    <div class="page-option-holder">
		<label for="nullpoint_post_allow_breadcrumbs" class="page-option-label"><?php _e( 'Breadcrumbs', 'nullpoint' ); ?></label>
		<div class="page-option-content">
            <select name="nullpoint_post_allow_breadcrumbs" id="nullpoint_post_allow_breadcrumbs">
                <option <?php echo (nullpoint_post_options_get_meta( 'nullpoint_post_allow_breadcrumbs' ) === 'default' ) ? 'selected' : '' ?>><?php _e( 'default', 'nullpoint' ); ?></option>
                <option <?php echo (nullpoint_post_options_get_meta( 'nullpoint_post_allow_breadcrumbs' ) === 'yes' ) ? 'selected' : '' ?>><?php _e( 'yes', 'nullpoint' ); ?></option>
                <option <?php echo (nullpoint_post_options_get_meta( 'nullpoint_post_allow_breadcrumbs' ) === 'no' ) ? 'selected' : '' ?>><?php _e( 'no', 'nullpoint' ); ?></option>
            </select>
        </div>
	</div>
    <?php } ?>
    <div class="page-option-holder">
		<label for="nullpoint_post_nav" class="page-option-label"><?php _e( 'Post Nav', 'nullpoint' ); ?></label>
		<div class="page-option-content">
            <select name="nullpoint_post_nav" id="nullpoint_post_nav">
                <option <?php echo (nullpoint_post_options_get_meta( 'nullpoint_post_nav' ) === 'yes' ) ? 'selected' : '' ?>><?php _e( 'yes', 'nullpoint' ); ?></option>
                <option <?php echo (nullpoint_post_options_get_meta( 'nullpoint_post_nav' ) === 'no' ) ? 'selected' : '' ?>><?php _e( 'no', 'nullpoint' ); ?></option>
            </select>
        </div>
	</div>
<?php  }
endif;

function nullpoint_post_options_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['post_options_nonce'] ) || ! wp_verify_nonce( $_POST['post_options_nonce'], '_post_options_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	
	if ( isset( $_POST['nullpoint_basic_post_layer_select'] ) )
		update_post_meta( $post_id, 'nullpoint_basic_post_layer_select', sanitize_text_field( $_POST['nullpoint_basic_post_layer_select'] ) );
	if (defined( 'FW' )) {
		if ( isset( $_POST['nullpoint_post_allow_breadcrumbs'] ) )
			update_post_meta( $post_id, 'nullpoint_post_allow_breadcrumbs', sanitize_text_field( $_POST['nullpoint_post_allow_breadcrumbs'] ) );
	}
	if ( isset( $_POST['nullpoint_post_nav'] ) )
		update_post_meta( $post_id, 'nullpoint_post_nav', sanitize_text_field( $_POST['nullpoint_post_nav'] ) );
}
add_action( 'save_post', 'nullpoint_post_options_save' );