<?php
/* ==========================================================================
   Navigation
   ========================================================================== */



// 
// Displays navigation to next/previous set of posts when applicable.
// @since Twenty Thirteen 1.0
// 
if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<i class="fi-arrow-left"></i> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <i class="fi-arrow-right"></i>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
		
	</nav><!-- .navigation -->
	<?php
}
endif;


// 
// Displays navigation to next/previous post when applicable.
// since Twenty Thirteen 1.0
// 
if ( ! function_exists( 'twentythirteen_post_nav' ) ) :

function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		
		<div class="nav-links">

			<div class="nav-previous" data-tooltip class="has-tip" title="Tooltips are awesome, you should totally use them!">
				<?php previous_post_link( '%link', _x( '<span class="meta-nav"><i class="fi-arrow-left"></i></span> Previous post', 'Previous post link', 'twentythirteen' ) ); ?>
			</div>
			
			<div class="nav-next">
				<?php next_post_link( '%link', _x( 'Next post <span class="meta-nav"><i class="fi-arrow-right"></i></span>', 'Next post link', 'twentythirteen' ) ); ?>
			</div>

		</div><!-- .nav-links -->
		
	</nav><!-- .navigation -->
	<?php
}
endif;


// Wp list page tree
// http://codex.wordpress.org/Function_Reference/wp_list_pages
if(!function_exists('get_post_top_ancestor_id')){
/**
 * Gets the id of the topmost ancestor of the current page. Returns the current
 * page's id if there is no parent.
 * 
 * @uses object $post
 * @return int 
 */
function get_post_top_ancestor_id(){
    global $post;
    
    if($post->post_parent){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    
    return $post->ID;
}}



/**
 * Link Pages
 * @author toscha
 * @link http://wordpress.stackexchange.com/questions/14406/how-to-style-current-page-number-wp-link-pages
 * @param  array $args
 * @return void
 * Modification of wp_link_pages() with an extra element to highlight the current page.
 */
function foundation_link_pages( $args = array () ) {
    $defaults = array(
        'before'      => '<ul class="pagination">',
        'after'       => '</ul>',
        'before_link' => '',
        'after_link'  => '',
        'current_before' => '',
        'current_after' => '',
        'link_before' => '',
        'link_after'  => '',
        'pagelink'    => '%',
        'echo'        => 1
    );
 
    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );
 
    global $page, $numpages, $multipage, $more, $pagenow;
 
    if ( ! $multipage )
    {
        return;
    }
 
    $output = $before;
 
    for ( $i = 1; $i < ( $numpages + 1 ); $i++ )
    {
        $j       = str_replace( '%', $i, $pagelink );
        $output .= ' ';
 
        if ( $i != $page || ( ! $more && 1 == $page ) )
        {
            $output .= "{$before_link}<li>" . _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a></li>{$after_link}";
        }
        else
        {
            $output .= "{$current_before}{$link_before}<li class='current'><a>{$j}</a></li>{$link_after}{$current_after}";
        }
    }
 
    print $output . $after;
}


//
// Pagination
//
if( ! function_exists( 'reverie_pagination' ) ) {
	function reverie_pagination() {
		global $wp_query;
	 
		$big = 999999999; // This needs to be an unlikely integer
	 
		// For more options and info view the docs for paginate_links()
		// http://codex.wordpress.org/Function_Reference/paginate_links
		$paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'mid_size' => 5,
			'prev_next' => True,
		    'prev_text' => __('<i class="fi-arrow-left"></i>'),
		    'next_text' => __('<i class="fi-arrow-right"></i>'),
			'type' => 'list'
		) );
	 
		// Display the pagination if more than one page is found
		if ( $paginate_links ) {
			echo '<div class="pagination-centered">';
			echo $paginate_links;
			echo '</div><!--// end .pagination -->';
		}
	}
}

// 
// A fallback when no navigation is selected by default, otherwise it throws some nasty errors in your face.
// From required+ Foundation http://themes.required.ch
// 
if( ! function_exists( 'reverie_menu_fallback' ) ) {
	function reverie_menu_fallback() {
		echo '<div class="alert-box alert">';
		// Translators 1: Link to Menus, 2: Link to Customize
	  	printf( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'reverie' ),
	  		sprintf(  __( '<a href="%s">Menus</a>', 'reverie' ),
	  			get_admin_url( get_current_blog_id(), 'nav-menus.php' )
	  		),
	  		sprintf(  __( '<a href="%s">Customize</a>', 'reverie' ),
	  			get_admin_url( get_current_blog_id(), 'customize.php' )
	  		)
	  	);
	  	echo '</div>';
	}
}




?>