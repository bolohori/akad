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
        <?php if (!have_posts()) : ?>
            <div class="alert alert-warning">
                <?php esc_attr_e('Sorry, no results were found.', 'xt-corporate-lite'); ?>
            </div>
            <?php get_search_form(); ?>
        <?php else: ?>

        <?php
        if($layout == '1'){?>
            <div class="content">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('templates/content', 'search'); ?>
                <?php endwhile; ?>
            </div>
        <?php
        }elseif($layout == '2'){  ?>
            <div class="col-md-4 col-sm-4 sidebar">
                <?php dynamic_sidebar($sidebar); ?>
            </div>
            <div class="col-md-8 col-sm-8 content">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('templates/content', 'search'); ?>
                <?php endwhile; ?>
            </div>
        <?php
        }elseif($layout == '3'){ ?>
            <div class="col-md-8 col-sm-8 content">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('templates/content', 'search'); ?>
                <?php endwhile; ?>
            </div>
            <div class="col-md-4 col-sm-4 sidebar">
                <?php dynamic_sidebar($sidebar); ?>
            </div>
        <?php
        }
        ?>

        <?php the_posts_navigation(); ?>

        <?php endif; ?>
    </div>
</div>