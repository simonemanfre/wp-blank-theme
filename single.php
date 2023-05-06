<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <ul class="c-breadcrumbs">
            <?php 
            /*
            //BREADCRUMBS
            if(function_exists('bcn_display')):
                bcn_display_list();
            endif;
            */
            ?>
        </ul>


    <?php endwhile; endif; ?>

<?php get_footer(); ?>