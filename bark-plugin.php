<?php
/**
 * The plugin Bark Plugin file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           bark-plugin
 *
 * @wordpress-plugin
 * Plugin Name: Bark Plugin
 * Plugin URI:  http://24bits.in/
 * Description: List your service and get leads
 * Version:     1.0.0
 * Author:      Hitesh Solanki, Sanjay Luva
 * Author URI:  http://24bits.in/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: bark-plugin
 */

if ( ! defined( 'WPINC' ) ) {
	echo 'Wrong turn';
	die;
}
define( 'BARK_PLUGIN_VERSION', '1.0.0' );
define( 'BARK_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'BARK_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bark-plugin-activator.php
 */
function activate_bark_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bark-plugin-activator.php';
	Dutchie_Connect_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bark-plugin-deactivator.php
 */
function deactivate_bark_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bark-plugin-deactivator.php';
	Dutchie_Connect_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bark_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_bark_plugin' );

require_once BARK_PLUGIN_PATH . 'includes/class-bark-plugin.php';
/**
 * The code init the plugin main function.
 * This action is documented in includes/class-bark-plugin.php
 */
function run_bark_plugin() {
	$plugin = new Bark_Plugin();
	$plugin->run();
}
run_bark_plugin();
