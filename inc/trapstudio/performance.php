<?php 
/*TODO DISABLE GLOBAL STYLES IF NOT USED
function trp_remove_global_css() {
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
  remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
}
add_action('init', 'trp_remove_global_css');
*/

/*TODO MOVE JQUERY TO FOOTER
add_action( 'wp_default_scripts','trp_move_jquery_to_footer' );
function trp_move_jquery_to_footer( $wp_scripts ){
  if( !is_admin() ){
    $wp_scripts->add_data( 'jquery', 'group', 1 );
    $wp_scripts->add_data( 'jquery-core', 'group', 1 );
    $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
  }
}
*/

/*TODO WEBP
function trp_convert_image_to_webp( $formats ) {
	$formats['image/jpeg'] = 'image/webp';
    $formats['image/png'] = 'image/webp';

	return $formats;
};
add_filter( 'image_editor_output_format', 'trp_convert_image_to_webp' );

function trp_filter_image_quality( $quality, $mime_type ) {
    if ($mime_type === 'image/webp' || $mime_type === 'image/jpeg' || $mime_type === 'image/png') {
        return 80;
    }
    return $quality;
}
add_filter( 'wp_editor_set_quality', 'trp_filter_image_quality', 10, 2 );
*/