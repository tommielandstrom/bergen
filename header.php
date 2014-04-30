<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?> "> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

	<!-- Mobile viewport optimized: j.mp/bplateviewport -->
	<meta name="viewport" content="width=device-width" />

	<?php get_template_part('/inc/favicon'); ?>

	<link href='http://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>

	<?php wp_head(); ?>

</head>

	<!-- Anchor link to top-->

<body id="page #top" <?php body_class('antialiased hfeed site'); ?>>

	<!--[if lt IE 8]>
	<div class="alert alert-warning">
	  <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
	</div>
	<![endif]-->
		
	<?php get_template_part('/inc/top-bar'); ?>
		
	<header>
	
		<?php if( get_theme_mod( 'header_image_placement' ) == 'all') { ?>
		
		<?php get_template_part('/inc/site-cover'); ?>
		
		<?php } if( get_theme_mod( 'header_image_placement' ) == 'front_page') { if(is_front_page()) { ?>
		
		<?php get_template_part('/inc/site-cover'); ?>
		
		<?php } else { ?>
		
		<div class="site-cover">
		
			<?php interchange_post_header(); ?>
		
		</div>
		
		<?php } } ?> 
		
	</header>	
	
	<!-- Load Yoast breadcrumbs -->
	<?php if ( !is_front_page() && function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<nav class="nav-breadcrumbs"><div class="row"><div class="large-12 columns"><div class="yoast-breadcrumbs">','</div></div></div></nav>'); }?>
	
	
	<!-- Start the main section -->
	<section class="site-content">
		<div class="row">
