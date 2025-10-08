<?php
/**
 * AJAX function to generate video embed on demand.
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
 * AJAX function to generate video embed on demand.
 *
 * @since 2.0.0
 * @return void
 */
function get_video_embed(): void {
	// Verify nonce for security.
	if ( ! isset( $_POST['nonce'] ) || ! \wp_verify_nonce( \sanitize_text_field( \wp_unslash( $_POST['nonce'] ) ), 'gn_video_embed' ) ) {
		\wp_send_json_error( 'Invalid nonce.', 403 );
		\wp_die();
	}

	// Rate limiting: check recent calls (max 10 per minute per IP).
	$user_ip       = \sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );
	$transient_key = 'gn_video_embed_' . \md5( $user_ip );
	$requests      = \get_transient( $transient_key ) ?: array();
	$current_time  = \time();

	// Clean old requests (older than 60 seconds).
	$requests = \array_filter(
		$requests,
		function ( $timestamp ) use ( $current_time ) {
			return ( $current_time - $timestamp ) < 60;
		}
	);

	// Check limit.
	if ( \count( $requests ) >= 10 ) {
		\wp_send_json_error( 'Trop de requêtes. Veuillez patienter.' );
	}

	// Add current request.
	$requests[] = $current_time;
	\set_transient( $transient_key, $requests, 60 );

	$video_url = \sanitize_url( $_POST['video_url'] ?? '' );

	if ( empty( $video_url ) ) {
		\wp_send_json_error( 'URL vidéo manquante' );
	}

	// Validate that URL comes from allowed domain (YouTube only).
	$allowed_domains = array( 'youtube.com', 'youtu.be' );
	$parsed_url      = \parse_url( $video_url );

	if ( ! $parsed_url || ! isset( $parsed_url['host'] ) ) {
		\wp_send_json_error( 'URL vidéo invalide' );
	}

	$domain_allowed = false;
	foreach ( $allowed_domains as $domain ) {
		if ( \strpos( $parsed_url['host'], $domain ) !== false ) {
			$domain_allowed = true;
			break;
		}
	}

	if ( ! $domain_allowed ) {
		\wp_send_json_error( 'Seules les vidéos YouTube sont supportées' );
	}

	// Clean YouTube URL from extra parameters.
	$clean_video_url = $video_url;

	// For youtu.be/ID?si=xxx URLs, keep only youtu.be/ID.
	if ( \strpos( $video_url, 'youtu.be' ) !== false && \strpos( $video_url, '?' ) !== false ) {
		$clean_video_url = \substr( $video_url, 0, \strpos( $video_url, '?' ) );
	} elseif ( \strpos( $video_url, 'youtube.com/watch' ) !== false && \strpos( $video_url, '&' ) !== false ) {
		// For youtube.com/watch?v=ID&si=xxx URLs, keep only youtube.com/watch?v=ID.
		$parts = \parse_url( $video_url );
		\parse_str( $parts['query'], $query );
		if ( isset( $query['v'] ) ) {
			$clean_video_url = 'https://www.youtube.com/watch?v=' . $query['v'];
		}
	}

	// Generate video embed with autoplay.
	$video_embed = \wp_oembed_get( $clean_video_url );

	// Add autoplay to YouTube embeds.
	if ( $video_embed && \strpos( $video_embed, 'youtube.com/embed' ) !== false ) {
		if ( \strpos( $video_embed, '?feature=oembed' ) !== false ) {
			$video_embed = \str_replace( '?feature=oembed', '?autoplay=1&mute=1&enablejsapi=1&feature=oembed', $video_embed );
		} else {
			$video_embed = \str_replace( '">', '?autoplay=1&mute=1&enablejsapi=1">', $video_embed );
		}
	}

	// If wp_oembed_get fails, try to force cache refresh.
	if ( ! $video_embed ) {
		$wp_oembed   = _wp_oembed_get_object();
		$video_embed = $wp_oembed->get_html( $clean_video_url );
	}

	// Last attempt: manually create YouTube iframe.
	if ( ! $video_embed ) {
		$youtube_id = '';
		if ( \strpos( $clean_video_url, 'youtu.be/' ) !== false ) {
			$youtube_id = \substr( $clean_video_url, \strpos( $clean_video_url, 'youtu.be/' ) + 9 );
		} elseif ( \strpos( $clean_video_url, 'youtube.com/watch?v=' ) !== false ) {
			$parts = \parse_url( $clean_video_url );
			\parse_str( $parts['query'], $query );
			$youtube_id = $query['v'] ?? '';
		}

		// Validate YouTube ID (11 alphanumeric characters, _ and -).
		if ( ! empty( $youtube_id ) && \preg_match( '/^[a-zA-Z0-9_-]{11}$/', $youtube_id ) ) {
			$video_embed = '<iframe width="800" height="450" src="https://www.youtube.com/embed/' . \esc_attr( $youtube_id ) . '?autoplay=1&mute=1&enablejsapi=1" frameborder="0" allowfullscreen></iframe>';
		}
	}

	if ( $video_embed ) {
		\wp_send_json_success( $video_embed );
	} else {
		\wp_send_json_error( 'Impossible de charger cette vidéo' );
	}
}

// Hooks
\add_action( 'wp_ajax_gn_get_video_embed', __NAMESPACE__ . '\\get_video_embed' );
\add_action( 'wp_ajax_nopriv_gn_get_video_embed', __NAMESPACE__ . '\\get_video_embed' );
