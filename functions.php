<?php

// Check for theme updates
require(get_template_directory().'/inc/theme_update_check.php');
$MyUpdateChecker = new ThemeUpdateChecker(
    'ecclesio-hallmark-theme',
    'https://kernl.us/api/v1/theme-updates/590352595c8dfe786f92b50d/'
);
// $MyUpdateChecker->purchaseCode = "somePurchaseCode";  <---- Optional!

// Church Theme Framework
require_once (get_template_directory() . '/church-theme-framework/framework.php'); // do this before anything

// Church Theme Content
require_once(get_template_directory().'/inc/church-theme-content.php');

// Theme support options
require_once(get_template_directory().'/assets/functions/theme-support.php'); 

/**
 * Include our Customizer settings.
**/
require get_template_directory() . '/inc/customizer/class-ecclesio-hallmark-customizer.php';
new Ecclesio_Hallmark_Customizer();

// WP Head and other cleanup functions
require_once(get_template_directory().'/assets/functions/cleanup.php');

// Advanced Custom Fields
require_once(get_template_directory().'/inc/acf.php');


// Register custom menus and menu walkers
require_once(get_template_directory().'/assets/functions/menu.php');
/**
 * Register Menus
 * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 

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
                'label'    => esc_html__( 'Heading Font', 'ecclesio' ),
                'selector' => 'h1, h2, h3, h4, h5, h6, button, .button, #menu-main-menu-1 li, #menu-main-menu.vertical, #breadcrumbs,#sermon-latest .text-container .meta,.tabs-sermon .tabs-title,.tabs-sermon .link-title,#listing article .thumb .overlay,.event-meta,.footer-top'
            ),
            array(
                'label'    => esc_html__( 'Body Font', 'ecclesio' ),
                'selector' => 'body,p,#purpose, #purpose .statement,#staff li h4'
            ),
        ),
    ) );
}

// Register scripts and stylesheets
require_once(get_template_directory().'/assets/functions/enqueue-scripts.php'); 

// Sermon Functions
require_once(get_template_directory().'/inc/sermons.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/assets/functions/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/assets/functions/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/assets/functions/page-navi.php'); 

// Adds support for multiple languages
//require_once(get_template_directory().'/assets/translation/translation.php'); 

// Remove 4.2 Emoji Support
// require_once(get_template_directory().'/assets/functions/disable-emoji.php'); 

// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/assets/functions/editor-styles.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/assets/functions/related-posts.php'); 

?>