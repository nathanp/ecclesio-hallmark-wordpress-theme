<?php
	
	/*
	 * Ecclesio Custom User Roles
	 */

	//Remove default roles
	if( get_role('subscriber') ){
	      remove_role( 'subscriber' );
	}
	if( get_role('editor') ){
	      remove_role( 'editor' );
	}
	if( get_role('contributor') ){
	      remove_role( 'contributor' );
	}
	if( get_role('author') ){
	      remove_role( 'author' );
	}


	add_role( 
	  'ecclesio_staff', 
	  __( 'Church Staff', 'ecclesio' ), 
	  array(
		'activate_plugins' => false,
		'copy_posts' => true,
		'create_pages' => true,
		'create_posts' => true,
		'create_users' => false,
		'delete_others_pages' => true,
		'delete_others_posts' => true,
		'delete_pages' => true,
		'delete_plugins' => false,
		'delete_posts' => true,
		'delete_private_pages' => true,
		'delete_private_posts' => true,
		'delete_published_pages' => true,
		'delete_published_posts' => true,
		'delete_themes' => false,
		'delete_users' => true,
		'edit_dashboard' => false,
		'edit_others_pages' => true,
		'edit_others_posts' => true,
		'edit_pages' => true,
		'edit_plugins' => false,
		'edit_posts' => true,
		'edit_private_pages' => true,
		'edit_private_posts' => true,
		'edit_published_pages' => true,
		'edit_published_posts' => true,
		'edit_theme_options' => true,
		'edit_themes' => true,
		'edit_users' => true,
		'export' => false,
		'gravityforms_api' => false,
		'gravityforms_api_settings' => false,
		'gravityforms_create_form' => true,
		'gravityforms_delete_entries' => true,
		'gravityforms_delete_forms' => true,
		'gravityforms_edit_entries' => true,
		'gravityforms_edit_entry_notes' => true,
		'gravityforms_edit_forms' => true,
		'gravityforms_edit_settings' => true,
		'gravityforms_export_entries' => true,
		'gravityforms_preview_forms' => true,
		'gravityforms_uninstall' => false,
		'gravityforms_view_addons' => false,
		'gravityforms_view_entries' => true,
		'gravityforms_view_entry_notes' => true,
		'gravityforms_view_settings' => true,
		'gravityforms_view_updates' => true,
		'import' => true,
		'install_plugins' => false,
		'install_themes' => false,
		'list_users' => true,
		'manage_categories' => true,
		'manage_links' => true,
		'manage_options' => true,
		'moderate_comments' => true,
		'promote_users' => true,
		'publish_pages' => true,
		'publish_posts' => true,
		'read' => true,
		'read_private_pages' => true,
		'read_private_posts' => true,
		'remove_users' => true,
		'switch_themes' => false,
		'unfiltered_html' => true,
		'unfiltered_upload' => true,
		'update_core' => false,
		'update_plugins' => false,
		'update_themes' => false,
		'upload_files' => true,
		'ure_create_capabilities' => false,
		'ure_create_roles' => false,
		'ure_delete_capabilities' => false,
		'ure_delete_roles' => false,
		'ure_edit_roles' => false,
		'ure_manage_options' => false,
		'ure_reset_roles' => false,
		'wpseo_bulk_edit' => true
	));

	add_role( 
	  'ecclesio_admin', 
	  __( 'Church Admin', 'ecclesio' ), 
	  array(
		'activate_plugins' => true,
		'copy_posts' => true,
		'create_pages' => true,
		'create_posts' => true,
		'create_users' => true,
		'delete_others_pages' => true,
		'delete_others_posts' => true,
		'delete_pages' => true,
		'delete_plugins' => false,
		'delete_posts' => true,
		'delete_private_pages' => true,
		'delete_private_posts' => true,
		'delete_published_pages' => true,
		'delete_published_posts' => true,
		'delete_themes' => false,
		'delete_users' => true,
		'edit_dashboard' => false,
		'edit_others_pages' => true,
		'edit_others_posts' => true,
		'edit_pages' => true,
		'edit_plugins' => false,
		'edit_posts' => true,
		'edit_private_pages' => true,
		'edit_private_posts' => true,
		'edit_published_pages' => true,
		'edit_published_posts' => true,
		'edit_theme_options' => true,
		'edit_themes' => true,
		'edit_users' => true,
		'export' => true,
		'gravityforms_api' => false,
		'gravityforms_api_settings' => false,
		'gravityforms_create_form' => true,
		'gravityforms_delete_entries' => true,
		'gravityforms_delete_forms' => true,
		'gravityforms_edit_entries' => true,
		'gravityforms_edit_entry_notes' => true,
		'gravityforms_edit_forms' => true,
		'gravityforms_edit_settings' => true,
		'gravityforms_export_entries' => true,
		'gravityforms_preview_forms' => true,
		'gravityforms_uninstall' => false,
		'gravityforms_view_addons' => false,
		'gravityforms_view_entries' => true,
		'gravityforms_view_entry_notes' => true,
		'gravityforms_view_settings' => true,
		'gravityforms_view_updates' => true,
		'import' => true,
		'install_plugins' => false,
		'install_themes' => false,
		'list_users' => true,
		'manage_categories' => true,
		'manage_links' => true,
		'manage_options' => true,
		'moderate_comments' => true,
		'promote_users' => true,
		'publish_pages' => true,
		'publish_posts' => true,
		'read' => true,
		'read_private_pages' => true,
		'read_private_posts' => true,
		'remove_users' => true,
		'switch_themes' => true,
		'unfiltered_html' => true,
		'unfiltered_upload' => true,
		'update_core' => false,
		'update_plugins' => true,
		'update_themes' => true,
		'upload_files' => true,
		'ure_create_capabilities' => false,
		'ure_create_roles' => false,
		'ure_delete_capabilities' => false,
		'ure_delete_roles' => false,
		'ure_edit_roles' => false,
		'ure_manage_options' => false,
		'ure_reset_roles' => false,
		'wpseo_bulk_edit' => true
	));

	$user = wp_get_current_user();
	$allowed_roles = array('administrator'); //array('editor', 'administrator', 'author')
	if( array_intersect($allowed_roles, $user->roles ) ) {
	   
		//For development - get node IDs for items in the Toolbar
		/*
		// use 'wp_before_admin_bar_render' hook to also get nodes produced by plugins.
		function add_all_node_ids_to_toolbar() {
			global $wp_admin_bar;
			$all_toolbar_nodes = $wp_admin_bar->get_nodes();

			if ( $all_toolbar_nodes ) {
				// add a top-level Toolbar item called "Node Id's" to the Toolbar
				$args = array(
					'id'    => 'node_ids',
					'title' => 'Node ID\'s'
				);
				$wp_admin_bar->add_node( $args );
				// add all current parent node id's to the top-level node.
				foreach ( $all_toolbar_nodes as $node  ) {
					if ( isset($node->parent) && $node->parent ) {
						$args = array(
							'id'     => 'node_id_'.$node->id, // prefix id with "node_id_" to make it a unique id
							'title'  => $node->id,
							'parent' => 'node_ids'
							// 'href' => $node->href,
						);
						// add parent node to node "node_ids"
						$wp_admin_bar->add_node($args);
					}
				}
				// add all current Toolbar items to their parent node or to the top-level node
				foreach ( $all_toolbar_nodes as $node ) {
					$args = array(
						'id'      => 'node_id_'.$node->id, // prefix id with "node_id_" to make it a unique id
						'title'   => $node->id,
						// 'href' => $node->href,
					);
					if ( isset($node->parent) && $node->parent ) {
						$args['parent'] = 'node_id_'.$node->parent;
					} else {
						$args['parent'] = 'node_ids';
					}
					$wp_admin_bar->add_node($args);
				}//foreach
			}//if
		}//add_all_node_ids_to_toolbar
		add_action( 'wp_before_admin_bar_render', 'add_all_node_ids_to_toolbar' );
		*/
	}
	if( in_array( 'ecclesio_staff', $user->roles ) ) {

		//Remove Sidebar Menu Items
		function ecclesio_staff_remove_menus(){
  
		  	//remove_menu_page( 'index.php' );                  		//Dashboard
				remove_submenu_page( 'index.php', 'relevanssi/relevanssi.php' ); //Relevanssi
			remove_menu_page( 'jetpack' );                  			//Jetpack* 
			//remove_menu_page( 'edit.php' );                  			//Posts
			//remove_menu_page( 'upload.php' );                 		//Media
			//remove_menu_page( 'edit.php?post_type=page' );    		//Pages
			remove_menu_page( 'edit-comments.php' );          			//Comments
			remove_menu_page( 'themes.php' );                 			//Appearance
				//remove_submenu_page( 'themes.php', 'widgets.php' );    		//Widgets
				remove_submenu_page( 'themes.php', 'themes.php' );    		//Widgets
				remove_submenu_page( 'themes.php', 'customize.php' );    		//Widgets
				remove_submenu_page( 'themes.php', 'theme-editor.php' );    		//Widgets
			//remove_menu_page( 'plugins.php' );                			//Plugins
			remove_menu_page( 'users.php' );                  		//Users
			remove_menu_page( 'tools.php' );                  			//Tools
			remove_menu_page( 'options-general.php' );        			//Settings
				/*
				remove_submenu_page( 'options-general.php', 'church-theme-content' ); //Settings
				remove_submenu_page( 'options-general.php', 'duplicatepost' ); //Settings
				remove_submenu_page( 'options-general.php', 'google-analytics' ); //Settings
				remove_submenu_page( 'options-general.php', 'hicpo-settings' ); //Settings
				remove_submenu_page( 'options-general.php', 'relevanssi/relevanssi.php' ); //Settings
				remove_submenu_page( 'options-general.php', 'svg-support' ); //Settings
				remove_submenu_page( 'options-general.php', 'github-updater' ); //Settings
				remove_submenu_page( 'options-general.php', 'options-permalink.php' ); //Settings
				remove_submenu_page( 'options-general.php', 'options-discussion.php' ); //Settings
				*/
			//remove_menu_page( 'edit.php?post_type=ctc_location' );    	//Locations

			remove_submenu_page( 'upload.php', 'wp-smush-bulk' ); //Settings

			remove_menu_page( 'wpseo_dashboard' ); 
			remove_menu_page( 'wphb' ); 
			remove_menu_page( 'site-migration-export' ); 
			remove_menu_page( 'edit.php?post_type=acf-field-group' ); 
		  
		}
		add_action( 'admin_init', 'ecclesio_staff_remove_menus' );

		//Remove Dashboard boxes
		function ecclesio_remove_dashboard_widgets() {
			global $wp_meta_boxes;

			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

			remove_action('welcome_panel', 'wp_welcome_panel');

			remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_activity', 'dashboard', 'advanced' );

			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' ); //Yoast
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' ); //Yoast
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'advanced' ); //Yoast

		}
		add_action('wp_dashboard_setup', 'ecclesio_remove_dashboard_widgets' );
	} //eccelsio_staff

	if( in_array( 'ecclesio_admin', $user->roles ) ) {

		//Remove Sidebar Menu Items
		function ecclesio_church_admin_remove_menus(){
  
		  	//remove_menu_page( 'index.php' );                  		//Dashboard
				remove_submenu_page( 'index.php', 'update-core.php' ); //Relevanssi
			remove_menu_page( 'jetpack' );                  			//Jetpack* 
			remove_menu_page( 'edit-comments.php' );          			//Comments
				remove_submenu_page( 'themes.php', 'theme-editor.php' );    		//Widgets

				remove_submenu_page( 'tools.php', 'tools' );
				remove_submenu_page( 'tools.php', 'wp-sync-db' );

			remove_menu_page( 'plugins.php' );                			//Plugins

			remove_menu_page( 'options-general.php' );        			//Settings
				/*
				remove_submenu_page( 'options-general.php', 'church-theme-content' ); //Settings
				remove_submenu_page( 'options-general.php', 'duplicatepost' ); //Settings
				remove_submenu_page( 'options-general.php', 'google-analytics' ); //Settings
				remove_submenu_page( 'options-general.php', 'hicpo-settings' ); //Settings
				remove_submenu_page( 'options-general.php', 'relevanssi/relevanssi.php' ); //Settings
				remove_submenu_page( 'options-general.php', 'svg-support' ); //Settings
				remove_submenu_page( 'options-general.php', 'github-updater' ); //Settings
				remove_submenu_page( 'options-general.php', 'options-permalink.php' ); //Settings
				remove_submenu_page( 'options-general.php', 'options-discussion.php' ); //Settings
				*/
			//remove_menu_page( 'edit.php?post_type=ctc_location' );    	//Locations

			remove_submenu_page( 'upload.php', 'wp-smush-bulk' ); //Settings

			remove_menu_page( 'wpseo_dashboard' ); 
			remove_menu_page( 'wphb' ); 
			remove_menu_page( 'site-migration-export' ); 
			remove_menu_page( 'edit.php?post_type=acf-field-group' ); 
		  
		}
		add_action( 'admin_init', 'ecclesio_church_admin_remove_menus' );

		//Remove Dashboard boxes
		function ecclesio_remove_dashboard_widgets() {
			global $wp_meta_boxes;

			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
			
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

			remove_action('welcome_panel', 'wp_welcome_panel');

			remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
			remove_meta_box( 'dashboard_activity', 'dashboard', 'advanced' );

			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' ); //Yoast
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' ); //Yoast
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'advanced' ); //Yoast

		}
		add_action('wp_dashboard_setup', 'ecclesio_remove_dashboard_widgets' );
	} //eccelsio_staff

//Remove Nodes from Toolbar
function ecclesio_remove_toolbar_nodes( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );		//WP Logo
	$wp_admin_bar->remove_node( 'updates' );		//Updates
	$wp_admin_bar->remove_node( 'comments' );		//Comments
	$wp_admin_bar->remove_node( 'wpseo-menu' );		//Yoast
}
add_action( 'admin_bar_menu', 'ecclesio_remove_toolbar_nodes', 999 );

//Edit the footer text
function wpse_edit_footer() {
    add_filter( 'admin_footer_text', 'wpse_edit_text', 11 );
}

function wpse_edit_text($content) {
    return "Church Websites by <a href='https://eccles.io' target='_blank'>Eccles.io</a>.";
}

add_action( 'admin_init', 'wpse_edit_footer' );

// Hide Admin user from everyone except the admin
add_action('pre_user_query','ecclesio_pre_user_query');
function ecclesio_pre_user_query($user_search) {
  $user = wp_get_current_user();
  if ($user->ID!=1) { // Is not administrator, remove administrator
    global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.ID<>1",$user_search->query_where);
  }
}

/**
 * DELETE THE OEMBED CACHE FOR SERMONS
 *
 * Sometimes, when you create a sermon post before Vimeo has fully processed,
 * the automatic oembed of the video will not work,
 * and it will only display the Vimeo URL instead of the embed.
 * This function helps prevent that,
 * by automatically deleting the oembed cache from the ctc_sermon CPT every time the post is saved.
 * Special thanks to the oEmbed-cache plugin from 61 Degrees North for the inspiration.
 */	
add_action( 'save_post_ctc_sermon', 'ecclesio_sermon_save' );
function ecclesio_sermon_save() {

    global $wpdb;
    $results = array("status" => "success");
    $post_id = get_the_ID();

    if( $post_id ){
        $delres = $wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key LIKE '%_oembed_%' AND post_id = ".$post_id);
        //echo json_encode($results);
        //die();
    }
}

?>