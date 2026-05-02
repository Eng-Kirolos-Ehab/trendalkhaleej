<?php
extract( $args );
extract( wp_parse_args( $instance, array(
    'title' => '',
    'number' => '4',
    'orderby' => '',
    'order' => '',
    'include' => '',
    'meta' => '',
    'style' => 'list',
    'column' => '4',
    'avatar_shape' => 'acute',
    'avatar_color' => 'grayscale_color',
    'list_sep' => true,
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

if ( 'DESC' !== $order ) $order = 'ASC';
if ( 'registered' !== $orderby && 'post_count' !== $orderby ) $orderby = 'name';
$args = array(
    'number' => $number,
    'has_published_posts' => true,
    'orderby' => $orderby,
    'order' => $order,
);

$include = trim( $include );
if ( $include ) {
    $include = explode( ',', $include );
    $include = array_map( 'intval', $include );
    $args[ 'include' ] = $include;
    $args[ 'orderby' ] = 'include';
    $args[ 'order' ] = 'ASC';
}

$authors = get_users( $args );
if ( ! $authors ) return;

/* Style
-------------------- */
$class = array();
if ( 'grid' !== $style ) $style = 'list';
$class[] = 'widget-author-' . $style;

// column
if ( 'grid' == $style ) {
    $class[] = 'column-' . $column;
}

// avatar shape
// since 4.4.2
if ( 'round' != $avatar_shape && 'circle' != $avatar_shape ) {
    $avatar_shape = 'acute';
}
$class[] = 'authors-avatar--' . $avatar_shape;

// avatar color
if ( ! in_array( $avatar_color, [ 'grayscale', 'color', 'color_grayscale' ] ) ) {
    $avatar_color = 'grayscale_color';
}
if ( 'grayscale' == $avatar_color || 'grayscale_color' == $avatar_color ) {
    $class[] = 'authors-avatar--grayscale';
}
if ( 'grayscale_color' == $avatar_color ) {
    $class[] = 'authors-avatar--hover-color';
}
if ( 'color_grayscale' == $avatar_color ) {
    $class[] = 'authors-avatar--hover-grayscale';
}

// list sep, since 4.4.2
if ( 'list' == $style ) {
    
    if ( $list_sep ) {
        $class[] = 'authors-has-sep';
    }
    
} 

?>

<div class="<?php echo esc_attr( join( ' ', $class ) ); ?>">

    <ul class="author-list">
        
        <?php foreach ( $authors as $author ) { ?>
    
        <li class="author-list-item">
            
            <div class="author-list-item-avatar">
                
                <a href="<?php echo get_author_posts_url( $author->ID, $author->nicename ); ?>" title="<?php echo esc_attr( $author->display_name ); ?>" role="tooltip" aria-label="<?php echo esc_attr( $author->display_name ); ?>" data-microtip-position="top">
            
                    <?php echo get_avatar( $author->ID, 150, '', $author->display_name ); ?>

                </a>
                
            </div><!-- .author-list-item-avatar -->
            
            <?php if ( 'list' === $style ) { ?>
            
            <div class="author-list-item-text">
                
                <h3 class="author-list-item-name">
                    
                    <a href="<?php echo get_author_posts_url( $author->ID, $author->nicename ); ?>"><?php echo get_the_author_meta( 'display_name', $author->ID ); ?></a>
                    
                </h3><!-- .author-list-item-name -->

                <?php if ( 'desc' === $meta ) { if ( $author->description ) { ?>
                
                <div class="author-list-item-description">
                    
                    <?php echo do_shortcode( get_the_author_meta( 'description', $author->ID ) ); ?>
                    
                </div>
                
                <?php } } else {
                
                    $args = array(
                        'author'        =>  $author->ID,
                        'orderby'       =>  'post_date',
                        'order'         =>  'DESC',
                        'posts_per_page' => 1
                    );
                    $author_query = new WP_Query( $args );
                    if ( $author_query->have_posts() ) {
                
                ?>
                
                <div class="author-list-item-posts">
                    
                    <?php while( $author_query->have_posts() ) { $author_query->the_post(); ?>
                    
                    <a class="author-list-item-post-name" href="<?php echo fox56_permalink(); ?>"><?php the_title(); ?></a>
                
                    <?php } // endwhile ?>
                    
                </div><!-- .author-list-item-posts -->
                
                <?php } // have posts ?>
                
                <?php wp_reset_query(); } // meta after title ?>
            
            </div><!-- .author-list-item-text -->
            
            <?php } // style list ?>
        
        </li><!-- .author-list-item -->
        
        <?php } ?>
        
    </ul><!-- .author-list -->

</div><!-- .widget-author-list -->

<?php echo $after_widget;