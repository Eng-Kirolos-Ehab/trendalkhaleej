<?php
$fox56_customize->add_section( 'header_bottom',[
    'title' => 'Header bottom',
    'panel' => 'header',
]);
$possible_layouts = [
    '12-12' => get_template_directory_uri() . '/inc/customize/images/group-1-1.jpg',
    '15-45' => get_template_directory_uri() . '/inc/customize/images/group-1-4.jpg',
    '14-34' => get_template_directory_uri() . '/inc/customize/images/group-1-3.jpg',
    '13-23' => get_template_directory_uri() . '/inc/customize/images/group-1-2.jpg',
    '23-13' => get_template_directory_uri() . '/inc/customize/images/group-2-1.jpg',
    '34-14' => get_template_directory_uri() . '/inc/customize/images/group-3-1.jpg',
    '45-15' => get_template_directory_uri() . '/inc/customize/images/group-4-1.jpg',
    
    '35-25' => get_template_directory_uri() . '/inc/customize/images/group-3-2.jpg',
    '25-35' => get_template_directory_uri() . '/inc/customize/images/group-2-3.jpg',
    
    '25-15-25' => get_template_directory_uri() . '/inc/customize/images/group-2-1-2.jpg',
    '13-13-13' => get_template_directory_uri() . '/inc/customize/images/group-1-1-1.jpg',
    '14-12-14' => get_template_directory_uri() . '/inc/customize/images/group-1-2-1.jpg',
    '15-35-15' => get_template_directory_uri() . '/inc/customize/images/group-1-3-1.jpg',
    '16-23-16' => get_template_directory_uri() . '/inc/customize/images/group-1-4-1.jpg',
    
    '11' => get_template_directory_uri() . '/inc/customize/images/group-1.jpg',
];

$fox56_customize->add_partial( 'header_bottom', [
    'selector' => '.header_bottom56',
    'render_callback' => 'fox56_header_bottom_inner',
]);

$fox56_customize->settings[ 'header_bottom_left_elements' ] = [
    'default' => [],
    'transport' => 'postMessage',
];
$fox56_customize->settings[ 'header_bottom_center_elements' ] = [
    'default' => [],
    'transport' => 'postMessage',
];
$fox56_customize->settings[ 'header_bottom_right_elements' ] = [
    'default' => [],
    'transport' => 'postMessage',
];
$fox56_customize->add_partial( 'header_bottom_left',[
    'selector' => '.header_bottom56 .header56__part--left',
    'render_callback' => function() {
        return fox56_header_part_inner( 'header_bottom', 'left' );
    },
    'settings' => [ 'header_bottom_left_elements' ]
]);
$fox56_customize->add_partial( 'header_bottom_center',[
    'selector' => '.header_bottom56 .header56__part--center',
    'render_callback' => function() {
        return fox56_header_part_inner( 'header_bottom', 'center' );
    },
    'settings' => [ 'header_bottom_center_elements' ]
]);
$fox56_customize->add_partial( 'header_bottom_right',[
    'selector' => '.header_bottom56 .header56__part--right',
    'render_callback' => function() {
        return fox56_header_part_inner( 'header_bottom', 'right' );
    },
    'settings' => [ 'header_bottom_right_elements' ]
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'header_bottom_layout',
    'title' => 'Header Bottom layout',
    'std'     => '16-23-16',
    'options' => $possible_layouts,
    'refresh' => 'header_bottom',
    'section' => 'header_bottom',

    'hint' => 'Header bottom',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'header_bottom_stretch',
    'title' => 'Stretch?',
    'std'     => 'content',
    'options'     => [
        'content' => get_template_directory_uri() . '/inc/customize/images/content.jpg',
        'full' => get_template_directory_uri() . '/inc/customize/images/fullwidth.jpg',
    ],
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'number',
    'id' => 'header_bottom_height',
    'title' => 'Header Bottom Height',
    'std'     => 32,
    'css' => [
        [
            'selector' => '.header_bottom56 .container .row',
            'property' => 'height',
            'unit' => 'px',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_bottom_background',
    'title' => 'Header Bottom background',
    
    'css' => [
        [
            'selector' => '.header_bottom56',
            'property' => 'background-color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'options' => [
        'light' => get_template_directory_uri() . '/inc/customize/images/text-light.jpg',
        'dark' => get_template_directory_uri() . '/inc/customize/images/text-dark.jpg',
    ],
    'std' => 'light',
    'id' => 'header_bottom_text_skin',
    'title' => 'Header Bottom text skin',
    'transport' => 'postMessage',
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_bottom_text_color',
    'title' => 'Custom text color',
    'css' => [
        [
            'selector' => '.header_bottom56__container, .header_bottom56__container.textskin--dark',
            'property' => 'color',
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'header_bottom_border',
    'title' => 'Header Bottom border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-2',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-2',
        ],
    ],
    'css' => [
        [
            'selector' => '.header_bottom56',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.header_bottom56',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ]
    ],
    'std' => [
        'top' => 0,
        'bottom' => 0,
    ],
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'header_bottom_container_border',
    'title' => 'Header Bottom Container border',
    'fields' => [
        'top' => [
            'name' => 'Top',
            'type' => 'number',
            'col' => '1-2',
        ],
        'bottom' => [
            'name' => 'Bottom',
            'type' => 'number',
            'col' => '1-2',
        ],
    ],
    'css' => [
        [
            'selector' => '.header_bottom56__container',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'bottom',
        ],
        [
            'selector' => '.header_bottom56__container',
            'property' => 'border-top-width',
            'unit' => 'px',
            'use' => 'top',
        ]
    ],
    'std' => [
        'top' => 0,
        'bottom' => 0,
    ]
]);

$fox56_customize->add_field([
    'type' => 'color',
    'id' => 'header_bottom_border_color',
    'title' => 'Border color',
    'css' => [
        [
            'selector' => '.header_bottom56, .header_bottom56__container',
            'property' => 'border-color',
        ],
    ],
]);

/**
 * since v6.8.1
 */
$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'single_header_bottom_border',
    'title' => '(Single post) header bottom border',
    'fields' => [
        'container' => [
            'name' => 'Container',
            'type' => 'number',
            'col' => '1-2',
        ],
        'full' => [
            'name' => 'Full',
            'type' => 'number',
            'col' => '1-2',
        ],
    ],
    'css' => [
        [
            'selector' => '.single .header_bottom56 .container, .page .header_bottom56 .container',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'container',
        ],
        [
            'selector' => '.single .header_bottom56, .page .header_bottom56',
            'property' => 'border-bottom-width',
            'unit' => 'px',
            'use' => 'full',
        ]
    ],
    'std' => [
        'container' => '',
        'full' => '',
    ],
]);