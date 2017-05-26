<?php
function dw_custom_google_map_validate_settings( $input ) {

	$options = get_option( 'dw_custom_google_map_settings' );
	
	// Create our array for storing the validated options
	$output = array();
	
	// Validate checkbox
	$activate_address = trim( $input['dw_custom_google_map_activate_address'] );
	$output['dw_custom_google_map_activate_address'] = dw_sanitize_checkbox( $activate_address );

	// Validate address field
    $address = trim( $input['dw_custom_google_map_address'] );
    $output['dw_custom_google_map_address'] = wp_strip_all_tags( $address );

	// Validate color picker
	$main_color = trim( $input['dw_custom_google_map_main_color'] );
	$main_color = strip_tags( stripslashes( $main_color ) );
    // Check if is a valid hex color and display error if false
    if ( false === dw_check_color( $main_color ) ) {
        // Set the error message
		add_settings_error( 'dw_custom_google_map_settings', 'dw_color_error', 'Insert a valid color', 'error' );
         
        // Get the previous valid value
        $output['dw_custom_google_map_main_color'] = $options['dw_custom_google_map_main_color'];
    } else {
        $output['dw_custom_google_map_main_color'] = $main_color;
    }

	// Validate custom marker url
    $custom_marker = trim( $input['dw_custom_google_map_custom_marker'] );
    $output['dw_custom_google_map_custom_marker'] = dw_check_uploaded_image( esc_url( $custom_marker ) );

	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'dw_custom_google_map_validate_settings', $output, $input );

}

/**
 * Check if value is a valid HEX color.
 */
function dw_check_color( $color ) { 
     
    if ( preg_match( '/^#[a-f0-9]{6}$/i', $color ) ) {    
        return true;
    }
     
    return false;
}

/**
 * Sanitize checkboxes.
 */
function dw_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Check if the uploaded image have the minimum or maximum sizes.
 */
function dw_check_uploaded_image( $file ) {

	$img = getimagesize( $file );
	
	$minimum = array( 'width' => '50', 'height' => '50');
	$maximum = array( 'width' => '200', 'height' => '200');
	$width   = $img[0];
	$height  = $img[1];

	if ( $file ) {
		if ( $width < $minimum['width'] ) {

			add_settings_error( 'dw_custom_google_map_settings', 'dw_image_error', 'Image dimensions are too small. Minimum width is '. $minimum['width'] .'px. Uploaded image width is '. $width .'px' );

		} elseif ( $height < $minimum['height'] ) {

			add_settings_error( 'dw_custom_google_map_settings', 'dw_image_error', 'Image dimensions are too small. Minimum height is '. $minimum['height'] .'px. Uploaded image width is '. $height .'px' );
			
		} elseif ( $width > $maximum['width'] ) {

			add_settings_error( 'dw_custom_google_map_settings', 'dw_image_error', 'Image dimensions are too big. Maximum width is '. $maximum['width'] .'px. Uploaded image width is '. $width .'px' );

		} elseif ( $height > $maximum['height'] ) {

			add_settings_error( 'dw_custom_google_map_settings', 'dw_image_error', 'Image dimensions are too big. Maximum height is '. $maximum['height'] .'px. Uploaded image width is '. $height .'px' );
			
		} else {
			return $file;
		}
	}
} 
