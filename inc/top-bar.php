<!-- Navigation -->
<div class="contain-to-grid <?php if( get_theme_mod( 'top-bar-placement' )) { echo 'fixed'; }?>">
	
	<div class="search-bar-content close">
	
		<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
		
			<div class="row collapse">
		
					<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'reverie'); ?>">
		
					<input type="submit" id="searchsubmit" value="" class="search">
		
			</div>
		
		</form> <!-- #searchform -->
		
	</div> <!-- .search-bar-content -->
		
	<nav id="site-navigation" class="top-bar main-navigation" role="navigation" data-topbar data-options="mobile_show_parent_link: true">
	    
	    <ul class="title-area">
	    
	        <li class="name">

	        </li>
		
			<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
			<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	    
	    </ul>
	    
	    <section class="top-bar-section">
        
            <ul class="right show-for-large-up">
		
			<li class="top-search-bar">
		
				<a class="show-search-bar close"><i></i></a>
		
			</li>	
                  
            </ul>
          
          	    <?php
	        wp_nav_menu( array(
	            'theme_location' => 'primary',
	            'container' => false,
	            'depth' => 0,
	            'items_wrap' => '<ul class="left">%3$s</ul>',
	            'fallback_cb' => 'reverie_menu_fallback', // workaround to show a message to set up a menu
	            'walker' => new reverie_walker( array(
	                'in_top_bar' => true,
	                'item_type' => 'li',
	                'menu_type' => 'main-menu'
	            ) ),
	        ) );
	    ?>

	    </section>
	    
	</nav>

</div>
