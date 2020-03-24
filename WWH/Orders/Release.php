<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Release Info.
**/
class WWH_Orders_Release
{
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

  public function show( $arg = [] ) {
    $data = [];
    $post_id = $arg['order_id'];
    if ( WWH_User_Check::get_instance()->is_admin() && WWH_Orders_WareHouseStatus::get_instance()->get($post_id) == 'new' ) {
      $data = [
        'order_id' => $post_id
      ];
      WWH_View::get_instance()->public_partials( 'orders/release.php', $data );
    }
  }

  public function showReleased( $arg = [] ) {
    $data = [];
    $post_id = $arg['order_id'];
    if ( ( WWH_User_Check::get_instance()->is_admin() || WWH_User_Check::get_instance()->is_warehouse() )
				&& ( WWH_Orders_WareHouseStatus::get_instance()->get($post_id) == 'released' || WWH_Orders_WareHouseStatus::get_instance()->get($post_id) == 'working' )
		) {
      $data = [
        'order_id' => $post_id
      ];

      WWH_View::get_instance()->public_partials( 'orders/start.php', $data );
    }
  }

  public function showNotes( $arg = [] ) {
    $data = [];
    $post_id = $arg['order_id'];

		WWH_Orders_Notes::get_instance()->showInternal($post_id);
  }


}//
