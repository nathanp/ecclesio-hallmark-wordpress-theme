<div id="banner">

	<span class="overlay"></span>

	<?php
		if( function_exists('get_field') && get_field('header_image') != '' ) {
			$banner_img_src = get_field('header_image');
		}
		elseif ( get_header_image() ) {
			$banner_img_src = get_header_image();
		}       
		else {
			$banner_img_src = get_stylesheet_directory_uri().'/images/demo_banner.jpg';
		}
		echo "<img class='banner-bg' src='$banner_img_src' alt=''>";	
	?>
	<div class="banner-text">
		<?php
			if ( is_404() ) {
				$banner_heading = "Whoops! That page isn't here.";
				$banner_byline = "(Error 404)";
			}
			elseif ( is_search() ) {
				$banner_heading = "Search Results";
				$banner_byline = '"'.get_search_query().'"';
			}
			elseif( function_exists('get_field') ) {
				if(get_field('header_primary_text')) {
					$banner_heading = get_field('header_primary_text');	
				} else { $banner_heading = get_the_title(); }
				if(get_field('header_byline')) {
					$banner_byline = get_field('header_byline');
				} else { $banner_byline = ''; }
			}
			else {
				$banner_heading = get_the_title();
				$banner_byline = get_field('header_byline');
			}
			
			if($banner_heading) {
				echo "<h1 class='page-title'>$banner_heading</h1>";	
			}
			if($banner_byline) {
				echo "<h3 class='page-byline'>$banner_byline</h3>";	
			}

			if( have_rows('header_buttons') ):
		    	echo '<div class="btn-group" role="group">';
		    	while( have_rows('header_buttons') ): the_row();
		    		$link = get_sub_field('button_link');
		    		$text = get_sub_field('button_text');
		    		$new_window = get_sub_field('open_in_new_window');
		    			if($new_window) {
		    				$target = 'target="_blank"';
		    			} else {
		    				$target = '';
		    			}

		    		echo '<a class="btn btn-outline-light" href="'.$link.'" target="'.$target.'">'.$text.'</a>';
			    endwhile;
			    echo '</div>';
			endif;
		?>
	</div><!-- .banner-text -->

	<?php
		if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
	?>

</div><!-- #banner -->