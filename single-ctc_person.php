<?php
/*
Individual Person template.
Based on the Church Theme Framework and custom post type.
If you need to see all potential data, use something like print_r(ctfw_person_data());
*/
?>

<?php get_header(); ?>

<?php
	//print_r(ctfw_person_data());
	$person_fname		= wp_trim_words( get_the_title(), 1, '' );
	$person_position	= ctfw_person_data()['position'];
	$person_phone		= ctfw_person_data()['phone'];
	$person_email		= ctfw_person_data()['email'];
	$person_urls		= ctfw_person_data()['urls'];
	$banner_img_src 	= get_header_image();
?>

<div id="banner">
	<span class="overlay"></span>
	<?php echo '<img class="banner-bg" src="'.$banner_img_src.'" alt="">'; ?>
	<div class="banner-text">
		<?php
			if ( has_post_thumbnail() ) {
				echo '<span class="img-thumbnail person-thumb">';
					the_post_thumbnail('full');
				echo '</span>';
			}
		?>
		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php 
			if($person_position != "") {
				echo "<p class='page-byline'>$person_position</p>";	
			}
		?>
	</div><!-- .banner-text -->
</div><!-- #banner -->
			
<div id="content">

	<div id="inner-content" class="container">
		<div class="row">
		
			<div id="sidebar" class="sidebar person col-lg-3 col-md-4" role="complementary">
				<?php if( $person_phone || $person_email || $person_urls ) { ?>
					<h3>Connect</h3>	
				<?php } ?>
				<p>
					<?php if($person_email) { ?>
						<i class="fa fa-envelope" aria-hidden="true"></i> <?php echo ctfw_email($person_email); ?>
						<br>
					<?php } ?>
					<?php if($person_phone) { ?>
						<i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo $person_phone; ?>"><?php echo $person_phone; ?></a>
						<br>
					<?php }
					if($person_urls) {
						$urls = wp_extract_urls( $person_urls );
						echo '<span class="person-profiles">';
							foreach ($urls as $url) {
								$url = esc_url($url);
								if(strpos($url, 'facebook.com') !== false){
									$fa_icon_class = 'fab fa-facebook';
								}
								elseif(strpos($url, 'twitter.com') !== false){
									$fa_icon_class = 'fab fa-twitter';
								}
								elseif(strpos($url, 'instagram.com') !== false){
									$fa_icon_class = 'fab fa-instagram';
								}
								elseif(strpos($url, 'snapchat.com') !== false){
									$fa_icon_class = 'fab fa-snapchat-ghost';
								}
								elseif(strpos($url, 'linkedin.com') !== false){
									$fa_icon_class = 'fab fa-linkedin';
								}
								else {
									$fa_icon_class = 'fas fa-link';
								}
								echo '<a href="'.$url.'" target="_blank">';
									echo '<i class="'.$fa_icon_class.'" aria-hidden="true"></i>';
								echo '</a>';
							}//end foreach
						echo '</span><!-- .person-profiles-->';
					}//endif ?>
				</p>
			</div>

			<main id="main" class="col-lg-9 col-md-8" role="main">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
					<?php get_template_part( 'parts/loop', 'person' ); ?>
					
				<?php endwhile; else : ?>
			
						<?php get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>

			</main> <!-- end #main -->
		</div>
	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>