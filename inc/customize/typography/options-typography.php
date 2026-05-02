<?php
/*
$fox56_customize->add_panel( 'typography', [
    'title' => 'Typography',
    'priority' => 54,
]);
*/

$custom_font_children = [];
$custom_font_variants = [];

if ( taxonomy_exists( 'bsf_custom_fonts' ) ) {
    $custom_fonts = get_terms([
        'taxonomy' => 'bsf_custom_fonts',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
    ]);
    if ( is_array( $custom_fonts ) ) {
        foreach ( $custom_fonts as $font_term ) {
            $custom_font_children[] = [
                'id' => $font_term->name,
                'text' => $font_term->name,
            ];
            $fox56_customize->custom_fonts[ $font_term->name ] = $font_term->name;
        }
    }
}

include_once(dirname( __FILE__ ) . '/options-typography-general.php');