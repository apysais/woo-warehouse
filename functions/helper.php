<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wwh_placement( $val = 0 ) {
	$arr = [
		1 => 'Kold hal',
		2	=> 'Varm hal',
		3 => 'Reol',
		4 => 'Reol ved bæk',
		5 => 'Ny hal',
		6 => 'Ny plads',
		7 => 'Ved bækken',
	];
	if ( $val == 0 ){
		return $arr;
	}else{
		return $arr[$val];
	}
}

function wwh_dd( $arr = [] ) {
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

function wwh_paginate_links( $args = '' ) {
    global $wp_query, $wp_rewrite;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $url_parts    = explode( '?', $pagenum_link );

    // Get max pages and current page out of the current query, if available.
    $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
    $current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

    $defaults = array(
        'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
        'format'             => $format, // ?page=%#% : %#% is replaced by the page number
        'total'              => $total,
        'current'            => $current,
        'aria_current'       => 'page',
        'show_all'           => false,
        'prev_next'          => true,
        'prev_text'          => __( '&laquo; Previous' ),
        'next_text'          => __( 'Next &raquo;' ),
        'end_size'           => 1,
        'mid_size'           => 2,
        'type'               => 'plain',
        'add_args'           => array(), // array of query args to add
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
    );

    $args = wp_parse_args( $args, $defaults );

    if ( ! is_array( $args['add_args'] ) ) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if ( isset( $url_parts[1] ) ) {
        // Find the format argument.
        $format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
        $format_query = isset( $format[1] ) ? $format[1] : '';
        wp_parse_str( $format_query, $format_args );

        // Find the query args of the requested URL.
        wp_parse_str( $url_parts[1], $url_query_args );

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ( $format_args as $format_arg => $format_arg_value ) {
            unset( $url_query_args[ $format_arg ] );
        }

        $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
    }

    // Who knows what else people pass in $args
    $total = (int) $args['total'];
    if ( $total < 2 ) {
        return;
    }
    $current  = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
    if ( $end_size < 1 ) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ( $mid_size < 0 ) {
        $mid_size = 2;
    }

    $add_args   = $args['add_args'];
    $r          = '';
    $page_links = array();
    $dots       = false;

    if ( $args['prev_next'] && $current && 1 < $current ) :
        $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current - 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="prev page-numbers page-link" href="%s">%s</a>',
            /**
             * Filters the paginated links for the given archive pages.
             *
             * @since 3.0.0
             *
             * @param string $link The paginated link URL.
             */
            esc_url( apply_filters( 'paginate_links', $link ) ),
            $args['prev_text']
        );
    endif;

    for ( $n = 1; $n <= $total; $n++ ) :
        if ( $n == $current ) :
            $page_links[] = sprintf(
                '<a href="#" class="page-link"><span aria-current="%s" class="page-numbers current">%s</span></a>',
                esc_attr( $args['aria_current'] ),
                $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
            );

            $dots = true;
        else :
            if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                $link = str_replace( '%#%', $n, $link );
                if ( $add_args ) {
                    $link = add_query_arg( $add_args, $link );
                }
                $link .= $args['add_fragment'];

                $page_links[] = sprintf(
                    '<a class="page-numbers page-link" href="%s">%s</a>',
                    /** This filter is documented in wp-includes/general-template.php */
                    esc_url( apply_filters( 'paginate_links', $link ) ),
                    $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
                );

                $dots = true;
            elseif ( $dots && ! $args['show_all'] ) :
                $page_links[] = '<span class="page-numbers dots sr-only">' . __( '&hellip;' ) . '</span>';

                $dots = false;
            endif;
        endif;
    endfor;

    if ( $args['prev_next'] && $current && $current < $total ) :
        $link = str_replace( '%_%', $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current + 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="next page-numbers page-link" href="%s">%s</a>',
            /** This filter is documented in wp-includes/general-template.php */
            esc_url( apply_filters( 'paginate_links', $link ) ),
            $args['next_text']
        );
    endif;

    switch ( $args['type'] ) {
        case 'array':
            return $page_links;

        case 'list':
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= join( "</li>\n\t<li>", $page_links );
            $r .= "</li>\n</ul>\n";
            break;

        default:
            $r = join( "\n", $page_links );
            break;
    }

    return $r;
}

function wwh_bootstrap_pagination( $object, $echo = true ) {
	$big = 999999999; // need an unlikely integer

	$pages = wwh_paginate_links( array(
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

function wwh_redirect_to( $url ) {
	?>
	<script type="text/javascript">
		window.location = '<?php echo $url; ?>';
	</script>
	<?php
	die();
}
