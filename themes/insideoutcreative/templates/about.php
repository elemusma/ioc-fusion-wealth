<?php 

/**
 * Template Name: About
 */

 get_header();

 echo '<div class="hero">';
the_post_thumbnail('full',array('class'=>'','style'=>''));
echo '</div>';

$bgImg = get_field('background_image');

if($bgImg):
echo '<div style="background:url(' . $bgImg['url'] . ');background-size:cover;background-attachment:fixed;">';
endif;

if(have_rows('video')): while(have_rows('video')): the_row();

echo '<section class="pt-5 pb-5 position-relative intro">';
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

echo '<section class="pt-5 pb-5 position-relative intro">';

echo '<div class="container">';

echo '<div class="row justify-content-center">';
echo '<div class="col-md-6 text-center">';
echo '<div class="h-100 d-flex align-items-center position-relative">';

$image = get_field('image');

echo wp_get_attachment_image($image['id'],'full','',['class'=>'w-100 h-100 position-absolute','style'=>'object-fit:cover;object-position:top;top:0;left:0;']);

echo '</div>';
echo '</div>';

echo '<div class="col-md-6 pt-4 pb-4">';
    if ( have_posts() ) : while ( have_posts() ) : the_post();
        the_content();
    endwhile;
    endif;
echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';

if($bgImg):
    echo '</div>';
    endif;

 get_footer();

?>