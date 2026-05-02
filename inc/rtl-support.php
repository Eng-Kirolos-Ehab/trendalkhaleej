<?php
/**
 * Fox Theme - RTL Support Functions
 * 
 * Include this file in functions.php:
 * require_once get_template_directory() . '/inc/rtl-support.php';
 * 
 * @package Fox
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue RTL stylesheet when needed
 */
function fox_enqueue_rtl_styles() {
    // Load main stylesheet
    wp_enqueue_style('fox-style', get_stylesheet_uri(), array(), FOX_VERSION);
    
    // Load RTL stylesheet only when site is in RTL mode
    if (is_rtl()) {
        wp_enqueue_style(
            'fox-rtl',
            get_template_directory_uri() . '/rtl.css',
            array('fox-style'),
            FOX_VERSION
        );
    }
}
add_action('wp_enqueue_scripts', 'fox_enqueue_rtl_styles', 20);

/**
 * Localize RTL variable for JavaScript
 */
function fox_localize_rtl_scripts() {
    // Localize for slider scripts
    wp_localize_script('fox-main', 'fox_slider_vars', array(
        'rtl' => is_rtl(),
        'direction' => is_rtl() ? 'rtl' : 'ltr',
        'isRTL' => is_rtl() ? 'true' : 'false',
    ));
    
    // Also localize for theme JS
    wp_localize_script('fox-theme', 'fox_rtl_vars', array(
        'rtl' => is_rtl(),
        'direction' => is_rtl() ? 'rtl' : 'ltr',
    ));
}
add_action('wp_enqueue_scripts', 'fox_localize_rtl_scripts', 25);

/**
 * Add RTL body class
 */
function fox_rtl_body_class($classes) {
    if (is_rtl()) {
        $classes[] = 'rtl';
        $classes[] = 'fox-rtl';
    } else {
        $classes[] = 'ltr';
        $classes[] = 'fox-ltr';
    }
    
    // Add text alignment class from Customizer
    $text_alignment = get_theme_mod('fox_text_alignment', 'right');
    if (is_rtl() && $text_alignment) {
        $classes[] = 'fox-align-' . sanitize_html_class($text_alignment);
    }
    
    return $classes;
}
add_filter('body_class', 'fox_rtl_body_class');

/**
 * Register Customizer settings for RTL/Text alignment
 */
function fox_rtl_customizer_settings($wp_customize) {
    // Add RTL Section
    $wp_customize->add_section('fox_rtl_section', array(
        'title'       => __('RTL & Text Direction', 'flavor flavor flavor flavor fox'),
        'description' => __('Settings for Right-to-Left language support', 'fox'),
        'priority'    => 35,
        'panel'       => 'design', // Add to design panel if exists
    ));
    
    // Text Alignment Setting
    $wp_customize->add_setting('fox_text_alignment', array(
        'default'           => 'right',
        'sanitize_callback' => 'fox_sanitize_text_alignment',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('fox_text_alignment', array(
        'label'       => __('Default Text Alignment', 'fox'),
        'description' => __('Choose the default text alignment for RTL mode', 'fox'),
        'section'     => 'fox_rtl_section',
        'type'        => 'select',
        'choices'     => array(
            'right'  => __('Right (Recommended for Arabic)', 'fox'),
            'center' => __('Center', 'fox'),
            'left'   => __('Left', 'fox'),
        ),
    ));
    
    // Enable RTL Debug Mode
    $wp_customize->add_setting('fox_rtl_debug', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('fox_rtl_debug', array(
        'label'       => __('RTL Debug Mode', 'fox'),
        'description' => __('Enable to show RTL debugging borders', 'fox'),
        'section'     => 'fox_rtl_section',
        'type'        => 'checkbox',
    ));
    
    // Slider Direction Override
    $wp_customize->add_setting('fox_slider_rtl', array(
        'default'           => 'auto',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('fox_slider_rtl', array(
        'label'       => __('Slider Direction', 'fox'),
        'description' => __('Override slider direction for RTL', 'fox'),
        'section'     => 'fox_rtl_section',
        'type'        => 'select',
        'choices'     => array(
            'auto' => __('Auto (Follow site direction)', 'fox'),
            'rtl'  => __('Force RTL', 'fox'),
            'ltr'  => __('Force LTR', 'fox'),
        ),
    ));
    
    // Navigation Menu Direction
    $wp_customize->add_setting('fox_nav_direction', array(
        'default'           => 'auto',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('fox_nav_direction', array(
        'label'       => __('Navigation Direction', 'fox'),
        'description' => __('Override navigation menu direction', 'fox'),
        'section'     => 'fox_rtl_section',
        'type'        => 'select',
        'choices'     => array(
            'auto' => __('Auto (Follow site direction)', 'fox'),
            'rtl'  => __('Force RTL', 'fox'),
            'ltr'  => __('Force LTR', 'fox'),
        ),
    ));
}
add_action('customize_register', 'fox_rtl_customizer_settings');

/**
 * Sanitize text alignment option
 */
function fox_sanitize_text_alignment($input) {
    $valid = array('right', 'center', 'left');
    return in_array($input, $valid) ? $input : 'right';
}

/**
 * Output RTL inline styles
 */
function fox_rtl_inline_styles() {
    if (!is_rtl()) {
        return;
    }
    
    $text_alignment = get_theme_mod('fox_text_alignment', 'right');
    $debug_mode = get_theme_mod('fox_rtl_debug', false);
    
    $css = '';
    
    // Text alignment
    if ($text_alignment) {
        $css .= "body.fox-rtl { text-align: {$text_alignment}; }";
    }
    
    // Debug mode - show borders for RTL elements
    if ($debug_mode) {
        $css .= "
        .fox-rtl .widget { border: 2px dashed #ff0000; }
        .fox-rtl .main-navigation { border: 2px dashed #00ff00; }
        .fox-rtl .site-header { border: 2px dashed #0000ff; }
        .fox-rtl .site-footer { border: 2px dashed #ff00ff; }
        ";
    }
    
    if ($css) {
        wp_add_inline_style('fox-rtl', $css);
    }
}
add_action('wp_enqueue_scripts', 'fox_rtl_inline_styles', 30);

/**
 * Get slider RTL setting
 */
function fox_get_slider_rtl() {
    $setting = get_theme_mod('fox_slider_rtl', 'auto');
    
    if ($setting === 'auto') {
        return is_rtl();
    }
    
    return $setting === 'rtl';
}

/**
 * Add RTL attribute to HTML tag
 */
function fox_rtl_html_attributes($output) {
    if (is_rtl()) {
        $output .= ' dir="rtl"';
    }
    return $output;
}
add_filter('language_attributes', 'fox_rtl_html_attributes');

/**
 * Modify widget output for RTL
 */
function fox_rtl_widget_output($widget_output, $widget_id_base, $widget_instance) {
    if (!is_rtl()) {
        return $widget_output;
    }
    
    // Add RTL class to widget wrapper
    $widget_output = str_replace('class="widget ', 'class="widget fox-rtl-widget ', $widget_output);
    
    return $widget_output;
}
add_filter('widget_display_callback', 'fox_rtl_widget_display', 10, 3);

function fox_rtl_widget_display($instance, $widget, $args) {
    if (is_rtl() && !empty($args['before_widget'])) {
        $args['before_widget'] = str_replace('class="', 'class="fox-rtl-widget ', $args['before_widget']);
    }
    return $instance;
}

/**
 * Admin notice for RTL mode
 */
function fox_rtl_admin_notice() {
    if (!is_rtl()) {
        return;
    }
    
    // Check if RTL stylesheet exists
    $rtl_file = get_template_directory() . '/rtl.css';
    if (!file_exists($rtl_file)) {
        echo '<div class="notice notice-warning"><p>';
        echo __('Fox Theme: RTL mode is active but rtl.css file is missing. Please add the RTL stylesheet.', 'fox');
        echo '</p></div>';
    }
}
add_action('admin_notices', 'fox_rtl_admin_notice');

/**
 * Load RTL text domain
 */
function fox_load_rtl_textdomain() {
    $locale = determine_locale();
    $rtl_locales = array('ar', 'he_IL', 'fa_IR', 'ur');
    
    $current_lang = substr($locale, 0, 2);
    
    if (in_array($current_lang, $rtl_locales) || in_array($locale, $rtl_locales)) {
        load_theme_textdomain('fox', get_template_directory() . '/languages');
    }
}
add_action('after_setup_theme', 'fox_load_rtl_textdomain');

/**
 * Modify Slick slider options for RTL
 */
function fox_slick_rtl_options($options) {
    if (fox_get_slider_rtl()) {
        $options['rtl'] = true;
    }
    return $options;
}

/**
 * Modify Flickity options for RTL
 */
function fox_flickity_rtl_options($options) {
    if (fox_get_slider_rtl()) {
        $options['rightToLeft'] = true;
    }
    return $options;
}
