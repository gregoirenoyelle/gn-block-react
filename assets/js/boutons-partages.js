/**
 * Share buttons functionality.
 * Handles URL copying to clipboard with fallback support.
 *
 * @package gn-block-react
 * @since 2.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
	// Handle copy buttons.
	document.querySelectorAll('.share-copy').forEach(function(button) {
		button.addEventListener('click', function(e) {
			e.preventDefault();
			const url = this.getAttribute('data-url');
			// Copy URL.
			copyTextToClipboard(url, this);
		});
	});

	/**
	 * Copy text to clipboard using modern API with fallback.
	 *
	 * @since 2.0.0
	 * @param {string} text - The text to copy.
	 * @param {HTMLElement} button - The button element that triggered the copy.
	 * @return {void}
	 */
	function copyTextToClipboard(text, button) {
		// Use Clipboard API if available.
		if (navigator.clipboard) {
			navigator.clipboard.writeText(text)
				.then(() => showCopyFeedback(button))
				.catch(err => {
					fallbackCopyMethod(text, button);
				});
		} else {
			fallbackCopyMethod(text, button);
		}
	}

	/**
	 * Fallback method for browsers not supporting Clipboard API.
	 *
	 * @since 2.0.0
	 * @param {string} text - The text to copy.
	 * @param {HTMLElement} button - The button element.
	 * @return {void}
	 */
	function fallbackCopyMethod(text, button) {
		const textArea = document.createElement('textarea');
		textArea.value = text;
		textArea.style.position = 'fixed';
		textArea.style.opacity = '0';
		document.body.appendChild(textArea);
		textArea.focus();
		textArea.select();
		
		try {
			const successful = document.execCommand('copy');
			if (successful) {
				showCopyFeedback(button);
			}
		} catch (err) {
			// Silently fail
		}
		
		document.body.removeChild(textArea);
	}

	/**
	 * Display confirmation notification after successful copy.
	 *
	 * @since 2.0.0
	 * @param {HTMLElement} element - The element to position the notification near.
	 * @return {void}
	 */
	function showCopyFeedback(element) {
		// Get clicked element position.
		const rect = element.getBoundingClientRect();
		
		// Create notification.
		const notification = document.createElement('div');
		notification.textContent = 'Lien copié !';
		notification.style.position = 'fixed';
		notification.style.left = (rect.right + 10) + 'px';
		notification.style.top = (rect.top - 5) + 'px';
		notification.style.padding = '6px 12px';
		notification.style.background = '#28a745';
		notification.style.color = 'white';
		notification.style.borderRadius = '4px';
		notification.style.zIndex = '9999';
		notification.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
		notification.style.fontSize = '14px';
		
		// Ensure notification stays within screen bounds.
		const rightEdge = notification.offsetWidth + rect.right + 10;
		if (rightEdge > window.innerWidth) {
			notification.style.left = 'auto';
			notification.style.right = (window.innerWidth - rect.left + 10) + 'px';
		}
		
		document.body.appendChild(notification);
		
		// Remove notification after 2 seconds.
		setTimeout(() => {
			document.body.removeChild(notification);
		}, 2000);
	}
});