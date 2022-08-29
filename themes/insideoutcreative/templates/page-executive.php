<?php

/**
 * Template Name: Page - Executive
 */

 get_header();

// start of header
// echo '<section class="position-relative section-header" style="padding:100px 0;">';
echo '<section class="position-relative section-header" style="padding:100px 0;background:url(' . get_the_post_thumbnail_url() . ');background-size:cover;background-position:center;">';
// echo '</section>';

// the_post_thumbnail('full',array('class'=>'w-100 h-100 position-absolute','style'=>'top:0;left:0;object-fit:cover;'));
echo '<div class="position-absolute w-100 h-100" style="top:0;left:0;mix-blend-mode:multiply;background-color: #d2d2d2;"></div>';


echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12 text-right">';

echo '<h1 class="text-uppercase text-white">' . get_the_title() . '</h1>';
echo '<h2 class="text-white">Optimize Your Wealth</h2>';

echo '<a href="' . home_url() . '/appointment/" class="btn btn-effect text-accent bg-white d-inline-block position-relative overflow-h">';
echo '<div class="position-absolute w-100 h-100 bg-light" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">Talk To Our Team</span>';
echo '</a>';

echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';
// end of header

// start of intro

echo '<section class="position-relative section-intro" style="padding:100px 0;">';

echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-md-6 pb-4">';

echo '<h2 class="">Protect Your Most Valuable Asset - <strong>TIME</strong></h2>';

echo '</div>';

echo '<div class="col-md-6 pb-4">';

echo '<h6 class="">Simplify Your Wealth to Focus on What Matters Most to You</h6>';

echo '<p>when you engage with our team, we streamline your financial plan and take the burden off you. We make sure your wealth plan and life values are connected.</p>';

echo '<a href="' . home_url() . '/appointment/" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h">';
echo '<div class="position-absolute w-100 h-100 bg-accent-secondary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">GET STARTED NOW</span>';
echo '</a>';

echo '</div>';

// echo '<div class="col-md-4">';
// echo '<h4>$27B</h4>';
// echo '<div class="divider-small"></div>';
// echo '<span class="text-gray">Assets under management</span>';
// echo '</div>';

// echo '<div class="col-md-4">';
// echo '<h4>10</h4>';
// echo '<div class="divider-small"></div>';
// echo '<span class="text-gray">True Fiduciary® Standards</span>';
// echo '</div>';

// echo '<div class="col-md-4">';
// echo '<h4>100</h4>';
// echo '<div class="divider-small"></div>';
// echo '<span class="text-gray">Liquidity Plan Events</span>';
// echo '</div>';

// echo '<div class="col-12 pt-4">';

// echo '<a href="' . home_url() . '/appointment/" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h">';
// echo '<div class="position-absolute w-100 h-100 bg-accent-secondary" style="top:0;left:-100%;"></div>';
// echo '<span class="position-relative">Talk to Founder</span>';
// echo '</a>';

// echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';

// end of intro



// start of bullet points

echo '<section class="position-relative section-intro" style="padding:100px 0;background: rgb(247,247,247);background: linear-gradient(90deg, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 100%);">';

echo '<div class="container">';
echo '<div class="row justify-content-center">';
echo '<div class="col-12 pb-4">';

echo '<h2 class="text-center">Maximize Your Equity Compensation</h2>';
echo '<h3 class="text-center">Plan Your Equity Compensation to Align With Your Future Goals</h3>';

echo '</div>';

echo '<div class="col-md-3 text-center">';
echo '<div class="position-relative h-100 p-2" style="border:1px solid black;">';

echo '<h3>Liquidation Strategies</h3>';

echo '</div>';
echo '</div>';

echo '<div class="col-md-3 text-center">';
echo '<div class="position-relative h-100 p-2" style="border:1px solid black;">';

echo '<h3>Tax Mitigation</h3>';

echo '</div>';
echo '</div>';

echo '<div class="col-md-3 text-center">';
echo '<div class="position-relative h-100 p-2" style="border:1px solid black;">';

echo '<h3>Gifting Strategies</h3>';

echo '</div>';
echo '</div>';

echo '<div class="col-md-3 text-center">';
echo '<div class="position-relative h-100 p-2" style="border:1px solid black;">';

echo '<h3>Asset Protection</h3>';

echo '</div>';
echo '</div>';

// echo '<div class="col-md-6">';
// echo '<h4 class="text-accent" style="border-bottom:2px solid var(--accent-primary);">5 Important Factors</h4>';
// // echo '<div class="divider-small"></div>';

// echo '<ul class="text-gray">';
// echo '<li><strong>Pre-Sale Planning</strong>: Make sure the right team is in place so you can have a successful exit.</li>';
// echo '<li><strong>Wise Money Decisions</strong>: Create a personalized wealth plan that will make you and your family feel secure.</li>';
// echo '<li><strong>Tax Mitigations Strategies</strong>: Estate and tax planning strategies for your future business exit.</li>';
// echo '<li><strong>Asset Protection</strong>: Have your wealth positioned, so it is not exposed or taken due to unjust litigation.</li>';
// echo '<li><strong>Maximize Charitable Gifts</strong>: Understand how to have the greatest impact on the causes you care about most.</li>';
// echo '</ul>';

// echo '</div>';


echo '<div class="col-12 pt-4 text-center">';

echo '<p>Stock options and other forms of equity compensation can represent an opportunity to build significant wealth. Unfortunately, it is all too common to see that opportunity wasted because of inadequate planning. Many executives fail to implement different strategies for their restricted shares, stock options, and ESPPs, despite the underlying differences in their structure and tax treatment.</p>';

echo '<a href="' . home_url() . '/appointment/" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h">';
echo '<div class="position-absolute w-100 h-100 bg-accent-secondary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">Schedule Your Call</span>';
echo '</a>';

echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';

// end of bullet points

// start of banner
echo '<section class="position-relative section-intro text-center" style="padding:100px 0 0;">';



// echo '<div class="container">';
// echo '<div class="row">';
echo '<div class="col-12">';

echo '<div class="position-relative pt-5 pb-5">';

echo wp_get_attachment_image(2998,'full','',['class'=>'w-100 h-100 position-absolute','style'=>'top:0;left:0;object-fit:cover;']);

echo '<h2 class="text-white position-relative">Four Steps to Take to Stress-Test<br>Your Financial Plan</h2>';

echo '<a href="' . home_url() . '/appointment/" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h">';
echo '<div class="position-absolute w-100 h-100 bg-accent-secondary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">REQUEST NOW</span>';
echo '</a>';

echo '</div>';
echo '</div>';
// echo '</div>';
// echo '</div>';
echo '</section>';
// end of banner

// start of family tree
echo '<section class="position-relative section-intro" style="padding:100px 0;">';

echo '<div class="container">';
echo '<div class="row justify-content-center">';
echo '<div class="col-12 pb-4 text-center">';

echo '<h2 class="">A Virtual Family Office for Entrepreneurs</h2>';
echo '<h3 class="pb-4">A Team Built and Coordinated to Simplify Your Financial Life</h3>';

echo wp_get_attachment_image(2999,'full','',['class'=>'w-100 h-auto m-auto','style'=>'max-width:750px;mix-blend-mode:darken;']);

echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';

// start of family tree

// start of blog
if(have_rows('blog_content')): while(have_rows('blog_content')): the_row();

$content = get_sub_field('content');
$relationship = get_sub_field('relationship');

echo '<section class="position-relative section-intro" style="padding:100px 0;">';

echo '<div class="container">';
echo '<div class="row justify-content-center">';
echo '<div class="col-12 pb-4 text-center">';

echo $content;

echo '</div>';

if( $relationship ):
    foreach( $relationship as $post ): 
    // Setup this post for WP functions (variable must be named $post).
    setup_postdata($post);
    echo '<a href="' . get_the_permalink() . '" class="d-block col-md-3">';

    echo '<div class="overflow-h">';
    echo '<div class="position-relative img-hover w-100">';
    the_post_thumbnail('full',array('class'=>'w-100','style'=>'height:200px;'));
    echo '</div>';
    echo '</div>';

    echo '<div class="bg-light p-4">';
    echo '<div class="divider-small" style="margin-left:0;"></div>';
    echo '<div class="pt-3"></div>';
    echo '<span class="text-black">' . get_the_title() . '</span>';
    echo '</div>';
    echo '</a>';
    endforeach;
        // Reset the global post object so that the rest of the page works correctly.
        wp_reset_postdata(); 
    endif;

echo '</div>';
echo '</div>';
echo '</section>';

endwhile; endif;
// end of blog

 get_footer();
 ?>