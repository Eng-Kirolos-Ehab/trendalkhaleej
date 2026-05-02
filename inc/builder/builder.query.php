<?php
/**
 * RETURN array of cat IDs
 * ------------------------------------------------
 */
function fox56_get_category_by_slug_i18n( $cat_slug ) {
    $term_qr_args = [
        'slug' => $cat_slug,
        'number' => 1,
        'taxonomy' => 'category',
    ];
    if ( function_exists( 'pll_default_language' ) ) {
        $term_qr_args[ 'lang' ] = pll_default_language();
    }
    $qr_terms = get_terms( $term_qr_args );
    $term_id = 0;
    if ( $qr_terms ) {
        $term_id = $qr_terms[0]->term_id;
        if ( function_exists( 'pll_get_term' ) ) {
            $term_id = pll_get_term( $term_id );
        }
    }
    return $term_id;
}

/**
 * $cats is often array [ cat--business, cat--lifestyle, cat--slug ]
 * but for historical reason, it can be something bad like [ 16, cat--business ]
 * 
 * output: [ business_ID, lifestyle_ID ]
 */
if ( ! function_exists( 'fox56_builder_get_cat_array' ) ) :
function fox56_builder_get_cat_array( $cats ) {
    $arr = [];
    foreach ( $cats as $cat ) {
        // cat--
        if ( 0 === strpos( $cat, 'cat--' ) ) {
            // ID
            $cat_remaining = substr( $cat, 5 );
            $cat_id = false;
            if ( is_numeric( $cat_remaining ) ) {
                $cat_id = intval( $cat_remaining );
            } else {
                $cat_slug = $cat_remaining;
                $cat_id = fox56_get_category_by_slug_i18n( $cat_slug );
            }
            if ( $cat_id ) {
                $arr[] = $cat_id;
            }
            continue;
        }
        if ( is_numeric( $cat) ) {
            $arr[] = intval( $cat );
        }
    }
    return $arr;
}
endif;

/**
 * RETURN array of author IDs
 * ------------------------------------------------
 */
if ( ! function_exists( 'fox56_builder_get_author_array') ) :
function fox56_builder_get_author_array( $authors ) {
    $arr = [];
    foreach ( $authors as $author ) {
        if ( 0 === strpos( $author, 'author--' ) ) {
            $author_id = intval( substr( $author, 8 ) );
            $arr[] = $author_id;
            continue;
        }
        if ( is_numeric( $author ) ) {
            $arr[] = intval( $author );
        }
    }
    return $arr;
}
endif;

/**
 * builder query functions
 */

/**
 * $args is the $widget_settings
 * RETURN array
 * ------------------------------------------------
 */
if ( ! function_exists( 'fox56_builder_query_args' ) ) :
function fox56_builder_query_args( $args ) {

    $query_args = [
        'post_status' => 'publish',
        'no_found_rows' => true,
        'ignore_sticky_posts' => true,
    ];

    $section_query_args = wp_parse_args( $args, [
        'include' => '',
        'exclude' => '',
        
        'number' => 3,
        'featured' => false,
        'categories' => [],
        'exclude_categories' => [],
        'tags' => '',
        'exclude_tags' => '',
        'authors' => [],
        'offset' => '',
        'format' => '',
        'orderby' => '',
        'order' => '',

        'exclude_sticky' => false,
        'exclude_featured_posts' => false,

        'pagination' => false,
        'post_type' => '',
        'exclude_displayed' => '',

        'tax_1' => '',
        'tax_1_value' => '',
        'tax_2' => '',
        'tax_2_value' => '',

        'additional_query' => '',
    ]);

    /* INCLUDE
     * quickly return
    ------------------------------ */
    $include = $section_query_args[ 'include' ];
    if ( ! empty( $include ) ) {
        $include_ids = explode( ',', $include );
        $include_ids = array_map( 'absint', $include_ids );
        $query_args[ 'post__in' ] = $include_ids;
        $query_args[ 'orderby' ] = 'post__in';
        $query_args[ 'order' ] = 'ASC';

        return $query_args;
    }

    /* exclude posts
    ------------------------------ */
    $exclude_posts = [];
    if ( $section_query_args[ 'exclude_sticky' ] ) {
        $sticky_posts = (array) get_option('sticky_posts');
        $exclude_posts = array_merge( $exclude_posts, $sticky_posts );
    }

    // make sure featured not checked, otherwise, It'll contradictory
    if ( $section_query_args[ 'exclude_featured_posts' ] ) {

        $query_args[ 'meta_query' ] = array(
            'relation' => 'OR',
            array(
                'key' => '_is_featured',
                'value' => 'yes',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key' => '_is_featured',
                'value' => 'yes',
                'compare' => '!=',
            ),
        );

        /*
        deprecated since v6.7
        $featured_query = new WP_Query([
            'posts_per_page' => -1,
            'featured' => true,
            'post_type' => 'any',
            'post_status' => 'any',
        ]);
        while ( $featured_query->have_posts()) {
            $featured_query->the_post();
            $exclude_posts[] = get_the_ID();
        }
        wp_reset_query();
        */
    }

    /* number
    ------------------------------ */
    $number = $section_query_args[ 'number' ];
    if ( ! is_numeric( $number ) ) {
        $number = get_option( 'posts_per_page', 10 );
    }
    if ( ! is_numeric( $number ) ) {
        $number = 10;
    }
    $query_args[ 'posts_per_page' ] = $number;

    /* featured
    ------------------------------ */
    if ( $section_query_args['featured'] ) {
        $query_args[ 'featured' ] = true;
    }

    /* category
    ------------------------------ */
    $categories = $section_query_args['categories'];
    if ( ! empty( $categories ) ) {
        $categories = fox56_builder_get_cat_array( $categories );
        if ( count( $categories ) >= 2 ) {
            $query_args[ 'category__in' ] = $categories;
        } elseif ( 1 == count( $categories ) ) {
            $query_args[ 'cat' ] = $categories[0];
        }
    }

    /* exclude category
    ------------------------------ */
    $exclude_categories = $section_query_args[ 'exclude_categories' ];
    if ( ! empty( $exclude_categories ) ) {
        $exclude_categories = fox56_builder_get_cat_array( $exclude_categories );
        $query_args[ 'category__not_in' ] = $exclude_categories;
    }

    /* tags
    ------------------------------ */
    $tag_ids = $section_query_args[ 'tags' ];
    if ( ! empty( $tag_ids ) ) {
        $tag_ids = explode( ',', $tag_ids );
        $tag_ids = array_map( 'intval', $tag_ids );
        if ( function_exists( 'pll_get_term' ) ) {
            $tag_ids = array_map( 'pll_get_term', $tag_ids );
        }
        $query_args[ 'tag__in' ] = $tag_ids;
    }

    /* tags not in
    ------------------------------ */
    $exclude_tag_ids = $section_query_args[ 'exclude_tags' ];
    if ( ! empty( $exclude_tag_ids ) ) {
        $tag_ids = explode( ',', $exclude_tag_ids );
        $tag_ids = array_map( 'intval', $tag_ids );
        if ( function_exists( 'pll_get_term' ) ) {
            $tag_ids = array_map( 'pll_get_term', $tag_ids );
        }
        $query_args[ 'tag__not_in' ] = $tag_ids;
    }

    /* authors
    ------------------------------ */
    $authors = $section_query_args[ 'authors' ];
    if ( ! empty( $authors ) ) {
        $authors = fox56_builder_get_author_array( $authors );
        $query_args[ 'author__in' ] = $authors;
    }

    /* offset
    ------------------------------ */
    $offset = $section_query_args['offset'];
    if ( $offset && is_numeric( $offset ) ) {
        $query_args[ 'offset' ] = $offset;
    }

    /* exclude
    ------------------------------ */
    $exclude = $section_query_args['exclude'];
    $exclude_ids = [];

    /* exclude previously posts
    ------------------------------ */
    $exclude_displayed = $section_query_args[ 'exclude_displayed' ];
    if ( 'true' == $exclude_displayed ) {
        $exclude_displayed = true;
    } elseif ( 'false' == $exclude_displayed ) {
        $exclude_displayed = false;
    } else {
        $exclude_displayed = get_theme_mod( 'builder_unique_reading', false );
    }
    if ( $exclude_displayed ) {
        global $builder_posts;
        if ( ! is_array( $builder_posts) ) {
            $builder_posts = [];
        }
        $exclude_ids = array_merge( $exclude_ids, $builder_posts );
    }

    if ( ! empty( $exclude ) ) {
        $exclude_ids = explode( ',', $exclude );
        $exclude_ids = array_map( 'absint', $exclude_ids );
    }
    $exclude_ids = array_merge( $exclude_ids, $exclude_posts );
    if ( ! empty( $exclude_ids) ) {
        $query_args[ 'post__not_in' ] = $exclude_ids;
    }

    /* format
    ------------------------------ */
    $format = $section_query_args['format'];
    if ( in_array( $format, [ 'video', 'audio', 'gallery', 'link' ] ) ) {
            
        $query_args[ 'tax_query' ] = array(
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => array( 'post-format-' . $format ),
            ),
        );
        
    } elseif ( $format == 'standard' ) {

        $query_args[ 'tax_query' ] = array(
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => array( 'post-format-video', 'post-format-audio', 'post-format-link', 'post-format-gallery', ),
                'operator' => 'NOT IN',
            ),
        );

    }

    /* order
    ------------------------------ */
    $orderby = $section_query_args['orderby'];
    $order = $section_query_args['order'];
    if ( 'ASC' != $order ) {
        $order = 'DESC';
    }
    if ( 'view' === $orderby ) {
            
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'view_week' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'views_query' ] = [
            'year' => date('Y'),
            'week' => date('W'),
        ];
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'view_month' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'views_query' ] = [
            'year' => date('Y'),
            'month' => date('n'),
        ];
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'view_year' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'post_views';
        $query_args[ 'views_query' ] = [
            'year' => date('Y'),
        ];
        $query_args[ 'order' ] = $order;
        
    } elseif ( 'review_score' == $orderby || 'review_date' == $orderby ) {
        
        $query_args[ 'orderby' ] = 'meta_value_num';
        $query_args[ 'meta_key' ] = '_wi_review_average';
        $query_args[ 'meta_value_num' ] = 0;
        $query_args[ 'meta_compare' ] = '>';
        
        if ( 'review_date' == $orderby ) {
            $query_args[ 'orderby' ] = 'date';
        }
        
        $query_args[ 'order' ] = $order;
        
    } elseif ( ! empty( $orderby ) ) {
        
        $query_args[ 'orderby' ] = $orderby;
        $query_args[ 'order' ] = $order;
        
    }

    /* CPT
    ------------------------------ */
    $post_type = $section_query_args[ 'post_type' ];
    if ( ! empty( $post_type ) ) {
        if ( 'any' == $post_type ) {
            $query_args[ 'post_type' ] = 'any';
        } else {
            if ( ! is_array( $post_type ) ) {
                $post_type = explode( ',', $post_type );
                $post_type = array_map( 'trim', $post_type );
            }
            $query_args[ 'post_type' ] = $post_type;
        }
    }

    /* TAX
    ------------------------------ */
    $tax_query = [];
    for ( $j = 1; $j <=2; $j++ ) {
        if ( $section_query_args[ 'tax_' . $j ] && $section_query_args[ 'tax_' . $j . '_value' ] ) {
            
            $terms = $section_query_args[ 'tax_' . $j . '_value' ];
            $terms = explode( ',', $terms );
            $terms = array_map( 'trim', $terms );
            $tax_query[] = [
                'taxonomy' => $section_query_args[ 'tax_' . $j ],
                'field'    => 'name',
                'terms'    => $terms,
            ];
            
        }
    }
    if ( $tax_query ) {
        if ( ! isset( $query_args[ 'tax_query' ] ) ) {
            $query_args[ 'tax_query' ] = [];
        }
        $query_args[ 'tax_query' ] = array_merge( $query_args[ 'tax_query' ], $tax_query );
    }

    /* pagination
    ------------------------------ */
    if ( $section_query_args[ 'pagination' ] ) {
        $query_args[ 'no_found_rows' ] = false;
        $query_args[ 'paged' ] = get_query_var( 'paged' );
        // adjust offset accordingly
        $offset = absint( $offset );
        if ( $offset > 0 && absint( $query_args[ 'paged' ] ) > 1 ) {
            $offset = $offset + ( ( absint( $query_args[ 'paged' ] ) - 1 ) * absint( $query_args[ 'posts_per_page' ] ) );
            $query_args[ 'offset' ] = $offset;
        }
    } else {
        $query_args[ 'no_found_rows' ] = true;
    }

    /* additional queries
    ------------------------------ */
    if ( isset( $section_query_args[ 'additional_query' ] ) && ! empty( trim( $section_query_args['additional_query'] ) ) ) {
        $additional_query_decode = json_decode( $section_query_args[ 'additional_query' ], true );
        if ( ! empty( $additional_query_decode ) ) {
            $query_args = wp_parse_args( $additional_query_decode, $query_args );
        }
    }

    return $query_args;

}
endif;

/**
 * RETURN WP_Query instance if have_posts
 * RETURN null if not
 * 
 * $args is the args of the widget
 * ------------------------------------------------
 */
if ( ! function_exists( 'fox56_builder_query') ) :
function fox56_builder_query( $args ) {

    $do_custom_query = false;
    if ( isset( $args[ 'custom_query' ] ) && ! empty( trim( $args['custom_query'] ) ) ) {
        $custom_query_decode = json_decode( $args[ 'custom_query' ], true );
        if ( ! empty( $custom_query_decode ) ) {
            $query = new WP_Query( $custom_query_decode );
            $do_custom_query = true;
        }
    }
    if ( ! $do_custom_query ) {
        $query_args = fox56_builder_query_args( $args );
        $query = new WP_Query( $query_args );
    }
    if ( $query->have_posts() ) {
        return $query;
    }
    wp_reset_query();
    return;    
}
endif;

/**
 * adjust home posts_per_page
 */
add_action( 'pre_get_posts', 'fox56_builder_query_pagination_forever' );
function fox56_builder_query_pagination_forever( $query ) {
    if ( is_admin() ) {
        return;
    }
    if ( ! $query->is_main_query() ) {
        return;
    }
    if ( ! is_home() ) {
        return;
    }
    
    /**
     * set it to 1, so that we can go pagination infinitely
     */
    $query->set( 'posts_per_page', 1 );
}