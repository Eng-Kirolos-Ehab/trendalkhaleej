<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'form_id' => '',
    'form_shortcode' => '',
    'layout' => 'stack',
    'heading' => '',
    'mail_icon' => true,
    'subtitle' => '',
    'text_color' => '',
    'background_color' => '',
    'background_image' => '',
    'border_color' => '',
    'button_style' => '',
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

/**
 * if no form_id, get anything
 */
$form_html = '';
$form_shortcode = trim( $form_shortcode );

if ( empty( $form_shortcode ) ) {

    // in case we have empty form_id or just an invalid form_id
    if ( $form_id ) {
        ob_start();
        if ( function_exists( 'mc4wp_show_form' ) ) { 
            mc4wp_show_form( $form_id );
        }
        $form_html = ob_get_clean();
    }
    if ( ! $form_id || ! $form_html ) {
        $args = array(
            'post_type' => 'mc4wp-form',
            'posts_per_page' => 1,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
        );
        $get_forms = get_posts( $args );
        if ( $get_forms ) {
            $form_id = $get_forms[0]->ID;
        }

        $form_id = apply_filters( 'wpml_translate_single_string', $form_id, self::CONTEXT_WPML, $this->field_name_translation( 'form_id' ) );

        ob_start();
        if ( function_exists( 'mc4wp_show_form' ) ) { 
            mc4wp_show_form( $form_id );
        }
        $form_html = ob_get_clean();

    }

} else {
    $form_html = do_shortcode( $form_shortcode );
}

/**
 * title
 */
$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

$class = [ 'foxmc' ];
$inner_css = [];
$css = [];

/**
 * layout
 */
if ( 'stack' != $layout ) {
    $layout = 'inline';
}
$class[] = 'foxmc-' . $layout;

/**
 * button style
 */
if ( ! in_array( $button_style, [ 'outline', 'fill', 'primary' ] ) ) {
    $button_style = 'black';
}
$class[] = 'foxmc-button-' . $button_style;

/**
 * color
 */
if ( $text_color ) {
    $class[] = 'custom-color';
    $css[] = 'color:' . $text_color;
}

/**
 * background color
 */
if ( $background_color ) {
    $css[] = 'background-color:' . $background_color;
}

/**
 * background image
 */
$bg_img = '';
if ( $background_image ) {
    if ( is_numeric( $background_image ) ) {
        $img_html = wp_get_attachment_image( $background_image, 'full' );
    } else {
        $img_html = '<img src="' . esc_url( $background_image ) . '" alt="Mailchimp form background" />';
    }
    $bg_img = '<div class="foxmc-bg-image">' . $img_html . '</div>';
    $class[] = 'foxmc-has-bg-image';
}

// so that we set the zero padding
if ( ! $background_color && ! $background_image ) {
    $class[] = 'foxmc-no-bg';
}

/**
 * border
 */
if ( $border_color ) {
    $class[] = 'foxmc-has-border';
    $inner_css[] = 'border-color:' . $border_color;
} else {
    $class[] = 'foxmc-no-border';
}

/**
 * final css
 */
$inner_css = join( ';', $inner_css );
if ( $inner_css ) {
    $inner_css = ' style="' . esc_attr( $inner_css ). '"';
}
$css = join( ';', $css );
if ( $css ) {
    $css = ' style="' . esc_attr( $css ). '"';
}
?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>"<?php echo $css; ?>>
    
    <div class="foxmc-inner"<?php echo $inner_css; ?>>
        
        <?php if ( $heading || $subtitle ) { 
            $heading = apply_filters( 'wpml_translate_single_string', $heading, self::CONTEXT_WPML, $this->field_name_translation( 'heading' ) );
            $subtitle = apply_filters( 'wpml_translate_single_string', $subtitle, self::CONTEXT_WPML, $this->field_name_translation( 'subtitle' ) );
            ?>
        
        <div class="foxmc-heading">
        
            <?php if ( $heading ) {
                if ( fox56() ) {
                    $mail_icon_html = $mail_icon ? '<i class="ic56-envelope"></i>' : '';
                } else {
                    $mail_icon_html = $mail_icon ? '<i class="fa fa-envelope"></i>' : '';
                }
            ?>
            <h2 class="foxmc-title"><?php echo $mail_icon_html . $heading; ?></h2>
            <?php } ?>
            
            <?php if ( $subtitle ) { ?>
            <p class="foxmc-subtitle"><?php echo do_shortcode( $subtitle ); ?></p>
            <?php } ?>
        
        </div><!-- .foxmc-heading -->
        
        <?php } ?>
        
        <div class="foxmc-form">

            <?php echo $form_html; ?>
            
        </div><!-- .foxmc-form -->
        
    </div><!-- .foxmc-inner -->
    
    <?php echo $bg_img; ?>
    
</div><!-- .foxmc -->

<?php echo $after_widget; ?>