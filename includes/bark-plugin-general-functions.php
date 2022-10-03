<?php
/**
 * The file that defines the general functions used in whereas area of the plugin
 *
 * @link      http://24bits.in/
 * @since      1.0.0
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/includes
 */

/**
 * Gets the template file of plugin
 *
 * @since    1.0.0
 * @param string $templatename template file name. check the theme folder if template available or not.
 */
function bark_get_template( $templatename ) {
	$theme_path           = get_stylesheet_directory();
	$theme_path_tempalate = get_template_directory();
	if ( file_exists( $theme_path . '/bark-plugin/' . $templatename . '.php' ) ) {
		return $theme_path . '/bark-plugin/' . $templatename . '.php';
	} elseif ( file_exists( $theme_path_tempalate . '/bark-plugin/' . $templatename . '.php' ) ) {
		return $theme_path_tempalate . '/bark-plugin/' . $templatename . '.php';
	} else {
		return plugin_dir_path( dirname( __FILE__ ) ) . 'front-end/templates/' . $templatename . '.php';
	}
}

/**
 * Gets the template file of plugin
 *
 * @since    1.0.0
 * @param string $templatename template file name and returns to front-end.
 * @param array  $args Data need to pass the template.
 */
function bark_get_template_part( $templatename, $args = array() ) {
	$template = bark_get_template( $templatename );
	require $template;
}
