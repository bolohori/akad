<?php
/**
 * Template Name: Business Template
 *
 * Displays the Business Template of the theme.
 * @package Enliven
 */

get_header();

if ( is_active_sidebar( 'business-sidebar' ) ) {
	dynamic_sidebar( 'business-sidebar' );
}

get_footer();

?>