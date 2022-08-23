<?php
function modules_shortcode() {

    ob_start();

    $options = get_field('options');


    echo '<div class="row align-items-end">';
    if(have_rows('modules')): while(have_rows('modules')): the_row();
    $videoOptions = get_sub_field('video_options');
    $title = get_sub_field('title');
    $video = get_sub_field('video');
    $oembed = get_sub_field('oembed');

    echo '<div class="col-md-6 pt-5">';

    echo '<h3>' . $title . '</h3>';
    if($videoOptions == "Video"){
        echo '<video controls class="w-100 h-auto" src="/wp-content/themes/insideoutcreative/assets/' . $video . '#t=1"></video>';
    } elseif($videoOptions == "oEmbed"){
        echo $oembed;
    }

    echo '</div>';
    
    endwhile; endif;
    echo '</div>';


    $output = ob_get_clean();
     return $output;

 }

 add_shortcode( 'modules', 'modules_shortcode' );

?>