<?php
$fields = array(
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => esc_html__( 'Title', 'wi' ),
        'std' => '',
    ),
    [
        'id' => 'size',
        'type' => 'text',
        'placeholder' => 'Eg. 32',
        'name' => 'Icon container size',
    ],
    [
        'id' => 'font_size',
        'type' => 'text',
        'placeholder' => 'Eg. 17',
        'name' => 'Icon Size',
    ],
    [
        'id' => 'border_width',
        'type' => 'select',
        'options' => [
            '0px' => 'No border',
            '1px' => '1px',
            '2px' => '2px',
            '3px' => '3px',
        ],
        'std' => '0px',
        'name' => 'Border',
    ],
    [
        'id' => 'border_radius',
        'type' => 'text',
        'name' => 'Border radius',
        'placeholder' => 'Eg. 4px',
    ],
    [
        'id' => 'spacing',
        'type' => 'text',
        'name' => 'Spacing between icons',
        'placeholder' => 'Eg. 3px',
    ],
    /*
    array(
        'id' => 'style',
        'type' => 'select',
        'options' => [
            'plain'     => 'Plain Icons',
            'black'     => 'Black',
            'outline'   => 'Outline',
            'fill'      => 'Fill',
            'color'     => 'Brand Color',
        ],
        'name' => 'Style',
        'std' => 'black',
    ),
    
    array(
        'id' => 'shape',
        'type' => 'select',
        'options' => [
            'circle'     => 'Circle',
            'square'     => 'Square',
            'round'     => 'Round',
        ],
        'name' => 'Shape',
        'std' => 'shape',
    ),

    array(
        'id' => 'size',
        'type' => 'select',
        'options' => fox_social_size_support(),
        'name' => 'Size',
        'std' => 'normal',
    ),
    *
    
    array(
        'id' => 'spacing',
        'type' => 'select',
        'options' => fox_social_spacing_support(),
        'name' => 'Spacing between icons',
        'std' => 'small',
    ),
    */

    array(
        'id' => 'align',
        'type' => 'select',
        'options' => [
            'left'     => 'Left',
            'center'     => 'Center',
            'right'     => 'Right',
        ],
        'name' => 'Align',
        'std' => 'center',
    ),
    
    array(
        'id' => 'color',
        'type' => 'color',
        'name' => 'Icon color',
    ),
    
    array(
        'id' => 'background_color',
        'type' => 'color',
        'name' => 'Icon background',
    ),
    
    array(
        'id' => 'border_color',
        'type' => 'color',
        'name' => 'Icon border color',
    ),
    
    array(
        'id' => 'hover_color',
        'type' => 'color',
        'name' => 'Icon hover color',
    ),
    
    array(
        'id' => 'hover_background_color',
        'type' => 'color',
        'name' => 'Icon hover background',
    ),
    
    array(
        'id' => 'hover_border_color',
        'type' => 'color',
        'name' => 'Icon hover border color',
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