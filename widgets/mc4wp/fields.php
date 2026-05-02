<?php
$forms = [];
$std = '';
$args = array(
    'post_type' => 'mc4wp-form',
    'posts_per_page' => 100,
    'ignore_sticky_posts' => true,
);
$get_forms = get_posts( $args );
foreach ( $get_forms as $form ) {
    if ( ! $std ) $std = strval($form->ID);
    $forms[ strval($form->ID) ] = $form->post_title;
}

if ( ! $forms ) $forms = array( '' => 'Please go to Dashboard > MailChimp for WP > Forms to create at least a form.' );

$fields = array(
    
    array(
        'id' => 'title',
        'type' => 'text',
        'name' => 'Title',
    ),
    
    array(
        'id' => 'form_id',
        'name' => 'Choose Mailchimp Form',
        'type' => 'select',
        'options' => $forms,
        'translate' => 1,
    ),

    array(
        'id' => 'form_shortcode',
        'name' => 'Enter custom form shortcode',
        'type' => 'textarea',
    ),
    
    array(
        'id' => 'layout',
        'name' => 'Input Layout',
        'std'   => 'stack', // changed since 5.6
        'options' => [
            'inline' => 'Inline',
            'stack' => 'Stack',
        ],
        'type' => 'select',
    ),
    
    /*
    deprecated since 5.6
    array(
        'id' => 'heading_position',
        'name' => 'Heading position',
        'std'   => 'inline',
        'options' => [
            'inline' => 'Inline',
            'stack' => 'Stack',
        ],
        'type' => 'select',
    ),
    */
    
    array(
        'id' => 'heading',
        'name' => 'Heading text',
        'std'   => 'Join our mailing list',
        'placeholder' => 'Join our mailing list',
        'type' => 'text',
        'translate' => 1,
    ),
    
    /*
    array(
        'id' => 'mail_icon',
        'name' => 'Mail icon before heading?',
        'std'   => true,
        'type' => 'checkbox',
    ),
    */
    
    array(
        'id' => 'subtitle',
        'name' => 'Subtitle',
        'std'   => 'We hate spams like you do',
        'placeholder' => 'We hate spams like you do',
        'type' => 'text',
        'translate' => 1,
    ),
    
    array(
        'id' => 'text_color',
        'name' => 'Text Color',
        'type' => 'color',
    ),
    
    array(
        'id' => 'background_color',
        'name' => 'Background Color',
        'type' => 'color',
        'std' => '',
    ),
    
    array(
        'id' => 'background_image',
        'name' => 'Background Image',
        'type' => 'image',
    ),
    
    array(
        'id' => 'border_color',
        'name' => 'Border Color',
        'type' => 'color',
        'std' => '',
    ),
    
    array(
        'id' => 'button_style',
        'type' => 'select',
        'name' => 'Submit button style',
        'type' => 'select',
        'options' => [
            'black' => 'Black',
            'fill' => 'Fill',
            'outline' => 'Outline',
            'primary' => 'Primary',
        ],
        'std' => 'black',
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