<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Change the warehouse status.
 * @since 0.0.1
 * */
class WWH_Orders_StatusAction {
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

  /**
   * Display status button
   * @param array $arg }
   *  @type string $status
   *  @type string $url
   * }
   */
  public function showClickedStatus( $arg = []) {
		$woo_status = isset($arg['woo_status']) ? $arg['woo_status'] : false;
		$redirect = isset($arg['redirect']) ? $arg['redirect'] : false;
    $status = 'new';
    $html = '';
		//this is for the admin user role
		if ( WWH_User_Check::get_instance()->is_admin() ) {
			if ( isset($arg['status']) && $arg['status'] == 'new' ) {
				$order_id = $arg['order_id'];
				$nonce_url_args = [
					'order_id' => $order_id,
					'action_url' => '?action=set-order&status=new&order-id='.$order_id.'&redirect='.$redirect
				];
				$nonce_url = WWH_Nonce_Nonces::get_instance()->setNewOrderNonce($nonce_url_args);
	      $html = "<a href='{$nonce_url}' class='btn btn-info'>";
	        $html .= "New";
	      $html .= "</a>";
	    }
		}

		if ( WWH_User_Check::get_instance()->is_warehouse() || WWH_User_Check::get_instance()->is_admin() ) {
			if ( isset($arg['status']) && $arg['status'] == 'released' ) {
				$order_id = $arg['order_id'];
				$nonce_url_args = [
					'order_id' => $order_id,
					'action_url' => '?action=set-order&status=released&order-id='.$order_id.'&redirect='.$redirect
				];
				$nonce_url = WWH_Nonce_Nonces::get_instance()->setReleaseOrderNonce($nonce_url_args);
	      $html = "<a href='{$nonce_url}' class='btn btn-info'>";
	        $html .= "Released";
	      $html .= "</a>";
			}
		}

		if ( WWH_User_Check::get_instance()->is_warehouse() || WWH_User_Check::get_instance()->is_admin() ) {
			if ( isset($arg['status']) && $arg['status'] == 'working' ) {
				$order_id = $arg['order_id'];
				$nonce_url_args = [
					'order_id' => $order_id,
					'action_url' => '?action=set-order&status=released&order-id='.$order_id.'&redirect='.$redirect
				];
				$nonce_url = WWH_Nonce_Nonces::get_instance()->setReleaseOrderNonce($nonce_url_args);
	      $html = "<a href='{$nonce_url}' class='btn btn-info'>";
	        $html .= "Working";
	      $html .= "</a>";
			}
		}

		if ( WWH_User_Check::get_instance()->is_warehouse() || WWH_User_Check::get_instance()->is_admin() ) {
			if ( isset($arg['status']) && $arg['status'] == 'done' ) {
				$order_id = $arg['order_id'];
				$nonce_url_args = [
					'order_id' => $order_id,
					'action_url' => '?action=set-order&status=released&order-id='.$order_id.'&redirect='.$redirect
				];
				$nonce_url = WWH_Nonce_Nonces::get_instance()->setReleaseOrderNonce($nonce_url_args);
				$class = 'btn-primary';
				$button_link_name = 'Un Known';
				if ( $woo_status == 'completed' ) {
					$class = 'btn-success';
					$button_link_name = 'Done';
				} elseif ( $woo_status == 'processing' || $woo_status == 'on-hold' ) {
					$class = 'btn-warning';
					$button_link_name = 'Ready';
				}
				$html = "<a href='#' class='btn {$class}'>";
					$html .= $button_link_name;
				$html .= "</a>";
			}
		}

    echo $html;
  }

	/**
   * Display action button in order details.
   * @param array $arg }
   *  @type string $status
   *  @type string $url
   * }
   */
	public function showReleasedButton( $arg = [] ) {
		$status = 'new';
		$redirect = isset($arg['redirect']) ? $arg['redirect'] : false;
    $html = '';

		if ( WWH_User_Check::get_instance()->is_admin() ) {
	    if ( isset($arg['status']) && $arg['status'] == 'new' ) {
				$order_id = $arg['order_id'];
				$nonce_url_args = [
					'order_id' => $order_id,
					'action_url' => '?action=set-order&status=new&order-id='.$order_id.'&redirect='.$redirect
				];
				$nonce_url = WWH_Nonce_Nonces::get_instance()->setNewOrderNonce($nonce_url_args);
	      $html = "<a href='{$nonce_url}' class='btn btn-info'>";
	        $html .= "New";
	      $html .= "</a>";
	    }
    }

    echo $html;
	}

}//
