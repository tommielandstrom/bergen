
<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
	
		<?php if ( is_single() ) : ?>
			
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
	       		       	
		<?php else : ?>
			
			<span class="admin-entry-meta right">
				<?php 	
					if (is_user_logged_in() ) {
						if ( get_post_status () == 'publish' )	{ echo '<i class="fi-page"></i> ';}
						if ( get_post_status () == 'draft' )	{ echo '<i class="fi-page-edit"></i> ';}
						if ( get_post_status () == 'future' ) 	{ echo '<i class="fi-page-export"></i> ';}
						if ( get_post_status () == 'pending' ) 	{ echo '<i class="fi-page-search"></i> ';}
						if ( get_post_status () == 'trash' ) 	{ echo '<i class="fi-page-delete"></i> ';}				
					}
					edit_post_link( __( '<i class="fi-pencil"></i>' ), '', '' ); ?>
			</span>
			
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
	
	       	<?php interchange_post_thumbnail(); ?>
	       	
		<?php endif; // is_single() ?>

		<div class="entry-meta">
			<ul>
				<?php if ( is_page() ) : ?>
					<?php edit_post_link( __( 'Edit', 'felles' ), '<span class="edit-link">', '</span>' ); ?>
				<?php else : ?>
					<?php felles_entry_meta_header(); ?>
				<?php endif; // is_page() ?>
			</ul>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->

	<?php if ( is_search() || has_excerpt() || get_option('rss_use_excerpt') ) : // Only display Excerpts for Search and post with excerpt ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php else : ?>

		<div class="entry-content">	
			<?php the_content( __( ' Read more', 'felles' ) ); ?>
			<?php foundation_link_pages(); ?>
		</div><!-- .entry-content -->

	<?php endif; ?>

	<footer class="entry-footer">
		
		<div class="entry-meta">
			<ul>
				<?php felles_entry_meta_footer(); ?>
			</ul>
		</div>
		
		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
		
	</footer><!-- .entry-meta -->
	
</article><!-- #post -->
