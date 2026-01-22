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

	/**
	 * Calculate scroll percentage, update the bar width and the label position.
	 *
	 * The label floats above the bar's right edge. Its left position is clamped
	 * so it never overflows the viewport edges.
	 *
	 * @since 2.0.0
	 * @return {void}
	 */
	const updateProgress = () => {
		const scrollTop = window.scrollY || document.documentElement.scrollTop;
		const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

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
