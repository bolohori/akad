<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Enliven
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function enliven_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of full-width-layout, boxed-layout.
	$classes[] = get_theme_mod( 'enliven_main_layout', 'full-width-layout' );


	// Adds a class of no-sidebar-full, no-sidebar or sidebar-(right/left) to blogs.
	if ( is_page_template( 'page-templates/front-page.php' ) || is_page_template( 'page-templates/grid-page.php' ) || is_page_template( 'page-templates/full-width-page.php' ) || is_404() || is_post_type_archive( 'jetpack-testimonial' ) ) {
		$classes[] = 'no-sidebar-full';
	} elseif ( ! is_active_sidebar( 'main-sidebar' ) ) {
		$classes[] = 'no-sidebar';
	} else {
		$classes[] = 'sidebar-' . get_theme_mod( 'enliven_post_sidebar_position', 'right' );
	}

	return $classes;
}
add_filter( 'body_class', 'enliven_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function enliven_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'enliven' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'enliven_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function enliven_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'enliven_render_title' );
endif;


/**
 * Sets the post excerpt length to 70 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function enliven_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'enliven_excerpt_length' );


/**
 * Replaces content [...] with ...
 */
function enliven_excerpt_more() {
	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'enliven_excerpt_more' );

/**
 * Custom length for excerpt
 */
function enliven_excerpt( $limit ) {
    return wp_trim_words( get_the_excerpt(), $limit );
}

/**
 * Header class definer
 */
function enliven_header_class() {
	global $post;

	$header_class = '';

	if ( is_front_page() && is_home() ) {

		if( is_home() ) {
			
			if ( get_theme_mod( 'enliven_slider_blog_header', '' ) ) {
				$header_class = 'image-bg-header';
			} else {
				$header_class = 'normal-header';
			}

		} else {
			
			if ( get_theme_mod( 'enliven_front_slider', '' ) ) {
				$header_class = 'image-bg-header';
			} else {
				$header_class = 'normal-header';
			}

		}
		
	} elseif ( is_front_page() ) {
		
		if ( get_theme_mod( 'enliven_front_slider', '' ) ) {
			$header_class = 'image-bg-header';
		} else {
			$header_class = 'normal-header';
		}

	} elseif( is_home() ) {
		
		$header_image = get_theme_mod( 'blog-header-image' );
		if( $header_image || get_theme_mod('enliven_slider_blog_header') ) {
			$header_class = 'image-bg-header';
		} else {
			$header_class = 'normal-header';
		}

	} elseif ( is_page() ) { 

		if( has_post_thumbnail( $post->ID ) ) {
			$header_class = 'image-bg-header';
		} else {
			$header_class = 'normal-header';
		}


	} elseif ( is_post_type_archive('jetpack-portfolio') ) {

		$header_image = get_theme_mod( 'portfolio-header-image' );
		if( $header_image ) {
			$header_class = 'image-bg-header';
		} else {
			$header_class = 'normal-header';
		}

	} else {
		$header_class = 'normal-header';
	}

	return $header_class;

}