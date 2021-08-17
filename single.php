<?php
/**
 * The template archive single page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Photo_MuXeD
 */

get_header();

$options = get_option('photo_muxed_theme_options');
$reversed = (isset($options['photo_muxed_menu_right'])) ? ' reverse-menu' : '';
?>

	<main id="primary" class="site-main<?php echo $reversed ?>">

		<?php
		photo_muxed_get_menu_terms('serie', 'lateral_menu');

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile;
		?>

	</main>

<?php
get_footer();
