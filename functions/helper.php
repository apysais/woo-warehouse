<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wwh_dd( $arr = [] ) {
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

function wwh_bootstrap_pagination( $object, $echo = true ) {
	$big = 999999999; // need an unlikely integer

	$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $object->max_num_pages,
			'type'  => 'array',
			'prev_next'   => true,
			'prev_text'    => __('« Prev'),
			'next_text'    => __('Next »'),
		)
	);

	if( is_array( $pages ) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

		$pagination = '<nav aria-label="Page navigation example">';
		$pagination .= '<ul class="pagination">';

		foreach ( $pages as $page ) {
			$pagination .= "<li class='page-item'>$page</li>";
		}

		$pagination .= '</ul>';
		$pagination .= '</nav>';

		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}
}

// function login_failed() {
//     $login_page = get_home_url();
//     wp_redirect($login_page . '?login=failed');
//     exit;
// }
// add_action('wp_login_failed', 'login_failed');

function wwh_verify_username_password($user, $username, $password) {
	$referrer = $_SERVER['HTTP_REFERER'];
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
		$login_page = home_url(WWH_PAGE_URL . "/?action=dashboard");
		if ($username == "" || $password == "") {
        wp_redirect($login_page);
        exit;
    }
	}
}
add_filter('authenticate', 'wwh_verify_username_password', 1, 3);
