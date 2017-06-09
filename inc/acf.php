<?php 
	// ACF - Remove default WP meta box - https://www.advancedcustomfields.com/blog/acf-pro-5-5-13-update/
	add_filter('acf/settings/remove_wp_meta_box', '__return_true');

	// ACF - Local JSON - https://www.advancedcustomfields.com/resources/local-json/
	add_filter('acf/settings/save_json', 'ecclesio_acf_json_save_point');
	function ecclesio_acf_json_save_point( $path ) {
	    // update path
	    $path = get_stylesheet_directory() . '/inc/acf-json';
	    // return
	    return $path;
	}
	add_filter('acf/settings/load_json', 'ecclesio_acf_json_load_point');
	function ecclesio_acf_json_load_point( $paths ) {
	    // remove original path (optional)
	    unset($paths[0]);
	    // append path
	    $paths[] = get_stylesheet_directory() . '/inc/acf-json';
	    // return
	    return $paths;
	}

	// ACF - Automate the Sync JSON process
	add_action( 'admin_init', 'ecclesio_sync_acf_fields' );
	function ecclesio_sync_acf_fields() {
	    // vars
	    $groups = acf_get_field_groups();
	    $sync   = array();
	    // bail early if no field groups
	    if( empty( $groups ) )
	        return;
	    // find JSON field groups which have not yet been imported
	    foreach( $groups as $group ) {
	        // vars
	        $local      = acf_maybe_get( $group, 'local', false );
	        $modified   = acf_maybe_get( $group, 'modified', 0 );
	        $private    = acf_maybe_get( $group, 'private', false );
	        // ignore DB / PHP / private field groups
	        if( $local !== 'json' || $private ) {
	            // do nothing
	        } elseif( ! $group[ 'ID' ] ) {
	            $sync[ $group[ 'key' ] ] = $group;
	        } elseif( $modified && $modified > get_post_modified_time( 'U', true, $group[ 'ID' ], true ) ) {
	            $sync[ $group[ 'key' ] ]  = $group;
	        }
	    }//foreach
	    // bail if no sync needed
	    if( empty( $sync ) )
	        return;
	    if( ! empty( $sync ) ) { //if( ! empty( $keys ) ) {
	        // vars
	        $new_ids = array();
	        foreach( $sync as $key => $v ) { //foreach( $keys as $key ) {
	            // append fields
	            if( acf_have_local_fields( $key ) ) {
	                $sync[ $key ][ 'fields' ] = acf_get_local_fields( $key );
	            }
	            // import
	            $field_group = acf_import_field_group( $sync[ $key ] );
	        }//foreach
	    }//if
	}//ecclesio_sync_acf_fields
?>