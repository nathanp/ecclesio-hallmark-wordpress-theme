<?php get_header(); ?>

	<?php get_template_part( 'parts/header', 'banner' ); ?>
			
	<div id="content">

		<div id="inner-content" class="row">
	
			<main id="main" class="large-8 medium-8 small-centered columns" role="main">

				<article id="content-not-found">
			
					<section class="entry-content">
						<p><?php _e( 'The page you were looking for was not found. Try to find what you are looking for using the navigation above or the search form below!', 'ecclesio' ); ?></p>
					</section> <!-- end article section -->

					<section class="search">
					    <p><?php get_search_form(); ?></p>
					</section> <!-- end search section -->
			
				</article> <!-- end article -->
	
			</main> <!-- end #main -->

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>