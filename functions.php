<?php
/* ==========================================================================
   Function index
   ========================================================================== */

require_once('lib/clean.php'); 									// Clean up
require_once('lib/scripts.php');								// Scripts and stylesheets
require_once('lib/theme-supports.php' );						// Add theme-supports
require_once('lib/theme-customizer.php');						// Foundation Clearing Gallery
require_once('lib/nav-walker.php');								// Navigation
require_once('lib/widgets.php' );								// Widgets
require_once('lib/template-tags.php'); 							// Random shit
require_once('lib/navigation.php'); 							// Random shit
require_once('lib/image.php'); 									// Random shit
require_once('lib/comments.php'); 									// Random shit

// Plugins

if( get_theme_mod( 'foundation_clearing_gallery' ) ) { 
	require_once('lib/clearing-gallery.php');					// Foundation Clearing Gallery
} // end if 


?>
