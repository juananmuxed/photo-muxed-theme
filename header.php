<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Photo_MuXeD
 */

$options = get_option('photo_muxed_theme_options');
$transition_lightbox = (isset($options['photo_muxed_transition_lightbox'])) ? $options['photo_muxed_transition_lightbox'] : 1000;
$opacity = (isset($options['photo_muxed_overlay_opacity'])) ? $options['photo_muxed_overlay_opacity'] : 1;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<div id="overlay" class="open" data-transition-time="<?php echo $transition_lightbox ?>" data-opacity="<?php echo $opacity ?>">
		<div class="content">
			<div class="prev">
				<span class="dashicons dashicons-arrow-left"></span>
			</div>
			<div class="img-wrapper"></div>
			<div class="next">
				<span class="dashicons dashicons-arrow-right"></span>
			</div>
		</div>
		<div class="close">
			<span class="dashicons dashicons-no-alt"></span>
		</div>
		<div class="background"></div>
	</div>
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			if (has_custom_logo()) {
				the_custom_logo();
			} else {?>
			<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
			<?php }?>
		</div>

		<nav id="site-navigation" class="main-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'header',
					'menu_id'        => 'header-nav-ul',
				)
			);
			?>
		</nav>
	</header>
	<div class="header-spacer"></div>
