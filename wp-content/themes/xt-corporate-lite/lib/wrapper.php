<?php
/**
 * Theme wrapper
 *
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */

function xt_corporate_lite_template_path() {
  return Xt_corporate_lite_SageWrapping::$main_template;
}

function xt_corporate_lite_sidebar_path() {
  return new Xt_corporate_lite_SageWrapping('templates/sidebar.php');
}

class Xt_corporate_lite_SageWrapping {
  // Stores the full path to the main template file
  public static $main_template;

  // Basename of template file
  public $slug;

  // Array of templates
  public $templates;

  // Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
  public static $base;

  public function __construct($template = 'base.php') {
    $this->slug = basename($template, '.php');
    $this->templates = array($template);

    if (self::$base) {
      $str = substr($template, 0, -4);
      array_unshift($this->templates, sprintf($str . '-%s.php', self::$base));
    }
  }

  public function __toString() {
    $this->templates = apply_filters('sage/wrap_' . $this->slug, $this->templates);
    return locate_template($this->templates);
  }

  public static function xt_corporate_lite_wrap($main) {
    // Check for other filters returning null
    if (!is_string($main)) {
      return $main;
    }

    self::$main_template = $main;
    self::$base = basename(self::$main_template, '.php');

    if (self::$base === 'index') {
      self::$base = false;
    }

    return new Xt_corporate_lite_SageWrapping();
  }
}
add_filter('template_include', array('Xt_corporate_lite_SageWrapping', 'xt_corporate_lite_wrap'), 99);
