/**
 * Back to top button functionality.
 * Handles scroll detection and smooth scrolling to top of page.
 *
 * @package gn-block-react
 * @since 2.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('backtotop');
    if (!backToTopButton) return;

    // Get block attributes
    const scrollTrigger = parseInt(backToTopButton.dataset.scrollTrigger) || 300;

    /**
     * Toggle button visibility based on scroll position.
     *
     * @since 2.0.0
     * @return {void}
     */
    function toggleBackToTopButton() {
        if (window.scrollY > scrollTrigger) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    }

    /**
     * Scroll to top of page with smooth animation.
     *
     * @since 2.0.0
     * @param {Event} e - The click or touch event.
     * @return {void}
     */
    function scrollToTop(e) {
        e.preventDefault();
        const link = e.currentTarget;
        
        link.classList.add('clicked');
        
        if (e.type === 'touchstart' || window.matchMedia('(hover: none)').matches) {
            link.classList.add('touched');
        }
        
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        
        setTimeout(() => {
            link.classList.remove('clicked', 'touched');
        }, 1000);
    }
    
    // Listen to scroll event
    window.addEventListener('scroll', toggleBackToTopButton);
    
    // Listen to button click and touch
    const backToTopLink = backToTopButton.querySelector('a');
    if (backToTopLink) {
        backToTopLink.addEventListener('click', scrollToTop);
        backToTopLink.addEventListener('touchstart', scrollToTop);
        
        // Reset touched state on mouseleave (desktop).
        backToTopLink.addEventListener('mouseleave', function() {
            this.classList.remove('touched');
        });
    }
    
    // Check initial state
    toggleBackToTopButton();
});