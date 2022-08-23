<div class="col-lg-3 col-md-12 sidebar">
<div class="card p-3 mb-2">
<?php get_search_form(); ?>
</div>
<!-- <div class="card p-3 mt-2 mb-2">
<h2>Subscribe to Our Blog</h2>
<p>Enter your email address to subscribe to this blog and receive notifications of new posts by email.</p>
</div> -->
<!-- <div class="card p-3 mt-2 mb-2">
<?php wp_list_categories(); ?>
</div> -->
<div class="card p-3 mt-2 mb-2">
<h4>Recent Posts</h4>
<?php
$recentBlog = new WP_Query(array(
'posts_per_page' => 5,
'post_type' => 'post'
)); ?>
<ul>
<?php while($recentBlog->have_posts()){
$recentBlog->the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php } wp_reset_postdata(); ?>
</ul>
</div>
<div class="card p-3 mt-2 mb-2">
<h4>Archives</h4>
<ul>
<?php wp_get_archives(); ?>
</ul>
</div>
</div>