<?php 
get_header(); 

?>
<!-- start of intro section -->
<section class="" style="padding:100px 0;">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-12 col text-center">

<h3 class="blair-itc h4"><?php the_field('intro_heading_1'); ?></h3>
<?php 
$content=get_field('intro_content');

if($content){
echo $content;
}


$linkLearn = get_field('learn_more_button');

$linkLearn_url = $linkLearn['url'];
$linkLearn_title = $linkLearn['title'];
$linkLearn_target = $linkLearn['target'] ? $linkLearn['target'] : '_self';


echo '<a class="btn btn-accent" style="width:48%;" href="' . esc_url( $linkLearn_url ) . '" target="' . esc_attr( $linkLearn_target ) . '">' . esc_html( $linkLearn_title ) . '</a>';



$linkIntro = get_field('watch_video');
if( $linkIntro ): 
$linkIntro_url = $linkIntro['url'];
$linkIntro_title = $linkIntro['title'];
$linkIntro_target = $linkIntro['target'] ? $linkIntro['target'] : '_self';
if($linkIntro_url=='#'){
?>
<a class="btn bg-black text-white btn-watch-video open-modal" id="btn-watch-video" style="width:48%;" data-target="<?php echo esc_url( $linkIntro_url ); ?>" target="<?php echo esc_attr( $linkIntro_target ); ?>"><?php echo esc_html( $linkIntro_title ); ?></a>
<?php 
} else { 
?>
<a class="btn bg-black text-white" href="<?php echo esc_url( $linkIntro_url ); ?>" style="width:48%;" target="<?php echo esc_attr( $linkIntro_target ); ?>"><?php echo esc_html( $linkIntro_title ); ?></a>
<?php 
}
endif; ?>

<!-- <div class="modal-content modal-watch-video position-fixed w-100 h-100 d-flex align-items-center justify-content-center" style="z-index:2;">
<div class="modal-watch-video-overlay position-absolute w-100 h-100 bg-black" style="opacity:.75;"></div>
<div class="modal-watch-video-content position-relative z-2 bg-white d-flex align-items-center justify-content-center" style="padding: 75px 110px;">
<div class="close position-absolute text-accent-brown bold" id="closeModal" style="top:25px;right:25px;">X</div>
<div style="margin-bottom:-1rem;">
<?php the_field('watch_video_popup'); ?>
</div>
</div>
</div> -->
<div class="modal-content btn-watch-video position-fixed w-100 h-100 z-3">
    <div class="bg-overlay"></div>
    <div class="bg-content">
      <div class="bg-content-inner">
        <div class="close" id="">X</div>
    <div>
    <?php the_field('watch_video_popup'); ?>
    </div>
      </div>
      
    </div>
</div>
</div>
</div>
</div>
</section>
<!-- end of intro section -->


<!-- start of vision -->
<section class="pt-5 pb-5 position-relative" style="background:#FDFAF6;">

<div class="container-fluid contained">
<div class="row align-items-center justify-content-between">

<div class="col-md-1"></div>


<div class="col-lg-4 text-left">
<h6 class="proxima headline-small mb-0"><?php the_field('vision_pretitle'); ?></h6>
<div class="bg-accent mb-4" style="width:150px;height:3px;"></div>
<h3 class="blair-itc h4"><?php the_field('vision_title'); ?></h3>

<div style="font-size:130%;">
<?php the_field('vision_content'); ?>
</div>

</div>



<div class="col-lg-6 pr-lg-0">
<?php 
$visionImg = get_field('vision_image');
echo wp_get_attachment_image($visionImg['id'],'large','',['class'=>'w-100 h-auto']);
?>
</div>

</div>
</div>
</section>
<!-- end of vision -->



<!-- start of big image section -->
<?php
if(have_rows('big_image_section_content')): while(have_rows('big_image_section_content')): the_row();
$image = get_sub_field('background_image');
$content = get_sub_field('content');

echo '<div class="pt-5 pb-5"></div>';

echo wp_get_attachment_image($image['id'],'full','',['class'=>'w-100 h-auto']);

endwhile; endif;
?>
<!-- end of big image section -->



<!-- start of about us -->
<section class="pt-5 pb-5 position-relative">

<div class="container">
<div class="row justify-content-center">
<div class="col-md-10 text-center pb-5">
<?php 
echo '<h3 class="">' . get_field('about_main_title') . '</h3>';
?>
</div>
</div>
</div>

<div class="container-fluid contained">
<div class="row align-items-center justify-content-between">



<div class="col-lg-6 pr-lg-0">
<?php 
$aboutImg = get_field('about_image');
echo wp_get_attachment_image($aboutImg['id'],'large','',['class'=>'w-100 h-auto']);
?>
</div>



<div class="col-lg-4 text-left">
<?php 
	echo '<div class="pb-4">';
	the_field('about_precontent');
	echo '</div>';
?>
<h6 class="proxima headline-small mb-0"><?php the_field('about_pretitle'); ?></h6>
<div class="bg-accent mb-4" style="width:200px;height:3px;"></div>

<h3 class="blair-itc h4"><?php the_field('about_title'); ?></h3>
<h4 class="font-italic text-accent garammond"><?php the_field('about_subtitle'); ?></h4>

<div class="pt-5" style="font-size:130%;">
<?php the_field('about_content'); ?>
</div>

</div>

<div class="col-md-1"></div>

</div>
</div>
</section>
<!-- end of about us -->






<!-- start of architects -->
<section class="position-relative bg-accent text-white" style="padding:5rem 0;">
<div class="container-fluid contained">
<div class="row justify-content-between align-items-center">
<div class="col-md-1"></div>
<div class="col-md-4 pt-4">
<h6 class="proxima headline-small"><?php the_field('architects_pretitle'); ?></h6>
<div style="width:250px;height:3px;background:#898989;" class="mb-4"></div>

<h3 class="blair-itc"><?php the_field('architects_title'); ?></h3>
<div class="text-white">
<?php the_field('architects_content'); ?>
</div>
</div>
<div class="col-md-6 pr-md-0">
<?php 
$architectsRightImg=get_field('architects_right_image');
echo wp_get_attachment_image($architectsRightImg['id'],'full','',['class'=>'w-100 h-100','style'=>'object-fit:cover;']);
?>
</div>

</div>
</div>
</section>
<!-- end of architects -->

<?php

// start of news
if(have_rows('news')): while(have_rows('news')): the_row();
echo '<section class="pt-5 pb-5 position-relative bg-light">';
echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12 pb-5">';
echo '<h2>' . get_sub_field('title') . '</h2>';
echo '<div class="bg-accent" style="width:200px;height:3px;"></div>';
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
echo '<div class="col-lg col-md-4 col-6 mt-3 mb-3 overflow-h">';
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


get_footer(); ?>