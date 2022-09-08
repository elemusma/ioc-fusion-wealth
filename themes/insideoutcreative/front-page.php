<?php 
get_header(); 

// start of featured
if(have_rows('featured')): while(have_rows('featured')): the_row();
$title = get_sub_field('title');
$gallery = get_sub_field('gallery');

echo '<section class="pt-5 pb-5 position-relative">';
echo '<div class="container-fluid contained">';
echo '<div class="row">';
echo '<div class="col-12 pb-5 text-center">';

echo '<h2>' . $title . '</h2>';



echo '</div>';
echo '</div>';

if( $gallery ): 
  echo '<div class="row justify-content-center align-items-center flex-wrap">';
foreach( $gallery as $image ):
echo '<div class="col-md-4 col-6 mt-3 mb-3 overflow-h">';
// echo '<div class="position-relative">';
// echo '<a href="' . wp_get_attachment_image_url($image['id'], 'full') . '" data-lightbox="image-set">';
echo wp_get_attachment_image($image['id'], 'full','',['class'=>'w-100 img-portfolio','style'=>'height:100px;object-fit:contain;'] );
// echo '</a>';
// echo '</div>';
echo '</div>';
endforeach; 
echo '</div>';
endif;

echo '</div>';
echo '</section>';
endwhile; endif;
// end of featured

// start of planning
if(have_rows('planning')): while(have_rows('planning')): the_row();
$bgImg = get_sub_field('background_image');
$image = get_sub_field('image');
$title = get_sub_field('title');
$content = get_sub_field('content');
$link = get_sub_field('link');
if( $link ): 
  $link_url = $link['url'];
  $link_title = $link['title'];
  $link_target = $link['target'] ? $link['target'] : '_self';
endif;

echo '<section class="position-relative pb-5" style="">';
echo wp_get_attachment_image($bgImg['id'],'full','',['class'=>'w-100 h-100']);

echo '<div class="container">';
echo '<div class="row justify-content-center align-items-center">';

echo '<div class="col-md-9 text-center">';
echo wp_get_attachment_image($image['id'],'full','',['class'=>'w-100 h-100','style'=>'border:10px solid rgba(255,255,255,.5);max-width:350px;margin-top:-100px;']);

echo '<h2>' . get_sub_field('title') . '</h2>';
echo $content;

echo '<a href="' . esc_url( $link_url ) . '" class="btn btn-effect text-white bg-accent-quaternary d-inline-block position-relative overflow-h mt-5 mb-5" target="' . esc_attr( $link_target ) . '">';
echo '<div class="position-absolute w-100 h-100 bg-accent-quinary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">' . esc_html( $link_title ) . '</span>';
echo '</a>';

echo '</div>';


echo '</div>';
echo '</div>';


echo '<div class="pt-4 pb-4" style="background:#f8f8f8;">';
echo '<div class="container">';
echo '<div class="row justify-content-center align-items-center">';

if(have_rows('checklist_left')):
  echo '<div class="col-md-4">';
  echo '<div class="" style="font-size:90%;color:#353535;">';
  while(have_rows('checklist_left')): the_row();
  $title = get_sub_field('title');
  
  echo '<div class="d-flex align-items-center icon-item">';
  echo '<div class="mr-3" style="width:35px;">';
  echo wp_get_attachment_image(3432,'full','',['class'=>'w-100 h-100','style'=>'object-fit:contain;']);
  echo '</div>';
  
  echo '<div>';
  echo '<strong>' . $title . '</strong>';
  echo '</div>';
  
  echo '</div>';
  
  endwhile;
  echo '</div>';
  
  echo '</div>';
endif;

if(have_rows('checklist_right')):
  echo '<div class="col-md-4">';
  echo '<div class="" style="font-size:90%;color:#353535;">';
  while(have_rows('checklist_right')): the_row();
  $title = get_sub_field('title');
  
  echo '<div class="d-flex align-items-center icon-item">';
  echo '<div class="mr-3" style="width:35px;">';
  echo wp_get_attachment_image(3432,'full','',['class'=>'w-100 h-100','style'=>'object-fit:contain;']);
  echo '</div>';
  
  echo '<div>';
  echo '<strong>' . $title . '</strong>';
  echo '</div>';
  
  echo '</div>';
  
  endwhile;
  echo '</div>';
  
  echo '</div>';
endif;

echo '</div>';
echo '</div>';
echo '</div>';


echo '</section>';
endwhile; endif;
// end of planning

// start of difference
if(have_rows('difference')): while(have_rows('difference')): the_row();
echo '<section class="position-relative bg-accent text-white" style="background:#464646;padding:100px 0;">';
echo '<div class="container">';
echo '<div class="row justify-content-center align-items-center">';

echo '<div class="col-md-9 pt-4 text-center">';

echo '<h2 class="pb-4">' . get_sub_field('title') . '</h2>';
echo '<div class="pl-md-5 pr-md-5">';
echo get_sub_field('content');
echo '</div>';

echo '</div>';


echo '</div>';
echo '</div>';
echo '</section>';
endwhile; endif;
// end of difference
?>


<!-- start of vision -->
<section class="pt-5 pb-5 position-relative" style="background:#FDFAF6;">

<div class="container-fluid contained">
<div class="row align-items-center justify-content-between">

<div class="col-md-1"></div>


<div class="col-lg-4 text-left">
<!-- <h6 class="proxima headline-small mb-0"><?php the_field('vision_pretitle'); ?></h6>
<div class="bg-accent mb-4" style="width:150px;height:3px;"></div> -->
<h3 class="blair-itc h4"><?php the_field('vision_title'); ?></h3>

<div style="font-size:130%;">
<?php the_field('vision_content'); ?>
</div>

</div>



<div class="col-lg-6 pr-lg-0">
<?php 
$visionImg = get_field('vision_image');
echo wp_get_attachment_image($visionImg['id'],'large','',['class'=>'w-100 h-auto pr-5']);
?>
</div>

</div>
</div>
</section>
<!-- end of vision -->


<?php

echo '<div class="pt-5 pb-5"></div>';

// <!-- start of architects -->
echo '<section class="position-relative bg-accent text-white" style="padding:5rem 0;">';
echo '<div class="container-fluid contained">';
echo '<div class="row justify-content-between align-items-center">';
echo '<div class="col-md-1"></div>';
echo '<div class="col-md-4 pt-4">';
// echo '<h6 class="proxima headline-small">' . get_field('architects_pretitle') . '</h6>';
// echo '<div style="width:250px;height:3px;background:#898989;" class="mb-4"></div>';

echo '<h2 class="h4">' . get_field('architects_title') . '</h2>';
echo '<div class="text-white" style="font-size:130%;">';
the_field('architects_content');
echo '</div>';
echo '</div>';
echo '<div class="col-md-6 pr-md-0">';

$architectsRightImg=get_field('architects_right_image');
echo wp_get_attachment_image($architectsRightImg['id'],'full','',['class'=>'w-100 h-100','style'=>'object-fit:cover;']);

echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';
// <!-- end of architects -->


echo '<div class="pt-5 pb-5"></div>';

// start of founder
if(have_rows('founder')): while(have_rows('founder')): the_row();
$image = get_sub_field('image');
$imageBottom = get_sub_field('image_bottom');
$content = get_sub_field('content');

echo '<section class="pt-5 pb-5 position-relative" style="background:#f5f3ef;">';
echo '<div class="position-absolute w-100 h-50 bg-white" style="top:50%;transform:translate(0,-50%);"></div>';
echo '<div class="container">';
echo '<div class="row justify-content-around">';

echo '<div class="col-md-4 pb-5">';
echo wp_get_attachment_image($image['id'],'full','',['class'=>'w-100 h-auto','style'=>'border:10px solid white;']);
echo '</div>';

echo '<div class="col-md-6 pb-5">';

echo '<div class="h-100 d-flex align-items-center">';
echo '<div>';
echo '<h2 class="">' . get_sub_field('pretitle') . '</h2>';
echo '<h3 class="h6" style="font-family:proxima_novaregular;">' . get_sub_field('title') . '</h3>';

echo '<div class="pt-4 pb-4">';
echo $content;
echo '</div>';

echo wp_get_attachment_image($imageBottom['id'],'full','',['class'=>'w-auto','style'=>'mix-blend-mode:darken;height:100px;max-width:350px;object-fit:contain;']);

echo '</div>';
echo '</div>';

echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';
endwhile; endif;
// end of founder

// start of news
if(have_rows('news')): while(have_rows('news')): the_row();
echo '<section class="pt-5 pb-5 position-relative">';
echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12 pb-5 d-flex justify-content-between align-items-center">';
echo '<h2 class="mb-0">' . get_sub_field('title') . '</h2>';

echo '<a href="' . home_url() . '/blog/" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h">';
echo '<div class="position-absolute w-100 h-100 bg-accent-secondary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">View All</span>';
echo '</a>';
// echo '<div class="bg-accent" style="width:200px;height:3px;"></div>';
echo '</div>';

$posts = get_sub_field('relationship');
if( $posts ):
foreach( $posts as $post ): 
// Setup this post for WP functions (variable must be named $post).
setup_postdata($post);

echo '<div class="col-md-4">';

echo '<div class="position-relative overflow-h">';
echo '<a href="' . get_the_permalink() . '">';
the_post_thumbnail('full',array('class'=>'w-100 img-hover','style'=>'height:300px;object-fit:cover;'));
echo '</a>';
echo '</div>';

echo '<div class="mt-4">';

echo '<div class="mb-3">';
echo get_the_date();
echo '</div>';

echo '<a href="' . get_the_permalink() . '" class=""><strong>' . get_the_title() . '</strong></a>';
// the_excerpt();
echo '</div>';

echo '</div>';

endforeach;
    // Reset the global post object so that the rest of the page works correctly.
    wp_reset_postdata(); 
endif;

echo '</div>';
echo '</div>';
echo '</section>';
endwhile; endif;
// end of news

// start of contact us
if(have_rows('contact')): while(have_rows('contact')): the_row();
echo '<section class="pt-5 pb-5">';
echo '<div class="container">';
echo '<div class="row">';

echo '<div class="col-md-3 bg-accent text-white" style="margin-bottom:7px;">';

echo '<div class="h-100 d-flex p-4">';
echo '<div class="">';
echo '<h2 class="proxima-bold pb-4">' . get_sub_field('title') . '</h2>';

if(have_rows('links')):
  echo '<div class="" style="">';
  while(have_rows('links')): the_row();
  $link = get_sub_field('title');
if( $link ): 
  $link_url = $link['url'];
  $link_title = $link['title'];
  $link_target = $link['target'] ? $link['target'] : '_self';
endif;


  
  echo '<div class="d-flex align-items-start contact-icon mb-3">';
  echo '<div class="bg-white d-flex align-items-center justify-content-center mr-4 bg-circle" style="height: 30px;min-width:30px;border-radius: 50%;">';
  echo get_sub_field('icon');
  echo '</div>';
  
  echo '<div>';
  if($link_url == '#'){
    echo '<strong>' . $link_title . '</strong>';
  } else {
    echo '<a href="' . esc_url($link_url) . '" target="' . esc_attr($link_target) . '"><strong>' . $link_title . '</strong></a>';
  }
  echo '</div>';
  
  echo '</div>';
  
  endwhile;
  echo '</div>';
  
endif;
echo '</div>';

echo '</div>';

echo '</div>';
echo '<div class="col-md-9 pl-0">';
echo get_sub_field('map');
echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';
endwhile; endif;
// end of contact us


get_footer(); ?>