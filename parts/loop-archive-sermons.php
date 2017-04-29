<main id="listing" class="sermons small-12 columns" role="main">
	<div class="row" data-equalizer data-equalize-on="medium">
    <?php if (have_posts()) : while (have_posts()) : the_post();
    	$sermon_video_url	= ctfw_sermon_data()['video'];

    ?>
 		
		<article id="post-<?php the_ID(); ?>" <?php post_class('large-4 medium-6 columns'); ?> role="article">
			<div class="thumb">
				<a href="<?php the_permalink() ?>">
					<span class="overlay">
						<span class="text">Watch Sermon</span>
					</span>
					<?php
						if(has_post_thumbnail()) {
							the_post_thumbnail('full');
						}
						else {
							//echo '<img src="http://placehold.it/1280x720/000000/ffffff?text=Watch" alt="">';
							echo '<img src="'.get_video_thumbnail($sermon_video_url).'" alt="" />';
						}
					?>
				</a>
			</div><!-- .thumb -->
			<div class="card" data-equalizer-watch>
			<header class="article-header">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			</header> <!-- end article header -->
							
			<section class="entry-content" itemprop="articleBody">
				<?php the_content('<button class="tiny">' . __( 'Read more...', 'jointswp' ) . '</button>'); ?>
			</section> <!-- end article section -->
								
			<footer class="article-footer sermon">
		    	<?php echo '<span class="date">'.get_the_date().'</span>'; ?>
		    	
		    	<span class="meta sermon">
			    	<?php
			    		$speakers = get_the_terms( $post, 'ctc_sermon_speaker');

			    		$primary_speaker = new WPSEO_Primary_Term('ctc_sermon_speaker', $post->ID);
						$primary_speaker = $primary_speaker->get_primary_term();
						$primary_speaker = get_term($primary_speaker);
						if($speakers) {
							echo '<span class="speaker"><label>Speaker:</label><a href="'.get_term_link($primary_speaker).'">'.$primary_speaker->name.'</a></span>';
						}

			    		$sermon_series = get_the_terms( $post, 'ctc_sermon_series');
			    		if($sermon_series) {
			    			echo '<span class="series"><label>Series:</label>';
				    		foreach($sermon_series as $series) {
								echo '<a href="'.get_term_link($series).'">'.$series->name,'</a>';
							}
							echo '</span>';
						}
			    	
						$primary_book = new WPSEO_Primary_Term('ctc_sermon_book', $post->ID);
						$primary_book = $primary_book->get_primary_term();
						if($primary_book) {
							$primary_book = get_term($primary_book);
							echo '<span class="book"><label>Book:</label><a href="'.get_term_link($primary_book).'">'.$primary_book->name.'</a></span>';	
						}
			    	?>
		    	</span><!-- .meta -->

		    	<a href="<?php the_permalink() ?>" class="button">Watch Sermon</a>
			</footer> <!-- end article footer -->
			</div>		    						
		</article> <!-- end article -->
	    
	<?php endwhile; ?>	

		<?php joints_page_navi(); ?>
		
	<?php else : ?>
								
		<?php get_template_part( 'parts/content', 'missing' ); ?>
			
	<?php endif; ?>
	</div>																
</main> <!-- end #main -->