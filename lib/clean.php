<?php
/* ==========================================================================
   Function index
   ========================================================================== */


// start all the functions
add_action('after_setup_theme','reverie_startup');

if( ! function_exists( 'reverie_startup ' ) ) {
	function reverie_startup() {

	    // launching operation cleanup
	    add_action('init', 'reverie_head_cleanup');
	    // remove WP version from RSS
	    add_filter('the_generator', 'reverie_rss_version');
	    // remove pesky injected css for recent comments widget
	    add_filter( 'wp_head', 'reverie_remove_wp_widget_recent_comments_style', 1 );
	    // clean up comment styles in the head
	    add_action('wp_head', 'reverie_remove_recent_comments_style', 1);

	    // enqueue base scripts and styles
	    add_action('wp_enqueue_scripts', 'reverie_scripts_and_styles', 999);
	    // ie conditional wrapper
	    add_filter( 'style_loader_tag', 'reverie_ie_conditional', 10, 2 );
	    // clean up gallery output in wp
	    add_filter('gallery_style', 'reverie_gallery_style');

	    // additional post related cleaning
	    //add_filter( 'img_caption_shortcode', 'reverie_cleaner_caption', 10, 3 );
	   // add_filter('get_image_tag_class', 'reverie_image_tag_class', 0, 4);
	    //add_filter('get_image_tag', 'reverie_image_editor', 0, 4);
	    add_filter( 'the_content', 'reverie_img_unautop', 30 );

	} /* end reverie_startup */
}


/**********************
WP_HEAD GOODNESS
The default WordPress head is
a mess. Let's clean it up.

Thanks for Bones
http://themble.com/bones/
**********************/

if( ! function_exists( 'reverie_head_cleanup ' ) ) {
	function reverie_head_cleanup() {
		// category feeds
		// remove_action( 'wp_head', 'feed_links_extra', 3 );
		// post and comment feeds
		// remove_action( 'wp_head', 'feed_links', 2 );
		// EditURI link
		remove_action( 'wp_head', 'rsd_link' );
		// windows live writer
		remove_action( 'wp_head', 'wlwmanifest_link' );
		// index link
		remove_action( 'wp_head', 'index_rel_link' );
		// previous link
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
		// start link
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
		// links for adjacent posts
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
		// WP version
		remove_action( 'wp_head', 'wp_generator' );
	  // remove WP version from css
	  add_filter( 'style_loader_src', 'reverie_remove_wp_ver_css_js', 9999 );
	  // remove Wp version from scripts
	  add_filter( 'script_loader_src', 'reverie_remove_wp_ver_css_js', 9999 );

	} /* end head cleanup */
}

// remove WP version from RSS
if( ! function_exists( 'reverie_rss_version ' ) ) {
	function reverie_rss_version() { return ''; }
}

// remove WP version from scripts
if( ! function_exists( 'reverie_remove_wp_ver_css_js ' ) ) {
	function reverie_remove_wp_ver_css_js( $src ) {
	    if ( strpos( $src, 'ver=' ) )
	        $src = remove_query_arg( 'ver', $src );
	    return $src;
	}
}

// remove injected CSS for recent comments widget
if( ! function_exists( 'reverie_remove_wp_widget_recent_comments_style ' ) ) {
	function reverie_remove_wp_widget_recent_comments_style() {
	   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
	      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
	   }
	}
}
// remove injected CSS from gallery
if( ! function_exists( 'reverie_gallery_style ' ) ) {
	function reverie_gallery_style($css) {
	  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
	}
}	    

// remove injected CSS from recent comments widget
if( ! function_exists( 'reverie_remove_recent_comments_style ' ) ) {
	function reverie_remove_recent_comments_style() {
	  global $wp_widget_factory;
	  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
	    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	  }
	}
}



?>