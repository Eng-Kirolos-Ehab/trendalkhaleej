<?php
/**
 * ============================================================
 * FOX THEME - RTL SUPPORT PATCH
 * ============================================================
 * 
 * ADD THE FOLLOWING CODE TO YOUR functions.php FILE
 * 
 * Location: Add after theme setup, before the closing PHP tag
 * 
 * ============================================================
 */

// ============================================================
// STEP 1: Add this near the top of functions.php (after <?php)
// ============================================================

/**
 * Load RTL (Right-to-Left) Support
 * Enables Arabic, Hebrew, Persian language support
 */
if (file_exists(get_template_directory() . '/inc/rtl-support.php')) {
    require_once get_template_directory() . '/inc/rtl-support.php';
}


// ============================================================
// STEP 2: Add this to your script enqueue function
// Or create a new function if it doesn't exist
// ============================================================

/**
 * Enqueue RTL Support Scripts
 */
function fox_enqueue_rtl_scripts() {
    // Only load on RTL sites
    if (!is_rtl()) {
        return;
    }
    
    // Enqueue RTL JavaScript support
    wp_enqueue_script(
        'fox-rtl-support',
        get_template_directory_uri() . '/js56/rtl-support.js',
        array('jquery'),
        defined('FOX_VERSION') ? FOX_VERSION : '1.0.0',
        true // Load in footer
    );
    
    // Localize RTL variables for JavaScript
    wp_localize_script('fox-rtl-support', 'fox_rtl_config', array(
        'rtl'           => true,
        'direction'     => 'rtl',
        'sliderRTL'     => get_theme_mod('fox_slider_rtl', 'auto'),
        'textAlignment' => get_theme_mod('fox_text_alignment', 'right'),
        'ajaxurl'       => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'fox_enqueue_rtl_scripts', 25);


// ============================================================
// STEP 3: Add RTL body classes (if not already in rtl-support.php)
// ============================================================

/**
 * Add RTL-specific body classes
 */
function fox_add_rtl_body_classes($classes) {
    if (is_rtl()) {
        $classes[] = 'fox-rtl-active';
        $classes[] = 'fox-direction-rtl';
        
        // Add alignment class
        $alignment = get_theme_mod('fox_text_alignment', 'right');
        $classes[] = 'fox-text-' . sanitize_html_class($alignment);
    }
    
    return $classes;
}
add_filter('body_class', 'fox_add_rtl_body_classes');


// ============================================================
// STEP 4: Modify slider initialization (find existing slider code)
// Add RTL option to slider configurations
// ============================================================

/**
 * Example: Modify theme slider defaults for RTL
 * Find your existing slider initialization and add rtl option
 */

// For Slick Slider initialization, change:
// Before:
// $('.fox-slider').slick({ slidesToShow: 3, ... });
// 
// After:
// var slickOptions = {
//     slidesToShow: 3,
//     rtl: (typeof fox_slider_vars !== 'undefined') ? fox_slider_vars.rtl : false,
//     // ... other options
// };
// $('.fox-slider').slick(slickOptions);


// ============================================================
// STEP 5: Widget RTL support (optional enhancement)
// ============================================================

/**
 * Add RTL wrapper to widgets
 */
function fox_rtl_widget_wrapper($params) {
    if (!is_rtl()) {
        return $params;
    }
    
    // Add RTL class to widget wrapper
    if (isset($params[0]['before_widget'])) {
        $params[0]['before_widget'] = str_replace(
            'class="widget',
            'class="widget fox-widget-rtl',
            $params[0]['before_widget']
        );
    }
    
    return $params;
}
add_filter('dynamic_sidebar_params', 'fox_rtl_widget_wrapper');


// ============================================================
// STEP 6: Admin RTL Support (optional)
// ============================================================

/**
 * Load RTL styles in admin when editing RTL content
 */
function fox_admin_rtl_styles() {
    $screen = get_current_screen();
    
    // Only on post edit screens
    if (!$screen || !in_array($screen->base, array('post', 'page'))) {
        return;
    }
    
    // Check if post is in RTL language (for multilingual sites)
    if (is_rtl() || (function_exists('pll_current_language') && in_array(pll_current_language(), array('ar', 'he', 'fa')))) {
        wp_enqueue_style(
            'fox-admin-rtl',
            get_template_directory_uri() . '/rtl.css',
            array(),
            defined('FOX_VERSION') ? FOX_VERSION : '1.0.0'
        );
    }
}
add_action('admin_enqueue_scripts', 'fox_admin_rtl_styles');


// ============================================================
// END OF RTL SUPPORT PATCH
// ============================================================
