<footer class="" style="">
<!-- <section class="pt-5 pb-5"> -->
<!-- <div class="container"> -->
<!-- <div class="row justify-content-center"> -->

<!-- <div class="col-lg-8 col-md-9 pl-5 col-footer-content">
<div class="position-absolute vertical-line bg-accent"></div>
<div class="position-absolute horizontal-line bg-accent"></div>
<?php wp_nav_menu(array(
'menu' => 'Footer',
'menu_class'=>'menu d-flex flex-wrap list-unstyled justify-content-start mb-0'
)); ?>
<div class="d-flex flex-wrap align-items-center justify-content-start" style="padding-left:30px;">
<div class="mr-1">
<p class="mb-0 mt-4 text-accent-brown"><strong>Phone:</strong> <a href="tel:+1<?php the_field('phone','options'); ?>" class="text-accent-brown"><?php the_field('phone','options'); ?></a> <span class="gray-text">|</span> </p>
</div>
<div class="">
<p class="mb-0 mt-4 text-accent-brown"><strong>Email:</strong> <a href="mailto:<?php the_field('email','options'); ?>" target="_blank" class="text-accent-darker"><?php the_field('email','options'); ?></a></p>
</div>
</div>

</div> -->
<!-- </div> -->
<!-- </div> -->
<!-- <div class="container">
<div class="row">
<div class="col-12 text-center pt-5 pb-5">
<?php echo get_template_part('partials/si'); ?>
</div>
</div>
</div> -->
<!-- </section> -->


<!-- <section class="copyright bg-accent-dark text-center text-gray">
<div class="container">
<div class="row align-items-center justify-content-center">
<div class="col-md-10 col-12 col bg-light pt-3 pb-3">
<div class="row justify-content-center">
<div class="col-md-6">
<span class="h3 mb-0">Join the conversation.</span>
</div>
<div class="col-md-4">
<?php echo get_template_part('partials/si'); ?>
</div>
</div>
</div>
</div>
</div>
</section> -->


<section class="pt-5 pb-5">
<div class="container">
<div class="row justify-content-center">

<div class="col-md-3 col-9 text-center">
<a href="<?php echo home_url(); ?>">
<?php $logo = get_field('logo','options'); ?>
<?php echo wp_get_attachment_image($logo['id'],'full',"",['class'=>'w-100 h-auto logo','style'=>'']); ?>
</a>
</div>
</div>
</div>
</section>

<section class="pt-5 bg-light" style="">
<div class="container">
<div class="row">
<div class="col-12">
<?php 
wp_nav_menu(array(
    'menu' => 'footer',
    'menu_class'=>'menu d-flex flex-wrap list-unstyled justify-content-center mb-5'
    ));

    the_field('copyright','options'); 
?>

</div>
<!-- <div class="col-12 text-right" style="opacity:.5;">

</div> -->
</div>
</div>
<section class="pb-5 text-center" style="">
<a href="https://insideoutcreative.io/" target="_blank" title="Website Development, Design &amp SEO in Colorado - Florida" style="padding-top:35px;">
<img class="auto img-backlink" src="<?php echo home_url(); ?>/wp-content/uploads/2022/03/created-by-inside-out-creative-black.png" alt="Website Development, Design &amp SEO in Colorado - Florida" width="125px" />
</a>
</section>
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