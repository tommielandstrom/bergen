<?php
/* ==========================================================================
   Post related functions
   ========================================================================== */

if ( ! function_exists( 'twentythirteen_entry_meta_header' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function felles_entry_meta_header() {

	// Entry date
	felles_entry_date();

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<li class="author vcard"><a class="" href="%1$s" title="%2$s" rel="author"><i class="fi-torso"></i>  %3$s</a></li>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'felles' ), get_the_author() ) ),
			get_the_author()
		);
	}
	
	// Comments	
	if ( comments_open() ) :
	  echo '<li>';
	  comments_popup_link( '<i class="fi-comments"></i> 0', '<i class="fi-comments"></i> 1 ', '<i class="fi-comments"></i> %', 'comments-link', 'Avaktiverat');
	  echo '</li>';
	endif;
	
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<li class="featured-post"><i class="fi-flag"></i> ' . __( 'Sticky', 'felles' ) . '</li>';

	if ( get_post_status() == 'private' ) {	echo '<li class="edit-link"><i class="fi-key"></i> private';}

	if ( post_password_required() ) {	echo '<li class="edit-link"><i class="fi-lock"></i> Password';	} 
	
}
endif;

if ( ! function_exists( 'felles_entry_meta_footer' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function felles_entry_meta_footer() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'felles' ) );
	if ( $categories_list ) {
		echo '<li class="categories-links"><i class="fi-folder"></i> ' . $categories_list . '</li>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'felles' ) );
	if ( $tag_list ) {
		echo '<li class="tags-links"><i class="fi-price-tag"></i> ' . $tag_list . '</li>';
	}

}
endif;

if ( ! function_exists( 'felles_entry_date' ) ) :

// 
// Prints HTML with date information for current post.
// 
// Create your own twentythirteen_entry_date() to override in a child theme.
// 
// @since Twenty Thirteen 1.0
// 
// @param boolean $echo Whether to echo the date. Default true.
// @return string The HTML-formatted post date.
// 
function felles_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'felles' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<li class="date"><a href="%1$s" title="%2$s" rel="bookmark"><i class="fi-clock"></i> <time class="entry-date" datetime="%3$s">%4$s</time></a></li>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'felles' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

//
// Add excerpt link: http://codex.wordpress.org/Function_Reference/the_excerpt
//
function felles_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __( "Read more", "felles" ) . '</a>';
}
add_filter( 'excerpt_more', 'felles_excerpt_more' );

//
// Add new excerpt length: http://stackoverflow.com/questions/4082662/multiple-excerpt-lengths-in-wordpress
//
class Excerpt {

  // Default length (by WordPress)
  public static $length = 55;

  // So you can call: my_excerpt('short');
  public static $types = array(
      'short' => 25,
      'regular' => 55,
      'long' => 100
    );

//
// Sets the length for the excerpt,
// then it adds the WP filter
// And automatically calls the_excerpt();
//
// @param string $new_length 
// @return void
// @author Baylor Rae'
//
  public static function length($new_length = 55) {
    Excerpt::$length = $new_length;

    add_filter('excerpt_length', 'Excerpt::new_length');

    Excerpt::output();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(Excerpt::$types[Excerpt::$length]) )
      return Excerpt::$types[Excerpt::$length];
    else
      return Excerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
    the_excerpt();
  }

}

// An alias to the class
function my_excerpt($length = 55) {
  Excerpt::length($length);
}


// 
// Custom display of get_time
// http://aext.net/2010/04/display-timeago-for-wordpress-if-less-than-24-hours/ 
// 
add_filter('the_time', 'timeago');

function timeago()
{
    global $post;

    $date = $post->post_date;

    $time = get_post_time('G', true, $post);

    $time_diff = time() - $time;

    if( $time_diff > 0 && $time_diff < 24*60*60 )
        $display = sprintf( __( '%s ago', 'felles' ), human_time_diff( $time ) );
    else
        $display = date(get_option('date_format'), strtotime($date) );

    return $display;
}

// 
// Remove .sticky from the post_class array (Thanks to required+ foundation and WPforge)
// 
function wpforge_filter_post_class( $classes ) {
    if ( ( $key = array_search( 'sticky', $classes ) ) !== false ) {
        unset( $classes[$key] );
        $classes[] = 'sticky-post';
    }
    return $classes;
}
add_filter( 'post_class', 'wpforge_filter_post_class', 20 );

//
// Change Private and Protected post prefix - 
// http://www.wpbeginner.com/wp-tutorials/how-to-change-private-and-protected-posts-prefix-in-wordpress/ 
//
function change_protected_title_prefix() {
    return '%s';
}
add_filter('protected_title_format', 'change_protected_title_prefix');

function change_private_title_prefix() {
    return '%s';
}
add_filter('private_title_format', 'change_private_title_prefix');


//
// Change Password protected post output
// Credit: https://codex.wordpress.org/Using_Password_Protection
//
function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    
    <input placeholder="' . __( "Password", "felles" ) . '" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit", "felles" ) . '" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );



?>