<?php
// Register menus
register_nav_menus(
	array(
		'main-nav' => __( 'The Main Menu', 'ecclesio' ),   // Main nav in header
		'footer-links' => __( 'Footer Links', 'ecclesio' ) // Secondary nav in footer
	)
);

// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu\">\n";
    }
}

// WP Bootstrap Navwalker
if ( ! file_exists( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' ) ) {
	// file does not exist... return an error.
	return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
	// file exists... require it.
    require_once( get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php' );
}


// The Top Desktop Menu
function ecclesio_top_nav() {
    wp_nav_menu(array(
        'theme_location'    => 'main-nav',        			            // Where it's located in the theme
        'container'         => false,
        'container_class'	=> 'collapse navbar-collapse',
        'container_id'		=> '',
        'menu_class'		=> 'nav',
        'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'             => 5,                                       // Limit the depth of the nav
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',      // Fallback function (see below)
        'walker'            => new WP_Bootstrap_Navwalker()
   ));
}

// The Off-Canvas Mobile Menu
function ecclesio_top_mobile_nav() {
    wp_nav_menu(array(
        'theme_location'    => 'main-nav',        			            // Where it's located in the theme
        'container'         => 'nav',
        'container_class'	=> 'navbar navbar-expand-lg',
	    'container_id'		=> '',
        'menu_class'		=> 'navbar-nav mr-auto',
        'items_wrap'        => '<div class="navbar-collapse"><ul id="%1$s" class="%2$s">%3$s</ul></div>',
        'depth'             => 5,                                       // Limit the depth of the nav
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',      // Fallback function (see below)
        'walker'            => new WP_Bootstrap_Navwalker()
   ));
}

class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"vertical menu\">\n";
    }
}

// The Footer Menu
function joints_footer_links() {
    wp_nav_menu(array(
    	'container' => 'false',                         // Remove nav container
    	'menu' => __( 'Footer Links', 'ecclesio' ),   	// Nav name
    	'menu_class' => 'menu',      					// Adding custom nav class
    	'theme_location' => 'footer-links',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
    	'fallback_cb' => ''  							// Fallback function
	));
} /* End Footer Menu */


// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );