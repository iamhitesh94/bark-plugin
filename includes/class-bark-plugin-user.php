<?php
/**
 * Register all actions and filters for the custom users
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
 * Register custom user roles and user related actions
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/includes
 */
class Bark_Plugin_User {

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_bark_user_roles() {
		add_role(
			'bark_customer',
			__( 'Bark Customer', 'bark-plugin' ),
			array(
				'read' => true,  // true allows this capability.
			)
		);

		add_role(
			'bark_seller',
			__( 'Bark seller', 'bark-plugin' ),
			array(
				'read'         => true,  // true allows this capability.
				'edit_posts'   => true, // allow to add new post.
				'delete_posts' => true, // allow to delete post.
				'upload_files' => true, // allow to media.
			)
		);

	}

	/**
	 * Register new user in WordPress for bark plugin
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param array $newuser new user data.
	 */
	public function bark_add_new_user( $newuser ) {

		$random_password = wp_generate_password( 12, true );

		$new_user = wp_insert_user(
			array(
				'user_login' => $newuser['email'],
				'user_pass'  => $random_password,
				'user_email' => $newuser['email'],
				'first_name' => $newuser['name'],
				'role'       => $newuser['role'],
			)
		);

		update_user_meta( $new_user, 'bark_user_phone', $newuser['phone'] );
		update_user_meta( $new_user, 'bark_user_pass', $random_password );
		update_user_meta( $new_user, 'bark_user_name', $newuser['name'] );
		$userdata = $this->bark_get_user_data( $newuser['email'] );

	}


	/**
	 * Get user by email address
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param string $email user email.
	 */
	public function bark_get_user_data( $email = '' ) {
		$data = get_user_by( 'email', $email );
		if ( ! empty( $data ) ) {
			$data = json_decode( wp_json_encode( $data ), true );
			return $data['data'];
		}
		return '';
	}

}
