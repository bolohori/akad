<?php
global $xt_corporate_lite_opt;
$title = __('Our Amazing Team','xt-corporate-lite');
if(isset($xt_corporate_lite_opt['xt_team_title']) && $xt_corporate_lite_opt['xt_team_title'] != ''){
    $title = $xt_corporate_lite_opt['xt_team_title'];
}
$desc = '';
if(isset($xt_corporate_lite_opt['xt_team_desc']) && $xt_corporate_lite_opt['xt_team_desc'] != ''){
    $desc = $xt_corporate_lite_opt['xt_team_desc'];
}
?>
<section id="team" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo sanitize_text_field($title); ?></h2>
                <h3 class="section-subheading text-muted"><?php echo esc_textarea($desc); ?></h3>
            </div>
        </div>

        <?php
        $xt_query = new WP_Query( array( 'post_type' => 'team', 'posts_per_page' => -1));
        $i = 1;
        if ( $xt_query->have_posts() ) {
            echo '<div class="row">';
            while ( $xt_query->have_posts() ) {
                $xt_query->the_post();
                ?>
                <div class="col-md-4">
                    <div class="team-member">
                        <?php
                        $team_image = get_field('xt_team_image');
                        if(isset($team_image['url']) && $team_image['url'] != ''){
                            $team_image = $team_image['url'];
                        }else{
                            $team_image = get_template_directory_uri().'/assets/img/no_team.jpg';
                        }
                        ?>
                        <img src="<?php echo esc_url($team_image); ?>" class="img-responsive img-circle" alt="">
                        <h4><?php echo get_field('xt_team_full_name'); ?></h4>
                        <p class="text-muted"><?php echo get_field('xt_team_position'); ?></p>
                        <ul class="list-inline social-buttons">
                            <?php
                            $twitter = get_field('xt_team_twitter');
                            $facebook = get_field('xt_team_facebook');
                            $linkedin = get_field('xt_team_linked_in');
                            $google = get_field('xt_team_google');

                            if(isset($twitter) && $twitter!=''){ ?>
                                <li><a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a>
                                </li>
                            <?php }
                            if(isset($facebook) && $facebook!=''){ ?>
                                <li><a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a>
                                </li>
                            <?php }
                            if(isset($linkedin) && $linkedin!=''){ ?>
                                <li><a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a>
                                </li>
                            <?php }
                            if(isset($google) && $google!=''){ ?>
                                <li><a href="<?php echo esc_url($google); ?>"><i class="fa fa-google-plus"></i></a>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
                <?php
                if($i%3 == 0){
                    echo '<div style="clear: both;"></div>';
                }
                $i++;
            }
            echo '</div>';
        } else {
            echo '<p class="no_results_found">';
            esc_attr_e('Opps! No Team Members Found.','xt-corporate-lite');
            echo '</p>';
        }
        wp_reset_postdata();
        ?>
    </div>
</section>