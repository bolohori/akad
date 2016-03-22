<?php
// Load the tgm-init if it exists
if (file_exists(dirname(__FILE__).'/tgm/tgm-init.php')) {
    require_once( dirname(__FILE__).'/tgm/tgm-init.php' );
}

// Load the XT Theme options
if (file_exists(dirname(__FILE__).'/theme_options-init.php')) {
    require_once( dirname(__FILE__).'/theme_options-init.php' );
}

// Load ACF options
if (file_exists(dirname(__FILE__).'/acf-options.php')) {
    require_once( dirname(__FILE__).'/acf-options.php' );
}
