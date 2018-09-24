				<footer class="footer" role="contentinfo">
					<div class="footer-top">
						<div class="container-fluid">
						<div class="row">

							<div class="col-lg-4 col-md-4 col-sm-12">
								<h5> <i class="fa fa-clock-o" aria-hidden="true"></i> <span class="ecclesio-part-services-heading"><?php echo get_customize_partial_church_services_heading(); ?></span></h5>
								<p class="ecclesio-part-service-times">
									<?php echo get_customize_partial_church_service_times(); ?>
								</p>
							</div><!-- .columns -->

							<div class="col-lg-4 col-md-4 col-sm-12 text-center">
								<a href="<?php echo get_customize_church_footer_cta_url(); ?>" class="btn btn-outline-light ecclesio-part-cta-text"><?php echo get_customize_partial_church_footer_cta_text(); ?></a>
							</div><!-- .columns -->

							<div class="col-lg-4 col-md-4 col-sm-12 social">
								<ul class="inline-menu">
									<?php
									if(get_customize_social_fb()) {
										echo '<li>
												<a href="'.get_customize_social_fb().'" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a>
											</li>';
									}
									if(get_customize_social_insta()) {
										echo '<li>
												<a href="'.get_customize_social_insta().'" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a>
											</li>';
									}
									if(get_customize_social_twitter()) {
										echo '<li>
												<a href="'.get_customize_social_twitter().'" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
											</li>';
									}
									if(get_customize_social_google()) {
										echo '<li>
												<a href="'.get_customize_social_google().'" target="_blank"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
											</li>';
									}
									if(get_customize_social_snap()) {
										echo '<li>
												<a href="'.get_customize_social_snap().'" target="_blank"><i class="fab fa-snapchat-ghost" aria-hidden="true"></i></a>
											</li>';
									}
									if(get_customize_social_itunes()) {
										echo '<li>
											<a href="'.get_customize_social_itunes().'" target="_blank"><i class="fas fa-podcast" aria-hidden="true"></i></a>
										</li>';
									}
									if(get_customize_social_spotify()) {
										echo '<li>
												<a href="'.get_customize_social_spotify().'" target="_blank"><i class="fab fa-spotify" aria-hidden="true"></i></a>
											</li>';
									}
									if(get_customize_social_vimeo()) {
										echo '<li>
												<a href="'.get_customize_social_vimeo().'" target="_blank"><i class="fab fa-vimeo" aria-hidden="true"></i></a>
											</li>';
									}
									if(get_customize_social_yt()) {
										echo '<li>
												<a href="'.get_customize_social_yt().'" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a>
											</li>';
									}
									?>
								</ul>
							</div><!-- .columns -->
						</div><!-- .row -->
						</div>
					</div><!-- footer-top -->

					<div id="bottom-footer" class="row">
						<div class="col-sm-12 text-center">
							
							<a href="<?php echo home_url(); ?>">
								<?php
									if ( get_option( 'ecclesio_site_logo' ) ) {
										echo '<img id="logo-footer" class="svg" src="' . esc_url( get_option( 'ecclesio_site_logo' ) ) . '">';
									}
									else { }
								?>
							</a>
							<p>
								<i class="fas fa-map-marker-alt" aria-hidden="true"></i> 
								<a href="https://www.google.com/maps/dir//<?php echo get_option( 'ecclesio_church_address' ); ?>" target="_blank">
									<span class="ecclesio-part-address"><?php echo get_customize_partial_church_address(); ?></span>
								</a>
								<br />
								<i class="fas fa-phone" aria-hidden="true"></i> 
								<a href="tel:<?php echo get_option( 'ecclesio_church_phone' ); ?>">
									<span class="ecclesio-part-phone"><?php echo get_customize_partial_church_phone(); ?></span>
								</a>
							</p>
							<p class="source-org copyright">
								&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
								<br>
								Website by <a href="https://eccles.io" target="_blank">Eccles.io</a></p>
							</p>
	    				</div>
					</div> <!-- end #bottom-footer -->

				</footer> <!-- end .footer -->
			</div>  <!-- end .main-content -->
		</div> <!-- end .off-canvas-wrapper -->
		<?php wp_footer(); ?>
	</body>
</html> <!-- end page -->