<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">
    <nav class="tab-bar">
      <section class="left-small">
        <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
      </section>

      <section class="middle tab-bar-section">
        <h1 class="title">Foundation</h1>
      </section>

      <section class="right-small">
        <a class="right-off-canvas-toggle menu-icon" href="#"><span></span></a>
      </section>
    </nav>

	<aside class="left-off-canvas-menu">
	    <?php
	    wp_nav_menu( array(
	        'theme_location' => 'primary',
	        'container' => false,
	        'depth' => 0,
	        'items_wrap' => '<ul class="off-canvas-list">%3$s</ul>',
	        'fallback_cb' => 'reverie_menu_fallback', // workaround to show a message to set up a menu
	        'walker' => new reverie_walker( array(
	            'in_top_bar' => true,
	            'item_type' => 'li',
	            'menu_type' => 'main-menu'
	        ) ),
	    ) );
	    ?>
	</aside>

    <aside class="right-off-canvas-menu">
      <ul class="off-canvas-list">
        <li><label>Users</label></li>
        <li><a href="#">Hari Seldon</a></li>
        <li><a href="#">...</a></li>
      </ul>
    </aside>

    <section class="main-section"> <!-- Off Canvas main section wrapper-->