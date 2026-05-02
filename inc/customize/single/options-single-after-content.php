<?php
$fox56_customize->add_section( 'single_after_content', [
    'title' => 'After post content',
    'panel' => 'single',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_after_content_elements',
    'section' => 'single_after_content',
    'title' => 'After post content reorder',
    'std'     => [ 'review', 'ad', 'share', 'related', 'tags', 'authorbox', 'nav', 'comments' ],
    'msg' => '<strong>Note:</strong> This only reorder components. To control ON/OFF of each element, please go to their corresponding panel.',

    'additional' => [
        'reorder_only' => true
    ],
    'options' => [
        'review' => 'Review',
        'ad' => 'Ad',
        'share' => 'Share',
        'related' => 'Related posts',
        'tags' => 'Tags',
        'authorbox' => 'Author box',
        'nav' => 'Post nav',
        'comments' => 'Comments',
        /*
        'html1' => [
            'name' => 'HTML 1',
            'section_edit' => 'single_html',
        ],
        'html2' => [
            'name' => 'HTML 2',
            'section_edit' => 'single_html',
        ],
        'html3' => [
            'name' => 'HTML 3',
            'section_edit' => 'single_html',
        ],
        */
    ],
    'refresh' => 'single',
]);

/* single headings
---------------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'single_heading_color',
    'hint' => 'single heading color',
    'title' => 'Color',
    'css' => [
        [
            'selector' => '.single56__heading',
            'property' => 'color',
        ]
    ],
    'heading' => 'Related heading, comment heading',
]);

$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'single_heading_typography',
    'std' => [
        'face' => 'var(--font-heading)',
        'weight' => '400',
        'spacing' => '0',
        'transform' => 'none',
        'line_height' => '1.3',
        'size' => '1.5em',
        'size_mobile' => '1em',
    ],
    'selector' => '.single56__heading',
    'hint' => 'single heading/label font',
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'single_heading_align',
    'hint' => 'single heading align',
    'title' => 'Align',
    'options' => [
        'left' => 'Left',
        'center' => 'Center',
        'right' => 'Right',
    ],
    'std' => 'center',
    'css' => [
        [
            'selector' => '.single56__heading',
            'property' => 'text-align',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'radio',
    'id' => 'single_heading_style',
    'hint' => 'single heading border style',
    'title' => 'Border style',
    'options' => [
        'normal' => 'Top - Bottom',
        'around' => 'Line middle',
    ],
    'std' => 'normal',
    'refresh' => 'single',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'single_heading_border',
    'hint' => 'single heading border',
    'title' => 'Border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '2-5',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '2-5',
        ],
        'color' => [
            'name' => 'Color',
            'type' => 'color',
            'col' => '1-5',
        ]
    ],
    'css' => [
        [
            'selector' => '.single56--small-heading-normal .single56__heading',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.single56--small-heading-normal .single56__heading',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ],
        [
            'selector' => '.single56--small-heading-normal .single56__heading, .single56__heading span:before, .single56__heading span:after',
            'property' => 'border-color',
            'use' => 'color',
        ],
    ],
    'std' => [
        'top' => 0,
        'bottom' => 0,
        'color' => '',
    ],
]);