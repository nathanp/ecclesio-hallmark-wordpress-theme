<?php

/**
 * Implements Customizer functionality.
 *
 * Add custom sections and settings to the Customizer.
 *
 * @package   ecclesio-hallmark-theme
 * @copyright Copyright (c) 2017, Eccles.io
 * @license   GPL2+
 */
class Ecclesio_Hallmark_Customizer {
	
	/**
	 * Customizer constructor.
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	 */
	public function __construct() {

		add_action( 'customize_register', array( $this, 'register_customize_sections' ) );

	}

	/**
	 * Add all sections and panels to the Customizer
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	 */
	public function register_customize_sections( $wp_customize ) {

		/*
		 * Rename Existing Sections
		 */

		// Yoast SEO
		$wp_customize->add_section( 'wpseo_breadcrumbs_customizer_section' , array(
			'title'		=> __('Breadcrumbs','ecclesio-hallmark-theme'),
			'priority'	=> 120,
		));

		/*
		 * Add Sections
		 */

		// New section for "Church Information".
		$wp_customize->add_section( 'ecclesio_church_info', array(
			'title'    => __( 'Church Info', 'ecclesio-hallmark-theme' ),
			'priority' => 101
		) );
		// New section for "Church Information".
		$wp_customize->add_section( 'ecclesio_church_social', array(
			'title'    => __( 'Social Media', 'ecclesio-hallmark-theme' ),
			'priority' => 102
		) );
		// New section for "Colors".
		$wp_customize->add_section( 'ecclesio_theme_colors', array(
			'title'    => __( 'Theme Colors', 'ecclesio-hallmark-theme' ),
			'priority' => 20
		) );
		// New section for "Staff Options".
		$wp_customize->add_section( 'ecclesio_church_staff', array(
			'title'    => __( 'Staff', 'ecclesio-hallmark-theme' ),
			'active_callback' => 'is_template_staff',
			'priority' => 19 //place above "Site Identity"
		) );
		// New section for "Sermon Archive Options".
		$wp_customize->add_section( 'ecclesio_church_sermons', array(
			'title'    => __( 'Sermon Archive', 'ecclesio-hallmark-theme' ),
			'active_callback' => 'is_archive_sermons',
			'priority' => 19 //place above "Site Identity"
		) );

		/*
		 * Add settings to sections.
		 */
		$this->ecclesio_title_tagline_section( $wp_customize );
		$this->ecclesio_church_info_section( $wp_customize );
		$this->ecclesio_church_social_section( $wp_customize );
		$this->ecclesio_theme_colors_section( $wp_customize );
		$this->ecclesio_church_staff_section( $wp_customize );
		$this->ecclesio_church_sermons_section( $wp_customize );
	}

	/**
	 * Existing Section: title_tagline
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @access private
	 * @since  1.0
	 * @return void
	 */
	private function ecclesio_title_tagline_section( $wp_customize ) {
		$section = 'title_tagline';
		/* Site Logo */
		$setting = 'ecclesio_site_logo';
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'default' => get_bloginfo('stylesheet_directory') . '/images/logo.svg',
		) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting, array(
		    	'label'    => __( 'Site Logo', 'ecclesio-hallmark-theme' ),
		    	'description' => __( 'Recommended format: transparent PNG or SVG. <br />Recommended dimensions: <strong>240x80px</strong>', 'ecclesio-hallmark-theme' ),
				'section'  => $section,
				'settings' => $setting,
			) ) );
	}

	/**
	 * Section: Church Info
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @access private
	 * @since  1.0
	 * @return void
	 */
	private function ecclesio_church_info_section( $wp_customize ) {
		$section = 'ecclesio_church_info';
	    /* Church Phone Number */
	    // Add Setting
		$wp_customize->add_setting( 'ecclesio_church_phone', array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '(555) ECC-LESI',
			'transport' => 'postMessage', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ecclesio_church_phone', array(
				'label'       => esc_html__( 'Church Phone Number', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => '(XXX) XXX-XXXX'
			    ),
				'description' => esc_html__( 'Type the main contact number for your church.', 'ecclesio-hallmark-theme' ),
				'section'     => 'ecclesio_church_info',
				'settings'    => 'ecclesio_church_phone',
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_church_phone', array(
			    'selector' => '.ecclesio-part-phone',
			    'settings' => array( 'ecclesio_church_phone' ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_church_phone',
			    'fallback_refresh' => false,
			) );

		/* Church Address */
		// Add Setting
		$wp_customize->add_setting( 'ecclesio_church_address', array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '700 Hallmark Ln. Fort Worth, TX 76120',
			'transport' => 'postMessage', // or postMessage
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'ecclesio_church_address', array(
				'label'       => esc_html__( 'Church Address', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'Street, City, State, ZIP'
			    ),
				'description' => esc_html__( 'Type the full address for your church.', 'ecclesio-hallmark-theme' ),
				'section'     => 'ecclesio_church_info',
				'settings'    => 'ecclesio_church_address',
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_church_address', array(
			    'selector' => '.ecclesio-part-address',
			    'settings' => array( 'ecclesio_church_address' ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_church_address',
			    'fallback_refresh' => false,
			) );
		/* Service Times Heading */
		$setting = 'ecclesio_church_services_heading';
		// Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => 'Sunday Service Times',
			'transport' => 'postMessage', // or postMessage
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Service Times Heading', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'Sunday Service Times'
			    ),
				'description' => esc_html__( 'This will go in the colored bar in your footer.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_church_services_heading', array(
			    'selector' => '.ecclesio-part-services-heading',
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_church_services_heading',
			    'fallback_refresh' => false,
			) );
		/* Service Times */
		$setting = 'ecclesio_church_service_times';
		// Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => 'Bible Study: 9:30am | Worship: 10:30am',
			'transport' => 'postMessage', // or postMessage
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Service Times', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => ''
			    ),
				'description' => esc_html__( 'This will go in the colored bar in your footer.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_church_service_times', array(
			    'selector' => '.ecclesio-part-service-times',
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_church_service_times',
			    'fallback_refresh' => false,
			) );
				

	} // ecclesio_church_info_section

	/**
	 * Section: Social Media
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @access private
	 * @since  1.0
	 * @return void
	 */
	private function ecclesio_church_social_section( $wp_customize ) {
		$section = 'ecclesio_church_social';
	    /* Facebook */
	    $setting = 'ecclesio_social_facebook';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Facebook URL', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'https://www.facebook.com/hallmarkbc/'
			    ),
				'description' => esc_html__( 'Enter the full URL for your Facebook page.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
		/* Instagram */
	    $setting = 'ecclesio_social_insta';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Instagram URL', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'https://www.instagram.com/hallmarkbaptist/'
			    ),
				'description' => esc_html__( 'Enter the full URL for your Instagram profile.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
		/* Twitter */
	    $setting = 'ecclesio_social_twitter';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Twitter URL', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'https://twitter.com/hallmarkbc'
			    ),
				'description' => esc_html__( 'Enter the full URL for your Twitter profile.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
		/* Google */
	    $setting = 'ecclesio_social_google';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Google+ URL', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'https://plus.google.com/+HallmarkBaptistChurchFortWorth'
			    ),
				'description' => esc_html__( 'Enter the full URL for your Google+ profile.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
		/* iTunes */
	    $setting = 'ecclesio_social_itunes';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'iTunes Podcast URL', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'https://itunes.apple.com/us/podcast/hallmark-baptist-church/id988947559?mt=2'
			    ),
				'description' => esc_html__( 'Enter the full URL for your iTunes podcast', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
		/* Snapchat */
	    $setting = 'ecclesio_social_snap';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Snapchat URL', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'https://www.snapchat.com/add/username'
			    ),
				'description' => esc_html__( 'Enter the full URL for your Snapchat profile.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
		/* Spotify */
	    $setting = 'ecclesio_social_spotify';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Spotify URL', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'http://open.spotify.com/user/yourusername'
			    ),
				'description' => esc_html__( 'Enter the full URL for your Spotify profile.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
		/* Vimeo */
	    $setting = 'ecclesio_social_vimeo';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Vimeo URL', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'https://vimeo.com/username'
			    ),
				'description' => esc_html__( 'Enter the full URL for your Vimeo profile.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
		/* YouTube */
	    $setting = 'ecclesio_social_yt';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'refresh', // or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'YouTube URL', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'https://www.youtube.com/user/username/'
			    ),
				'description' => esc_html__( 'Enter the full URL for your YouTube profile.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );

	} // ecclesio_church_social_section

	/**
	 * Section: Theme Colors
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @access private
	 * @since  1.0
	 * @return void
	 */
	private function ecclesio_theme_colors_section( $wp_customize ) {
		$section = 'ecclesio_theme_colors';

		/* Main Color */
		$setting = 'ecclesio_color_main';
		$wp_customize->add_setting( $setting, array(
			'type' 				=> 'theme_mod', // This is a THEME_MOD, *not* a site-wide option. AKA this sticks only with this theme.
			'transport'			=> 'postMessage',
			'default'           => '#358fcd',
			'sanitize_callback' => 'sanitize_hex_color'
		) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
				'label'    => esc_html__( 'Main Color', 'ecclesio-hallmark-theme' ),
				'section'  => $section,
				'settings' => $setting,
				'priority' => 10
			) ) );
		/* Accent Color */
		$setting = 'ecclesio_color_accent';
		$wp_customize->add_setting( $setting, array(
			'type' 				=> 'theme_mod',
			'transport'			=> 'postMessage',
			'default'           => '#f8981d',
			'sanitize_callback' => 'sanitize_hex_color'
		) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
				'label'    => esc_html__( 'Accent Color', 'ecclesio-hallmark-theme' ),
				'section'  => $section,
				'settings' => $setting,
				'priority' => 10
			) ) );
		/* Banner Color */
		$setting = 'ecclesio_color_banner';
		$wp_customize->add_setting( $setting, array(
			'type' 				=> 'theme_mod',
			'transport'			=> 'postMessage',
			'default'           => '#016CC5',
			'sanitize_callback' => 'sanitize_hex_color'
		) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
				'label'    => esc_html__( 'Banner Color', 'ecclesio-hallmark-theme' ),
				'section'  => $section,
				'settings' => $setting,
				'priority' => 10
			) ) );
		/* Footer Color */
		$setting = 'ecclesio_color_footer';
		$wp_customize->add_setting( $setting, array(
			'type' 				=> 'theme_mod',
			'transport'			=> 'postMessage',
			'default'           => '#4a4a4a',
			'sanitize_callback' => 'sanitize_hex_color'
		) );
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, array(
				'label'    => esc_html__( 'Footer Color', 'ecclesio-hallmark-theme' ),
				'section'  => $section,
				'settings' => $setting,
				'priority' => 10
			) ) );
		
	} //ecclesio_theme_colors

	/**
	 * Section: Church Staff
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @access private
	 * @since  1.0
	 * @return void
	 */
	private function ecclesio_church_staff_section( $wp_customize ) {
		$section = 'ecclesio_church_staff';
	    /* Display Count */
	    $setting = 'ecclesio_staff_count';
		$wp_customize->add_setting( $setting, array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'default' => '4',
			'transport' => 'refresh', // refresh or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'People per Row', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => '4'
			    ),
				'description' => esc_html__( 'Number of staff displayed per row.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'number',
				'input_attrs' => array(
				    'min' => 1,
				    'max' => 12,
				    'step' => 1,
				  ),
				'priority'    => 10
			) ) );

	} // ecclesio_church_staff_section

	/**
	 * Section: Sermons Archive
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @access private
	 * @since  1.0
	 * @return void
	 */
	private function ecclesio_church_sermons_section( $wp_customize ) {
		$section = 'ecclesio_church_sermons';
		/* Banner Image */
		$setting = 'ecclesio_sermon_banner_image';
		$wp_customize->add_setting( $setting, array(
			'type' => 'theme_mod', //option or theme_mod
			'default' => get_bloginfo('stylesheet_directory') . '/images/home_sermon_latest.jpg',
		) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting, array(
		    	'label'    => __( 'Banner Image', 'ecclesio-hallmark-theme' ),
		    	'description' => __( 'Recommended format: JPG.', 'ecclesio-hallmark-theme' ),
				'section'  => $section,
				'settings' => $setting,
			) ) );
	    /* Banner Heading */
	    $setting = 'ecclesio_sermon_banner_heading';
		$wp_customize->add_setting( $setting, array(
			'type' => 'option', //option or theme_mod
			'capability' => 'edit_theme_options',
			'default' => 'Sermons',
			'transport' => 'postMessage', // refresh or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Banner Heading', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'Sermons'
			    ),
				'description' => esc_html__( 'Banner heading for Sermons archive.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_sermon_banner_heading', array(
			    'selector' => '.post-type-archive-ctc_sermon #banner .banner-text .page-title',
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_sermons_heading',
			    'fallback_refresh' => false,
			) );
		/* Banner Caption */
	    $setting = 'ecclesio_sermon_banner_byline';
		$wp_customize->add_setting( $setting, array(
			'type' => 'option', //option or theme_mod
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'postMessage', // refresh or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Banner Byline', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => ''
			    ),
				'description' => esc_html__( 'Banner byline for Sermons archive.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_sermon_banner_byline', array(
			    'selector' => '.ecclesio-part-sermons-byline',
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_sermons_byline',
			    'fallback_refresh' => false,
			) );

	} // ecclesio_church_sermons_section

	/**
	 * Sanitize Checkbox
	 * 
	 * Accepts only "true" or "false" as possible values.
	 *
	 * @param $input
	 *
	 * @access public
	 * @since  1.0
	 * @return bool
	 */
	public function sanitize_checkbox( $input ) {
		return ( $input === true ) ? true : false;
	}

} //Ecclesio_Hallmark_Customizer

/*
 * Make data publicly available by placing them outside of the Class
 */

//Partials
function get_customize_partial_church_address() {
    $option = get_option( 'ecclesio_church_address' );
    return $option;
}
function get_customize_partial_church_phone() {
    $option = get_option( 'ecclesio_church_phone' );
    return $option;
}
function get_customize_partial_church_services_heading() {
    $option = get_option( 'ecclesio_church_services_heading' );
    return $option;
}
function get_customize_partial_church_service_times() {
    $option = get_option( 'ecclesio_church_service_times' );
    return $option;
}
function get_customize_partial_sermons_heading() {
    $option = get_option( 'ecclesio_sermon_banner_heading' );
    return $option;
}
function get_customize_partial_sermons_byline() {
    $option = get_option( 'ecclesio_sermon_banner_byline' );
    return $option;
}

//Non-Partials
function get_customize_social_fb() {
    $option = get_option( 'ecclesio_social_facebook' );
    return $option;
}
function get_customize_social_insta() {
    $option = get_option( 'ecclesio_social_insta' );
    return $option;
}
function get_customize_social_twitter() {
    $option = get_option( 'ecclesio_social_twitter' );
    return $option;
}
function get_customize_social_google() {
    $option = get_option( 'ecclesio_social_google' );
    return $option;
}
function get_customize_social_itunes() {
    $option = get_option( 'ecclesio_social_itunes' );
    return $option;
}
function get_customize_social_snap() {
    $option = get_option( 'ecclesio_social_snap' );
    return $option;
}
function get_customize_social_spotify() {
    $option = get_option( 'ecclesio_social_spotify' );
    return $option;
}
function get_customize_social_vimeo() {
    $option = get_option( 'ecclesio_social_vimeo' );
    return $option;
}
function get_customize_social_yt() {
    $option = get_option( 'ecclesio_social_yt' );
    return $option;
}

/*
 * Active Callbacks
 */
function is_template_staff(){
    // Get the page's template
    if ( is_page_template( 'template-people.php' ) == 0 ){
        return false;
    } else {
        return true;
    }
}
function is_archive_sermons(){
    // Get the page's template
    if ( is_post_type_archive( 'ctc_sermon' ) == 0 ){
        return false;
    } else {
        return true;
    }
}

/**
 * Generate CSS based on the Customizer settings.
 *
 * @since 1.0
 * @return string
 */
function ecclesio_customizer_css() {

	// Variables
	$css = '';

	$color_main = get_theme_mod( 'ecclesio_color_main', '#358fcd' );
	$color_accent = get_theme_mod( 'ecclesio_color_accent', '#f8981d' );
	$color_banner = get_theme_mod( 'ecclesio_color_banner', '#016CC5' );
		list($r, $g, $b) = sscanf($color_banner, "#%02x%02x%02x");
	$color_footer = get_theme_mod( 'ecclesio_color_footer', '#4a4a4a' );

	// Generate CSS
	//Main Color
	$css .= '#menu-main-menu-1 .submenu li a:hover, .footer-top, .off-canvas, button.hamburger .hamburger-inner, button.hamburger .hamburger-inner:after, button.hamburger .hamburger-inner:before, .pagination .current, .button { background-color: ' . $color_main . '; }';
	$css .= 'a, #menu-main-menu-1 li.active>a, #menu-main-menu-1 li a:hover, #listing article .card .button:active, #listing article .card .button:focus, #listing article .card .button:hover, .button.outline-white:hover, .button.outline-white:active, .button.outline-white:focus, .tabs-sermon .tabs-title.is-active a { color: ' . $color_main . '; }';
	$css .= '.dropdown.menu.medium-horizontal>li.is-dropdown-submenu-parent>a:after { border-color: ' . $color_main . ' transparent transparent; }';
	//Accent Color
	$css .= 'a:focus, a:hover { color: ' . $color_accent . '; }';
	$css .= '#purpose, #sermon-latest .text-container .button { border-color: ' . $color_accent . '; }';
	$css .= '.home #banner .button-group li a.button:hover, .home #banner .button-group li a.button:focus, .home #banner .button-group li a.button:active, #sermon-latest .text-container h5, #sermon-latest .text-container .button:hover, #sermon-latest .text-container .button:active, #sermon-latest .text-container .button:focus, button.hamburger:hover .hamburger-inner, button.hamburger:hover .hamburger-inner:after, button.hamburger:hover .hamburger-inner:before { background-color: ' . $color_accent . '; }';
	//Banner Color
	$css .= '#banner .overlay { background: rgba('.$r.', '.$g.', '.$b.', 0.75); }';
	//Foter Color
	$css .= 'footer.footer { background-color: '. $color_footer .'; }';

	// Return CSS
	return $css;
}

/* 
 * Preview CSS changes without refreshs
 * Also see ecclesio-customizer.js
 * Also see functions.php
 */
add_action( 'wp_head', 'ecclesio_customizer_empty_style' );
 
/**
 * Print Empty Color CSS
 */
function ecclesio_customizer_empty_style(){
 
    /* Add in Customizer Only (style tag placeholder for link color). */
    global $wp_customize;
    if ( isset( $wp_customize ) ){
        echo "\n" . '<style type="text/css" id="ecclesio-customizer-preview"></style>' . "\n";
    }
}

/* 
 * Custom palette for color pickder
 * https://wordpress.org/support/topic/universally-change-iris-palette/
 */
add_action('admin_enqueue_scripts', 'ecclesio_iris_palette');
function ecclesio_iris_palette() {
	/* Add in Customizer Only */
	global $wp_customize;
	if ( isset( $wp_customize ) ){
		wp_enqueue_script( 'ecclesio-customizer-iris-palette', get_stylesheet_directory_uri() . '/js/ecclesio-customizer-iris-palette.js');
	}
}

/* 
 * Remove sections from the Customizer
 * https://wordpress.stackexchange.com/questions/181905/remove-the-widgets-tab-from-theme-customizer
 */
function ecclesio_edit_customizer( $wp_customize ) {
	$wp_customize->remove_panel( 'widgets' );
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'themes' );
}
add_action( 'customize_register', 'ecclesio_edit_customizer' );