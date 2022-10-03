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

}
