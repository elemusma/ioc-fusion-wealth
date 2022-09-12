<?php
/**
 * Template Name: Free Consultation
*/

get_header();

if(have_rows('free_consultation_sections')): 
    while(have_rows('free_consultation_sections')): the_row();

    $options = get_sub_field('options');

    if($options == 'Content and 3 Columns plus Content'){
        if(have_rows('content_and_3_columns_plus_content')): 
            while(have_rows('content_and_3_columns_plus_content')): the_row();
            $bgImg = get_sub_field('background_image');
            $image = get_sub_field('image');
            $style = get_sub_field('style');

            if($bgImg){
                echo '<section class="position-relative section-content-columns-image" style="padding:100px 0;background:url(' . $bgImg['url'] . ');background-size:cover;background-attachment:fixed;' . $style . '">';
            } else {
                echo '<section class="position-relative section-content-columns-image" style="padding:100px 0;">';
                // echo '</section>';
            }
            
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-md-6">';
            
            
            echo '<div class="" style="font-size:120%;">';
                echo get_sub_field('content');
                echo '</div>';

                if(have_rows('columns')):
                echo '<div class="row">';
                    while(have_rows('columns')): the_row();
                    echo '<div class="col-md-4">';

                    echo '<div class="d-flex">';

                    echo '<div class="mr-2" style="width:25px;">';
                    echo get_sub_field('icon');
                    echo '</div>';

                    echo get_sub_field('content');
                    echo '</div>';

                    echo '</div>';
                    endwhile;
                echo '</div>';
                endif;

            echo '</div>';

            if($image){
                echo '<div class="col-md-6">';

                echo wp_get_attachment_image($image['id'],'full','',['class'=>'w-100 h-100']);

            echo '</div>';
            }

            echo '</div>';
            echo '</div>';
            echo '</section>';

            endwhile; 
        endif;
        // echo 'h3llo';
    } elseif($options == 'Content plus 3 Columns'){

        // echo 'h3llooo';
        if(have_rows('content_plus_3_columns')): 
            while(have_rows('content_plus_3_columns')): the_row();

            $bgImg = get_sub_field('background_image');
            $image = get_sub_field('image');
            $style = get_sub_field('style');

            

            if($bgImg){
                echo '<section class="position-relative section-content-columns" style="padding:100px 0;background:url(' . $bgImg['url'] . ');background-size:cover;background-attachment:fixed;' . $style . '">';
            } else {
                echo '<section class="position-relative section-content-columns" style="padding:100px 0;' . $style . '">';
                // echo '</section>';
            }
            
            echo '<div class="container">';
            echo '<div class="row justify-content-center">';
            echo '<div class="col-md-9 text-center pb-5">';
            
            
            echo '<div class="" style="font-size:120%;">';
                echo get_sub_field('content');
                echo '</div>';

                

            echo '</div>';

            echo '</div>';

            if(have_rows('columns')):
                echo '<div class="row">';
                    while(have_rows('columns')): the_row();
                    echo '<div class="col-md-4">';

                    echo '<div class="d-flex">';

                    echo '<div class="mr-2 col-icon-content-columns" style="">';
                    echo get_sub_field('icon');
                    echo '</div>';
                    
                    
                    echo '<div class="" style="">';
                    echo get_sub_field('content');
                    echo '</div>';
                    echo '</div>';

                    echo '</div>';
                    endwhile;
                echo '</div>';
                endif;

                if(get_sub_field('content_below')):
                echo '<div class="row justify-content-center pt-5">';
                echo '<div class="col-md-9 pb-5">';
                            
                echo '<div class="" style="font-size:120%;">';
                    echo get_sub_field('content_below');
                    echo '</div>';
    
                echo '</div>';
                echo '</div>';
                endif;

            echo '</div>';
            echo '</section>';
            endwhile; 
        endif;

    } elseif($options == 'Codearea'){
        if(have_rows('codearea')): 
            while(have_rows('codearea')): the_row();
            $bgImg = get_sub_field('background_image');

            if($bgImg){
                echo '<section class="position-relative section-content-columns" style="padding:100px 0;background:url(' . $bgImg['url'] . ');background-size:cover;background-attachment:fixed;' . $style . '">';
            } else {
                echo '<section class="position-relative section-content-columns" style="padding:100px 0;' . $style . '">';
                // echo '</section>';
            }
            echo get_sub_field('codearea');
            echo '</section>';

            endwhile; 
        endif;
    } elseif($options == 'Image plus Content'){
        if(have_rows('image_plus_content')): 
            while(have_rows('image_plus_content')): the_row();

            endwhile; 
        endif;
    }


    endwhile;
endif;

get_footer();

?>