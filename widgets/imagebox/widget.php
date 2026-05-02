<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'style' => '',
    'image' => '',
    'name' => '',
    'text_position' => '',
    'url' => '',
    'target' => '',
    'ratio' => '',
    'overlay' => '',
    'overlay_opacity' => '',
    'inner_border' => '',
    'hover_effect' => '',
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

$class = [ 'fox-imagebox' ];

/**
 * style
 */
if ( ! in_array( $style, [ 2, 3 ] ) ) {
    $style = 1;
}
$class[] = 'imagebox-style-' . $style;

/**
 * text position
 * @since 4.6
 */
if ( $text_position != 'top' && $text_position != 'bottom' ) {
    $text_position = 'middle';
}
$class[] = 'text-' . $text_position;

/**
 * hover effect
 */
if ( in_array( $hover_effect, [ 'scale', 'slide' ] ) ) {
    $class[] = 'imagebox-hover-' . $hover_effect;
}

// target
if ( '_blank' != $target ) $target = '_self';
/**
 * Height, ratio
 */
$height_html = '';
$height_css = '';
if ( $ratio ) {
    $explode = explode( ':', $ratio );
    $w = isset( $explode[0] ) ? $explode[0] : ''; $w = trim( $w );
    $h = isset( $explode[1] ) ? $explode[1] : ''; $h = trim( $h );
    if ( is_numeric( $w ) && $w > 0 && is_numeric( $h ) && $h > 0 ) {
        $quotient = $h/$w * 100;
        if ( $quotient < 1000 && $quotient > 5 ) {
            $height_css = ' style="padding-bottom:' . $quotient . '%"';
        }
    }
}
$height_html = '<div class="imagebox-height"' . $height_css . '></div>';

/**
 * Overlay
 */
$overlay_html = '';
$overlay_css = [];
if ( $overlay ) {
    $overlay_css[] = 'background:' . $overlay;
}
if ( '' != $overlay_opacity ) {
    $overlay_opacity = floatval( $overlay_opacity );
    if ( $overlay_opacity <=1 && $overlay_opacity >= 0 ) {
        $overlay_css[] = 'opacity:' . $overlay_opacity;
    }
}
$overlay_css = join( ';', $overlay_css );
if ( ! empty( $overlay_css ) ) {
    $overlay_css = ' style="' . esc_attr( $overlay_css ) . '"';
}

$overlay_html = '<div class="imagebox-overlay"' . $overlay_css . '></div>';

/**
 * inner border
 */
if ( $inner_border ) {
    $class[] = 'has-inner-border';
}
?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">
    
    <?php 
    $image = apply_filters( 'wpml_translate_single_string', $image, self::CONTEXT_WPML, $this->field_name_translation( 'image' ) );
    if ( $image && $img_html = wp_get_attachment_image( $image, 'large' ) ) { ?>
    <figure class="imagebox-image">

        <?php echo $img_html; ?>

    </figure>
    <?php } ?>
    
    <div class="imagebox-inner">
        
        <?php 
        $name = apply_filters( 'wpml_translate_single_string', $name, self::CONTEXT_WPML, $this->field_name_translation( 'name' ) );
        if ( $name ) { ?>
        <div class="imagebox-content">
            
            <h3 class="imagebox-name"><?php echo esc_html( $name ); ?></h3>
            
        </div>
        <?php } ?>
        
        <?php 
        $url = apply_filters( 'wpml_translate_single_string', $url, self::CONTEXT_WPML, $this->field_name_translation( 'url' ) );
        if ( $url ) { ?>
        
        <a href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>" class="imagebox-link"></a>
    
        <?php } ?>
        
        <?php echo $height_html; ?>
        
        <?php if ( $inner_border ) {
    echo '<div class="imagebox-border imagebox-border-top"></div>';
    echo '<div class="imagebox-border imagebox-border-right"></div>';
    echo '<div class="imagebox-border imagebox-border-bottom"></div>';
    echo '<div class="imagebox-border imagebox-border-left"></div>';
}?>
        
    </div><!-- .imagebox-inner -->
    
    <?php echo $overlay_html; ?>
    
</div><!-- .fox-imagebox -->

<?php
echo $after_widget;