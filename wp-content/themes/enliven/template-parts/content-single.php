<?php
/**
 * Template part for displaying single posts.
 *
 * @package Enliven
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('enl-post-single'); ?>>
	<header class="post-entry-header">
		<?php the_title( '<h1 class="post-entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php enliven_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	
	<?php if( has_post_thumbnail() ) : ?>
		<figure class="enl-post-thumbnail">
			<?php the_post_thumbnail('enliven-featured'); ?>
		</figure>
	<?php endif; ?>

	<div class="post-entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'enliven' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="post-entry-footer">
		<?php enliven_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->