<?php
/**
 * hmm, there's a real risk here. So don't force to do so. Just let it as a setup wizard.
 */
// add_action('after_switch_theme', 'fox56_setup_onboard');
add_action( 'init', 'fox56_setup_onboard' );
if ( ! function_exists( 'fox56_setup_onboard' ) ) :
function fox56_setup_onboard () {

    /* Builder
    -------------------------------------------------------------------------------- */
    $sectionlist = get_theme_mod( 'sectionlist', [] );
    if ( ! isset( $sectionlist['content'] ) || empty( $sectionlist['content'] ) ) {
        fox56_generate_default_sectionlist();
    }

    return;

    /* Builder settings
    -------------------------------------------------------------------------------- */

    /* Header
    -------------------------------------------------------------------------------- */
    // header not sticky
    fox56_set_theme_mod( 'header_sticky_parts', [] );

    // topbar
    fox56_set_theme_mod( 'topbar_layout', '34-14' );
    fox56_set_theme_mod( 'topbar_right_elements', [ 'social', 'darkmode', 'search' ] );
    fox56_set_theme_mod( 'topbar_height', 44 );
    fox56_set_theme_mod( 'topbar_border', [ 'bottom' => 1] );
    fox56_set_theme_mod( 'topbar_border_color', '#e0e0e0' );

    // search
    fox56_set_theme_mod( 'header_search_style', 'toggle' ); // most modern

    // darkmode
    fox56_set_theme_mod( 'darkmode_switcher_style', 'icon' );

    // logo
    fox56_set_theme_mod( 'tagline_typography',[
        'spacing' => 0,
        'transform' => 'none',
    ]);
    fox56_set_theme_mod( 'tagline_color', '#999' );
    fox56_set_theme_mod( 'tagline_enable', true ); // enable by default

    // main
    fox56_set_theme_mod( 'main_header_border_bottom', 1 );
    fox56_set_theme_mod( 'main_header_border_color', '#e0e0e0' );

    // social
    fox56_set_theme_mod( 'header_social_icon_size', 30 );
    fox56_set_theme_mod( 'header_social_icon_font', 14 );
    fox56_set_theme_mod( 'header_social_icon_border', 1 );
    fox56_set_theme_mod( 'header_social_icon_background', '#fff' );
    fox56_set_theme_mod( 'header_social_icon_color', '#3f3f3f' );
    fox56_set_theme_mod( 'header_social_icon_border_color', '#e0e0e0' );

    fox56_set_theme_mod( 'header_social_icon_hover_background', '#111' );
    fox56_set_theme_mod( 'header_social_icon_hover_color', '#fff' );
    fox56_set_theme_mod( 'header_social_icon_hover_border_color', '#111' );

    // hamburger
    fox56_set_theme_mod( 'hamburger_size', 22 );

    // nav
    fox56_set_theme_mod( 'nav_typography', [
        'weight' => 400,
        'size' => '16',
        'uppercase' => 'none',
    ]);
    fox56_set_theme_mod( 'nav_color', '#777' );
    fox56_set_theme_mod( 'nav_hover_color', '#111' );
    fox56_set_theme_mod( 'nav_active_color', '#111' );

    fox56_set_theme_mod( 'nav_dropdown_indicator_size', 16 );
    fox56_set_theme_mod( 'nav_submenu_typography', [
        'weight' => 400,
        'size' => '15',
        'spacing' => 0,
        'uppercase' => 'none',
    ]);
    fox56_set_theme_mod( 'nav_dropdown_padding_top', 8 );
    fox56_set_theme_mod( 'nav_dropdown_border_radius', 4 );
    fox56_set_theme_mod( 'nav_dropdown_border_color', '#e0e0e0' );
    fox56_set_theme_mod( 'nav_dropdown_shadow', 1 );
    fox56_set_theme_mod( 'nav_dropdown_arrow', true );
    fox56_set_theme_mod( 'nav_dropdown_arrow_inner_color', '#fff' );
    fox56_set_theme_mod( 'nav_dropdown_arrow_outer_color', '#e0e0e0' );
    fox56_set_theme_mod( 'nav_dropdown_item_height', 30 );
    fox56_set_theme_mod( 'nav_dropdown_item_color', '#111' );
    fox56_set_theme_mod( 'nav_dropdown_item_background', '#fff' );
    fox56_set_theme_mod( 'nav_dropdown_item_hover_background', '#efefef' );
    fox56_set_theme_mod( 'nav_dropdown_item_active_background', '#efefef' );
    fox56_set_theme_mod( 'nav_dropdown_item_sep_color', '#e0e0e0' ); // for megamenu problem

    // offcanvas
    fox56_set_theme_mod( 'offcanvas_overlay_background', 'rgba(0,0,0,.2)' );
    fox56_set_theme_mod( 'offcanvas_nav_sep_color', '#ccc' );
    fox56_set_theme_mod( 'offcanvas_nav_typography', [
        'weight' => 600,
        'size' => 16,
    ]);
    fox56_set_theme_mod( 'offcanvas_nav_item_height', 44 );
    fox56_set_theme_mod( 'offcanvas_nav_item_padding', 8 );
    fox56_set_theme_mod( 'offcanvas_nav_item_hover_background', '#f0f0f0' );
    fox56_set_theme_mod( 'offcanvas_nav_dropdown_typography', [
        'weight' => 400,
        'size' => 15,
    ] );
    fox56_set_theme_mod( 'offcanvas_nav_dropdown_height', 36 );

    set_theme_mod( 'css_critical', true );

    /* Design
    -------------------------------------------------------------------------------- */
    fox56_set_theme_mod( 'sidebar_border', '1px' );
    fox56_set_theme_mod( 'sidebar_border_color', '#f0f0f0' );

    // accent color
    fox56_set_theme_mod( 'accent_color', '#0000FF' );
    fox56_set_theme_mod( 'link_color', '#0000FF' );

    fox56_set_theme_mod( 'body_font', 'Inter' );
    fox56_set_theme_mod( 'body_typography', [
        'size' => 16,
        'size_mobile' => 14,
        'line_height' => '1.6',
    ]);
    fox56_set_theme_mod( 'heading_font', 'Inter' );
    fox56_set_theme_mod( 'nav_font', 'Inter' );

    // input
    fox56_set_theme_mod( 'input_typography', [
        'transform' => 'none',
        'spacing' => '',
        'size' => 16,
        'size_mobile' => 16,
    ] );
    fox56_set_theme_mod( 'input_height', 44 );
    fox56_set_theme_mod( 'input_border_radius', 1 );
    fox56_set_theme_mod( 'input_border_color', '#c0c0c0' );
    fox56_set_theme_mod( 'input_focus_border_color', '#888' );

    // button
    fox56_set_theme_mod( 'button_typography', [
        'transform' => 'none',
        'spacing' => '',
        'weight' => 400,
        'size' => 16,
        'size_mobile' => 14,
    ]);
    fox56_set_theme_mod( 'button_border_radius', 2 );

    /**
     * darkmode
     */
    fox56_set_theme_mod( 'darkmode_background_color', '#2a3d47' );

    /* Single post
    -------------------------------------------------------------------------------- */
    fox56_set_theme_mod( 'single_padding_top', [
        'desktop' => 30,
        'tablet' => 30,
        'mobile' => 0,
    ] );
    
    fox56_set_theme_mod( 'subtitle_typography', [
        'size_template' => 'small',
    ]);
    fox56_set_theme_mod( 'subtitle_color', '#777' );

    // set_theme_mod( 'single_header_align', 'left' );
    fox56_set_theme_mod( 'reading_progress_height', 3 );
    fox56_set_theme_mod( 'content_link_style', 3 ); // black underline
    fox56_set_theme_mod( 'single_content_typography', [
        'size' => '1.1em',
        'size_mobile' => '1em',
        'line_height' => '1.68',
    ]);

    fox56_set_theme_mod( 'single_content_width', 'narrow' );

    /**
     * after content
     */
    fox56_set_theme_mod( 'single_after_content_elements', [ 'ad', 'share', 'tags', 'authorbox', 'related', 'comments', 'nav' ] );

    /**
     * bottom
     */
    fox56_set_theme_mod( 'single_bottom_elements', []);

    /**
     * postnav
     */
    fox56_set_theme_mod( 'single_nav_style', 'simple-2' );
    
    /**
     * dock
     */
    fox56_set_theme_mod( 'single_side_dock_title_typography', [
        'size_template' => 'tiny',
    ]);
    fox56_set_theme_mod( 'single_side_dock_orientation', 'right' );

    /**
     * caption
     */
    fox56_set_theme_mod( 'caption_color', '#777' );
    fox56_set_theme_mod( 'caption_link_color', '#000' );

    /**
     * blockquote
     */
    fox56_set_theme_mod( 'blockquote_border', [ 'left' => 3, 'color' => '#0000FF' ] );
    fox56_set_theme_mod( 'blockquote_padding', [ 'desktop' => '0 20px' ] );
    fox56_set_theme_mod( 'blockquote_typography', [
        'face' => 'Georgia',
        'style' => 'italic',
        'line_height' => '1.36',
    ]);

    /**
     * tags
     */
    fox56_set_theme_mod( 'tags_label', 'Tags: ' );
    fox56_set_theme_mod( 'tags_height', 36 );
    fox56_set_theme_mod( 'tags_background', '#f6f6f6' );
    fox56_set_theme_mod( 'tags_typography', [
        'size' => '0.9em',
    ]);

    /**
     * authorbox
     */
    fox56_set_theme_mod( 'authorbox_width', 'full' );
    fox56_set_theme_mod( 'authorbox_title_desc_spacing', 8 );
    fox56_set_theme_mod( 'authorbox_title_typography', [ 'size' => '1.2em' ] );
    fox56_set_theme_mod( 'authorbox_description_typography', [ 'size' => '0.95em', 'line_height' => '1.4' ] );
    
    /**
     * social share
     */
    fox56_set_theme_mod( 'share_spacing', 6 );
    fox56_set_theme_mod( 'share_align', 'left' );

    /**
     * comment
     */

    /**
     * single heading
     */
    fox56_set_theme_mod( 'single_heading_align', 'left' );
    fox56_set_theme_mod( 'single_heading_style', 'normal' );
    fox56_set_theme_mod( 'single_heading_border', [
        'bottom' => 1,
        // 'color' => ''
    ]);
    fox56_set_theme_mod( 'single_heading_typography', [
        'weight' => 700,
        'size' => '1em',
        'size_mobile' => '0.9em',
        'transform' => 'uppercase',
    ]);

    /**
     * related
     */
    fox56_set_theme_mod( 'single_related_title_typography', [
        'size_template' => 'tiny'
    ]);

    /* Blog archive
    -------------------------------------------------------------------------------- */

    /**
     * titlebar
     */
    fox56_set_theme_mod( 'titlebar_align', 'center' );
    fox56_set_theme_mod( 'titlebar_width', 720 );
    fox56_set_theme_mod( 'titlebar_container_border', [ 'top' => 0, 'bottom' => 0 ] );
    fox56_set_theme_mod( 'titlebar_border', [ 'top' => 0, 'bottom' => 1 ] );
    fox56_set_theme_mod( 'titlebar_border_color', '#f0f0f0' );

    fox56_set_theme_mod( 'titlebar_title_typography', [
        'size' => '3.4em',
        'size_tablet' => '2.8em',
        'size_mobile' => '2.4em',
    ]);
    fox56_set_theme_mod( 'titlebar_description_typography', [
        'size' => '1em',
        'size_tablet' => '0.95em',
        'size_mobile' => '0.9em',
    ]);
    fox56_set_theme_mod( 'titlebar_description_color', '#777' );

    /**
     * top area
     */
    fox56_set_theme_mod( 'category_toparea_display', 'latest' );
    fox56_set_theme_mod( 'category_toparea_number', 4 );

    fox56_set_theme_mod( 'tag_toparea_display', 'none' );
    fox56_set_theme_mod( 'tag_toparea_number', 4 );

    fox56_set_theme_mod( 'author_toparea_display', 'latest' );
    fox56_set_theme_mod( 'author_toparea_number', 4 );

    fox56_set_theme_mod( 'toparea_layout', 'group' );
    fox56_set_theme_mod( 'toparea_column', [ 'desktop' => 1, 'tablet' => 1, 'mobile' => 1 ] );
    fox56_set_theme_mod( 'toparea_components', [ 'thumbnail', 'standalone_category', 'title', 'excerpt', 'date', 'author' ] );

    fox56_set_theme_mod( 'toparea_thumbnail_width_type', 'percent' );
    // fox56_set_theme_mod( 'toparea_thumbnail_width_percent', [ 'desktop' => 50, 'tablet' => 40 ] );

    /**
     * top area query
     */
    fox56_set_theme_mod( 'toparea_not_excluded', true );

    /**
     * pagination
     */
    fox56_set_theme_mod( 'pagination_item_border', 0 );
    fox56_set_theme_mod( 'pagination_item_border_radius', 30 );
    fox56_set_theme_mod( 'pagination_item_color', '#aaa' );
    fox56_set_theme_mod( 'pagination_item_border_color', '#fff' );
    fox56_set_theme_mod( 'pagination_item_hover_color', '#111' );
    fox56_set_theme_mod( 'pagination_item_active_color', '#111' );
    fox56_set_theme_mod( 'pagination_typography', [
        'size' => 13,
        'weight' => 700,
        'transform' => 'uppercase',
    ]);
    
    /**
     * blog item
     */
    fox56_set_theme_mod( 'components', [ 'thumbnail', 'standalone_category', 'title', 'excerpt', 'date', 'author' ] );
    fox56_set_theme_mod( 'list_mobile_layout', 'list' );

    fox56_set_theme_mod( 'component_spacing', [ 'desktop' => 6 ] );
    fox56_set_theme_mod( 'title_margin_bottom', [ 'desktop' => 10, 'mobile' => 8 ] );
    fox56_set_theme_mod( 'excerpt_margin_bottom', [ 'desktop' => 24, 'mobile' => 14 ] );

    /**
     * title
     */
    fox56_set_theme_mod( 'post_title_hover_text_decoraction', 'underline' );
    fox56_set_theme_mod( 'post_title_hover_text_decoraction_color', '' );

    /**
     * thumbnail
     */

    /**
     * excerpt
     */
    fox56_set_theme_mod( 'excerpt_color', '#777' );

    /**
     * meta
     */
    fox56_set_theme_mod( 'author_avatar', true );
    fox56_set_theme_mod( 'post_meta_typography', [
        'size' => '0.9em',
        'size_mobile' => '0.85em',
    ]);
    fox56_set_theme_mod( 'post_meta_color', '#888' );
    fox56_set_theme_mod( 'post_meta_link_color', '#222' );
    fox56_set_theme_mod( 'author_avatar_size', [
        'desktop' => 40,
        'tablet' => 32,
        'mobile' => 24,
    ]);
    fox56_set_theme_mod( 'translate', [
        'author' => '%s',
    ]);

    /* Widgets
    -------------------------------------------------------------------------------- */
    fox56_set_theme_mod( 'wid_title_align', 'left' );
    fox56_set_theme_mod( 'wid_title_typography', [
        'weight' => 700,
        'size' => '0.8em',
        // 'size_mobile' => '0.9em',
        'transform' => 'uppercase',
        'spacing' => '0.2',
    ]);
    fox56_set_theme_mod( 'wid_title_padding', [
        'bottom' => 10,
    ]);
    // fox56_set_theme_mod( 'wid_title_border_color', '#e0e0e0' );
    fox56_set_theme_mod( 'wid_sep', '1px' );
    fox56_set_theme_mod( 'wid_sep_color', '#f0f0f0' );
    fox56_set_theme_mod( 'wid_spacing', 30 );

    fox56_set_theme_mod( 'list_widget_spacing', 4 );

    /* Footer
    -------------------------------------------------------------------------------- */
    fox56_set_theme_mod( 'footer_bottom_border', [
        'color' => '#f0f0f0',
    ]);
    fox56_set_theme_mod( 'footer_sidebar_border', [
        'color' => '#f0f0f0',
    ]);
    fox56_set_theme_mod( 'footer_bottom_layout', 'stack' );
    fox56_set_theme_mod( 'footer_stack_elements', [ 'logo', 'social', 'copyright', 'nav' ] );

    // social
    fox56_set_theme_mod( 'footer_social_icon_spacing', 8 );
    fox56_set_theme_mod( 'footer_social_icon_size', 36 );
    fox56_set_theme_mod( 'footer_social_icon_font', 16 );
    fox56_set_theme_mod( 'footer_social_icon_border', 1 );
    fox56_set_theme_mod( 'footer_social_icon_border_color', '#e0e0e0' );
    fox56_set_theme_mod( 'footer_social_icon_background', '#fff' );
    fox56_set_theme_mod( 'footer_social_icon_color', '#3f3f3f' );

    fox56_set_theme_mod( 'footer_social_icon_hover_background', '#111' );
    fox56_set_theme_mod( 'footer_social_icon_hover_color', '#fff' );
    fox56_set_theme_mod( 'footer_social_icon_hover_border_color', '#111' );

    // copyright
    fox56_set_theme_mod( 'copyright_typography', [
        'size_template' => 'supertiny',
    ]);
    fox56_set_theme_mod( 'footer_copyright_color', '#777' );

    // scrollup
    fox56_set_theme_mod( 'scrollup_type', 'icon' );
    fox56_set_theme_mod( 'scrollup_icon', 'chevron-thin-up' );
    fox56_set_theme_mod( 'scrollup_shape', 'circle' );
    fox56_set_theme_mod( 'scrollup_border_width', 1 );
    fox56_set_theme_mod( 'scrollup_color', '#3f3f3f' );
    fox56_set_theme_mod( 'scrollup_background', '#fff' );
    fox56_set_theme_mod( 'scrollup_border_color', '#e0e0e0' );

    fox56_set_theme_mod( 'scrollup_hover_color', '#fff' );
    fox56_set_theme_mod( 'scrollup_hover_background', '#111' );
    fox56_set_theme_mod( 'scrollup_hover_border_color', '#111' );

}
endif;

if ( ! function_exists( 'fox56_set_theme_mod' ) ) :
function fox56_set_theme_mod( $key, $value ) {
    $x = get_theme_mod( $key, null );
    if ( null === $x ) {
        set_theme_mod( $key, $value );
    }
}
endif;

if ( ! function_exists( 'fox56_generate_default_sectionlist' ) ) :
function fox56_generate_default_sectionlist() {

    /**
     * Homepage builder
     * --------------------------------------------------------------------------------
     */
    set_theme_mod( 'sectionlist', [
        'type' => 'builder',
        'widget_id' => 'sectionlist',
        'content' => [ 'section_1' ]
    ]);
    set_theme_mod( 'section_1', [
        'type' => 'section',
        'widget_id' => 'section_1',
        'content' => [ 'row_1' ]
    ]);
    set_theme_mod( 'section_1', [
        'type' => 'section',
        'widget_id' => 'section_1',
        'content' => [ 'row_1' ]
    ]);
    set_theme_mod( 'row_1', [
        'type' => 'row',
        'widget_id' => 'row_1',
        'sidebar' => 'sidebar',
        'sidebar_position' => 'right',
        'content' => [ 'column_1' ],
    ]);

    set_theme_mod( 'column_1', [
        'type' => 'column',
        'widget_id' => 'column_1',
        'size' => '1-1',
        'content' => [ 'post_list_1' ]
    ]);

    set_theme_mod( 'post_list_1', [
        'type' => 'post-list',
        'widget_id' => 'post_list_1',
        'number' => 10,
        'pagination' => true,
        'content' => [],
    ]);

    set_theme_mod( 'h2', [
        'css' => [
            'section_1' => [
                'padding' => [
                    'desktop' => '40px 0'
                ],
            ]
        ]
    ]);
}
endif;