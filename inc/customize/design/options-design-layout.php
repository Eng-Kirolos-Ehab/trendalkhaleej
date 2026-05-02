<?php
$fox56_customize->add_section( 'design_layout', [
    'title' => 'Site layout & background',
    'panel' => 'design',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'container_width',
    'title' => 'Container width',
    'desc' => 'Enter numeric value like 1020. Default is 1080px. Percentage value is accepted but we do not recommend. If you wish to have a wide-content site, just use a big value like 1440. Max content width is 97% so It never exceeds the screenwidth despite of the value you enter.',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--content-width',
            'unit' => 'px',
        ],
        /*
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'width',
            'value_pattern' => 'calc($ + 60px)',
            'unit' => 'px',
        ],
        */
    ],
    'std' => 1080,
    'section' => 'design_layout',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'single_container_width',
    'title' => 'Container width for single post',
    'css' => [
        [
            'selector' => '.single .container--main',
            'property' => 'width',
            'unit' => 'px',
        ],
    ],
    'std' => '',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'sidebar_width',
    'std' => 265,
    'title' => 'Sidebar width',
    'css' => [
        [
            'selector' => '.secondary56',
            'property' => 'width',
            'unit' => 'px',
            'media_query' => '@media only screen and (min-width: 840px)',
        ],
        [
            'selector' => '.hassidebar > .container--main > .primary56',
            'property' => 'width',
            'unit' => 'px',
            'value_pattern' => 'calc(100% - $)',
            'media_query' => '@media only screen and (min-width: 840px)',
        ],
    ],
]);

$fox56_customize->add_field([
    'id' => 'sidebar_border',
    'type' => 'radio',
    'options' => [
        '0px' => 'No, thanks!',
        '1px' => 'Yes, please!'
    ],
    'std' => '0px',
    'name' => 'Content/sidebar separator line',
    'condition' => $condition,

    'css' => [
        [
            'selector' => '.secondary56 .secondary56__sep',
            'property' => 'border-left-width',
        ]
    ],
]);

$fox56_customize->add_field([
    'id' => 'sidebar_border_color',
    'type' => 'color',
    'name' => 'Sep color',
    'condition' => $condition,
    'css' => [
        [
            'selector' => '.secondary56 .secondary56__sep',
            'property' => 'border-left-color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'sticky_sidebar',
    'title' => 'Sticky sidebar?',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'sidebar_content_spacing',
    'title' => 'Sidebar content spacing',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--sidebar-content-spacing',
            'unit' => 'px',
        ]
    ],
    'std' => 32,
]);

/* ---------------------------------------------        boxed / wide */
$fox56_customize->add_field([
    'heading' => 'Body Background',
    'type' => 'background',
    'id' => 'body_background',
    'std' => [
        'size' => 'cover',
        'repeat' => 'no-repeat',
        'position' => 'center center',
        'attachment' => 'scroll',
    ],
    'selector' => 'body',

    'hint' => 'body background',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'body_border',
    'title' => 'Body border',
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
            'selector' => 'body',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => 'body',
            'property' => 'border-right-width',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => 'body',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => 'body',
            'property' => 'border-left-width',
            'unit' => 'px',
            'use' => 'left',
        ],
        [
            'selector' => 'body',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ],
]);

/* ---------------------------------------------        boxed */
$fox56_customize->add_field([
    'heading' => 'Boxed layout',
    'name' => 'Layout boxed?',
    'type' => 'checkbox',
    'id' => 'layout_boxed',
    'transport' => 'postMessage',

    'hint' => 'boxed layout',
]);

$fox56_customize->add_field([
    'name' => 'Inner top/bottom margin',
    'type' => 'number',
    'id' => 'inner_margin',
    'css' => [
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'margin-top',
            'unit' => 'px',
            'media_query' => '@media (min-width:1024px)',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'margin-bottom',
            'unit' => 'px',
            'media_query' => '@media (min-width:1024px)',
        ],
    ],
    'std' => 0,
    'condition' => [ 'layout_boxed' => true ],
]);

$fox56_customize->add_field([
    'name' => 'Inner top/bottom padding',
    'type' => 'number',
    'id' => 'inner_padding',
    'css' => [
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'padding-top',
            'unit' => 'px',
            'media_query' => '@media (min-width:1024px)',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'padding-bottom',
            'unit' => 'px',
            'media_query' => '@media (min-width:1024px)',
        ],
    ],
    'std' => 0,
    'condition' => [ 'layout_boxed' => true ],
]);

$fox56_customize->add_field([
    'name' => 'Inner background',
    'type' => 'background',
    'id' => 'inner_background',
    'std' => [
        'size' => 'cover',
        'repeat' => 'no-repeat',
        'position' => 'center center',
        'attachment' => 'scroll',
    ],
    'selector' => 'body.layout-boxed #wi-all',
    'condition' => [ 'layout_boxed' => true ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'inner_border',
    'title' => 'Inner border',
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
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-right-width',
            'unit' => 'px',
            'use' => 'right',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-left-width',
            'unit' => 'px',
            'use' => 'left',
        ],
        [
            'selector' => 'body.layout-boxed #wi-all',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ],
    'condition' => [ 'layout_boxed' => true ]
]);

$fox56_customize->add_field([
    'name' => 'Use hand-drawn border?',
    'type' => 'checkbox',
    'id' => 'hand_drawn',
    'condition' => [ 'layout_boxed' => true ],

    'hint' => 'hand drawn line border',
]);

/* ---------------------------------------------        mobile edge layout *
// experimental, todo later
$fox56_customize->add_field([
    'heading' => 'Mobile: Image stretch fullwidth',
    'name' => 'Stretch featured image to edge of screen?',
    'type' => 'checkbox',
    'id' => 'mobile_stretch_edge',
    'hint' => 'Mobile stretch image'
]);
*/