<?php
/**
 * Plugin Name: Мinify And Combine
 * Plugin URI: https://webcraftic.com
 * Description: Optimizes your website, concatenating the CSS and JavaScript code, and compressing it.
 * Author: Webcraftic <wordpress.webraftic@gmail.com>
 * Version: 1.1.1
 * Text Domain: minify-and-combine
 * Domain Path: /languages/
 * Author URI: https://webcraftic.com
 * Framework Version: FACTORY_478_VERSION
 */

/*
 * #### CREDITS ####
 * This plugin is based on the plugin Autoptimize by the author Frank Goossens, we have finalized this code for our project and our goals.
 * Many thanks to Frank Goossens for the quality solution for optimizing scripts in Wordpress.
 *
 * Public License is a GPLv2 compatible license allowing you to change and use this version of the plugin for free.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * -----------------------------------------------------------------------------
 * CHECK REQUIREMENTS
 * Check compatibility with php and wp version of the user's site. As well as checking
 * compatibility with other plugins from Webcraftic.
 * -----------------------------------------------------------------------------
 */

require_once( dirname( __FILE__ ) . '/libs/factory/core/includes/class-factory-requirements.php' );

// @formatter:off
$wmac_plugin_info = array(
	'prefix'         => 'wbcr_mac_', // префикс для базы данных и полей формы
	'plugin_name'    => 'wbcr_minify_and_combine', // имя плагина, как уникальный идентификатор
	'plugin_title'   => __( 'Webcraftic minify and combine', 'minify-and-combine' ), // заголовок плагина

	// PLUGIN SUPPORT
	'support_details'      => array(
		'url'       => 'https://webcraftic.com',
		'pages_map' => array(
			'support'  => 'support',           // {site}/support
			'docs'     => 'docs'               // {site}/docs
		)
	),

	// PLUGIN ADVERTS
	'render_adverts' => true,
	'adverts_settings'    => array(
		'dashboard_widget' => true, // show dashboard widget (default: false)
		'right_sidebar'    => true, // show adverts sidebar (default: false)
		'notice'           => true, // show notice message (default: false)
	),

	// FRAMEWORK MODULES
	'load_factory_modules' => array(
		array( 'libs/factory/bootstrap', 'factory_bootstrap_480', 'admin' ),
		array( 'libs/factory/forms', 'factory_forms_478', 'admin' ),
		array( 'libs/factory/pages', 'factory_pages_478', 'admin' ),
		array( 'libs/factory/clearfy', 'factory_templates_131', 'all' ),
		array( 'libs/factory/adverts', 'factory_adverts_156', 'admin')
	)
);

$wmac_compatibility = new Wbcr_Factory478_Requirements( __FILE__, array_merge( $wmac_plugin_info, array(
	'plugin_already_activate'          => defined( 'WMAC_PLUGIN_ACTIVE' ),
	'required_php_version'             => '5.4',
	'required_wp_version'              => '4.2.0',
	'required_clearfy_check_component' => false
) ) );


/**
 * If the plugin is compatible, then it will continue its work, otherwise it will be stopped,
 * and the user will throw a warning.
 */
if ( ! $wmac_compatibility->check() ) {
	return;
}

/**
 * -----------------------------------------------------------------------------
 * CONSTANTS
 * Install frequently used constants and constants for debugging, which will be
 * removed after compiling the plugin.
 * -----------------------------------------------------------------------------
 */

// This plugin is activated
define( 'WMAC_PLUGIN_ACTIVE', true );
define( 'WMAC_PLUGIN_VERSION', $wmac_compatibility->get_plugin_version() );
define( 'WMAC_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'WMAC_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'WMAC_PLUGIN_URL', plugins_url( '', __FILE__ ) );




/**
 * -----------------------------------------------------------------------------
 * PLUGIN INIT
 * -----------------------------------------------------------------------------
 */

require_once( WMAC_PLUGIN_DIR . '/libs/factory/core/boot.php' );
require_once( WMAC_PLUGIN_DIR . '/includes/class-plugin.php' );

try {
	new WMAC_Plugin( __FILE__, array_merge( $wmac_plugin_info, array(
		'plugin_version'     => WMAC_PLUGIN_VERSION,
		'plugin_text_domain' => $wmac_compatibility->get_text_domain(),
	) ) );
} catch( Exception $e ) {
	// Plugin wasn't initialized due to an error
	define( 'WMAC_PLUGIN_THROW_ERROR', true );

	$wmac_plugin_error_func = function () use ( $e ) {
		$error = sprintf( "The %s plugin has stopped. <b>Error:</b> %s Code: %s", 'Webcraftic Disable Comments', $e->getMessage(), $e->getCode() );
		echo '<div class="notice notice-error"><p>' . $error . '</p></div>';
	};

	add_action( 'admin_notices', $wmac_plugin_error_func );
	add_action( 'network_admin_notices', $wmac_plugin_error_func );
}
// @formatter:on