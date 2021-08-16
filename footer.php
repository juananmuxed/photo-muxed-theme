<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photo_MuXeD
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
				<?php
				printf( esc_html__( 'Design with ❤️ by %1$s', 'photo-muxed' ), '<a href="https://muxed.es/" target="_blank">MuXeD</a>' );
				?>
		</div><!-- .site-info -->
		<nav id="site-navigation" class="footer-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-nav-ul',
				)
			);
			?>
		</nav>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
