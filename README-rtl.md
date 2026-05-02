# Fox Theme - RTL (Right-to-Left) Support Documentation

## Overview

This document describes the RTL (Right-to-Left) language support implementation for the Fox WordPress theme. RTL support enables proper display of Arabic, Hebrew, Persian, Urdu, and other RTL languages.

## Files Added/Modified

### New Files

1. **`/rtl.css`** - Main RTL stylesheet
   - Contains all RTL-specific CSS rules
   - Automatically loaded when WordPress is in RTL mode
   - Handles layout mirroring, text alignment, and directional swaps

2. **`/inc/rtl-support.php`** - RTL PHP functions
   - Enqueues RTL stylesheet
   - Registers Customizer settings
   - Handles RTL body classes
   - Localizes JavaScript variables

3. **`/js56/rtl-support.js`** - RTL JavaScript support
   - Initializes sliders in RTL mode
   - Fixes navigation menus
   - Handles swipe gestures
   - Manages dynamic content

4. **`/README-rtl.md`** - This documentation file

### Modified Files

Add the following line to **`/functions.php`** after theme setup:

```php
// Load RTL Support
require_once get_template_directory() . '/inc/rtl-support.php';
```

## Installation

### Step 1: Add RTL Support File

Add this line to your `functions.php` file (near the top, after initial setup):

```php
/**
 * Load RTL Support
 */
if (file_exists(get_template_directory() . '/inc/rtl-support.php')) {
    require_once get_template_directory() . '/inc/rtl-support.php';
}
```

### Step 2: Enqueue RTL JavaScript

Add to `functions.php` or modify existing script enqueue:

```php
function fox_enqueue_rtl_scripts() {
    if (is_rtl()) {
        wp_enqueue_script(
            'fox-rtl-support',
            get_template_directory_uri() . '/js56/rtl-support.js',
            array('jquery'),
            FOX_VERSION,
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'fox_enqueue_rtl_scripts', 30);
```

### Step 3: Enable RTL in WordPress

1. Go to **Settings > General**
2. Change **Site Language** to Arabic (or another RTL language)
3. Save changes

## Customizer Options

After installation, new options are available in the WordPress Customizer:

### RTL & Text Direction Panel

- **Default Text Alignment**: Choose right, center, or left alignment
- **RTL Debug Mode**: Enable to show visual borders for debugging
- **Slider Direction**: Auto, Force RTL, or Force LTR
- **Navigation Direction**: Auto, Force RTL, or Force LTR

Access via: **Appearance > Customize > RTL & Text Direction**

## CSS Classes

### Body Classes

The following classes are automatically added to `<body>`:

| Class | Description |
|-------|-------------|
| `.rtl` | WordPress default RTL class |
| `.fox-rtl` | Theme-specific RTL class |
| `.fox-align-right` | Right text alignment |
| `.fox-align-center` | Center text alignment |
| `.fox-align-left` | Left text alignment |

### Utility Classes

```css
/* Direction */
.direction-ltr { direction: ltr; }
.direction-rtl { direction: rtl; }

/* Text alignment */
.text-right { text-align: right; }
.text-left { text-align: left; }
.text-center { text-align: center; }

/* Float swaps */
.pull-left { float: right; }  /* Reversed in RTL */
.pull-right { float: left; }  /* Reversed in RTL */
```

## Slider Configuration

### Slick Slider

RTL is automatically enabled. To manually configure:

```javascript
$('.my-slider').slick({
    rtl: true, // or fox_slider_vars.rtl
    // other options...
});
```

### Flickity

```javascript
var flkty = new Flickity('.my-carousel', {
    rightToLeft: true, // or fox_slider_vars.rtl
    // other options...
});
```

### Owl Carousel

```javascript
$('.my-owl').owlCarousel({
    rtl: true,
    // other options...
});
```

## JavaScript API

### Global Variables

```javascript
// Available when RTL mode is active
fox_slider_vars = {
    rtl: true,           // Boolean
    direction: 'rtl',    // String: 'rtl' or 'ltr'
    isRTL: 'true'        // String: 'true' or 'false'
};
```

### FoxRTL Object

```javascript
// Check if RTL
if (window.FoxRTL) {
    FoxRTL.init();                    // Initialize RTL support
    FoxRTL.initSlickSliders();        // Re-init Slick sliders
    FoxRTL.initFlickitySliders();     // Re-init Flickity
    FoxRTL.initNavigationMenus();     // Fix navigation
}
```

## Widget Styling

Widgets automatically receive RTL styling. Key changes:

- Text alignment: right
- List item direction: reversed
- Icons and arrows: mirrored
- Padding/margin: swapped

## Navigation Menus

### Main Navigation
- Menu items float right
- Submenus open from right
- Dropdown arrows mirrored

### Mobile Navigation
- Off-canvas menu slides from right
- Toggle button on left side

## Testing Checklist

Before deploying, verify the following:

### Header
- [ ] Logo positioned correctly (right side)
- [ ] Navigation menu items in correct order
- [ ] Search box functional and aligned
- [ ] Social icons in correct order
- [ ] Mobile menu toggle on correct side

### Content
- [ ] Post titles right-aligned
- [ ] Post meta in correct order
- [ ] Images float correctly
- [ ] Blockquotes styled correctly
- [ ] Lists display correctly

### Sidebar
- [ ] Widgets right-aligned
- [ ] Widget titles correct
- [ ] Category counts on left
- [ ] Tag cloud flows correctly

### Footer
- [ ] Footer widgets in correct order
- [ ] Copyright text right-aligned
- [ ] Footer menu in correct order
- [ ] Social icons correct

### Sliders/Carousels
- [ ] Slides flow right-to-left
- [ ] Navigation arrows positioned correctly
- [ ] Swipe gestures work correctly
- [ ] Autoplay direction correct

### Forms
- [ ] Input fields right-aligned
- [ ] Labels positioned correctly
- [ ] Submit buttons functional
- [ ] Validation messages correct

### Comments
- [ ] Comment list indentation correct
- [ ] Avatar on right side
- [ ] Reply links positioned correctly

## Troubleshooting

### RTL styles not loading

1. Check if `rtl.css` exists in theme root
2. Verify WordPress language is set to RTL language
3. Check browser console for errors
4. Clear all caches

### Sliders not working in RTL

1. Check if `rtl-support.js` is loaded
2. Verify `fox_slider_vars` is defined
3. Re-initialize sliders after AJAX content loads

### Navigation menus broken

1. Check for conflicting CSS
2. Verify submenu positioning
3. Test mobile menu separately

### Text not aligning correctly

1. Check Customizer text alignment setting
2. Verify body classes are applied
3. Look for `!important` rules overriding

## Browser Support

RTL support has been tested on:

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- iOS Safari 14+
- Android Chrome 90+

## Performance Notes

- RTL stylesheet is only loaded when needed
- JavaScript RTL support defers to slider libraries
- No additional HTTP requests in LTR mode

## Credits

RTL Support implemented for Fox Theme
Version: 1.0.0
Date: February 2026

## Changelog

### 1.0.0 (February 2026)
- Initial RTL support implementation
- Added rtl.css stylesheet
- Added Customizer options
- Added JavaScript slider support
- Created documentation

---

For support or questions, please refer to the theme documentation or contact the developer.
