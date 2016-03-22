<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

function xt_theme_register_required_plugins() {
	$plugins = array(
        array(
            'name'               => __('XT Corporate ToolKit', 'xt-corporate-lite' ),
            'slug'               => 'xt-corporate-toolkit',
            'required'           => true,
        ),
        array(
            'name'               => __('Redux Framework', 'xt-corporate-lite' ),
            'slug'               => 'redux-framework',
            'required'           => true,
        ),
		array(
            'name'               => __('Advanced Custom Fields', 'xt-corporate-lite' ),
            'slug'               => 'advanced-custom-fields',
            'required'           => true,
        ),
	);

	$config = array(
		'default_path' => '',                           // Default absolute path to bundled plugins.
		'menu'         => 'install-required-plugins',   // Menu slug.
		'parent_slug'  => 'themes.php',                 // Parent menu slug.
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,                         // Show admin notices or not.
		'is_automatic' => true,                         // Automatically activate plugins after installation or not.
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'xt_theme_register_required_plugins' );
