<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<div id="content">
	
		<div id="inner-content" class="row">
			
			<div id="purpose" class="large-8 medium-10 small-centered columns">
				<h2 class="statement">We exist to love God, love others, and serve the world.</h2>
			</div>

		    <div id="listing" class="events large-12 medium-12 columns">
    			<div class="row" data-equalizer data-equalize-on="medium">
			    <?php
			    	$events_array = ctfw_get_events(); if($events_array) {
			    	foreach(array_slice($events_array, 0, 3) as $post) { //limits to 3
						//print_r(ctfw_event_data());
				    	$event_title 			= get_the_title();
						$event_date 			= ctfw_event_data()['date'];
						$event_time_range 		= ctfw_event_data()['time_range'];
						$event_hide_time_range 	= ctfw_event_data()['hide_time_range'];
						$event_time_desc 		= ctfw_event_data()['time'];
						$event_venue 			= ctfw_event_data()['venue'];
						$event_address 			= ctfw_event_data()['address'];
						$event_directions 		= ctfw_event_data()['directions_url'];
						$event_has_coord 		= ctfw_event_data()['map_has_coordinates'];
						$event_lat 				= ctfw_event_data()['map_lat'];
						$event_lng 				= ctfw_event_data()['map_lng'];
						$event_registration 	= ctfw_event_data()['registration_url'];
			    ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('large-4 columns'); ?> role="article">
							<div class="thumb">
								<a href="<?php the_permalink() ?>">
									<span class="overlay">
										<span class="text">More Info</span>
									</span>
									<?php
										if(has_post_thumbnail()) {
											the_post_thumbnail('medium_large');
										}
										else {
											echo "<img src='http://placehold.it/1200x628/000000/ffffff?text=$event_title' alt='click for event info'>";
										}
									?>
								</a>
							</div><!-- .thumb -->
							<div class="card" data-equalizer-watch>
								<header class="article-header">
									<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								</header> <!-- end article header -->
												
								<footer class="article-footer event">
							    	<?php
							    		if($event_date) { echo '<span class="date">'.$event_date.'</span>'; }

							    		if($event_time_desc) { echo '<span class="time">'.$event_time_desc.'</span>'; }
							    		elseif($event_time_range && !$event_hide_time_range) { echo '<span class="time">'.$event_time_range.'</span>'; }
							    	
							    		if($event_venue) { echo '<span class="venue">'.$event_venue.'</span>'; }
							    	?>
							    	<a href="<?php the_permalink() ?>" class="button">Learn More</a> 
									<?php
									if($event_has_coord == 1) {
											echo '<a href="'.$event_directions.'" target="_blank" class="button">Directions</a>';
									}
									?>
								</footer> <!-- end article footer -->
							</div><!-- .card -->			
						</article> <!-- end article -->
				    
				<?php } //endfor
					
				} //endif
				else {
					
				} ?>
				</div><!-- .row -->															
		    </div> <!-- #listing -->
		    
		</div> <!-- #inner-content -->

		<div id="sermon-latest">
			
			<?php
				$sermon_args = array(
					'numberposts' => 1,
					'offset' => 0,
					'category' => 0,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_type' => 'ctc_sermon',
					'post_status' => 'publish',
					'suppress_filters' => true
				);
			    $recent_sermons = wp_get_recent_posts($sermon_args);
			    foreach( $recent_sermons as $sermon ){

			    	$sermon_video_url	= ctfw_sermon_data($sermon["ID"])['video'];
					$sermon_audio_embed = ctfw_sermon_data($sermon["ID"])['audio_player'];
					$sermon_audio_dl 	= ctfw_sermon_data($sermon["ID"])['audio_download_url'];

			    	if($sermon_video_url) {
			    		$verb = "Watch";
			    	}
			    	elseif($sermon_audio_embed || $sermon_audio_dl) {
			    		$verb = "Listen";
			    	}
			    	else {
			    		$verb = "View";
			    	}

			    	echo '<img src="'.get_stylesheet_directory_uri().'/images/home_sermon_latest.jpg" class="background" />';

					echo "<span class='text-container'>";
						echo "<h5>This Week's Message</h5><br />";
						echo '<h3><a href="' . get_permalink($sermon["ID"]) . '" title="Watch '.esc_attr($sermon["post_title"]).'" >'.
							$sermon["post_title"];
							if(get_field('subtitle', $sermon["ID"])) {
								echo '<span class="show-for-medium">';
				    				echo ' - '.get_field('subtitle', $sermon["ID"]);
				    			echo '</span>';
				    		}
						echo '</a></h3>';
						$speakers = get_the_terms( $sermon["ID"], 'ctc_sermon_speaker');
						if (class_exists('WPSEO_Primary_Term')) { //YoastSEO
							$primary_speaker = new WPSEO_Primary_Term('ctc_sermon_speaker', $sermon["ID"]);
							$primary_speaker = $primary_speaker->get_primary_term();
							$primary_speaker = get_term($primary_speaker);
								$primary_speaker_name = $primary_speaker->name;
						}
						else {
							$primary_speaker_name = $speakers[0]->name;
						}
						echo "<span class='meta'>";
							if($speakers) {
								echo '<span class="speaker">'.$primary_speaker_name.'</span> | ';
							}
							echo '<span class="date">'.get_the_time('F j, Y', $sermon['ID']).'</span>';
						echo "</span>";
						
				        echo '<a href="' . get_permalink($sermon["ID"]) . '" title="Watch '.esc_attr($sermon["post_title"]).'" class="button">'. $verb .' Now</a>';
				    echo "</span>";
			    }
			?>

		</div><!-- #sermon-latest -->

	</div> <!-- #content -->

<?php get_footer(); ?>