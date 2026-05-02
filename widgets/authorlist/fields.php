<?php
$fields = array(
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => esc_html__( 'Title', 'wi' ),
        'std' => 'Authors',
    ),
    
    array(
        'id' => 'number',
        'name' => esc_html__( 'Number', 'wi' ),
        'type' => 'text',
        'std' => '3',
    ),
    
    array(
        'id' => 'orderby',
        'name' => esc_html__( 'Order by', 'wi' ),
        'type' => 'select',
        'options' => array(
            'name' => esc_html__( 'Name', 'wi' ),
            'post_count' => esc_html__( 'Post Count', 'wi' ),
            'registered' => esc_html__( 'Time of registration', 'wi' ),
        ),
        'std' => 'name',
    ),
    
    array(
        'id' => 'order',
        'name' => esc_html__( 'Order', 'wi' ),
        'type' => 'select',
        'options' => array(
            'DESC' => esc_html__( 'Descending', 'wi' ),
            'ASC' => esc_html__( 'Ascending', 'wi' ),
        ),
        'std' => 'ASC',
    ),
    
    array(
        'id' => 'include',
        'name' => esc_html__( 'Author IDs', 'wi' ),
        'type' => 'text',
        'desc' => 'By this field, you can display only authors with IDs specified.',
    ),
    
    array(
        'id' => 'style',
        'name' => esc_html__( 'Style', 'wi' ),
        'type' => 'select',
        'options' => array(
            'list' => esc_html__( 'List', 'wi' ),
            'grid' => esc_html__( 'Grid', 'wi' ),
        ),
        'std' => 'list',
    ),
    
    array(
        'id' => 'column',
        'name' => 'Grid Column',
        'type' => 'select',
        'options' => array(
            '2' => '2 columns',
            '3' => '3 columns',
            '4' => '4 columns',
        ),
        'std' => '4',
    ),
    
    array(
        'id' => 'meta',
        'name' => esc_html__( 'Display after title:', 'wi' ),
        'desc' => esc_html__( 'This option only applies for list style', 'wi' ),
        'type' => 'select',
        'options' => array(
            'post' => esc_html__( 'The last post', 'wi' ),
            'desc' => esc_html__( 'Author description', 'wi' ),
        ),
        'std' => 'post',
    ),
    
    array(
        'id' => 'avatar_shape',
        'name' => 'Avatar shape',
        'type' => 'select',
        'options' => array(
            'acute' => 'Acute',
            'round' => 'Round',
            'circle' => 'Circle',
        ),
        'std' => 'acute',
    ),
    
    array(
        'id' => 'avatar_color',
        'name' => 'Avatar color effect',
        'type' => 'select',
        'options' => array(
            'grayscale_color' => 'Grayscale >> color hover',
            'grayscale' => 'Grayscale',
            'color' => 'Natural Color',
            'color_grayscale' => 'Color >> grayscale hover'
        ),
        'std' => 'grayscale_color',
    ),
    
    array(
        'id' => 'list_sep',
        'name' => 'Seperator between list items',
        'desc' => 'This option only applies for list style',
        'type' => 'checkbox',
        'value' => 'true',
        'std' => 'true',
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