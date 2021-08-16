<?php
/**
 * Custom Menu Options
 *
 * @package Photo_MuXeD
 */

function photo_muxed_add_options_menu() {
    add_theme_page(
        __('Theme Options', 'photo-muxed'),
        __('Photo Muxed Theme Options', 'photo-muxed'),
        'edit_theme_options', 
        'photo_muxed_theme_options.php',
        'photo_muxed_options_page'
    );
}
add_action( 'admin_menu', 'photo_muxed_add_options_menu' );

function photo_muxed_options_page() {
    ?>
        <div class="section panel">
            <h1><?php echo __('Photo Muxed Theme Options', 'photo-muxed') ?></h1>
            <form method="post" enctype="multipart/form-data" action="options.php">
                <?php
                settings_fields('photo_muxed_theme_options'); 
                do_settings_sections('photo_muxed_theme_options.php');
                submit_button();
                ?>
            </form>
            <?php echo __('Created by', 'photo-muxed') ?> <a href="https://muxed.es">MuXeD</a>.
        </div>
    <?php
}

function photo_muxed_settings_init() {
    add_settings_section(
        'slider_setting_section',
        __( 'Slider options', 'photo-muxed' ),
        'setting_section_callback',
        'photo_muxed_theme_options.php'
    );

    $timeout_field = array(
        'type'      => 'number',
        'id'        => 'photo_muxed_timeout',
        'name'      => 'photo_muxed_timeout',
        'desc'      => __('Timeout for every slide', 'photo_muxed'),
        'std'       => '',
        'label_for' => 'photo_muxed_timeout',
        'class'     => ''
    );

    add_settings_field(
        'timeout_field',
        __( 'Timeout (ms)', 'photo-muxed' ),
        'setting_markup',
        'photo_muxed_theme_options.php',
        'slider_setting_section',
        $timeout_field
    );

    $transition_time_field = array(
        'type'      => 'number',
        'id'        => 'photo_muxed_transition_time',
        'name'      => 'photo_muxed_transition_time',
        'desc'      => __('Time between photos in slider', 'photo_muxed'),
        'std'       => '',
        'label_for' => 'photo_muxed_transition_time',
        'class'     => ''
    );

    add_settings_field(
        'transition_time_field',
        __( 'Transition time (ms)', 'photo-muxed' ),
        'setting_markup',
        'photo_muxed_theme_options.php',
        'slider_setting_section',
        $transition_time_field
    );

    $controls_field = array(
        'type'      => 'bool',
        'id'        => 'photo_muxed_controls',
        'name'      => 'photo_muxed_controls',
        'desc'      => __('Controls for slider active', 'photo-muxed'),
        'std'       => '',
        'label_for' => 'photo_muxed_controls',
        'class'     => ''
    );

    add_settings_field(
        'controls_field',
        __( 'Controls', 'photo-muxed' ),
        'setting_markup',
        'photo_muxed_theme_options.php',
        'slider_setting_section',
        $controls_field
    );

    add_settings_section(
        'menu_setting_section',
        __( 'Menu options', 'photo-muxed' ),
        'setting_section_callback',
        'photo_muxed_theme_options.php'
    );

    $right_menu = array(
        'type'      => 'bool',
        'id'        => 'photo_muxed_menu_right',
        'name'      => 'photo_muxed_menu_right',
        'desc'      => __('Menu right position', 'photo-muxed'),
        'std'       => '',
        'label_for' => 'photo_muxed_menu_right',
        'class'     => ''
    );

    add_settings_field(
        'menu_right_field',
        __( 'Right menu', 'photo-muxed' ),
        'setting_markup',
        'photo_muxed_theme_options.php',
        'menu_setting_section',
        $right_menu
    );

    $separator_menu = array(
        'type'      => 'text',
        'id'        => 'photo_muxed_separator',
        'name'      => 'photo_muxed_separator',
        'desc'      => __('Separator for lateral menu', 'photo-muxed'),
        'std'       => '',
        'label_for' => 'photo_muxed_separator',
        'class'     => ''
    );

    add_settings_field(
        'separator_field',
        __( 'Separator menu', 'photo-muxed' ),
        'setting_markup',
        'photo_muxed_theme_options.php',
        'menu_setting_section',
        $separator_menu
    );

    add_settings_section(
        'grid_setting_section',
        __( 'Grid options', 'photo-muxed' ),
        'setting_section_callback',
        'photo_muxed_theme_options.php'
    );

    $show_title_grid = array(
        'type'      => 'bool',
        'id'        => 'photo_muxed_show_title_grid',
        'name'      => 'photo_muxed_show_title_grid',
        'desc'      => __('Show title in archive grid', 'photo-muxed'),
        'std'       => '',
        'label_for' => 'photo_muxed_show_title_grid',
        'class'     => ''
    );

    add_settings_field(
        'show_title_field',
        __( 'Show title', 'photo-muxed' ),
        'setting_markup',
        'photo_muxed_theme_options.php',
        'grid_setting_section',
        $show_title_grid
    );

    $show_desc_grid = array(
        'type'      => 'bool',
        'id'        => 'photo_muxed_show_desc_grid',
        'name'      => 'photo_muxed_show_desc_grid',
        'desc'      => __('Show description in archive grid', 'photo-muxed'),
        'std'       => '',
        'label_for' => 'photo_muxed_show_desc_grid',
        'class'     => ''
    );

    add_settings_field(
        'show_desc_field',
        __( 'Show description', 'photo-muxed' ),
        'setting_markup',
        'photo_muxed_theme_options.php',
        'grid_setting_section',
        $show_desc_grid
    );

    $transition_lightbox = array(
        'type'      => 'number',
        'id'        => 'photo_muxed_transition_lightbox',
        'name'      => 'photo_muxed_transition_lightbox',
        'desc'      => __('Transition time in lightbox', 'photo-muxed'),
        'std'       => '',
        'label_for' => 'photo_muxed_transition_lightbox',
        'class'     => ''
    );

    add_settings_field(
        'transition_lightbox_field',
        __( 'Transition time (ms)', 'photo-muxed' ),
        'setting_markup',
        'photo_muxed_theme_options.php',
        'grid_setting_section',
        $transition_lightbox
    );

    $overlay_opacity = array(
        'type'      => 'float',
        'id'        => 'photo_muxed_overlay_opacity',
        'name'      => 'photo_muxed_overlay_opacity',
        'desc'      => __('Opacity for overlay of lightbox', 'photo-muxed'),
        'std'       => '',
        'label_for' => 'photo_muxed_overlay_opacity',
        'class'     => ''
    );

    add_settings_field(
        'overlay_opacity_field',
        __( 'Overlay opacity', 'photo-muxed' ),
        'setting_markup',
        'photo_muxed_theme_options.php',
        'grid_setting_section',
        $overlay_opacity
    );

    register_setting( 'photo_muxed_theme_options', 'photo_muxed_theme_options' );
}
add_action( 'admin_init', 'photo_muxed_settings_init' );

function setting_markup($args) {
    extract( $args );
    $option_name = 'photo_muxed_theme_options';
    $options = get_option( $option_name );
    if( empty($options) ) {
		$options = array(
			'photo_muxed_timeout' => 6000,
			'photo_muxed_transition_time' => 1000,
			'photo_muxed_controls' => false,
			'photo_muxed_menu_right' => false,
            'photo_muxed_separator' => '/',
			'photo_muxed_show_title_grid' => false,
			'photo_muxed_show_desc_grid' => false,
			'photo_muxed_transition_lightbox' => 1000,
		);
	}

    switch ( $type ) {
        case 'number':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text$class' type='number' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
            break;
        case 'text':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
            break;
        case 'bool':
            $check = (isset($options[$id])) ? $options[$id] : false;
            echo "<input class='regular-text$class' type='checkbox' id='$id' value='1' name='" . $option_name . "[$id]' " . checked( 1, $check, false ) . "/>";
            echo ($desc != '') ? "<label class='description' for='" . $option_name . "[$id]'>$desc</label>" : "";
            break;
        case 'float':
            $options[$id] = stripslashes($options[$id]);
            $options[$id] = esc_attr( $options[$id]);
            echo "<input class='regular-text$class' type='number' id='$id' step='0.01' min='0' max='1' name='" . $option_name . "[$id]' value='$options[$id]' />";
            echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
            break;
    }
}

function setting_section_callback($section){
    
}