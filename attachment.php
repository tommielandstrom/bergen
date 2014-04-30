<?php
/**
 * The template for displaying image attachments.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.0
 */

get_header(); ?>
<div class="row">
	<div id="primary" class="medium-12 large-12 columns site-content">
		<div id="content" role="main">
        

		<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<ul class="entry-meta">
							<?php
								$metadata = wp_get_attachment_metadata();
								printf( __( '<li class="entry-date"><i class="fi-clock"></i> <time class="entry-date" datetime="%1$s">%2$s</time></li> <li><i class="fi-page"></i> <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a></li><li><i class="fi-camera"></i> <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a></li>', 'wpforge' ),
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									esc_url( wp_get_attachment_url() ),
									$metadata['width'],
									$metadata['height'],
									esc_url( get_permalink( $post->post_parent ) ),
									esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
									get_the_title( $post->post_parent )
								);
							?>
							<?php edit_post_link( __( ' Edit', 'wpforge' ), '<span class="edit-link"><i class="fi-pencil"></i>', '</span>' ); ?>
						</ul><!-- .entry-meta -->

					</header><!-- .entry-header -->

					<div class="entry-content">

						<div class="entry-attachment">
							<figure class="attachment">

								<?php
								$attachment_size = apply_filters( 'wpforge_attachment_size', array( 960, 960 ) );
								echo wp_get_attachment_image( $post->ID, $attachment_size );
								?>

								<figcaption class="entry-caption">
									<?php the_excerpt(); ?>
								</figcaption>
							</figure><!-- .attachment -->

						</div><!-- .entry-attachment -->

						<div class="entry-description">
							<?php the_content(); ?>
						</div><!-- .entry-description -->

					</div><!-- .entry-content -->

				</article><!-- #post -->


			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>