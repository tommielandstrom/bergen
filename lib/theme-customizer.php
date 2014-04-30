<?php

/**
* WP-Forge Theme Customizer
* A Theme Customizer for WP-Forge. Adds the individual sections, settings, and controls to the theme customizer
*
* Built utilizing the following tutorials:
*
* @author Tom McFarlin (@tommcfarlin)
* @see http://wp.tutsplus.com/tutorials/theme-development/a-guide-to-the-wordpress-theme-customizer-what-it-is-why-it-benefits-us/
*
* @author Alex Mansfield (@alexmansfield)
* @see http://themefoundation.com/wordpress-theme-customizer/
*
* @author Slobodan Manic (@slobodanmanic)
* @see http://www.wpexplorer.com/theme-customizer-introduction/
*
* @author Devin Price (@devinsays)
* @see http://wptheming.com/2012/06/add-options-to-theme-customizer-default-sections/
*
* @since WP-Forge 5.2.2
*/

function wpforge_customizer( $wp_customize ) { // Begin WP-Forge Theme Customizer

// Remove the default sections because we are going to create our own
$wp_customize->remove_section('colors');
$wp_customize->remove_section('background_image');
$wp_customize->remove_control('display_header_text');
//$wp_customize->remove_section('sidebar-widgets-Sidebar2');
//$wp_customize->remove_section('sidebar-widgets-Footer');

// Change some of the defaults
$wp_customize->get_section('static_front_page')->priority = 180; 			// Changed priority so it shows at the end of the Theme Customizer
$wp_customize->get_section('nav')->priority = 30;					 		// Changed priority so it shows at the end of the Theme Customizer

// Change some sections titles


 
/*
 * OK, now we can start building our own theme customizer.
 */

	/* title_tagline */
		
			
	/* nav */
	
	// Top bar placement	
	$wp_customize->add_setting( 'top-bar-placement', array(
		'default'        => false,
	    )
	);
	$wp_customize->add_control( 'top-bar-placement', array(
	        'section' => 'nav',
	        'label' => __('Fixed top-bar', 'felles'),
	        'type' => 'checkbox',
	    )
	);
	
	/* header_image */

	// Custom header 		
	$wp_customize->add_setting( 'header_image_placement', array(
	        'default' => 'all',
	    )
	);
	$wp_customize->add_control( 'header_image_placement', array(
	        'section' 		=> 'header_image',
	        'label' 		=> __('Show header on: ', 'felles'),
	        'type' 			=> 'radio',
	        'priority'		=> '9',
	        'choices' 		=> array(
				        	'all' 				=> __('All pages', 'felles'),
				        	'front_page'		=> __('Frontpage', 'felles'),
	        ),
	    )
	);
	
	$wp_customize->add_setting( 'display_site_info', array(
		'default'        => true,
	    )
	);
	$wp_customize->add_control( 'display_site_info', array(
       'section' 		=> 'title_tagline',
       'label' 			=> 'Display site info',
       'type' 			=> 'checkbox',
       )    
	);			 


	/* header_image */

	// Theme settings
	
	$wp_customize->add_section('theme_settings', array(
        'title'    => __('Theme settings', 'felles'),
    ));
			
	$wp_customize->add_setting( 'foundation_clearing_gallery', array(
		'default'        => true,
	    )
	);
	$wp_customize->add_control( 'foundation_clearing_gallery', array(
       'section' 		=> 'theme_settings',
       'label' 			=> __('Foundation Clearing gallery', 'felles'),
       'type' 			=> 'checkbox',
       )    
	);			 

    // Copyright text to footer 
    $wp_customize->add_setting('wpforge_footer_text',array(
		'default' => '',
	));
	$wp_customize->add_control('wpforge_footer_text',array(
		'label' => __('Footer Text','felles'),
		'section' => 'theme_settings',
		'type' => 'text',
	));
		

}
add_action( 'customize_register', 'wpforge_customizer' ); // End WP-Forge Theme Customizer



?>