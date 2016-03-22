<?php
/**
 * The template for blog listing.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Enliven
 */

get_header(); 

if ( ! is_front_page() && get_theme_mod( 'enliven_slider_blog_header') == '' ) : ?>

    <?php $image_url = get_theme_mod( 'blog-header-image' ); ?>

    <?php if( $image_url ) { ?>
        <div class="hero-container img-banner" style="background-image: url('<?php echo esc_url($image_url); ?>');">
        <div class="overlay"></div>
    <?php } else { ?>
        <div class="hero-container nrml-banner">
    <?php } ?>

            <div class="hero-wrapper">
                <h1 class="page-title-hero"><?php echo esc_html( get_theme_mod( 'blog_page_title', 'Blog' ) ); ?></h1>
                <?php 
                    $blog_subtitle = get_theme_mod( 'blog_subtitle', '' );
                    if( ! empty( $blog_subtitle ) ) : ?>
                        <p class="page-subtitle-hero">
                            <?php echo esc_html( get_theme_mod( 'blog_subtitle', 'Subtitle' ) ); ?>
                        </p>
                <?php endif; ?>
            </div>

        </div><!-- .hero-container -->

<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8 col-lg-8 enl-content-float">
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">

                <?php if ( have_posts() ) : ?>

                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'template-parts/content', get_post_format() );
                        ?>

                    <?php endwhile; ?>

                    <?php the_posts_pagination(); ?>

                <?php else : ?>

                    <?php get_template_part( 'template-parts/content', 'none' ); ?>

                <?php endif; ?>

                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!--.bootstrap-cols -->

        <div class="col-xs-12 col-md-4 col-lg-4 enl-widgets-float">
            <?php get_sidebar(); ?>
        </div><!--.bootstrap-cols -->

    </div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>
