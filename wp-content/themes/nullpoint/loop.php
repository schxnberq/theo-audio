<?php
/**
 * The loop that displays posts.
 *
 * @since NullPoint 1.0
 */
?>
<div id="npt-blog-normal-content">

<?php if (have_posts()) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<?php /* How to display all posts. */ 
	get_template_part( 'content', get_post_format() ); 
	?>
	<?php endwhile; // End the loop. Whew. ?>
    
	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php
    the_posts_pagination( array(
        'mid_size' => 2,
        'prev_text' => '<i class="fa fa-angle-double-left"></i>',
        'next_text' => '<i class="fa fa-angle-double-right"></i>',
    ) ); 
    
	else : ?>
	<article id="post-0" class="post error404 not-found">
		<h1 class="posttitle"><?php _e( 'Not Found', 'nullpoint'); ?></h1>
		<div class="entry">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'nullpoint'); ?></p>
			<?php get_search_form(); ?>
		</div>
	</article>
<?php endif; ?>
</div>
