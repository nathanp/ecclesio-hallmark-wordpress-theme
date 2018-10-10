<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>
			
	<div id="content">

		<div id="inner-content" class="container">
			<main id="listing" class="row" role="main">
			
				<?php if (have_posts()) : while (have_posts()) : the_post();
				$sermon_video_url	= ctfw_sermon_data()['video'];
				?>
				<article <?php post_class('col-sm-12 col-md-6 col-lg-4'); ?> role="article">
					<div class="card">

						<div class="card-body">
							
							<?php $postType = get_post_type_object(get_post_type());
							if ($postType) {
								//echo esc_html($postType->labels->singular_name);
								echo '<h2>'.esc_html($postType->labels->singular_name).'</h2>';
							} ?>
							<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							<?php if(get_field('subtitle')) echo '<p class="subtitle">'.get_field('subtitle').'</p>'; ?>

							<section class="entry-content" itemprop="articleBody">
								<?php the_excerpt();
								echo '<a href="'.get_the_permalink().'" class="btn">View</a> ';
								?>
							</section>
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

									$primary_book = get_term($primary_book);
									echo '<span><i class="fas fa-bible"></i> Book: <a href="'.get_term_link($primary_book).'">'.$primary_book_name.'</a></span>';
								}

								// Events
								$event_title 				= get_the_title();
								$event_date 				= ctfw_event_data()['date'];
								$event_time_range 		= ctfw_event_data()['time_range'];
								$event_hide_time_range 	= ctfw_event_data()['hide_time_range'];
								$event_time_desc 			= ctfw_event_data()['time'];
								$event_venue 				= esc_html(ctfw_event_data()['venue']);
								$event_registration 		= ctfw_event_data()['registration_url'];

								if($event_time_desc) { echo '<span class="time"><i class="far fa-clock"></i> '.$event_time_desc.'</span>'; }
								elseif($event_time_range && !$event_hide_time_range) { echo '<span class="time"><i class="far fa-clock"></i> '.$event_time_range.'</span>'; }
							
								if($event_venue) { echo '<span class="venue"><i class="fas fa-map-marker-alt"></i> '.$event_venue.'</span>'; }
							?>
						</div> <!-- .card-footer -->

					</div><!-- .card -->		    						
				</article> <!-- article -->
					
				<?php endwhile;
				else :							
					get_template_part( 'parts/content', 'missing' );
				endif; ?>
			
			</main> <!-- #main -->

			<?php joints_page_navi(); ?>
		</div> <!-- #inner-content -->
	</div> <!-- #content -->

<?php get_footer(); ?>