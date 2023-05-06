<?php
get_header();

global $wp_query;
global $query_string;

wp_parse_str( $query_string, $search_query );
$query_results = new WP_Query( $search_query );

//TITOLO RICERCA
$title = "{$query_results->post_count} risultati per “{$_GET['s']}”";
echo $title;
?>

<?php //FORM RICERCA ?>
<form role="search" method="GET" action="<?php echo HOME_URL; ?>" class="c-form c-form--search">
    <div class="c-form__field">
        <input type="text" name="s" id="input-search" value="<?php echo $_GET['s'] ?>">
        <button class="c-button">Cerca</button>
    </div>
</form>

<?php if($query_results->have_posts()): ?>

    <?php while($query_results->have_posts()): $query_results->the_post(); ?>

        <?php //RISULTATI RICERCA QUI ?>                    
    
    <?php endwhile; ?>

<?php
endif;
wp_reset_query();
?>

<?php get_footer() ?>