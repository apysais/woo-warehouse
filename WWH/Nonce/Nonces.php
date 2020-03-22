<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Change the warehouse status.
 * @since 0.0.1
 * */
class WWH_Nonce_Nonces {
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

  public function setNonceUrl( $action_url, $action, $name) {
    return wp_nonce_url( $action_url, $action, $name);
  }

  public function setNewOrderNonce( $args = [] ) {
    $action_url = $args['action_url'];

    $name = '_nonce';
    if ( isset($args['name']) ) {
      $name = $args['name'];
    }

    $order_id = $args['order_id'];

    $user_id  = get_current_user_id();
    if ( isset($args['user_id']) ) {
      $user_id  = $args['user_id'];
    }
    $action = 'set-new-order-' . $order_id . $user_id;

    return $this->setNonceUrl($action_url, $action, $name);
  }

  public function setReleaseOrderNonce( $args = [] ) {
    $action_url = $args['action_url'];

    $name = '_nonce';
    if ( isset($args['name']) ) {
      $name = $args['name'];
    }

    $order_id = $args['order_id'];

    $user_id  = get_current_user_id();
    if ( isset($args['user_id']) ) {
      $user_id  = $args['user_id'];
    }
    $action = 'set-released-order-' . $order_id . $user_id;

    return $this->setNonceUrl($action_url, $action, $name);
  }

  public function setNonceField( $args = [] ) {

    $order_id = $args['order_id'];

    $user_id  = get_current_user_id();
    if ( isset($args['user_id']) ) {
      $user_id  = $args['user_id'];
    }
    $action = 'set-new-order-' . $order_id . $user_id;

    return $action;
  }

  public function verifyNonceNewOrderUrl( $args = [] ) {
    $action_url = isset($args['action_url']) ? $args['action_url'] : '';

    $name = '_nonce';
    if ( isset($args['name']) ) {
      $name = $args['name'];
    }

    $order_id = $args['order_id'];
    $user_id  = get_current_user_id();
    if ( isset($args['user_id']) ) {
      $user_id  = $args['user_id'];
    }
    $action = 'set-new-order-' . $order_id . $user_id;

    return wp_verify_nonce($name, $action);
  }

  public function verifyNonceReleasedOrderUrl( $args = [] ) {
    $action_url = isset($args['action_url']) ? $args['action_url'] : '';

    $name = '_nonce';
    if ( isset($args['name']) ) {
      $name = $args['name'];
    }

    $order_id = $args['order_id'];
    $user_id  = get_current_user_id();
    if ( isset($args['user_id']) ) {
      $user_id  = $args['user_id'];
    }
    $action = 'set-released-order-' . $order_id . $user_id;

    return wp_verify_nonce($name, $action);
  }

}//
