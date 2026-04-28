<?php
/**
 * Enqueue for admin and front-end.
 *
 * @package GnBlockReact
 * @author  Gregoire Noyelle
 * @license GPL-2.0-or-later
 * @link    https://www.gregoirenoyelle.com/
 */

namespace GN\BlockReact\Assets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register and enqueue CSS and JS assets for custom blocks in admin and front-end.
 *
 * @since 2.0.0
 * @return void
 */
function enqueue_assets(): void {
	$plugin_url = GNBLOCK_URL;

	// Icon font.
	\wp_enqueue_style(
		'gn-block-react-font',
		$plugin_url . 'assets/css/font.css',
		array(),
		\filemtime( GNBLOCK_DIR . 'assets/css/font.css' )
	);

	// Back to top block.
	// Note: has_block() does not work in templates.
	if ( ! \is_admin() ) {
		\wp_enqueue_script(
			'gn-block-react-retour-haut-js',
			$plugin_url . 'assets/js/back-to-top.js',
			array(),
			\filemtime( GNBLOCK_DIR . 'assets/js/back-to-top.js' ),
			true
		);
	}

	// Scroll progress block.
	// Note: has_block() does not work in templates.
	if ( ! \is_admin() ) {
		\wp_enqueue_script(
			'gn-block-react-progression-scroll-js',
			$plugin_url . 'assets/js/progression-scroll.js',
			array(),
			\filemtime( GNBLOCK_DIR . 'assets/js/progression-scroll.js' ),
			true
		);
	}

	// Icon block and share buttons.
	\wp_enqueue_style(
		'gn-block-react-icone-css',
		$plugin_url . 'assets/css/icone.css',
		array(),
		\filemtime( GNBLOCK_DIR . 'assets/css/icone.css' )
	);

	// Share buttons block - loaded on all singles except pages.
	if ( ! \is_admin() && \is_singular() && ! \is_page() ) {
		\wp_enqueue_script(
			'gn-block-react-boutons-partages-js',
			$plugin_url . 'assets/js/boutons-partages.js',
			array(),
			\filemtime( GNBLOCK_DIR . 'assets/js/boutons-partages.js' ),
			true
		);
	}

	// Image-video block.
	if ( ! \is_admin() && \has_block( 'gn2025/image-video' ) ) {
		\wp_enqueue_script(
			'gn-block-react-image-video-js',
			$plugin_url . 'assets/js/image-video.js',
			array(),
			\filemtime( GNBLOCK_DIR . 'assets/js/image-video.js' ),
			true
		);
	}

	// Slider block.
	if ( ! \is_admin() && \has_block( 'gn2025/slider' ) ) {
		\wp_enqueue_style(
			'gn-block-react-swiper-css',
			$plugin_url . 'assets/css/swiper.css',
			array(),
			\filemtime( GNBLOCK_DIR . 'assets/css/swiper.css' )
		);

		\wp_enqueue_style(
			'gn-block-react-swiper-css-custom',
			$plugin_url . 'assets/css/swiper-custom.css',
			array(),
			\filemtime( GNBLOCK_DIR . 'assets/css/swiper-custom.css' )
		);

		\wp_enqueue_script(
			'gn-block-react-swiper-js',
			$plugin_url . 'assets/js/swiper.js',
			array(),
			\filemtime( GNBLOCK_DIR . 'assets/js/swiper.js' ),
			true
		);
	}

	// Slider-image block.
	if ( ! \is_admin() && \has_block( 'gn2025/slider-image' ) ) {
		\wp_enqueue_script(
			'gn-block-react-swiffyslider-js',
			$plugin_url . 'assets/js/swiffyslider.js',
			array(),
			\filemtime( GNBLOCK_DIR . 'assets/js/swiffyslider.js' ),
			true
		);
	}

	// Animated counter block.
	if ( ! \is_admin() && \has_block( 'gn2025/compteur-anime' ) ) {
		\wp_enqueue_script(
			'gn-block-react-compteur-anime-js',
			$plugin_url . 'assets/js/compteur-anime.js',
			array(),
			\filemtime( GNBLOCK_DIR . 'assets/js/compteur-anime.js' ),
			true
		);
	}
}

/**
 * Enqueue admin styles for block editor.
 *
 * @since 2.0.0
 * @return void
 */
function enqueue_admin_assets(): void {
	\wp_enqueue_style(
		'gn-block-react-admin-block',
		GNBLOCK_URL . 'assets/css/admin-block.css',
		array(),
		\filemtime( GNBLOCK_DIR . 'assets/css/admin-block.css' )
	);
}

/**
 * Add defer attribute to JS scripts.
 *
 * @since 2.0.0
 * @param string $tag    Script HTML tag.
 * @param string $handle Script handle.
 * @param string $src    Script source URL.
 * @return string Modified script tag.
 */
function defer_scripts( string $tag, string $handle, string $src ): string {
	$scripts_to_defer = array(
		'gn-block-react-swiper-js',
		'gn-block-react-swiffyslider-js',
		'gn-block-react-retour-haut-js',
		'gn-block-react-boutons-partages-js',
		'gn-block-react-image-video-js',
		'gn-block-react-compteur-anime-js',
		'gn-block-react-progression-scroll-js',
	);

	if ( \in_array( $handle, $scripts_to_defer, true ) ) {
		return \sprintf(
			'<script src="%s" defer></script>' . "\n",
			\esc_url( $src )
		);
	}

	return $tag;
}

/**
 * Set script translations for Gutenberg blocks.
 * Loads JSON translation files for JavaScript in the block editor.
 *
 * @since 2.0.0
 * @return void
 */
function set_script_translations(): void {
	if ( ! \is_admin() ) {
		return;
	}

	$registered_blocks = \WP_Block_Type_Registry::get_instance()->get_all_registered();

	foreach ( $registered_blocks as $block_name => $block_type ) {
		if ( \strpos( $block_name, 'gn2025/' ) !== 0 ) {
			continue;
		}

		if ( ! empty( $block_type->editor_script ) ) {
			\wp_set_script_translations(
				$block_type->editor_script,
				'gn-block-react',
				GNBLOCK_DIR . 'languages'
			);
		}

		if ( ! empty( $block_type->script ) ) {
			\wp_set_script_translations(
				$block_type->script,
				'gn-block-react',
				GNBLOCK_DIR . 'languages'
			);
		}

		if ( ! empty( $block_type->view_script ) ) {
			\wp_set_script_translations(
				$block_type->view_script,
				'gn-block-react',
				GNBLOCK_DIR . 'languages'
			);
		}
	}
}

// Hooks
\add_action( 'enqueue_block_assets', __NAMESPACE__ . '\\enqueue_assets' );
\add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\enqueue_admin_assets' );
\add_filter( 'script_loader_tag', __NAMESPACE__ . '\\defer_scripts', 10, 3 );
\add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\set_script_translations', 999 );
