<?php
add_action('delete_widget', 'fox56_widgets_unregister_wpml_strings', 999, 1);
function fox56_widgets_unregister_wpml_strings( $widget_id ) {
    global $wp_registered_widgets;
    try {
        if( !isset( $wp_registered_widgets[$widget_id] ) || 0 !== strpos( $wp_registered_widgets[$widget_id]['name'], '(FOX)' ) || !function_exists( 'icl_unregister_string' ) ) {
            return;
        }
        $widget = $wp_registered_widgets[$widget_id];
        $widget_class = $widget['callback'][0];
        $fields = $widget_class->fields();
        $length = count( $fields );
        $int = preg_match( '#-([0-9]+)$#i', $widget_id, $matches );
        $num_order = '';
		if ( $int ) { $num_order = $matches[1]; }
        
        for( $i=0; $i<$length; $i++ ) {
            if( isset( $fields[$i]['translate'] ) ) {
                icl_unregister_string( $widget_class::CONTEXT_WPML, $widget_class->field_name_translation( $fields[$i]['id'], $num_order ) );
            }
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
    return;
}

add_action( 'admin_init', 'fox56_register_wpml_strings' );
function fox56_register_wpml_strings() {
    global $builder_widgets;
    $ids = fox56_builder_cone_ids( 'sectionlist' );
    $package = Fox56_Builder_Widget_Base::PACKAGE_WPML;
    do_action( 'wpml_start_string_package_registration', $package );
    foreach( $ids as $widget_id ) {
        $widget_settings = get_theme_mod( $widget_id, [] );
        $w =& $widget_settings;
        
        if( !isset($w['type']) || !isset( $builder_widgets[ $w['type'] ] )  ) { continue; }
        
        $widget_obj = $builder_widgets[ $w['type'] ];
        $trans_fields = $widget_obj->translation_fields();
        if( !$trans_fields ) { continue; }
        foreach( $trans_fields as $key => $sub_key ) {
            $value = $widget_obj->field_value_from_array( $w, [$key => $sub_key] );
            $id = $widget_obj->translation_field_id( $widget_id, [$key => $sub_key] );
            // Using wpml_register_string. More https://wpml.org/wpml-hook/wpml_register_string/
            do_action( 'wpml_register_string', $value, $id, $package, 'widget', 'LINE' );
        }
    }
    do_action( 'wpml_delete_unused_package_strings', $package );
}

/**
 * Register some string from the customizer to be translated with Polylang
 */
function wi_wpml_register_strings() {
    
    /* Part 1: Homepage Builder
    ----------------------------------------------------------------- */
    $sections = fox_builder_data();
    foreach ( $sections as $i => $section ) {

        $heading = isset( $section[ 'heading' ] ) ? $section[ 'heading' ] : '';
        $section_id = isset( $section[ 'id' ] ) && $section[ 'id' ] ? $section[ 'id' ] : $i;
        if ( '' != $heading ) {
            do_action( 'wpml_register_single_string', 'FOX Homepage Builder', 'fox_builder_heading_' . $section_id, $heading );
        }
        
        $link_text = isset( $section[ 'viewall_link_text' ] ) ? $section[ 'viewall_link_text' ] : '';
        if ( '' != $link_text ) {
            do_action( 'wpml_register_single_string', 'FOX Homepage Builder', 'fox_builder_link_text_' . $section_id, $link_text );
        }
        
        $url = isset( $section[ 'viewall_link' ] ) ? $section[ 'viewall_link' ] : '';
        if ( '' != $url ) {
            do_action( 'wpml_register_single_string', 'FOX Homepage Builder', 'fox_builder_url_' . $section_id, $url );
        }

    }
    
    $prefix = 'main_stream_';
    $heading = get_theme_mod( $prefix . 'heading' );
    if ( '' != $heading ) {
        do_action( 'wpml_register_single_string', 'FOX Homepage Builder', 'fox_builder_heading_norm', $heading );
    }
    
    /* Part 2: Quick Translation
    ----------------------------------------------------------------- *
    // quick translate strings
    $strings = fox_quick_translation_support();
    foreach ( $strings as $k => $str ) {
        do_action( 'wpml_register_single_string', 'FOX Strings', 'fox_quick_' . $k, $str );
    }
    */

}

// todo57
// add_action( 'after_setup_theme', 'wi_wpml_register_strings' );