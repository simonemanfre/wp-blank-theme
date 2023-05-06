<?php
get_header(); 

//PAGINA BLOG
$blog_page = get_option('page_for_posts');

//STICKY POSTS
$sticky = get_option('sticky_posts');

/*
QUERY ESEMPIO STICKY POSTS
$args_sticky = array(
    'posts_per_page' => 2,
    'post__in' => $sticky
);
$query_sticky = trp_query($args_sticky);

$exclude_ids = array();
if($query_sticky->have_posts()):
    while($query_sticky->have_posts()): $query_sticky->the_post();

        //array per escluderli dalla query successiva
        array_push($exclude_ids, $post);

        //POST QUI

    endwhile;
endif;
wp_reset_query();
*/

//TUTTI I POSTS:
/*
QUERY ESEMPIO TUTTI I POST CON PAGINAZIONE
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; 

$args_posts = array(
    'posts_per_page' => 500,
    'paged' => $paged,
);
$query_posts = trp_query($args_posts);

if($query_posts->have_posts()):
    while($query_posts->have_posts()): $query_posts->the_post();

        //escludo sticky posts
        if(!in_array($post, $exclude_ids)):
            
            //POST QUI

        endif;

    endwhile;
endif;
wp_reset_query();
*/
?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


    <?php endwhile; endif; ?>

    <?php
    /*
    //INFINITE SCROLL WITH BUTTON
    $next_link = get_next_posts_page_link($query_video->max_num_pages); 
    if($next_link):
    ?>
        <footer class="c-loader u-align-center">
            <button class="c-button c-button--loader j-next-button" type="button" href="<?php echo $next_link ?>"><?php _e('Guarda di più', 'blank') ?> <span class="c-button__loader"><svg class="c-spinner infinite-scroll-request" width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg></span></button>
        </footer>
    <?php endif; ?>

    <?php */?>

<?php get_footer(); ?>