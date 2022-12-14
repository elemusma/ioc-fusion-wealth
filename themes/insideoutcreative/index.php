<?php

get_header();

if(have_rows('blog_banner','options')): while(have_rows('blog_banner','options')): the_row();
$bgImg = get_sub_field('background_image');
$title = get_sub_field('title');
$content = get_sub_field('content');
$code = get_sub_field('code');

echo '<section class="position-relative section-header" style="padding:100px 0;background:url(' . wp_get_attachment_image_url($bgImg['id'], 'full') . ');background-size:cover;background-position:top;background-attachment:fixed;background-repeat:no-repeat;">';


echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12 text-white">';

echo '<div class="text-center">';
echo '<h2>' . $title . '</h2>';
echo '<div class="divider"></div>';
echo $content;
echo '</div>';

echo $code;

echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';
endwhile; endif;

echo '<section class="pt-5 pb-5 body">';
echo '<div class="container">';
echo '<div class="row">';

echo '<div class="col-12 pb-4">';
echo '<h1>' . get_the_title(2889) . '</h1>';

if(have_rows('blog_banner','options')): while(have_rows('blog_banner','options')): the_row();

if(get_sub_field('blog_content')):
echo '<div class="pt-4">';
echo get_sub_field('blog_content');
echo '</div>';
endif;

endwhile; endif;

echo '</div>';

if ( have_posts() ) : 
    
    while ( have_posts() ) : the_post();

echo '<div class="col-lg-4 col-md-6 pr-lg-5 col-blog text-white" style="margin-bottom: 50px;">';

    
    echo '<div class="w-100 h-100 d-flex align-items-end justify-content-center blog-content position-relative overflow-h">';
    the_post_thumbnail('full',array('class'=>'position-absolute w-100 h-100'));
echo '<div>';

  echo '<div class="overlay position-absolute"></div>';
  echo '<div class="position-relative z-1" style="padding: 150px 25px 50px;">';
  echo '<a href="' . get_the_permalink() . '">';
  echo '<h3 class="h4">' . get_the_title() . '</h3>';
echo '</a>';

  echo '<hr class="border-white">';


  echo '<p class="">' . get_the_tags('Tags: ') . '</p>';
  echo '<a href="' . get_the_permalink() . '">Read More</a>';
  echo '</div>';



  echo '</div>';


  echo '</div>';


  echo '</div>';

endwhile;



echo '<div class="col-12 d-flex justify-content-center pt-4">';
// pagination with page numbers
    the_posts_pagination( array(
        'mid_size' => 100,
        'prev_text' => __( 'Previous Page', 'textdomain' ),
        'next_text' => __( 'Next Page', 'textdomain' ),
        ) );
echo '</div>';

endif;

echo '</div>';
echo '</div>';
echo '</section>';

get_footer(); 
?>