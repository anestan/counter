<?php
/**
 * The template for displaying comments
 *
 * @package Counter
 */

/*
 * If current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One Comment', '%s Comments', get_comments_number(), 'Comments title', 'counter' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h3>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => '96',
				) );
			?>
		</ul><!-- .comment-list -->

		<?php counter_comment_navigation(); ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'counter' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array(
		'title_reply'       => __( 'Leave a Comment', 'counter' ),
		'title_reply_to'    => __( 'Reply to %s', 'counter' ),
		'cancel_reply_link' => __( 'Cancel', 'counter' ),
		'label_submit'      => __( 'Submit Comment', 'counter' ),
		'class_submit'      => 'submit btn btn-default',
	) ); ?>

</div><!-- #comments -->
