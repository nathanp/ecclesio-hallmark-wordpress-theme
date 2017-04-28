<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>
			
	<div id="content">

		<div id="inner-content" class="row">
	
			<main id="listing" class="sermons small-12 columns" role="main">
				<div class="row" data-equalizer data-equalize-on="medium">
			    <?php if (have_posts()) : while (have_posts()) : the_post();
			    	$sermon_video_url	= ctfw_sermon_data()['video'];
			    ?>
			 		
					<article id="post-<?php the_ID(); ?>" <?php post_class('large-4 medium-6 columns'); ?> role="article">
						<?php /*
						<div class="thumb">
							<a href="<?php the_permalink() ?>">
								<span class="overlay">
									<span class="text">Watch Sermon</span>
								</span>
								<?php
									if(has_post_thumbnail()) {
										the_post_thumbnail('full');
									}
									elseif($sermon_video_url) {
										echo '<img src="'.get_video_thumbnail($sermon_video_url).'" alt="" />';
									}
								?>
							</a>
						</div><!-- .thumb -->
						*/ ?>
						<div class="card" data-equalizer-watch>
						<header class="article-header">
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						</header> <!-- end article header -->
										
						<section class="entry-content" itemprop="articleBody">
							<?php the_excerpt('<button class="tiny">' . __( 'Read more...', 'jointswp' ) . '</button>'); ?>
						</section> <!-- end article section -->
											
						<footer class="article-footer sermon">
					    	<?php //echo '<span class="date">'.get_the_date().'</span>'; ?>

					    	<a href="<?php the_permalink() ?>" class="button">Read More</a>
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
		
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
