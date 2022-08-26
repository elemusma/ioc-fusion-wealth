<?php
/**
 * Block Patterns
 *
 * @package twentig
 */
 
/**
 * Registers the block pattern categories.
 */
function twentig_register_block_pattern_categories () {
	if ( function_exists( 'register_block_pattern_category' ) ) {		
		register_block_pattern_category( 'columns', array( 'label' => esc_html_x( 'Columns', 'Block pattern category' ) ) );
		register_block_pattern_category( 'text-image', array( 'label' => esc_html_x( 'Text and Image', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'text', array( 'label' => esc_html_x( 'Text', 'Block pattern category' ) ) );
		register_block_pattern_category( 'hero', array( 'label' => esc_html_x( 'Hero', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'cover', array( 'label' => esc_html_x( 'Cover', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'cta', array( 'label' => esc_html_x( 'Call to Action', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'list', array( 'label' => esc_html_x( 'List', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'numbers', array( 'label' => esc_html_x( 'Numbers, Stats', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'gallery', array( 'label' => esc_html_x( 'Gallery', 'Block pattern category' ) ) );
		register_block_pattern_category( 'video-audio', array( 'label' => esc_html_x( 'Video, Audio', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'latest-posts', array( 'label' => esc_html_x( 'Latest Posts', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'contact', array( 'label' => esc_html_x( 'Contact', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'team', array( 'label' => esc_html_x( 'Team', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'testimonials', array( 'label' => esc_html_x( 'Testimonials', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'logos', array( 'label' => esc_html_x( 'Logos, Clients', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'pricing', array( 'label' => esc_html_x( 'Pricing', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'faq', array( 'label' => esc_html_x( 'FAQ', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'events', array( 'label' => esc_html_x( 'Events, Schedule', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'buttons', array( 'label' => _x( 'Buttons', 'Block pattern category' ) ) );
		register_block_pattern_category( 'pages', array( 'label' => _x( 'Pages', 'Block pattern category' ) ) );
		register_block_pattern_category( 'page-single', array( 'label' => _x( 'Single Pages', 'Block pattern category', 'twentig' ) ) );
		register_block_pattern_category( 'query', array( 'label' => _x( 'Query', 'Block pattern category' ) ) );
		register_block_pattern_category( 'header', array( 'label' => _x( 'Headers', 'Block pattern category' ) ) );
		register_block_pattern_category( 'footer', array( 'label' => _x( 'Footers', 'Block pattern category' ) ) );	

		if ( WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( 'twentytwenty' ) ) {
			unregister_block_pattern_category( 'twentytwenty' );
			register_block_pattern_category( 'twentytwenty', array( 'label' => 'Twenty Twenty' ) );
		}

		if ( WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( 'twentytwentyone' ) ) {
			unregister_block_pattern_category( 'twentytwentyone' );
			register_block_pattern_category( 'twentytwentyone', array( 'label' => 'Twenty Twenty-One' ) );
		}
	}	
}
add_action( 'init', 'twentig_register_block_pattern_categories', 9 );

/**
 * Registers the block patterns.
 */
function twentig_register_block_patterns() {

	$path = TWENTIG_PATH . 'inc/classic/patterns/';	
	if ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) {
		$path = TWENTIG_PATH . 'inc/patterns/';
	}

	$files = array(
		'columns.php',
		'text.php',
		'contact.php',
		'text-image.php',
		'cover.php',
		'cta.php',
		'events.php',
		'faq.php',
		'gallery.php',
		'hero.php',
		'latest-posts.php',
		'list.php',
		'logos.php',
		'numbers.php',
		'pricing.php',
		'team.php',
		'testimonials.php',
		'video-audio.php',
		'pages.php',
		'single-page.php',
		'header.php',
		'footer.php',
		'query.php',
	);

	if ( 'twentytwenty' === get_template() ) {
		$files[] = 'twentytwenty.php';
	}

	foreach ( $files as $file ) {
		if ( file_exists( $path . $file ) ) {
			require_once $path . $file;
		}
	}
}
add_action( 'init', 'twentig_register_block_patterns', 9 );

/**
 * Registers a block pattern.
 *
 * @param string $pattern_name       Pattern name including namespace.
 * @param array  $pattern_properties Array containing the properties of the pattern.
 */
function twentig_register_block_pattern( $pattern_name, $pattern_properties ) {

	if ( ! isset( $pattern_properties['viewportWidth'] ) ) {
		$pattern_properties['viewportWidth'] = 1440;
	}

	if ( 'twentytwenty' === get_template() ) {
		$pattern_properties['content'] = twentig_twentytwenty_opiniated_style_for_pattern( $pattern_properties['content'] );
	}

	if ( ! in_array( get_template(), ['twentytwentytwo','twentytwentyone', 'twentytwenty' ] ) ) {
		$pattern_properties['content'] = twentig_remove_opiniated_style_from_pattern( $pattern_properties['content'] );
	}

	register_block_pattern(
		$pattern_name,
		$pattern_properties
	);
}

function twentig_twentytwenty_opiniated_style_for_pattern( $content ) {

	$content = str_replace(
		[
			'<!-- wp:heading {"level":3,"fontSize":"large"',
			'<h3 class="has-large-font-size',
			'<!-- wp:heading {"fontSize":"large"} --><h2 class="has-large-font-size">',
			'<!-- wp:paragraph {"fontSize":"medium"',
			'<p class="has-medium-font-size',
			'"backgroundColor":"subtle"',
			'has-subtle-background-color',
			'<!-- wp:heading {"fontSize":"h3"} --><h2 class="has-h-3-font-size">',
			'<!-- wp:heading {"fontSize":"extra-large"',
			'<h2 class="has-extra-large-font-size',
			'"fontSize":"huge"',
			'has-huge-font-size',			
			'tw-hide-more-link',
			'<!-- wp:heading {"level":1,"fontSize":"extra-large"',
			'<h1 class="has-extra-large-font-size',
			'<!-- wp:media-text {"align":"full"',
			'<div class="wp-block-media-text alignfull',
		],
		[
			'<!-- wp:heading {"level":3,"fontSize":"h5"',
			'<h3 class="has-h-5-font-size',			
			'<!-- wp:heading {"fontSize":"large"} --><h2 class="has-h-5-font-size">',
			'<!-- wp:paragraph {"fontSize":"large"',
			'<p class="has-large-font-size',
			'"backgroundColor":"subtle-background"',
			'has-subtle-background-background-color',			
			'<!-- wp:heading {"fontSize":"h4"} --><h2 class="has-h-4-font-size">',
			'<!-- wp:heading {"fontSize":"h3"',
			'<h2 class="has-h-3-font-size',
			'"fontSize":"h1"',
			'has-h-1-font-size',
			'',
			'<!-- wp:heading {"level":1,"fontSize":"h3"',
			'<h1 class="has-h-3-font-size',
			'<!-- wp:media-text {"align":"full","className":"tw-content-narrow"',
			'<div class="wp-block-media-text alignfull tw-content-narrow',
		],
		$content
	);
	
	return $content;
}

function twentig_remove_opiniated_style_from_pattern( $content ) {
	$content = str_replace(
		[
			'<!-- wp:heading {"level":3,"fontSize":"large"} --><h3 class="has-large-font-size">',
			'<!-- wp:heading {"level":3,"fontSize":"large",',
			'<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem"}}} --><h3 style="font-size:1.5rem">',
			'<!-- wp:heading {"level":3,"fontSize":"x-large",',
			'<!-- wp:heading {"fontSize":"large"} --><h2 class="has-large-font-size">',
			'<!-- wp:heading {"fontSize":"extra-large"} --><h2 class="has-extra-large-font-size">',
		],
		[
			'<!-- wp:heading {"level":3} --><h3>',
			'<!-- wp:heading {"level":3,',
			'<!-- wp:heading {"level":3} --><h3>',
			'<!-- wp:heading {"level":3,',
			'<!-- wp:heading --><h2>',
			'<!-- wp:heading --><h2>',
		],
		$content
	);
	
	return $content;
}

/**
 * Retrieves the url of asset stored inside the plugin that can be used in block patterns.
 *
 * @param string $asset_name Asset name.
 */
function twentig_get_pattern_asset( $asset_name ) {
	return esc_url( TWENTIG_ASSETS_URI . '/images/patterns/' . $asset_name );
}
