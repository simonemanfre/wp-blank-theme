<!DOCTYPE html>
<html class="no-js" dir="ltr" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php echo get_option('blog_charset'); ?>">
    <meta name="theme-color" content="#000000">
    
    <title><?php wp_title(' - ', true, 'right'); ?> <?php if (!function_exists('wpseo_activate')): echo get_option('blogname'); endif; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<?php wp_head(); ?>
    
    <?php if(get_field('css_custom', 'option')): ?>
        <style>
            <?php the_field('css_custom', 'option'); ?>
        </style>
    <?php endif; ?>    
    
    <?php 
    if(get_field('html_header', 'option')):
        the_field('html_header', 'option');
    endif; 
    ?>
</head>

<?php 
/*
DA USARE NEI TEMPLATE PER AGGIUNGERE CLASSI AL BODY
$args['body_class'] = 'nome_classe';
get_header(null, $args); 
*/
?>
<body <?php if(isset($args['body_class'])): body_class($args['body_class']); else: body_class(); endif; ?>>

    <?php get_template_part('partials/svg', 'icons'); ?>

    <a class="c-skip-to-content" href="#main-content"><?php _e('Skip to content', 'wp-blank-theme') ?></a>

    <header id="header-content" class="c-site-header">
        <div class="c-site-header__content l-container">
            <a href="<?php echo HOME_URL; ?>" class="c-site-header__logo c-logo">
                <?php
                if(get_field('contact_logo', 'option')):
                    echo wp_get_attachment_image(get_field('contact_logo', 'option'), 'large', false, array('class' => 'nolazy', 'loading' => false, 'fetchpriority' => 'high'));
                else:
                    get_template_part('partials/svg', 'logo'); 
                endif;
                ?>
            </a> 
            
            <a href="#" class="c-toggle j-toggle">
                <span class="c-toggle__item"></span>
                <span class="c-toggle__item"></span>
                <span class="c-toggle__item"></span>
            </a>

            <nav class="c-site-nav">                          
                <ul class="c-site-nav__menu">
                    <?php
                    $args = array(
                        'theme_location' => 'Primario',
                        'depth'    => 1,
                        'items_wrap' => '%3$s',
                        'container' => ''
                    );
                    wp_nav_menu($args);
                    ?>
                </ul>

                <?php 
                //MEGAMENÙ
                /*
                ?>

                <section id="megamenu-header" class="c-megamenu">
                    <div class="l-container l-desktop-flex">
                        <ul class="c-megamenu__menu">
                            <?php
                            $args = array(
                                'theme_location' => 'Megamenu1',
                                'depth'    => 1,
                                'items_wrap' => '%3$s',
                                'container' => ''
                            );
                            wp_nav_menu($args);
                            ?>
                        </ul>

                        <ul class="c-megamenu__menu">
                            <?php
                            $args = array(
                                'theme_location' => 'Megamenu2',
                                'depth'    => 1,
                                'items_wrap' => '%3$s',
                                'container' => ''
                            );
                            wp_nav_menu($args);
                            ?>
                        </ul>                           
                    </div>
                </section>

                <?php */ ?>
            </nav> 
        </div>
    </header>

    <main id="main-content" class="l-main">