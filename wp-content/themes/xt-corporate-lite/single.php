<?php
global $xt_corporate_lite_opt;
$sidebar = 'sidebar-primary';
if(isset($xt_corporate_lite_opt['xt_blog_sidebar']) && $xt_corporate_lite_opt['xt_blog_sidebar'] != '') {
    $sidebar = sanitize_text_field($xt_corporate_lite_opt['xt_blog_sidebar']);
}
$layout = '3';
if(isset($xt_corporate_lite_opt['xt_blog_layout']) && $xt_corporate_lite_opt['xt_blog_layout'] != ''){
    $layout = sanitize_text_field($xt_corporate_lite_opt['xt_blog_layout']);
}
?>
<div id="page-content">
    <div class="container">
        <?php
        if($layout == '1'){?>
            <div class="content">
                <?php get_template_part('templates/content-single', get_post_type()); ?>
            </div>
        <?php
        }elseif($layout == '2'){  ?>
            <div class="col-md-4 col-sm-4 sidebar">
                <?php dynamic_sidebar($sidebar); ?>
            </div>
            <div class="col-md-8 col-sm-8 content">
                <?php get_template_part('templates/content-single', get_post_type()); ?>
            </div>
        <?php
        }elseif($layout == '3'){ ?>
            <div class="col-md-8 col-sm-8 content">
                <?php get_template_part('templates/content-single', get_post_type()); ?>
            </div>
            <div class="col-md-4 col-sm-4 sidebar">
                <?php dynamic_sidebar($sidebar); ?>
            </div>
        <?php
        }
        ?>
    </div>
</div>