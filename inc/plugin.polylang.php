<?php
if ( function_exists( 'pll_register_string' ) ) :

    /**
     * Register some string from the customizer to be translated with Polylang
     */
    function fox_theme_name_pll_register_string() {
        
        /* -------------------------        builder heading      */
        $widgetlist = fox56_builder_widgetlist();
        foreach ( $widgetlist as $widget_id => $widget_settings ) {
            if ( 'heading' != $widget_settings['type'] ) {
                continue;
            }
            if ( ! isset( $widget_settings['heading'] ) || ! $widget_settings['heading'] ) {
                continue;
            }
            extract( wp_parse_args( $widget_settings, [
                'heading' => '',
                'heading_link' => [],
                'heading_link_text' => '',
            ] ) );
            if ( '' !== $heading ) {
                pll_register_string( 'builder_heading_' . $widget_settings[ 'widget_id' ], $heading, 'Fox', true );
            }
            if ( is_array( $heading_link ) && isset( $heading_link['url'] ) && $heading_link['url'] ) {
                pll_register_string( 'builder_heading_url_' . $widget_settings[ 'widget_id' ], $heading_link['url'], 'Fox', true );
            }
            if ( '' !== $heading_link_text ) {
                pll_register_string( 'builder_heading_link_text' . $widget_settings[ 'widget_id' ], $heading_link_text, 'Fox', true );
            }
        }

        /* -------------------------        copyright      */
        $copyright = get_theme_mod( 'footer_copyright' );
        if ( '' != $copyright ) {
            pll_register_string( 'copyright', $copyright, 'Fox', true );
        }
        
        /* -------------------------        quick translation      */
        $strings = fox_quick_translation_support();
        foreach ( $strings as $k => $str ) {
            pll_register_string( $k, $str, 'Fox', true );
        }
        
    }

    add_action( 'after_setup_theme', 'fox_theme_name_pll_register_string' );

endif;