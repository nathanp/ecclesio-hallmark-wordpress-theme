<?php
/**
 * Register Google fonts.
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

/**
 * Enqueues scripts and styles.
 */
function ecclesio_scripts() {

  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  // Register main stylesheet
  wp_enqueue_style( 'ecclesio-css', get_template_directory_uri() . '/assets/css/style.css', array(), '', 'all' );

  // Add custom fonts, used in the main stylesheet.
  wp_enqueue_style( 'ecclesio-fonts', ecclesio_google_fonts_url(), array(), null );

  // Font Awesome
  wp_enqueue_style('ecclesio-font-awesome', '//use.fontawesome.com/releases/v5.3.1/css/all.css');

  // Live preview CSS changes
  wp_add_inline_style( 'ecclesio-responsive', ecclesio_customizer_css() ); //class-ecclesio-hallmark-customizer.php

  // Adding Bootstrap scripts file in the footer
  wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/dependencies/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), '4.1.3', true );

  // Hallmark - Custom JS
  wp_enqueue_script( 'ecclesio-app-js', get_template_directory_uri() . '/assets/js/frontend/ecclesio.js', array( 'jquery' ), '6.0', true );

  // Comment reply script for threaded comments
  if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
    wp_enqueue_script( 'comment-reply' );
  }

}
add_action( 'wp_enqueue_scripts', 'ecclesio_scripts', 1000); //1000 places these after the defaults loaded by the parent theme

function ecclesio_customizer_preview() {
    wp_enqueue_script( 
          'ecclesio-customizer',
          get_template_directory_uri().'/assets/js/admin/ecclesio-customizer.js',
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
} else {
  add_filter( 'script_loader_src', 'ecclesio_remove_query_strings_1', 15, 1 );
  add_filter( 'style_loader_src', 'ecclesio_remove_query_strings_1', 15, 1 );
}

function ecclesio_remove_query_strings_2( $src ){
  $rqs = explode( '&ver', $src );
    return $rqs[0];
}
if ( is_admin() ) {
  // Remove query strings from static resources disabled in admin
} else {
  add_filter( 'script_loader_src', 'ecclesio_remove_query_strings_2', 15, 1 );
  add_filter( 'style_loader_src', 'ecclesio_remove_query_strings_2', 15, 1 );
}

/**
 * Keeps bloat/un-used scripts and styles from plugins from loading on the front-end.
 */
function ecclesio_remove_scripts() {
  if (!is_admin()) {
    // CSS
    wp_dequeue_style('wpdm-font-awesome');
    wp_dequeue_style('wpdm-front');
    wp_dequeue_style('wpdm-bootstrap');
    wp_dequeue_style('bodhi-svgs-attachment');
    wp_dequeue_style('duplicate-post');
    // JS
    wp_dequeue_script( 'wpdm-bootstrap' );
    wp_dequeue_script( 'frontjs' );
    wp_dequeue_script( 'jquery-choosen' );
  }
}
add_action( 'wp_enqueue_scripts', 'ecclesio_remove_scripts', 1000); //1000 places these after the defaults loaded by the parent theme

/**
 * Keeps bloat/un-used scripts and styles from plugins from loading on the admin.
 */
function ecclesio_remove_scripts_admin() {
  
	//ACF - Don't load date/timepickers IF Church Theme Content has already loaded them. Fixes conflict issues.
	if ( wp_script_is( 'air-datepicker', 'enqueued' ) || wp_script_is( 'jquery-timepicker', 'enqueued' ) ) { //ct-meta-box.php
    wp_dequeue_script( 'jquery-ui-datepicker' ); //class-acf-field-date_picker.php
    wp_dequeue_script( 'acf-timepicker' ); //class-acf-field-date_time_picker.php
  }
  
}
add_action( 'admin_enqueue_scripts', 'ecclesio_remove_scripts_admin', 1000); //1000 places these after the defaults loaded by the parent theme

?>