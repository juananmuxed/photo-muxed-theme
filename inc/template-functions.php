<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Photo_MuXeD
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function photo_muxed_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'photo_muxed_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function photo_muxed_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'photo_muxed_pingback_header' );

/**
 * Add menu by terms and add id
 */
function photo_muxed_get_menu_terms( $terms, $id ) {
	if(!$terms) $terms = 'category';
	$menus = get_terms(
		array(
			'taxonomy'   => $terms,
			'hide_empty' => false,
		)
	);

	$options = get_option('photo_muxed_theme_options');
	$reversed = (isset($options['photo_muxed_menu_right'])) ? 'reverse' : '';
	$separator = (isset($options['photo_muxed_separator'])) ? $options['photo_muxed_separator'] : '';

	// Check if any term exists
	if ( ! empty( $menus ) && is_array( $menus ) ) {
		?>
			<div id="<?php echo !$id ? 'no-id' : $id ?>" class="<?php echo $terms ?> <?php echo $reversed ?>">
				<ul>
				<?php
				foreach ( $menus as $menu ) { ?>
					<li>
						<?php echo $separator ?> <a href="<?php echo esc_url( get_term_link( $menu ) ) ?>">
							<?php echo $menu->name; ?>
						</a>
					</li>
					<?php
				}
				?>
				</ul>
			</div>
		<?php
	} else {
		?>
			<div class="empty-series"><?php esc_html_e('No term configured.', 'photo-muxed') ?></div>
		<?php
	}
}

function photo_muxed_get_slider_home() {
	$options = get_option('photo_muxed_theme_options');
	if( empty($options) ) {
		$options = array(
			'photo_muxed_timeout' => 6000,
			'photo_muxed_transition_time' => 1000,
			'photo_muxed_controls' => false
		);
	}

	$slides = get_posts(
		array(
			'posts_per_page'	=> -1,
			'post_type'=> 'slide'
		)
	);
	
	$inactives = 0;
	$c_slides = count($slides);
	
	if ( !empty( $slides ) && is_array( $slides ) ) {
		$timeout = $options['photo_muxed_timeout'];
		$output = '<div class="background-slider" data-timeout="' . $timeout . '">';
		foreach ( $slides as $key=>$slide ) {
			$meta_content = get_post_meta($slide->ID);
			$thumbID = get_post_thumbnail_id( $slide->ID );
			$image = wp_get_attachment_image_src( $thumbID, 'full' );
			$transitionTime = $options['photo_muxed_transition_time'];
			
			if( !$thumbID || $meta_content['home-inactive'][0] == 'yes' ) {
				$inactives += 1;
			} else {
				$current = $key === 0 ? ' current' : '';
				$output .= '<div class="slide' . $current . '" style="background-image: url(' . $image[0] . '); transition: opacity ' . $transitionTime / 1000 . 's ease-in-out;">';
				if( $meta_content['see-title'][0] == 'yes' || $meta_content['see-description'][0] == 'yes' ) {
					$output .= '<div class="content" style="transition: opacity ' . $transitionTime . 's ease-in-out">';
					if( $meta_content['see-title'][0] == 'yes' ) $output .= '<h2>' . $slide->post_title . '</h2>';
					if( $meta_content['see-description'][0] == 'yes' ) $output .= '<p>' . $slide->post_content . '</p>';
					$output .= '</div>';
				}
				$output .= '</div>';
			}
		}
		$output .= '</div>';
		
		if(isset($options['photo_muxed_controls'])) {
			$output .= '<div class="buttons-slider">';
				$output .= '<div class="left">';
					$output .= '<span class="dashicons dashicons-arrow-left"></span>';
				$output .= '</div>';
				$output .= '<div class="right">';
					$output .= '<span class="dashicons dashicons-arrow-right"></span>';
				$output .= '</div>';
			$output .= '</div>';
		} 

		if($c_slides == $inactives) $output = '<div class="empty-slides">' . __('All slides are without images or inactives', 'photo-muxed') . '</div>';

		echo $output;
	} else {
		echo '<div class="empty-slides">' . __('No slides configured', 'photo-muxed') . '</div>';
	}
}