<?php
/**
 * Plugin activation and deactivation hooks.
 *
 * @package GnBlockReact
 * @author  Gregoire Noyelle
 * @license GPL-2.0-or-later
 * @link    https://www.gregoirenoyelle.com/
 */

namespace GN\BlockReact\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin activation hook to initialize default options.
 *
 * @since 2.0.0
 * @return void
 */
function plugin_activation(): void {
	activate_plugin();
}

/**
 * Plugin deactivation hook.
 *
 * @since 2.0.0
 * @return void
 */
function plugin_deactivation(): void {
	// Nothing to do for now.
}

// Hooks
\register_activation_hook( GNBLOCK_DIR . 'gn-block-react.php', __NAMESPACE__ . '\\plugin_activation' );
