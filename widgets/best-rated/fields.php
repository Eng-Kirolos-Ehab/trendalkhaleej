<?php
$cat_arr = array( '' => 'All' );
$categories = get_categories();
foreach ( $categories as $cat ) {
    $cat_arr[ strval( $cat->term_id ) ] = $cat->name;
}

$fields = array(
    
    array(
        'id' => 'deprecated_notice',
        'type' => 'html',
        'std' => '<div class="fox-notice fox-error"><strong>Deprecated Widget</strong>: This widget will continue to work but you should use "<strong>(FOX) Post List</strong>" widget. It also has option for displaying highest review score posts, and much more options.</div>',
    ),
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => esc_html__( 'Title', 'wi' ),
        'std' => 'Best Rated',
    ),
    
    array(
        'id' => 'number',
        'name' => esc_html__( 'Number of posts to show', 'wi' ),
        'std'   => 4,
        'type' => 'text',
    ),
    
    array(
        'id' => 'category',
        'name' => esc_html__( 'Category', 'wi' ),
        'type' => 'select',
        'options' => $cat_arr,
    ),
    
    array(
        'id' => 'tag',
        'name' => esc_html__( 'Tag', 'wi' ),
        'type' => 'text',
        'desc' => 'Enter tag IDs, separated by comma. You can find tag ID in your browser address bar when you edit a tag.',
    ),
    
    // since 2.8
    array(
        'id' => 'orderby',
        'name' => esc_html__( 'Orderby', 'wi' ),
        'type' => 'select',
        'options' => array(
            'score' => 'Highest Score',
            'date' => 'Recent Review',
        ),
    ),
    

    // ═══════════════════════════════════════════════════════════════
    // RTL & TEXT ALIGNMENT SECTION
    // ═══════════════════════════════════════════════════════════════
    
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
            'right'   => 'Right (للعربية)',
            'center'  => 'Center',
            'left'    => 'Left',
        ),
        'std'     => 'inherit',
        'desc'    => 'Control text alignment for this widget',
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
            'auto' => 'Auto (Follow Site)',
            'rtl'  => 'RTL (Right to Left)',
            'ltr'  => 'LTR (Left to Right)',
        ),
        'std'     => 'auto',
    ),
    
    array(
        'id'      => 'items_direction',
        'name'    => 'Items Direction',
        'type'    => 'select',
        'options' => array(
            'auto'    => 'Auto',
            'normal'  => 'Normal (LTR)',
            'reverse' => 'Reverse (RTL)',
        ),
        'std'     => 'auto',
        'desc'    => 'Control the order of items/columns',
    ),
    
    // ═══════════════════════════════════════════════════════════════
    // BORDER SETTINGS
    // ═══════════════════════════════════════════════════════════════
    
    array(
        'id'   => 'border_section',
        'type' => 'heading',
        'name' => '━━━ Border Settings ━━━',
    ),
    
    array(
        'id'      => 'border_between',
        'name'    => 'Border Between Items',
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
        'name'    => 'Widget Border',
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
        'name'        => 'Border Color',
        'type'        => 'text',
        'placeholder' => '#e0e0e0',
    ),
    
    array(
        'id'          => 'border_width',
        'name'        => 'Border Width (px)',
        'type'        => 'text',
        'placeholder' => '1',
        'std'         => '1',
    ),
    
    array(
        'id'      => 'border_style',
        'name'    => 'Border Style',
        'type'    => 'select',
        'options' => array(
            'solid'  => 'Solid',
            'dashed' => 'Dashed',
            'dotted' => 'Dotted',
        ),
        'std'     => 'solid',
    ),
    
    // ═══════════════════════════════════════════════════════════════
    // SPACING
    // ═══════════════════════════════════════════════════════════════
    
    array(
        'id'   => 'spacing_section',
        'type' => 'heading',
        'name' => '━━━ Spacing ━━━',
    ),
    
    array(
        'id'          => 'widget_padding',
        'name'        => 'Widget Padding',
        'type'        => 'text',
        'placeholder' => '15px',
        'desc'        => 'e.g., 15px or 10px 20px',
    ),
    
    array(
        'id'          => 'item_spacing',
        'name'        => 'Item Spacing',
        'type'        => 'text',
        'placeholder' => '15px',
    ),
    
    array(
        'id'          => 'column_gap',
        'name'        => 'Column Gap',
        'type'        => 'text',
        'placeholder' => '20px',
    ),

);