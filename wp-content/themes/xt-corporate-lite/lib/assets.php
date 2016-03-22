<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/xt_corporate_lite_common.css
 *
 * Enqueue scripts in the following order:
 * 1. /theme/assets/js/main.js
 */

class Xt_corporate_lite_JsonManifest{
  private $manifest;

  public function __construct($manifest_path) {
    if (file_exists($manifest_path)) {
      $this->manifest = json_decode(wp_remote_fopen($manifest_path), true);
    } else {
      $this->manifest = array();
    }
  }

  public function get() {
    return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    if (is_null($key)) {
      return $collection;
    }
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        return $default;
      } else {
        $collection = $collection[$segment];
      }
    }
    return $collection;
  }
}

function xt_corporate_lite_asset_path($filename) {
  $dist_path = get_template_directory_uri() . DIST_DIR;
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  static $manifest;

  if (empty($manifest)) {
    $manifest_path = get_template_directory() . DIST_DIR . 'assets.json';
    $manifest = new Xt_corporate_lite_JsonManifest($manifest_path);
  }

  if (array_key_exists($file, $manifest->get())) {
    $manifest_array = $manifest->get();
    return $dist_path . $directory . $manifest_array[$file];
  } else {
    return $dist_path . $directory . $file;
  }
}

function xt_corporate_lite_assets() {
    wp_enqueue_style('xt_corporate_lite_common', xt_corporate_lite_asset_path('css/xt_corporate_lite_common.css'), false, null);
    global $xt_corporate_lite_opt;
    $skin = isset($xt_corporate_lite_opt['xt_skin'])?$xt_corporate_lite_opt['xt_skin']:'';
    if(sanitize_text_field($skin) == 'blue'){
        wp_enqueue_style('xt_corporate_lite_css_blue', xt_corporate_lite_asset_path('css/xt_corporate_lite_main-blue.css'), false, null);
    }elseif($skin == 'green'){
        wp_enqueue_style('xt_corporate_lite_css_green', xt_corporate_lite_asset_path('css/xt_corporate_lite_main-green.css'), false, null);
    }elseif($skin == 'red'){
        wp_enqueue_style('xt_corporate_lite_css_red', xt_corporate_lite_asset_path('css/xt_corporate_lite_main-red.css'), false, null);
    }elseif($skin == 'yellow'){
        wp_enqueue_style('xt_corporate_lite_css_yello', xt_corporate_lite_asset_path('css/xt_corporate_lite_main-yellow.css'), false, null);
    }elseif($skin == 'coffee'){
        wp_enqueue_style('xt_corporate_lite_css_coffee', xt_corporate_lite_asset_path('css/xt_corporate_lite_main-coffee.css'), false, null);
    }else{
        wp_enqueue_style('xt_corporate_lite_css_blue', xt_corporate_lite_asset_path('css/xt_corporate_lite_main-blue.css'), false, null);
    }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
	wp_enqueue_script('xt_corporate_lite_bootstrap', xt_corporate_lite_asset_path('js/bootstrap.min.js'), array('jquery'), null, true);
	wp_enqueue_script('xt_corporate_lite_hoverERM', xt_corporate_lite_asset_path('js/hoverERM.js'), array('jquery'), null, true);
	wp_enqueue_script('xt_corporate_lite_responsive_menu', xt_corporate_lite_asset_path('js/responsive-menu.js'), array('jquery'), null, true);
    wp_enqueue_script('xt_corporate_lite_xt_js', xt_corporate_lite_asset_path('js/main.js'), array('jquery'), null, true);
    wp_enqueue_script('xt_corporate_lite_jquery-easing', xt_corporate_lite_asset_path('js/jquery.easing.min.js'), array('jquery'), null, true);
    wp_enqueue_script('xt_corporate_lite_owl-carousel', xt_corporate_lite_asset_path('js/owl.carousel.js'), array('jquery'), null, true);
    wp_enqueue_script('xt_corporate_lite_google-map', 'http://maps.googleapis.com/maps/api/js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'xt_corporate_lite_assets', 100);
