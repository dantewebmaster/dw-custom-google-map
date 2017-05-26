<?php 
function dw_custom_google_map_settings_section_callback() { 
	// Display the options section description
	echo __( 'Configure the display options of the Custom Google Map.', 'dw-custom-google-map' );

}

// Map latitude setting render
function dw_custom_google_map_latitude() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	$val = ( isset( $options['dw_custom_google_map_latitude'] ) ? $options['dw_custom_google_map_latitude'] : '' );

	?>
	<input name="dw_custom_google_map_settings[dw_custom_google_map_main_color]" type="text" value="<?php echo $val; ?>" />
	<p><em><small><?php _e( 'Set the custom map main color.', 'dw-custom-google-map' ); ?><small></em></p>
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
	<textarea name="dw_custom_google_map_settings[dw_custom_google_map_address]" cols="50" rows="4" placeholder="<?php _e( 'Map address', 'dw-custom-google-map' ); ?>"><?php echo wp_strip_all_tags( $val ); ?></textarea>
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
    <input id="custom-marker-url" type="text" name="dw_custom_google_map_settings[dw_custom_google_map_custom_marker]" value="<?php echo $val; ?>" placeholder="<?php _e( 'Image url', 'dw-custom-google-map' ); ?>" />

    <input type="button" name="dw_custom_google_map_settings[dw_custom_google_map_custom_marker]" id="upload-custom-marker" class="button-secondary" value="<?php _e( 'Upload Marker', 'dw-custom-google-map' ); ?>" />
	
	<?php if ( $val ) {
		echo '<img src="'. $val .'" alt="" width="40">';
	} ?>
	
	<p><em><small><?php _e( 'Upload a custom map marker. Min <strong>50px</strong> and max <strong>200px</strong>.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}
