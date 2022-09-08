<?php
function fusion_wealth_management_stylesheets() {
wp_enqueue_style('style', get_stylesheet_uri() );

wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.min.css'));
wp_enqueue_style('btn', get_theme_file_uri('/css/elements/btn.css'));
wp_enqueue_style('nav', get_theme_file_uri('/css/sections/nav.css'));
wp_enqueue_style('hero', get_theme_file_uri('/css/sections/hero.css'));
wp_enqueue_style('blog', get_theme_file_uri('/css/sections/blog.css'));
wp_enqueue_style('fonts', get_theme_file_uri('/css/elements/fonts.css'));
wp_enqueue_style('img', get_theme_file_uri('/css/elements/img.css'));
wp_enqueue_style('photo-gallery', get_theme_file_uri('/css/sections/photo-gallery.css'));
wp_enqueue_style('body', get_theme_file_uri('/css/sections/body.css'));
wp_enqueue_style('sidebar', get_theme_file_uri('/css/sections/sidebar.css'));
wp_enqueue_style('popup', get_theme_file_uri('/css/sections/popup.css'));
wp_enqueue_style('contact', get_theme_file_uri('/css/sections/contact.css'));
wp_enqueue_style('woocommerce', get_theme_file_uri('/css/sections/woocommerce.css'));

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

add_action('after_setup_theme',function() {
    add_theme_support('woocommerce');
});
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

add_action('woocommerce_before_main_content','add_container_class',9);
function add_container_class(){
echo '<div class="container pt-5 pb-5">';
echo '<div class="row justify-content-center">';
// echo get_template_part('partials/sidebar');
echo '<div class="col-12">';
}

add_action('woocommerce_after_main_content','close_container_class',9);
function close_container_class(){
echo '</div>';
echo '</div>';
echo '</div>';
}

// removes sidebar
remove_action('woocommerce_sidebar','woocommerce_get_sidebar');

add_action('woocommerce_after_cart','books',10);

function books(){ ?>

	 <div class="container pt-5">
    <div class="row justify-content-center">
<div class="col-lg-3 col-6 order-1 text-center">
<?php 
if(have_rows('left',2)): while(have_rows('left',2)): the_row();
$link = get_sub_field('link');
$link_url = $link['url'];
$link_title = $link['title'];
$link_target = $link['target'] ? $link['target'] : '_self';
$image = get_sub_field('image');

echo wp_get_attachment_image($image,'large','',['class'=>'w-100 mb-5 img-amazon','style'=>'height:325px;object-fit:contain;']);
echo '<a class="" href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">';
echo wp_get_attachment_image(2411,'large','',['class'=>'w-75 h-auto m-auto','style'=>'']);
echo '</a>';


endwhile; endif;
?>
</div>


<div class="col-lg-3 col-6 order-lg-3 order-2 text-center">
<?php 
if(have_rows('right',2)): while(have_rows('right',2)): the_row();
$link = get_sub_field('link');
$link_url = $link['url'];
$link_title = $link['title'];
$link_target = $link['target'] ? $link['target'] : '_self';
$image = get_sub_field('image');

echo wp_get_attachment_image($image['id'],'large','',['class'=>'w-100 mb-5 img-amazon','style'=>'height:325px;object-fit:contain;']);
echo '<a class="" href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">';
echo wp_get_attachment_image(2411,'large','',['class'=>'w-75 h-auto m-auto','style'=>'']);
echo '</a>';

endwhile; endif;
?>
</div>
</div>
    </div>

<?php }

function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function fusion_wealth_management_block_editor_settings() {
	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => _x( 'Primary', 'color', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => _x( 'Secondary', 'color', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	// $background_color = get_theme_mod( 'background_color' );
	// if ( ! $background_color ) {
	// 	$background_color_arr = get_theme_support( 'custom-background' );
	// 	$background_color     = $background_color_arr[0]['default-color'];
	// }
	// $editor_color_palette[] = array(
	// 	'name'  => __( 'Background Color', 'twentytwenty' ),
	// 	'slug'  => 'background',
	// 	'color' => '#' . $background_color,
	// );

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}
}

// add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

add_action('after_setup_theme','fusion_wealth_management_block_editor_settings');

function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}