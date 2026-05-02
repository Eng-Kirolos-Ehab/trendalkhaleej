<?php
include_once(dirname( __FILE__ ).'/builder.widget.base.php' );
include_once(dirname( __FILE__ ).'/builder.options.php' );
include_once(dirname( __FILE__ ).'/builder.migrate.php' );
include_once(dirname( __FILE__ ).'/builder.legacy.php' );
include_once(dirname( __FILE__ ).'/builder.query.php' );
include_once(dirname( __FILE__ ).'/builder.css.php' );

/* ================================================================================
REGISTER WIDGETS
================================================================================ */
function fox56_register_widgets( $widgets_manager ) {

    global $builder_widgets;

	require_once( __DIR__ . '/widgets/builder.php' );
    require_once( __DIR__ . '/widgets/section.php' );
    require_once( __DIR__ . '/widgets/row.php' );
    require_once( __DIR__ . '/widgets/column.php' );
	require_once( __DIR__ . '/widgets/heading.php' );
    require_once( __DIR__ . '/widgets/button.php' );
    require_once( __DIR__ . '/widgets/image.php' );
    require_once( __DIR__ . '/widgets/text.php' );
    require_once( __DIR__ . '/widgets/spacer.php' );

    require_once( __DIR__ . '/widgets/separator.php' );
    
    require_once( __DIR__ . '/widgets/post-grid.php' );
    require_once( __DIR__ . '/widgets/post-list.php' );
    require_once( __DIR__ . '/widgets/post-group.php' );
    require_once( __DIR__ . '/widgets/post-carousel.php' );
    require_once( __DIR__ . '/widgets/post-masonry.php' );

    require_once( __DIR__ . '/widgets/authors.php' );

    require_once( __DIR__ . '/widgets/html.php' );
    require_once( __DIR__ . '/widgets/sidebar.php' );
    require_once( __DIR__ . '/widgets/ad.php' );
    require_once( __DIR__ . '/widgets/page.php' );
    require_once( __DIR__ . '/widgets/subscribe-form.php' );

	$builder_widgets[ 'builder' ] = new \Fox56_Builder_Builder();
    $builder_widgets[ 'section' ] = new \Fox56_Builder_Section();
    $builder_widgets[ 'row' ] = new \Fox56_Builder_Row();
    $builder_widgets[ 'column' ] = new \Fox56_Builder_Column();
    $builder_widgets[ 'heading' ] = new \Fox56_Builder_Heading();
    $builder_widgets[ 'button' ] = new \Fox56_Builder_Button();
    $builder_widgets[ 'spacer' ] = new \Fox56_Builder_Spacer();
    $builder_widgets[ 'text' ] = new \Fox56_Builder_Text();
    $builder_widgets[ 'image' ] = new \Fox56_Builder_Image();

    $builder_widgets[ 'separator' ] = new \Fox56_Builder_Separator();

    $builder_widgets[ 'post-grid' ] = new \Fox56_Builder_Post_Grid();
    $builder_widgets[ 'post-list' ] = new \Fox56_Builder_Post_List();
    $builder_widgets[ 'post-group' ] = new \Fox56_Builder_Post_Group();
    $builder_widgets[ 'post-carousel' ] = new \Fox56_Builder_Post_Carousel();
    $builder_widgets[ 'post-masonry' ] = new \Fox56_Builder_Post_Masonry();

    $builder_widgets[ 'authors' ] = new \Fox56_Builder_Authors();
    
    $builder_widgets[ 'html' ] = new \Fox56_Builder_HTML();
    $builder_widgets[ 'sidebar' ] = new \Fox56_Builder_Sidebar();
    $builder_widgets[ 'ad' ] = new \Fox56_Builder_Ad();
    $builder_widgets[ 'page' ] = new \Fox56_Builder_Page();
    $builder_widgets[ 'subscribe-form' ] = new \Fox56_Builder_Subscribe_Form();

}
add_action( 'init', 'fox56_register_widgets', 0 );
add_action( 'admin_init', 'fox56_register_widgets', 0 );

/* ================================================================================
RENDER BUILDER, WIDGETS
================================================================================ */
/**
 * this is the main function that will be used in home.php
 * ------------------------------------------------
 */
function fox56_builder() {
    global $builder_posts; // list of IDs, this is for unique post rendering
    $builder_posts = [];
    fox56_builder_render_widget_id( 'sectionlist' );
}

/**
 * render widget from $widget_id
 * ------------------------------------------------
 */
function fox56_builder_render_widget_id( $widget_id ) {

    $widget_settings = get_theme_mod( $widget_id, [] );
    if ( 'sectionlist' == $widget_id ) {
        $widget_settings[ 'type' ] = 'builder';
        $widget_settings[ 'widget_id' ] = $widget_id;
    }
    fox56_builder_render_widget( $widget_settings );

}

/**
 * render widget from $widget_settings
 * ------------------------------------------------
 */
function fox56_builder_get_instance_from_type( $type ) {
    global $builder_widgets;
    if ( ! is_array( $builder_widgets ) ) {
        return;
    }
    if ( ! isset( $builder_widgets[ $type ] ) ) {
        return;
    }
    return $builder_widgets[ $type ];
}
function fox56_builder_render_widget( $widget_settings ) {

    $type = isset( $widget_settings['type'] ) ? $widget_settings['type'] : '';
    $instance = fox56_builder_get_instance_from_type( $type );
    if ( ! $instance ) {
        return;
    }
    $instance->final_render( $widget_settings );

}

/**
 * render widget content
 * $content is an array of IDs []
 * ------------------------------------------------
 */
function fox56_builder_render_widget_content( $content = [] ) {
    foreach ( $content as $sub_widget_id ) {
        fox56_builder_render_widget_id( $sub_widget_id );
    }
}

/* ================================================================================
TEMPLATE FUNCTIONS
================================================================================ */
// RETURN array widget_id => widget_settings
function fox56_builder_widgetlist() {
    global $fox_widgets;
    if ( ! is_array( $fox_widgets ) ) {
        $fox_widgets = [];
        $ids = fox56_builder_cone_ids( 'sectionlist' );
        foreach( $ids as $id ) {
            if ( 'sectionlist' != $id ) {
                $fox_widgets[ $id ] = get_theme_mod( $id, [] );
            }
        }
    }
    return $fox_widgets;
}

function fox56_builder_cone_ids( $widget_id ) {
    $arr = [ $widget_id ];
    $settings = get_theme_mod( $widget_id, [] );
    $content = isset( $settings[ 'content' ] ) ? $settings[ 'content' ] : [];
    foreach( $content as $sub_id ) {
        $arr = array_merge( $arr, fox56_builder_cone_ids( $sub_id ) );
    }
    return $arr;
}