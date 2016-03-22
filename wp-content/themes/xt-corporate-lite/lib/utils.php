<?php
/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function xt_corporate_lite_get_search_form() {
  $form = '';
  locate_template('/templates/searchform.php', true, false);
  return $form;
}
add_filter('get_search_form', 'xt_corporate_lite_get_search_form');
