<?php
/**
 * Register all actions and filters for the Admin End
 *
 * @link       http://24bits.in/
 * @since      1.0.0
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/front-end
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Register actions & filtr for Admin end.
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/admin
 */
class Bark_Plugin_Admin {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Add plugin css files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name . '-main-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), $this->version, 'all' );
	}

	/**
	 * Add plugin script files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( $this->plugin_name . '-min-script', plugin_dir_url( __FILE__ ) . 'assets/js/admin.js', array(), $this->version, true );
		$localizedata = array(
			'ajaxurl'                  => admin_url( 'admin-ajax.php' ),
			'bark_service_suggections' => wp_create_nonce( 'bark-service-suggections' ),
			'bark_service_providers'   => wp_create_nonce( 'bark-service-providers' ),
		);
		wp_localize_script( $this->plugin_name . '-min-script', 'bark_front_obj', $localizedata );
	}
}
