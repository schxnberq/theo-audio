<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coup
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
		if ( is_active_sidebar( 'sidebar-2' ) or is_active_sidebar( 'sidebar-3' ) ) { ?>

			<div class="footer-widget-holder container">
				<?php coup_footer_widgets(); ?>
			</div>

		<?php

		} ?>


		<div class="site-info">
			<a href="<?php echo 'https://wordpress.org/'; ?>">
				<?php echo esc_html__('Proudly powered by WordPress', 'coup'); ?>
			</a>
			<span class="sep"><?php echo esc_html__(' - ', 'coup'); ?></span>
			<a href="<?php echo 'https://themeskingdom.com/'; ?>" target="_blank">
				<?php echo esc_html__('Theme: Coup Lite by Themes Kingdom', 'coup'); ?>
			</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<span class="overlay"></span>
<button class="back-to-top hide"><i class="icon-top"></i></button>
<?php wp_footer(); ?>

</body>
</html>
