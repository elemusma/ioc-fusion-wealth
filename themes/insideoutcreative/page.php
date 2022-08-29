<?php
get_header();
?>
<style>
@import url('/wp-content/themes/insideoutcreative/css/sections/products-single.css');
@import url('/wp-content/themes/insideoutcreative/css/sections/intro.css');
</style>

<?php 
echo '<section class="pt-5 pb-5">';
echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-md-12">';

echo '<h1>' . get_the_title() . '</h1>';
if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile; endif;

echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';

get_footer(); ?>