<?php
/**
 * Template part for displaying single posts.
 *
 * @package Enliven
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('enl-portfolio-single'); ?>>
	<header class="portfolio-entry-header">
		<?php the_title( '<h1 class="portfolio-entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	
	<div class="enl-post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>

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