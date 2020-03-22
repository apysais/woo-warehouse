<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              apyc.com
 * @since             1.2.0
 * @package           Woo_Warehouse
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Warehouse
 * Plugin URI:        apyc.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.2.0
 * Author:            allan paul casilum
 * Author URI:        apyc.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-warehouse
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOO_WAREHOUSE_VERSION', '1.2.0' );
define( 'WWH_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WWH_PAGE_URL', 'warehouse' );
/**
 * For autoloading classes
 * */
spl_autoload_register('wwh_directory_autoload_class');
function wwh_directory_autoload_class($class_name){
		if ( false !== strpos( $class_name, 'WWH' ) ) {
	 $include_classes_dir = realpath( get_template_directory( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	 $admin_classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
	 $class_file = str_replace( '_', DIRECTORY_SEPARATOR, $class_name ) . '.php';
	 if( file_exists($include_classes_dir . $class_file) ){
		 require_once $include_classes_dir . $class_file;
	 }
	 if( file_exists($admin_classes_dir . $class_file) ){
		 require_once $admin_classes_dir . $class_file;
	 }
 }
}
function wwh_get_plugin_details(){
 // Check if get_plugins() function exists. This is required on the front end of the
 // site, since it is in a file that is normally only loaded in the admin.
 if ( ! function_exists( 'get_plugins' ) ) {
	 require_once ABSPATH . 'wp-admin/includes/plugin.php';
 }
 $ret = get_plugins();
 return $ret['woo-warehouse/woo-warehouse.php'];
}

/**
* get the text domain of the plugin.
**/
function wwh_get_text_domain(){
 $ret = wwh_get_plugin_details();
 return $ret['TextDomain'];
}

/**
* get the plugin directory path.
**/
function wwh_get_plugin_dir(){
 return plugin_dir_path( __FILE__ );
}

/**
* get the plugin url path.
**/
function wwh_get_plugin_dir_url(){
 return plugin_dir_url( __FILE__ );
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-warehouse-activator.php
 */
function activate_woo_warehouse() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-warehouse-activator.php';
	Woo_Warehouse_Activator::activate();

	add_role( 'warehouse_role', 'Warehouse', get_role( 'author' )->capabilities );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-warehouse-deactivator.php
 */
function deactivate_woo_warehouse() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-warehouse-deactivator.php';
	Woo_Warehouse_Deactivator::deactivate();

	remove_role( 'warehouse_role' );
}

register_activation_hook( __FILE__, 'activate_woo_warehouse' );
register_deactivation_hook( __FILE__, 'deactivate_woo_warehouse' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-warehouse.php';

require plugin_dir_path( __FILE__ ) . 'functions/helper.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_warehouse() {

	$plugin = new Woo_Warehouse();
	$plugin->run();

	show_admin_bar(false);

	WWH_TemplateInclude::get_instance();
}
//run_woo_warehouse();
add_action('plugins_loaded', 'run_woo_warehouse');

function wwh_init() {
	WWH_Dashboard_Index::get_instance()->postSubmit();
}
add_action( 'init', 'wwh_init' );
