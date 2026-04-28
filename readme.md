# GN Block React - WordPress Gutenberg Blocks Plugin

Custom WordPress Gutenberg blocks plugin developed with React and modern WordPress technologies. Provides a collection of 13 reusable blocks optimized for Full Site Editing (FSE) themes.

## Requirements

### Server Requirements

- **WordPress**: 6.7 or higher
- **PHP**: 7.4 or higher
- **Recommended**: PHP 8.0+ for optimal performance

## General Information

- **Plugin Name**: GN Block React
- **Version**: 2.0.4
- **Author**: Grégoire Noyelle
- **Text Domain**: gn-block-react
- **License**: GPL-2.0-or-later

## Plugin Architecture

### Main Features

- **Dynamic & Static Blocks**: Optimized rendering with PHP and JavaScript
- **Conditional Asset Loading**: Scripts and styles loaded only when needed
- **Admin Settings Page**: Enable/disable blocks individually
- **Internationalization**: English and French translations
- **Performance Optimized**: Deferred scripts, transient cache, AJAX loading
- **Security Hardened**: Nonce verification, rate limiting, input validation

## Available Blocks

### 1. Current Year (annee-courante)

Displays the current server year dynamically.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: Optional text before and after the year
- **Settings**: Prefix text, suffix text

### 2. Share Buttons (boutons-partages)

Social media sharing buttons with customizable options.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: Facebook, LinkedIn, WhatsApp, Email, Copy Link
- **Settings**: Individual toggle for each platform, custom icon spacing

### 3. Animated Counter (compteur-anime)

Counter that animates from start to end value with customizable speed.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: Start/end values, custom unit, "+" prefix option, animation speed
- **Settings**: Numeric range, unit text, animation duration

### 4. Icon Image (image-icone)

Display custom icons from the included icon font.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: Custom icon font, optional link, target blank option
- **Settings**: Icon picker, URL, aria-label

### 5. Image Video (image-video)

Display an image that loads a YouTube video on click (AJAX optimized).

- **Category**: Content
- **Type**: Dynamic (render.php + AJAX)
- **Features**: Lazy video loading, custom play icon, security hardened
- **Settings**: Image, video URL, icon color/size

### 6. Scroll Progress (progression-scroll)

Displays a fixed horizontal progress bar updated in real time as the user scrolls.

- **Category**: Theme
- **Type**: Dynamic (render.php)
- **Features**: Fixed position at bottom of viewport, optional percentage label
- **Settings**: Bar color, bar height, show/hide label

### 7. AI Summary (resume-ia)

Summarize the current post with an AI service.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: ChatGPT, Claude, Mistral, Perplexity support, custom prompt, UTM tracking
- **Settings**: Service selection, custom prompt text, UTM parameters, icon spacing

### 8. Back to Top (retour-haut)

Floating button to scroll back to top with customizable appearance.

- **Category**: Theme
- **Type**: Dynamic (render.php)
- **Features**: Position control, scroll trigger threshold, hover effects
- **Settings**: Right/bottom position, scroll trigger distance, icon size

### 9. Swiper Slider (slider)

Advanced image slider using Swiper library.

- **Category**: Content
- **Type**: Static (view.js)
- **Features**: Multiple slides, navigation, pagination, autoplay
- **Library**: Swiper 11.1.15

### 10. Image Slider (slider-image)

Lightweight image slider using SwiffySlider.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: Multiple animations, autoplay, navigation, ratio control
- **Library**: SwiffySlider
- **Settings**: Aspect ratio, image size, animation type, autoplay/autopause

### 11. Auto Table of Contents (sommaire-auto)

Generates automatic table of contents from H2 headings.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: Automatic H2 detection, custom prefix, anchor generation
- **Settings**: Custom prefix text, post type selection

### 12. Reading Time (temps-lecture)

Calculates and displays estimated reading time.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: Word count calculation (200 words/min), custom prefix/unit
- **Settings**: Prefix text, time unit

### 13. Archive Title (title-archive)

Display archive title with optional prefix and suffix.

- **Category**: Theme
- **Type**: Dynamic (render.php)
- **Features**: Works with categories, tags, authors, post types, taxonomies
- **Settings**: HTML tag (h1-h6), prefix, suffix, text alignment

## Block Types

### Dynamic Blocks

Dynamic blocks render on the server using `render.php` files:
- Current Year
- Share Buttons
- Animated Counter
- Icon Image
- Image Video
- Scroll Progress
- AI Summary
- Back to Top
- Image Slider
- Auto Table of Contents
- Reading Time
- Archive Title

### Static Blocks

Static blocks render in the editor and save HTML to post content:
- Swiper Slider

## Internationalization

### Languages

- **Default**: English (en_US)
- **Translations**: French (fr_FR)

### Translation Files

- **POT**: `languages/gn-block-react.pot` (template)
- **PO**: `languages/gn-block-react-fr_FR.po` (French)
- **MO**: `languages/gn-block-react-fr_FR.mo` (compiled)
- **JSON**: `languages/gn-block-react-fr_FR-*.json` (JavaScript)
- **PHP**: `languages/gn-block-react-fr_FR.l10n.php` (PHP)

## Admin Settings

Navigate to **Settings > GN Blocs** to:

- Enable/disable blocks individually
- Configure automatic H2 anchors for post types
- Set automatic cleanup on uninstall

Disabled blocks are not loaded, improving performance.

## Performance Optimization

### Conditional Loading

Scripts and styles load only when needed using `has_block()`:
- Image Video: Only on pages with the block
- Swiper: Only on pages with the block
- Image Slider: Only on pages with the block
- Animated Counter: Only on pages with the block

### Deferred Scripts

All frontend scripts use `defer` attribute for optimal loading:
- back-to-top.js
- boutons-partages.js
- image-video.js
- compteur-anime.js
- swiper.js
- swiffyslider.js

### Caching

- Transient cache for video embed requests
- WordPress object cache compatible

## Installation

1. Upload plugin folder to `/wp-content/plugins/gn-block-react/`
2. Activate plugin through the 'Plugins' menu in WordPress
3. Navigate to 'Settings > GN Blocs' to configure
4. Insert blocks through the Block Editor

## Block Registration Optimization

The plugin uses WordPress 6.7+ optimized block registration:

- **WordPress 6.8+**: Uses `wp_register_block_types_from_metadata_collection()`
- **WordPress 6.7**: Uses `wp_register_block_metadata_collection()`
- **Fallback**: Classic `register_block_type()` for older versions

Benefits: Faster block registration and reduced database queries.

## Important Notes

### Icon Font

Custom icon font "Icones Font" uses hexadecimal codes (e.g., `ea0b` for play icon).

### External Libraries

- **Swiper**: v11.1.15 (CDN downloaded to assets)
- **SwiffySlider**: Latest version

Update Swiper: `npm run update-swiper [version]` (local development only)

**Note**: The `update-swiper.js` script is for local development only and should never be run in production or CI/CD environments. It downloads Swiper assets from jsdelivr CDN without integrity verification.

## Support

- **Developer**: Grégoire Noyelle
- **Website**: https://www.gregoire-noyelle.com
- **License**: GPL-2.0-or-later
