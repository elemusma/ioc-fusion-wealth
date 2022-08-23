<!-- start of repeater field section -->
<?php  if( have_rows('content') ): ?>
<div class="pt-5 pb-5">
<div class="container" style="">
<?php while ( have_rows('content') ) : the_row(); ?>
<div class="row services-content-row position-relative col-content">
<div class="col-md-6 services-content-text" style="padding:100px 0;">
<div class="inner-content p-5">
<h3><?php the_sub_field('title'); ?></h3>
<?php the_sub_field('content'); ?>
</div>
</div>
<div class="col-md-6 p-0 services-content-img">
<div class="h-100">
<?php $contentImage = get_sub_field('image');
echo wp_get_attachment_image($contentImage['id'], 'full', "",['class'=>'w-100 h-100 position-absolute','style'=>'object-fit:cover;']); ?>
</div>
</div>
</div>
<?php
endwhile; 
?>
</div>
</div>
</section>
<?php endif; ?>
<!-- end of repeater field section -->