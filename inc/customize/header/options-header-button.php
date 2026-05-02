<?php
// BUTTON 1
$fox56_customize->add_section( "header_button1", [
    "title" => 'Button 1',
    "panel" => "header",
]);
fox56_create_button_fields( 1, 'header_button1' );

// BUTTON 2
$fox56_customize->add_section( "header_button2", [
    "title" => 'Button 2',
    "panel" => "header",
]);
fox56_create_button_fields( 2, 'header_button2' );

/**
 * Create list fields of button
 */
function fox56_create_button_fields($i, $section) {

    global $fox56_customize;

    $fox56_customize->add_field([
        "type" => "text",
        "id" => "header_button{$i}_text",
        "title" => "Text",
        "desc" => "",
        'hint' => 'header button ' . $i,
        "std" => "Button {$i}",
        "section" => $section,
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);

    $fox56_customize->add_field([
        "type" => "text",
        "id" => "header_button{$i}_text_loggedin",
        "title" => "Logged-in user text",
        "desc" => "This text will be displayed for logged-in users. You might need this to design a Login button",
        'std' => '',
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);

    $fox56_customize->add_field([
        "type" => "text",
        "id" => "header_button{$i}_icon",
        "title" => "Icon",
        "desc" => 'Icon name. e.g: <strong>bell</strong>, <strong>file</strong>.. choose <a href="https://fontawesome.com/v5/search?m=free" target="_blank">icon here</a>',
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);

    /*
    $fox56_customize->add_field([
        'type' => 'textarea',
        "id" => "header_button{$i}_popup_content",
        "title" => "Popup content",
    ]);
    */

    $fox56_customize->add_field([
        "type" => "text",
        "id" => "header_button{$i}_url",
        "title" => "URL",
        "desc" => "",
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);

    $fox56_customize->add_field([
        "type" => "checkbox",
        "id" => "header_button{$i}_target",
        "title" => "Open link in a new tab.",
        "desc" => "",
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
    // size
    $fox56_customize->add_field([
        "type" => "select",
        "id" => "header_button{$i}_size",
        "title" => "Size",
        "desc" => "",
        "options" => [
            "tiny" => "Tiny",
            "small" => "Small",
            "normal" => "Normal",
            "medium" => "Medium",
            "large" => "Large",
        ],
        "std" => "small",
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);

    // style
    $fox56_customize->add_field([
        "type" => "select",
        "id" => "header_button{$i}_style",
        "title" => "Style",
        "desc" => "",
        "options" => [
            "primary" => "Primary",
            "black" => "Black",
            "outline" => "Outline",
            'filled' => 'Fill',

            //Custom style
            "fill" => "--Custom--",
        ],
        "std" => "black",
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ],
    ]);

    /* tabs 
    ---------------------------- */
    $fox56_customize->add_field([
        'type' => 'tabs',
        'tabs' => [
            'normal' => 'Normal',
            'hover' => 'Hover',
        ],
        'id' => "header_btn_{$i}__tabs",

        'heading' => 'Custom style',
    ]);
    
    /* normal 
    ---------------------------- */
    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_text_color",
        "title" => "Color",
        "desc" => "",
        
        'css' => [
            [
                'selector' => '.header56__btn__' . $i,
                'property' => 'color',
            ]
        ],

        'tabs' => "header_btn_{$i}__tabs",
        'tab' => 'normal',
    ]);

    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_bg_color",
        "title" => "Background color",
        "desc" => "",
        
        'css' => [
            [
                'selector' => '.header56__btn__' . $i,
                'property' => 'background',
            ]
        ],

        'tabs' => "header_btn_{$i}__tabs",
        'tab' => 'normal',
    ]);

    // border
    $fox56_customize->add_field([
        "type" => "number",
        "id" => "header_button{$i}_border_width",
        "title" => "Border width",
        "desc" => "",
        "std" => 1,
        "min" => 0,
        "max" => 9,
        "step" => 1,

        'css' => [
            [
                'selector' => '.header56__btn__' . $i,
                'property' => 'border-width',
                'unit' => 'px',
            ]
        ],

        'tabs' => "header_btn_{$i}__tabs",
        'tab' => 'normal',
    ]);

    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_border_color",
        "title" => "Border color",
        "desc" => "",
        
        'css' => [
            [
                'selector' => '.header56__btn__' . $i,
                'property' => 'border-color',
            ]
        ],

        'tabs' => "header_btn_{$i}__tabs",
        'tab' => 'normal',
    ]);

    $fox56_customize->add_field([
        "type" => "number",
        "id" => "header_button{$i}_border_radius",
        "title" => "Border radius",
        "desc" => "",
        "std" => 0,
        "min" => 0,
        "max" => 50,
        "step" => 1,
       
        'css' => [
            [
                'selector' => '.header56__btn__' . $i,
                'property' => 'border-radius',
                'unit' => 'px',
            ]
        ],

        'tabs' => "header_btn_{$i}__tabs",
        'tab' => 'normal',
    ]);

    /* hover
    ---------------------------- */
    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_text_color_hover",
        "title" => "Text color hover",
        
        'css' => [
            [
                'selector' => ".header56__btn__{$i}:hover",
                'property' => 'color',
            ]
        ],

        'tabs' => "header_btn_{$i}__tabs",
        'tab' => 'hover',
    ]);

    // Background color
    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_bg_color_hover",
        "title" => "Background color hover",
        
        'css' => [
            [
                'selector' => ".header56__btn__{$i}:hover",
                'property' => 'background',
            ]
        ],

        'tabs' => "header_btn_{$i}__tabs",
        'tab' => 'hover',
    ]);
    
    $fox56_customize->add_field([
        "type" => "color",
        "id" => "header_button{$i}_border_color_hover",
        "title" => "Border color hover",
        
        'css' => [
            [
                'selector' => ".header56__btn__{$i}:hover",
                'property' => 'border-color',
            ]
        ],

        'tabs' => "header_btn_{$i}__tabs",
        'tab' => 'hover',
    ]);

    /* additional options
    ---------------------------- */
    /*
    $fox56_customize->add_field([
        'heading' => 'Additional options',
        "type" => "select",
        "id" => "header_button{$i}_block",
        "title" => "Block",
        "options" => [
            "" => "Default",
            "full" => "Full",
            "half" => "Half",
            "third" => "Third",
        ],
        "std" => "",
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
    */
    // extra_class
    $fox56_customize->add_field([
        "type" => "text",
        "id" => "header_button{$i}_extra_class",
        "title" => "CSS class",
        "desc" => "Add your custom class WITHOUT the dot. e.g: my-button",
        "refresh" => [
            "selector" => ".header56__button{$i}",
            "render_callback" => "fox56_header_button{$i}_inner",
        ]
    ]);
}