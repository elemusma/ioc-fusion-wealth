<?php

/**
 * Gets Twentig custom font settings.
 */
function twentig_get_custom_font_settings() {
	$typography   = get_option( 'twentig_typography' );
	$font1        = isset( $typography['font1'] ) && $typography['font1'] ? $typography['font1'] : '';
	$font1_styles = isset( $typography['font1_styles'] ) && $typography['font1_styles'] ? $typography['font1_styles'] : [];
	$font2        = isset( $typography['font2'] ) && $typography['font2'] ? $typography['font2'] : '';
	$font2_styles = isset( $typography['font2_styles'] ) && $typography['font2_styles'] ? $typography['font2_styles'] : [];
	
	return array( $font1, $font2, $font1_styles, $font2_styles );
}

/**
 * Gets custom font CSS variables.
 */
function twentig_get_custom_font_css_variables() {
	$css = '';

	list( $font1, $font2 ) = twentig_get_custom_font_settings();

	if ( $font1 ) {
		$css .= '--tw-font-1:' . $font1 . ';';
	}	
	if ( $font2 ) {
		$css .= '--tw-font-2:' . $font2 . ';';
	}
	if ( $css ) {
		$css = 'body{' . $css . '}';
	}
	return $css;
}

/**
 * Get Twentig additional fonts.
 */
function twentig_get_additional_fonts() {

	$fonts = [];

	list( $font1, $font2, $font1_styles, $font2_styles ) = twentig_get_custom_font_settings();

	if ( $font1 ) {
		$font_name = twentig_get_font_name( $font1 );
		$fonts[] = array(
			'fontFamily' => 'var(--tw-font-1)',
			'slug'       => 'tw-font-1',
			'name'       => esc_html__( 'Font 1', 'twentig' ) . ': ' . $font_name,
			'src'        => twentig_build_google_font_url_part( $font_name, $font1_styles ),
			'provider'   => 'google',
		);
	}

	if ( $font2 ) {
		$font_name = twentig_get_font_name( $font2 );
		$fonts[] = array(
			'fontFamily' => 'var(--tw-font-2)',
			'slug'       => 'tw-font-2',
			'name'       => esc_html__( 'Font 2', 'twentig' ) . ': '. $font_name,
			'src'        => twentig_build_google_font_url_part( $font_name, $font2_styles ),
			'provider'   => 'google',
		);
	}

	$curated_fonts = array(
		array(
			'fontFamily' => "\"Alegreya\", serif",
			"slug"       => "alegreya",
			"name"       => "Alegreya",
			'src'        => "Alegreya:ital,wght@0,400..900;1,400..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Cabin\", sans-serif",
			"slug"       => "cabin",
			"name"       => "Cabin",
			'src'        => "Cabin:ital,wght@0,400..700;1,400..700",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Crimson Pro\", serif",
			"slug"       => "crimson-pro",
			"name"       => "Crimson Pro",
			'src'        => "Crimson+Pro:ital,wght@0,200..900;1,200..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"EB Garamond\", serif",
			"slug"       => "eb-garamond",
			"name"       => "EB Garamond",
			'src'        => "EB+Garamond:ital,wght@0,400..800;1,400..800",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Inter\", sans-serif",
			"slug"       => "inter",
			"name"       => "Inter",
			'src'        => "Inter:wght@100..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Libre Franklin\", sans-serif",
			"slug"       => "libre-franklin",
			"name"       => "Libre Franklin",
			'src'        => "Libre+Franklin:ital,wght@0,100..900;1,100..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Lora\", serif",
			"slug"       => "lora",
			"name"       => "Lora",
			'src'        => "Lora:ital,wght@0,400..700;1,400..700",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Open Sans\", sans-serif",
			"slug"       => "open-sans",
			"name"       => "Open Sans",
			'src'        => "Open+Sans:ital,wght@0,300..800;1,300..800",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Playfair Display\", serif",
			"slug"       => "playfair-display",
			"name"       => "Playfair Display",
			'src'        => "Playfair+Display:ital,wght@0,400..900;1,400..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Raleway\", sans-serif",
			"slug"       => "raleway",
			"name"       => "Raleway",
			'src'        => "Raleway:ital,wght@0,100..900;1,100..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Roboto Flex\", sans-serif",
			"slug"       => "roboto-flex",
			"name"       => "Roboto Flex",
			'src'        => "Roboto+Flex:wght@100..900",
			'provider'   => 'google',
		),				
		array(
			'fontFamily' => "\"Roboto Mono\", monospace",
			"slug"       => "roboto-mono",
			"name"       => "Roboto Mono",
			'src'        => "Roboto+Mono:ital,wght@0,100..700;1,100..700",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Roboto Serif\", serif",
			"slug"       => "roboto-serif",
			"name"       => "Roboto Serif",
			'src'        => "Roboto+Serif:ital,wght@0,100..900;1,100..900",
			'provider'   => 'google',
		),	
		array(
			'fontFamily' => "\"Roboto Slab\", serif",
			"slug"       => "roboto-slab",
			"name"       => "Roboto Slab",
			'src'        => "Roboto+Slab:wght@100..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Rubik\", sans-serif",
			"slug"       => "rubik",
			"name"       => "Rubik",
			'src'        => "Rubik:ital,wght@0,300..900;1,300..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Source Sans 3\", sans-serif",
			"slug"       => "source-sans-3",
			"name"       => "Source Sans 3",
			'src'        => "Source+Sans+3:ital,wght@0,200..900;1,200..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Source Serif 4\", serif",
			"slug"       => "source-serif-4",
			"name"       => "Source Serif 4",
			'src'        => "Source+Serif+4:ital,wght@0,200..900;1,200..900",
			'provider'   => 'google',
		),
		array(
			'fontFamily' => "\"Work Sans\", sans-serif",
			"slug"       => "work-sans",
			"name"       => "Work Sans",
			'src'        => "Work+Sans:ital,wght@0,100..900;1,100..900",
			'provider'   => 'google',
		),
	);

	$curated_fonts = apply_filters( 'twentig_curated_google_fonts', $curated_fonts );	
	$fonts         = array_merge( $fonts, $curated_fonts );

	return $fonts;
}

/**
 * Gets the font name of a given font stack.
 *
 * @param string  $font_stack The font stack.
 */
function twentig_get_font_name( $font_stack ) {
	$font_name = explode ( ',',  $font_stack )[0];
	$font_name = str_replace( "'", '', $font_name );
	return $font_name;
}

/**
 * Builds the URL part for the Google Font.
 * 
 *  @param string  $font_family The font family.
 *  @param array   $weights     The weights to load.
 */
function twentig_build_google_font_url_part( $font_family, $weights = [] ) {
	$normal_weights = array();
	$italic_weights = array();

	foreach ( $weights as $index => $weight ) {
		if ( false !== strpos( $weight, 'italic' ) ) {
			$italic_weights[] = str_replace( 'italic', '', $weight );
		} else {
			$normal_weights[] = $weight;
		}
	}

	// Remove duplicates.
	$normal_weights = array_unique( $normal_weights );
	$italic_weights = array_unique( $italic_weights );

	// Tuples must be sorted
	sort( $normal_weights );
	sort( $italic_weights );

	// Build the font-style with its font-weights.
	$url_part = urlencode( $font_family );
	if ( empty( $italic_weights ) && ! empty( $normal_weights ) ) {
		$url_part .= ':wght@' . implode( ';', $normal_weights );
	} elseif ( ! empty( $italic_weights ) && empty( $normal_weights ) ) {
		$url_part .= ':ital,wght@1,' . implode( ';', $normal_weights );
	} elseif ( ! empty( $italic_weights ) && ! empty( $normal_weights ) ) {
		$url_part .= ':ital,wght@0,' . implode( ';0,', $normal_weights ) . ';1,' . implode( ';1,', $italic_weights );
	}

	return $url_part;
}

/**
 * Merges our additional fonts with the theme fonts and make sure the values are unique.
 *
 * @param array $theme_fonts The theme fonts.
 * @return array             The merged fonts.
 */
function twentig_merge_fonts_to_theme_fonts( $theme_fonts = array() ) {
	$new_fonts = twentig_get_additional_fonts();	
	foreach( $new_fonts as $font ) {
		if ( in_array( $font['fontFamily'], array_column( $theme_fonts, 'fontFamily' ) ) ) {
			continue;
		}
		$theme_fonts[] = $font;
	}
	return $theme_fonts;	
}

/**
 * Gets cached CSS from a remote URL.
 *
 * @param string $url  The remote URL.
 *
 * @return string The CSS.
*/
function twentig_get_cached_remote_font_styles( $url ) {

	$cache_key = 'twentig_google_fonts_' . md5( $url );
	$css       = get_site_transient( $cache_key );
	
	if ( false === $css ) {
		
		// Use a modern user-agent to get woff2 files.
		$user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36';
		
		// Gets styles from the remote font URL.
		$response = wp_safe_remote_get( $url, array( 'user-agent' => $user_agent ) );
		
		if ( is_wp_error( $response ) || false === strpos( wp_remote_retrieve_header( $response, 'content-type' ), 'text/css' ) ) {
			$css = '';
		} else {
			$contents = wp_remote_retrieve_body( $response );
			$css = twentig_minify_css( $contents );			
		}

		// Cache the CSS.
		if ( empty( $css ) ) {
			set_site_transient( $cache_key, '', MINUTE_IN_SECONDS );
			return '';
		}
		set_site_transient( $cache_key, $css, MONTH_IN_SECONDS );
	}
	return $css;
}

/**
 * Adds preconnect for Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 */
function twentig_google_fonts_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentig-google-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'twentig_google_fonts_resource_hints', 10, 2 );

/**
 * Migrates Twentig Heading font family global style to core Heading block.
 */
function twentig_migrate_global_styles() {

	$tw_heading_option = get_option( 'twentig_heading_font' );

	if ( $tw_heading_option ) {

		$heading_block_font = wp_get_global_styles(
			array( 'typography' ),
			array( 'block_name' => 'core/heading' )
		);

		if ( ! isset( $heading_block_font['fontFamily'] ) ) {

			$fonts             = twentig_get_additional_fonts();
			$heading_font_slug = $tw_heading_option;

			foreach( $fonts as $font ) {
				$family_slug = sanitize_title( $font['slug'] );
				$family      = $font['fontFamily'];			
				if ( false !== strpos( $tw_heading_option, $family ) ) {
					$heading_font_slug = $family_slug;
				}
			}

			$user_data = WP_Theme_JSON_Resolver::get_user_data()->get_raw_data();
			$new_styles = array();

			if ( array_key_exists( 'styles', $user_data ) ) {
				$new_styles = $user_data['styles'];
			}

			if ( empty( $new_styles['blocks'] ) ) {
				$new_styles['blocks'] = array();
			}
		
			if ( empty( $new_styles['blocks']['core/heading'] ) ) {
				$new_styles['blocks']['core/heading'] = array();
			}
		
			if ( empty( $new_styles['blocks']['core/heading']['typography'] ) ) {
				$new_styles['blocks']['core/heading']['typography'] = array();
			}
		
			$new_styles['blocks']['core/heading']['typography']['fontFamily'] = "var:preset|font-family|$heading_font_slug";	

			$user_cpt_id              = WP_Theme_JSON_Resolver::get_user_global_styles_post_id();
			$global_styles_controller = new WP_REST_Global_Styles_Controller();
			
			$update_request = new WP_REST_Request( 'PUT', '/wp/v2/global-styles/' );
			$update_request->set_param( 'id', $user_cpt_id );
			$update_request->set_param( 'styles', $new_styles );
			$global_styles_controller->update_item( $update_request );
			
			delete_transient( 'global_styles' );
			delete_transient( 'global_styles_' . get_stylesheet() );
		}	

		delete_option( 'twentig_heading_font' );
	}
}
add_action( 'init', 'twentig_migrate_global_styles' );
