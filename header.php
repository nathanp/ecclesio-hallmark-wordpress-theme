<!doctype html>
  <html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">

		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta class="foundation-mq">

		<!-- If Site Icon isn't set in customizer -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
			<!-- Icons & Favicons -->
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png" rel="apple-touch-icon" />
			<!--[if IE]>
				<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			<![endif]-->
			<meta name="msapplication-TileColor" content="<?php echo $color_main; ?>">
			<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">

	    <?php } ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

		<?php $color_main = get_theme_mod( 'ecclesio_color_main', '#358fcd' ); ?>
		<!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="<?php echo $color_main; ?>">
	</head>
	<body <?php body_class(); ?>>
		<div class="off-canvas-wrapper">
			<?php get_template_part( 'parts/content', 'offcanvas' ); ?>
			<div class="off-canvas-content" data-off-canvas-content>
				<header class="header" role="banner">
					 <?php get_template_part( 'parts/nav', 'offcanvas-topbar' ); ?>
				</header> <!-- end .header -->