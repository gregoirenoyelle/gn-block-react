<?php
/**
 * Render file for Current Year block.
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
$text_before = isset( $attributes['textBefore'] ) ? sanitize_text_field( $attributes['textBefore'] ) : '';
$text_after  = isset( $attributes['textAfter'] ) ? sanitize_text_field( $attributes['textAfter'] ) : '';
$current_year = date( 'Y' );

$block_wrapper_attributes = get_block_wrapper_attributes();
?>

<p <?php echo $block_wrapper_attributes; ?>>
	<?php if ( $text_before ) : ?>
		<span class="wp-block-gn2025-current-year__before"><?php echo esc_html( $text_before ); ?> </span>
	<?php endif; ?>
	<span class="wp-block-gn2025-current-year__year"><?php echo esc_html( $current_year ); ?></span>
	<?php if ( $text_after ) : ?>
		<span class="wp-block-gn2025-current-year__after"> <?php echo esc_html( $text_after ); ?></span>
	<?php endif; ?>
</p>
