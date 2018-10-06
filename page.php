<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<div id="content">
	
		<div id="inner-content" class="container">
			<div class="row">
				<main id="main" class="col-sm-12" role="main">
				
				<?php if (have_posts()) : while (have_posts()) : the_post();
			    	get_template_part( 'parts/loop', 'page' );
			    endwhile; endif; ?>							
			    					
				</main> <!-- end #main -->
			</div><!-- .row -->
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>