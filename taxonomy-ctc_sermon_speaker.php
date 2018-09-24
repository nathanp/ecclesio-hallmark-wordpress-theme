<?php
/*
Sermons by Book template.
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
		elseif ( get_header_image() ) {
			$banner_img_src = get_header_image();
		}       
		else {
			$banner_img_src = get_stylesheet_directory_uri().'/images/demo_banner_bible.jpg';
		}
		echo '<img class="banner-bg" src="' . $banner_img_src . '" alt="">';
	?>
	<div class="banner-text">
		<h3 class='page-byline'>Sermons by</h3>
		<h1 class="page-title"><?php single_cat_title(); ?></h1>
	</div><!-- .banner-text -->

	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p id="breadcrumbs">','</p>'); } ?>
</div><!-- #banner -->
			
	<div id="content">
	
	<div id="inner-content" class="container">
			<main id="listing" class="row sermons" role="main">
		    <?php get_template_part( 'parts/loop', 'archive-sermons' ); ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>