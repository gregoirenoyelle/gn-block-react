<?php
/**
 * Cleanup on plugin uninstall.
 *
 * @package GnBlockReact
 * @author  Gregoire Noyelle
 * @license GPL-2.0-or-later
 * @link    https://www.gregoirenoyelle.com/
 */

namespace GN\BlockReact;

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete all plugin options if cleanup option is enabled.
 *
 * @since 2.0.0
 * @return void
 */
function cleanup_on_uninstall(): void {
	if ( ! \get_option( 'gn2025_remove_data_on_uninstall', false ) ) {
		return;
	}

	$available_blocks = array(
		'boutons-partages' => 'Share Buttons',
		'image-icone'      => 'Icon Image',
		'image-video'      => 'Image Video',
		'retour-haut'      => 'Back to Top',
		'slider'           => 'Swiper Slider',
		'slider-image'     => 'Image Slider',
		'temps-lecture'    => 'Reading Time',
		'title-archive'    => 'Archive Title',
	);

	foreach ( $available_blocks as $block_folder => $block_title ) {
		$option_name = 'gn2025_enable_block_' . \str_replace( '-', '_', $block_folder );
		\delete_option( $option_name );
	}

	\delete_option( 'gn2025_remove_data_on_uninstall' );
}

cleanup_on_uninstall();
