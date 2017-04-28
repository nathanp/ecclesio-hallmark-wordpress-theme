<div id="post-not-found" class="hentry">
	
	<?php if ( is_search() ) : ?>
		
		<div class="large-8 medium-8 small-centered columns" role="main">

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
			<h1><?php _e( 'Oops, Post Not Found!', 'jointswp' ); ?></h1>
		</header>
		
		<section class="entry-content">
			<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'jointswp' ); ?></p>
		</section>
		
		<section class="search">
		    <p><?php get_search_form(); ?></p>
		</section> <!-- end search section -->
		
		<footer class="article-footer">
		  <p><?php _e( 'This is the error message in the parts/content-missing.php template.', 'jointswp' ); ?></p>
		</footer>
			
	<?php endif; ?>
	
</div>
