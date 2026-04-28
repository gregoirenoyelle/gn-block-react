=== GN Block React ===

Contributors: Grégoire Noyelle
Requires at least: 6.7
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 2.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: gutenberg, blocks, custom-blocks, react, fse, block-editor, social-sharing, table-of-contents


== Description ==

Collection of 13 custom Gutenberg blocks for WordPress, developed with React and optimized for Full Site Editing (FSE) themes.

**Features:**

* 13 custom Gutenberg blocks ready to use
* Individual block activation/deactivation from admin settings
* Dynamic and static blocks with optimized rendering
* Conditional asset loading for better performance
* Current year display with optional prefix/suffix
* Social media sharing buttons (Facebook, LinkedIn, WhatsApp, Email)
* Animated counter with customizable settings
* Auto table of contents from H2 headings
* Reading time calculator
* Image video player with lazy loading (YouTube)
* Scroll progress bar fixed at bottom of viewport
* AI Summary links (ChatGPT, Claude, Mistral, Perplexity)
* Back to top button with scroll trigger
* Two slider options (Swiper and SwiffySlider)
* Custom icon font included
* Archive title with prefix/suffix
* Fully internationalized (English and French)
* Security hardened with nonce verification and rate limiting


== Available Blocks ==

**Content Blocks (gn-block-content):**

1. **Current Year** - Dynamic current year with optional prefix/suffix
2. **Share Buttons** - Social media sharing with customizable platforms
3. **Animated Counter** - Count up animation with custom unit
4. **Icon Image** - Display custom icons with optional link
5. **Image Video** - Image placeholder that loads YouTube video on click
6. **AI Summary** - Summarize post with ChatGPT, Claude, Mistral or Perplexity
7. **Swiper Slider** - Advanced image slider with Swiper library
8. **Image Slider** - Lightweight slider with SwiffySlider
9. **Auto Table of Contents** - Generate TOC from H2 headings
10. **Reading Time** - Calculate and display reading time

**Theme Blocks (gn-block-theme):**

11. **Scroll Progress** - Fixed progress bar updated in real time on scroll
12. **Back to Top** - Floating button to scroll to top
13. **Archive Title** - Display archive titles with prefix/suffix


== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to 'Settings > GN Blocs' to configure block activation
4. Insert blocks through the Block Editor (Gutenberg)


== Frequently Asked Questions ==

= How do I enable or disable blocks? =

Navigate to 'Settings > GN Blocs' in your WordPress admin. You can enable or disable each block individually. Disabled blocks will not be loaded, improving performance.

= Are the blocks compatible with Full Site Editing (FSE)? =

Yes, all blocks are fully compatible with FSE themes and follow WordPress Block API standards.

= Can I use these blocks with classic themes? =

Yes, the blocks work with both classic and block themes as long as you have WordPress 6.7 or higher.

= Are the blocks translated? =

Yes, the plugin is fully internationalized with English and French translations included.

= How does the Image Video block work? =

The Image Video block displays an image placeholder. When clicked, it loads the YouTube video via AJAX, preventing the video from loading on page load and improving performance.

= Can I customize the blocks? =

Yes, each block has its own settings panel in the Block Editor with various customization options (colors, sizes, text, etc.).


== Requirements ==

**Server Requirements:**

* WordPress 6.7 or higher
* PHP 7.4 or higher
* Recommended: PHP 8.0+ for optimal performance


== Credits ==

**Swiper**
* License: MIT
* Version: 11.1.15
* Source: https://swiperjs.com/

**SwiffySlider**
* License: MIT
* Source: https://github.com/dynamicweb/swiffy-slider

**Icones Font**
* Custom icon font developed for this plugin


== Copyright ==

GN Block React Plugin, (C) 2025 Grégoire Noyelle
GN Block React is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
