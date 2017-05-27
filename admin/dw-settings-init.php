<?php
// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Initialize the settings fields using WP Settings API.
 */
function dw_custom_google_map_settings_init() {
	// Register the settings group
	register_setting( 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings',
		'dw_custom_google_map_validate_settings'
	);

	// Generate the settings section
	add_settings_section(
		'dw_custom_google_map_settings_group_section', 
		__( 'DW Custom Google Map Display Settings', 'dw-custom-google-map' ), 
		'dw_custom_google_map_settings_section_callback', 
		'dw_custom_google_map_settings_group'
	);

	// Map address latitude 
	add_settings_field( 
		'dw_custom_google_map_latitude', 
		__( 'Map Address Latitude', 'dw-custom-google-map' ), 
		'dw_custom_google_map_latitude_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-latitude' )
	);

	// Map address longitude 
	add_settings_field( 
		'dw_custom_google_map_longitude', 
		__( 'Map Address Longitude', 'dw-custom-google-map' ), 
		'dw_custom_google_map_longitude_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-longitude' )
	);

	// Option to set map zoom level 
	add_settings_field( 
		'dw_custom_google_map_zoom',
		__( 'Map Zoom Level', 'dw-custom-google-map' ), 
		'dw_custom_google_map_zoom_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-zoom' )
	);

	// Checkbox to activate/deactivate the address box 
	add_settings_field( 
		'dw_custom_google_map_activate_address', 
		__( 'Activate the Address Box', 'dw-custom-google-map' ), 
		'dw_custom_google_map_activate_address_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-activate-address' )
	);

	// Textarea for address
	add_settings_field( 
		'dw_custom_google_map_address', 
		__( 'Map Address', 'dw-custom-google-map' ), 
		'dw_custom_google_map_address_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-address' )
	);

	// Option to set map main color 
	add_settings_field( 
		'dw_custom_google_map_main_color', 
		__( 'Map Main Color', 'dw-custom-google-map' ), 
		'dw_custom_google_map_main_color_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-main-color' )
	);

	// Option to set map main color saturation 
	add_settings_field( 
		'dw_custom_google_map_saturation',
		__( 'Main Color Saturation', 'dw-custom-google-map' ), 
		'dw_custom_google_map_saturation_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-saturation' )
	);

	// Option to set map main color brightness 
	add_settings_field( 
		'dw_custom_google_map_brightness',
		__( 'Main Color Brightness', 'dw-custom-google-map' ), 
		'dw_custom_google_map_brightness_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-brightness' )
	);

	// Media uploader to send custom marker 
	add_settings_field( 
		'dw_custom_google_map_custom_marker', 
		__( 'Custom Map Marker', 'dw-custom-google-map' ), 
		'dw_custom_google_map_custom_marker_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-custom-marker' )
	);
}
add_action( 'admin_init', 'dw_custom_google_map_settings_init' );
