<?php
/**
 * Plugin Name: DW Custom Google Map
 * Plugin URI: https://dantewebmaster.com/plugins/dw-custom-google-map
 * Description: With the Custom Google Map plugin you can create a better customized map with color, saturation, brightness, custom map marker, zoom and more.
 * Version: 1.0
 * Author: Dante Webmaster
 * Author URI: https://dantewebmaster.com/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: dw-custom-google-map
 * Domain Path: /languages
 */

// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Load the plugin text domain for translation.
 */
function dw_custom_google_map_load_textdomain() {

	load_plugin_textdomain(
		'dw-custom-google-map',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages'
	);

}
add_action( 'plugins_loaded', 'dw_custom_google_map_load_textdomain' );

/**
 * Enqueue the public scripts.
 */
function dw_custom_google_map_public_scripts() {
	// google maps api key
	$api_key =  'AIzaSyD4pK30HoIhAond9uN-fJejBfg4ZIKXWfY';
	
	// renqueue styles
	wp_enqueue_style( 'dw-custom-google-map-public-styles', plugin_dir_url( __FILE__ ) . 'public/css/dw-public-styles.css' );
	
	// add custom css
	$options = get_option( 'dw_custom_google_map_settings' );
	$main_color = esc_html( $options['dw_custom_google_map_main_color'] );
	$inline_css = "
		.main-color {
			background: $main_color;
		}
	";
	if ( $main_color ) {
		wp_add_inline_style( 'dw-custom-google-map-public-styles', $inline_css );
	}
	
	// enqueue the scripts
	wp_enqueue_script( 'dw-google-maps-api', "https://maps.googleapis.com/maps/api/js?key=$api_key", array(), false, true );
	
	wp_enqueue_script( 'dw-custom-google-map-public-scripts', plugin_dir_url( __FILE__ ) . 'public/js/dw-public-scripts.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'dw_custom_google_map_public_scripts' );

/**
 * Creates a shortcode to display the map.
 */
require "public/dw-custom-google-map-shortcode.php";

/**
 * Create options page on admin.
 */
require "admin/dw-settings-page.php";
