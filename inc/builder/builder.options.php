<?php
/* common functions for widgets
---------------------------------------------------------------------- */
function fox56_builder_query_options() {
    global $fox56_customize;

    $fields = [];

    /* Query 
    --------------------------------------------------------------- */
    $fields[ 'number' ] = [
        'type' => 'number',
        'min' => -1,
        'std' => 3,
        'title' => 'Number of posts?',

        'section' => 'query',
        'section_name' => 'Query',
    ];
    
    $fields[ 'orderby' ] = [
        'type' => 'select',
        'std' => '',
        'options' => [
            '' => 'Default',
            'date'  =>'Published Date',
            'modified'  =>'Modified Date',
            'title'  =>'Post title',
            'comment_count'=>'Comment count',
            'view'=>'View count',
            'view_week' =>'View count (Weekly)',
            'view_month'=>'View count (Monthly)',
            'view_year'=>'View count (Yearly)',
            
            'menu_order' => 'Menu Order',
    
            'review_score' => 'Review Score',
            'review_date' => 'Recent Review',
            'rand' => 'Random',
        ],
        'title' => 'Order by',
    ];
    
    $fields[ 'order' ] = [
        'type' => 'radio',
        'std' => 'DESC',
        'options' => [
            'ASC' => 'ASC',
            'DESC' => 'DESC',
        ],
        'title' => 'Order',
    ];
    
    $fields[ 'featured' ] = [
        'type' => 'checkbox',
        'std' => false,
        'title' => 'Only featured posts?',
    ];
    
    $fields[ 'categories' ] = [
        'type' => 'select',
        'multiple' => true,
        'title' => 'Category',
        'options' => $fox56_customize->category_list,
    ];
    
    $fields[ 'exclude_categories' ] = [
        'type' => 'select',
        'multiple' => true,
        'title' => 'Exclude Category',
        'options' => $fox56_customize->category_list,
    ];
    
    $fields[ 'tags' ] = [
        'type' => 'text',
        'title' => 'Include only tags:',
        'desc' => 'Use tag IDs, eg. 5, 291, 67',
    ];
    
    $fields[ 'exclude_tags' ] = [
        'type' => 'text',
        'title' => 'Exclude following tags:',
        'desc' => 'Use tag IDs, eg. 5, 291, 67',
    ];
    
    $fields[ 'authors' ] = [
        'type' => 'select',
        'title' => 'Include only author:',
        'multiple' => true,
        'options' => $fox56_customize->author_list,
    ];
    
    $fields[ 'format' ] = [
        'type' => 'select',
        'title' => 'Post Format',
        'options' => [
            '' => 'All',
            'standard' => 'Only Standard',
            'video' => 'Only Video',
            'audio' => 'Only Audio',
            'gallery' => 'Only Gallery',
            'link' => 'Only Link',
        ],
        'std' => '',
    ];
    
    $fields[ 'include' ] = [
        'type' => 'text',
        'title' => 'Include only post IDs:',
        'desc' => 'Eg. 5, 17, 211',
    ];
    
    $fields[ 'exclude' ] = [
        'type' => 'text',
        'title' => 'Exclude post IDs:',
        'desc' => 'Eg. 5, 17, 211',
    ];
    
    $fields[ 'exclude_displayed' ] = [
        'type' => 'select',
        'title' => 'Exclude previously displayed posts',
        'options' => [
            '' => 'Inherit from Builder Settings',
            'true' => 'Yes',
            'false' => 'No',
        ],
        'std' => '',
        'desc' => 'If you choose Yes, It will skip posts have been displayed by previous sections. This is for Non-duplicated posts.',
    ];
    
    $fields[ 'offset' ] = [
        'type' => 'number',
        'std' => 0,
        'title' => 'Offset',
        'desc' => 'Number of posts to pass by',
    ];
    
    $fields[ 'exclude_sticky' ] = [
        'type' => 'checkbox',
        'std' => false,
        'title' => 'Exclude sticky posts?',
        'desc' => 'Note: Enable this will affect performance. Only use if there is no alternative solutions.',
    ];
    
    $fields[ 'exclude_featured_posts' ] = [
        'type' => 'checkbox',
        'std' => false,
        'title' => 'Exclude featured posts?',
        'desc' => 'Note: Enable this will affect performance. Only use if there is no alternative solutions.',
    ];
    
    $fields[ 'pagination' ] = [
        'type' => 'checkbox',
        'title' => 'Pagination?',
    ];
    
    $fields[ 'disable_paged' ] = [
        'type' => 'checkbox',
        'title' => 'Disable this section from 2nd pages?',
    ];
    
    /* ---------------------------------        cpt         */
    $fields[ 'cpt__heading' ] = [
        'type' => 'heading',
        'heading' => 'Custom post type',
    ];

    $fields[ 'post_type' ] = [
        'type' => 'text',
        'title' => 'Enter custom post type',
        'desc' => 'Eg. my_movie. You can enter several post types, separated by comma: post, my_movie, my_book',
        'heading' => 'Custom post type',
    ];
    
    $fields[ 'tax_1' ] = [
        'type' => 'text',
        'title' => 'Enter custom taxonomy 1',
        'desc' => 'Eg. movie_genre',
    ];
    
    $fields[ 'tax_1_value' ] = [
        'type' => 'text',
        'title' => 'Taxonomy 1 value (name)',
        'desc' => 'Eg. Comedy. You can enter several values, separated by comma: Comedy, Anime, Documentary',
    ];
    
    $fields[ 'tax_2' ] = [
        'type' => 'text',
        'title' => 'Enter custom taxonomy 2',
        'desc' => 'Eg. movie_genre',
    ];
    
    $fields[ 'tax_2_value' ] = [
        'type' => 'text',
        'title' => 'Taxonomy 2 value (name)',
        'desc' => 'Eg. Comedy. You can enter several values, separated by comma: Comedy, Anime, Documentary',
    ];

    /* ---------------------------------        custom query         */
    $fields[ 'custom_query__heading' ] = [
        'type' => 'heading',
        'heading' => 'Custom query',
    ];

    $fields[ 'additional_query' ] = [
        'type' => 'textarea',
        'title' => 'Additional query json',
        'desc' => '<span style="color:red">This APPENDS additional queries to above options. Do not enter if you don\'t understand what are you doing. <a href="https://fox.withemes.com/documentation/builder/builder-post-additional-query/" target="_blank">Docs: additional query ↗</a></span>',
    ];

    $fields[ 'custom_query' ] = [
        'type' => 'textarea',
        'title' => 'Custom query json',
        'desc' => '<span style="color:red">This OVERRIDES additional queries to above options. Do not enter if you don\'t understand what are you doing. <a href="https://fox.withemes.com/documentation/additional/builder-post-custom-query/" target="_blank">Docs: custom query ↗</a></span>',
    ];

    return $fields;
}

function fox56_builder_post_style_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'post_style' ] = [
        'type' => 'radio_image',
        'std' => 'normal',
        'options' => [
            'normal' => get_template_directory_uri() . '/inc/customize/images/post-style-normal.jpg',
            'ontop' => get_template_directory_uri() . '/inc/customize/images/post-style-ontop.jpg',
        ],
        'title' => 'Post text style',
    
        'section' => 'post_style',
        'section_name' => 'Post Style',
    ];

    $fields[ 'ontop_valign' ] = [
        'type' => 'radio',
        'title' => '[On Top] Text Position',
        'options' => [
            'top' => 'Top',
            'middle' => 'Middle',
            'bottom' => 'Bottom',
        ],
        'std' => 'middle',
        'transport' => 'postMessage',
        'condition' => [
            "post_style" => 'ontop',
        ]
    ];

        /* -----------------------  ON TOP OPTIONS */
        $fields[ 'ontop_height_style' ] = [
            'type' => 'radio',
            'std' => 'ratio',
            'options' => [
                'fixed' => 'Fixed height',
                'ratio' => 'By ratio',
            ],
            'title' => 'Post height by?',
            
            'condition' => [
                "post_style" => 'ontop',
            ],
        ];
    
        $fields[ 'ontop_padding' ] = [
            'type' => 'group',
            'fields' => [
                'desktop' => [
                    'type' => 'number',
                    'col' => '1-3',
                    'std' => '80%',
                    'placeholder' => 'Eg. 80%',
                    'name' => 'Desktop', 
                ],
                'tablet' => [
                    'type' => 'number',
                    'col' => '1-3',
                    'std' => '80%',
                    'name' => 'Tablet', 
                ],
                'mobile' => [
                    'type' => 'number',
                    'col' => '1-3',
                    'std' => '80%',
                    'name' => 'Mobile', 
                ],
            ],
            'std' => [
                'desktop' => '80',
                'tablet' => '80',
                'mobile' => '80',
            ],
            'css' => [
                [
                    'property' => 'padding-bottom',
                    'selector' => '{{wrapper}} .post56__padding',
                    'unit' => '%',
                    'use' => 'desktop',
                ],
                [
                    'property' => 'padding-bottom',
                    'selector' => '{{wrapper}} .post56__padding',
                    'unit' => '%',
                    'use' => 'tablet',
                    'media_query' => $fox56_customize->tablet,
                ],
                [
                    'property' => 'padding-bottom',
                    'selector' => '{{wrapper}} .post56__padding',
                    'unit' => '%',
                    'use' => 'mobile',
                    'media_query' => $fox56_customize->mobile,
                ],
            ],
            'desc' => 'Post ratio height/width. If any devices value missing, it will take value from bigger device.',
            'title' => 'Padding (%)',
            'condition' => [
                "post_style" => 'ontop',
                'ontop_height_style' => 'ratio',
            ],
        ];
    
        $fields[ 'ontop_height' ] = [
            'type' => 'group',
            'fields' => [
                'desktop' => [
                    'type' => 'text',
                    'col' => '1-3',
                    'std' => '320',
                    'placeholder' => 'Eg. 320',
                    'name' => 'Desktop', 
                ],
                'tablet' => [
                    'type' => 'text',
                    'col' => '1-3',
                    'std' => '320',
                    'name' => 'Tablet', 
                ],
                'mobile' => [
                    'type' => 'text',
                    'col' => '1-3',
                    'std' => '320',
                    'name' => 'Mobile', 
                ],
            ],
            'desc' => 'Post fixed. If any devices value missing, it will take value from bigger device.',
            'title' => 'Post height',
            'condition' => [
                "post_style" => 'ontop',
                'ontop_height_style' => 'fixed',
            ],
            'std' => [
                'desktop' => '320',
                'tablet' => '320',
                'mobile' => '320',
            ],
            'css' => [
                [
                    'property' => 'height',
                    'selector' => '{{wrapper}} .post56__height',
                    'unit' => 'px',
                    'use' => 'desktop',
                ],
                [
                    'property' => 'height',
                    'selector' => '{{wrapper}} .post56__height',
                    'unit' => 'px',
                    'use' => 'tablet',
                    'media_query' => $fox56_customize->tablet,
                ],
                [
                    'property' => 'height',
                    'selector' => '{{wrapper}} .post56__height',
                    'unit' => 'px',
                    'use' => 'mobile',
                    'media_query' => $fox56_customize->mobile,
                ],
            ],
        ];
    
        $fields[ 'ontop_overlay' ] = [
            'type' => 'color',
            'name' => 'Overlay background',
            'std' => 'rgba(0,0,0,.3)',
            'css' => [
                [
                    'selector' => '{{wrapper}} .post56__overlay',
                    'property' => 'background',
                ]
            ],
            'condition' => [
                "post_style" => 'ontop',
            ],
        ];

    return $fields;

}

function fox56_builder_component_spacing_options() {
    global $fox56_customize;
    $fields = [];
    $fields[ 'component_spacing' ] = [
        'type' => 'group',
        'title' => 'Component spacing',
        'fields' => [
            'desktop' => [
                'type' => 'number',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'number',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'number',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 8,
            'tablet' => 8,
            'mobile' => 6,
        ],

        'css' => [
            [
                'property' => 'margin-top',
                'selector' => "{{wrapper}} .component56 + .component56",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'margin-top',
                'selector' => "{{wrapper}} .component56 + .component56",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'margin-top',
                'selector' => "{{wrapper}} .component56 + .component56",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
    ];

    $fields[ 'thumbnail_margin_bottom' ] = [
        'type' => 'group',
        'title' => 'Thumbnail gap bottom',
        'fields' => [
            'desktop' => [
                'type' => 'number',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'number',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'number',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 10,
            'tablet' => 8,
            'mobile' => 6,
        ],
        'css' => [
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .thumbnail56",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .thumbnail56",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .thumbnail56",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
        'condition' => [
            "post_style" => 'normal',
        ],
    ];

    $fields[ 'title_margin_bottom' ] = [
        'type' => 'group',
        'title' => 'Title margin bottom',
        'fields' => [
            'desktop' => [
                'type' => 'number',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'number',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'number',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 10,
            'tablet' => 8,
            'mobile' => 6,
        ],
        'css' => [
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .title56",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .title56",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .title56",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
    ];

    $fields[ 'excerpt_margin_bottom' ] = [
        'type' => 'group',
        'title' => 'Excerpt margin bottom',
        'fields' => [
            'desktop' => [
                'type' => 'number',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'number',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'number',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 10,
            'tablet' => 8,
            'mobile' => 6,
        ],
        'css' => [
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .excerpt56",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .excerpt56",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'margin-bottom',
                'selector' => "{{wrapper}} .excerpt56",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
    ];

    return $fields;
}

function fox56_builder_border_options() {
    global $fox56_customize;
    $fields = [];
    
    $fields[ 'border__heading' ] = [
        'type' => 'heading',
        'heading' => 'Border',
    ];
    
    $fields[ 'v_sep' ] = [
        'type' => 'radio',
        'title' => 'Vertical border between cols?',
        'options' => [
            '1px' => 'Yes',
            '0px' => 'No',
        ],
        'std' => '0px',
        'css' => [
            [
                'property' => 'border-right-width',
                'selector' => "{{wrapper}} .blog56__sep__line",
            ],
        ],
    ];

    $fields[ 'v_sep_color' ] = [
        'type' => 'color',
        'title' => 'Vertical border color',
        'css' => [
            [
                'property' => 'border-color',
                'selector' => "{{wrapper}} .blog56__sep__line",
            ],
        ],
    ];

    // if group, it applies to sub-items
    $fields[ 'h_sep' ] = [
        'type' => 'radio',
        'title' => 'Horizontal border between items?',
        'options' => [
            '1px' => 'Yes',
            '0px' => 'No',
        ],
        'std' => '0px',
        'css' => [
            [
                'property' => 'border-top-width',
                'selector' => "{{wrapper}} .post56__sep__line",
            ],
        ],
        
    ];

    $fields[ 'h_sep_color' ] = [
        'type' => 'color',
        'title' => 'Horizontal border color',
        'css' => [
            [
                'property' => 'border-color',
                'selector' => "{{wrapper}} .post56__sep__line",
            ],
        ],
    ];
    return $fields;
}

function fox56_builder_item_box_options() {
    
    global $fox56_customize;
    
    $fields = [];

    $fields[ 'item__heading' ] = [
        'type' => 'heading',
        'heading' => 'Post Item Box',
    ];

    $fields[ 'item_border_radius' ] = [
        'type' => 'text',
        'std' => '0',
        'id' => "item_border_radius",
        'title' => 'Post box border radius',
        'css' => [
            [
                'property' => 'border-radius',
                'selector' => "{{wrapper}} .post56",
                'unit' => 'px',
            ],
        ],
    ];

    $fields[ 'item_background' ] = [
        'type' => 'color',
        'title' => 'Post box background',
        'css' => [
            [
                'property' => 'background-color',
                'selector' => "{{wrapper}} .post56",
            ],
        ],
        
    ];

    $fields[ 'item_shadow' ] = [
        'type' => 'number',
        'title' => 'Post box shadow',
        'std' => 0,
        'css' => [
            [
                'property' => 'box-shadow',
                'selector' => "{{wrapper}} .post56",
                'value_pattern' => '2px 8px 20px rgba(0,0,0,0.$)',
            ],
        ],
    ];

    $fields[ 'item_padding' ] = [
        'type' => 'group',
        'fields' => [
            'desktop' => [
                'type' => 'text',
                'name' => 'Desktop',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'tablet' => [
                'type' => 'text',
                'name' => 'Tablet',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
            'mobile' => [
                'type' => 'text',
                'name' => 'Mobile',
                'min' => 0,
                'max' => 100,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 0,
            'tablet' => 0,
            'mobile' => 0,
        ],
        'title' => 'Post box padding',
        'css' => [
            [
                'property' => 'padding',
                'selector' => "{{wrapper}} .post56__text",
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'property' => 'padding',
                'selector' => "{{wrapper}} .post56__text",
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'property' => 'padding',
                'selector' => "{{wrapper}} .post56__text",
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
    ];
    return $fields;
}

function fox56_builder_component_options() {

    global $fox56_customize;
    $fields = [];

    $fields[ 'components' ] = [
        'type' => 'sortable',

        'section' => 'components',
        'section_name' => 'Components',

        'options' => [
            'thumbnail' => 'Post Thumbnail',
            'standalone_category' => [
                'display' => 'inline',
                'name' => 'Fancy Category'
            ],
            'live' => [
                'display' => 'inline',
                'name' => 'LIVE Indicator'
            ],
            'title' => 'Post Title',
            'date' => [
                'display' => 'inline',
                'name' => 'Date'
            ],
            'author' => [
                'display' => 'inline',
                'name' => 'Author'
            ],
            'category' => [
                'display' => 'inline',
                'name' => 'Category'
            ],
            'comment' => [
                'display' => 'inline',
                'name' => 'Comment'
            ],
            'reading_time' => [
                'display' => 'inline',
                'name' => 'Read time'
            ],
            'view' => [
                'display' => 'inline',
                'name' => 'View'
            ],
            'excerpt' => 'Excerpt',
            'more' => 'ReadMore button',
            'share' => 'Social share icons',
        ],
        'title' => 'Components to display',
        'std' => [ 'thumbnail', 'standalone_category', 'live', 'title', 'date', 'excerpt' ],
    ];

    return $fields;

}

function fox56_builder_title_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'title_tag' ] = [
        'id' => "title_tag",
        'type' => 'radio',
        'options' => [
            'h2' => 'H2',
            'h3' => 'H3',
            'h4' => 'H4',
        ],
        'std' => 'h2',
        'title' => 'Title heading',

        'section' => 'title',
        'section_name' => 'Title',
    ];

    return $fields;
}

function fox56_builder_excerpt_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'excerpt_content' ] = [
        'type' => 'radio',
        'title' => 'Excerpt/content?',
        'options' => [
            'excerpt' => 'Excerpt',
            'content' => 'Content',
        ],

        'std' => 'excerpt',
        
        'section' => 'excerpt',
        'section_name' => 'Excerpt',
    ];

    $fields[ 'excerpt_length' ] = [
        'type' => 'number',
        'title' => 'Excerpt length',
        
        'std' => 24,
        'min' => 0,
        'max' => 60,
        'step' => 1,
    ];

    $fields[ 'excerpt_column' ] = [
        'type' => 'radio',
        'title' => 'Excerpt text column',
        'options' => [
            '1' => '1 cols',
            '2' => '2 cols',
            '3' => '3 cols',
        ],
        'std' => 1,
    ];

    $fields[ 'excerpt_align' ] = [
        'type' => 'radio',
        'css' => [
            [
                'property' => 'text-align',
                'selector' => '{{wrapper}} .excerpt56',
            ]
        ],
        'title' => 'Excerpt text align',
        'options' => [
            '' => 'Default',
            'left' => 'Left',
            'center' => 'Center',
            'right' => 'Right',
            'justify' => 'Justify',
        ],
        'std' => '',
    ];

    $fields[ 'more_style' ] = [
        'type' => 'radio_image',
        'title' => 'More button style',
        
        'options' => [
            'primary' => get_template_directory_uri() . '/inc/customize/images/btn-primary.jpg',
            'outline' => get_template_directory_uri() . '/inc/customize/images/btn-outline.jpg',
            'fill' => get_template_directory_uri() . '/inc/customize/images/btn-filled.jpg',
            'black' => get_template_directory_uri() . '/inc/customize/images/btn-black.jpg',
            'minimal' => get_template_directory_uri() . '/inc/customize/images/btn-minimal.jpg',
            'plain' => get_template_directory_uri() . '/inc/customize/images/btn-plain.jpg',
        ],
        'std' => 'primary',
    ];

    return $fields;
}

function fox56_builder_meta_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'date_format' ] = [
        'type' => 'text',
        'title' => 'Date format',
        'desc' => 'Learn about date format <a href="https://wordpress.org/documentation/article/customize-date-and-time-format/" target="_blank">here</a>. By default, It will display date based on your general date format setting.',
        
        'section' => 'meta',
        'section_name' => 'Meta',
    ];

    $fields[ 'date_type' ] = [
        'type' => 'radio',
        'title' => 'Date type',
        'options' => [
            '' => 'Default',
            'publish' => 'Published date',
            'updated' => 'Updated date',
        ],
        'std' => '',
    ];

    $fields[ 'author_avatar' ] = [
        'type' => 'checkbox',
        'title' => 'Author avatar?',
    ];

    $fields[ 'author_avatar_size' ] = [
        'type' => 'group',
        'title' => 'Author avatar size',
        'css' => [
            [
                'selector' => "{{wrapper}} .meta56__author img",
                'property' => 'width',
                'unit' => 'px',
                'use' => 'desktop',
            ],
            [
                'selector' => "{{wrapper}} .meta56__author img",
                'property' => 'width',
                'unit' => 'px',
                'use' => 'tablet',
                'media_query' => $fox56_customize->tablet,
            ],
            [
                'selector' => "{{wrapper}} .meta56__author img",
                'property' => 'width',
                'unit' => 'px',
                'use' => 'mobile',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
        'fields' => [
            'desktop' => [
                'name' => 'Desktop',
                'type' => 'number',
                'max' => 100,
                'min' => 20,
                'col' => '1-3',
            ],
            'tablet' => [
                'name' => 'Tablet',
                'type' => 'number',
                'max' => 100,
                'min' => 20,
                'col' => '1-3',
            ],
            'mobile' => [
                'name' => 'Mobile',
                'type' => 'number',
                'max' => 100,
                'min' => 10,
                'col' => '1-3',
            ],
        ],
        'std' => [
            'desktop' => 32,
            'tablet' => 28,
            'mobile' => 24,
        ],
    ];

    $fields[ 'category_tax' ] = [
        'type' => 'text',
        'title' => 'Custom Taxonomy in place of category',
        'desc' => 'Please use precisely the taxonomy slug, eg. post_tag, product_cat or my_movie',
    ];

    $fields[ 'fancy_category_style' ] = [
        'type' => 'radio',
        'title' => 'Fancy category style',
        'options'   => [
            '' => 'Default',
            'plain' => 'Plain',
            'box' => 'Box',
            'solid' => 'Solid',
        ],
        'std' => '',
    ];

    return $fields;
}

function fox56_builder_color_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'color' ] = [
        'type' => 'color',
        'title' => 'Custom Text color',
        'css' => [
            [
                'selector' => "
                {{wrapper}},
                {{wrapper}} .post56,
                {{wrapper}} .title56, 
                {{wrapper}} .excerpt56, 
                {{wrapper}} .meta56,
                {{wrapper}} .meta56 a, 
                {{wrapper}} .meta56__category--fancy,
                {{wrapper}} .btn56--outline,
                {{wrapper}} .btn56--fill",
                'property' => 'color',
            ],
            [
                'selector' => "{{wrapper}} .btn56--outline,
                {{wrapper}} .btn56--fill",
                'property' => 'border-color',
            ],
            [
                'selector' => "{{wrapper}} .btn56--fill:hover",
                'property' => 'background-color',
            ],
            // make this always white when hovered
            [
                'selector' => "{{wrapper}} .btn56--fill:hover",
                'property' => 'color',
                'value_pattern' => 'white',
            ],
        ],

        'section' => 'color',
        'section_name' => 'Color',
    ];

    $fields[ 'title_color' ] = [
        'id' => 'title_color',
        'type' => 'color',
        'title' => 'Title color',
        'css' => [
            [
                'selector' => "{{wrapper}} .post56 .title56 a",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'title_hover_color' ] = [
        'type' => 'color',
        'title' => 'Title hover color',
        'css' => [
            [
                'selector' => "{{wrapper}} .post56 .title56 a:hover",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'excerpt_color' ] = [
        'type' => 'color',
        'title' => 'Excerpt color',
        'css' => [
            [
                'selector' => "{{wrapper}} .post56 .excerpt56",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'meta_color' ] = [
        'type' => 'color',
        'title' => 'Post meta color',
        'css' => [
            [
                'selector' => "{{wrapper}}  .post56 .meta56",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'meta_link_color' ] = [
        'type' => 'color',
        'title' => 'Meta link color',
        'css' => [
            [
                'selector' => "{{wrapper}}  .post56 .meta56 a",
                'property' => 'color',
            ],
        ],
        
    ];

    $fields[ 'meta_link_hover_color' ] = [
        'type' => 'color',
        'title' => 'Meta link hover color',
        'css' => [
            [
                'selector' => "{{wrapper}}  .post56 .meta56 a:hover",
                'property' => 'color',
            ],
        ],
    ];

    $fields[ 'standalone_category_color' ] = [
        'type' => 'color',
        'title' => 'Fancy category color',
        'css' => [
            [
                'selector' => "{{wrapper}}  .post56 .meta56__category--fancy a",
                'property' => 'color',
            ],
        ],
    ];

    return $fields;
}

function fox56_builder_typo_css( $selector, $wrapper_prefix = true ) {
    global $fox56_customize;
    if ( $wrapper_prefix ) {
        $selector = "{{wrapper}} $selector";
    }

    $value_replace = [
        // for title
        'supertiny' => [ '0.9', '0.9', '0.8' ],
        'tiny' => [ '1', '1', '1' ],
        'small' => [ '1.2', '1.1', '1' ],
        'normal' => [ '1.44', '1.2', '1.1' ],
        'medium' => [ '1.728', '1.4', '1.2' ],
        'large' => [ '2.074', '1.6', '1.4' ],
        'huge' => [ '2.488', '1.8', '1.5' ],
        'gigantic' => [ '2.986', '2.25', '1.7' ],

        // for excerpt
        'excerpt_supertiny' => [ '0.85', '0.85', '0.85' ],
        'excerpt_tiny' => [ '0.9', '0.9', '0.85' ],
        'excerpt_normal' => [ '1', '1', '1' ],
        'excerpt_medium' => [ '1.15', '1.1', '1.1' ],
        'excerpt_large' => [ '1.3', '1.25', '1.15' ],
        'excerpt_huge' => [ '1.6', '1.3', '1.2' ],
    ];

    $value_replace_arr = [ 'desktop' => [], 'tablet' => [], 'mobile' => [] ];
    foreach( $value_replace as $k => $arr ) {
        $value_replace_arr['desktop'][$k] = $arr[0];
        $value_replace_arr['tablet'][$k] = $arr[1];
        $value_replace_arr['mobile'][$k] = $arr[2];
    }

    return [
        [
            'selector' => $selector,
            'property' => 'font-family',
            'use' => 'face',
        ],
        [
            'selector' => $selector,
            'property' => 'font-weight',
            'use' => 'weight',
        ],
        [
            'selector' => $selector,
            'property' => 'font-style',
            'use' => 'style',
        ],
        [
            'selector' => $selector,
            'property' => 'font-size',
            'use' => 'size_template',
            'value_replace' => $value_replace_arr['desktop'],
            'unit' => 'em',
        ],
        [
            'selector' => $selector,
            'property' => 'font-size',
            'use' => 'size_template',
            'value_replace' => $value_replace_arr['tablet'],
            'unit' => 'em',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => $selector,
            'property' => 'font-size',
            'use' => 'size_template',
            'value_replace' => $value_replace_arr['mobile'],
            'unit' => 'em',
            'media_query' => $fox56_customize->mobile,
        ],
        [
            'selector' => $selector,
            'property' => 'font-size',
            'use' => 'size',
            'unit' => 'px',
        ],
        [
            'selector' => $selector,
            'property' => 'font-size',
            'use' => 'size_tablet',
            'unit' => 'px',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'selector' => $selector,
            'property' => 'font-size',
            'use' => 'size_mobile',
            'unit' => 'px',
            'media_query' => $fox56_customize->mobile,
        ],
        [
            'selector' => $selector,
            'property' => 'line-height',
            'use' => 'line_height',
        ],
        [
            'selector' => $selector,
            'property' => 'letter-spacing',
            'use' => 'spacing',
            'unit' => 'px',
        ],
        [
            'selector' => $selector,
            'property' => 'text-transform',
            'use' => 'transform',
        ],
    ];
}

function fox56_builder_typography_options() {

    global $fox56_customize;

    $fields = [];

    $fields[ 'title_typography' ] = [
        'type' => 'group',
        'title' => "Title Typography",
        'fields' => $fox56_customize->typo_fields,
        'css' => fox56_builder_typo_css( '.title56' ),
        
        'section' => 'typography',
        'section_name' => 'Typography',
    ];

    $excerpt_typo_fields = $fox56_customize->typo_fields;
    $excerpt_typo_fields[ 'size_template' ][ 'options' ] = [
        '' => '--Select--',
        'excerpt_supertiny' => 'Super tiny',
        'excerpt_tiny' => 'Tiny',
        'excerpt_normal' => 'Normal',
        'excerpt_medium' => 'Medium',
        'excerpt_large' => 'Large',
        'excerpt_huge' => 'Huge',
    ];

    $fields[ 'excerpt_typography' ] = [
        'type' => 'group',
        'title' => "Excerpt Typography",
        'fields' => $excerpt_typo_fields,
        'css' => fox56_builder_typo_css( '.excerpt56' ),
    ];

    $fields[ 'more_typography' ] = [
        'type' => 'group',
        'title' => "More Typography",
        'fields' => $excerpt_typo_fields,
        'css' => fox56_builder_typo_css( '.readmore56 a' ),
    ];

    $fields[ 'meta_typography' ] = [
        'type' => 'group',
        'title' => "Meta Typography",
        'fields' => $excerpt_typo_fields,
        'css' => fox56_builder_typo_css( '.meta56' ),
    ];

    $fields[ 'standalone_category_typography' ] = [
        'type' => 'group',
        'title' => "Fancy Category Typography",
        'fields' => $excerpt_typo_fields,
        'css' => fox56_builder_typo_css( '.meta56__category--fancy' ),
    ];

    return $fields;
};

function fox56_builder_style_options() {

    $fields[ 'custom_css' ] = [
        'type' => 'textarea',
        'title' => 'Custom CSS',
        'desc' => 'Use {{wrapper}} for the widget selector, eg. {{wrapper}} h2 {color: red;}',
    ];

}

function fox56_builder_widget_layout_options( $field_prefix, $selector, $wrapper_prefix = true, $fields = ['margin'] ) {
    global $fox56_customize;
    $fields = [];
    if ( $wrapper_prefix ) {
        $selector = "{{wrapper}} $selector";
    }
    // ================MARGIN======================
    $fields[ $field_prefix.'margin_desktop' ] = [
        'type' => 'group',
        // 'name' => 'Margin (Desktop)',
        'name' => 'Margin <span class="dashicons dashicons-desktop"></span><span class="dashicons dashicons-tablet" data-trigger="preview-tablet"></span><span class="dashicons dashicons-smartphone" data-trigger="preview-mobile"></span> <span class="dashicons dashicons-image-rotate" data-reset="1"></span>',
        'preview_device' => 'desktop',
        'section' => 'widget_layout',
        'section_name' => 'Margin, padding..',
        'fields' => [
            'top' => [ 'type' => 'number', 'name' => 'Top', 'col' => '1-4' ],
            'right' => [ 'type' => 'number', 'name' => 'Right', 'col' => '1-4' ],
            'bottom' => [ 'type' => 'number', 'name' => 'Bottom', 'col' => '1-4' ],
            'left' => [ 'type' => 'number', 'name' => 'Left', 'col' => '1-4' ],
        ],
        'css' => [
            [ 'selector' => $selector, 'property' => 'margin-top', 'unit' => 'px',
                'use' => 'top',
            ],
            [ 'selector' => $selector, 'property' => 'margin-right', 'unit' => 'px',
                'use' => 'right',
            ],
            [ 'selector' => $selector, 'property' => 'margin-bottom', 'unit' => 'px',
                'use' => 'bottom',
            ],
            [ 'selector' => $selector, 'property' => 'margin-left', 'unit' => 'px', 
                'use' => 'left',
            ],
        ],
        'std' => [ 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ]
    ];

    $fields[ $field_prefix.'margin_tablet' ] = [
        'type' => 'group',
        'name' => 'Margin  <span class="dashicons dashicons-desktop" data-trigger="preview-desktop"></span><span class="dashicons dashicons-tablet"></span><span class="dashicons dashicons-smartphone" data-trigger="preview-mobile"></span> <span class="dashicons dashicons-image-rotate" data-reset="1"></span>',
        'preview_device' => 'tablet',
        'fields' => [
            'top' => [ 'type' => 'number', 'name' => 'Top', 'col' => '1-4' ],
            'right' => [ 'type' => 'number', 'name' => 'Right', 'col' => '1-4' ],
            'bottom' => [ 'type' => 'number', 'name' => 'Bottom', 'col' => '1-4' ],
            'left' => [ 'type' => 'number', 'name' => 'Left', 'col' => '1-4' ],
        ],
        'css' => [
            [ 'selector' => $selector, 'property' => 'margin-top', 'unit' => 'px',
                'use' => 'top',
                'media_query' => $fox56_customize->tablet,
            ],
            [ 'selector' => $selector, 'property' => 'margin-right', 'unit' => 'px',
                'use' => 'right',
                'media_query' => $fox56_customize->tablet,
            ],
            [ 'selector' => $selector, 'property' => 'margin-bottom', 'unit' => 'px',
                'use' => 'bottom',
                'media_query' => $fox56_customize->tablet,
            ],
            [ 'selector' => $selector, 'property' => 'margin-left', 'unit' => 'px', 
                'use' => 'left',
                'media_query' => $fox56_customize->tablet,
            ],
        ],
        'std' => [ 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ]
    ];

    $fields[ $field_prefix.'margin_mobile' ] = [
        'type' => 'group',
        'name' => 'Margin <span class="dashicons dashicons-desktop" data-trigger="preview-desktop"></span><span class="dashicons dashicons-tablet" data-trigger="preview-tablet"></span><span class="dashicons dashicons-smartphone"></span> <span class="dashicons dashicons-image-rotate" data-reset="1"></span>',
        'preview_device' => 'mobile',
        'fields' => [
            'top' => [ 'type' => 'number', 'name' => 'Top', 'col' => '1-4' ],
            'right' => [ 'type' => 'number', 'name' => 'Right', 'col' => '1-4' ],
            'bottom' => [ 'type' => 'number', 'name' => 'Bottom', 'col' => '1-4' ],
            'left' => [ 'type' => 'number', 'name' => 'Left', 'col' => '1-4' ],
        ],
        'css' => [
            [ 'selector' => $selector, 'property' => 'margin-top', 'unit' => 'px',
                'use' => 'top',
                'media_query' => $fox56_customize->mobile,
            ],
            [ 'selector' => $selector, 'property' => 'margin-right', 'unit' => 'px',
                'use' => 'right',
                'media_query' => $fox56_customize->mobile,
            ],
            [ 'selector' => $selector, 'property' => 'margin-bottom', 'unit' => 'px',
                'use' => 'bottom',
                'media_query' => $fox56_customize->mobile,
            ],
            [ 'selector' => $selector, 'property' => 'margin-left', 'unit' => 'px', 
                'use' => 'left',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
        'std' => [ 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ]
    ];
    // ================PADDING======================
    $fields[ $field_prefix.'padding_desktop' ] = [
        'type' => 'group',
        'name' => 'Padding <span class="dashicons dashicons-desktop"></span><span class="dashicons dashicons-tablet" data-trigger="preview-tablet"></span><span class="dashicons dashicons-smartphone" data-trigger="preview-mobile"></span> <span class="dashicons dashicons-image-rotate" data-reset="1"></span>',
        'preview_device' => 'desktop',
        'fields' => [
            'top' => [ 'type' => 'number', 'name' => 'Top', 'min' => 0, 'col' => '1-4' ],
            'right' => [ 'type' => 'number', 'name' => 'Right', 'min' => 0, 'col' => '1-4' ],
            'bottom' => [ 'type' => 'number', 'name' => 'Bottom', 'min' => 0, 'col' => '1-4' ],
            'left' => [ 'type' => 'number', 'name' => 'Left', 'min' => 0, 'col' => '1-4' ],
        ],
        'css' => [
            [ 'selector' => $selector, 'property' => 'padding-top', 'unit' => 'px',
                'use' => 'top',
            ],
            [ 'selector' => $selector, 'property' => 'padding-right', 'unit' => 'px',
                'use' => 'right',
            ],
            [ 'selector' => $selector, 'property' => 'padding-bottom', 'unit' => 'px',
                'use' => 'bottom',
            ],
            [ 'selector' => $selector, 'property' => 'padding-left', 'unit' => 'px',
                'use' => 'left',
            ],
        ],
        'std' => [ 'top' => '', 'right' => '', 'bottom' => '', 'left' => '', ]
    ];

    $fields[ $field_prefix.'padding_tablet' ] = [
        'type' => 'group',
        'name' => 'Padding   <span class="dashicons dashicons-desktop" data-trigger="preview-desktop"></span><span class="dashicons dashicons-tablet"></span><span class="dashicons dashicons-smartphone" data-trigger="preview-mobile"></span> <span class="dashicons dashicons-image-rotate" data-reset="1"></span>',
        'preview_device' => 'tablet',
        'fields' => [
            'top' => [ 'type' => 'number', 'name' => 'Top', 'min' => 0, 'col' => '1-4' ],
            'right' => [ 'type' => 'number', 'name' => 'Right', 'min' => 0, 'col' => '1-4' ],
            'bottom' => [ 'type' => 'number', 'name' => 'Bottom', 'min' => 0, 'col' => '1-4' ],
            'left' => [ 'type' => 'number', 'name' => 'Left', 'min' => 0, 'col' => '1-4' ],
        ],
        'css' => [
            [ 'selector' => $selector, 'property' => 'padding-top', 'unit' => 'px',
                'use' => 'top',
                'media_query' => $fox56_customize->tablet,
            ],
            [ 'selector' => $selector, 'property' => 'padding-right', 'unit' => 'px',
                'use' => 'right',
                'media_query' => $fox56_customize->tablet,
            ],
            [ 'selector' => $selector, 'property' => 'padding-bottom', 'unit' => 'px',
                'use' => 'bottom',
                'media_query' => $fox56_customize->tablet,
            ],
            [ 'selector' => $selector, 'property' => 'padding-left', 'unit' => 'px',
                'use' => 'left',
                'media_query' => $fox56_customize->tablet,
            ],
        ],
        'std' => [ 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ]
    ];

    $fields[ $field_prefix.'padding_mobile' ] = [
        'type' => 'group',
        'name' => 'Padding   <span class="dashicons dashicons-desktop" data-trigger="preview-desktop"></span><span class="dashicons dashicons-tablet" data-trigger="preview-tablet"></span><span class="dashicons dashicons-smartphone"></span> <span class="dashicons dashicons-image-rotate" data-reset="1"></span>',
        'preview_device' => 'mobile',
        'fields' => [
            'top' => [ 'type' => 'number', 'name' => 'Top', 'min' => 0, 'col' => '1-4' ],
            'right' => [ 'type' => 'number', 'name' => 'Right', 'min' => 0, 'col' => '1-4' ],
            'bottom' => [ 'type' => 'number', 'name' => 'Bottom', 'min' => 0, 'col' => '1-4' ],
            'left' => [ 'type' => 'number', 'name' => 'Left', 'min' => 0, 'col' => '1-4' ],
        ],
        'css' => [
            [ 'selector' => $selector, 'property' => 'padding-top', 'unit' => 'px',
                'use' => 'top',
                'media_query' => $fox56_customize->mobile,
            ],
            [ 'selector' => $selector, 'property' => 'padding-right', 'unit' => 'px',
                'use' => 'right',
                'media_query' => $fox56_customize->mobile,
            ],
            [ 'selector' => $selector, 'property' => 'padding-bottom', 'unit' => 'px',
                'use' => 'bottom',
                'media_query' => $fox56_customize->mobile,
            ],
            [ 'selector' => $selector, 'property' => 'padding-left', 'unit' => 'px', 
                'use' => 'left',
                'media_query' => $fox56_customize->mobile,
            ],
        ],
        'std' => [ 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ]
    ];
    // ================BACKGROUND COLOR======================
    $fields[ $field_prefix.'background_color' ] = [
        'type' => 'color',
        'title' => 'Background Color',
        'css' => [
            [ 'selector' => $selector, 'property' => 'background-color' ]
        ]
    ];
    // ================BORDER======================
    // Border Style
    $fields[ $field_prefix.'border_style' ] = [
        'type' => 'select',
        'title' => 'Border Style',
        'options' => [
            ''      => 'Default',
            'solid' => 'Solid',
            'dashed' => 'Dashed',
            'dotted' => 'Dotted',
            'ridge' => 'Ridge',
            'Inset' => 'Inset',
            'Outset' => 'Outset',
        ],
        'std' => '',
        'css' => [
            [ 'selector' => $selector, 'property' => 'border-style', 'value_pattern' => '$' ]
        ],
    ];
    //Border Width
    $fields[ $field_prefix.'border_width' ] = [
        'type' => 'group',
        'name' => 'Border Width <span class="dashicons dashicons-image-rotate" data-reset="1"></span>',
        'fields' => [
            'top' => [ 'type' => 'number', 'name' => 'Top', 'min' => 0, 'col' => '1-4' ],
            'right' => [ 'type' => 'number', 'name' => 'Right', 'min' => 0, 'col' => '1-4' ],
            'bottom' => [ 'type' => 'number', 'name' => 'Bottom', 'min' => 0, 'col' => '1-4' ],
            'left' => [ 'type' => 'number', 'name' => 'Left', 'min' => 0, 'col' => '1-4' ],
        ],
        'css' => [
            [ 'selector' => $selector, 'property' => 'border-top-width', 'unit' => 'px',
                'use' => 'top',
            ],
            [ 'selector' => $selector, 'property' => 'border-right-width', 'unit' => 'px',
                'use' => 'right',
            ],
            [ 'selector' => $selector, 'property' => 'border-bottom-width', 'unit' => 'px',
                'use' => 'bottom',
            ],
            [ 'selector' => $selector, 'property' => 'border-left-width', 'unit' => 'px',
                'use' => 'left',
            ],
        ],
        'std' => [ 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ],
        "condition" => [
                        'abz_test' => 'test',
            $field_prefix.'border_style' => ['solid', 'dashed', 'dotted', 'ridge', 'Inset', 'Outset'],

        ]
    ];
    //Border Color
    $fields[ $field_prefix.'border_color' ] = [
        'type' => 'color',
        'title' => 'Border Color',
        'css' => [
            [ 'selector' => $selector, 'property' => 'border-color' ],
        ],
        'condition' => [
            $field_prefix.'border_style' => ['solid', 'dashed', 'dotted', 'ridge', 'Inset', 'Outset'],
        ]
    ];
    //Border Radius
    $fields[ $field_prefix.'border_radius' ] = [
        'type' => 'group',
        'name' => 'Border Radius <span class="dashicons dashicons-image-rotate" data-reset="1"></span>',
        'fields' => [
            'top' => [ 'type' => 'number', 'name' => 'Top', 'min' => 0, 'col' => '1-4' ],
            'right' => [ 'type' => 'number', 'name' => 'Right', 'min' => 0, 'col' => '1-4' ],
            'bottom' => [ 'type' => 'number', 'name' => 'Bottom', 'min' => 0, 'col' => '1-4' ],
            'left' => [ 'type' => 'number', 'name' => 'Left', 'min' => 0, 'col' => '1-4' ],
        ],
        'css' => [
            [ 'selector' => $selector, 'property' => 'border-top-left-radius', 'unit' => 'px',
                'use' => 'top',
            ],
            [ 'selector' => $selector, 'property' => 'border-top-right-radius', 'unit' => 'px',
                'use' => 'right',
            ],
            [ 'selector' => $selector, 'property' => 'border-bottom-right-radius', 'unit' => 'px',
                'use' => 'bottom',
            ],
            [ 'selector' => $selector, 'property' => 'border-bottom-left-radius', 'unit' => 'px',
                'use' => 'left',
            ],
        ],
        'std' => [ 'top' => '', 'right' => '', 'bottom' => '', 'left' => '' ]
    ];

    return $fields;
}