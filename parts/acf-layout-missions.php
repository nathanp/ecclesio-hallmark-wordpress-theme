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
        			$columns_classes = "col-sm-12 col-md-6";
        		}
        		elseif($columns == "3") {
        			$columns_classes = "col-sm-12 col-md-6 col-lg-4";	
        		}
        		else {
        			$columns_classes = "col-sm-12";	
        		}

        	//Output
        	echo '<div class="row">';
        		echo '<div class="'.$columns_classes.'"><div class="card"><div class="card-body">'. $text_col_1 .'</div></div></div>';
        		if($text_col_2) { echo '<div class="'.$columns_classes.'"><div class="card"><div class="card-body">'. $text_col_2 .'</div></div></div>'; }
        		if($text_col_3) { echo '<div class="'.$columns_classes.'"><div class="card"><div class="card-body">'. $text_col_3 .'</div></div></div>'; }
        	echo '</div>';
        }
        elseif( get_row_layout() == 'text_sidebar' ) {
        	$text 		= get_sub_field('text');
        	$sidebar 	= get_sub_field('sidebar');

        	//Output
        	echo '<div class="row">';
        		echo '<div class="col-md-8 col-sm-12">'. $text .'</div>';
        		if($sidebar) { echo '<div class="sidebar col-md-4 col-sm-12" role="complementary">'. $sidebar .'</div>'; }
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
        		<div class="content-banner col-sm-12">
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