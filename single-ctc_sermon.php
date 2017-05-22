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
	<div class="tabs-content sermon" data-tabs-content="sermon-tabs">
		<?php
			if($sermon_video_embed) { ?>
				<div class="tabs-panel is-active" id="watch">
					<?php echo $sermon_video_embed; ?>
				</div><!-- .tabs-panel -->
		<?php }
			if($sermon_audio_embed) { ?>
				<div class="tabs-panel <?php if(!$sermon_video_embed) echo 'is-active'; ?>" id="listen">
					<?php echo $sermon_audio_embed; ?>
				</div><!-- .tabs-panel -->
		<?php } ?>
	</div><!-- .tabs-content -->
</div><!-- #banner -->
			
<div id="content">

	<div id="inner-content" class="row">

		<main id="main" class="large-12 medium-12 columns" role="main">
		
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		    	<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					
					<ul class="tabs tabs-sermon" data-tabs id="sermon-tabs">
						<?php
							if($sermon_video_embed) { ?>
							  <li class="tabs-title is-active">
							  	<a href="#watch" aria-selected="true">
							  		<i class="fa fa-video-camera" aria-hidden="true"></i> Watch
							  	</a>
							  </li>
						<?php }
							if($sermon_audio_embed) { ?>
							  <li class="tabs-title <?php if(!$sermon_video_embed) echo 'is-active'; ?>" id="tab-listen">
							  	<a href="#listen">
							  		<i class="fa fa-headphones" aria-hidden="true"></i> Listen
							  	</a>
							  </li>
							  <?php if(strpos($sermon_audio_dl, '.mp3') !== false) { ?>
								  <li class="link-title">
								  	<a href="<?php echo $sermon_audio_dl; ?>" target="_blank">
								  		<i class="fa fa-cloud-download" aria-hidden="true"></i> Download Audio
								  	</a>
								  </li>
						<?php } } 
							if($sermon_pdf) { ?>
							  <li class="link-title">
							  	<a href="<?php echo $sermon_pdf; ?>" target="_blank">
							  		<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF
							  	</a>
							  </li>
						<?php } ?>
					</ul>

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
				    		$sermon_series = get_the_terms( $post, 'ctc_sermon_series');
				    		if($sermon_series) {
				    			echo '<br>Series: ';
					    		foreach($sermon_series as $series) {
									echo '<a href="'.get_term_link($series).'">'.$series->name,'</a>';
								}
							}
				    	?>
				    	
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