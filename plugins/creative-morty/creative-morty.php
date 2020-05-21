<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://codercave.net
 * @since             1.0.0
 * @package           Creative_Morty
 *
 * @wordpress-plugin
 * Plugin Name:       Morty
 * Plugin URI:        https://github.com/moscoquera/creative-rick-and-morty
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Andrés Mosquera
 * Author URI:        https://codercave.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       creative-morty
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

include "vendor/autoload.php";

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CREATIVE_MORTY_VERSION', '1.0.0' );
define( 'CREATIVE_MORTY_PATH',plugin_dir_path( __FILE__ ));
define('RAM_API_URL','https://rickandmortyapi.com/api/');


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-creative-morty-activator.php
 */
function activate_creative_morty() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-creative-morty-activator.php';
	Creative_Morty_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-creative-morty-deactivator.php
 */
function deactivate_creative_morty() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-creative-morty-deactivator.php';
	Creative_Morty_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_creative_morty' );
register_deactivation_hook( __FILE__, 'deactivate_creative_morty' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-creative-morty.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_creative_morty() {

	$plugin = new Creative_Morty();
	$plugin->run();

}
run_creative_morty();
