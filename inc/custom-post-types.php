<?php
/**
 * Custom post Types
 *
 * @package Photo_MuXeD
 */
 
function custom_post_types() {
 
    // Set UI labels for Custom Post Type
    $labels_photos = array(
        'name'                => _x( 'Photos', 'Post Type General Name', 'photo-muxed' ),
        'singular_name'       => _x( 'Photo', 'Post Type Singular Name', 'photo-muxed' ),
        'menu_name'           => __( 'Photos', 'photo-muxed' ),
        'parent_item_colon'   => __( 'Parent Photo', 'photo-muxed' ),
        'all_items'           => __( 'All Photos', 'photo-muxed' ),
        'view_item'           => __( 'View Photo', 'photo-muxed' ),
        'add_new_item'        => __( 'Add New Photo', 'photo-muxed' ),
        'add_new'             => __( 'Add New', 'photo-muxed' ),
        'edit_item'           => __( 'Edit Photo', 'photo-muxed' ),
        'update_item'         => __( 'Update Photo', 'photo-muxed' ),
        'search_items'        => __( 'Search Photo', 'photo-muxed' ),
        'not_found'           => __( 'Not Found', 'photo-muxed' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'photo-muxed' ),
    );
     
    // Set other options for Custom Post Type
     
    $args_photos = array(
        'label'               => __( 'Photos', 'photo-muxed' ),
        'description'         => __( 'Series of Media photos', 'photo-muxed' ),
        'labels'              => $labels_photos,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-images-alt2', 
        'menu_position'       => 32,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );

    $labels_slider =  array(
        'name'                => _x( 'Sliders', 'Post Type General Name', 'photo-muxed' ),
        'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'photo-muxed' ),
        'menu_name'           => __( 'Slider Home', 'photo-muxed' ),
        'parent_item_colon'   => __( 'Parent Slide', 'photo-muxed' ),
        'all_items'           => __( 'All Slides', 'photo-muxed' ),
        'view_item'           => __( 'View Slide', 'photo-muxed' ),
        'add_new_item'        => __( 'Add New Slide', 'photo-muxed' ),
        'add_new'             => __( 'Add New', 'photo-muxed' ),
        'edit_item'           => __( 'Edit Slide', 'photo-muxed' ),
        'update_item'         => __( 'Update Slide', 'photo-muxed' ),
        'search_items'        => __( 'Search Slide', 'photo-muxed' ),
        'not_found'           => __( 'Not Found', 'photo-muxed' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'photo-muxed' ),
    );

    $args_slides = array(
        'label'               => __( 'Slides', 'photo-muxed' ),
        'description'         => __( 'Series of Media slides', 'photo-muxed' ),
        'labels'              => $labels_slider,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_icon'           => 'dashicons-slides', 
        'menu_position'       => 31,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
     
    // Registering your Custom Post Type
    register_post_type( 'slide', $args_slides );
    register_post_type( 'photo', $args_photos );

    // Setup the labels
    $labels_series = array(
        'name'                => _x( 'Series', 'Post Type General Name', 'photo-muxed' ),
        'singular_name'       => _x( 'Serie', 'Post Type Singular Name', 'photo-muxed' ),
        'menu_name'           => __( 'Series', 'photo-muxed' ),
        'parent_item_colon'   => __( 'Parent Series', 'photo-muxed' ),
        'all_items'           => __( 'All Series', 'photo-muxed' ),
        'view_item'           => __( 'View Series', 'photo-muxed' ),
        'add_new_item'        => __( 'Add New Series', 'photo-muxed' ),
        'add_new'             => __( 'Add New', 'photo-muxed' ),
        'edit_item'           => __( 'Edit Series', 'photo-muxed' ),
        'update_item'         => __( 'Update Series', 'photo-muxed' ),
        'search_items'        => __( 'Search Series', 'photo-muxed' ),
        'not_found'           => __( 'Not Found', 'photo-muxed' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'photo-muxed' ),
    );
    
    // Register the taxonomy
    register_taxonomy( 'series', array( 'photo' ), array(
        'hierarchical'       => true,
        'labels'             => $labels_series,
        'show_ui'            => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'series' ),
    ));
 
}
 
add_action( 'init', 'custom_post_types', 0 );