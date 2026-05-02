<?php
/**
 * all shortcodes for the theme
 */

/* 
 * Blog Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'fox_posts', 'fox56_blog_shortcode' );
add_shortcode( 'fox_blog', 'fox56_blog_shortcode' );
function fox56_blog_shortcode( $atts, $content ) {

    if ( ! is_array( $atts ) ) {
        $atts = [];
    }

    /**
     * convert string into array
     */
    $args = [];
    foreach ( $atts as $k => $v ) {
        $final_v = $v;
        /* ----------------------- devices */
        if ( in_array( $k, [ 'column' ] ) ) {
            $v = explode( ',', $v );
            $final_v = [];
            if ( isset( $v[0] ) ) {
                $final_v['desktop'] = $v[0];
            }
            if ( isset( $v[1] ) ) {
                $final_v['tablet'] = $v[1];
            }
            if ( isset( $v[2] ) ) {
                $final_v['mobile'] = $v[2];
            }
        }

        /* ----------------------- categories */
        if ( in_array( $k, [ 'categories', 'exclude_categories' ]) ) {
            $final_v = explode( ',', $v );
            $final_v = array_map( 'trim', $final_v );
            foreach ( $final_v as $j => $final_v_value ) {
                $final_v[ $j ] = 'cat--' . $final_v_value;
            }
        }

        /* ----------------------- authors */
        if ( in_array( $k, [ 'authors' ]) ) {
            $final_v = explode( ',', $v );
            $final_v = array_map( 'absint', $final_v );
        }

        /* ----------------------- components */
         if ( in_array( $k, [ 'components', 'thumbnail_components' ]) ) {
            $final_v = explode( ',', $v );
            $final_v = array_map( 'trim', $final_v );
        }
        
        $args[$k] = $final_v;
    }

    /**
     * query
     */
    $query = fox56_builder_query( $args );
    if ( ! $query ) {
        if ( current_user_can( 'manage_options' ) ) {
            return '<em style="color:red;">message for admin only: No posts found for this query</em>';
        }
        return;
    }

    /**
     * $layout
     */
    $layout = isset( $args['layout'] ) ? $args['layout'] : 'grid';
    if ( ! in_array( $layout, [ 'grid', 'list' ] ) ) {
        $layout = 'grid';
    }

    /**
     * custom
     */
    $args[ 'render_css' ] = true;
    $args[ 'widget_id' ] = uniqid( 'f-blog-shortcode' );

    ob_start();

    if ( 'list' == $layout ) {
        $args[ 'type' ] = 'post-list';
        fox56_blog_list( $query, $args );
    } else {
        $args[ 'type' ] = 'post-grid';
        fox56_blog_grid( $query, $args );
    }

    wp_reset_query();

    return ob_get_clean();
    
}

/* 
 * Button Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'button', 'fox56_button_shortcode' );
add_shortcode( 'btn', 'fox56_button_shortcode' );
add_shortcode( 'fox_button', 'fox56_button_shortcode' );
add_shortcode( 'fox_btn', 'fox56_button_shortcode' );

function fox56_button_shortcode( $atts, $content = null ) {
    ob_start();
    fox56_btn( $atts );
    return ob_get_clean();
}

/* 
 * Dropcap Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'dropcap', 'fox_dropcap_shortcode' );
add_shortcode( 'fox_dropcap', 'fox_dropcap_shortcode' );
add_shortcode( 'wi_dropcap', 'fox_dropcap_shortcode' );

if ( ! function_exists( 'fox_dropcap_shortcode' ) ) :
function fox_dropcap_shortcode( $atts, $content = null ) {
    
    extract( wp_parse_args( $atts, [
        'style' => ''
    ] ) );
    
    $class = [
        'wi-dropcap',
        'fox-dropcap',
    ];
    
    if ( $style != 'dark' && $style != 'color' ) $style = 'default';
    $class[] = 'dropcap-' . $style;
    
    $html = '<span class="' . esc_attr( join( ' ', $class ) ) . '">' . trim( $content ) . '</span>';
    
    return $html;
    
}
endif;
add_shortcode( 'blockquote', 'fox_blockquote_shortcode' );
add_shortcode( 'fox_blockquote', 'fox_blockquote_shortcode' );
add_shortcode( 'wi_blockquote', 'fox_blockquote_shortcode' );

/* 
 * Blockquote Shortcode
 * ------------------------------------------------------------------ */
if ( ! function_exists( 'fox_blockquote_shortcode' ) ) :
function fox_blockquote_shortcode( $atts, $content = null ) {
    
    extract( shortcode_atts( array(
        'align' => 'center',
        'author' => '',
    ), $atts ) );
    
    if ( $align != 'left' && $align != 'right' ) $align = 'center';
    
    if ( $author ) $author = '<cite>' . $author . '</cite>';
    
    return '<blockquote class="wi-blockquote align-' . esc_attr( $align ) . '">' . trim( $content ) .  $author . '</blockquote>';
    
}
endif;

/* 
 * Today Shortcode
 * ------------------------------------------------------------------ */
add_shortcode( 'today', 'fox_today_shortcode' );
add_shortcode( 'fox_today', 'fox_today_shortcode' );

if ( ! function_exists( 'fox_today_shortcode' ) ) :
function fox_today_shortcode( $atts, $content = null ) {
    
    extract( wp_parse_args( $atts, [
        'format' => '',
    ] ) );
    
    if ( ! $format ) {
        $format = get_option( 'date_format' );
    }
    
    return '<span class="tody">' . wp_date( $format ) . '</span>';
    
}
endif;

/* 
 * Logged in
 * ------------------------------------------------------------------ */
add_shortcode( 'logged_in', 'fox_logged_in_shortcode' );
if ( ! function_exists( 'fox_logged_in_shortcode' ) ) :
function fox_logged_in_shortcode( $atts, $content = null ) {
    if ( ! is_user_logged_in() ) {
        return;
    }
    return do_shortcode( $content );
}
endif;

/* 
 * Author list
 * ------------------------------------------------------------------ */
add_shortcode( 'fox_authors', 'fox_authors_shortcode' );
function fox_authors_shortcode( $args ) {

    $default = [

        'widget_id' => '',

        // query options
        'number' => '',
        'orderby' => '',
        'order' => '',
        'include' => '',
        'exclude' => '',
        'has_published_posts' => true,
    
        // layout
        'column' => [],
        'author_item_layout' => 'top',
        'align' => 'left',
        'valign' => 'top',

        'description_displays' => 'post',
        'description_post' => 'date',

        /**
         * css options
         */
        'align' => 'left',
        'valign' => 'flex-start',
        'h_spacing' => '32,20,10',
        'v_spacing' => '32,20,10',
        'v_sep' => '0px',
        'v_sep_color' => '',
        'h_sep' => '0px',
        'h_sep_color' => '',
        'avatar_text_gap' => '20,15,10',
        'avatar_size' => '120,90,50',
        'avatar_border_radius' => 150,
        'name_description_gap' => '6,5,4',
        'name_font_size' => '',
        'description_font_size' => '',
        'color' => '',
        'name_color' => '',
        'description_color' => '',
    ];

    extract( wp_parse_args( $args, $default ) );

    ob_start();

    /* Query
    -------------------- */
    $query_args = [
        'number' => $number,
        'orderby' => $orderby,
        'order' => $order,
    ];
    if ( $has_published_posts ) {
        $query_args[ 'capability' ] = 'edit_posts';
        $query_args[ 'has_published_posts' ] = 'post';
    }

    $include = trim( $include );
    if ( ! empty( $include ) ) {
        $include = explode( ',', $include );
        $include = array_map( 'absint', $include );
        $query_args = [ 'include' => $include ];
        $query_args[ 'orderby' ] = 'include';
    }
    $exclude = trim( $exclude );
    if ( ! empty( $exclude ) ) {
        $exclude = explode( ',', $exclude );
        $exclude = array_map( 'absint', $exclude );
        $query_args[ 'exclude' ] = $exclude;
    }

    $user_query = new WP_User_Query( $query_args );
    $result = $user_query->get_results();

    /**
     * classes
     */
    $cl = [ 'authors56', $widget_id ];

    if ( empty( $result ) ) {
        $cl[] = 'fox-error';
        ?>
        <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">
            <span><?php echo esc_html__( 'No users found', 'wi' ); ?>
        </div>
        <?php
        return;
    }

    /**
     * column
     */
    /**
     * column
     */
    if ( ! $column ) { $column = '3,3,1'; }
    if ( ! is_array( $column ) ) {
        $column = explode( ',', $column );
    }
    if ( ! is_array( $column ) ) { 
        $column = []; 
    }
    
    /* ----------------------- devices */
    
    $final_column = [];
    if ( isset( $column[0] ) ) {
        $final_column['desktop'] = $column[0];
    }
    if ( isset( $column[1] ) ) {
        $finafinal_columnl_v['tablet'] = $column[1];
    }
    if ( isset( $column[2] ) ) {
        $final_column['mobile'] = $column[2];
    }

    $final_column = wp_parse_args( $final_column, [ 'desktop' => 3, 'tablet' => 3, 'mobile' => 1 ]);

    $cl[] = 'authors56--desktop--' . $final_column['desktop'];
    $cl[] = 'authors56--tablet--' . $final_column['tablet'];
    $cl[] = 'authors56--mobile--' . $final_column['mobile'];

    /**
     * layout
     */
    if ( 'left' != $author_item_layout ) {
        $author_item_layout = 'top';
    }
    $cl[] = 'authors56--item--' . $author_item_layout;

    /**
     * CSS
     */
    $id = uniqid('authors__');
    $css = [];
    global $fox56_customize;

    $css[ 'align' ] = [
        [
            'property' => 'text-align',
            'selector' => "{{wrapper}} .author56",
        ]
    ];
    $css[ 'valign' ] = [
        [
            'property' => 'align-items',
            'selector' => "{{wrapper}}.authors56--item--left .author56",
        ]
    ];
    
    $css[ 'h_spacing' ] = [
        [
            'property' => 'padding-left',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-left',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-left',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'padding-right',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-right',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-right',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'margin-left',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-left',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-left',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'margin-right',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-right',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-right',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ];

    $css[ 'v_spacing' ] = [
				
        [
            'property' => 'padding-top',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-top',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-top',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'padding-bottom',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-bottom',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-bottom',
            'selector' => "{{wrapper}} .author56",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'margin-top',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-top',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-top',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

        [
            'property' => 'margin-bottom',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-bottom',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-bottom',
            'selector' => "{{wrapper}} .authors56__container",
            'unit' => 'px',
            'value_pattern' => '-$',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],

    ];

    $css[ 'v_sep' ] = [
        [
            'property' => 'border-left-width',
            'selector' => "{{wrapper}} .author56",
        ],
    ];

    $css[ 'v_sep_color' ] = [
        [
            'property' => 'border-left-color',
            'selector' => "{{wrapper}} .author56",
        ],
    ];

    $css[ 'h_sep' ] = [
        [
            'property' => 'border-top-width',
            'selector' => "{{wrapper}} .author56",
        ],
    ];

    $css[ 'h_sep_color' ] = [
        [
            'property' => 'border-top-color',
            'selector' => "{{wrapper}} .author56",
        ],
    ];

    $css[ 'avatar_text_gap' ] = [
        [
            'property' => 'margin-top',
            'selector' => "{{wrapper}}.authors56--item--top .author56__text",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-top',
            'selector' => "{{wrapper}}.authors56--item--top .author56__text",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-top',
            'selector' => "{{wrapper}}.authors56--item--top .author56__text",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],


        [
            'property' => 'padding-left',
            'selector' => "{{wrapper}}.authors56--item--left .author56__text",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'padding-left',
            'selector' => "{{wrapper}}.authors56--item--left .author56__text",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'padding-left',
            'selector' => "{{wrapper}}.authors56--item--left .author56__text",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ];

    $css[ 'avatar_size' ] = [
        [
            'property' => 'width',
            'selector' => "{{wrapper}} .author56__avatar",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'width',
            'selector' => "{{wrapper}}.authors56--item--left .author56__text",
            'value_pattern' => 'calc(100% - $)',
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'width',
            'selector' => "{{wrapper}} .author56__avatar",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'width',
            'selector' => "{{wrapper}}.authors56--item--left .author56__text",
            'value_pattern' => 'calc(100% - $)',
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'width',
            'selector' => "{{wrapper}} .author56__avatar",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
        [
            'property' => 'width',
            'selector' => "{{wrapper}}.authors56--item--left .author56__text",
            'value_pattern' => 'calc(100% - $)',
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ];

    $css[ 'avatar_border_radius' ] = [
        [
            'property' => 'border-radius',
            'selector' => "{{wrapper}} .author56__avatar img",
            'unit' => 'px',
        ],
    ];

    $css[ 'name_description_gap' ] = [
        [
            'property' => 'margin-top',
            'selector' => "{{wrapper}} .author56__description",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'margin-top',
            'selector' => "{{wrapper}} .author56__description",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'margin-top',
            'selector' => "{{wrapper}} .author56__description",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ];

    $css[ 'name_font_size' ] = [
        [
            'property' => 'font-size',
            'selector' => "{{wrapper}} .author56__name",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'font-size',
            'selector' => "{{wrapper}} .author56__name",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'font-size',
            'selector' => "{{wrapper}} .author56__name",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ];

    $css[ 'description_font_size' ] = [
        [
            'property' => 'font-size',
            'selector' => "{{wrapper}} .author56__description",
            'unit' => 'px',
            'use' => 'desktop',
        ],
        [
            'property' => 'font-size',
            'selector' => "{{wrapper}} .author56__description",
            'unit' => 'px',
            'use' => 'tablet',
            'media_query' => $fox56_customize->tablet,
        ],
        [
            'property' => 'font-size',
            'selector' => "{{wrapper}} .author56__description",
            'unit' => 'px',
            'use' => 'mobile',
            'media_query' => $fox56_customize->mobile,
        ],
    ];

    $css[ 'color' ] = [
        [
            'property' => 'color',
            'selector' => "{{wrapper}}",
        ],
    ];

    $css[ 'name_color' ] = [
        [
            'property' => 'color',
            'selector' => "{{wrapper}} .author56__name",
        ],	
    ];

    $css[ 'description_color' ] = [
        [
            'property' => 'color',
            'selector' => "{{wrapper}} .author56__description",
        ],
    ];

    $css_collect = [];
    foreach ( $css as $k => $css_data ) {
        $value = isset( $args[ $k ] ) ? $args[ $k ] : $default[ $k ];
        if ( false !== strpos( $value, ',' ) ) {
            $value = explode( ',', $value );
            $value = array_map( 'absint', $value );
        }
        if ( is_array($value) && empty( $value ) ) {
            continue;
        }
        if ( is_array( $value ) ) {
            $value = [
                'desktop' => $value[0],
                'tablet' => isset( $value[1] ) ? $value[1] : 10,
                'mobile' => isset( $value[2] ) ? $value[2] : 10,
            ];
        }
        foreach( $css_data as $css_piece ) {
            if ( isset( $css_piece['use'] ) && isset( $value[ $css_piece['use'] ] ) ) {
                $final_value = $value[ $css_piece['use'] ];
            } else {
                $final_value = $value;
            }
            if ( '' === $final_value ) {
                continue;
            }
            if ( isset( $css_piece['unit'] ) ) {
                $final_value .= $css_piece['unit'];
            }
            if ( isset( $css_piece['value_pattern'] ) ) {
                $final_value = str_replace( '$', $final_value, $css_piece['value_pattern'] );
            }
            $selector = str_replace( '{{wrapper}}', '#' . $id, $css_piece['selector'] );
            $media_query = isset( $css_piece['media_query'] ) ? $css_piece['media_query'] : 'desktop';
            if ( ! isset( $css_collect[$media_query] ) ) {
                $css_collect[$media_query] = [];
            }
            if ( ! isset( $css_collect[$media_query][ $selector ] ) ) {
                $css_collect[$media_query][ $selector ] = [];
            }
            $css_collect[$media_query][ $selector ][] = $css_piece['property'] . ':' . $final_value;
        }
    }

    echo '<style>';
    foreach ( $css_collect as $media_query => $css_collect_by_media_query ) {
        if ( 'desktop' != $media_query ) {
            echo $media_query . '{';
        }
        foreach( $css_collect_by_media_query as $selector => $css_collect_selector ) {
            echo $selector . '{' . join( ';', $css_collect_selector ) . '}';
        }
        if ( 'desktop' != $media_query ) {
            echo '}';
        }
    }
    echo '</style>';

    /*
        'v_spacing' => '32,20,10',
        'v_sep' => '0px',
        'v_sep_color' => '',
        'h_sep' => '0px',
        'h_sep_color' => '',
        'avatar_text_gap' => '20,15,10',
        'avatar_size' => '120,90,50',
        'avatar_border_radius' => 150,
        'name_description_gap' => '6,5,4',
        // 'name_typography' => '',
        // 'description_typography' => '',
        'color' => '',
        'name_color' => '',
        'description_color' => '',
        */

    ?>
    <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( join( ' ', $cl ) ); ?>" data-id="<?php echo esc_attr( $widget_id ); ?>">

        <div class="authors56__container">

        <?php foreach ( $result as $user ) {
            /**
             * link
             */
            $author_link = get_author_posts_url( $user->ID, $user->user_nicename );

            /**
             * description
             */
            if ( 'description' == $description_displays ) {
                $desc = wpautop( do_shortcode( $user->description ) );
            } else {
                $description_post;
                $post_query_args = [
                    'author' => $user->ID,
                    'posts_per_page' => 1,
                    'ignore_sticky_posts' => true,
                    'no_found_rows' => true,
                    'order' => 'DESC',
                ];
                if ( in_array( $description_post, [ 'date', 'rand', 'modified', 'comment_count' ]) ) {
                    $post_query_args['orderby'] = $description_post;
                } elseif ( 'featured' == $description_post ) {
                    $post_query_args['featured'] = true;
                } elseif ( 'view' == $description_post ) {
                    $query_args[ 'orderby' ] = 'post_views';
                    
                } elseif ( 'view_week' == $description_post ) {
                    $query_args[ 'orderby' ] = 'post_views';
                    $query_args[ 'views_query' ] = [
                        'year' => date('Y'),
                        'week' => date('W'),
                    ];
                } elseif ( 'view_month' == $description_post ) {
                    $query_args[ 'orderby' ] = 'post_views';
                    $query_args[ 'views_query' ] = [
                        'year' => date('Y'),
                        'month' => date('n'),
                    ];
                } elseif ( 'view_year' == $description_post ) {
                    $query_args[ 'orderby' ] = 'post_views';
                    $query_args[ 'views_query' ] = [
                        'year' => date('Y'),
                    ];
                }
                $user_post_query = new WP_Query( $post_query_args );
                if ( $user_post_query->have_posts() ) {
                    $user_post_query->the_post();
                    $desc = '<a href="' . get_permalink() .  '">' . get_the_title() . '</a>';
                } else {
                    $desc = wpautop( do_shortcode( $user->description ) );
                }
                wp_reset_query();
            }
            ?>
            <div class="author56">
                <a href="<?php echo $author_link; ?>" class="author56__avatar">
                    <?php echo get_avatar( $user->ID, 300, '', $user->display_name ); ?>
                </a>
                <div class="author56__text">
                    <h3 class="author56__name">
                        <a href="<?php echo $author_link; ?>"><?php echo $user->display_name; ?></a>
                    </h3>
                    <div class="author56__description">
                        <?php echo $desc; ?>
                    </div><!-- .author56__description -->
                </div><!-- .author56__text -->

                <div class="author56__sep"></div>
            </div><!-- .author56 -->

        <?php } // each user ?>

            <div class="authors56__sep"></div>
            <div class="authors56__sep"></div>
            <div class="authors56__sep"></div>
            <div class="authors56__sep"></div>
            <div class="authors56__sep"></div>

        </div><!-- .authors56__container -->

    </div>

    <?php

    return ob_get_clean();

}


// PHP Snippet to create shortcode
// display nested list of posts by month year
function fox_post_index_shortcode( $atts ) {

    ob_start();

    extract( wp_parse_args( $atts, [
        'from_year' => '', // 1st post by default
        'to_year' => '', // now by default
    ]) );

    /* get valid from year
    --------------------------------------------- */
    $valid_from_year = false;
    if ( is_numeric( $from_year ) ) {
        $from_year = absint( $from_year );
        if ( $from_year > 1900 ) {
            $valid_from_year = true;
        }
    }
    if ( ! $valid_from_year ) {
        $oldest_post = get_posts([
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'ASC',
            'ignore_sticky_post' => true,
        ]);
        if ( is_array( $oldest_post ) && count( $oldest_post ) >= 1 ) {
            $from_year = get_the_date( 'Y', $oldest_post[0] );
        }
    }
    $from_year = absint( $from_year );
    if ( ! $from_year ) {
        $from_year = 2010;
    }

    /* get valid to year
    --------------------------------------------- */
    if ( ! $to_year ) {
        $to_year = date('Y');
    }
    $to_year = absint( $to_year );
    if ( ! $to_year ) {
        $to_year = 2026;
    }

    echo '<div class="fox56__sitemap">';

    /* now scan years
    --------------------------------------------- */
    for ( $y = $to_year; $y >= $from_year; $y-- ) {
        $args = [
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
            'year' => $y,
            'ignore_sticky_posts' => true,
        ];
        $query = new WP_Query( $args );
        $post_count = $query->found_posts;

        $ul = [];
        $prev_month = '';
        while ( $query->have_posts() ) {
            $query->the_post();
            $li_class = [];
            $month = get_the_date('M');
            if ( $month === $prev_month ) {
                $li_class[] = 'li-hide-month';
            } else {
                $li_class[] = 'li-has-month';
            }
            $prev_month = $month;
            $li = '<li class="' . join( ' ', $li_class ). '"><strong>' . $month . '</strong> <a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            $ul[] = $li;
        }
        wp_reset_query();
        if ( empty( $ul ) ) {
            continue;
        }

        echo '<div class="fox56__sitemap__item">';

        echo '<h2>' . $y . '<sup>' . $post_count . '</sup></h2>';
        $ul = join( "\n", $ul );
        $ul = '<ul>' . $ul . '</ul>';

        echo $ul;

        echo '</div>'; // sitemap__item

    }

    echo '</div>'; // fox56__sitemap

    return ob_get_clean();

}
add_shortcode( 'fox_post_index', 'fox_post_index_shortcode' );