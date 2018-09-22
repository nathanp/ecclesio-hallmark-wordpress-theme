<!-- By default, this menu will use off-canvas for small
	 and a topbar for medium-up -->

<div class="top-bar" id="top-bar-menu">

	<a class="navbar-brand" href="<?php echo home_url(); ?>">
		<?php
			if ( get_option( 'ecclesio_site_logo' ) ) {
				echo '<img id="logo-primary" class="svg" src="' . esc_url( get_option( 'ecclesio_site_logo' ) ) . '">';
			}
			else {
				echo '<h1 class="site-title">'.get_bloginfo('name').'</h1>';
			}
		?>
	</a>

	<div class="top-bar-right d-none d-lg-block desktop">
		<?php ecclesio_top_nav(); ?>	
	</div><!-- .top-bar-right -->

	<div class="top-bar-right float-right d-block d-lg-none mobile">
			<button class="hamburger hamburger--collapse" type="button" data-toggle="off-canvas">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
	</div><!-- .top-bar-right -->

</div><!-- #top-bar-menu -->