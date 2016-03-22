<?php
/**
 * The template for displaying the Jetpack Testimonial archive page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Enliven
 */

get_header(); ?>

<?php $image_url = get_theme_mod( 'testimonial-header-image' ); ?>

<?php if( $image_url ) { ?>
	<div class="hero-container img-banner" style="background-image: url('<?php echo esc_url($image_url); ?>');">
	<div class="overlay"></div>
<?php } else { ?>
	<div class="hero-container nrml-banner">
<?php } ?>

		<div class="hero-wrapper">
			<h1 class="page-title-hero"><?php echo esc_html( get_theme_mod( 'testimonial_page_title', 'Testimonials' ) ); ?></h1>
			<?php 
				$testimonial_subtitle = get_theme_mod( 'testimonial_page_subtitle', '' );
				if( ! empty( $testimonial_subtitle ) ) : ?>
					<p class="page-subtitle-hero">
						<?php echo esc_html( $testimonial_subtitle ); ?>
					</p>
			<?php endif; ?>
		</div>

</div><!-- .hero-container -->


<?php 
	$testimonial_page_description = get_theme_mod( 'testimonial_page_description', '' );
	if( ! empty ( $testimonial_page_description ) ) : ?>
		<div class="enl-test-description container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<?php echo wp_kses_post( $testimonial_page_description ); ?>
				</div>
			</div>
		</div>
<?php endif; ?>


<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ 
				$counter = 0;
			?>
			<div class="row">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content-testimonial', get_post_format() );
					?>

					<?php
						$counter++;
						if ($counter%3 == 0) {
							echo '</div><div class="row">';
						}
					?>

				<?php endwhile; ?>
			</div><!--.row-->

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .container -->
<?php get_footer(); ?>
