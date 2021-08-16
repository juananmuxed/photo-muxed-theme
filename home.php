<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photo_MuXeD
 */

get_header();

photo_muxed_get_slider_home();

$options = get_option('photo_muxed_theme_options');
$reversed = (isset($options['photo_muxed_menu_right'])) ? ' reverse-menu' : '';

?>

	<main id="primary" class="site-main<?php echo $reversed ?>">

		<?php 
			photo_muxed_get_menu_terms('series', 'lateral_menu');
		?>
		
	</main>

<?php get_footer();