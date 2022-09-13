<?php
function fusion_wealth_management_stylesheets() {
wp_enqueue_style('style', get_stylesheet_uri() );

wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.min.css'));
wp_enqueue_style('fonts', get_theme_file_uri('/css/elements/fonts.css'));
wp_enqueue_style('btn', get_theme_file_uri('/css/elements/btn.css'));
wp_enqueue_style('nav', get_theme_file_uri('/css/sections/nav.css'));
wp_enqueue_style('hero', get_theme_file_uri('/css/sections/hero.css'));
wp_enqueue_style('blog', get_theme_file_uri('/css/sections/blog.css'));
wp_enqueue_style('img', get_theme_file_uri('/css/elements/img.css'));
wp_enqueue_style('photo-gallery', get_theme_file_uri('/css/sections/photo-gallery.css'));
wp_enqueue_style('body', get_theme_file_uri('/css/sections/body.css'));
wp_enqueue_style('sidebar', get_theme_file_uri('/css/sections/sidebar.css'));
wp_enqueue_style('popup', get_theme_file_uri('/css/sections/popup.css'));
wp_enqueue_style('contact', get_theme_file_uri('/css/sections/contact.css'));
wp_enqueue_style('woocommerce', get_theme_file_uri('/css/sections/woocommerce.css'));
wp_enqueue_style('free-consultation', get_theme_file_uri('/css/sections/free-consultation.css'));

if(is_page_template('templates/page-entrepreneur.php') || is_page_template('templates/page-executive.php')){
	wp_enqueue_style('pages', get_theme_file_uri('/css/sections/pages.css'));
}

if(is_page_template('templates/modules-parent.php')){
	wp_enqueue_style('modules', get_theme_file_uri('/css/sections/modules.css'));
}

if(is_front_page()){
wp_enqueue_style('home', get_theme_file_uri('/css/sections/home.css'));
}

// fonts
wp_enqueue_style('blair-itc', get_theme_file_uri('/blair-itc-font/stylesheet.css'));
wp_enqueue_style('proxima-nova', get_theme_file_uri('/proxima-nova/proxima-nova.css'));
// wp_enqueue_style('calibri', '//use.typekit.net/jui3ltm.css');
wp_enqueue_style('garammond', '//use.typekit.net/jfy5zpd.css');



if(is_page_template('templates/services.php')){
	wp_enqueue_style('services', get_theme_file_uri('/css/sections/services.css'));
	wp_enqueue_style('tabs', get_theme_file_uri('/css/sections/tabs.css'));
}


}
add_action('wp_enqueue_scripts', 'fusion_wealth_management_stylesheets');
// for footer
function fusion_wealth_management_stylesheets_footer() {
	wp_enqueue_style('footer', get_theme_file_uri('/css/sections/footer.css'));

	wp_enqueue_style('social-icons', get_theme_file_uri('/css/sections/social-icons.css'));
	
	// owl carousel
	wp_enqueue_style('owl.carousel.min', get_theme_file_uri('/owl-carousel/owl.carousel.min.css'));
	wp_enqueue_style('owl.theme.default', get_theme_file_uri('/owl-carousel/owl.theme.default.min.css'));
	wp_enqueue_style('lightbox-css', get_theme_file_uri('/lightbox/lightbox.min.css'));
	wp_enqueue_script('font-awesome', '//use.fontawesome.com/fff80caa08.js');
	// owl carousel
	wp_enqueue_script('jquery-min', get_theme_file_uri('/owl-carousel/jquery.min.js'));
	wp_enqueue_script('owl-carousel', get_theme_file_uri('/owl-carousel/owl.carousel.min.js'));
	wp_enqueue_script('owl-carousel-custom', get_theme_file_uri('/owl-carousel/owl-carousels.js'));
	wp_enqueue_script('lightbox-min-js', get_theme_file_uri('/lightbox/lightbox.min.js'));
	wp_enqueue_script('lightbox-js', get_theme_file_uri('/lightbox/lightbox.js'));
    // aos
    wp_enqueue_script('aos-js', get_theme_file_uri('/aos/aos.js'));
    wp_enqueue_script('aos-custom-js', get_theme_file_uri('/aos/aos-custom.js'));
    wp_enqueue_style('aos-css', get_theme_file_uri('/aos/aos.css'));
    // general
	wp_enqueue_script('nav-js', get_theme_file_uri('/js/nav.js'));
	wp_enqueue_script('popup-js', get_theme_file_uri('/js/popup.js'));
	if(is_page_template('templates/services-individual.php')){
		wp_enqueue_script('tabs-js', get_theme_file_uri('/js/tabs.js'));
	}

	if( is_page_template('templates/portfolio.php') || is_page_template('templates/portfolio-parent.php') || is_page_template('templates/design-parent.php') || is_page_template('templates/design-child.php') || is_page_template('templates/build-parent.php') || is_page_template('templates/build-child.php') || is_page_template('templates/invest-parent.php') || is_page_template('templates/invest-child.php') || is_single() || is_page_template('templates/blog-native.php') ){

		wp_enqueue_script('anime-cdn-js', '//cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js');
		wp_enqueue_script('portfolio-js', get_theme_file_uri('/js/portfolio.js'));
	}

	if(is_front_page()){
		wp_enqueue_script('home-js', get_theme_file_uri('/js/home.js'));
	}

// 	if(is_page('checkout')){
		wp_enqueue_script('checkout-js', get_theme_file_uri('/js/checkout.js'));
// 	}
}
add_action('get_footer', 'fusion_wealth_management_stylesheets_footer');
function fusion_wealth_management_menus() {
 register_nav_menus( array(
   'primary' => __( 'Primary Menu' )));
register_nav_menus( array(
'secondary' => __( 'Secondary Menu' )));
 register_nav_menu('new-menu',__( 'Footer Links' ));
 add_theme_support('title-tag');
 add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'fusion_wealth_management_menus');
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}
// add_filter('show_admin_bar', '__return_false');

function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function btn_shortcode( $atts, $content = null ) {

	$a = shortcode_atts( array(
	
	'class' => '',

	'class_secondary' => '',
	
	'href' => '#',
	
	'style' => '',
	
	'target' => ''
	
	), $atts );
	
	// return '<a class="btn-accent-primary" href="' . esc_attr($a['href']) . '" target="' . esc_attr($a['target']) . '">' . $content . '</a>';
	
	// return '<a class="' . esc_attr($a['class']) . '" href="' . esc_attr($a['href']) . '" style="' . esc_attr($a['style']) . '" target="' . esc_attr($a['target']) . '">' . $content . '</a>';

	return '<a href="' . esc_attr($a['href']) . '" class="btn btn-effect ' . esc_attr($a['class']) . ' d-inline-block position-relative overflow-h mt-4" target="' . esc_attr($a['target']) . '"><div class="position-absolute w-100 h-100 ' . esc_attr($a['class_secondary']) . '" style="top:0;left:-100%;"></div><span class="position-relative">' . $content . '</span></a>';
	
	// [button href="#" class="bg-accent text-white" class_secondary="bg-accent-secondary" style=""]Join Now[/button]
	
	}
	
	add_shortcode( 'button', 'btn_shortcode' );

	/*Base URL shorcode*/
add_shortcode( 'base_url', 'baseurl_shortcode' );
function baseurl_shortcode( $atts ) {

    return site_url();
	// [base_url]

}