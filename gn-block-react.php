<?php
/**
 * Plugin Name:       GN - Block React
 * Description:       Custom blocks for the project.
 * Version:           2.2.2
 * Requires at least: 6.7
 * Requires PHP:      8.0
 * Author:            Grégoire Noyelle
 * Author URI:        https://www.gregoire-noyelle.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gn-block-react
 *
 * @package GnBlockReact
 * @author  Gregoire Noyelle
 * @license GPL-2.0-or-later
 * @link    https://www.gregoirenoyelle.com/
 */

namespace GN\BlockReact;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GNBLOCK_DIR', plugin_dir_path( __FILE__ ) );
define( 'GNBLOCK_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load plugin textdomain for translations.
 *
 * @since 2.0.0
 * @return void
 */
function load_textdomain(): void {
	\load_plugin_textdomain(
		'gn-block-react',
		false,
		\dirname( \plugin_basename( __FILE__ ) ) . '/languages'
	);
}

// Hooks
\add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_textdomain' );

// Include plugin core files.
require_once GNBLOCK_DIR . 'inc/assets/enqueue.php';
require_once GNBLOCK_DIR . 'inc/blocks/categories-blocks.php';
require_once GNBLOCK_DIR . 'inc/admin/options-page.php';
require_once GNBLOCK_DIR . 'inc/blocks/blocks-manager.php';
require_once GNBLOCK_DIR . 'inc/admin/plugin-activation.php';

// Include special features based on enabled blocks.
if ( \get_option( 'gn2025_enable_block_image_video', true ) ) {
	require_once GNBLOCK_DIR . 'inc/features/video-embed.php';
}

if ( \get_option( 'gn2025_enable_block_sommaire_auto', true ) ) {
	require_once GNBLOCK_DIR . 'inc/features/ancres-auto.php';
}