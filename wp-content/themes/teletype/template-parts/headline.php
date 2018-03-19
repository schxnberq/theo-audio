<?php
/**
 * Template part for displaying headline section.
 *
 * @package Teletype
 */
?>

<?php
	// Set header Image
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'teletype-header' );

	if( !is_singular() ) {
		$bgimage = get_header_image();
	}
	if( is_singular() && $thumbnail ) {
		$bgimage = $thumbnail[0];
	}
	if( is_singular() && !$thumbnail ) {
		$bgimage = get_header_image();
	}
	if( is_page_template( 'templates/landing-page.php' ) ) {
		$bgimage = $thumbnail[0];
	}
	if ( is_home() && ! get_theme_mod( 'blog-headline-content' ) && empty( $bgimage ) || is_front_page() && ! get_theme_mod( 'headline-text' ) && empty( $bgimage ) ) {
		$class = ' space';
	}

	if( is_singular( array( 'post', 'portfolio' ) ) && !is_active_sidebar( 'sidebar-post' ) || !is_front_page() && is_singular( 'page' ) && !is_active_sidebar( 'sidebar-page' ) ) :
?>

	<!-- Headline Section -->
	<section id="headline" class="text-center"<?php teletype_header_bg(); ?>>
        <div class="head-content">
            			<?php the_title( '<h1>', '</h1><hr>' ); ?>
            			<?php if ( has_excerpt() ) : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
        </div>
	<span class="overlay-white"></span>
    </section>
<?php
	endif;

	if( is_singular( array( 'post', 'portfolio' ) ) && is_active_sidebar( 'sidebar-post' ) || !is_front_page() && is_singular( 'page' ) && is_active_sidebar( 'sidebar-page' ) ) : ?>

	<!-- Headline Section -->
	<section id="headline"<?php teletype_header_bg(); ?>>
		<div class="container caption-wrapper">
			<?php if ( has_excerpt() ) : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
			<div class="single-caption">
				<?php the_title( '<h1>', '</h1>' ); ?>
			</div>
        </div>
		<span class="overlay-white"></span>
    </section>
<?php
	endif;
	// Front Display
	if( is_front_page() ) : ?>
	<!-- Headline Section -->
	<section id="headline" class="text-center<?php if( !empty( $class ) ) { echo esc_html( $class ); } ?>"<?php teletype_header_bg(); ?>>
        <div class="head-content">
			<?php echo do_shortcode( wp_kses_post( get_theme_mod( 'headline-text' ) ) ); ?>
        </div>
		<span class="overlay-white"></span>
    </section>
<?php
	endif;
	// Blog Page
	if( !is_front_page() && is_home() ) : ?>
	<!-- Headline Section -->
	<section id="headline" class="text-center<?php if( !empty( $class ) ) { echo esc_html( $class ); } ?>"<?php teletype_header_bg(); ?>>
        <div class="head-content">
			<?php echo do_shortcode( wp_kses_post( get_theme_mod( 'blog-headline-content' ) ) ); ?>
        </div>
		<span class="overlay-white"></span>
    </section>
<?php
	endif;
	// Not Found
	if( is_404() ) : ?>
	<!-- Headline Section -->
	<section id="headline" class="text-center"<?php teletype_header_bg(); ?>>
        <div class="head-content">
            	<h1><?php esc_html_e( 'Error 404', 'teletype' ); ?></h1>
            	<hr>
            	<p class="lead"><?php esc_html_e( 'Oops! That page cant be found.', 'teletype' ); ?></p>
        </div>
		<span class="overlay-white"></span>
    </section>
<?php
	endif;

	if( is_attachment() ) : ?>

	<section id="headline" class="text-center"<?php teletype_header_bg(); ?>>
        <div class="head-content">
            	<?php the_title( '<h1>', '</h1><hr>' ); ?>
            	<?php if ( has_excerpt() ) : ?>
				<?php the_excerpt(); ?>
				<?php endif; ?>
        </div>
		<span class="overlay-white"></span>
    </section>
<?php
	endif; ?>