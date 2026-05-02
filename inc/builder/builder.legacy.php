<?php
/**
 * HEADING
 * ------------------------------------------------
 */
function fox56_builder_heading_inner( $section ) {

    extract( wp_parse_args( $section, [
        'heading' => '',
        'heading_empty' => false,
        'heading_style' => '',
        'heading_stretch' => 'content',
        'heading_align' => 'center',
        'heading_link' => [],
        'heading_link_position' => 'inheading',
        'heading_link_text' => '',
    ] ) );

    if ( ! $heading && ! $heading_empty ) {
        return;
    }
    if ( $heading_empty ) {
        $heading = '';
    }
    if ( function_exists( 'pll__' ) ) {
        $heading = pll__( $heading );
    }
    
    $cl = [ 'heading56', 'section56__heading' ];

    /**
     * STYLE
     */
    if ( $heading_style ) {
        $cl[] = 'heading56--' . $heading_style;
    }
    if ( in_array( $heading_style, [ 'middle-line', 'pixelate-dots', 'diagonal-stripe' ] ) ) {
        $cl[] = 'heading56--decorate-middle';
    }

    /**
     * STRETCH
     */
    if ( ! in_array( $heading_stretch, [ 'half', 'full' ] ) ) {
        $heading_stretch = 'content';
    }
    $cl[] = 'heading56--stretch-' . $heading_stretch;

    /**
     * ALIGN
     */
    if ( 'left' != $heading_align && 'right' != $heading_align ) {
        $heading_align = 'center';
    }
    $cl[] = 'heading56--' . $heading_align;

    /**
     * LINK
     */
    extract( wp_parse_args( $heading_link, [ 'url' => '', 'target' => '_self' ] ) );
    $a = ''; $a_close = '';
    $a_cl = [ 'heading56__link' ];
    if ( 'separated' != $heading_link_position ) {
        $heading_link_position = 'inheading';
    }
    $a_cl[] = 'heading56__link--' . $heading_link_position;
    if ( $url ) {
        if ( function_exists( 'pll__' )) {
            $url = pll__( $url );
        }
        $a = '<a href="' . esc_url( $url ). '" target="' . esc_attr( $target ). '" class="' . esc_attr( join( ' ', $a_cl ) ) . '">';
        $a_close = '</a>';
    }
    $separated_link = '';
    if ( 'inheading' != $heading_link_position ) {
        if ( ! $heading_link_text ) {
            $heading_link_text = esc_html__( 'View', 'wi' );
        }
        if ( function_exists( 'pll__' )) {
            $heading_link_text = pll__( $heading_link_text );
        }
        if ( $a && $a_close ) {
            $separated_link = $a . $heading_link_text . $a_close;
        }
    }
    ?>
<div class="heading56__wrapper">    
    <h2 class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php if ( 'inheading' == $heading_link_position ) { echo $a; } ?>
        <?php echo '<span class="heading56__text">'
             . $heading . 
            '<span class="heading56__line heading56__line--left"></span>
            <span class="heading56__line heading56__line--right"></span>
        </span>'; ?>
        <?php if ( 'inheading' == $heading_link_position ) { echo $a_close; } ?>
    </h2>
    <?php echo $separated_link; ?>
</div>
    <?php
}

/**
 * AD
 * ------------------------------------------------
 */
function fox56_builder_ad_inner( $section ) {
    extract( wp_parse_args( $section, [
        'ad_code' => '',
        'banner_image' => 0,
        'banner_image_tablet' => 0,
        'banner_image_mobile' => 0,
        'banner_link' => [],
        'ad_visibility' => 'desktop,tablet,mobile',
    ] ) );
    
    if ( ! $ad_code && ! $banner_image ) {
        return;
    }
    $cl = [ 'section56__ad', 'ad56' ];
    if ( $ad_code ) {
        $cl[] = 'ad56--code';
        ?>
        <div class="ad56__container">
            <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
                <?php echo $ad_code ; ?>
            </div>
        </div>
        <?php
        return;
    }

    $cl[] = 'ad56--banner';
    $cl[] = 'banner56';

    /**
     * LINK
     */
    extract( wp_parse_args( $banner_link, [ 'url' => '', 'target' => '_self' ] ) );
    $a = ''; $a_close = '';
    if ( $url ) {
        $a = '<a href="' . esc_url( $url ). '" target="' . esc_attr( $target ). '">';
        $a_close = '</a>';
    }

    /**
     * VISIBILITY
     */
    if ( ! is_array( $ad_visibility ) ) {
        $ad_visibility = explode( ',', $ad_visibility );
    }
    if ( ! is_customize_preview() ) {
        $cl[] = in_array( 'desktop', $ad_visibility ) ? 'show--desktop' : 'hide--desktop';
        $cl[] = in_array( 'tablet', $ad_visibility ) ? 'show--tablet' : 'hide--tablet';
        $cl[] = in_array( 'mobile', $ad_visibility ) ? 'show--mobile' : 'hide--mobile';
    } else {
        $cl[] = in_array( 'desktop', $ad_visibility ) ? 'show--desktop' : 'disable--desktop';
        $cl[] = in_array( 'tablet', $ad_visibility ) ? 'show--tablet' : 'disable--tablet';
        $cl[] = in_array( 'mobile', $ad_visibility ) ? 'show--mobile' : 'disable--mobile';
    }

    $imgs = [];
    if ( $banner_image_mobile ) {
        $imgs[] = wp_get_attachment_image( $banner_image_mobile, 'full', false, [ 'class' => 'banner56--mobile' ]);
    }
    if ( $banner_image_tablet ) {
        $imgs[] = wp_get_attachment_image( $banner_image_tablet, 'full', false, [ 'class' => 'banner56--tablet' ]);
    }
    if ( $banner_image ) {
        $imgs[] = wp_get_attachment_image( $banner_image, 'full', false, [ 'class' => 'banner56--desktop' ]);
    }
    ?>
<div class="ad56__container">
    <div class="<?php echo esc_attr( join( ' ', $cl ) ); ?>">
        <?php echo $a; ?>
        <?php echo join( "\n", $imgs ); ?>
        <?php echo $a_close; ?>
    </div>
</div>
    <?php
}

/**
 * $sb is 'main', 'my_sidebar'
 * ------------------------------------------------
 */
function fox56_builder_sidebar_inner( $sb ) {
    if ( ! $sb ) {
        return;
    }
    dynamic_sidebar(  $sb );
}

/**
 * 
 * ------------------------------------------------
 */
function fox56_builder_primary_inner( $section ) {
    $layout = isset( $section['layout'] ) ? $section['layout'] : 'grid';

    switch( $layout ) {
        
        case 'grid' :
            fox56_builder_grid( $section );
        break;

        case 'masonry' :
            fox56_builder_masonry( $section );
        break;

        case 'list' :
            fox56_builder_list( $section );
        break;

        case 'group' :
            fox56_builder_group( $section );
        break;

        case 'carousel' :
            fox56_builder_carousel( $section );
        break;

        case 'sidebar' :
            fox56_builder_main_sidebar( $section );
        break;

        case 'html' :
            fox56_builder_html( $section );
        break;

        case 'page' :
            fox56_builder_page_content( $section );
        break;
            
        default :
        break;
    }
    wp_reset_query(); // in case we forget
}

/**
 * $components = [thumbnail,title,date,excerpt, title-general,title-desktop,title-mobile,date-tablet,date-mobile] is the input from Customizer
 * $std = only components without devices: [thumbnail,title,date..]
 * RETURN array of existing component => devices
 * title => [ desktop, mobile ], date => [ tablet, mobile ]..
 */
function fox56_friendly_components( $components = [] ) {

    $components_order = [];
    $visibility = [];
    foreach ( $components as $com ) {
        $device = null;
        if ( substr( $com, 0, 8 ) == 'tablet--') {
            $device = 'tablet';
            $original_com = substr( $com, 8 );
        } elseif ( substr( $com, 0, 8 ) == 'mobile--') {
            $device = 'mobile';
            $original_com = substr( $com, 8 );
        } elseif ( substr( $com, 0, 9 ) == 'general--' ) {
            $device = 'general';
            $original_com = substr( $com, 9 );
        } elseif ( substr( $com, 0, 9 ) == 'desktop--' ) {
            $device = 'desktop';
            $original_com = substr( $com, 9 );
        } else {
            $components_order[] = $com;
            $original_com = $com;
        }
        if ( ! isset( $visibility[ $original_com ] ) ) {
            $visibility[ $original_com] = [];
        }
        if ( $device ) {
            $visibility[ $original_com ][] = $device;
        }
    }
    foreach ( $visibility as $com => $devices ) {
        if ( empty( $devices ) ) {
            unset( $visibility[$com]);
        }
    }
    $final = [];
    foreach ( $components_order as $com ) {
        if ( isset( $visibility[$com] ) ) {
            $final[$com] = $visibility[$com];
        }
    }

    return $final;

}

/**
 * $components_std = [thumbnail,title,date,author,view].. order of components and redundant
 * $component_arr = [ thumbnail,title,excerpt] only existing components
 * RETURN array with all devices filled
 * title, thumbnail => title-general, title-desktop, title-mobile..
 */
function fox56_components_fill_devices( $components_std, $component_arr ) {
    foreach ( $component_arr as $com ) {
        $components_std[] = "general--{$com}";
        $components_std[] = "desktop--{$com}";
        $components_std[] = "tablet--{$com}";
        $components_std[] = "mobile--{$com}";
    }
    return $components_std;
}

/**
 * RETURN array of popular args (components..)
 */
function fox56_builder_popular_args( $section ) {

    $args = wp_parse_args( $section, [
        'layout' => 'grid',
        'column' => [ 'desktop' => 3, 'tablet' => 2, 'mobile' => 1 ],
        
        // post style: normal/overlay
        'post_style' => 'normal',
        'ontop_height_style' => 'ratio',
        'ontop_valign' => 'middle',

        // list_mobile_layout
        'list_mobile_layout' => '',

        // align
        'align' => 'left',
        'valign' => 'top',

        // thumbnail
        'thumbnail_loading' => 'lazy',
        'thumbnail' => 'thumbnail-medium',
        'thumbnail_rich' => false,
        'thumbnail_custom' => [],
        'thumbnail_caption' => false,
        'thumbnail_hover_effect' => '',
        'thumbnail_hover_logo' => 0,
        'thumbnail_position' => 'left',
        
        'excerpt_content' => 'excerpt',
        'excerpt_hellip' => get_theme_mod( 'excerpt_hellip', false ),
        'excerpt_length' => 24,
        'title_tag' => 'h2',
        'date_format' => '',
        'date_type' => '',
        'author_avatar' => false,
        'category_tax' => '',
        'more_style' => 'primary',

        // components
        'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt' ],
    ]);

    /* list_mobile_layout */
    if ( ! in_array( $args['list_mobile_layout'], [ 'list', 'grid' ] ) ) {
        $args['list_mobile_layout'] = get_theme_mod( 'list_mobile_layout', 'list' );
    }

    /**
     * THUMBNAIL COMPONENTS
     */
    $thumbnail_components = isset( $args[ 'thumbnail_components'] ) ? $args['thumbnail_components'] : [ 'format_indicator' ];
    if ( ! is_array( $thumbnail_components ) ) {
        $thumbnail_components = explode(',',$thumbnail_components);
    }
    $args[ 'thumbnail_format_indicator' ] = in_array( 'format_indicator', $thumbnail_components );
    $args[ 'thumbnail_caption' ] = in_array( 'caption', $thumbnail_components );
    $args[ 'thumbnail_review' ] = in_array( 'review', $thumbnail_components );
    $args[ 'thumbnail_view' ] = in_array( 'view', $thumbnail_components );

    return $args;
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_grid( $section ) {
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );
    fox56_blog_grid( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_masonry( $section ) {
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );
    fox56_blog_masonry( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_list( $section ) {
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );
    $args['layout'] = 'list';

    // thumbnail width
    $args[ 'thumbnail_width_type' ] = isset( $section['thumbnail_width_type'] ) ? $section['thumbnail_width_type'] : 'percent';

    fox56_blog_list( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_carousel( $section ) {
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );

    /**
     * more carousel args
     */
    $args[ 'carousel_hint' ] = isset( $section['carousel_hint'] ) ? $section['carousel_hint'] : false;

    fox56_blog_carousel( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_group( $section ) {
    
    $query = fox56_builder_query( $section );
    if ( ! $query ) {
        return;
    }
    $args = fox56_builder_popular_args( $section );

    /**
     * group layout
     */
    $args[ 'group_layout' ] = isset( $section['group_layout'] ) ? $section['group_layout'] : '2-1';
    $args[ 'big_number' ] = isset( $section['big_number'] ) ? $section['big_number'] : 1;
    $args[ 'medium_number' ] = isset( $section['medium_number'] ) ? $section['medium_number'] : 1;

    /**
     * col options
     */
    $cols = [
        'big' => [
            'layout' => 'grid',
            'column' => '1',
            'tablet_column' => '1',
            'mobile_column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
            'excerpt_length' => 32,
            'thumbnail' => 'thumbnail-large',
            'thumbnail_custom' => [ 'width' => 800, 'height' => 400 ],
            'thumbnail_rich' => false,
            'align' => 'left',
            'more_style' => 'primary',
        ],
        'medium' => [
            'layout' => 'grid',
            'column' => '1',
            'tablet_column' => '1',
            'mobile_column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'standalone_category', 'title', 'date', 'excerpt', 'more' ],
            'excerpt_length' => 32,
            'thumbnail' => 'medium',
            'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
            'thumbnail_rich' => false,
            'align' => 'left',
            'more_style' => 'plain',
        ],
        'small' => [
            'layout' => 'grid',
            'column' => '1',
            'tablet_column' => '1',
            'mobile_column' => '1',
            'number' => 1,
            'components' => [ 'thumbnail', 'title', 'excerpt' ],
            'excerpt_length' => 12,
            'thumbnail' => 'thumbnail-medium',
            'thumbnail_custom' => [ 'width' => 400, 'height' => 300 ],
            'thumbnail_rich' => false,
            'align' => 'left',
            'more_style' => 'plain',
        ],
    ];
    foreach ( $cols as $col => $std ) {
        foreach( $std as $key => $val ) {
            if ( 'components' == $key ) {
                continue;
            }
            $args[ "{$col}_{$key}" ] = isset( $section[ "{$col}_{$key}" ] ) ? $section[ "{$col}_{$key}" ] : $std[ $key ];
        }
    }

    /**
     * force options
     */
    $args[ 'thumbnail_text_gap' ] = [ 'desktop' => 12, 'tablet' => 10, 'mobile' => 8 ];
    $args[ 'thumbnail_width_type' ] = 'pixel';
    $args[ 'thumbnail_position' ] = 'right';

    fox56_blog_group( $query, $args );
}

/**
 * RETURN void
 * ECHO
 */
function fox56_builder_main_sidebar( $section ) {
    extract( wp_parse_args( $section, [
        'main_sidebar' => '',
        'sidebar_layout' => '3',
    ]));

    if ( ! $main_sidebar ) {
        if ( current_user_can( 'manage_options' ) ) {
            echo '<p class="fox-error">Please choose a sidebar to display</p>';
        }
        return;
    }

    if ( ! is_active_sidebar( $main_sidebar ) ) {
        if ( current_user_can( 'manage_options' ) ) {
            echo '<p class="fox-error">Your sidebar is currently empty. Please go to <strong>Appearance > Widgets</strong> to drop widgets there!</p>';
        }
        return;
    }

    $cl = [ 'main-section-sidebar' ];
    if ( ! in_array( $sidebar_layout, [ '1', '2', '3', '4' ] ) ) {
        $sidebar_layout = '3';
    }
    $cl[] = 'main-section-sidebar-' . $sidebar_layout;

    echo '<div class="' . esc_attr( join( ' ', $cl ) ) . '"><div class="section-sidebar-inner">';

    dynamic_sidebar( $main_sidebar );

    echo '</div></div>';

}

/**
 * HTML
 */
function fox56_builder_html( $section ) {

    $html = isset( $section[ 'html' ] ) ? $section[ 'html' ] : '';
    echo '<div class="section-shortcode">';
    echo do_shortcode( $html );
    echo '</div>';

}

/**
 * Page Content
 */
function fox56_builder_page_content( $section ) {
    $page_id = isset( $section[ 'page' ] ) ? $section[ 'page' ] : '';
    $page_id = str_replace( 'page_', '', $page_id );
    if ( ! $page_id ) {
        return;
    }
    
    // we should use WP_Query instead of get_post
    // so that we can pass the_content instead of get_the_content
    $query = new WP_Query([
        'p' => $page_id,
        'post_type' => 'page',
        'post_status' => 'publish',
    ]);
    
    if ( $query->have_posts() ) {
        while( $query->have_posts() ) {
            $query->the_post();
            echo '<div class="section-page-content">';
            the_content();
            echo '</div>';
        }
    }
    wp_reset_query();
}

/**
 * regulate the data, so that It's can be wrong
 */
// add_action( 'init', 'fox56_init_h2', 2 );
// add_action( 'admin_init', 'fox56_init_h2', 2 );
function fox56_init_h2() {

    /**
     * SECTIONLIST
     */
    $sectionlist = get_theme_mod( 'sectionlist' );
    $change = false;
    if ( ! is_array( $sectionlist ) ) {
        $sectionlist = [
            'type' => 'builder',
            'widget_id' => 'sectionlist',
            'content' => []
        ];
        $change = true;
    }
    if ( ! isset( $sectionlist['type'] ) || 'builder' != $sectionlist['type'] ) {
        $sectionlist['type'] = 'builder';
        $change = true;
    }
    if ( ! isset( $sectionlist['widget_id'] ) || 'sectionlist' != $sectionlist['widget_id'] ) {
        $sectionlist['widget_id'] = 'sectionlist';
        $change = true;
    }
    if ( ! isset( $sectionlist['content'] ) || ! is_array( $sectionlist['content'] ) ) {
        $sectionlist['content'] = [];
        $change = true;
    }
    if ( $change ) {
        set_theme_mod( 'sectionlist', $sectionlist );
    }
}


function fox56_builder_widget_json( $widget_id, $h__css = null ) {
    $settings = get_theme_mod( $widget_id, [] );
    if ( ! is_array( $h__css ) ) {
        $h2 = get_theme_mod( 'h2', [] );
        $h__css = isset( $h2['css'] ) ? $h2['css'] : [];
        if ( ! is_array($h__css)) {
            $h__css = [];
        }
    }
    if ( ! is_array( $settings ) ) {
        return false;
    }
    $content = isset( $settings[ 'content' ] ) ? $settings[ 'content' ] : [];
    $children = [];
    foreach( $content as $sub_id ) {
        $children[] = fox56_builder_widget_json( $sub_id );
    }
    $css = isset( $h__css[ $widget_id ] ) ? $h__css[ $widget_id ] : [];
    $settings[ 'children' ] = $children;

    $json = [];
    $json[ 'css' ] = $css;
    $json[ 'refresh' ] = $settings;
    
    return $json;
}