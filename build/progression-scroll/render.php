<?php
/**
 * Render file for Scroll Progress block.
 *
 * @package GnBlockReact
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 * @since 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Sanitize attributes.
$show_label = isset( $attributes['showLabel'] ) ? (bool) $attributes['showLabel'] : true;
$bar_height = isset( $attributes['barHeight'] ) ? absint( $attributes['barHeight'] ) : 4;
$bar_color  = '#0073aa';

if ( isset( $attributes['barColor'] ) ) {
	$sanitized = sanitize_hex_color( $attributes['barColor'] );
	if ( $sanitized ) {
		$bar_color = $sanitized;
	}
}

$track_style = sprintf( 'height: %dpx;', $bar_height );

// Expose bar color as a CSS variable so label bubble inherits it without duplication.
$block_wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class' => 'gn-scroll-progress',
		'style' => '--gn-bar-color: ' . esc_attr( $bar_color ) . ';',
	)
);
?>

<div <?php echo $block_wrapper_attributes; ?> aria-hidden="true">
	<div class="gn-scroll-progress__track" style="<?php echo esc_attr( $track_style ); ?>">
		<div class="gn-scroll-progress__bar" data-scroll-bar></div>
		<?php if ( $show_label ) : ?>
			<span class="gn-scroll-progress__label" data-scroll-label>0%</span>
		<?php endif; ?>
	</div>
</div>
