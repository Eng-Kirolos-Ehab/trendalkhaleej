<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'align' => '',
    'image' => '',
    'image_size' => 'medium',
    'image_width' => '',
    'image_shape' => '',
    'desc' => '',
    'signature' => '',
    'signature_width' => '',
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

if ( 'center' != $align && 'right' != $align ) {
    $align = 'left';
}

echo '<div class="about-wrapper align-' . $align . '">';

$image_id = 0;
$img_html = '';
$shape = $image_shape;
$caption_html = '';

if ( 'circle' != $shape && 'round' != $shape ) $shape = 'acute';
if ( $image ) {
    $image = apply_filters( 'wpml_translate_single_string', $image, self::CONTEXT_WPML, $this->field_name_translation( 'image' ) );
    if ( is_numeric( $image ) ) {
        $image_id = $image;
    } else {
        $image_id = attachment_url_to_postid( $image );
    }
    if ( $image_id ) {
        
        if ( 'square' == $image_size ) {
            $size = 'thumbnail-square';
        } elseif ( 'portrait' == $image_size ) {
            $size = 'thumbnail-portrait';
        } elseif ( 'landscape' == $image_size ) {
            $size = 'thumbnail-medium';
        } else {
            $size = $image_size;
        }
        
        $img_html = wp_get_attachment_image( $image_id, $size );
        if ( $img_html ) {
            
            $cl = [
                'fox-figure',
                'about-image',
            ];
            
            $cl[] = 'thumbnail-' . $image_shape;
            
            $image_width_css = '';
            if ( $image_width ) {
                if ( is_numeric( $image_width ) ) {
                    $image_width .= 'px';
                }
                $image_width_css = ' style="width:' . esc_attr( $image_width ) . '"';
            }
            
            $img_html = '<figure class="' . esc_attr( join( ' ', $cl ) ) . '"' . $image_width_css . '><span class="image-element thumbnail-inner">' . $img_html  . '</span></figure>';
            
        }
        
        if ( $img_html ) {
            echo $img_html;
        }
        
    }
}

$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {
    echo $before_title . $title . $after_title;
}

echo '<div class="widget-about">';

if ( $desc ) {
    $desc = apply_filters( 'wpml_translate_single_string', $desc, self::CONTEXT_WPML, $this->field_name_translation( 'desc' ) );
    echo '<div class="desc">' . do_shortcode( $desc ) . '</div>';
}

if ( is_numeric( $signature ) ) {
    $signature_id = $signature;
} else {
    $signature_id = attachment_url_to_postid( $signature );
}
if ( $signature_id ) {

    $size = 'medium';
    $img_html = wp_get_attachment_image( $signature_id, $size );
    if ( $img_html ) {
        
        $signature_width_css = '';
        if ( $signature_width ) {
            if ( is_numeric( $signature_width ) ) {
                $signature_width .= 'px';
            }
            $signature_width_css = ' style="width:' . esc_attr( $signature_width ) . '"';
        }
        
        echo '<figure class="about-signature"' . $signature_width_css . '>' . $img_html  . '</figure>';
    }

}

echo '</div><!-- .about-widget -->';

echo '</div><!-- .about-wrapper -->';

echo $after_widget;