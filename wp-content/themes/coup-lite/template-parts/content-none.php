<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package coup
 */

?>

<section class="no-results not-found container container-small">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'coup' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			/* translators: no posts text for admins */ ?>
			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'coup' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p>
				<?php esc_html_e( 'There’s nothing to be found here.', 'coup' ); ?>
				<a href="<?php echo esc_url( home_url()); ?>"><?php esc_html_e( 'Go back home', 'coup' ); ?></a>
				<?php esc_html_e( ' and try your luck there.', 'coup' ); ?>
			</p>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
