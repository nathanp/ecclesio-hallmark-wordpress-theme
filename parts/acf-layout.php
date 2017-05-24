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

        	echo '<div class="row '.$columns_classes.'">';
        		echo '<div class="column">'. $text_col_1 .'</div>';
        		if($text_col_2) { echo '<div class="column">'. $text_col_2 .'</div>'; }
        		if($text_col_3) { echo '<div class="column">'. $text_col_3 .'</div>'; }
        	echo '</div>';
        	
        }
        elseif( get_row_layout() == 'text_sidebar' ) {
        	$text 		= get_sub_field('text');
        	$sidebar 	= get_sub_field('sidebar');
        }
        elseif( get_row_layout() == 'image' ) {
        	$image 			= get_sub_field('image');
	        $image_caption 	= get_sub_field('image_caption');
	        $button_text 	= get_sub_field('button_text');
	        $button_url 	= get_sub_field('button_url');

        }

    endwhile;

}

?>