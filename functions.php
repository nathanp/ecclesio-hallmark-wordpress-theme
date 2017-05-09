<?php

// Check for theme updates
require(get_stylesheet_directory().'/inc/theme_update_check.php');
$MyUpdateChecker = new ThemeUpdateChecker(
    'ecclesio-hallmark-theme',
    'https://kernl.us/api/v1/theme-updates/590352595c8dfe786f92b50d/'
);
// $MyUpdateChecker->purchaseCode = "somePurchaseCode";  <---- Optional!

/**
 * Include our Customizer settings.
**/
require get_stylesheet_directory() . '/inc/customizer/class-ecclesio-hallmark-customizer.php';
new Ecclesio_Hallmark_Customizer();

// Church Theme Content
require_once(get_stylesheet_directory().'/inc/church-theme-content.php');

// Church Theme Framework
require_once get_stylesheet_directory() . '/church-theme-framework/framework.php'; // do this before anything

// Sermon Archive - Order by Publish Date
add_action( 'pre_get_posts', 'sermons_change_sort_order'); 
function sermons_change_sort_order($query){
    if(is_post_type_archive( 'ctc_sermon' )):
       //Set the number of posts to display
       $query->set( 'posts_per_page', 9 );

       //Set the order ASC or DESC
       $query->set( 'order', 'DESC' );
       //Set the orderby
       $query->set( 'orderby', 'post_date' );
       

       $query->set( 'suppress_filters', true );
       
    endif;    
};

/**
 * Register Menus
 * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 
register_nav_menus(array(
    'primary-menu' => 'Primary', // registers the menu in the WordPress admin menu editor
    'secondary-menu' => 'Secondary',
    'footer-menu-primary' => 'Footer Primary',
    'footer-menu-secondary' => 'Footer Secondary'
));
*/

/**
 * Primary Menu
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu

if ( ! function_exists( 'themeium_nav_primary' ) ) {
	function themeium_nav_primary() {
	    wp_nav_menu(array( 
	        'container' => false,                           // remove nav container
	        'container_class' => '',                        // class of container
	        'menu' => '',                                   // menu name
	        'menu_class' => 'menu',            // adding custom nav class
	        'theme_location' => 'primary-menu',             // where it's located in the theme
	        'before' => '',                                 // before each link <a> 
	        'after' => '',                                  // after each link </a>
	        'link_before' => '',                            // before each link text
	        'link_after' => '',                             // after each link text
	        'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="drilldown medium-dropdown">%3$s</ul>',
	        'depth' => 5,                                   // limit the depth of the nav
	        'fallback_cb' => false,                         // fallback function (see below)
	    ));
	}
}
 */

/* The Top Menu
 * Added data-close-on-click-inside to fix touch-screen dropdown issue
 * See http://foundation.zurb.com/forum/posts/49787-problem-with-dropdown-menu-on-ipad
 */
function ecclesio_top_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical medium-horizontal menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
        'theme_location' => 'main-nav',        			// Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Topbar_Menu_Walker()
    ));
} 

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


/* Google Fonts for the Customizer
 * For now, rely on Ultimate Fonts plugin - https://wordpress.org/plugins/ultimate-fonts
 * See https://wpultimatefonts.com/docs/integrate-ultimatefonts-into-your-wordpress-theme/
 */
add_action( 'after_setup_theme', 'ecclesio_ultimatefonts_setup' );
function ecclesio_ultimatefonts_setup() {
    add_theme_support( 'ultimate-fonts', array(
        'no_settings'      => false, // Disable the plugin settings page
        'default_elements' => array(
            array(
                'label'    => esc_html__( 'Heading/Button Font', 'ecclesio' ),
                'selector' => 'h1, h2, h3, h4, h5, h6, button, .button, #menu-main-menu-1 li, #menu-main-menu.vertical, #breadcrumbs,#sermon-latest .text-container .meta,.tabs-sermon .tabs-title,.tabs-sermon .link-title,#listing article .thumb .overlay,.event-meta,.footer-top'
            ),
            array(
                'label'    => esc_html__( 'Body Font', 'ecclesio' ),
                'selector' => 'body,p,#purpose, #purpose .statement,#staff li h4'
            ),
        ),
    ) );
}

/**
 * Enqueues scripts and styles.
 */
function ecclesio_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'ecclesio-fonts', ecclesio_google_fonts_url(), array(), null );

	// Primary CSS
	wp_enqueue_style( 'ecclesio-primary', get_stylesheet_directory_uri() . '/style.css', array(), '1.0' );
	// Responsive
	wp_enqueue_style( 'ecclesio-responsive', get_stylesheet_directory_uri() . '/css/responsive.css', array(), '1.0' );
	// Hamburgers Navigation
	wp_enqueue_style( 'ecclesio-hamburgers', get_stylesheet_directory_uri() . '/css/hamburgers.min.css', array(), '1.0' );
	// Font Awesome
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

	// Live preview CSS changes
	wp_add_inline_style( 'ecclesio-responsive', ecclesio_customizer_css() ); //class-ecclesio-hallmark-customizer.php

	// Hallmark - Custom JS
	wp_enqueue_script( 'ecclesio-app-js', get_stylesheet_directory_uri() . '/js/ecclesio.js', array( 'jquery' ), '6.0', true );

}
add_action( 'wp_enqueue_scripts', 'ecclesio_scripts', 1000); //1000 places these after the defaults loaded by the parent theme

function ecclesio_customizer_preview() {
    wp_enqueue_script( 
          'ecclesio-customizer',
          get_stylesheet_directory_uri().'/js/ecclesio-customizer.js',
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

/**
 * GET THUMBNAIL FROM VIMEO
 * Retrieves the thumbnail from a youtube or vimeo video
 * @param - $src: the url of the "player"
 * @return - string
 * @todo - do some real world testing. 
 * 
**/
function get_video_thumbnail( $src, $res = null ) {

	$url_pieces = explode('/', $src);
	
	if ( $url_pieces[2] == 'vimeo.com' ) { // If Vimeo
		$res = (string) $res; //argument for resolution
		$id = (int) substr(parse_url($src, PHP_URL_PATH), 1);
		$hash = unserialize(file_get_contents('https://vimeo.com/api/v2/video/' . $id . '.php'));

		if(get_transient('vimeo_' . $res . '_' . $id)) { // If thumbnail has already been cached, get that
			$thumbnail = get_transient('vimeo_' . $res . '_' . $id);
		}
		else { // If no thumbnail has been cached
			if ( '' !== $res ) { //if $res is set, e.g. get_video_thumbnail($sermon_video_url, 'hd')
				$hash = (explode("_640",$hash[0]['thumbnail_large']));
				$thumbnail = $hash[0];
			}
			else {
				$thumbnail = $hash[0]['thumbnail_large']; //default to 640px width
			}
			set_transient('vimeo_' . $res . '_' . $id, $thumbnail, 2629743);
		}

	} elseif ( $url_pieces[2] == 'www.youtube.com' ) { // If Youtube

		preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $src, $matches);
    	$id = $matches[1];
		$thumbnail = 'https://img.youtube.com/vi/' . $id . '/mqdefault.jpg';

	}

	return $thumbnail;

}

?>