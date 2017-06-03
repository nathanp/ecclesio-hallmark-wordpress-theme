<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<div id="content">
	
		<div id="inner-content" class="row">
			<?php if( function_exists('get_field') && get_field( 'purpose_statement' ) ) { ?>
				<div id="purpose" class="large-8 medium-10 small-centered columns">
					<h2 class="statement"><?php the_field( 'purpose_statement' ); ?></h2>
				</div>
			<?php }
	    	// Event Category Option
	    	if( function_exists('get_field') && get_field( 'event_category' ) ) {
	    		$event_category_ids = get_field( 'event_category' );
				$args = array( 'category' => $event_category_ids, );
			} else {
				$args = array();
			}
	    	$events_array = ctfw_get_events($args);
	    		$events_array_count = count($events_array);
	    	?>
	    	<div id="listing" class="events small-12 columns">
				<div class="row large-up-<?php echo $events_array_count; ?>" data-equalizer data-equalize-on="medium">
				<?php
			    	if($events_array) {
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
						<article id="post-<?php the_ID(); ?>" <?php post_class('columns'); ?> role="article">
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
				    
			<?php 	} //endfor
					wp_reset_query();
					} //endif
					else { }
			?>
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

			    	// Latest Sermon Image
			    	if( function_exists('get_field') && get_field( 'latest_sermon_image' ) ) {
			    		$img_src = get_field( 'latest_sermon_image' );
					} else {
						$img_src = get_stylesheet_directory_uri().'/images/home_sermon_latest.jpg';
					}
			    	echo '<img src="'. $img_src .'" class="background" />';

			    	// Latest Sermon Heading
			    	if( function_exists('get_field') && get_field( 'latest_sermon_heading' ) ) {
			    		$latest_sermon_heading = get_field( 'latest_sermon_heading' );
					} else {
						$latest_sermon_heading = "This Week's Message";
					}

					echo "<span class='text-container'>";
						echo "<h5>$latest_sermon_heading</h5><br />";
						echo '<h3><a href="' . get_permalink($sermon["ID"]) . '" title="Watch '.esc_attr($sermon["post_title"]).'" >'.
							$sermon["post_title"];
							if( function_exists('get_field') && get_field('subtitle', $sermon["ID"]) ) {
								echo '<span class="show-for-medium">';
				    				echo ' - '.get_field('subtitle', $sermon["ID"]);
				    			echo '</span>';
				    		}
						echo '</a></h3>';

						if(taxonomy_exists('ctc_sermon_speaker')) { //Church Theme Content
							$speakers = get_the_terms( $sermon["ID"], 'ctc_sermon_speaker');	
						}
						
						if (class_exists('WPSEO_Primary_Term')) { //YoastSEO
							$primary_speaker = new WPSEO_Primary_Term('ctc_sermon_speaker', $sermon["ID"]);
							$primary_speaker = $primary_speaker->get_primary_term();
							$primary_speaker = get_term($primary_speaker);
								$primary_speaker_name = $primary_speaker->name;
						}
						elseif( !empty($speakers) ) {
							$primary_speaker = $speakers[0]->term_id;
							$primary_speaker_name = $speakers[0]->name;
						}
						else {
							$primary_speaker = '';
							$primary_speaker_name = '';
						}
						
						echo "<span class='meta'>";
							echo '<span class="speaker">'.$primary_speaker_name.'</span> | ';
							echo '<span class="date">'.get_the_time('F j, Y', $sermon['ID']).'</span>';
						echo "</span>";
						
				        echo '<a href="' . get_permalink($sermon["ID"]) . '" title="Watch '.esc_attr($sermon["post_title"]).'" class="button">'. $verb .' Now</a>';
				    echo "</span>";
			    } //foreach
			    wp_reset_query();
			?>

		</div><!-- #sermon-latest -->

	</div> <!-- #content -->

<?php get_footer(); ?>