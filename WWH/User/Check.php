<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * check the user.
 * @since 0.0.1
 * */
class WWH_User_Check {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.0.1
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

  public function __construct() { }

  public function user_role() {
    $user = wp_get_current_user();

    return $user->roles;
  }

  public function is_logged_in() {
    return is_user_logged_in();
  }

  public function is_admin() {
    if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
      return true;
    }
  }

  public function is_warehouse() {

    if ( is_user_logged_in() && current_user_can('warehouse_role') ) {
      return true;
    }
  }

	public function loginForm() {
		$data = [
			'redirect' => home_url(WWH_PAGE_URL . '/?action=dashboard')
		];
		WWH_View::get_instance()->public_partials( 'orders/login.php', $data );
	}

}//
