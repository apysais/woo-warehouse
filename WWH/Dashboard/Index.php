<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Controller for the wharehouse page.
 * @since 0.0.1
 * */
class WWH_Dashboard_Index {
  /**
	 * instance of this class
	 *
	 * @since 0.0.1
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;
	protected $action;
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

	public function setAction( $action ) {
		$this->action = $action;
	}

	public function getAction( ) {
		return $this->action;
	}

	public function postSubmit() {
		if ( $_POST && isset( $_POST['wwh_action'] ) ) {
			$action = isset( $_POST['wwh_action'] ) ? $_POST['wwh_action'] : false;
			$order_id = $_POST['order_id'];
			if ( $action ) {
				switch( $action ) {
					case 'finish-order':
						$args = [
							'order_id' => $order_id,
							'colli' => isset($_POST['colli']) ? $_POST['colli'] : 0,
							'placement' => isset($_POST['placement']) ? $_POST['placement'] : 0,
						];

						$verify_nonce = WWH_Nonce_Nonces::get_instance()->verifyNonceField([
							'order_id'		=>	$order_id,
							'user_id'     =>  get_current_user_id(),
							'action_name'	=>	'set-finish-order-',
							'request_nonce'	=> isset($_POST['_nonce']) ? $_POST['_nonce'] : ''
						]);

						if ( $verify_nonce ) {
							WWH_Orders_DB::get_instance()->setFinishOrder($args);
						}

						wwh_redirect_to( home_url(WWH_PAGE_URL) );

						break;
					case 'start-order':
						$verify_nonce = WWH_Nonce_Nonces::get_instance()->verifyNonceField([
							'order_id'		=>	$order_id,
							'user_id'     =>  get_current_user_id(),
							'action_name'	=>	'set-order-start-',
							'request_nonce'	=> isset($_POST['_nonce']) ? $_POST['_nonce'] : ''
						]);

						if ( $verify_nonce ) {
							$args = [
								'order_id' => $order_id,
							];

							WWH_Orders_DB::get_instance()->setWorkingOrder($args);
						}

						wwh_redirect_to( home_url(WWH_PAGE_URL) );

						break;
					case 'release-order':
						$args = [
							'order_id' => $order_id,
							'note' 		 => isset($_POST['messageTextArea']) ? $_POST['messageTextArea'] : ''
						];
						WWH_Orders_DB::get_instance()->setNewOrder($args);

						wwh_redirect_to( home_url(WWH_PAGE_URL) );

						break;
				}
			}

		}
	}

	public function route( $args = [] )	{

    $action = isset( $args['action'] ) ? $args['action'] : false;
		$this->setAction($action);
		if ( WWH_User_Check::get_instance()->is_admin() || WWH_User_Check::get_instance()->is_warehouse() ) {
			switch ( $action ) {
				case 'order-details':
					add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getOrderDetails'], 100);
					break;
				case 'set-order':
					add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getOrderDetails'], 100);
					break;
				case 'orders':
					add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getDoneOrders'], 100);
					break;
	      case 'dashboard' :
	      default :
					if ( WWH_User_Check::get_instance()->is_admin() ) {
	        	add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getNewOrders'], 100);
	        	add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getReleasedOrders'], 100);
	        	add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getWorkingOrders'], 100);
	        	add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getReadyOrders'], 100);
					} elseif ( WWH_User_Check::get_instance()->is_warehouse() ) {
						add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getReleasedOrders'], 100);
						add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getWorkingOrders'], 100);
					}
	      	break;
	    }
		} else {
			add_action('warehouse_data', [ WWH_User_Check::get_instance(), 'loginForm'], 100);
		}


    return WWH_View::get_instance()->public_part_partials( 'dashboard/index.php' );

	}



}//
