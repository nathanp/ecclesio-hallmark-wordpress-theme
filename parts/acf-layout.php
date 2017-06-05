<?php

// check if the flexible content field has rows of data
if( have_rows('advanced_content') ) {

     // loop through the rows of data
    while ( have_rows('advanced_content') ) : the_row();

        if( get_row_layout() == 'text' ) {
        	$columns 	= get_sub_field('columns');
        	$text_col_1 = get_sub_field('text_column_1');
        	$text_col_2 = get_sub_field('text_column_2');
        	$text_col_3 = get_sub_field('text_column_3');

        		if($columns == "2") {
        			$columns_classes = "medium-up-2 small-up-1";
        		}
        		elseif($columns == "3") {
        			$columns_classes = "large-up-3 medium-up-3 small-up-1";	
        		}
        		else {
        			$columns_classes = "small-up-1";	
        		}

        	//Output
        	echo '<div class="row '.$columns_classes.'">';
        		echo '<div class="column">'. $text_col_1 .'</div>';
        		if($text_col_2) { echo '<div class="column">'. $text_col_2 .'</div>'; }
        		if($text_col_3) { echo '<div class="column">'. $text_col_3 .'</div>'; }
        	echo '</div>';
        }
        elseif( get_row_layout() == 'text_sidebar' ) {
        	$text 		= get_sub_field('text');
        	$sidebar 	= get_sub_field('sidebar');

        	//Output
        	echo '<div class="row">';
        		echo '<div class="large-8 medium-8 small-12 columns">'. $text .'</div>';
        		if($sidebar) { echo '<div class="sidebar large-4 medium-4 columns" role="complementary">'. $sidebar .'</div>'; }
        	echo '</div>';
        }
        elseif( get_row_layout() == 'image' ) {
        	$image 			= get_sub_field('image');
	        $image_title 	= get_sub_field('image_title');
	        $image_caption 	= get_sub_field('image_caption');
	        $button_text 	= get_sub_field('button_text');
	        $button_url 	= get_sub_field('button_url');

	        //Output ?>
        	<div class="row">
        		<div class="content-banner small-12 columns">
					<img class="banner-bg" src="<?php echo $image; ?>">)
					<div class="banner-text">
						<?php if($image_title) { ?>
							<h1 class="page-title"><?php echo $image_title; ?></h1>
						<?php } if($image_caption) { ?>
							<span class="page-caption"><?php echo $image_caption; ?></span>
						<?php } if($button_text) { ?>
							<a href="<?php echo $button_url; ?>" class="button"><?php echo $button_text; ?></a>
						<?php } ?>
					</div><!-- .banner-text -->
        		</div><!-- .content-banner -->
        	</div><!-- .row -->
        <?php }

    endwhile;

}

?>