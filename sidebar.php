<div id="sidebar1" class="sidebar col-md-4 col-sm-12" role="complementary">

	<?php
		if(function_exists('the_field') && get_field( 'sidebar_content' ) != NULL ) {
			the_field( 'sidebar_content' );
		}
		else {
			dynamic_sidebar( 'sidebar1' );
		}	
	?>

</div>