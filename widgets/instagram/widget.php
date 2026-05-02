<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    
    'title' => '',
    'feed_id' => '1',
    /*
    'username' => '',
    'number' => '',
    'column' => '',
    'size' => '',
    'item_spacing' => 'tiny',
    'show_header' => true,
    'show_meta' => '',
    'crop' => true,
    'cache_time' => '', */
    'hover_style' => '',
    'heading_text' => '',
    'heading_text_icon' => true,
    'heading_subtitle' => '',
    'profile_url' => '',
    'follow_text' => 'Follow Us',
    'follow_text_style' => 'insta',
    'follow_text_position' => 'after',
) ) );

/* previous version
--------------------------------------------- */
if ( ! fox56() ) { 
    
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

    fox_instagram( $instance );

    echo $after_widget;
    return;
}

/* current version
--------------------------------------------- */
if ( ! $feed_id ) {
    $feed_id = 1;
}
$feed_id = apply_filters( 'wpml_translate_single_string', $feed_id, self::CONTEXT_WPML, $this->field_name_translation( 'feed_id' ) );
$shortcode = '[instagram-feed feed=' . esc_attr( $feed_id ). ']';

echo $before_widget;
$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
if ( !empty( $title ) ) {	
    echo $before_title . $title . $after_title;
}

$cl = [ 'instagram56' ];

/* ------------- hover_style */
if ( $hover_style == 'fade' || $hover_style == 'border' ) {
    $cl[] = 'instagram56--' . $hover_style;
}
?>
<div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">

    <?php if ( $heading_text || $heading_subtitle ) { 
        $heading_text = apply_filters( 'wpml_translate_single_string', $heading_text, self::CONTEXT_WPML, $this->field_name_translation( 'heading_text' ) );
        $heading_subtitle = apply_filters( 'wpml_translate_single_string', $heading_subtitle, self::CONTEXT_WPML, $this->field_name_translation( 'heading_subtitle' ) );
        ?>
        <div class="instagram56__header">
            <?php if ( $heading_subtitle ) { ?>
            <p class="instagram56__header__subtitle"><?php echo $heading_subtitle; ?></p>
            <?php } ?>
            <?php if ( $heading_text ) { ?>
            <h3 class="instagram56__header__title">
                <?php if ( $heading_text_icon ) { ?><i class="ic56-instagram"></i><?php } ?>
                <span><?php echo $heading_text; ?></span>
            </h3>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="instagram56__main">
        <?php echo do_shortcode( $shortcode ); ?>

        <?php if ( $follow_text && $profile_url ) { 
            $follow_text = apply_filters( 'wpml_translate_single_string', $follow_text, self::CONTEXT_WPML, $this->field_name_translation( 'follow_text' ) );
            $profile_url = apply_filters( 'wpml_translate_single_string', $profile_url, self::CONTEXT_WPML, $this->field_name_translation( 'profile_url' ) );
            ?>
        <div class="follow-text button56 follow-text--<?php echo esc_attr( $follow_text_position ); ?>">
            <a href="<?php echo esc_url( $profile_url ); ?>" target="_blank" class="follow-us btn56 btn56--<?php echo esc_attr( $follow_text_style ); ?>"><?php echo esc_html( $follow_text ) ?></a>
        </div><!-- .follow-text -->
        <?php } ?>
    </div>

</div>

<?php echo $after_widget; ?>