<?php
define('ACF_LITE',true);

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_clients',
		'title' => __( 'Clients', 'xt-corporate-lite' ),
		'fields' => array (
			array (
				'key' => 'field_55c345d1a41f8',
				'label' => __( 'Client Image', 'xt-corporate-lite' ),
				'name' => 'xt_client_image',
				'type' => 'image',
				'instructions' => __( 'Upload/Edit Client Image. (Max height: 100px)', 'xt-corporate-lite' ),
				'save_format' => 'object',
				'preview_size' => 'full',
				'library' => 'all',
			),
			array (
				'key' => 'field_55c346472b7c9',
				'label' => __( 'Client Link', 'xt-corporate-lite' ),
				'name' => 'xt_client_link',
				'type' => 'text',
				'instructions' => __( 'Add/Update Client Link','xt-corporate-lite' ),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'clients',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_services',
		'title' => __('Services','xt-corporate-lite' ),
		'fields' => array (
			array (
				'key' => 'field_55c34da1c8170',
				'label' => __('Image','xt-corporate-lite'),
				'name' => 'xt_services_image',
				'type' => 'image',
				'instructions' => __('Upload/Edit Services Image (Max height: 100px)','xt-corporate-lite' ),
				'save_format' => 'object',
				'preview_size' => 'full',
				'library' => 'all',
			),
			array (
				'key' => 'field_55c350cdbef22',
				'label' => __('Service Desciption','xt-corporate-lite' ),
				'name' => 'xt_service_desciption',
				'type' => 'textarea',
				'instructions' => __('Add/Edit Services Desription','xt-corporate-lite' ),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'none',
			),
			array (
				'key' => 'field_55c34eb49212e',
				'label' => __('Service Link','xt-corporate-lite' ),
				'name' => 'xt_services_link',
				'type' => 'text',
				'instructions' => __('Add/Edit Service Link','xt-corporate-lite' ),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'services',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_team-member',
		'title' => __('Team Member','xt-corporate-lite' ),
		'fields' => array (
			array (
				'key' => 'field_55c3470242062',
				'label' => __('Image','xt-corporate-lite' ),
				'name' => 'xt_team_image',
				'type' => 'image',
				'instructions' => __('Upload/Edit Team Member\'s Image','xt-corporate-lite' ),
				'save_format' => 'object',
				'preview_size' => 'full',
				'library' => 'all',
			),
			array (
				'key' => 'field_55c3473442063',
				'label' => __('Full Name','xt-corporate-lite' ),
				'name' => 'xt_team_full_name',
				'type' => 'text',
				'instructions' => __('Add/Edit Team Member\'s Full Name','xt-corporate-lite' ),
				'default_value' => '',
				'placeholder' => __('e.g: Dharmesh Patel','xt-corporate-lite' ),
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55c3477642064',
				'label' => __('Position (Profession)','xt-corporate-lite' ),
				'name' => 'xt_team_position',
				'type' => 'text',
				'instructions' => __('What do the team member do?','xt-corporate-lite' ),
				'default_value' => '',
				'placeholder' => __('e.g: Wordpress Developer','xt-corporate-lite' ),
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55c34805c7029',
				'label' => __('Facebook','xt-corporate-lite' ),
				'name' => 'xt_team_facebook',
				'type' => 'text',
				'instructions' => __('Paste the facebook profile link of the team member. ','xt-corporate-lite' ),
				'default_value' => '',
				'placeholder' => __('e.g: https://www.facebook.com/D1025','xt-corporate-lite' ),
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55c34874d9af9',
				'label' => __('Twitter','xt-corporate-lite' ),
				'name' => 'xt_team_twitter',
				'type' => 'text',
				'instructions' => __('Paste the Twitter profile link of the team member. ','xt-corporate-lite' ),
				'default_value' => '',
				'placeholder' => __('e.g: https://twitter.com/dspatel44','xt-corporate-lite' ),
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55c349308ccef',
				'label' => __('Linked In','xt-corporate-lite' ),
				'name' => 'xt_team_linked_in',
				'type' => 'text',
				'instructions' => __('Paste the Linked In profile link of the team member. ','xt-corporate-lite' ),
				'default_value' => '',
				'placeholder' => __('e.g: https://www.linkedin.com/profile/view?id=233977166','xt-corporate-lite' ),
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55c349728ccf0',
				'label' => __('Google +','xt-corporate-lite' ),
				'name' => 'xt_team_google',
				'type' => 'text',
				'instructions' => __('Paste the Google Plus profile link of the team member. ','xt-corporate-lite' ),
				'default_value' => '',
				'placeholder' => __('e.g: https://plus.google.com/u/0/+DharmeshPatel25','xt-corporate-lite' ),
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'team',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

    register_field_group(array (
        'id' => 'acf_header-settings',
        'title' => __('Header Settings','xt-corporate-lite' ),
        'fields' => array (
            array (
                'key' => 'field_55cee3766727f',
                'label' => __('Display Header Title?','xt-corporate-lite' ),
                'name' => 'display_header_title',
                'type' => 'radio',
                'instructions' => __('Do You want to Display Header Title on Page Header?','xt-corporate-lite' ),
                'choices' => array (
                    1 => 'Yes',
                    0 => 'No',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 1,
                'layout' => 'horizontal',
            ),
            array (
                'key' => 'field_55cee3f867280',
                'label' => __('Page Tag Line','xt-corporate-lite' ),
                'name' => 'page_tag_line',
                'type' => 'text',
                'instructions' => __('Add/Edit Page Tagline (it will display Below page title).','xt-corporate-lite' ),
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_55cee3766727f',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'none',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_contact-form',
        'title' => __('Contact Form','xt-corporate-lite' ),
        'fields' => array (
            array (
                'key' => 'field_55daba7793acb',
                'label' => __('Map Address','xt-corporate-lite' ),
                'name' => 'xt_map_address',
                'type' => 'google_map',
                'instructions' => __('Select Your Address on map.','xt-corporate-lite' ),
                'center_lat' => '',
                'center_lng' => '',
                'zoom' => '',
                'height' => '',
            ),
            array (
                'key' => 'field_55dabad893acc',
                'label' => __('Zoom','xt-corporate-lite' ),
                'name' => 'zoom',
                'type' => 'number',
                'instructions' => __('Enter Map Zoom level','xt-corporate-lite' ),
                'default_value' => 14,
                'placeholder' => __('Zoom level','xt-corporate-lite' ),
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'contact-template.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}