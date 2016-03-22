<?php
/**
 * Xylus includes
 *
 * The $xt_corporate_lite_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */
$xt_corporate_lite_includes = array(
    'admin/admin-init.php',          //Redux Framework and Required Plugin
    'lib/utils.php',                 // Utility functions
    'lib/init.php',                  // Initial theme setup and constants
    'lib/wrapper.php',               // Theme wrapper class
    'lib/conditional-tag-check.php', // ConditionalTagCheck class
    'lib/config.php',                // Configuration
    'lib/assets.php',                // Scripts and stylesheets
    'lib/titles.php',                // Page titles
    'lib/extras.php',                // Custom functions
    'lib/navwalker.php'              // nav walker
);

foreach ($xt_corporate_lite_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'xt-corporate-lite'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);