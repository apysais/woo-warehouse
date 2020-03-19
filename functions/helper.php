<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wwh_dd( $arr = [] ) {
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}
