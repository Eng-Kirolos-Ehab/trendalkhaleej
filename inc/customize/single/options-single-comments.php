<?php
$fox56_customize->add_section( 'single_comments', [
    'title' => 'Post Comments',
    'panel' => 'single',
]);

$fox56_customize->add_field([
    'type' => 'checkbox',
    'id' => 'comments_display',
    'section' => 'single_comments',
    'name' => 'Enable post comments',
    'std' => true,
]);