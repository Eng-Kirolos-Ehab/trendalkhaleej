<?php
$fox56_customize->add_section( 'builder_settings', [
    'title' => 'Builder settings',
    'priority' => 163,
]);

/* General
------------------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'builder_unique_reading',
    'name' => 'Non-duplicated posts',
    'desc' => 'By this option, a post won\'t be displayed twice through the builder.',
    'section' => 'builder_settings',
    'refresh' => 'h2',

    'heading' => 'General',

    'hint' => 'non-duplicated posts: unique reading',
]);

$fox56_customize->add_field([
    'id' => 'builder_padding_top',
    'type' => 'group',
    'name' => 'Builder padding top',

    'heading' => 'Spacing',

    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'number',
            'name' => 'Tablet',
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'col' => '1-3',
        ],
    ],
    'css' => [
        [
            'property' => 'padding-top',
            'selector' => '.builder56',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-top',
            'selector' => '.builder56',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-top',
            'selector' => '.builder56',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => 20,
        'tablet' => 0,
        'mobile' => 0,
    ],
    'section' => 'builder_settings',

    'hint' => 'builder padding top',
]);

$fox56_customize->add_field([
    'id' => 'builder_padding_bottom',
    'type' => 'group',
    'name' => 'Builder padding bottom',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'number',
            'name' => 'Tablet',
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'col' => '1-3',
        ],
    ],
    'css' => [
        [
            'property' => 'padding-bottom',
            'selector' => '.builder56',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-bottom',
            'selector' => '.builder56',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-bottom',
            'selector' => '.builder56',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => 30,
        'tablet' => 20,
        'mobile' => 10,
    ],
    'section' => 'builder_settings',

    'hint' => 'builder padding bottom',
]);

// since 6.2
$fox56_customize->add_field([
    'id' => 'section_spacing',
    'type' => 'group',
    'name' => 'Section Spacing',
    'fields' => [
        'desktop' => [
            'type' => 'number',
            'name' => 'Desktop',
            'col' => '1-3',
        ],
        'tablet' => [
            'type' => 'number',
            'name' => 'Tablet',
            'col' => '1-3',
        ],
        'mobile' => [
            'type' => 'number',
            'name' => 'Mobile',
            'col' => '1-3',
        ],
    ],
    'css' => [
        [
            'property' => 'margin-top',
            'selector' => '.builder56__section + .builder56__section',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-top',
            'selector' => '.builder56__section + .builder56__section',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-top',
            'selector' => '.builder56__section + .builder56__section',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => 24,
        'tablet' => 20,
        'mobile' => 16,
    ],
    'hint' => 'section spacing',
]);

/* Heading
------------------------------------------------------------ */
$fox56_customize->add_field([
    'name' => 'Builder heading font',
    'type' => 'typography',
    'id' => 'builder_heading_typography',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => 700,
        'spacing' => 2,
        'transform' => 'uppercase',
    ],
    'selector' => '.heading56, .section-heading h2, .fox-heading .heading-title-main',
    'hint' => 'builder heading font',

    'heading' => 'Builder heading',
]);