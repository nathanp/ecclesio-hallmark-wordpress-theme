<!-- By default, this menu will use off-canvas for small
	 and a topbar for medium-up -->

<div class="top-bar" id="top-bar-menu">
	<div class="top-bar-left float-left">
		<ul class="menu">
			<li>
				<a href="<?php echo home_url(); ?>">
					<?php
						if ( get_option( 'ecclesio_site_logo' ) ) {
							echo '<img id="logo-primary" class="svg" src="' . esc_url( get_option( 'ecclesio_site_logo' ) ) . '">';
						}
						else {
							echo '<h1 class="site-title">'.get_bloginfo('name').'</h1>';
						}
					?>
					
				</a>
			</li>
		</ul>
	</div>
	<div class="top-bar-right d-none d-lg-block desktop">
		<?php ecclesio_top_nav(); ?>	
	</div>
	<div class="top-bar-right float-right d-block d-lg-none mobile">
		<ul class="menu">
			<li>
				<button class="hamburger hamburger--collapse" type="button" data-toggle="off-canvas">
				  <span class="hamburger-box">
				    <span class="hamburger-inner"></span>
				  </span>
				</button>
			</li>

		</ul>
	</div><!-- .show-for-small-only -->
</div>