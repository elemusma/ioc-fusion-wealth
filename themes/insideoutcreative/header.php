<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 

if(get_field('header', 'options')) { the_field('header', 'options'); }

if(get_field('custom_css')){ ?>
<style>
<?php the_field('custom_css'); ?>
</style>
<?php }
wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if(get_field('body','options')) { the_field('body','options'); } ?>
<header class="position-relative">
<div class="blank-space-before-header w-100"></div>
<div class="nav w-100 bg-white box-shadow" style="">
<div class="container-fluid contained container-navbar">
<div class="row align-items-center justify-content-center row-navbar">
<div class="col-md-4 col-6 nav-toggler-col text-center">

<a id="navToggle" class="nav-toggle">
<div>
<div class="line-1 bg-gray-dark"></div>
<div class="line-2 bg-gray-dark"></div>
<div class="line-3 bg-gray-dark"></div>
</div>
</a>
</div>
<div class="col-md-4 col-6 text-center">
<?php 
// echo wp_get_attachment_image(2374,'large','',['class'=>'position-absolute w-100 h-100','style'=>'bottom:0;left:0;transform:translate(0, 50%);z-index:1;']);
?>
<a href="<?php echo home_url(); ?>">
<?php $logo = get_field('logo','options');

echo '<img src="' . get_site_icon_url() . '" alt="" class="w-100 h-auto logo position-absolute pl-md-0 pl-3 pr-md-0 pr-3" style="max-width:75px;z-index:2;top:50%;left:50%;transform:translate(-50%,-50%);" id="logo-favicon">';
echo wp_get_attachment_image($logo['id'],'full',"",['class'=>'w-100 h-auto logo position-relative pl-md-0 pl-3 pr-md-0 pr-3 pt-2 pb-2','style'=>'max-width:125px;','id'=>'logo-main']); 
// echo get_site_icon_url();
?>
</a>

</div>
<div class="col-lg-4 d-flex align-items-center">
<?php 
$linkNav = get_field('navigation_cta','options');
if( $linkNav ): 
  $linkNav_url = $linkNav['url'];
  $linkNav_title = $linkNav['title'];
  $linkNav_target = $linkNav['target'] ? $linkNav['target'] : '_self';
endif;



wp_nav_menu(array(
'menu' => 'Contact',
'menu_class'=>'menu d-flex flex-wrap list-unstyled justify-content-center mb-0'
)); 

if( $linkNav ): 
    echo '<a href="' . esc_url( $linkNav_url ) . '" class="btn btn-sm btn-effect text-quaternary bg-white d-inline-block position-relative overflow-h" target="' . esc_attr( $linkNav_target ) . '" style="border:2px solid var(--accent-quaternary);">';
    echo '<div class="position-absolute w-100 h-100 bg-light" style="top:0;left:-100%;"></div>';
    echo '<span class="position-relative small">' . esc_html( $linkNav_title ) . '</span>';
    echo '</a>';
endif;

?>
</div>
</div> <!-- end of row navbar -->
</div> <!-- end of container-navbar -->
<div class="container-fluid container-nav-items">
<div class="nav-items closed align-items-start" id="navItems">
<div id="body-overlay" class="position-absolute"></div>
<div class="row position-relative" style="z-index:5;pointer-events:none;">


<!-- <div class="container"> -->
    <!-- <div class="row"> -->
<div class="col col-lg-3 col-md-5 col-12 pr-0 pl-0 slide-menu" id="menuCol1" style="transition:all .25s ease-in-out;pointer-events:all;max-width:420px;">

<div class="bg-accent h-100" id="menuCol1Inner">
<a id="navClose" class="navClose text-white position-relative" style="font-size:2rem;right:-25px;cursor:pointer;">X</a>

<div style="">
<?php wp_nav_menu(array(
'menu' => 'Main Menu',
'menu_class'=>'menu list-unstyled justify-content-center mb-0 pl-lg-3 mt-md-5'
)); ?>
</div>

</div>

</div>
<div class="col col-lg-4 col-md-5 col-12 p-0 dropdown-menu-images" id="menuCol2" style="transition:all .25s ease-in-out;pointer-events:all;max-width:400px;">
<?php $featured_posts = get_field('navigation_menu','options');
if( $featured_posts ):
$counterSections = 0;
foreach( $featured_posts as $post ): 
// Setup this post for WP functions (variable must be named $post).
setup_postdata($post); 
$counterSections++;
$ID = sanitize_title_with_dashes(get_the_title());
?>
<div class="col col-12 p-0 col-dropdown-menu-images" id="section-<?php echo $counterSections; ?>">
<a href="<?php the_permalink(); ?>">

<?php 
if(has_post_thumbnail()){
    the_post_thumbnail('medium',array('class'=>'w-100 dropdown-menu-images-single')); 
} else {
    $globalImage = get_field('global_image','options');
    echo wp_get_attachment_image($globalImage['id'],'full','',['class'=>'w-100 dropdown-menu-images-single']);
}

?>
<div class="overlay position-absolute w-100 h-100"></div>
<!-- <div class="pt-5 pb-5 bg-gray2 position-absolute"> -->
<div class="position-absolute dropdown-menu-images-content text-center w-100 text-white z-1 pl-5 pr-5">
<p class="bold text-white title text-shadow" style="font-size:150%;line-height:1;"><?php the_title(); ?></p>
</div>
<!-- </div> -->
</a>
</div>
<?php 
endforeach;
// Reset the global post object so that the rest of the page works correctly.
wp_reset_postdata();
endif; 
?>


</div>

<!-- </div> -->
<!-- </div> -->


</div> <!-- end of row nav items -->
</div> <!-- end of row nav items -->
</div>





</div> 
</header>
<?php if( is_front_page() ){
echo '<section class="hero position-relative overflow-h bg-attachment text-white" style="background:url(' . get_the_post_thumbnail_url() . ');background-attachment:fixed;background-size:cover;background-position:center bottom;padding:100px 0;">';
    // the_post_thumbnail('full', array('class' => 'h-auto w-100','style'=>'pointer-events:none;opacity:0;max-height:1400px;'));

    // echo '<div class="position-absolute w-100 h-100" style="mix-blend-mode:multiply;top:0;left:0;opacity:.35;background:#44637e;pointer-events:none;"></div>';
    // echo '<div class="position-absolute w-100 h-100" style="mix-blend-mode:soft-light;top:0;left:0;opacity:.35;background:#44637e;pointer-events:none;"></div>';

    
    echo '<div class="hero-content m-auto text-center position-relative" style="">';
    echo '<h1 class="pb-3 h2" style="font-family:proxima_novabold">' . get_the_title() . '</h1>';
    // echo '<hr class="" style="border-width:5px;border-color:white;">';

    if(have_rows('header')): while(have_rows('header')): the_row();
    $link = get_sub_field('link');
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
    endif;
    echo '<h2 class="h4 d-inline-block pt-2 pb-2 mb-0" style="font-family:proxima_novaregular;border-top:2px solid var(--accent-primary);border-bottom:2px solid var(--accent-primary);">' . get_sub_field('subtitle') . '</h2>';

    echo '<div>';
    echo '<a href="' . esc_url( $link_url ) . '" class="btn btn-effect text-white bg-accent-quaternary d-inline-block position-relative overflow-h mt-5" target="' . esc_attr( $link_target ) . '">';
    echo '<div class="position-absolute w-100 h-100 bg-accent-quinary" style="top:0;left:-100%;"></div>';
    echo '<span class="position-relative">' . esc_html( $link_title ) . '</span>';
    echo '</a>';
    echo '</div>';
    endwhile; endif;

    // echo '<a class="btn bg-black text-white mr-md-3 mr-0" style="width:46%;" href="/products/lightz/" target="_self">Learn More</a>';
    // echo '<a class="btn bg-black text-white btn-watch-video open-modal" id="btn-watch-video" style="width:46%;margin-left:10px;" data-target="#" target="_blank">Watch Video</a>';
    echo '</div>';
// $globalImage = get_field('global_image','options');
// if(is_page()){
// // start of if has_post_thumbnail
// if(has_post_thumbnail()){
// } else {
// echo wp_get_attachment_image($globalImage['id'],'full','',['class'=>'h-100 w-100 position-absolute bg-img img-hero','style'=>'pointer-events:none;']);
// }
// // end of if has_post_thumbnail
// } elseif(is_single()){
// if(has_post_thumbnail()){
// the_post_thumbnail('full', array('class' => 'h-100 w-100 position-absolute bg-img img-hero','style'=>'pointer-events:none;'));
// } else {
// echo wp_get_attachment_image($globalImage['id'],'full','',['class'=>'h-100 w-100 position-absolute bg-img img-hero','style'=>'pointer-events:none;']);
// }
// // end of if has_post_thumbnail
// } else {
// echo wp_get_attachment_image($globalImage['id'],'full','',['class'=>'h-100 w-100 position-absolute bg-img img-hero','style'=>'pointer-events:none;']);
// }
?>
<!-- <div class="position-absolute w-100 h-100" style="top:0;left:0;background: rgb(118,180,207);background:radial-gradient(circle, rgba(118,180,207,0.05) 10%, rgba(118,180,207,1) 50%);opacity:.35;mix-blend-mode:multiply;pointer-events:none;"></div> -->
<!-- <div class="hero-content position-relative overflow-h text-center text-white pt-5 pb-5">
<div class="position-relative">
<?php
if(is_page() && !is_front_page()){ ?> 
<h1 class="mb-0 h2"><?php the_title(); ?></h1>
<?php } elseif(is_single()){ ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
<h1 class="mb-0 h2"><?php single_post_title(); ?></h1>
</div>
    </div>
</div>

<?php } elseif(is_author()){ ?> 
<h1 class="mb-0 h3">Author:<br><?php the_author(); ?></h1>
<?php } elseif(is_tag()){ ?> 
<h1 class="mb-0 h3"><?php single_tag_title(); ?></h1>
<?php } elseif(is_category()){ ?> 
<h1 class="mb-0 h3"><?php single_cat_title(); ?></h1>
<?php } elseif(is_archive()){ ?> 
<h1 class="mb-0 h3"><?php the_archive_title(); ?></h1>
<?php } ?>
</div>
</div> -->
</section>
<?php } ?>