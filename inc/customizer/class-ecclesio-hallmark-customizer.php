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
		// New section for "Sermon Archive Options".
		$wp_customize->add_section( 'ecclesio_church_sermons', array(
			'title'    => __( 'Sermon Archive', 'ecclesio-hallmark-theme' ),
			'active_callback' => 'is_archive_sermons',
			'priority' => 19 //place above "Site Identity"
		) );
		// New section for "Event Archive Options".
		$wp_customize->add_section( 'ecclesio_church_events', array(
			'title'    => __( 'Event Archive', 'ecclesio-hallmark-theme' ),
			'active_callback' => 'is_archive_events',
			'priority' => 19 //place above "Site Identity"
		) );
		// New section for "Footer".
		$wp_customize->add_section( 'ecclesio_church_footer', array(
			'title'    => __( 'Footer Options', 'ecclesio-hallmark-theme' ),
			'priority' => 190 //place above "Additional CSS"
		) );

		/*
		 * Add settings to sections.
		 */
		$this->ecclesio_title_tagline_section( $wp_customize );
		$this->ecclesio_church_info_section( $wp_customize );
		$this->ecclesio_church_social_section( $wp_customize );
		$this->ecclesio_theme_colors_section( $wp_customize );
		$this->ecclesio_church_sermons_section( $wp_customize );
		$this->ecclesio_church_events_section( $wp_customize );
		$this->ecclesio_church_footer_section( $wp_customize );
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
			'default' => get_template_directory_uri() . '/images/home_sermon_latest.jpg',
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
			    'selector' => '.post-type-archive-ctc_sermon #banner .banner-text .page-byline',
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_sermons_byline',
			    'fallback_refresh' => false,
			) );

	} // ecclesio_church_sermons_section

	/**
	 * Section: Events Archive
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @access private
	 * @since  1.0
	 * @return void
	 */
	private function ecclesio_church_events_section( $wp_customize ) {
		$section = 'ecclesio_church_events';
		/* Banner Image */
		$setting = 'ecclesio_event_banner_image';
		$wp_customize->add_setting( $setting, array(
			'type' => 'theme_mod', //option or theme_mod
			'default' => get_template_directory_uri() . '/images/ft-worth.jpg',
		) );
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting, array(
		    	'label'    => __( 'Banner Image', 'ecclesio-hallmark-theme' ),
		    	'description' => __( 'Recommended format: JPG.', 'ecclesio-hallmark-theme' ),
				'section'  => $section,
				'settings' => $setting,
			) ) );
	    /* Banner Heading */
	    $setting = 'ecclesio_event_banner_heading';
		$wp_customize->add_setting( $setting, array(
			'type' => 'option', //option or theme_mod
			'capability' => 'edit_theme_options',
			'default' => 'Events',
			'transport' => 'postMessage', // refresh or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Banner Heading', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => 'Events'
			    ),
				'description' => esc_html__( 'Banner heading for Events archive.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_event_banner_heading', array(
			    'selector' => '.post-type-archive-ctc_event #banner .banner-text .page-title',
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_events_heading',
			    'fallback_refresh' => false,
			) );
		/* Banner Caption */
	    $setting = 'ecclesio_event_banner_byline';
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
				'description' => esc_html__( 'Banner byline for Events archive.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_event_banner_byline', array(
			    'selector' => '.post-type-archive-ctc_event #banner .banner-text .page-byline',
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_events_byline',
			    'fallback_refresh' => false,
			) );
		/* Banner Button */
	    $setting = 'ecclesio_event_banner_button';
		$wp_customize->add_setting( $setting, array(
			'type' => 'option', //option or theme_mod
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'postMessage', // refresh or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Banner Button', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => ''
			    ),
				'description' => esc_html__( 'Banner button for Events archive.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_event_banner_button', array(
			    'selector' => '.post-type-archive-ctc_event #banner .banner-text .button',
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_events_button',
			    'fallback_refresh' => false,
			) );
		/* Banner Button Link */
	    $setting = 'ecclesio_event_banner_button_link';
		$wp_customize->add_setting( $setting, array(
			'type' => 'option', //option or theme_mod
			'capability' => 'edit_theme_options',
			'default' => '',
			'transport' => 'postMessage', // refresh or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $setting, array(
				'label'       => esc_html__( 'Banner Button Link', 'ecclesio-hallmark-theme' ),
				'input_attrs' => array(
			        'placeholder' => ''
			    ),
				'description' => esc_html__( 'Banner button link for Events archive.', 'ecclesio-hallmark-theme' ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_event_banner_button_link', array(
			    'selector' => '.post-type-archive-ctc_event #banner .banner-text .button',
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_events_button_link',
			    'fallback_refresh' => false,
			) );

	} // ecclesio_church_events_section

	/**
	 * Section: Footer
	 *
	 * @param WP_Customize_Manager $wp_customize
	 *
	 * @access private
	 * @since  1.0
	 * @return void
	 */
	private function ecclesio_church_footer_section( $wp_customize ) {
		$section = 'ecclesio_church_footer';
		$text_domain = 'ecclesio-hallmark-theme';
	    /* Footer CTA Text */
	    $setting = 'ecclesio_church_footer_cta_text';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'default' => 'Contact Us',
			'transport' => 'postMessage', // refresh or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize,  $setting, array(
				'label'       => esc_html__( 'Footer Button Text', $text_domain ),
				'description' => esc_html__( 'Type the button text for the main call to action button in the footer.', $text_domain ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );
			// Selective Refresh
			$wp_customize->selective_refresh->add_partial( 'ecclesio_part_church_footer_cta_text', array(
			    'selector' => '.ecclesio-part-cta-text', //match this selector with the selctor in the customizer js file.
			    'settings' => array( $setting ),
			    'container_inclusive' => false,
			    'render_callback' => 'get_customize_partial_church_footer_cta_text',
			    'fallback_refresh' => false,
			) );
		/* Footer CTA URL */
	    $setting = 'ecclesio_church_footer_cta_url';
	    // Add Setting
		$wp_customize->add_setting( $setting, array(
			'type' => 'option',
			'default' => '',
			'transport' => 'refresh', // refresh or postMessage
			'sanitize_callback' => 'sanitize_text_field'
		) );
			// Add Control
			$wp_customize->add_control( new WP_Customize_Control( $wp_customize,  $setting, array(
				'label'       => esc_html__( 'Footer Button URL', $text_domain ),
				'description' => esc_html__( 'Type the URL for the main call to action button in the footer.', $text_domain ),
				'section'     => $section,
				'settings'    => $setting,
				'type'        => 'text',
				'priority'    => 10
			) ) );				

	} // ecclesio_church_footer_section

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
function get_customize_partial_events_heading() {
    $option = get_option( 'ecclesio_event_banner_heading' );
    return $option;
}
function get_customize_partial_events_byline() {
    $option = get_option( 'ecclesio_event_banner_byline' );
    return $option;
}
function get_customize_partial_events_button() {
    $option = get_option( 'ecclesio_event_banner_button' );
    return $option;
}
function get_customize_partial_events_button_link() {
    $option = get_option( 'ecclesio_event_banner_button_link' );
    return $option;
}
function get_customize_partial_church_footer_cta_text() {
    $option = get_option( 'ecclesio_church_footer_cta_text' );
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
function get_customize_church_footer_cta_url() {
    $option = get_option( 'ecclesio_church_footer_cta_url' );
    return $option;
}

/*
 * Active Callbacks
 */
function is_archive_sermons(){
    // Get the page's template
    if ( is_post_type_archive( 'ctc_sermon' ) == 0 ){
        return false;
    } else {
        return true;
    }
}
function is_archive_events(){
    // Get the page's template
    if ( is_post_type_archive( 'ctc_event' ) == 0 ){
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

	// BRAND COLOR - PRIMARY
	// Background color
	$css .= '.footer-top, input[type="submit"], button.hamburger .hamburger-inner, button.hamburger .hamburger-inner:after, button.hamburger .hamburger-inner:before, button.hamburger .hamburger-inner:hover .hamburger-inner, button.hamburger .hamburger-inner:hover .hamburger-inner:after, button.hamburger .hamburger-inner:hover .hamburger-inner:before, .off-canvas #menu-main-menu, .timeline__content-title { background-color: ' . $color_main . '; }';
	// Text color
	$css .= 'a, #listing article .card .btn:active, #listing article .card .btn:focus, #listing article .card .btn:hover, #top-bar-menu .desktop .nav li a:hover, #top-bar-menu .desktop .nav > li.active > a, .tabs-sermon .link-title .nav-link.active { color: ' . $color_main . '; }';
	// Border color
	$css .= '.gform_wrapper input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]):focus, .gform_wrapper input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]):active, .gform_wrapper textarea:active, .gform_wrapper textarea:focus, .timeline-item:before, .timeline-item:nth-child(even):before { border-color: ' . $color_main . ' transparent transparent; }';
	// Dropdown arrow
	$css .= '#top-bar-menu .desktop .nav li .dropdown-toggle::after { border-top-color: ' . $color_main . '; }';

	// BRAND COLOR - SECONDARY
	// Background color
	$css .= '.home #banner .button-group li a.button:hover, .home #banner .button-group li a.button:focus, .home #banner .button-group li a.button:active, #sermon-latest .text-container h5, #sermon-latest .text-container .button:hover, #sermon-latest .text-container .button:active, #sermon-latest .text-container .button:focus, button.hamburger:hover .hamburger-inner, button.hamburger:hover .hamburger-inner:after, button.hamburger:hover .hamburger-inner:before { background-color: ' . $color_accent . '; }';
	// Text color
	$css .= 'a:focus, a:hover { color: ' . $color_accent . '; }';
	// Border color
	$css .= '#purpose, #sermon-latest .text-container .button { border-color: ' . $color_accent . '; }';
	
	//Banner Color
	$css .= '#banner .overlay { background: rgba('.$r.', '.$g.', '.$b.', 0.75); }';
	//Foter Color
	$css .= 'footer.footer { background-color: '. $color_footer .'; }';
	$css .= '.footer-top .social a:hover { color: '. $color_footer .'; }';
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
add_action('admin_enqueue_scripts', 'ecclesio_iris_palette', 9000);
function ecclesio_iris_palette() {
	/* Add in Customizer Only */
	global $wp_customize;
	if ( isset( $wp_customize ) ){
		wp_enqueue_script( 'ecclesio-customizer-iris-palette', get_template_directory_uri() . '/js/admin/ecclesio-customizer-iris-palette.js');
	}
}

/* 
 * Remove sections from the Customizer
 * https://wordpress.stackexchange.com/questions/181905/remove-the-widgets-tab-from-theme-customizer
 */
function ecclesio_edit_customizer_sections( $wp_customize ) {
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'themes' );
	$wp_customize->remove_section( 'colors' );
}
add_action( 'customize_register', 'ecclesio_edit_customizer_sections' );


/**
 * Customize the available fonts in the Customizer
 * Utilizes Ultimate Fonts plugin
 */
function ecclesio_fonts( $fonts_array ) {
 
 	$fonts_array = array(
		'system' => array(
			'label' => esc_html__( 'System Fonts', 'ultimate-fonts' ),
			'fonts' => array(
				'Arial'               => '400,400italic,700,700italic|Helvetica, sans-serif',
				'Tahoma'              => '400,400italic,700,700italic|Geneva, sans-serif',
				'Verdana'             => '400,400italic,700,700italic|Geneva, sans-serif',
				'Lucida Sans Unicode' => '400,400italic,700,700italic|"Lucida Grande", sans-serif',
				'Georgia'             => '400,400italic,700,700italic|serif',
				'Times New Roman'     => '400,400italic,700,700italic|Times, serif',
				'Palatino Linotype'   => '400,400italic,700,700italic|"Book Antiqua", Palatino, serif',
			),
		),
		'google' => array(
			'label' => esc_html__( 'Google Fonts', 'ultimate-fonts' ),
			'fonts' => array(
				'Abril Fatface'            => '400|cursive|latin,latin-ext',
				'Alegreya'                 => '400,400italic,700,700italic,900,900italic|serif|latin,latin-ext',
				'Alegreya SC'              => '400,400italic,700,700italic,900,900italic|serif|latin,latin-ext',
				'Alegreya Sans'            => '100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,800,800italic,900,900italic|sans-serif|vietnamese,latin,latin-ext',
				'Alegreya Sans SC'         => '100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,800,800italic,900,900italic|sans-serif|vietnamese,latin,latin-ext',
				'Archivo Black'            => '400|sans-serif|latin,latin-ext',
				'Archivo Narrow'           => '400,400italic,700,700italic|sans-serif|latin,latin-ext',
				'Arvo'                     => '400,400italic,700,700italic|serif|latin',
				'Bitter'                   => '400,400italic,700|serif|latin,latin-ext',
				'Cabin'                    => '400,400italic,500,500italic,600,600italic,700,700italic|sans-serif|latin',
				'Cabin Condensed'          => '400,500,600,700|sans-serif|latin',
				'Cardo'                    => '400,400italic,700|serif|greek-ext,greek,latin,latin-ext',
				'Chivo'                    => '400,400italic,900,900italic|sans-serif|latin',
				'Cormorant'                => '300,300i,400,400i,500,500i,600,600i,700,700i|sans-serif|latin',
				'Crimson Text'             => '400,400italic,600,600italic,700,700italic|serif|latin',
				'Domine'                   => '400,700|serif|latin,latin-ext',
				'Eczar'                    => '400,500,600,700,800|serif|devanagari,latin,latin-ext',
				'Fira Sans'                => '300,300italic,400,400italic,500,500italic,700,700italic|sans-serif|cyrillic-ext,cyrillic,greek,latin,latin-ext',
				'Gentium Basic'            => '400,400italic,700,700italic|serif|latin,latin-ext',
				'Gentium Book Basic'       => '400,400italic,700,700italic|serif|latin,latin-ext',
				'Karla'                    => '400,400italic,700,700italic|sans-serif|latin,latin-ext',
				'Lato'                     => '100,100italic,300,300italic,400,400italic,700,700italic,900,900italic|sans-serif|latin,latin-ext',
				'Libre Baskerville'        => '400,400italic,700|serif|latin,latin-ext',
				'Lora'                     => '400,400italic,700,700italic|serif|cyrillic,latin,latin-ext',
				'Merriweather'             => '300,300italic,400,400italic,700,700italic,900,900italic|serif|cyrillic-ext,cyrillic,latin,latin-ext',
				'Merriweather Sans'        => '300,300italic,400,400italic,700,700italic,800,800italic|sans-serif|latin,latin-ext',
				'Montserrat'               => '400,700|sans-serif|latin',
				'Neuton'                   => '200,300,400,400italic,700,800|serif|latin,latin-ext',
				'Old Standard TT'          => '400,400italic,700|serif|latin',
				'Open Sans'                => '300,300italic,400,400italic,600,600italic,700,700italic,800,800italic|sans-serif|cyrillic-ext,greek-ext,cyrillic,vietnamese,greek,latin,latin-ext',
				'Open Sans Condensed'      => '300,300italic,700|sans-serif|cyrillic-ext,greek-ext,cyrillic,vietnamese,greek,latin,latin-ext',
				'Oswald'                   => '300,400,700|sans-serif|latin,latin-ext',
				'PT Sans'                  => '400,400italic,700,700italic|sans-serif|cyrillic-ext,cyrillic,latin,latin-ext',
				'PT Sans Caption'          => '400,700|sans-serif|cyrillic-ext,cyrillic,latin,latin-ext',
				'PT Sans Narrow'           => '400,700|sans-serif|cyrillic-ext,cyrillic,latin,latin-ext',
				'PT Serif'                 => '400,400italic,700,700italic|serif|cyrillic-ext,cyrillic,latin,latin-ext',
				'PT Serif Caption'         => '400,400italic|serif|cyrillic-ext,cyrillic,latin,latin-ext',
				'Playfair Display'         => '400,400italic,700,700italic,900,900italic|serif|cyrillic,latin,latin-ext',
				'Playfair Display SC'      => '400,400italic,700,700italic,900,900italic|serif|cyrillic,latin,latin-ext',
				'Poppins'                  => '300,400,500,600,700|sans-serif|devanagari,latin,latin-ext',
				'Rajdhani'                 => '300,400,500,600,700|sans-serif|devanagari,latin,latin-ext',
				'Raleway'                  => '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic|sans-serif|latin,latin-ext',
				'Roboto'                   => '100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic|sans-serif|cyrillic-ext,greek-ext,cyrillic,vietnamese,greek,latin,latin-ext',
				'Roboto Condensed'         => '300,300italic,400,400italic,700,700italic|sans-serif|cyrillic-ext,greek-ext,cyrillic,vietnamese,greek,latin,latin-ext',
				'Roboto Slab'              => '100,300,400,700|serif|cyrillic-ext,greek-ext,cyrillic,vietnamese,greek,latin,latin-ext',
				'Rubik'                    => '300,300italic,400,400italic,500,500italic,700,700italic,900,900italic|sans-serif|cyrillic,latin,latin-ext',
				'Rubik One'                => '400|sans-serif|cyrillic,latin,latin-ext',
				'Source Code Pro'          => '200,300,400,500,600,700,900|monospace|latin,latin-ext',
				'Source Sans Pro'          => '200,200italic,300,300italic,400,400italic,600,600italic,700,700italic,900,900italic|sans-serif|vietnamese,latin,latin-ext',
				'Source Serif Pro'         => '400,600,700|serif|latin,latin-ext',
				'Ubuntu'                   => '300,300italic,400,400italic,500,500italic,700,700italic|sans-serif|cyrillic-ext,greek-ext,cyrillic,greek,latin,latin-ext',
				'Ubuntu Condensed'         => '400|sans-serif|cyrillic-ext,greek-ext,cyrillic,greek,latin,latin-ext',
				'Vollkorn'                 => '400,400italic,700,700italic|serif|latin',
				'Work Sans'                => '100,200,300,400,500,600,700,800,900|sans-serif|latin,latin-ext',
			),
		),
	);   
 
    return $fonts_array;
}
add_filter('ultimate_fonts_fonts', 'ecclesio_fonts');