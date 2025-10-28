<?php
/**
 * Automatic anchors for posts.
 *
 * @package GnBlockReact
 * @author  Gregoire Noyelle
 * @license GPL-2.0-or-later
 * @link    https://www.gregoirenoyelle.com/
 */

namespace GN\BlockReact\Features;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add automatic anchors to H2 headings in posts.
 *
 * @since 2.0.0
 * @param string|null $content The post content.
 * @return string Modified content with anchors.
 */
function h2_ids_to_content( ?string $content ): string {
	if ( ! \is_string( $content ) ) {
		return '';
	}

	if ( empty( $content ) ) {
		return $content;
	}

	$enabled_post_types = \get_option( 'gn2025_ancres_post_types', array( 'post' ) );
	if ( ! \is_singular( $enabled_post_types ) ) {
		return $content;
	}

	$dom = new \DOMDocument();
	\libxml_use_internal_errors( true );
	$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $content );
	\libxml_clear_errors();

	$xpath    = new \DOMXPath( $dom );
	$headings = $xpath->query( '//h2' );

	if ( ! $headings || $headings->length === 0 ) {
		return $content;
	}

	foreach ( $headings as $index => $h2 ) {
		$text = \trim( $h2->textContent );
		$slug = \sanitize_title( $text );

		if ( empty( $slug ) ) {
			$slug = 'titre-' . ( $index + 1 );
		}

		$h2->setAttribute( 'id', $slug );
	}

	$modified = $dom->saveHTML( $dom->getElementsByTagName( 'body' )->item( 0 ) );
	return \preg_replace( '/^<body>|<\/body>$/', '', $modified ) ?: $content;
}

// Hooks
\add_filter( 'the_content', __NAMESPACE__ . '\\h2_ids_to_content' );
