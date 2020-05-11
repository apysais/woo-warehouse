<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Base Class Utility
 * */
abstract class WWH_Base extends WWH_BaseController{
	/**
	 * holds the error
	 *
	 * @var		$array_error		array
	 * */
	public $array_error = array();

	/**
	 * Set input error
	 *
	 * @param		$array_error		array
	 * @return	void
	 * */
	public function set_input_error($array_error){
		$this->array_error = $array_error;
	}

	/**
	 * Get input error
	 *
	 * @see		public $array_error
	 * @return		array
	 * */
	public function get_input_error(){
		return $this->array_error;
	}
}
