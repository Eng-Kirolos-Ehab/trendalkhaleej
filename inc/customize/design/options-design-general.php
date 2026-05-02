<?php
$fox56_customize->add_section( 'design_general', [
    'title' => 'General colors',
    'panel' => 'design',
]);

/* ---------------------------------------------        body font */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'text_color',
    'name' => 'Body text color',
    'css' => [
        [
            'selector' => 'body',
            'property' => 'color',
        ]
    ],
    'std' => '#000000',
    'section' => 'design_general',
]);


fox56_typo_migrate( $fox56_customize, 'body text', 'general', 'General' );

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'link_color',
    'name' => 'Link color',
    'css' => [
        [
            'selector' => 'a',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'link_hover_color',
    'name' => 'Link hover color',
    'css' => [
        [
            'selector' => 'a:hover',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'message',
    'id' => 'link_color_msg',
    'msg' => 'This is the general link color option. If you want to change post content link color/underline style, please go to <a href="' . fox56_link_to_section('single_body') . '">Customize &raquo; Single &raquo; Single area: content</a>',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'border_color',
    'name' => 'General border color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--border-color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'accent_color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--accent-color',
        ]
        ],
    'name' => 'Accent color',
    'hint' => 'accent/primary color',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'selection_background',
    'name' => 'Selection background',
    'css' => [
        [
            'selector' => '::-moz-selection',
            'property' => 'background-color',
        ],
        [
            'selector' => '::selection',
            'property' => 'background-color',
        ],
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'selection_text_color',
    'name' => 'Selection text color',
    'css' => [
        [
            'selector' => '::-moz-selection',
            'property' => 'color',
        ],
        [
            'selector' => '::selection',
            'property' => 'color',
        ],
    ]
]);