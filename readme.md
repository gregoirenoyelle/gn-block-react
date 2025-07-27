# GN Block React - WordPress Gutenberg Blocks Plugin

Custom WordPress Gutenberg blocks plugin developed with React and modern WordPress technologies. Provides 3 reusable blocks optimized for Full Site Editing (FSE) themes.

## Requirements

### Server Requirements

- **WordPress**: 6.7 or higher
- **PHP**: 7.4 or higher
- **Recommended**: PHP 8.0+ for optimal performance

## General Information

- **Plugin Name**: GN Block React
- **Version**: 1.0.0
- **Author**: Grégoire Noyelle
- **Text Domain**: gn-block-react
- **License**: GPL-2.0-or-later

## Plugin Architecture

### Main Features

- **Dynamic & Static Blocks**: Optimized rendering with PHP and JavaScript
- **Conditional Asset Loading**: Scripts and styles loaded only when needed
- **Internationalization**: English and French translations

## Available Blocks

### 1. Icon Image (image-icone)

Display custom icons from the included icon font.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: Custom icon font, optional link, target blank option
- **Settings**: Icon picker, URL, aria-label

### 2. Swiper Slider (slider)

Advanced image slider using Swiper library.

- **Category**: Content
- **Type**: Static (view.js)
- **Features**: Multiple slides, navigation, pagination, autoplay
- **Library**: Swiper 11.1.15

### 3. Image Slider (slider-image)

Lightweight image slider using SwiffySlider.

- **Category**: Content
- **Type**: Dynamic (render.php)
- **Features**: Multiple animations, autoplay, navigation, ratio control
- **Library**: SwiffySlider
- **Settings**: Aspect ratio, image size, animation type, autoplay/autopause

## Block Types

### Dynamic Blocks

Dynamic blocks render on the server using `render.php` files:
- Icon Image
- Image Slider

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

## Performance Optimization

### Conditional Loading

Scripts and styles load only when needed using `has_block()`:
- Swiper: Only on pages with the block
- Image Slider: Only on pages with the block

### Deferred Scripts

All frontend scripts use `defer` attribute for optimal loading:
- swiper.js
- swiffyslider.js

## Installation

1. Upload plugin folder to `/wp-content/plugins/gn-block-react/`
2. Activate plugin through the 'Plugins' menu in WordPress
3. Insert blocks through the Block Editor

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

## Support

- **Developer**: Grégoire Noyelle
- **Website**: https://www.gregoire-noyelle.com
- **License**: GPL-2.0-or-later
