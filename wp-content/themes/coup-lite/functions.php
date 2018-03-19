<?php
/**
 * coup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package coup
 */

if ( ! function_exists( 'coup_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function coup_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on coup, use a find and replace
	 * to change 'coup' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'coup', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Add excerpt functionality to pages
	 */
	add_post_type_support( 'page', 'excerpt' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'coup-single-post', 900 );
	add_image_size( 'coup-archive-sticky', 1000 );
	add_image_size( 'coup-archive', 450 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'coup' ),
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'video',
		'gallery',
		'quote',
		'link'
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 400,
		'height'      => 120,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * About page class
	 */
	require_once get_template_directory() . '/about-page/coup-lite-about-page.php';

	/*
	* About page instance
	*/

	$my_theme = wp_get_theme();
	$my_theme_themeslug = $my_theme->get_template();

	$config = array(
		// Menu name under Appearance.
		'menu_name'               => __( 'About Coup', 'coup' ),
		// Page title.
		'page_name'               => __( 'About Coup', 'coup' ),
		// Main welcome title
		/* translators: Heading for welcome to theme text */
		'welcome_title'         => sprintf( __( 'Welcome to %s!', 'coup' ), 'Coup Lite' ),
		// Main welcome content
		/* translators: Main text for welcome to theme text */
		'welcome_content'       => esc_html__( 'So, you’ve installed a free WordPress theme called Coup Lite. That’s great and we’re glad to have you with us. Coup Lite is fast, minimal, elegant, but you knew all this already. What you might not know: you can pay to upgrade to Coup (full) and Coup Shop. If you like Coup Lite then you’ll love the full Coup experience with 24/7 support.', 'coup' ),
		/**
		 * Tabs array.
		 *
		 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
		 * the will be the name of the function which will be used to render the tab content.
		 */
		'tabs'                    => array(
			'getting_started'  => __( 'Getting Started', 'coup' ),
			'free_pro'         => __( 'Why Upgrade?', 'coup' ),
			'changelog'        => __( 'Changelog', 'coup' ),
			//'child_themes'     => __( 'Demos','coup' ),
		),
		// Getting started tab
		'getting_started' => array(
			'first' => array (
				'title' => esc_html__( 'Read the Docs','coup' ),
				'text' => esc_html__( 'Read how to use and customize Coup Lite. Because reading is what? Fundamental.','coup' ),
				'button_label' => esc_html__( 'Read Coup Lite Docs','coup' ),
				'button_link' => 'https://help.themeskingdom.com/docs/coup-lite/',
				'is_button' => true,
				'recommended_actions' => true,
                'is_new_tab' => true
			),
			'second' => array(
				'title' => esc_html__( 'Customize','coup' ),
				'text' => esc_html__( 'Change how Coup Lite looks and works in the WordPress Customizer.','coup' ),
				'button_label' => esc_html__( 'Open Customizer','coup' ),
				'button_link' => esc_url( admin_url( 'customize.php' ) ),
				'is_button' => true,
				'recommended_actions' => false,
                'is_new_tab' => false
			),
			'third' => array(
				'title' => esc_html__( 'Upgrade to full Coup','coup' ),
				'text' => esc_html__( 'Get the full Coup experience. More customizations. Portfolio. Shop. 24/7 support. And more.','coup' ),
				'button_label' => esc_html__( 'Upgrade your experience','coup' ),
				'button_link' => esc_url( admin_url( 'themes.php?page=' . $my_theme_themeslug . '-welcome&tab=free_pro' ) ),
				'is_button' => true,
				'recommended_actions' => false,
                'is_new_tab' => true
			)
		),
		// Child themes array.
		'child_themes'            => array(
			'download_button_label' => esc_html__( 'Buy','coup' ),
			'preview_button_label'  => esc_html__( 'Preview','coup' ),
			'content'               => array(
				array(
					'title'         => 'Coup',
					'image'         => get_template_directory_uri() . '/assets/img/coup.png',
					'image_alt'     => 'Coup',
					'download_link' => 'https://themeskingdom.com/wordpress-themes/coup-architects-blog-portfolio-theme/?utm_source=coup_lite&utm_medium=pro_button',
					'preview_link'  => 'https://coup.tkdemos.com/',
				),
				array(
					'title'         => 'Coup Dark',
					'image'         => get_template_directory_uri() . '/assets/img/coup-dark.png',
					'image_alt'     => 'Coup Dark',
					'download_link' => 'https://themeskingdom.com/wordpress-themes/coup-architects-blog-portfolio-theme/?utm_source=coup_lite&utm_medium=pro_button',
					'preview_link'  => 'https://coup-dark.tkdemos.com/',
				),
				array(
					'title'         => 'Coup Shop',
					'image'         => get_template_directory_uri() . '/assets/img/coup-shop.png',
					'image_alt'     => 'Coup Shop',
					'download_link' => 'https://themeskingdom.com/wordpress-themes/coupshop-woocommerce-wordpress-theme/?utm_source=coup_lite&utm_medium=shop_button',
					'preview_link'  => 'https://coup-shop.tkdemos.com/',
				),
				array(
					'title'         => 'Coup Shop Dark',
					'image'         => get_template_directory_uri() . '/assets/img/coup-shop-dark.png',
					'image_alt'     => 'Coup Shop Dark',
					'download_link' => 'https://themeskingdom.com/wordpress-themes/coupshop-woocommerce-wordpress-theme/?utm_source=coup_lite&utm_medium=shop_button',
					'preview_link'  => 'https://coup-shop-2.tkdemos.com/',
				)

			),
		),
		// Free vs pro array.
		'free_pro'                => array(
			'free_theme_name'     => 'Coup Lite',
			'pro_theme_name'      => 'Coup',
			'shop_theme_name'      => 'Coup Shop',
			'pro_theme_link'      => 'https://themeskingdom.com/wordpress-themes/coup-architects-blog-portfolio-theme/?utm_source=coup_lite&utm_medium=pro_button',
			'shop_theme_link'      => 'https://themeskingdom.com/wordpress-themes/coupshop-woocommerce-wordpress-theme/?utm_source=coup_lite&utm_medium=shop_button',
			/* translators: text for Buy premium theme button */
			'get_pro_theme_label' => sprintf( __( 'Get %s!', 'coup' ), 'Coup' ),
			/* translators: text for Buy premium theme button */
			'get_shop_theme_label' => sprintf( __( 'Get %s!', 'coup' ), 'Coup Shop' ),
			'features'            => array(
				array(
					'title'       => __( 'Jetpack', 'coup' ),
					'description' => __( 'The most popular WordPress plugin.', 'coup' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'PSD files + Docs', 'coup' ),
					'description' => __( 'Photoshop files and full theme documentation.', 'coup' ),
					'is_in_lite'  => 'true',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Shuffle Layout', 'coup' ),
					'description' => __( 'The shuffle grid adds a randomized amount of space to your posts, letting them breathe.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Change Color', 'coup' ),
					'description' => __( 'You can change the colors of elements. You have unlimited options.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Change Fonts', 'coup' ),
					'description' => __( 'You can change the fonts. You have unlimited options.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Built-in Portfolio', 'coup' ),
					'description' => __( 'Showcase your best projects in the portfolio section.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Support', 'coup' ),
					'description' => __( 'Access to Fast, Full Support.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Change Credit Footer Link', 'coup' ),
					'description' => __( 'Remove "Theme: Coup Lite by Themes Kingdom" copyright from the footer.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Fullwidth Video Header', 'coup' ),
					'description' => __( 'Set your video in full size on the front page.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Fullwidth slider', 'coup' ),
					'description' => __( 'Make your slider fill the viewport.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'true',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Customizable Slider', 'coup' ),
					'description' => __( 'Customize every aspect of the slider.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'false',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Built-in Shop', 'coup' ),
					'description' => __( 'Start selling products with full WooCommerce compatibility.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'false',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Multiple Shop Layouts', 'coup' ),
					'description' => __( 'Stand out with more layout options for your online shop.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'false',
					'is_in_shop'   => 'true',
				),
				array(
					'title'       => __( 'Cart', 'coup' ),
					'description' => __( 'The ideal place for people to store your products before buying them.', 'coup' ),
					'is_in_lite'  => 'false',
					'is_in_pro'   => 'false',
					'is_in_shop'   => 'true',
				),
			),
		),
		// Required actions array.
		'recommended_actions'        => array(
			'install_label' => esc_html__( 'Install and Activate', 'coup' ),
			'activate_label' => esc_html__( 'Activate', 'coup' ),
			'deactivate_label' => esc_html__( 'Deactivate', 'coup' ),
			'content'            => array(
				'tk-companion' => array(
					'title'       => 'Jetpack',
					'description' => __( 'It is highly recommended that you install Jetpack to have access to the frontpage sections widgets.', 'coup' ),
					'check'       => defined( 'JETPACK' ),
					'plugin_slug' => 'Jetpack',
					'id' => 'jetpack'
				),
			),
		),
	);
	Coup_Lite_About_Page::init( $config );
}
endif;
add_action( 'after_setup_theme', 'coup_setup' );


// add css for hideing header text
function coup_header_style() {
	/*
	 * If header text is set to display, let's bail.
	 */
	if ( display_header_text() ) {
		return;
	} else {
	// If we get this far, we have custom styles. Let's do this.


		$add_data = '.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}';

		wp_add_inline_style( 'coup-style', $add_data );
	}
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function coup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'coup_content_width', 900 );
}
add_action( 'after_setup_theme', 'coup_content_width', 0 );

/**
 * Customize read more link.
 *
 * @link https://codex.wordpress.org/Customizing_the_Read_More
 */

function coup_read_more_link() {
    return '';
}
add_filter( 'the_content_more_link', 'coup_read_more_link' );


/**
 * disable sharedaddy and like buttons from standard place
 * they are added in single.php
 *
 */

function coup_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
}

add_action( 'loop_start', 'coup_remove_share' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function coup_widgets_init() {
	// Define sidebars
		$sidebars = array(
			'sidebar-1' => esc_html__( 'Sidebar', 'coup' ),
			'sidebar-2' => esc_html__( 'Footer Widgets 1', 'coup' ),
			'sidebar-3' => esc_html__( 'Footer Widgets 2', 'coup' )
		);

		// Loop through each sidebar and register
		foreach ( $sidebars as $sidebar_id => $sidebar_name ) {
			register_sidebar( array(
				'name'          => esc_html($sidebar_name),
				'id'            => esc_html($sidebar_id),
				/* translators: text for description of widget areas */
				'description'   => sprintf( esc_html__( 'Widget area for %s', 'coup' ), $sidebar_name ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			) );
		}
}
add_action( 'widgets_init', 'coup_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function coup_scripts() {

	// Google Fonts
	wp_enqueue_style( 'coup-font-enqueue', get_stylesheet_directory_uri() . '/assets/fonts/hk-grotesk/stylesheet.css');

	coup_header_style();

	// Style
	wp_enqueue_style( 'coup-style', get_stylesheet_uri() );

	// Scripts

	wp_enqueue_script( 'coup-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'coup-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'coup-slick', get_template_directory_uri() . '/js/slick.js', array(), '20151215', true );

	wp_enqueue_script( 'coup-mcustom-scrollbar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Main JS file
	wp_enqueue_script( 'coup-call-scripts', get_template_directory_uri() . '/js/common.js', array( 'jquery', 'masonry', 'thickbox' ), false, true );


}
add_action( 'wp_enqueue_scripts', 'coup_scripts' );


/**
 * One click demo import settings
 */
function coup_import_files() {
  return array(
    array(
      /* translators: import demo */
      'import_file_name'           => sprintf( __( '%s Demo', 'coup' ), 'Coup Lite' ),
      'import_file_url'            => get_template_directory_uri().'/import/coup-lite/content.xml',
      'import_widget_file_url'     => get_template_directory_uri().'/import/coup-lite/widgets.json',
      'import_customizer_file_url' => get_template_directory_uri().'/import/coup-lite/customizer.dat',
      'import_preview_image_url'   => get_template_directory_uri().'/import/coup-lite/screenshot.png',
      'import_notice'              => __( 'You can speed up development of your site by importing our sample site content like posts and images. The imported images are copyrighted and are for demo use only. Please replace them with your own images after importing.', 'coup' ),
    )
  );
}
add_filter( 'pt-ocdi/import_files', 'coup_import_files' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
