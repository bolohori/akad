<?php
global $xt_corporate_lite_opt;
$sidebar = 'page-sidebar';
if(isset($xt_corporate_lite_opt['xt_page_sidebar']) && $xt_corporate_lite_opt['xt_page_sidebar'] != '') {
    $sidebar = sanitize_text_field($xt_corporate_lite_opt['xt_page_sidebar']);
}
$layout = '1';
if(isset($xt_corporate_lite_opt['xt_page_layout']) && $xt_corporate_lite_opt['xt_page_layout'] != ''){
    $layout = sanitize_text_field($xt_corporate_lite_opt['xt_page_layout']);
}
?>
<div id="page-content">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <?php
            if($layout == '1'){?>
                <div class="content">
                    <?php get_template_part('templates/content', 'page'); ?>
                </div>
                <?php
            }elseif($layout == '2'){  ?>
                <div class="col-md-4 col-sm-4 sidebar">
                    <?php dynamic_sidebar($sidebar); ?>
                </div>
                <div class="col-md-8 col-sm-8 content">
                    <?php get_template_part('templates/content', 'page'); ?>
                </div>
                <?php
            }elseif($layout == '3'){ ?>
                <div class="col-md-8 col-sm-8 content">
                    <?php get_template_part('templates/content', 'page'); ?>
                </div>
                <div class="col-md-4 col-sm-4 sidebar">
                    <?php dynamic_sidebar($sidebar); ?>
                </div>
                <?php
            }
            ?>
        <?php endwhile; ?>
    </div>
</div>
