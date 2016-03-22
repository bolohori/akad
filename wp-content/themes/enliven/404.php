<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Enliven
 */

get_header(); ?>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="enl-error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'enliven' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'enliven' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .container -->
<?php get_footer(); ?>
