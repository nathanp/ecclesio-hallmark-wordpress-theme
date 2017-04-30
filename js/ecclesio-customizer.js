( function( $ ) {
    wp.customize( 'ecclesio_part_church_phone', function( value ) {
        value.bind( function( to ) {
            jQuery('.ecclesio-part-phone').html( to );
        } );
    } );
    
} )( jQuery );