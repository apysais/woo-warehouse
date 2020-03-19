<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Template Include.
**/
class WWH_TemplateInclude
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
    add_filter( 'template_include', [$this, 'wharehouseTemplate'], 99 );
  }

  public function wharehouseTemplate( $template ) {

    if ( is_page( 'wharehouse' )  ) {
        $action = '';
        if ( isset( $_GET['action'] ) ) {
          $action = $_GET['action'];
        }
        $args = [
          'action' => $action
        ];
        return WWH_Dashboard_Index::get_instance()->route( $args );
    }

    return $template;
  }


}//
