<?php
/*
Sermons by Topic template.
Based on the Church Theme Framework and  custom post type.
*/
?>
<?php get_header(); ?>

<div id="banner">
	<span class="overlay"></span>
	<?php
		$banner_img_src = get_field('header_image');
		if($banner_img_src) {
			echo "<img class='banner-bg' src='$banner_img_src' alt=''>";	
		}
		else {
			echo '<img class="banner-bg" src="'.get_stylesheet_directory_uri().'/images/home_sermon_latest.jpg" alt="">';
		}
	?>
	<div class="banner-text">
		<h3 class='page-byline'>Sermons about</h3>
		<h1 class="page-title"><?php single_cat_title(); ?></h1>
	</div><!-- .banner-text -->

	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
</div><!-- #banner -->
			
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <?php get_template_part( 'parts/loop', 'archive-sermons' ); ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>