<?php
global $xt_corporate_lite_opt;
$title = __('Services','xt-corporate-lite');
if(isset($xt_corporate_lite_opt['xt_services_title']) && $xt_corporate_lite_opt['xt_services_title'] != ''){
    $title = $xt_corporate_lite_opt['xt_services_title'];
}
$desc = '';
if(isset($xt_corporate_lite_opt['xt_services_desc']) && $xt_corporate_lite_opt['xt_services_desc'] != ''){
    $desc = $xt_corporate_lite_opt['xt_services_desc'];
}
?>
<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo sanitize_text_field($title); ?></h2>
                <h3 class="section-subheading text-muted"><?php echo esc_textarea($desc); ?></h3>
            </div>
        </div>

        <?php

        $xt_query = new WP_Query( array( 'post_type' => 'services', 'posts_per_page' => -1));
        $i = 1;
        if ( $xt_query->have_posts() ) {
            echo '<div class="row text-center">';
            while ( $xt_query->have_posts() ) {
                $xt_query->the_post();
                ?>
                <div class="col-md-4">
                    <?php
                    $ser_image = get_field('xt_services_image');
                    if(isset($ser_image['url']) && $ser_image['url'] != ''){
                        $ser_image = $ser_image['url'];
                    }else{
                        $ser_image = get_template_directory_uri().'/assets/img/no_image.png';
                    }
                    echo '<div class="service_img">';
                    echo '<img src="'.esc_url($ser_image).'">';
                    echo '</div>';
                    ?>
                    <h4 class="service-heading">
                        <a href="<?php echo get_field('xt_services_link'); ?>">
                            <?php echo get_the_title(); ?>
                        </a>
                    </h4>
                    <p class="text-muted"><?php echo get_field('xt_service_desciption'); ?></p>
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
            esc_attr_e('Opps! No Services Found.','xt-corporate-lite');
            echo '</p>';
        }
        wp_reset_postdata();
        ?>
    </div>
</section>