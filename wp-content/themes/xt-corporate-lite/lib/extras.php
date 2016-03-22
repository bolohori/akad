<?php
/**
 * Add <body> classes
 */
function xt_corporate_lite_body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(esc_url(get_permalink())), $classes)) {
      $classes[] = basename(esc_url(get_permalink()));
    }
  }

  // Add class if sidebar is active
  if (Config\xt_corporate_lite_display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('xt_corporate_lite_body_class', 'xt_corporate_lite_body_class');

/**
 * Clean up the_excerpt()
 */
function xt_corporate_lite_excerpt_more() {
  return ' &hellip; <a href="' . esc_url(get_permalink()) . '">' . __('Continued', 'xt-corporate-lite') . '</a>';
}
add_filter('excerpt_more', 'xt_corporate_lite_excerpt_more');

function xt_corporate_lite_backgroud_image(){
    global $xt_corporate_lite_opt;
    $services = isset($xt_corporate_lite_opt['xt_services_background'])?$xt_corporate_lite_opt['xt_services_background']:'';
    $portfolio = isset($xt_corporate_lite_opt['xt_portfolio_background'])?$xt_corporate_lite_opt['xt_portfolio_background']:'';
    $about   = isset($xt_corporate_lite_opt['xt_about_background'])?$xt_corporate_lite_opt['xt_about_background']:'';
    $team    = isset($xt_corporate_lite_opt['xt_team_background'])?$xt_corporate_lite_opt['xt_team_background']:'';
    $clients = isset($xt_corporate_lite_opt['xt_clients_background'])?$xt_corporate_lite_opt['xt_clients_background']:'';
    $contact = isset($xt_corporate_lite_opt['xt_contact_background'])?$xt_corporate_lite_opt['xt_contact_background']:'';
    $contact_color = isset($xt_corporate_lite_opt['xt_contact_backcolor'])?$xt_corporate_lite_opt['xt_contact_backcolor']:'';
    ?>
    <style>
        <?php if(!empty($services['url'])){ ?>
            section#services{
                background-image: url("<?php echo esc_url($services['url']);?>");
                background-repeat: no-repeat;
            }
        <?php } ?>
        <?php if(!empty($portfolio['url'])){ ?>
            section#portfolio{
                background-image: url("<?php echo esc_url($portfolio['url']);?>");
                background-repeat: no-repeat;
            }
        <?php } ?>
        <?php if(!empty($about['url'])){ ?>
            section#about{
                background-image: url("<?php echo esc_url($about['url']);?>");
                background-repeat: no-repeat;
            }
        <?php } ?>
        <?php if(!empty($team['url'])){ ?>
            section#team{
                background-image: url("<?php echo esc_url($team['url']);?>");                background-repeat: no-repeat;
            }
        <?php } ?>
        <?php if(!empty($clients['url'])){ ?>
            aside#clients{
                background-image: url("<?php echo esc_url($clients['url']);?>");
                background-repeat: no-repeat;
            }
        <?php } ?>
        <?php if($contact_color == '' || $contact_color == '#FFFFFF'){ ?>
            section#contact {
                background-color: #222;
                background-image: url(<?php echo get_template_directory_uri();?>/assets/img/map-image.png);
            }
        <?php }else{ ?>
            section#contact {
                background-color: <?php echo $contact_color;?>;
            }
        <?php } ?>

    </style>
<?php
}

add_action('wp_head', 'xt_corporate_lite_backgroud_image');

