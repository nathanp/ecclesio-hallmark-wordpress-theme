<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<div id="content">
	
		<div id="inner-content" class="container">
			<div class="row">
				<main id="main" class="col-md-8 col-sm-12" role="main">
								
					<?php
						if (have_posts()) : while (have_posts()) : the_post();
								get_template_part( 'parts/loop', 'archive' );
							endwhile;
						else :				
							get_template_part( 'parts/content', 'missing' );
						endif;
					?>
		
				</main> <!-- end #main -->
	
				<?php get_sidebar(); ?>

			</div><!-- .row -->

			<div class="row">
				<div class="col-sm-12">
					<?php joints_page_navi(); ?>
				</div><!-- .col-sm-12 -->
			</div><!-- .row -->
	    
		</div> <!-- #inner-content -->
	</div> <!-- #content -->

<?php get_footer(); ?>