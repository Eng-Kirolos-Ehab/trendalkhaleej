<?php
$fox56_customize->add_section( 'header_sticky', [
    'title' => 'Sticky header',
    'panel' => 'header',
]);

$fox56_customize->add_field([
    'id' => 'header_sticky',
    'title' => 'Sticky header?',
    'section' => 'header_sticky',
    'std' => true,
    'type' => 'checkbox',
    'hint' => 'sticky header (fixed header)',

    'msg' => 'For sticky header on mobile, please visit <strong><a href="javascript:wp.customize.section(\'header_mobile\').focus()">Header &raquo; Header Mobile</a></strong>',
]);

$fox56_customize->add_field([
    'id' => 'header_sticky_parts',
    'title' => 'Sticky parts',
    'type' => 'multicheckbox',
    'options' => [
        'topbar' => 'Topbar',
        'main_header' => 'Main Header',
        'header_bottom' => 'Header Bottom',
    ],
    'std' => [ 'topbar', 'main_header', 'header_bottom' ]
]);

$fox56_customize->add_field([
    'id' => 'header_sticky_background',
    'title' => 'Sticky header background',
    'type' => 'color',
    'css' => [
        [
            'selector' => '.masthead--sticky .masthead__wrapper.before-sticky',
            'property' => 'background', 
        ]
    ]
]);

$fox56_customize->add_field([
    'id' => 'header_sticky_border',
    'title' => 'Sticky header border',
    'type' => 'group',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'col' => '2-5',
            'type' => 'number',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'col' => '2-5',
            'type' => 'number',
        ],
        'color' => [
            'name' => 'Color',
            'col' => '1-5',
            'type' => 'color',
        ],
    ],
    'std' => [
        'top' => 0,
        'bottom' => 0,
        'color' => '',
    ],
    'css' => [
        [
            'selector' => '.masthead--sticky .masthead__wrapper.before-sticky',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top', 
        ],
        [
            'selector' => '.masthead--sticky .masthead__wrapper.before-sticky',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom', 
        ],
        [
            'selector' => '.masthead--sticky .masthead__wrapper.before-sticky',
            'property' => 'border-color',
            'use' => 'color', 
        ],
    ]
]);

$fox56_customize->add_field([
    'id' => 'header_sticky_shadow',
    'title' => 'Sticky header shadow',
    'type' => 'number',
    'std' => 0,
    'css' => [
        [
            'selector' => '.masthead--sticky .masthead__wrapper.before-sticky',
            'property' => 'box-shadow',
            'value_pattern' => '0 3px 10px rgba(0,0,0,0.$)',
        ]
    ]
]);