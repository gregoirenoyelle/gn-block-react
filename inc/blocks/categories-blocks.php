<?php
/**
 * Add custom block categories.
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
 * Add custom block categories for GN blocks.
 *
 * @since 2.0.0
 * @param array<int, array<string, string>> $block_categories Existing block categories.
 * @return array<int, array<string, string>> Modified block categories with custom categories at the top.
 */
function block_categories( array $block_categories ): array {
	$custom_categories = array(
		array(
			'slug'  => 'gn-block-content',
			'title' => 'GN Bloc Contenu',
			'icon'  => 'layout',
		),
		array(
			'slug'  => 'gn-block-theme',
			'title' => 'GN Bloc Thème',
			'icon'  => 'admin-customizer',
		),
	);

	return \array_merge( $custom_categories, $block_categories );
}

// Hooks
\add_filter( 'block_categories_all', __NAMESPACE__ . '\\block_categories', 10, 1 );
