<?php
/*
Template Name: People
*/
?>

<?php get_header(); ?>

	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<?php
		if( function_exists('get_field') ) {
	    	$people_per_row = get_field( 'people_per_row' );
	    }
	    else {
	    	$people_per_row = 3;
		 }

		//change column sizes based on how many staff per row
		if( $people_per_row == 1 ) {
			$columns_classes = 'col-sm-12';
		} elseif( $people_per_row == 2 ) {
			$columns_classes = 'col-sm-12 col-md-6';
		} elseif( $people_per_row == 3 ) {
			$columns_classes = 'col-sm-12 col-md-4';
		} elseif( $people_per_row == 4 ) {
			$columns_classes = 'col-sm-12 col-md-4 col-lg-3';
		} elseif( $people_per_row == 5 ) {
			$columns_classes = 'col-2dot4';
		} else {
			$columns_classes = 'col-sm-12 col-md-3 col-lg-2';
		}
	?>

	<div id="content">

		<div id="inner-content" class="container">
			<div class="row">
				<main id="main" class="col-sm-12" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<?php get_template_part( 'parts/loop', 'page' ); ?>

					<?php endwhile; endif; ?>

					<div id="staff" class="row" data-equalizer>
						<?php
						if( function_exists('get_field') ) {
							$people_group_ids = get_field( 'people_group' );
						}
						else {
							$people_group_ids = 'staff';
						}
						$the_query = new WP_Query( array(
							'post_type' => 'ctc_person',
							'posts_per_page' => -1,
							'tax_query' => array(
								array (
									'taxonomy' => 'ctc_person_group',
									'terms' => $people_group_ids,
								)
							),
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
						<div class="person <?php echo $columns_classes; ?> <?php if (($the_query->current_post +1) == ($the_query->post_count)) { echo ' end'; } ?>" data-equalizer-watch>
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
								if($person_position) { echo "<p>$person_position</p>"; }
							?>
						</div>
						<?php endwhile; ?>
					</div><!-- #staff -->

				</main> <!-- end #main -->
			</div><!-- end .row -->
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>