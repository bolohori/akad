<?php
/**
 * The template for displaying Projects on index view
 *
 * @package enliven
 */
?>
<div class="col-xs-12 col-sm-4 col-md-4">
<article id="post-<?php the_ID(); ?>" <?php post_class('enl-port-archive'); ?>>
    <figure class="enl-portfolio-item">
        <figcaption class="enl-port-details">
            <h3 class="enl-port-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title() ?></a></h3>
            <span class="enl-port-icon"><i class="fa fa-caret-right"></i></span>
        </figcaption>
        
        <?php  
            if ( '' != get_the_post_thumbnail() ) { ?>
                <a href="<?php the_permalink() ?>" rel="bookmark"></a>
                <?php the_post_thumbnail( 'enliven-one-by-one' ); ?>
        <?php } ?>
    </figure><!-- .enl-portfolio-item -->
</article><!-- #post-## -->
</div><!--boostrap-cols-->


