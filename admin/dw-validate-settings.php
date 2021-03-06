<?php
// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Validate all settings inputs and output if valid.
 */
function dw_custom_google_map_validate_settings( $input ) {
	// Get all plugin saved settings
	$options = get_option( 'dw_custom_google_map_settings' );
	
	// Create our array for storing the validated options
	$output = array();

	// Validate latitude field
    $latitude = trim( $input['dw_custom_google_map_latitude'] );
    $output['dw_custom_google_map_latitude'] = wp_strip_all_tags( $latitude );
	
	// Validate longitude field
    $longitude = trim( $input['dw_custom_google_map_longitude'] );
    $output['dw_custom_google_map_longitude'] = wp_strip_all_tags( $longitude );

	// Validate map zoom level field
    $zoom_level = trim( $input['dw_custom_google_map_zoom'] );
    $output['dw_custom_google_map_zoom'] = intval( $zoom_level );

	// Validate checkbox
	$activate_address = trim( $input['dw_custom_google_map_activate_address'] );
	$output['dw_custom_google_map_activate_address'] = dw_sanitize_checkbox( $activate_address );

	// Validate address field
    $address = trim( $input['dw_custom_google_map_address'] );
    $output['dw_custom_google_map_address'] = esc_textarea( $address );

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

	// Validate main color saturation field
    $saturation = trim( $input['dw_custom_google_map_saturation'] );
    $output['dw_custom_google_map_saturation'] = intval( $saturation );

	// Validate main color brightness field
    $brightness = trim( $input['dw_custom_google_map_brightness'] );
    $output['dw_custom_google_map_brightness'] = intval( $brightness );

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
