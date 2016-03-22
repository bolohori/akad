<div class="featured-image">
    <?php the_post_thumbnail(); ?>
</div>
<?php the_content(); ?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'xt-corporate-lite'), 'after' => '</p></nav>']); ?>
