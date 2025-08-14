<?php
/**
 * Render file for Back to Top block.
 *
 * @package GnBlockReact
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Extract attributes with default values.
$right_position = isset( $attributes['rightPosition'] ) ? intval( $attributes['rightPosition'] ) : 15;
$bottom_position = isset( $attributes['bottomPosition'] ) ? intval( $attributes['bottomPosition'] ) : 15;
$scroll_trigger = isset( $attributes['scrollTrigger'] ) ? intval( $attributes['scrollTrigger'] ) : 300;
$icon_size = isset( $attributes['iconSize'] ) ? intval( $attributes['iconSize'] ) : 48;

// SVG images URL.
$default_icon = plugin_dir_url( __FILE__ ) . '../../assets/img/back-to-top.svg';
$hover_icon = plugin_dir_url( __FILE__ ) . '../../assets/img/back-to-top-hover.svg';

// Inline CSS for position and size.
$style = sprintf(
    'right: %dpx; bottom: %dpx;',
    esc_attr( $right_position ),
    esc_attr( $bottom_position )
);

// CSS for link element (size).
$link_style = sprintf(
    'width: %dpx; height: %dpx;',
    esc_attr( $icon_size ),
    esc_attr( $icon_size )
);

// HTML output.
?>
<div id="backtotop" style="<?php echo esc_attr( $style ); ?>" data-scroll-trigger="<?php echo esc_attr( $scroll_trigger ); ?>" <?php echo get_block_wrapper_attributes(); ?>>
    <a href="#top" aria-label="Retour vers le haut de la page" style="<?php echo esc_attr( $link_style ); ?>">
        <span class="sr-only-back-to-top">Retour vers le haut de la page</span>
        <img src="<?php echo esc_url( $default_icon ); ?>" alt="" class="icon-default" width="<?php echo esc_attr( $icon_size ); ?>" height="<?php echo esc_attr( $icon_size ); ?>">
        <img src="<?php echo esc_url( $hover_icon ); ?>" alt="" class="icon-hover" width="<?php echo esc_attr( $icon_size ); ?>" height="<?php echo esc_attr( $icon_size ); ?>">
    </a>
</div>
