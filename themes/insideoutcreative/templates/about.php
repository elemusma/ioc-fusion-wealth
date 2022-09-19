<?php 

/**
 * Template Name: About
 */

 get_header();

 echo '<div class="hero">';
the_post_thumbnail('full',array('class'=>'','style'=>''));
echo '</div>';

echo '<section class="pt-5 pb-5 position-relative intro">';

echo '<div class="container">';

echo '<div class="row justify-content-center align-items-center">';
echo '<div class="col-md-6 text-center">';

$image = get_field('image');

echo wp_get_attachment_image($image['id'],'full','',['class'=>'w-100 h-100','style'=>'object-fit:contain;']);

echo '</div>';

echo '<div class="col-md-6 pb-5">';
    if ( have_posts() ) : while ( have_posts() ) : the_post();
        the_content();
    endwhile;
    endif;
echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';

if(have_rows('video')): while(have_rows('video')): the_row();

echo '<section class="pb-5 position-relative intro">';
echo '<div class="container">';

echo '<div class="row justify-content-center align-items-center">';
echo '<div class="col-md-6 text-md-right">';

echo get_sub_field('content');

echo '</div>';

echo '<div class="col-md-6">';
echo get_sub_field('video_code');
echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';
endwhile; endif;


 get_footer();

?>