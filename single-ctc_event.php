<?php
/*
Individual Event template.
Based on the Church Theme Framework and  custom post type.
If you need to see all potential data, use something like print_r(ctfw_event_data());
*/
?>

<?php get_header(); ?>

<?php
	//print_r(ctfw_event_data());
	$event_date 		= ctfw_event_data()['date'];
	$event_time_range 	= ctfw_event_data()['time_range'];
	$event_venue 		= esc_html(ctfw_event_data()['venue']);
	$event_address 		= ctfw_event_data()['address'];
	$event_directions 	= ctfw_event_data()['directions_url'];
	$event_has_coord 	= ctfw_event_data()['map_has_coordinates'];
	$event_lat 			= ctfw_event_data()['map_lat'];
	$event_lng 			= ctfw_event_data()['map_lng'];
	$event_registration = ctfw_event_data()['registration_url'];

?>

<div id="banner">
	<span class="overlay"></span>
	<?php
		if(has_post_thumbnail()) {
			the_post_thumbnail('full', ['class' => 'banner-bg']);
		}
		else {
			echo '<img class="banner-bg" src="'.get_stylesheet_directory_uri().'/images/ft-worth.jpg" alt="">';
		}
	?>
	<div class="banner-text">
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php
			echo "<h3 class='page-byline'>$event_date</h3>";

			if($event_registration) {
				echo '<a href="'.$event_registration.'" target="_blank" class="button">Register</a>';
			}
		?>
	</div><!-- .banner-text -->
	<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb('<p id="breadcrumbs">','</p>');
		}
	?>
</div><!-- #banner -->
			
<div id="content">

	<div id="inner-content" class="row">

		<main id="main" class="medium-8 small-12 small-centered columns" role="main">
		
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		    	<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
									
				    <section class="entry-content" itemprop="articleBody">
				    	<ul class="event-meta">
				    		<?php
				    			if($event_date) { ?>
						    		<li>
						    			<span class="label">Date</span>
						    			<span class="info"><?php echo $event_date; ?></span>
						    		</li>
					    	<?php }
					    		if($event_time_range)  { ?>
						    		<li>
						    			<span class="label">Time</span>
						    			<span class="info"><?php echo $event_time_range; ?></span>
						    		</li>
				    		<?php }
				    		/* hide category for now
				    		<li>
				    			<span class="label">Category</span>
				    			<span class="info">
				    				<?php
							    		$event_categories = get_the_terms( $post, 'ctc_event_category');
							    		if($event_categories) {
								    		foreach($event_categories as $event_category) {
												echo '<a href="'.get_term_link($event_category).'">'.$event_category->name,'</a>';
											}
										}
							    	?>
				    			</span>
				    		</li>
				    		*/ ?>
				    	</ul><!-- .event-meta -->
						<?php the_content(); ?>
					</section> <!-- end article section -->
					<p class="text-center">
						<?php
							if($event_registration) {
								echo '<a href="'.$event_registration.'" target="_blank" class="button">Register</a>';
							}
							if($event_has_coord == 1) {
								echo '<a href="'.$event_directions.'" target="_blank" class="button">Get Directions</a>';
						} ?>
					</p>

				</article> <!-- end article -->
		    					
		    <?php endwhile; else : ?>
		
		   		<?php get_template_part( 'parts/content', 'missing' ); ?>

		    <?php endif; ?>

		</main> <!-- end #main -->

	</div> <!-- end #inner-content -->

	<section class="map">
		<?php if($event_has_coord == 1) { ?>
			<div id="event-map"></div>
			<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo ctfw_google_maps_api_key(); ?>"></script>
		    <script>
		    	//Get Latitude and Longitude
		    	var myLatLng = {lat: <?php echo $event_lat; ?>, lng: <?php echo $event_lng; ?>};
		    	//Generate Map
		    	var map = new google.maps.Map(document.getElementById('event-map'), {
		        	center: myLatLng,
		        	zoom: 10
		      	});
		    	//Generate content for map infowindow
		    	var contentString = 
		            '<h4 class="mapHeading"><?php echo $event_venue; ?></h4>';
		        //Generate infowindow
		        var infowindow = new google.maps.InfoWindow({
		          content: contentString
		        });
		        //Custom image marker
		      	var image = '<?php echo get_stylesheet_directory_uri()."/images/logo_icon.png"; ?>';
		      	//Generate marker
		      	var marker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					title: '<?php echo $event_venue; ?>'
		        });
		        //Open infowindow when a user clicks the marker
		        marker.addListener('click', function() {
		          infowindow.open(map, marker);
		        });
		    </script>
		<?php } ?>
	</section><!-- .map -->

</div> <!-- end #content -->

<?php get_footer(); ?>