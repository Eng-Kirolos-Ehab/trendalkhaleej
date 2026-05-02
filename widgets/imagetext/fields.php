<?php
$fields = [];
$fields[] = [
    'id' => 'title',
    'type' => 'text',
    'name' => 'Widget Title',
];

$fields[] = [
    'id' => 'layout',
    'type' => 'select',
    'options' => [
        'imagetop' => 'Image top',
        'imageleft' => 'Image left',
    ],
    'std' => 'imagetop',
    'name' => 'Layout',
];

$fields[] = [
    'id' => 'align',
    'type' => 'select',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'center',
    'name' => 'Align',
];

$fields[] = [
    'id' => 'image',
    'type' => 'image',
    'name' => 'Upload image',
    'translate' => 1,
];

$fields[] = [
    'id' => 'image_size',
    'type' => 'select',
    'options' => [
        'thumbnail' => 'Thumbnail (150x150)',
        'medium' => 'Medium',
        'large' => 'Large',
        'full' => 'Full',
        'thumbnail-medium' => 'Medium (480x384)',
        'thumbnail-square' => 'Square (480x480)',
        'thumbnail-portrait' => 'Portrait (480x600)',
        'thumbnail-large' => 'Landscape (720x480)'
    ],
    'std' => 'medium',
    'name' => 'Image size',
];

$fields[] = [
    'id' => 'image_width',
    'type' => 'text',
    'placeholder' => 'Eg. 240px',
    'name' => 'Image width',
];

$fields[] = [
    'id' => 'image_shape',
    'type' => 'select',
    'options' => [
        'acute' => 'Acute',
        'round' => 'Round',
        'circle' => 'Circle',
    ],
    'std' => 'acute',
    'name' => 'Image shape',
];

$fields[] = [
    'id' => 'heading',
    'placeholder' => 'Eg. About me',
    'type' => 'text',
    'name' => 'Heading text',
    'translate' => 1,
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
    'id' => 'description',
    'type' => 'textarea',
    'name' => 'Description',
    'translate' => 1,
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
