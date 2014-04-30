<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div class="row collapse">
		<div class="large-10 small-9 columns">
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'reverie'); ?>">
		</div>
		<div class="large-2 small-3 columns">
			<button type="submit" id="searchsubmit" value="" class="postfix button expand search"><i class="fi-magnifying-glass"></i></button>
		</div>
	</div>
</form>

