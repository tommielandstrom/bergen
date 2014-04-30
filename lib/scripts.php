<?php
/*********************
Enqueue the proper CSS
if you use Sass.
*********************/
if( ! function_exists( 'reverie_enqueue_style' ) ) {
	function reverie_enqueue_style()
	{
		// foundation stylesheet
		wp_register_style( 'reverie-foundation-stylesheet', get_stylesheet_directory_uri() . '/css/app.css', array(), '' );

		// Register the main style
		wp_register_style( 'reverie-stylesheet', get_stylesheet_directory_uri() . '/css/style.css', array(), '', 'all' );
		
		wp_enqueue_style( 'reverie-foundation-stylesheet' );
		wp_enqueue_style( 'reverie-stylesheet' );
		
	}
}
add_action( 'wp_enqueue_scripts', 'reverie_enqueue_style' );


/**********************
Enqueue CSS and Scripts
**********************/

// loading modernizr and jquery, and reply script
if( ! function_exists( 'reverie_scripts_and_styles ' ) ) {
	function reverie_scripts_and_styles() {
	  if (!is_admin()) {

	    // modernizr (without media query polyfill)
	    wp_register_script( 'reverie-modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.2', false );

	    // register Google font
	    wp_register_style('google-font', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Lora:400,700|Droid+Sans+Mono');

	    // ie-only style sheet
	    wp_register_style( 'reverie-ie-only', get_template_directory_uri() . '/css/ie.css', array(), '' );

	    // comment reply script for threaded comments
	    if( get_option( 'thread_comments' ) )  { wp_enqueue_script( 'comment-reply' ); }
	    
	    // adding Foundation scripts file in the footer
	    wp_register_script( 'reverie-js', get_template_directory_uri() . '/js/foundation.min.js', array( 'jquery' ), '', true );

		wp_register_script( 'app-js', get_template_directory_uri() . '/js/app.min.js', array( 'jquery' ), '', true );

    
	    global $is_IE;
	    if ($is_IE) {
	       wp_register_script ( 'html5shiv', "http://html5shiv.googlecode.com/svn/trunk/html5.js" , false, true);
	    }

	    // enqueue styles and scripts
	    wp_enqueue_script( 'reverie-modernizr' );
	    wp_enqueue_style( 'google-font' );
	    wp_enqueue_style('reverie-ie-only');
	    /*
	    I recommend using a plugin to call jQuery
	    using the google cdn. That way it stays cached
	    and your site will load faster.
	    */
	    wp_enqueue_script( 'jquery' );

	    wp_enqueue_script( 'reverie-js' );
	    wp_enqueue_script( 'app-js' );
	    wp_enqueue_script( 'html5shiv' );

	  }
	}
}

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
if( ! function_exists( 'reverie_ie_conditional ' ) ) {
	function reverie_ie_conditional( $tag, $handle ) {
		if ( 'reverie-ie-only' == $handle )
			$tag = '<!--[if lt IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
		return $tag;
	}
}

?>
