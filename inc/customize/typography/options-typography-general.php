<?php
$fox56_customize->add_section( 'typography_general', [
    'title' => 'Typography',
    'priority' => 172,
]);

$variants = [
    '100' => '100',
    '100itatlic' => '100italic',

    '200' => '200',
    '200itatlic' => '200italic',
    
    '300' => '300',
    '300itatlic' => '300italic',
    
    'regular' => 'Regular (400)',
    'itatlic' => 'Italic (400italic)',
    
    '500' => '500',
    '500itatlic' => '500italic',

    '600' => '600',
    '600itatlic' => '600italic',

    '700' => '700',
    '700itatlic' => '700italic',

    '800' => '800',
    '800itatlic' => '800italic',

    '900' => '900',
    '900itatlic' => '900italic',
];

/* body font
------------------------------------------------ */
$fox56_customize->add_field([
    'section' => 'typography_general',
    'id' => 'body_font',
    'type' => 'fonts',
    'title' => 'Body font',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',

    'heading' => 'Body font',
]);

$fox56_customize->add_field([
    'id' => 'body_font_custom',
    'type' => 'text',
    'title' => 'Body custom font name',
    'desc' => 'Do not enter if you don\'t have this font loaded manually. Check Fox docs for the details.',
]);

$fox56_customize->add_field([
    'id' => 'body_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Body font variants',
    'options' => $variants,
    'std' => [ '400' ],
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'body_typography',
    'title' => 'Body typography',
    'std' => [
        'size' => 16,
        'size_mobile' => 14,
        'weight' => 400,
        'line_height' => '1.5',
    ],
    'exclude' => [ 'face' ],
    'selector' => 'body',

    'hint' => 'body typography',
]);

/* heading font
------------------------------------------------ */
$fox56_customize->add_field([
    'id' => 'heading_font',
    'type' => 'fonts',
    'title' => 'Heading font',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',

    'heading' => 'Heading font',
]);

$fox56_customize->add_field([
    'id' => 'heading_font_custom',
    'type' => 'text',
    'title' => 'Heading custom font name',
    'desc' => 'Do not enter if you don\'t have this font loaded manually. Check Fox docs for the details.',
]);

$fox56_customize->add_field([
    'id' => 'heading_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Heading font variants',
    'options' => $variants,
    'std' => ['400', '700'],
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'heading_typography',
    'title' => 'Heading typography',
    'std' => [
        'weight' => 700,
        'line_height' => '1.2',
    ],
    'exclude' => [ 'face', 'size', 'size_tablet', 'size_mobile' ],
    'selector' => 'h1, h2, h3, h4, h5, h6',

    'hint' => 'heading typography',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'include' => [ 'size', 'size_tablet', 'size_mobile' ],
    'selector' => 'h2',
    'id' => 'h2_typography',
    'title' => 'H2 font size',
    'std' => [
        'size' => 33,
        'size_mobile' => 24,
    ],
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'include' => [ 'size', 'size_tablet', 'size_mobile' ],
    'selector' => 'h3',
    'id' => 'h3_typography',
    'title' => 'H3 font size',
    'std' => [
        'size' => 26,
        'size_mobile' => 20,
    ],
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'include' => [ 'size', 'size_tablet', 'size_mobile' ],
    'selector' => 'h4',
    'id' => 'h4_typography',
    'title' => 'H4 font size',
    'std' => [
        'size' => 20,
        'size_mobile' => 16,
    ],
]);

/* nav font
------------------------------------------------ */
$fox56_customize->add_field([
    'id' => 'nav_font',
    'type' => 'fonts',
    'title' => 'Menu font',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',

    'heading' => 'Navigation font',
]);

$fox56_customize->add_field([
    'id' => 'nav_font_custom',
    'type' => 'text',
    'title' => 'Menu custom font name',
    'desc' => 'Do not enter if you don\'t have this font loaded manually. Check Fox docs for the details.',
]);

$fox56_customize->add_field([
    'id' => 'nav_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Menu font variants',
    'options' => $variants,
    'std' => ['400'],
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'nav_font_size_msg',
    'type' => 'message',
    'msg' => 'The header menu font goes here because It\'s a primary font, ie. It\'ll be used as in various parts of the theme.To customize header menu item font size, weight.. please go to <a href="javascript:wp.customize.section(\'header_nav\').focus()">Customize &raquo; Header &raquo; Header navigation menu</a>',
]);

$fox56_customize->add_field([
    'id' => 'custom_1_font',
    'type' => 'fonts',
    'title' => 'Custom font 1',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',

    'heading' => 'Custom fonts',
]);

$fox56_customize->add_field([
    'id' => 'custom_1_font_custom',
    'type' => 'text',
    'title' => 'Custom font 1 - custom name',
    'desc' => 'Do not enter if you don\'t have this font loaded manually. Check Fox docs for the details.',
]);

$fox56_customize->add_field([
    'id' => 'custom_1_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Custom font 1 variants',
    'options' => $variants,
    'std' => ['400'],
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'custom_2_font',
    'type' => 'fonts',
    'title' => 'Custom font 2',
    'options' => array_merge([
        'Helvetica Neue' => 'Helvetica Neue',
        'Helvetica' => 'Helvetica',
        'Arial' => 'Arial',
        'Times' => 'Times',
        'Georgia' => 'Georgia',
        'monospace' => 'Monospace',
    ], $fox56_customize->custom_fonts),
    'std' => 'Helvetica Neue',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'custom_2_font_custom',
    'type' => 'text',
    'title' => 'Custom font 2 - custom name',
    'desc' => 'Do not enter if you don\'t have this font loaded manually. Check Fox docs for the details.',
]);

$fox56_customize->add_field([
    'id' => 'custom_2_font_variants',
    'type' => 'multicheckbox',
    'title' => 'Custom font 2 variants',
    'options' => $variants,
    'std' => ['400'],
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'id' => 'font_subsets',
    'type'      => 'multicheckbox',
    'name'      => 'Font Subsets',
    'options'   => array(
        "latin" => 'Latin',
        "latin-ext" => 'Latin Extended',
        'greek' => 'Greek',
        "greek-ext" => 'Greek Extended',
        "cyrillic" => 'Cyrillic',
        "cyrillic-ext" => 'Cyrillic Extended',
        'vietnamese' => 'Vietnamese',
    ),
    'desc' => 'Note that not each font supports only certain languages, not all.',

    'heading' => 'Font subsets',
]);