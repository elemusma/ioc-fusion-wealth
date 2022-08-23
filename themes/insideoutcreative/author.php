<?php get_header(); ?>
<section class="pt-5 pb-5 body">
<div class="container">
<?php 
$author_id = get_the_author_meta('ID'); 
$profileImage = get_field('profile_image', 'user_'. $author_id);
$profileBio = get_field('author_bio', 'user_'. $author_id);
if($profileImage || $profileBio){
?>
<div class="row align-items-center pb-5">
<div class="col-md-2">
<?php 
echo wp_get_attachment_image($profileImage['id'],'full','',['class'=>'w-100 h-100','style'=>'border-radius:50%;']);
?>
</div>
<div class="col-md-7">
<?php echo $profileBio; ?>
</div>
</div>
<?php } ?>

<div class="row">
<?php 
$author = get_queried_object();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('posts_per_page' => 10, 'post_type' => 'post','paged' => $paged, 'author'=> $author->ID
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