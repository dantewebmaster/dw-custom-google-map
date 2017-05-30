<?php
// If this file is called directly, abort
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Enqueue the admin scripts.
 */
function dw_custom_google_map_admin_scripts() {

	if ( is_admin() ) {
		// Add the custom css to admin
		wp_enqueue_style( 'dw-custom-google-map-admin-styles', plugin_dir_url( __FILE__ ) . 'css/dw-admin-styles.css', array(), '1.0', 'all' );
		
		// Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' );

		// Add the media uploader
		wp_enqueue_media();

		// Add the admin custom scripts and its dependencies
		wp_enqueue_script( 'dw-custom-google-map-admin-scripts', plugin_dir_url( __FILE__ ) . 'js/dw-admin-scripts.js', array( 'jquery', 'wp-color-picker' ), '1.0', true );
	}

}
add_action( 'admin_enqueue_scripts', 'dw_custom_google_map_admin_scripts' );

/**
 * Add the submenu item on Settings menu.
 */
function dw_custom_google_map_menu() {
	add_submenu_page( 'options-general.php', 'DW Custom Google Map Settings', 'DW Custom Google Map Settings', 'manage_options', 'dw-custom-google-map-settings', 'dw_custom_google_map_settings_page' );
}
add_action( 'admin_menu', 'dw_custom_google_map_menu' );

/**
 * Adds an action link to settings page on the plugins list.
 */
function dw_custom_google_map_settings_link( $links, $file ) {
 
    if ( $file == 'dw-custom-google-map/dw-custom-google-map.php' ) {
        $links['settings'] = sprintf( '<a href="%s"> %s </a>', admin_url( 'admin.php?page=dw-custom-google-map-settings' ), __( 'Settings', 'dw-custom-google-map' ) );
    }
    return $links;
 
}
add_filter( 'plugin_action_links', 'dw_custom_google_map_settings_link', 10, 2 );

/**
 * Creates the options page interface.
 */
function dw_custom_google_map_settings_page() { 
?>

	<div class="wrap dw-custom-google-map-settings-page">
		<h1><?php echo get_admin_page_title(); ?></h1>
		<div class="card left">
			<form method="post" action="options.php">

			<?php
			settings_fields( 'dw_custom_google_map_settings_group' );
			do_settings_sections( 'dw_custom_google_map_settings_group' );
			submit_button();
			?>

			</form>
		</div>
		<div class="card right">
			<div>
				<h2><?php _e( 'How to configure and use the custom map', 'dw-custom-google-map' ); ?></h2>
				<p><?php _e( 'The only required fields are the latitude and longitude.', 'dw-custom-google-map' ); ?></p>
				<ol class="howto">
					<li><?php _e( 'Open <a href="https://www.google.com.br/maps/" target="_blank">Google Maps</a> and enter your address', 'dw-custom-google-map' ); ?></li>
					<li><?php _e( "Right click on the marker and click on <strong>What's here</strong>.", "dw-custom-google-map" ); ?></li>
					<li><?php _e( 'A box is opened and here are the latitude and longitude, respectively. Copy or click on it.' ); ?>
						<img src="<?php echo plugin_dir_url( __FILE__ ); ?>images/lat-long.png" alt="print">
					</li>
					<li><?php _e( 'Paste latitude and longitude into the indicated fields and save.', 'dw-custom-google-map' ); ?></li>
				</ol>
				<p><?php _e( 'Use the shortcode <code>[dw-custom-google-map]</code> to call the map.', 'dw-custom-google-map' ); ?></p>
			</div>
		</div>
	</div>

<?php
}

/**
 * Register the settings fields.
 */
require "dw-settings-init.php";

/**
 * Render the settings fields HTML.
 */
require "dw-settings-render.php";

/**
 * Sanitize the settings input.
 */
require "dw-validate-settings.php";
