<?php
$fox56_customize->add_section( 'single_general',[
    'title' => 'General settings',
    'panel' => 'single',
]);

$fox56_customize->add_partial( 'single', [
    'selector' => '.single-placement',
    'render_callback' => 'fox56_single_inner',
]);

$fox56_customize->add_partial( 'single_header', [
    'selector' => '.single56__header',
    'render_callback' => 'fox56_single_header_inner',
]);

if ( defined( 'FOX_FRAMEWORK_VERSION' ) ) {

    $fox56_customize->add_field([
        'type' => 'radio',
        'id' => 'wi_single_layout_type',
        'title' => 'Single post layout type',
        'std'     => 'classic',
        'options' => [
            'classic' => 'Predefined',
            'builder' => 'Single Builder by Elementor',
        ],
        'section' => 'single_general',
    ]);

    $fox56_customize->add_field([
        'id' => 'wi_single_template',
        'type' => 'select',
        'options' => $fox_block_list,
        'name' => 'Choose Template',
        'std' => '',

        'condition' => [ 'wi_single_layout_type' => 'builder' ],
    ]);

}

$condition = [];
if ( defined( 'FOX_FRAMEWORK_VERSION' ) ) {
    $condition = [ 'wi_single_layout_type' => 'classic' ];
}

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'single_style',
    'title' => 'Single post layout',
    'std'     => '1',
    'options' => [
        '1' => get_template_directory_uri() . '/inc/customize/images/single_layout_1.jpg?v=' . FOX_VERSION,
        '1b' => get_template_directory_uri() . '/inc/customize/images/single_layout_1b.jpg?v=' . FOX_VERSION,
        '2' => get_template_directory_uri() . '/inc/customize/images/single_layout_2.jpg?v=' . FOX_VERSION,
        '3' => get_template_directory_uri() . '/inc/customize/images/single_layout_3.jpg?v=' . FOX_VERSION,
        '4' => get_template_directory_uri() . '/inc/customize/images/single_layout_4.jpg?v=' . FOX_VERSION,
        '5' => get_template_directory_uri() . '/inc/customize/images/single_layout_5.jpg?v=' . FOX_VERSION,
        '6' => get_template_directory_uri() . '/inc/customize/images/single_layout_6.jpg?v=' . FOX_VERSION,
    ],
    // 'refresh' => 'single',
    'condition' => $condition,
    'section' => 'single_general',

    'hint' => 'single post layout',
]);

/* -------------------          sidebar */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'single_sidebar_state',
    'title' => 'Single sidebar',
    'std'     => 'sidebar-right',
    'options' => [
        'sidebar-left' => get_template_directory_uri() . '/inc/customize/images/sidebar-left.jpg',
        'sidebar-right' => get_template_directory_uri() . '/inc/customize/images/sidebar-right.jpg',
        'no-sidebar' => get_template_directory_uri() . '/inc/customize/images/no-sidebar.jpg',
    ],
    'refresh' => 'single',
    'condition' => $condition,

    'hint' => 'single post sidebar position',
]);

$fox56_customize->add_field([
    'id' => 'single_sidebar',
    'type' => 'select',
    'options' => $sidebar_list,
    'std' => '',
    'name' => 'Sidebar replacement',
    'desc' => 'By default, It uses <strong>Main Sidebar</strong> for single post',
    'condition' => $condition,
    'hint' => 'single post sidebar',
]);

// NEW SINCE 5.6
$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'single_background',
    'name' => 'Single post background',
    'css' => [
        [
            'selector' => 'body.single',
            'property' => 'background-color'
        ]
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'single_text_color',
    'name' => 'Single post text color',
    
    'css' => [
        [
            'selector' => 'body.single',
            'property' => 'color'
        ]
    ]
]);

/*
$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'single_padding_top',
    'title' => 'Single post padding top',
    'fields' => [
        'desktop' => [
            'name' => 'Padding',
            'type' => 'number',
            'col' => '2-5',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'col' => '2-5',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'col' => '1-5',
        ],
    ],
    'css' => [
        [
            'selector' => '.single56',
            'property' => 'padding-top',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.single56',
            'property' => 'padding-top',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.single56',
            'property' => 'padding-top',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => '20',
        'tablet' => '0',
        'mobile' => '0',
    ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'single_padding_bottom',
    'title' => 'Single post padding bottom',
    'fields' => [
        'desktop' => [
            'name' => 'Padding',
            'type' => 'number',
            'col' => '2-5',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'col' => '2-5',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'col' => '1-5',
        ],
    ],
    'css' => [
        [
            'selector' => '.single56',
            'property' => 'padding-bottom',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'selector' => '.single56',
            'property' => 'padding-bottom',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => '.single56',
            'property' => 'padding-bottom',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ],
    'std' => [
        'desktop' => '',
        'tablet' => '',
        'mobile' => '',
    ],
]);

*/