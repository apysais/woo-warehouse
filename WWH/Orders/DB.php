<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Data base related.
 * @since 0.0.1
 * */
class WWH_Orders_DB {
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

	public function getOrderNote( $arg = [] ) {
		$order_id = isset($arg['order_id']) ? $arg['order_id'] : false;
    if ( $order_id ) {

			$comment_args = [
				'post_id' => $order_id,
				'type' => 'woo_warehouse_order',
			];

			return get_comments($comment_args);
		}
		return false;
	}

	public function warehouseComment( $arg = [] ) {
		$order_id = isset($arg['order_id']) ? $arg['order_id'] : false;
    if ( $order_id ) {
      $note = isset($arg['note']) ? $arg['note'] : false;
      //set status
      //add order note, internally
      if ( $note ) {
        wp_insert_comment([
					'comment_post_ID' => $order_id,
					'comment_author' => 'woo warehouse',
					'comment_agent' => 'woo warehouse',
					'comment_content' => $note,
					'comment_type' => 'woo_warehouse_order'
				]);
      }
    }
	}

  /**
   * set new order.
   */
  public function setNewOrder( $arg = [] ) {

    $order_id = isset($arg['order_id']) ? $arg['order_id'] : false;
    if ( $order_id ) {
      $note = isset($arg['note']) ? $arg['note'] : false;
      //set status
      //add order note, internally
      if ( $note ) {
        $order = wc_get_order(  $order_id );
        // Add the note
        $order->add_order_note( $note );

				$this->warehouseComment( $arg );
      }
			WWH_Orders_WareHouseStatus::get_instance()->setToReleased( $order_id );
    }
  }

  /**
   * set working order.
   */
  public function setWorkingOrder( $arg = [] ) {
    $order_id = isset($arg['order_id']) ? $arg['order_id'] : false;
    if ( $order_id ) {
      //set status
      WWH_Orders_WareHouseStatus::get_instance()->setToWorking( $order_id );
    }
  }

  /**
   * set finish order.
   */
  public function setFinishOrder( $arg = [] ) {
    $order_id = isset($arg['order_id']) ? $arg['order_id'] : false;
    if ( $order_id ) {
      $colli = isset($arg['colli']) ? $arg['colli'] : 0;
      $placement = isset($arg['placement']) ? $arg['placement'] : 0;
      //set status
      WWH_Orders_WareHouseStatus::get_instance()->setToDone( $order_id );
      WWH_Orders_Meta::get_instance()->colli([
        'post_id' => $order_id,
        'action' => 'u',
        'value' => $colli
      ]);
      WWH_Orders_Meta::get_instance()->placement([
        'post_id' => $order_id,
        'action' => 'u',
        'value' => $placement
      ]);
    }
  }

}//
