<?php
/*
Template Name: Staff
*/
?>

<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="large-12 medium-12 columns" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			    	<?php get_template_part( 'parts/loop', 'page' ); ?>
			    
			    <?php endwhile; endif; ?>
				
				<ul id="staff">
				    <?php
				    $the_query = new WP_Query( array(
					    'post_type' => 'ctc_person',
					    'tax_query' => array(
					        array (
					            'taxonomy' => 'ctc_person_group',
					            'field' => 'slug',
					            'terms' => 'staff',
					        )
					    ),
					) );

					while ( $the_query->have_posts() ) : $the_query->the_post();
						$person_position 	= strip_tags( get_post_meta( $post->ID , '_ctc_person_position' , true ) );
						$person_phone 		= strip_tags( get_post_meta( $post->ID , '_ctc_person_phone' , true ) );
						$person_email		= strip_tags( get_post_meta( $post->ID , '_ctc_person_email' , true ) );
						$person_urls		= strip_tags( get_post_meta( $post->ID , '_ctc_person_urls' , true ) );

					?>
					<li>
						<?php
							if ( has_post_thumbnail() ) {
								/* temporarily disable link to profile until profile pages are complete

								echo '<span class="thumbnail"><a href="' . get_permalink( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, array( 200, 200 ) ) . '</a></span>';

								*/
								echo '<span class="thumbnail">' . get_the_post_thumbnail( $post->ID, array( 200, 200 ) ) . '</span>';
							}
							echo '<h3>'.get_the_title().'</h3>';
							if($person_position) { echo "<h4>$person_position</h4>"; }
						?>
					</li>
					<?php endwhile; ?>
				</ul>					
			    					
			</main> <!-- end #main -->
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>