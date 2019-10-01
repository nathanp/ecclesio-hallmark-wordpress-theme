<?php
/*
People Index template.
Based on the Church Theme Framework and  custom post type.
*/
?>
<?php get_header(); ?>

<div id="banner">
	<span class="overlay"></span>
	<?php
		if ( get_theme_mod( 'ecclesio_staff_banner_image' ) ) {
			$banner_img_src = esc_url( get_theme_mod( 'ecclesio_staff_banner_image' ) );
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
			if ( function_exists('get_customize_partial_staff_heading') && get_customize_partial_staff_heading() ) {
				$banner_heading = get_customize_partial_staff_heading();
			}
			else {
				$banner_heading = 'Staff';
			}
			echo '<h1 class="page-title">'. $banner_heading .'</h1>';

			if( function_exists('get_customize_partial_staff_byline') && get_customize_partial_staff_byline() != "") {
				$banner_byline = get_customize_partial_staff_byline();
				echo '<p class="page-byline">'. $banner_byline .'</p>';
			}
		?>
	</div><!-- .banner-text -->

	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>

</div><!-- #banner -->
<?php
	//change column sizes based on how many staff per row
	if( get_theme_mod('ecclesio_staff_count') < 4 ) {
		$columns_classes = 'large-8 medium-10 small-12 small-centered';
	} else {
		$columns_classes = 'small-12';
	}
?>
<div id="content">

		<div id="inner-content" class="row">

		    <main id="main" class="<?php echo $columns_classes; ?> columns" role="main">

				<div id="staff" class="row large-up-<?php echo get_theme_mod('ecclesio_staff_count'); ?> medium-up-3 small-up-2" data-equalizer>
				    <?php
				    $the_query = new WP_Query( array(
					    'post_type' => 'ctc_person'
					) );

					while ( $the_query->have_posts() ) : $the_query->the_post();
						$person_fname		= wp_trim_words( get_the_title(), 1, '' );
						$person_position 	= strip_tags( get_post_meta( $post->ID , '_ctc_person_position' , true ) );
						$person_phone 		= strip_tags( get_post_meta( $post->ID , '_ctc_person_phone' , true ) );
						$person_email		= strip_tags( get_post_meta( $post->ID , '_ctc_person_email' , true ) );
						$person_urls		= strip_tags( get_post_meta( $post->ID , '_ctc_person_urls' , true ) );
						if(has_post_thumbnail($post->ID)) {
						    $person_thumb = get_the_post_thumbnail( $post->ID, array( 200, 200 ) );
						} else {
						    $person_thumb = '<img src="'.get_stylesheet_directory_uri().'/images/fallback_staff.png" />';
						}

						//query count below is to add the "end" class to the last item to remove the float:right from Foundation
					?>
					<div class="person column<?php if (($the_query->current_post +1) == ($the_query->post_count)) { echo ' end'; } ?>" data-equalizer-watch>
						<?php
							//Only link to the person if they have filled out their content
							if(trim($post->post_content) != "") { echo '<a href="' . get_permalink( $post->ID ) . '">'; }
								echo '<span class="thumbnail">';
									echo $person_thumb;
									if(trim($post->post_content) != "") { echo '<span class="overlay"><span class="text">Meet<br />'.$person_fname.'</span></span>'; }
								echo '</span>';
							if(trim($post->post_content) != "") { echo '</a>'; }

							echo '<h3>';
								if(trim($post->post_content) != "") { echo '<a href="' . get_permalink( $post->ID ) . '">'; }
									echo get_the_title();
								if(trim($post->post_content) != "") { echo '</a>'; }
							echo '</h3>';
							if($person_position) { echo "<h4>$person_position</h4>"; }
						?>
					</div>
					<?php endwhile; ?>
				</div><!-- #staff -->

			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>