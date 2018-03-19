<?php
/**
 * The template for displaying Comments.
 *
 * @subpackage NullPoint
 * @since NullPoint 1.0
 */
?>

<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'nullpoint' ); ?></p>
</div><!-- #comments -->
	<?php
            /* Stop the rest of comments.php from being processed,
             * but don't kill the script entirely -- we still have
             * to fully load the template.
             */
            return;
        endif;
    ?>


<?php if ( have_comments() ) : ?>
    <h3 id="comments-title"><?php
        $comments_number = get_comments_number();
        if ( '1' === $comments_number ) {
            /* translators: %s: post title */
            printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'nullpoint' ), get_the_title() );
        } else {
            printf(
                /* translators: 1: number of comments, 2: post title */
                _nx(
                    '%1$s thought on &ldquo;%2$s&rdquo;',
                    '%1$s thoughts on &ldquo;%2$s&rdquo;',
                    $comments_number,
                    'comments title',
                    'nullpoint'
                ),
                number_format_i18n( $comments_number ),
                get_the_title()
            );
        }
    ?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			
<?php endif; // check for comment navigation ?>

    <ol class="commentlist">
        <?php
            /* Loop through and list the comments. Tell wp_list_comments()
             * to use nullpoint_comment() to format the comments.
             * If you want to overload this in a child theme then you can
             * define nullpoint_comment() and that will be used instead.
             */
            wp_list_comments( 
                array( 
                    'callback' => 'nullpoint_comment',
                    'avatar_size' => 80,
                ) 
            );
        ?>
    </ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<?php nullpoint_comment_nav(); ?>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'nullpoint' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php 
comment_form(array(
			'fields' => array(
				'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'nullpoint' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	            			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',
							
				'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'nullpoint'  ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
	            			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /></p>',
							
				'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'nullpoint'  ) . '</label>' .
	            			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
			),
			'title_reply' => __( 'Post a Comment', 'nullpoint'  ),
			'label_submit' => __( 'Submit', 'nullpoint'  ),
			'comment_notes_after' => ''
)); ?>
</div><!-- #comments -->