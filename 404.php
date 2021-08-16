<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Photo_MuXeD
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<h1 class="page-title"><?php esc_html_e( 'Page not found', 'photo-muxed' ); ?></h1>

			<div class="page-content">

				<div class="not-found">404</div>

				<div class="go-home">
					<a href="/" class="home"><?php esc_html_e( 'Back to home', 'photo-muxed' ); ?></a>
				</div>

			</div>
		</section>

	</main>

<?php
get_footer();
