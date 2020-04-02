<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Ajax
 * @since 0.0.1
 * */
class WWH_Ajax {
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

	public function __construct() {
    add_action( 'wp_ajax_get_dashboard_admin_order', [$this, 'dashboardAdminOrder'] );
    add_action( 'wp_ajax_get_dashboard_warehouse_order', [$this, 'dashboardWarehouseOrder'] );
  }

  public function dashboardAdminOrder() {
		$query_args = [];
		switch( $_POST['order_status'] ) {
			case 'new':
				$query_args = [
						'limit' => -1,
						'status' => ['processing', 'on-hold'],
						'orderby' => 'modified',
						'order' => 'DESC',
						'meta_key' => 'wh_order_status',
						'meta_compare' => 'NOT EXISTS'
				];
				break;
			case 'released':
				$query_args = [
						'limit' => -1,
						'status' => ['processing', 'on-hold'],
						'orderby' => 'modified',
						'order' => 'DESC',
						'meta_key' => 'wh_order_status',
						'meta_value' => 'released',
				];
				break;
			case 'working':
				$query_args = [
						'limit' => -1,
						'status' => ['processing', 'on-hold'],
						'orderby' => 'modified',
						'order' => 'DESC',
						'meta_key' => 'wh_order_status',
						'meta_value' => 'working',
				];
				break;
		}

		$orders = wc_get_orders( $query_args );

    $data = [
      'title' => 'New Orders',
			'orders' => $orders,
			'app' => 'index',
    ];

    WWH_View::get_instance()->public_partials( 'orders/office/ajax-list.php', $data );
    wp_die();
  }

  public function dashboardWarehouseOrder() {

		switch( $_POST['order_status'] ) {
			case 'new':
				$query_args = [
						'limit' => -1,
						'status' => ['processing'],
						'orderby' => 'modified',
						'order' => 'DESC',
						'meta_key' => 'wh_order_status',
						'meta_compare' => 'NOT EXISTS'
				];
				break;
			case 'released':
				$query_args = [
						'limit' => -1,
						'status' => ['processing'],
						'orderby' => 'modified',
						'order' => 'DESC',
						'meta_key' => 'wh_order_status',
						'meta_value' => 'released',
				];
				break;
			case 'working':
				$query_args = [
						'limit' => -1,
						'status' => ['processing'],
						'orderby' => 'modified',
						'order' => 'DESC',
						'meta_key' => 'wh_order_status',
						'meta_value' => 'working',
				];
				break;
		}

		$orders = wc_get_orders( $query_args );

    $data = [
      'title' => 'For Released Orders',
			'orders' => $orders,
			'app' => 'index',
    ];

    WWH_View::get_instance()->public_partials( 'orders/office/ajax-list.php', $data );
    wp_die();
  }

}//
