<?php
/**
 * Render file for Image Slider block.
 *
 * @package GnBlockReact
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$images = $attributes['images'] ?? [];
$ratio = $attributes['ratio'] ?? '16x9';
$imageSize = $attributes['imageSize'] ?? 'full';
$hasAutoplay = $attributes['hasAutoplay'] ?? false;
$hasAutopause = $attributes['hasAutopause'] ?? false;
$hasVisibleNav = $attributes['hasVisibleNav'] ?? false;
$hasRevealEffect = $attributes['hasRevealEffect'] ?? false;
$animationType = $attributes['animationType'] ?? 'slide';
$hasBorder = $attributes['hasBorder'] ?? false;

if ( empty( $images ) ) {
    return;
}

$slider_classes = [
    'swiffy-slider',
    'slider-nav-animation',
    'slider-item-ratio',
    'slider-item-ratio-' . $ratio,
    'slider-nav-touch'
];

if ( $hasAutoplay ) {
    $slider_classes[] = 'slider-nav-autoplay';
}
if ( $hasAutopause ) {
    $slider_classes[] = 'slider-nav-autopause';
}
if ( $hasVisibleNav ) {
    $slider_classes[] = 'slider-nav-visible';
}
if ( $hasRevealEffect ) {
    $slider_classes[] = 'slider-item-reveal';
}
if ( $animationType === 'fadein' ) {
    $slider_classes[] = 'slider-nav-animation-fadein';
}
if ( $animationType !== 'slide' ) {
    $slider_classes[] = 'slider-nav-animation-' . $animationType;
}
if ( $hasBorder ) {
    $slider_classes[] = 'slider-bordure';
}

$wrapper_attributes = get_block_wrapper_attributes();
?>

<section <?php echo $wrapper_attributes; ?>>
    <div class="<?php echo esc_attr( implode( ' ', $slider_classes ) ); ?>">
        <ul class="slider-container">
            <?php foreach ( $images as $image ): ?>
                <?php
                $imgUrl = wp_get_attachment_image_url( $image['id'], $imageSize );
                $imgAlt = get_post_meta( $image['id'], '_wp_attachment_image_alt', true );
                ?>
                <li class="slide-visible">
                    <img src="<?php echo esc_url( $imgUrl ); ?>"
                         alt="<?php echo esc_attr( $imgAlt ); ?>"
                         loading="lazy">
                </li>
            <?php endforeach; ?>
        </ul>

        <button type="button" class="slider-nav" aria-label="Go previous"></button>
        <button type="button" class="slider-nav slider-nav-next" aria-label="Go next"></button>
    </div>
</section>