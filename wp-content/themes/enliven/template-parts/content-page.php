<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Enliven
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('enl-page'); ?>>

	<div class="page-entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'enliven' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="page-entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'enliven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

