<?php
$fox56_customize->add_section( 'single_share', [
    'title' => 'Social share',
    'panel' => 'single',
]);

$fox56_customize->add_partial( "share",[
    'selector' => ".share56__outer",
    'render_callback' => 'fox56_share_inner',
]);

// since v6.8
$fox56_customize->add_field([
    'type' => 'multicheckbox',
    'options' => [
        'post_header' => 'Post header along meta',
        'before_content' => 'Before post content',
        'after_content' => 'After post content',
    ],
    'std' => [ 'after_content' ],
    'id' => 'share_display',
    'name' => 'Display social share:',
    'section' => 'single_share',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'options' => [
        'facebook' => 'Facebook',
        'twitter' => 'X (Former Twitter)',
        'telegram' => 'Telegram',
        'pinterest' => 'Pinterest',
        'linkedin' => 'Linkedin',
        'reddit' => 'Reddit',
        'whatsapp' => 'Whatsapp',
        'bluesky' => 'Bluesky',
        'threads' => 'Threads',
        'email' => 'Email',
    ],
    'std' => [ 'facebook', 'twitter', 'pinterest', 'whatsapp', 'email' ],
    'id' => 'share_elements',
    'name' => 'Elements',
    'refresh' => 'share',
    'hint' => 'Share icons',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'share_stretch',
    'options' => [
        'full' => get_template_directory_uri() . '/inc/customize/images/share-full.jpg',
        'inline' => get_template_directory_uri() . '/inc/customize/images/share-inline.jpg',
    ],
    'std' => 'inline',
    'name' => 'Stretch',
    'refresh' => 'share',
    'hint' => 'share stretch',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'left',
    'id' => 'share_align',
    'name' => 'Align',
    'condition' => [ 'share_stretch' => 'inline' ],
    'refresh' => 'share',
    'hint' => 'share align',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'share_label',
    'std' => '',
    'name' => 'Share label:',
    'refresh' => 'share',
    'condition' => [ 'share_stretch' => 'inline' ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'share_width',
    'std' => 32,
    'name' => 'Icon width',
    'hint' => 'share icon width',
    'css' => [
        [
            'selector' => '.share56--inline a',
            'property' => 'width',
            'unit' => 'px',
        ],
    ],
    'condition' => [ 'share_stretch' => 'inline' ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'share_height',
    'std' => 32,
    'name' => 'Icon height',
    'hint' => 'share icon height',
    'css' => [
        [
            'selector' => '.share56--inline a',
            'property' => 'height',
            'unit' => 'px',
        ],
        [
            'selector' => '.share56--full a',
            'property' => 'height',
            'unit' => 'px',
        ],
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'share_font_size',
    'std' => 16,
    'name' => 'Icon Size',
    'hint' => 'share icon font size',
    'css' => [
        [
            'selector' => '.share56 a',
            'property' => 'font-size',
            'unit' => 'px',
        ],
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'share_inline_border_radius',
    'std' => 30,
    'name' => 'Border radius',
    'hint' => 'share border radius',
    'css' => [
        [
            'selector' => '.share56--inline a',
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
    'condition' => [ 'share_stretch' => 'inline' ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'share_full_border_radius',
    'std' => 0,
    'name' => 'Border radius',
    'hint' => 'share border radius',
    'css' => [
        [
            'selector' => '.share56--full a',
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
    'condition' => [ 'share_stretch' => 'full' ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'share_spacing',
    'std' => 3,
    'hint' => 'share icon spacing',
    'name' => 'Icon Spacing',
    'css' => [
        [
            'selector' => '.share56--inline li + li',
            'property' => 'margin-left',
            'unit' => 'px',
        ],
        [
            'selector' => '.share56--full ul',
            'property' => 'column-gap',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'share_color_scheme',
    'name' => 'Color scheme',
    'hint' => 'share color scheme',
    'refresh' => 'share',
    'options' => [
        'brand' => 'Brand colors',
        'custom' => 'Custom colors',
    ],
    'std' => 'brand',
]);

$fox56_customize->add_field([
    'type' => 'tabs',
    'tabs' => [
        'normal' => 'Normal',
        'hover' => 'Hover',
    ],
    'id' => 'share__tabs',
    'condition' => [ 'share_color_scheme' => 'custom' ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'share_color',
    'name' => 'Icon Color',
    'hint' => 'share icon color',
    'css' => [
        [
            'selector' => '.share56--custom a',
            'property' => 'color',
        ]
    ],
    'condition' => [ 'share_color_scheme' => 'custom' ],
    
    'tabs' => 'share__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'share_background',
    'hint' => 'share icon background',
    'name' => 'Icon background',
    'css' => [
        [
            'selector' => '.share56--custom a',
            'property' => 'background',
        ]
    ],
    'condition' => [ 'share_color_scheme' => 'custom' ],

    'tabs' => 'share__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'std' => 0,
    'id' => 'share_border_width',
    'hint' => 'share icon border',
    'name' => 'Icon border size',
    'css' => [
        [
            'selector' => '.share56--custom a',
            'property' => 'border-width',
            'unit' => 'px',
        ]
    ],
    'condition' => [ 'share_color_scheme' => 'custom' ],

    'tabs' => 'share__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'share_border_color',
    'hint' => 'share icon border color',
    'name' => 'Icon border color',
    'css' => [
        [
            'selector' => '.share56--custom a',
            'property' => 'border-color',
        ]
    ],
    'condition' => [ 'share_color_scheme' => 'custom' ],

    'tabs' => 'share__tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'share_hover_color',
    'hint' => 'share icon hover color',
    'name' => 'Icon hover color',
    'css' => [
        [
            'selector' => '.share56--custom a:hover',
            'property' => 'color',
        ]
    ],
    'condition' => [ 'share_color_scheme' => 'custom' ],

    'tabs' => 'share__tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'share_hover_background',
    'name' => 'Icon hover background',
    'hint' => 'share icon hover background',
    'css' => [
        [
            'selector' => '.share56--custom a:hover',
            'property' => 'background',
        ]
    ],
    'condition' => [ 'share_color_scheme' => 'custom' ],

    'tabs' => 'share__tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'share_hover_border_color',
    'hint' => 'share icon border color',
    'name' => 'Icon hover border color',
    'css' => [
        [
            'selector' => '.share56--custom a:hover',
            'property' => 'border-color',
        ]
    ],
    'condition' => [ 'share_color_scheme' => 'custom' ],

    'tabs' => 'share__tabs',
    'tab' => 'hover',
]);