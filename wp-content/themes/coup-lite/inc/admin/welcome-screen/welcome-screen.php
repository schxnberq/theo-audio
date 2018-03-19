<?php
/**
 * Welcome Screen Class
 */
class coup_Welcome {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'coup_lite_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'coup_lite_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'coup_lite_welcome_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'coup_lite_welcome_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'coup_lite_welcome', array( $this, 'coup_lite_welcome_getting_started' ), 	    10 );
		add_action( 'coup_lite_welcome', array( $this, 'coup_lite_welcome_child_themes' ), 		    30 );
		add_action( 'coup_lite_welcome', array( $this, 'coup_lite_welcome_changelog' ),             50 );
		add_action( 'coup_lite_welcome', array( $this, 'coup_lite_welcome_free_pro' ), 				60 );

		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_coup_lite_dismiss_required_action', array( $this, 'coup_lite_dismiss_required_action_callback') );
		add_action( 'wp_ajax_nopriv_coup_lite_dismiss_required_action', array($this, 'coup_lite_dismiss_required_action_callback') );

	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.8.2.4
	 */
	public function coup_lite_welcome_register_menu() {
		add_theme_page( 'About Coup Lite', 'About Coup Lite', 'activate_plugins', 'coup-welcome', array( $this, 'coup_lite_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.8.2.4
	 */
	public function coup_lite_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'coup_lite_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 1.8.2.4
	 */
	public function coup_lite_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<?php /* translators: text for instaling theme */ ?>
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Coup Lite! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'coup' ), '<a href="' . esc_url( admin_url( 'themes.php?page=coup-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=coup-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _esc_html_e( 'Get started with Coup Lite', 'coup' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 * @since  1.8.2.4
	 */
	public function coup_lite_welcome_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_coup-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'coup-welcome-screen-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome.css' );
			wp_enqueue_script( 'coup-welcome-screen-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome.js', array('jquery') );

			global $coup_required_actions;

			$nr_actions_required = 0;

			/* get number of required actions */
			if( get_option('coup_show_required_actions') ):
				$coup_show_required_actions = get_option('coup_show_required_actions');
			else:
				$coup_show_required_actions = array();
			endif;

			if( !empty($coup_required_actions) ):
				foreach( $coup_required_actions as $coup_required_action_value ):
					if(( !isset( $coup_required_action_value['check'] ) || ( isset( $coup_required_action_value['check'] ) && ( $coup_required_action_value['check'] == false ) ) ) && ((isset($coup_show_required_actions[$coup_required_action_value['id']]) && ($coup_show_required_actions[$coup_required_action_value['id']] == true)) || !isset($coup_show_required_actions[$coup_required_action_value['id']]) )) :
						$nr_actions_required++;
					endif;
				endforeach;
			endif;

			wp_localize_script( 'coup-welcome-screen-js', 'coupLiteWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','coup' )
			) );
		}
	}

	/**
	 * Load scripts for customizer page
	 * @since  1.8.2.4
	 */
	public function coup_lite_welcome_scripts_for_customizer() {

		wp_enqueue_style( 'coup-welcome-screen-customizer-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'coup-welcome-screen-customizer-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome_customizer.js', array('jquery'), '20120206', true );

		global $coup_required_actions;

		$nr_actions_required = 0;

		/* get number of required actions */
		if( get_option('coup_show_required_actions') ):
			$coup_show_required_actions = get_option('coup_show_required_actions');
		else:
			$coup_show_required_actions = array();
		endif;

		if( !empty($coup_required_actions) ):
			foreach( $coup_required_actions as $coup_required_action_value ):
				if(( !isset( $coup_required_action_value['check'] ) || ( isset( $coup_required_action_value['check'] ) && ( $coup_required_action_value['check'] == false ) ) ) && ((isset($coup_show_required_actions[$coup_required_action_value['id']]) && ($coup_show_required_actions[$coup_required_action_value['id']] == true)) || !isset($coup_show_required_actions[$coup_required_action_value['id']]) )) :
					$nr_actions_required++;
				endif;
			endforeach;
		endif;

		wp_localize_script( 'coup-welcome-screen-customizer-js', 'coupLiteWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=coup-welcome#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
		) );
	}

	/**
	 * Dismiss required actions
	 * @since 1.8.2.4
	 */
	public function coup_lite_dismiss_required_action_callback() {

		global $coup_required_actions;
		$coup_dismiss_id = isset($_GET['dismiss_id']) ? sanitize_text_field(wp_unslash($_GET['dismiss_id'])) : 0;

		echo esc_attr($coup_dismiss_id); /* this is needed and it's the id of the dismissable required action */

		if( !empty($coup_dismiss_id) ):

			/* if the option exists, update the record for the specified id */
			if( get_option('coup_show_required_actions') ):

				$coup_show_required_actions = get_option('coup_show_required_actions');

				$coup_show_required_actions[$coup_dismiss_id] = false;

				update_option( 'coup_show_required_actions',$coup_show_required_actions );

			/* create the new option,with false for the specified id */
			else:

				$coup_show_required_actions_new = array();

				if( !empty($coup_required_actions) ):

					foreach( $coup_required_actions as $coup_required_action ):

						if( $coup_required_action['id'] == $coup_dismiss_id ):
							$coup_show_required_actions_new[$coup_required_action['id']] = false;
						else:
							$coup_show_required_actions_new[$coup_required_action['id']] = true;
						endif;

					endforeach;

				update_option( 'coup_show_required_actions', $coup_show_required_actions_new );

				endif;

			endif;

		endif;

		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 * @since 1.8.2.4
	 */
	public function coup_lite_welcome_screen() {

		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>

		<ul class="coup-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started','coup'); ?></a></li>
			<li role="presentation"><a href="#free_pro" aria-controls="free_pro" role="tab" data-toggle="tab"><?php esc_html_e( 'Free VS PRO','coup'); ?></a></li>
			<li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Changelog','coup'); ?></a></li>

			<li role="presentation"><a href="#child_themes" aria-controls="child_themes" role="tab" data-toggle="tab"><?php esc_html_e( 'Child themes','coup'); ?></a></li>
		</ul>

		<div class="coup-tab-content">

			<?php do_action( 'coup_lite_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Changelog
	 *
	 */
	public function coup_lite_welcome_changelog() {
		get_template_part( '/inc/admin/welcome-screen/sections/changelog' );
	}
}

$GLOBALS['coup_Welcome'] = new coup_Welcome();
