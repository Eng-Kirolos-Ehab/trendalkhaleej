<?php
$fox56_customize->add_section( 'single_body',[
    'title' => 'Post content',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'single_body', [
    'selector' => '.single56__post_content',
    'render_callback' => 'fox56_single_body_inner',
]);

/* content
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'single_content_width',
    'options' => [
        'full' => 'Fullwdith',
        'narrow' => 'Narrow',
    ],
    'std' => 'full',
    'name' => 'Content width',
    'refresh' => 'single',

    'section' => 'single_body',
    'hint' => 'single content width',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'single_content_narrow_width',
    'std' => '660',
    'css' => [
        [
            'selector' => ':root',
            'property' => '--narrow-width',
            'unit' => 'px',
        ]
    ],
    'name' => 'Content narrow width',
    'hint' => 'single narrow width',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'single_content_image_stretch',
    'std' => false,
    'refresh' => 'single',
    'name' => 'Stretch content image?',
    'desc' => 'This option will stretch content images a little bit to the left/right',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'single_content_color',
    'name' => 'Post content text color',
    'css' => [
        [
            'selector' => '.single56__post_content',
            'property' => 'color',
        ],
    ],
    'hint' => 'single content color',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'single_content_typography',
    'name' => 'Post content font',
    'std' => [
        'face' => 'var(--font-body)',
        'weight' => '400',
        'spacing' => '0',
        'transform' => 'none',
        'line_height' => '1.5',
    ],
    'selector' => '.single56__post_content',
    'hint' => 'single content font',
]);