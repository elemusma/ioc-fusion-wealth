<div class="container-fluid container-nav-items">
<div class="row nav-items position-fixed" style="padding-bottom:100px;" id="navItems">
<div id="body-overlay" class="position-absolute"></div>

<div class="col col-lg-6 col-md-10 col-12 slide-menu" style="" id="menuCol1">
<?php if(have_rows('main_pages','options')): while(have_rows('main_pages','options')): the_row();
$mainPages = get_sub_field('pages');
if( $mainPages ): ?>
<?php foreach( $mainPages as $post ): 
// Setup this post for WP functions (variable must be named $post).
setup_postdata($post); ?>
<li class="row position-relative">
<a href="<?php the_permalink(); ?>" class="h5 col-md-6 mb-0 main-title pt-3 pb-3 z-1 t-25 z-3" style="background:white;"><?php the_title(); ?></a>
<?php if(have_rows('sub_pages','options')): while(have_rows('sub_pages','options')): the_row(); ?>
<!-- start of submenu -->
<div class="position-absolute z-2 close-submenu text-center z-4" style=""><strong>&#8722;</strong></div>
<div class="position-absolute z-2 open-submenu text-center z-4" style="">&#10133;</div>
<div class="col-md-6 sub-menu z-2 overflow-h" style="">
<div class="row">
<?php
$subPages = get_sub_field('sub_pages_relationship');
if( $subPages ): ?>
<?php foreach( $subPages as $post ): 
// Setup this post for WP functions (variable must be named $post).
setup_postdata($post); ?>
<a href="<?php the_permalink(); ?>" class="position-relative overflow-h col-12 text-center text-white pt-5 pb-5 h4 mb-0">
<?php
if(has_post_thumbnail()) {
the_post_thumbnail('medium',array('class'=>'position-absolute bg-img w-100 h-100'));
} else {
$globalImage=get_field('global_image','options');
echo wp_get_attachment_image($globalImage['id'],'medium','',['class'=>'position-absolute bg-img w-100 h-100']);
}
?>
<div class="position-absolute w-100 h-100 bg-black" style="opacity:.5;top:0;left:0;"></div>
<span class="position-relative z-1"><?php the_title(); ?></span>
</a>
<?php 
endforeach;
// Reset the global post object so that the rest of the page works correctly.
wp_reset_postdata();
endif;
?>
</div>
</div>
<!-- end of submenu -->
<?php 
endwhile; endif; ?>
</li>
<?php 
endforeach;
// Reset the global post object so that the rest of the page works correctly.
wp_reset_postdata(); 
endif; 
endwhile; endif;
?>
</div>



</div>


</div>