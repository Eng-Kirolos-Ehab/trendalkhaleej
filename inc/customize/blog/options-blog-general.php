<?php
$fox56_customize->add_section( 'blog_archive', [
    'title' => 'Layout & sidebar',
    'panel' => 'blog',
]);

/* ----------------------------------       archive */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'archive_layout',
    'std' => 'list',
    'options' => $layouts,
    'heading' => 'General Archive layout',
    'desc' => 'This applies to general archive types: date, post type.. Each archive type like Category, Tag, Author.. has its own layout option.',
    'section' => 'blog_archive',

    'std_affects' => [
        'archive_column' => [
            'list' => [
                'desktop' => 1, 'tablet' => 1, 'mobile' => 1,
            ],
            'grid' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
            'masonry' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
        ]
    ],

    'hint' => 'Archive Layout',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'archive_sidebar_state',
    'std' => 'sidebar-right',
    'options' => $sidebar_states,
    'name' => 'Archive sidebar',

    'hint' => 'Archive sidebar state',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'archive_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Archive custom sidebar',

    'hint' => 'Archive sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'archive_column',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 1,
        'tablet' => 1,
        'mobile' => 1,
    ],
    'name' => 'Archive column',

    'hint' => 'Archive column',
]);

/* ----------------------------------       category */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'category_layout',
    'options' => $layouts,
    'std' => 'list',
    'name' => 'Category display',
    'refresh' => 'blog',
    'heading' => 'Category page', 

    'std_affects' => [
        'category_column' => [
            'list' => [
                'desktop' => 1, 'tablet' => 1, 'mobile' => 1,
            ],
            'grid' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
            'masonry' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
        ]
    ],

    'hint' => 'Category page layout',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'category_sidebar_state',
    'options' => $sidebar_states,
    'std' => 'sidebar-right',
    'name' => 'Sidebar state',
    'refresh' => 'blog',

    'hint' => 'Category page sidebar state',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'category_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Category custom sidebar',
    'refresh' => 'blog',

    'hint' => 'Category page sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'category_column',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 1,
        'tablet' => 1,
        'mobile' => 1,
    ],
    'name' => 'Category posts column',
    'refresh' => 'blog',

    'hint' => 'Category page column',
]);

/* ----------------------------------       tag page */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'tag_layout',
    'options' => $layouts,
    'std' => 'list',
    'name' => 'Tag display',
    'heading' => 'Tag page',
    'refresh' => 'blog',

    'hint' => 'tag page layout',
    
    
    'std_affects' => [
        'tag_column' => [
            'list' => [
                'desktop' => 1, 'tablet' => 1, 'mobile' => 1,
            ],
            'grid' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
            'masonry' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
        ]
    ],
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'hint' => 'tag page sidebar state',
    'id' => 'tag_sidebar_state',
    'options' => $sidebar_states,
    'std' => 'sidebar-right',
    'name' => 'Sidebar state',
    'refresh' => 'blog',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'hint' => 'tag page sidebar',
    'id' => 'tag_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Tag custom sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'hint' => 'tag page column',
    'id' => 'tag_column',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 1,
        'tablet' => 1,
        'mobile' => 1,
    ],
    'name' => 'Tag posts column',
    'refresh' => 'blog',
]);

/* ----------------------------------       author page */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'author_layout',
    'options' => $layouts,
    'std' => 'list',
    'name' => 'Author display',
    'heading' => 'Author page',
    'refresh' => 'blog',

    'std_affects' => [
        'author_column' => [
            'list' => [
                'desktop' => 1, 'tablet' => 1, 'mobile' => 1,
            ],
            'grid' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
            'masonry' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
        ]
    ],

    'hint' => 'Author Page Layout',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'author_sidebar_state',
    'options' => $sidebar_states,
    'std' => 'sidebar-right',
    'name' => 'Sidebar state',
    'refresh' => 'blog',

    'hint' => 'Archive page sidebar state',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'author_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Author custom sidebar',
    'refresh' => 'blog',

    'hint' => 'Archive page sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'author_column',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 1,
        'tablet' => 1,
        'mobile' => 1,
    ],
    'name' => 'Author posts column',
    'refresh' => 'blog',

    'hint' => 'Archive page column',
]);

/* ----------------------------------       search page */
$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'search_layout',
    'options' => $layouts,
    'std' => 'list',
    'name' => 'Search display',
    'heading' => 'Search page',
    'refresh' => 'blog',

    'std_affects' => [
        'search_column' => [
            'list' => [
                'desktop' => 1, 'tablet' => 1, 'mobile' => 1,
            ],
            'grid' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
            'masonry' => [
                'desktop' => 3, 'tablet' => 2, 'mobile' => 1,
            ],
        ]
    ],

    'hint' => 'search page layout',
]);

$fox56_customize->add_field([
    'type' => 'radio_image',
    'id' => 'search_sidebar_state',
    'options' => $sidebar_states,
    'std' => 'sidebar-right',
    'name' => 'Sidebar state',
    'refresh' => 'blog',

    'hint' => 'search page sidebar state',
]);

$fox56_customize->add_field([
    'type' => 'select',
    'id' => 'search_sidebar',
    'std' => '',
    'options' => $sidebar_list,
    'name' => 'Search custom sidebar',

    'hint' => 'search page sidebar',
]);

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'search_column',
    'hint' => 'search page column',
    'fields' => [
        'desktop' => [
            'name' => 'Desktop',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'tablet' => [
            'name' => 'Tablet',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
        'mobile' => [
            'name' => 'Mobile',
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'col' => '1-3',
        ],
    ],
    'std' => [
        'desktop' => 1,
        'tablet' => 1,
        'mobile' => 1,
    ],
    'name' => 'Search posts column',
    'refresh' => 'blog',
]);