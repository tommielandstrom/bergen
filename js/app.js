	(function($) {
		$(document).foundation()
		
	// Joyride: Add java script to footer so all Foundation scripts will work
	.foundation('joyride', 'start'); 
	
	// Toggle Search-bar
	jQuery(".search-bar-content").hide();
	jQuery( ".show-search-bar" ).click(function() {
	  jQuery( ".search-bar-content" ).toggle();
	  jQuery( ".top-search-bar" ).toggleClass( "highlight" );
	
	});
	
	jQuery(document).mousedown(function(event) {
	    var target = jQuery(event.target);
	    if (!target.parents().andSelf().is(".close")) { // Clicked outside
	        jQuery(".search-bar-content").hide();
	          jQuery( ".top-search-bar" ).removeClass( "highlight" );
	
	    }
	}); 
            
	// Add button class to all submit buttons
	jQuery('input[type="submit"]').addClass('tiny button');

	// Add button class to all submit buttons
	jQuery('input[type="file"]').addClass('tiny file-button');

	
	// Adds flex video to embeded video: http://foundation.zurb.com/docs/components/flex-video.html
    jQuery('iframe[src*="vimeo.com"]').wrap('<div class="flex-video widescreen vimeo" />');
	jQuery('iframe[src*="dailymotion.com"]').wrap('<div class="flex-video widescreen" />');
    jQuery('iframe[src*="youtube.com"]').wrap('<div class="flex-video widescreen" />');


		
	})(jQuery);



