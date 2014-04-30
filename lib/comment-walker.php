<?php

//
// Comment Walker
//
	class comment_walker extends Walker_Comment {
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
		// constructor – wrapper for the comments list
		function __construct() { ?>
 
			<ol class="comments-list">
 
		<?php }
 
		// start_lvl – wrapper for child comments list
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
			
			<ol class="child-comments comments-list">
 
		<?php }
	
		// end_lvl – closing wrapper for child comments list
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
 
			</ol>
 
		<?php }
 
		// start_el – HTML for comment template
		function start_el( &$output, $object, $depth = 0, $args = Array(), $current_object_id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
	
			if ( 'article' == $args['style'] ) {
				$tag = 'article';
				$add_below = 'comment';
			} else {
				$tag = 'article';
				$add_below = 'comment';
			} ?>
 
			<li <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?>>
				<article class="comment-body" id="comment-<?php comment_ID() ?>" itemscope itemtype="http://schema.org/Comment">
					<header class="comment-header clearfix">
						<?php echo get_avatar( $comment, 50); ?>
						<?php if ($comment->user_id) : ?>
							<h6 class="comment-title">
								<a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a>
							</h6>
							<span class="post-author-label">Post Author</span>							<br>			

							<?php edit_comment_link('<span class="comment-meta-item right"><i class="fi-pencil"></i> Edit</span>','',''); ?>
						<?php else : ?>
							<h6 class="comment-title" itemprop="author">
								<?php comment_author_link(); ?> 
							</h6>
							<?php edit_comment_link('<span class="comment-meta-item right"><i class="fi-pencil"></i> Edit</span>','',''); ?>
						<?php endif; ?>

						<div class="comment-meta post-meta" role="complementary">
							<time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished">
								<?php
								// Credit http://css-tricks.com/forums/topic/wordpress-comments-time-ago-feature/
								
								if ( get_comment_time('U') > date('U') - 7*60*60*24 ) {
								echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' sedan';
								} 
								
								elseif ( get_comment_date('Y') == date('Y') ) 
								{ echo 'Den ';
								{ comment_date('j F');}
								{ comment_time(' H:i');}
								}
								
								else {
								comment_date('j F Y');
								} ?>							
							</time>
							<?php if ($comment->comment_approved == '0') : ?>
							<p class="comment-meta-item">Your comment is awaiting moderation.</p>
							<?php endif; ?>
						</div> <!-- .comment-meta -->
					</header>
				<div class="comment-content post-content" itemprop="text">
					<?php comment_text() ?>
					<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
 				</article>
			<hr>

		<?php }
 
		// end_el – closing HTML for comment template
		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
			</li>
 
		<?php }
 
		// destructor – closing wrapper for the comments list
		function __destruct() { ?>
 
			</ol>
		
		<?php }
 
	}
?>