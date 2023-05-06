<?php 
//COMPOSER ACF
$composer = get_field('composer');
if($composer): 
    foreach($composer as $args):

        get_template_part('partials/composer/c', $args['acf_fc_layout'], $args);

    endforeach; 
endif;
?>