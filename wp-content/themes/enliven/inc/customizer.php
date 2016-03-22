<?php
/**
 * Enliven Theme Customizer
 *
 * @package Enliven
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function enliven_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


    $wp_customize->add_section(
        'enliven_general_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => __( 'General Settings', 'enliven' )
        )
    );

    // Footer copyright text.
    $wp_customize->add_setting(
        'footer_copyright_text',
        array(
            'default'           => sprintf( __( 'Copyright %s. All rights reserved.', 'enliven' ), esc_html( get_bloginfo( 'name' ) ) ),
            'sanitize_callback' => 'enliven_sanitize_html'
        )
    );
    $wp_customize->add_control(
        'footer_copyright_text',
        array(
            'settings'      => 'footer_copyright_text',
            'section'       => 'enliven_general_settings',
            'type'          => 'textarea',
            'label'         => __( 'Footer copyright text', 'enliven' ),
            'description'   => __( 'Copyright or other text to be displayed in the site footer. HTML allowed.', 'enliven' )
        )
    );

    /*$wp_customize->add_setting(
        'enliven_custom_excerpt_length',
        array (
            'default'           => '25',
            'sanitize_callback' => 'esc_attr',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'enliven_custom_excerpt_length',
        array (
            'label'         => __( 'Excerpt length', 'enliven' ),
            'section'       => 'enliven_general_settings',
            'priority'      => 3,
            'type'          => 'text',
        )
    );*/

    /*$wp_customize->add_setting(
        'enliven_menu_type',
        array(
            'default'           => 'sticky-menu',
            'sanitize_callback' => 'enliven_sanitize_menu_type',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'enliven_menu_type',
        array(
            'label'     => __( 'Select the menu type.', 'enliven' ),
            'section'   => 'enliven_general_settings',
            'priority'  => 1,
            'type'      => 'radio',
            'choices'   => array (
                'sticky-menu' => __( 'Sticky Menu', 'enliven' ),
                'normal-menu' => __( 'Normal Menu', 'enliven' )
            )
        )
    );*/
    
    // Logo image
    $wp_customize->add_setting(
        'site_logo',
        array(
            'sanitize_callback' => 'enliven_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
                'label'         => __( 'Site Logo', 'enliven' ),
                'section'       => 'title_tagline',
                'settings'      => 'site_logo',
                'description'   => __( 'Upload a logo for your website. Recommended height for your logo is 120px.', 'enliven' ),
            )
        )
    );

    // Logo, title and description chooser
    $wp_customize->add_setting(
        'site_title_option',
        array(
            'default'           => 'text-only',
            'sanitize_callback' => 'enliven_sanitize_select',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'site_title_option',
        array(
            'label'         => __( 'Display site title / logo.', 'enliven' ),
            'section'       => 'title_tagline',
            'type'          => 'radio',
            'description'   => __( 'Choose your preferred option.', 'enliven' ),
            'choices'   => array (
                'text-only'     => __( 'Display site title and description only.', 'enliven' ),
                'logo-only'     => __( 'Display site logo image only.', 'enliven' ),
                'text-logo'     => __( 'Display both site title and logo image.', 'enliven' ),
                'display-none'  => __( 'Display none', 'enliven' )
            )
        )
    );

    /**
     * Slider
     */
    $wp_customize->add_panel (
        'enliven_slider_panel',
        array(
            'priority'      => 30,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => __( 'Slider', 'enliven' ),
            'description'   => __( 'Use this panel to set your slider settings.', 'enliven' )
        )
    );

    $wp_customize->add_section( 
        'enliven_slider_settings', 
        array(
            'title'     => __( 'Slider Settings.', 'enliven' ),
            'priority'  => 30,
            'panel'     => 'enliven_slider_panel',
            'description'   => __( 'Slider should be activated from <b>Front Page Settings</b> or <b>Blog Settings</b> in order to display the slider on front page or blog posts listing page.', 'enliven' )
        ) 
    );

    $wp_customize->add_setting(
        'display_slider_title',
        array(
            'default'           => true,
            'transport'         => 'refresh',
            'sanitize_callback' => 'enliven_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'display_slider_title',
        array(
            'label'         => __( 'Display page title as slide title.', 'enliven' ),
            'section'       => 'enliven_slider_settings',
            'type'          => 'checkbox'
        )
    ); 

    $wp_customize->add_setting(
        'slider_content_switcher',
        array(
            'default'           => 'display-excerpt',
            'sanitize_callback' => 'enliven_sanitize_select',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'slider_content_switcher',
        array(
            'label'         => __( 'Select what to display as slide content.', 'enliven' ),
            'section'       => 'enliven_slider_settings',
            'type'          => 'radio',
            //'description'   => __( 'Choose your preferred option.', 'enliven' ),
            'choices'   => array (
                'display-excerpt'   => __( 'Display page excerpt.', 'enliven' ),
                'display-content'   => __( 'Display all page content.', 'enliven' ),
                'display-none'      => __( 'Display none', 'enliven' )
            )
        )
    );   

    for ( $i=1; $i <= 5; $i++ ) {

        $wp_customize->add_section( 
            'enliven_slide_' . $i, 
            array(
                'title'     => sprintf( __( 'Slide %d.', 'enliven' ), $i ),
                'priority'  => 30,
                'panel'     => 'enliven_slider_panel',
                'description'   => __( 'Featured image of the selected page will be displayed as the slide image.', 'enliven' )
            ) 
        );

        // Page select for slider
        $wp_customize->add_setting( 
            'slider_page_' . $i, 
            array(
                'default'           => '',
                'sanitize_callback' => 'absint'
            )
        );

        $wp_customize->add_control( 
            'slider_page_' . $i, 
            array(
                'label'         => sprintf( __( 'Select a page for slide %d.', 'enliven' ), $i ),
                'section'       => 'enliven_slide_' . $i,
                'type'          => 'dropdown-pages'
            ) 
        );

        // Button 1 Text.
        $wp_customize->add_setting(
            'slide_' . $i . '_btn_one_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'enliven_sanitize_text',
                'transport'         => 'refresh'
            )
        );    
        
        $wp_customize->add_control(
            'slide_' . $i . '_btn_one_text',
            array(
                'settings'      => 'slide_' . $i . '_btn_one_text',
                'label'         => sprintf( __( 'Slide %d first button text.', 'enliven' ), $i ),
                'section'       => 'enliven_slide_' . $i,
                'type'          => 'text',
            )
        );  

        // Button 1 URL
        $wp_customize->add_setting(
            'slide_' . $i . '_btn_one_url',
            array(
                'default'           => '',
                'sanitize_callback' => 'enliven_sanitize_url',
                'transport'         => 'refresh'
            )
        );    
        
        $wp_customize->add_control(
            'slide_' . $i . '_btn_one_url',
            array(
                'settings'      => 'slide_' . $i . '_btn_one_url',
                'label'         => sprintf( __( 'Slide %d first button url.', 'enliven' ), $i ),
                'section'       => 'enliven_slide_' . $i,
                'type'          => 'text',
            )
        );        

        // Button 2 text.
        $wp_customize->add_setting(
            'slide_' . $i . '_btn_two_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'enliven_sanitize_text',
                'transport'         => 'refresh'
            )
        );    
        
        $wp_customize->add_control(
            'slide_' . $i . '_btn_two_text',
            array(
                'settings'      => 'slide_' . $i . '_btn_two_text',
                'label'         => sprintf( __( 'Slide %d second button text.', 'enliven' ), $i ),
                'section'       => 'enliven_slide_' . $i,
                'type'          => 'text',
            )
        );

        // Button 2 URL
        $wp_customize->add_setting(
            'slide_' . $i . '_btn_two_url',
            array(
                'default'           => '',
                'sanitize_callback' => 'enliven_sanitize_url',
                'transport'         => 'refresh'
            )
        );    
        
        $wp_customize->add_control(
            'slide_' . $i . '_btn_two_url',
            array(
                'settings'      => 'slide_' . $i . '_btn_two_url',
                'label'         => sprintf( __( 'Slide %d second button url.', 'enliven' ), $i ),
                'section'       => 'enliven_slide_' . $i,
                'type'          => 'text',
            )
        );           

    }   

    /**
     * Header Panel
     */
    $wp_customize->add_panel (
        'enliven_header_panel',
        array(
            'priority'      => 10,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => __( 'Header Settings', 'enliven' ),
            'description'   => __( 'Use this panel to set your header area settings', 'enliven' )
        )
    );

    /**
     * Menu - Sticky, Fixed
     */
    /*$wp_customize->add_section(
        'enliven_menu_options',
        array(
            'priority'      => 160,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => __( 'Menu Settings', 'enliven' ),
            'panel'         => 'enliven_header_panel'
        )
    );


    /**
     * Front Page Options
     */
    $wp_customize->add_section( 'enliven_frontpage', array(
        'title'    => __( 'Front Page Settings', 'enliven' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting(
        'enliven_front_slider',
        array(
            'default'           => false,
            'transport'         => 'refresh',
            'sanitize_callback' => 'enliven_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'enliven_front_slider',
        array(
            'label'         => __( 'Activate slider.', 'enliven' ),
            'section'       => 'enliven_frontpage',
            'type'          => 'checkbox'
        )
    );


    /**
     * Blog Settings
     */
    $wp_customize->add_section( 'enliven_blog_section', array(
        'title'    => __( 'Blog Settings', 'enliven' ),
        'priority' => 35,
    ) );

    $wp_customize->add_setting(
        'enliven_slider_blog_header',
        array(
            'default'           => false,
            'transport'         => 'refresh',
            'sanitize_callback' => 'enliven_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'enliven_slider_blog_header',
        array(
            'label'         => __( 'Activate slider on blog.', 'enliven' ),
            'section'       => 'enliven_blog_section',
            /*'description'   => __( 'This setting only works if the blog is not set as front page.' ), */
            'type'          => 'checkbox'
        )
    );    

    $wp_customize->add_setting(
        'blog_page_title',
        array(
            'default'           => __( 'Blog', 'enliven' ),
            'sanitize_callback' => 'enliven_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'blog_page_title',
        array(
            'label'         => __( 'Blog title', 'enliven' ),
            //'description'   => __( 'Leave this empty to display the default blog page title', 'enliven' ),
            'section'       => 'enliven_blog_section',
            'type'          => 'text',
        )
    );    

    $wp_customize->add_setting(
        'blog_subtitle',
        array(
            'default'           => __( 'Latest Articles.', 'enliven' ),
            'sanitize_callback' => 'enliven_sanitize_text',
        )
    );
    $wp_customize->add_control(
        'blog_subtitle',
        array(
            'label'     => __( 'Blog secondary title', 'enliven' ),
            'section'   => 'enliven_blog_section',
            'type'      => 'text',
        )
    );

    $wp_customize->add_setting( 
        'blog-header-image',
        array(
            'sanitize_callback' => 'enliven_sanitize_image'
        ) 
    );  
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'blog-header-image',
            array(
                'label'         => __( 'Blog Header Image', 'enliven' ),
                'section'       => 'enliven_blog_section',
                'settings'      => 'blog-header-image'
            )
        )
    );


    /**
     * Portfolio Settings
     */
    $wp_customize->add_section( 'enliven_portfolio_section', array(
        'title'             => __( 'Portfolio Settings', 'enliven' ),
        'priority'          => 36,
        'description'       => __( 'This section settings is only for portfolio archive page.', 'enliven' ),
        'active_callback'   => 'is_jetpack_cpt_active'
    ) );

    $wp_customize->add_setting(
        'portfolio_page_title',
        array(
            'default'           => __( 'Portfolio', 'enliven' ),
            'sanitize_callback' => 'enliven_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'portfolio_page_title',
        array(
            'label'     => __( 'Portfolio archive title', 'enliven' ),
            'section'   => 'enliven_portfolio_section',
            'type' => 'text',
        )
    );    

    $wp_customize->add_setting(
        'portfolio_page_subtitle',
        array(
            'default'           => __( 'What we have done so far.', 'enliven' ),
            'sanitize_callback' => 'enliven_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'portfolio_page_subtitle',
        array(
            'label'     => __( 'Portfolio archive secondary title', 'enliven' ),
            'section'   => 'enliven_portfolio_section',
            'type'      => 'text',
        )
    );

    $wp_customize->add_setting(
        'portfolio_page_description',
        array(
            'default'            => '',
            'sanitize_callback'  => 'enliven_sanitize_textarea',
        )
    );

    $wp_customize->add_control(
        'portfolio_page_description',
        array(
            'label'         => __( 'Portfolio archive description.', 'enliven' ),
            'section'       => 'enliven_portfolio_section',
            'type'          => 'textarea',
        )
    );    

    $wp_customize->add_setting( 
        'portfolio-header-image',
        array(
            'sanitize_callback' => 'enliven_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'portfolio-header-image',
            array(
                'label'     => __( 'Portfolio Header Image', 'enliven' ),
                'section'   => 'enliven_portfolio_section',
                'settings'  => 'portfolio-header-image'
            )
        )
    );

    /**
     * Testimonial Settings
     */
    $wp_customize->add_section( 'enliven_testimonial_section', array(
        'title'             => __( 'Testimonial Settings', 'enliven' ),
        'priority'          => 36,
        'description'       => __( 'This section settings is only for testimonial archive page.', 'enliven' ),
        'active_callback'   => 'is_jetpack_cpt_active'
    ) );

    $wp_customize->add_setting(
        'testimonial_page_title',
        array(
            'default'           => __( 'Testimonial', 'enliven' ),
            'sanitize_callback' => 'enliven_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'testimonial_page_title',
        array(
            'label'     => __( 'Testimonial archive title', 'enliven' ),
            'section'   => 'enliven_testimonial_section',
            'type' => 'text',
        )
    );    

    $wp_customize->add_setting(
        'testimonial_page_subtitle',
        array(
            'default'           => __( 'What others say about us?', 'enliven' ),
            'sanitize_callback' => 'enliven_sanitize_text',
        )
    );

    $wp_customize->add_control(
        'testimonial_page_subtitle',
        array(
            'label'     => __( 'Testimonial archive secondary title', 'enliven' ),
            'section'   => 'enliven_testimonial_section',
            'type'      => 'text',
        )
    );

    $wp_customize->add_setting(
        'testimonial_page_description',
        array(
            'default'            => '',
            'sanitize_callback'  => 'enliven_sanitize_textarea',
        )
    );

    $wp_customize->add_control(
        'testimonial_page_description',
        array(
            'label'         => __( 'Testimonial archive description.', 'enliven' ),
            'section'       => 'enliven_testimonial_section',
            'type'          => 'textarea',
        )
    );    

    $wp_customize->add_setting( 
        'testimonial-header-image',
        array(
            'sanitize_callback' => 'enliven_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'testimonial-header-image',
            array(
                'label'     => __( 'Testimonial Header Image', 'enliven' ),
                'section'   => 'enliven_testimonial_section',
                'settings'  => 'testimonial-header-image'
            )
        )
    );


    /**
     * Layout settings.
     */
    $wp_customize->add_section(
        'enliven_layout_options',
        array (
            'priority'      => 37,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => __( 'Layout Settings', 'enliven' )
        )
    );
    /* Site width */
    $wp_customize->add_setting(
        'enliven_main_layout',
        array (
            'default'           => 'enliven-full-width',
            'sanitize_callback' => 'enliven_sanitize_main_layout',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'enliven_main_layout',
        array(
            'label'     => __( 'Select the main layout for site.', 'enliven' ),
            'section'   => 'enliven_layout_options',
            'priority'  => 1,
            'type'      => 'radio',
            'choices'   => array (
                'enliven-full-width' => __( 'Full width layout', 'enliven' ),
                'enliven-boxed'      => __( 'Boxed layout - 1240px', 'enliven' )
            )
        )
    );
    /* Post sidebar position */
    $wp_customize->add_setting(
        'enliven_post_sidebar_position',
        array (
            'default'           => 'right',
            'sanitize_callback' => 'enliven_sanitize_sidebar_position',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'enliven_post_sidebar_position',
        array (
            'label'         => __( 'Default sidebar position.', 'enliven' ),
            'section'       => 'enliven_layout_options',
            'priority'      => 2,
            'type'          => 'radio',
            'choices'       => array (
                'left'  => __( 'Left', 'enliven' ),
                'right' => __( 'Right', 'enliven' )
            ),
        )
    );    


}
add_action( 'customize_register', 'enliven_customize_register' );


/**
 * Sanitize text box.
 * 
 * @param string $input
 * @return string
 */
function enliven_sanitize_text( $input ) {
    return esc_html( $input );
}


/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function enliven_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * URL sanitization.
 * 
 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
 *
 * @param string $url URL to sanitize.
 * @return string Sanitized URL.
 */
function enliven_sanitize_url( $url ) {
    return esc_url_raw( $url );
}

/**
 * Select sanitization
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function enliven_sanitize_select( $input, $setting ) {
    
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize textarea.
 * 
 * @param string $input
 * @return string
 */
function enliven_sanitize_textarea( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize image.
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function enliven_sanitize_image( $image, $setting ) {
    /*
     * Array of valid image file types.
     *
     * The array includes image mime types that are included in wp_get_mime_types()
     */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
    // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
    // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}


/**
 * Sanitize the Sidebar Position value.
 *
 * @param string $position.
 * @return string (left|right).
 */
function enliven_sanitize_sidebar_position( $position ) {
    if ( ! in_array( $position, array( 'left', 'right' ) ) ) {
        $position = 'right';
    }
    return $position;
}

/**
 * Sanitize the layout width postion value.
 *
 * @param string $layout.
 * @return string (full-width|fixed-width).
 */
function enliven_sanitize_main_layout( $layout ) {
    if ( ! in_array( $layout, array( 'enliven-full-width', 'enliven-boxed' ) ) ) {
        $layout = 'enliven-full-width';
    } 

    return $layout;
}
/**
 * Sanitize the menu_type
 *
 * @param string $menu_type.
 * @return string (sticky-menu|normal-menu).
 */
function enliven_sanitize_menu_type( $menu_type ) {
    if ( ! in_array( $menu_type, array( 'sticky-menu', 'normal-menu' ) ) ) {
        $menu_type = 'sticky-menu';
    } 

    return $menu_type;
}

/**
 * HTML sanitization 
 *
 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 *
 * @param string $html HTML to sanitize.
 * @return string Sanitized HTML.
 */
function enliven_sanitize_html( $html ) {
    return wp_filter_post_kses( $html );
}

/**
 * Checks whether the Jetpack Custom Content Type is active
 * @return bool
 */
function is_jetpack_cpt_active() {
    if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'custom-content-types' ) ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function enliven_customize_preview_js() {
    wp_enqueue_script( 'enliven_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'enliven_customize_preview_js' );
