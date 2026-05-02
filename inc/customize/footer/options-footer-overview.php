<?php
$fox56_customize->add_section( 'footer_overview',[
    'title' => 'Overview (check me first)',
    'panel' => 'footer',
]);

$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'footer_overview_img',
    'html' => '<img src="' . get_template_directory_uri() . '/inc/customize/images/footer_overview.jpg?v=' . FOX_VERSION . '" />',

    'section' => 'footer_overview',
]);

$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'footer_overview_placeholder_top',
    'html' => '<h3 class="sortable56__custom_title">
                <a href="javascript:wp.customize.section(\'footer_top\').focus()" class="sortable56__custom_title__edit"><i class="dashicons dashicons-edit"></i></a>
                <span>Footer top</span>
            </h3>',
]);

$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'footer_overview_placeholder_sidebar',
    'html' => '<h3 class="sortable56__custom_title">
                <a href="javascript:wp.customize.section(\'footer_sidebar\').focus()" class="sortable56__custom_title__edit"><i class="dashicons dashicons-edit"></i></a>
                <span>Footer sidebars</span>
            </h3>',
]);

$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'footer_overview_placeholder_bottom',
    'html' => '<h3 class="sortable56__custom_title">
                <a href="javascript:wp.customize.section(\'footer_bottom\').focus()" class="sortable56__custom_title__edit"><i class="dashicons dashicons-edit"></i></a>
                <span>Footer bottom</span>
            </h3>',
]);

$fox56_customize->add_field([
    'type' => 'html',
    'id' => 'footer_overview_placeholder_scrollup',
    'html' => '<h3 class="sortable56__custom_title">
                <a href="javascript:wp.customize.section(\'footer_scrollup\').focus()" class="sortable56__custom_title__edit"><i class="dashicons dashicons-edit"></i></a>
                <span>Footer scroll up</span>
            </h3>',
]);