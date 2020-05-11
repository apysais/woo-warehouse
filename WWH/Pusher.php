<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * WWH_Pusher
 * */
class WWH_Pusher {
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

  }

  public function pushNotification( $arg = [] ) {
    $data = $arg['data'];
    $channel = $arg['channel'];
    $event = $arg['event'];

		$options = array(
	    'cluster' => 'eu',
	    'useTLS' => true
	  );

		$pusher = new Pusher\Pusher(
	    'ec2fd4c2152b2cf0cfc2',
	    '3454ffcbe858e0cb00e9',
	    '998785',
	    $options
	  );

    $pusher->trigger($channel, $event, $data);
  }

  public function newOrder() {
    $this->pushNotification([
      'data' => [
        'order' => 'new'
      ],
      'channel' => 'warehouse',
      'event' => 'order',
    ]);
  }

  public function notifyWareHouse() {
    $this->pushNotification([
      'data' => [
        'order' => 'notify'
      ],
      'channel' => 'warehouse',
      'event' => 'order',
    ]);
  }

	public function doneOrders() {
		$this->pushNotification([
      'data' => [
        'order' => 'done'
      ],
      'channel' => 'orders-done',
      'event' => 'order',
    ]);
	}

}//
