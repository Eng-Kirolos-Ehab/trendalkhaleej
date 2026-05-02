<?php
$fox56_customize->add_section( 'single_header',[
    'title' => 'Post header',
    'panel' => 'single',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_header_elements',
    'section' => 'single_header',
    'title' => 'Post header components',
    'std'     => [
        'standalone_category',
        'title',
        'subtitle',
        'date',
        'author',
    ],
    'options' => [
        'standalone_category' => [
            'name' => 'Fancy category',
            // 'section_edit' => 'blog_meta',
        ],
        'title' => [
            'name' => 'Post title',
            // 'section_edit' => 'single_header',
        ],
        'subtitle' => [
            'name' => 'Subtitle',
            // 'section_edit' => 'single_header',
        ],
        'date' => [
            'name' => 'Date',
            // 'section_edit' => 'blog_meta',
        ],
        'author' => [
            'name' => 'Author',
            // 'section_edit' => 'blog_meta',
        ],
        'view' => [
            'name' => 'View',
            // 'section_edit' => 'blog_meta',
        ],
        'comment' => [
            'name' => 'Comment',
            // 'section_edit' => 'blog_meta',
        ],
        'category' => [
            'name' => 'Category',
            // 'section_edit' => 'blog_meta',
        ],
        'reading_time' => [
            'name' => 'Reading time',
            // 'section_edit' => 'blog_meta',
        ],
        /*
        'share' => [
            'name' => 'Share',
            // 'section_edit' => 'single_share',
        ],
        */
    ],
    'refresh' => 'single_header',

    // 'msg' => 'You can drag/drop elements to reorder them',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'single_header_author_avatar',
    'hint' => 'single author avatar',
    'std' => true,
    'name' => 'Display author avatar for single post meta?',
    'refresh' => 'single_header',

    'msg' => 'To change author avatar size, go to <strong>Customize &raquo; Blog/archive &raquo; Post meta</strong>',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'single_header_author_date',
    'std' => false,
    'name' => 'Display date below author name?',
    'refresh' => 'single_header',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'name' => 'Post header align',
    'id' => 'single_header_align',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'left',
    'transport' => 'postMessage',

    'section' => 'single_header',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'name' => 'Post header stretch',
    'id' => 'single_header_stretch',
    'options' => [
        'auto' => 'Auto set',
        'narrow' => 'Always narrow',
        'wide' => 'Always wide',
    ],
    'std' => 'auto',
]);

/*
deprecated since v6.8
$fox56_customize->add_field([
    'type' => 'group',
    'name' => 'Post header border',
    'id' => 'single_header_border',
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
    'css' => [
        [
            'selector' => '.single56__header',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.single56__header',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.single56__header',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ]
]);
*/

/* Post title
------------------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'single_title_color',
    'hint' => 'single title color',
    'css' => [
        [
            'selector' => '.single56__title',
            'property' => 'color',
        ]
    ],
    'name' => 'Single title color',
    'heading' => 'Single post title',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'single_title_typography',
    'hint' => 'Post title font',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => '',
        'spacing' => '',
        'transform' => '',
        'line_height' => '1.1',
        'size' => '3em',
        'size_tablet' => '2.25em',
        'size_mobile' => '1.75em',
    ],
    'selector' => '.single56__title',
    'name' => 'Post title font',
]);

/* Post subtitle
------------------------------------------------------------ */
$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'subtitle_display',
    'options' => [
        'subtitle' => 'Post Subtitle',
        'excerpt' => 'Post Excerpt',
        'meta_key' => 'Custom field',
    ],
    'std' => 'subtitle',
    'name' => 'Subtitle displays:',
    'refresh' => 'single_header',

    'heading' => 'Subtitle',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'subtitle_meta_key',
    'name' => 'Subtitle meta key',
    'refresh' => 'single_header',
    'desc' => '',
]);

$fox56_customize->add_field([
    'type' => 'text',
    'id' => 'subtitle_maxwidth',
    'std' => '600',
    'name' => 'Subtitle max-width',
    'css' => [
        [
            'selector' => '.single56__subtitle',
            'property' => 'max-width',
            'unit' => 'px',
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'subtitle_color',
    'hint' => 'single subtitle color',
    'css' => [
        [
            'selector' => '.single56__subtitle',
            'property' => 'color',
        ]
    ],
    'name' => 'Subtitle color',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'subtitle_typography',
    'name' => 'Subtitle typography',
    'hint' => 'single subtitle font',
    'std' => [
        'face' => 'var(--font-body)',
        'weight' => '400',
        'spacing' => '0',
        'transform' => 'none',
        'line_height' => '',
        'size' => 20,
        'size_tablet' => 17,
        'size_mobile' => 16,
    ],
    'selector' => '.single56__subtitle',
]);