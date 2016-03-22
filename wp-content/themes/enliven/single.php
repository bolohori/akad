<?php
/**
 * The template for displaying all single posts.
 *
 * @package Enliven
 */

get_header(); ?>

<div class="container">
<div class="row">
    <div class="col-xs-12 col-md-8 col-lg-8 enl-content-float">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/content', 'single' ); ?>

                <?php the_post_navigation(); ?>

                <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>

            <?php endwhile; // End of the loop. ?>

            </main><!-- #main -->
	    </div><!-- #primary -->
    </div><!--.bootstrap-cols -->

    <div class="col-xs-12 col-md-4 col-lg-4 enl-widgets-float">
        <?php get_sidebar(); ?>
    </div><!--.bootstrap-cols -->

</div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>