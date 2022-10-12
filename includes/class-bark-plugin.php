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
class Bark_Plugin {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Bark_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;
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
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->plugin_name = 'bark-plugin';
		$this->version     = BARK_PLUGIN_VERSION;

		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Bark_Plugin_Loader. Orchestrates the hooks of the plugin.
	 * - Bark_Plugin_Admin. Defines all hooks for the admin area.
	 * - Bark_Plugin_Front. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bark-plugin-loader.php';

		/**
		 * All general functions file
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bark-plugin-general-functions.php';

		/**
		 * The class responsible for admin the actions and filters of the
		 * plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bark-plugin-admin.php';

		/**
		 * The class responsible for  front-end actions and filters of the
		 * plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'front-end/class-bark-plugin-front.php';

		/**
		 * The class responsible for  user related the actions and filters of the
		 * plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bark-plugin-user.php';

		/**
		 * The class responsible for  custom post type related the actions and filters of the
		 * plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bark-plugin-custom-post-types.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		$this->loader = new Bark_Plugin_Loader();

		$this->define_admin_hooks();
		$this->define_front_end_hooks();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		/* register custom post types*/
		$barkposttypes = new Bark_Plugin_Custom_Post_Types();
		$this->loader->add_action( 'init', $barkposttypes, 'register_bark_services' );
		$this->loader->add_action( 'init', $barkposttypes, 'register_bark_services_types' );
		$this->loader->add_action( 'init', $barkposttypes, 'register_bark_requests' );
		//$this->loader->add_action( 'add_meta_boxes', $barkposttypes, 'service_meta_box' );
		/* register custom post types*/

		$admin_obj = new Bark_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );
		/** Add Style and script */
		$this->loader->add_action( 'admin_enqueue_scripts', $admin_obj, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $admin_obj, 'enqueue_scripts' );
	}

	/**
	 * Register all of the hooks related to the front area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_front_end_hooks() {
		/* Register user role*/
		$user_obj = new Bark_Plugin_User();
		$this->loader->add_action( 'bark_plugin_activated', $user_obj, 'register_bark_user_roles' );

		$front_obj = new Bark_Plugin_Front( $this->get_plugin_name(), $this->get_version() );
		/** Add Style and script */
		$this->loader->add_action( 'wp_enqueue_scripts', $front_obj, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $front_obj, 'enqueue_scripts' );

		/** Add shortcode */
		add_shortcode( 'bark-search-bar', array( $front_obj, 'bark_searchbar_shortcode' ), 99 );
		$this->loader->add_action( 'wp_footer', $front_obj, 'bark_search_modal', 99 );

		/** Add suggestion ajax calls */
		$this->loader->add_action( 'wp_ajax_bark_get_service_suggestions', $front_obj, 'bark_get_service_suggestions_call' );
		$this->loader->add_action( 'wp_ajax_nopriv_bark_get_service_suggestions', $front_obj, 'bark_get_service_suggestions_call' );

		/** Add suggestion ajax calls */
		$this->loader->add_action( 'wp_ajax_bark_filtered_service_providers', $front_obj, 'bark_filtered_service_providers_call' );
		$this->loader->add_action( 'wp_ajax_nopriv_bark_filtered_service_providers', $front_obj, 'bark_filtered_service_providers_call' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Provide autoupdate feature.
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function init_autoupdate() {
		if ( ! class_exists( '\Bark_Plugin_AutoUpdate' ) ) {
			require plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bark-plugin-autoupdate.php';
		}
		$slug        = basename( DUTCHIE_CONNECT_PATH ) . '/bark-plugin.php';
		$plugin_data = get_plugin_data( DUTCHIE_CONNECT_PATH . '/bark-plugin.php' );
		$version     = $this->version;
		$data        = new \Bark_Plugin_Autoupdate( $version, 'http://localhost/testDemo2/update', $slug, '', 'abcd' );
	}

	/**
	 * Get and return service suggestions.
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function ajax_get_service_suggestions() {

	}


}
