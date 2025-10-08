<?php
/**
 * Render file for Image Video block.
 *
 * @package GnBlockReact
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$image_id = $attributes['imageId'] ?? '';
$image_url = $attributes['imageUrl'] ?? '';
$image_alt = $attributes['imageAlt'] ?? '';
$video_url = $attributes['videoUrl'] ?? '';
$icon_color = $attributes['iconColor'] ?? '#fff';
$icon_size = $attributes['iconSize'] ?? '7rem';

$block_wrapper_attributes = get_block_wrapper_attributes();

// Display nothing if image or video is missing.
if ( empty( $image_url ) || empty( $video_url ) ) {
    return;
}
?>

<div <?php echo $block_wrapper_attributes; ?>>
    <div class="gn-image-video-container" 
         data-video-url="<?php echo esc_url( $video_url ); ?>"
         data-ajax-url="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
         data-nonce="<?php echo wp_create_nonce( 'gn_video_embed' ); ?>">
        <div class="gn-image-video-wrapper" style="aspect-ratio: 16/9; position: relative; overflow: hidden; cursor: pointer;">
            <img 
                src="<?php echo esc_url( $image_url ); ?>" 
                alt="<?php echo esc_attr( $image_alt ); ?>"
                style="width: 100%; height: 100%; object-fit: cover;"
                loading="lazy"
            />
            <div class="gn-image-video-overlay" style="
                position: absolute; 
                top: 0; 
                left: 0; 
                width: 100%; 
                height: 100%; 
                display: flex; 
                align-items: center; 
                justify-content: center;
            ">
                <div class="gn-play-button" style="
                    display: flex; 
                    align-items: center; 
                    justify-content: center; 
                    font-size: <?php echo esc_attr( $icon_size ); ?>; 
                    color: <?php echo esc_attr( $icon_color ); ?>;
                    font-family: 'Icones Font', sans-serif;
                    transition: transform 0.3s ease;
                ">
                    <?php echo html_entity_decode("&#xea0b;", ENT_COMPAT, 'UTF-8'); ?>
                </div>
            </div>
        </div>
        
        <div class="gn-video-player" style="display: none; aspect-ratio: 16/9;">
            <!-- Iframe will be created by JavaScript via AJAX to avoid preloading -->
        </div>
    </div>
</div>