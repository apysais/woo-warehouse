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
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$query_args = [
				'paginate' => true,
		    'paged' => $paged,
				'status' => ['processing', 'on-hold'],
		    'orderby' => 'modified',
		    'order' => 'DESC',
				'meta_key' => 'wh_order_status',
				'meta_compare' => 'NOT EXISTS'
		];
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
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$query_args = [
				'paginate' => true,
				'paged' => $paged,
		    'orderby' => 'modified',
		    'order' => 'DESC',
				'meta_key' => 'wh_order_status',
				'meta_value' => ['released', 'working'],
		];

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
