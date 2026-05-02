<?php
$fox56_customize->add_section( 'single_bottom', [
    'title' => 'Bottom of post',
    'panel' => 'single',
]);

$fox56_customize->add_field([
    'type' => 'sortable',
    'id' => 'single_bottom_elements',
    'additional' => [
        'reorder_only' => true,
    ],
    'title' => 'Single bottom reorder',
    'section' => 'single_bottom',
    'std'     => [ 'ad', 'related', 'bottom_posts', 'nav' ],
    'options' => [
        'bottom_posts' => 'Bottom posts',
        'related' => 'Related posts',
        'nav' => 'Post navigation',
        'ad' => 'Bottom ad',
    ],
    'refresh' => 'single',
]);