<?php
/* MIGRATION
-------------------------------------------------------------------------------- */
add_action( 'init', 'fox56_builder_migrate_h', 1 );
add_action( 'admin_init', 'fox56_builder_migrate_h', 1 );
function fox56_builder_migrate_h() {

    // if we don't have 'h', we don't need to migrate
    if ( false === get_theme_mod( 'h', false ) ) {
        return;
    }

    // if we have sectionlist already, we don't need this anymore
    if ( false !== get_theme_mod( 'sectionlist', false ) ) {
        return;
    }

    $big_arr = fox56_builder_migrate_big_arr();
    $css_arr = fox56_builder_migrate_h_part( $big_arr );
    $h2 = [
        'css' => $css_arr,
    ];
    set_theme_mod( 'h2', $h2 );

}

function fox56_builder_migrate_h_part( $arr ) {
    $refresh = $arr[ 'refresh' ];
    set_theme_mod( $refresh[ 'widget_id' ], $refresh );
    $css_arr = [
        $refresh[ 'widget_id' ] => $arr[ 'css' ]
    ];
    foreach( $arr['children'] as $sub_id => $sub_arr ) {
        $sub_css_arr = fox56_builder_migrate_h_part( $sub_arr );
        $css_arr = array_merge( $css_arr, $sub_css_arr );
    }
    return $css_arr;
}

/**
 * RETURN $big_arr
 */
function fox56_builder_migrate_big_arr() {
    $big_arr = [
        'refresh' => [
            'type' => 'builder',
            'widget_id' => 'sectionlist',
        ],
        'css' => [],
    ];
    $children = [];

    $h = get_theme_mod( 'h', [] );
    if ( false === get_theme_mod( 'h_backup', false ) ) {
        set_theme_mod( 'h_backup', $h );
    }

    $h__css = [];
    $sectionlist = isset( $h['sectionlist'] ) ? $h['sectionlist'] : [];
    $content_new = [];

    foreach ( $sectionlist as $section_id ) {

        /* REFRESH PART
        ------------------------ */
        $widget_settings = get_theme_mod( $section_id, false );
        if ( false === $widget_settings ) {
            continue;
        }
        $section_css = get_theme_mod( $section_id . '__css', [] );
        $new_section_id = 'h2-' . $section_id;
        $widget_settings[ 'section_id' ] = $section_id;
        $widget_settings['type'] = 'section';

        $children[ $new_section_id ] = fox56_builder_migrate_section( $widget_settings, $section_css, $new_section_id );

    }

    $big_arr[ 'children' ] = $children;
    $big_arr['refresh'][ 'content' ] = array_keys( $children );
    return $big_arr;

}

/**
 * $widget_settings is the $section theme mod 
 */
function fox56_builder_migrate_section( $widget_settings, $css, $new_section_id ) {

    $children = fox56_builder_legacy_section_children( $widget_settings, $css );
    $content = array_keys( $children );

    $refresh = fox56_filter_by_type( $widget_settings, 'section' );
    $refresh[ 'content' ] = $content;
    $refresh[ 'widget_id' ] = $new_section_id;
    $refresh[ 'section_name' ] = isset( $css['section_name'] ) ? $css['section_name'] : 'Untitled';
    $css_filtered = fox56_filter_css_by_type( $css, 'section' );
    
    $arr = [
        'children' => $children,
        'refresh' => $refresh,
        'css' => $css_filtered,
    ];

    return $arr;

}


/**
 * RETURN array of content elements, ie. row, heading, ad..
 */
function fox56_builder_legacy_section_children( $section, $section_css ) {

    $section_children = [];

    /**
     * ad
     */
    $ad_arr = wp_parse_args( $section, [
        'ad_code' => false,
        'banner_image' => false,
        'banner_image_tablet' => false,
        'banner_image_mobile' => false
    ]);
    if ( ! empty( $ad_arr['ad_code'] ) || ! empty( $ad_arr['banner_image'] ) || ! empty( $ad_arr['banner_image_tablet'] ) || ! empty( $ad_arr['banner_image_mobile'] ) ) {
        $new_id = uniqid( 'legacy-' );
        $section_children[ $new_id ] = fox56_section_legacy_ad_element( $section, $section_css, $new_id );
    }

    /**
     * heading
     */
    $heading_arr = wp_parse_args( $section, [
        'heading' => '',
        'heading_empty' => false,
    ]);
    if ( $heading_arr['heading'] !== '' || $heading_arr['heading_empty'] ) {
        $new_id = uniqid( 'legacy-' );
        $section_children[ $new_id ] = fox56_section_legacy_heading_element( $section, $section_css, $new_id );
    }

    /**
     * the main element
     */
    $new_id = uniqid( 'legacy-' );
    $section_children[ $new_id ] = fox56_section_legacy_row_element( $section, $section_css, $new_id );
    return $section_children;
}

/**
 * convert section into an ad
 */
function fox56_section_legacy_ad_element( $section, $section_css, $new_id ) {
    $refresh = fox56_filter_by_type( $section, 'ad' );
    $refresh[ 'type' ] = 'ad';
    $refresh[ 'widget_id' ] = $new_id;
    $refresh[ 'content' ] = [];

    $css = fox56_filter_css_by_type( $section_css, 'ad' );
    return [
        'refresh' => $refresh,
        'css' => $css,
        'children' => [],
    ];
}

function fox56_section_legacy_heading_element( $section, $section_css, $new_id ) {
    $refresh = fox56_filter_by_type( $section, 'heading' );
    $refresh[ 'type' ] = 'heading';
    $refresh[ 'widget_id' ] = $new_id;
    $refresh[ 'content' ] = [];

    $css = fox56_filter_css_by_type( $section_css, 'heading' );
    return [
        'refresh' => $refresh,
        'css' => $css,
        'children' => [],
    ];
}

function fox56_section_legacy_row_element( $section, $section_css, $new_id ) {

    $row_refresh = fox56_filter_by_type( $section, 'row' );
    $row_refresh[ 'type' ] = 'row';
    $row_refresh[ 'widget_id' ] = $new_id;
    
    $row_css = fox56_filter_css_by_type( $section_css, 'row' );
    
    $col_id = uniqid('legacy-');
    $col_refresh = [
        'type' => 'column',
        'size' => '1-1',
        'widget_id' => $col_id,
        'content' => []
    ];
    $col_css = [];
    $col = [
        'refresh' => $col_refresh,
        'css' => $col_css
    ];
    
    /**
     * the main content
     */
    $main_id = uniqid('legacy-');
    $col[ 'children' ] = [
        $main_id => fox56_section_legacy_main_element( $section, $section_css, $main_id ) 
    ];

    /**
     * after code
     */
    if ( isset( $section['after_code'] ) && ! empty( $section['after_code'] ) ) {
        $html_id = uniqid('legacy-');
        $col[ 'children' ][ $html_id ] = [
            'refresh' => [
                'type' => 'html',
                'widget_id' => $html_id,
                'html' => $section['after_code'],
                'content' => []
            ],
            'css' => [],
            'children' => []
        ];
    }

    $col[ 'refresh' ][ 'content' ] = array_keys( $col['children'] );

    $row_children = [
        $col_id => $col 
    ];
    $row_refresh[ 'content' ] = array_keys( $row_children );
    
    return [
        'refresh' => $row_refresh,
        'children' => $row_children,
        'css' => $row_css
    ];

}

function fox56_section_legacy_main_element( $section, $section_css, $new_id ) {

    /**
     * LAYOUT
     */
    extract( wp_parse_args( $section, [
        'layout' => 'grid',
    ]) );
    $arr = [
        'grid' => 'post-grid',
        'list' => 'post-list',
        'masonry' => 'post-masonry',
        'group' => 'post-group',
        'carousel' => 'post-carousel',

        'sidebar' => 'sidebar',
        'page' => 'page',
        'html' => 'html',
    ];
    if ( isset( $arr[ $layout ] ) ) {
        $type = $arr[ $layout ];
    } else {
        $type = 'post-grid';
    }

    /**
     * we take only valid fields
     */
    $refresh = fox56_filter_by_type( $section, $type );
    $css = fox56_filter_css_by_type( $section_css, $type );
    $refresh['type'] = $type;
    $refresh[ 'widget_id' ] = $new_id;
    $refresh[ 'content' ] = [];
    return [
        'refresh' => $refresh,
        'css' => $css,
        'children' => []
    ];
}








function fox56_filter_css_by_type( $arr, $type ) {
    $fields = fox56_builder_get_fields_from_type( $type );
    if ( ! $fields ) {
        $fields = [];
    }
    $args = [];
    foreach ( $arr as $k => $v ) {
        if ( ! isset( $fields[ $k ] ) ) {
            continue;
        }
        if ( ! isset( $fields[ $k ]['css'])) {
            continue;
        }
        $args[$k] = $arr[$k];
    }
    return $args;
}

/**
 * so that we filter only neccesary keys for the array
 */
function fox56_filter_by_type( $arr, $type, $preserve = [ 'widget_id', 'section_name', 'type', 'content' ] ) {
    $fields = fox56_builder_get_fields_from_type( $type );
    if ( ! $fields ) {
        $fields = [];
    }
    $args = [];
    foreach ( $arr as $k => $v ) {
        if ( ! isset( $fields[ $k ] ) ) {
            continue;
        }
        // we don't take css stuff, It's a part of h__css
        if ( isset( $fields[ $k ]['css'])) {
            continue;
        }
        $args[$k] = $arr[$k];
    }
    foreach( $preserve as $k ) {
        if ( isset( $arr[$k] ) ) {
            $args[$k] = $arr[$k];
        }
    }
    return $args;
}

function fox56_builder_get_fields_from_type( $type ) {
    global $builder_widgets;
    if ( ! is_array( $builder_widgets ) ) {
        return;
    }
    if ( ! isset( $builder_widgets[ $type ] ) ) {
        return;
    }
    $instance = $builder_widgets[ $type ];
    return $instance->fields();
}