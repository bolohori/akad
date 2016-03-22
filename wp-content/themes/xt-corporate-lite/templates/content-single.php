<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
        <div class="featured-image">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="blog-header">
            <?php get_template_part('templates/entry-meta'); ?>
        </div>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
        <div class="tags">
            <?php echo get_the_tag_list(__("Tags : ","xt-corporate-lite"),' ', ''); ?>
        </div>
      <div class="page-navi">
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'xt-corporate-lite'), 'after' => '</p></nav>']); ?>
    </div>
    <?php comments_template('/templates/comments.php'); ?>
    </article>
<?php endwhile; ?>
