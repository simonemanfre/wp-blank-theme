<?php
function trp_whitelabel(){
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	remove_action( 'wp_head', 'wp_resource_hints', 2 );

	add_filter('the_generator','remove_wp_version_rss');

	function remove_wp_version_rss() {
	 return'';
	}

	//EMOJI
	function disable_wp_emojicons() {
	  // all actions related to emojis
	  remove_action( 'admin_print_styles', 'print_emoji_styles' );
	  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	  remove_action( 'wp_print_styles', 'print_emoji_styles' );
	  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

	  // filter to remove TinyMCE emojis
	  //add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
	}
	add_action( 'init', 'disable_wp_emojicons' );
}


function trp_xmlrpc_disable(){
	// Disable use XML-RPC
	add_filter( 'xmlrpc_enabled', '__return_false' );

	// Disable X-Pingback to header
	add_filter( 'wp_headers', 'disable_x_pingback' );
	function disable_x_pingback( $headers ) {
	    unset( $headers['X-Pingback'] );

	return $headers;
	}
}


trp_whitelabel();
trp_xmlrpc_disable();


//EDIT CAPABILIES FOR ADMINISTRATOR 
function trp_edit_role_caps() {
	$current_user = wp_get_current_user();

	if( in_array( $current_user->user_email, array('supporto@trapstudio.it', 'matteo@trapstudio.it', 'simone.manfredini@trapella.it', 'simone.manfredini@trapstudio.it', 'marzia.martinelli@trapstudio.it') ) ):
	
		//add custom capabilities for super admin
		$current_user->add_cap( 'trap_admin', true );

	else:

		//didsabilito editor tema e plugin
		if(get_field('capabilities_files_disabled', 'option')):
			define('DISALLOW_FILE_EDIT', TRUE);
		endif;

		//remove dangerous capability for other admin
		if(get_field('capabilities_themes_disabled', 'option')):
			$current_user->add_cap( 'upload_themes', false );
			$current_user->add_cap( 'install_themes', false );
			$current_user->add_cap( 'switch_themes', false );
			$current_user->add_cap( 'edit_themes', false );
			$current_user->add_cap( 'delete_themes', false );
		endif;

		if(get_field('capabilities_plugins_disabled', 'option')):
			$current_user->add_cap( 'upload_plugins', false );
			$current_user->add_cap( 'install_plugins', false );
			$current_user->add_cap( 'activate_plugins', false );
			$current_user->add_cap( 'edit_plugins', false );
			$current_user->add_cap( 'delete_plugins', false );
		endif;

		if(get_field('capabilities_updates_disabled', 'option')):
			$current_user->add_cap( 'update_plugins', false );
			$current_user->add_cap( 'update_core', false );
			$current_user->add_cap( 'update_themes', false );
		endif;

	endif;
}
add_action( 'init', 'trp_edit_role_caps', 11 );

/* DEBUG LOG 

INSERIRE IN WP-CONFIG.PHP:
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

UTILIZZO:
write_log($valore_da_stampare);

(Il file di debug si troverà in FTP dentro wp-content)
*/

if (!function_exists('write_log')) {
    function write_log($log) {
        if (WP_DEBUG === true) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}