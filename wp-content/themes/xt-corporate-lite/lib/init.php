<?php
/**
 * Theme setup
 */
function xt_corporate_lite_setup() {
  // Make theme available for translation
  load_theme_textdomain('xt-corporate-lite', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'xt-corporate-lite')
  ));

    register_nav_menus(array(
        'footer_navigation' => __('Footer Navigation', 'xt-corporate-lite')
    ));

  // Add Feed Links
  add_theme_support( 'automatic-feed-links' );

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  //add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', array('caption', 'comment-form', 'comment-list'));

    // Add Custom Background Support
    add_theme_support( "custom-background");

    // Tell the TinyMCE editor to use a custom stylesheet
    add_editor_style(get_template_directory_uri().'/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'xt_corporate_lite_setup');

/**
 * Setup Custom Width
 */
if ( ! isset( $content_width ) ){
    $content_width = 750;
}


/**
 * Register sidebars
 */
function xt_corporate_lite_widgets_init() {
  register_sidebar(array(
    'name'          => __('Primary Sidebar', 'xt-corporate-lite'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ));
    register_sidebar(array(
        'name'          => __('Page Sidebar', 'xt-corporate-lite'),
        'id'            => 'page-sidebar',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}
add_action('widgets_init','xt_corporate_lite_widgets_init');
