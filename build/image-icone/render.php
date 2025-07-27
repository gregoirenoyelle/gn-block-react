<?php
/**
 * Render file for icon block.
 *
 * @package GnBlockReact
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Block attributes + CSS class.
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'gn-block-icone gn-block-icone-solo' ) );
// Build icon.
$icon = $attributes['icon'] ?? 'ea02';
if ( ! preg_match( '/^[0-9a-fA-F]{4,6}$/', $icon ) ) {
	$icon = 'ea02';
}
$icon_char = html_entity_decode( "&#x{$icon};", ENT_COMPAT, 'UTF-8' );
$link = $attributes['link'] ?? '';
$target_blank = !empty($attributes['targetBlank']) ? true : false;

// Prepare link attributes.
$link_attributes = '';
if ($target_blank) {
    $link_attributes = ' target="_blank" rel="noopener noreferrer"';
}

// Get aria-label with translated default value.
$aria_label_text = ! empty( $attributes['ariaLabel'] )
	? $attributes['ariaLabel']
	: __( 'Icon', 'gn-block-react' );
$aria_label = ' aria-label="' . esc_attr( $aria_label_text ) . '"';

// Display icon with or without link.
if (!empty($link)) {
    printf(
        '<a href="%1$s"%2$s class="gn-block-link-icone"><i %3$s%4$s>%5$s</i></a>',
        esc_url($link),
        wp_kses_data($link_attributes),
        $wrapper_attributes,
        $aria_label,
        $icon_char
    );
} else {
    printf(
        '<i %1$s%2$s>%3$s</i>',
        $wrapper_attributes,
        $aria_label,
        $icon_char
    );
}
