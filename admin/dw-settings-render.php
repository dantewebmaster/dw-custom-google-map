<?php
// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}

function dw_custom_google_map_settings_section_callback() { 
	// Display the options section description
	echo __( 'Configure the display options of the Custom Google Map.', 'dw-custom-google-map' );
}

// Map latitude setting render
function dw_custom_google_map_latitude_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_latitude'] ) ? $options['dw_custom_google_map_latitude'] : '' );

	?>
	<input class="regular-text" name="dw_custom_google_map_settings[dw_custom_google_map_latitude]" type="text" value="<?php echo $val; ?>" placeholder="<?php _e( 'Address latitude, e.g: -12.345678', 'dw-custom-google-map' ) ?>" />
	<p><em><small><?php _e( 'Place the address latitude here.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Map longitude setting render
function dw_custom_google_map_longitude_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_longitude'] ) ? $options['dw_custom_google_map_longitude'] : '' );

	?>
	<input class="regular-text" name="dw_custom_google_map_settings[dw_custom_google_map_longitude]" type="text" value="<?php echo $val; ?>" placeholder="<?php _e( 'Address longitude, e.g: -87.654321', 'dw-custom-google-map' ) ?>" />
	<p><em><small><?php _e( 'Place the address longitude here.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Map zoom level setting render
function dw_custom_google_map_zoom_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_zoom'] ) ? $options['dw_custom_google_map_zoom'] : 15 );

	?>
	<input name="dw_custom_google_map_settings[dw_custom_google_map_zoom]" type="number" min="3" max="22" step="1" value="<?php echo intval( $val ); ?>" />
	<p><em><small><?php _e( 'Set the zoom level for the map.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Setting to activate the address box render
function dw_custom_google_map_activate_address_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_activate_address'] ) ? $options['dw_custom_google_map_activate_address'] : '' );	

	?>
	<label>
		<input id="activate-address" type="checkbox" name="dw_custom_google_map_settings[dw_custom_google_map_activate_address]" value="1" <?php checked( $val, 1 ); ?> />
		<p><em><small><?php _e( 'Check to show the address box on the map.', 'dw-custom-google-map' ); ?><small></em></p>
	</label>
	<?php
}

// Address setting render
function dw_custom_google_map_address_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_address'] ) ? $options['dw_custom_google_map_address'] : '' );

	?>
	<textarea name="dw_custom_google_map_settings[dw_custom_google_map_address]" cols="50" rows="2" placeholder="<?php _e( 'Map complete address', 'dw-custom-google-map' ); ?>"><?php echo esc_textarea( $val ); ?></textarea>
	<p><em><small><?php _e( 'Insert the address for the map here.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Main color setting render
function dw_custom_google_map_main_color_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_main_color'] ) ? $options['dw_custom_google_map_main_color'] : '' );

	?>
	<input class="dw-color-picker" name="dw_custom_google_map_settings[dw_custom_google_map_main_color]" type="text" value="<?php echo esc_html( $val ); ?>" />
	<p><em><small><?php _e( 'Set the custom map main color.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Main color saturation setting render
function dw_custom_google_map_saturation_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_saturation'] ) ? $options['dw_custom_google_map_saturation'] : 0 );

	?>
	<input name="dw_custom_google_map_settings[dw_custom_google_map_saturation]" type="number" min="-100" max="100" step="1" value="<?php echo intval( $val ); ?>" />
	<p><em><small><?php _e( 'Set the saturation for the main color.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Main color brightness setting render
function dw_custom_google_map_brightness_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_brightness'] ) ? $options['dw_custom_google_map_brightness'] : 0 );

	?>
	<input name="dw_custom_google_map_settings[dw_custom_google_map_brightness]" type="number" min="-100" max="100" step="1" value="<?php echo intval( $val ); ?>" />
	<p><em><small><?php _e( 'Set the brightness for the main color.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Custom map marker render
function dw_custom_google_map_custom_marker_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_custom_marker'] ) ? $options['dw_custom_google_map_custom_marker'] : '' );

	?>
    <input id="custom-marker-url" type="text" name="dw_custom_google_map_settings[dw_custom_google_map_custom_marker]" value="<?php echo $val; ?>" placeholder="<?php _e( 'Marker image url', 'dw-custom-google-map' ); ?>" />

    <input type="button" name="dw_custom_google_map_settings[dw_custom_google_map_custom_marker]" id="upload-custom-marker" class="button-secondary" value="<?php _e( 'Upload Marker', 'dw-custom-google-map' ); ?>" />
	
	<?php if ( $val ) {
		echo '<img src="'. $val .'" alt="" width="40">';
	} ?>
	
	<p><em><small><?php _e( 'Select a custom marker. Min <strong>50px</strong> and max <strong>200px</strong>.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}
