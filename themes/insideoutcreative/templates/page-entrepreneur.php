<?php

/**
 * Template Name: Page - Entrepreneur
 */

 get_header();

// start of header
echo '<section class="position-relative section-header" style="padding:100px 0;">';

the_post_thumbnail('full',array('class'=>'w-100 h-100 position-absolute','style'=>'top:0;left:0;object-fit:cover;'));

echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12 text-right">';

echo '<h1 class="text-uppercase text-white">' . get_the_title() . '</h1>';
echo '<h2 class="text-white">Streamline your path</h2>';

echo '<a href="#" class="btn btn-effect text-accent bg-white d-inline-block position-relative overflow-h">';
echo '<div class="position-absolute w-100 h-100 bg-light" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">Talk to Founder</span>';
echo '</a>';

echo '</div>';
echo '</div>';
echo '</div>';
echo '</section>';
// end of header

// start of intro

echo '<section class="position-relative section-intro text-center" style="padding:100px 0;">';

echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-12 pb-4">';

echo '<h2 class="">CEO Founders & Entrepreneurs</h2>';
echo '<h3 class="">You Face Unique Planning Challenges.</h3>';

echo '</div>';

echo '<div class="col-md-4">';
echo '<h4>$27B</h4>';
echo '<div class="divider-small"></div>';
echo '<span class="text-gray">Assets under management</span>';
echo '</div>';

echo '<div class="col-md-4">';
echo '<h4>10</h4>';
echo '<div class="divider-small"></div>';
echo '<span class="text-gray">True Fiduciary® Standards</span>';
echo '</div>';

echo '<div class="col-md-4">';
echo '<h4>100</h4>';
echo '<div class="divider-small"></div>';
echo '<span class="text-gray">Liquidity Plan Events</span>';
echo '</div>';

echo '<div class="col-12 pt-4">';

echo '<a href="#" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h">';
echo '<div class="position-absolute w-100 h-100 bg-accent-secondary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">Talk to Founder</span>';
echo '</a>';

echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';

// end of intro

// start of banner
echo '<section class="position-relative section-intro text-center" style="padding:100px 0;">';



// echo '<div class="container">';
// echo '<div class="row">';
echo '<div class="col-12">';

echo '<div class="position-relative pt-5 pb-5">';

echo wp_get_attachment_image(2998,'full','',['class'=>'w-100 h-100 position-absolute','style'=>'top:0;left:0;object-fit:cover;']);

echo '<h2 class="text-white position-relative">Top Ten Tips Before <br><strong>SELLING YOUR BUSINESS</strong></h2>';

echo '<a href="#" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h">';
echo '<div class="position-absolute w-100 h-100 bg-accent-secondary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">REQUEST NOW</span>';
echo '</a>';

echo '</div>';
echo '</div>';
// echo '</div>';
// echo '</div>';
echo '</section>';
// end of banner

// start of intro

echo '<section class="position-relative section-intro" style="padding:100px 0;">';

echo '<div class="container">';
echo '<div class="row justify-content-center">';
echo '<div class="col-12 pb-4">';

echo '<h2 class="text-center">Path to Financial Freedom</h2>';
echo '<h3 class="text-center">Plan Your Business Exit to Align With Your Personal Goals.</h3>';

echo '</div>';

echo '<div class="col-md-6">';
echo '<h4 class="text-accent" style="border-bottom:2px solid var(--accent-primary);">5 Important Factors</h4>';
// echo '<div class="divider-small"></div>';

echo '<ul class="text-gray">';
echo '<li><strong>Pre-Sale Planning</strong>: Make sure the right team is in place so you can have a successful exit.</li>';
echo '<li><strong>Wise Money Decisions</strong>: Create a personalized wealth plan that will make you and your family feel secure.</li>';
echo '<li><strong>Tax Mitigations Strategies</strong>: Estate and tax planning strategies for your future business exit.</li>';
echo '<li><strong>Asset Protection</strong>: Have your wealth positioned, so it is not exposed or taken due to unjust litigation.</li>';
echo '<li><strong>Maximize Charitable Gifts</strong>: Understand how to have the greatest impact on the causes you care about most.</li>';
echo '</ul>';

echo '</div>';


echo '<div class="col-12 pt-4 text-center">';

echo '<a href="#" class="btn btn-effect text-white bg-accent d-inline-block position-relative overflow-h">';
echo '<div class="position-absolute w-100 h-100 bg-accent-secondary" style="top:0;left:-100%;"></div>';
echo '<span class="position-relative">Schedule Your Call</span>';
echo '</a>';

echo '</div>';

echo '</div>';
echo '</div>';
echo '</section>';

// end of intro

 get_footer();
 ?>