<?php
	// Sermon Archive - Order by Publish Date
	add_action( 'pre_get_posts', 'sermons_change_sort_order');
	function sermons_change_sort_order($query){
	    if( ! is_admin() && is_post_type_archive( 'ctc_sermon' ) || is_tax(array('ctc_sermon_book','ctc_sermon_series','ctc_sermon_speaker','ctc_sermon_topic')) ):
	       //Set the number of posts to display
	       $query->set( 'posts_per_page', 9 );

		   //Set the order of Sermon Series pages to go from oldest to newest
		   if($query->is_tax( 'ctc_sermon_series' )) {
				$query->set( 'order', 'ASC' );
		   }
		   //Other sermon archive pages to go from newest to oldest
		   else {
				$query->set( 'order', 'DESC' );
		   }

	       //Set the orderby
	       $query->set( 'orderby', 'post_date' );


	       $query->set( 'suppress_filters', true );

	    endif;
	};

	/**
	 * STRIP HTTP and HTTPS
	 * Including this specifically for the below Vimeo thumbnail code
	 * Returns a protocol agnostic URL
	 */
	function remove_http($url) {
	   $disallowed = array('http:', 'https:');
	   foreach($disallowed as $d) {
	      if(strpos($url, $d) === 0) {
	         return str_replace($d, '', $url);
	      }
	   }
	   return $url;
	}

	/**
	 * GET THUMBNAIL FROM VIMEO/YOUTUBE
	 * Retrieves the thumbnail from a youtube or vimeo video
	 * @param - $src: the url of the "player"
	 * @return - string
	 * @todo - do some real world testing.
	 *
	**/
	function get_video_thumbnail( $src, $res = null ) {
		$url_pieces = explode('/', $src);

		//If a Vimeo URL - https://stackoverflow.com/questions/10488943/easy-way-to-get-vimeo-id-from-a-vimeo-url
		if(preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $src, $output_array)) {
			$res = (string) $res; //argument for resolution
			$id = $output_array[5];
			$request = wp_remote_get('https://vimeo.com/api/v2/video/' . $id . '.json');
			$body = wp_remote_retrieve_body( $request );
			$hash = json_decode( $body, true); //use the true parameter to return as array instead of an object
			//print_r($hash);
			if(get_transient('vimeo_' . $res . '_' . $id)) { // If thumbnail has already been cached, get that
				$thumbnail = remove_http(get_transient('vimeo_' . $res . '_' . $id));
			}
			else { // If no thumbnail has been cached
				if ( '' !== $res ) { //if $res is set, e.g. get_video_thumbnail($sermon_video_url, 'hd')
					$hash = (explode("_640",$hash[0]['thumbnail_large']));
					$thumbnail = remove_http($hash[0]);
				}
				else {
					$thumbnail = remove_http($hash[0]['thumbnail_large']); //default to 640px width
				}
				set_transient('vimeo_' . $res . '_' . $id, $thumbnail, 2629743);
			}

		} elseif ( $url_pieces[2] == 'www.youtube.com' ) { // If Youtube
			preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $src, $matches);
	    	$id = $matches[1];
			$thumbnail = 'https://img.youtube.com/vi/' . $id . '/mqdefault.jpg';
		} elseif ( $url_pieces[2] == 'www.facebook.com' ) { // If Facebook
			preg_match("~/videos/(?:t\.\d+/)?(\d+)~i", $src, $matches);
	    	$id = $matches[1];
			//$thumbnail = 'https://img.youtube.com/vi/' . $id . '/mqdefault.jpg';
		}
		return $thumbnail;
	}

	/**
	 * ENABLE AUTOMATIC EMBEDS FROM SERMON AUDIO
	 * Thanks to - https://github.com/CarlosRios/sermonaudio-embed
	 * Just paste the URL to the page from sermonaudio. E.g. http://www.sermonaudio.com/sermoninfo.asp?SID=51016846565
	**/
	// Get things going
	add_action( 'init', function(){
		wp_embed_register_handler(
			'sermonaudio',
			'#http://(www\.)?sermonaudio\.com/sermoninfo.asp\?SID=([\d]+)#',
			'wp_register_sermonaudio_embed',
			true
		);
		wp_embed_register_handler(
			'sermonaudio_2',
			'#http://(www\.)?sermonaudio\.com/sermoninfo.asp\?m=t&s=([\d]+)#',
			'wp_register_sermonaudio_embed',
			true
		);
	});
	// Provide WordPress with the embed code
	if( !function_exists( 'wp_register_sermonaudio_embed' ) ) {
		function wp_register_sermonaudio_embed( $matches, $attr, $url, $rawattr )
		{
			$embed = sprintf(
				'<iframe style="min-width:250px;" width="100%%" height="150" frameborder="0" src="http://www.sermonaudio.com/saplayer/player_embed.asp?SID=%1$s"></iframe>',
				esc_attr( $matches[2] )
			);
			return apply_filters( 'wp_embed_sermonaudio', $embed, $matches, $attr, $url, $rawattr );
		}
	}

	/**
	 * ENABLE AUTOMATIC EMBEDS FROM SOUNDCLOUD
	 * Thanks to - http://www.wpbeginner.com/wp-tutorials/how-to-embed-soundcloud-in-your-wordpress-posts-by-using-oembed/
	**/
	// Add SoundCloud oEmbed
	function add_oembed_soundcloud(){
	wp_oembed_add_provider( 'http://soundcloud.com/*', 'http://soundcloud.com/oembed' );
	}
	add_action('init','add_oembed_soundcloud');
?>