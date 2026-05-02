<?php
/**
 * Fox Theme - Widget RTL Support System
 * 
 * Comprehensive RTL support for all widgets with:
 * - Text alignment controls per widget
 * - Column alignment options
 * - Border direction controls
 * - Layout direction settings
 * 
 * @package Fox
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * RTL Alignment Options for Widgets
 */
function fox_widget_rtl_alignment_options() {
    return array(
        'inherit' => __('Inherit (Auto RTL/LTR)', 'fox'),
        'right'   => __('Right', 'fox'),
        'center'  => __('Center', 'fox'),
        'left'    => __('Left', 'fox'),
    );
}

/**
 * RTL Direction Options
 */
function fox_widget_rtl_direction_options() {
    return array(
        'auto' => __('Auto (Follow Site)', 'fox'),
        'rtl'  => __('RTL (Right to Left)', 'fox'),
        'ltr'  => __('LTR (Left to Right)', 'fox'),
    );
}

/**
 * Border Position Options
 */
function fox_widget_border_position_options() {
    return array(
        'none'   => __('None', 'fox'),
        'right'  => __('Right', 'fox'),
        'left'   => __('Left', 'fox'),
        'top'    => __('Top', 'fox'),
        'bottom' => __('Bottom', 'fox'),
        'both-v' => __('Both Vertical (Left & Right)', 'fox'),
        'both-h' => __('Both Horizontal (Top & Bottom)', 'fox'),
        'all'    => __('All Sides', 'fox'),
    );
}

/**
 * RTL Fields to add to each widget
 */
function fox_widget_rtl_fields() {
    return array(
        // Section Header
        array(
            'id'   => 'rtl_section_header',
            'type' => 'heading',
            'name' => __('━━━ RTL & Alignment Settings ━━━', 'fox'),
        ),
        
        // Text Alignment
        array(
            'id'      => 'text_alignment',
            'name'    => __('Text Alignment', 'fox'),
            'type'    => 'select',
            'options' => fox_widget_rtl_alignment_options(),
            'std'     => 'inherit',
            'desc'    => __('Control text alignment for this widget', 'fox'),
        ),
        
        // Title Alignment
        array(
            'id'      => 'title_alignment',
            'name'    => __('Title Alignment', 'fox'),
            'type'    => 'select',
            'options' => fox_widget_rtl_alignment_options(),
            'std'     => 'inherit',
            'desc'    => __('Control widget title alignment', 'fox'),
        ),
        
        // Content Direction
        array(
            'id'      => 'content_direction',
            'name'    => __('Content Direction', 'fox'),
            'type'    => 'select',
            'options' => fox_widget_rtl_direction_options(),
            'std'     => 'auto',
            'desc'    => __('Control content flow direction', 'fox'),
        ),
        
        // Column Alignment (for multi-column widgets)
        array(
            'id'      => 'column_alignment',
            'name'    => __('Column Alignment', 'fox'),
            'type'    => 'select',
            'options' => array(
                'auto'   => __('Auto', 'fox'),
                'start'  => __('Start (Right in RTL)', 'fox'),
                'center' => __('Center', 'fox'),
                'end'    => __('End (Left in RTL)', 'fox'),
            ),
            'std'     => 'auto',
            'desc'    => __('Align columns within widget', 'fox'),
        ),
        
        // Border Section Header
        array(
            'id'   => 'border_section_header',
            'type' => 'heading',
            'name' => __('── Border Settings ──', 'fox'),
        ),
        
        // Vertical Border
        array(
            'id'      => 'border_vertical',
            'name'    => __('Vertical Border', 'fox'),
            'type'    => 'select',
            'options' => array(
                'none'    => __('None', 'fox'),
                'right'   => __('Right Side', 'fox'),
                'left'    => __('Left Side', 'fox'),
                'between' => __('Between Columns', 'fox'),
                'both'    => __('Both Sides', 'fox'),
            ),
            'std'     => 'none',
        ),
        
        // Horizontal Border
        array(
            'id'      => 'border_horizontal',
            'name'    => __('Horizontal Border', 'fox'),
            'type'    => 'select',
            'options' => array(
                'none'    => __('None', 'fox'),
                'top'     => __('Top', 'fox'),
                'bottom'  => __('Bottom', 'fox'),
                'between' => __('Between Items', 'fox'),
                'both'    => __('Both (Top & Bottom)', 'fox'),
            ),
            'std'     => 'none',
        ),
        
        // Border Color
        array(
            'id'          => 'border_color',
            'name'        => __('Border Color', 'fox'),
            'type'        => 'text',
            'placeholder' => '#e0e0e0',
            'desc'        => __('Enter color code (e.g., #e0e0e0)', 'fox'),
        ),
        
        // Border Width
        array(
            'id'          => 'border_width',
            'name'        => __('Border Width', 'fox'),
            'type'        => 'text',
            'placeholder' => '1',
            'desc'        => __('Border width in pixels', 'fox'),
        ),
        
        // Border Style
        array(
            'id'      => 'border_style',
            'name'    => __('Border Style', 'fox'),
            'type'    => 'select',
            'options' => array(
                'solid'  => __('Solid', 'fox'),
                'dashed' => __('Dashed', 'fox'),
                'dotted' => __('Dotted', 'fox'),
                'double' => __('Double', 'fox'),
            ),
            'std'     => 'solid',
        ),
        
        // Spacing Section
        array(
            'id'   => 'spacing_section_header',
            'type' => 'heading',
            'name' => __('── Spacing & Padding ──', 'fox'),
        ),
        
        // Padding
        array(
            'id'          => 'widget_padding',
            'name'        => __('Widget Padding', 'fox'),
            'type'        => 'text',
            'placeholder' => '15px',
            'desc'        => __('e.g., 15px or 10px 20px', 'fox'),
        ),
        
        // Column Gap
        array(
            'id'          => 'column_gap',
            'name'        => __('Column Gap', 'fox'),
            'type'        => 'text',
            'placeholder' => '20px',
            'desc'        => __('Space between columns', 'fox'),
        ),
        
        // Row Gap
        array(
            'id'          => 'row_gap',
            'name'        => __('Row Gap', 'fox'),
            'type'        => 'text',
            'placeholder' => '15px',
            'desc'        => __('Space between rows', 'fox'),
        ),
    );
}

/**
 * Generate RTL CSS for widget
 */
function fox_widget_rtl_css($instance, $widget_id) {
    $defaults = array(
        'text_alignment'    => 'inherit',
        'title_alignment'   => 'inherit',
        'content_direction' => 'auto',
        'column_alignment'  => 'auto',
        'border_vertical'   => 'none',
        'border_horizontal' => 'none',
        'border_color'      => '#e0e0e0',
        'border_width'      => '1',
        'border_style'      => 'solid',
        'widget_padding'    => '',
        'column_gap'        => '',
        'row_gap'           => '',
    );
    
    $settings = wp_parse_args($instance, $defaults);
    $css = array();
    $selector = "#{$widget_id}";
    
    // Text Alignment
    if ($settings['text_alignment'] !== 'inherit') {
        $css[] = "{$selector} { text-align: {$settings['text_alignment']}; }";
        $css[] = "{$selector} .widget-content { text-align: {$settings['text_alignment']}; }";
    }
    
    // Title Alignment
    if ($settings['title_alignment'] !== 'inherit') {
        $css[] = "{$selector} .widget-title, {$selector} .widgettitle { text-align: {$settings['title_alignment']}; }";
    }
    
    // Content Direction
    if ($settings['content_direction'] !== 'auto') {
        $css[] = "{$selector} { direction: {$settings['content_direction']}; }";
    }
    
    // Column Alignment
    if ($settings['column_alignment'] !== 'auto') {
        $justify = $settings['column_alignment'];
        if ($justify === 'start') {
            $justify = 'flex-start';
        } elseif ($justify === 'end') {
            $justify = 'flex-end';
        }
        $css[] = "{$selector} .widget-content { justify-content: {$justify}; }";
        $css[] = "{$selector} .blog56, {$selector} .posts-list { justify-content: {$justify}; }";
    }
    
    // Border settings
    $border_color = !empty($settings['border_color']) ? $settings['border_color'] : '#e0e0e0';
    $border_width = !empty($settings['border_width']) ? intval($settings['border_width']) : 1;
    $border_style = $settings['border_style'];
    $border = "{$border_width}px {$border_style} {$border_color}";
    
    // Vertical Border
    switch ($settings['border_vertical']) {
        case 'right':
            $css[] = "{$selector} { border-right: {$border}; }";
            break;
        case 'left':
            $css[] = "{$selector} { border-left: {$border}; }";
            break;
        case 'between':
            $css[] = "{$selector} .post56, {$selector} .widget-item { border-right: {$border}; }";
            $css[] = "{$selector} .post56:last-child, {$selector} .widget-item:last-child { border-right: none; }";
            // RTL adjustment
            if (is_rtl()) {
                $css[] = "body.rtl {$selector} .post56, body.rtl {$selector} .widget-item { border-right: none; border-left: {$border}; }";
                $css[] = "body.rtl {$selector} .post56:last-child, body.rtl {$selector} .widget-item:last-child { border-left: none; }";
            }
            break;
        case 'both':
            $css[] = "{$selector} { border-left: {$border}; border-right: {$border}; }";
            break;
    }
    
    // Horizontal Border
    switch ($settings['border_horizontal']) {
        case 'top':
            $css[] = "{$selector} { border-top: {$border}; }";
            break;
        case 'bottom':
            $css[] = "{$selector} { border-bottom: {$border}; }";
            break;
        case 'between':
            $css[] = "{$selector} .post56, {$selector} .widget-item { border-bottom: {$border}; }";
            $css[] = "{$selector} .post56:last-child, {$selector} .widget-item:last-child { border-bottom: none; }";
            break;
        case 'both':
            $css[] = "{$selector} { border-top: {$border}; border-bottom: {$border}; }";
            break;
    }
    
    // Padding
    if (!empty($settings['widget_padding'])) {
        $css[] = "{$selector} { padding: {$settings['widget_padding']}; }";
    }
    
    // Column Gap
    if (!empty($settings['column_gap'])) {
        $gap = $settings['column_gap'];
        $css[] = "{$selector} .blog56, {$selector} .posts-list { gap: {$gap}; }";
        $css[] = "{$selector} .blog56 .post56 { margin-right: 0; margin-left: 0; }";
    }
    
    // Row Gap
    if (!empty($settings['row_gap'])) {
        $gap = $settings['row_gap'];
        $css[] = "{$selector} .blog56 .post56, {$selector} .posts-list .post { margin-bottom: {$gap}; }";
    }
    
    return $css;
}

/**
 * Generate RTL classes for widget wrapper
 */
function fox_widget_rtl_classes($instance) {
    $classes = array('fox-widget-rtl-enabled');
    
    $defaults = array(
        'text_alignment'    => 'inherit',
        'title_alignment'   => 'inherit',
        'content_direction' => 'auto',
        'column_alignment'  => 'auto',
    );
    
    $settings = wp_parse_args($instance, $defaults);
    
    if ($settings['text_alignment'] !== 'inherit') {
        $classes[] = 'fox-text-' . $settings['text_alignment'];
    }
    
    if ($settings['title_alignment'] !== 'inherit') {
        $classes[] = 'fox-title-' . $settings['title_alignment'];
    }
    
    if ($settings['content_direction'] !== 'auto') {
        $classes[] = 'fox-dir-' . $settings['content_direction'];
    }
    
    if ($settings['column_alignment'] !== 'auto') {
        $classes[] = 'fox-col-' . $settings['column_alignment'];
    }
    
    return implode(' ', $classes);
}

/**
 * Add RTL fields to widget
 */
function fox_add_rtl_fields_to_widget($fields) {
    return array_merge($fields, fox_widget_rtl_fields());
}

/**
 * Render RTL CSS in widget output
 */
function fox_render_widget_rtl_css($instance, $widget_id) {
    $css_rules = fox_widget_rtl_css($instance, $widget_id);
    
    if (!empty($css_rules)) {
        echo '<style type="text/css">';
        echo implode("\n", $css_rules);
        echo '</style>';
    }
}

/**
 * Filter to add RTL wrapper classes
 */
function fox_filter_widget_params($params) {
    global $wp_registered_widgets;
    
    $widget_id = $params[0]['widget_id'];
    
    if (isset($wp_registered_widgets[$widget_id])) {
        // Add RTL class to widget wrapper
        if (strpos($params[0]['before_widget'], 'class="') !== false) {
            $params[0]['before_widget'] = str_replace(
                'class="',
                'class="fox-widget-rtl-support ',
                $params[0]['before_widget']
            );
        }
    }
    
    return $params;
}
add_filter('dynamic_sidebar_params', 'fox_filter_widget_params');

/**
 * Global RTL Widget CSS
 */
function fox_widget_rtl_global_css() {
    if (!is_rtl()) {
        return;
    }
    
    ?>
    <style type="text/css">
    /* Fox Widget RTL Global Styles */
    
    /* Text alignment classes */
    .fox-text-right { text-align: right !important; }
    .fox-text-left { text-align: left !important; }
    .fox-text-center { text-align: center !important; }
    
    /* Title alignment */
    .fox-title-right .widget-title,
    .fox-title-right .widgettitle { text-align: right !important; }
    .fox-title-left .widget-title,
    .fox-title-left .widgettitle { text-align: left !important; }
    .fox-title-center .widget-title,
    .fox-title-center .widgettitle { text-align: center !important; }
    
    /* Direction classes */
    .fox-dir-rtl { direction: rtl !important; }
    .fox-dir-ltr { direction: ltr !important; }
    
    /* Column alignment */
    .fox-col-start .blog56,
    .fox-col-start .posts-list { justify-content: flex-start !important; }
    .fox-col-center .blog56,
    .fox-col-center .posts-list { justify-content: center !important; }
    .fox-col-end .blog56,
    .fox-col-end .posts-list { justify-content: flex-end !important; }
    
    /* RTL Widget Base */
    .fox-widget-rtl-support {
        direction: rtl;
        text-align: right;
    }
    
    /* RTL List adjustments */
    .fox-widget-rtl-support ul {
        padding-right: 0;
        padding-left: 0;
    }
    
    .fox-widget-rtl-support ul li {
        text-align: right;
    }
    
    /* RTL thumbnail position swap */
    .fox-widget-rtl-support .post56--list .thumbnail56 {
        margin-right: 0;
        margin-left: 15px;
    }
    
    .fox-widget-rtl-support .post56--list.thumbnail-position-right .thumbnail56 {
        margin-left: 0;
        margin-right: 15px;
    }
    
    /* Border between columns - RTL */
    .fox-widget-rtl-support .blog56--list .post56 {
        border-left: none;
    }
    
    /* Flex direction for RTL */
    .fox-widget-rtl-support .blog56 {
        flex-direction: row-reverse;
    }
    
    .fox-widget-rtl-support .blog56--list {
        flex-direction: column;
    }
    </style>
    <?php
}
add_action('wp_head', 'fox_widget_rtl_global_css', 99);
