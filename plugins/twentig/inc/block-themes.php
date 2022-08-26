<?php
/**
 * Additional functionalities for block themes.
 *
 * @package twentig
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require TWENTIG_PATH . 'inc/custom-fonts.php';

/**
 * Enqueue styles for block themes: spacing, layout, fonts.
 */
function twentig_block_theme_enqueue_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Match styles from wp_get_layout_style().
	$block_gap             = wp_get_global_settings( array( 'spacing', 'blockGap' ) );
	$has_block_gap_support = isset( $block_gap ) ? null !== $block_gap : false;

	$layout_styles = '
	.layout-default > :where(:not(.alignleft):not(.alignright)) { max-width: var(--layout--content-size); margin-left: auto !important; margin-right: auto !important; }		
	.layout-default > .alignwide { max-width: var(--layout--wide-size); }
	.layout-default .alignfull { max-width: none; }
	.layout-default .alignleft { float: left; margin-inline-start: 0; margin-inline-end: 2em; }
	.layout-default .alignright { float: right; margin-inline-start: 2em; margin-inline-end: 0; }
	.layout-default .aligncenter { margin-left: auto !important; margin-right: auto !important; }';

	if ( $has_block_gap_support ) {
		$layout_styles .= '
		:where(.layout-default):not(.has-gap) > * { margin-block-start: 0; margin-block-end: 0; }
		:where(.layout-default):not(.has-gap) > * + * {	margin-block-start: var( --wp--style--block-gap ); margin-block-end: 0; }';
	}
	
	$default_layout = wp_get_global_settings( array( 'layout' ) );	
	$content_width  = get_option( 'twentig_content_size' );
	$wide_width     = get_option( 'twentig_wide_size' );
	$content_width  = $content_width ? $content_width : $default_layout['contentSize'];		
	$wide_width     = $wide_width ? $wide_width : $default_layout['wideSize'];
			
	$layout_styles .= 'body {';		
	if ( $content_width ) {
		$layout_styles .= '--layout--content-size:' . esc_html( $content_width ) . ';';
	}
	if ( $wide_width ) {
		$layout_styles .= '--layout--wide-size:' . esc_html( $wide_width ) . ';';
	}
	$layout_styles .= '}';
		
	wp_add_inline_style( 'global-styles', twentig_minify_css( $layout_styles ) );

	if ( get_option( 'twentig_global_spacing', twentig_default_global_spacing() ) ) {
		wp_enqueue_style(
			'twentig-global-spacing',
			TWENTIG_ASSETS_URI . "/blocks/tw-spacing{$min}.css",
			array(),
			TWENTIG_VERSION
		);
	}

	global $template_html;

	$merged_json        = WP_Theme_JSON_Resolver::get_merged_data()->get_raw_data();
	$theme_fonts        = $merged_json['settings']['typography']['fontFamilies']['theme'];
	$fonts              = twentig_get_additional_fonts();
	$stylesheet         = wp_get_global_stylesheet();
	$enqueue_fonts      = [];
	$font_vars          = '';
	$font_classes       = '';	
	$content_to_check   = $stylesheet . $template_html;

	wp_add_inline_style( 'global-styles', twentig_get_custom_font_css_variables() );

	foreach( $fonts as $font ) {	
		$family_slug = sanitize_title( $font['slug'] );
		$family      = $font['fontFamily'];
		if ( in_array( $family_slug, array_column( $theme_fonts, 'slug' ) ) ) {
			continue;
		}
		if ( false !== strpos( $content_to_check, 'var(--wp--preset--font-family--' . $family_slug . ')' ) ||
			 false !== strpos( $content_to_check, 'has-' . $family_slug . '-font-family' ) ) {
				$enqueue_fonts[] = $font['src'];
				$font_vars      .= "--wp--preset--font-family--{$family_slug}:{$family};";
				$font_classes   .= ".has-{$family_slug}-font-family{font-family:var(--wp--preset--font-family--{$family_slug})!important;}";	
		}
	}

	if ( ! empty( $enqueue_fonts ) ) {

		$typography = get_option( 'twentig_typography' );
		$local      = isset( $typography['local'] ) ? $typography['local'] : true;
		$remote_url = 'https://fonts.googleapis.com/css2?family=' . implode( '&family=', array_unique( array_values( $enqueue_fonts ) ) ) . '&display=swap';

		if ( $local ) {
			require_once TWENTIG_PATH . 'inc/wptt-webfont-loader.php';
			
			// Enqueue the stylesheet.
			wp_register_style( 'twentig-webfonts', '' );
			wp_enqueue_style( 'twentig-webfonts' );

			// Add the styles to the stylesheet.
			wp_add_inline_style( 'twentig-webfonts', twentig_minify_css( wptt_get_webfont_styles( $remote_url ) ) );

		} else {
			wp_enqueue_style( // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
				'twentig-google-fonts',
				esc_url_raw( $remote_url ),
				array(),
				null
			);
		}

		wp_add_inline_style( 'global-styles', 'body{' . $font_vars . '}' . $font_classes );
	}

	if ( false !== strpos( $template_html, 'tw-bottom-shape' ) || false !== strpos( $template_html, 'tw-top-shape' ) ) {
		$styles_file = TWENTIG_PATH . "dist/blocks/group/shape.min.css";
		$styles = file_get_contents( $styles_file );
		wp_add_inline_style( "wp-block-group", $styles );
	}

	wp_add_inline_style( 'wp-block-navigation-link', twentig_generate_navigation_styles() );

}
add_action( 'wp_enqueue_scripts', 'twentig_block_theme_enqueue_scripts', 11 );

/**
 * Enqueue styles inside the editor.
 */
function twentig_block_theme_editor_styles() {
	
	if ( get_option( 'twentig_global_spacing', twentig_default_global_spacing() ) ) {
		if ( ! is_wp_version_compatible( '6.0' ) ) {
			add_editor_style( TWENTIG_ASSETS_URI . '/blocks/tw-spacing-editor-5-9.css' );
		} else {
			add_editor_style( TWENTIG_ASSETS_URI . '/blocks/tw-spacing-editor.css' );
		}
	}

	add_editor_style( TWENTIG_ASSETS_URI . '/blocks/editor.css' );
	$fse_blocks = [
		'post-template',
		'search',
		'tag-cloud',
		'post-terms',
		'post-navigation-link',
		'query-pagination',
		'separator'
	];

	foreach ( $fse_blocks as $block_name ) {
		$style_path = TWENTIG_PATH . "dist/blocks/$block_name/style.min.css";
		if ( file_exists( $style_path ) ) {
			add_editor_style( TWENTIG_ASSETS_URI . "/blocks/{$block_name}/style.min.css" );
		}
	}

	$fonts         = twentig_get_additional_fonts();
	$css           = '';
	$css_vars      = '';
	$enqueue_fonts = [];

	$css .= twentig_get_custom_font_css_variables();	

	foreach( $fonts as $font ) {
		$family          = $font['fontFamily'];
		$family_slug     = sanitize_title( $font['slug'] );		
		$css_vars       .= "--wp--preset--font-family--{$family_slug}:{$family};";
		$css            .= ".has-{$family_slug}-font-family{font-family:var(--wp--preset--font-family--{$family_slug})!important;}";
		$enqueue_fonts[] = $font['src'];
	}

	if ( ! empty( $enqueue_fonts ) ) {		
		$remote_url = 'https://fonts.googleapis.com/css2?family=' . implode( '&family=', array_unique( array_values( $enqueue_fonts ) ) ) . '&display=swap';
		$css .= twentig_get_cached_remote_font_styles( $remote_url );
	}

	wp_add_inline_style( 'wp-block-library', '.editor-styles-wrapper {' . $css_vars . '}' . $css );
	wp_add_inline_style( 'wp-block-library', twentig_generate_navigation_styles() );
}
add_action( 'admin_init', 'twentig_block_theme_editor_styles' );

/**
 * Returns CSS for navigation buttons.
 */
function twentig_generate_navigation_styles() {
	$button_styles = wp_get_global_styles(
		array(),
		array( 'block_name' => 'core/button' )
	); 	

	$button_colors = array(
		'background'       => array( 'color', 'gradient' ),
		'background-color' => array( 'color', 'background' ),
		'color'            => array( 'color', 'text' ),
	);

	$radius = _wp_array_get( $button_styles, array( 'border', 'radius' ), null );
	$radius = is_array( $radius ) ? _wp_array_get( $button_styles, array( 'border', 'radius', 'topLeft' ), null ) : $radius;
	$radius = $radius ? $radius : '0';

	$button_css = '
		.wp-block-navigation .wp-block-navigation-link:is(.is-style-tw-button-outline,.is-style-tw-button-fill) a {
			padding: 0.625rem max(1rem,0.75em) !important;
			text-decoration: none !important;
			opacity: 1;
			border: 2px solid currentColor;
			border-radius: ' . $radius . ';		
		}
		.wp-block-navigation-link.is-style-tw-button-outline a {
			color: currentColor !important;
		}
		.wp-block-navigation .wp-block-navigation-link.is-style-tw-button-fill a {
			border-color: transparent;';

		foreach ( $button_colors as $css_property => $value_path ) {
			$value = _wp_array_get( $button_styles, $value_path, '' );

			if ( '' !== $value && ! is_array( $value ) ) {
				$prefix     = 'var:';
				$prefix_len = strlen( $prefix );
				if ( 0 === strncmp( $value, $prefix, $prefix_len ) ) {
					$unwrapped_name = str_replace(
						'|',
						'--',
						substr( $value, $prefix_len )
					);
					$value          = "var(--wp--$unwrapped_name)";
				}
				$button_css .= $css_property . ':' . $value . ' !important;';
			}
		}

	$button_css .= '}';

	return twentig_minify_css( $button_css );
}

/**
 * Updates post editor settings to add fonts and width settings.
 *
 * @param array  $settings Default editor settings.
 *
 * @return array Filtered editor settings.
 */
function twentig_filter_global_styles_settings( $settings ) {	

	if ( isset( $settings['__experimentalFeatures'] ) ) {
		$default_layout = wp_get_global_settings( array( 'layout' ) );
		$content_width  = get_option( 'twentig_content_size' );
		$content_width  = $content_width ? $content_width : $default_layout['contentSize'];
		$wide_width     = get_option( 'twentig_wide_size' );
		$wide_width     = $wide_width ? $wide_width : $default_layout['wideSize'];

		$settings['__experimentalFeatures']['layout']['contentSize'] = $content_width;
		$settings['__experimentalFeatures']['layout']['wideSize'] = $wide_width;
	
		// Make sure the path to __experimentalFeatures.typography.fontFamilies.theme exists before updating fonts.
		if ( empty( $settings['__experimentalFeatures']['typography'] ) ) {
			$settings['__experimentalFeatures']['typography'] = array();
		}
		if ( empty( $settings['__experimentalFeatures']['typography']['fontFamilies'] ) ) {
			$settings['__experimentalFeatures']['typography']['fontFamilies'] = array();
		}
		if ( empty( $settings['__experimentalFeatures']['typography']['fontFamilies']['theme'] ) ) {
			$settings['__experimentalFeatures']['typography']['fontFamilies']['theme'] = array();
		}

		$fonts = $settings['__experimentalFeatures']['typography']['fontFamilies']['theme'];			
		$settings['__experimentalFeatures']['typography']['fontFamilies']['theme'] = twentig_merge_fonts_to_theme_fonts( $fonts );
	}

	return $settings;
}
add_filter( 'block_editor_settings_all', 'twentig_filter_global_styles_settings' );


/**
 * Updates the Global Styles controller route.
 *
 * @see WP_REST_Global_Styles_Controller.
 */
function twentig_register_global_styles_rest_route() {
	
	$controller = new WP_REST_Global_Styles_Controller();
	register_rest_route(
		'wp/v2',
		sprintf(
			'/%s/themes/(?P<stylesheet>%s)',
			'global-styles',
			'[^\/:<>\*\?"\|]+(?:\/[^\/:<>\*\?"\|]+)?'
		),
		array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => 'twentig_get_theme_item_global_styles',
				'permission_callback' => array( $controller, 'get_theme_item_permissions_check'),
				'args'                => array(
					'stylesheet' => array(
						'description'       => __( 'The theme identifier' ),
						'type'              => 'string',
						'sanitize_callback' => array( $controller, '_sanitize_global_styles_callback' ),
					),
				),
			),
		),
		true
	);
}
add_action( 'rest_api_init', 'twentig_register_global_styles_rest_route', 100 );

/**
 * Returns the given theme global styles config.
 * 
 * @param WP_REST_Request $request The request instance.
 * @return WP_REST_Response|WP_Error
*/
function twentig_get_theme_item_global_styles( $request ) {

	$controller = new WP_REST_Global_Styles_Controller();
	$response = $controller->get_theme_item( $request );

	if ( $response->data['settings'] ) {
		$settings       = $response->data['settings'];
		$default_layout = wp_get_global_settings( array( 'layout' ) );	
		$content_width  = get_option( 'twentig_content_size' );
		$content_width  = $content_width ? $content_width : $default_layout['contentSize'];
		$wide_width     = get_option( 'twentig_wide_size' );
		$wide_width     = $wide_width ? $wide_width : $default_layout['wideSize'];

		$settings['layout']['contentSize'] = $content_width;
		$settings['layout']['wideSize'] = $wide_width;

		// Make sure the path to settings.typography.fontFamilies.theme exists before updating fonts.
		if ( empty( $settings['typography'] ) ) {
			$settings['typography'] = array();
		}
		if ( empty( $settings['typography']['fontFamilies'] ) ) {
			$settings['typography']['fontFamilies'] = array();
		}
		if ( empty( $settings['typography']['fontFamilies']['theme'] ) ) {
			$settings['typography']['fontFamilies']['theme'] = array();
		}

		$fonts = $settings['typography']['fontFamilies']['theme'];		
		$settings['typography']['fontFamilies']['theme'] = twentig_merge_fonts_to_theme_fonts( $fonts );

		if ( 'twentytwentytwo' === wp_get_theme()->get_stylesheet() ) {
			$theme_sizes = $settings['typography']['fontSizes']['theme'];
			$settings['typography']['fontSizes']['theme'] = twentig_twentytwo_get_font_sizes( $theme_sizes );
		}

		$response->data['settings'] = $settings;
	}
	return $response;
}

/**
 * Renders the layout config to the block wrapper.
 * Overrides wp_render_layout_support_flag() core function to make the default layout work as a preset.
 *
 * @param  string $block_content Rendered block content.
 * @param  array  $block         Block object.
 * @return string                Filtered block content.
 */
function twentig_render_layout_support_flag( $block_content, $block ) {
	$block_type     = WP_Block_Type_Registry::get_instance()->get_registered( $block['blockName'] );
	$support_layout = block_has_support( $block_type, array( '__experimentalLayout' ), false );

	if ( ! $support_layout ) {
		return $block_content;
	}

	$block_gap             = wp_get_global_settings( array( 'spacing', 'blockGap' ) );
	$default_layout        = wp_get_global_settings( array( 'layout' ) );
	$has_block_gap_support = isset( $block_gap ) ? null !== $block_gap : false;
	$default_block_layout  = _wp_array_get( $block_type->supports, array( '__experimentalLayout', 'default' ), array() );
	$used_layout           = isset( $block['attrs']['layout'] ) ? $block['attrs']['layout'] : $default_block_layout;

	$class_names     = array();
	$container_class = wp_unique_id( 'wp-container-' );
	$class_names[]   = $container_class;

	if ( ! empty( $used_layout['type'] ) && 'flex' === $used_layout['type'] ) {
		$class_names[] = 'is-layout-flex';
	}

	if ( ! empty( $block['attrs']['layout']['orientation'] ) ) {
		$class_names[] = 'is-' . sanitize_title( $block['attrs']['layout']['orientation'] );
	}

	if ( ! empty( $block['attrs']['layout']['justifyContent'] ) ) {
		$class_names[] = 'is-content-justification-' . sanitize_title( $block['attrs']['layout']['justifyContent'] );
	}

	if ( ! empty( $block['attrs']['layout']['flexWrap'] ) && 'nowrap' === $block['attrs']['layout']['flexWrap'] ) {
		$class_names[] = 'is-nowrap';
	}

	$gap_value = _wp_array_get( $block, array( 'attrs', 'style', 'spacing', 'blockGap' ) );

	if ( is_array( $gap_value ) ) {
		foreach ( $gap_value as $key => $value ) {
			$gap_value[ $key ] = $value && preg_match( '%[\\\(&=}]|/\*%', $value ) ? null : $value;
		}
	} else {
		$gap_value = $gap_value && preg_match( '%[\\\(&=}]|/\*%', $gap_value ) ? null : $gap_value;
	}

	$fallback_gap_value = _wp_array_get( $block_type->supports, array( 'spacing', 'blockGap', '__experimentalDefault' ), '0.5em' );

	if ( isset( $used_layout['inherit'] ) && $used_layout['inherit'] ) {
		if ( ! $default_layout ) {
			return $block_content;
		}

		$used_layout = array( 
			'contentSize' => '',
			'wideSize'    => ''
		);

		$class_names[] = 'layout-default';

		$block_content = preg_replace(
			'/' . preg_quote( 'class="', '/' ) . '/',
			'class="' . esc_attr( implode( ' ', $class_names ) ) . ' ',
			$block_content,
			1
		);

		if ( ! $gap_value ) {
			return $block_content;
		}
	}
	
	$style = '';

	if ( function_exists( 'wp_should_skip_block_supports_serialization') ) {
		$should_skip_gap_serialization = wp_should_skip_block_supports_serialization( $block_type, 'spacing', 'blockGap' );
		$style                         = wp_get_layout_style( ".$container_class", $used_layout, $has_block_gap_support, $gap_value, $should_skip_gap_serialization, $fallback_gap_value );
	} else {
		$style = wp_get_layout_style( ".$container_class", $used_layout, $has_block_gap_support, $gap_value );	
	}

	if ( $gap_value && in_array( $block['blockName'], [ 'core/group', 'core/columns', 'core/column' ], true ) ) {
		$class_names[] = 'has-gap';
	}

	$content = preg_replace(
		'/' . preg_quote( 'class="', '/' ) . '/',
		'class="' . esc_attr( implode( ' ', $class_names ) ) . ' ',
		$block_content,
		1
	);

	add_action(
		'wp_head',
		static function () use ( $style ) {
			echo "<style>$style</style>";
		}
	);
		
	return $content;
}
remove_filter( 'render_block', 'wp_render_layout_support_flag' );
add_filter( 'render_block', 'twentig_render_layout_support_flag', 10, 2 );

/**
 * Registers additional global editor settings.
 */
function twentig_register_site_editor_settings() {
	
	$default_layout = wp_get_global_settings( array( 'layout' ) );	

	register_setting(
		'twentig_content_size',
		'twentig_content_size',
		array(
			'type'              => 'string',
			'show_in_rest'      => true,
			'default'           => isset( $default_layout['contentSize'] ) ? $default_layout['contentSize'] : '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	register_setting(
		'twentig_wide_size',
		'twentig_wide_size',
		array(
			'type'              => 'string',
			'show_in_rest'      => true,
			'default'           => isset( $default_layout['wideSize'] ) ? $default_layout['wideSize'] : '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	
	register_setting(
		'twentig_typography',
		'twentig_typography',
		array(
			'type'         => 'object',
			'show_in_rest' => array(
				'schema' => array(
					'type' => 'object',
					'properties' => array(
						'font1'        => array(
							'type' => 'string',
						),
						'font1_styles' => array(
							'type'  => 'array',
							'items' => array(
								'type' => 'string',
							)
						),
						'font2'        => array(
							'type' => 'string',
						),
						'font2_styles' => array(
							'type'  => 'array',
							'items' => array(
								'type' => 'string',
							)
						),
						'local'        => array(
							'type'    => 'boolean',
							'default' => true
						),
					)
				)
			),
			'default' => array( 'local' => true )
		)
	);

	register_setting(
		'twentig_global_spacing',
		'twentig_global_spacing',
		array(
			'type'              => 'boolean',
			'show_in_rest'      => true,
			'default'           => twentig_default_global_spacing(),
			'sanitize_callback' => 'rest_sanitize_boolean',
		)
	);

}
add_action( 'init', 'twentig_register_site_editor_settings' );

/**
 * Get default value for the Twentig global spacing setting.
 */
function twentig_default_global_spacing() {
	$theme = get_template();
	if ( 'twentytwentytwo' === $theme ) {
		return true;
	}
	return false;
}

/**
 * Remove line breaks and superfluous whitespace.
 *
 * @param string $css String containing CSS.
 */
function twentig_minify_css( $css ) {
	if ( ! defined( 'SCRIPT_DEBUG' ) || ! SCRIPT_DEBUG ) {

		// Remove breaks.
		$css = preg_replace( '/[\r\n\t ]+/', ' ', $css );

		// Remove whitespace around specific characters.
		$css = preg_replace( '/\s+([{};,!>\)])/', '$1', $css );
		$css = preg_replace( '/([{};,:>\(])\s+/', '$1', $css );

		// Remove semicolon followed by closing bracket.
		$css = str_replace( ';}', '}', $css );
	}
	return $css;
}
