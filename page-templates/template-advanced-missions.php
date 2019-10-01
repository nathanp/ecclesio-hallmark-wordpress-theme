<?php
/*
Template Name: Advanced Layout - Missions
*/
?>

<?php get_header(); ?>
	
	<?php get_template_part( 'parts/header', 'banner' ); ?>

	<div id="content">
	
		<div id="inner-content" class="container">
			<div class="row">
		   	<main id="main" class="col-sm-12" role="main">
				
				<?php
					if (have_posts()) : while (have_posts()) : the_post();
						get_template_part( 'parts/loop', 'page' );
					endwhile; endif;
				?>					
			    					
				</main>
			</div> <!-- .row -->
			<nav id="navbar-example2" class="navbar navbar-light bg-light">
				<ul class="nav nav-pills">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Locations</a>
						<div class="dropdown-menu" id="test">
							<script>
								jQuery(document).ready(function() { 
								// Get the element with id="myDIV" (a div), then get all elements with class="example" inside div
								var x = document.getElementById("scrollspy").querySelectorAll("h2");
									
								// Create a for loop and set the background color of all elements with class="example" in div
								var i;

								var tag_id = document.getElementById('test');
								
								

								for (i = 0; i < x.length; i++) {
									//console.log(x[i].id);

									var newNode = document.createElement('a');
									newNode.setAttribute("class", "dropdown-item");
									newNode.setAttribute("href", "#"+x[i].id);
									newNode.innerText = x[i].innerText;
									tag_id.appendChild(newNode);
									
								}
								});
							</script>
					
						</div>
					</li>
				</ul>
				</nav>
			<div id="scrollspy" data-spy="scroll" data-target="#navbar-example2" data-offset="0">
				<?php get_template_part( 'parts/acf', 'layout-missions' ); ?>	
			</div>
		</div> <!-- #inner-content -->
	
	</div><!-- #content -->

<?php get_footer(); ?>