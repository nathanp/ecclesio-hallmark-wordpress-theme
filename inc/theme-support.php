<?php
	
// Adding WP Functions & Theme Support
function ecclesio_theme_support() {

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );
	
	// Default thumbnail size
	set_post_thumbnail_size(125, 125, true);

	// Add RSS Support
	add_theme_support( 'automatic-feed-links' );
	
	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );
	
	// Add HTML5 Support
	add_theme_support( 'html5', 
		array( 
			'comment-list', 
			'comment-form', 
			'search-form', 
		) 
	);
	
	// Adding post format support
	 add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// Adding custom header support
	 $header_info = array(
	    'width'         => 1920,
	    'height'        => 720,
	    'default-image' => get_template_directory_uri() . '/images/demo_banner_worship.jpg',
	);
	add_theme_support( 'custom-header', $header_info );
	 
	$header_images = array(
	    'worship' => array(
	            'url'           => get_template_directory_uri() . '/images/demo_banner_worship.jpg',
	            'thumbnail_url' => get_template_directory_uri() . '/images/demo_banner_worship.jpg',
	            'description'   => 'Worship',
	    ),
	    'bible' => array(
	            'url'           => get_template_directory_uri() . '/images/demo_banner_bible.jpg',
	            'thumbnail_url' => get_template_directory_uri() . '/images/demo_banner_bible.jpg',
	            'description'   => 'Bible',
	    ),
	    'laughing' => array(
	            'url'           => get_template_directory_uri() . '/images/demo_banner_laughing.jpg',
	            'thumbnail_url' => get_template_directory_uri() . '/images/demo_banner_laughing.jpg',
	            'description'   => 'Laughing',
	    ),
	);
	register_default_headers( $header_images );
	
	// Set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
	$GLOBALS['content_width'] = apply_filters( 'ecclesio_theme_support', 1200 );	
	
} /* end theme support */

add_action( 'after_setup_theme', 'ecclesio_theme_support' );