<?php

/**
 * The template used for displaying child page on the grid template.
 *
 * @package Enliven
 */
?>
<div class="col-xs-12 col-sm-4 col-md-4">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'child-page' ); ?>>
		<?php if ( '' != get_the_post_thumbnail() ) : ?>
		<div class="grid-entry-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'enliven' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="<?php the_ID(); ?>">
				<?php the_post_thumbnail('enliven-featured'); ?>
			</a>
		</div><!-- .entry-thumbnail -->
		<?php endif; ?>

		<header class="grid-entry-header">
			<h1 class="enl-gp-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php 
				if ( empty( $post->post_excerpt ) ) {
					echo enliven_excerpt(30); 
				} else {
					echo the_excerpt();
				} 
			?>
		</div><!-- .entry-summary -->

		<?php edit_post_link( __( 'Edit', 'enliven' ), '<footer class="grid-entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
	</article><!-- #post-## -->
</div>