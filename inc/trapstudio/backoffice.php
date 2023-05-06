<?php 
//ADMIN STYLE E SCRIPT
function trp_admin_scripts_and_css() {
    wp_enqueue_style( 'admin', THEME_URL . '/assets/css/admin.css', array(), null);
    wp_enqueue_script( 'admin', THEME_URL . "/assets/js/admin.js", array(), '1.0', true);
}
add_action( 'admin_enqueue_scripts', 'trp_admin_scripts_and_css' );


//ABILITO SOLO ALCUNI BLOCCHI GUTEBERG
/*
function trp_allowed_block_types() {
	return array(
		'acf/custom-block',
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/quote',
		'core/image',
		'core/media-text',
		'core/freeform',
		'core/spacer',
		'core/html',
		'core/separator',
		'core/shortcode',
		'contact-form-7/contact-form-selector',
	);
}
add_filter( 'allowed_block_types_all', 'trp_allowed_block_types' );
*/


//DISABLE EDITOR FULLSCREEN BY DEFAULT
function ghub_disable_editor_fullscreen_mode() {
	$script = "window.onload = function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } }";
	wp_add_inline_script( 'wp-blocks', $script );
}
add_action( 'enqueue_block_editor_assets', 'ghub_disable_editor_fullscreen_mode' );


//MOVE YOAST SETTINGS PANEL IN EDITOR TO BOTTOM
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


//REDIRECT DASHBOARD
function trp_get_dashboard_url() {
    /*
    * Modificare url dashboard 
    * oppure ricordarsi di assegnare il template p-dashboard.php
    */
    $args = array(
        'posts_per_page' => 1,
        'post_type' => 'page',
        'meta_key' => '_wp_page_template',
        'meta_value' => 'p-dashboard.php',
        'fields' => 'ids'
    );
    $admin_page = get_posts($args);
    if($admin_page):
        $url = get_the_permalink($admin_page[0]);
    else:
        $url = HOME_URL;
    endif;

    return $url;
}

//hide dashboard for users
function trp_admin_redirect() {
    $current_user = wp_get_current_user();

    //se l'utente è sottoscrittore e non sto facendo una chiamata ajax
    if (in_array('subscriber', $current_user->roles) && !wp_doing_ajax() ) {
        $url = trp_get_dashboard_url();

        wp_safe_redirect( $url);
        exit;
    }
}
add_action( 'admin_init', 'trp_admin_redirect', 1 );

//redirect after login
function trp_login_redirect( $redirect_to, $request, $user ){
    $current_user = wp_get_current_user();

    //se l'utente non è amministratore
    if(!in_array('administrator', $current_user->roles)):

        //cambiare redirect qui
        return $redirect_to;

    else:

        return $redirect_to;

    endif;
}
add_filter( 'login_redirect', 'trp_login_redirect', 10, 3 );


// CUSTOM LOGIN

//logo url + title
function trp_login_logo_url() {
    return HOME_URL;
}
add_filter( 'login_headerurl', 'trp_login_logo_url' );

function trp_login_logo_url_title() {
    return get_option('blogname');
}
add_filter( 'login_headertext', 'trp_login_logo_url_title' );

//login css inline
function trp_login_inline_css() {
    /*
    PRENDERE VALORI CAMPI ACF OPTIONS
    $color1 = get_field('colore_primario', 'option');
    $color2 = get_field('colore_secondario', 'option');
    $text_color1 = get_field('colore_testo_primario', 'option');
    $text_color2 = get_field('colore_testo_secondario', 'option');

    <style type="text/css">
        AGGIUNGERE VARIABILI CSS AL LOGIN
        :root {
        --primary-color: <?php echo $color1 ?>;
        --secondary-color: <?php echo $color2 ?>;
        --text-primary-color: <?php echo $text_color1 ?>;
        --text-secondary-color: <?php echo $text_color2 ?>;
        }
    </style>
    */
?>
    <?php if(get_field('contact_logo', 'option')): ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo wp_get_attachment_image_url(get_field('contact_logo','option'), 'large'); ?>);
            }
        </style>
    <?php endif; ?>
<?php
}
add_action('login_head', 'trp_login_inline_css');

//login style e script
/*
function trp_login_scripts_and_css() {
    $dati_tema = wp_get_theme();

    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/login.css', $dati_tema->Version );
    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/assets/js/login.js', $dati_tema->Version, true );
}
add_action( 'login_enqueue_scripts', 'trp_login_scripts_and_css' );
*/

/*
//login message
function trp_login_message() {
    if($_GET['action'] == 'register'):
        return '<h2>Aggiungere messaggio form Registrazione</h2>';
    else:
        return '<h2>Aggiungere messaggio form Login</h2>';
    endif;
}
add_filter( 'login_message', 'trp_login_message' );

//login form
function trp_login_form() {
    echo '<p><strong>aggiungere cose extra al form di login qui</strong></p>';
}
add_action( 'login_form', 'trp_login_form' );

//register form
function trp_register_form() {
    echo '<p><strong>aggiungere cose extra al form di registrazione qui</strong></p>';
}
add_action( 'register_form', 'trp_register_form' );

//login footer
function trp_login_footer() {
    echo 'FOOTER';
}
add_action( 'login_footer', 'trp_login_footer' );
*/