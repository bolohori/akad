<?php
/**
 * The template used for displaying testimonials.
 *
 * @package Enliven
 */
?>
<div class="col-md-10 col-md-offset-1">
	<article id="post-<?php the_ID(); ?>" <?php post_class('enl-testimonial'); ?>>
			<?php if ( '' != get_the_post_thumbnail() ) : ?>
			<div class="testimonial-thumbnail">
				<?php the_post_thumbnail( 'enliven-small-thumb' ); ?>
			</div>
			<?php endif; ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<header class="entry-header">
			<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
		</header>
		<?php edit_post_link( __( 'Edit', 'enliven' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
	</article><!-- #post-## -->
</div>