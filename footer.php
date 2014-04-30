					</div> <!-- .row  -->
				</section> <!-- .site-main  -->
				
				<footer class="site-footer">

					<?php if (is_active_sidebar( 'footer' ) ) { ?>
						<div class="full-width widget-footer">
							<div class="row">
								<ul class="large-block-grid-4 small-block-grid-1">
									<?php dynamic_sidebar("Footer"); ?>
								</ul>
							</div>
						</div>
				    <?php } ?>
				    
					<div class="full-width bottom-footer" role="contentinfo">
						<div class="row">
							<div class="large-12 columns">
								     <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
					                    <span class="copywright left">&copy; <?php echo date('Y'); ?> <?php echo get_theme_mod( 'wpforge_footer_text'); ?></span>
					                <?php }  ?>
					                <a href="#top" class="right"><i class="fi-arrow-up"></i></a>
							</div>
						</div>
					</div>

				</footer>
								
		<?php wp_footer(); ?>	
	</body>
</html>

