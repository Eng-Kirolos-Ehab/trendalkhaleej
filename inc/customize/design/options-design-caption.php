<?php
$fox56_customize->add_section( 'design_caption',[
    'title' => 'Image caption',
    'panel' => 'design'
]);

/* caption
------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'caption_color',
    'hint' => 'image caption color',
    'css' => [
        [
            'selector' => '.wp-caption-text, .wp-element-caption, .single_thumbnail56 figcaption, .thumbnail56 figcaption, .wp-block-image figcaption, .blocks-gallery-caption',
            'property' => 'color',
        ]
    ],
    'name' => 'Caption text color',
    'section' => 'design_caption',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'caption_link_color',
    'hint' => 'image caption link color',
    'css' => [
        [
            'selector' => '.wp-caption-text a, .wp-element-caption a, .single_thumbnail56 figcaption a, .thumbnail56 figcaption a, .wp-block-image figcaption a, .blocks-gallery-caption a',
            'property' => 'color',
        ]
    ],
    'name' => 'Caption link color',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'caption_typography',
    'hint' => 'image caption font',
    'std' => [
        'face' => 'var(--font-body)',
        'variant' => '400',
        'transform' => 'none',
        'spacing' => '',
        'line_height' => '',
        'size' => 14,
        'size_mobile' => 12,
    ],
    'selector' => '.wp-caption-text, .single_thumbnail56 figcaption, .thumbnail56 figcaption, .wp-block-image figcaption, .blocks-gallery-caption',
    'title' => 'Caption font'
]);