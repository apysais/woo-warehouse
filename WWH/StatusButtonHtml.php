<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Change the warehouse status.
 * @since 0.0.1
 * */
class WWH_StatusButtonHtml {
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

  public function startOrder( $order_id, $label = 'Start Order' ) {
    $data = [];
		$data['order_id'] = $order_id;
		$data['label'] = $label;

		WWH_View::get_instance()->public_partials( 'buttons/start-order.php', $data );
  }

  public function finishOrder( $order_id, $label = 'Finish Order' ) {
    $data = [];
		$data['order_id'] = $order_id;
		$data['label'] = $label;

		WWH_View::get_instance()->public_partials( 'buttons/finish-order.php', $data );
  }

  public function releaseOrder( $order_id, $label = 'Release Order' ) {
    $data = [];
		$data['order_id'] = $order_id;
		$data['label'] = $label;

		WWH_View::get_instance()->public_partials( 'buttons/release-now.php', $data );
  }

  public function cancelOrder($order_id, $label = 'Cancel' ) {
    $data = [];
		$data['order_id'] = $order_id;
		$data['label'] = $label;

		WWH_View::get_instance()->public_partials( 'buttons/cancel-order.php', $data );
  }


}//
