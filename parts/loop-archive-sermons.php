<main id="listing" class="sermons small-12 columns" role="main">
	<div class="row large-up-3 medium-up-2 small-up-1" data-equalizer data-equalize-on="medium">
    <?php if (have_posts()) : while (have_posts()) : the_post();
    	$sermon_video_url	= ctfw_sermon_data()['video'];
    	$sermon_audio_dl 	= ctfw_sermon_data()['audio_download_url'];

    	if($sermon_video_url) {
    		$verb = "Watch";
    	}
    	elseif($sermon_audio_dl) {
    		$verb = "Listen to";
    	}
    	else {
    		$verb = "View";
    	}
    ?>
 		
		<article id="post-<?php the_ID(); ?>" <?php post_class('column'); ?> role="article">
			<div class="thumb">
				<a href="<?php the_permalink() ?>">
					<span class="overlay">
						<span class="text"><?php echo $verb; ?> Sermon</span>
					</span>
					<?php
						if(has_post_thumbnail()) {
							the_post_thumbnail('full');
						}
						elseif($sermon_video_url) {
							echo '<img src="'.get_video_thumbnail($sermon_video_url).'" alt="" />';
						}
						else {

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

		    	<a href="<?php the_permalink() ?>" class="button"><?php echo $verb; ?> Sermon</a>
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