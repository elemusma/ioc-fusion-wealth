<?php
/**
 * Template Name: Services
 */
get_header();

echo '<div class="hero">';
the_post_thumbnail('full',array('class'=>'','style'=>''));
echo '</div>';

// start of intro
if(have_rows('content')): while(have_rows('content')): the_row();
$options = get_sub_field('options');



echo '<section class="pt-5 pb-5 position-relative intro">';

echo '<div class="container">';


if($options == 'Content Center'){
  // start of group
  if(have_rows('content_center')): while(have_rows('content_center')): the_row();
  $content = get_sub_field('content');
  
echo '<div class="row justify-content-center">';
echo '<div class="col-md-7 text-center pb-5">';
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
endwhile; endif;
// end of group

} elseif($options == 'Content + Image') {
  // start of group
  if(have_rows('content_image')): while(have_rows('content_image')): the_row();
$leftRight = get_sub_field('image_left_or_right');
$image = get_sub_field('image');
$content = get_sub_field('content');


if($leftRight == 'Left'){
  echo '<div class="row justify-content-center row-content-image">';
} elseif ($leftRight == 'Right'){
  echo '<div class="row justify-content-center row-content-image flex-md-row-reverse">';
}
  echo '<div class="col-md-6">';
  echo '<div class="position-relative w-100 h-100">';


  echo wp_get_attachment_image($image['id'],'full','',['class'=>'position-absolute h-100 w-100 d-md-block d-none','style'=>'top:0;left:0;object-fit:cover;']);
  echo wp_get_attachment_image($image['id'],'full','',['class'=>'position-relative h-auto w-100 d-md-none d-block','style'=>'']);
  echo '</div>';
  echo '</div>';

  echo '<div class="col-md-6 pt-5 pb-5">';
  echo $content;
  echo '</div>';

  echo '</div>';
endwhile; endif;
// end of group
}








echo '</div>';
echo '</section>';

endwhile; endif;
// end of intro

get_footer();
?>