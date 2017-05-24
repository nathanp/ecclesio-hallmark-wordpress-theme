<div id="banner">
	<span class="overlay"></span>
	<?php
		if( function_exists('get_field')) {
			$banner_img_src = get_field('header_image');
		}
		else {
			$banner_img_src = get_stylesheet_directory_uri().'/images/ft-worth.jpg';
		}
		echo "<img src='$banner_img_src' alt=''>";	
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
			elseif( function_exists('get_field') && ( (get_field('header_primary_text') || get_field('header_byline')) != "" ) ) {
				$banner_heading = get_field('header_primary_text');
				$banner_byline = get_field('header_byline');
			}
			else {
				$banner_heading = get_the_title();
				$banner_byline = '';
			}
			

			if($banner_heading) {
				echo "<h1 class='page-title'>$banner_heading</h1>";	
			}
			if($banner_byline) {
				echo "<h3 class='page-byline'>$banner_byline</h3>";	
			}
			if(is_front_page()) {
				echo "
					<ul class='button-group'>
					  <li><a href='/first-visit/' class='button'>I'm New</a></li>
					  <li><a href='https://www.google.com/maps/dir//4201+W+Risinger+Rd,+Fort+Worth,+TX+76123/@32.6161951,-97.3866526,17z/data=!4m16!1m7!3m6!1s0x864e6c5d2fe4b0ef:0xb8443c54d1a3ca47!2s4201+W+Risinger+Rd,+Fort+Worth,+TX+76123!3b1!8m2!3d32.6161951!4d-97.3844586!4m7!1m0!1m5!1m1!1s0x864e6c5d2fe4b0ef:0xb8443c54d1a3ca47!2m2!1d-97.3844586!2d32.6161951' class='button' target='_blank'>Directions</a></li>
					</ul>
				";
			}
		?>
	</div><!-- .banner-text -->
	<?php
		if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
		?>
</div><!-- #banner -->