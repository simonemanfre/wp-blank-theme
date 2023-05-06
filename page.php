<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php /*HERO ?>
        <header class="c-hero">
            <div class="l-container">
                <figure class="c-hero__picture">
                    <?php 
                    if(get_field('hero_img')):
                        echo wp_get_attachment_image(get_field('hero_img'), 'hero', false, array('class' => 'nolazy', 'loading' => false, 'fetchpriority' => 'high'));
                    else:
                        the_post_thumbnail('hero', array('class' => 'nolazy', 'loading' => false, 'fetchpriority' => 'high'));
                    endif;
                    ?>
                </figure>

                <article class="c-hero__content">
                    <ul class="c-breadcrumbs">
                        <?php 
                        //BREADCRUMBS
                        if(function_exists('bcn_display')):
                            bcn_display_list();
                        endif;
                        ?>
                    </ul>

                    <h1 class="c-hero__title t-title t-title--1"><?php echo get_field('hero_title') ?: get_the_title(); ?></h1>

                    <?php if(get_field('hero_subtitle')): ?>
                        <p class="c-hero__subtitle"><?php the_field('hero_subtitle') ?></p>
                    <?php endif; ?>

                    <?php if(get_field('hero_button_label')): ?>
                        <a href="<?php the_field('hero_button_url') ?>" class="c-hero__button c-button"><?php the_field('hero_button_label') ?></a>
                    <?php endif; ?>
                </article>               
            </div>
        </header>
        <?php */ ?>

    <?php endwhile; endif; ?>

<?php get_footer(); ?>