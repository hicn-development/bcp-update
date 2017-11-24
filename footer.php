<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BCP_BLOG
 */

?>
			</div><!-- .main-inner -->
		</div><!-- #content -->
	</div><!-- #on_page_first -->
</div><!-- #on_page_second -->

	<footer id="colophon" class="site-footer">
		<section class="footer-container" id="footer-widgets">
			<div class="container-inner">
				<div class="pad group">
					<div class="footer-widget-1 grid one-third ">
						<?php 
							if ( is_active_sidebar( 'sidebar-footer-widget-1' ) ) {
								dynamic_sidebar( 'sidebar-footer-widget-1' );
							}
						?>
					</div>
					<div class="footer-widget-2 grid one-third ">
						<?php 
							if ( is_active_sidebar( 'sidebar-footer-widget-2' ) ) {
								dynamic_sidebar( 'sidebar-footer-widget-2' );
							}
						?>
					</div>
					<div class="footer-widget-3 grid one-third last">
						<?php 
							if ( is_active_sidebar( 'sidebar-footer-widget-3' ) ) {
								dynamic_sidebar( 'sidebar-footer-widget-3' );
							}
						?>
					</div>
				</div>
			</div>
		</section>
		<nav class="nav-container group" id="nav-footer">
			<div class="nav-wrap">
				<?php
                    wp_nav_menu( array(
                        'menu'              => 'Header Nav',
                        'theme_location'    => 'menu-2',
                        'depth'             => 2,
                        'container'         => false,
                        'menu_class'        => 'nav container group',
                        'walker'            => new Bcp_Walker_Nav_Menu())
                    );
                ?>
			</div>
		</nav>
		<section class="footer-container" id="footer-bottom">
			<div class="container-inner">
				<a id="back-to-top" href="#"><i class="fa fa-angle-up"></i></a>
				<div class="pad group">
					<div class="grid one-half">
						<div id="copyright">
							<p>
								<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bcp' ) ); ?>"><?php
									/* translators: %s: CMS name, i.e. WordPress. */
									printf( esc_html__( 'Proudly powered by %s', 'bcp' ), 'WordPress' );
								?></a>
								<span class="sep"> | </span>
								<?php
									/* translators: 1: Theme name, 2: Theme author. */
									printf( esc_html__( 'Theme: %1$s by %2$s.', 'bcp' ), 'bcp', '<a href="http://habibimroncn.github.io">habibimroncn</a>' );
								?>
							</p>
						</div>
					</div>
					<div class="grid one-half last">
						
					</div>
				</div>
			</div>
		</section>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
