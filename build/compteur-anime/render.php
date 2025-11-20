<?php
/**
 * Render file for Animated Counter block.
 *
 * @package GnBlockReact
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$debut = $attributes['debut'] ?? '0';
$fin = $attributes['fin'] ?? '100';
$plus = $attributes['plus'] ?? false;
$unite = $attributes['unite'] ?? '';
$vitesse = $attributes['vitesse'] ?? 900;

$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'gn2025-compteur-block' ) );
?>

<div <?php echo $wrapper_attributes; ?>>
    <?php if ( $plus ) : ?>
        <div class="gn2025-compteur-plus" style="opacity: 0;">+</div>
    <?php endif; ?>
    
    <div 
        class="gn2025-compteur-number" 
        data-end="<?php echo esc_attr( $fin ); ?>" 
        data-vitesse="<?php echo esc_attr( $vitesse ); ?>"
        aria-live="polite"
        aria-label="<?php echo esc_attr( sprintf( __( 'Counter: %s%s%s', 'gn-block-react' ), $plus ? '+' : '', $fin, $unite ) ); ?>"
    >
        <?php echo esc_html( $debut ); ?>
    </div>
    
    <?php if ( $unite ) : ?>
        <div class="gn2025-compteur-unit" style="opacity: 0;">
            <?php echo esc_html( $unite ); ?>
        </div>
    <?php endif; ?>
</div>