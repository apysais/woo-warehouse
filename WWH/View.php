<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * View Class | Singleton
 *
 * this render html template across plugin also can render template
 * there is a magic class a setter and getter we can use it also if we instantiate the class
 * sample:
 *
 *
 * @since 3.12
 * @access (protected, public)
 * */
class WWH_View{
	/**
	 * instance of this class
	 *
	 * @since 3.12
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

    /**
     * use for magic setters and getter
     * we can use this when we instantiate the class
     * it holds the variable from __set
     *
     * @see function __get, function __set
     * @access protected
     * @var array
     * */
    protected $vars = array();

    public function __construct() {}

    /**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
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

	/**
	 * get current view folder
	 *
	 * @since 3.12
	 * @access public
	 *
	 * @return path / string
	 * */
	public function get_view_folder(){
		return wwh_get_plugin_dir();
	}

	/**
	 * check and get template in theme
	 *
	 * this check if the current template file is in the current theme
	 * this is usefull in shortcodes where we assign page via doc comment
	 *
	 * @since 3.12
	 * @access public
	 * @param		string		$template_file
	 * @return string | bool, if the file exists return the directory path, else false
	 * */
	public function get_in_theme($template_file){
		if( defined('STYLESHEETPATH') && defined('TEMPLATEPATH') ){
			if( locate_template($template_file) ){
				return locate_template($template_file);
			}
		}

		return false;
	}

	/**
	 * check and get template/file in plugin
	 *
	 * this check if the current template file is in the plugin
	 * this is primarily use for getting template file inside plugin only
	 * for backend view purposes
	 *
	 * @since 3.12
	 * @access public
	 * @param		string		$template_file
	 * @return string | bool, if the file exists return the directory path, else false
	 * */
	public function get_in_plugin($template_file){
		$template = $this->get_view_folder() . $template_file;
		if( file_exists($template) ){
			//check in plugin
			return $template;
		}else{
			return false;
		}
	}

	/**
	 * check and get template/file in wp-content
	 *
	 * this check if the current template file is in the plugin
	 * this is primarily use for getting template file inside plugin only
	 * for backend view purposes
	 *
	 * @since 3.12
	 * @access public
	 * @param		string		$template_file
	 * @return string | bool, if the file exists return the directory path, else false
	 * */
	public function get_in_wp_content($template_file){
		$template = WP_CONTENT_DIR . $template_file;
		if( file_exists($template) ){
			//check in plugin
			return $template;
		}else{
			return false;
		}
	}

	/**
	 * check and get template/file in admin/partials
	 *
	 * this check if the current template file is in the plugin
	 * this is primarily use for getting template file inside plugin only
	 * for backend view purposes
	 *
	 * @since 3.12
	 * @access public
	 * @param		string		$template_file
	 * @return string | bool, if the file exists return the directory path, else false
	 * */
	public function admin_part_partials($template_file){
		$template = 'admin/partials/' . $template_file;
		$template_admin = $this->get_in_plugin($template);
		if( file_exists($template_admin) ){
			return $template_admin;
		}else{
			return false;
		}
	}

	/**
	 * check and get template/file in public/partials/ folder
	 *
	 * this check if the current template file is in the plugin - public/partials
	 * this is primarily use for getting template file inside plugin only
	 * for backend view purposes
	 *
	 * @since 3.12
	 * @access public
	 * @param		string		$template_file
	 * @return string | bool, if the file exists return the directory path, else false
	 * */
	public function public_part_partials($template_file){
		$template = 'public/partials/' . $template_file;

		$template_public = $this->get_in_plugin($template);

		if( file_exists($template_public) ){
			return $template_public;
		}else{
			return false;
		}
	}

	/**
	 * get both template in theme or plugin
	 *
	 * we get both template file in theme first them plugin
	 *
	 * @since 3.12
	 * @access public
	 * @param	string	$template_file
	 * @return string | bool, if the file exists return the directory path, else false
	 * */
    public function get_view_part($template_file) {
		$template = '';

		//we check the template first
    if( $this->get_in_theme($template_file) ){
			//get template file in theme
			$template = $this->get_in_theme($template_file);
		}
		//if template exists return
		if( $template ){
			return $template;
		}
		return false;
    }

	/**
	 * require template file from current theme
	 *
	 * this only render template file on the theme use only
	 *
	 * @since 3.12
	 * @access public
	 * @param	string	$template_file
	 * - the name of the file to be included
	 * @param	array	$data
	 * - set data to be pass in the template file, default is array
	 * @return require if exists else false
	 * */
	public function view_theme($template_file, $data = array()){
		extract($data);
		$template = $this->get_in_theme($template_file);
		if( $template ){
			//check in plugin
			require $template;
		}else{
			return false;
		}
	}

	/**
	 * display the template file
	 * doesn't use the method get_view_folder()
	 * it check for file exists first then it display
	 *
	 * @since 3.12
	 * @access public
	 * @param	string	$template_file
	 * @param	array	$data
	 * @return require | bool, if the file exists return the directory path, else false
	 * */
	public function admin_partials($template_file, $data = array(), $require_once = false){

		/**
		 * path to admin template
		 * */
		$template_admin = $this->admin_part_partials($template_file);

		/**
		 * extract the data so it will be variable only
		 * sample:
		 * $data['one'] = 1;
		 * would be $one and echo 1
		 * */
		extract($data);

		if( file_exists($template_admin) ){
			if(!$require_once) {
				require $template_admin;
			}else{
				require $template_admin;
			}
		}
		return false;
	}

	/**
	 * display the template file
	 * doesn't use the method get_view_folder()
	 * it check for file exists first then it display
	 *
	 * @since 3.12
	 * @access public
	 * @param	string	$template_file
	 * @param	array	$data
	 * @return require | bool, if the file exists return the directory path, else false
	 * */
	public function public_partials($template_file, $data = array(), $require_once = false){
		/**
		 * path to admin template
		 * */
		$template_public = $this->public_part_partials($template_file);
		/**
		 * extract the data so it will be variable only
		 * sample:
		 * $data['one'] = 1;
		 * would be $one and echo 1
		 * */
		extract($data);
		if( file_exists($template_public) ){
			if(!$require_once) {
				require $template_public;
			}else{
				require_once $template_public;
			}
		}
		return false;
	}

	/**
	 * display the template file directly
	 * doesn't use the method get_view_folder()
	 * it check for file exists first then it display
	 *
	 * @since 3.12
	 * @access public
	 * @param	string	$template_file
	 * @param	array	$data
	 * @return require | bool, if the file exists return the directory path, else false
	 * */
	public function display($template_file, $data = array(), $require = true){
		/**
		 * extract the data so it will be variable only
		 * sample:
		 * $data['one'] = 1;
		 * would be $one and echo 1
		 * */
		extract($data);
		if( file_exists($template_file) ){
			//check in plugin
			$template_file = apply_filters('wwh_display_template_file', $template_file, $data, 10, 2);
			if( $require ){
				require $template_file;
			}else{
				return $template_file;
			}
		}else{
			return false;
		}
	}

	/**
	 * use object instantiate class
	 * */
    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

	/**
	 * use object instantiate class
	 * */
    public function __get($name) {
		if( isset($this->vars[$name]) ){
			return $this->vars[$name];
		}
    }

}
