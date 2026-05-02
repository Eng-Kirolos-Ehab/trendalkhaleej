<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'big_number_display' => 'all',
    'country' => '',
    'state' => '',
    'table_display'  => 'all',
    'cache_time' => '2',
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

// 2 hours cache time
$cache_time = floatval( $cache_time ) * HOUR_IN_SECONDS;
if ( $cache_time < 0 ) {
    $cache_time = HOUR_IN_SECONDS;
}

/**
 * 01 - BIG NUMBERS
 */
$endpoint = '';
switch( $big_number_display ) {
        
    case 'all' :
        $endpoint = 'all';
        break;
        
    case 'Europe':
    case 'Asia':
    case 'Africa':
    case 'Oceania':
    case 'North America':
    case 'South America':
        
        $endpoint = 'continents/' . $big_number_display;
        break;
        
    case 'country' :
        
        $endpoint = 'countries/' . rawurlencode( $country );
        break;
        
    case 'state' :
        
        $endpoint = 'states/' . rawurlencode( $state );
        break;
        
    default :
        break;
}

$big_json = '';
if ( $endpoint ) {
    
    $big_url = 'https://ev3klr6bchdcdowp.disease.sh/v2/' . $endpoint;
    
    $key = sanitize_title_with_dashes( 'fox-coronavirus-big-numbers-' . $endpoint );
    $body = get_transient( $key );
    
    if ( false === $body ) {
        $response = wp_remote_get( $big_url, array(
            'user-agent' => 'Coronavirus/1.0.0'
        ));
        if ( ! is_wp_error( $response ) ) {
            
            $body = wp_remote_retrieve_body( $response );
            $big_json = json_decode( $body );
            
            if ( ! empty( $big_json ) ) {
                set_transient( $key , $body, $cache_time );
            }
            
        }
    } else {
        
        $big_json = json_decode( $body );
        
    }
    
}

/**
 * 02 - SMALL TABLE DATA
 */
$endpoint = '';
$name_label = esc_html__( 'Area', 'wi' );
switch( $table_display ) {
        
    case 'all' :
        $endpoint  = 'countries';
        $table_key = 'country';
        $name_label = esc_html__( 'Country', 'wi' );
        break;
        
    case 'continents' :
        $endpoint = 'continents';
        $table_key = 'continent';
        $name_label = esc_html__( 'Continent', 'wi' );
        break;
        
    case 'states' :
        $endpoint = 'states';
        $table_key = 'state';
        $name_label = esc_html__( 'State', 'wi' );
        break;
        
    default :
        break;
}
if ( $endpoint ) {
    
    $url = 'https://ev3klr6bchdcdowp.disease.sh/v2/' . $endpoint;
    
    $key = sanitize_title_with_dashes( 'fox-coronavirus-table-' . $endpoint );
    $body = get_transient( $key );

    if ( false === $body ) {
        
        $response = wp_remote_get( $url, array(
            'user-agent' => 'Coronavirus/1.0.0'
        ));
        
        if ( ! is_wp_error( $response ) ) {
            
            $body = wp_remote_retrieve_body( $response );
            $table_json = json_decode( $body );
            
            if ( ! empty( $table_json ) ) {
                set_transient( $key , $body, $cache_time );
            }
            
        }
    } else {
        
        $table_json = json_decode( $body );
        
    }
    
    if ( ! empty( $table_json ) ) {
        usort( $table_json, 'fox_helper_corona_sort_by_cases' );
    }
    
}
?>

<div class="fox-coronavirus">

    <div class="coronavirus-inner">
    
        <?php if ( ! empty( $big_json ) && isset( $big_json->cases ) ) { ?>
        
        <div class="coronavirus-big-numbers">
        
            <div class="number-cases big-number">
                <span class="num" title="<?php echo esc_attr( $big_json->cases ); ?>"><?php echo fox_number( $big_json->cases, 2 ); ?></span>
                <span class="num-today"><?php echo '+' . fox_number( $big_json->todayCases ); ?> <?php echo esc_html__( 'today', 'wi' ); ?></span>
                <span class="num-label"><?php echo esc_html__( 'confirmed', 'wi' ); ?></span>
            </div>
            <div class="number-deaths big-number">
                <span class="num"><?php echo fox_number( $big_json->deaths, 2 ); ?></span>
                <span class="num-today"><?php echo '+' . fox_number( $big_json->todayDeaths ); ?> <?php echo esc_html__( 'today', 'wi' ); ?></span>
                <span class="num-label"><?php echo esc_html__( 'death', 'wi' ); ?></span>
            </div>
        
        </div><!-- .big-numbers -->
        
        <?php } ?>
        
        <?php if ( ! empty( $table_json ) ) { ?>
        
        <div class="coronavirus-table-outer">
            
            <div class="t-row-th">
                <div class="th th-name"><?php echo $name_label; ?></div>
                <div class="th th-case"><?php echo esc_html__( 'Cases' ,'wi' ); ?></div>
                <div class="th th-death"><?php echo esc_html__( 'Deaths' ,'wi' ); ?></div>
            </div>

            <div class="coronavirus-table-wrapper">

                <div class="coronavirus-table-container">

                    <div class="coronavirus-table">

                        <?php foreach ( $table_json as $row_json ) {
                        ?>

                        <div class="t-row">
                            <div class="td td-name"><?php echo $row_json->{$table_key}; ?></div>
                            <div class="td td-case"><?php echo fox_number( $row_json->cases ); ?></div>
                            <div class="td td-death"><?php echo fox_number( $row_json->deaths ); ?></div>
                        </div>

                        <?php } ?>

                    </div><!-- .coronavirus-table -->

                </div><!-- .coronavirus-table-container -->

            </div><!-- .coronavirus-table-wrapper -->
            
        </div><!-- .coronavirus-table-outer -->
        
        <?php } ?>
        
        <div class="coronavirus-source">
            
            <span><?php printf( esc_html__( 'Source: %s', 'wi' ), '<a href="https://github.com/CSSEGISandData/COVID-19" target="_blank">Johns Hopkins University</a>, <a href="https://github.com/nytimes/covid-19-data" target="_blank">New York Times</a>, <a href="https://www.worldometers.info/coronavirus/" target="_blank">Worldometers</a>' ); ?></span>
            
        </div>
        
    </div><!-- .coronavirus-inner -->

</div><!-- .fox-coronavirus -->

<?php echo $after_widget;