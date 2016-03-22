<?php
/**
 * Template Name: Portfolio Page Template
 *
 * @package Enliven
 */

get_header(); ?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<div class="enl-port-page-desc">
					<?php
						the_content();
						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'enliven' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) );
					?>
					<?php edit_post_link( __( 'Edit', 'enliven' ), '<div class="entry-meta"><span class="edit-link">', '</span></div>' ); ?>

				</div><!-- .enl-port-page-desc -->

			<?php endwhile; // end of the loop. ?>

			<?php
				if ( get_query_var( 'paged' ) ) :
					$paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) :
					$paged = get_query_var( 'page' );
				else :
					$paged = 1;
				endif;

				$posts_per_page = get_option( 'jetpack_portfolio_posts_per_page', '9' );

				$args = array(
					'post_type'      => 'jetpack-portfolio',
					'paged'          => $paged,
					'posts_per_page' => $posts_per_page,
				);

				$project_query = new WP_Query ( $args );

				if ( $project_query -> have_posts() ) :
			?>
			
			<div class="row">
				<?php
					while ( $project_query -> have_posts() ) : $project_query -> the_post();

						get_template_part( 'template-parts/content', 'portfolio' );

					endwhile;
				?>
			</div><!--.row-->

			<?php
				// Insert Pagination Here.
				wp_reset_postdata();

			?>

			<?php else : ?>

				<div class="enl-port-page-no-results">
					<header>
						<h3 class="page-title"><?php _e( 'No Projects Found', 'enliven' ); ?></h3>
					</header>

						<?php 
							if ( ! post_type_exists( 'jetpack-portfolio' ) ) :
								
								echo "You have not yet activated the jetpack portfolio feature. Please activate it.";
							
							else :
						?>
								<?php if ( current_user_can( 'publish_posts' ) ) { ?>

									<p><?php printf( __( 'Ready to publish your first project? <a href="%1$s">Get started here</a>.', 'enliven' ), esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) ); ?></p>

								<?php } ?>
								
						<?php endif; ?>

				</div><!-- .enl-port-no-results -->

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .container -->

<?php get_footer(); ?>