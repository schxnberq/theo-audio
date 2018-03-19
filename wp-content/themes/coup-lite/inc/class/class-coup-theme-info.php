<?php
class coup_Theme_Info extends WP_Customize_Control {
	public function render_content() {
		$docs_url = 'https://themeskingdom.com/wordpress-themes/coup-architects-blog-portfolio-theme/';
		$demo_url = 'https://coup.tkdemos.com/'; ?>
		<div class="coup-theme-info">
			<?php
			printf( '<a href="'.esc_url( $docs_url ).'" target="_blank">%s</a>', esc_html__( 'View Documentation', 'coup' ) ); ?>
			<hr/>
			<?php
			printf( '<a href="'.esc_url( $demo_url ).'" target="_blank">%s</a>', esc_html__( 'View Demo', 'coup' ) ); ?>
		</div>
		<?php
	}
}
