<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<div id="content">
		<div id="inner-content" class="container">

			<div class="row justify-content-md-center">
			<?php if( function_exists('get_field') && get_field( 'purpose_statement' ) ) { ?>
				<div id="purpose" class="col-lg-8 col-md-10 col-sm-12">
					<h2 class="statement"><?php the_field( 'purpose_statement' ); ?></h2>
				</div><!-- #purpose -->
			</div><!-- .row -->

			<?php }
			 // Event Category Option
			 
	    	if( function_exists('get_field') && get_field('event_category') || get_field('event_count') ) {
				$event_category_ids = get_field( 'event_category' );
				$event_count = get_field('event_count');
				$args = array( 'category' => $event_category_ids, 'limit' => $event_count );
			} else {
				$args = array( 'limit' => 3 );
			}
	    	$events_array = ctfw_get_events($args);
	    		$events_array_count = count($events_array);
	    	?>
	    	<div id="listing" class="row justify-content-center events">
				<?php
			    	if($events_array) {
			    	foreach($events_array as $post) {
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
						<article <?php post_class('col-sm-12 col-md-6 col-lg-4'); ?> role="article">
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
							<div class="card">
			
								<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								
								<div class="card-body">
									<?php
										if($event_date) { echo '<span class="date">'.$event_date.'</span>'; }

										echo '<a href="'.get_the_permalink().'" class="btn">Learn More</a> ';
										if($event_has_coord == 1) {
											echo '<a href="'.$event_directions.'" target="_blank" class="btn">Directions</a>';
										}
									?>
								</div><!-- .card-body -->
								<div class="card-footer">
									<?php 
										if($event_time_desc) { echo '<span class="time"><i class="far fa-clock"></i> '.$event_time_desc.'</span>'; }
										elseif($event_time_range && !$event_hide_time_range) { echo '<span class="time"><i class="far fa-clock"></i> '.$event_time_range.'</span>'; }
									
										if($event_venue) { echo '<span class="venue"><i class="fas fa-map-marker-alt"></i> '.$event_venue.'</span>'; }
									?>
								</div> <!-- .card-footer -->

							</div><!-- .card -->			
						</article> <!-- end article -->
				    
			<?php 	} //endfor
					wp_reset_query();
					} //endif
					else { }
			?>													
		    </div> <!-- #listing -->
		</div> <!-- #inner-content -->

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
		    if($recent_sermons) { ?>
		    	<div id="sermon-latest">
			    	<?php foreach( $recent_sermons as $sermon ){

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
						$img_src = get_template_directory_uri().'/images/demo_banner_bible.jpg';
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
				    				echo ''.get_field('subtitle', $sermon["ID"]);
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
							if(!empty($primary_speaker_name)) { echo '<span class="speaker">'.$primary_speaker_name.'</span> | '; }
							echo '<span class="date">'.get_the_time('F j, Y', $sermon['ID']).'</span>';
						echo "</span>";
						
				        echo '<a href="' . get_permalink($sermon["ID"]) . '" title="Watch '.esc_attr($sermon["post_title"]).'" class="btn">'. $verb .' Now</a>';
				    echo "</span>";
			    	} //foreach
		    } //if
		    else { ?>
				</div><!-- #sermon-latest -->
		    <?php }
		    wp_reset_query();
		?>

	</div> <!-- #content -->

<?php get_footer(); ?>