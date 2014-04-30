<?php if ( get_header_image() || get_theme_mod( 'display_site_info' ) ) : ?>

	<div class="site-cover">
	
		<?php 
				if ( is_random_header_image() ) {}
				if ( get_header_image() != '') {
			
				    $custom_header = get_custom_header();
				
					$custom_header_small = wp_get_attachment_image_src(intval($custom_header->attachment_id), 'small-img', true);
					$custom_header_medium = wp_get_attachment_image_src(intval($custom_header->attachment_id), 'medium-img', true);
					$custom_header_large = wp_get_attachment_image_src(intval($custom_header->attachment_id), 'large-img', true);
										
					echo "<div class='site-cover-background' data-interchange='[$custom_header_small[0], (small)], [ $custom_header_medium[0], (medium)] [$custom_header_large[0], (large)]'>";	
				
				} 
				
				else {
					
					echo "<div class='site-cover-background'>";
				}
		 ?>
									
			<div class="header-inner section-inner">
	
				<?php if ( get_theme_mod( 'display_site_info' ) ) { 
				
					if ( get_bloginfo( 'description' ) || get_bloginfo( 'title' ) ) : ?>
				
						<div class="site-info">
						
							<h1 class="site-title">
							
								<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'title' ) ); ?> &mdash; <?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" rel="home"><?php echo esc_attr( get_bloginfo( 'title' ) ); ?></a>	
										
							</h1>
							
							<?php if ( get_bloginfo( 'description' ) ) { ?>
							
								<h1 class="site-description subheader">
									
									<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>
								
								</h1>
								
							<?php } ?>
							
						</div> <!-- /.site-info -->
					
					<?php endif;
				 
				}?>
				
							
			</div> <!-- /.header-inner -->
						
		</div> <!-- /.site-cover-background -->

	</div> <!-- /.site-cover -->
				
<?php endif; ?>