<aside id="clients">
    <div class="container">

            <?php
            $xt_query = new WP_Query( array( 'post_type' => 'clients', 'posts_per_page' => -1));
            if ( $xt_query->have_posts() ) {
                echo '<div id="xt-clients" class="owl-carousel row">';
                while ( $xt_query->have_posts() ) {
                    $xt_query->the_post();
                    $image = get_field('xt_client_image');
                    if(isset($image['url']) && $image['url'] != ''){
                        $client_image = $image['url'];
                    }else{
                        $client_image = get_template_directory_uri().'/assets/img/no_image_h.png';
                    }
                    ?>
                    <div class="item">
                        <a href="<?php echo esc_url(get_field('xt_services_link')); ?>">
                            <img src="<?php echo esc_url($client_image); ?>" class="client_img img-responsive img-centered" alt="<?php echo get_the_title(); ?>">
                        </a>
                    </div>
                    <?php
                }
                echo '</div>';
            } else {
                echo '<p class="no_results_found">';
                esc_attr_e('Opps! No Clients Found.','xt-corporate-lite');
                echo '</p>';
            }
            wp_reset_postdata();
            ?>
    </div>
</aside>
