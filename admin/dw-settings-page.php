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
		wp_enqueue_style( 'dw-custom-google-map-admin-styles', plugin_dir_url( __FILE__ ) . 'css/dw-admin-styles.css', array(), '1.0', 'all' );
		// Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( 'dw-custom-google-map-admin-scripts', plugin_dir_url( __FILE__ ) . 'js/dw-admin-scripts.js', array( 'jquery', 'wp-color-picker' ), '1.0', true );
	}

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
}
add_action( 'admin_init', 'dw_custom_google_map_settings_init' );

/**
 * Generate the options section description.
 */
function dw_custom_google_map_settings_section_callback() { 

	echo __( 'Configure the display options of the Custom Google Map.', 'dw-custom-google-map' );

}

/**
 * Render the settings fields HTML.
 */
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
	</div>

<?php
}

/**
 * Sanitize the settings input
 */
function dw_custom_google_map_validate_settings( $input ) {

	$options = get_option( 'dw_custom_google_map_settings' );
	
	// Create our array for storing the validated options
	$output = array();
	
	// Validate checkbox
	$activate_address = trim( $input['dw_custom_google_map_activate_address'] );
	$output['dw_custom_google_map_activate_address'] = dw_sanitize_checkbox( $activate_address );

	// Validate address field
    $address = trim( $input['dw_custom_google_map_address'] );
    $output['dw_custom_google_map_address'] = wp_strip_all_tags( $address );

	// Validate color picker
	$main_color = trim( $input['dw_custom_google_map_main_color'] );
	$main_color = strip_tags( stripslashes( $main_color ) );
    // Check if is a valid hex color and display error if false
    if ( false === dw_check_color( $main_color ) ) {
        // Set the error message
		add_settings_error( 'dw_custom_google_map_settings', 'dw_color_error', 'Insert a valid color', 'error' );
         
        // Get the previous valid value
        $output['dw_custom_google_map_main_color'] = $options['dw_custom_google_map_main_color'];
    } else {
        $output['dw_custom_google_map_main_color'] = $main_color;
    }

	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'dw_custom_google_map_validate_settings', $output, $input );

}
/**
 * Check if value is a valid HEX color.
 */
function dw_check_color( $color ) { 
     
    if ( preg_match( '/^#[a-f0-9]{6}$/i', $color ) ) {    
        return true;
    }
     
    return false;
}
/**
 * Sanitize checkboxes.
 */
function dw_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
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
