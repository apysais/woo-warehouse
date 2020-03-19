<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       apyc.com
 * @since      1.0.0
 *
 * @package    Woo_Warehouse
 * @subpackage Woo_Warehouse/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woo_Warehouse
 * @subpackage Woo_Warehouse/includes
 * @author     allan paul casilum <allan.paul.casilum@gmail.com>
 */
class Woo_Warehouse_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woo-warehouse',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
