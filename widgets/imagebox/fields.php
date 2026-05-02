<?php
$fields = [];
$fields[] = [
    'id' => 'title',
    'type' => 'text',
    'name' => 'Title',
];

$fields[] = [
    'id' => 'style',
    'type' => 'select',
    'options' => [
        '1' => 'Style 1',
        '2' => 'Style 2',
        '3' => 'Style 3',
    ],
    'std' => '1',
    'name' => 'Style',
];

$fields[] = [
    'id' => 'image',
    'type' => 'image',
    'name' => 'Upload image',
    'translate' => 1,
];

$fields[] = [
    'id' => 'name',
    'type' => 'text',
    'name' => 'Imagebox name',
    'placeholder' => 'Eg. About Me',
    'translate' => 1,
];

$fields[] = [
    'id' => 'text_position',
    'type' => 'select',
    'name' => 'Text position',
    'options' => [
        'top' => 'Top',
        'middle' => 'Middle',
        'bottom' => 'Bottom',
    ],
    'std' => 'middle',
    'desc' => 'This option works with style 1, 2'
];

$fields[] = [
    'id' => 'url',
    'type' => 'text',
    'name' => 'URL',
    'placeholder' => 'https://',
    'translate' => 1,
];

$fields[] = [
    'id' => 'target',
    'type' => 'select',
    'name' => 'Open URL in',
    'options' => [
        '_self' => 'Current tab',
        '_blank' => 'New tab',
    ],
    'std' => '_self',
];

$fields[] = [
    'id' => 'ratio',
    'type' => 'text',
    'name' => 'Ratio (W:H)',
    'placeholder' => 'Eg. 2:1',
    'desc' => 'Enter ratio in syntax "W : H", eg. 2:1',
];

$fields[] = [
    'id' => 'overlay',
    'type' => 'color',
    'name' => 'Overlay color',
];

$fields[] = [
    'id' => 'overlay_opacity',
    'type' => 'text',
    'name' => 'Overlay opacity',
    'desc' => 'Enter value between 0 - 1, eg. 0.7',
    'placeholder' => 'Eg. 0.5',
];

$fields[] = [
    'id' => 'inner_border',
    'type' => 'checkbox',
    'name' => 'Inner Border?',
];

$fields[] = [
    'id' => 'hover_effect',
    'type' => 'select',
    'name' => 'Hover Effect?',
    'options' => [
        'none'  => 'None',
        'scale' => 'Image Scale',
        'slide' => 'Image Slide',
    ],
];


// ═══════════════════════════════════════════════════════════════
// RTL & TEXT ALIGNMENT SECTION
// ═══════════════════════════════════════════════════════════════

$fields[] = array(
    'id'   => 'rtl_section',
    'type' => 'heading',
    'name' => '━━━ RTL & Text Alignment ━━━',
);

$fields[] = array(
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
);

$fields[] = array(
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
);

$fields[] = array(
    'id'      => 'content_direction',
    'name'    => 'Content Direction',
    'type'    => 'select',
    'options' => array(
        'auto' => 'Auto (Follow Site)',
        'rtl'  => 'RTL (Right to Left)',
        'ltr'  => 'LTR (Left to Right)',
    ),
    'std'     => 'auto',
);

$fields[] = array(
    'id'      => 'items_direction',
    'name'    => 'Items Direction',
    'type'    => 'select',
    'options' => array(
        'auto'    => 'Auto',
        'normal'  => 'Normal (LTR)',
        'reverse' => 'Reverse (RTL)',
    ),
    'std'     => 'auto',
);

// ═══════════════════════════════════════════════════════════════
// BORDER SETTINGS
// ═══════════════════════════════════════════════════════════════

$fields[] = array(
    'id'   => 'border_section_rtl',
    'type' => 'heading',
    'name' => '━━━ Border Settings ━━━',
);

$fields[] = array(
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
);

$fields[] = array(
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
);

$fields[] = array(
    'id'          => 'rtl_border_color',
    'name'        => 'RTL Border Color',
    'type'        => 'text',
    'placeholder' => '#e0e0e0',
);

$fields[] = array(
    'id'          => 'rtl_border_width',
    'name'        => 'RTL Border Width (px)',
    'type'        => 'text',
    'placeholder' => '1',
);

$fields[] = array(
    'id'      => 'rtl_border_style',
    'name'    => 'RTL Border Style',
    'type'    => 'select',
    'options' => array(
        'solid'  => 'Solid',
        'dashed' => 'Dashed',
        'dotted' => 'Dotted',
    ),
    'std'     => 'solid',
);

// ═══════════════════════════════════════════════════════════════
// SPACING
// ═══════════════════════════════════════════════════════════════

$fields[] = array(
    'id'   => 'spacing_section_rtl',
    'type' => 'heading',
    'name' => '━━━ Spacing ━━━',
);

$fields[] = array(
    'id'          => 'widget_padding',
    'name'        => 'Widget Padding',
    'type'        => 'text',
    'placeholder' => '15px',
);

$fields[] = array(
    'id'          => 'item_spacing',
    'name'        => 'Item Spacing',
    'type'        => 'text',
    'placeholder' => '15px',
);

$fields[] = array(
    'id'          => 'column_gap',
    'name'        => 'Column Gap',
    'type'        => 'text',
    'placeholder' => '20px',
);
