<?php
get_header();
?>
<style>
@import url('/wp-content/themes/insideoutcreative/css/sections/products-single.css');
@import url('/wp-content/themes/insideoutcreative/css/sections/intro.css');
</style>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section class="pt-5 pb-5">
<div class="container">
<div class="row">
<div class="col-md-12">
<?php the_content(); ?>
</div>
</div>
</div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?>