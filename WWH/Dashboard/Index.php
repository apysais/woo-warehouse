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

	public function route( $args = [] )	{

    $action = isset( $args['action'] ) ? $args['action'] : false;

    switch ( $action ) {
			case 'orders':
				add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getAll'], 100);
				break;
      case 'dashboard' :
      default :
        add_action('warehouse_data', [ WWH_Orders_Order::get_instance(), 'getNewOrders'], 100);
      	break;
    }

    return WWH_View::get_instance()->public_part_partials( 'dashboard/index.php' );

	}



}//
