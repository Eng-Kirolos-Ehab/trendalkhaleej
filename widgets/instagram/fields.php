<?php
$fields = array();
    
$fields[] = array(
    'id' => 'title',
    'type' => 'text',
    'name' => esc_html__( 'Title', 'wi' ),
    'std' => '',
);

$fields[] = array(
    'id' => 'feed_id',
    'type' => 'text',
    'name' => 'Feed ID',
    'desc' => 'Since version 6.0, Feed ID is required. Normally, your feed ID is 1. If It\'s not the case, please check <a href="' . get_admin_url( '', 'admin.php?page=sbi-feed-builder' ) . '" target="_blank">your feed list</a> to see what is your feed ID.',
    'std' => '1',
    'translate' => 1,
);

/*
$numbers = array( '1' => esc_html__( '1 Photo', 'wi' ) );
for ( $i = 2; $i <= 12; $i++ ) {
    $numbers[ (string) $i ] = sprintf( esc_html__( '%d Photos', 'wi' ), $i );
}

$columns = array( '1' => esc_html__( '1 Column', 'wi' ) );
for ( $i = 2; $i <= 9; $i++ ) {
    $columns[ (string) $i ] = sprintf( esc_html__( '%d Columns', 'wi' ), $i );
}

$fields[] = array(
    'id' => 'number',
    'type' => 'select',
    'options'=> $numbers,
    'std'   => '9',
    'name' => esc_html__( 'Number of photos', 'wi' ),
);

$fields[] = array(
    'id' => 'column',
    'type' => 'select',
    'options'=> $columns,
    'std'   => '3',
    'name' => esc_html__( 'Columns?', 'wi' ),
);

$fields[] = array(
    'id' => 'item_spacing',
    'type' => 'select',
    'name' => 'Item Spacing',
    'std' => 'tiny',
    'options' => [
        'none' => 'No spacing',
        'tiny' => 'Tiny',
        'small' => 'Small',
        'normal' => 'Normal',
        'wide' => 'Wide',
        'wider' => 'Wider',
    ],
);
*/

$fields[] = [
    'id' => 'hover_style',
    'type' => 'select',
    'options' => [
        'none' => 'None',
        'fade' => 'Fade',
        'border' => 'Border',
    ],
    'std'   => 'none',
    'name'  => 'Hover style',
];

/*
$fields[] = array(
    'id' => 'show_header',
    'type' => 'checkbox',
    'std' => true,
    'name' => 'Show Header?',
);
*/

$fields[] = array(
    'id' => 'heading_text',
    'type' => 'text',
    'placeholder' => 'WiThemes',
    'name' => 'Heading Text',
    'translate' => 1,
);

$fields[] = array(
    'id' => 'heading_text_icon',
    'type' => 'checkbox',
    'std' => true,
    'name' => 'Instagram Icon?',
);

$fields[] = array(
    'id' => 'heading_subtitle',
    'type' => 'text',
    'name' => 'Heading text subtitle',
    'placeholder' => 'Follow us on Instagram',
    'translate' => 1,
);

$fields[] = array(
    'id' => 'profile_url',
    'type' => 'text',
    'placeholder' => 'https://instagram.com/your_username/',
    'name' => 'Instagram Profile URL',
    'translate' => 1,
);

$fields[] = array(
    'id' => 'follow_text',
    'type' => 'text',
    'std'   => esc_html__( 'Follow Us', 'wi' ),
    'name'  => esc_html__( 'Follow Text', 'wi' ),
    'translate' => 1,

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