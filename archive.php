<?php
get_header(); 

//PAGINA BLOG
$blog_page = get_option('page_for_posts');

//OGGETTO CORRENTE
$current_cat = get_queried_object();

//echo $current_cat->name;
//echo $current_cat->description;
//$custom_field = get_field('field_name', $current_cat);

/*
QUERY ESEMPIO CATEGORIA CORRENTE CON PAGINAZIONE
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; 

$args_category = array(
    'posts_per_page' => 2,
    'paged' => $paged,
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy'  => 'category',
            'field'     => 'term_id',
            'terms'     => $current_cat->term_id
        ),
    ),
);
$query_category = trp_query($args_category);

if($query_category->have_posts()):
    while($query_category->have_posts()): $query_category->the_post();
            
        //POST QUI

    endwhile;
endif;
wp_reset_query();
*/
?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


    <?php endwhile; endif; ?>

    <?php /*INFINITE SCROLL NO BUTTON ?>
    <footer class="c-loader">
        <?php 
        $next_link = get_next_posts_page_link($query_posts->max_num_pages); 
        if($next_link):
        ?>
            <a class="c-button j-next-button" href="<?php echo $next_link ?>">Mostra di più</a>
        <?php endif; ?>

        <p class="infinite-scroll-request u-align-center">
            <svg class="c-spinner" width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg>
        </p>
    </footer>
    <?php */ ?>

<?php get_footer(); ?>