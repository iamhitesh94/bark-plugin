<?php
/**
 * Register all actions and filters for the Front End
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
 * Register actions & filtr for front end.
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/front-end
 */
class Bark_Plugin_Front {

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
		wp_enqueue_style( $this->plugin_name . '-jquery-nice-select', plugin_dir_url( __FILE__ ) . 'assets/css/nice-select.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-jquery-ui-min', plugin_dir_url( __FILE__ ) . 'assets/css/jquery-ui.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-main-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '-main-responsive', plugin_dir_url( __FILE__ ) . 'assets/css/responsive.css', array(), $this->version, 'all' );
	}

	/**
	 * Add plugin script files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( $this->plugin_name . '-jquery-ui-min', plugin_dir_url( __FILE__ ) . 'assets/js/jquery-ui.min.js', array(), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-min-script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array(), $this->version, true );

		$localizedata = array(
			'ajaxurl'                  => admin_url( 'admin-ajax.php' ),
			'bark_service_suggections' => wp_create_nonce( 'bark-service-suggections' ),
		);

		wp_localize_script( $this->plugin_name . '-min-script', 'bark_front_obj', $localizedata );
	}


	/**
	 * Generate plugin pages for searchbox & listing.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function bark_generate_plugin_page() {

	}

	/**
	 * Gets the searchbar sortcode.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param array $args This argument used for sortcode aruments.
	 */
	public function bark_searchbar_shortcode( $args = array() ) {
		$atts = shortcode_atts(
			array(
				'title'               => __( 'Find your profession what you love', 'bark-plugin' ),
				'description_text'    => __( 'Get free quotes within minutes', 'bark-plugin' ),
				'search_btn_text'     => __( 'Search', 'bark-plugin' ),
				'search_placeholder'  => __( 'What service are you looking for?', 'bark-plugin' ),
				'zipcode_placeholder' => __( 'Zip code', 'bark-plugin' ),
			),
			$args
		);

		ob_start();
		bark_get_template_part( 'search-form', $atts );
		$storehtml = ob_get_clean();
		return $storehtml;
	}


	/**
	 * Gets the plugin service suggestion call.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function bark_get_service_suggestions_call() {

		$search = '';
		if ( ! isset( $_POST['nounce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nounce'] ) ), 'bark-service-suggections' ) ) {
			echo wp_json_encode(
				array(
					'error' => 1,
					'msg'   => 'Could not match the nounce',
				)
			);
			die();
		}
		if ( isset( $_POST['term'] ) ) {
			$search = sanitize_text_field( wp_unslash( $_POST['term'] ) );
		}

		$service_suggections = array();
		$error               = 0;

		if ( ! empty( $search ) ) {
			$args     = array(
				'post_type'      => 'bark-service',
				'posts_per_page' => -1,
				's'              => $search,
			);
			$services = new WP_Query( $args );

			if ( $services->have_posts() ) {
				$i = 0;
				while ( $services->have_posts() ) {
					$services->the_post();
					$service_id = get_the_ID();
					$image      = get_the_post_thumbnail_url( $service_id );

					if ( empty( $image ) ) {
						$image = BARK_PLUGIN_URL . '/front-end/images/banner-image.jpg';
					}

					$service_suggections[ $i ]['id']    = $service_id;
					$service_suggections[ $i ]['title'] = get_the_title();
					$service_suggections[ $i ]['image'] = $image;
					$i++;
				}
			}
		} else {
			$error = 1;
		}

		echo wp_json_encode(
			array(
				'error'       => $error,
				'suggections' => $service_suggections,
			)
		);
		die();
	}

}
