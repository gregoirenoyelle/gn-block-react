/**
 * Front-end script for Scroll Progress block.
 *
 * Updates a fixed progress bar and optional floating label in real time
 * as the user scrolls the page.
 *
 * @package gn-block-react
 * @since 2.0.0
 */

document.addEventListener( 'DOMContentLoaded', () => {
	const bar = document.querySelector( '[data-scroll-bar]' );
	const label = document.querySelector( '[data-scroll-label]' );

	if ( ! bar ) {
		return;
	}

	const scrollEnd = document.querySelector( '[data-scroll-end]' );

	/**
	 * Calculate scroll percentage, update the bar width and the label position.
	 *
	 * Uses the in-flow [data-scroll-end] anchor emitted by render.php to set the
	 * 100% point at the block's placement position. Falls back to full document
	 * height when the anchor is absent.
	 *
	 * The label floats above the bar's right edge. Its left position is clamped
	 * so it never overflows the viewport edges.
	 *
	 * @since 2.0.0
	 * @return {void}
	 */
	const updateProgress = () => {
		const scrollTop = window.scrollY || document.documentElement.scrollTop;

		const clientHeight = document.documentElement.clientHeight;
		const docHeight = scrollEnd
			? scrollEnd.getBoundingClientRect().top + scrollTop - clientHeight
			: document.documentElement.scrollHeight - clientHeight;

		if ( docHeight <= 0 ) {
			return;
		}

		const percentage = Math.min( Math.round( ( scrollTop / docHeight ) * 100 ), 100 );

		bar.style.width = percentage + '%';

		if ( label ) {
			label.textContent = percentage + '%';

			// Clamp left position so the bubble stays within viewport bounds.
			const clampedLeft = Math.max( 2, Math.min( 98, percentage ) );
			label.style.left = clampedLeft + '%';
		}
	};

	window.addEventListener( 'scroll', updateProgress, { passive: true } );

	// Run once on load to set initial state.
	updateProgress();
} );
