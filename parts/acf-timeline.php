<div class="timeline-container">
	<div class="timeline">
<?php

// check if the flexible content field has rows of data
if( have_rows('timeline_item') ) {

     // loop through the rows of data
    while ( have_rows('timeline_item') ) : the_row();
        
        	$caption = get_sub_field('caption');
        	$image 	= get_sub_field('image');
        	$title 	= get_sub_field('title');
        	$content = get_sub_field('content');

	      //Output ?>
			<div class="timeline-item timeline-item--active" data-text="<?php echo $caption; ?>">
				<div class="timeline__content">
					<img class="timeline__img" src="<?php echo $image; ?>"/>
					<h2 class="timeline__content-title"><?php echo $title; ?></h2>
					<p class="timeline__content-desc"><?php echo $content; ?></p>
				</div><!-- .timeline__content -->
			</div><!-- .timeline-item -->
        <?php
	endwhile;
}
?>