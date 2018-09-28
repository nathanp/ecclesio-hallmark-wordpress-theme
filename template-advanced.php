<?php
/*
Template Name: Advanced Layout
*/
?>

<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<div id="content">
	
		<div id="inner-content" class="container">
			<div class="row">
		   	<main id="main" class="col-sm-12" role="main">
				
				<?php
					if (have_posts()) : while (have_posts()) : the_post();
						get_template_part( 'parts/loop', 'page' );
					endwhile; endif;
				?>					
			    					
				</main>
			</div> <!-- .row -->
			
			<?php get_template_part( 'parts/acf', 'layout' ); ?>	
			
		</div> <!-- #inner-content -->
	
	</div><!-- #content -->

<?php get_footer(); ?>