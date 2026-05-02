<?php
$fox56_customize->add_section( 'design_content_link',[
    'title' => 'Post content link',
    'panel' => 'design'
]);

/* content link style
------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'content_link_style',
    'std' => '1',
    'options'   => array(
        '1' => 'Grey underline',
        '2' => 'Same color underline',
        '3' => 'Black underline',
        '4' => 'Custom',
    ),
    'refresh' => 'single',
    'hint' => 'single content link style',
    'name' => 'Content link style',

    'section' => 'design_content_link',
]);

$fox56_customize->add_field([
    'type' => 'tabs',
    'tabs' => [
        'normal' => 'Normal',
        'hover' => 'Hover',
    ],
    'id' => 'content_link_style__tabs',

    'condition' => [ 'content_link_style' => '4' ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'content_link_color',
    'name' => 'Link color',
    'css' => [
        [
            'selector' => '.single56--link-4 .single56__content a',
            'property' => 'color',
        ]
    ],

    'tabs' => 'content_link_style__tabs',
    'tab' => 'normal',

    'condition' => [ 'content_link_style' => '4' ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'content_link_decoration',
    'name' => 'Text decoration',
    'css' => [
        [
            'selector' => '.single56--link-4 .single56__content a',
            'property' => 'text-decoration',
            'use' => 'decoration',
        ],
        [
            'selector' => '.single56--link-4 .single56__content a',
            'property' => 'text-decoration-color',
            'use' => 'color',
        ],
        [
            'selector' => '.single56--link-4 .single56__content a',
            'property' => 'text-decoration-thickness',
            'use' => 'thickness',
            'unit' => 'px',
        ],
    ],
    'fields' => [
        'decoration' => [
            'type' => 'select',
            'options' => [
                'none' => 'None',
                'underline' => 'Underline',
                'line-through' => 'Line through',
            ],
            'name' => 'Underline',
            'col' => '2-5',
        ],
        'thickness' => [
            'type' => 'number',
            'name' => 'Thickness',
            'std' => '1',
            'col' => '2-5',
        ],
        'color' => [
            'type' => 'color',
            'name' => 'Color',
            'col' => '1-5',
        ],
    ],
    'std' => [
        'decoration' => 'none',
        'color' => '',
        'thickness' => '1',
    ],

    'tabs' => 'content_link_style__tabs',
    'tab' => 'normal',
    'condition' => [ 'content_link_style' => '4' ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'content_link_hover_color',
    'name' => 'Link hover color',
    'css' => [
        [
            'selector' => '.single56--link-4 .single56__content a:hover',
            'property' => 'color',
        ]
    ],

    'tabs' => 'content_link_style__tabs',
    'tab' => 'hover',
    'condition' => [ 'content_link_style' => '4' ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'content_link_hover_decoration',
    'name' => 'Link hover text decoration',
    'css' => [
        [
            'selector' => '.single56--link-4 .single56__content a:hover',
            'property' => 'text-decoration',
            'use' => 'decoration',
        ],
        [
            'selector' => '.single56--link-4 .single56__content a:hover',
            'property' => 'text-decoration-color',
            'use' => 'color',
        ],
        [
            'selector' => '.single56--link-4 .single56__content a:hover',
            'property' => 'text-decoration-thickness',
            'use' => 'thickness',
            'unit' => 'px',
        ],
    ],
    'fields' => [
        'decoration' => [
            'type' => 'select',
            'options' => [
                'none' => 'None',
                'underline' => 'Underline',
                'line-through' => 'Line through',
            ],
            'name' => 'Underline',
            'col' => '2-5',
        ],
        'thickness' => [
            'type' => 'number',
            'name' => 'Thickness',
            'std' => '1',
            'col' => '2-5',
        ],
        'color' => [
            'type' => 'color',
            'name' => 'Color',
            'col' => '1-5',
        ],
    ],
    'std' => [
        'decoration' => 'none',
        'color' => '',
        'thickness' => '1',
    ],

    'tabs' => 'content_link_style__tabs',
    'tab' => 'hover',
    'condition' => [ 'content_link_style' => '4' ],
]);