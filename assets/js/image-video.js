/**
 * Image video block functionality.
 * Handles click events and AJAX calls for lazy video embed loading.
 *
 * @package gn-block-react
 * @since 2.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
    const imageVideoContainers = document.querySelectorAll('.gn-image-video-container');
    
    imageVideoContainers.forEach(container => {
        const imageWrapper = container.querySelector('.gn-image-video-wrapper');
        const videoPlayer = container.querySelector('.gn-video-player');
        const videoUrl = container.dataset.videoUrl;
        const ajaxUrl = container.dataset.ajaxUrl;
        const nonce = container.dataset.nonce;
        
        if (!imageWrapper || !videoPlayer || !videoUrl || !ajaxUrl || !nonce) {
            return;
        }

        // Handle hover.
        imageWrapper.addEventListener('mouseenter', function() {
            const overlay = this.querySelector('.gn-image-video-overlay');
            const playButton = this.querySelector('.gn-play-button');
            if (overlay) overlay.style.background = 'rgba(0,0,0,0.5)';
            if (playButton) playButton.style.transform = 'scale(1.1)';
        });

        imageWrapper.addEventListener('mouseleave', function() {
            const overlay = this.querySelector('.gn-image-video-overlay');
            const playButton = this.querySelector('.gn-play-button');
            if (overlay) overlay.style.background = 'rgba(0,0,0,0.3)';
            if (playButton) playButton.style.transform = 'scale(1)';
        });

        // Handle click to launch video via AJAX.
        imageWrapper.addEventListener('click', function() {
            // Hide image.
            imageWrapper.style.display = 'none';

            // Show loader during loading.
            videoPlayer.innerHTML = '<div style="display: flex; align-items: center; justify-content: center; height: 100%; background: #f0f0f0;"><p>Loading video...</p></div>';
            videoPlayer.style.display = 'block';

            // AJAX call to get embed.
            const formData = new FormData();
            formData.append('action', 'gn_get_video_embed');
            formData.append('video_url', videoUrl);
            formData.append('nonce', nonce);
            
            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Parse server response and extract iframe only to prevent XSS.
                    const parser = new DOMParser();
                    const parsed = parser.parseFromString(data.data, 'text/html');
                    const embedIframe = parsed.querySelector('iframe');
                    const wrapper = document.createElement('div');
                    wrapper.className = 'gn-video-embed wp-embed-responsive';
                    if (embedIframe) {
                        wrapper.appendChild(embedIframe);
                    }
                    videoPlayer.replaceChildren(wrapper);

                    // Enable sound after video starts.
                    setTimeout(() => {
                        const iframe = videoPlayer.querySelector('iframe');
                        if (iframe && iframe.src.includes('youtube.com')) {
                            // Enable sound for YouTube.
                            iframe.contentWindow.postMessage('{"event":"command","func":"unMute","args":""}', '*');
                        }
                    }, 500);
                } else {
                    // Show error and return to image.
                    console.error('AJAX Error:', data.data);
                    videoPlayer.style.display = 'none';
                    imageWrapper.style.display = 'block';
                    // Create discrete error notification.
                    const errorDiv = document.createElement('div');
                    errorDiv.style.cssText = 'position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(255,0,0,0.9); color: white; padding: 10px 15px; border-radius: 5px; font-size: 14px; z-index: 1000;';
                    errorDiv.textContent = 'Error: ' + data.data;
                    videoPlayer.appendChild(errorDiv);

                    // Remove notification after 3 seconds.
                    setTimeout(() => {
                        if (errorDiv.parentNode) {
                            errorDiv.remove();
                        }
                    }, 3000);
                }
            })
            .catch(error => {
                // Network error, return to image.
                console.error('Network error:', error);
                videoPlayer.style.display = 'none';
                imageWrapper.style.display = 'block';
                // Create discrete error notification.
                const errorDiv = document.createElement('div');
                errorDiv.style.cssText = 'position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(255,0,0,0.9); color: white; padding: 10px 15px; border-radius: 5px; font-size: 14px; z-index: 1000;';
                errorDiv.textContent = 'Connection error. Please try again.';
                videoPlayer.appendChild(errorDiv);

                // Remove notification after 3 seconds.
                setTimeout(() => {
                    if (errorDiv.parentNode) {
                        errorDiv.remove();
                    }
                }, 3000);
            });
        });
    });
});