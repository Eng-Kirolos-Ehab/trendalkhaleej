<?php
/**
 * builder css problem
 */
add_action( 'wp_head', 'fox56_builder_css', 0 ); // IMPORTANT: must be priority 0
function fox56_builder_css() {
    global $fox56_customize;
    if ( ! $fox56_customize ) {
        return;
    }
    global $builder_widgets;

    $ids = fox56_builder_cone_ids( 'sectionlist' );
    
    $h2 = get_theme_mod( 'h2', [] );
    $h__css = isset( $h2['css'] ) ? $h2['css'] : [];

    foreach( $ids as $widget_id ) {
        if ( 'sectionlist' == $widget_id ) {
            continue;
        }
        $widget_settings = get_theme_mod( $widget_id, false );
        if ( false === $widget_settings ) {
            continue;
        }
        if ( ! isset( $widget_settings['type'] ) ) {
            continue;
        }
        $css = isset( $h__css[ $widget_id ] ) ? $h__css[ $widget_id ] : [];
        // print_r( $css );
        $type = $widget_settings[ 'type' ];
        if ( ! isset( $builder_widgets[ $type ] ) ) {
            continue;
        }
        $instance = $builder_widgets[ $type ];
        $fields = $instance->fields();

        foreach ( $fields as $field_id => $field ) {
            if ( ! isset( $field['css'])) {
                continue;
            }
            $field_std = isset( $field['std' ] ) ? $field['std' ] : null;
            
            $value = isset( $css[ $field_id ] ) ? $css[ $field_id ] : $field_std;

            $css_piece = [];
            $has_font = false;
            foreach( $field['css'] as $css_arr ) {
                
                $css_arr['selector'] = str_replace( '{{wrapper}}', '.' . $widget_id, $css_arr['selector'] );

                if ( 'group' == $field['type'] ) {
                    $use = $css_arr['use'];
                    if ( isset( $value[ $use ] ) ) {
                        $final_value = $value[ $use ];
                    } elseif ( isset( $field_std[ $use ] ) ) {
                        $final_value = $field_std[ $use ];
                    } else {
                        $final_value = null;
                    }
                    unset( $css_arr['use'] );
                } else {
                    $final_value = $value;
                }

                $css_arr[ 'value' ] = $final_value;
                $fox56_customize->css[] = $css_arr;
                $css_piece[] = $css_arr;

                if ( isset( $css_arr['property'] ) && $css_arr['property'] == 'font-family' ) {
                    $has_font = true;
                }
            }
            
            if ( $has_font ) {
                $fox56_customize->typography[] = $css_piece;
            }
            
        }
    } 
}