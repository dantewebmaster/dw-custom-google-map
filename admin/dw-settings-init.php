<?php
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
