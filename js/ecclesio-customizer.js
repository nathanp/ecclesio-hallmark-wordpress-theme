( function( $ ) {
    // Selective refresh on Church Info
    wp.customize( 'ecclesio_part_church_phone', function( value ) {
        value.bind( function( to ) {
            jQuery('.ecclesio-part-phone').html( to );
        } );
    } ); //wp.customize
    wp.customize( 'ecclesio_part_church_services_heading', function( value ) {
        value.bind( function( to ) {
            jQuery('.ecclesio-part-services-heading').html( to );
        } );
    } ); //wp.customize
    wp.customize( 'ecclesio_part_church_service_times', function( value ) {
        value.bind( function( to ) {
            jQuery('.ecclesio-part-service-times').html( to );
        } );
    } ); //wp.customize
    wp.customize( 'ecclesio_part_sermon_banner_heading', function( value ) {
        value.bind( function( to ) {
            jQuery('.post-type-archive-ctc_sermon #banner .banner-text .page-title').html( to );
        } );
    } ); //wp.customize
    wp.customize( 'ecclesio_part_sermon_banner_byline', function( value ) {
        value.bind( function( to ) {
            jQuery('.ecclesio-part-sermons-byline').html( to );
        } );
    } ); //wp.customize

    // function to convert hex to rgb
    function hexToRGB(hex, alpha) {
        var r = parseInt(hex.slice(1, 3), 16),
            g = parseInt(hex.slice(3, 5), 16),
            b = parseInt(hex.slice(5, 7), 16);
        if (alpha) {
            return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
        } else {
            return "rgb(" + r + ", " + g + ", " + b + ")";
        }
    }//hexToRGB

    // Selective refresh the site's main color
    wp.customize( 'ecclesio_color_main', function( value ) {
        value.bind( function( to ) {
            //Generate CSS
            var color_main_bg       = '#menu-main-menu-1 .submenu li a:hover, .footer-top, .off-canvas, button.hamburger .hamburger-inner, button.hamburger .hamburger-inner:after, button.hamburger .hamburger-inner:before, .pagination .current, .button { background-color:' +  to + '}';
            var color_main_txt      = 'a, #menu-main-menu-1 li.active>a, #menu-main-menu-1 li a:hover, #listing article .card .button:active, #listing article .card .button:focus, #listing article .card .button:hover, .button.outline-white:hover, .button.outline-white:active, .button.outline-white:focus, .tabs-sermon .tabs-title.is-active a { color:' +  to + '}';
            var color_main_border   = '.dropdown.menu.medium-horizontal>li.is-dropdown-submenu-parent>a:after {  border-color: ' + to + ' transparent transparent; }';
            //Put in the preview-only CSS
            $( '#ecclesio-customizer-preview' ).append( color_main_bg );
            $( '#ecclesio-customizer-preview' ).append( color_main_txt );
            $( '#ecclesio-customizer-preview' ).append( color_main_border );
        } );
    } );//wp.customize

    // Selective refresh the site's accent color
    wp.customize( 'ecclesio_color_accent', function( value ) {
        value.bind( function( to ) {
            //Generate CSS
            var color_accent_color    = 'a:focus, a:hover { color: ' + to + '; }';
            var color_accent_bg       = '.home #banner .button-group li a.button:hover, .home #banner .button-group li a.button:focus, .home #banner .button-group li a.button:active, #sermon-latest .text-container h5, #sermon-latest .text-container .button:hover, #sermon-latest .text-container .button:active, #sermon-latest .text-container .button:focus, button.hamburger:hover .hamburger-inner, button.hamburger:hover .hamburger-inner:after, button.hamburger:hover .hamburger-inner:before { background-color:' +  to + '}';
            var color_accent_border   = '#purpose, #sermon-latest .text-container .button {  border-color: ' + to + '; }';
            //Put in the preview-only CSS
            $( '#ecclesio-customizer-preview' ).append( color_accent_color );
            $( '#ecclesio-customizer-preview' ).append( color_accent_bg );
            $( '#ecclesio-customizer-preview' ).append( color_accent_border );
        } );
    } );//wp.customize

    // Selective refresh the site's banner color
    wp.customize( 'ecclesio_color_banner', function( value ) {
        value.bind( function( to ) {
            //Generate CSS
            var color_banner   = '#banner .overlay { background: ' + hexToRGB(to, 0.75) + '; }';
            //Put in the preview-only CSS
            $( '#ecclesio-customizer-preview' ).append( color_banner );
        } );
    } );//wp.customize

    // Selective refresh the site's footer color
    wp.customize( 'ecclesio_color_footer', function( value ) {
        value.bind( function( to ) {
            //Generate CSS
            var color_footer   = 'footer.footer { background: ' + to + '; }';
            //Put in the preview-only CSS
            $( '#ecclesio-customizer-preview' ).append( color_footer );
        } );
    } );//wp.customize
    
} )( jQuery );