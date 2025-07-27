# GN Block React - WordPress Gutenberg Blocks Plugin

Custom WordPress Gutenberg blocks plugin developed with React and modern WordPress technologies. Provides 3 reusable blocks optimized for Full Site Editing (FSE) themes.

## Requirements

### Server Requirements

- **WordPress**: 6.7 or higher
- **PHP**: 8.0 or higher

## General Information

- **Plugin Name**: GN Block React
- **Version**: 1.0.0
- **Author**: Grégoire Noyelle
- **Text Domain**: gn-block-react
- **License**: GPL-2.0-or-later

## Code Standards

### Naming Conventions

- **Block Prefix**: `gn2025/`
- **Function Names**: `gn2025_` prefix
- **Block Categories**: `gn-block-theme` and `gn-block-content`
- **CSS/JS Handles**: Prefix with `gn-block-react-`
- **Text Domain**: `gn-block-react` in all i18n functions

### PHP Standards

- **WordPress PHP Coding Standards** compliant
- PHP 8.0+ features
- Tabs for indentation
- Output escaping: `esc_html()`, `esc_attr()`, `esc_url()`
- `ABSPATH` check in all files
- Strict comparison: `in_array( $value, $array, true )`
- PHPDoc blocks with `@since`, `@param`, `@return`

### CSS Standards

- **Indentation**: Tabs only (never spaces)
- No trailing spaces
- WordPress CSS Coding Standards
- Classic CSS (no SCSS nesting)

### JavaScript Standards

- **WordPress JavaScript Coding Standards** compliant
- ESLint configured via `@wordpress/scripts`
- Semicolons required (no ASI)
- Single quotes for strings
- `const`/`let` only (no `var`)
- camelCase for variables/functions
- PascalCase for classes/components

## Plugin Architecture

### Main Features

- **3 Custom Gutenberg Blocks**: Developed with React and WordPress Block API
- **Dynamic & Static Blocks**: Optimized rendering with PHP and JavaScript
- **Conditional Asset Loading**: Scripts and styles loaded only when needed
- **Internationalization**: English and French translations

### File Structure

```
gn-block-react/
├── gn-block-react.php      # Main plugin file
├── uninstall.php            # Cleanup on uninstall
├── inc/                     # PHP functionalities
│   ├── assets/              # Asset management
│   │   └── enqueue.php
│   └── blocks/              # Block registration
│       ├── blocks-manager.php
│       └── categories-blocks.php
├── build/                   # Compiled blocks (webpack output)
├── assets/                  # Static assets
│   ├── css/
│   │   ├── font.css         # Custom icon font
│   │   ├── icone.css        # Icon styles
│   │   ├── swiper.css       # Swiper library
│   │   └── swiper-custom.css
│   ├── js/
│   │   ├── swiper.js        # Swiper library
│   │   └── swiffyslider.js  # SwiffySlider library
│   └── fonts/               # Custom icon font
└── languages/               # Translation files
```

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

## Development Workflow

### Scripts

```bash
# Development build with watch mode
npm run start

# Production build
npm run build

# Code linting
npm run lint:js
npm run lint:css
```

## Block Registration

The plugin uses WordPress 6.7+ optimized block registration:

- **WordPress 6.8+**: Uses `wp_register_block_types_from_metadata_collection()`
- **WordPress 6.7**: Uses `wp_register_block_metadata_collection()`
- **Fallback**: Classic `register_block_type()` for older versions

## Important Notes

### Icon Font

Custom icon font "Icones Font" uses hexadecimal codes (e.g., `ea0b` for play icon).

### External Libraries

- **Swiper**: v11.1.15 (CDN downloaded to assets)
- **SwiffySlider**: Latest version

## Installation

1. Upload plugin folder to `/wp-content/plugins/gn-block-react/`
2. Activate plugin through the 'Plugins' menu in WordPress
3. Insert blocks through the Block Editor

## Support

- **Developer**: Grégoire Noyelle
- **Website**: https://www.gregoire-noyelle.com
- **License**: GPL-2.0-or-later
