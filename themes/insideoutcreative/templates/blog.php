<?php
/**
 * Template Name: Blog
 */
get_header(); 

if(have_rows('blog_banner')): while(have_rows('blog_banner')): the_row();
$bgImg = get_sub_field('background_image');
$title = get_sub_field('title');
$content = get_sub_field('content');
$code = get_sub_field('code');

echo '<section class="position-relative section-header" style="padding:100px 0;background:url(' . wp_get_attachment_image_url($bgImg['id'], 'full') . ');background-size:120%;background-position:top;background-attachment:fixed;background-repeat:no-repeat;">';

echo '<div class="position-absolute w-100 h-100" style="top:0;left:0;mix-blend-mode:multiply;background-color: #d2d2d2;"></div>';


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
  echo '<h1 class="ml2">' . get_the_title() . '</h1>';
  
  if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile; else:
echo '<p>Sorry, no posts matched your criteria.</p>';
endif;
echo '</div>';
echo '<div class="col-12">';
echo '<div class="row">';


// the query to set the posts per page to 3
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('posts_per_page' => 10, 'post_type' => 'post', 'paged' => $paged );
query_posts($args);
// the loop
if ( have_posts() ) : while (have_posts()) : the_post();
// start of col
echo '<div class="col-md-6 pr-lg-5 col-blog text-white" style="margin-bottom: 50px;">';

    
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
// end of col
endwhile;
// pagination
echo '<div class="col-md-12 text-center pt-5 pb-5">';

echo paginate_links(array(
'show_all' => true,
'prev_text' => '&#60;',
'next_text' => '&#62;'
));
echo '</div>';
endif;
echo '</div>';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';





// wp_enqueue_script('anime-cdn-js', '//cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js');
// wp_enqueue_script('portfolio-js', get_theme_file_uri('/js/portfolio.js'));
get_footer(); ?>