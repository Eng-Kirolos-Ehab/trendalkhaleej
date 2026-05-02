<?php
$fox56_customize->add_section( 'single_authorbox', [
    'title' => 'Author box',
    'panel' => 'single',
]);

/*
$fox56_customize->add_partial( 'single_authorbox',[
    'selector' => ".authorboxes56",
    'render_callback' => 'fox56_authorbox_inner',
]);
*/

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'authorbox_display',
    'section' => 'single_authorbox',
    'name' => 'Enable author box',
    'std' => true,
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'authorbox_style',
    'name' => 'Style',
    'options' => [
        'simple' => 'Simple',
        'box' => 'Box + tab',
    ],
    'std' => 'simple',
    // 'refresh' => 'single_authorbox',

    'hint' => 'author box style',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'authorbox_width',
    'options'   => [
        'full' => 'Full',
        'narrow' => 'Narrow',
    ],
    'std'       => 'narrow',
    'name'      => 'Author box width',
    // 'refresh' => 'single_authorbox',
]);

$fox56_customize->add_field([
    'id' => 'authorbox_padding',
    'type' => 'group',
    'hint' => 'authorbox padding',
    'fields' => [
        'desktop' => [
            'type' => 'text',
            'name' => 'Desktop',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'text',
            'name' => 'Tablet',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'text',
            'name' => 'Mobile',
            'min' => 0,
            'max' => 100,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => '',
        'tablet' => '',
        'mobile' => '',
    ],
    'title' => 'Author box padding',
    'css' => [
        [
            'property' => 'padding',
            'selector' => '.authorbox56',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding',
            'selector' => '.authorbox56',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding',
            'selector' => '.authorbox56',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    
]);

$fox56_customize->add_field([
    'id' => 'authorbox_color',
    'type' => 'color',
    'hint' => 'authorbox text color',
    'title' => 'Author box text color',
    'css' => [
        [
            'property' => 'color',
            'selector' => '.authorbox56',
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'authorbox_background',
    'type' => 'color',
    'hint' => 'authorbox background',
    'title' => 'Author box background',
    'css' => [
        [
            'property' => 'background',
            'selector' => '.authorbox56',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'authorbox_border',
    'title' => 'Author box border',
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
            'selector' => '.authorbox56',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.authorbox56',
            'property' => 'border-right-width',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => '.authorbox56',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.authorbox56',
            'property' => 'border-left-width',
            'unit' => 'px',
            'use' => 'left',
        ],
        [
            'selector' => '.authorbox56',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ],
]);

/* avatar
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'authorbox_avatar_width',
    'name' => 'Avatar width',
    'hint' => 'author box avatar width',
    'heading' => 'Avatar',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'col' => '2-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 90,
        'mobile' => 54,
    ],
    'css' => [
        [
            'selector' => '.authorbox56__avatar',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.authorbox56__text',
            'property' => 'width',
            'value_pattern' => 'calc(100% - $)',
            'unit' => 'px',
            'use' => 'desktop',
        ],

        [
            'selector' => '.authorbox56__avatar',
            'property' => 'width',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        [
            'selector' => '.authorbox56__text',
            'property' => 'width',
            'value_pattern' => 'calc(100% - $)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'authorbox_avatar_shape',
    'type'      => 'select',
    'options'   => [
        'circle' => 'Circle',
        'round' => 'Round',
        'square' => 'Square simple',
        'acute' => 'Square with border',
    ],
    'std'       => 'circle',
    'name'      => 'Author avatar shape',
    // 'refresh'   => 'single_authorbox',
]);

/* title desc
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'authorbox_title_desc_spacing',
    'name' => 'Author name - description spacing',
    'css' => [
        [
            'selector' => '.authorbox56__name',
            'property' => 'margin-bottom',
            'unit' => 'px',
        ],
    ],
    'std' => 10,

    'heading' => 'Author name, bio text',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'authorbox_title_typography',
    'name' => 'Author name font',
    'selector' => '.authorbox56__name',
    'hint' => 'author box title font',

    'std' => [
        'size' => '1.3em',
        'weight' => '700',
    ],
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'authorbox_description_typography',
    'name' => 'Author bio font',
    'selector' => '.authorbox56__description',
    'std' => [
        'line_height' => '1.4',
    ],
    'hint' => 'author box description font',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'authorbox_social_size',
    'name' => 'Author social icon size',
    'css' => [
        [
            'selector' => '.authorbox56 .fox56-social-list a',
            'property' => 'font-size',
            'unit' => 'px',
        ],
        [
            'selector' => '.authorbox56 .fox56-social-list a',
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(1.7 * $)',
        ],
        [
            'selector' => '.authorbox56 .fox56-social-list a',
            'property' => 'height',
            'unit' => 'px',
            'value_pattern' => 'calc(1.7 * $)',
        ],
    ],
]);