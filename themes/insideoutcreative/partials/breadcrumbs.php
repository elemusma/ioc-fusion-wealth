<ul class="list-unstyled d-flex mb-0 small">
<li class="mr-2"><a href="<?php echo home_url(); ?>" class="text-accent">Home</a> &#62; </li>
<?php if ( $post->post_parent ) { ?>
    <li class="mr-2"><a href="<?php echo get_permalink( $post->post_parent ); ?>" class="text-accent"><?php echo get_the_title( $post->post_parent ); ?></a> &#62; </li>
    <?php } ?>
<?php if ( is_single() ) { ?>
    <li class="mr-2"><a href="<?php echo home_url(); ?>/blog/" class="text-accent">Blog</a> &#62; </li>
<?php } ?>
<li><?php the_title(); ?></li>
</ul>