<?php
/**
 * Blocks registration manager.
 *
 * @package GnBlockReact
 * @author  Gregoire Noyelle
 * @license GPL-2.0-or-later
 * @link    https://www.gregoirenoyelle.com/
 */

namespace GN\BlockReact\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the block using a `blocks-manifest.php` file, which improves the performance of block type registration.
 * Behind the scenes, it also registers all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @since 2.0.0
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 * @return void
 */
function block_init(): void {
	$available_blocks = \GN\BlockReact\Admin\get_available_blocks();

	$enabled_blocks = array();
	foreach ( $available_blocks as $block_folder => $block_title ) {
		$option_name = 'gn2025_enable_block_' . \str_replace( '-', '_', $block_folder );
		if ( \get_option( $option_name, true ) ) {
			$enabled_blocks[] = $block_folder;
		}
	}

	if ( empty( $enabled_blocks ) ) {
		return;
	}

	/**
	 * WordPress 6.8+: Optimized registration with collection.
	 *
	 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
	 */
	if ( \function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		$manifest_data = require GNBLOCK_DIR . 'build/blocks-manifest.php';

		foreach ( \array_keys( $manifest_data ) as $block_type ) {
			$block_folder = \basename( $block_type );
			if ( \in_array( $block_folder, $enabled_blocks, true ) ) {
				\register_block_type( GNBLOCK_DIR . "build/{$block_type}" );
			}
		}
		return;
	}

	/**
	 * WordPress 6.7: Registration with metadata.
	 *
	 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
	 */
	if ( \function_exists( 'wp_register_block_metadata_collection' ) ) {
		\wp_register_block_metadata_collection( GNBLOCK_DIR . 'build', GNBLOCK_DIR . 'build/blocks-manifest.php' );
	}

	/**
	 * Fallback: Classic registration for enabled blocks only.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	foreach ( $enabled_blocks as $block_folder ) {
		$block_path = GNBLOCK_DIR . "build/{$block_folder}";
		if ( \file_exists( $block_path . '/block.json' ) ) {
			\register_block_type( $block_path );
		}
	}
}

// Hooks
\add_action( 'init', __NAMESPACE__ . '\\block_init' );
