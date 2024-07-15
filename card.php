<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mesvak.software
 * @since             1.0.0
 * @package           Card
 *
 * @wordpress-plugin
 * Plugin Name:       shuffle card
 * Plugin URI:        https://mesvak.software
 * Description:       this is a shuffle card for reading people's mind and helping them through their problems 
 * Version:           1.0.0
 * Author:            mesvak
 * Author URI:        https://mesvak.software/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       card
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CARD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-card-activator.php
 */
function activate_card() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-card-activator.php';
	Card_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-card-deactivator.php
 */
function deactivate_card() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-card-deactivator.php';
	Card_Deactivator::deactivate();
 
}

register_activation_hook( __FILE__, 'activate_card' );
register_deactivation_hook( __FILE__, 'deactivate_card' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-card.php';



function run_card() {

	$plugin = new Card();
	$plugin->run();
}
run_card();
