<?php
/**
 * Enliven functions and definitions
 * 
 * @package Enliven
 */

if ( ! function_exists( 'enliven_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function enliven_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Enliven, use a find and replace
	 * to change 'enliven' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'enliven', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'enliven-featured', 720, 460, true );
	add_image_size( 'enliven-one-by-one', 720, 720, true );
	add_image_size( 'enliven-small-thumb', 300, 300, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'enliven' ),
		'social'  => esc_html__( 'Social Media Menu', 'enliven' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	/*add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );*/

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'enliven_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function enliven_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'enliven_content_width', 690 );
	}
	add_action( 'after_setup_theme', 'enliven_content_width', 0 );

}
endif; // enliven_setup
add_action( 'after_setup_theme', 'enliven_setup' );


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function enliven_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'enliven' ),
		'id'            => 'main-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="enl-widget widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="enl-widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Business Template.', 'enliven' ),
		'id'            => 'business-sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="%2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="enl-front-widget-title">',
		'after_title'   => '</h1>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Left Footer.', 'enliven' ),
		'id'            => 'footer-left',
		'description'   => __('Left Footer Widget Area', 'enliven'),
		'before_widget' => '<div class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Mid Footer.', 'enliven' ),
		'id'            => 'footer-mid',
		'description'   => __('Middle Footer Widget Area', 'enliven'),
		'before_widget' => '<div class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );	

	register_sidebar( array(
		'name'          => esc_html__( 'Right Footer.', 'enliven' ),
		'id'            => 'footer-right',
		'description'   => __('Right Footer Widget Area', 'enliven'),
		'before_widget' => '<div class="footer-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="footer-widget-title">',
		'after_title'   => '</h1>',
	) );	


}
add_action( 'widgets_init', 'enliven_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function enliven_scripts() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.css', array(), '3.3.5', false );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array(), '4.4.0' );

	wp_enqueue_style( 'enliven-styles', get_stylesheet_uri() );

	wp_enqueue_script( 'enliven-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'scrollreveal', get_template_directory_uri() . '/js/scrollreveal.min.js', array(), '', true );

	wp_enqueue_script( 'enliven-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '', true );

	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/assets/flexslider/jquery.flexslider-min.js', array('jquery'), '', true );

	wp_enqueue_script( 'enliven-flex-custom-js', get_template_directory_uri() . '/assets/flexslider/flex-custom.js', array(), '', true );

	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/flexslider/flexslider.css', '', '', 'screen' );

	wp_enqueue_script( 'enliven-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'respond', get_template_directory_uri().'/js/respond.min.js' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
 
    wp_enqueue_script( 'html5shiv',get_template_directory_uri().'/js/html5shiv.js');
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

}
add_action( 'wp_enqueue_scripts', 'enliven_scripts' );

function enliven_fonts_url() {

    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'enliven' );

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $montserrat = _x( 'on', 'Montserrat font: on or off', 'enliven' );

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    //$libre_baskerville = _x( 'on', 'Libre Baskerville font: on or off', 'enliven' );

    if ( 'off' !== $open_sans || 'off' !== $montserrat || 'off' !== $libre_baskerville ) {

        $font_families = array();

        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:400italic,700italic,700,600,400';
        }

        if ( 'off' !== $montserrat ) {
            $font_families[] = 'Montserrat:400,700';
        }

        /*if ( 'off' !== $libre_baskerville ) {
            $font_families[] = 'Libre Baskerville:400,400italic,700';
        }*/

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    }

    return $fonts_url;
}

/**
* Enqueue Google fonts.
*/
function enliven_font_styles() {
    wp_enqueue_style( 'enliven-fonts', enliven_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'enliven_font_styles' );

/**
* Admin Scripts
*/
function enliven_admin_scripts($hook) {
	wp_enqueue_style( 'enliven-admin-css', get_template_directory_uri() . '/css/admin.css', false );
	if( 'widgets.php' == $hook ) {
		wp_enqueue_script('media-upload');
	    wp_enqueue_script('thickbox');
	    wp_enqueue_style('thickbox');
	    wp_enqueue_media();
		wp_enqueue_script( 'enliven-admin-js', get_template_directory_uri() . '/js/custom-admin.js', array('jquery'), '', true );
	}
}
add_action( 'admin_enqueue_scripts', 'enliven_admin_scripts' );

/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function enliven_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'enliven_add_excerpt_support_for_pages' );

/**
 * Filter portfolio page template if the jetpack is not active.
 *
 * @param array    $page_templates Page templates.
 * @return array (Maybe) modified page templates array.
 */
function enliven_filter_theme_page_templates( $page_templates ) {
 
	if ( ! class_exists( 'Jetpack' ) ) {
		if ( isset( $page_templates['page-templates/portfolio.php'] ) ) {
            unset( $page_templates['page-templates/portfolio.php'] );
        }
	}

    return $page_templates;
}
add_filter( 'theme_page_templates', 'enliven_filter_theme_page_templates' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'enliven_register_required_plugins' );

function enliven_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'      => 'Jetpack by WordPress.com',
			'slug'      => 'jetpack',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'enliven',               // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}

/**
 *  Load Enliven Homepage Slider
 */
require get_template_directory() . '/inc/slider.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Theme info page.
 */
require get_template_directory() . '/inc/theme-info.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/widgets/call-to-action-widget.php';

require get_template_directory() . '/inc/widgets/blocks-widget.php';

require get_template_directory() . '/inc/widgets/blog-posts-widget.php';

require get_template_directory() . '/inc/widgets/featured-pages-widget.php';

require get_template_directory() . '/inc/widgets/portfolio-widget.php';

require get_template_directory() . '/inc/widgets/testimonial-widget.php';

require get_template_directory() . '/inc/widgets/clients-widget.php';