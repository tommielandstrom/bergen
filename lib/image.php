<?php
/* ==========================================================================
   Image
   ========================================================================== */


//
// Interchange custom header
//			
if ( ! function_exists( 'interchange_custom_header' ) ) :
function interchange_custom_header() {
	if ( is_random_header_image() ) {}
	if ( get_header_image() != '') {

    $custom_header = get_custom_header();

	$custom_header_small = wp_get_attachment_image_src(intval($custom_header->attachment_id), 'small-img', true);
	$custom_header_medium = wp_get_attachment_image_src(intval($custom_header->attachment_id), 'medium-img', true);
	$custom_header_large = wp_get_attachment_image_src(intval($custom_header->attachment_id), 'large-img', true);
	
	$html .= "<div class='site-cover-background' data-interchange='[$custom_header_small[0], (small)], [ $custom_header_medium[0], (medium)] [$custom_header_large[0], (large)]'></div>";
	
	echo $html;	
	
	} 
	
	else {
		
		return false;
	} 

}
endif;

//
// Interchange post header
//
if ( ! function_exists( 'interchange_post_header' ) ) :
function interchange_post_header() {
	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_small = wp_get_attachment_image_src($thumb_id,'small-img', true);
	$thumb_url_medium = wp_get_attachment_image_src($thumb_id,'medium-img', true);
	$thumb_url_large = wp_get_attachment_image_src($thumb_id,'large-img', true);

	echo '<div class="site-cover-background" data-interchange="[' . $thumb_url_small[0] . ', (small)], [' . $thumb_url_medium[0] . ', (medium)] [' . $thumb_url_large[0] . ', (large)]"></div>';	 

} else {
	echo '';
}

}
endif;

//
// Interchange post thumbnail
//
if ( ! function_exists( 'interchange_post_thumbnail' ) ) :
function interchange_post_thumbnail() {
	if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_small = wp_get_attachment_image_src($thumb_id,'small-img', true);
	$thumb_url_medium = wp_get_attachment_image_src($thumb_id,'medium-img', true);
	$thumb_url_large = wp_get_attachment_image_src($thumb_id,'large-img', true);

	echo '<img data-interchange="[' . $thumb_url_small[0] . ', (small)], [' . $thumb_url_medium[0] . ', (medium)] [' . $thumb_url_large[0] . ', (large)]">';	 

} else {
	echo '';
}

}
endif;

//
// Remove height/width attributes on images so they can be responsive
//
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
//
// Wrap images with figure tag. Courtesy of Interconnectit http://interconnectit.com/2175/how-to-remove-p-tags-from-images-in-wordpress/
//
if( ! function_exists( 'reverie_img_unautop ' ) ) {
	function reverie_img_unautop($pee) {
	    $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure class="post-figure">$1</figure>', $pee);
	    return $pee;
	} 
}

//
// Reveal Lightbox 
//
function reveal_lightbox($html, $id, $caption, $title, $align, $url, $size, $alt) {
    
    $src = wp_get_attachment_image_src( $id, $size, false );
 
 	$thumb_url_small = wp_get_attachment_image_src($id,'small-img', true);
	$thumb_url_medium = wp_get_attachment_image_src($id,'medium-img', true);
	$thumb_url_large = wp_get_attachment_image_src($id,'large-img', true);
  
    $html5 = "<figure class='post-figure align$align'><a href='#' data-reveal-id='reveal$id' data-reveal>";
    $html5 .= "<img src='$src[0]' alt='$alt' />";
    if ($caption) {
    $html5 .= "<figcaption class='post-caption'>$caption</figcaption>";
    }
    $html5 .= "</a></figure>";
    $html5 .= "<div id='reveal$id' class='reveal-modal' data-reveal><figure class='post-figure'><img data-interchange='[$thumb_url_small[0], (small)], [ $thumb_url_medium[0], (medium)] [$thumb_url_large[0], (large)]'>";
    if ($caption) {
    $html5 .= "<figcaption>$caption</figcaption></figure>";
    }
    $html5 .= "<a class='close-reveal-modal'>&#215;</a></div>";
    
    return $html5;
    }
add_filter( 'image_send_to_editor', 'reveal_lightbox', 10, 9 );


?>