<?php
/**
 * Custom Meta Boxes
 *
 * @package Photo_MuXeD
 */

function photo_muxed_add_meta_boxes() {
    add_meta_box(
        'slide-metaboxes',
        __('Slides Custom Fields', 'photo-muxed'),
        'slide_callback',
        'slide'
    );
}
add_action( 'add_meta_boxes', 'photo_muxed_add_meta_boxes' );

/**
 * Callback slides
 */

function slide_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'slide_nonce' );
    $stored_meta = get_post_meta( $post->ID );
	
	?>
        <p>
            <div class="photo-muxed-row-content">
                <label for="home-inactive">
                    <input type="checkbox" name="home-inactive" id="home-inactive" value="yes" <?php if ( isset ( $stored_meta['home-inactive'] ) ) checked( $stored_meta['home-inactive'][0], 'yes' ); ?> />
                    <?php _e( 'Inactive in Home', 'photo-muxed' )?>
                </label>
            </div>
            
            <div class="photo-muxed-row-content">
                <label for="see-title">
                    <input type="checkbox" name="see-title" id="see-title" value="yes" <?php if ( isset ( $stored_meta['see-title'] ) ) checked( $stored_meta['see-title'][0], 'yes' ); ?> />
                    <?php _e( 'See title', 'photo-muxed' )?>
                </label>
            </div>

            <div class="photo-muxed-row-content">
                <label for="see-description">
                    <input type="checkbox" name="see-description" id="see-description" value="yes" <?php if ( isset ( $stored_meta['see-description'] ) ) checked( $stored_meta['see-description'][0], 'yes' ); ?> />
                    <?php _e( 'See description', 'photo-muxed' )?>
                </label>
            </div>
        </p> 
    <?php
}

/**
 * Saves the custom meta input
 */
function slides_meta_saves( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'slide_nonce' ] ) && wp_verify_nonce( $_POST[ 'slide_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    if( isset( $_POST[ 'home-inactive' ] ) ) {
        update_post_meta( $post_id, 'home-inactive', 'yes' );
    } else {
        update_post_meta( $post_id, 'home-inactive', 'no' );
    }
    if( isset( $_POST[ 'see-title' ] ) ) {
        update_post_meta( $post_id, 'see-title', 'yes' );
    } else {
        update_post_meta( $post_id, 'see-title', 'no' );
    }
    if( isset( $_POST[ 'see-description' ] ) ) {
        update_post_meta( $post_id, 'see-description', 'yes' );
    } else {
        update_post_meta( $post_id, 'see-description', 'no' );
    }
}
add_action( 'save_post', 'slides_meta_saves' );