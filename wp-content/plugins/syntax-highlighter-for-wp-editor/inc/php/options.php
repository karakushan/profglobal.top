<?php

/**
 * Callback function that returns an array with the value of the plugin options
 * @return array
 */
function spacexchimp_p009_options() {

    // Put value of plugin constants into an array for easier access
    $plugin = spacexchimp_p009_plugin();

    // Retrieve options from database
    $options = get_option( $plugin['settings'] . '_settings' );

    // Make the "$options" array if the plugin options data in the database is not exist
    if ( ! is_array( $options ) ) {
        $options = array();
    }

    // Create an array with options
    $array = $options;

    // Set default value if option is empty
    $list = array(
        'first_line_number' => '0',
        'hidden_scrollto' => '0',
        'line_numbers' => '',
        'tab_size' => '4',
        'theme' => 'default',
    );
    foreach ( $list as $name => $default ) {
        $array[$name] = !empty( $options[$name] ) ? $options[$name] : $default;
    }

    // Sanitize data


    // Modify data
    $array['line_numbers'] = ( $array['line_numbers'] == 'on' || $array['line_numbers'] == '1' || $array['line_numbers'] == 'true' ) ? 'true' : 'false';

    // Return the processed data
    return $array;
}
