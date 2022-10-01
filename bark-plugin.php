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
