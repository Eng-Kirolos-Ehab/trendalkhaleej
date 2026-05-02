<?php
$fox56_customize->add_section( 'design_blockquote',[
    'title' => 'Blockquote',
    'panel' => 'design'
]);

/* ---------------------------------------------        BLOCKQUOTE */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'blockquote_typography',
    'name' => 'Blockquote font',
    'std' => [
        'face' => 'var(--font-body)',
        'variant' => 'italic',
        'spacing' => 0,
        'transform' => 'none',
        'line_height' => '',
        'size' => 20,
        'size_mobile' => 16,
    ],
    'selector' => 'blockquote',
    'hint' => 'blockquote font',

    'section' => 'design_blockquote',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'blockquote_color',
    'title' => 'Blockquote text color',
    'hint' => 'blockquote color',
    'css' => [
        [
            'selector' => 'blockquote',
            'property' => 'color',
        ]
    ],
]);

// fox56_typo_migrate( $fox56_customize, 'blockquote', 'elements', 'Elements' );

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'blockquote_background',
    'title' => 'Blockquote background',
    'hint' => 'blockquote background',
    'css' => [
        [
            'selector' => 'blockquote',
            'property' => 'background',
        ]
    ]
]);

$fox56_customize->add_field([
    'id' => 'blockquote_padding',
    'type' => 'group',
    'hint' => 'blockquote padding',
    'fields' => [
        'desktop' => [
            'type' => 'text',
            'name' => 'Desktop',
            'col' => '2-5',
        ],
        'tablet' => [
            'type' => 'text',
            'name' => 'Tablet',
            'col' => '2-5',
        ],
        'mobile' => [
            'type' => 'text',
            'name' => 'Mobile',
            'col' => '1-5',
        ],
    ],
    'std' => [
        'desktop' => '',
        'tablet' => '',
        'mobile' => '',
    ],
    'title' => 'Blockquote padding',
    'desc' => 'Note: padding css is written in order:<br> Top Right Bottom Left. Eg. <pre>1.25em 1em 1.25em 1em</pre>',
    'css' => [
        [
            'property' => 'padding',
            'selector' => 'blockquote',
            'unit' => 'px',
            'use' => 'desktop',
            'col' => '2-5',
        ],
        [
            'property' => 'padding',
            'selector' => 'blockquote',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
            'col' => '2-5',
        ],
        [
            'property' => 'padding',
            'selector' => 'blockquote',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
            'col' => '1-5',
        ],
    ],
    
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'blockquote_align',
    'title' => 'Blockquote align',
    'hint' => 'blockquote align',
    'css' => [
        [
            'selector' => 'blockquote',
            'property' => 'text-align',
        ]
    ],
    'std' => '',
    'options' => [
        '' => 'Default',
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ]
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'blockquote_border',
    'title' => 'Blockquote border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-5',
        ],
        'right' => [
            'name' => 'Right',
            'type' => 'number',
            'col' => '1-5',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-5',
        ],
        'left' => [
            'name' => 'Left',
            'type' => 'number',
            'col' => '1-5',
        ],
        'color' => [
            'name' => 'Color',
            'type' => 'color',
            'col' => '1-5',
        ]
    ],
    'std' => [
        'top' => 0,
        'right' => 0,
        'bottom' => 0,
        'left' => 0,
        'color' => '',
    ],
    'css' => [
        [
            'selector' => 'blockquote',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => 'blockquote',
            'property' => 'border-right-width',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => 'blockquote',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => 'blockquote',
            'property' => 'border-left-width',
            'unit' => 'px',
            'use' => 'left',
        ],
        [
            'selector' => 'blockquote',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'blockquote_icon',
    'title' => 'Blockquote icon',
    'hint' => 'blockquote icon',
    'options' => [
        'none' => 'None',
        'above' => 'Above text',
        'overlay' => 'Overlap text',
    ],
    'std' => 'none',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'blockquote_icon_icon',
    'title' => 'Choose blockquote icon',
    'options' => [
        'none' => 'None',
        'above' => 'Above text',
        'overlay' => 'Overlap text',
    ],
    'condition' => [
        'blockquote_icon' => [ 'above', 'overlay' ],
    ],
    'std' => '1',
    'options' => [
        '1' => get_template_directory_uri() . '/images/quote.png',
        '2' => get_template_directory_uri() . '/images/quote2.png',
        '3' => get_template_directory_uri() . '/images/quote3.png',
        '4' => get_template_directory_uri() . '/images/quote4.png',
    ],
]);