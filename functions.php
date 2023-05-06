<?php
define('HOME_URL', get_home_url());
define('THEME_URL', get_template_directory_uri());
define('THEME_DIR', dirname(__FILE__) );

//TODO ENABLE CUSTOM POST TYPE
//require_once(THEME_DIR . '/inc/trapstudio/cpt.php');

require_once(THEME_DIR . '/inc/trapstudio/scripts.php');
require_once(THEME_DIR . '/inc/trapstudio/api.php');
require_once(THEME_DIR . '/inc/trapstudio/performance.php');
require_once(THEME_DIR . '/inc/trapstudio/htaccess.php');
require_once(THEME_DIR . '/inc/trapstudio/security.php');
require_once(THEME_DIR . '/inc/trapstudio/backoffice.php');

//ACF
if( function_exists('acf_add_options_page') ):
    require_once(THEME_DIR . '/inc/trapstudio/acf.php');
endif;

//CF7
if(function_exists('wpcf7')):
    require_once(THEME_DIR . '/inc/trapstudio/cf7.php');
endif;

//DISABLE COMMENTS (lascio attive le recensioni su woocommerce)
if( !class_exists('woocommerce') ):
    require_once(THEME_DIR . '/inc/trapstudio/comments.php');
endif;


//WOOCOMMERCE
if( class_exists('woocommerce') ):
    require_once(THEME_DIR . '/woocommerce/woocommerce.php');
endif;


//MENU
add_theme_support( 'nav-menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus( array('Primario' => __( 'Navigazione primaria', 'blank') ) );
    // register_nav_menus( array('Top' => __( 'Navigazione Top Bar', 'blank') ) );
	// register_nav_menus( array('Megamenu1' => __( 'Navigazione Megamenù 1', 'blank') ) );
	// register_nav_menus( array('Megamenu2' => __( 'Navigazione Megamenù 2', 'blank') ) );
	// register_nav_menus( array('Footer1' => __( 'Navigazione Footer 1', 'blank') ) );
	// register_nav_menus( array('Footer2' => __( 'Navigazione Footer 2', 'blank') ) );
}


//THUMBNAILS
//add custom thumbnails
add_theme_support('post-thumbnails' );
add_image_size('hero', 1900, 1900, false);
//add_image_size('card', 600, 600, false);

//remove default unused thumbnails
remove_image_size('medium_large');
remove_image_size('1536x1536');
remove_image_size('2048x2048');

//set default unused thumbnails to 0
update_option( 'medium_large_size_w', 0 );
update_option( 'medium_large_size_h', 0 );


//CAMBIO POST_PER_PAGINA NEI POST TYPES
function trp_posts_per_page( $query ) {
	if ( ! is_admin() && is_post_type_archive( 'post_type' ) ) {
		$query->set( 'posts_per_page', 3 );
		return;
	}
}
add_action( 'pre_get_posts', 'trp_posts_per_page' );


//AGGIUNGO SUPPORTO EXCERPT NELLE PAGINE
add_post_type_support('page', 'excerpt');


//LIMIT EXCERPT (Per limitare le parole dei riassunti)
/*
function tn_custom_excerpt_length( $length ) {
    return 10;
}
add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );
*/


//LIMITO REVISIONI POSTS
add_filter( 'wp_revisions_to_keep', 'filter_function_name', 10, 2 );

function filter_function_name( $num, $post ) {
    return 20;
}


//TIMESTAMP
function the_debug_timestamp(){
    echo date("YmdHis");
}
	
?>