<?php
/**
 * Square Theme Customizer.
 *
 * @package Square
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function square_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	global $fontawesome_choices;
	$square_page = '';
	$square_page_array = get_pages();
	if(is_array($square_page_array)){
		$square_page = $square_page_array[0]->ID;
	}

	$header_bg_choices = array(
							'sq-white' => __( 'White', 'square'), 
							'sq-black' => __( 'Black', 'square')  
							);

	/*============GENERAL SETTINGS PANEL============*/
	$wp_customize->add_panel(
		'square_general_settings_panel',
		array(
			'title' 			=> __( 'General Settings', 'square' ),
			'priority'          => 10
		)
	);

	//STATIC FRONT PAGE
	$wp_customize->add_section( 'static_front_page', array(
	    'title'          => __( 'Static Front Page', 'square' ),
	    'panel' => 'square_general_settings_panel',
	    'description'    => __( 'Your theme supports a static front page.', 'square'),
	) );

	//TITLE AND TAGLINE SETTINGS
	$wp_customize->add_section( 'title_tagline', array(
	     'title'    => __( 'Site Title & Tagline', 'square' ),
	     'panel' => 'square_general_settings_panel',
	) );

	//HEADER LOGO 
	$wp_customize->add_section( 'header_image', array(
	     'title'    => __( 'Header Logo', 'square' ),
	     'panel' => 'square_general_settings_panel',
	) );

	//HEADER Background 
	$wp_customize->add_section(
		'square_header_bg_sec',
		array(
			'title'			=> __( 'Header Background Color', 'square' ),
			'panel'         => 'square_general_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'square_header_bg',
		array(
			'default'			=> 'sq-black',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'square_sanitize_choices'
		)
	);

	$wp_customize->add_control(
		new Square_Dropdown_Chooser(
			$wp_customize,
			'square_header_bg',
			array(
				'settings'		=> 'square_header_bg',
				'section'		=> 'square_header_bg_sec',
				'type'			=> 'select',
				'label'			=> __( 'Header Background Color', 'square' ),
				'choices'       => $header_bg_choices,
			)
		)
	);


	//PAGE HEADER BACKGROUND 
	$wp_customize->add_section(
		'square_page_header_bg_sec',
		array(
			'title'			=> __( 'Page Header Banner', 'square' ),
			'panel'         => 'square_general_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'square_page_header_bg',
		array(
			'default'			=> get_template_directory_uri().'/images/bg.jpg',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'square_page_header_bg',
	        array(
	            'label'    => __( 'Page Header Banner', 'square' ),
	            'settings' => 'square_page_header_bg',
	            'section'  => 'square_page_header_bg_sec',
	            'description'   => __( 'Recommended Image Size: 1800X400px', 'square' )
	        )
	    )
	);

	//BACKGROUND IMAGE
	$wp_customize->add_section( 'background_image', array(
	     'title'    => __( 'Background Image', 'square' ),
	     'panel' => 'square_general_settings_panel',
	) );

	$wp_customize->add_section( 'colors', array(
	     'title'    => __( 'Colors' , 'square'),
	     'panel' => 'square_general_settings_panel',
	) );

	/*============HOME SETTINGS PANEL============*/
	$wp_customize->add_panel(
		'square_home_settings_panel',
		array(
			'title' 			=> __( 'Home Page Settings', 'square' ),
			'priority'          => 10
		)
	);

	/*============SLIDER IMAGES SECTION============*/
	$wp_customize->add_section(
		'square_slider_sec',
		array(
			'title'			=> __( 'Slider Section', 'square' ),
			'panel'         => 'square_home_settings_panel'
		)
	);

	//SLIDERS
	for ($i=1; $i < 4; $i++) { 

	$wp_customize->add_setting(
		'square_slider_heading'.$i,
		array(
			'default'			=> '',
			'sanitize_callback' => 'square_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new Square_Customize_Heading(
			$wp_customize,
			'square_slider_heading'.$i,
		array(
			'settings'		=> 'square_slider_heading'.$i,
			'section'		=> 'square_slider_sec',
			'label'			=> __( 'Slider ', 'square' ).$i,
		)
		)
	);

	$wp_customize->add_setting(
		'square_slider_title'.$i,
		array(
			'default'			=> __('Free WordPress Themes','square'),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'square_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'square_slider_title'.$i,
		array(
			'settings'		=> 'square_slider_title'.$i,
			'section'		=> 'square_slider_sec',
			'type'			=> 'text',
			'label'			=> __( 'Caption Title', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_slider_subtitle'.$i,
		array(
			'default'			=> __('Create website in no time','square'),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'square_sanitize_text'
		)
	);

	$wp_customize->add_control(
		'square_slider_subtitle'.$i,
		array(
			'settings'		=> 'square_slider_subtitle'.$i,
			'section'		=> 'square_slider_sec',
			'type'			=> 'textarea',
			'label'			=> __( 'Caption SubTitle', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_slider_image'.$i,
		array(
			'default'			=> get_template_directory_uri().'/images/bg.jpg',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'square_slider_image'.$i,
	        array(
	            'label'    => __( 'Slider Image', 'square' ),
	            'settings' => 'square_slider_image'.$i,
	            'section'  => 'square_slider_sec',
	            'description'   => __( 'Recommended Image Size: 1800X800px', 'square' )
	        )
	    )
	);
		
	}

	/*============FEATURED SECTION============*/

	//FEATURED PAGES
	$wp_customize->add_section(
		'square_featured_page_sec',
		array(
			'title'			=> __( 'Featured Section', 'square' ),
			'panel'         => 'square_home_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'square_enable_featured_link',
		array(
			'default'			=> 1,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
			'square_enable_featured_link',
			array(
				'settings'		=> 'square_enable_featured_link',
				'section'		=> 'square_featured_page_sec',
				'label'			=> __( 'Enable Read More link ', 'square' ),
				'type'       	=> 'checkbox',
			)
	);

	for( $i = 1; $i < 4; $i++ ){

	$wp_customize->add_setting(
		'square_featured_header'.$i,
		array(
			'default'			=> '',
			'sanitize_callback' => 'square_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new Square_Customize_Heading(
			$wp_customize,
			'square_featured_header'.$i,
			array(
				'settings'		=> 'square_featured_header'.$i,
				'section'		=> 'square_featured_page_sec',
				'label'			=> __( 'Featured Page ', 'square' ).$i
			)
		)
	);

	$wp_customize->add_setting(
		'square_featured_page'.$i,
		array(
			'default'			=> $square_page,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'square_featured_page'.$i,
		array(
			'settings'		=> 'square_featured_page'.$i,
			'section'		=> 'square_featured_page_sec',
			'type'			=> 'dropdown-pages',
			'label'			=> __( 'Select a Page', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_featured_page_icon'.$i,
		array(
			'default'			=> 'fa-bell',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'square_sanitize_choices'
		)
	);

	$wp_customize->add_control(
		new Square_Dropdown_Chooser(
		$wp_customize,
		'square_featured_page_icon'.$i,
		array(
			'settings'		=> 'square_featured_page_icon'.$i,
			'section'		=> 'square_featured_page_sec',
			'type'			=> 'select',
			'label'			=> __( 'FontAwesome Icon', 'square' ),
			'choices'       => $fontawesome_choices,
		)
		)
	);
	}

	/*============ABOUT SECTION============*/

	$wp_customize->add_section(
		'square_about_sec',
		array(
			'title'			=> __( 'About Us Section', 'square' ),
			'panel'         => 'square_home_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'square_disable_about_sec',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
			'square_disable_about_sec',
			array(
				'settings'		=> 'square_disable_about_sec',
				'section'		=> 'square_about_sec',
				'label'			=> __( 'Disable About Section ', 'square' ),
				'type'       	=> 'checkbox',
			)
	);

	$wp_customize->add_setting(
		'square_about_header',
		array(
			'default'			=> '',
			'sanitize_callback' => 'square_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new Square_Customize_Heading(
			$wp_customize,
			'square_about_header',
			array(
				'settings'		=> 'square_about_header',
				'section'		=> 'square_about_sec',
				'label'			=> __( 'About Page ', 'square' )
			)
		)
	);

	$wp_customize->add_setting(
		'square_about_page',
		array(
			'default'			=> '',
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
		'square_about_page',
		array(
			'settings'		=> 'square_about_page',
			'section'		=> 'square_about_sec',
			'type'			=> 'dropdown-pages',
			'label'			=> __( 'Select a Page', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_about_image_header',
		array(
			'default'			=> '',
			'sanitize_callback' => 'square_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new Square_Customize_Heading(
			$wp_customize,
			'square_about_image_header',
			array(
				'settings'		=> 'square_about_image_header',
				'section'		=> 'square_about_sec',
				'label'			=> __( 'About Page Stack Images', 'square' )
			)
		)
	);

	$wp_customize->add_setting(
		'square_about_image_stack',
		array(
			'default'			=> '',
			'sanitize_callback' => 'square_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new Square_Customize_Multi_Image(
			$wp_customize,
			'square_about_image_stack',
		array(
			'settings'		=> 'square_about_image_stack',
			'section'		=> 'square_about_sec',
			'label'			=> __( 'About Us Stack Image', 'square' ),
			'description'   => __( 'Recommended Image Size: 400X420px', 'square' )
		)
		)
	);

	/*============ABOUT SECTION============*/

	$wp_customize->add_section(
		'square_tab_sec',
		array(
			'title'			=> __( 'Tab Section', 'square' ),
			'panel'         => 'square_home_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'square_disable_tab_sec',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
			'square_disable_tab_sec',
			array(
				'settings'		=> 'square_disable_tab_sec',
				'section'		=> 'square_tab_sec',
				'label'			=> __( 'Disable Tab Section ', 'square' ),
				'type'       	=> 'checkbox',
			)
	);

	for($i = 1; $i < 6; $i++){

		$wp_customize->add_setting(
			'square_tab_header'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'square_sanitize_text'
			)
		);

		$wp_customize->add_control(
			new Square_Customize_Heading(
				$wp_customize,
				'square_tab_header'.$i,
				array(
					'settings'		=> 'square_tab_header'.$i,
					'section'		=> 'square_tab_sec',
					'label'			=> __( 'Tab ', 'square' ).$i
				)
			)
		);

		$wp_customize->add_setting(
			'square_tab_title'.$i,
			array(
				'default'			=> '',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'square_sanitize_text'
			)
		);

		$wp_customize->add_control(
			'square_tab_title'.$i,
			array(
				'settings'		=> 'square_tab_title'.$i,
				'section'		=> 'square_tab_sec',
				'type'			=> 'text',
				'label'			=> __( 'Tab Title', 'square' )
			)
		);

		$wp_customize->add_setting(
			'square_tab_icon'.$i,
			array(
				'default'			=> 'fa-bell',
				'transport'         => 'postMessage',
				'sanitize_callback' => 'square_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			new Square_Dropdown_Chooser(
			$wp_customize,
			'square_tab_icon'.$i,
			array(
				'settings'		=> 'square_tab_icon'.$i,
				'section'		=> 'square_tab_sec',
				'type'			=> 'select',
				'label'			=> __( 'FontAwesome Icon', 'square' ),
				'choices'       => $fontawesome_choices,
			)
			)
		);

		$wp_customize->add_setting(
			'square_tab_page'.$i,
			array(
				'default'			=> '',
				'sanitize_callback' => 'absint'
			)
		);

		$wp_customize->add_control(
			'square_tab_page'.$i,
			array(
				'settings'		=> 'square_tab_page'.$i,
				'section'		=> 'square_tab_sec',
				'type'			=> 'dropdown-pages',
				'label'			=> __( 'Select a Page', 'square' )
			)
		);

	}

	/*============CLIENTS LOGO SECTION============*/
	$wp_customize->add_section(
		'square_logo_sec',
		array(
			'title'			=> __( 'Clients Logo Section', 'square' ),
			'panel'         => 'square_home_settings_panel'
		)
	);

	$wp_customize->add_setting(
		'square_disable_logo_sec',
		array(
			'default'			=> 0,
			'sanitize_callback' => 'absint'
		)
	);

	$wp_customize->add_control(
			'square_disable_logo_sec',
			array(
				'settings'		=> 'square_disable_logo_sec',
				'section'		=> 'square_logo_sec',
				'label'			=> __( 'Disable Client Logo Section ', 'square' ),
				'type'       	=> 'checkbox',
			)
	);

	$wp_customize->add_setting(
		'square_logo_header',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'square_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new Square_Customize_Heading(
			$wp_customize,
			'square_logo_header',
			array(
				'settings'		=> 'square_logo_header',
				'section'		=> 'square_logo_sec',
				'label'			=> __( 'Section Title & Logo', 'square' )
			)
		)
	);

	$wp_customize->add_setting(
		'square_logo_title',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'square_sanitize_text'
		)
	);

	$wp_customize->add_control(
		'square_logo_title',
		array(
			'settings'		=> 'square_logo_title',
			'section'		=> 'square_logo_sec',
			'type'			=> 'text',
			'label'			=> __( 'Title', 'square' )
		)
	);

	//CLIENTS LOGOS
	$wp_customize->add_setting(
		'square_client_logo_image',
		array(
			'default'			=> '',
			'sanitize_callback' => 'square_sanitize_text'
		)
	);

	$wp_customize->add_control(
		new Square_Customize_Multi_Image(
			$wp_customize,
			'square_client_logo_image',
		array(
			'settings'		=> 'square_client_logo_image',
			'section'		=> 'square_logo_sec',
			'label'			=> __( 'Upload Clients Logos', 'square' ),
			'description'   => __( 'Recommended Image Size: 220X90px', 'square' )
		)
		)
	);

	/*============SOCIAL ICONS SECTION============*/
	$wp_customize->add_section(
		'square_social_sec',
		array(
			'title'			=> __( 'Footer Social Icons', 'square' ),
		)
	);

	$wp_customize->add_setting(
		'square_social_facebook',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'square_social_facebook',
		array(
			'settings'		=> 'square_social_facebook',
			'section'		=> 'square_social_sec',
			'type'			=> 'text',
			'label'			=> __( 'Facebook', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_social_twitter',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'square_social_twitter',
		array(
			'settings'		=> 'square_social_twitter',
			'section'		=> 'square_social_sec',
			'type'			=> 'text',
			'label'			=> __( 'Twitter', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_social_google_plus',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'square_social_google_plus',
		array(
			'settings'		=> 'square_social_google_plus',
			'section'		=> 'square_social_sec',
			'type'			=> 'text',
			'label'			=> __( 'Google Plus', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_social_pinterest',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'square_social_pinterest',
		array(
			'settings'		=> 'square_social_pinterest',
			'section'		=> 'square_social_sec',
			'type'			=> 'text',
			'label'			=> __( 'Pinterest', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_social_youtube',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'square_social_youtube',
		array(
			'settings'		=> 'square_social_youtube',
			'section'		=> 'square_social_sec',
			'type'			=> 'text',
			'label'			=> __( 'Youtube', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_social_linkedin',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'square_social_linkedin',
		array(
			'settings'		=> 'square_social_linkedin',
			'section'		=> 'square_social_sec',
			'type'			=> 'text',
			'label'			=> __( 'Linkedin', 'square' )
		)
	);

	$wp_customize->add_setting(
		'square_social_instagram',
		array(
			'default'			=> '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'square_social_instagram',
		array(
			'settings'		=> 'square_social_instagram',
			'section'		=> 'square_social_sec',
			'type'			=> 'text',
			'label'			=> __( 'Instagram', 'square' )
		)
	);
}
add_action( 'customize_register', 'square_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function square_customize_preview_js() {
	wp_enqueue_script( 'square_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'square_customize_preview_js' );


function square_customizer_script() {
	wp_enqueue_script( 'square-customizer-script', get_template_directory_uri() .'/inc/js/customizer-scripts.js', array("jquery","jquery-ui-draggable"),'', true  );
	wp_enqueue_script( 'square-customizer-chosen-script', get_template_directory_uri() .'/inc/js/chosen.jquery.js', array("jquery"),'1.4.1', true  );
	wp_enqueue_style( 'square-customizer-chosen-style', get_template_directory_uri() .'/inc/css/chosen.css');
	wp_enqueue_style( 'square-customizer-font-awesome', get_template_directory_uri() .'/css/font-awesome.css');
	wp_enqueue_style( 'square-customizer-style', get_template_directory_uri() .'/inc/css/customizer-style.css');	
}
add_action( 'customize_controls_enqueue_scripts', 'square_customizer_script' );


if( class_exists( 'WP_Customize_Control' ) ):	
class Square_Customize_Multi_Image extends WP_Customize_Control{
    public $type = 'multi-image';

    public function __construct($manager, $id, $args = array()){
        parent::__construct($manager, $id, $args);
    }

    public function render_content(){
        // get the set values if any
        $imageIds = explode(',', $this->value());
        if (!is_array($imageIds)) {
            $imageIds = array();
        }
        $this->theTitle();
        $this->theButtons();
        $this->theUploadedImages($imageIds);
    }

    protected function theTitle(){
        ?>
        <label>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>
            <?php if($this->description){ ?>
            <span class="description customize-control-description">
            	<?php echo esc_html($this->description); ?>
            </span>
            <?php } ?>
        </label>
        <?php
    }

    protected function getImages(){
        $options = $this->value();
        if (!isset($options['image_sources'])) {
            return '';
        }
        return $options['image_sources'];
    }

    public function theButtons(){
        ?>
        <div>
            <input type="hidden" value="<?php echo $this->value(); ?>" <?php $this->link(); ?> class="multi-images-control-input"/>
            <a href="#" class="button-secondary multi-images-upload">
                <?php _e( 'Upload', 'square' ); ?>
            </a>
            <a href="#" class="button-secondary multi-images-remove">
               <?php _e( 'Remove all images', 'square' ); ?>
           </a>
       </div>
       <?php
   }

   public function theUploadedImages($ids = array()){
    ?>
    <div class="customize-control-content">
        <ul class="thumbnails">
            <?php if (is_array($ids)): ?>
                <?php foreach ($ids as $id): ?>
                    <?php if ($id != ''): 
                    $image = wp_get_attachment_image_src( $id, 'medium');
                    ?>
                        <li class="thumbnail" style="background-image: url(<?php echo esc_url( $image[0] ); ?>);" data-id="<?php echo esc_attr($id); ?>" data-src="<?php echo esc_url( $image[0] ); ?>">
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?> 
            <?php endif; ?>
        </ul>
    </div>
    <?php
	}
}

class Square_Customize_Heading extends WP_Customize_Control {

    public function render_content() {
    	?>

        <?php if ( !empty( $this->label ) ) : ?>
            <h3 class="square-accordion-section-title"><?php echo esc_html( $this->label ); ?></h3>
        <?php endif; ?>
    <?php }
}

class Square_Dropdown_Chooser extends WP_Customize_Control{
	public function render_content(){
		if ( empty( $this->choices ) )
                return;
		?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <select class="hs-chosen-select" <?php $this->link(); ?>>
                    <?php
                    foreach ( $this->choices as $value => $label )
                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
                    ?>
                </select>
            </label>
		<?php
	}
}

endif;


//SANITIZATION FUNCTIONS
function square_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function square_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function square_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function square_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}
