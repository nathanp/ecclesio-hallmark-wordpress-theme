<div id="post-not-found" class="col-sm-12 text-center">
	
	<?php if ( is_search() ) : ?>
		
		<div class="col-lg-8 col-md-8 small-centered" role="main">

			<article id="content-not-found">
		
				<section class="entry-content">
					<p><?php _e( 'Sorry, no results were found. Try to find what you are looking for using the navigation above or the search form below!', 'ecclesio' ); ?></p>
				</section> <!-- end article section -->

				<section class="search">
				    <p><?php get_search_form(); ?></p>
				</section> <!-- end search section -->
		
			</article> <!-- end article -->

		</div>
		
	<?php else: ?>
	
		<header class="article-header">
			<h1><?php _e( 'No sermons found.', 'ecclesio' ); ?></h1>
		</header>
		
		<section class="entry-content">
			<p><?php _e( 'Uh Oh. Something is missing. Try double checking things or clearing some of your filters.', 'ecclesio' ); ?></p>
		</section>
			
	<?php endif; ?>
	
</div>
