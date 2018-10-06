<?php get_header(); ?>
			
<div id="content">

	<div id="inner-content" class="container">
		<div class="row justify-content-md-center">
			<main id="main" class="col-md-8 col-sm-12" role="main">
		
				<?php if (have_posts()) : while (have_posts()) : the_post();
					get_template_part( 'parts/loop', 'single' );
				endwhile; else :
					get_template_part( 'parts/content', 'missing' );
				endif; ?>

			</main> <!-- end #main -->

			<?php get_sidebar(); ?>

		</div><!-- .row -->
	</div> <!-- #inner-content -->
</div> <!-- #content -->

<?php get_footer(); ?>