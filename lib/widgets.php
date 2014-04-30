<?php
// create widget areas: sidebar, footer
$sidebars = array('sidebar-1');
foreach ($sidebars as $sidebar) {
    register_sidebar(array(
    	'name'=> 'Sidebar 1',
    	'id' => 'sidebar-1',
        'before_widget' => '<article id="%1$s" class="panel widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
}
$sidebars = array('sidebar-2');
foreach ($sidebars as $sidebar) {
    register_sidebar(array(
    	'name'=> 'Sidebar 2',
    	'id' => 'sidebar-2',
        'before_widget' => '<article id="%1$s" class=" widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
}
$sidebars = array('Footer');
foreach ($sidebars as $sidebar) {
    register_sidebar(array(
    	'name'=> 'Footer',
    	'id' => 'footer',
        'before_widget' => '<li><article id="%1$s" class="panel widget %2$s">',
        'after_widget' => '</article></li>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));
}


// Front Page Template Sidebars. This will count the number of front page sidebars to enable dynamic classes for the home page
function display_sidebars()
{
     if (is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) )
     {
          echo 'medium-8 large-8 columns';     
     }
     elseif ( is_home() || is_single() ) {
	     echo 'medium-8 medium-centered large-8 large-centered columns';
     } 
}
?>