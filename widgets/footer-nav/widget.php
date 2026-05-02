<?php 
extract( $args );
if ( fox56() ) {
    
// ═══════════════════════════════════════════════════════════════
// RTL CSS GENERATION
// ═══════════════════════════════════════════════════════════════

$rtl_classes = array('fox-widget-rtl-enhanced');
$rtl_css = array();
$is_rtl = is_rtl();

// Get RTL settings from instance
$text_alignment = isset($instance['text_alignment']) ? $instance['text_alignment'] : 'inherit';
$title_alignment = isset($instance['title_alignment']) ? $instance['title_alignment'] : 'inherit';
$content_direction = isset($instance['content_direction']) ? $instance['content_direction'] : 'auto';
$items_direction = isset($instance['items_direction']) ? $instance['items_direction'] : 'auto';
$border_between = isset($instance['border_between']) ? $instance['border_between'] : 'none';
$border_position = isset($instance['border_position']) ? $instance['border_position'] : 'none';
$border_color = isset($instance['border_color']) && !empty($instance['border_color']) ? $instance['border_color'] : '#e0e0e0';
$border_width = isset($instance['border_width']) && !empty($instance['border_width']) ? intval($instance['border_width']) : 1;
$border_style = isset($instance['border_style']) && !empty($instance['border_style']) ? $instance['border_style'] : 'solid';
$widget_padding = isset($instance['widget_padding']) ? $instance['widget_padding'] : '';
$item_spacing = isset($instance['item_spacing']) ? $instance['item_spacing'] : '';
$column_gap = isset($instance['column_gap']) ? $instance['column_gap'] : '';

// Determine actual direction
$actual_dir = $content_direction;
if ($actual_dir === 'auto') {
    $actual_dir = $is_rtl ? 'rtl' : 'ltr';
}
$rtl_classes[] = 'fox-dir-' . $actual_dir;

// Text alignment
if ($text_alignment !== 'inherit') {
    $rtl_classes[] = 'fox-text-' . $text_alignment;
    $rtl_css[] = "#{$widget_id}, #{$widget_id} .widget-content { text-align: {$text_alignment}; }";
}

// Title alignment  
if ($title_alignment !== 'inherit') {
    $rtl_classes[] = 'fox-title-' . $title_alignment;
    $rtl_css[] = "#{$widget_id} .widget-title, #{$widget_id} .widgettitle { text-align: {$title_alignment}; }";
}

// Content direction
if ($content_direction !== 'auto') {
    $rtl_css[] = "#{$widget_id} { direction: {$content_direction}; }";
}

// Items direction
if ($items_direction === 'reverse' || ($items_direction === 'auto' && $is_rtl)) {
    $rtl_classes[] = 'fox-items-reverse';
}

// Border settings
$border_val = "{$border_width}px {$border_style} {$border_color}";

if ($border_position !== 'none') {
    switch ($border_position) {
        case 'top':    $rtl_css[] = "#{$widget_id} { border-top: {$border_val}; }"; break;
        case 'bottom': $rtl_css[] = "#{$widget_id} { border-bottom: {$border_val}; }"; break;
        case 'left':   $rtl_css[] = "#{$widget_id} { border-left: {$border_val}; }"; break;
        case 'right':  $rtl_css[] = "#{$widget_id} { border-right: {$border_val}; }"; break;
        case 'all':    $rtl_css[] = "#{$widget_id} { border: {$border_val}; }"; break;
    }
}

if ($border_between !== 'none') {
    if ($border_between === 'horizontal' || $border_between === 'both') {
        $rtl_css[] = "#{$widget_id} li, #{$widget_id} .widget-item { border-bottom: {$border_val}; padding-bottom: 10px; margin-bottom: 10px; }";
        $rtl_css[] = "#{$widget_id} li:last-child, #{$widget_id} .widget-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }";
    }
}

if (!empty($widget_padding)) {
    $rtl_css[] = "#{$widget_id} { padding: {$widget_padding}; }";
}

if (!empty($item_spacing)) {
    $rtl_css[] = "#{$widget_id} li, #{$widget_id} .widget-item { margin-bottom: {$item_spacing}; }";
}

// Add RTL classes to before_widget
$before_widget = str_replace('class="widget', 'class="widget ' . implode(' ', $rtl_classes), $before_widget);

// Output RTL CSS
if (!empty($rtl_css)) {
    echo '<style type="text/css">' . implode("\n", $rtl_css) . '</style>';
}

echo $before_widget;
    echo '<div class="footer56__element footer56__nav">';
    echo fox56_footer_nav_inner();
    echo '</div>';
    echo $after_widget;
} else {
    if ( function_exists( 'fox_footer_nav' ) ) {
        
// ═══════════════════════════════════════════════════════════════
// RTL CSS GENERATION
// ═══════════════════════════════════════════════════════════════

$rtl_classes = array('fox-widget-rtl-enhanced');
$rtl_css = array();
$is_rtl = is_rtl();

// Get RTL settings from instance
$text_alignment = isset($instance['text_alignment']) ? $instance['text_alignment'] : 'inherit';
$title_alignment = isset($instance['title_alignment']) ? $instance['title_alignment'] : 'inherit';
$content_direction = isset($instance['content_direction']) ? $instance['content_direction'] : 'auto';
$items_direction = isset($instance['items_direction']) ? $instance['items_direction'] : 'auto';
$border_between = isset($instance['border_between']) ? $instance['border_between'] : 'none';
$border_position = isset($instance['border_position']) ? $instance['border_position'] : 'none';
$border_color = isset($instance['border_color']) && !empty($instance['border_color']) ? $instance['border_color'] : '#e0e0e0';
$border_width = isset($instance['border_width']) && !empty($instance['border_width']) ? intval($instance['border_width']) : 1;
$border_style = isset($instance['border_style']) && !empty($instance['border_style']) ? $instance['border_style'] : 'solid';
$widget_padding = isset($instance['widget_padding']) ? $instance['widget_padding'] : '';
$item_spacing = isset($instance['item_spacing']) ? $instance['item_spacing'] : '';
$column_gap = isset($instance['column_gap']) ? $instance['column_gap'] : '';

// Determine actual direction
$actual_dir = $content_direction;
if ($actual_dir === 'auto') {
    $actual_dir = $is_rtl ? 'rtl' : 'ltr';
}
$rtl_classes[] = 'fox-dir-' . $actual_dir;

// Text alignment
if ($text_alignment !== 'inherit') {
    $rtl_classes[] = 'fox-text-' . $text_alignment;
    $rtl_css[] = "#{$widget_id}, #{$widget_id} .widget-content { text-align: {$text_alignment}; }";
}

// Title alignment  
if ($title_alignment !== 'inherit') {
    $rtl_classes[] = 'fox-title-' . $title_alignment;
    $rtl_css[] = "#{$widget_id} .widget-title, #{$widget_id} .widgettitle { text-align: {$title_alignment}; }";
}

// Content direction
if ($content_direction !== 'auto') {
    $rtl_css[] = "#{$widget_id} { direction: {$content_direction}; }";
}

// Items direction
if ($items_direction === 'reverse' || ($items_direction === 'auto' && $is_rtl)) {
    $rtl_classes[] = 'fox-items-reverse';
}

// Border settings
$border_val = "{$border_width}px {$border_style} {$border_color}";

if ($border_position !== 'none') {
    switch ($border_position) {
        case 'top':    $rtl_css[] = "#{$widget_id} { border-top: {$border_val}; }"; break;
        case 'bottom': $rtl_css[] = "#{$widget_id} { border-bottom: {$border_val}; }"; break;
        case 'left':   $rtl_css[] = "#{$widget_id} { border-left: {$border_val}; }"; break;
        case 'right':  $rtl_css[] = "#{$widget_id} { border-right: {$border_val}; }"; break;
        case 'all':    $rtl_css[] = "#{$widget_id} { border: {$border_val}; }"; break;
    }
}

if ($border_between !== 'none') {
    if ($border_between === 'horizontal' || $border_between === 'both') {
        $rtl_css[] = "#{$widget_id} li, #{$widget_id} .widget-item { border-bottom: {$border_val}; padding-bottom: 10px; margin-bottom: 10px; }";
        $rtl_css[] = "#{$widget_id} li:last-child, #{$widget_id} .widget-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }";
    }
}

if (!empty($widget_padding)) {
    $rtl_css[] = "#{$widget_id} { padding: {$widget_padding}; }";
}

if (!empty($item_spacing)) {
    $rtl_css[] = "#{$widget_id} li, #{$widget_id} .widget-item { margin-bottom: {$item_spacing}; }";
}

// Add RTL classes to before_widget
$before_widget = str_replace('class="widget', 'class="widget ' . implode(' ', $rtl_classes), $before_widget);

// Output RTL CSS
if (!empty($rtl_css)) {
    echo '<style type="text/css">' . implode("\n", $rtl_css) . '</style>';
}

echo $before_widget;
        fox_footer_nav();
        echo $after_widget;
    }
}