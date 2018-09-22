<?php $posts_array = ctfw_get_events(); if($posts_array) {
foreach($posts_array as $post) {
	//print_r(ctfw_event_data());
	$event_title 			= get_the_title();
	$event_date 			= ctfw_event_data()['date'];
	$event_time_range 		= ctfw_event_data()['time_range'];
	$event_hide_time_range 	= ctfw_event_data()['hide_time_range'];
	$event_time_desc 		= ctfw_event_data()['time'];
	$event_venue 			= esc_html(ctfw_event_data()['venue']);
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
						the_post_thumbnail('full');
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

					if($event_time_desc) { echo '<span class="time">'.$event_time_desc.'</span>'; }
					elseif($event_time_range && !$event_hide_time_range) { echo '<span class="time">'.$event_time_range.'</span>'; }
				
					if($event_venue) { echo '<span class="venue">'.$event_venue.'</span>'; }
				?>
			</div><!-- .card-body -->
			<div class="card-footer">
				<a href="<?php the_permalink() ?>" class="btn">Learn More</a> 
				<?php
				if($event_has_coord == 1) {
					echo '<a href="'.$event_directions.'" target="_blank" class="btn">Directions</a>';
				}
				?>
			</div> <!-- .card-footer -->

		</div><!-- .card -->
	</article> <!-- end article -->
	
<?php } //endfor
	//joints_page_navi();
} //endif
else {
	get_template_part( 'parts/content', 'missing' );
} ?>