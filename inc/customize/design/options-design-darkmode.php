<?php
$fox56_customize->add_section( 'design_darkmode',[
    'title' => 'Dark mode',
    'panel' => 'design'
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'darkmode',
    'name' => 'Enable Dark mode by default?',
    'section' => 'design_darkmode',

    'hint' => 'dark mode',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'darkmode_text_color',
    'name' => 'Dark mode: Text color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--darkmode-text-color',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'darkmode_background_color',
    'std' => '#000',
    'name' => 'Dark mode: Body Background Color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--darkmode-bg',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'darkmode_border_color',
    'std' => 'rgba(255,255,255,0.12)',
    'name' => 'Dark mode: Border color',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--darkmode-border-color',
        ]
    ]
]);

/* logo
-------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'darkmode_logo',
    'name' => 'Dark mode: White Logo',
    'desc' => 'If your site uses image logo, please upload a white logo version so It displays this logo when visitor switches to dark mode.',

    'heading' => 'Dark mode logo',
]);

$fox56_customize->add_field([
    'type' => 'image',
    'id' => 'darkmode_footer_logo',
    'name' => 'Dark mode: Footer White Logo',
    'desc' => 'If your site uses footer image logo, please upload a white logo version so It displays this logo when visitor switches to dark mode.',
]);

/* dark mode icon
-------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'darkmode_switcher_style',
    'name' => 'Darkmode switcher style',
    'options' => [
        'icon_text' => 'Icon + text',
        'icon' => 'Icon switcher',
        'icon_minimal' => 'Minimal Icon',
    ],
    'std' => 'icon_text',
    'heading' => 'Dark mode icon design',

    'msg' => 'You can change text Dark/Light in Customize > Quick translation',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'darkmode_switcher_size',
    'name' => 'Darkmode switcher size',
    'std' => 24,
    'css' => [
        [
            'selector' => '.lamp56--icon .lamp56__part, .lamp56--icon_text .lamp56__part',
            'property' => 'height',
            'unit' => 'px',
        ],
        [
            'selector' => '.lamp56--icon .lamp56__part',
            'property' => 'width',
            'unit' => 'px',
        ],
    ]
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'darkmode_switcher_icon_size',
    'name' => 'Darkmode switcher icon size',
    'std' => 18,
    'css' => [
        [
            'selector' => '.lamp56__part i',
            'property' => 'font-size',
            'unit' => 'px',
        ],
    ]
]);