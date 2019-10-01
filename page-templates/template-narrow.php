<?php
/*
Template Name: Narrow Single Column Content
*/
?>

<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<div id="content">
	
		<div id="inner-content" class="container">
			<div class="row justify-content-md-center">
				<main id="main" class="col-lg-8 col-md-10 col-sm-12" role="main">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<?php get_template_part( 'parts/loop', 'page' ); ?>
					
					<?php endwhile; endif; ?>							
										
				</main> <!-- #main -->
			</div><!-- .row -->
		</div> <!-- #inner-content -->

		<?php get_template_part( 'parts/acf', 'layout' ); ?>

	</div> <!-- end #content -->

<?php get_footer(); ?>