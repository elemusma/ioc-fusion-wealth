<?php get_header(); ?>
<section class="pt-5 pb-5 body">
<div class="container">
    <div class="row justify-content-center">
        

        <div class="col-lg-9 col-md-12 pr-lg-5 pt-4">
            <div>
                <?php echo get_template_part('partials/breadcrumbs'); ?>
            <h1 class="ml2"><?php the_title(); ?></h1>
        <p class="d-flex flex-wrap align-items-center">
        Posted on: <?php the_time('F jS, Y'); ?></p>

            </div>
        
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
the_content();
endwhile; else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>
<hr>
        </div>
        <?php get_template_part('partials/sidebar'); ?>
        <div class="col-md-12">
        </div>
        
    </div>
    <div class="row">
    <!-- <div class="col-md-7 mt-2 mb-5">
        <?php comments_template(); ?>
        </div> -->
        <div class="col-md-6">
        <!-- <small>Previous</small> -->
        <h3 class="h5"><?php previous_post_link(); ?></h3>
        </div>
        <div class="col-md-6 text-right">
            <!-- <small>Next</small> -->
        <h3 class="h5"><?php next_post_link(); ?></h3>
        </div>
    </div>
</div>
</section>
<?php get_footer(); ?>