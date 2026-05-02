<?php
$fox56_customize->add_section( 'export', [
    'title' => 'Back up',
    'priority' => 184,
]);

$fox56_customize->add_field([
    'type' => 'html',
    'html' => '<a download href="' . get_rest_url( null, 'fox/v1/theme_mods' ) . '" class="button button-primary">Export Settings</a>',
    'id' => 'export_button',
    'name' => 'Export Settings',
    'section' => 'export',
]);