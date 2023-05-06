<?php 
//category
$cats = get_the_category();
echo $cats[0]->name;
echo get_category_link($tags[0]);

//tags
$tags = get_the_tags(); 
echo $tags[0]->name;
echo get_tag_link($tags[0]);

//custom taxonomy (change fields or post_id if needed)
$taxs = wp_get_object_terms($post->ID, 'taxonomy', array('fields'=>'ids'));
echo get_term_link($taxs[0], 'taxonomy');
?>

<?php the_permalink() ?>

<?php the_post_thumbnail('large') ?>

<?php the_title() ?>

<?php the_excerpt() ?>

<?php echo get_the_date() ?>
