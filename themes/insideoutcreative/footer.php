<footer class="" style="">

<?php
// if(is_front_page()):
// echo '<section class="pt-5 pb-5">';
// echo '<div class="container">';
// echo '<div class="row justify-content-center">';

// echo '<div class="col-md-3 col-9 text-center">';
// echo '<a href="' . home_url() . '">';
// $logo = get_field('logo','options');
// echo wp_get_attachment_image($logo['id'],'full',"",['class'=>'w-100 h-auto logo','style'=>'']);
// echo '</a>';
// echo '</div>';
// echo '</div>';
// echo '</div>';
// echo '</section>';
// endif;
?>

<section class="pt-5" style="background:#d7d7d7;">
<div class="container">
<div class="row">
<div class="col-12">
<?php 
wp_nav_menu(array(
    'menu' => 'Footer Top',
    'menu_class'=>'menu d-flex flex-wrap list-unstyled justify-content-center'
    ));
wp_nav_menu(array(
    'menu' => 'footer',
    'menu_class'=>'menu d-flex flex-wrap list-unstyled justify-content-center mb-5'
    ));

    echo '<div class="text-center">';
    the_field('copyright','options');
    echo '<div class="small">';
    the_field('disclosure','options');
    echo '</div>';
    echo '</div>';
?>

</div>
<!-- <div class="col-12 text-right" style="opacity:.5;">

</div> -->
</div>
</div>
<!-- <section class="pb-5 text-center" style="">
<a href="https://insideoutcreative.io/" target="_blank" title="Website Development, Design &amp SEO in Colorado - Florida" style="padding-top:35px;">
<img class="auto img-backlink" src="<?php echo home_url(); ?>/wp-content/uploads/2022/03/created-by-inside-out-creative-black.png" alt="Website Development, Design &amp SEO in Colorado - Florida" width="125px" />
</a>
</section> -->
</section>

<!-- <section class="pt-1 pb-1 bg-gray-2">
<div class="bg-gray1 pt-2 pb-2 text-center">
<small><a href="https://insideoutcreative.io" target="_blank" rel="noopener noreferrer" class="gray-text-1">WEB DESIGN &amp; DEVELOPMENT BY INSIDE OUT CREATIVE</a></small>
</div>
</section> -->
</footer>
<?php if(get_field('footer', 'options')) { the_field('footer', 'options'); } ?>
<?php wp_footer(); ?>
</body>
</html>