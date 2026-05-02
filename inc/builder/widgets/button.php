<?php
class Fox56_Builder_Button extends Fox56_Builder_Widget_Base {

    public function get_name() {
        return 'button';
    }
    public function get_title() {
        return 'Button';
    }

    public function get_icon() {
        return 'button';
    }

    public function get_preview_image_url() {
        // return get_template_directory_uri() . '/inc/builder/images/button.jpg';
        return get_template_directory_uri() . '/inc/builder/images/button.jpg?v=' . FOX_VERSION;
    }

    function fields() {
        global $fox56_customize;
        $fields = [];

        $fields['text'] = [
            'type' => 'text',
            'name' => 'Text',
            'std'  => 'Button'
        ];

        $fields['icon'] = [
            "type" => "text",
            "name" => "Icon",
            "hint" => "",
            "desc" => 'Icon name. e.g: <strong>bell</strong>, <strong>file</strong>.. choose <a href="https://fontawesome.com/v5/search?m=free" target="_blank">icon here</a>',
            'std'  => 'arrow-right'
        ];

        $fields['url'] = [
            "type" => "text",
            "name" => "URL",
        ];

        $fields['target'] = [
            "type" => "checkbox",
            "name" => "Open link in a new tab.",
        ];

        // size
        $fields['size'] = [
            "type" => "select",
            "name" => "Size",
            "options" => [
                "tiny" => "Tiny",
                "small" => "Small",
                "normal" => "Normal",
                "medium" => "Medium",
                "large" => "Large",
            ],
            "std" => "small",
        ];

        // block
        $fields['block'] = [
            'heading' => 'Additional options',
            "type" => "select",
            "name" => "Block",
            "hint" => "",
            "desc" => "",
            "options" => [
                "" => "Default",
                "full" => "Full",
                "half" => "Half",
                "third" => "Third",
            ],
            "std" => "",
        ];

        // align
        $fields['align'] = [
            "type" => "select",
            "name" => "Alignment",
            "options" => [
                '' => 'Default',
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right',
            ],
            "std" => '',
        ];

        $fields['style'] = [
            "type" => "select",
            "name" => "Style",
            "hint" => "",
            "desc" => "",
            "options" => [
                "primary" => "Primary",
                "black" => "Black",
                "outline" => "Outline",
                //Custom style
                "fill" => "--Custom--",
            ],
            "std" => "fill",
        ];

        // Color
        $fields['text_color'] = [
            // "heading" => "Color",
            "type" => "color",
            "name" => "Color",
            "hint" => "",
            "desc" => "",
            // 'css' => [
            //     [
            //         'property' => 'color',
            //         'selector' => '{{wrapper}} .btn56',
            //     ]
            // ],
            "condition" => [
                "style" => "fill"
            ]
        ];
        $fields['text_color_hover'] = [
            "type" => "color",
            "name" => "Text color hover",
            "hint" => "",
            "desc" => "",
            // 'css' => [
            //     [
            //         'property' => 'color',
            //         'selector' => '{{wrapper}} .btn56:hover',
            //     ]
            // ],
            "condition" => [
                "style" => "fill"
            ]
        ];

        // Background color
        $fields['bg_color'] = [
            "heading" => "Background color",
            "type" => "color",
            "name" => "Background color",
            "hint" => "",
            "desc" => "",
            // 'css' => [
            //     [
            //         'property' => 'background',
            //         'selector' => '{{wrapper}} .btn56',
            //     ]
            // ],
            "condition" => [
                "style" => "fill"
            ]
        ];
        $fields['bg_color_hover'] = [
            "type" => "color",
            "name" => "Background color hover",
            "hint" => "",
            "desc" => "",
            // 'css' => [
            //     [
            //         'property' => 'background',
            //         'selector' => '{{wrapper}} .btn56:hover',
            //     ]
            // ],
            "condition" => [
                "style" => "fill"
            ]
        ];

        // border
        $fields['border_radius'] = [
            "heading" => "Border",
            "type" => "number",
            "name" => "Border radius",
            "hint" => "",
            "desc" => "",
            "std" => 0,
            "min" => 0,
            "max" => 50,
            "step" => 1,
            // 'css' => [
            //     [
            //         'property' => 'border-radius',
            //         'selector' => '{{wrapper}} .btn56',
            //         'unit' => 'px',
            //     ]
            // ],
        ];
        $fields['border_width'] = [
            "type" => "number",
            "name" => "Border width",
            "hint" => "",
            "desc" => "",
            // "std" => 1,
            "min" => 0,
            "max" => 9,
            "step" => 1,
            // 'css' => [
            //     [
            //         'property' => 'border-width',
            //         'selector' => '{{wrapper}} .btn56',
            //         'unit' => 'px',
            //     ]
            // ],
            "condition" => [
                "style" => "fill"
            ]
        ];
        $fields['border_color'] = [
            "type" => "color",
            "title" => "Border color",
            "hint" => "",
            "desc" => "",
            // 'css' => [
            //     [
            //         'property' => 'border-color',
            //         'selector' => '{{wrapper}} .btn56',
            //     ]
            // ],
            'condition' => [
                "style" => "fill",
            ],
        ];
        $fields['border_color_hover'] = [
            "type" => "color",
            "name" => "Border color hover",
            "hint" => "",
            "desc" => "",
            // 'css' => [
            //     [
            //         'property' => 'border-color',
            //         'selector' => '{{wrapper}} .btn56:hover',
            //     ]
            // ],
            "condition" => [
                "style" => "fill",
            ],
        ];

        // extra_class
        $fields['extra_class'] = [
            "type" => "text",
            "name" => "CSS class",
            "hint" => "my-button",
            "desc" => "Add your custom class WITHOUT the dot. e.g: my-button",
        ];

        return $fields;
    }

    function render($args) {
        $args['target'] = (isset($args['target']) && $args['target']) ? '_blank' : '';
        if (isset($args['style']) && 'fill' != $args['style']) {
            $disable_fields = array(
                'text_color', 'text_color_hover',
                'bg_color', 'bg_color_hover',
                'border_width', 'border_color', 'border_color_hover'
            );
            foreach ($disable_fields as $k) {
                $args[$k] = '';
            }
        }

        echo fox56_btn($args, false, $args['widget_id']);
    }
}