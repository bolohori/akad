<?php
global $xt_corporate_lite_opt;
?>

<?php
    // Page Content
    while (have_posts()) : the_post();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    get_template_part('templates/content', 'page');
                    ?>
                </div>
            </div>
        </div>
        <?php
    endwhile;

    // Services Section
    if(isset($xt_corporate_lite_opt['xt_is_services']) && $xt_corporate_lite_opt['xt_is_services'] == '1'){
        get_template_part('templates/section', 'services');
    }

    // Portfolio Grid Section
    if(isset($xt_corporate_lite_opt['xt_is_portfolio']) && $xt_corporate_lite_opt['xt_is_portfolio'] == '1'){
        get_template_part('templates/section', 'portfolio');
    }

    // About Section
    if(isset($xt_corporate_lite_opt['xt_is_about']) && $xt_corporate_lite_opt['xt_is_about'] == '1'){
        get_template_part('templates/section', 'aboutus');
    }

    // Team Section
    if(isset($xt_corporate_lite_opt['xt_is_team']) && $xt_corporate_lite_opt['xt_is_team'] == '1'){
        get_template_part('templates/section', 'team');
    }

    // Clients Aside
    if(isset($xt_corporate_lite_opt['xt_is_clients']) && $xt_corporate_lite_opt['xt_is_clients'] == '1'){
        get_template_part('templates/section', 'clients');
    }

    // Contact Section
    if(isset($xt_corporate_lite_opt['xt_is_contact']) && $xt_corporate_lite_opt['xt_is_contact'] == '1'){
        get_template_part('templates/section', 'contactus');
    }
?>