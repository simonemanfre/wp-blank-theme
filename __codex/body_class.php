<?php
function my_body_class( $classes )
{	
	$include = array
	(
		// browsers/devices (https://codex.wordpress.org/Global_Variables)
		'is-iphone'            => $GLOBALS['is_iphone'],
		'is-chrome'            => $GLOBALS['is_chrome'],
		'is-safari'            => $GLOBALS['is_safari'],
		'is-ns4'               => $GLOBALS['is_NS4'],
		'is-opera'             => $GLOBALS['is_opera'],
		'is-mac-ie'            => $GLOBALS['is_macIE'],
		'is-win-ie'            => $GLOBALS['is_winIE'],
		'is-gecko'             => $GLOBALS['is_gecko'],
		'is-lynx'              => $GLOBALS['is_lynx'],
		'is-ie'                => $GLOBALS['is_IE'],
		'is-edge'              => $GLOBALS['is_edge'],
		// WP Query (already included by default, but nice to have same format)
		'is-archive'           => is_archive(),
		'is-post_type_archive' => is_post_type_archive(),
		'is-attachment'        => is_attachment(),
		'is-author'            => is_author(),
		'is-category'          => is_category(),
		'is-tag'               => is_tag(),
		'is-tax'               => is_tax(),
		'is-date'              => is_date(),
		'is-day'               => is_day(),
		'is-feed'              => is_feed(),
		'is-comment-feed'      => is_comment_feed(),
		'is-front-page'        => is_front_page(),
		'is-home'              => is_home(),
		'is-privacy-policy'    => is_privacy_policy(),
		'is-month'             => is_month(),
		'is-page'              => is_page(),
		'is-paged'             => is_paged(),
		'is-preview'           => is_preview(),
		'is-robots'            => is_robots(),
		'is-search'            => is_search(),
		'is-single'            => is_single(),
		'is-singular'          => is_singular(),
		'is-time'              => is_time(),
		'is-trackback'         => is_trackback(),
		'is-year'              => is_year(),
		'is-404'               => is_404(),
		'is-embed'             => is_embed(),
		// Mobile
		'is-mobile'            => wp_is_mobile(),
		'is-desktop' 		   => ! wp_is_mobile(),
		// Common
		'has-blocks'           => function_exists( 'has_blocks' ) && has_blocks(),
	);

	// Sidebars
	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) 
	{
		$include[ "is-sidebar-{$sidebar['id']}" ] = is_active_sidebar( $sidebar['id'] );
	}

	// Add classes

	foreach ( $include as $class => $do_include ) 
	{
		if ( $do_include ) $classes[ $class ] = $class;
	}

	// Return

	return $classes;
}

add_filter( 'body_class', 'my_body_class' );