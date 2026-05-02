<?php
$fox56_customize->add_section( 'design_dropcap',[
    'title' => 'Drop cap',
    'panel' => 'design'
]);

/* drop cap
------------------------------------------------------- */
$fox56_customize->add_field([
    'type' => 'typography',
    'id' => 'dropcap_typography',
    'std' => [
        'face' => 'var(--font-body)',
        'weight' => '700',
        'transform' => 'uppercase',
        'spacing' => '',
        'line_height' => '',
    ],
    'selector' => '.wi-dropcap,.enable-dropcap .dropcap-content > p:first-of-type:first-letter, p.has-drop-cap:not(:focus):first-letter',
    'section' => 'design_dropcap',
    'title' => 'Drop cap font',
    'hint' => 'dropcap font',
]);