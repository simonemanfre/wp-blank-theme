<?php 
/**
* CODEX: https://developer.wordpress.org/reference/functions/wp_get_object_terms/
* EXAMPLE: https://wp-kama.com/function/wp_get_object_terms
*/
 
wp_get_object_terms( $object_ids, $taxonomies, $args );

/*
ESEMPIO:

$taxs = wp_get_object_terms($post->ID, 'taxonomy', array('fields'=>'ids'));
*/

?>