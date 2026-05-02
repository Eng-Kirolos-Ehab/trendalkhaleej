<?php
$fox56_customize->add_section( 'header_social',[
    "title" => 'Header social icons',
    'panel' => 'header',
]);

$fox56_customize->add_field([
    'msg_before' => 'To enter social URLs, please visit the <strong><a href="javascript:wp.customize.section(\'social\').focus()">Social Panel</a></strong>',
    'type' => 'number',
    'id' => 'header_social_icon_spacing',
    'title'  => 'Icon spacing',
    'std'     => 6,
    'css' => [
        [
            'selector' => '.header56__social li + li',
            'property' => 'margin-left',
            'unit' => 'px',
        ],
    ],
    'section' => 'header_social',
    'hint' => 'header social icons',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_social_icon_size',
    'title'  => 'Icon container size',
    'std'     => 32,
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'width',
            'unit' => 'px',
        ],
        [
            'selector' => '.header56__social a',
            'property' => 'height',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_social_icon_font',
    'title'  => 'Icon size',
    'std'     => 18,
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'font-size',
            'unit' => 'px',
        ],
        [
            'selector' => '.header56__social a img',
            'property' => 'width',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_social_icon_border_radius',
    'title'  => 'Border radius',
    'std'     => 30,
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'border-radius',
            'unit' => 'px',
        ],
    ],
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_social_icon_border',
    'title'  => 'Icon border width',
    'std'     => 0,
    'choices' => [
        'min' => 0,
        'max' => 6,
        'step' => 1,
    ],
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'border-width',
            'unit' => 'px',
        ],
    ]
]);

/* ------------------ tabs */
$fox56_customize->add_field([
    'type' => 'tabs',
    'id' => 'header_social_tabs',
    'tabs' => [
        'normal' => 'Normal',
        'hover' => 'Hover',
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_background',
    'title'  => 'Icon background',
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'background',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_color',
    'title'  => 'Icon text color',
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'color',
        ],
    ],
    
    'tabs' => 'header_social_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_border_color',
    'title'  => 'Icon border color',
    'css' => [
        [
            'selector' => '.header56__social a',
            'property' => 'border-color',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'normal',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_hover_background',
    'title'  => 'Icon hover background',
    'css' => [
        [
            'selector' => '.header56__social a:hover',
            'property' => 'background',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_hover_color',
    'title'  => 'Icon hover text color',
    'css' => [
        [
            'selector' => '.header56__social a:hover',
            'property' => 'color',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'hover',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_social_icon_hover_border_color',
    'title'  => 'Icon hover border color',
    'css' => [
        [
            'selector' => '.header56__social a:hover',
            'property' => 'border-color',
        ],
    ],
    'tabs' => 'header_social_tabs',
    'tab' => 'hover',
]);