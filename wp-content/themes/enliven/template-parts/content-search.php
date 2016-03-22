<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Enliven
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('enl-article'); ?>>

	<?php
		if( has_post_thumbnail() ) : ?>
			<a href="<?php echo the_permalink(); ?>" rel="bookmark">
				<figure class="enl-thumbnail">
					<?php the_post_thumbnail('enliven-featured'); ?>
				</figure>
			</a>
	<?php
		endif;
	?>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="arc-entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="arc-entry-content">
		<?php
			/* translators: %s: Name of current post */
			/*the_content( sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'enliven' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );*/
			the_excerpt();
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'enliven' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="arc-entry-meta">
			<?php enliven_arc_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

</article><!-- #post-## -->