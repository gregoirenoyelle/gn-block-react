<?php
/**
 * Render file for Reading Time block.
 *
 * @package GnBlockReact
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get attributes with sanitization.
$prefix_text = isset( $attributes['prefixText'] ) ? sanitize_text_field( $attributes['prefixText'] ) : '';
$time_unit = isset( $attributes['timeUnit'] ) ? sanitize_text_field( $attributes['timeUnit'] ) : __( 'min.', 'gn-block-react' );

// Calculate reading time.
global $post;

// Check if post is defined.
if ( ! isset( $post->ID ) ) {
    return '';
}

// Get post content.
$content = get_post_field( 'post_content', $post->ID );

// Calculate word count.
$word_count = str_word_count( wp_strip_all_tags( $content ) );

// Calculate reading time.
$readingtime = ceil( $word_count / 200 );

// Total reading time with prefix and custom unit.
$totalreadingtime = $prefix_text . ' ' . $readingtime . '&nbsp;' . $time_unit;
// Remove extra spaces if prefix is empty.
$totalreadingtime = trim( $totalreadingtime );

// Add reading-time class.
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'temps-lecture' ) );
?>
<p <?php echo $wrapper_attributes; ?>>
	<?php echo esc_html( $prefix_text ); ?><?php if ( ! empty( $prefix_text ) ) echo ' '; ?><?php echo esc_html( $readingtime ); ?>&nbsp;<?php echo esc_html( $time_unit ); ?>
</p>
