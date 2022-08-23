<?php 
get_header(); ?>
<section class="pt-5 pb-5 body">
<div class="container">
<div class="row">
<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('posts_per_page' => 10, 'post_type' => 'post','paged' => $paged, 'date_query' => array(
    'year' => get_the_time( 'Y' ),
    'month' => get_the_time( 'n' )
    )
);
query_posts($args); ?>
<!-- the loop -->
<?php if ( have_posts() ) : while (have_posts()) : the_post();
echo get_template_part('partials/blogs-query');
endwhile; ?>
<!-- pagination -->
<div class="col-md-12 text-center pt-5">
<?php echo paginate_links(array(
'show_all' => true,
'prev_text' => '&#60;',
'next_text' => '&#62;'
)); ?>
</div>
<?php else : ?>
<!-- No posts found -->
<?php endif; ?>
</div>
</div>
</section>
<?php get_footer(); ?>