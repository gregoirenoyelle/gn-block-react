<?php
/**
 * Render file for Archive Title block.
 *
 * @package GnBlockReact
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get block attributes.
$tag_name   = isset( $attributes['tagName'] ) ? $attributes['tagName'] : 'h1';
$prefix     = isset( $attributes['prefix'] ) ? $attributes['prefix'] : '';
$suffix     = isset( $attributes['suffix'] ) ? $attributes['suffix'] : '';
$text_align = isset( $attributes['textAlign'] ) ? 'has-text-align-' . $attributes['textAlign'] : '';

// Get archive title.
$archive_title = '';

if ( is_category() ) {
    $archive_title = single_cat_title( '', false );
} elseif ( is_tag() ) {
    $archive_title = single_tag_title( '', false );
} elseif ( is_author() ) {
    $archive_title = get_the_author();
} elseif ( is_post_type_archive() ) {
    $archive_title = post_type_archive_title( '', false );
} elseif ( is_tax() ) {
    $archive_title = single_term_title( '', false );
} elseif ( is_home() ) {
    $archive_title = get_the_title( get_option( 'page_for_posts', true ) );
} else {
    $archive_title = __( 'Archives', 'gn-block-react' );
}

// Build classes.
$wrapper_classes = 'wp-block-query-title';
if ($text_align) {
    $wrapper_classes .= ' ' . $text_align;
}
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $wrapper_classes ) );

// Build HTML.
printf(
    '<%1$s %2$s>%3$s<span class="archive-title">%4$s</span>%5$s</%1$s>',
    esc_attr( $tag_name ),
    $wrapper_attributes,
    ! empty( $prefix ) ? '<span class="prefix">' . esc_html( $prefix ) . '</span>' : '',
    esc_html( $archive_title ),
    ! empty( $suffix ) ? '<span class="suffix"> ' . esc_html( $suffix ) . '</span>' : ''
);
