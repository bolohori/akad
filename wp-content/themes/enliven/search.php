<?php
/**
 * The template for displaying search results pages.
 *
 * @package Enliven
 */

get_header();

if( have_posts() ) : ?>
	<div class="hero-container nrml-banner">
	    <div class="hero-wrapper container">
	        <h1 class="page-title-hero"><?php printf( esc_html__( 'Search Results for: %s', 'enliven' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	    </div><!-- .hero-wrapper -->
	</div><!-- .hero-container -->
<?php endif; ?>

<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-md-8 col-lg-8 enl-content-float">
			<section id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );
						?>

					<?php endwhile; ?>

					<?php the_posts_pagination(); ?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>

				</main><!-- #main -->
			</section><!-- #primary -->
    </div><!--.bootstrap-cols -->

    <div class="col-xs-12 col-md-4 col-lg-4 enl-widgets-float">
        <?php get_sidebar(); ?>
    </div><!--.bootstrap-cols -->

	</div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>
