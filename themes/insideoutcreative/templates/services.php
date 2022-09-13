<?php
/**
 * Template Name: Services
 */
get_header();

echo '<div class="hero">';
the_post_thumbnail('full',array('class'=>'','style'=>''));
echo '</div>';

$bgImg = get_field('background_image');

if($bgImg):
echo '<div style="background:url(' . $bgImg['url'] . ');background-size:cover;background-attachment:fixed;">';
endif;

// start of intro
if(have_rows('content')): while(have_rows('content')): the_row();
$options = get_sub_field('options');



// echo '<section class="pt-5 pb-5 position-relative intro">';

// echo '<div class="container">';


if($options == 'Content Center'){
  // start of group
  if(have_rows('content_center')): while(have_rows('content_center')): the_row();
  $content = get_sub_field('content');
  
  echo '<section class="pt-5 position-relative intro">';

echo '<div class="container">';

echo '<div class="row justify-content-center">';
echo '<div class="col-md-7 text-center">';
echo $content;
echo '</div>';

if(have_rows('columns')): 
  echo '<div class="col-12 text-center">';
  echo '<div class="row justify-content-center align-items-center">';
  while(have_rows('columns')): the_row();
  $contentColumns = get_sub_field('content_columns');

  echo '<div class="col-lg-3 col-md-4 col-content-center">';
  echo $contentColumns;
  echo '</div>';

  endwhile;
  echo '</div>';
  echo '</div>';
endif;


echo '</div>';
echo '</div>';
echo '</section>';
endwhile; endif;
// end of group

} elseif($options == 'Content + Image') {
  // start of group
  if(have_rows('content_image')): while(have_rows('content_image')): the_row();
$leftRight = get_sub_field('image_left_or_right');
$image = get_sub_field('image');
$content = get_sub_field('content');
$classes = get_sub_field('classes');
$overlayBackground = get_sub_field('overlay_background');

// echo '<section class="pt-5 pb-5 position-relative intro" style="background:#f7f7f7;">';

if($image){
  echo '<section class="position-relative section-intro ' . $classes . '" style="background:url(' . $image['url'] . ');background-size:cover;padding:5rem 0;">';
} else {
  echo '<section class="pt-5 pb-5 position-relative section-intro ' . $classes . '" style="">';
  // echo '</section>';
}

echo '<div class="position-absolute w-100 h-100" style="top:0;left:0;background:' . $overlayBackground . '"></div>';

echo '<div class="container">';

if($leftRight == 'Left'){
  echo '<div class="row justify-content-center row-content-image">';
} elseif ($leftRight == 'Right'){
  echo '<div class="row justify-content-center row-content-image flex-md-row-reverse">';
}
  // echo '<div class="col-md-6">';
  // echo '<div class="position-relative w-100 h-100">';


  // echo wp_get_attachment_image($image['id'],'full','',['class'=>'position-absolute h-100 w-100 d-md-block d-none','style'=>'top:0;left:0;object-fit:cover;']);
  // echo wp_get_attachment_image($image['id'],'full','',['class'=>'position-relative h-auto w-100 d-md-none d-block','style'=>'']);
  // echo '</div>';
  // echo '</div>';

  echo '<div class="col-12">';
  echo $content;
  echo '</div>';

  echo '</div>';
  echo '</div>';
  echo '</section>';
endwhile; endif;
// end of group
}








// echo '</div>';
// echo '</section>';

endwhile; endif;
// end of intro

if($bgImg):
  echo '</div>';
  endif;

// start of video
if(have_rows('video_content')): while(have_rows('video_content')): the_row();
echo '<section class="position-relative text-center">';
echo get_sub_field('video_embed_code');
echo '</section>';
endwhile; endif;
// end of video

get_footer();
?>