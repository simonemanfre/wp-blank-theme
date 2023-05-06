<?php 
function trp_site_scripts_and_css() {
    $dati_tema = wp_get_theme();

    //VARIABILI DA PASSARE A JS
    $var_array = array();
    $var_array['homeUrl'] = HOME_URL;   
    $var_array['themeUrl'] = THEME_URL;
    
    //cf7
    if (function_exists('wpcf7')):
        $var_array['cf7'] = 1;
    endif;
    
    //woocommerce
    if( class_exists('woocommerce') ):
        $var_array['woocommerce'] = 1;
        //wp_dequeue_style( 'wc-block-style' ); //TODO REMOVE WOOCOMMERCE BLOCK CSS IF NOT USED
    endif;

    
    /*TODO REMOVE CSS DEFAULT IF NOT USED
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'wp-block-library' );
    */


    //TODO REGISTER STYLES AND SCRIPTS USED
    //usare siteScripts-blocking solo per il JS che ha bisogno di caricarsi insieme all'HTML per renderizzarlo (non usare jQuery in questo file, il rendering delle pagine non deve dipendere da jQuery)
    
    //FILE CSS
    wp_enqueue_style( 'normalize', THEME_URL . "/assets/css/normalize.css", array(), $dati_tema->Version);
    wp_register_style( 'app', THEME_URL . "/assets/css/app.css", array('normalize'), $dati_tema->Version);
    //wp_enqueue_style( 'general', THEME_URL . "/assets/css/general.css", array('normalize'), $dati_tema->Version);
    wp_register_style( 'style', THEME_URL . "/style.css", array('normalize'), $dati_tema->Version);
    
    //FILE SCRIPTS
    //wp_enqueue_script( 'headroom', THEME_URL . "/assets/js/headroom.min.js", array('jquery'), $dati_tema->Version, true);
    //wp_register_script( 'siteScripts-blocking', THEME_URL . "/assets/js/scripts-blocking.js", array(), $dati_tema->Version, true );
    wp_register_script( 'siteScripts', THEME_URL . "/assets/js/scripts.js", array('jquery'), $dati_tema->Version, true );
    

    //INFINITE SCROLL IN PAGINE ARCHIVIO
    /*
    if(is_home() || is_archive() || is_post_type_archive('post_type')):
        $var_array['infiniteScroll'] = 1;
        wp_enqueue_script( 'infinite-scroll', THEME_URL . "/assets/js/infinite-scroll.pkgd.min.js", array('jquery'), $dati_tema->Version, true);
    endif;
    */

    //SCROLLNAV SOLO IN SINGOLI POST O PAGINE
    /*
    if(is_single() || (is_page() && !is_page_template())):
        $var_array['scrollNav'] = 1;
        wp_enqueue_script( 'scrollnav', THEME_URL . "/assets/js/jquery.scrollNav.min.js", array('jquery'), $dati_tema->Version, true);
    endif;
    */

    //FANCYBOX PER MODAL E CAROUSEL SOLO DOVE SERVE
    /*
    if(is_front_page() || is_page_template('templates/p-page.php') || is_singular('post_type') || is_post_type_archive('post_type') || has_block('acf/reviews')):
        $var_array['fancybox'] = 1;
        wp_enqueue_style( 'fancybox', "https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css", array(), $dati_tema->Version);
        wp_enqueue_script( 'fancybox', "https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js", array(), $dati_tema->Version, true);
    endif;
    */
    

    //PASSO VARIABILI PHP A JAVASCRIPT        
    wp_localize_script('siteScripts', 'phpVars', $var_array );
    
    //ACCODO CSS + JS
    wp_enqueue_style('app');
    wp_enqueue_style('style');

    //wp_enqueue_script('siteScripts-blocking');
    wp_enqueue_script('siteScripts');
}
add_action( 'wp_enqueue_scripts', 'trp_site_scripts_and_css' );