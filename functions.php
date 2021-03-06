<?php
/**
 * Photo MuXeD functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Photo_MuXeD
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'photo_muxed_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function photo_muxed_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Photo MuXeD, use a find and replace
		 * to change 'photo-muxed' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'photo-muxed', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'header' => esc_html__( 'Top Menu', 'photo-muxed' ),
				'footer' => esc_html__( 'Footer Menu', 'photo-muxed' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'photo_muxed_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'photo_muxed_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function photo_muxed_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'photo_muxed_content_width', 640 );
}
add_action( 'after_setup_theme', 'photo_muxed_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function photo_muxed_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'photo-muxed' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'photo-muxed' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'photo_muxed_widgets_init' );

/**
 * Enqueue scripts and styles.
 */


function photo_muxed_scripts() {
	$enviorement_folder = '/dist/';
	$minify = '.min';
	$enviorement_type = wp_get_environment_type();
	if($enviorement_type == 'local' || $enviorement_type == 'development') {
		$enviorement_folder = '/dev/';
		$minify = '';
	};
	wp_enqueue_style( 'photo-muxed-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'photo-muxed-bundle', get_template_directory_uri() . $enviorement_folder . 'css/bundle' . $minify . '.css', array(), _S_VERSION );

	wp_enqueue_script( 'photo-muxed-common', get_template_directory_uri() . $enviorement_folder . 'js/common' . $minify . '.js', array(), _S_VERSION, true );
	
	if( is_front_page() && is_home() ) {
		wp_enqueue_script( 'photo-muxed-home', get_template_directory_uri() . $enviorement_folder . 'js/home' . $minify . '.js', array(), _S_VERSION, true );
	}

	if( is_archive() ) {
		wp_enqueue_script( 'photo-muxed-home', get_template_directory_uri() . $enviorement_folder . 'js/archives' . $minify . '.js', array(), _S_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'photo_muxed_scripts' );

/**
 * Add menu settings
 */
require get_template_directory() . '/inc/custom-menu-page.php';

/**
 * Add Custom Post Types for Series and Slides
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Add Custom Meta Boxes
 */
require get_template_directory() . '/inc/custom-meta-boxes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Disable Gutenberg
 */
add_filter('use_block_editor_for_post', '__return_false', 10);
