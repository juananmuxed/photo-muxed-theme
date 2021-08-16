<?php
/**
 * The template for taxonomy series
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Photo_MuXeD
 */

get_header();

$options = get_option('photo_muxed_theme_options');
$reversed = (isset($options['photo_muxed_menu_right'])) ? ' reverse-menu' : '';
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
?>

	<main id="primary" class="site-main<?php echo $reversed ?>">

		<?php
		photo_muxed_get_menu_terms(get_query_var( 'taxonomy' ), 'lateral_menu');
		?>

		<div id="<?php echo (get_query_var( 'taxonomy' ) . '-' . $term->slug ) ?>" class="archive">
			<?php if ( have_posts() ) { ?>

				<h2 class="page-title"><?php echo $term->name ?></h2>
				<div class="archive-description"><?php echo $term->description ?></div>
				
				<div class="grid-masonry">

					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					}
					?>
								
				</div>

				<?php

			} else {

				get_template_part( 'template-parts/content', 'none' );

			}
			?>

		</div>

	</main>

<?php
get_footer();
