<?php
/*
Individual Sermon template.
Based on the Church Theme Framework and  custom post type.
If you need to see all potential data, use something like print_r(ctfw_sermon_data());
*/
?>

<?php get_header(); ?>

<?php
	//print_r(ctfw_sermon_data());
	$sermon_video_url	= ctfw_sermon_data()['video'];
	$sermon_video_embed = ctfw_sermon_data()['video_player'];
	$sermon_audio_embed = ctfw_sermon_data()['audio_player'];
	$sermon_audio_dl 	= ctfw_sermon_data()['audio_download_url'];
	$sermon_pdf 		= ctfw_sermon_data()['pdf'];
?>

<div id="banner">
	<div class="tab-content sermon" data-tabs-content="sermon-tabs">
		<?php
			if($sermon_video_embed) { ?>
				<div class="tab-pane fade show active" id="watch" role="tabpanel" aria-labelledby="watch-tab">
					<?php echo $sermon_video_embed; ?>
				</div><!-- .tabs-panel -->
		<?php }
			if($sermon_audio_embed) { ?>
				<div class="tab-pane fade <?php if(!$sermon_video_embed) echo 'show active'; ?>" id="listen" role="tabpanel" aria-labelledby="watch-listen">
					<?php echo $sermon_audio_embed; ?>
				</div><!-- .tabs-panel -->
		<?php } ?>
	</div><!-- .tabs-content -->
</div><!-- #banner -->
			
<div id="content">

	<div id="inner-content" class="container">
		<main id="main" class="row justify-content-md-center" role="main">
		
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		    	<article id="post-<?php the_ID(); ?>" <?php post_class('col-lg-8 col-md-10 col-sm-12'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
					<ul class="nav nav-tabs tabs-sermon" role="tablist">
						<?php
							if($sermon_video_embed) { ?>
							  <li class="nav-item link-title">
							  	<a class="nav-link active" id="watch-tab" data-toggle="tab" href="#watch" role="tab" aria-controls="watch" aria-selected="true">
								  <i class="fas fa-video"></i> Watch
							  	</a>
							  </li>
						<?php }
							if($sermon_audio_embed) { ?>
							  <li class="nav-item link-title" id="tab-listen">
							  <a class="nav-link <?php if(!$sermon_video_embed) echo 'active'; ?>" id="listen-tab" data-toggle="tab" href="#listen" role="tab" aria-controls="listen" aria-selected="true">
							  		<i class="fa fa-headphones" aria-hidden="true"></i> Listen
							  	</a>
							  </li>
							  <?php if(strpos($sermon_audio_dl, '.mp3') !== false) { ?>
								  <li class="link-title">
								  	<a href="<?php echo $sermon_audio_dl; ?>" target="_blank">
									  <i class="fas fa-cloud-download-alt"></i> Download Audio
								  	</a>
								  </li>
						<?php } } 
							if($sermon_pdf) { ?>
							  <li class="link-title">
							  	<a href="<?php echo $sermon_pdf; ?>" target="_blank">
								  <i class="far fa-file-pdf"></i> Download PDF
							  	</a>
							  </li>
						<?php } ?>
					</ul>

					<?php
						$sermon_series = get_the_terms( $post, 'ctc_sermon_series');
						if($sermon_series) {
							echo '<p class="series"><a href="'.get_post_type_archive_link( "ctc_sermon" ).'">Sermons</a> / Series: ';
							foreach($sermon_series as $series) {
								echo '<a href="'.get_term_link($series).'">'.$series->name,'</a>';
							}
							echo '</p>';
						}
					?>

					<header class="article-header text-center">	
						<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
						<?php if(get_field('subtitle')) { echo '<h2 class="subtitle">'.get_field('subtitle').'</h2>'; } ?>
						
				    </header> <!-- end article header -->
									
				    <section class="entry-content text-center" itemprop="articleBody">
				    	<?php
				    		$speakers = get_the_terms( $post, 'ctc_sermon_speaker');
				    		if($speakers) {
					    		foreach($speakers as $speaker) {
									$speaker_names[] = "<a href='".get_term_link($speaker)."'>$speaker->name</a>";
								}
								echo implode(', ', $speaker_names);
								echo " |";
							}
				    	?> <?php echo get_the_date(); ?>
				    	
				    	<?php
				    		$sermon_books = get_the_terms( $post, 'ctc_sermon_book');
				    		if($sermon_books) {
				    			echo '<br>Book: ';
					    		foreach($sermon_books as $sermon_book) {
									$book_names[] = "<a href='".get_term_link($sermon_book)."'>$sermon_book->name</a>";
								}
								echo implode(', ', $book_names);
							}
				    	?>
				    	
				    	<?php
				    		$sermon_topics = get_the_terms( $post, 'ctc_sermon_topic');
				    		if($sermon_topics) {
				    			echo '<br>Topic: ';
					    		foreach($sermon_topics as $sermon_topic) {
					    			$topic_names[] = "<a href='".get_term_link($sermon_topic)."'>$sermon_topic->name</a>";
								}
								echo implode(', ', $topic_names);
							}
				    	?>
				    	
						<?php the_content(); ?>
					</section> <!-- end article section -->
										
					<footer class="article-footer">
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jointswp' ), 'after'  => '</div>' ) ); ?>
						<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>	
					</footer> <!-- end article footer -->
																	
				</article> <!-- end article -->
		    					
		    <?php endwhile; else : ?>
		
		   		<?php get_template_part( 'parts/content', 'missing' ); ?>

		    <?php endif; ?>

		</main> <!-- end #main -->

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<script>
	var iframe = document.querySelector('iframe');
    var pauseButton = document.getElementById("tab-listen");
</script>

<?php if (strpos($sermon_video_url,'vimeo.com') ) { ?>
	<script src="https://player.vimeo.com/api/player.js"></script>

	<script>
		jQuery(document).ready(function() {
		    jQuery('#banner iframe').attr('src', function() {
		        return this.src + '?title=0&byline=0&portrait=0&color=358fcd'
		    });
		});
		var player = new Vimeo.Player(iframe);
		pauseButton.addEventListener('click',function()
		{
			player.pause();
		});
	</script>
<?php } ?>

<?php if (strpos($sermon_video_url,'youtube.com') ) { ?>
	<script>
		jQuery(document).ready(function() {
		    jQuery('#banner iframe').attr('src', function() {
		        return this.src + '&enablejsapi=1&showinfo=0&modestbranding=1&rel=0'
		    });
		});

		// https://developers.google.com/youtube/iframe_api_reference
		var tag = document.createElement('script');
		tag.src = "//www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		var player = false

		function onYouTubeIframeAPIReady() {
			player = new YT.Player(iframe, {});
		}
		
		var pauseButton = document.getElementById("tab-listen");
		pauseButton.addEventListener("click", function() {
			if (player) {
				player.pauseVideo()
			}
		});
	</script>
<?php } ?>

<?php get_footer(); ?>