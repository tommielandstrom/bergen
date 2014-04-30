<?php 
/**
 * Template for comments and pingbacks.
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wpforge_comment(), and that function will be used instead.
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since WP-Forge 1.0
 */
if ( ! function_exists( 'wpforge_comment' ) ) :

function wpforge_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'felles' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'felles' ), '<span class="edit-link"><i class="fi-pencil"></i> ', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-body">
					<header class="comment-header clearfix">
						<?php echo get_avatar( $comment, 50); ?>
						<?php if ($comment->user_id) : ?>
							<h6 class="comment-title">
								<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
							</h6>
							<span class="post-author-label"><?php _e( 'Post author', 'felles' ); ?></span>							<br>			

						<?php edit_comment_link( __( 'Edit', 'felles' ), '<span class="comment-meta-item right"><i class="fi-pencil"></i> ','</span>' ); ?>
						<?php else : ?>
							<h6 class="comment-title" itemprop="author">
								<?php comment_author_link(); ?> 
							</h6>
						<?php edit_comment_link( __( 'Edit', 'felles' ), '<span class="comment-meta-item right"><i class="fi-pencil"></i> ','</span>' ); ?>
						<?php endif; ?>

						<div class="comment-meta post-meta" role="complementary">
							<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished">
								<?php
								// Credit http://css-tricks.com/forums/topic/wordpress-comments-time-ago-feature/
								
								if ( get_comment_time('U') > date('U') - 7*60*60*24 ) {
								echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . __( ' ago', 'felles' );
								} 
								
								elseif ( get_comment_date('Y') == date('Y') ) 
								{ echo _e( 'The ', 'felles' );
								{ comment_date('j F');}
								{ comment_time(' H:i');}
								}
								
								else {
								comment_date('j F Y');
								} ?>							
							</time>
						</div> <!-- .comment-meta -->
					</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'felles' ); ?></p>
			<?php endif; ?>

			<section class="comment-content" itemprop="text">
				<?php comment_text(); ?>
			</section><!-- .comment-content -->

			<footer class="comment-footer reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'felles' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</footer><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

?>