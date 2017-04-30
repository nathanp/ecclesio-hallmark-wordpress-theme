				<footer class="footer" role="contentinfo">
					<div class="footer-top">
						<div class="row">
							<div class="large-4 medium-5 small-12 columns">
								<h5> <i class="fa fa-clock-o" aria-hidden="true"></i> Sunday Service Times</h5>
								<p>
									Bible Study: 9:30am | Worship: 10:30am
								</p>
							</div><!-- .columns -->
							<div class="large-4 medium-3 small-12 columns text-center">
								<a href="<?php echo get_permalink('18'); ?>" class="button outline-white">Contact Us</a>
							</div><!-- .columns -->
							<div class="large-4 medium-4 small-12 columns social">
								<ul class="inline-menu">
									<?php
									if(get_customize_social_fb()) {
										echo '<li>
												<a href="'.get_customize_social_fb().'" target="_blank">
													<i class="fa fa-facebook" aria-hidden="true"></i>
												</a>
											</li>';
									}
									if(get_customize_social_insta()) {
										echo '<li>
												<a href="'.get_customize_social_insta().'" target="_blank">
													<i class="fa fa-instagram" aria-hidden="true"></i>
												</a>
											</li>';
									}
									if(get_customize_social_twitter()) {
										echo '<li>
												<a href="'.get_customize_social_twitter().'" target="_blank">
													<i class="fa fa-twitter" aria-hidden="true"></i>
												</a>
											</li>';
									}
									if(get_customize_social_itunes()) {
										echo '<li>
											<a href="'.get_customize_social_itunes().'" target="_blank">
												<i class="fa fa-podcast" aria-hidden="true"></i>
											</a>
										</li>';
									}
									?>
								</ul>
							</div><!-- .columns -->
						</div><!-- .row -->
					</div><!-- footer-top -->

					<div id="bottom-footer" class="row">
						<div class="small-12 columns text-center">
							
							<a href="<?php echo home_url(); ?>">
								<img id="logo-footer" class="svg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="">
							</a>
							<p>
								<i class="fa fa-map-marker" aria-hidden="true"></i> 
								<a href="https://www.google.com/maps/dir//<?php echo get_option( 'ecclesio_church_address' ); ?>" target="_blank">
									<span class="ecclesio-part-address"><?php echo get_customize_partial_church_address(); ?></span>
								</a>
								<br />
								<i class="fa fa-phone" aria-hidden="true"></i> 
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