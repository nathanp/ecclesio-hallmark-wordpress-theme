<?php

/**
 * Register Google fonts.
 *
 *
 * @return string Google fonts URL for the theme.
 */
function ecclesio_google_fonts_url() {
  $fonts_url = '';
  $fonts     = array();
  $subsets   = 'latin,latin-ext';

  /* translators: If there are characters in your language that are not supported by Catamaran, translate this to 'off'. Do not translate into your own language. */
  if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'ecclesio' ) ) {
    $fonts[] = 'Montserrat:300,400,700';
  }
  if ( 'off' !== _x( 'on', 'Lora font: on or off', 'ecclesio' ) ) {
    $fonts[] = 'Lora:400,700';
  }

  if ( $fonts ) {
    $fonts_url = add_query_arg( array(
      'family' => urlencode( implode( '|', $fonts ) ),
      'subset' => urlencode( $subsets ),
    ), 'https://fonts.googleapis.com/css' );

  }
  $fonts_url = str_replace("%2B", "+", $fonts_url); //keep plus signs
  return $fonts_url;
}

function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
    
    // Load What-Input files in footer
    wp_enqueue_script( 'what-input', get_template_directory_uri() . '/vendor/what-input/dist/what-input.min.js', array(), '', true );
    
    // Adding Foundation scripts file in the footer
    wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/vendor/foundation-sites/dist/js/foundation.min.js', array( 'jquery' ), '6.2.3', true );
    
    // Adding scripts file in the footer
    wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '', true );
	
	// Select which grid system you want to use (Foundation Grid by default)
    wp_enqueue_style( 'foundation-css', get_template_directory_uri() . '/vendor/foundation-sites/dist/css/foundation.min.css', array(), '', 'all' );
     //wp_enqueue_style( 'foundation-css', get_template_directory_uri()() . '/vendor/foundation-sites/dist/foundation-flex.min.css', array(), '', 'all' );

    // Register main stylesheet
    wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/css/style.css', array(), '', 'all' );

    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);

/**
 * Enqueues scripts and styles.
 */
function ecclesio_scripts() {
  // Add custom fonts, used in the main stylesheet.
  wp_enqueue_style( 'ecclesio-fonts', ecclesio_google_fonts_url(), array(), null );

  // Primary CSS
  wp_enqueue_style( 'ecclesio-primary', get_template_directory_uri() . '/style.css', array(), '1.0' );
  // Responsive
  wp_enqueue_style( 'ecclesio-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1.0' );
  // Hamburgers Navigation
  wp_enqueue_style( 'ecclesio-hamburgers', get_template_directory_uri() . '/css/hamburgers.min.css', array(), '1.0' );
  // Font Awesome
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  // Live preview CSS changes
  wp_add_inline_style( 'ecclesio-responsive', ecclesio_customizer_css() ); //class-ecclesio-hallmark-customizer.php

  // Hallmark - Custom JS
  wp_enqueue_script( 'ecclesio-app-js', get_template_directory_uri() . '/js/ecclesio.js', array( 'jquery' ), '6.0', true );

}
add_action( 'wp_enqueue_scripts', 'ecclesio_scripts', 1000); //1000 places these after the defaults loaded by the parent theme

function ecclesio_customizer_preview() {
    wp_enqueue_script( 
          'ecclesio-customizer',
          get_template_directory_uri().'/js/ecclesio-customizer.js',
          array( 'jquery','customize-preview' )
    );
}
add_action('customize_preview_init','ecclesio_customizer_preview');

/**
 * Remove query strings from static resources.
 * Only does this for someone not an admin, so can more easily test development, etc.
 * https://atulhost.com/query-strings-remover
 */
function ecclesio_remove_query_strings_1( $src ){ 
  $rqs = explode( '?ver', $src );
  return $rqs[0];
}
  if ( is_admin() ) {
    // Remove query strings from static resources disabled in admin
  }
  else {
    add_filter( 'script_loader_src', 'ecclesio_remove_query_strings_1', 15, 1 );
    add_filter( 'style_loader_src', 'ecclesio_remove_query_strings_1', 15, 1 );
  }

function ecclesio_remove_query_strings_2( $src ){
  $rqs = explode( '&ver', $src );
    return $rqs[0];
}
  if ( is_admin() ) {
    // Remove query strings from static resources disabled in admin
  }

  else {
    add_filter( 'script_loader_src', 'ecclesio_remove_query_strings_2', 15, 1 );
    add_filter( 'style_loader_src', 'ecclesio_remove_query_strings_2', 15, 1 );
  }

  ?>