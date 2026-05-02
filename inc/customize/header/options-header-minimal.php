<?php
$fox56_customize->add_section( 'header_minimal', [
    'title' => 'Header for "Hero post"',
    'panel' => 'header',
]);

$fox56_customize->add_field([
    'id' => 'header_minimal_redirect',
    'section' => 'header_minimal',
    'type' => 'message',
    'msg' => 'Please go to <strong>Customize > Single post > Hero post</strong>',
]);