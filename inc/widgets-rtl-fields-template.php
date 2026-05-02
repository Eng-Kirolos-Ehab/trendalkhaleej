<?php
/**
 * RTL Fields Template for All Widgets
 * 
 * Copy these fields to each widget's fields.php file
 * Add them at the end of the $fields array
 * 
 * @package Fox
 * @since 1.0.0
 */

/**
 * RTL & ALIGNMENT FIELDS
 * Add these to any widget's fields.php
 */
$rtl_alignment_fields = array(
    
    // ════════════════════════════════════════════════════════
    // RTL & TEXT ALIGNMENT SECTION
    // ════════════════════════════════════════════════════════
    
    array(
        'id'   => 'rtl_section',
        'type' => 'heading',
        'name' => '━━━ RTL & Text Alignment ━━━',
    ),
    
    array(
        'id'      => 'text_alignment',
        'name'    => esc_html__('Text Alignment', 'fox'),
        'type'    => 'select',
        'options' => array(
            'inherit' => 'Inherit (Auto RTL/LTR)',
            'right'   => 'Right (للعربية)',
            'center'  => 'Center',
            'left'    => 'Left',
        ),
        'std'     => 'inherit',
        'desc'    => 'Control text alignment for this widget',
    ),
    
    array(
        'id'      => 'title_alignment',
        'name'    => esc_html__('Title Alignment', 'fox'),
        'type'    => 'select',
        'options' => array(
            'inherit' => 'Inherit',
            'right'   => 'Right',
            'center'  => 'Center',
            'left'    => 'Left',
        ),
        'std'     => 'inherit',
        'desc'    => 'Control widget title alignment',
    ),
    
    array(
        'id'      => 'content_direction',
        'name'    => esc_html__('Content Direction', 'fox'),
        'type'    => 'select',
        'options' => array(
            'auto' => 'Auto (Follow Site)',
            'rtl'  => 'RTL (Right to Left)',
            'ltr'  => 'LTR (Left to Right)',
        ),
        'std'     => 'auto',
        'desc'    => 'Control content flow direction',
    ),
    
    array(
        'id'      => 'column_order',
        'name'    => esc_html__('Column Order', 'fox'),
        'type'    => 'select',
        'options' => array(
            'auto'    => 'Auto',
            'normal'  => 'Normal (LTR)',
            'reverse' => 'Reverse (RTL)',
        ),
        'std'     => 'auto',
        'desc'    => 'Control the order of columns',
    ),
    
    // ════════════════════════════════════════════════════════
    // BORDER SETTINGS SECTION
    // ════════════════════════════════════════════════════════
    
    array(
        'id'   => 'border_section',
        'type' => 'heading',
        'name' => '━━━ Border Settings ━━━',
    ),
    
    array(
        'id'      => 'border_between_items',
        'name'    => esc_html__('Border Between Items', 'fox'),
        'type'    => 'select',
        'options' => array(
            'none'       => 'None',
            'horizontal' => 'Horizontal Line',
            'vertical'   => 'Vertical Line',
            'both'       => 'Both',
        ),
        'std'     => 'none',
    ),
    
    array(
        'id'      => 'border_position',
        'name'    => esc_html__('Widget Border', 'fox'),
        'type'    => 'select',
        'options' => array(
            'none'   => 'None',
            'top'    => 'Top',
            'bottom' => 'Bottom',
            'left'   => 'Left',
            'right'  => 'Right',
            'all'    => 'All Sides',
        ),
        'std'     => 'none',
    ),
    
    array(
        'id'          => 'border_color',
        'name'        => esc_html__('Border Color', 'fox'),
        'type'        => 'text',
        'placeholder' => '#e0e0e0',
        'desc'        => 'Enter color code (e.g., #e0e0e0)',
    ),
    
    array(
        'id'          => 'border_width',
        'name'        => esc_html__('Border Width (px)', 'fox'),
        'type'        => 'text',
        'placeholder' => '1',
        'std'         => '1',
    ),
    
    array(
        'id'      => 'border_style',
        'name'    => esc_html__('Border Style', 'fox'),
        'type'    => 'select',
        'options' => array(
            'solid'  => 'Solid',
            'dashed' => 'Dashed',
            'dotted' => 'Dotted',
            'double' => 'Double',
        ),
        'std'     => 'solid',
    ),
    
    // ════════════════════════════════════════════════════════
    // SPACING SECTION
    // ════════════════════════════════════════════════════════
    
    array(
        'id'   => 'spacing_section',
        'type' => 'heading',
        'name' => '━━━ Spacing & Padding ━━━',
    ),
    
    array(
        'id'          => 'widget_padding',
        'name'        => esc_html__('Widget Padding', 'fox'),
        'type'        => 'text',
        'placeholder' => '15px',
        'desc'        => 'e.g., 15px or 10px 20px 10px 20px',
    ),
    
    array(
        'id'          => 'item_spacing',
        'name'        => esc_html__('Item Spacing', 'fox'),
        'type'        => 'text',
        'placeholder' => '15px',
        'desc'        => 'Space between items',
    ),
    
    array(
        'id'          => 'column_gap',
        'name'        => esc_html__('Column Gap', 'fox'),
        'type'        => 'text',
        'placeholder' => '20px',
        'desc'        => 'Space between columns (for grid layout)',
    ),
);

/**
 * Function to merge RTL fields with existing widget fields
 * Usage: $fields = fox_merge_rtl_fields($fields);
 */
function fox_merge_rtl_fields($fields) {
    global $rtl_alignment_fields;
    
    if (!isset($rtl_alignment_fields)) {
        $rtl_alignment_fields = array(
            array(
                'id'   => 'rtl_section',
                'type' => 'heading',
                'name' => '━━━ RTL & Text Alignment ━━━',
            ),
            array(
                'id'      => 'text_alignment',
                'name'    => 'Text Alignment',
                'type'    => 'select',
                'options' => array(
                    'inherit' => 'Inherit (Auto RTL/LTR)',
                    'right'   => 'Right',
                    'center'  => 'Center',
                    'left'    => 'Left',
                ),
                'std'     => 'inherit',
            ),
            array(
                'id'      => 'title_alignment',
                'name'    => 'Title Alignment',
                'type'    => 'select',
                'options' => array(
                    'inherit' => 'Inherit',
                    'right'   => 'Right',
                    'center'  => 'Center',
                    'left'    => 'Left',
                ),
                'std'     => 'inherit',
            ),
            array(
                'id'      => 'content_direction',
                'name'    => 'Content Direction',
                'type'    => 'select',
                'options' => array(
                    'auto' => 'Auto',
                    'rtl'  => 'RTL',
                    'ltr'  => 'LTR',
                ),
                'std'     => 'auto',
            ),
            array(
                'id'   => 'border_section',
                'type' => 'heading',
                'name' => '━━━ Border Settings ━━━',
            ),
            array(
                'id'      => 'border_between_items',
                'name'    => 'Border Between Items',
                'type'    => 'select',
                'options' => array(
                    'none'       => 'None',
                    'horizontal' => 'Horizontal',
                    'vertical'   => 'Vertical',
                ),
                'std'     => 'none',
            ),
            array(
                'id'          => 'border_color',
                'name'        => 'Border Color',
                'type'        => 'text',
                'placeholder' => '#e0e0e0',
            ),
        );
    }
    
    return array_merge($fields, $rtl_alignment_fields);
}

/**
 * RTL CSS Generator for Widget
 * Use in widget.php to generate inline styles
 */
function fox_widget_generate_rtl_css($instance, $widget_id) {
    $defaults = array(
        'text_alignment'      => 'inherit',
        'title_alignment'     => 'inherit',
        'content_direction'   => 'auto',
        'column_order'        => 'auto',
        'border_between_items'=> 'none',
        'border_position'     => 'none',
        'border_color'        => '#e0e0e0',
        'border_width'        => '1',
        'border_style'        => 'solid',
        'widget_padding'      => '',
        'item_spacing'        => '',
        'column_gap'          => '',
    );
    
    $settings = wp_parse_args($instance, $defaults);
    $css = array();
    $selector = "#{$widget_id}";
    $is_rtl = is_rtl();
    
    // Determine actual direction
    $actual_dir = $settings['content_direction'];
    if ($actual_dir === 'auto') {
        $actual_dir = $is_rtl ? 'rtl' : 'ltr';
    }
    
    // Widget padding
    if (!empty($settings['widget_padding'])) {
        $css[] = "{$selector} { padding: {$settings['widget_padding']}; }";
    }
    
    // Text alignment
    if ($settings['text_alignment'] !== 'inherit') {
        $css[] = "{$selector}, {$selector} .widget-content { text-align: {$settings['text_alignment']}; }";
    }
    
    // Title alignment
    if ($settings['title_alignment'] !== 'inherit') {
        $css[] = "{$selector} .widget-title, {$selector} .widgettitle { text-align: {$settings['title_alignment']}; }";
    }
    
    // Content direction
    if ($settings['content_direction'] !== 'auto') {
        $css[] = "{$selector} { direction: {$settings['content_direction']}; }";
    }
    
    // Column order
    if ($settings['column_order'] === 'reverse' || ($settings['column_order'] === 'auto' && $is_rtl)) {
        $css[] = "{$selector} .blog56, {$selector} .posts-grid { flex-direction: row-reverse; }";
    }
    
    // Border settings
    $border = (!empty($settings['border_width']) ? $settings['border_width'] : '1') . 'px ' .
              (!empty($settings['border_style']) ? $settings['border_style'] : 'solid') . ' ' .
              (!empty($settings['border_color']) ? $settings['border_color'] : '#e0e0e0');
    
    // Widget border
    switch ($settings['border_position']) {
        case 'top':    $css[] = "{$selector} { border-top: {$border}; }"; break;
        case 'bottom': $css[] = "{$selector} { border-bottom: {$border}; }"; break;
        case 'left':   $css[] = "{$selector} { border-left: {$border}; }"; break;
        case 'right':  $css[] = "{$selector} { border-right: {$border}; }"; break;
        case 'all':    $css[] = "{$selector} { border: {$border}; }"; break;
    }
    
    // Border between items
    switch ($settings['border_between_items']) {
        case 'horizontal':
            $css[] = "{$selector} .post56, {$selector} .widget-item { border-bottom: {$border}; padding-bottom: 15px; margin-bottom: 15px; }";
            $css[] = "{$selector} .post56:last-child, {$selector} .widget-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }";
            break;
        case 'vertical':
            $side = ($actual_dir === 'rtl') ? 'left' : 'right';
            $css[] = "{$selector} .post56, {$selector} .widget-item { border-{$side}: {$border}; padding-{$side}: 15px; margin-{$side}: 15px; }";
            $css[] = "{$selector} .post56:last-child, {$selector} .widget-item:last-child { border-{$side}: none; padding-{$side}: 0; margin-{$side}: 0; }";
            break;
    }
    
    // Item spacing
    if (!empty($settings['item_spacing'])) {
        $css[] = "{$selector} .post56 { margin-bottom: {$settings['item_spacing']}; }";
    }
    
    // Column gap
    if (!empty($settings['column_gap'])) {
        $css[] = "{$selector} .blog56 { gap: {$settings['column_gap']}; }";
    }
    
    return $css;
}

/**
 * Render RTL CSS in widget
 */
function fox_widget_render_rtl_css($instance, $widget_id) {
    $css = fox_widget_generate_rtl_css($instance, $widget_id);
    
    if (!empty($css)) {
        echo '<style type="text/css">' . "\n";
        echo implode("\n", $css);
        echo "\n</style>\n";
    }
}

/**
 * Get RTL widget classes
 */
function fox_widget_get_rtl_classes($instance) {
    $defaults = array(
        'text_alignment'    => 'inherit',
        'title_alignment'   => 'inherit',
        'content_direction' => 'auto',
        'column_order'      => 'auto',
    );
    
    $settings = wp_parse_args($instance, $defaults);
    $classes = array('fox-widget-rtl-enhanced');
    $is_rtl = is_rtl();
    
    // Direction class
    $dir = $settings['content_direction'];
    if ($dir === 'auto') {
        $dir = $is_rtl ? 'rtl' : 'ltr';
    }
    $classes[] = 'fox-dir-' . $dir;
    
    // Text alignment class
    if ($settings['text_alignment'] !== 'inherit') {
        $classes[] = 'fox-text-' . $settings['text_alignment'];
    }
    
    // Title alignment class
    if ($settings['title_alignment'] !== 'inherit') {
        $classes[] = 'fox-title-' . $settings['title_alignment'];
    }
    
    // Column order class
    if ($settings['column_order'] === 'reverse' || ($settings['column_order'] === 'auto' && $is_rtl)) {
        $classes[] = 'fox-columns-reverse';
    }
    
    return implode(' ', $classes);
}
