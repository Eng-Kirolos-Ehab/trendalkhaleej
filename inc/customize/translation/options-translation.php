<?php
$fox56_customize->add_section( 'translation', [
    'title' => 'Quick translation',
    'priority' => 180,
]);

$fields = [];
foreach ( fox_quick_translation_support() as $k => $v ) {
    $fields[ $k ] = [
        'type' => 'text',
        'name' => $v,
        'col' => '1-1',
    ];
}

$fox56_customize->add_field([
    'type' => 'group',
    'id' => 'translate',
    'name' => 'Quick translation',
    'fields' => $fields,
    'section' => 'translation',
]);