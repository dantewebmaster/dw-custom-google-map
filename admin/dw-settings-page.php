<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Enqueue the admin scripts.
 */
function dw_custom_google_map_admin_scripts() {

	if ( is_admin() ) {
		wp_enqueue_style( 'dw-custom-google-map-admin-styles', plugin_dir_url( __FILE__ ) . 'admin/css/dw-admin-styles.css', array(), '1.0', 'all' );
	}

	wp_enqueue_script( 'dw-custom-google-map-admin-scripts', plugin_dir_url( __FILE__ ) . 'admin/js/dw-admin-scripts.js', array( 'jquery' ), '1.0', true );

}
add_action( 'admin_enqueue_scripts', 'dw_custom_google_map_admin_scripts' );

/**
 * Add the submenu item on WPCF7 menu.
 */
function dw_custom_google_map_menu() {
	add_submenu_page( 'options-general.php', 'DW Custom Google Map Settings', 'DW Custom Google Map Settings', 'manage_options', 'dw-custom-google-map-settings', 'dw_custom_google_map_settings_page' );
}
add_action( 'admin_menu', 'dw_custom_google_map_menu' );

/**
 * Register the settings fields.
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
		__( 'DW CF7 Alerts Display Settings', 'dw-custom-google-map' ), 
		'dw_custom_google_map_settings_section_callback', 
		'dw_custom_google_map_settings_group'
	);

	// Checkbox to activat/deactivate the plugin 
	add_settings_field( 
		'dw_custom_google_map_activate', 
		__( 'Activate the Custom Alerts', 'dw-custom-google-map' ), 
		'dw_custom_google_map_activate_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-activate' )
	);

	// Alert type radio option
	add_settings_field( 
		'dw_custom_google_map_alert_type', 
		__( 'Set the Type of Alerts', 'dw-custom-google-map' ), 
		'dw_custom_google_map_alert_type_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-alert-type' )
	);
	
	// The position of toast alert
	add_settings_field( 
		'dw_custom_google_map_alert_position', 
		__( 'Toast Alerts Position', 'dw-custom-google-map' ), 
		'dw_custom_google_map_alert_position_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-toast-position' )
	);

	// Textarea for custom CSS
	add_settings_field( 
		'dw_custom_google_map_custom_css', 
		__( 'Custom CSS', 'dw-custom-google-map' ), 
		'dw_custom_google_map_custom_css_render', 
		'dw_custom_google_map_settings_group', 
		'dw_custom_google_map_settings_group_section',
		array( 'class' => 'option-custom-css' )
	);
}
add_action( 'admin_init', 'dw_custom_google_map_settings_init' );

/**
 * Generate the options section description.
 */
function dw_custom_google_map_settings_section_callback() { 

	echo __( 'Configure the display options of the Contact Form 7 custom response output alerts.', 'dw-custom-google-map' );

}

/**
 * Render the settings fields HTML.
 */
// Setting to activate the plugin render
function dw_custom_google_map_activate_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );

	?>
	<label>
		<input type="checkbox" name="dw_custom_google_map_settings[dw_custom_google_map_activate]" value="1" <?php checked( $options['dw_custom_google_map_activate'], 1 ); ?> />
		<p><em><small><?php _e( 'Uncheck to disable the custom alerts.', 'dw-custom-google-map' ); ?><small></em></p>
	</label>
	<?php
}

// Alert type setting render
function dw_custom_google_map_alert_type_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );

	?>
	<label>
		<input class="alert-type-input" type="radio" name="dw_custom_google_map_settings[dw_custom_google_map_alert_type]" value="toast" <?php checked( $options['dw_custom_google_map_alert_type'], 'toast' ); ?> />
		Toast
	</label>
	<br />
	<label>
		<input class="alert-type-input" type="radio" name="dw_custom_google_map_settings[dw_custom_google_map_alert_type]" value="modal" <?php checked( $options['dw_custom_google_map_alert_type'], 'modal' ); ?> />
		Modal
	</label>
	<p><em><small><?php _e( 'Select the style of alerts, toast or modal.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

// Alert position setting render
function dw_custom_google_map_alert_position_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );
	?>
	<select name="dw_custom_google_map_settings[dw_custom_google_map_alert_position]">
		<option value="bottom_right" <?php selected( $options['dw_custom_google_map_alert_position'], 'bottom_right' ); ?>><?php _e( 'Bottom Right', 'dw-custom-google-map' ); ?></option>
		<option value="bottom_left" <?php selected( $options['dw_custom_google_map_alert_position'], 'bottom_left' ); ?>><?php _e( 'Bottom Left', 'dw-custom-google-map' ); ?></option>
		<option value="top_right" <?php selected( $options['dw_custom_google_map_alert_position'], 'top_right' ); ?>><?php _e( 'Top Right', 'dw-custom-google-map' ); ?></option>
		<option value="top_left" <?php selected( $options['dw_custom_google_map_alert_position'], 'top_left' ); ?>><?php _e( 'Top Left', 'dw-custom-google-map' ); ?></option>
	</select>
	<p><em><small><?php _e( 'Select the position of the alerts on the screen.', 'dw-custom-google-map' ); ?></small></em></p>
	<?php

}

// Custom CSS setting render
function dw_custom_google_map_custom_css_render() { 

	$options = get_option( 'dw_custom_google_map_settings' );

	?>
	<textarea name="dw_custom_google_map_settings[dw_custom_google_map_custom_css]" cols="48" rows="8"><?php echo wp_strip_all_tags( $options['dw_custom_google_map_custom_css'] ); ?></textarea>
	<p><em><small><?php _e( 'Write custom CSS for the plugin here.', 'dw-custom-google-map' ); ?><small></em></p>
	<?php
}

/**
 * Creates the options page interface.
 */
function dw_custom_google_map_settings_page() { 
?>

	<div class="wrap dw-custom-google-map-settings-page">

		<?php 
		// add error/update messages
		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error( 'dw_custom_google_map_messages', 'dw_custom_google_map_message', __( 'Settings saved.' ), 'updated' );
		}
		settings_errors( 'dw_custom_google_map_messages' );
		?>

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
	</div>

<?php
}

/**
 * Sanitize the settings input
 */
function dw_custom_google_map_validate_settings( $input ) {
	
	// Create our array for storing the validated options
	$output = array();

	// Loop through each of the incoming options
	foreach ( $input as $key => $value ) {
		
		// Check to see if the current option has a value. If so, process it.
		if ( isset( $input[$key] ) ) {
		
			// Strip all HTML and PHP tags and properly handle quoted strings
			$output[$key] = wp_strip_all_tags( $input[ $key ] );
			
		}
		
	}

	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'dw_custom_google_map_validate_settings', $output, $input );

}

/**
 * Adds an action link to settings page on the plugins list.
 */
function dw_custom_google_map_settings_link( $links, $file ) {
 
    if ( $file == 'dw-custom-google-map/dw-custom-google-map.php' ) {
        $links['settings'] = sprintf( '<a href="%s"> %s </a>', admin_url( 'admin.php?page=dw-custom-google-map-settings' ), __( 'Settings' ) );
    }
    return $links;
 
}
add_filter( 'plugin_action_links', 'dw_custom_google_map_settings_link', 10, 2 );
