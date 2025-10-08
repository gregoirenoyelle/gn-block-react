<?php
/**
 * Options page for GN Blocs plugin.
 * Allows enabling/disabling each block individually.
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
 * List of available blocks with their titles.
 *
 * @since 2.0.0
 * @return array<string, string> Block folder => translated label.
 */
function get_available_blocks(): array {
	return array(
		'boutons-partages'   => __( 'Share Buttons', 'gn-block-react' ),
		'compteur-anime'     => __( 'Animated Counter', 'gn-block-react' ),
		'annee-courante'     => __( 'Current Year', 'gn-block-react' ),
		'image-icone'        => __( 'Icon Image', 'gn-block-react' ),
		'image-video'        => __( 'Image Video', 'gn-block-react' ),
		'progression-scroll' => __( 'Scroll Progress', 'gn-block-react' ),
		'resume-ia'          => __( 'AI Summary', 'gn-block-react' ),
		'retour-haut'        => __( 'Back to Top', 'gn-block-react' ),
		'slider'             => __( 'Swiper Slider', 'gn-block-react' ),
		'slider-image'       => __( 'Image Slider', 'gn-block-react' ),
		'sommaire-auto'      => __( 'Auto Table of Contents', 'gn-block-react' ),
		'temps-lecture'      => __( 'Reading Time', 'gn-block-react' ),
		'title-archive'      => __( 'Archive Title with Prefix and Suffix', 'gn-block-react' ),
	);
}

/**
 * Add options page to Settings menu.
 *
 * @since 2.0.0
 * @return void
 */
function add_options_page(): void {
	\add_options_page(
		'GN Blocs',
		'GN Blocs',
		'manage_options',
		'gn-blocs-options',
		__NAMESPACE__ . '\\options_page_html'
	);
}

/**
 * Register plugin settings.
 *
 * @since 2.0.0
 * @return void
 */
function register_settings(): void {
	$available_blocks = get_available_blocks();

	foreach ( $available_blocks as $block_folder => $block_title ) {
		\register_setting(
			'gn2025_options',
			'gn2025_enable_block_' . \str_replace( '-', '_', $block_folder ),
			array(
				'type'              => 'boolean',
				'default'           => true,
				'sanitize_callback' => 'rest_sanitize_boolean',
			)
		);
	}

	\register_setting(
		'gn2025_options',
		'gn2025_remove_data_on_uninstall',
		array(
			'type'              => 'boolean',
			'default'           => false,
			'sanitize_callback' => 'rest_sanitize_boolean',
		)
	);

	\register_setting(
		'gn2025_options',
		'gn2025_ancres_post_types',
		array(
			'type'              => 'array',
			'default'           => array( 'post' ),
			'sanitize_callback' => __NAMESPACE__ . '\\sanitize_post_types',
		)
	);

	\add_settings_section(
		'gn2025_blocks_section',
		__( 'Available Blocks', 'gn-block-react' ),
		__NAMESPACE__ . '\\blocks_section_callback',
		'gn-blocs-options'
	);

	foreach ( $available_blocks as $block_folder => $block_title ) {
		\add_settings_field(
			'gn2025_enable_block_' . \str_replace( '-', '_', $block_folder ),
			$block_title,
			__NAMESPACE__ . '\\block_field_callback',
			'gn-blocs-options',
			'gn2025_blocks_section',
			array(
				'block_folder' => $block_folder,
				'block_title'  => $block_title,
			)
		);
	}

	\add_settings_section(
		'gn2025_advanced_section',
		__( 'Advanced Settings', 'gn-block-react' ),
		__NAMESPACE__ . '\\advanced_section_callback',
		'gn-blocs-options'
	);

	\add_settings_field(
		'gn2025_remove_data_on_uninstall',
		__( 'Automatic Cleanup', 'gn-block-react' ),
		__NAMESPACE__ . '\\cleanup_field_callback',
		'gn-blocs-options',
		'gn2025_advanced_section'
	);

	\add_settings_field(
		'gn2025_ancres_post_types',
		__( 'Automatic Anchors on', 'gn-block-react' ),
		__NAMESPACE__ . '\\ancres_post_types_callback',
		'gn-blocs-options',
		'gn2025_advanced_section'
	);
}

/**
 * Callback for blocks section.
 *
 * @since 2.0.0
 * @return void
 */
function blocks_section_callback(): void {
	echo '<p>' . \esc_html__( 'Enable or disable blocks as needed. Disabled blocks will not be loaded.', 'gn-block-react' ) . '</p>';
}

/**
 * Callback for block fields.
 *
 * @since 2.0.0
 * @param array<string, string> $args Arguments containing block_folder and block_title.
 * @return void
 */
function block_field_callback( array $args ): void {
	$block_folder = $args['block_folder'];
	$option_name  = 'gn2025_enable_block_' . \str_replace( '-', '_', $block_folder );
	$value        = \get_option( $option_name, true );

	echo '<label>';
	echo '<input type="checkbox" name="' . \esc_attr( $option_name ) . '" value="1"' . \checked( 1, $value, false ) . ' />';
	echo ' ' . \esc_html__( 'Enable this block in the editor', 'gn-block-react' );
	echo '</label>';
}

/**
 * Callback for advanced settings section.
 *
 * @since 2.0.0
 * @return void
 */
function advanced_section_callback(): void {
	echo '<p>' . \esc_html__( 'Management and maintenance options for the plugin.', 'gn-block-react' ) . '</p>';
}

/**
 * Callback for cleanup field.
 *
 * @since 2.0.0
 * @return void
 */
function cleanup_field_callback(): void {
	$value = \get_option( 'gn2025_remove_data_on_uninstall', false );

	echo '<label>';
	echo '<input type="checkbox" name="gn2025_remove_data_on_uninstall" value="1"' . \checked( 1, $value, false ) . ' />';
	echo ' ' . \esc_html__( 'Delete all settings when uninstalling the plugin', 'gn-block-react' );
	echo '</label>';
	echo '<p class="description">' . \esc_html__( 'If enabled, all settings will be permanently deleted when the plugin is removed.', 'gn-block-react' ) . '</p>';
}

/**
 * Sanitize post types for automatic anchors.
 *
 * @since 2.0.0
 * @param mixed $input Data to sanitize.
 * @return array<string> Sanitized array of post type slugs.
 */
function sanitize_post_types( mixed $input ): array {
	if ( ! \is_array( $input ) ) {
		return array( 'post' );
	}

	$available_post_types = \get_post_types( array( 'public' => true ), 'names' );
	$sanitized            = \array_intersect( $input, $available_post_types );

	return ! empty( $sanitized ) ? \array_values( $sanitized ) : array( 'post' );
}

/**
 * Callback for automatic anchors post types field.
 *
 * @since 2.0.0
 * @return void
 */
function ancres_post_types_callback(): void {
	$selected_post_types  = \get_option( 'gn2025_ancres_post_types', array( 'post' ) );
	$available_post_types = \get_post_types( array( 'public' => true ), 'objects' );

	echo '<fieldset>';
	foreach ( $available_post_types as $post_type ) {
		$checked = \in_array( $post_type->name, $selected_post_types, true );
		echo '<label style="display: block; margin-bottom: 5px;">';
		echo '<input type="checkbox" name="gn2025_ancres_post_types[]" value="' . \esc_attr( $post_type->name ) . '"' . \checked( $checked, true, false ) . ' /> ';
		echo \esc_html( $post_type->labels->name );
		echo '</label>';
	}
	echo '</fieldset>';
	echo '<p class="description">' . \esc_html__( 'Select content types where H2 anchors should be added automatically (requires the Auto Table of Contents block).', 'gn-block-react' ) . '</p>';
}

/**
 * Render options page HTML.
 *
 * @since 2.0.0
 * @return void
 */
function options_page_html(): void {
	if ( ! \current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( isset( $_GET['settings-updated'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		\add_settings_error(
			'gn2025_messages',
			'gn2025_message',
			__( 'Settings saved successfully.', 'gn-block-react' ),
			'updated'
		);
	}

	\settings_errors( 'gn2025_messages' );
	?>
	<div class="wrap">
		<h1><?php echo \esc_html( \get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			\settings_fields( 'gn2025_options' );
			\do_settings_sections( 'gn-blocs-options' );
			\submit_button( __( 'Save Settings', 'gn-block-react' ) );
			?>
		</form>

		<div class="notice notice-info">
			<p><strong><?php \esc_html_e( 'Information:', 'gn-block-react' ); ?></strong> <?php \esc_html_e( 'These settings help optimize performance by only loading the blocks you need.', 'gn-block-react' ); ?></p>
		</div>
	</div>
	<?php
}

/**
 * Initialize default options on plugin activation.
 *
 * @since 2.0.0
 * @return void
 */
function activate_plugin(): void {
	$available_blocks = get_available_blocks();

	foreach ( $available_blocks as $block_folder => $block_title ) {
		$option_name = 'gn2025_enable_block_' . \str_replace( '-', '_', $block_folder );
		if ( \get_option( $option_name ) === false ) {
			\update_option( $option_name, true );
		}
	}

	if ( \get_option( 'gn2025_ancres_post_types' ) === false ) {
		\update_option( 'gn2025_ancres_post_types', array( 'post' ) );
	}
}

// Hooks
\add_action( 'admin_menu', __NAMESPACE__ . '\\add_options_page' );
\add_action( 'admin_init', __NAMESPACE__ . '\\register_settings' );
