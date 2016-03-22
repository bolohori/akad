<?php
global $xt_corporate_lite_opt;
$site_logo = array();
if(isset($xt_corporate_lite_opt['xt_site_logo']) && $xt_corporate_lite_opt['xt_site_logo'] != '') {
    $site_logo = $xt_corporate_lite_opt['xt_site_logo'];
}
?>

<!-- Navigation -->

<nav class="navbar navbar-default navbar-fixed-top navbar-page">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"><?php _e('Toggle navigation','xt-corporate-lite'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

                <?php
                if(isset($site_logo['url']) && $site_logo['url'] != ''){
                    $xt_logo = $site_logo['url'];
                    echo '<a class="page-scroll" href="'.esc_url(get_site_url()).'">';
                    echo '<img class="site_logo" src="'.esc_url($xt_logo).'">';
                    echo '</a>';
                    echo '<p class="site_description">'.get_bloginfo("description").'</p>';
                }else{
                    echo '<a class="navbar-brand page-scroll" href="'.esc_url(get_site_url()).'">';
                    bloginfo('site_title');
                    echo '</a>';
                    echo '<p class="site_description">'.get_bloginfo("description").'</p>';
                }
                ?>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
            if ( has_nav_menu( 'primary_navigation' ) ) {
                wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav navbar-right', 'walker' => new xt_corporate_lite_navwalker(), 'depth' => '3']);
            }
            ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
    <div class="page_header">
        <div class="container">
            <div class="page-title">
                <h1><?php echo xt_corporate_lite_title(); ?></h1>
            </div>
        </div>
    </div>
