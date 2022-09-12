<?php
/**
 * Template Name: Free Consultation
*/

get_header();

if(have_rows('free_consultation_sections')): 
    while(have_rows('free_consultation_sections')): the_row();

    $options = get_sub_field('options');

    if($options = 'Content and 3 Columns plus Content'){
        if(have_rows('content_and_3_columns_plus_content')): 
            while(have_rows('content_and_3_columns_plus_content')): the_row();

            endwhile; 
        endif;
    } elseif($options = 'Content plus 3 Columns'){
        if(have_rows('content_plus_3_columns')): 
            while(have_rows('content_plus_3_columns')): the_row();

            endwhile; 
        endif;
    } elseif($options = 'Codearea'){
        echo get_sub_field('codearea');
    } elseif($options = 'Image plus Content'){
        if(have_rows('image_plus_content')): 
            while(have_rows('image_plus_content')): the_row();

            endwhile; 
        endif;
    }

    endwhile;
endif;

get_footer();

?>