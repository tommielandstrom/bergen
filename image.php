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
								printf( __( '<li class="meta-prep meta-prep-entry-date"><i class="fi-clock"></i> <a href="%6$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%1$s">%2$s</time></a><li><i class="fi-photo"></i> <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a></li><li><i class="fi-page"></i> <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a></li>', 'wpforge' ),
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
							<?php edit_post_link( __( ' Redigera', 'wpforge' ), '<li class="edit-link"><i class="fi-pencil"></i>', '</li>' ); ?>
						</ul><!-- .entry-meta -->

						<nav class="navigation image-navigation" role="navigation">
							<div class="nav-links">
								<span class="nav-previous"><?php previous_image_link( false, __( '&laquo; Previous Image', 'wpforge' ) ); ?></span>
								<span class="nav-next"><?php next_image_link( false, __( 'Next Image &raquo;', 'wpforge' ) ); ?></span>
							</div>
						</nav><!-- #image-navigation -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<div class="entry-attachment">
							<figure class="attachment">
<?php
/**
 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
 */
$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
foreach ( $attachments as $k => $attachment ) :
	if ( $attachment->ID == $post->ID )
		break;
endforeach;

$k++;
// If there is more than 1 attachment in a gallery
if ( count( $attachments ) > 1 ) :
	if ( isset( $attachments[ $k ] ) ) :
		// get the URL of the next image attachment
		$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
	else :
		// or get the URL of the first image attachment
		$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	endif;
else :
	// or, if there's only 1 image, get the URL of the image
	$next_attachment_url = wp_get_attachment_url();
endif;
?>
								<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
								$attachment_size = apply_filters( 'wpforge_attachment_size', array( 960, 960 ) );
								echo wp_get_attachment_image( $post->ID, $attachment_size );
								?></a>

								<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<figcaption class="entry-caption">
									<?php the_excerpt(); ?>
								</figcaption>
								<?php endif; ?>
							</figure><!-- .attachment -->
						</div><!-- .entry-attachment -->
						
						<div class="entry-description">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wpforge' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-description -->

					</div><!-- .entry-content -->

				</article><!-- #post -->

				<?php comments_template(); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div>
<?php get_footer(); ?>