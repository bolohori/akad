<?php

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "xt_corporate_lite_opt";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'XT Options', 'xt-corporate-lite' ),
        'page_title'           => __( 'XT Options', 'xt-corporate-lite' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,

        'customizer_only'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.
        'show_options_object'  => false,
        // Shows the Options Object panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'     => ' ',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => false,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
    );


    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
    } else {
    }

    // Add content after the form.

    $authorURI = wp_get_theme()->get('AuthorURI');

    $args['footer_text'] = sprintf(wp_kses(__('Thanks for Choosing Us | Theme by <a href="%s" target="_blank">Xylus Themes</a> | Powered by WordPress<br>', 'xt-corporate-lite'), array('a' => array('href' => array()))), esc_url($authorURI));

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

/*
 * START SECTIONS
 */

/* General Settings */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'General Settings', 'xt-corporate-lite' ),
        'id'     => 'general_settings',
        'icon'   => 'el el-cogs',
        'fields' => array(
            array(
                'id'        => 'xt_site_logo',
                'type'      => 'media',
                'title'     => __('Logo', 'xt-corporate-lite'),
                'desc'      => __('upload Site Logo.', 'xt-corporate-lite'),
                'subtitle'  => __('Upload a Logo', 'xt-corporate-lite'),
            ),

            array(
                'id'       => 'xt_skin',
                'type'     => 'select',
                'title'    => __( 'Theme Skin', 'xt-corporate-lite' ),
                'subtitle' => __( 'Select Theme Skin', 'xt-corporate-lite' ),
                'options'  => array(
                    'blue'   => __( 'Blue','xt-corporate-lite' ),
                    'red'    => __( 'Red','xt-corporate-lite' ),
                    'green'  => __( 'Green','xt-corporate-lite' ),
                    'yellow' => __( 'Yellow','xt-corporate-lite' ),
                    'coffee' => __( 'Coffee','xt-corporate-lite' ),
                ),
                'default'  => 'blue'
            ),

            array(
                'id'       => 'xt_credit',
                'type'     => 'checkbox',
                'title'     => __('Theme\'s Credit Links', 'xt-corporate-lite'),
                'subtitle'  => __('Theme by Xylustheme | Powered by WordPress', 'xt-corporate-lite'),
                'default'  => true
            ),

            array(
                'id'        => 'xt_copyright',
                'type'      => 'textarea',
                'title'     => __('Footer Text', 'xt-corporate-lite'),
                'subtitle'  => __('Enter Footer Text.', 'xt-corporate-lite'),
                'default'   => __('&copy; Copyrights 2015. All Rights Reserved.','xt-corporate-lite'),
            ),

            array(
                'id'       => 'xt_footer_twitter',
                'type'     => 'text',
                'title'    => __( 'Twitter Url', 'xt-corporate-lite' ),
                'subtitle' => __( 'Your Twitter Page/Profile Url', 'xt-corporate-lite' ),
                'validate'  => 'url',
                'default'   => '',
            ),
            array(
                'id'       => 'xt_footer_facebook',
                'type'     => 'text',
                'title'    => __( 'Facebook Url', 'xt-corporate-lite' ),
                'subtitle' => __( 'Your Facebook Page/Profile Url', 'xt-corporate-lite' ),
                'validate'  => 'url',
                'default'   => '',
            ),
            array(
                'id'       => 'xt_footer_linkedin',
                'type'     => 'text',
                'title'    => __( 'Linked In Url', 'xt-corporate-lite' ),
                'subtitle' => __( 'Your Linked In Page/Profile Url', 'xt-corporate-lite' ),
                'validate'  => 'url',
                'default'   => '',
            ),

            array(
                'id'       => 'xt_footer_google',
                'type'     => 'text',
                'title'    => __( 'Google Plus Url', 'xt-corporate-lite' ),
                'subtitle' => __( 'Your Google Plus Page/Profile Url', 'xt-corporate-lite' ),
                'validate'  => 'url',
                'default'   => '',
            ),

        )
    ) );
/* Homepage Settings */
    Redux::setSection( $opt_name, array(
        'title' => __( 'Homepage Settings', 'xt-corporate-lite' ),
        'id'    => 'homepage',
        'icon'  => 'el el-home  ',
        'fields'     => array(
            array(
                'id'        => 'xt_homepage_header',
                'type'      => 'media',
                'title'     => __('Header Image', 'xt-corporate-lite'),
                'desc'      => __('Upload/Change Homepage header Image.', 'xt-corporate-lite'),
                'subtitle'  => __('Upload Header Image', 'xt-corporate-lite'),
            ),
            array(
                'id'       => 'xt_header_title',
                'type'     => 'text',
                'title'    => __( 'Header Title', 'xt-corporate-lite' ),
                'subtitle' => __( 'Homepage Header Title', 'xt-corporate-lite' ),
                'desc'     => __( 'Add/Update Home Page Title', 'xt-corporate-lite' ),
                'default'  => __( 'Welcome to Xylus Theme', 'xt-corporate-lite'),
            ),
            array(
                'id'       => 'xt_header_description',
                'type'     => 'textarea',
                'title'    => __( 'Header Description', 'xt-corporate-lite' ),
                'subtitle' => __( 'Homepage Header Description', 'xt-corporate-lite' ),
                'desc'     => __( 'Add/Update Homepage Description', 'xt-corporate-lite' ),
            ),
            array(
                'id'       => 'xt_button_text',
                'type'     => 'text',
                'title'    => __( 'Button Text', 'xt-corporate-lite' ),
                'subtitle' => __( 'Homepage Header Button Text', 'xt-corporate-lite' ),
                'desc'     => __( 'Add/Update Home Page Button Text', 'xt-corporate-lite' ),
                'default'  => __( 'TELL ME MORE', 'xt-corporate-lite'),
            ),
            array(
                'id'       => 'xt_button_url',
                'type'     => 'text',
                'title'    => __( 'Button Url', 'xt-corporate-lite' ),
                'subtitle' => __( 'Homepage Header Button Url', 'xt-corporate-lite' ),
                'desc'     => __( 'Add/Update Home Page Button Url', 'xt-corporate-lite' ),
                'validate'  => 'url',
                'default'   => __( '', 'xt-corporate-lite' ),
            ),
            )
        ) );
/* Services */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Services Section', 'xt-corporate-lite' ),
        'id'     => 'services_section',
        'icon'   => 'el el-cogs',
        'fields' => array(
            array(
                'id'       => 'xt_is_services',
                'type'     => 'checkbox',
                'title'    => __( 'Services Section', 'xt-corporate-lite' ),
                'subtitle' => __( 'Enable/Disable Services Section on Homepage', 'xt-corporate-lite' ),
                'desc'     => __( 'Check Checkbox for Enable Services Section on homepage', 'xt-corporate-lite' ),
                'default'  => __( '1','xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_services_background',
                'type'     => 'media',
                'title'    => __( 'Background Image', 'xt-corporate-lite' ),
                'subtitle' => __( 'Upload/Edit Services Background Image', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_services_color',
                'type'     => 'color',
                'output'   => array( '#services, #services p, #services h1, #services h2, #services h3, #services h4, #services h5, #services h6' ),
                'title'    => __( 'Font Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a font color for the Services Section (default: #000).', 'xt-corporate-lite' ),
                'default'  => '#000000',
            ),
            array(
                'id'       => 'xt_services_backcolor',
                'type'     => 'color',
                'title'    => __( 'Background Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a background color for the Services Section  (default: #ffffff).', 'xt-corporate-lite' ),
                'mode'     => 'background',
                'output'   => array( '#services' ),
                'default'  => '#ffffff',
            ),

            array(
                'id'       => 'xt_services_title',
                'type'     => 'text',
                'required' => array( 'xt_is_services', '=', true ),
                'title'    => __( 'Services Title', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update Services Title', 'xt-corporate-lite' ),
                'default'   => 'Our Services',
            ),
            array(
                'id'       => 'xt_services_desc',
                'type'     => 'textarea',
                'required' => array( 'xt_is_services', '=', true ),
                'title'    => __( 'Services description', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update Services Description', 'xt-corporate-lite' ),
            ),
            )
        ) );
/* Portfolio */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Portfolio Section', 'xt-corporate-lite' ),
        'id'     => 'portfolio_section',
        'icon'   => 'el el-cogs',
        'fields' => array(

            array(
                'id'       => 'xt_is_portfolio',
                'type'     => 'checkbox',
                'title'    => __( 'Portfolio Section', 'xt-corporate-lite' ),
                'subtitle' => __( 'Enable/Disable Portfolio Section on Homepage', 'xt-corporate-lite' ),
                'desc'     => __( 'Check Checkbox for Enable Portfolio Section on homepage', 'xt-corporate-lite' ),
                'default'  => __( '1','xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_portfolio_background',
                'type'     => 'media',
                'title'    => __( 'Background Image', 'xt-corporate-lite' ),
                'subtitle' => __( 'Upload/Edit Portfolio Background Image', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_portfolio_color',
                'type'     => 'color',
                'output'   => array( '#portfolio, #portfolio p,#portfolio h1, #portfolio h2, #portfolio h3, #portfolio h4, #portfolio h5, #portfolio h6' ),
                'title'    => __( 'Font Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a font color for the Portfolio Section (default: #000).', 'xt-corporate-lite' ),
                'default'  => '#000000',
            ),
            array(
                'id'       => 'xt_portfolio_backcolor',
                'type'     => 'color',
                'title'    => __( 'Background Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a background color for the Portfolio Section  (default: #F7F7F7).', 'xt-corporate-lite' ),
                'mode'     => 'background',
                'output'   => array( '#portfolio' ),
                'default'  => '#F7F7F7',
            ),



            array(
                'id'       => 'xt_portfolio_title',
                'type'     => 'text',
                'required' => array( 'xt_is_portfolio', '=', '1' ),
                'title'    => __( 'Portfolio Title', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update Portfolio Title', 'xt-corporate-lite' ),
                'default'   =>__( 'Portfolio','xt-corporate-lite' ),
            ),
            array(
                'id'       => 'xt_portfolio_desc',
                'type'     => 'textarea',
                'required' => array( 'xt_is_portfolio', '=', '1' ),
                'title'    => __( 'Portfolio description', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update Portfolio Description', 'xt-corporate-lite' ),
            ),
        )
    ) );
/* Team */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Team Section', 'xt-corporate-lite' ),
        'id'     => 'team_section',
        'icon'   => 'el el-cogs',
        'fields' => array(

            array(
                'id'       => 'xt_is_team',
                'type'     => 'checkbox',
                'title'    => __( 'Team Section', 'xt-corporate-lite' ),
                'subtitle' => __( 'Enable/Disable Team Section on Homepage', 'xt-corporate-lite' ),
                'desc'     => __( 'Check Checkbox for Enable Team Section on homepage', 'xt-corporate-lite' ),
                'default'  => __( '1', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_team_background',
                'type'     => 'media',
                'title'    => __( 'Background Image', 'xt-corporate-lite' ),
                'subtitle' => __( 'Upload/Edit Team Background Image', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_team_color',
                'type'     => 'color',
                'output'   => array( '#team, #team p,#team h1, #team h2, #team h3, #team h4, #team h5, #team h6' ),
                'title'    => __( 'Font Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a font color for the Team Section (default: #000).', 'xt-corporate-lite' ),
                'default'  => '#000000',
            ),
            array(
                'id'       => 'xt_team_backcolor',
                'type'     => 'color',
                'title'    => __( 'Background Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a background color for the Team Section  (default: #F7F7F7).', 'xt-corporate-lite' ),
                'mode'     => 'background',
                'output'   => array( '#team' ),
                'default'  => '#F7F7F7',
            ),


            array(
                'id'       => 'xt_team_title',
                'type'     => 'text',
                'required' => array( 'xt_is_team', '=', '1' ),
                'title'    => __( 'Team Title', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update Team Title', 'xt-corporate-lite' ),
                'default'   =>__( 'Our Amazing Team', 'xt-corporate-lite' ),
            ),
            array(
                'id'       => 'xt_team_desc',
                'type'     => 'textarea',
                'required' => array( 'xt_is_team', '=', '1' ),
                'title'    => __( 'Team description', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update Team Description', 'xt-corporate-lite' ),
            ),
        )
    ) );
/* Clients */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Clients Section', 'xt-corporate-lite' ),
        'id'     => 'clients_section',
        'icon'   => 'el el-cogs',
        'fields' => array(

            array(
                'id'       => 'xt_is_clients',
                'type'     => 'checkbox',
                'title'    => __( 'Clients Section', 'xt-corporate-lite' ),
                'subtitle' => __( 'Enable/Disable Clients Section on Homepage', 'xt-corporate-lite' ),
                'desc'     => __( 'Check Checkbox for Enable Clients Section on homepage', 'xt-corporate-lite' ),
                'default'  => __( '1', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_clients_background',
                'type'     => 'media',
                'title'    => __( 'Background Image', 'xt-corporate-lite' ),
                'subtitle' => __( 'Upload/Edit Clients Background Image', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_clients_backcolor',
                'type'     => 'color',
                'title'    => __( 'Background Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a background color for the Clients Section  (default: #FFFFFF).', 'xt-corporate-lite' ),
                'mode'     => 'background',
                'output'   => array( '#clients' ),
                'default'  => '#FFFFFF',
            ),

            )
    ) );
/* About Us */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'About Section', 'xt-corporate-lite' ),
        'id'     => 'about_section',
        'icon'   => 'el el-cogs',
        'fields' => array(
            array(
                'id'       => 'xt_is_about',
                'type'     => 'checkbox',
                'title'    => __( 'About Section', 'xt-corporate-lite' ),
                'subtitle' => __( 'Enable/Disable About Section on Homepage', 'xt-corporate-lite' ),
                'desc'     => __( 'Check Checkbox for Enable About Section on homepage', 'xt-corporate-lite' ),
                'default'  => __( '1', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_about_background',
                'type'     => 'media',
                'title'    => __( 'Background Image', 'xt-corporate-lite' ),
                'subtitle' => __( 'Upload/Edit About Background Image', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_about_color',
                'type'     => 'color',
                'output'   => array( '#about, #about p,#about h1,#about h2,#about h3,#about h4,#about h5,#about h6' ),
                'title'    => __( 'Font Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a font color for the About Section (default: #000).', 'xt-corporate-lite' ),
                'default'  => '#000000',
            ),
            array(
                'id'       => 'xt_about_backcolor',
                'type'     => 'color',
                'title'    => __( 'Background Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a background color for the About Section  (default: #FFFFFF).', 'xt-corporate-lite' ),
                'mode'     => 'background',
                'output'   => array( '#about' ),
                'default'  => '#FFFFFF',
            ),

            array(
                'id'       => 'xt_about_title',
                'type'     => 'text',
                'required' => array( 'xt_is_about', '=', '1' ),
                'title'    => __( 'About us Title', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update About us Section Title', 'xt-corporate-lite' ),
                'default'   =>__( 'About', 'xt-corporate-lite' ),
            ),
            array(
                'id'       => 'xt_about_subtitle',
                'type'     => 'textarea',
                'required' => array( 'xt_is_about', '=', '1' ),
                'title'    => __( 'About us description', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update About us Section description', 'xt-corporate-lite' ),
            ),
            array(
                'id'       => 'xt_about_page',
                'type'     => 'select',
                'data'     => 'page',
                'title'    => __( 'Select About page', 'xt-corporate-lite' ),
                'subtitle' => __( 'Select/Change About Page, Selected page\'s content will be shown in About Section', 'xt-corporate-lite' ),
            ),
        )
    ) );
/* Contact */
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Contact Section', 'xt-corporate-lite' ),
        'id'     => 'contact_section',
        'icon'   => 'el el-cogs',
        'fields' => array(
            array(
                'id'       => 'xt_is_contact',
                'type'     => 'checkbox',
                'title'    => __( 'Contact Section', 'xt-corporate-lite' ),
                'subtitle' => __( 'Enable/Disable Team Section on Homepage', 'xt-corporate-lite' ),
                'desc'     => __( 'Check Checkbox for Enable Contact Section on homepage', 'xt-corporate-lite' ),
                'default'  => __( '1', 'xt-corporate-lite' ),
            ),
            array(
                'id'       => 'xt_contact_background',
                'type'     => 'media',
                'required' => array( 'xt_is_contact', '=', '1' ),
                'title'    => __( 'Contact Background Image', 'xt-corporate-lite' ),
                'subtitle' => __( 'Upload/Edit Contact Background Image', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_contact_color',
                'type'     => 'color',
                'output'   => array( '#contact, #contact p,#contact h1,#contact h2,#contact h3,#contact h4,#contact h5,#contact h6,' ),
                'title'    => __( 'Font Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a font color for the Contact Section (default: #000).', 'xt-corporate-lite' ),
                'default'  => '#000000',
            ),
            array(
                'id'       => 'xt_contact_backcolor',
                'type'     => 'color',
                'title'    => __( 'Background Color', 'xt-corporate-lite' ),
                'subtitle' => __( 'Pick a background color for the Contact Section  (default: #FFFFFF).', 'xt-corporate-lite' ),
                'mode'     => 'background',
                'output'   => array( '#contact' ),
                'default'  => '#FFFFFF',
            ),

            array(
                'id'       => 'xt_contact_title',
                'type'     => 'text',
                'required' => array( 'xt_is_contact', '=', '1' ),
                'title'    => __( 'Contact Title', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update Contact Title', 'xt-corporate-lite' ),
                'default'   => __('Contact','xt-corporate-lite' ),
            ),
            array(
                'id'       => 'xt_contact_desc',
                'type'     => 'textarea',
                'required' => array( 'xt_is_contact', '=', '1' ),
                'title'    => __( 'Contact description', 'xt-corporate-lite' ),
                'subtitle' => __( 'Add/Update Contact Description', 'xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_contact_page',
                'type'     => 'select',
                'data'     => 'page',
                'title'    => __( 'Select Contact page', 'xt-corporate-lite' ),
                'subtitle' => __( 'Select/Change Contact Page, Selected page\'s content will be shown in Contact Section', 'xt-corporate-lite' ),
            ),

        )
    ) );
/* Page Setting */
    Redux::setSection( $opt_name, array(
        'title' => __( 'Page Settings', 'xt-corporate-lite' ),
        'id'    => 'page',
        'icon'  => 'el el-file  ',
        'fields'     => array(
            array(
                'id'        => 'xt_page_header',
                'type'      => 'media',
                'title'     => __('Default Header Image', 'xt-corporate-lite'),
                'desc'      => __('Upload/Change Default Page header Image.', 'xt-corporate-lite'),
                'subtitle'  => __('Upload Default Header Image', 'xt-corporate-lite'),
            ),

            array(
                'id'       => 'xt_page_layout',
                'type'     => 'select',
                'title'    => __( 'Page Layout', 'xt-corporate-lite' ),
                'subtitle' => __( 'Select Page Layout', 'xt-corporate-lite' ),
                'desc'     => __( 'Select Page layout (Sidebar Position).', 'xt-corporate-lite' ),
                'options'  => array(
                    '1' => __('Fullwidth','xt-corporate-lite' ),
                    '2' => __('Left Sidebar','xt-corporate-lite' ),
                    '3' => __('Right Sidebar','xt-corporate-lite' ),
                ),
                'default'  =>  __('3','xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_page_sidebar',
                'type'     => 'select',
                'data'     => 'sidebar',
                'title'    => __( 'Select Page Sidebar', 'xt-corporate-lite' ),
                'subtitle' => __( 'Select/Change Sidebar, Selected Sidebar Will display on Page', 'xt-corporate-lite' ),
            ),


        )
    ) );
/* Blog Setting*/
    Redux::setSection( $opt_name, array(
        'title' => __( 'Blog Settings', 'xt-corporate-lite' ),
        'id'    => 'blog_setting',
        'icon'  => 'el el-edit',
        'fields'     => array(
            array(
                'id'        => 'xt_blog_header',
                'type'      => 'media',
                'title'     => __('Default Header Image', 'xt-corporate-lite'),
                'desc'      => __('Upload/Change Default Blog header Image.', 'xt-corporate-lite'),
                'subtitle'  => __('Upload Default Header Image', 'xt-corporate-lite'),
            ),

            array(
                'id'       => 'xt_blog_layout',
                'type'     => 'select',
                'title'    => __( 'Blog Layout', 'xt-corporate-lite' ),
                'subtitle' => __( 'Select Blog Layout', 'xt-corporate-lite' ),
                'desc'     => __( 'Select Blog layout (Sidebar Position).', 'xt-corporate-lite' ),
                'options'  => array(
                    '1' => __('Fullwidth','xt-corporate-lite' ),
                    '2' => __('Left Sidebar','xt-corporate-lite' ),
                    '3' => __('Right Sidebar','xt-corporate-lite' ),
                ),
                'default'  => __('3','xt-corporate-lite' ),
            ),

            array(
                'id'       => 'xt_blog_sidebar',
                'type'     => 'select',
                'data'     => 'sidebar',
                'title'    => __( 'Select Blog Sidebar', 'xt-corporate-lite' ),
                'subtitle' => __( 'Select/Change Sidebar, Selected Sidebar Will display on Blog', 'xt-corporate-lite' ),
            ),


        )

    ) );

/*
 * END SECTIONS
 */
