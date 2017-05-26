<?php 
function dw_custom_google_map_settings_section_callback() { 

	echo __( 'Configure the display options of the Custom Google Map.', 'dw-custom-google-map' );

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

	?>
	<textarea name="dw_custom_google_map_settings[dw_custom_google_map_address]" cols="50" rows="4"><?php echo wp_strip_all_tags( $options['dw_custom_google_map_address'] ); ?></textarea>
	<p><em><small><?php _e( 'Insert the address for the map here.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Main color setting render
function dw_custom_google_map_main_color_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );

	$val = ( isset( $options['dw_custom_google_map_main_color'] ) ? $options['dw_custom_google_map_main_color'] : '' );

	?>
	<input class="dw-color-picker" name="dw_custom_google_map_settings[dw_custom_google_map_main_color]" type="text" value="<?php echo $val; ?>" />
	<p><em><small><?php _e( 'Set the custom map main color.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Custom map marker render
function dw_custom_google_map_custom_marker_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );

	$val = ( isset( $options['dw_custom_google_map_custom_marker'] ) ? $options['dw_custom_google_map_custom_marker'] : '' );

	?>
    <input class="" id="custom-marker-url" type="text" name="dw_custom_google_map_settings[dw_custom_google_map_custom_marker]" value="<?php echo $val; ?>" />
	<img src="<?php echo $val; ?>" alt="" width="100">

    <input type="button" name="dw_custom_google_map_settings[dw_custom_google_map_custom_marker]" id="upload-custom-marker" class="button-secondary" value="<?php _e( 'Upload Marker', 'dw-custom-google-map' ); ?>" />
	<p><em><small><?php _e( 'Upload a custom map marker. Min <strong>50px</strong> and max <strong>200px</strong>.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}
