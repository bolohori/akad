<div class="entry-meta">
    <span class="byline author vcard">
        <i class="fa fa-user"></i>
        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author" class="fn">
            <?php echo get_the_author(); ?>
        </a>
    </span>
    <span class="category">
        <i class="fa fa-briefcase"></i>
        <span><?php the_category(', '); ?></span>
    </span>
    <span class="date">
        <i class="fa fa-calendar-o"></i>
        <time class="updated" datetime="<?php echo get_the_time('c'); ?>">
            <i class="fa fa-calandereer"></i>
            <span>
                <a href="<?php echo esc_url(get_permalink()); ?>" rel="Date">
                    <?php echo get_the_date(); ?>
                </a>
            </span>
        </time>
    </span>

    <?php if(comments_open()) { ?>
        <span class="comment">
            <i class="fa fa-comment"></i>
            <span>
                <?php comments_number(__('No Comments', 'xt-corporate-lite'),__('1 Comment', 'xt-corporate-lite'),__('% Comments', 'xt-corporate-lite')); ?>
            </span>
        </span>
    <?php } ?>

    <span class="edit">
        <?php edit_post_link(__('Edit','xt-corporate-lite')); ?>
    </span>
</div>
