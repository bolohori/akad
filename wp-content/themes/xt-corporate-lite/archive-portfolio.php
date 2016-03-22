<section id="portfolio" >
    <div class="container">
        <?php if (!have_posts()) : ?>
            <div class="alert alert-warning">
                <?php esc_attr_e('Sorry, no results were found.', 'xt-corporate-lite'); ?>
            </div>
            <?php get_search_form(); ?>
        <?php else: ?>
        <div class="row">
            <?php
            $i = 1;
            while (have_posts()) : the_post(); ?>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <?php
                    $port_image = get_template_directory_uri().'/assets/img/no_image.png';
                    if ( has_post_thumbnail() ) {
                        $port_image =  wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    }
                    ?>
                    <a href="<?php the_permalink(); ?>" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="<?php echo esc_url($port_image); ?>" class="img-responsive" alt="<?php echo get_the_title(); ?>">
                    </a>
                    <div class="portfolio-caption">
                        <h4><?php echo get_the_title(); ?></h4>
                        <p class="text-muted">
                            <?php
                            $categories = get_the_category();
                            $separator = ', ';
                            $output = '';
                            if ( ! empty( $categories ) ) {
                                foreach( $categories as $category ) {
                                    $output .= esc_html( $category->name ) .$separator;
                                }
                                echo trim( $output, $separator );
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <?php
                if($i%3 == 0){
                    echo '<div style="clear: both;"></div>';
                }
                $i++;
            endwhile;
        endif; ?>
            <div class="clearfix"></div>
            <div class="row port_pagination">
                <?php the_posts_pagination(); ?>
            </div>
    </div>
</section>