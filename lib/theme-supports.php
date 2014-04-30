<?php
/* 
==========================================================================
Theme supports
==========================================================================   
*/



if( ! function_exists( 'reverie_theme_support' ) ) {
    function reverie_theme_support() {
        // Add language supports.
        load_theme_textdomain('reverie', get_template_directory() . '/lang');
        
        // Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) ); // Only Posts and Pages     
        // Set thumbnail size
		//set_post_thumbnail_size(150, 150, false);
		// Add custom image to Foundation interchange for responsive images
		add_image_size('small-img', 640, 9999);
        add_image_size('medium-img', 1020, 9999);
        add_image_size('large-img', 1440, 9999);
        //add_image_size('xlarge-img', 1600, 9999);
        //add_image_size('xxlarge', 1600, 9999);

		add_theme_support( 'custom-header', array(
			'flex-width'   	 	=> true,
			'width'        	 	=> 1440,
			'flex-height'   	=> true,
			'height'        	=> 400,
			'default-image' 	=> '',
			'wp-head-callback'       => '',
		) );
		
		add_theme_support( 'custom-background' );
        // RSS
        add_theme_support('automatic-feed-links');
        
        //Switches default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery' ) );	
        
        add_theme_support( 'infinite-scroll', array(
		    'type'           => 'click',
		    'footer_widgets' => false,
		    'container'      => 'main',
		    'wrapper'        => true,
		    'render'         => 'felles_infinite_scroll_render',
		    'posts_per_page' => false,
		) );
		

        // Add post formats support. http://codex.wordpress.org/Post_Formats
        add_theme_support('post-formats', array(
        	'aside', 
        	'gallery', 
        	'link', 
        	'image', 
        	'quote', 
        	'status', 
        	'video', 
        	'audio', 
        	'chat'
        ) );

        // Add menu support. http://codex.wordpress.org/Function_Reference/register_nav_menus
        add_theme_support('menus');
        register_nav_menus(array(
            'primary' => __('Primary Navigation', 'reverie'),
            'footer' => __('Footer Navigation', 'reverie'),
            //'utility' => __('Utility Navigation', 'reverie')
        ));
        
		
		// This theme styles the visual editor to resemble the theme style
		add_editor_style( array( 'css/style.css' ) );

    }
}
add_action('after_setup_theme', 'reverie_theme_support'); /* end Reverie theme support */

/**
* Disable admin bar - it cocks up positionings of foundation tooltips & topbar menu
*/
show_admin_bar(false);

// Give infinite scroll the right folder
function felles_infinite_scroll_render() {
    while( have_posts() ) {
	    the_post();
	    get_template_part( '/content/content', get_post_format() );
    }
}

if ( ! isset( $content_width ) ) $content_width = 900;

?>