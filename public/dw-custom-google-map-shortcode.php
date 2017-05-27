<?php
// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Generate the custom google map shortcode with the custom settings.
 */
function dw_custom_google_map_shortcode() {

	// get all plugin settings
	$options = get_option( 'dw_custom_google_map_settings' );

	$activate_address = $options['dw_custom_google_map_activate_address'];
	$address          = esc_textarea( $options['dw_custom_google_map_address'] );
	$latitude         = wp_strip_all_tags( $options['dw_custom_google_map_latitude'] );
	$longitude        = wp_strip_all_tags( $options['dw_custom_google_map_longitude'] );
	$map_zoom         = intval( $options['dw_custom_google_map_zoom'] );
	$custom_marker    = esc_url( $options['dw_custom_google_map_custom_marker'] );
	$main_color       = esc_html( $options['dw_custom_google_map_main_color'] );
	$saturation       = intval( $options['dw_custom_google_map_saturation'] );
	$brightness       = intval( $options['dw_custom_google_map_brightness'] );

	echo '<section id="dw-custom-google-map" class="dw-custom-google-map" data-latitude="'. $latitude .'" data-longitude="'. $longitude .'" data-zoom="'. $map_zoom .'" data-custom-marker="'. $custom_marker .'" data-main-color="'. $main_color .'" data-saturation="'. $saturation .'" data-brightness="'. $brightness .'">';

	echo '<div id="dw-google-container" class="dw-google-container"></div><button id="dw-zoom-in" class="dw-zoom-in main-color">&plus;</button><button id="dw-zoom-out" class="dw-zoom-out main-color">&minus;</button>';

	if ( $activate_address && $address ) {
		echo '<address class="dw-address main-color">'. $address .'</address>';
	}

	echo '</section>';

}
add_shortcode( 'dw-custom-google-map', 'dw_custom_google_map_shortcode' ); 
