<?php
/**
 * Template Name: Blog
 */
get_header(); ?>

<section class="pt-5 pb-5 body">
<div class="container">
<div class="row">
<div class="col-12 pb-4">
  <h1 class="ml2"><?php the_title(); ?></h1>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile; else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>
</div>
<div class="col-md-9">
<div class="row">
<?php
// the query to set the posts per page to 3
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('posts_per_page' => 10, 'post_type' => 'post', 'paged' => $paged );
query_posts($args); ?>
<!-- the loop -->
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
<!-- start of col -->
<div class="col-md-6 pr-lg-5 col-blog text-white" style="margin-bottom: 50px;">

    
    <div class="w-100 h-100 d-flex align-items-end justify-content-center blog-content position-relative overflow-h">
    <?php the_post_thumbnail('full',array('class'=>'position-absolute w-100 h-100')); ?>
<div>

  <div class="overlay position-absolute"></div>
  <div class="position-relative z-1 p-5">
  <a href="<?php the_permalink(); ?>">
  <h3 class="h4"><?php the_title(); ?></h3>
</a>

  <hr class="border-white">


  <p class=""><?php the_tags('Tags: '); ?></p>
  <a href="<?php the_permalink(); ?>">Read More</a>
  </div>



  </div>


  </div>


  </div>
<!-- end of col --> 
<?php endwhile; ?>
<!-- pagination -->
<div class="col-md-12 text-center pt-5 pb-5">
<?php echo paginate_links(array(
'show_all' => true,
'prev_text' => '&#60;',
'next_text' => '&#62;'
)); ?>
</div>
<?php endif; ?>
</div>
</div>
<?php echo get_template_part('partials/sidebar'); ?>
</div>
</div>
</section>

<?php 
wp_enqueue_script('anime-cdn-js', '//cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js');
wp_enqueue_script('portfolio-js', get_theme_file_uri('/js/portfolio.js'));
get_footer(); ?>