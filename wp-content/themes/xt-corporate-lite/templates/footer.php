<?php global $xt_corporate_lite_opt;
$copyright = isset($xt_corporate_lite_opt['xt_copyright'])?$xt_corporate_lite_opt['xt_copyright']:'';
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 copyright">
                    <?php
                    if(isset($xt_corporate_lite_opt['xt_credit']) && $xt_corporate_lite_opt['xt_credit'] == '1') {
                        $authorURI = wp_get_theme()->get('AuthorURI');
                        $link = sprintf(wp_kses(__('Theme by <a href="%s" target="_blank">Xylus Themes</a> | Powered by WordPress <br>', 'xt-corporate-lite'), array('a' => array('href' => array()))), esc_url($authorURI));
                        echo $link;
                        echo esc_html($copyright);
                    }
                    ?>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <?php
                    $twitter = $xt_corporate_lite_opt['xt_footer_twitter'];
                    $facebook = $xt_corporate_lite_opt['xt_footer_facebook'];
                    $linkedin = $xt_corporate_lite_opt['xt_footer_linkedin'];
                    $google = $xt_corporate_lite_opt['xt_footer_google'];

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
            <div class="col-md-4">
                <?php
                if (has_nav_menu('footer_navigation')) :
                wp_nav_menu(array('theme_location' => 'footer_navigation', 'items_wrap' => '<ul id="%1$s" class="list-inline quicklinks">%3$s</ul>'));
                endif;
                ?>
            </div>
        </div>
    </div>
</footer>