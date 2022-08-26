<?php

/**
 * Enqueues block assets for frontend and backend editor.
 */
function twentig_block_assets() {

	$asset_file             = include TWENTIG_PATH . 'dist/index.asset.php';
	$block_library_filename = wp_should_load_separate_core_block_assets() ? 'blocks/common.min' : 'style-index';

	wp_enqueue_style(
		'twentig-blocks',
		plugins_url( 'dist/' . $block_library_filename . '.css', dirname( __FILE__ ) ),
		array(),
		$asset_file['version']
	);

	wp_style_add_data( 'twentig-blocks', 'rtl', 'replace' );
}
add_action( 'enqueue_block_assets', 'twentig_block_assets' );

/**
 * Enqueues block assets for backend editor.
 */
function twentig_block_editor_assets() {

	global $pagenow;

	$asset_file = include TWENTIG_PATH . 'dist/index.asset.php';
	$deps       = $asset_file['dependencies'];
	$env        = 'post-editor';

	// Removes editor related assets when viewing the customizer or widgets screen to prevent conflict with the widgets editor.
	if ( is_customize_preview() || 'widgets.php' === $pagenow ) {
		$env           = 'no-post-editor';
		$edit_post_key = array_search( 'wp-edit-post', $deps );
		if ( false !== $edit_post_key ) {
			unset( $deps[ $edit_post_key ] );
		}
		$edit_site_key = array_search( 'wp-edit-site', $deps );
		if ( false !== $edit_site_key ) {
			unset( $deps[ $edit_site_key ] );
		}		
	}
	
	if ( 'site-editor.php' === $pagenow ) {
		$env = 'site-editor';
	}

	wp_enqueue_script(
		'twentig-blocks-editor',
		plugins_url( '/dist/index.js', dirname( __FILE__ ) ),
		$deps,
		$asset_file['version'],
		false
	);

	$config = apply_filters(
		'twentig_blocks_editor_config',
		array(
			'theme'          => get_template(),
			'block_theme'    => function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ? true : false,
			'branch'         => str_replace( array( '.', ',' ), '-', (float) get_bloginfo( 'version' ) ),
			'cssClasses'     => twentig_get_block_css_classes(),
			'guideAssetsUri' => TWENTIG_ASSETS_URI . '/images/welcome/',
			'fonts'          => 'site-editor' === $env ? twentig_get_fonts_data() : [],
			'env'            => $env
		)
	);

	wp_localize_script( 'twentig-blocks-editor', 'twentigEditorConfig', $config );

	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'twentig-blocks-editor', 'twentig' );
	}

	wp_enqueue_style(
		'twentig-editor',
		plugins_url( 'dist/index.css', dirname( __FILE__ ) ),
		array( 'wp-edit-blocks' ),
		$asset_file['version']
	);

	wp_style_add_data( 'twentig-editor', 'rtl', 'replace' );
}
add_action( 'enqueue_block_editor_assets', 'twentig_block_editor_assets' );

/**
 * Processes the fonts json file and returns an array with its contents.
 * @see read_json_file() in class-wp-theme-json-resolver.php
 */
function twentig_get_fonts_data() {
	$file_path = TWENTIG_PATH . 'dist/js/webfonts.json';	
	$config = array();
	
	if ( function_exists( 'wp_json_file_decode' ) ) { // function exists since 5.9
		$decoded_file = wp_json_file_decode( $file_path, array( 'associative' => true ) );
		if ( is_array( $decoded_file ) ) {
			$config = $decoded_file;
		}
	} else if ( file_exists( $file_path ) ) {
		$decoded_file = json_decode( file_get_contents( $file_path ), true );
		if ( JSON_ERROR_NONE !== json_last_error() ) {
			return $config;
		}
		if ( is_array( $decoded_file ) ) {
			$config = $decoded_file;
		}
	}
	return $config;
}

/**
 * Enqueue block styles (attach extra styles or override block styles).
 */
function twentig_enqueue_block_styles() {

	if ( ! wp_should_load_separate_core_block_assets() ) {
		return;
	}

	// Add block-specific inline styles.
	$styled_blocks = [ 
		'cover',
		'image',
		'list',
		'table',
		'social-links',
		'post-featured-image',
		'query-title',
		'post-author',
		'quote',
		'post-navigation-link',
		'search',
		'query-pagination',
		'post-terms',
		'tag-cloud',
		'separator',
	];
 
	foreach ( $styled_blocks as $block_name ) {
		$style_path = TWENTIG_PATH . "dist/blocks/$block_name/style.min.css";
		if ( file_exists( $style_path ) ) {
			$styles = file_get_contents( $style_path );
			wp_add_inline_style( "wp-block-{$block_name}", $styles );
		}
	}
	
	// Override core blocks style.
	$overriden_blocks = [
		'columns',
		'gallery',
		'media-text',
		'post-template',		
		'latest-posts',
		'pullquote'
	];

	foreach ( $overriden_blocks as $block_name ) {
		$style_path = TWENTIG_PATH . "dist/blocks/$block_name/style.min.css";
		if ( file_exists( $style_path ) ) {
			wp_deregister_style( "wp-block-{$block_name}" );
			wp_register_style(
				"wp-block-{$block_name}",
				TWENTIG_ASSETS_URI . "/blocks/{$block_name}/style.min.css",
				array(),
				TWENTIG_VERSION
			);

			// Add a reference to the stylesheet's path to allow calculations for inlining styles in `wp_head`.
			wp_style_add_data( "wp-block-{$block_name}", 'path', $style_path );

			// Add RTL stylesheet.
			$rtl_file_path = str_replace( '.css', '-rtl.css', $style_path ); 
			if ( file_exists( $rtl_file_path ) ) {
				wp_style_add_data( "wp-block-{$block_name}", 'rtl', 'replace' );  
				if ( is_rtl() ) {
					wp_style_add_data( "wp-block-{$block_name}", 'path', $rtl_file_path );
				}
			}		
		}
	}
}
add_action( 'wp_enqueue_scripts', 'twentig_enqueue_block_styles' );

/**
 * Filters the columns block output.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_filter_columns_block( $block_content, $block ) {

	$attributes = isset( $block['attrs'] ) ? $block['attrs'] : [];
	$gap = _wp_array_get( $attributes, array( 'style', 'spacing', 'blockGap' ), null );

	if ( $gap && false !== strpos( $gap, 'px' ) ) {
		$gap_value = intval( $gap );
	
		if ( $gap_value > 32 ) {
			$class = 'tw-large-gap';
			$block_content = preg_replace(
				'/' . preg_quote( 'class="', '/' ) . '/',
				'class="' . $class . ' ',
				$block_content,
				1
			);
		}
	}
	return $block_content;
}
add_filter( 'render_block_core/columns', 'twentig_filter_columns_block', 10, 2 );

/**
 * Filters the column block output to add a CSS var to store the width attribute.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_filter_column_block( $block_content, $block ) {

	if ( wp_should_load_separate_core_block_assets() ) {
		return $block_content;
	}
	if ( isset( $block['attrs'] ) && isset( $block['attrs']['width'] ) ) {
		$block_content = str_replace( 'flex-basis', '--col-width:' . $block['attrs']['width'] . ';flex-basis', $block_content );
	}
	return $block_content;
}
add_filter( 'render_block_core/column', 'twentig_filter_column_block', 10, 2 );

/**
 * Wraps the archive title prefix with a span.
 *
 * @param string $prefix Archive title prefix.
 */
function twentig_set_archive_title_block_prefix( $prefix ) {
	if ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) {
		return '<span class="archive-title-prefix">' . $prefix . '</span>';
	}
	return $prefix;
}
add_filter( 'get_the_archive_title_prefix', 'twentig_set_archive_title_block_prefix' );

/**
 * Filters the post author block output.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_filter_post_author_block( $block_content, $block ) {	
	if ( ! empty( $block['attrs'] ) && isset( $block['attrs']['twIsLink'] ) && $block['attrs']['twIsLink']  ) {
		$author_id = get_post_field( 'post_author', get_the_ID() );
		if ( empty( $author_id ) ) {
			return $block_content;
		}
		
		$author_display_name = get_the_author_meta( 'display_name', $author_id );
		$author_post_url     = get_author_posts_url( $author_id );
	
		$block_content = str_replace(
			'<p class="wp-block-post-author__name">' . $author_display_name,
			sprintf( '<p class="wp-block-post-author__name"><a href="%s">%s</a>', esc_url( $author_post_url ), esc_html( $author_display_name ) ),
			$block_content
		);
	}
	return $block_content;
}
add_filter( 'render_block_core/post-author', 'twentig_filter_post_author_block', 10, 2 );

/**
 * Filters the post excerpt block output.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_filter_post_excerpt_block( $block_content, $block ) {
	
	if ( empty( $block_content ) || has_excerpt() ) {
		return $block_content;
	}
	
	add_filter( 'excerpt_more', function() {
		return '&hellip;';
	} );

	if ( ! empty( $block['attrs'] ) && isset( $block['attrs']['twExcerptLength'] ) ) {	

		$attributes            = $block['attrs'];	
		$more_text             = ! empty( $attributes['moreText'] ) ? '<a class="wp-block-post-excerpt__more-link" href="' . esc_url( get_the_permalink() ) . '">' . $attributes['moreText'] . '</a>' : '';
		$excerpt_length        = $attributes['twExcerptLength'];		
		$filter_excerpt_length = function() use ( $excerpt_length ) {
			return $excerpt_length;
		};
		add_filter( 'excerpt_length', $filter_excerpt_length );

		$excerpt               = get_the_excerpt();
		$content               = '<p class="wp-block-post-excerpt__excerpt">' . $excerpt;
		$show_more_on_new_line = ! isset( $attributes['showMoreOnNewLine'] ) || $attributes['showMoreOnNewLine'];
		if ( $show_more_on_new_line && ! empty( $more_text ) ) {
			$content .= '</p>';
		} else {
			$content .= " $more_text</p>";
		}
		$block_content = preg_replace('/<p class=\"wp-block-post-excerpt__excerpt\">.*?<\/p>/', $content , $block_content );
		remove_filter( 'excerpt_length', $filter_excerpt_length );
		return $block_content;
	}

	return $block_content;
}
add_filter( 'render_block_core/post-excerpt', 'twentig_filter_post_excerpt_block', 10, 2 );

/**
 * Filters the query block output.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_filter_query_block( $block_content, $block ) {

	$attributes = isset( $block['attrs'] ) ? $block['attrs'] : [];
	$layout     = _wp_array_get( $attributes, array( 'displayLayout','type' ), null );
	$new_class  = '';
	$style      = '';

	if ( 'flex' === $layout ) {
		if ( isset( $attributes['twVerticalAlignment'] ) ) {
			$new_class .= ' tw-valign-' . $attributes['twVerticalAlignment'];
		}
		if ( isset( $attributes['twColumnWidth'] ) ) {
			$new_class .= ' tw-cols-' . $attributes['twColumnWidth'];
		}
		if ( isset( $attributes['twBlockGapHorizontal'] ) ) {
			$style .= '--tw-gap-x:' . $attributes['twBlockGapHorizontal'] . ';';
		}
	}

	if ( isset( $attributes['twBlockGapVertical'] ) ) {
		$style .= '--tw-gap-y:' . $attributes['twBlockGapVertical'] . ';';
	}

	if ( $style ) {
		$query_class = wp_unique_id( 'tw-query-' );
		$new_class  .= ' ' . $query_class;
		$style       = '.' . $query_class . '{' . $style . '}';
		add_action(
			'wp_head',
			static function () use ( $style ) {
				echo "<style>$style</style>";
			}
		);
	}

	if ( $new_class ) {
		$block_content = preg_replace(
			'/' . preg_quote( 'class="', '/' ) . '/',
			'class="' . trim( $new_class ) . ' ',
			$block_content,
			1
		);
	}

	if ( 'flex' === $layout ) {
		$columns     = _wp_array_get( $attributes, array( 'displayLayout','columns' ), null );
		$image_sizes = '';
		
		if ( 2 === $columns ) {
			$image_sizes = '(min-width: 1024px) calc(50vw - 60px), (min-width: 640px) calc(50vw - 40px), calc(100vw - 40px)';
		} elseif ( 3 === $columns ) {
			$image_sizes = '(min-width: 1024px) calc(33vw - 50px), (min-width: 640px) calc(50vw - 40px), calc(100vw - 40px)';
		} else {
			$image_sizes = '(min-width: 1024px) calc(25vw - 40px), (min-width: 640px) calc(50vw - 40px), calc(100vw - 40px)';
		}

		$block_content = preg_replace( '/sizes="([^>]+?)"/', 'sizes="' . $image_sizes . '"', $block_content );			
	}

	return $block_content;
}
add_filter( 'render_block_core/query', 'twentig_filter_query_block', 10, 2 );

/**
 * Filters the navigation block output.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_filter_navigation_block( $block_content, $block ) {
	if ( ! empty( $block['attrs'] ) && isset( $block['attrs']['twMenuIcon'] ) ) {
		$current_icon = '<rect x="4" y="7.5" width="16" height="1.5" /><rect x="4" y="15" width="16" height="1.5" />';
		if ( 'three-lines' === $block['attrs']['twMenuIcon'] ) {
			$new_icon = '<rect x="4" y="6.5" width="16" height="1.5"></rect><rect x="4" y="11.25" width="16" height="1.5"></rect><rect x="4" y="16" width="16" height="1.5"></rect>';
			$block_content = str_replace( $current_icon, $new_icon, $block_content );
		} else if ( 'plus' === $block['attrs']['twMenuIcon'] ) {
			$new_icon = '<path d="M21.75 11.3H12.7V2.25h-1.4v9.05H2.25v1.4h9.05v9.05h1.4V12.7h9.05v-1.4"></path>';
			$block_content = str_replace( $current_icon, $new_icon, $block_content );
		}
	}
	return $block_content;
}
add_filter( 'render_block_core/navigation', 'twentig_filter_navigation_block', 10, 2 );

/**
 * Filters the parsed attribute values of the navigation block.
 *
 * @param array $parsed_block The block being rendered.
 *
 * @return array The block being rendered with additional classnames.
 */
function twentig_filter_navigation_block_class( $parsed_block ) {

	if ( 'core/navigation' === $parsed_block['blockName'] ) {
		$nav_class    = '';
		$attributes   = $parsed_block['attrs'];
		$hover_style  = isset( $attributes['twHoverStyle'] ) ? $attributes['twHoverStyle'] : '';
		$active_style = isset( $attributes['twActiveStyle'] ) ? $attributes['twActiveStyle'] : $hover_style;
		$overlay_menu = isset( $attributes['overlayMenu'] ) ? $attributes['overlayMenu'] : 'mobile';
	
		if ( $hover_style ) {
			$nav_class .= ' tw-nav-hover-' . $hover_style;
		}
		if ( $active_style ) {
			$nav_class .= ' tw-nav-active-' . $active_style;
		}
		if ( isset( $attributes['twGap'] ) ) {
			$nav_class .= ' tw-gap-' . $attributes['twGap'] ;
		}
		
		if ( in_array( $overlay_menu, ['mobile', 'always'], true ) ) {
			if ( isset( $attributes['twBreakpoint'] ) && 'mobile' === $overlay_menu ) {
				$nav_class .= ' tw-break-' . $attributes['twBreakpoint'];
			}
			if ( isset( $attributes['twMenuIconSize'] ) ) {
				$nav_class .= ' tw-icon-' . $attributes['twMenuIconSize'];
			}			
		}

		if ( $nav_class ) {
			if ( isset( $parsed_block['attrs']['className'] ) ) {
				$parsed_block['attrs']['className'] = trim( esc_html( $parsed_block['attrs']['className'] . $nav_class ) );
			} else {
				$parsed_block['attrs']['className'] = trim( esc_html( $nav_class ) );
			}
		}
	}
	return $parsed_block;
}
add_filter( 'render_block_data', 'twentig_filter_navigation_block_class' );

/**
 *  Renders out the shape style and SVG.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_render_shape_support( $block_content, $block ) {

	if ( ! empty( $block['attrs'] ) && isset( $block['attrs']['twShape'] ) ) {
		$shape            = $block['attrs']['twShape'];	
		$action_hook_name = function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ? 'wp_body_open' : 'wp_footer';

		add_action( $action_hook_name, function() use ( $shape ) { twentig_enqueue_shape_svg( $shape ); }, 11 );
		
		$style = "--shape:url(#tw-shape-$shape);";

		$first_element = $block_content;

		if ( 'core/cover' === $block['blockName'] ) {
			// Retrieve the opening tag of the first HTML element. cf wp_render_elements_support()
			$html_element_matches = array();
			preg_match( '/<[^>]+>/', $block_content, $html_element_matches, PREG_OFFSET_CAPTURE );
			$first_element = $html_element_matches[0][0];
		}

		if ( strpos( $first_element, 'style="' ) !== false ) {
			return preg_replace(
				'/' . preg_quote( 'style="', '/' ) . '/',
				'style="' . $style . ' ',
				$block_content,
				1
			);
		} else {
			return preg_replace(
				'/' . preg_quote( 'class="', '/' ) . '/',
				'style="' . $style . '" class="',
				$block_content,
				1
			);
		}
	}	
	return $block_content;
}
add_filter( 'render_block_core/image', 'twentig_render_shape_support', 10, 2 );
add_filter( 'render_block_core/cover', 'twentig_render_shape_support', 10, 2 );
add_filter( 'render_block_core/post-featured-image', 'twentig_render_shape_support', 10, 2 );

/**
 * Returns the shapes with their path.
 */
function twentig_get_shapes() {

	$shapes = array(
		'diamond'          => '<path d="M.9393.6464.6464.9393a.207.207 0 0 1-.2929 0L.0607.6464a.207.207 0 0 1 0-.2929L.3536.0606a.207.207 0 0 1 .2929 0l.2929.2929a.2072.2072 0 0 1-.0001.2929z"/>',
		'squircle'         => '<path d="M0 .5C0 .08.08 0 .5 0s.5.08.5.5-.08.5-.5.5S0 .92 0 .5z"/>',
		'organic-square'   => '<path d="M.602.042.637.027a.256.256 0 0 1 .336.336L.958.398a.256.256 0 0 0 0 .204l.015.035a.256.256 0 0 1-.336.336L.602.958a.256.256 0 0 0-.204 0L.363.973A.256.256 0 0 1 .027.637L.042.602a.256.256 0 0 0 0-.204L.027.363A.256.256 0 0 1 .363.027l.035.015a.256.256 0 0 0 .204 0Z"/>',
		'star-1'           => '<path d="M.3628.0418a.246.246 0 0 1 .2744 0A.246.246 0 0 0 .727.079a.246.246 0 0 1 .194.194.246.246 0 0 0 .0372.09.246.246 0 0 1 0 .2744A.246.246 0 0 0 .921.727a.246.246 0 0 1-.194.194.246.246 0 0 0-.09.0372.246.246 0 0 1-.2744 0A.246.246 0 0 0 .273.921.246.246 0 0 1 .079.727a.246.246 0 0 0-.0372-.09.246.246 0 0 1 0-.2744A.246.246 0 0 0 .079.273.246.246 0 0 1 .273.079.246.246 0 0 0 .3628.0418Z"/>',
		'star-2'           => '<path d="m.4031.0393.0462-.026a.1034.1034 0 0 1 .1015 0l.0461.026a.1034.1034 0 0 0 .05.0133l.0525.0005a.1034.1034 0 0 1 .0879.0508l.027.0456a.1034.1034 0 0 0 .0363.0363l.0456.027a.1034.1034 0 0 1 .0507.0878l.0005.0529a.1034.1034 0 0 0 .0133.05l.026.0461a.1034.1034 0 0 1 0 .1015l-.026.0458a.1034.1034 0 0 0-.0133.05L.9469.6994a.1034.1034 0 0 1-.0508.0879L.8506.8142a.1034.1034 0 0 0-.0364.0364L.7873.8961a.1034.1034 0 0 1-.0879.0508L.6465.9474a.1034.1034 0 0 0-.05.0133l-.0458.026a.1034.1034 0 0 1-.1015 0L.4031.9607a.1034.1034 0 0 0-.05-.0133L.3006.9469A.1034.1034 0 0 1 .2127.8961L.1858.8506A.1034.1034 0 0 0 .1494.8142L.1039.7873A.1034.1034 0 0 1 .0531.6994L.0526.6465a.1034.1034 0 0 0-.0133-.05L.0133.5507a.1034.1034 0 0 1 0-.1015l.026-.0461a.1034.1034 0 0 0 .0133-.05L.0531.3006A.1034.1034 0 0 1 .1039.2127L.1494.1858A.1034.1034 0 0 0 .1858.1494L.2127.1039A.1034.1034 0 0 1 .3006.0531L.3535.0526A.1034.1034 0 0 0 .4031.0393Z"/>',
		'star-3'           => '<path d="M.4257.0293.4683.0076a.07.07 0 0 1 .0635 0l.0425.0217a.07.07 0 0 0 .0372.0075L.6591.033a.07.07 0 0 1 .0586.0243l.031.0363A.07.07 0 0 0 .78.1147l.0457.0147a.07.07 0 0 1 .0449.0449L.8853.22a.07.07 0 0 0 .0211.0313l.0363.031A.07.07 0 0 1 .967.3409L.9632.3885a.07.07 0 0 0 .0075.0372l.0217.0426a.07.07 0 0 1 0 .0635L.9707.5743a.07.07 0 0 0-.0075.0372L.967.6591a.07.07 0 0 1-.0243.0586l-.0363.031A.07.07 0 0 0 .8853.78L.8706.8257a.07.07 0 0 1-.0449.0449L.78.8853a.07.07 0 0 0-.0313.0211l-.031.0363A.07.07 0 0 1 .6591.967L.6115.9632a.07.07 0 0 0-.0372.0075L.5317.9924a.07.07 0 0 1-.0635 0L.4257.9707A.07.07 0 0 0 .3885.9632L.3409.967A.07.07 0 0 1 .2823.9427L.2513.9064A.07.07 0 0 0 .22.8853L.1743.8706A.07.07 0 0 1 .1294.8257L.1147.78A.07.07 0 0 0 .0936.7487L.0573.7177A.07.07 0 0 1 .033.6591L.0368.6115A.07.07 0 0 0 .0293.5743L.0076.5317a.07.07 0 0 1 0-.0635L.0293.4257A.07.07 0 0 0 .0368.3885L.033.3409A.07.07 0 0 1 .0573.2823l.0363-.031A.07.07 0 0 0 .1147.22L.1294.1743A.07.07 0 0 1 .1743.1294L.22.1147A.07.07 0 0 0 .2513.0936l.031-.0363A.07.07 0 0 1 .3409.033l.0476.0038A.07.07 0 0 0 .4257.0293Z"/>',
		'organic-circle-1' => '<path d="M.9916.6255a.381.381 0 0 1-.1051.1972C.832.8774.7712.9196.7039.9495S.566.996.4917.9995a.3642.3642 0 0 1-.207-.0511C.221.9107.1665.8639.1212.8077S.0423.688.0204.617-.0058.4731.0077.3986.054.2593.1064.2046.2168.102.2804.0608.4149-.0007.4927 0s.1518.0174.2218.0501.1238.0821.1613.1481c.0375.0661.0701.1346.0976.2057s.0337.1449.0182.2216z"/>',
		'organic-circle-2' => '<path d="M.9952.6114a.4448.4448 0 0 1-.0839.2085C.8653.8825.8062.9268.7339.9527S.588.9941.513.9992C.4379 1.0042.3686.9866.3048.9463S.1816.8595.1264.8069.034.6895.0149.6125-.0049.4581.0128.3803.068.2381.1253.187.2428.0902.3058.0498s.1317-.0562.206-.0475.1435.0295.2072.0626.1179.0781.1625.135c.0446.0569.0772.1206.0977.1912s.0259.144.016.2203z"/>',
		'organic-circle-3' => '<path d="M.9891.6044A.416.416 0 0 1 .8852.799C.8333.8541.7749.9018.71.9419s-.1363.0595-.2141.058S.3456.9795.2785.943.1534.8591.1044.8011.0236.6771.0092.6033-.0027.4568.0168.3851.0683.248.113.1885.2143.0846.2828.0552.423.0079.498.0015s.1464.0079.2141.043.1233.0828.1666.1429C.922.2476.9555.3135.9793.3852s.0271.1447.0098.2192z"/>',
		'organic-circle-4' => '<path d="M.9918.6317a.406.406 0 0 1-.0864.2076C.8571.9005.797.9424.7252.965S.5812.9992.5086 1 .3636.9898.291.9672.163.9002.1246.8339.0528.698.0244.6251-.0076.4776.0137.4011.0677.2536.1118.188.2135.0725.2846.0383.4293-.0072.5054.0044.654.0361.723.0645s.1301.0714.1835.1289.0832.1257.0896.2044.005.1567-.0043.2339z"/>',
		'flower-1'         => '<path d="M1 .3A.3.3 0 0 0 .5.0765.3.3 0 0 0 .0765.5.3.3 0 0 0 .5.9235.3.3 0 0 0 .9235.5.2986.2986 0 0 0 1 .3z"/>',
		'flower-2'         => '<path d="M1 .3757A.2.2 0 0 0 .8229.1771.2.2 0 0 0 .5.0435a.2.2 0 0 0-.3229.1336A.2.2 0 0 0 .0435.5a.2.2 0 0 0 .1336.3229A.2.2 0 0 0 .5.9565.2.2 0 0 0 .8229.8229.2.2 0 0 0 .9565.5.1987.1987 0 0 0 1 .3757z"/>',
		'flower-3'         => '<path d="M.96.5A.1.1 0 0 0 .9254.3238a.1.1 0 0 0-.0863-.15L.8255.1745.8266.1609a.1.1 0 0 0-.15-.0863A.1.1 0 0 0 .5.04a.1.1 0 0 0-.1762.035.1.1 0 0 0-.15.0863l.001.0135L.1609.1734a.1.1 0 0 0-.0863.15A.1.1 0 0 0 .04.5a.1.1 0 0 0 .035.1762.1.1 0 0 0 .0863.15L.1745.8255.1734.8391a.1.1 0 0 0 .15.0863A.1.1 0 0 0 .5.96.1.1 0 0 0 .6762.9254a.1.1 0 0 0 .15-.0863L.8255.8255l.0135.001a.1.1 0 0 0 .0863-.15A.1.1 0 0 0 .96.5Z"/>',
		'peanut-1'         => '<path d="M1 .3A.3.3 0 0 0 .7 0H.3a.3.3 0 0 0-.2235.5A.3.3 0 0 0 .3 1h.4A.3.3 0 0 0 .9235.5.2988.2988 0 0 0 1 .3Z"/>',
		'peanut-2'         => '<path d="M.3 0a.3.3 0 0 0-.3.3v.4a.3.3 0 0 0 .5.2235A.3.3 0 0 0 1 .7V.3A.3.3 0 0 0 .5.0765.2988.2988 0 0 0 .3 0Z"/>',
		'hourglass-1'      => '<path d="M1 0H0v.3a.2988.2988 0 0 0 .0765.2A.2988.2988 0 0 0 0 .7V1h1V.7A.2988.2988 0 0 0 .9235.5.2988.2988 0 0 0 1 .3Z"/>',
		'hourglass-2'      => '<path d="M1 1V0H.7a.2988.2988 0 0 0-.2.0765A.2988.2988 0 0 0 .3 0H0v1h.3A.2988.2988 0 0 0 .5.9235.2988.2988 0 0 0 .7 1Z"/>',
		'hourglass-3'      => '<path d="M1 0H.7a.2986.2986 0 0 0-.2.0765A.2986.2986 0 0 0 .3 0H0v.3c0 .0768.0289.1469.0765.2A.2986.2986 0 0 0 0 .7V1h.3A.2986.2986 0 0 0 .5.9235.2986.2986 0 0 0 .7 1H1V.7A.2986.2986 0 0 0 .9235.5.2986.2986 0 0 0 1 .3V0z"/>',
		'cut-corners'      => '<path d="M.076 0 0 .076v.848L.076 1h.848L1 .924V.076L.924 0H.076z"/>',
	);

	return apply_filters( 'twentig_shapes', $shapes );
}

/**
 * Enqueues the shape to print the SVG.
 * 
 *  @param string $shape The selected shape.
 */
function twentig_enqueue_shape_svg( $shape ) {
	
	global $tw_shapes;

	if ( ! isset( $tw_shapes ) ) {
		$tw_shapes = array();
	}

	if ( ! in_array( $shape, $tw_shapes, true ) ) {
		$tw_shapes[] = $shape;		
		twentig_render_shape_svg( $shape ); 
	}
}

/**
 * Prints all the shape SVG at the beginning of the body on block editor pages.
 */
function twentig_editor_print_shapes_svg() {

	if ( ! get_current_screen()->is_block_editor() ) {
		return;
	}

	$shapes = twentig_get_shapes();
	foreach( $shapes as $shape => $path ) {
		twentig_render_shape_svg( $shape );
	}
}
add_action( 'in_admin_header' , 'twentig_editor_print_shapes_svg' );

/**
 * Prints the shape's SVG.
 *  
 * @param string $shape The selected shape.
 */
function twentig_render_shape_svg( $shape ) {

	$shapes = twentig_get_shapes();

	$path = isset( $shapes[ $shape ] ) ? $shapes[ $shape ] : '';

	if ( $path ) {
		echo '
		<svg  
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 0 0"
			width="0"
			height="0"
			focusable="false"
			role="none"
			style="position:absolute;left:-9999px;overflow:hidden;"
		><defs><clipPath id="tw-shape-' . esc_attr( $shape )  .'" clipPathUnits="objectBoundingBox">' . $path . '</clipPath></defs></svg>';
	}
}

/**
 * Filters the site logo block output.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_filter_site_logo_block( $block_content, $block ) {
	
	if ( ! empty( $block['attrs'] ) && isset( $block['attrs']['twWidthMobile'] ) ) {

		$class         = wp_unique_id( 'tw-logo-' );
		$block_content = preg_replace(
			'/' . preg_quote( 'class="', '/' ) . '/',
			'class="' . $class . ' ',
			$block_content,
			1
		);

		$style = '@media(max-width:767px){.wp-block-site-logo.' . $class . ' img{width: ' . esc_attr( $block['attrs']['twWidthMobile'] ) . 'px;height:auto;}}';
		add_action(
			'wp_head',
			static function () use ( $style ) {
				echo "<style>$style</style>";
			}
		);
	}
	return $block_content;
}
add_filter( 'render_block_core/site-logo', 'twentig_filter_site_logo_block', 10, 2 );

/**
 * Filters the gallery block output.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_filter_gallery_block( $block_content, $block ) {
	$attributes = isset( $block['attrs'] ) ? $block['attrs'] : [];
	$gap        = _wp_array_get( $attributes, array( 'style','spacing', 'blockGap' ), null );
	$gap        = is_array( $gap ) ? _wp_array_get( $attributes, array( 'style', 'spacing', 'blockGap', 'left' ), null ) : $gap;

	if ( $gap && false !== strpos( $gap, 'px' ) ) {
		$gap_value = intval( $gap );
		$class     = '';

		if ( $gap_value > 32 ) {
			$class = 'tw-large-gap';
		} elseif ( $gap_value > 20 ) {
			$class = 'tw-medium-gap';
		}
		if ( $class ) {
			$block_content = preg_replace(
				'/' . preg_quote( 'class="', '/' ) . '/',
				'class="' . $class . ' ',
				$block_content,
				1
			);
		}
	}
	return $block_content;
}
add_filter( 'render_block_core/gallery', 'twentig_filter_gallery_block', 10, 2 );

/**
 * Filters the separator block output.
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block         The full block, including name and attributes.
 */
function twentig_filter_separator_block( $block_content, $block ) {
	$attributes = isset( $block['attrs'] ) ? $block['attrs'] : [];

	if ( isset( $attributes['className'] )
		&& 
		( false !== strpos( $attributes['className'], 'is-style-dots' ) || false !== strpos( $attributes['className'], 'is-style-tw-asterisks' ) )
	) {
		return $block_content;
	}
	
	$style = '';
	$class = '';

	/* fix custom gradient */
	$gradient = _wp_array_get( $attributes, array( 'style', 'color', 'gradient' ), null );
	if ( $gradient && false === strpos( $block_content , 'linear-gradient(' )  ) {
		$style .= 'background:' . $gradient . ';';
	}

	if ( isset( $attributes['twWidth'] ) && $attributes['twWidth'] ) {
		$style .= 'width:' . esc_attr( $attributes['twWidth'] ) . ';max-width:100%;';
	}
	if ( isset( $attributes['twHeight'] ) && $attributes['twHeight'] ) {
		$style .= 'height:' . esc_attr( $attributes['twHeight'] ) . ';';
		if ( isset( $attributes['twWidth'] ) && $attributes['twWidth'] && intval( $attributes['twHeight'] ) > intval( $attributes['twWidth'] ) ) {
			$class .= 'is-vertical';
		}
	}

	if ( $class ) {
		$block_content = preg_replace(
			'/' . preg_quote( 'class="', '/' ) . '/',
			'class="' . $class . ' ',
			$block_content,
			1
		);
	}
	
	if ( $style ) {
		if ( false !== strpos( $block_content, 'style="' ) ) {
			$block_content = preg_replace(
				'/' . preg_quote( 'style="', '/' ) . '/',
				'style="' . $style,
				$block_content,
				1
			);
		} else {
			$block_content = preg_replace(
				'/' . preg_quote( 'class="', '/' ) . '/',
				'style="' . $style . '" class="',
				$block_content,
				1
			);
		}
	}

	return $block_content;
}
add_filter( 'render_block_core/separator', 'twentig_filter_separator_block', 10, 2 );
