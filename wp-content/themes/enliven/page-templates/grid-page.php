<?php
/**
 * Template Name: Grid Page
 *
 * @package Enliven
 */

get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'template-parts/content', 'hero' ); ?>

<?php endwhile; ?>

<?php rewind_posts(); ?>

<div class="container">
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php
			$enliven_child_pages = new WP_Query( array(
				'post_type'      => 'page',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'post_parent'    => $post->ID,
				'posts_per_page' => 999,
				'no_found_rows'  => true,
			) );
		?>

		<?php if ( $enliven_child_pages->have_posts() ) : ?>

		<div class="child-pages grid">
			<div class="row">
				<?php
					$i = 1;
					
					while ( $enliven_child_pages->have_posts() ) : $enliven_child_pages->the_post();

						get_template_part( 'template-parts/content', 'grid' );

						if( $i % 3 == 0 ) {
							echo '</div><div class="row">';
						}

						$i++;

					endwhile;
				?>
			</div><!-- .row -->
		</div><!-- .child-pages .grid -->

		<?php
			endif;
			wp_reset_postdata();
		?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) {
				comments_template();
			}
		?>

	</main><!-- #main -->
</div><!-- #primary -->
</div><!--container-->


<?php get_footer(); ?>
