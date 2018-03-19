<?php
/**
 * Get Started Dashboard
 * @package Teletype
 */

class Teletype_Welcome {

	public $minimum_capability = 'manage_options';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menus' ) );
		add_action( 'load-themes.php', array( $this, 'teletype_activation_admin_notice' ) );
	}

	/**
	 * Adds admin notice
	 */
	public function teletype_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'teletype_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display admin notice
	 */
	public function teletype_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
			<p><strong><?php echo esc_html__( 'Thanks for choosing Teletype!', 'teletype' ); ?></strong></p>
			<p><?php echo sprintf( esc_html__( 'You can get short installation instructions on the %1$swelcome screen%2$s.', 'teletype' ), '<a href="' . esc_url( admin_url( 'themes.php?page=teletype-about' ) ) . '">', '</a>' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=teletype-about' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Welcome!', 'teletype' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Register the Theme Pages which are later hidden but these pages
	 * are used to render the Welcome and subpages.
	 */
	public function admin_menus() {
		add_theme_page(
			__( 'Teletype Theme', 'teletype' ),
			__( 'Teletype Theme', 'teletype' ),
			$this->minimum_capability,
			'teletype-about',
			array( $this, 'about_screen' )

		);
	}

	/**
	 * Render About Screen
	 */
	public function about_screen() {
			// Get theme version
			$theme_data = wp_get_theme();
			$theme_version = $theme_data->get( 'Version' );
			$theme_name = $theme_data->get( 'Name' ); ?>

		<div class="wrap">
			<h2><?php echo $theme_name; ?> <?php _e( 'Theme', 'teletype' ); ?> v<?php echo $theme_version; ?></h2>
			<p class="about-description"><?php _e( 'Thank you for choosing Teletype WordPress theme for your website!', 'teletype' ); ?></p>

		    <div class="welcome-panel">
		        <div class="welcome-panel-content">

			<h3><?php _e( 'Welcome to', 'teletype' ); ?> <?php echo $theme_name; ?>!</h3>

			<div class="about-description">
				<?php _e( 'Here are some links to get you started and optional theme-setup tasks:', 'teletype' ); ?>
			</div>

				<div class="welcome-panel-column-container">

					<div class="welcome-panel-column">
						
						

				<?php if ( 'posts' == get_option( 'show_on_front' ) && get_option( 'page_on_front' ) ) : ?>
				<h4><?php _e( 'Get Started', 'teletype' ); ?></h4>
						<p><?php _e( 'Set your Front page, go to', 'teletype' ); ?> <a href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>"><?php _e( 'Front page displays', 'teletype' ); ?></a></p>
				<?php endif; ?>

				<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
				<h4><?php _e( 'Get Started', 'teletype' ); ?></h4>
						<p><?php _e( 'Set you Posts page, go to', 'teletype' ); ?> <a href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>"><?php _e( 'Front page displays', 'teletype' ); ?></a></p>
				<?php endif; ?>

				<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_on_front' ) ) : ?>
				<h4><?php _e( 'Get Started', 'teletype' ); ?></h4>
						<p><?php _e( 'Set your Front page, go to', 'teletype' ); ?> <a href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>"><?php _e( 'Front page displays', 'teletype' ); ?></a></p>
				<?php endif; ?>

				<?php if ( 'posts' == get_option( 'show_on_front' ) && ! get_option( 'page_on_front' ) ) : ?>
				<h4><?php _e( 'Get Started', 'teletype' ); ?></h4>
						<p><?php _e( 'To select page as Front page you will need to create a new page, go to ', 'teletype' ); ?><a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=page' ) ); ?>"><?php _e( 'Add New Page', 'teletype' ); ?></a></p>
				<?php endif; ?>

				<?php if ( !has_nav_menu('primary') ) : ?>
				<h4><?php _e( 'Get Started', 'teletype' ); ?></h4>
						<p><?php _e( 'Set you ', 'teletype' ); ?><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php _e( 'main Menu', 'teletype' ); ?></a></p>
				<?php endif; ?>

						<h4><?php _e( 'Get More Features', 'teletype' ); ?></h4>

						<p><?php _e( 'Get more features and personal support by email with premium version Teletype&nbsp;Plus!', 'teletype' ); ?></p>
						<p><a href="<?php echo esc_url( 'http://dinevthemes.com/themes/teletype-plus/' ); ?>" class="button button-primary" target="blank"><?php _e( 'Get Premium', 'teletype' ); ?></a></p>

					</div>

					<div class="welcome-panel-column">

						<h4><?php _e( 'Next Steps', 'teletype' ); ?></h4>
						
						<p><?php _e( 'Teletype offers custom widgets that are marked Teletype, go to ', 'teletype' ); ?><a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php _e( 'Manage widgets', 'teletype' ); ?></a></p>


					<?php if ( current_user_can( 'customize' ) ): ?>
						<p><?php _e( 'Using the WordPress Customizer you can tweak appearance.', 'teletype' ); ?></p>
						<p><a href="<?php echo wp_customize_url(); ?>" class="button"><?php esc_html_e( 'Customize', 'teletype' ); ?></a></p>
					<?php endif; ?>

					</div>

				</div>

	                        </div><!-- .welcome-panel-content -->
	                    </div>

		</div><!-- .wrap -->

		<?php
	} // about_screen
	
}
new Teletype_Welcome();