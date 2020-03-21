<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Controller for the wharehouse page.
 * @since 0.0.1
 * */
class WWH_Orders_Order {
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

	public function getReleasedOrders() {
		
	}

  /**
   * Get new orders, this is for officers only.
   */
	public function getNewOrders() {
		$query_args = [
		    'limit' => -1,
				'status' => ['processing', 'on-hold'],
		    'orderby' => 'date',
		    'order' => 'DESC',
		];
		$orders = wc_get_orders( $query_args );

    $data = [
      'title' => 'New Orders',
			'orders' => $orders
    ];

    WWH_View::get_instance()->public_partials( 'orders/office/list.php', $data );
  }

	/**
	 * get all orders.
	 **/
	public function getAll() {
		$query_args = [
	    'paginate' => true,
	    'orderby' => 'date',
	    'order' => 'DESC',
		];
		$orders = wc_get_orders( $query_args );

    $data = [
      'title' => 'Orders',
			'orders' => $orders
    ];

    WWH_View::get_instance()->public_partials( 'orders/office/orders.php', $data );
	}

}//
