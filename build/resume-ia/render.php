<?php
/**
 * Render file for AI Summary block.
 *
 * @package GnBlockReact
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 * @since 2.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get attributes with defaults.
$show_chatgpt    = isset( $attributes['chatgpt'] ) ? $attributes['chatgpt'] : true;
$show_claude     = isset( $attributes['claude'] ) ? $attributes['claude'] : true;
$show_mistral    = isset( $attributes['mistral'] ) ? $attributes['mistral'] : true;
$show_perplexity = isset( $attributes['perplexity'] ) ? $attributes['perplexity'] : true;
$prompt_text     = ! empty( $attributes['promptText'] )
	? $attributes['promptText']
	: __( 'Summarize this article concisely, listing the 5 to 8 key points to remember for the reader. Use a professional and friendly tone, no more than 150 words.', 'gn-block-react' );
$enable_utm      = isset( $attributes['enableUtm'] ) ? $attributes['enableUtm'] : false;
$utm_medium      = isset( $attributes['utmMedium'] ) ? $attributes['utmMedium'] : 'ai_share';

// Resolve blockGap from native spacing support.
$block_gap_raw = isset( $attributes['style']['spacing']['blockGap'] ) ? $attributes['style']['spacing']['blockGap'] : null;
$gap_style     = '';
if ( $block_gap_raw ) {
	if ( str_starts_with( $block_gap_raw, 'var:preset|spacing|' ) ) {
		$slug      = str_replace( 'var:preset|spacing|', '', $block_gap_raw );
		$gap_style = 'gap: var(--wp--preset--spacing--' . esc_attr( $slug ) . ');';
	} else {
		$gap_style = 'gap: ' . esc_attr( $block_gap_raw ) . ';';
	}
}

// Build post URL, with optional per-service UTM appended later.
$post_title = get_the_title();
$post_url   = get_permalink();

if ( ! function_exists( 'gn2025_build_ai_url' ) ) {
	/**
	 * Build a prompt URL for a given AI service.
	 *
	 * @param string $base_url    The AI service base URL with query param.
	 * @param string $prompt_text The instruction text.
	 * @param string $post_title  The post title.
	 * @param string $post_url    The post URL (already UTM-enriched if needed).
	 * @return string The full encoded URL.
	 */
	function gn2025_build_ai_url( $base_url, $prompt_text, $post_title, $post_url ) {
		$prompt = $prompt_text . ' Title: ' . $post_title . ' — URL: ' . $post_url;
		return $base_url . rawurlencode( $prompt );
	}
}

// Build per-service post URLs with UTM if enabled.
$url_chatgpt    = $enable_utm ? add_query_arg( array( 'utm_source' => 'chatgpt',    'utm_medium' => $utm_medium ), $post_url ) : $post_url;
$url_claude     = $enable_utm ? add_query_arg( array( 'utm_source' => 'claude',     'utm_medium' => $utm_medium ), $post_url ) : $post_url;
$url_mistral    = $enable_utm ? add_query_arg( array( 'utm_source' => 'mistral',    'utm_medium' => $utm_medium ), $post_url ) : $post_url;
$url_perplexity = $enable_utm ? add_query_arg( array( 'utm_source' => 'perplexity', 'utm_medium' => $utm_medium ), $post_url ) : $post_url;

// Build full AI service URLs.
$chatgpt_url    = gn2025_build_ai_url( 'https://chatgpt.com/?prompt=',                    $prompt_text, $post_title, $url_chatgpt );
$claude_url     = gn2025_build_ai_url( 'https://claude.ai/new?q=',                        $prompt_text, $post_title, $url_claude );
$mistral_url    = gn2025_build_ai_url( 'https://chat.mistral.ai/chat?q=',                 $prompt_text, $post_title, $url_mistral );
$perplexity_url = gn2025_build_ai_url( 'https://www.perplexity.ai/search/new?q=',         $prompt_text, $post_title, $url_perplexity );

// Icon characters.
$icons = array(
	'chatgpt'   => html_entity_decode( '&#xea5d;', ENT_COMPAT, 'UTF-8' ),
	'claude'    => html_entity_decode( '&#xea5b;', ENT_COMPAT, 'UTF-8' ),
	'mistral'   => html_entity_decode( '&#xea5e;', ENT_COMPAT, 'UTF-8' ),
	'perplexity' => html_entity_decode( '&#xea5a;', ENT_COMPAT, 'UTF-8' ),
);

$wrapper_attributes = get_block_wrapper_attributes( array(
	'class' => 'gn-block-resume-ia',
	'style' => $gap_style,
) );
?>

<div <?php echo $wrapper_attributes; ?>
	role="group"
	aria-label="<?php esc_attr_e( 'Summarize this post with an AI service', 'gn-block-react' ); ?>">

	<span class="gn-block-resume-ia__label">
		<?php esc_html_e( 'Summarize this post with:', 'gn-block-react' ); ?>
	</span>

	<ul class="gn-block-resume-ia__links" role="list" <?php echo $gap_style ? 'style="' . esc_attr( $gap_style ) . '"' : ''; ?>>

		<?php if ( $show_chatgpt ) : ?>
		<li>
			<a class="gn-block-resume-ia__btn"
				href="<?php echo esc_attr( $chatgpt_url ); ?>"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="<?php esc_attr_e( 'Summarize with ChatGPT', 'gn-block-react' ); ?>">
				<i class="gn-block-icone" aria-hidden="true"><?php echo $icons['chatgpt']; ?></i>
				ChatGPT
			</a>
		</li>
		<?php endif; ?>

		<?php if ( $show_claude ) : ?>
		<li>
			<a class="gn-block-resume-ia__btn"
				href="<?php echo esc_attr( $claude_url ); ?>"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="<?php esc_attr_e( 'Summarize with Claude', 'gn-block-react' ); ?>">
				<i class="gn-block-icone" aria-hidden="true"><?php echo $icons['claude']; ?></i>
				Claude
			</a>
		</li>
		<?php endif; ?>

	<?php if ( $show_mistral ) : ?>
		<li>
			<a class="gn-block-resume-ia__btn"
				href="<?php echo esc_attr( $mistral_url ); ?>"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="<?php esc_attr_e( 'Summarize with Mistral', 'gn-block-react' ); ?>">
				<i class="gn-block-icone" aria-hidden="true"><?php echo $icons['mistral']; ?></i>
				Mistral
			</a>
		</li>
		<?php endif; ?>

		<?php if ( $show_perplexity ) : ?>
		<li>
			<a class="gn-block-resume-ia__btn"
				href="<?php echo esc_attr( $perplexity_url ); ?>"
				target="_blank"
				rel="noopener noreferrer"
				aria-label="<?php esc_attr_e( 'Summarize with Perplexity', 'gn-block-react' ); ?>">
				<i class="gn-block-icone" aria-hidden="true"><?php echo $icons['perplexity']; ?></i>
				Perplexity
			</a>
		</li>
		<?php endif; ?>

	</ul>
</div>
