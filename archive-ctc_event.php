<?php
/*
Event Index template.
Based on the Church Theme Framework and  custom post type.
If you need to see all potential data, use something like print_r(ctfw_event_data());
Also uses the ctfw_get_events() function to properly query the events in order, etc. This uses the get_posts() function from WP.
*/
?>
<?php get_header(); ?>

<div id="banner">
	<span class="overlay"></span>
	<?php
		if ( get_theme_mod( 'ecclesio_event_banner_image' ) ) {
			$banner_img_src = esc_url( get_theme_mod( 'ecclesio_event_banner_image' ) );
		}
		elseif ( get_header_image() ) {
			$banner_img_src = get_header_image();
		}       
		else {
			$banner_img_src = get_stylesheet_directory_uri().'/images/demo_banner.jpg';
		}
		echo '<img class="banner-bg" src="' . $banner_img_src . '" alt="">';
	?>
	<div class="banner-text">
		<?php
			if ( function_exists('get_customize_partial_events_heading') && get_customize_partial_events_heading() ) {
				$banner_heading = get_customize_partial_events_heading();
			}
			else {
				$banner_heading = 'Events';
			}
			echo '<h1 class="page-title">'. $banner_heading .'</h1>';
		
			if( function_exists('get_customize_partial_events_byline') && get_customize_partial_events_byline() != "") {
				$banner_byline = get_customize_partial_events_byline();
				echo '<h3 class="page-byline">'. $banner_byline .'</h3>';
			}

			if( function_exists('get_customize_partial_events_button') && get_customize_partial_events_button() != "") {
				$banner_button = get_customize_partial_events_button();
				$banner_button_link = get_customize_partial_events_button();
				echo '<a class="button" href="'. $banner_button_link .'">'. $banner_button .'</a>';
			}
		?>
	</div><!-- .banner-text -->

	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
</div><!-- #banner -->
			
	<div id="content">
		<div id="inner-content" class="row">
			
		    <?php get_template_part( 'parts/loop', 'archive-events' ); ?>
		    
		</div> <!-- end #inner-content -->
	</div> <!-- end #content -->

<?php get_footer(); ?>