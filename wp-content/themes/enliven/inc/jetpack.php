<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Enliven
 */


function enliven_jetpack_setup() {
	/**
	 * Add theme support for Infinite Scroll.
	 * See: https://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'enliven_infinite_scroll_render',
		'footer'    => 'page',
	) );

    /**
     * Add theme support for Jetpack portfolios
     */
    add_theme_support( 'jetpack-portfolio' );

} // end function enliven_jetpack_setup
add_action( 'after_setup_theme', 'enliven_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function enliven_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function enliven_infinite_scroll_render


/**
 * Flush the Rewrite Rules for the testimonials CPT after the user has activated the theme.
 */
function enliven_flush_rewrite_rules() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'enliven_flush_rewrite_rules' );