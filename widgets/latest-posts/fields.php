<?php
$cat_arr = array( '' => 'All' );
$author_arr = array( '' => 'All' );
$categories = get_categories();
foreach ( $categories as $cat ) {
    $cat_arr[ strval( $cat->term_id ) ] = $cat->name;
}

$args = array(
    'number' => 100,
    'has_published_posts' => true,
    'orderby' => 'name',
    'order' => 'asc',
);

$authors = get_users( $args );
foreach ( $authors as $user ) {
    $author_arr[ strval( $user->ID ) ] = $user->display_name;
}

$fields = array(
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => esc_html__( 'Title', 'wi' ),
        'std' => 'Latest Posts',
    ),
    
    array(
        'id' => 'related',
        'name' => 'Displays "related posts"?',
        'type' => 'checkbox',
        'desc' => 'If you check this, this widget will display related posts of current-viewing post and only shows up in single post. If you display related posts, it\'ll skip all options other query options.',
    ),
    
    array(
        'id' => 'related_source',
        'name' => 'Related Source?',
        'options' => [
            'tag' => 'Posts having same tag',
            'category' => 'Posts having same category',
            'author' => 'Posts having same author',
        ],
        'std'   => 'tag',
        'type' => 'select',
        'desc' => 'Skip this option if you don\'t display related posts.'
    ),
    
    array(
        'id' => 'number',
        'name' => esc_html__( 'Number of posts to show', 'wi' ),
        'std'   => 4,
        'type' => 'text',
    ),
    
    array(
        'id' => 'category',
        'name' => esc_html__( 'Category', 'wi' ),
        'type' => 'select',
        'options' => $cat_arr,
    ),
    
    array(
        'id' => 'tag',
        'name' => 'Only from tags:',
        'type' => 'text',
        'placeholder' => 'Eg. 25, 342',
        'desc' => 'Enter tag IDs, separated by comma. You can find tag ID in your browser address bar when you edit a tag.',
    ),
    
    array(
        'id' => 'author',
        'name' => 'Author',
        'type' => 'select',
        'options' => $author_arr,
    ),
    
    array(
        'id' => 'orderby',
        'name' => 'Orderby',
        'type' => 'select',
        'options' => fox_orderby_support(),
        'std' => 'date',
    ),
    
    array(
        'id' => 'order',
        'name' => 'Order',
        'type' => 'select',
        'options' => fox_order_support(),
        'std' => 'desc',
    ),
    
    array(
        'id' => 'featured',
        'name' => 'Only featured post?',
        'type' => 'checkbox',
    ),
    
    array(
        'id' => 'include',
        'name' => 'Include only following posts:',
        'type' => 'text',
        'placeholder' => 'Eg. 15, 92',
        'desc' => 'Enter post IDs, separate them by commas.'
    ),
    
    array(
        'id' => 'layout',
        'name' => esc_html__( 'Layout', 'wi' ),
        'type' => 'select',
        'options' => array(
            'small' => 'Small Image',
            'big' => 'Big Image',
        ),
        'std' => 'small',
    ),
    
    /*
    array(
        'id' => 'list_index',
        'name' => 'List Index?',
        'desc' => 'If you choose layout Small Image',
        'type' => 'checkbox',
        'std' => false,
    ),
    */
    
    array(
        'id' => 'show_excerpt',
        'name' => 'Show Excerpt',
        'type' => 'checkbox',
    ),
    
    array(
        'id' => 'show_date',
        'name' => 'Show Date',
        'type' => 'checkbox',
        'std' => true,
    ),
    
    array(
        'id' => 'thumbnail_show',
        'name' => 'Show thumbnail?',
        'desc' => 'Show thumbnail',
        'type' => 'checkbox',
        'std' => true,
    ),
    
    /*
    array(
        'id' => 'item_card',
        'name' => 'Card Style',
        'type' => 'select',
        'options' => [
            'none' => 'None',
            'normal' => 'Normal',
            'normal_no_shadow' => 'Normal + no shadow',
            'overlap' => 'Text Overlaps Image',
            'overlap_no_shadow' => 'Overlap + no shadow',
        ],
        'std' => 'none',
    ),
    */

    array(
        'id' => 'thumbnail_align',
        'name' => 'Thumbnail Align',
        'type' => 'select',
        'options' => [
            'left'  => 'Left',
            'right' => 'Right',
        ],
        'desc' => 'Option for small image layout',
        'std'   => 'left',
    ),
    
    array(
        'id' => 'thumbnail',
        'name' => 'Thumbnail',
        'type' => 'select',
        'options' => fox_basic_thumbnail_support(),
        'std'   => 'landscape',
    ),
    
    array(
        'id' => 'title_font_size',
        'name' => 'Title font size',
        'type' => 'text',
        'placeholder' => 'Eg. 18',
    ),

    array(
        'id' => 'excerpt_font_size',
        'name' => 'Excerpt font size',
        'type' => 'text',
        'placeholder' => 'Eg. 14',
    ),

    array(
        'id' => 'meta_font_size',
        'name' => 'Meta font size',
        'type' => 'text',
        'placeholder' => 'Eg. 12',
    ),
    
    array(
        'id' => 'index',
        'name' => 'Show Index on thumbnail?',
        'desc' => 'Option for big image layout',
        'type' => 'checkbox',
    ),
    
    array(
        'id' => 'view',
        'name' => 'Show view count on thumbnail?',
        'desc' => 'Option for big image layout',
        'type' => 'checkbox',
    ),
    

    // ═══════════════════════════════════════════════════════════════
    // RTL & TEXT ALIGNMENT SECTION
    // ═══════════════════════════════════════════════════════════════
    
    array(
        'id'   => 'rtl_section',
        'type' => 'heading',
        'name' => '━━━ RTL & Text Alignment ━━━',
    ),
    
    array(
        'id'      => 'text_alignment',
        'name'    => 'Text Alignment',
        'type'    => 'select',
        'options' => array(
            'inherit' => 'Inherit (Auto RTL/LTR)',
            'right'   => 'Right (للعربية)',
            'center'  => 'Center',
            'left'    => 'Left',
        ),
        'std'     => 'inherit',
        'desc'    => 'Control text alignment for this widget',
    ),
    
    array(
        'id'      => 'title_alignment',
        'name'    => 'Title Alignment',
        'type'    => 'select',
        'options' => array(
            'inherit' => 'Inherit',
            'right'   => 'Right',
            'center'  => 'Center',
            'left'    => 'Left',
        ),
        'std'     => 'inherit',
    ),
    
    array(
        'id'      => 'content_direction',
        'name'    => 'Content Direction',
        'type'    => 'select',
        'options' => array(
            'auto' => 'Auto (Follow Site)',
            'rtl'  => 'RTL (Right to Left)',
            'ltr'  => 'LTR (Left to Right)',
        ),
        'std'     => 'auto',
    ),
    
    array(
        'id'      => 'items_direction',
        'name'    => 'Items Direction',
        'type'    => 'select',
        'options' => array(
            'auto'    => 'Auto',
            'normal'  => 'Normal (LTR)',
            'reverse' => 'Reverse (RTL)',
        ),
        'std'     => 'auto',
        'desc'    => 'Control the order of items/columns',
    ),
    
    // ═══════════════════════════════════════════════════════════════
    // BORDER SETTINGS
    // ═══════════════════════════════════════════════════════════════
    
    array(
        'id'   => 'border_section',
        'type' => 'heading',
        'name' => '━━━ Border Settings ━━━',
    ),
    
    array(
        'id'      => 'border_between',
        'name'    => 'Border Between Items',
        'type'    => 'select',
        'options' => array(
            'none'       => 'None',
            'horizontal' => 'Horizontal Line',
            'vertical'   => 'Vertical Line',
            'both'       => 'Both',
        ),
        'std'     => 'none',
    ),
    
    array(
        'id'      => 'border_position',
        'name'    => 'Widget Border',
        'type'    => 'select',
        'options' => array(
            'none'   => 'None',
            'top'    => 'Top',
            'bottom' => 'Bottom',
            'left'   => 'Left',
            'right'  => 'Right',
            'all'    => 'All Sides',
        ),
        'std'     => 'none',
    ),
    
    array(
        'id'          => 'border_color',
        'name'        => 'Border Color',
        'type'        => 'text',
        'placeholder' => '#e0e0e0',
    ),
    
    array(
        'id'          => 'border_width',
        'name'        => 'Border Width (px)',
        'type'        => 'text',
        'placeholder' => '1',
        'std'         => '1',
    ),
    
    array(
        'id'      => 'border_style',
        'name'    => 'Border Style',
        'type'    => 'select',
        'options' => array(
            'solid'  => 'Solid',
            'dashed' => 'Dashed',
            'dotted' => 'Dotted',
        ),
        'std'     => 'solid',
    ),
    
    // ═══════════════════════════════════════════════════════════════
    // SPACING
    // ═══════════════════════════════════════════════════════════════
    
    array(
        'id'   => 'spacing_section',
        'type' => 'heading',
        'name' => '━━━ Spacing ━━━',
    ),
    
    array(
        'id'          => 'widget_padding',
        'name'        => 'Widget Padding',
        'type'        => 'text',
        'placeholder' => '15px',
        'desc'        => 'e.g., 15px or 10px 20px',
    ),
    
    array(
        'id'          => 'item_spacing',
        'name'        => 'Item Spacing',
        'type'        => 'text',
        'placeholder' => '15px',
    ),
    
    array(
        'id'          => 'column_gap',
        'name'        => 'Column Gap',
        'type'        => 'text',
        'placeholder' => '20px',
    ),

);