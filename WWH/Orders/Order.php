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

	public function showTemplate() {
		$action = 'dashboard';

		if ( isset($_GET['action']) && $_GET['action'] !== '' ) {
			$action = $_GET['action'];
		}

		if ( $action == 'orders-local' ) {
			return 'orders/office/local-list.php';
		} else {
			return 'orders/office/list.php';
		}

	}

	public function getItemsOrder($orders_obj) {
		$data = [];
		$data['orders'] = $orders_obj;

		WWH_View::get_instance()->public_partials( 'orders/detail-loop-product.php', $data );
	}

  /**
   * Get new orders, this is for officers only.
   */
	public function getNewOrders() {
		//$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$query_args = [
				'limit' => -1,
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
			'order_status' => 'new'
    ];

		$template = $this->showTemplate();
    WWH_View::get_instance()->public_partials( $template, $data );
  }

  /**
   * Get released orders, this is for officers only.
   */
	public function getReleasedOrders() {
		//$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$query_args = [
				'limit' => -1,
				'status' => ['processing', 'on-hold'],
		    'orderby' => 'modified',
		    'order' => 'DESC',
				'meta_key' => 'wh_order_status',
				'meta_value' => 'released'
		];
		$orders = wc_get_orders( $query_args );

    $data = [
      'title' => 'Released Orders',
			'orders' => $orders,
			'app' => 'index',
			'order_status' => 'released'
    ];

		$template = $this->showTemplate();
    WWH_View::get_instance()->public_partials( $template, $data );
  }

  /**
   * Get working orders, this is for officers only.
   */
	public function getWorkingOrders() {
		//$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$query_args = [
				'limit' => -1,
				'status' => ['processing', 'on-hold'],
		    'orderby' => 'modified',
		    'order' => 'DESC',
				'meta_key' => 'wh_order_status',
				'meta_value' => 'working'
		];
		$orders = wc_get_orders( $query_args );

    $data = [
      'title' => 'Working Orders',
			'orders' => $orders,
			'app' => 'index',
			'order_status' => 'working'
    ];

		$template = $this->showTemplate();
    WWH_View::get_instance()->public_partials( $template, $data );
  }

  /**
   * Get ready orders, this is for officers only.
   */
	public function getReadyOrders() {
		//$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$query_args = [
				'limit' => -1,
				'status' => ['processing', 'on-hold'],
		    'orderby' => 'modified',
		    'order' => 'DESC',
				'meta_key' => 'wh_order_status',
				'meta_value' => 'done'
		];
		$orders = wc_get_orders( $query_args );

    $data = [
      'title' => 'Ready Orders',
			'orders' => $orders,
			'app' => 'index',
			'order_status' => 'done'
    ];

		$template = $this->showTemplate();
    WWH_View::get_instance()->public_partials( $template, $data );
  }

	/**
	 * get all orders.
	 **/
	public function getDoneOrders() {
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$query_args = [
	    'paginate' => true,
			'paged' => $paged,
			'status' => ['completed'],
	    'orderby' => 'date',
	    'order' => 'DESC',
		];
		$orders = wc_get_orders( $query_args );

    $data = [
      'title' => 'Orders',
			'orders' => $orders
    ];

		$template = $this->showTemplate();
		WWH_View::get_instance()->public_partials( 'orders/office/orders.php', $data );
	}

	/**
	 * get all orders.
	 **/
	public function getAll() {
		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$query_args = [
	    'paginate' => true,
			'paged' => $paged,
	    'orderby' => 'date',
	    'order' => 'DESC',
		];
		$orders = wc_get_orders( $query_args );

    $data = [
      'title' => 'Orders',
			'orders' => $orders
    ];
		//wwh_dd($orders);exit();
		$template = $this->showTemplate();
    WWH_View::get_instance()->public_partials( $template, $data );
	}

	/**
	 * Display order details.
	 */
	public function getOrderDetailsView( $arg = [] ) {
		$order_id = false;
		if ( isset($arg['order_id']) ) {
			$order_id = $arg['order_id'];
			$data = [
				'order_id' => $order_id
			];
			WWH_View::get_instance()->public_partials( 'orders/details.php', $data );
		}
	}

	/**
	 * get the order details and display.
	 */
	public function getOrderDetails() {

		if ( WWH_User_Check::get_instance()->is_admin() ) {
			if ( isset($_GET['_nonce']) && isset($_GET['order-id']) ) {
				$order_id = $_GET['order-id'];
				$nonce 		= $_GET['_nonce'];
				$status 	= $_GET['status'];
				$nonce_url_args = [
					'order_id' => $order_id,
					'name' => $nonce,
				];
				$verify_nonce_url = WWH_Nonce_Nonces::get_instance()->verifyNonceNewOrderUrl($nonce_url_args);
				$verify_nonce_url_release = WWH_Nonce_Nonces::get_instance()->verifyNonceReleasedOrderUrl($nonce_url_args);
				if( $verify_nonce_url || $verify_nonce_url_release ) {
					$details_arg = [
						'order_id' => $order_id
					];
					$this->getOrderDetailsView($details_arg);
				}
			}
		} elseif ( WWH_User_Check::get_instance()->is_admin() || WWH_User_Check::get_instance()->is_warehouse() ) {
			if ( isset($_GET['_nonce']) && isset($_GET['order-id']) ) {
				$order_id = $_GET['order-id'];
				$nonce 		= $_GET['_nonce'];
				$status 	= $_GET['status'];
				$nonce_url_args = [
					'order_id' => $order_id,
					'name' => $nonce,
				];
				$verify_nonce_url_release = WWH_Nonce_Nonces::get_instance()->verifyNonceReleasedOrderUrl($nonce_url_args);
				if( $verify_nonce_url_release ) {
					$details_arg = [
						'order_id' => $order_id
					];
					$this->getOrderDetailsView($details_arg);
				}
			}
		}

	}

}//
