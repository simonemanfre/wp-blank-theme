<?php 
/**
* CODEX: https://developer.wordpress.org/reference/classes/wp_term_query/get_terms/
* EXAMPLE: https://wp-kama.com/function/get_terms
*/
 
$args = [
	'taxonomy'      => [ 'post_tag', 'my_tax' ], // tax name WP 4.5
	'orderby'       => 'id',
	'order'         => 'ASC',
	'hide_empty'    => true,
	'object_ids'    => null,
	'include'       => array(),
	'exclude'       => array(),
	'exclude_tree'  => array(),
	'number'        => '',
	'fields'        => 'all',
	'count'         => false,
	'slug'          => '',
	'parent'         => '',
	'hierarchical'  => true,
	'child_of'      => 0,
	'get'           => '', // set `all` to get all terms
	'name__like'    => '',
	'pad_counts'    => false,
	'offset'        => '',
	'search'        => '',
	'cache_domain'  => 'core',
	'name'          => '',    // to get terms by name field.
	'childless'     => false, // true - pass the terms which has child terms.
	'update_term_meta_cache' => true,
	'meta_query'    => '',
];

$terms = get_terms( $args );

foreach( $terms as $term ){
	print_r( $term );
}

?>