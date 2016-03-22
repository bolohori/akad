<?php
/**
 * The template for displaying all single posts of testimonials.
 *
 * @package Enliven
 */

get_header(); ?>

<div class="container">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'template-parts/content-testimonial', 'single' ); ?>

            <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            ?>

        <?php endwhile; // End of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

</div><!-- .container -->
<?php get_footer(); ?>