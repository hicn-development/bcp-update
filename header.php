<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BCP_BLOG
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bcp' ); ?></a>

	<header id="masthead" class="site-header">

		<!-- Custom Code -->
		<div class="container group">
			<div class="container-inner">
				<div class="group pad central-header-zone">
					<div class="logo-tagline-group">
						<p class="site-title">
							<a class="custom-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
								<?php 
									if(get_header_image() !== ''){
								?>
								<img src="<?php echo get_header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
								<?php

									} else {
										bloginfo( 'name' ); 
									}
								?>			
							</a>
						</p>
						<p class="site-description">
							<?php echo bloginfo( 'name' ); ?> | <?php echo get_bloginfo( 'description', 'display' ); ?>
						</p>
					</div>
				</div>
				<nav class="nav-container group desktop-menu" id="nav-header">
					<nav class="nav-text"></nav>
				<div class="nav-wrap container">
					<?php
	                    wp_nav_menu( array(
	                        'menu'              => 'Nav Header',
	                        'theme_location'    => 'menu-3',
	                        'depth'             => 2,
	                        'container'         => false,
	                        'menu_class'        => 'nav container-inner group',
	                        'walker'            => new Bcp_Walker_Nav_Menu())
	                    );
	                ?>
				</div>
			</nav>
			</div>
		</div>
		<!-- EOF Custom Code -->
	</header><!-- #masthead -->
<div id="on_page_first" class="container_first">
	<div id="on_page_second" class="container_second">
	<div id="content" class="site-content">
		<div class="main-inner group">
