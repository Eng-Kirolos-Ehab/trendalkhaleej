<?php
$fields = [];
    
$fields[] = [
    'id' => 'text',
    'type' => 'text',
    'name' => 'Button',
    'std' => 'Click here',
    'translate' => 1,
];
$fields[] = [
    'id' => 'url',
    'type' => 'text',
    'name' => 'URL',
    'translate' => 1,
];

$fields[] = [
    'id' => 'target',
    'type' => 'select',
    'name' => 'Open link in',
    'options' => [
        '_self' => 'Current tab',
        '_blank' => 'New tab',
    ],
    'std' => '_self',
];

$fields[] = [
    'id' => 'icon',
    'name' => 'Icon',
    'type' => 'text',
    'desc' => 'Enter fontawesome icon from <a href="https://fontawesome.com/icons/" target="_blank">this list</a> or feather icon from <a href="https://feathericons.com/" target="_blank">this list</a>',
    'placeholder' => 'Eg. arrow-right',
];

$fields[] = [
    'id' => 'size',
    'name' => 'Size',
    'type' => 'select',
    'options' => array(
        'tiny' => 'Tiny',
        'small' => 'Small',
        'normal' => 'Normal',
        'medium' => 'Medium',
        'large' => 'Large',
    ),
    'std' => 'normal',
];

$fields[] = [
    'id' => 'style',
    'name' => 'Style',
    'type' => 'select',
    'options' => array(
        'primary' => 'Primary',
        'outline' => 'Outline',
        'fill' => 'Fill',
        'black' => 'Black',
    ),
    'std' => 'black',
];

$fields[] = [
    'id' => 'border_width',
    'name' => 'Border Width',
    'type' => 'select',
    'options' => array(
        '' => 'Default',
        '0' => 'None',
        '1px' => '1px',
        '2px' => '2px',
        '3px' => '3px',
        '4px' => '4px',
        '5px' => '5px',
    ),
    'std' => '',
];

$fields[] = [
    'id' => 'shape',
    'name' => 'Shape',
    'type' => 'select',
    'options' => array(
        'square' => 'Square',
        'round' => 'Round',
        'pill' => 'Pill',
    ),
    'std' => 'square',
];

$fields[] = [
    'id' => 'align',
    'name' => 'Align',
    'type' => 'select',
    'options' => array(
        'inline' => 'Inline',
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ),
    'std' => 'inline',
];

$fields[] = [
    'id' => 'block',
    'name' => 'Block Button',
    'type' => 'select',
    'options' => array(
        'none' => 'None',
        'full' => 'Full-width',
        'half' => 'Half-width',
        'third' => 'Third-width',
    ),
    'std' => 'none',
];

$fields[] = [
    'id' => 'extra_class',
    'name' => 'Extra Class',
    'type' => 'text',
    'desc' => 'Enter your custom CSS class',
];

$fields[] = [
    'id' => 'attr',
    'name' => 'Additional Attributes',
    'type' => 'textarea',
    'desc' => 'Enter your custom attributes here. Make sure you know what you are doing.',
];

/**
 * Custom Color Options
 */
$fields[] = [
    'id' => 'text_color',
    'name' => 'Text Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'bg_color',
    'name' => 'Background Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'border_color',
    'name' => 'Border Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'text_color_hover',
    'name' => 'Hover Text Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'bg_color_hover',
    'name' => 'Hover Background Color',
    'type' => 'color',
];

$fields[] = [
    'id' => 'border_color_hover',
    'name' => 'Hover Border Color',
    'type' => 'color',
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
