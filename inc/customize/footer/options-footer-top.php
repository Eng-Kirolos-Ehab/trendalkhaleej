<?php
$fox56_customize->add_section( 'footer_top',[
    'title' => 'Footer top',
    'panel' => 'footer',
]);

$fox56_customize->add_field([
    'id' => 'footer_instagram_bg',
    'type' => 'color',
    'name' => 'Footer top background',
    'css' => [
        [
            'selector' => '#footer-instagram',
            'property' => 'background-color',
        ]
    ],
    'msg_before' => 'Here is Footer top settings. To enable this <strong>Footer top area</strong>, please go to either <strong>Customze &raquo; Widgets</strong> or <a href="' . get_admin_url( '','widgets.php' ). '" target="_blank">Dashboard &raquo; Appearance &raquo; Widgets ↗</a> to drag the widgets (Instagram, Newsletter..) to the <strong>Footer top</strong> sidebar.',
    'section' => 'footer_top',
]);