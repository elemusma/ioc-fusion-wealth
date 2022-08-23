<!-- start of testimonials -->
<section class="pt-5 pb-5 mt-5 mb-5 testimonials bg-light position-relative z-1" style="">
<div class="container">
<div class="row">
<div class="col-12 text-center">
<?php
$testimonialsGroup = get_field('testimonials_content','options');
$tTitle = $testimonialsGroup['title'];
$tContent = $testimonialsGroup['content'];

echo '<h3 class="">' . $tTitle . '</h3>';

if($tContent) {
echo $tContent;
} ?>
</div>
<div class="testimonials-carousel owl-carousel owl-themes">
<?php 
$counterTestimonial = 0;
if(have_rows('testimonials')): while(have_rows('testimonials')): the_row(); 
$counterTestimonial++;
?>
<div class="col-testimonial mt-2 mb-2 pl-md-0 pr-md-0 pl-5 pr-4" data-aos="fade-up" data-aos-delay="<?php echo $counterTestimonial; ?>00">
<?php echo wp_get_attachment_image(129,'full','',['class'=>'bg-img position-absolute img-quotes','style'=>'width:25px;height:auto;']); ?>
<div class="position-relative pl-5">

<div class="gray-text-1" style="">
<p><?php the_sub_field('content'); ?></p>
</div>

<div class="row align-items-center">
<?php $testimonialsImage = get_sub_field('headshot'); 
if($testimonialsImage){
echo '<div class="col-lg-4 col-5">';
echo wp_get_attachment_image($testimonialsImage['id'],'full','',['class'=>'img-testimonial']); 
echo '</div>';
}
?>
<div class="col-lg-8 col-7">
<!-- <small> -->
<p><span class="h6"><strong><?php the_sub_field('name'); ?></strong></span><br>
<?php the_sub_field('job_title'); ?></p>
<!-- </small> -->
</div>
</div>
</div>
</div>
<?php endwhile; else : endif; ?>
</div>

</div>
</div>
</section>
<!-- end of testimonials -->