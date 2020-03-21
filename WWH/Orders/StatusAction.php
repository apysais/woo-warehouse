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
  public function show( $arg = []) {
    $status = 'new';
    $html = '';

    if ( isset($arg['status']) && $arg['status'] == 'new' ) {
      $html = "<a href='?action=set-order&status=new' class='btn btn-info'>";
        $html .= "New";
      $html .= "</a>";
    }

    echo $html;
  }

}//
