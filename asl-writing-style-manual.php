<?php

/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           ASL_Writing_Style_Manual
 *
 * @wordpress-plugin
 * Plugin Name:       Academic Writing Style Manual
 * Plugin URI:        http://example.com/asl-writing-style-manual-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress dashboard.
 * Version:           0.0.1
 * Author:            Michael Schofield
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       asl-writing-style-manual
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-asl-writing-style-manual-activator.php
 */
function activate_asl_writing_style_manual() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-asl-writing-style-manual-activator.php';
	ASL_Writing_Style_Manual_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-asl-writing-style-manual-deactivator.php
 */
function deactivate_asl_writing_style_manual() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-asl-writing-style-manual-deactivator.php';
	ASL_Writing_Style_Manual_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_asl_writing_style_manual' );
register_deactivation_hook( __FILE__, 'deactivate_asl_writing_style_manual' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-asl-writing-style-manual.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_asl_writing_style_manual() {

	$plugin = new ASL_Writing_Style_Manual();
	$plugin->run();

}
run_asl_writing_style_manual();
