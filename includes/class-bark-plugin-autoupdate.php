<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link      http://24bits.in/
 * @since      1.0.0
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Bark Plugin
 * @subpackage bark-plugin/includes
 */
class Bark_Plugin_Autoupdate {

	/**
	 * The plugin current version
	 *
	 * @var string
	 */
	private $current_version;

	/**
	 * The plugin remote update path
	 *
	 * @var string
	 */
	private $update_path;

	/**
	 * Plugin Slug (plugin_directory/plugin_file.php)
	 *
	 * @var string
	 */
	private $plugin_slug;

	/**
	 * Plugin name (plugin_file)
	 *
	 * @var string
	 */
	private $slug;

	/**
	 * License User
	 *
	 * @var string
	 */
	private $license_user;

	/**
	 * License Key
	 *
	 * @var string
	 */
	private $license_key;

	/**
	 * Initialize a new instance of the WordPress Auto-Update class.
	 *
	 * @param string $current_version set the current version of plugin.
	 * @param string $update_path set the update path for plugin.
	 * @param string $plugin_slug set the slug of plugin.
	 * @param string $license_user set the slug of plugin license user.
	 * @param string $license_key set the slug of plugin license key.
	 */
	public function __construct( $current_version, $update_path, $plugin_slug, $license_user = '', $license_key = '' ) {

		// Set the class public variables.
		$this->current_version = $current_version;
		$this->update_path     = $update_path;

		// Set the License.
		$this->license_user = $license_user;
		$this->license_key  = $license_key;

		// Set the Plugin Slug.
		$this->plugin_slug = $plugin_slug;
		list ($t1, $t2)    = explode( '/', $plugin_slug );
		$this->slug        = str_replace( '.php', '', $t2 );

		// define the alternative API for updating checking.
		add_filter( 'pre_set_site_transient_update_plugins', array( &$this, 'check_update' ) );

		// Define the alternative response for information checking.
		add_filter( 'plugins_api', array( &$this, 'check_info' ), 10, 3 );
	}

	/**
	 * Add our self-hosted autoupdate plugin to the filter transient.
	 *
	 * @param object $transient set the plugin transient value.
	 * @return object $ transient
	 */
	public function check_update( $transient ) {
		if ( empty( $transient->checked ) ) {
			return $transient;
		}

		// Get the remote version
		// $remote_version = $this->get_remote( 'version' ).
		$remote_version = $this->get_remote( 'info' );
		// If a newer version is available, add the update.
		if ( ! empty( $remote_version->new_version ) && version_compare( $this->current_version, $remote_version->new_version, '<' ) ) {
			$obj                                       = new stdClass();
			$obj->id                                   = $remote_version->id;
			$obj->slug                                 = $this->slug;
			$obj->new_version                          = $remote_version->new_version;
			$obj->url                                  = $remote_version->url;
			$obj->plugin                               = $this->plugin_slug;
			$obj->package                              = $remote_version->package;
			$obj->tested                               = $remote_version->tested;
			$transient->response[ $this->plugin_slug ] = $obj;
		}
		return $transient;
	}

	/**
	 * Add our self-hosted description to the filter.
	 *
	 * @param object $obj return the plugin api object.
	 * @param array  $action set the action for remot client.
	 * @param object $arg set the argument for remote client.
	 */
	public function check_info( $obj, $action, $arg ) {
		if ( ( 'query_plugins' === $action || 'plugin_information' === $action ) && isset( $arg->slug ) && $arg->slug === $this->slug ) {
			return $this->get_remote( 'info' );
		}

		return $obj;
	}

	/**
	 * Return the remote version
	 *
	 * @param array $action set the action for remot client.
	 * @return string $remote_version checks the version.
	 */
	public function get_remote( $action = '' ) {
		$params = array(
			'body' => array(
				'action'       => $action,
				'license_user' => $this->license_user,
				'license_key'  => $this->license_key,
			),
		);

		// Make the POST request.
		$request = wp_remote_post( $this->update_path, $params );

		// Check if response is valid.
		if ( ! is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			return maybe_unserialize( $request['body'] );
		}

		return false;
	}

}
