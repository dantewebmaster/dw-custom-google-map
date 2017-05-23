<?php
/**
 * Plugin Name: DW Custom Google Map
 * Plugin URI: https://dantewebmaster.com/plugins/dw-custom-google-map
 * Description:
 * Version: 1.0
 * Author: Dante Webmaster
 * Author URI: https://dantewebmaster.com/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: dw-custom-google-map
 * Domain Path: /languages
 */

// If this file is called directly, abort.
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
	
	// enqueue the scripts
	wp_enqueue_script( 'dw-google-maps-api', "https://maps.googleapis.com/maps/api/js?key=$api_key", array(), false, true );
	
	wp_enqueue_script( 'dw-custom-google-map-public-scripts', plugin_dir_url( __FILE__ ) . 'public/js/dw-public-scripts.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'dw_custom_google_map_public_scripts' );

/**
 * Creates a shortcode to display the map.
 */
function dw_custom_google_map_shortcode() {

	// get all plugin settings
	$options = get_option( 'dw_custom_google_map_settings' );

	$address       = 'Avenida Eudes Scherrer Souza, nº 1.025, Sala 602 Centro Empresarial da Serra, Pq. Residencial de Laranjeiras. Serra - Espírito Santo - Brasil / CEP 29166-865';
	$latitude      = '-20.195007';
	$longitude     = '-40.254891';
	$map_zoom      = 15;
	$custom_marker = esc_url( 'http://victa.nambbu.com.br/wp-content/uploads/2017/05/map-marker-victa.png' );
	$main_color    = '#a8ce3b';
	$saturation    = 0;
	$brightness    = 0;

	echo '<section id="dw-custom-google-map" class="dw-custom-google-map" data-latitude="'. $latitude .'" data-longitude="'. $longitude .'" data-zoom="'. $map_zoom .'" data-custom-marker="'. $custom_marker .'" data-main-color="'. $main_color .'" data-saturation="'. $saturation .'" data-brightness="'. $brightness .'">
			<div id="dw-google-container" class="dw-google-container"></div>
			<button id="dw-zoom-in" class="dw-zoom-in">&plus;</button>
			<button id="dw-zoom-out" class="dw-zoom-out">&minus;</button>
			<address class="dw-address">'. $address .'</address>
		  </section>';

}
add_shortcode( 'dw-custom-google-map', 'dw_custom_google_map_shortcode' );

/**
 * Create options page on admin.
 */
include "admin/dw-settings-page.php";
