<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Controller for the wharehouse page.
 * @since 0.0.1
 * */
class WWH_InitController extends WWH_Base {
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

	public function dashboard()
	{
		$data = [];
		$post_id = 0;
		$store_db = false;
		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];
			$store_db = tcf_get_complete_meta($post_id, 'tcf_mail_data');
		}
		$data['store_db'] = $store_db;
		TCF_View::get_instance()->admin_partials('data/index.php', $data);
	}


	/**
	 * Controller
	 *
	 * @param	$action		string | empty
	 * @parem	$arg		array
	 * 						optional, pass data for controller
	 * @return mix
	 * */
	public function controller($action = '', $arg = array()){
		$this->call_method($this, $action);
	}

	public function __construct(){}

}//
