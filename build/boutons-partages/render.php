<?php
/**
 * Render file for Share Buttons block.
 *
 * @package GnBlockReact
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get current page URL.
$content_url = get_permalink();
$content_titre = get_the_title();

// Get attributes with default values.
$facebook = isset($attributes['facebook']) ? $attributes['facebook'] : true;
$linkedin = isset($attributes['linkedin']) ? $attributes['linkedin'] : true;
$whatsapp = isset($attributes['whatsapp']) ? $attributes['whatsapp'] : true;
$email = isset($attributes['email']) ? $attributes['email'] : true;
$copyLink = isset($attributes['copyLink']) ? $attributes['copyLink'] : true;
$iconsGap = isset($attributes['iconsGap']) ? $attributes['iconsGap'] : '12px';

// Define icons.
$icons = [
    'facebook' => 'ea0e',
    'linkedin' => 'ea0c',
    'whatsapp' => 'ea33',
    'email' => 'ea13',
    'copy' => 'ea35'
];

// Inline style for gap.
$container_style = "gap: {$iconsGap};";

// Attributes.
$wrapper_attributes = get_block_wrapper_attributes([
    'class' => 'gn-block-partages share-buttons-container',
    'style' => $container_style
]);
$common_link_attributes = 'target="_blank" rel="noopener noreferrer" class="gn-block-link-icone"';
$icon_class = 'gn-block-icone gn-block-icone-partage';

?>
<div <?php echo $wrapper_attributes; ?>>
    <?php if ( $facebook ) : ?>
		<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $content_url ); ?>"
		   <?php echo $common_link_attributes; ?>
		   aria-label="<?php esc_attr_e( 'Share on Facebook', 'gn-block-react' ); ?>"
		   title="<?php esc_attr_e( 'Share on Facebook', 'gn-block-react' ); ?>">
			<i class="<?php echo $icon_class; ?>">
				<?php echo html_entity_decode( '&#x' . $icons['facebook'] . ';', ENT_COMPAT, 'UTF-8' ); ?>
			</i>
		</a>
	<?php endif; ?>

	<?php if ( $linkedin ) : ?>
		<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_url( $content_url ); ?>"
		   <?php echo $common_link_attributes; ?>
		   aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'gn-block-react' ); ?>"
		   title="<?php esc_attr_e( 'Share on LinkedIn', 'gn-block-react' ); ?>">
			<i class="<?php echo $icon_class; ?>">
				<?php echo html_entity_decode( '&#x' . $icons['linkedin'] . ';', ENT_COMPAT, 'UTF-8' ); ?>
			</i>
		</a>
	<?php endif; ?>

	<?php if ( $whatsapp ) : ?>
		<a href="https://api.whatsapp.com/send?text=<?php echo esc_url( $content_url ); ?>"
		   <?php echo $common_link_attributes; ?>
		   aria-label="<?php esc_attr_e( 'Share on WhatsApp', 'gn-block-react' ); ?>"
		   title="<?php esc_attr_e( 'Share on WhatsApp', 'gn-block-react' ); ?>">
			<i class="<?php echo $icon_class; ?>">
				<?php echo html_entity_decode( '&#x' . $icons['whatsapp'] . ';', ENT_COMPAT, 'UTF-8' ); ?>
			</i>
		</a>
	<?php endif; ?>

	<?php if ( $email ) : ?>
		<a href="mailto:?subject=<?php echo esc_attr__( 'Content sharing', 'gn-block-react' ); ?>&body=<?php echo esc_attr( $content_titre ); ?>%0D%0A<?php echo esc_url( $content_url ); ?>"
		   <?php echo $common_link_attributes; ?>
		   aria-label="<?php esc_attr_e( 'Send by email', 'gn-block-react' ); ?>"
		   title="<?php esc_attr_e( 'Share by email', 'gn-block-react' ); ?>">
			<i class="<?php echo $icon_class; ?>">
				<?php echo html_entity_decode( '&#x' . $icons['email'] . ';', ENT_COMPAT, 'UTF-8' ); ?>
			</i>
		</a>
	<?php endif; ?>

	<?php if ( $copyLink ) : ?>
		<a class="gn-block-link-icone share-copy"
		   data-url="<?php echo esc_attr( $content_url ); ?>"
		   href="#"
		   onclick="return false;"
		   aria-label="<?php esc_attr_e( 'Copy link', 'gn-block-react' ); ?>"
		   title="<?php esc_attr_e( 'Copy link', 'gn-block-react' ); ?>">
			<i class="<?php echo $icon_class; ?>">
				<?php echo html_entity_decode( '&#x' . $icons['copy'] . ';', ENT_COMPAT, 'UTF-8' ); ?>
			</i>
		</a>
	<?php endif; ?>
</div>
