<?php
/**
 * Changelog
 *
 * @package coup
 */

$coup_lite = wp_get_theme( 'coup-lite' );

?>
<div class="coup-lite-tab-pane" id="changelog">

	<div class="coup-tab-pane-center">

		<h1>Coup Lite
		<?php
		if ( ! empty( $coup_lite['Version'] ) ) :
?>
 <sup id="coup-lite-theme-version"><?php echo esc_attr( $coup_lite['Version'] ); ?> </sup><?php endif; ?></h1>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$coup_lite_changelog = $wp_filesystem->get_contents( get_template_directory() . '/CHANGELOG.md' );
	$coup_lite_changelog_lines = explode( PHP_EOL, $coup_lite_changelog );
	foreach ( $coup_lite_changelog_lines as $coup_lite_changelog_line ) {
		if ( substr( $coup_lite_changelog_line, 0, 3 ) === '###' ) {
			echo '<hr /><h1>' . esc_html(substr( $coup_lite_changelog_line,3 ) ) . '</h1>';
		} else {
			echo wp_kses_post($coup_lite_changelog_line) . '<br/>';
		}
	}

	?>

</div>
