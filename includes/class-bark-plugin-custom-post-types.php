<?php
/**
 * Register all actions and filters for the custom post types for bark
 *
 * @link       http://24bits.in/
 * @since      1.0.0
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Register custom post_stypes
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/includes
 */
class Bark_Plugin_Custom_Post_Types {

	/**
	 * Function related to the register bark service
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_bark_services() {
		$serviceargs = array(
			'slug'                => 'bark-service',
			'name'                => _x( 'Services', 'Post Type General Name', 'lexicon' ),
			'label'               => 'bark-service',
			'single_name'         => 'Service',
			'menu_name'           => 'Bark Service',
			'support'             => array(
				'title',
				'thumbnail',
				'author',
			),
			'hide_admin'          => false,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'icon'                => 'dashicons-list-view',
		);
		$this->add_custom_post_types( $serviceargs );
	}

	/**
	 * Function related to the register bark requests
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_bark_requests() {
		$requestsargs = array(
			'slug'                => 'bark-requests',
			'name'                => _x( 'Requests', 'Post Type General Name', 'lexicon' ),
			'label'               => 'bark-request',
			'single_name'         => 'Request',
			'menu_name'           => 'Bark Requests',
			'hide_admin'          => false,
			'support'             => array(
				'title',
				'thumbnail',
				'author',
				'editor',
			),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'icon'                => 'dashicons-email-alt2',
		);
		$this->add_custom_post_types( $requestsargs );
	}


	/**
	 * Generate post type data and register
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param array $posttype_data Data for custom post type.
	 */
	private function add_custom_post_types( $posttype_data = array() ) {
		if ( empty( $posttype_data ) ) {
			return;
		}

		$posttype_slug                = $posttype_data['slug'];
		$posttype_name                = $posttype_data['name'];
		$posttype_label               = $posttype_data['label'];
		$posttype_single_name         = $posttype_data['single_name'];
		$posttype_menu_name           = $posttype_data['menu_name'];
		$posttype_supports            = '';
		$posttype_hide_admin          = $posttype_data['hide_admin'];
		$posttype_hierarchical        = $posttype_data['hierarchical'];
		$posttype_public              = $posttype_data['public'];
		$posttype_show_ui             = $posttype_data['show_ui'];
		$posttype_show_in_menu        = $posttype_data['show_in_menu'];
		$posttype_has_archive         = $posttype_data['has_archive'];
		$posttype_exclude_from_search = $posttype_data['exclude_from_search'];
		$posttype_publicly_queryable  = $posttype_data['publicly_queryable'];
		$posttype_icon                = $posttype_data['icon'];

		if ( isset( $posttype_data['support'] ) ) {
			$posttype_supports = $posttype_data['support'];
		}

		$labels = array(
			'name'          => $posttype_name,
			'singular_name' => $posttype_single_name,
			'menu_name'     => $posttype_menu_name,
		);

		$args = array(
			'label'               => $posttype_label,
			'description'         => __( 'custom post type for bark', 'bark-plugin' ),
			'labels'              => $labels,
			'supports'            => $posttype_supports,
			'taxonomies'          => array( '' ),
			'hierarchical'        => $posttype_hierarchical,
			'public'              => $posttype_public,
			'show_ui'             => $posttype_show_ui,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => $posttype_show_in_menu,
			'show_in_admin_bar'   => true,
			'menu_position'       => 20,
			'can_export'          => true,
			'menu_icon'           => $posttype_icon,
			'has_archive'         => $posttype_has_archive,
			'exclude_from_search' => $posttype_exclude_from_search,
			'publicly_queryable'  => $posttype_publicly_queryable,
			'capability_type'     => 'post',
			'show_in_rest'        => true,

		);
		register_post_type( $posttype_slug, $args );

	}

	/**
	 * Add custom taxonommy for custom post type
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param array $taxonomy_data Data for custom taxonomy data.
	 */
	public function add_custom_taxonomy( $taxonomy_data = array() ) {
		// Add new taxonomy, make it hierarchical (like categories).

		$name          = $taxonomy_data['name'];
		$singluar_name = $taxonomy_data['singluar_name'];
		$menu_name     = $taxonomy_data['menu_name'];
		$slug          = $taxonomy_data['slug'];
		$taxonomy_name = $taxonomy_data['taxonomy_name'];
		$post_type     = $taxonomy_data['post_type'];

		$labels = array(
			'name'          => $name,
			'singular_name' => $singluar_name,
			'menu_name'     => $menu_name,
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $slug ),
		);

		register_taxonomy( $taxonomy_name, array( $post_type ), $args );
	}

	/**
	 * Generate custom taxonommy for service
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_bark_services_types() {
		$taxonomy_data = array(
			'name'          => 'Service Types',
			'singluar_name' => 'Service Type',
			'menu_name'     => 'Service Types',
			'slug'          => 'service-type',
			'taxonomy_name' => 'service-types',
			'post_type'     => 'bark-service',
		);

		$this->add_custom_taxonomy( $taxonomy_data );

	}


	/**
	 * Generate metabox for service
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function service_meta_box() {
		add_meta_box(
			'service_option',       // $id
			'Service Option',                  // $title
			array( $this, 'services_options_metabox' ),  // $callback
			'bark-service',                 // $page
			'normal',                  // $context
			'high'                     // $priority
		);
	}

	/**
	 * Generate options for service
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function services_options_metabox() {
		require_once BARK_PLUGIN_PATH . '/admin/parts/metabox/service-metabox.php';
	}

}
