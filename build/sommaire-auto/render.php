<?php
/**
 * Render file for auto table of contents block.
 * Generates a table of contents based on H2 headings in the post.
 *
 * @package GnBlockReact
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Check if current post type is allowed for anchors.
$enabled_post_types = get_option( 'gn2025_ancres_post_types', array( 'post' ) );
if ( ! is_singular( $enabled_post_types ) ) {
    return;
}

// Get block attributes.
// Use translated default if no custom text is set
$prefix_text = ! empty( $attributes['prefixText'] )
	? $attributes['prefixText']
	: __( 'TABLE OF CONTENTS', 'gn-block-react' );

// Get current post (works in FSE).
$current_post = get_post();
if ( ! $current_post ) {
    return;
}

// Get raw content (HTML is already present in Gutenberg blocks).
$post_content = $current_post->post_content;
if ( empty( $post_content ) ) {
    return;
}

// Use DOMDocument to parse HTML content.
$dom = new DOMDocument();
libxml_use_internal_errors( true );
$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $post_content );
libxml_clear_errors();

// Extract all H2 headings.
$xpath = new DOMXPath( $dom );
$headings = $xpath->query( '//h2' );

// Check if there are H2 headings to display.
if ( ! $headings || $headings->length === 0 ) {
    return;
}

// Start table of contents list.
$sommaire = '<ul class="gn-sommaire-auto-list">';

// Add each H2 heading to the list.
foreach ( $headings as $index => $h2 ) {
    $titre = trim( $h2->textContent );

    // Use native WordPress function to create a clean slug.
    $slug = sanitize_title( $titre );
    
    // If slug is empty, use index-based ID.
    if ( empty( $slug ) ) {
        $slug = 'titre-' . ( $index + 1 );
    }
    
    $sommaire .= sprintf(
        '<li class="gn-sommaire-auto-item"><a href="#%s" class="gn-sommaire-auto-link">%s</a></li>',
        esc_attr( $slug ),
        esc_html( $titre )
    );
}

$sommaire .= '</ul>';

$wrapper_attributes = get_block_wrapper_attributes( array( 
    'class' => 'gn-sommaire-auto-block',
    'role' => 'navigation',
    'aria-label' => esc_attr( $prefix_text )
) );
?>

<section <?php echo $wrapper_attributes; ?>>
    <?php if ( ! empty( $prefix_text ) ) : ?>
        <p class="gn-sommaire-auto-prefix"><?php echo esc_html( $prefix_text ); ?></p>
    <?php endif; ?>
    <?php echo $sommaire; ?>
</section>