<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Order Meta.
 * @since 0.0.1
 * */
class WWH_Orders_Meta {
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
  * colli.
  * @param array $args {
  *		Array of arguments.
  *		@type int $post_id the article id, required.
  *		@type bool $single this will return string if true else array if false. default is false.
  *		@type string $action CRUD action, default is read.
  *			accepted values: r (read), u (update), d (delete)
  *		@type string $prefix the prefix meta key.
  * }
  * @return  $action, r = get_post_meta(), u = update_post_meta(), d = delete_post_meta
  **/
  public function colli( $args = [] ) {
    $prefix = 'wh_colli';
    if ( isset ( $args['post_id'] ) ) {

      $defaults = array(
        'single'  => false,
        'action'  => 'r',
        'value'   => '',
        'prefix'  => $prefix
      );

      $args = wp_parse_args( $args, $defaults );

      switch( $args['action'] ) {
        case 'd':
          delete_post_meta( $args['post_id'], $args['prefix'], $args['value'] );
          break;
        case 'u':
          update_post_meta( $args['post_id'], $args['prefix'], $args['value'] );
          break;
        case 'r':
          return get_post_meta( $args['post_id'], $args['prefix'], $args['single'] );
          break;
      }
    }
  }

  /**
  * placement.
  * @param array $args {
  *		Array of arguments.
  *		@type int $post_id the article id, required.
  *		@type bool $single this will return string if true else array if false. default is false.
  *		@type string $action CRUD action, default is read.
  *			accepted values: r (read), u (update), d (delete)
  *		@type string $prefix the prefix meta key.
  * }
  * @return  $action, r = get_post_meta(), u = update_post_meta(), d = delete_post_meta
  **/
  public function placement( $args = [] ) {
    $prefix = 'wh_placement';
    if ( isset ( $args['post_id'] ) ) {

      $defaults = array(
        'single'  => false,
        'action'  => 'r',
        'value'   => '',
        'prefix'  => $prefix
      );

      $args = wp_parse_args( $args, $defaults );

      switch( $args['action'] ) {
        case 'd':
          delete_post_meta( $args['post_id'], $args['prefix'], $args['value'] );
          break;
        case 'u':
          update_post_meta( $args['post_id'], $args['prefix'], $args['value'] );
          break;
        case 'r':
          return get_post_meta( $args['post_id'], $args['prefix'], $args['single'] );
          break;
      }
    }
  }

}//
