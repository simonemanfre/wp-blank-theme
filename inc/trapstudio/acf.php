<?php
//TODO DISABILITO EDITOR VISUALE ACF
//add_filter('acf/settings/show_admin', 'false');

//PAGE OPTION
$dati_tema = wp_get_theme();
$title_option_page = 'Opzioni '.$dati_tema->Name;

acf_add_options_sub_page(array(
    'page_title' 	    => $title_option_page,
    'menu_slug' 	    => 'theme-options',
    'parent_slug'       => 'themes.php',
    'update_button'     => __('Aggiorna', 'blank'),
    'updated_message'   => __("Opzioni aggiornate", 'blank'),
));


// GUTENBERG CATEGORIES REGISTRATION
function trp_block_categories( $categories, $block_editor_context ) {
    return array_merge(
        array(
            array(
                'slug' => 'custom',
                'title' => get_option('blogname'),
                'icon'  => 'customizer',
            ),
            array(
                'slug' => 'wp_default',
                'title' => 'Default',
                'icon'  => 'wordpress',
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'trp_block_categories', 10, 2 );


//GUTENBERG BLOCKS REGISTRATION
function trp_register_acf_blocks() {
    //TODO REGISTRARE BLOCCHI GUTENBERG QUI
    //register_block_type( THEME_DIR . '/partials/blocks/custom-block' );
}
add_action( 'init', 'trp_register_acf_blocks' );


// API KEY
function trp_acf_init() {

    acf_update_setting('google_api_key', get_field('api', 'option'));

}
add_action('acf/init', 'trp_acf_init');


//VISUALIZZO CUSTOM FIELD VOCI DI MENÙ
/*
function my_wp_nav_menu_objects( $items, $args ) {
    foreach( $items as $item ) {
        
        $description = get_field('description', $item);
        
        if( $description ) {
            $item->title .= '<span>'.$description.'</span>';
        }
    }

    return $items;
}
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
*/