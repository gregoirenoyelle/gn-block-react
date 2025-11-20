/**
 * Animated counter block functionality.
 * Handles number animation with IntersectionObserver and accessibility support.
 *
 * @package gn-block-react
 * @since 2.0.0
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

document.addEventListener('DOMContentLoaded', function () {
    /**
     * Animate counter from start to end value with smooth transition.
     *
     * @since 2.0.0
     * @param {HTMLElement} container - The counter block container.
     * @return {void}
     */
    function animateCounters(container) {
        if (!container) return

        const chiffreElement = container.querySelector('.gn2025-compteur-number')
        if (!chiffreElement?.dataset?.end) return

        // Respecter prefers-reduced-motion
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches
        if (prefersReducedMotion) {
            // Afficher directement la valeur finale
            const endValue = chiffreElement.dataset.end
            const plusElement = container.querySelector('.gn2025-compteur-plus')
            const uniteElement = container.querySelector('.gn2025-compteur-unit')
            
            chiffreElement.textContent = parseFloat(endValue).toLocaleString('fr-FR')
            if (plusElement) plusElement.style.opacity = '1'
            if (uniteElement) uniteElement.style.opacity = '1'
            return
        }

        const endValue = Math.abs(parseFloat(chiffreElement.dataset.end)) || 0
        const startValue = Math.abs(parseFloat(chiffreElement.textContent)) || 0
        const plusElement = container.querySelector('.gn2025-compteur-plus')
        const uniteElement = container.querySelector('.gn2025-compteur-unit')
            
        const duration = parseInt(chiffreElement.dataset.vitesse) || 900
        let startTime = null
        let animationFrame = null
        const decimalPlaces = String(endValue).includes('.') ? 
            String(endValue).split('.')[1].length : 0

        function formatNumber(value) {
            const safeValue = Math.abs(parseFloat(value)) || 0
            return safeValue.toLocaleString('fr-FR', {
                minimumFractionDigits: Math.min(decimalPlaces, 2),
                maximumFractionDigits: Math.min(decimalPlaces, 2)
            })
        }

        function cleanup() {
            if (animationFrame) {
                cancelAnimationFrame(animationFrame)
            }
        }

        function step(timestamp) {
            if (!startTime) startTime = timestamp
            const progress = Math.min((timestamp - startTime) / duration, 1)

            if (progress < 1) {
                const currentValue = startValue + (endValue - startValue) * progress
                chiffreElement.textContent = formatNumber(currentValue)
                animationFrame = requestAnimationFrame(step)
            } else {
                chiffreElement.textContent = formatNumber(endValue)
                if (plusElement) {
                    plusElement.style.opacity = '1'
                }
                if (uniteElement) {
                    uniteElement.style.opacity = '1'
                }
                cleanup()
            }
        }

        animationFrame = requestAnimationFrame(step)

        const observer = new MutationObserver((mutations) => {
            if (!document.contains(container)) {
                cleanup()
                observer.disconnect()
            }
        })
        observer.observe(document.body, { childList: true, subtree: true })
    }

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters(entry.target)
                observer.unobserve(entry.target)
            }
        })
    }, { threshold: 0.5 })

    document.querySelectorAll('.wp-block-gn2025-compteur-anime').forEach(section => {
        observer.observe(section)
    })
})