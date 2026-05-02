<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'color' => '',
    'background_color' => '',
    'border_color' => '',
    'hover_color' => '',
    'hover_background_color' => '',
    'hover_border_color' => '',
    'border_radius' => null,
    'border_width' => null,
    'size' => null,
    'font_size' => '',
    'spacing' => null,
    'align' => '',
) ) );


// ═══════════════════════════════════════════════════════════════
// RTL CSS GENERATION
// ═══════════════════════════════════════════════════════════════

$rtl_classes = array('fox-widget-rtl-enhanced');
$rtl_css = array();
$is_rtl = is_rtl();

// Determine actual direction
$actual_dir = isset($content_direction) ? $content_direction : 'auto';
if ($actual_dir === 'auto') {
    $actual_dir = $is_rtl ? 'rtl' : 'ltr';
}
$rtl_classes[] = 'fox-dir-' . $actual_dir;

// Text alignment
if (isset($text_alignment) && $text_alignment !== 'inherit') {
    $rtl_classes[] = 'fox-text-' . $text_alignment;
    $rtl_css[] = "#{$widget_id}, #{$widget_id} .widget-content { text-align: {$text_alignment}; }";
}

// Title alignment
if (isset($title_alignment) && $title_alignment !== 'inherit') {
    $rtl_classes[] = 'fox-title-' . $title_alignment;
    $rtl_css[] = "#{$widget_id} .widget-title, #{$widget_id} .widgettitle { text-align: {$title_alignment}; }";
}

// Content direction
if (isset($content_direction) && $content_direction !== 'auto') {
    $rtl_css[] = "#{$widget_id} { direction: {$content_direction}; }";
}

// Items direction
if (isset($items_direction)) {
    if ($items_direction === 'reverse' || ($items_direction === 'auto' && $is_rtl)) {
        $rtl_classes[] = 'fox-items-reverse';
        $rtl_css[] = "#{$widget_id} .blog56, #{$widget_id} .posts-list, #{$widget_id} .widget-items { flex-direction: row-reverse; }";
    }
}

// Border settings
$border_color_val = isset($border_color) && !empty($border_color) ? $border_color : '#e0e0e0';
$border_width_val = isset($border_width) && !empty($border_width) ? intval($border_width) : 1;
$border_style_val = isset($border_style) && !empty($border_style) ? $border_style : 'solid';
$border_val = "{$border_width_val}px {$border_style_val} {$border_color_val}";

// Widget border
if (isset($border_position) && $border_position !== 'none') {
    switch ($border_position) {
        case 'top':    $rtl_css[] = "#{$widget_id} { border-top: {$border_val}; }"; break;
        case 'bottom': $rtl_css[] = "#{$widget_id} { border-bottom: {$border_val}; }"; break;
        case 'left':   $rtl_css[] = "#{$widget_id} { border-left: {$border_val}; }"; break;
        case 'right':  $rtl_css[] = "#{$widget_id} { border-right: {$border_val}; }"; break;
        case 'all':    $rtl_css[] = "#{$widget_id} { border: {$border_val}; }"; break;
    }
}

// Border between items
if (isset($border_between) && $border_between !== 'none') {
    switch ($border_between) {
        case 'horizontal':
            $rtl_css[] = "#{$widget_id} .post56, #{$widget_id} .widget-item, #{$widget_id} li { border-bottom: {$border_val}; padding-bottom: 12px; margin-bottom: 12px; }";
            $rtl_css[] = "#{$widget_id} .post56:last-child, #{$widget_id} .widget-item:last-child, #{$widget_id} li:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }";
            break;
        case 'vertical':
            $side = ($actual_dir === 'rtl') ? 'left' : 'right';
            $rtl_css[] = "#{$widget_id} .post56, #{$widget_id} .widget-item { border-{$side}: {$border_val}; padding-{$side}: 12px; margin-{$side}: 12px; }";
            $rtl_css[] = "#{$widget_id} .post56:last-child, #{$widget_id} .widget-item:last-child { border-{$side}: none; padding-{$side}: 0; margin-{$side}: 0; }";
            break;
        case 'both':
            $rtl_css[] = "#{$widget_id} .post56, #{$widget_id} .widget-item { border-bottom: {$border_val}; padding-bottom: 12px; margin-bottom: 12px; }";
            $rtl_css[] = "#{$widget_id} .post56:last-child, #{$widget_id} .widget-item:last-child { border-bottom: none; }";
            $side = ($actual_dir === 'rtl') ? 'left' : 'right';
            $rtl_css[] = "#{$widget_id} .blog56--grid .post56 { border-{$side}: {$border_val}; padding-{$side}: 12px; }";
            break;
    }
}

// Widget padding
if (isset($widget_padding) && !empty($widget_padding)) {
    $rtl_css[] = "#{$widget_id} { padding: {$widget_padding}; }";
}

// Item spacing
if (isset($item_spacing) && !empty($item_spacing)) {
    $rtl_css[] = "#{$widget_id} .post56, #{$widget_id} .widget-item { margin-bottom: {$item_spacing}; }";
}

// Column gap
if (isset($column_gap) && !empty($column_gap)) {
    $rtl_css[] = "#{$widget_id} .blog56, #{$widget_id} .widget-items { gap: {$column_gap}; }";
}

// Add RTL classes to before_widget
$before_widget = str_replace('class="widget', 'class="widget ' . implode(' ', $rtl_classes), $before_widget);

// Output RTL CSS
if (!empty($rtl_css)) {
    echo '<style type="text/css">' . implode("
", $rtl_css) . '</style>';
}


echo $before_widget;

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}
/**
 * CSS
 */
$css = [
    'a' => [],
    'a:hover' => [],
    'li + li' => [],
];
$cl = [ 'social56--widget', 'fox56-social-list' ];

/* ----------------------- align */
if ( 'left' != $align && 'right' != $align ) {
    $align = 'center';
}
$cl[] = 'align-' . $align;

/* ----------------------- spacing */
if ( ! empty($spacing)) {
    if ( is_numeric($spacing)) {
        $spacing .= 'px';
    }
    $css['li + li'][] = "margin-left:{$spacing}";
}

/* ----------------------- size */
if ( ! empty($size)) {
    if ( is_numeric($size)) {
        $size .= 'px';
    }
    $css['a'][] = "width:{$size};height:{$size}";
}

/* ----------------------- font size */
if ( ! empty($font_size)) {
    if ( is_numeric($font_size)) {
        $font_size .= 'px';
    }
    $css['a'][] = "font-size:{$font_size}";
}

/* ----------------------- border radius */
if ( ! empty($border_radius)) {
    if ( is_numeric($border_radius)) {
        $border_radius .= 'px';
    }
    $css['a'][] = "border-radius:{$border_radius}";
}

/* ----------------------- border width */
if ( ! empty($border_width)) {
    if ( is_numeric($border_width)) {
        $border_width .= 'px';
    }
    $css['a'][] = "border-width:{$border_width}";
}

/* ----------------------- color */
if ( ! empty($color)) {
    $css['a'][] = "color:{$color}";
}
if ( ! empty($background_color)) {
    $css['a'][] = "background-color:{$background_color}";
}
if ( ! empty($border_color)) {
    $css['a'][] = "border-color:{$border_color}";
}

/* ----------------------- hover color */
if ( ! empty($hover_color)) {
    $css['a:hover'][] = "color:{$hover_color}";
}
if ( ! empty($hover_background_color)) {
    $css['a:hover'][] = "background-color:{$hover_background_color}";
}
if ( ! empty($hover_border_color)) {
    $css['a:hover'][] = "border-color:{$hover_border_color}";
}

$style = [];
foreach ( $css as $selector => $css_arr ) {
    if ( empty( $css_arr) ) {
        continue;
    }
    $final_selector = "#{$widget_id} .fox56-social-list {$selector}";
    $val = join( ';', $css_arr );
    $style[] = "{$final_selector}{ {$val} }";
}
?>
<style><?php echo join( "\n", $style ); ?></style>
<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
    <?php echo fox56_social_list(); ?>
</div>

<?php echo $after_widget; ?>