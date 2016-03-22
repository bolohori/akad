<?php
global $xt_corporate_lite_opt;
$title = __('About','xt-corporate-lite');
if(isset($xt_corporate_lite_opt['xt_about_title']) && $xt_corporate_lite_opt['xt_about_title'] != ''){
    $title = $xt_corporate_lite_opt['xt_about_title'];
}
$desc = '';
if(isset($xt_corporate_lite_opt['xt_about_subtitle']) && $xt_corporate_lite_opt['xt_about_subtitle'] != ''){
    $desc = $xt_corporate_lite_opt['xt_about_subtitle'];
}
?>
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo sanitize_text_field($title); ?></h2>
                <h3 class="section-subheading text-muted"><?php echo esc_textarea($desc); ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <?php
                if(isset($xt_corporate_lite_opt['xt_about_page']) && $xt_corporate_lite_opt['xt_about_page'] != '') {
                    $xt_query = new WP_Query(array('page_id' => $xt_corporate_lite_opt['xt_about_page']));
                    if ($xt_query->have_posts()) {
                        while ($xt_query->have_posts()) {
                            $xt_query->the_post();
                            the_content();
                        }
                    }
                    wp_reset_postdata();
                }
                ?>

            </div>
        </div>
    </div>
</section>