<?php
global $xt_corporate_lite_opt;
$title = __('Contact Us','xt-corporate-lite');
if(isset($xt_corporate_lite_opt['xt_contact_title']) && $xt_corporate_lite_opt['xt_contact_title'] != ''){
    $title = $xt_corporate_lite_opt['xt_contact_title'];
}
$desc = '';
if(isset($xt_corporate_lite_opt['xt_contact_subtitle']) && $xt_corporate_lite_opt['xt_contact_subtitle'] != ''){
    $desc = $xt_corporate_lite_opt['xt_contact_subtitle'];
}
?>
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo sanitize_text_field($title); ?></h2>
                <h3 class="section-subheading text-muted"><?php echo esc_textarea($desc); ?></h3>
            </div>
        </div>
        <div class="row">
                <?php
                if(isset($xt_corporate_lite_opt['xt_contact_page']) && $xt_corporate_lite_opt['xt_contact_page'] != '') {
                    $xt_query = new WP_Query(array('page_id' => $xt_corporate_lite_opt['xt_contact_page']));
                    if ($xt_query->have_posts()) {
                        while ($xt_query->have_posts()) {
                            $xt_query->the_post();
                            ?>
                            <?php
                                $location = get_field('xt_map_address');

                                $zoom = get_field('zoom');
                                if(empty($zoom)){
                                    $zoom = '14';
                                }
                                $lat = $location['lat'];
                                $lng = $location['lng'];
                                if(!empty($location)){ ?>
                                    <div class="col-md-6">
                                        <?php the_content(); ?>
                                    </div>

                                    <div class="col-md-6">
                                        <?php
                                        if(function_exists('xt_corporate_lite_get_map')){
                                            xt_corporate_lite_get_map(sanitize_text_field($lat),sanitize_text_field($lng),sanitize_text_field($zoom));
                                        }
                                        ?>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-md-12">
                                        <?php the_content(); ?>
                                    </div>
                                <?php }
                        }
                    }
                    wp_reset_postdata();
                }
                ?>
        </div>
    </div>
</section>