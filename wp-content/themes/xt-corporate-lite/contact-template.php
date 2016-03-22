<?php
/**
 * Template Name: Contact Us
 */
?>
<div id="page-content">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>


                <div class="content">
                    <?php get_template_part('templates/content', 'contact'); ?>
                </div>

        <?php endwhile; ?>
    </div>
</div>
