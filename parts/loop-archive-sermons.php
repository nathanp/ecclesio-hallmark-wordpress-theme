	<?php if (have_posts()) : while (have_posts()) : the_post();
    	$sermon_video_url	= ctfw_sermon_data()['video'];
    	$sermon_audio_embed = ctfw_sermon_data()['audio_player'];
    	$sermon_audio_dl 	= ctfw_sermon_data()['audio_download_url'];
    	// Verbs
    	if($sermon_video_url) {
    		$verb = "Watch";
    	}
    	elseif($sermon_audio_embed || $sermon_audio_dl) {
    		$verb = "Listen to";
    	}
    	else {
    		$verb = "View";
    	}
    ?>
		<article <?php post_class('col-sm-12 col-md-6 col-lg-4'); ?> role="article">
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
							echo '<img src="http://via.placeholder.com/640x360/000000/ffffff?text='.get_the_title().'" alt="" />';	
						}
					?>
				</a>
			</div><!-- .thumb -->
			<div class="card">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="card-body">
					<?php echo '<div class="date">'.get_the_date().'</div>'; ?>

					<a href="<?php the_permalink() ?>" class="btn"><?php echo $verb; ?> Sermon</a>
				</div><!-- .card-body -->

				<div class="card-footer">
					<?php
						// Sermon Speakers
						$speakers = get_the_terms( $post, 'ctc_sermon_speaker');
						if (class_exists('WPSEO_Primary_Term') && $speakers) { //YoastSEO
							$primary_speaker = new WPSEO_Primary_Term('ctc_sermon_speaker', $post->ID);
							$primary_speaker = $primary_speaker->get_primary_term();
							$term = get_term( $primary_speaker );
								$primary_speaker_name = $term->name;
						}
							elseif( !empty($speakers) ) {
									$primary_speaker = $speakers[0]->term_id;
									$primary_speaker_name = $speakers[0]->name;
							}
						if($speakers) {
							echo '<span><i class="fas fa-user"></i> Speaker: <a href="'.get_term_link($primary_speaker).'">'.$primary_speaker_name.'</a></span>';
						}

						// Sermon Series
						$sermon_series = get_the_terms( $post, 'ctc_sermon_series');
						if($sermon_series) {
							echo '<span><i class="fas fa-caret-square-right"></i> Series: ';
							foreach($sermon_series as $series) {
								echo '<a href="'.get_term_link($series).'">'.$series->name,'</a>';
							}
							echo '</span>';
						}

						// Sermon Books
						$sermon_books = get_the_terms( $post, 'ctc_sermon_book');
						if (class_exists('WPSEO_Primary_Term') && $sermon_books) { //YoastSEO
							$primary_book = new WPSEO_Primary_Term('ctc_sermon_book', $post->ID);
							$primary_book = $primary_book->get_primary_term();
							$term = get_term( $primary_book );
								$primary_book_name = $term->name;
						}
							elseif( !empty($sermon_books) ) {
								$primary_book = $sermon_books[0]->term_id;
								$primary_book_name = $sermon_books[0]->name;
							}
						if($primary_book) {
							$primary_book = get_term($primary_book);
							echo '<span><i class="fas fa-bible"></i> Book: <a href="'.get_term_link($primary_book).'">'.$primary_book_name.'</a></span>';
						}
					?>
				</div><!-- .card--footer -->

			</div><!-- .card -->	    						
		</article> <!-- end article -->
	    
	<?php endwhile; ?>	

		<?php joints_page_navi(); ?>
		
	<?php else : ?>
								
		<?php get_template_part( 'parts/content', 'missing-sermon' ); ?>
			
	<?php endif; ?>