<?php
/**
 * NullPoint About Theme
 *
 * @package nullpoint
 */

//about theme info
add_action( 'admin_menu', 'nullpoint_about_theme' );
function nullpoint_about_theme() {  
	global $nullpoint_about_theme_page; 	
	$nullpoint_about_theme_page = add_theme_page( __('About Theme', 'nullpoint'), __('About Theme', 'nullpoint'), 'edit_theme_options', 'nullpoint_guide', 'nullpoint_guide');   
} 

//guidline for about theme
function nullpoint_guide() { 
?>

<div class="wrapper-info">
	<div class="col-left">
   		   <div class="about-title">
			  <h1><?php esc_html_e('About NullPoint Theme', 'nullpoint'); ?></h1>
		   </div>
           <p><?php esc_html_e('NullPoint - Multipurpose WordPress Theme is a responsive theme with all features You need. NullPoint has page builder, customizer options and demo content. Imagine Your website and build it with NullPoint. Build Your site with the highly customizable elements. If You would make something big, try NullPoint Pro with more elements and special functions.', 'nullpoint'); ?></p>
           <p><?php esc_html_e('If You want to know more about NullPoint, please read the', 'nullpoint'); ?> <a href="<?php echo esc_url(NULLPOINT_WEBZAKT_THEME_DOC); ?>" target="_blank"><?php esc_html_e('documentation', 'nullpoint'); ?></a>.</p>
           <h2><?php esc_html_e('How to use NullPoint', 'nullpoint'); ?></h2>
		  <p><?php esc_html_e('1. If You want to use all NullPoint features install and activate the 3 recommended plugins: Unyson, NullPoint Functions, Contact Form 7.', 'nullpoint'); ?></p>
          <p><?php esc_html_e('2. Install the Unyson extensions: Analytics, Backup & Demo Content, Sliders, Mega Menu, SEO, Page Builder, Sidebars, Breadcrumbs.', 'nullpoint'); ?></p>
          <p><?php esc_html_e('3. Install the demo contents at Tools -> Demo Content Install. (This step is optional.)', 'nullpoint'); ?></p>
          <p><?php esc_html_e('4. Use the customizer to setup Your site and build Your pages and blog posts with the page builder. If You prefer the default editor, You can call the NullPoint elements with the "editor shortcodes" button.', 'nullpoint'); ?></p>
          <p><?php esc_html_e('5. Have fun!', 'nullpoint'); ?></p>
          
          <h4><?php esc_html_e('If You need more info, please read the', 'nullpoint'); ?> <a href="<?php echo esc_url(NULLPOINT_WEBZAKT_THEME_DOC); ?>" target="_blank"><?php esc_html_e('documentation', 'nullpoint'); ?></a>. <?php esc_html_e('It contains videos with NullPoint in action.', 'nullpoint'); ?></h4><br />
           <h2><?php esc_html_e('About NullPoint Pro', 'nullpoint'); ?></h2>
          <p><?php esc_html_e('Do You want more? Extend NullPoint Theme! You can download', 'nullpoint'); ?> <a href="<?php echo esc_url(NULLPOINT_WEBZAKT_THEME_URL); ?>" target="_blank"><?php esc_html_e('NullPoint - Multipurpose WordPress Theme', 'nullpoint'); ?></a> <?php esc_html_e('pro version from Webzakt.', 'nullpoint'); ?></p>
          <div class="description free-and-pro"><a href="<?php echo esc_url(NULLPOINT_WEBZAKT_THEME_URL); ?>" class="webzakt-button webzakt-button-pro" target="_blank"><?php esc_html_e('More about Pro Version', 'nullpoint'); ?></a><a href="<?php echo esc_url(NULLPOINT_WEBZAKT_AUTHOR_URL); ?>" class="webzakt-button webzakt-button-more" target="_blank"><?php esc_html_e('More about Webzakt', 'nullpoint'); ?></a></div>
          <p><?php esc_html_e('Pro version includes above the lite features:', 'nullpoint'); ?></p>
          
          <h3><?php esc_html_e('Customizable Colors & Fonts, WooCommerce Plugin support with page builder elemnts, Events & Portfolio post types with page builder elemnts, Extra Widgets (Contact, Event, Flickr, Popular Posts, Quote), 4 Blog Style, Social share function, Animations, Nice sroll, Back to top, Sticky header, more Header styles, Countdown, Counter, Map-fullwidth, Member, Pricing-table, Progress, Tabs, Toggle, Calendar, Extra Post carousel and much more...', 'nullpoint'); ?></h3>
	</div><!-- .col-left -->
	
	<div class="col-right">			
			<div class="about-donate">
				<hr />
				<a href="<?php echo esc_url(NULLPOINT_WEBZAKT_THEME_URL); ?>" target="_blank"><?php esc_html_e('Demo', 'nullpoint'); ?></a> | 
				<a href="<?php echo esc_url(NULLPOINT_WEBZAKT_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'nullpoint'); ?></a> | 
				<a href="<?php echo esc_url(NULLPOINT_WEBZAKT_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'nullpoint'); ?></a>
                <div class="about-space"></div>
				<hr />
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" width="1200" height="900" style="max-width: 80%; height: inherit; padding: 10%;" />
            <div class="about-title">
				<?php esc_html_e('Credits', 'nullpoint'); ?>
            </div>
            <p><?php esc_html_e('I`ve used the following scripts as listed. See the source of the images in the documentation.', 'nullpoint'); ?></p>
                        
            <ul>
                <li><?php esc_html_e('Bootstrap', 'nullpoint'); ?></li>
                <li><?php esc_html_e('jQuery easing', 'nullpoint'); ?></li>
                <li><?php esc_html_e('prettyPhoto', 'nullpoint'); ?></li>
                <li><?php esc_html_e('Flexslider', 'nullpoint'); ?></li>
                <li><?php esc_html_e('OwlCarousel', 'nullpoint'); ?></li>
                <li><?php esc_html_e('Nivo Slider', 'nullpoint'); ?></li>
                <li><?php esc_html_e('jQuery Directional Hover', 'nullpoint'); ?></li>
                <li><?php esc_html_e('Font Awesome', 'nullpoint'); ?></li>
                <li><?php esc_html_e('Google Fonts', 'nullpoint'); ?></li>
                <li><?php esc_html_e('Unyson', 'nullpoint'); ?></li>
            </ul>
		</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>