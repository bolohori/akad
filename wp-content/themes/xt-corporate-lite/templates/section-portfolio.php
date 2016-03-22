<?php
global $xt_corporate_lite_opt;
$title = __('Portfolio','xt-corporate-lite');
if(isset($xt_corporate_lite_opt['xt_portfolio_title']) && $xt_corporate_lite_opt['xt_portfolio_title'] != ''){
    $title = $xt_corporate_lite_opt['xt_portfolio_title'];
}
$desc = '';
if(isset($xt_corporate_lite_opt['xt_portfolio_desc']) && $xt_corporate_lite_opt['xt_portfolio_desc'] != ''){
    $desc = $xt_corporate_lite_opt['xt_portfolio_desc'];
}
?>

<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo sanitize_text_field($title); ?></h2>
                <h3 class="section-subheading text-muted"><?php echo esc_textarea($desc); ?></h3>
            </div>
        </div>
        <?php

        $xt_query = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 6 ));
        $i = 1;
        if ( $xt_query->have_posts() ) {
            echo '<div class="row">';
            while ( $xt_query->have_posts() ) {
                $xt_query->the_post();
                ?>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <?php
                    $port_image = get_template_directory_uri().'/assets/img/no_image.png';
                    if ( has_post_thumbnail() ) {
                        $port_image =  wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    }
                    ?>
                    <a href="#portfolio<?php echo $i; ?>" class="portfolio-link" data-toggle="modal">
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
            }
            echo '</div>';
        } else {
            echo '<p class="no_results_found">';
            esc_attr_e('Opps! No Portfolio Found.','xt-corporate-lite');
            echo '</p>';
        }
        wp_reset_postdata();
        ?>
    </div>
</section>

<!-- Portfolio Modals -->
<!-- Use the modals below to showcase details about your portfolio projects! -->
<?php
$xt_query = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 6 ));
$i = 1;
if ( $xt_query->have_posts() ) {
    while ( $xt_query->have_posts() ) {
        $xt_query->the_post();
        ?>
        <div class="portfolio-modal modal fade" id="portfolio<?php echo $i;?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <h2><?php echo get_the_title(); ?></h2>
                                <?php
                                if ( has_post_thumbnail() ) {
                                    $port_image =  wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                                    echo '<img class="img-responsive img-centered" src="'.esc_url($port_image).'" alt="'.get_the_title().'">';
                                }
                                ?>
                                <?php the_content(); ?>
                                <br/>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i><?php esc_attr_e('Close Project','xt-corporate-lite'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i++;
    }
}
wp_reset_postdata();
?>
