<?php
/*
Sermon Index template.
Based on the Church Theme Framework and  custom post type.
If you need to see all potential data, use something like print_r(ctfw_sermon_data());
*/
?>
<?php get_header(); ?>

<div id="banner">
	<span class="overlay"></span>
	<?php
		if ( get_theme_mod( 'ecclesio_sermon_banner_image' ) ) {
			$banner_img_src = esc_url( get_theme_mod( 'ecclesio_sermon_banner_image' ) );
		}
		else {
			$banner_img_src = get_stylesheet_directory_uri().'/images/home_sermon_latest.jpg';
		}
		echo '<img src="' . $banner_img_src . '" alt="">';
	?>
	<div class="banner-text">
		<?php
			if ( get_customize_partial_sermons_heading() ) {
				$banner_heading = get_customize_partial_sermons_heading();
			}
			else {
				$banner_heading = 'Sermons';
			}
			echo '<h1 class="page-title">'. $banner_heading .'</h1>';
		?>
		
		<span class="ecclesio-part-sermons-byline">
			<?php
				if(get_customize_partial_sermons_byline() != "") {
					echo '<h3 class="page-byline">'.get_customize_partial_sermons_byline().'</h3>';
				}
			?>
		</span>
	</div><!-- .banner-text -->

	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
</div><!-- #banner -->
			
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <?php get_template_part( 'parts/loop', 'archive-sermons' ); ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>