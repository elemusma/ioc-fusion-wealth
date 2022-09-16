<?php

/**
 * Template Name: Page - Entrepreneur
 */

 get_header();

// start of header
echo '<section class="position-relative section-header" style="padding:100px 0;background:url(' . get_the_post_thumbnail_url() . ');background-size:120%;background-position:top;background-attachment:fixed;background-repeat:no-repeat;">';

echo '<div class="position-absolute w-100 h-100" style="top:0;left:0;mix-blend-mode:multiply;background-color: #d2d2d2;"></div>';


echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12 text-right">';

echo '<h1 class="text-uppercase text-shadow text-white">' . get_the_title() . '</h1>';

if(have_rows('header')): while(have_rows('header')): the_row();
$content = get_sub_field('content');

$link = get_sub_field('link');
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
    endif;

echo '<div class="text-white">';
echo $content;
echo '</div>';

if( $link ):
    echo '<a href="' . esc_url( $link_url ) . '" class="btn btn-effect text-white bg-accent-quaternary d-inline-block position-relative overflow-h mt-4" target="' . esc_attr( $link_target ) . '">';
    echo '<div class="position-absolute w-100 h-100 bg-accent" style="top:0;left:-100%;"></div>';
    echo '<span class="position-relative">' . esc_html( $link_title ) . '</span>';
    echo '</a>';
endif;

endwhile; endif;

echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';
// end of header

$bgImg = get_field('background_image');

if($bgImg):
echo '<div style="background:url(' . $bgImg['url'] . ');background-size:cover;background-attachment:fixed;">';
endif;

// start of bullet points
if(have_rows('section_03')): while(have_rows('section_03')): the_row();
$bgImg = get_sub_field('background_image');
$content = get_sub_field('content');
$link = get_sub_field('link');
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
    endif;

if($bgImg){
    echo '<section class="position-relative section-list" style="padding:100px 0;background:url(' . $bgImg['url'] . ');background-size:cover;">';
} else {
    echo '<section class="position-relative section-list" style="padding:100px 0;">';
    // echo '</section>';
}

echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12 pb-4 text-center">';

echo $content;

echo '</div>';

echo '</div>';

echo '<div class="row justify-content-center">';

if(have_rows('bullet_points_left')):
echo '<div class="col-md-6">';
echo '<div class="" style="font-size:120%;">';
while(have_rows('bullet_points_left')): the_row();
$title = get_sub_field('title');

echo '<div class="d-flex icon-item">';
echo '<div class="mr-3 pt-2" style="width:45px;">';
echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"/></svg>';
echo '</div>';

echo '<ul class="list-unstyled">';
echo '<li>' . $title . '</li>';
echo '</ul>';

echo '</div>';

endwhile;
echo '</div>';

echo '</div>';
endif;

if(have_rows('bullet_points_right')):
echo '<div class="col-md-6">';
echo '<div class="" style="font-size:120%;">';
while(have_rows('bullet_points_right')): the_row();
$title = get_sub_field('title');

echo '<div class="d-flex icon-item">';
echo '<div class="mr-3 pt-2" style="width:45px;">';
echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"/></svg>';
echo '</div>';

echo '<ul class="list-unstyled">';
echo '<li>' . $title . '</li>';
echo '</ul>';

echo '</div>';

endwhile;
echo '</div>';

echo '</div>';
endif;

// if(have_rows('bullet_points_right')):
// echo '<div class="col-md-6">';
// echo '<ul class="text-gray">';
// while(have_rows('bullet_points_right')): the_row();
// $title = get_sub_field('title');

// echo '<li><strong>' . $title . '</strong></li>';

// endwhile;
// echo '</ul>';

// echo '</div>';
// endif;

echo '</div>';

echo '<div class="row justify-content-center pt-5">';
echo '<div class="col-12 text-center">';
echo '<a href="' . esc_url( $link_url ) . '" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h" target="' . esc_attr( $link_target ) . '">';
echo '<div class="position-absolute w-100 h-100 bg-accent-quaternary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">' . esc_html( $link_title ) . '</span>';
echo '</a>';

echo '</div>';
echo '</div>';

echo '</div>';
echo '</section>';
endwhile; endif;
// end of bullet points



// start of banner
if(have_rows('section_02')): while(have_rows('section_02')): the_row();
$bgImg = get_sub_field('background_image');
$content = get_sub_field('content');

$link = get_sub_field('link');
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
    endif;

echo '<section class="position-relative section-banner text-center" style="">';

echo '<div class="col-12">';

echo '<div class="position-relative pt-5 pb-5">';

if($bgImg){
    echo wp_get_attachment_image($bgImg['id'],'full','',['class'=>'w-100 h-100 position-absolute','style'=>'top:0;left:0;object-fit:cover;']);
}

// echo '<h2 class="text-white position-relative">Four Steps to Take to Stress-Test<br>Your Financial Plan</h2>';

echo '<div class="position-relative text-white pb-5">';
echo get_sub_field('content');
echo '</div>';

echo '<a href="' . esc_url( $link_url ) . '" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h" target="' . esc_attr( $link_target ) . '">';
echo '<div class="position-absolute w-100 h-100 bg-accent-quaternary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">' . esc_html( $link_title ) . '</span>';
echo '</a>';

echo '</div>';
echo '</div>';

echo '</section>';
endwhile; endif;
// end of banner

// start of intro
if(have_rows('section_01')): while(have_rows('section_01')): the_row();
$bgImg = get_sub_field('background_image');

$content = get_sub_field('content');
$image = get_sub_field('image');

$link = get_sub_field('link');
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
    endif;

if($bgImg){
    echo '<section class="position-relative section-intro text-center" style="padding:100px 0;background:url(' . $bgImg['url'] . ');background-size:cover;">';
} else {
    echo '<section class="position-relative section-intro text-center" style="padding:100px 0;">';
    // echo '</section>';
}

echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12 pb-4">';

echo $content;

echo wp_get_attachment_image($image['id'],'full','',['class'=>'w-100 h-auto mt-5','style'=>'max-width:500px;mix-blend-mode:darken;']);

if( $link ): 
    echo '<a href="' . esc_url( $link_url ) . '" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h" target="' . esc_attr( $link_target ) . '">';
    echo '<div class="position-absolute w-100 h-100 bg-accent-quaternary" style="top:0;left:-100%;"></div>';
    echo '<span class="position-relative">' . esc_html( $link_title ) . '</span>';
    echo '</a>';
endif;

echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';
endwhile; endif;
// end of intro

// start of family tree
if(have_rows('section_04')): while(have_rows('section_04')): the_row();
$bgImg = get_sub_field('background_image');
$image = get_sub_field('image');
$content = get_sub_field('content');

$link = get_sub_field('link');
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
    endif;

// echo '<section class="position-relative section-intro" style="padding:100px 0;background: rgb(247,247,247);background: linear-gradient(90deg, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 100%);">';
if($bgImg){
    echo '<section class="position-relative section-family-tree" style="padding:100px 0;background:url(' . $bgImg['url'] . ');background-size:cover;">';
} else {
    echo '<section class="position-relative section-family-tree" style="padding:100px 0;">';
    // echo '</section>';
}

echo '<div class="container">';
echo '<div class="row justify-content-center">';
echo '<div class="col-12 pb-4 text-center">';

echo $content;

echo wp_get_attachment_image($image['id'],'full','',['class'=>'w-100 h-auto m-auto','style'=>'max-width:750px;mix-blend-mode:darken;']);

echo '<div class="pt-4">';

echo '<a href="' . esc_url( $link_url ) . '" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h mt-5" target="' . esc_attr( $link_target ) . '">';
echo '<div class="position-absolute w-100 h-100 bg-accent-quaternary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">' . esc_html( $link_title ) . '</span>';
echo '</a>';

echo '</div>';

echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';
endwhile; endif;
// start of family tree

// start of blog
if(have_rows('blog_content')): while(have_rows('blog_content')): the_row();
$bgImg = get_sub_field('background_image');
$content = get_sub_field('content');
$relationship = get_sub_field('relationship');

$link = get_sub_field('link');
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
    endif;

if($bgImg){
    echo '<section class="position-relative section-blog" style="padding:100px 0;background:url(' . $bgImg['url'] . ');background-size:cover;">';
} else {
    echo '<section class="position-relative section-blog" style="padding:100px 0;">';
    // echo '</section>';
}

echo '<div class="container">';
echo '<div class="row justify-content-center">';
echo '<div class="col-12 pb-4 text-center">';

echo $content;

echo '</div>';

if( $relationship ):
    foreach( $relationship as $post ): 
    // Setup this post for WP functions (variable must be named $post).
    setup_postdata($post);
    echo '<a href="' . get_the_permalink() . '" class="d-block col-md-3">';

    echo '<div class="overflow-h">';
    echo '<div class="position-relative img-hover w-100">';
    the_post_thumbnail('full',array('class'=>'w-100','style'=>'height:200px;'));
    echo '</div>';
    echo '</div>';

    echo '<div class="bg-light p-4">';
    echo '<div class="divider-small" style="margin-left:0;"></div>';
    echo '<div class="pt-3"></div>';
    echo '<span class="text-black">' . get_the_title() . '</span>';
    echo '</div>';
    echo '</a>';
    endforeach;
        // Reset the global post object so that the rest of the page works correctly.
        wp_reset_postdata(); 
    endif;

    echo '<div class="col-12 text-right pt-4">';
        echo '<a href="' . esc_url( $link_url ) . '" class="btn btn-sm btn-effect text-white bg-accent d-inline-block position-relative overflow-h" target="' . esc_attr( $link_target ) . '">';
        echo '<div class="position-absolute w-100 h-100 bg-accent-quaternary" style="top:0;left:-100%;"></div>';
        echo '<span class="position-relative small">' . esc_html( $link_title ) . '</span>';
        echo '</a>';
    echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';

endwhile; endif;
// end of blog

if($bgImg):
echo '</div>';
endif;

 get_footer();
 ?>