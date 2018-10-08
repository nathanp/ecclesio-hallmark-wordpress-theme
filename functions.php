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
require_once(get_template_directory().'/inc/theme-support.php'); 

/**
 * Include our Customizer settings.
**/
require get_template_directory() . '/inc/customizer/class-ecclesio-hallmark-customizer.php';
new Ecclesio_Hallmark_Customizer();

// WP Head and other cleanup functions
require_once(get_template_directory().'/inc/cleanup.php');

// Advanced Custom Fields
require_once(get_template_directory().'/inc/acf.php');

// Register custom menus and menu walkers
require_once(get_template_directory().'/inc/menu.php');
/**
 * Register Menus
 * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 */

/* Google Fonts for the Customizer
 * For now, rely on Ultimate Fonts plugin - https://wordpress.org/plugins/ultimate-fonts
 * See https://wpultimatefonts.com/docs/integration/
 */
add_action( 'after_setup_theme', 'ecclesio_ultimatefonts_setup' );
function ecclesio_ultimatefonts_setup() {
    add_theme_support( 'ultimate-fonts', array(
        'no_settings'      => true, // Disable the plugin settings page
        'default_elements' => array(
            array(
                'label'    => esc_html__( 'Heading Font', 'ecclesio' ),
                'selector' => 'h1,h2,h3,h4,h5,h6,button,.button,.btn,#menu-main-menu-1 li,#menu-main-menu,#breadcrumbs,.tabs-sermon .tabs-title,.tabs-sermon .link-title,.beautiful-taxonomy-filters label,#listing article .thumb .overlay,.thumbnail .overlay,.event-meta,.timeline-item:before,.footer-top,.gform_wrapper label.gfield_label',
            ),
            array(
                'label'    => esc_html__( 'Body Font', 'ecclesio' ),
                'selector' => 'body,p,#purpose, #purpose .statement,#staff li h4',
            ),
        ),
    ) );
}

// Register scripts and stylesheets
require_once(get_template_directory().'/inc/enqueue-scripts.php'); 

// Sermon Functions
require_once(get_template_directory().'/inc/sermons.php'); 

// Register sidebars/widget areas
require_once(get_template_directory().'/inc/sidebar.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/inc/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/inc/page-navi.php'); 

// Adds support for multiple languages
//require_once(get_template_directory().'/assets/translation/translation.php'); 

// Remove 4.2 Emoji Support
// require_once(get_template_directory().'/inc/disable-emoji.php'); 

// Adds site styles to the WordPress editor
//require_once(get_template_directory().'/inc/editor-styles.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/inc/related-posts.php'); 

?>